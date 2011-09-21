var map, GDir1, GDir2, normalProj, waypoints=[], gpolys=[], routeNodes=[], myNode, markerDragged, isDragged, lastIndex, prevIndex, route, geoCoder;
var startLatLng, endLatLng;
var pointCounter;
var routeDistance; // The length of the entire route;
var poolIcon, workplaceIcon; // GIcon objects to use as custom GMarkers

var workplace = "Purchase College";

function loadGMap(lat, lng){
	map = new GMap2(document.getElementById("map"));
    map.setCenter(new GLatLng(lat, lng), 9);
	map.addControl(new GSmallMapControl());
	normalProj = G_NORMAL_MAP.getProjection(); // for conversion between LatLng and screen pixels
	
	GDir1 = new GDirections(); // for extending route to additional point
	GDir2 = new GDirections(); // for recalculating of route when dragging line
	geoCoder = new GClientGeocoder();
			
	GEvent.addListener(map, 'mousemove', getProximity); // for detecting if mouse is above displayed route
	GEvent.addListener(map, "zoomend", function() {
		routeNodes = []; // clear cached coordinates in pixels of displayed route vertexes, the coordinates have to be recalculated on new zoom level
	});
	
	GEvent.addListener(map, "click", function(overlay, point) {
		if (point) {
			if (waypoints.length == 0) { // no waypoints exist yet - map was clicked for start of the route
				GDir1.loadFromWaypoints([point.toUrlValue(6), point.toUrlValue(6)], {getPolyline:true}); // get directions from that point to itself to snap it to street
			} 
			else if(waypoints.length == 1){ // map was clicked for additional waypoint
				GDir1.loadFromWaypoints([waypoints[waypoints.length-1].getPoint(), point.toUrlValue(6)], {getPolyline:true}); //get directions from last waypoint to clicked point
			}
		}			
	});	

	
	iconNode = new GIcon();	iconNode.image = '../images/node.gif';
	iconNode.shadow = ''; iconNode.iconSize = new GSize(10,10); iconNode.shadowSize = new GSize(0,0);
	iconNode.iconAnchor = new GPoint(5,5); iconNode.infoWindowAnchor = new GPoint(5,5);
	iconNode.dragCrossImage = 'empty.gif'; // undocumented String: indicates an image to be used as the drag cross. If you set it to the null string, you get the default drag_cross_67_16.png image.
	iconNode.dragCrossSize = GSize(1, 1); //undocumented GSize(): indicates the size of the drag cross. 
	iconNode.maxHeight = 1; //undocumented integer: The maximum difference in height between the marker anchor and the drag cross anchor during dragging. Setting the maxHeight to zero causes it to use the default 13.
	
	// create marker for displaying and dragging when mouse is over displayed route
	myNode = new GMarker(map.getCenter(), {icon:iconNode, draggable:true, bouncy:false, zIndexProcess:function(marker,b) {return 1;}});
	map.addOverlay(myNode);
	myNode.show(); // sometimes .hide() does not work without .show() at first ???
	myNode.hide(); // hide this marker initially
	
	GEvent.addListener(myNode, "drag", function() { // mouse was over displayed route and user drags the displayed marker
		myNode.show();
		if (isDragged == 2) { // already waiting for GDir2.load to complete - so just remember that marker was dragged again
			markerDragged = myNode; // remember which marker was dragged
			return;
		}
		
		if (myNode.MyIndex < waypoints.length) {
			isDragged = 2; // tag that GDir2.load is started
			markerDragged = false;
			
			lastIndex = myNode.MyIndex;	
			prevIndex = -1;
			// recalculate route between waypoints before and after myNode on the displayed line
			GDir2.loadFromWaypoints([waypoints[lastIndex].getPoint(), myNode.getPoint().toUrlValue(6), waypoints[lastIndex + 1].getPoint()], {getPolyline:true});
		}
	});
	
	GEvent.addListener(myNode, "dragend", function() { // when user finished dragging the line, create new waypoint with permanent marker at the location
		var point = myNode.getPoint();
		var marker = new GMarker(point, {icon:iconNode, draggable:true, dragCrossMove:false, bouncy:false, zIndexProcess:function(marker,b) {return 1;}});
		waypoints.splice(myNode.MyIndex + 1, 0, marker); //insert new waypoint into waypoints array
		
		//alert (Object.toJSON(marker));
		
		for (var i = myNode.MyIndex; i < waypoints.length; i++) // reindex next waypoints
			waypoints[i].MyIndex = i;
		
		var dummy = new GPolyline([point]); // insert empty segment into route segments array - GDir2.load will replace it with new route segment
		map.addOverlay(dummy);
		gpolys.splice(myNode.MyIndex + 1, 0, dummy); 
		
		// add event listeners for marker of new waypoint - so route will be recalculated when user drags waypoint
		GEvent.addListener(marker, "dragstart", function() { isDragged = 1; myNode.hide(); });
		GEvent.addListener(marker, "dragend", function() { isDragged = 0; } );
		GEvent.addListener(marker, "drag", dragMarker);
		GEvent.addListener(marker, "click", clicked);
		map.addOverlay(marker);
		
		if (myNode.MyIndex < waypoints.length) {
			lastIndex = myNode.MyIndex + 1; prevIndex = lastIndex - 1;
			// recalculate route between previous and next waypoints going through new inserted waypoint
			GDir2.loadFromWaypoints([waypoints[lastIndex - 1].getPoint(),point.toUrlValue(6), waypoints[lastIndex + 1].getPoint()], {getPolyline:true});
		}
	});		
			
	GEvent.addListener(GDir1, "load", function() { 
		var gp = GDir1.getPolyline();
		var point = gp.getVertex(gp.getVertexCount() - 1); // snap to last vertex in the polyline
		
		
		if (waypoints.length == 0) {	
			var marker = new GMarker(point, {icon:workplaceIcon, draggable:false, title:workplace, dragCrossMove:false, bouncy:false, zIndexProcess:function(marker,b) {return 1;}});
			marker.title = GDir1.getRoute(0).getStartGeocode().address;
		}
		else if (waypoints.length == 1) {	
			var marker = new GMarker(point, {icon:poolIcon, draggable:false,title: GDir1.getRoute(0).getEndGeocode().address ,dragCrossMove:false, bouncy:false, zIndexProcess:function(marker,b) {return 1;}});
			marker.title = GDir1.getRoute(0).getStartGeocode().address;
		}
		else {
			var marker = new GMarker(point, {icon:iconNode, draggable:true, dragCrossMove:false, bouncy:false, zIndexProcess:function(marker,b) {return 1;}});
			waypoints[waypoints.length-1].title = GDir1.getRoute(0).getStartGeocode().address;
			marker.title = GDir1.getRoute(0).getEndGeocode().address
		}
		
		GEvent.addListener(marker, "dragstart", function() { isDragged = 1; myNode.hide(); });
		GEvent.addListener(marker, "drag", dragMarker); 
		GEvent.addListener(marker, "dragend", function() { isDragged = 0; }); 
		//GEvent.addListener(marker, "click", clicked); //can be used to allow user to delete a new intermediate waypoint. Took it out to simplify application.
		
		marker.MyIndex = waypoints.length;
		waypoints.push(marker);
		map.addOverlay(marker);
				
		if (waypoints.length > 1) { // if this was not the first waypoint - display the route to this waypoint
			map.addOverlay(gp);
			gpolys.push(gp);
			
			routeNodes = [];
			getProximity();
		}
		calculateRouteDistance();
	});

	GEvent.addListener(GDir2, "load", function() {
		var gp = GDir2.getPolyline();
		
		map.removeOverlay(gpolys[lastIndex]);
						
		if (prevIndex >= 0) { // not the last waypoint was dragged
			map.removeOverlay(gpolys[lastIndex-1]);

			var minD, minI, points=[];
			var p0 = waypoints[lastIndex].getPoint();
					
			for (var i = 0; i < gp.getVertexCount(); i++) { // search closest vertex to dragged waypoint for splitting received route at it into two routes between waypoints
				var p = gp.getVertex(i);
				points.push(p);
			
				var d = p0.distanceFrom(p);
			
				if (i == 0 || minD > d) {
					minD = d;
					minI = i;
				}	
			}

			gpolys[lastIndex - 1] = new GPolyline(points.slice(0, minI + 1)); //+1,  because slice extracts up to, but not including, the 'end' element
			gpolys[lastIndex] = new GPolyline(points.slice(minI, points.length));
			
			map.addOverlay(gpolys[lastIndex - 1]);
			
			waypoints[lastIndex-1].title = GDir2.getRoute(0).getStartGeocode().address;
			waypoints[lastIndex].title = GDir2.getRoute(0).getEndGeocode().address;
			waypoints[lastIndex+1].title = GDir2.getRoute(1).getEndGeocode().address;
		}
		else { // last waypoint was dragged
			gpolys[lastIndex] = gp;
			waypoints[lastIndex].title = GDir2.getRoute(0).getStartGeocode().address;
			waypoints[lastIndex+1].title = GDir2.getRoute(0).getEndGeocode().address;
		}
		map.addOverlay(gpolys[lastIndex]);
		
		routeNodes = [];
	
		getProximity();
		
		calculateRouteDistance();
		
		isDragged = 0; // tag that there is no dragged waypoints or waiting for GDir to complete 
	
		if (markerDragged) { // marker was dragged again until GDir2 was loaded
			isDragged = 1; // tag that there is dragged waypoint
			GEvent.trigger(markerDragged, 'drag'); // trigger recalculation of route
		}
	});
	
}	

function dragMarker() { // when waypoint marker is being dragged, start calculation of new route
	if (isDragged == 2) { // exit if already waiting for GDir2.load to complete 
		markerDragged = this;
		return; 
	}				
	isDragged = 2; // tag that calculation of new route is started

	if (markerDragged) { //determine which marker triggered the recalculation
		marker = markerDragged;
		markerDragged = false;
	}
	else {
		marker = this;
	}
	
	lastIndex = marker.MyIndex;
	var point = marker.getPoint();
			
	if (lastIndex > 0) {
		if (lastIndex < waypoints.length - 1) {
			prevIndex = lastIndex - 1;	
			GDir2.loadFromWaypoints([waypoints[lastIndex - 1].getPoint(),point.toUrlValue(6),waypoints[lastIndex + 1].getPoint()],{getPolyline:true});	
		}
		else {
			prevIndex = -1; lastIndex = lastIndex - 1; // recalculate path to this point
			GDir2.loadFromWaypoints([waypoints[lastIndex].getPoint(),point.toUrlValue(6)],{getPolyline:true});
		}
	}
	else if (waypoints.length > 1) {
		prevIndex = -1;
		GDir2.loadFromWaypoints([point.toUrlValue(6),waypoints[1].getPoint()],{getPolyline:true});
	}
}

function getProximity(mouseLatLng, marker) { // detecting if mouse is over displayed route
	var dist, zoom;
	
	if (routeNodes.length == 0) { // calculate and cache coordinates of displayed polylines in pixels for better performance in routeNodes array
		dist = 0;
		zoom = map.getZoom();
		
		if (gpolys.length > 0 && gpolys[0].getVertexCount() > 0 ) //store first point
			routeNodes.push(normalProj.fromLatLngToPixel(gpolys[0].getVertex(0), zoom));
				
		for (var i = 0; i < gpolys.length; i++) {
			dist += gpolys[i].getLength();
			
			for (var j = 1; j < gpolys[i].getVertexCount(); j++) {
				var point = normalProj.fromLatLngToPixel(gpolys[i].getVertex(j), zoom)
				point.MyIndex = i; // store the index of polyline containing this node
				routeNodes.push(point);
			}
		}

		// display route length if 'panel' element is present
		var panel = document.getElementById('panel');
		
		if (panel) { 
			panel.innerHTML = (dist/1000).toFixed(1) + " km";
		}		
	}
	
	if (!mouseLatLng || routeNodes.length <= 1 || isDragged > 0) // no route is displayed or route is already being dragged
		return;

	zoom = map.getZoom();
	var mousePx = normalProj.fromLatLngToPixel(mouseLatLng, zoom);
	
	var minDist = 999;
	var minX = mousePx.x; // we will search closest point on the line to mouse position for displaying marker there available for dragging
	var minY = mousePx.y;
	
	if (routeNodes.length > 1) {
		var x,y, d1,d2,d;
		var dx = mousePx.x - routeNodes[0].x;
		var dy = mousePx.y - routeNodes[0].y;
		d2 = dx*dx + dy*dy; // distance^2 from mouse to start of segment 1 in pixels
		
		for (var n = 0 ; ++n < routeNodes.length; ) {
			d1 = d2; // distance^2 from mouse to start of segment n in pixels
			
			x = routeNodes[n].x; dx = mousePx.x - x;
			y = routeNodes[n].y; dy = mousePx.y - y;
			d2 = dx*dx + dy*dy; // distance^2 from mouse to end of segment n in pixels
			
			dx = x - routeNodes[n-1].x; 
			dy = y - routeNodes[n-1].y;
			d = dx*dx + dy*dy; // lenght^2 of segment n			

			var u = ((mousePx.x - x) * dx + (mousePx.y - y) * dy) / d; // a bit of vector algebra :)
			x += (u*dx); // x,y coordinates in pixels of closest point to mouse in segment n
			y += (u*dy);
				
			dx = mousePx.x - x;
			dy = mousePx.y - y;
			dist = dx*dx + dy*dy; // distance^2 from mouse to closest point in segment n

			if ((d1 - dist) + (d2 - dist) > d) { // closest point is outside the segment, so the real closest point is either start or end of segment
				if (d1 < d2) {
					dist = d1; 
					x = routeNodes[n-1].x;
					y = routeNodes[n-1].y;
				}
				else {
					dist = d2; 
					x = routeNodes[n].x;
					y = routeNodes[n].y;
				}				
			};  

			if (minDist > dist) { // closest point in segment n is closest point overall so far
				minDist = dist;
				minX = x;
				minY = y;
				myNode.MyIndex = routeNodes[n].MyIndex; // remember segment closest to mouse
			}
		}
		
		if (minDist > 25) { // mouse is not close enough to the displayed line
			myNode.hide(); // do not display marker for dragging the polyline
		}	
		else {	
			for (n = waypoints.length; --n >= 0;) { // check if mouse is not too close to existing waypoints markers
				var markerPx = normalProj.fromLatLngToPixel(waypoints[n].getPoint(), zoom);
				
				dx = markerPx.x - minX;
				dy = markerPx.y - minY;
				
				if (dx*dx + dy*dy < 25) { // mouse is too close to existing marker
					myNode.hide(); // do not show additional marker for dragging the line - the user is about to drag existing waypoint
					return;
				}	
			}
			
			myNode.setPoint(normalProj.fromPixelToLatLng(new GPoint(minX, minY), zoom));
			myNode.show(); // display marker for dragging the polyline
		}

		//document.getElementById('panel').innerHTML = '<br>Mouse distance to line ' + n + ': ' + minDist.toFixed(2);		
	}
}

var GDir;
var geolocations = new Array();
var numberOfWaypoints;
var deletedWaypoint;
var deletedGpoly1, deletedGpoly2;
function getDirectionsInJSON(){
	var i;
	var geolocations = new Array();
	for(i=0; i<waypoints.length; i++){
		geolocations.push(waypoints[i].getLatLng().toUrlValue(6));
	}
	return geolocations.toJSON();
}
function getTextDirections(){
	var GDir3 = new GDirections();
	var geolocations = new Array();
	for(i=0; i<waypoints.length; i++){
		geolocations.push(waypoints[i].getPoint().toUrlValue(6));
	}
	GDir3.loadFromWaypoints(geolocations,{getPolyline:true,getSteps:true});

	GEvent.addListener(GDir3, "load", function(){
		var route, step, html;
		for(var i=0; i<GDir3.getNumRoutes(); i++){
			route = GDir3.getRoute(i);
			for(step=0;step<route.getNumSteps();step++){
				html+=route.getStep(step).getDescriptionHtml()+": " + route.getStep(step).getDistance().html+"<br>";
			}
		}
		document.getElementById('directions').innerHTML=html;
	});
}
//Will undo a new waypoint  that has been added
function undo(){
	var index = deletedWaypoint.MyIndex;
	map.removeOverlay(gpolys[index-1]);
	//map.removeOverlay(gpolys[index]);
	map.addOverlay(deletedGpoly1);
	map.addOverlay(deletedGpoly2);
	map.addOverlay(deletedWaypoint)
	gpolys.splice(index-1,1, deletedGpoly1, deletedGpoly2); //put back  two surrounding route paths 
	waypoints.splice(index,0,deletedWaypoint); //add waypoint
	//reindex the waypoint markers
	for(var i=index+1;i<waypoints.length;i++){
		waypoints[i].MyIndex += 1;;
	}
}
function clicked(){
	if(this.MyIndex!=waypoints.length-1) {
		var yes=window.confirm("Do you want to delete this waypoint?")
		if (yes){
			GDir = new GDirections();
			var index = this.MyIndex;
			GDir.loadFromWaypoints([waypoints[this.MyIndex-1].getPoint(),waypoints[this.MyIndex+1].getPoint()],{getPolyline:true});
			GEvent.addListener(GDir, "load", function(){ 
				deletedGpoly1 = gpolys[index-1];
				deletedGpoly2 = gpolys[index];
				deletedWaypoint=waypoints[index];
				map.removeOverlay(gpolys[index-1]);
				map.removeOverlay(gpolys[index]);
				var gp = GDir.getPolyline();
				map.addOverlay(gp);
				gpolys.splice(index-1,2, gp); //Replace two surrounding route paths with one connecting two surrounding points
				map.removeOverlay(waypoints[index]);
				waypoints.splice(index,1); //remove waypoint
				//reindex the waypoint markers
				for(var i=index;i<waypoints.length;i++){
					waypoints[i].MyIndex -= 1;
				}
				
			});
		}
	}
}

// Handler for recursively loading initial route segments. 
function routeLoaded() { 
	var gp = GDir.getPolyline();
	var i = waypoints.length;
	var coords = geolocations[i].split(",");
	var point = new GLatLng(coords[0],coords[1])

			
	map.addOverlay(gp);
	//alert(waypoints.length);
	gpolys.push(gp);	
	routeNodes = [];
	getProximity();	
	if(i < numberOfWaypoints-1){
		var marker = new GMarker(point, {icon:iconNode, draggable:false, dragCrossMove:false, bouncy:false, zIndexProcess:function(marker,b) {return 1;}});
		waypoints[i-1].title = GDir.getRoute(0).getStartGeocode().address;
		
		GEvent.addListener(marker, "dragstart", function() {isDragged = 1; myNode.hide(); });
		GEvent.addListener(marker, "drag", dragMarker); 
		GEvent.addListener(marker, "dragend", function() {isDragged = 0; }); 
		//if(i!=numberOfWaypoints-1) {GEvent.addListener(marker, "click", clicked);}
		GEvent.addListener(marker, "click", clicked);
		marker.MyIndex = i;
		waypoints.push(marker);
		map.addOverlay(marker);	
		GDir = new GDirections();
		GDir.loadFromWaypoints(geolocations.slice(i,i+2),{getPolyline:true});
		GEvent.addListener(GDir, "load", routeLoaded); 
	}
	else{
		var marker = new GMarker(point, {icon:poolIcon, title:title, clickable:false});
		marker.MyIndex = 0;
		waypoints.push(marker);
		map.addOverlay(marker);
		waypoints[i].title = GDir.getRoute(0).getEndGeocode().address;
		calculateRouteDistance();
	}
}

function drawDirections(geopositions){
	for(var i=0; i<geopositions.length;i++){geolocations[i]=geopositions[i];}//Make a local copy of the initial locations
	numberOfWaypoints = geolocations.length;
	//Create the starting marker
	var coords = geolocations[0].split(",");
	var point = new GLatLng(coords[0],coords[1])
	var marker = new GMarker(point, {icon:workplaceIcon, clickable:false, title:workplace});
	marker.MyIndex = 0;
	waypoints.push(marker);
	map.addOverlay(marker);
	
	// Get first route segment
	GDir = new GDirections();
	GDir.loadFromWaypoints(geolocations.slice(0,2),{getPolyline:true});
	GEvent.addListener(GDir, "load", routeLoaded); 
}


function addStreetAddressToRoute(address){
	//document.getElementById("debug").innerHTML = address;
	geoCoder.getLatLng(address,  function(point){
		if (waypoints.length == 0) { 
			GDir1.loadFromWaypoints([point.toUrlValue(6), point.toUrlValue(6)], {getPolyline:true}); // get directions from that point to itself to snap it to street
		} 
		else if (waypoints.length ==1){
			if(!point)
			{
				alert('This is an invalid address. Please try again.');
				$('startaddress').value = '';
				$('startcity').value = '';
				$('startstate').value = '';
				$('startzip').value = '';
			} else {
	
			GDir1.loadFromWaypoints([waypoints[waypoints.length-1].getPoint(), point.toUrlValue(6)], {getPolyline:true}); //get directions from last waypoint to clicked point
			}
			
		}
	} );
}

function addStartAndEndStreetAddressToRoute(start, end){
	pointCounter=0;
	geoCoder.getLatLng(start,  function(point){
		startLatLng = point.lat()+ ","+ point.lng();
		pointCounter++;
		if(pointCounter==2){
			drawDirections([startLatLng, endLatLng]);
		}
	}); 
	geoCoder.getLatLng(end,  function(point){
		endLatLng =point.lat() + ","+ point.lng();
		pointCounter++;
		if(pointCounter==2){
			drawDirections([startLatLng, endLatLng]);
		}
	}); 


}
function clearMyOverlays(){
	var i;
	for(i=0;i<waypoints.length;i++){
		map.removeOverlay(waypoints[i])
	}
	for(i=0;i<gpolys.length;i++){
		map.removeOverlay(gpolys[i])
	}

	routeNodes=[];
	gpolys=[];
	waypoints=[]

	// John added
	 addStreetAddressToRoute(endaddress);
	 
	 
}
function getVertices(){
	var vertices = new Array();
	var i, j, point;
	for(i=0; i<gpolys.length ; i++){
		for(j=0; j<gpolys[i].getVertexCount(); j++){
			//vertices.push(gpolys[i].getVertex(j).toUrlValue(6));
			point = map.fromLatLngToContainerPixel(gpolys[i].getVertex(j));
			vertices.push(point.x +"," + point.y);
			//alert(gpolys[i].getVertex(j));
		}
	}
	
	return vertices.toJSON();
	//alert(vertices.length);
	//alert(map.fromLatLngToContainerPixel(gpolys[0].getVertex(0))) ;	
}
function calculateRouteDistance(){
	routeDistance=0;
	for(i=0;i<gpolys.length;i++){
		routeDistance += gpolys[i].getLength();
	}
}
function getDistance(){
	return routeDistance;
}