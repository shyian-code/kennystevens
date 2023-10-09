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
      if (elementIntoView(currentSection, 3)) {
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
        if (elementIntoView(currentSection, 3)) {
          currentSection.addClass("active");
        }
      }
    });
  });
}

function flexLastToLeft() {
  const post = $(".post");
  var posts = post.length;
  if (posts % 3 !== 0) {
    post.last().addClass("post--last-mr");
  }
}

function loadPostsAjax() {
  function appendData(dataArray) {
    for (var i = 0; i < dataArray.length; i++) {
      var markup = dataArray[i];
      var postDocument = new DOMParser().parseFromString(markup, "text/html");
      var post = postDocument.body.firstChild;
      postsWrapper.append(post);
    }
  }

  const postsWrapper = $(".post-listing");
  const queryVars = postsWrapper.data("query-vars");
  const totalCount = postsWrapper.data("total");

  if (queryVars) {
    var postsPerPage = queryVars.posts_per_page,
      offset = queryVars.offset;

    var startOffset = queryVars.offset;
  }

  const footerHeight = $(".footer").outerHeight();
  var canBeLoaded = true,
    bottomOffset = footerHeight * 3;

  $(window).scroll(function() {
    if (
      $(document).scrollTop() > $(document).height() - bottomOffset &&
      canBeLoaded === true
    ) {
      $.ajax({
        type: "POST",
        url: themeVars.adminUrl,
        data: {
          action: "loadmore",
          queryVars: queryVars,
        },
        beforeSend: function() {
          canBeLoaded = false;
        },
        success: function(jsonData) {
          var data = JSON.parse(jsonData);

          if (parseInt(offset) + parseInt(postsPerPage) >= totalCount) {
            appendData(data.posts);
          } else {
            appendData(data.posts);
          }
          scrollPage();
          flexLastToLeft();
          offset = parseInt(offset) + parseInt(postsPerPage);
          canBeLoaded = true;
        },
      });
      if (queryVars) {
        queryVars.offset = parseInt(offset) + parseInt(postsPerPage);
      }
    }
  });
}

jQuery(document).ready(() => {
  flexLastToLeft();
  loadPostsAjax();
});
