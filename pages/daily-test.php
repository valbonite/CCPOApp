<?php
session_start();
include('connection.php');
require('../vendor/autoload.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CCPO Crime Prediction</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/primary.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!--<script src="../dist/js/date-time.js"></script>-->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.8&libraries=geometry&sensor=false"></script>
<script type="text/javascript" src="proj4.js"></script>
<script type="text/javascript">
    var map;
    var infowindow = new google.maps.InfoWindow();
    var rectArr = [];
    var rectArr2 = [];
    var rect_counts = [];
    var years = [];
    var months = []
    var dayCounts = []
    var cols=["red","blue","green","yellow","orange","gray"]
    var startYear = 0
    var startDay = 0
    var startYearCounter = 0
    var startDayCounter = 1
    var predictionCounter = 0
    var predictions = [];

    proj4.defs([
      [
        'EPSG:4326',
        '+title=WGS 84 (long/lat) +proj=longlat +ellps=WGS84 +datum=WGS84 +units=degrees'],
      [
        'EPSG:23031',
        '+title=ED 1950 (UTM) +proj=utm +zone=51 +ellps=intl +units=m +no_defs +towgs84=-84,-97,-117'],
      [
        'SR-ORG:14-UTM',
        '+title=GPS (WGS84) (UTM) +proj=utm +zone=51 +ellps=WGS84 +datum=WGS84 +units=degrees'],
    ]);

    function initialize() {
        var rectangle;
        var cebu = new google.maps.LatLng(10.36400982742309, 123.8498639944824);
        var myOptions = {
          zoom: 13,
          center: cebu,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
        };

        var customMapType = new google.maps.StyledMapType([            
        {
            "featureType": "administrative",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "color": "#444444"
                }
            ]
        },
        {
            "featureType": "landscape",
            "elementType": "all",
            "stylers": [
                {
                    "color": "#f2f2f2"
                }
            ]
        },
        {
            "featureType": "poi",
            "elementType": "all",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "road",
            "elementType": "all",
            "stylers": [
                {
                    "saturation": -100
                },
                {
                    "lightness": 45
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "all",
            "stylers": [
                {
                    "visibility": "simplified"
                }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "labels.icon",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "transit",
            "elementType": "all",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "water",
            "elementType": "all",
            "stylers": [
                {
                    "color": "#46bcec"
                },
                {
                    "visibility": "on"
                }
            ]
        }
    ], {
              name: 'Custom Style'
        });

        var customMapTypeId = 'custom_style';        

        map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
        map2 = new google.maps.Map(document.getElementById("map_canvas2"),myOptions);
        citybounds = drawCityBounds();
        drawRects();

        map.mapTypes.set(customMapTypeId, customMapType);
        map.setMapTypeId(customMapTypeId);

        map2.mapTypes.set(customMapTypeId, customMapType);
        map2.setMapTypeId(customMapTypeId);

        years = [];
        days = [];
        dayCounts = [];
        startYear = 0
        startDay = 0
        file = file.split("\n");

        var currentYear = 0;
        var currentMonth = 0;
        var prevMonth = 0;
        var prevYear = 0;
        var prevDay = 0;
        var currentDay = 0;

        rect_counts = Array.apply(null, new Array(rectArr.length)).map(Number.prototype.valueOf,0);

        downloadUrl("phpsqlajax_genxml.php", function(data) {
        var xml = data.responseXML;
        markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {
          var dateData = markers[i].getAttribute("date");
          var latitudeData = markers[i].getAttribute("latitude");
          var longitudeData = markers[i].getAttribute("longitude");

          console.log(dateData);
          console.log(latitudeData);

            var date = dateData[0].split("/");
            var year = date[2];
            var month = date[1];
            var day = date[0];

            var savedYear = false;



            prevYear = currentYear;
            currentYear = parseInt(year);
            prevMonth = currentMonth;
            currentMonth = parseInt(month);
            prevDay = currentDay;
            currentDay = parseInt(day);

            if (currentYear != prevYear) {
                if (prevYear != 0){
                    dayDataSnapshot = {
                        month: prevMonth,
                        day: prevDay,
                        counts: dayCounts
                    }
                    days.push(dayDataSnapshot);

                    yearDataSnapshot = {
                        year: prevYear,
                        days: days
                    }
                    years.push(yearDataSnapshot);
                    savedYear = true;
                }
                days = []
                dayCounts = Array.apply(null, new Array(rectArr.length)).map(Number.prototype.valueOf,0);
            }

            if (currentDay != prevDay && !savedYear) {
                if (prevDay != 0) {
                    dayDataSnapshot = {
                        month: prevMonth,
                        day: prevDay,
                        counts: dayCounts
                    }
                    days.push(dayDataSnapshot);
                    savedYear = false;
                }

                dayCounts = Array.apply(null, new Array(rectArr.length)).map(Number.prototype.valueOf,0);
            }

            //var ed50 = [];
            //ed50.push(line[6]);
            //ed50.push(line[7])
            //var coordinates = convertToWSG(ed50);

            var incident = new google.maps.LatLng(latitudeData, longitudeData);

            // marker = new google.maps.Marker({
            //  position: incident,
            //  map: map
            // });

            for (y in rectArr) {
                if (rectArr[y].bounds.contains(incident)) {
                    dayCounts[y]++;
                    rectArr[y].counts++;
                    break;
                }
            }
        }
    }
        dayDataSnapshot = {
            month: prevMonth,
            day: prevDay,
            counts: dayCounts
        }
        days.push(dayDataSnapshot);
        yearDataSnapshot = {
            year: prevYear,
            days: days
        }
        years.push(yearDataSnapshot);
        startYear = years[0].year
        startDay = years[0].days[0].day
        console.log("finished")
        console.log(years);
    }

    function drawCityBounds() {
        var myCoordinates = [
                new google.maps.LatLng(10.259900,123.873253),
                new google.maps.LatLng(10.263109,123.869348),
                new google.maps.LatLng(10.265474,123.856473),
                new google.maps.LatLng(10.270161,123.847890),
                new google.maps.LatLng(10.272484,123.847160),
                new google.maps.LatLng(10.273708,123.847547),
                new google.maps.LatLng(10.276157,123.846216),
                new google.maps.LatLng(10.282534,123.839736),
                new google.maps.LatLng(10.284476,123.834586),
                new google.maps.LatLng(10.298495,123.825488),
                new google.maps.LatLng(10.308713,123.815746),
                new google.maps.LatLng(10.319986,123.820853),
                new google.maps.LatLng(10.324292,123.819308),
                new google.maps.LatLng(10.326741,123.814974),
                new google.maps.LatLng(10.326488,123.810382),
                new google.maps.LatLng(10.329528,123.806305),
                new google.maps.LatLng(10.334974,123.806520),
                new google.maps.LatLng(10.333496,123.798151),
                new google.maps.LatLng(10.337212,123.789911),
                new google.maps.LatLng(10.376050,123.780556),
                new google.maps.LatLng(10.397325,123.761330),
                new google.maps.LatLng(10.422988,123.793602),
                new google.maps.LatLng(10.461817,123.845787),
                new google.maps.LatLng(10.489500,123.886986),
                new google.maps.LatLng(10.495576,123.897285),
                new google.maps.LatLng(10.490513,123.900375),
                new google.maps.LatLng(10.479372,123.926125),
                new google.maps.LatLng(10.456752,123.930931),
                new google.maps.LatLng(10.455064,123.936081),
                new google.maps.LatLng(10.413196,123.930931),
                new google.maps.LatLng(10.371323,123.924408),
                new google.maps.LatLng(10.341940,123.913078),
                new google.maps.LatLng(10.340125,123.912048),
                new google.maps.LatLng(10.335270,123.918657),
                new google.maps.LatLng(10.330710,123.921061),
                new google.maps.LatLng(10.327839,123.919687),
                new google.maps.LatLng(10.326741,123.920932),
                new google.maps.LatLng(10.323701,123.920503),
                new google.maps.LatLng(10.320915,123.920631),
                new google.maps.LatLng(10.319099,123.918829),
                new google.maps.LatLng(10.316270,123.920717),
                new google.maps.LatLng(10.313104,123.923764),
                new google.maps.LatLng(10.310444,123.925695),
                new google.maps.LatLng(10.299719,123.912392),
                new google.maps.LatLng(10.291781,123.908100),
                new google.maps.LatLng(10.288234,123.897800),
                new google.maps.LatLng(10.287389,123.889732),
                new google.maps.LatLng(10.273708,123.880291),
                new google.maps.LatLng(10.271850,123.883038),
                new google.maps.LatLng(10.259688,123.873253)
            ];
            var polyOptions = {
                path: myCoordinates,
                strokeColor: "#FF0000",
                strokeOpacity: 1,
                strokeWeight: 3
            }

            var it = new google.maps.Polyline(polyOptions);
            it.setMap(map);
            var it2 = new google.maps.Polyline(polyOptions);
            it2.setMap(map2);
            return it;

    }

    function drawRects () {
        var rect_number = 0;
        var NorthWest=new google.maps.LatLng(10.496428, 123.760815);
        var NorthEast=new google.maps.LatLng(10.496428, 123.935909);
        var SouthWest=new google.maps.LatLng(10.26049829996074, 123.760815);
        var SouthEast=new google.maps.LatLng(10.26049829996074, 123.935909);
        var distance = 750;
        var dist_coords_long = google.maps.geometry.spherical.computeOffset(NorthWest, distance, 90);
        dist_coords_long = dist_coords_long.lng() - NorthWest.lng();
        var dist_coords_lat = google.maps.geometry.spherical.computeOffset(NorthWest, distance, 180);
        dist_coords_lat = NorthWest.lat() - dist_coords_lat.lat();

        marker = new google.maps.Marker({
            position: NorthEast,
            map: map
        });

        marker = new google.maps.Marker({
            position: SouthWest,
            map: map
        });

        marker = new google.maps.Marker({
            position: NorthEast,
            map: map2
        });

        marker = new google.maps.Marker({
            position: SouthWest,
            map: map2
        });

        var NW = google.maps.geometry.spherical.computeOffset(NorthWest, distance, 270);

        while(NW.lat() >= SouthWest.lat()) {
            // curr_NE = google.maps.geometry.spherical.computeOffset(NW, distance, 90)
            curr_NE = new google.maps.LatLng(NW.lat(), NW.lng() + dist_coords_long);
            // curr_SW = google.maps.geometry.spherical.computeOffset(NW, distance, 180)
            curr_SW = new google.maps.LatLng(NW.lat() - dist_coords_lat, NW.lng());
            curr_NW = NW;
            NW = new google.maps.LatLng(NW.lat() - dist_coords_lat, NW.lng());
            while(curr_NW.lng() <= NorthEast.lng()) {
                // NE = google.maps.geometry.spherical.computeOffset(curr_NE, distance, 90);
                NE = new google.maps.LatLng(curr_NE.lat(), curr_NE.lng() + dist_coords_long);
                // SW = google.maps.geometry.spherical.computeOffset(curr_SW, distance, 90);
                SW = new google.maps.LatLng(curr_SW.lat(), curr_SW.lng() + dist_coords_long);
                curr_NW = NE;
                curr_NE = NE;
                curr_SW = SW;
                var bounds = new google.maps.LatLngBounds(SW,NE)
                var bound_NW = new google.maps.LatLng(NE.lat(),SW.lng());
                var bound_SE = new google.maps.LatLng(SW.lat(), NE.lng());

                if (google.maps.geometry.poly.containsLocation(bound_NW, citybounds) || 
                    google.maps.geometry.poly.containsLocation(NE, citybounds) || 
                    google.maps.geometry.poly.containsLocation(SW, citybounds) || 
                    google.maps.geometry.poly.containsLocation(bound_SE, citybounds)){

                    var rectangle = new google.maps.Rectangle();
                    var rectOptions = {
                        strokeColor: "#FF0000",
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: "grey",
                        fillOpacity: 0.35,
                        map: map,
                        bounds: bounds,
                        counts: 0,
                        number: rect_number,
                        merged: false,
                    };
                    rectangle.setOptions(rectOptions);
                    rectangle.getBounds().extend(bound_NW);
                    rectangle.getBounds().extend(bound_SE);
                    rectArr.push(rectangle);
                    // bindWindow(rectangle,rectArrS.length)

                    var rectangle2 = new google.maps.Rectangle();
                    var rectOptions2 = {
                        strokeColor: "#FF0000",
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: "grey",
                        fillOpacity: 0.35,
                        map: map2,
                        bounds: bounds,
                        counts: 0,
                        number: rect_number,
                    };

                    rectangle2.setOptions(rectOptions2);
                    rectangle2.getBounds().extend(bound_NW);
                    rectangle2.getBounds().extend(bound_SE);
                    rectArr2.push(rectangle2);
                    rect_number++;
                    // console.log(rect_number)
                }
            }
        }

        // var NS = google.maps.geometry.spherical.computeOffset(NorthWest,distance,90);
        // var SS = google.maps.geometry.spherical.computeOffset(NorthWest,distance,180);
        // var i = 0;
        // var NE = google.maps.geometry.spherical.computeOffset(NS,i*distance,180)
        // var SW = google.maps.geometry.spherical.computeOffset(SS,i*distance,180)

        // while(SW.lat() >= SouthWest.lat()) {
        //  NE = google.maps.geometry.spherical.computeOffset(NS,i*distance,180)
        //  SW = google.maps.geometry.spherical.computeOffset(SS,i*distance,180)
        //  var NE_prev = google.maps.geometry.spherical.computeOffset(NE,distance,270)
        //  var j = 0;

        //  while(NE_prev.lng() <= NorthEast.lng()) {
        //      var bounds = new google.maps.LatLngBounds(SW,NE)
        //      var bound_NW = new google.maps.LatLng(NE.lat(),SW.lng());
        //      var bound_SE = new google.maps.LatLng(SW.lat(), NE.lng());

        //      if (google.maps.geometry.poly.containsLocation(bound_NW, citybounds) || 
        //          google.maps.geometry.poly.containsLocation(NE, citybounds) || 
        //          google.maps.geometry.poly.containsLocation(SW, citybounds) || 
        //          google.maps.geometry.poly.containsLocation(bound_SE, citybounds)){

        //              var rectangle = new google.maps.Rectangle();
        //              var rectOptions = {
        //                  strokeColor: "#FF0000",
        //                  strokeOpacity: 0.8,
        //                  strokeWeight: 2,
        //                  fillColor: "grey",
        //                  fillOpacity: 0.35,
        //                  map: map,
        //                  bounds: bounds,
        //                  counts: 0,
        //                  number: rect_number,
        //              };
        //              rectangle.setOptions(rectOptions);
        //              rectArr.push(rectangle);
        //              // bindWindow(rectangle,rectArr.length)

        //              var rectangle2 = new google.maps.Rectangle();
        //              var rectOptions2 = {
        //                  strokeColor: "#FF0000",
        //                  strokeOpacity: 0.8,
        //                  strokeWeight: 2,
        //                  fillColor: "grey",
        //                  fillOpacity: 0.35,
        //                  map: map2,
        //                  bounds: bounds,
        //                  counts: 0,
        //                  number: rect_number,
        //              };

        //              rectangle2.setOptions(rectOptions2);
        //              rectArr2.push(rectangle2);
        //              rect_number++;
        //      }
        //      var SW = google.maps.geometry.spherical.computeOffset(SW,distance,90)
        //      NE_prev = NE
        //      var NE = google.maps.geometry.spherical.computeOffset(NE,distance,90)

        //  }
        //  i += 1;
        // }
    }

    function mergeNoCounts() {
        var newRectArr = []
        var newRectArr2 = []
        for (var x = 0; x < rectArr.length; x++) {
            var neighbors = getNeighbors(rectArr[x]);
            if (neighbors.length == 8) {
                if (checkNotMergedandNoCounts(neighbors)) {
                    var bounds = new google.maps.LatLngBounds(getSouthWest(neighbors),getNorthEast(neighbors));
                    var rectangle = new google.maps.Rectangle();
                    var rectOptions = {
                        strokeColor: "#FF0000",
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: "grey",
                        fillOpacity: 0.35,
                        map: map,
                        bounds: bounds,
                        counts: 0,
                    };
                    rectangle.setOptions(rectOptions);
                    newRectArr.push(rectangle);

                    var rectangle2 = new google.maps.Rectangle();
                    var rectOptions2 = {
                        strokeColor: "#FF0000",
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: "grey",
                        fillOpacity: 0.35,
                        map: map2,
                        bounds: bounds,
                        counts: 0,
                    };
                    rectangle2.setOptions(rectOptions2);
                    newRectArr2.push(rectangle2);
                    clearRectangles(neighbors, x);
                }
            }
        }

        for (x in rectArr) {
            if (!rectArr[x].merged) {
                var old = rectArr[x]
                var old2 = rectArr2[x]
                old.counts = 0
                newRectArr.push(old);
                newRectArr2.push(old2);
            }
        }
        rectArr = newRectArr;
        rectArr2 = newRectArr2;
        console.log(rectArr.length)
    }

    function checkNotMergedandNoCounts(neighbors) {
        var flag = true;
        var count = 0;
        for (x in neighbors) {
            count += rectArr[neighbors[x]].counts;
            if (rectArr[neighbors[x]].merged)
                flag = false;
        }

        if (count > 15) {
            flag = false;
        }
        return flag;
    }

    function clearRectangles(neighbors, rect) {
        for (x in neighbors) {
            rectArr[neighbors[x]].merged = true;
            rectArr[neighbors[x]].setMap(null);
            rectArr2[neighbors[x]].merged = true;
            rectArr2[neighbors[x]].setMap(null);
        }
        rectArr[rect].setMap(null);
        rectArr2[rect].setMap(null);
    }

    function getSouthWest(neighbors) {
        var lat = rectArr[neighbors[0]].getBounds().getSouthWest().lat();
        var lng = rectArr[neighbors[0]].getBounds().getSouthWest().lng();

        for (var x = 1; x < neighbors.length; x++){
            if (lat > rectArr[neighbors[x]].getBounds().getSouthWest().lat()) {
                lat = rectArr[neighbors[x]].getBounds().getSouthWest().lat();
            } else if (lng > rectArr[neighbors[x]].getBounds().getSouthWest().lng()) {
                lng = rectArr[neighbors[x]].getBounds().getSouthWest().lng();
            }
        }
        return new google.maps.LatLng(lat, lng);
    }

    function getNorthEast(neighbors) {
        var lat = rectArr[neighbors[0]].getBounds().getNorthEast().lat();
        var lng = rectArr[neighbors[0]].getBounds().getNorthEast().lng();

        for (var x = 1; x < neighbors.length; x++){
            if (lat < rectArr[neighbors[x]].getBounds().getNorthEast().lat()) {
                lat = rectArr[neighbors[x]].getBounds().getNorthEast().lat();
            } else if (lng < rectArr[neighbors[x]].getBounds().getNorthEast().lng()) {
                lng = rectArr[neighbors[x]].getBounds().getNorthEast().lng()
            }
        }
        return new google.maps.LatLng(lat, lng);
    }

    function getNeighbors(rectangle) {
        var neighbors = []
        for (x in rectArr) {
            if (x != rectangle.number) {
                var bounds = rectangle.getBounds();
                // var NE = bounds.getNorthEast();
                // var SW = bounds.getSouthWest();
                // var bound_NW = new google.maps.LatLng(NE.lat(),SW.lng());
                // var bound_SE = new google.maps.LatLng(SW.lat(), NE.lng());

                var rectbounds = rectArr[x].getBounds();
                var rect_NE = rectbounds.getNorthEast();
                var rect_SW = rectbounds.getSouthWest();
                var rect_NW = new google.maps.LatLng(rect_NE.lat(),rect_SW.lng());
                var rect_SE = new google.maps.LatLng(rect_SW.lat(), rect_NE.lng());

                if (bounds.intersects(rectbounds)) {
                    neighbors.push(x);
                }
            }

        }
        return neighbors;
    }

    function showAllCounts() {
        for (x in rectArr) {
            if (rectArr[x].counts == 0){
                rectArr[x].setOptions({fillColor: 'green'});
            } else {
                rectArr[x].setOptions({fillColor: 'red'});
            }
            // console.log(rectArr[x].number + " " + rectArr[x].counts)
            bindWindow(rectArr[x],x,rectArr[x].counts);
        }
    }
        
    function bindWindow(rectangle,num,counts){
        var bounds = rectangle.getBounds();
        var NE = bounds.getNorthEast();
        var SW = bounds.getSouthWest();
        var bound_NW = new google.maps.LatLng(NE.lat(),SW.lng());
        var bound_SE = new google.maps.LatLng(SW.lat(), NE.lng());

        google.maps.event.addListener(rectangle, 'click', function(event) {
            infowindow.setContent("rectangle "+num+ " counts " + counts)
            infowindow.setPosition(event.latLng)
            infowindow.open(map);
        });
    }

    function bindWindow2(rectangle,num,counts){
        google.maps.event.addListener(rectangle, 'click', function(event) {
        infowindow.setContent("rectangle "+num+ "counts" + counts)
        infowindow.setPosition(event.latLng)
        infowindow.open(map2);
        });
    }


    function readPredictions(file) {
        file = file.split("\n")

        for (x in file) {
            line = file[x]

            line = line.split(" ")
            predictions.push(line)
        }
    }

    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
      new ActiveXObject('Microsoft.XMLHTTP') :
      new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
      }
  };

  request.open('GET', url, true);
  request.send(null);
}

    function convertToWSG(coordinates){
        return proj4(proj4.defs("SR-ORG:14-UTM"),proj4.defs("EPSG:4326"), coordinates);
    }

    function showTiles(year, month) {
        mapTiles = years[year-startYear].days[month - 1].counts;
        console.log(mapTiles.length)
        for (y in mapTiles) {
            if (mapTiles[y] == 0){
                rectArr[y].setOptions({fillColor: 'green'});
            } else {
                rectArr[y].setOptions({fillColor: 'red'});
            }
            bindWindow(rectArr[y],y,mapTiles[y]);
        }
    }

    function showPredictionTiles(month) {
        mapTiles = predictions[month];
        console.log(mapTiles.length)
        for (y in mapTiles) {
            // if (y == 0) continue;
            if (mapTiles[y] < 0.75) {
                rectArr2[y].setOptions({fillColor: 'green'});
            } else {
                rectArr2[y].setOptions({fillColor: 'red'});
            }
            bindWindow2(rectArr2[y],y,mapTiles[y]);
        }
    }

    function get_accuracy(year, month, pred_month) {
        var total = 0;
        var correct = 0;

        var truepos = 0;
        var falsepos = 0;
        var trueneg = 0;
        var falseneg = 0;

        var actual_tiles = years[year-startYear].days[month - 1].counts;
        var pred_tiles = predictions[pred_month];

        for (y in actual_tiles) {
            total += 1;
            if (pred_tiles[y] >= 0.75) {
                if (actual_tiles[y] > 0) {
                    correct += 1;
                    truepos += 1;
                } else {
                    falsepos += 1;
                }
            } else {
                if (actual_tiles[y] == 0) {
                    correct += 1;
                    trueneg += 1;
                } else {
                    falseneg += 1;
                }
            }
        }
        console.log("correct" + correct);
        console.log("total"+ total);
        var acc = (correct / parseFloat(total)) * 100;

        var precision = truepos / parseFloat(truepos+falsepos);
        var recall = truepos / parseFloat(truepos+falseneg);

        console.log("precision " + precision)
        console.log("recall " + recall)

        var f1scr = (precision * recall * 2) / parseFloat(precision + recall)
        console.log("f1 score " + f1scr)
        document.getElementById('accuracy').innerHTML = "Accuracy: " + acc + '%';
        document.getElementById('f1scr').innerHTML = "F1 Score: " + f1scr;

    }

    function generateTileFiles() {
        var output = ""
        for (x in years) {
            x = parseInt(x)
            year = years[x];
            // console.log(year);
            for (y in year.days) {
                y = parseInt(y)
                if (y == year.days.length - 1) {
                    nextYear = x + 1;
                    nextDay = 0;
                    if (nextYear == years.length) break
                } else {
                    nextYear = x;
                    nextDay = y + 1;
                }

                day = year.days[y];

                var now = new Date(year.year, day.month - 1, day.day);
                var start = new Date(now.getFullYear(), 0, 0);
                var diff = now - start;
                var oneDay = 1000 * 60 * 60 * 24;
                var doy = Math.round(diff / oneDay);

                // line = year.year.toString()
                // line = month.month.toString()
                // line += "," + month.month.toString()
                line = (doy/365).toString()
                for (z in day.counts) {
                    if (day.counts[z] == 0) {
                        line += ",-1"
                    } else {
                        line += ",1"
                    }
                    // line += "," + month.counts[z].toString()
                }

                line += " "

                now = new Date(years[nextYear].year, years[nextYear].days[nextDay].month - 1, years[nextYear].days[nextDay].day);

                start = new Date(now.getFullYear(), 0, 0);
                diff = now - start;
                oneDay = 1000 * 60 * 60 * 24;
                doy = Math.round(diff / oneDay);

                // line += years[nextYear].year.toString()
                // line += years[nextYear].months[nextMonth].month.toString()
                // line += "," + years[nextYear].months[nextMonth].month.toString()
                line += (doy/365).toString()
                for (z in years[nextYear].days[nextDay].counts) {
                    if (years[nextYear].days[nextDay].counts[z] == 0) {
                        line += ",-1"
                    } else {
                        line += ",1"
                    }
                    // line += "," + years[nextYear].months[nextMonth].counts[z].toString()
                }

                line += "\n";
                output += line;
                console.log(output);
            }
        }
        // writeFile("griddatadiscrete.txt", output);
        download(output, "griddatadiscrete.txt", "text/plain");
        console.log("fin")
    }

    function writeFile(filename, text) {
        var pom = document.createElement('a');
        pom.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
        pom.setAttribute('download', filename);
        pom.click();
    }

    function download(strData, strFileName, strMimeType) {
        var D = document,
            A = arguments,
            a = D.createElement("a"),
            d = A[0],
            n = A[1],
            t = A[2] || "text/plain";

        //build download link:
        a.href = "data:" + strMimeType + "charset=utf-8," + escape(strData);


        if (window.MSBlobBuilder) { // IE10
            var bb = new MSBlobBuilder();
            bb.append(strData);
            return navigator.msSaveBlob(bb, strFileName);
        } /* end if(window.MSBlobBuilder) */



        if ('download' in a) { //FF20, CH19
            a.setAttribute("download", n);
            a.innerHTML = "downloading...";
            D.body.appendChild(a);
            setTimeout(function() {
                var e = D.createEvent("MouseEvents");
                e.initMouseEvent("click", true, false, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
                a.dispatchEvent(e);
                D.body.removeChild(a);
            }, 66);
            return true;
        }; /* end if('download' in a) */



        //do iframe dataURL download: (older W3)
        var f = D.createElement("iframe");
        D.body.appendChild(f);
        f.src = "data:" + (A[2] ? A[2] : "application/octet-stream") + (window.btoa ? ";base64" : "") + "," + (window.btoa ? window.btoa : escape)(strData);
        setTimeout(function() {
            D.body.removeChild(f);
        }, 333);
        return true;
    }

    function getTileData(year, month) {
        return years[year-startYear].months[month-1].counts;
        // return years[startYear-year]
    }

    function showPredictionComparisons() {
        console.log(startYearCounter);
        dayData = years[startYearCounter].days;
        dayDay = dayData[startDayCounter].day;
        dayMonth = dayData[startDayCounter].month;

        document.getElementById('date').innerHTML = dayMonth + ", " + dayDay + ", " + (startYear + startYearCounter);
        showTiles(startYear + startYearCounter, startDay + startDayCounter);
        showPredictionTiles(predictionCounter);
        get_accuracy(startYear + startYearCounter, startDay + startDayCounter, predictionCounter);
    }

    function forward() {
        startDayCounter++
        predictionCounter++
        if (startDayCounter + startDay == 355) {
            startYearCounter++
            startDayCounter = 0
        }
        showPredictionComparisons()
    }

    function back() {
        startDayCounter--
        predictionCounter--
        if (startDayCounter + startDay == 0) {
            startYearCounter--
            startDayCounter = 353
        }
        showPredictionComparisons()
    }

      
</script>

</head>

<body onload="initialize()" onload="s">

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <div class="navbar-brand">
                    <img src="images/logo-small.png" class="center-block" alt="Logo Small">
                </div>
            </div>
            <div class="navbar-clock">
                <span id="date_time"></span>
                <script type="text/javascript">window.onload = date_time('date_time');</script>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 2</strong>
                                        <span class="pull-right text-muted">20% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 3</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 4</strong>
                                        <span class="pull-right text-muted">80% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="heading">
                            <h4>CCPO FUNCTION</h4>
                        </li>
                        <li class="sidebar-upload">
                            <div class="btn-group btn-group-justified">
                                <a href="index.html" class="btn btn-primary active" id="prediction" role="button">Prediction</a>
                                <a href="reporting.php" class="btn btn-primary" id="reporting" role="button">Reporting</a>
                            </div>
                        </li>
                        <li class="heading">
                            <h4>GRID SNAPSHOT</h4>
                        </li>
                        <li class="sidebar-upload">
                            <div class="btn-group btn-group-justified">
                                <a href="daily.html" class="btn btn-primary active" id="daily" role="button">Daily</a>
                                <a href="weekly.html" class="btn btn-primary btn-weekly" id="weekly" role="button">Weekly</a>
                                <a href="monthly.html" class="btn btn-primary" id="monthly" role="button">Monthly</a>
                            </div>
                        </li>
                        <li class="heading">
                            <h4>LOAD DATA</h4>
                        </li>                    
                        <li class="sidebar-upload">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-primary btn-file">
                                        Browse&hellip; <input type="file" id="fileinput" name="files[]" multiple>
                                    </span>
                                </span>
                                <input type="text" class="form-control" id="button-tooltip" data-toggle="tooltip" data-placement="right" title="Load your data. The data must be in a .csv (Comma-separated) format." readonly>
                            </div>
                        </li>       
                        <li>
                            <button type="button" class="btn btn-primary btn-md sharp" onclick="mergeNoCounts()" id="button-tooltip" data-toggle="tooltip" data-placement="right" title=" Merge squares in the grid.">Merge Squares</button>
                        </li>
                        <li>
                            <button type="button" class="btn btn-primary btn-md sharp" onclick="generateTileFiles()" id="button-tooltip" data-toggle="tooltip" data-placement="right" title="Generates the tile files for the neural network.">Generate Tile Files</button>
                        </li>
                        <li class="heading">
                            <h4>LOAD PREDICTION FILE</h4>
                        </li>
                        <li class="sidebar-upload">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-primary btn-file">
                                        Browse&hellip; <input type="file" id="fileinput2" name="files[]" multiple>
                                    </span>
                                </span>
                                <input type="text" class="form-control" id="button-tooltip" data-toggle="tooltip" data-placement="right" title="Upload the prediction test file." readonly>
                            </div>
                        </li>
                        <li>
                            <button type="button" class="btn btn-primary btn-md sharp" onclick="preprocessData()" id="button-tooltip" data-toggle="tooltip" data-placement="right" title=" Shows all counts of plotted crime.">Process Data</button>
                        </li>

                        <li>
                            <button type="button" class="btn btn-primary btn-md sharp" onclick="showAllCounts()" id="button-tooltip" data-toggle="tooltip" data-placement="right" title=" Shows all counts of plotted crime.">Show All Counts</button>
                        </li>
                        <li>
                            <button type="button" class="btn btn-primary btn-md sharp" onclick="showPredictionComparisons()" id="button-tooltip" data-toggle="tooltip" data-placement="right" title="Compares actual data with prediction data.">Show Prediction Comparisons</button>
                        </li>
                        <li>
                            <div class="back-forward">
                                <button type="button" class="btn btn-primary btn-md sharp" onclick="back()" id="button-tooltip" data-toggle="tooltip" data-placement="right" title="Traverse the previous day.">Previous Day</button>
                                <button type="button" class="btn btn-primary btn-md sharp" onclick="forward()" id="button-tooltip" data-toggle="tooltip" data-placement="right" title=" Traverse the next day.">Next Day</button>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div id="map_canvas" style="width:50%; height: 100vh; float: left"></div>
                <div id="map_canvas2" style="width:50%; height: 100vh; float: right"></div>
                <span style="text-align: center"><h1 id="date"></h1></span>
                <span style="text-align: center"><h2 id="accuracy"></h2></span>
                <span style="text-align: center"><h2 id="f1scr"></h2></span>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js"></script>

    <script type="text/javascript">
    $('document').ready(function () {
        $('#button-tooltip').tooltip()
    })
    </script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../bower_components/raphael/raphael-min.js"></script>
    <script src="../bower_components/morrisjs/morris.min.js"></script>
    <script src="../js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    <script src="../dist/js/highlight.js"></script>
    <script src="../dist/js/main.js"></script>

    <script>
        var d = new Date();
        document.getElementById("demo").innerHTML = d.toString();
    </script>

    <script>
        $('.fa.arrow').on('click', function() {
        $(this).closest('a').next('.nav').slideToggle();
        });
    </script>

    <script>
        $(".rotate").click(function(){
        $(this).toggleClass("down")  ; 
        })
    </script>

    <script>
        $(document).on('change', '.btn-file :file', function() {
          var input = $(this),
              numFiles = input.get(0).files ? input.get(0).files.length : 1,
              label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
          input.trigger('fileselect', [numFiles, label]);
        });

        $(document).ready( function() {
            $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
                
                var input = $(this).parents('.input-group').find(':text'),
                    log = numFiles > 1 ? numFiles + ' files selected' : label;
                
                if( input.length ) {
                    input.val(log);
                } else {
                    if( log ) alert(log);
                }
                
            });
        });
    </script>



</body>

</html>
<script type="text/javascript">
    document.getElementById('fileinput').addEventListener('change', handleFileSelect, false);
    document.getElementById('fileinput2').addEventListener('change', handleFileSelect2, false);
</script>