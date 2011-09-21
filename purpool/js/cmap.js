var map, geoCoder;
var markers = []; // an associative array of the markers
var currentMarker;
var mode="edit"; //edit or browse

//The following data should be fed dynamically
var endlat = 41.04822346972845;
var endlng = -73.70208263397217;
var workplace = "Purchase College";
var icon=poolIcon;


//var poiData = [{'id':'1', 'title':'Anthony\'s Pizza','location':'40.672012,-73.963466', 'description':'Great Italian pizza at a reasonable cost','poster':'peter.ohring','address':'11 Maple St, Pleasantville, NY', 'tags':'food, italian, pizza'}, {'id':'2','title':'Citgo','location':'41.459652,-73.490729', 'description':'Cheapest gas in the area','poster':'peter.ohring','address':'4343 North Main, Pleasantville, NY', 'tags':'gas, convenience store'}, {'id':'3','title':'Steakhouse','location':'40.637877,-74.015067', 'description':'Thick and Tasty','poster':'brooke.singer','address':'5674 Woodhaven Blvd, Queens, NY', 'tags':'food, steak'}, {'id':'4','title':'County Park','location':'40.408467,-74.976321', 'description':'A great place for hiking and x-country skiing','poster':'brooke.singer','address':'765 Rectory Street, White Plains, NY', 'tags':'park, hiking, x-country'}, {'id':'5','title':'Art Museum','location':'41.141242,-73.263099', 'description':'Nice collection of Masters','poster':'john.kuiphoff','address':'200 South Eden, Tarrytown, NY', 'tags':'museum, art, painting'}, {'id':'6','title':'Coffe Shop','location':'41.290155,-73.920374', 'description':'A great place to hang out','poster':'peter.ohring', 'address':'11 Maple St, Pleasantville, NY','tags':'food, coffee, desserts'}, {'id':'7','title':'Starbucks','location':'41.205657,-73.892388', 'description':'Wifi available','poster':'john.kuiphoff', 'address':'11 Maple St, Pleasantville, NY','tags':'food, coffee, starbucks'}];






function loadGMap(){
	map = new GMap2(document.getElementById("map"));
	geoCoder = new GClientGeocoder();
    map.setCenter(new GLatLng(endlat, endlng), 9);
	map.addControl(new GSmallMapControl());
	if(mode=="edit"){
		GEvent.addListener(map, "click", function(overlay, point) {
			if (point) {
				var marker = new GMarker(point,{icon:icon});
				try{
					map.removeOverlay(currentMarker);
				}
				catch(e){}
				clearAddressForm();
				map.addOverlay(marker);
				currentMarker=marker;
				// Populate form with latitude and longitude values
				document.getElementById("latitude").value = point.lat();
				document.getElementById("longitude").value = point.lng();
			}			
		});	
	}
	addMarkers();
	//addStreetAddress("Brewster,NY");
}	
//Posts a new Marker using submitted address
function addStreetAddress(address){
	try{
		map.removeOverlay(currentMarker);
	}
	catch(e){}
		geoCoder.getLatLng(address,  function(point)
		{
											  
			try
			{								  
				var marker = new GMarker(point,{icon:icon}); 
				map.addOverlay(marker);
				currentMarker=marker;
			
				// Populate form with latitude and longitude values
				document.getElementById("latitude").value = point.lat();
				document.getElementById("longitude").value = point.lng();
				
				document.getElementById("addressError").innerHTML = '';
		
			}
			catch(e)
			{
				document.getElementById("addressError").innerHTML = 'Address not found. Please try again.';
			}
			

		} );
		
		
	
	
	
}

// adding the markers to the map
function addMarkers() { 
	var id;
	try{
		for(var i=0; i<poiData.length; i++){
				var coords = poiData[i]['location'].split(",");
				var point = new GLatLng(coords[0],coords[1]);
				
				var marker = new GMarker(point, {icon:icon});
				marker.id = poiData[i]["id"];
				marker.title=poiData[i]["title"];
				if(poiData[i]["address"]==null){ marker.address="";} else{marker.address=poiData[i]["address"];}  
				if(poiData[i]["city"]==null){ marker.city="";} else{marker.city=poiData[i]["city"];}  
				if(poiData[i]["state"]==null){ marker.state="";} else{marker.state=poiData[i]["state"];}  
				if(poiData[i]["zip"]==null){ marker.zip="";} else{marker.zip=poiData[i]["zip"];}  
				if(poiData[i]["tags"]==null){ marker.tags="";} else{marker.tags=poiData[i]["tags"];}  
				if(poiData[i]["description"]==null){ marker.description="";} else{marker.description=poiData[i]["description"];}  
				if(poiData[i]["url"]==null){ marker.url="";} else{marker.url=poiData[i]["url"];}  
				marker.name=poiData[i]["name"];
				marker.lat = point.lat();
				marker.lng = point.lng();
				
				//markers[id]= marker;
				markers.push(marker);
				GEvent.addListener(marker, "click", onMarkerClick);
				map.addOverlay(marker);
				
		}
	}
	catch (e){}
	//add workplace marker
	point = new GLatLng(endlat,endlng)
	marker = new GMarker(point, {icon:workplaceIcon, title:workplace});
	map.addOverlay(marker);

}

function onMarkerClick(){
	if(mode=="edit"){
		document.getElementById("title").value=this.title;
		document.getElementById("address").value=this.address;
		document.getElementById("city").value=this.city;
		document.getElementById("state").value=this.state;
		document.getElementById("zip").value=this.zip;
		document.getElementById("tags").value=this.tags;
		document.getElementById("description").value=this.description;
		document.getElementById("url").value=this.url;
		document.getElementById("id").value=this.id;
		document.getElementById("latitude").value=this.lat;
		document.getElementById("longitude").value=this.lng;
		
		currentMarker = this;
		document.getElementById("remove").style.visibility="visible";	
	}
	else{
		var address = "";
		if(this.address!="") {
			address = this.address + ", " +this.city + ", " + this.state + " " + this.zip;
		}
		var url="";
		if(this.url!=""){
			url = "<a href='"+this.url+"'>"+this.url+"</a>";
		}
		var html = "<span class='info_window'><b>"+this.title+"<br/>Address: </b>" + address +"<br/><b>Description: </b>"+this.description+"<br/><b>Posted by: </b>" + this.name+"<br/><b>tags: </b>" + this.tags+"<br/><b>url: </b>" + url + "</span>";
		map.openInfoWindowHtml(this.getLatLng(),html);
	}
	//markerSelected(this.id);

}

//hide all markers on the map
function hideMarkers(){
	var i;
	for(i=0; i<markers.length; i++){
		markers[i].hide();
	}
}

//show markers based on keyword
function showMarkersByTag(tag){
	var useThisPOI = true;
	for(var i=0; i<markers.length; i++){
		if(tag!="all"){
			var tags = markers[i].tags.split(' ');
			var useThisPOI = false;
			var j=0;
			for(j=0; j<tags.length; j++){
				if(trim(tags[j])==trim(tag)) {
					var useThisPOI = true;
				}
			}
		}
		if(useThisPOI){
			markers[i].show();
		}
		else{
			markers[i].hide();
		}
	}
}

// makes the markers whose ids are in the array ids visible
function showMarkersById(ids){
	for(var i=0; i<markers.length; i++){
		if(inArray(markers[i].id, ids)){
			markers[i].show();
		}
		else{
			markers[i].hide();
		}
	}
}

//checks o see whehter element is in the array list. If the array is empty returns false.
function inArray(element, list){
	var result=false;
	if(list.length != 0){
		for(var i=0; i<list.length; i++){
			if(element == list[i]) result=true;
		}
	}
	return result;
}

function clearAddressForm(){
	document.getElementById("myform").reset();
}

function trim(string){
	while(string.substr(0,1)==" ")
		string = string.substring(1,string.length) ;

	while(string.substr(string.length-1,1)==" ")
		string = string.substring(0,string.length-2) ;

	return string;
}

