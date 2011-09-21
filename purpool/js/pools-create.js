//////////////////////////////////////////////////////////////
// Title: pool-create.js									//
// Author: John Kuiphoff									//
// Description: Handles all project ajax requests			//
//////////////////////////////////////////////////////////////

// INITIAL EVENT LISTENERS
document.observe("dom:loaded", function() 
{
	
	// Initialize Pool Form
	var poolForm = new Formfocus('myform');
			
	// Focus first element
	poolForm.focusFirst();
	
	// Create event handlers for obtaining default starting and ending places
	Event.observe('startplace', 'change', getParkAndRideAddressPost);
	Event.observe('endplace', 'change', getWorkplaceAddressPost);
	
	// Listen for form submission
	Event.observe('myform', 'submit', createPoolPost);
	
	// Declare map variables
	var startcenter = null;
	var endcenter = null;
	var startmarker = null;
	var endmarker = null;
	var startlat = null;
	var startlng = null;
	var endlat = null;
	var endlng = null;
	var startmapmarkerpresent = false;
	
	// Initialize Map
	if (GBrowserIsCompatible()) 
	{
		// Create Map Objects
		var startmap = new GMap2(document.getElementById("startmap"));
		var endmap   = new GMap2(document.getElementById("endmap"));
		
		// Set the center point for the starting place (default to workplace)
		startlat = $('endlat').value;
		startlng = $('endlng').value;
		startcenter = new GLatLng(startlat, startlng);
		startmap.setCenter(new GLatLng(startcenter), 12);
		startmarker = new GMarker(startcenter, { draggable: true });
		startmap.addOverlay(startmarker);
		
		// Add the workplace marker to the endplace map
		endlat = $('endlat').value;
		endlng = $('endlng').value;
		endcenter = new GLatLng(endlat, endlng);
		endmap.setCenter(endcenter, 12);
		endmarker = new GMarker(endcenter, { draggable: true });
		endmap.addOverlay(endmarker);
		
		// Listen for address/map toggle
		Event.observe('startplace_map', 'click', function(e) {
			Event.stop(e);
			$('startmap_container').show();
			$('startaddress').hide();
			$('startplace_address').className = '';
			$('startplace_map').className = 'current';
			
			// Check to see if an address present
			if($('startaddress1') != '')
			{
				// Clear previous latitude and longitude
				$('startlat').value = '';
				$('startlng').value = '';
				getlatlng('start');
				
				// Check to see if the Latitude and Longitude values are finished rendering
				new PeriodicalExecuter(function(pe) 
				{
					if (($('startlat').value != '') && ($('startlng').value != ''))
					{
						// Move marker to the address typed in the form field
						startcenter = null;
						startcenter = new GLatLng($('startlat').value, $('startlng').value);
						startmarker.setLatLng(startcenter);
						startmap.checkResize();	
						startmap.setCenter(startcenter, 12);
						
						// Stop listening
						pe.stop();
					} 
				}, 0.25);
			}
			
			startmap.checkResize();	
			startmap.setCenter(startcenter, 12);
		});
		Event.observe('endplace_map', 'click', function(e) {
			Event.stop(e);
			$('endmap_container').show();
			$('endaddress').hide();
			$('endplace_address').className = '';
			$('endplace_map').className = 'current';
			
			// Check to see if an address present
			if($('endaddress1') != '')
			{
				// Clear previous latitude and longitude
				$('endlat').value = '';
				$('endlng').value = '';
				getlatlng('end');
				
				// Check to see if the Latitude and Longitude values are finished rendering
				new PeriodicalExecuter(function(pe) 
				{
					if (($('endlat').value != '') && ($('endlng').value != ''))
					{
						// Move marker to the address typed in the form field
						endcenter = null;
						endcenter = new GLatLng($('endlat').value, $('endlng').value);
						endmarker.setLatLng(endcenter);
						endmap.checkResize();	
						endmap.setCenter(endcenter, 12);
						
						// Stop listening
						pe.stop();
					} 
				}, 0.25);
			}
			
			endmap.checkResize();
			endmap.setCenter(endcenter, 12);
		});
		Event.observe('startplace_address', 'click', function(e) {
			Event.stop(e);
			$('startmap_container').hide();
			$('startaddress').show();	
			$('startplace_address').className = 'current';
			$('startplace_map').className = '';				
		});
		Event.observe('endplace_address', 'click', function(e) {
			Event.stop(e);
			$('endmap_container').hide();
			$('endaddress').show();	
			$('endplace_address').className = 'current';
			$('endplace_map').className = '';		
		});
		
		// Listen for the dragging of the end marker
		GEvent.addListener(startmarker,"dragend", function(startlatlng) 
		{
			// Update latitude and longitude form fields
			$('startlat').value = startlatlng.lat();
			$('startlng').value = startlatlng.lng();
			startcenter = null;
			startcenter = new GLatLng(startlatlng.lat(), startlatlng.lng());
			
			// Clear start address
			$('startplace').value = 'other';
			$('startaddress1').value = '';
			$('startaddress2').value = '';
			$('startcity').value = '';
			$('startstate').value = '';
			$('startzip').value = '';
		});
		
		// Listen for the dragging of the end marker
		GEvent.addListener(endmarker,"dragend", function(endlatlng) 
		{
			// Update latitude and longitude form fields
			$('endlat').value = endlatlng.lat();
			$('endlng').value = endlatlng.lng();
			endcenter = null;
			endcenter = new GLatLng(endlatlng.lat(), endlatlng.lng());
			
			// Clear end address
			$('endplace').value = 'other';
			$('endaddress1').value = '';
			$('endaddress2').value = '';
			$('endcity').value = '';
			$('endstate').value = '';
			$('endzip').value = '';
		});
		
		// Add additional map controls
		startmap.addControl(new GSmallMapControl());
		startmap.addControl(new GMapTypeControl());
		endmap.addControl(new GSmallMapControl());
		endmap.addControl(new GMapTypeControl());

	}
	
});

// GET PARK AND RIDE POST
function getParkAndRideAddressPost(e)
{
	// Prevent page refresh
	Event.stop(e);
	
	// Clear previous errors
	$('startaddress1').value = ''; 
	$('startaddress2').value = '';
	$('startcity').value = '';
	$('startstate').value = '';
	$('startzip').value = '';
	
	// Check to see if user has selected 'other'
	if(($F('startplace') != 'other') && ($F('startplace') != ''))
	{
	
		// Show indicator
		$('startplace_indicator').show();
	
		// Send AJAX request
		var url = 'pools.php?state=getparkandrideaddress&parkandride=' + $F('startplace');
		var ajax = new Ajax.Request( url, { method: 'post', onSuccess: getParkAndRideAddressResponse });
	
	}
}

// GET PARK AND RIDE RESPONSE
function getParkAndRideAddressResponse(resp)
{
	
	// Obtain JSON response
	var json = resp.responseText.evalJSON();
	
	// Populate workplace address
	$('startaddress1').value = json.address1;
	$('startaddress2').value = json.address2;
	$('startcity').value = json.city;
	$('startstate').value = json.state;
	$('startzip').value = json.zip;
	
	// Hide indicator
	$('startplace_indicator').hide();
	
}

// GET WORKPLACE POST
function getWorkplaceAddressPost(e)
{
	// Prevent page refresh
	Event.stop(e);
	
	// Clear previous errors
	$('endaddress1').value = ''; 
	$('endaddress2').value = '';
	$('endcity').value = '';
	$('endstate').value = '';
	$('endzip').value = '';
	
	// Check to see if user has selected 'other'
	if(($F('endplace') != 'other') && ($F('endplace') != ''))
	{
	
		// Show indicator
		$('endplace_indicator').show();
	
		// Send AJAX request
		var url = 'pools.php?state=getworkplaceaddress&workplace=' + $F('endplace');
		var ajax = new Ajax.Request( url, { method: 'post', onSuccess: getWorkplaceAddressResponse });
	
	}
}

// GET WORKPLACE RESPONSE
function getWorkplaceAddressResponse(resp)
{
	
	// Obtain JSON response
	var json = resp.responseText.evalJSON();
	
	// Populate workplace address
	$('endaddress1').value = json.address1;
	$('endaddress2').value = json.address2;
	$('endcity').value = json.city;
	$('endstate').value = json.state;
	$('endzip').value = json.zip;
	
	// Hide indicator
	$('endplace_indicator').hide();
	
}

// Get latitude and longitude via address
function getlatlng(place)
{
	if(place == 'start')
	{
		var address = $('startaddress1').value + ' ' + $('startcity').value + ' ' + $('startstate').value + ', ' + $('startzip').value; 
	} else {
		var address = $('endaddress1').value + ' ' + $('endcity').value + ' ' + $('endstate').value + ', ' + $('endzip').value; 
	}

	// Create Geocoder Object
	var geocoder = null;
	geocoder = new GClientGeocoder();

	if (geocoder) 
	{
		geocoder.getLatLng(address, function(point) 
		{
			if (point) 
			{
				if(place == 'start')
				{
					// Update latitude and longitude form fields
					$('startlat').value = point.lat();
					$('startlng').value = point.lng();
					
				} else {
					
					// Update latitude and longitude form fields
					$('endlat').value = point.lat();
					$('endlng').value = point.lng();

				}
			}
		}
	);
}}

// Get distance
function getdistance()
{
	//var dpanel = $('dpanel');
	
	// Specify start and end points
	var startpoint = $('startlat').value + ', ' + $('startlng').value;
	var endpoint = $('endlat').value + ', ' + $('endlng').value;
	var dstring = 'from: ' + startpoint + ' to: ' + endpoint;
	
	// Create new directions object
	var directions = new GDirections();
	directions.load(dstring);

	//GEvent.addListener(directions,"error", function() {
    //  alert("Directions failed: code "+directions.getStatus().code);
    //}; 
	
	// Wait for the directions object to finish
	GEvent.addListener( directions, "load", function() {

		// Calculate the distance
		var distance = directions.getDistance();	

		// Convert meters to miles
		$('distance').value = distance.meters * 0.000621371192237334;

	});

}


// CREATE POOL POST
function createPoolPost(e)
{
	// Prevent page refresh
	Event.stop(e);
	
	// Check for a starting address
	if($F('startaddress1') != null)
	{
		getlatlng('start');	
	}
	
	// Check for a starting address
	if($F('endaddress1') != null)
	{
		getlatlng('end');
	}

	// Check to see if the Latitude and Longitude values are finished rendering
	new PeriodicalExecuter(function(pe) 
	{
		if (($('startlat').value != '') && ($('startlng').value != '') && ($('endlat').value != '') && ($('endlng').value != ''))
		{
			// Get route distance
			getdistance();
			
			// Stop listening
			pe.stop();
		} 
	}, 0.25);
	
	// Check to see if the distance calculations are finished rendering
	new PeriodicalExecuter(function(pe) 
	{
		if ($('distance').value != '')
		{
			// Stop listening
			pe.stop();
			
			// Clear previous errors
			$('titleError').update(''); 
			$('startplaceError').update(''); 
			$('endplaceError').update('');
			
			// Send AJAX request
			var url = 'pools.php?state=addpool';
			var params = Form.serialize('myform');
			var ajax = new Ajax.Request( url, { method: 'post', postBody: params, onSuccess: createPoolResponse }); 
		} 
	}, 0.25);
}

function createPoolResponse(resp)
{
	// Obtain JSON response
	var json = resp.responseText.evalJSON();
	
	// If successful, goto step three (interests)
	if(json.status == 'success')
	{
		// Redirect user
		window.location = 'pools.php?confirmation=createpool';
	}
	
	// If errors, display errors
	if(json.status == 'failure')
	{
		if(json.error.title)     	{ $('titleError').update(json.error.title); }
		if(json.error.startplace)   { $('startplaceError').update(json.error.startplace); }
		if(json.error.endplace)     { $('endplaceError').update(json.error.endplace);}
	}	
}


