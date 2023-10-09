function imgTagToSvg() {
  $("img.svg").each(function() {
    const $img = $(this);
    const imgID = $img.attr("id");
    const imgClass = $img.attr("class");
    const imgURL = $img.attr("src");

    $.get(
      imgURL,
      function(data) {
        var $svg = $(data).find("svg");

        if (typeof imgID !== "undefined") {
          $svg = $svg.attr("id", imgID);
        }
        if (typeof imgClass !== "undefined") {
          $svg = $svg.attr("class", imgClass + " replaced-svg");
        }

        $svg = $svg.removeAttr("xmlns:a");

        if (
          !$svg.attr("viewBox") &&
          $svg.attr("height") &&
          $svg.attr("width")
        ) {
          $svg.attr(
            "viewBox",
            "0 0 " + $svg.attr("height") + " " + $svg.attr("width")
          );
        }

        $img.replaceWith($svg);
      },
      "xml"
    );
  });
}

jQuery(document).ready(() => {
  const menuBtn = $("#mobile-menu-btn");

  menuBtn.on("click", function() {
    $(this).toggleClass("menu-btn--clicked");

    if ($(this).hasClass("menu-btn--clicked")) {
      $(".nav-primary__menu--mobile").fadeIn();
    } else {
      $(".nav-primary__menu--mobile").fadeOut();
    }
  });

  $(".nav-primary__menu--mobile .menu-item-has-children > a").on(
    "click",
    function(e) {
      const subMenu = $(this)
        .closest(".menu-item")
        .children("ul");
      const subMenuHeight = subMenu[0].scrollHeight;

      if (subMenu.outerHeight() === 0) {
        $(this)
          .closest(".menu-item")
          .addClass("js-active");
        subMenu.css("max-height", subMenuHeight + "px");
        e.preventDefault();
        return false;
      } else {
        $(this)
          .closest(".menu-item")
          .removeClass("js-active");
        subMenu.css("max-height", 0);
        e.preventDefault();
        return false;
      }
    }
  );

  $(".nav-primary__menu--mobile .menu-item-gtranslate").on("click", function() {
    $(this)
      .closest(".menu-item")
      .toggleClass("js-active");
  });

  imgTagToSvg();

  $(".nav-primary__menu--desktop .menu-item-has-children").hover(
    function() {
      $(this)
        .find(".submenu")
        .fadeIn("fast");
    },
    function() {
      $(this)
        .find(".submenu")
        .fadeOut("fast");
    }
  );

  $(".nav-primary__menu--desktop .menu-item-gtranslate").hover(
    function() {
      $(this)
        .find("div.option")
        .fadeIn("fast");
    },
    function() {
      $(this)
        .find("div.option")
        .fadeOut("fast");
    }
  );

  const mailtoUsername = themeVars.mailtoUsername;
  const mailtoDomain = themeVars.mailtoDomain;
  $(".btn-cta").on("click", e => {
    e.preventDefault();
    const username = mailtoUsername;
    const domain = mailtoDomain;
    window.location.href = "mailto:" + username + "@" + domain;
  });

  $(window).on("load", function() {
    $(".load-later").addClass("loaded");
  });
});
