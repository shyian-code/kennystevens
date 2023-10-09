(function($) {
  var style = [
    {
      elementType: "geometry",
      stylers: [
        {
          color: "#f5f5f5",
        },
      ],
    },
    {
      elementType: "labels.icon",
      stylers: [
        {
          visibility: "off",
        },
      ],
    },
    {
      elementType: "labels.text.fill",
      stylers: [
        {
          color: "#616161",
        },
      ],
    },
    {
      elementType: "labels.text.stroke",
      stylers: [
        {
          color: "#f5f5f5",
        },
      ],
    },
    {
      featureType: "administrative.land_parcel",
      elementType: "labels.text.fill",
      stylers: [
        {
          color: "#bdbdbd",
        },
      ],
    },
    {
      featureType: "poi",
      elementType: "geometry",
      stylers: [
        {
          color: "#eeeeee",
        },
      ],
    },
    {
      featureType: "poi",
      elementType: "labels.text.fill",
      stylers: [
        {
          color: "#757575",
        },
      ],
    },
    {
      featureType: "poi.park",
      elementType: "geometry",
      stylers: [
        {
          color: "#e5e5e5",
        },
      ],
    },
    {
      featureType: "poi.park",
      elementType: "labels.text.fill",
      stylers: [
        {
          color: "#9e9e9e",
        },
      ],
    },
    {
      featureType: "road",
      elementType: "geometry",
      stylers: [
        {
          color: "#ffffff",
        },
      ],
    },
    {
      featureType: "road.arterial",
      elementType: "labels.text.fill",
      stylers: [
        {
          color: "#757575",
        },
      ],
    },
    {
      featureType: "road.highway",
      elementType: "geometry",
      stylers: [
        {
          color: "#dadada",
        },
      ],
    },
    {
      featureType: "road.highway",
      elementType: "labels.text.fill",
      stylers: [
        {
          color: "#616161",
        },
      ],
    },
    {
      featureType: "road.local",
      elementType: "labels.text.fill",
      stylers: [
        {
          color: "#9e9e9e",
        },
      ],
    },
    {
      featureType: "transit.line",
      elementType: "geometry",
      stylers: [
        {
          color: "#e5e5e5",
        },
      ],
    },
    {
      featureType: "transit.station",
      elementType: "geometry",
      stylers: [
        {
          color: "#eeeeee",
        },
      ],
    },
    {
      featureType: "water",
      stylers: [
        {
          color: "#c6d7d4",
        },
      ],
    },
    {
      featureType: "water",
      elementType: "geometry",
      stylers: [
        {
          color: "#c6d7d4",
        },
      ],
    },
    {
      featureType: "water",
      elementType: "labels.text.fill",
      stylers: [
        {
          color: "#9e9e9e",
        },
      ],
    },
  ];

  /*
    *  new_map
    *
    *  This function will render a Google Map onto the selected jQuery element
    *
    *  @type	function
    *  @date	8/11/2013
    *  @since	4.3.0
    *
    *  @param	$el (jQuery element)
    *  @return	n/a
    */

  function new_map($el) {
    console.log("here");

    // var
    var zoom;
    var $markers = $el.find(".marker");
    if ($el.data("zoom")) {
      zoom = $el.data("zoom");
    } else {
      zoom = 13;
    }
    //var
    var args = {
      zoom: zoom,
      center: new google.maps.LatLng(0, 0),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      fullscreenControl: false,
      streetViewControl: false,
      mapTypeControl: false,
      // disableDefaultUI: false,
      scaleControl: true,
      zoomControl: true,
      rotateControl: false,
      styles: style,
    };

    // create map
    var map = new google.maps.Map($el[0], args);

    // add a markers reference
    map.markers = [];

    // add markers
    $markers.each(function() {
      add_marker($(this), map);
    });

    // center map
    center_map(map);

    // return
    return map;
  }

  /*
    *  add_marker
    *
    *  This function will add a marker to the selected Google Map
    *
    *  @type	function
    *  @date	8/11/2013
    *  @since	4.3.0
    *
    *  @param	$marker (jQuery element)
    *  @param	map (Google Map object)
    *  @return	n/a
    */

  function add_marker($marker, map) {
    var latlng = new google.maps.LatLng(
        $marker.attr("data-lat"),
        $marker.attr("data-lng")
      ),
      markerPin = themeVars.markerPin;

    var image = {
      url: markerPin,
      size: new google.maps.Size(45, 65),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(45, 65),
      scaledSize: new google.maps.Size(45, 65),
    };

    var locationInfowindow = new google.maps.InfoWindow({
      content: $marker.html(),
    });

    // create marker
    var marker = new google.maps.Marker({
      map: map,
      position: latlng,
      icon: image,
      infowindow: locationInfowindow,
    });

    // add to array
    map.markers.push(marker);

    google.maps.event.addListener(marker, "click", function() {
      hideAllInfoWindows(map);
      this.infowindow.open(map, this);
    });
  }

  function hideAllInfoWindows(map) {
    map.markers.forEach(function(marker) {
      marker.infowindow.close(map, marker);
    });
  }

  /*
    *  center_map
    *
    *  This function will center the map, showing all markers attached to this map
    *
    *  @type	function
    *  @date	8/11/2013
    *  @since	4.3.0
    *
    *  @param	map (Google Map object)
    *  @return	n/a
    */

  function center_map(map) {
    // vars
    var bounds = new google.maps.LatLngBounds();

    // loop through all markers and create bounds
    $.each(map.markers, function(i, marker) {
      var latlng = new google.maps.LatLng(
        marker.position.lat(),
        marker.position.lng()
      );

      bounds.extend(latlng);
    });

    // only 1 marker?
    if (map.markers.length == 1) {
      // set center of map
      map.setCenter(bounds.getCenter());
    } else {
      // fit to bounds
      map.fitBounds(bounds);
    }
  }

  /*
    *  document ready
    *
    *  This function will render each map when the document is ready (page has loaded)
    *
    *  @type	function
    *  @date	8/11/2013
    *  @since	5.0.0
    *
    *  @param	n/a
    *  @return	n/a
    */
  // global var
  var map = null;

  $(document).ready(() => {
    const mapParent = $(".acf-map__parent");
    const column = mapParent.find(".image-hover-text__wrapper--txt");

    var heights = column
      .map(function() {
        return $(this).outerHeight();
      })
      .get();

    const maxHeight = Math.max.apply(null, heights);
    const mapTopPos = maxHeight + 20;
    const mapParentH = mapParent.outerHeight();
    const mapDiff = mapParentH - mapTopPos;
    const offsetBottom = 400 - mapDiff;

    $(".acf-map").each(function() {
      // create map
      map = new_map($(this));
      if (parseInt($(window).width()) >= 1280) {
        $(this)
          .closest(".acf-map__parent")
          .css("margin-bottom", offsetBottom + "px");
        $(this)
          .closest(".acf-map__wrapper")
          .css("top", mapTopPos + "px");
      }
    });

    $(window).on("resize", function() {
      setTimeout(function() {
        var heights = column
          .map(function() {
            return $(this).outerHeight();
          })
          .get();

        const maxHeight = Math.max.apply(null, heights);
        const mapTopPos = maxHeight + 20;
        const mapParentH = mapParent.outerHeight();
        const mapDiff = mapParentH - mapTopPos;
        const offsetBottom = 400 - mapDiff;

        $(".acf-map").each(function() {
          if (parseInt($(window).width()) >= 1280) {
            $(this)
              .closest(".acf-map__parent")
              .css("margin-bottom", offsetBottom + "px");
            $(this)
              .closest(".acf-map__wrapper")
              .css("top", mapTopPos + "px");
          }
        });
      }, 200);
    });

    $(window).on("orientationchange", function() {
      setTimeout(function() {
        var heights = column
          .map(function() {
            return $(this).outerHeight();
          })
          .get();

        const maxHeight = Math.max.apply(null, heights);
        const mapTopPos = maxHeight + 20;
        const mapParentH = mapParent.outerHeight();
        const mapDiff = mapParentH - mapTopPos;
        const offsetBottom = 400 - mapDiff;

        $(".acf-map").each(function() {
          if (parseInt($(window).width()) >= 1280) {
            $(this)
              .closest(".acf-map__parent")
              .css("margin-bottom", offsetBottom + "px");
            $(this)
              .closest(".acf-map__wrapper")
              .css("top", mapTopPos + "px");
          }
        });
      }, 200);
    });
  });
})(jQuery);
