jQuery(document).ready(() => {
  function slickBtns() {
    if (parseInt($(window).width()) >= 1440) {
      const windowWidth = $(window).width();
      const heroActiveWidth = 1250;
      const heroPadding = 35;
      const heroBtnHalfWidth = 50;
      const offsetFromSides =
        (windowWidth - heroActiveWidth) / 2 - heroPadding - heroBtnHalfWidth;
      const nextBtn = $(".slick-next");
      nextBtn.css("right", offsetFromSides + "px");
      const prevBtn = $(".slick-prev");
      prevBtn.css("left", offsetFromSides + "px");
    }
  }

  $(".hero-slider")
    .on("init", function() {
      slickBtns();
      $(window).resize(() => {
        slickBtns();
      });
    })
    .slick({
      arrows: true,
      dots: false,
      centerMode: true,
      centerPadding: "60px",
      slidesToShow: 1,
      variableWidth: true,
      focusOnSelect: false,
      adaptiveHeight: true,
      responsive: [
        {
          breakpoint: 1440,
          settings: {
            centerMode: false,
            centerPadding: "",
            focusOnSelect: false,
            variableWidth: false,
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 320,
          settings: {
            centerMode: false,
            centerPadding: "",
            focusOnSelect: false,
            variableWidth: false,
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });
});
