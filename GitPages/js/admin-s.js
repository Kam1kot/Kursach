document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("liveSearch");
    const drop = document.getElementById("searchDrop");
    /* если не страница товаров — выходим */
    if (!searchInput || !drop) {
        console.warn("LiveSearch: элементы не найдены");
        return;
    }

    const rows = [...document.querySelectorAll(".product-row")];

    const toggleDrop = (show) => {
        drop.style.display = show ? "block" : "none";
    };

    const clearHighlight = () => {
        rows.forEach((r) => r.classList.remove("highlight"));
    };

    /* клик по результату */
    drop.addEventListener("click", async (e) => {
        const item = e.target.closest("[data-id]");
        if (!item) return;

        const id = item.dataset.id;

        const res = await fetch(`/admin/products/locate?id=${id}`);
        const { found, page } = await res.json();
        if (!found) return;

        const here = document.querySelector(
            `.product-row[data-product-id="${id}"]`
        );

        if (here) {
            toggleDrop(false);
            searchInput.value = "";
            clearHighlight();
            here.classList.add("highlight");
            here.scrollIntoView({ behavior: "smooth", block: "center" });
            return;
        }

        const url = new URL(location);
        url.searchParams.set("page", page);
        url.searchParams.set("highlight", id);
        location.href = url.toString();
    });

    let abortCtrl;
    searchInput.addEventListener("input", async () => {
        const q = searchInput.value.trim();
        if (!q) {
            toggleDrop(false);
            return;
        }

        if (abortCtrl) abortCtrl.abort();
        abortCtrl = new AbortController();

        try {
            const res = await fetch(
                `/admin/products/search-json?q=${encodeURIComponent(q)}`,
                { signal: abortCtrl.signal }
            );

            if (!res.ok) throw new Error(res.status);

            const data = await res.json();

            drop.innerHTML = data
                .map(
                    (p) =>
                        `<div class="dropdown-item" data-id="${p.id}">
                            ${p.title} <span class="muted">id:${p.id}</span>
                        </div>`
                )
                .join("");

            toggleDrop(!!data.length);
        } catch (err) {
            if (err.name === "AbortError") return;
            console.warn("Live search error:", err);
            toggleDrop(false);
        }
    });

    document.addEventListener("click", (e) => {
        if (
            !e.target.closest("#liveSearch") &&
            !e.target.closest("#searchDrop")
        ) {
            toggleDrop(false);
        }
    });

    const params = new URLSearchParams(window.location.search);
    const highlightId = params.get("highlight");

    if (highlightId) {
        const row = document.querySelector(
            `.product-row[data-product-id="${highlightId}"]`
        );

        if (row) {
            console.log(row);
            row.classList.add("highlight");

            row.scrollIntoView({
                behavior: "smooth",
                block: "center",
            });

            // убрать подсветку через 3 секунды (опционально)
            setTimeout(() => {
                row.classList.remove("highlight");
            }, 3000);
        }
    }
    console.log("Карточек товаров:", rows.length);
});
