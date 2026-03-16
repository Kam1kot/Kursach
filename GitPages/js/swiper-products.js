const otherProductsContainer = document.querySelector(".other-prds .swiper");
if (otherProductsContainer) {
  new Swiper(otherProductsContainer, {
    direction: "horizontal",
    loop: false,
    slidesPerView: 4,
    spaceBetween: 15,
    breakpoints: {
      1920: {
        slidesPerView: 5,
        spaceBetween: 20,
      },
      1440: {
        slidesPerView: 4,
        spaceBetween: 20,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
      320: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
    },
  });
}
