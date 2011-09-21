
//Purchase Coordinates 41.043774, -73.684943
var lat = 39.090432;
var lng = -94.583653;
var marker;
document.observe("dom:loaded", function() {
	// Load Map
	if (GBrowserIsCompatible()) {
		map = new GMap2(document.getElementById("map"));
		map.setCenter(new GLatLng(lat, lng), 3);
		map.addControl(new GSmallMapControl());
		geoCoder = new GClientGeocoder();
	}
	
	Event.observe('geocode', 'click', geocoder);
});

function geocoder(){
	var streetAddress = document.getElementById("address").value;
	var city = document.getElementById("city").value;
	var state = document.getElementById("state").value;
	var address = streetAddress + ", " + city + ", " + state;

	
	try{
		geoCoder.getLatLng(address,  function(point){
			document.getElementById("latitude").value = point.lat();
			document.getElementById("longitude").value = point.lng();
			marker = new GMarker(point, {icon:workplaceIcon, clickable:false, title:document.getElementById("name").value});
			map.addOverlay(marker);
			map.setCenter(new GLatLng(point.lat(), point.lng()), 8);
		}); 
	}
	catch(e){
		alert("Geocoding failed. Please check the address and try again");
	}
}