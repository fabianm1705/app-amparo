var swiper = new Swiper('.swiper-container', {
  slidesPerView: 5,
  spaceBetween: 10,
  slidesPerGroup: 2,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  breakpoints: {
    100: {
      slidesPerView: 1,
      spaceBetween: 10,
      slidesPerGroup: 1,
    },
    400: {
      slidesPerView: 2,
      spaceBetween: 10,
      slidesPerGroup: 1,
    },
    640: {
      slidesPerView: 3,
      spaceBetween: 10,
      slidesPerGroup: 1,
    },
    815: {
      slidesPerView: 4,
      spaceBetween: 10,
    },
    1024: {
      slidesPerView: 5,
      spaceBetween: 10,
    },
  }
});
