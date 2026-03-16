document.addEventListener("DOMContentLoaded", () => {

    const imageInput =
        document.getElementById("imageInput") ||
        document.getElementById("mainFile");

    if (!imageInput) return;

    const imagesHidden = document.getElementById("imagesHidden");
    const imagesPreview = document.getElementById("imagesPreview");

    const previewImg = document.getElementById("previewImg");
    const previewWrap = document.getElementById("previewWrap");
    const cropBtn = document.getElementById("cropBtn");

    let cropper = null;
    let croppedImages = [];

    imageInput.addEventListener("change", (e) => {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = (evt) => {
            previewImg.src = evt.target.result;
            previewWrap.classList.remove("d-none");
            cropBtn.classList.remove("d-none");

            if (cropper) cropper.destroy();

            cropper = new Cropper(previewImg, {
                aspectRatio: 1.65,
                viewMode: 1,
            });
        };
        reader.readAsDataURL(file);
    });

    cropBtn.addEventListener("click", () => {
        if (!cropper) return;

        const canvas = cropper.getCroppedCanvas({
            width: 600,
            height: 400,
        });

        canvas.toBlob((blob) => {

            const file = new File(
                [blob],
                `product_${Date.now()}.jpg`,
                { type: "image/jpeg" }
            );

            // если есть hidden input → сохраняем туда
            if (imagesHidden) {
                croppedImages.push(file);

                const dt = new DataTransfer();
                croppedImages.forEach(f => dt.items.add(f));
                imagesHidden.files = dt.files;
            }

            // если есть preview блок → добавляем превью
            if (imagesPreview) {
                const img = document.createElement("img");
                img.src = canvas.toDataURL("image/jpeg");
                img.style.width = "120px";
                img.style.borderRadius = "6px";
                imagesPreview.appendChild(img);
            }

            cropper.destroy();
            cropper = null;

            previewWrap.classList.add("d-none");
            cropBtn.classList.add("d-none");

            imageInput.value = "";

        }, "image/jpeg", 0.9);
    });

});
