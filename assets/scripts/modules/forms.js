function setupCurrentTimeLS() {
  var now = new Date().getTime();
  var setupTime = localStorage.getItem("setupTime");
  if (setupTime == null) {
    localStorage.setItem("setupTime", now);
  }
}

jQuery(document).on("ready", function() {
  $(".text-content input, .text-content textarea, .download-form input")
    .focusin(function() {
      $(this)
        .closest(".gfield")
        .addClass("focus");
    })
    .focusout(function() {
      if (!$(this).val() || $(this).val() === "(___) ___-____") {
        $(this)
          .closest(".gfield")
          .removeClass("focus");
      }
    });

  $(document).bind("gform_confirmation_loaded", function() {
    $(".download-form__text-wrapper").addClass(
      "download-form__text-wrapper--hidden"
    );
  });

  // if ($("body").hasClass("page-template-thank-you")) {
  //   console.log("is page-template-thank-you");
  // }

  const popupForm = $(".popup-form");
  const popupFormInner = $(".download-form--popup");
  const popupFormCloseBtn = $(".popup-form__close-btn");
  const popupAppearTime = themeVars.popupAppearTime * 1000;
  const popupHideForMinutes = themeVars.popupHideForMinutes;
  const popupHideForHours = themeVars.popupHideForHours;
  const popupHideForDays = themeVars.popupHideForDays;

  var formShowDelay;

  if (popupHideForMinutes !== "0") {
    formShowDelay = popupHideForMinutes * 60 * 1000;
  }
  if (popupHideForHours !== "0") {
    formShowDelay = popupHideForHours * 60 * 60 * 1000;
  }
  if (popupHideForDays !== "0") {
    formShowDelay = popupHideForDays * 24 * 60 * 60 * 1000;
  }

  var showPopup;

  function checkTimeLS() {
    if (formShowDelay) {
      var now = new Date().getTime();
      var getTime = localStorage.getItem("setupTime");
      if (now - getTime > formShowDelay) {
        localStorage.removeItem("setupTime");
        showPopup = true;
      } else {
        showPopup = false;
      }
    } else {
      showPopup = true;
    }
  }

  function showPopupFunc() {
    if (showPopup) {
      setTimeout(function() {
        popupForm.addClass("popup-form--show");
      }, popupAppearTime);
    }
  }

  checkTimeLS();
  showPopupFunc();

  popupFormCloseBtn.on("click", function() {
    $(this)
      .closest(".popup-form")
      .removeClass("popup-form--show");
    if (formShowDelay) {
      setupCurrentTimeLS();
    }
  });

  const el_height_class = "popup-form--sm-form-height";
  const el2_height_class = "download-form--sm-form-height";
  const el3_height_class = "popup-form__close-btn--sm-form-height";

  const windowHeight = $(window).height();
  const popupHeight = popupForm.outerHeight();

  if (windowHeight < popupHeight) {
    popupForm.addClass(el_height_class);
    popupFormInner.addClass(el2_height_class);
    popupFormCloseBtn.addClass(el3_height_class);
  } else {
    popupForm.removeClass(el_height_class);
    popupFormInner.removeClass(el2_height_class);
    popupFormCloseBtn.removeClass(el3_height_class);
  }
});
