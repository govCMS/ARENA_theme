/**
 * @file
 * Provides jQuery behaviors.
 */

(function ($) {

  Drupal.behaviors.arenaProjects = {
    attach: function (context, settings) {
      var map;
      var $mapWrapper;
      var markers = [];

      var initMap = function () {
        // Initialize map.
        map = new google.maps.Map(document.getElementById('arena-projects-map-wrapper'), {
          center: new google.maps.LatLng(-28.62441593910887,133.50637499999993),
          zoom: 4,
          minZoom: 3
        });
        updateMap();
      };

      var clearMapMarkers = function () {
        $.each(markers, function (index, marker) {
          google.maps.event.clearListeners(marker, 'click');
          marker.setMap(null);
        });
        markers = [];
      };

      var updateMap = function () {
        // Clear existing markers.
        clearMapMarkers();

        // Create map markers.
        $('.view-id-arena_projects .panel').each(function (index, ele) {
          var $item = $(ele);
          var $projectMarker = $('.arena-project-marker', $item);
          var title = $projectMarker.attr('arena-project-title');
          var funding = $projectMarker.attr('arena-project-funding');
          var lat = $projectMarker.attr('arena-project-location-lat');
          var leadOrganisation = $projectMarker.attr('arena-project-lead-organisation');
          var lng = $projectMarker.attr('arena-project-location-lng');
          var nid = $projectMarker.attr('arena-project-nid');
          var suburb = $projectMarker.attr('arena-project-location-suburb');
          var summary = $projectMarker.attr('arena-project-summary');
          var state = $projectMarker.attr('arena-project-location-state');

          // Create map marker object.
          var marker = new google.maps.Marker({
            position: new google.maps.LatLng(lat, lng),
            map: map,
            title: title
          });
          markers.push(marker);

          // Create popup window for marker.
          var popupContent = '<div>\n\
            <h3 class="arena-popup-title"><a href="/node/' + nid + '">' + title + '</a></h3>\n\
            <div class="arena-popup-body">\n\
              <div class="arena-popup-location"><span>Location:</span>' + suburb + ', ' + state + '</div>\n\
              <div class="arena-popup-funding"><span>ARENA funding:</span>' + funding + '</div>\n\
              <div class="arena-popup-org"><span>Lead organisation:</span>' + leadOrganisation + '</div>\n\
              <div class="arena-popup-summary">' + summary + '</div>\n\
            </div>\n\
          </div>';
          var infowindow = new google.maps.InfoWindow({
            content: popupContent
          });

          // Add open popup window on marker click.
          google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
          });
        });
      };

      $(document).ready(function () {
        $mapWrapper = $('.field-name-field-page-abstract', context).append('<div id="arena-projects-map-wrapper" style="height: 500px; width: 100%;"></div>');
        initMap();
      });
    }
  };

})(jQuery);
