//////////////////////////////////////////////////////////////
// Title: register-car.js									//
// Author: John Kuiphoff									//
// Description: Handles all project ajax requests			//
//////////////////////////////////////////////////////////////

// INITIAL EVENT LISTENERS
document.observe("dom:loaded", function() 
{
	
	// Initialize Login Form
	var carForm = new Formfocus('myform');
			
	// Focus first element
	carForm.focusFirst();
	
	// Create event handlers
	Event.observe('year', 'change', getMakePost);
	Event.observe('color', 'change', function(e) 
	{ 
		// Clear previous color error
		if($F('color') != '') 
		{ 
			$('colorError').update(''); 
		} 
	});
	
	// Listen for 'own vehicle' setting
	Event.observe('ownvehicle_yes', 'change', showHideVehicles);
	Event.observe('ownvehicle_no', 'change', showHideVehicles);
	
	// Listen for form submission
	Event.observe('myform', 'submit', updateVehiclePost);
	
	// Reset form fields 
	$('seats').value = ''; 
	$('year').value = ''; 
	$('color').value = ''; 
	$('make').value = ''; 
	$('model').value = ''; 
	$('trans').value = '';
	$('cylinders').value = '';
	$('mpg').value = '';
	$('emissions').value = '';

});

// OWN VEHICLE SETTINGS
function showHideVehicles()
{
	if($('ownvehicle_yes').checked == true)
	{
		// Show form
		$('vehiclewrapper').show();
	} else {
		// Hide form
		$('vehiclewrapper').hide();
		
		// Reset values
		$('year').value = ''; 
		$('color').value = ''; 
		$('make').value = ''; 
		$('model').value = ''; 
		$('trans').value = '';
		$('cylinders').value = '';
		$('mpg').value = '';
		$('emissions').value = '';
	}
}

// UPDATE VEHICLE INFORMATION
function updateVehiclePost(e)
{
	// Prevent page refresh
	Event.stop(e);
	
	// Clear previous errors
	$('seatsError').update(''); 
	$('colorError').update(''); 
	$('yearError').update('');
	$('makeError').update(''); 
	$('modelError').update(''); 
	$('transError').update('');
	$('cylindersError').update(''); 
	$('mpgError').update(''); 
	$('emissionsError').update(''); 
	
	// Send AJAX request
	var url = 'register.php?state=updatevehicle';
	var params = Form.serialize('myform');
	var ajax = new Ajax.Request( url, { method: 'post', postBody: params, onSuccess: updateVehicleResponse });
}

// UPDATE VEHICLE RESPONSE
function updateVehicleResponse(resp)
{

	// Obtain JSON response
	var json = resp.responseText.evalJSON();
	
	// If successful, goto step three (interests)
	if(json.status == 'success')
	{
		window.location ='register.php?state=interests';	
	}
	
	// If errors, display errors
	if(json.status == 'failure')
	{
		if(json.error.seats)     { $('seatsError').update(json.error.seats); }
		if(json.error.color)     { $('colorError').update(json.error.color); }
		if(json.error.year)      { $('yearError').update(json.error.year);}
		if(json.error.make)      { $('makeError').update(json.error.make); }
		if(json.error.model)     { $('modelError').update(json.error.model); }
		if(json.error.trans)     { $('transError').update(json.error.trans);}
		if(json.error.cylinders) { $('cylindersError').update(json.error.cylinders); }
		if(json.error.mpg)       { $('mpgError').update(json.error.mpg); }
		if(json.error.emissions) { $('emissionsError').update(json.error.emissions); }
	}
}

// GET CAR MAKE POST
function getMakePost(e)
{
	
	// Prevent page refresh
	Event.stop(e);
	
	// Send AJAX request
	var url = 'register.php?state=getmake&year=' + $F('year');
	var ajax = new Ajax.Request( url, { method: 'post', onSuccess: getMakeResponse });
	
	// Reset form fields
	$('make').value = ''; $('make').disable();
	$('model').value = ''; $('model').disable();
	$('trans').value = ''; $('trans').disable();
	$('cylinders').value = ''; $('cylinders').disable();
	$('mpg').value = ''; $('mpg').disable();
	$('emissions').value = ''; $('emissions').disable();
	
	// Clear previous errors
	if($F('year') != '') { $('yearError').update(''); } 
	
	// Show make indicator
	$('make_indicator').show();
	
}

// GET CAR MAKE RESPONSE
function getMakeResponse(resp)
{

	// Obtain JSON response
	var json = resp.responseText.evalJSON();
	
	// Insert select box options
	$('make').replace(json.contents);
	
	// Create event handler
	Event.observe('make', 'change', getModelPost);
	
	// Enable select box
	$('make').enable();
	
	// Hide make indicator
	$('make_indicator').hide();
}

// GET CAR MODEL POST
function getModelPost(e)
{
	
	// Prevent page refresh
	Event.stop(e);
	
	// Send AJAX request
	var url = 'register.php?state=getmodel&make=' + $F('make') + '&year=' + $F('year');
	var ajax = new Ajax.Request( url, { method: 'post', onSuccess: getModelResponse });
	
	// Reset form fields
	$('model').value = ''; $('model').disable();
	$('trans').value = ''; $('trans').disable();
	$('cylinders').value = ''; $('cylinders').disable();
	$('mpg').value = ''; $('mpg').disable();
	$('emissions').value = ''; $('emissions').disable();
	
	// Clear previous errors
	if($F('make') != '') { $('makeError').update(''); }
	
	// Show model indicator
	$('model_indicator').show();
	
}

// GET CAR MODEL RESPONSE
function getModelResponse(resp)
{

	// Obtain JSON response
	var json = resp.responseText.evalJSON();
	
	// Insert select box options
	$('model').replace(json.contents);
	
	// Create event handler
	Event.observe('model', 'change', getTransPost);
	
	// Enable select box
	$('model').enable();
	
	// Hide model indicator
	$('model_indicator').hide();
	
}

// GET CAR TRANS POST
function getTransPost(e)
{
	
	// Prevent page refresh
	Event.stop(e);
	
	// Send AJAX request
	var url = 'register.php?state=gettrans&make=' + $F('make') + '&model=' + $F('model') + '&year=' + $F('year');
	var ajax = new Ajax.Request( url, { method: 'post', onSuccess: getTransResponse });
	
	// Reset form fields
	$('trans').value = ''; $('trans').disable();
	$('cylinders').value = ''; $('cylinders').disable();
	$('mpg').value = ''; $('mpg').disable();
	$('emissions').value = ''; $('emissions').disable();
	
	// Clear previous errors
	if($F('model') != '') { $('modelError').update(''); }
	
	// Show model indicator
	$('trans_indicator').show();
	
}

// GET CAR TRANS RESPONSE
function getTransResponse(resp)
{

	// Obtain JSON response
	var json = resp.responseText.evalJSON();
	
	// Insert select box options
	$('trans').replace(json.contents);
	
	// Create event handler
	Event.observe('trans', 'change', getCylindersPost);
	
	// Enable select box
	$('trans').enable();
	
	// Hide model indicator
	$('trans_indicator').hide();
	
}

// GET CAR CYLINDERS POST
function getCylindersPost(e)
{
	
	// Prevent page refresh
	Event.stop(e);
	
	// Send AJAX request
	var url = 'register.php?state=getcylinders&make=' + $F('make') + '&model=' + $F('model') + '&trans=' + $F('trans') + '&year=' + $F('year');
	var ajax = new Ajax.Request( url, { method: 'post', onSuccess: getCylindersResponse });
	
	// Reset form fields
	$('cylinders').value = ''; $('cylinders').disable();
	$('mpg').value = ''; $('mpg').disable();
	$('emissions').value = ''; $('emissions').disable();
	
	// Clear previous errors
	if($F('trans') != '') { $('transError').update(''); }
	
	// Show model indicator
	$('cylinders_indicator').show();
	
}

// GET CAR CYLINDERS RESPONSE
function getCylindersResponse(resp)
{

	// Obtain JSON response
	var json = resp.responseText.evalJSON();
	
	// Insert select box options
	$('cylinders').replace(json.contents);
	
	// Create event handler
	Event.observe('cylinders', 'change', getMpgPost);
	
	// Enable select box
	$('cylinders').enable();
	
	// Hide model indicator
	$('cylinders_indicator').hide();
	
}

// GET CAR MPG POST
function getMpgPost(e)
{
	
	// Prevent page refresh
	Event.stop(e);
	
	// Send AJAX request
	var url = 'register.php?state=getmpg&make=' + $F('make') + '&model=' + $F('model') + '&trans=' + $F('trans') + '&cylinders=' + $F('cylinders') + '&year=' + $F('year');
	var ajax = new Ajax.Request( url, { method: 'post', onSuccess: getMpgResponse });
	
	// Reset form fields
	$('mpg').value = ''; $('mpg').disable();
	$('emissions').value = ''; $('emissions').disable();
	
	// Clear previous errors
	if($F('cylinders') != '') { $('cylindersError').update(''); }
	
	// Show mpg/emissions indicator
	$('mpg_indicator').show();
	$('emissions_indicator').show();
	
}

// GET CAR MPG RESPONSE
function getMpgResponse(resp)
{

	// Obtain JSON response
	var json = resp.responseText.evalJSON();
	
	// Insert mpg
	$('mpg').value = json.mpg;
	
	// Insert emissions
	$('emissions').value = json.emissions;
	
	// Enable fields
	$('mpg').enable();
	$('emissions').enable();
	
	// Hide mpg/emissions indicator
	$('mpg_indicator').hide();
	$('emissions_indicator').hide();
	
}