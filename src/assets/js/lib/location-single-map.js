( function( $ ) {

    // The built-in Google Maps examples for some reason don't work, but the way that the Store plugin does it on the admin side does
    // So we're going to copy/past parts of their code to use. 

    if ( $( 'body.single-facility' ).length == 0 ) return;

    let apiKey = vibrantLife.asl_google_maps_api_key;

    if ( ! apiKey ) return;

    let store = vibrantLife.current_store;

    if ( ! store || typeof store == 'undefined' ) return;

    let map_div = document.getElementById( 'map_canvas' );

    let latlng = new google.maps.LatLng( store.lat, store.lng ),
    mapOptions = {
        zoom: 14,
        minZoom: 8,
        center: latlng,
        //maxZoom: 10,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        styles: [{ "stylers": [{ "saturation": -100 }, { "gamma": 1 }] }, { "elementType": "labels.text.stroke", "stylers": [{ "visibility": "off" }] }, { "featureType": "poi.business", "elementType": "labels.text", "stylers": [{ "visibility": "off" }] }, { "featureType": "poi.business", "elementType": "labels.icon", "stylers": [{ "visibility": "off" }] }, { "featureType": "poi.place_of_worship", "elementType": "labels.text", "stylers": [{ "visibility": "off" }] }, { "featureType": "poi.place_of_worship", "elementType": "labels.icon", "stylers": [{ "visibility": "off" }] }, { "featureType": "road", "elementType": "geometry", "stylers": [{ "visibility": "simplified" }] }, { "featureType": "water", "stylers": [{ "visibility": "on" }, { "saturation": 50 }, { "gamma": 0 }, { "hue": "#50a5d1" }] }, { "featureType": "administrative.neighborhood", "elementType": "labels.text.fill", "stylers": [{ "color": "#333333" }] }, { "featureType": "road.local", "elementType": "labels.text", "stylers": [{ "weight": 0.5 }, { "color": "#333333" }] }, { "featureType": "transit.station", "elementType": "labels.icon", "stylers": [{ "gamma": 1 }, { "saturation": 50 }] }],
        draggable: true,
      }

    let map = new google.maps.Map( map_div, mapOptions );

    let map_marker = new google.maps.Marker( {
        draggable: false,
        position: latlng,
        map: map
    } );

    let days = {
        0: 'sun',
        1: 'mon',
        2: 'tue',
        3: 'wed',
        4: 'thu',
        5: 'fri',
        6: 'sat',
    };

    let content = '' + 
        '<h3>' + store.title + '</h3>' + 
        '<div class="infowindowContent">' + 
            '<div class="info-addr">' + 
                ( ( store.description ) ? '<div class="address" style="margin-bottom: 10px">' + store.description + '</div>' : '' ) + 
                '<div class="address"><span class="glyphicon icon-location"></span>' + store.street + "<br />" + store.city + ', ' + store.state + ' ' + store.postal_code + '</div>' + 
                '<br />' + 
                '<div class="phone"><span class="glyphicon icon-phone-outline"></span><b>Phone: </b><a href="tel:' + store.phone.replace( /\D/ig, '' ) + '">' + store.phone + '</a></div>' + 
                '<br />' + 
                ( ( store.email ) ? '<div class="phone"><span class="glyphicon icon-at"></span><a href="mailto:' + store.email + '" style="text-transform: lowercase">' + store.email + '</a></div><br />' : '' ) + 
                ( ( store.open_hours ) ? '<div class="p-time"><span class="glyphicon icon-clock-1"></span>' + JSON.parse( store.open_hours)[ days[ new Date().getDay() ] ] + '</div><br />' : '' ) + 
                '<div class="address"><a target="_blank" href="https://www.google.com/maps/place/' + encodeURIComponent( store.street + ' ' + store.city + ', ' + store.state + ' ' + store.postal_code ) + '/">' + vibrantLife.i18n.directions + '</a>' + 
            '</div>' + 
        '</div>';

    let info_window = new google.maps.InfoWindow( {
        content: content,
    } );

    map_marker.addListener( 'click', function() {
        info_window.open( map, map_marker );
    } );

    if ( vibrantLife.asl_url !== false ) {

        let marker_icon = new google.maps.MarkerImage( vibrantLife.asl_url + 'admin/images/pin1.png' );
        marker_icon.size = new google.maps.Size( 24, 39 );
        marker_icon.anchor = new google.maps.Point( 24, 39 );

        map_marker.setIcon( marker_icon );

    }

    map.panTo( latlng );

} )( jQuery );