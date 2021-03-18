var mySwiper = new Swiper('.swiper-container', {
  loop: true,
  autoplay: true,
  pagination: {
    el: '.swiper-pagination',
  },
})
let menuToggle = $('.header-menu-toggle');
menuToggle.on('click', function(event) {
  event.preventDefault();
  $('.header-nav').slideToggle(200);

})