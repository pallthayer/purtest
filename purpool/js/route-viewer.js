var map, waypoints=[], gpolys=[];
var GDir;
var poolIcon, workplaceIcon; // GIcon objects to use as custom GMarkers
//var workplace = "Purchase College";

function loadGMap(lat, lng){
	map = new GMap2(document.getElementById("map"));
    map.setCenter(new GLatLng(lat, lng), 8);
	
	GDir = new GDirections();
}	

// Handler for loading route 
function routeLoaded() { 
	var gp = GDir.getPolyline();
	
	map.addOverlay(gp);
	
	//add marker for pool at route starting point
	var coords = waypoints[waypoints.length-1].split(",");
	var point = new GLatLng(coords[0],coords[1])
	var marker = new GMarker(point, {icon:poolIcon, title:title, clickable:false});
	map.addOverlay(marker);
	
	//add workpplace marker at end of route, indexed with 0 because of way route is stored
	coords = waypoints[0].split(",");
	point = new GLatLng(coords[0],coords[1])
	marker = new GMarker(point, {icon:workplaceIcon, title:workplace, clickable:false});
	map.addOverlay(marker);

}

function drawDirections(geopositions){
	for(var i=0; i<geopositions.length;i++){waypoints[i]=geopositions[i];}//Make a local copy of the initial locations
	GDir.loadFromWaypoints(waypoints,{getPolyline:true});
	GEvent.addListener(GDir, "load", routeLoaded); 
}
