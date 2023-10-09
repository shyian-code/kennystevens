function elementIntoView(elem, times) {
  if (elem.length) {
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();

    var elemTop = $(elem).offset().top;
    var elemTopOffset = $(elem).offset().top + $(elem).height();

    var elemBottom = elemTop + $(elem).height() / times;

    return elemBottom <= docViewBottom && elemTopOffset >= docViewTop;
  }
  return false;
}

function scrollPage() {
  const sectionsToScroll = $(".animate-sections .section");
  sectionsToScroll.each(function() {
    const currentSection = $(this);
    if (parseInt($(window).width()) <= 767) {
      if (elementIntoView(currentSection, 10)) {
        currentSection.addClass("active");
      }
    } else {
      if (elementIntoView(currentSection, 5)) {
        currentSection.addClass("active");
      }
    }
  });
  $(window).on("scroll", function() {
    sectionsToScroll.each(function() {
      const currentSection = $(this);
      if (parseInt($(window).width()) <= 767) {
        if (elementIntoView(currentSection, 10)) {
          currentSection.addClass("active");
        }
      } else {
        if (elementIntoView(currentSection, 5)) {
          currentSection.addClass("active");
        }
      }
    });
  });
}

function checkScroll() {
  const headerTop = $(".header");
  if ($(window).scrollTop() > 0) {
    headerTop.addClass("header--sticky");
  } else {
    headerTop.removeClass("header--sticky");
  }
}

jQuery(document).ready(() => {
  scrollPage();

  checkScroll();
  $(window).scroll(function() {
    checkScroll();
  });
});
