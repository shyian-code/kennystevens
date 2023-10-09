function rollingNumbersCols() {
  const rollingNumbersSection = $(".rolling-numbers-cols");

  if (rollingNumbersSection.length !== 0) {
    var a = 0;
    $(window).scroll(function() {
      var oTop = rollingNumbersSection.offset().top - window.innerHeight + 200;
      const rollingNumbersWrap = rollingNumbersSection.find(
        ".rolling-numbers-cols__col"
      );

      if (a === 0 && $(window).scrollTop() > oTop) {
        rollingNumbersWrap.each(function() {
          var $currentCol = $(this).find(".rolling-numbers-cols__number"),
            countTo = $currentCol.attr("data-number");
          $({
            countNum: $currentCol.text(),
          }).animate(
            {
              countNum: countTo,
            },

            {
              duration: 3000,
              easing: "swing",
              step: function() {
                $currentCol.text(Math.floor(this.countNum));
              },
              complete: function() {
                $currentCol.text(this.countNum);
              },
            }
          );
        });
        a = 1;
      }
    });
  }
}

jQuery(document).ready(() => {
  rollingNumbersCols();
});
