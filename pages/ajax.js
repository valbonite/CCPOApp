function getXMLHTTP() { //function to return the xml http object
	var xmlhttp = false;
	try {
		xmlhttp = new XMLHttpRequest();
	} catch (e) {
		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (e) {
			try {
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e1) {
				xmlhttp = false;
			}
		}
	}
	return xmlhttp;
}
//Start of ICONS
var customIcons = {
	1 : {
		icon : './img/final-map/carnapping.png'
	},
	2 : {
		icon : './img/final-map/cattlerustling.png'
	},
	3 : {
		icon : './img/final-map/homicide.png'
	},
	4 : {
		icon : './img/final-map/murder.png'
	},
	5 : {
		icon : './img/final-map/otherni.png'
	},
	6 : {
		icon : './img/final-map/physicalinjuries.png'
	},
	7 : {
		icon : './img/final-map/rape.png'
	},
	8 : {
		icon : './img/final-map/robbery.png'
	},
	9 : {
		icon : './img/final-map/speciallaws.png'
	},
	10 : {
		icon : './img/final-map/theft.png'
	},
	11 : {
		icon : './img/final-map/vawc.png'
	},
	12 : {
		icon : './img/final-map/vta.png'
	},
};
var otherLayers = {
	1 : {
		icon : './img/pnp.png'
	},
};
var customIcon = {
	1 : {
		icon : './img/small-icons/carnapping.gif'
	},
	2 : {
		icon : './img/small-icons/cattlerustling.gif'
	},
	3 : {
		icon : './img/small-icons/homicide.gif'
	},
	4 : {
		icon : './img/small-icons/murder.gif'
	},
	5 : {
		icon : './img/small-icons/otherni.gif'
	},
	6 : {
		icon : './img/small-icons/physicalinjuries.gif'
	},
	7 : {
		icon : './img/small-icons/rape.gif'
	},
	8 : {
		icon : './img/small-icons/robbery.gif'
	},
	9 : {
		icon : './img/small-icons/speciallaws.gif'
	},
	10 : {
		icon : './img/small-icons/theft.gif'
	},
	11 : {
		icon : './img/small-icons/vawc.gif'
	},
	12 : {
		icon : './img/small-icons/vta.gif'
	},
};
//End of ICONS
var gmarkers = [], gmarker = [], maps = [], circle = null, center, radius = null, marker_radius = null, station_markers = [], check_icon = 0, pointArray, heatmap, heatData = [];

function load() { //Initialize CORDILLERA MAP
	var baguio = new google.maps.LatLng(17.500009, 121.083069);
google.maps.visualRefresh = true;
	map = new google.maps.Map(document.getElementById("map_canvas"), {
		center : baguio,
		zoom : 8,
		mapTypeId : google.maps.MapTypeId.ROADMAP,
                mapTypeControl: false,
		panControl : true,
		panControlOptions : {
			position : google.maps.ControlPosition.RIGHT_TOP
		},
		zoomControl : true,
		zoomControlOptions : {
			style : google.maps.ZoomControlStyle.LARGE,
			position : google.maps.ControlPosition.RIGHT_TOP
		},
		scaleControl : true,
		scaleControlOptions : {
			position : google.maps.ControlPosition.RIGHT_TOP
		},
	});
	//Places autocomplete for CORDILLERA map
	var autocomplete = new google.maps.places.Autocomplete(document
			.getElementById('search'));
	autocomplete.bindTo('bounds', map);
	google.maps.event.addListener(autocomplete, 'place_changed', function() {
		var place = autocomplete.getPlace();
		center = place.geometry.location;
		radius = parseInt(document.getElementById('radius').value);
		map.setCenter(center);
		map.setZoom(20);
		addMarker(center);
		addCircle(center, radius);
	});
	var infoWindow = new google.maps.InfoWindow;
	var outerPoints = [ //Define CORDILLERA BOUNDARIES
	new google.maps.LatLng(16.893916, 120.640869),
			new google.maps.LatLng(16.694079, 120.613403),
			new google.maps.LatLng(16.667769, 120.591431),
			new google.maps.LatLng(16.630929, 120.552979),
			new google.maps.LatLng(16.588817, 120.547485),
			new google.maps.LatLng(16.509833, 120.470581),
			new google.maps.LatLng(16.367580, 120.481567),
			new google.maps.LatLng(16.262141, 120.498047),
			new google.maps.LatLng(16.219949, 120.547485),
			new google.maps.LatLng(16.219949, 120.591431),
			new google.maps.LatLng(16.188300, 120.651855),
			new google.maps.LatLng(16.193575, 120.695801),
			new google.maps.LatLng(16.198850, 120.750732),
			new google.maps.LatLng(16.235772, 120.756226),
			new google.maps.LatLng(16.330683, 120.805664),
			new google.maps.LatLng(16.314868, 120.855103),
			new google.maps.LatLng(16.441354, 120.899048),
			new google.maps.LatLng(16.551962, 120.871582),
			new google.maps.LatLng(16.599346, 120.904541),
			new google.maps.LatLng(16.630929, 121.047363),
			new google.maps.LatLng(16.630929, 121.140747),
			new google.maps.LatLng(16.630929, 121.201172),
			new google.maps.LatLng(16.646718, 121.250610),
			new google.maps.LatLng(16.688817, 121.289063),
			new google.maps.LatLng(16.699340, 121.316528),
			new google.maps.LatLng(16.757208, 121.322021),
			new google.maps.LatLng(16.783506, 121.343994),
			new google.maps.LatLng(16.804541, 121.398926),
			new google.maps.LatLng(16.841348, 121.462097),
			new google.maps.LatLng(16.851862, 121.517029),
			new google.maps.LatLng(16.867634, 121.539001),
			new google.maps.LatLng(16.886032, 121.571960),
			new google.maps.LatLng(16.912311, 121.585693),
			new google.maps.LatLng(17.279841, 121.555481),
			new google.maps.LatLng(17.395200, 121.596680),
			new google.maps.LatLng(17.450232, 121.679077),
			new google.maps.LatLng(17.515725, 121.651611),
			new google.maps.LatLng(17.617846, 121.549988),
			new google.maps.LatLng(17.628317, 121.525269),
			new google.maps.LatLng(17.675428, 121.475830),
			new google.maps.LatLng(17.659726, 121.445618),
			new google.maps.LatLng(17.691129, 121.440125),
			new google.maps.LatLng(17.735607, 121.431885),
			new google.maps.LatLng(17.803611, 121.354980),
			new google.maps.LatLng(17.814071, 121.313782),
			new google.maps.LatLng(17.845447, 121.322021),
			new google.maps.LatLng(17.882045, 121.346741),
			new google.maps.LatLng(17.929089, 121.360474),
			new google.maps.LatLng(17.957832, 121.376953),
			new google.maps.LatLng(18.028363, 121.409912),
			new google.maps.LatLng(18.054478, 121.462097),
			new google.maps.LatLng(18.119750, 121.475830),
			new google.maps.LatLng(18.239786, 121.486816),
			new google.maps.LatLng(18.312811, 121.453857),
			new google.maps.LatLng(18.380592, 121.333008),
			new google.maps.LatLng(18.401443, 121.283569),
			new google.maps.LatLng(18.427502, 121.239624),
			new google.maps.LatLng(18.484819, 121.102295),
			new google.maps.LatLng(18.542117, 121.080322),
			new google.maps.LatLng(18.542117, 121.030884),
			new google.maps.LatLng(18.505657, 121.036377),
			new google.maps.LatLng(18.463979, 120.997925),
			new google.maps.LatLng(18.463979, 120.964966),
			new google.maps.LatLng(18.401443, 120.948486),
			new google.maps.LatLng(18.338884, 120.948486),
			new google.maps.LatLng(18.250220, 120.953979),
			new google.maps.LatLng(18.161511, 120.981445),
			new google.maps.LatLng(18.119750, 120.937500),
			new google.maps.LatLng(18.030975, 120.937500),
			new google.maps.LatLng(17.952606, 120.910034),
			new google.maps.LatLng(17.968283, 120.827637),
			new google.maps.LatLng(17.910796, 120.778198),
			new google.maps.LatLng(17.895114, 120.717773),
			new google.maps.LatLng(17.832374, 120.684814),
			new google.maps.LatLng(17.790535, 120.569458),
			new google.maps.LatLng(17.670194, 120.520020),
			new google.maps.LatLng(17.560247, 120.476074),
			new google.maps.LatLng(17.481672, 120.476074),
			new google.maps.LatLng(17.486911, 120.536499),
			new google.maps.LatLng(17.486911, 120.580444),
			new google.maps.LatLng(17.460713, 120.591431),
			new google.maps.LatLng(17.434511, 120.563965),
			new google.maps.LatLng(17.397821, 120.558472),
			new google.maps.LatLng(17.345395, 120.541992),
			new google.maps.LatLng(17.324420, 120.552979),
			new google.maps.LatLng(17.324420, 120.602417),
			new google.maps.LatLng(17.261482, 120.668335),
			new google.maps.LatLng(17.167034, 120.679321),
			new google.maps.LatLng(17.156537, 120.761719),
			new google.maps.LatLng(17.188027, 120.783691),
			new google.maps.LatLng(17.193275, 120.855103),
			new google.maps.LatLng(17.098792, 120.778198),
			new google.maps.LatLng(17.041029, 120.789185),
			new google.maps.LatLng(16.999009, 120.783691),
			new google.maps.LatLng(16.946470, 120.772705),
			new google.maps.LatLng(16.909684, 120.734253),
			new google.maps.LatLng(16.909684, 120.673828),
			new google.maps.LatLng(16.903114, 120.644989),
			new google.maps.LatLng(16.896544, 120.638123) ];
	var myCoordinates = [ outerPoints ];
	var polyOptions = {
		paths : myCoordinates,
		strokeColor : "#FFFF00",
		strokeOpacity : 0.8,
		strokeWeight : 2,
		fillColor : "#0000FF",
		fillOpacity : 0.1
	};
	var it = new google.maps.Polygon(polyOptions);
	it.setMap(map);

	downloadUrl(
			"crime.php",
			function(data) { //Retrieve Crimes
				var xml = data.responseXML;
				var markers = xml.documentElement.getElementsByTagName("crime");
				var infoWindow = new google.maps.InfoWindow;
				for ( var i = 0; i < markers.length; i++) {
                                        var crimeid = markers[i].getAttribute("crimeid");
					var name = markers[i].getAttribute("crime_name");
					var address = markers[i].getAttribute("place");
					var crime_type = markers[i].getAttribute("crime_type");
					var station = markers[i].getAttribute("station");
					var description = markers[i].getAttribute("description");
					var date = markers[i].getAttribute("date");
					var time = markers[i].getAttribute("time");
					var mode = markers[i].getAttribute("mode");
					var sketch = markers[i].getAttribute("sketch");
					if (sketch == '') {
						sketch = 'img/unknown.gif';
					} else {
						sketch = 'upload/' + sketch;
					}
					var point = new google.maps.LatLng(parseFloat(markers[i]
							.getAttribute("lat")), parseFloat(markers[i]
							.getAttribute("lng")));
var x = parseFloat(markers[i].getAttribute("lat"));
					var y = parseFloat(markers[i].getAttribute("lng"));
					//var heat = new google.maps.LatLng(x, y);
					var html = "<b>"
							+ name
                                                        + "</b> <br/><span>Crime ID:</span>"
                                                        + crimeid
							+ "<br/><span>Description:</span>"
							+ description
							+ "-"
							+ mode
							+ "<br/><span>Location:</span>"
							+ address
							+ "</br><span>Date:</span>"
							+ date
							+ "</br><span>Time:</span>"
							+ time
							+ "<br/><span>Police Station:</span>"
							+ station
							+ "</br><a href='"+sketch+"' rel='lightbox' caption='Suspect'> <img src='"
							+ sketch
							+ "' name='testing' style='width: 60px; height:60px;'/></a></br><label>Suspect's Sketch</label>";
					//var icon = customIcons[crime_type] || {};
					var marker = new google.maps.Marker({
						position : point,
					//animation : google.maps.Animation.DROP,
					//icon: icon.icon,
					//map: map
					});
					marker.crime_type = crime_type;
					marker.date = markers[i].getAttribute("date");
					marker.time = markers[i].getAttribute("time");
					marker.province = markers[i].getAttribute("province");
					marker.station = station;
					gmarkers.push(marker);
//heatData.push(heat);
					bindInfoWindow(marker, map, infoWindow, html);
				}
//pointArray = new google.maps.MVCArray(heatData);
	//			  heatmap = new google.maps.visualization.HeatmapLayer({
		//			data: pointArray,
			//		map: map
				//  });
				showMarkers(); //Process Markers
			});
	loadStations(); // Load Police Stations
}

function loadStations() { // Function to load Stations
	downloadUrl("station.php", function(data) {
		var xml = data.responseXML;
		var markers = xml.documentElement.getElementsByTagName("station");
		var infoWindow = new google.maps.InfoWindow;
		for ( var i = 0; i < markers.length; i++) {
			var id = 1; //Initialize to match ICON id
			var name = markers[i].getAttribute("name");
			var head = markers[i].getAttribute("head");
			var email = markers[i].getAttribute("email");
			var hotline = markers[i].getAttribute("hotline");
			var address = markers[i].getAttribute("address");
			var point = new google.maps.LatLng(parseFloat(markers[i]
					.getAttribute("lat")), parseFloat(markers[i]
					.getAttribute("lng")));
			var html = "<b>" + name + "</b> <br/><b>Head: </b>" + head
					+ "</br><b>Address: </b>" + address
					+ "</br><b>Hotline/Contact No: </b>" + hotline;
			var icon = otherLayers[id] || {};
			var marker = new google.maps.Marker({
				position : point,
				icon : icon.icon,
			//map: map
			});
			station_markers.push(marker);
			bindInfoWindow(marker, map, infoWindow, html);
		}
	});
	CheckStations();
}

function CheckStations() { //Check if user checked the Checkbox
	if (document.getElementById('procor_station').checked == true) {
		for ( var i = 0; i < station_markers.length; i++) {
			station_markers[i].setMap(map);
		}
	} else {
		for ( var i = 0; i < station_markers.length; i++) {
			station_markers[i].setMap(null);
		}
	}
}

function showMarkers() {
	resetMarker();
	var date_from = document.getElementById('start_date').value;
	var date_to = document.getElementById('end_date').value;
	var ppo = document.getElementById('province').value;
	if (date_from > date_to) {
		alert('Starting date must be earlier than ending date.');
	}
	var time_from = document.getElementById('start_time').value;
	var time_to = document.getElementById('end_time').value;
	time_from = Date.parse('20 Aug 2000 ' + time_from);
	time_to = Date.parse('20 Aug 2000 ' + time_to);
	if (time_from > time_to) {
		alert('Starting time must be earlier than ending time.');
	}
	if (ppo == 0) {
		for ( var i = 0; i < gmarkers.length; i++) {
			if ((gmarkers[i].date >= date_from && gmarkers[i].date <= date_to)
					&& (Date.parse('20 Aug 2000 ' + gmarkers[i].time) >= time_from && Date
							.parse('20 Aug 2000 ' + gmarkers[i].time) <= time_to)) {
				gmarker.push(gmarkers[i]);
			}
		}
	} else {
		for ( var i = 0; i < gmarkers.length; i++) {
			if ((gmarkers[i].date >= date_from && gmarkers[i].date <= date_to)
					&& (Date.parse('20 Aug 2000 ' + gmarkers[i].time) >= time_from && Date
							.parse('20 Aug 2000 ' + gmarkers[i].time) <= time_to)
					&& gmarkers[i].province == ppo) {
				gmarker.push(gmarkers[i]);
			}
		}
	}
	checkBox();
}
function checkBox() {
	var crime_type_search = document.getElementsByName('crime_type_search');
	for ( var i = 0; i < gmarker.length; i++) {
		for ( var x = 0; x < crime_type_search.length; x++) {
			if (crime_type_search[x].checked == true) {
				if (gmarker[i].crime_type == crime_type_search[x].value) {
					maps.push(gmarker[i]);
				}
			}
		}
	}
	finalMarker();
}
function finalMarker() {
	if (check_icon == 0) {
		for ( var i = 0; i < maps.length; i++) {
			var icon = customIcons[maps[i].crime_type] || {};
			maps[i].setIcon(icon.icon);
		}
	} else if (check_icon == 1) {
		for ( var i = 0; i < maps.length; i++) {
			var icons = customIcon[maps[i].crime_type] || {};
			maps[i].setIcon(icons.icon);
		}
	}
	var counter = 0;
	var radius = document.getElementById('radius').value;
	if (radius == 0) {
		for ( var i = 0; i < maps.length; i++) {
			maps[i].setMap(map);
			counter++;
		}
	} else {
		for ( var i = 0; i < maps.length; i++) {
			maps[i].setMap(null);
		}
		for ( var i = 0; i < maps.length; i++) {
			var inRadius = google.maps.geometry.spherical
					.computeDistanceBetween(maps[i].position, center);
			if (inRadius < radius) {
				maps[i].setMap(map);
				counter++;
			}
		}
	}
	var date_from = document.getElementById('start_date').value;
	var date_to = document.getElementById('end_date').value;
	document.getElementById('information').innerHTML = "Showing " + counter
			+ " crimes from <a href='#' onclick='date_from.focus()'>"
			+ date_from + " </a>to <a href='#' onclick='date_to.focus()'>"
			+ date_to + "</a>.";
}

function resetMarker() {
	for ( var i = 0; i < gmarkers.length; i++) {
		gmarkers[i].setMap(null);
	}
	gmarker.length = 0;
	maps.length = 0;
	gmarker = [];
	maps = [];
}

function bindInfoWindow(marker, map, infoWindow, html, crime_type) {
	google.maps.event.addListener(marker, 'click', function() {
		infoWindow.setContent(html);
		infoWindow.open(map, marker);
	});
}

function downloadUrl(url, callback) {
	var request = window.ActiveXObject ? new ActiveXObject('Microsoft.XMLHTTP')
			: new XMLHttpRequest;

	request.onreadystatechange = function() {
		if (request.readyState == 4) {
			request.onreadystatechange = doNothing;
			callback(request, request.status);
		}
	};
	request.open('GET', url, true);
	request.send(null);
}

function doNothing() {
}

function setLocation() {
	var address = document.getElementById('search').value;
	if (address == '') {
		alert('Please enter a location.');
	} else {
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({
			'address' : address
		}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				map.setZoom(16);
				center = results[0].geometry.location;
				radius = parseInt(document.getElementById('radius').value);
				addCircle(center, radius);
			} else {
				alert('Unable to find address!');
			}
		});
	}
}

function addMarker(loc) {
	//var infoWindows = new google.maps.InfoWindow;
	// var marker_html = "<b>Select Radius</b></br><select id='radius' onchange='setLocation()'><option value='0'>Select Radius</option><option value='100'>100 m</option><option value='500'>500 m</option><option value='1000'>1 km</option><option value='1500'>1.5 km</option><option value='2000'>2 km</option></select>";
	if (marker_radius != null)
		marker_radius.setMap(null);
	marker_radius = new google.maps.Marker({
		map : map,
		position : loc,
		draggable : true
	});
	//google.maps.event.addListener(marker_radius, 'click', function() {
	//infoWindows.setContent(marker_html);
	//infoWindows.open(map, marker_radius);
	// });
}
function addCircle(center, radius) {
	if (circle != null)
		circle.setMap(null);
	circle = new google.maps.Circle({
		center : center,
		map : map,
		radius : radius,
		fillColor : 'blue',
		editable : false
	});
	/*  google.maps.event.addListener(circle, 'center_changed', function() {
	     var pos = circle.getCenter();
	     marker.setPosition(pos);
	     center = pos;
		finalMarker();
	 });
	  google.maps.event.addListener(circle, 'radius_changed', function() {
	     $('#radius').val(Math.ceil(circle.getRadius()));
		finalMarker();
	 });  */
	finalMarker();
}
function smallIcon() {
	/* for(var i=0; i<maps.length; i++){
	var icons = customIcon[maps[i].crime_type] || {};
	maps[i].setIcon(icons.icon);
	}
	for(var i=0; i<gmarker.length; i++){
	var icons = customIcon[gmarker[i].crime_type] || {};
	gmarker[i].setIcon(icons.icon);
	}
	for(var i=0; i<gmarkers.length; i++){
	var icons = customIcon[gmarker[i].crime_type] || {};
	gmarkers[i].setIcon(icons.icon);
	} */
	check_icon = 1;
	finalMarker();
}
function largeIcon() {
	check_icon = 0;
	finalMarker();
}
function loadMap() {
	var baguio = new google.maps.LatLng(17.500009, 121.083069);
	map = new google.maps.Map(document.getElementById("modal_map"), {
		center : baguio,
		zoom : 8,
		mapTypeId : google.maps.MapTypeId.HYBRID,
		panControl : true,
		panControlOptions : {
			position : google.maps.ControlPosition.RIGHT_TOP
		},
		zoomControl : true,
		zoomControlOptions : {
			style : google.maps.ZoomControlStyle.LARGE,
			position : google.maps.ControlPosition.RIGHT_TOP
		},
		scaleControl : true,
		scaleControlOptions : {
			position : google.maps.ControlPosition.RIGHT_TOP
		},
	});
	var autocomplete = new google.maps.places.Autocomplete(document
			.getElementById('modal_search'));
	autocomplete.bindTo('bounds', map);
	google.maps.event.addListener(autocomplete, 'place_changed', function() {
		var place = autocomplete.getPlace();
		center = place.geometry.location;
		map.setCenter(center);
		map.setZoom(18);
		var marker = new google.maps.Marker({
			map : map,
			position : center,
			animation : google.maps.Animation.DROP,
			draggable : true
		});
		google.maps.event.addListener(marker, 'click', function() {
			latlng = marker.getPosition();
			;
			var geocoder = new google.maps.Geocoder();
			geocoder.geocode({
				'location' : latlng
			}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					//document.getElementById('location').value = results[0].formatted_address;
				}
			});
			document.getElementById('longitude').value = latlng.lng();
			document.getElementById('latitude').value = latlng.lat();
		});
	});

	var latlng;
	google.maps.event.addListener(map, "click", function(event) {
		marker = new google.maps.Marker({
			position : event.latLng,
			map : map,
draggable:true
		});
		google.maps.event.addListener(marker, "click", function() {
			//infowindow.open(map, marker);
			latlng = marker.getPosition();
			;
			var geocoder = new google.maps.Geocoder();
			geocoder.geocode({
				'location' : latlng
			}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					//document.getElementById('location').value = results[0].formatted_address;
				}
			});
			document.getElementById('longitude').value = latlng.lng();
			document.getElementById('latitude').value = latlng.lat();
			$('#map_modal_div').modal('hide');
		});
	});
}
function getOffense(crime_type) {
	var strURL = "getOffense.php?crime_type=" + crime_type;
	var req = getXMLHTTP();
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				// only if "OK"
				if (req.status == 200) {
					document.getElementById('classification').innerHTML = req.responseText;
				} else {
					alert("There was a problem while using XMLHTTP:\n"
							+ req.statusText);
				}
			}
		}
		req.open("GET", strURL, true);
		req.send(null);
	}
}
function getMode(crime_type) {
	var strURL = "getMode.php?crime_type=" + crime_type;
	var req = getXMLHTTP();
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				// only if "OK"
				if (req.status == 200) {
					document.getElementById('mode').innerHTML = req.responseText;
				} else {
					alert("There was a problem while using XMLHTTP:\n"
							+ req.statusText);
				}
			}
		}
		req.open("GET", strURL, true);
		req.send(null);
	}
}
function getStation(ppo) {
	var strURL = "../admin/getStation.php?ppo=" + ppo;
	var req = getXMLHTTP();
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				// only if "OK"
				if (req.status == 200) {
					document.getElementById('encoder_station').innerHTML = req.responseText;
				} else {
					alert("There was a problem while using XMLHTTP:\n"
							+ req.statusText);
				}
			}
		}
		req.open("GET", strURL, true);
		req.send(null);
	}
}
function changePassword() {
	var pass1 = document.getElementById('new_password').value;
	var pass2 = document.getElementById('confirm_password').value;
	var username = document.getElementById('u_name').value;
	var error_password = "";
	if (pass1.length < 8) {
		error_password = '';
		error_password = error_password
				+ "<p>Password must not be lesser than 8.</p></br>";
		document.getElementById('error_pass').innerHTML = error_password;
		document.getElementById('error_pass').style.visibility = 'visible';
	} else if (pass2 != pass1) {
		error_password = '';
		error_password = error_password
				+ "<p>Password does not match.</p></br>";
		document.getElementById('error_pass').innerHTML = error_password;
		document.getElementById('error_pass').style.visibility = 'visible';
	} else {
		var strURL = "changePassword.php?password=" + pass1 + "&username="
				+ username;
		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {
						document.getElementById('error_pass').innerHTML = "Password changed!";
						document.getElementById('error_pass').style.visibility = 'visible';
						document.getElementById('new_password').value = '';
						document.getElementById('confirm_password').value = '';
					} else {
						alert("There was a problem while using XMLHTTP:\n"
								+ req.statusText);
					}
				}
			}
			req.open("GET", strURL, true);
			req.send(null);
		}
	}
}
function selectCrimeType(crime_type) {
	var strURL = "../admin/table.php?crime_type=" + crime_type;
	var req = getXMLHTTP();
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				// only if "OK"
				if (req.status == 200) {
					document.getElementById('list_here').innerHTML = req.responseText;
				} else {
					alert("There was a problem while using XMLHTTP:\n"
							+ req.statusText);
				}
			}
		}
		req.open("GET", strURL, true);
		req.send(null);
	}
}