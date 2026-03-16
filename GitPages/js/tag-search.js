document.addEventListener("DOMContentLoaded", () => {
    const input = document.getElementById("liveSearch");
    const drop = document.getElementById("searchDrop");

    const rows = [...document.querySelectorAll(".product-row")];

    const toggleDrop = (show) => {
        drop.style.display = show ? "block" : "none";
    };

    const clearHighlight = () => {
        rows.forEach((r) => r.classList.remove("highlight"));
    };

    /* === клик по результату === */
    drop.addEventListener("click", async (e) => {
        const item = e.target.closest("[data-id]");
        if (!item) return;

        const id = item.dataset.id;

        // используем route('tags.locate') через blade
        const res = await fetch(`/tags/locate?id=${id}`);
        const { found, page, tag } = await res.json();
        if (!found) return;

        const here = document.querySelector(
            `.product-row[data-tag-id="${id}"]`
        );

        if (here) {
            toggleDrop(false);
            input.value = "";
            clearHighlight();
            here.classList.add("highlight");
            here.scrollIntoView({ behavior: "smooth", block: "center" });
            return;
        }

        // если тег на другой странице — редирект с highlight
        const url = new URL(location);
        url.searchParams.set("page", page);
        url.searchParams.set("highlight", id);
        location.href = url.toString();
    });

    /* === ввод текста === */
    let abortCtrl;

    input.addEventListener("input", async () => {
        const q = input.value.trim();
        if (!q) {
            toggleDrop(false);
            return;
        }

        if (abortCtrl) abortCtrl.abort();
        abortCtrl = new AbortController();

        try {
            const res = await fetch(
                `/tags/search-json?q=${encodeURIComponent(q)}`,
                { signal: abortCtrl.signal }
            );
            if (!res.ok) throw new Error(res.status);

            const data = await res.json();

            drop.innerHTML = data
                .map(
                    (t) =>
                        `<div class="dropdown-item" data-id="${t.id}">
                            #${t.title} <span class="muted">id:${t.id}</span>
                        </div>`
                )
                .join("");

            toggleDrop(!!data.length);
        } catch (err) {
            if (err.name === "AbortError") return;
            toggleDrop(false);
        }
    });

    /* === клик вне области закрывает выпадающий список === */
    document.addEventListener("click", (e) => {
        if (!e.target.closest(".search-box")) toggleDrop(false);
    });

    /* === подсветка после редиректа === */
    const params = new URLSearchParams(location.search);
    const highlightId = params.get("highlight");

    if (highlightId) {
        const row = document.querySelector(
            `.product-row[data-tag-id="${highlightId}"]`
        );
        if (row) {
            row.classList.add("highlight");
            row.scrollIntoView({ behavior: "smooth", block: "center" });
            setTimeout(() => row.classList.remove("highlight"), 3000);
        }
    }
});
