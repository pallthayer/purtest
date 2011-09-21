var map;
var markers = Array; // an associative array of the markers
var selectedMarker; //marker that is currently selected


//The following data should be fed dynamically
//var endlat = 41.04822346972845;
//var endlng = -73.70208263397217;
//var workplace = "Purchase College";

//test data
//var profileData = [{'zipcode':'10232','location':'40.672012,-73.963466'}, {'zipcode':'06812','location':'41.459652,-73.490729'}, {'zipcode':'12345','location':'40.637877,-74.015067'}, //{'zipcode':'98762','location':'40.408467,-74.976321'}, {'zipcode':'22321','location':'41.141242,-73.263099'}, {'zipcode':'65723','location':'41.290155,-73.920374'}, //{'zipcode':'11221','location':'41.205657,-73.892388'}];

//var poolData = [{'pool_id':'10232','location':'40.672012,-73.963466'}, {'pool_id':'06812','location':'41.459652,-73.490729'}, {'pool_id':'12345','location':'40.637877,-74.015067'}, //{'pool_id':'98762','location':'40.408467,-74.976321'}, {'pool_id':'22321','location':'41.141242,-73.263099'}, {'pool_id':'65723','location':'41.290155,-73.920374'}, //{'pool_id':'11221','location':'41.205657,-73.892388'}];

//Code to enable this script to work for both profile and pool browsing
var icon, defaultImage, data;
if(type=="profile"){
	icon=peopleIcon;
	defaultImage="images/marker-profile.png";
	selectImage="images/marker-profile-selected.png";
	data=profileData;
}
else{
	icon=poolIcon;
	defaultImage="images/marker-pool.png";
	selectImage="images/marker-pool-selected.png";
	data=poolData
}


function loadGMap(lat, lng){
	map = new GMap2(document.getElementById("map"));
    map.setCenter(new GLatLng(lat, lng), 9);
	map.addControl(new GSmallMapControl());
	addMarkers();
}	

// adding the markers to the map
function addMarkers() { 
	//add markers for people at zipcode
	var title;
	
	if(type == "profile")
	{
	
		for(var i=0; i<profileData.length; i++){
			var coords = profileData[i]['location'].split(",");
			var point = new GLatLng(coords[0],coords[1]);
			title=profileData[i]["zipcode"];
			var marker = new GMarker(point, {icon:icon, title:title});
			marker.title = title;
			markers[title]= marker;
			GEvent.addListener(marker, "click", function(){
				markerSelected(this.title);
			});
			map.addOverlay(marker);
		}
	
	} else {
		
		/*
		for(var i=0; i<poolData.length; i++){
			var coords = poolData[i]['location'].split(",");
			var point = new GLatLng(coords[0],coords[1]);
			title=poolData[i]["pool_id"];
			var marker = new GMarker(point, {icon:icon, title:title});
			marker.title = title;
			markers[title]= marker;
			GEvent.addListener(marker, "click", function(){
				markerSelected(this.title);
			});
			map.addOverlay(marker);
		}
		*/
		
		for(var i=0; i<poolData.length; i++){
			var coords = poolData[i]['location'].split(",");
			var point = new GLatLng(coords[0],coords[1]);
			title=poolData[i]["zipcode"];
			var marker = new GMarker(point, {icon:icon, title:title});
			marker.title = title;
			markers[title]= marker;
			GEvent.addListener(marker, "click", function(){
				markerSelected(this.title);
			});
			map.addOverlay(marker);
		}
		
	}
	
	//add workplace marker
	point = new GLatLng(lat,lng)
	marker = new GMarker(point, {icon:workplaceIcon, title:workplace});
	GEvent.addListener(marker, "click", function(){
		if(type == "profile")
		{
			var url = 'profile.php?state=browsesort';
		} else {
			var url = 'pools.php?state=browsesort';
		}
		var ajax = new Ajax.Request( url, { method: 'post', onSuccess: browseSortResponse });
		
	});
	map.addOverlay(marker);

}

function markerSelected(key){
	//document.getElementById('list').innerHTML =  markers[key].title;
	try{
		selectedMarker.setImage(defaultImage); //revert back to default image
	}
	catch(e){}
	markers[key].setImage(selectImage);
	selectedMarker = markers[key]; //set the marker that has been clicked as the selected marker
	map.panTo(markers[key].getLatLng()); //center map on selected marker
	
	// Filter results
	if(type == "profile")
	{
		var url = 'profile.php?state=browsesort&zipcode=' + markers[key].title;
	} else {
		var url = 'pools.php?state=browsesort&zipcode=' + key
	}
	
	// Send ajax request to sort tables
	var ajax = new Ajax.Request( url, { method: 'post', onSuccess: browseSortResponse });
}

function browseSortResponse(resp)
{
	// Obtain JSON response
	var json = resp.responseText.evalJSON();
	
	// If successful, goto step three (interests)
	if(json.status == 'success')
	{
		$('browsetable').update(json.contents);	
	}
}

