const mainBannersContainer = document.querySelector(".main-banners .swiper");
if (mainBannersContainer) {
  new Swiper(mainBannersContainer, {
    direction: "horizontal",
    loop: true,
    autoplay: {
      delay: 10000,
    },
    slidesPerView: 2,
    spaceBetween: 10,
    breakpoints: {
      1600: {
        slidesPerView: 2,
        spaceBetween: 10,
      },
      320: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
    },
    scrollbar: {
      el: ".swiper-scrollbar",
    },
  });
}
