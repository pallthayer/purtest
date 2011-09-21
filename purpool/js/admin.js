//////////////////////////////////////////////////////////////
// Title: register.js										//
// Author: John Kuiphoff									//
// Description: Handles all project ajax requests			//
//////////////////////////////////////////////////////////////

// INITIAL EVENT LISTENERS
document.observe("dom:loaded", function() 
{
	
	// Initialize AJAX indicator
	new Indicator();

});

// UPDATE GENERAL POST
function updateGeneralPost(e)
{
	// Prevent page refresh
	Event.stop(e);

	// Clear previous error messages
	$('usernameError').update(''); $('usernameError').hide();
	$('userpassError').update(''); $('userpassError').hide();
	$('firstnameError').update(''); $('firstnameError').hide();
	$('lastnameError').update(''); $('lastnameError').hide();
	$('emailError').update(''); $('emailError').hide();
	$('phoneError').update(''); $('phoneError').hide();
	
	// Send AJAX request
	var url = 'register.php?state=updategeneral';
	var params = Form.serialize('profileGeneral');
	var ajax = new Ajax.Request( url, { method: 'post', postBody: params, onSuccess: updateGeneralResponse });	
}

// UPDATE GENERAL RESPONSE
function updateGeneralResponse(resp)
{
	// Obtain JSON response
	var json = resp.responseText.evalJSON();

	// If success, show confirmation
	if (json.status == 'success')
	{
		alert('temporary : you are registered');
	}
	
	// If failure, display errors
	if (json.status == 'failure')
	{
		if(json.error.username)  { $('usernameError').update(json.error.username); Effect.Appear('usernameError'); }
		if(json.error.userpass)  { $('userpassError').update(json.error.userpass); Effect.Appear('userpassError'); }
		if(json.error.firstname) { $('firstnameError').update(json.error.firstname); Effect.Appear('firstnameError'); }
		if(json.error.lastname)  { $('lastnameError').update(json.error.lastname); Effect.Appear('lastnameError'); }
		if(json.error.email)     { $('emailError').update(json.error.email); Effect.Appear('emailError'); }
		if(json.error.phone)     { $('phoneError').update(json.error.phone); Effect.Appear('phoneError');}
		if(json.error.make)      { $('makeError').update(json.error.make); Effect.Appear('makeError');}
	}
}
