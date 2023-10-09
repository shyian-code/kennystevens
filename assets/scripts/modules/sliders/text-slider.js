jQuery(document).ready(() => {
  $(".bg-img-text__slider").slick({
    arrows: false,
    dots: true,
    slidesToShow: 1,
    infinite: true,
    speed: 500,
    fade: true,
    cssEase: "linear",
    autoplay: true,
    autoplaySpeed: 8000,
    draggable: true,
  });
});
