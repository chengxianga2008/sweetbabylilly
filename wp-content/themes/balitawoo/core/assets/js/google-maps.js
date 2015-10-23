jQuery(document).ready(function($) {

	geocoder = new google.maps.Geocoder();

    geocoder.geocode( { 'address': sci_google_address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var mapOptions = {
                zoom: parseInt(sci_google_zoom),
                center: results[0].geometry.location,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }

            var map = new google.maps.Map(document.getElementById("tokokoo-google-map"), mapOptions);
            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });
        } else {
            alert("Geocode was not successful for the following reason: " + status);
        }
    });	

});