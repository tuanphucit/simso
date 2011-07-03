//for search in
var map = null;
function initialize() {
        if (GBrowserIsCompatible()) {

          // create a center for our map
          point = new GLatLng(21.006558, 105.843058);

          // create a new map.
          map = new GMap2(document.getElementById("map-canvas"));

          // set the center
          map.setCenter(point, 15, G_NORMAL_MAP);

          // add a zoom control
          map.addControl(new GSmallZoomControl());

          // add a local search
          map.addControl(new google.maps.LocalSearch());
        }

}

//for search out
window._uds_msw_donotrepair = true;
function LoadMapSearchControl() {
      var options = {
            zoomControl : GSmapSearchControl.ZOOM_CONTROL_ENABLE_ALL,
            title : "Googleplex",
            url : "http://www.google.com/corporate/index.html",
            idleMapZoom : GSmapSearchControl.ACTIVE_MAP_ZOOM + 1,
            activeMapZoom : GSmapSearchControl.ACTIVE_MAP_ZOOM - 1
            }
      new GSmapSearchControl(
            document.getElementById("mapsearch"),
            "v?nh phúc",
            options
            );
}
//for point list
/*
google.load("jquery", '1.3');
google.load("maps", "2.x");
*/
$(document).ready(function(){
    var map = new GMap2($("#map").get(0));
    var burnsvilleMN = new GLatLng(21.006558, 105.843058);
    map.setCenter(burnsvilleMN, 8);

    // setup 10 random points
    var bounds = map.getBounds();
    var southWest = bounds.getSouthWest();
    var northEast = bounds.getNorthEast();
    var lngSpan = northEast.lng() - southWest.lng();
    var latSpan = northEast.lat() - southWest.lat();
    var markers = [];
    for (var i = 0; i < 10; i++) {
        var point = new GLatLng(southWest.lat() + latSpan * Math.random(),
            southWest.lng() + lngSpan * Math.random());
            marker = new GMarker(point);
            map.addOverlay(marker);
            markers[i] = marker;
    }

    $(markers).each(function(i,marker){
            $("<li />")
                    .html("Point "+i)
                    .click(function(){
                            displayPoint(marker, i);
                    })
                    .appendTo("#list");

            GEvent.addListener(marker, "click", function(){
                    displayPoint(marker, i);
            });
    });

    $("#message").appendTo(map.getPane(G_MAP_FLOAT_SHADOW_PANE));

    function displayPoint(marker, index){
            $("#message").hide();

            var moveEnd = GEvent.addListener(map, "moveend", function(){
                    var markerOffset = map.fromLatLngToDivPixel(marker.getLatLng());
                    $("#message")
                            .fadeIn()
                            .css({top:markerOffset.y, left:markerOffset.x});

                    GEvent.removeListener(moveEnd);
            });
            map.panTo(marker.getLatLng());
    }
});
//for add point
/*
$(function(){
        var map = new GMap2(document.getElementById('map'));
        var burnsvilleMN = new GLatLng(44.797916,-93.278046);
        map.setCenter(burnsvilleMN, 8);
        var bounds = new GLatLngBounds();
        var geo = new GClientGeocoder();

        var reasons=[];
        reasons[G_GEO_SUCCESS]            = "Success";
        reasons[G_GEO_MISSING_ADDRESS]    = "Missing Address";
        reasons[G_GEO_UNKNOWN_ADDRESS]    = "Unknown Address.";
        reasons[G_GEO_UNAVAILABLE_ADDRESS]= "Unavailable Address";
        reasons[G_GEO_BAD_KEY]            = "Bad API Key";
        reasons[G_GEO_TOO_MANY_QUERIES]   = "Too Many Queries";
        reasons[G_GEO_SERVER_ERROR]       = "Server error";

        // initial load points
        $.getJSON("php/map-service.php?action=listpoints", function(json) {
                if (json.Locations.length > 0) {
                        for (i=0; i<json.Locations.length; i++) {
                                var location = json.Locations[i];
                                addLocation(location);
                        }
                        zoomToBounds();
                }
        });

        $("#add-point").submit(function(){
                geoEncode();
                return false;
        });

        function savePoint(geocode) {
                var data = $("#add-point :input").serializeArray();
                data[data.length] = {name: "lng", value: geocode[0]};
                data[data.length] = {name: "lat", value: geocode[1]};
                $.post($("#add-point").attr('action'), data, function(json){
                        $("#add-point .error").fadeOut();
                        if (json.status == "fail") {
                                $("#add-point .error").html(json.message).fadeIn();
                        }
                        if (json.status == "success") {
                                $("#add-point :input[name!=action]").val("");
                                var location = json.data;
                                addLocation(location);
                                zoomToBounds();
                        }
                }, "json");
        }

        function geoEncode() {
                var address = $("#add-point input[name=address]").val();
                geo.getLocations(address, function (result){
                        if (result.Status.code == G_GEO_SUCCESS) {
                                geocode = result.Placemark[0].Point.coordinates;
                                savePoint(geocode);
                        } else {
                                var reason="Code "+result.Status.code;
                                if (reasons[result.Status.code]) {
                                        reason = reasons[result.Status.code]
                                }
                                $("#add-point .error").html(reason).fadeIn();
                                geocode = false;
                        }
                });
        }

        function addLocation(location) {
                var point = new GLatLng(location.lat, location.lng);
                var marker = new GMarker(point);
                map.addOverlay(marker);
                bounds.extend(marker.getPoint());

                $("<li />")
                        .html(location.name)
                        .click(function(){
                                showMessage(marker, location.name);
                        })
                        .appendTo("#list");

                GEvent.addListener(marker, "click", function(){
                        showMessage(this, location.name);
                });
        }

        function zoomToBounds() {
                map.setCenter(bounds.getCenter());
                map.setZoom(map.getBoundsZoomLevel(bounds)-1);
        }

        $("#message").appendTo( map.getPane(G_MAP_FLOAT_SHADOW_PANE) );

        function showMessage(marker, text){
                var markerOffset = map.fromLatLngToDivPixel(marker.getPoint());
                $("#message").hide().fadeIn()
                        .css({top:markerOffset.y, left:markerOffset.x})
                        .html(text);
        }
});
*/
//main site
$(function(){
    $('#content > li').hide();
    //search in
    $('#menu_search_in').click(function(){
        $('#content li').hide();
        $('#search_in').show();
        initialize();
    });
    //search out
    $('#menu_search_out').click(function(){
        $('#content li').hide();
        $('#search_out').show();
        GSearch.setOnLoadCallback(LoadMapSearchControl());
    });
    //point list
    $('#menu_point_list').click(function(){
        $('#content li').hide();
        $('#point_list li').show();
        $('#point_list').show();
        
    });
    //add point
    $('#menu_add_point').click(function(){
        $('#content li').hide();
        $('#add_point').show();
        
    });
});