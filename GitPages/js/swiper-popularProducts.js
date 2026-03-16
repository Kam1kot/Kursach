const classicProductsContainer = document.querySelector(".popular-product-list .swiper");
if (classicProductsContainer) {
  new Swiper(classicProductsContainer, {
    direction: "horizontal",
    loop: false,
    slidesPerView: 3,
    autoplay: {
      delay: 6000,
    },
    spaceBetween: 20,
    breakpoints: {
      320: {
        slidesPerView: 1,
        spaceBetween: 15,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 15,
      },
      1560: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
    },
  });
}
