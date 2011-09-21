var map, GDirs=[], waypoints=[], geolocations=[], gpolys=[], routesList=[], routes=[], myNode, lastIndex, prevIndex, route, geoCoder;
//var startLatLng, endLatLng;
var latitude, longitude;
var pointCounter;
var routeIndex=0;
var numberOfRoutes;
var team, rank, purpool_index, shiftValue;
var teams;
//var json;

function loadGMap(){
	map = new GMap2(document.getElementById("map"));
    map.setCenter(new GLatLng(41.04822346972845, -73.70208263397217), 9);
	map.addControl(new GLargeMapControl());
	normalProj = G_NORMAL_MAP.getProjection(); // for conversion between LatLng and screen pixels
	
	geoCoder = new GClientGeocoder();
	
/*
json={"type":"monthly","months":[{"month":"October","year":2008,"number_of_pools":17,"number_of_pools_overall":55,"teams":[{"team":"The Crazy Riders","members":"john.kuiphoof, brooke.singer, peter.ohring","rank":1,"overall":3,"route":"[\"40.672012,-73.963466\", \"41.043747,-73.684978\"]","purpool_index":144.3,"shift":3},{"team":"General Pepsi","members":"general.smith, general.pepsi, general.cola, general.coke","rank":2,"overall":2,"route":"[\"41.459652,-73.490729\", \"41.043747,-73.684978\"]","purpool_index":128.8,"shift":0},{"team":"The Dodges","members":"john.dodge, jeff.dodge, jim.dodge","rank":3,"overall":1,"route":"[\"40.637877,-74.015067\", \"41.043747,-73.684978\"]","purpool_index":99.2,"shift":-2},{"team":"Pinstripers","members":"john.kuiphoof, brooke.singer, peter.ohring","rank":4,"overall":5,"route":"[\"40.408467,-74.976321\", \"40.94049,-74.080811\", \"41.043747,-73.684978\"]","purpool_index":91.3,"shift":-1},{"team":"Unicorns","members":"matt.yu, brooke.singer, peter.ohring, john.kuiphoff","rank":5,"overall":7,"route":"[\"41.200083,-73.72349\", \"41.043747,-73.684978\"]","purpool_index":88.4,"shift":1},{"team":"Lorem Ipsum","members":"jim.mcelwaine, john.mastracchio, jon.esser, jon.rubin","rank":6,"overall":6,"route":"[\"41.355188,-73.659056\", \"41.043747,-73.684978\"]","purpool_index":84.8,"shift":3},{"team":"Carpulerz","members":"jeanine.meyer, taina.chao, joe skrivanek, marge.oztunali","rank":7,"overall":7,"route":"[\"41.141242,-73.263099\", \"41.043747,-73.684978\"]","purpool_index":82.2,"shift":0},{"team":"Stockton","members":"john.kuiphoof, brooke.singer, peter.ohring","rank":8,"overall":10,"route":"[\"41.290155,-73.920374\", \"41.043747,-73.684978\"]","purpool_index":79.2,"shift":-2},{"team":"Los Lobos","members":"john.kuiphoof, brooke.singer, peter.ohring","rank":9,"overall":8,"route":"[\"41.205657,-73.892388\", \"41.043747,-73.684978\"]","purpool_index":70.2,"shift":-1},{"team":"Pocketeers","members":"john.kuiphoof, brooke.singer, peter.ohring","rank":10,"overall":12,"route":"[\"41.371734,-73.407443\", \"41.043747,-73.684978\"]","purpool_index":40.5,"shift":1}]},{"month":"September","year":2008,"number_of_pools":15,"number_of_pools_overall":53,"teams":[{"team":"The Crazy Riders","members":"john.kuiphoof, brooke.singer, peter.ohring","rank":1,"overall":3,"route":"[\"40.672012,-73.963466\", \"41.043747,-73.684978\"]","purpool_index":141.3,"shift":3},{"team":"General Pepsi","members":"greg.lock, jon.rubin, jon.esser","rank":2,"overall":2,"route":"[\"41.459652,-73.490729\", \"41.043747,-73.684978\"]","purpool_index":134.8,"shift":0},{"team":"The Bottlers","members":"jeanine.meyer, marge.oztunali, michael.wuench, joel.tenenbaum","rank":3,"overall":3,"route":"[\"40.637877,-74.015067\", \"41.043747,-73.684978\"]","purpool_index":123.2,"shift":-2},{"team":"Reverse Commuters","members":"mary.kosut, brooke.singer. jon.rubin, jeremy.rotsztain","rank":4,"overall":6,"route":"[\"40.408467,-74.976321\", \"40.94049,-74.080811\", \"41.043747,-73.684978\"]","purpool_index":112.3,"shift":-1},{"team":"Unicorns","members":"matt.yu, brooke.singer, peter.ohring, john.kuiphoff","rank":5,"overall":8,"route":"[\"41.200083,-73.72349\", \"41.043747,-73.684978\"]","purpool_index":109.4,"shift":1},{"team":"Lorem Ipsum","members":"jim.mcelwaine, john.mastracchio, jon.esser, jon.rubin","rank":6,"overall":7,"route":"[\"41.355188,-73.659056\", \"41.043747,-73.684978\"]","purpool_index":94.8,"shift":3},{"team":"Carpulerz","members":"jeanine.meyer, taina.chao, joe skrivanek, marge.oztunali","rank":7,"overall":10,"route":"[\"41.141242,-73.263099\", \"41.043747,-73.684978\"]","purpool_index":89.2,"shift":0},{"team":"Stockton","members":"john.kuiphoof, brooke.singer, peter.ohring","rank":8,"overall":11,"route":"[\"41.290155,-73.920374\", \"41.043747,-73.684978\"]","purpool_index":89.2,"shift":-2},{"team":"Los Lobos","members":"john.kuiphoof, brooke.singer, peter.ohring","rank":9,"overall":12,"route":"[\"41.205657,-73.892388\", \"41.043747,-73.684978\"]","purpool_index":76.2,"shift":-1},{"team":"Slackers","members":"john.kuiphoof, brooke.singer, peter.ohring","rank":10,"overall":13,"route":"[\"40.891622,-73.910998\", \"41.043747,-73.684978\"]","purpool_index":44.5,"shift":1}]}]} 
*/

//json={"type":"overall","start_month":"October","start_year":2007,"number_of_pools":55,"teams":[{"team":"The Crazy Riders","members":"john.kuiphoof, brooke.singer, peter.ohring","rank":1,"route":"[\"40.672012,-73.963466\", \"41.043747,-73.684978\"]","purpool_index":144.3,"shift":3},{"team":"General Pepsi","members":"general.smith, general.pepsi, general.cola, general.coke","rank":2,"route":"[\"41.459652,-73.490729\", \"41.043747,-73.684978\"]","purpool_index":128.8,"shift":0},{"team":"The Dodges","members":"john.dodge, jeff.dodge, jim.dodge","rank":3,"route":"[\"40.637877,-74.015067\", \"41.043747,-73.684978\"]","purpool_index":99.2,"shift":-2},{"team":"Pinstripers","members":"john.kuiphoof, brooke.singer, peter.ohring","rank":4,"route":"[\"40.408467,-74.976321\", \"40.94049,-74.080811\", \"41.043747,-73.684978\"]","purpool_index":91.3,"shift":-1},{"team":"Unicorns","members":"matt.yu, brooke.singer, peter.ohring, john.kuiphoff","rank":5,"route":"[\"41.200083,-73.72349\", \"41.043747,-73.684978\"]","purpool_index":88.4,"shift":1},{"team":"Lorem Ipsum","members":"jim.mcelwaine, john.mastracchio, jon.esser, jon.rubin","rank":6,"route":"[\"41.355188,-73.659056\", \"41.043747,-73.684978\"]","purpool_index":84.8,"shift":3},{"team":"Carpulerz","members":"jeanine.meyer, taina.chao, joe skrivanek, marge.oztunali","rank":7,"route":"[\"41.141242,-73.263099\", \"41.043747,-73.684978\"]","purpool_index":82.2,"shift":0},{"team":"Stockton","members":"john.kuiphoof, brooke.singer, peter.ohring","rank":8,"route":"[\"41.290155,-73.920374\", \"41.043747,-73.684978\"]","purpool_index":79.2,"shift":-2},{"team":"Los Lobos","members":"john.kuiphoof, brooke.singer, peter.ohring","rank":9,"route":"[\"41.205657,-73.892388\", \"41.043747,-73.684978\"]","purpool_index":70.2,"shift":-1},{"team":"Pocketeers","members":"john.kuiphoof, brooke.singer, peter.ohring","rank":10,"route":"[\"41.371734,-73.407443\", \"41.043747,-73.684978\"]","purpool_index":40.5,"shift":1}]} ;
	//alert(json.months[0].month);

	thisMovie("leaders").sendTypeToActionScript(json.type);//let flash know if monthly or overall vis
	var month, team, teamObj;
	if(json.type=="monthly"){
		var numberOfMonths=12;
		//display at most 12 months worth of data
		if(json.months.length<numberOfMonths){
			numberOfMonths=json.months.length;
		}
		for(month=0; month<numberOfMonths; month++){
			for(team=0; team<json.months[month].teams.length; team++){
				teamObj = json.months[month].teams[team];
				thisMovie("leaders").myinit(month, json.months[month].month, json.months[month].year, parseInt(json.months[month].number_of_pools),parseInt(json.months[month].number_of_pools_overall) ,teamObj.team, teamObj.members, parseInt(teamObj.rank), parseInt(teamObj.overall), parseInt(teamObj.purpool_index), parseInt(teamObj.shift));
			}
		}
		teams = json.months[0].teams;
	}
	else{
		teams = json.teams;
		for(team=0; team<teams.length; team++){
				teamObj = teams[team];
				thisMovie("leaders").myinit(0, "", "", 0,json.number_of_pools_overall ,teamObj.team, teamObj.members, teamObj.rank, teamObj.rank, teamObj.purpool_index, teamObj.shift);
			}		
	}
	thisMovie("leaders").sendLoadMonthToActionScript(0);
	var i;
	for(i=0;i<teams.length;i++){
		routesList[i] = teams[i].route.evalJSON();
	}	
	getRoutes();
	
	GEvent.addListener(map, 'move', function(){
		var i;
		for(i=0;i<teams.length;i++){
			sendToActionScript(getVertices(i),i);
		}
	}); // for detecting if map is moving
}	


// Handler for  route segments. 
function routeLoaded() { 
	routes[routeIndex] = GDirs[routeIndex].getPolyline();
	map.addOverlay(routes[routeIndex]);
	sendToActionScript(getVertices(routeIndex),routeIndex);
	routeIndex++;
	if(routeIndex<routesList.length){
		drawDirections(routesList[routeIndex]);
	}
	//routeIndex++;
}

function drawDirections(geopositions){
	GDirs[routeIndex] = new GDirections();
	GDirs[routeIndex].loadFromWaypoints(geopositions,{getPolyline:true});
	GEvent.addListener(GDirs[routeIndex], "load", routeLoaded); 
}

//sequentially get route info using GDirection class. 
function getRoutes(){
	routeIndex=0;
	//alert(routesList.length);
	if(routesList.length>0){
		drawDirections(routesList[0]);
	}
}
							   
							  

function clearMyOverlays(){
	while(waypoints.length>0) {
		waypoints.pop();
	}
	map.clearOverlays();
}
function getVertices(index){
	var vertices = new Array();
	var i, j, point;
	//alert(routes[index].getVertexCount())
	//for(i=0; i<routes[index].getVertexCount() ; i+=5){
		
	/*for(i=routes[index].getVertexCount()-1; i>0 ; i-=20){
		point = map.fromLatLngToContainerPixel(routes[index].getVertex(i));
		vertices.push(point.x +"," + point.y);
	}
	point = map.fromLatLngToContainerPixel(routes[index].getVertex(0));
	vertices.push(point.x +"," + point.y);*/
	

	for(i=0; i<routes[index].getVertexCount() - 19; i+=20){
		point = map.fromLatLngToContainerPixel(routes[index].getVertex(i));
		vertices.push(point.x +"," + point.y);
	}
	point = map.fromLatLngToContainerPixel(routes[index].getVertex(routes[index].getVertexCount()-1));
	vertices.push(point.x +"," + point.y);
	
	
	//alert(point.x +"," + point.y);
	//alert(vertices.toJSON());
	return vertices.toJSON();
}
/*function thisMovie(movieName) {
	if (navigator.appName.indexOf("Microsoft") != -1) {
    	return window[movieName];
    } 
	else {
        return document[movieName];
    }
}*/
function thisMovie(movieName) {
	var isIE = navigator.appName.indexOf("Microsoft") != -1;
	return (isIE) ? window[movieName] : document[movieName];
}

function sendToActionScript(verticesInJSON,index) {
	//document.getElementById("text").innerHTML += "Hello World";
    thisMovie("leaders").sendToActionScript(verticesInJSON,index);
}
function sendToJavaScript(value) {
    alert("ActionScript says: " + value );
}
function sendPanToJavaScript(dx,dy) {
	//document.getElementById('text').innerHTML = dx + "  " + dy;
    map.panBy(new GSize(dx,dy));
	
}
function sendZoomOutToJavaScript(){
	map.zoomOut();
}
function sendZoomInToJavaScript(){
	map.zoomIn();
}
function sendLoadMapToJavaScript(){
	//eitest();
	if (GBrowserIsCompatible()) {
		loadGMap();
	}
}
function sendLoadRoutesToJavaScript(monthIndex){
	teams = json.months[monthIndex].teams;
	var i;
	for(i=0;i<teams.length;i++){
		routesList[i] = teams[i].route.evalJSON();
	}	
	getRoutes();	
}

