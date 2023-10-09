function hasTouch() {
  return "ontouchstart" in window;
}

function floatImages() {
  if (hasTouch() === true) return;
  var scrolled = $(window).scrollTop();
  $("[data-move-speed]").each(function() {
    var initY = $(this).offset().top;
    var height = $(this).outerHeight();
    var speedData = $(this).data("move-speed");
    var diff = scrolled - initY;
    var ratio = Math.round((diff / height) * 100);
    $(this).css({
      transform: "translateY(" + parseInt(-(ratio * speedData)) + "px)",
    });
  });
}

jQuery(document).ready(() => {
  floatImages();
  $(window).on("scroll", () => {
    floatImages();
  });
});
