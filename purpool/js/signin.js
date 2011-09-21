//////////////////////////////////////////////////////////////
// Title: signin.js											//
// Author: John Kuiphoff									//
// Description: Handles all project ajax requests			//
//////////////////////////////////////////////////////////////

// INITIAL EVENT LISTENERS
document.observe("dom:loaded", function() 
{
	
	// Listen for new project submission
	Event.observe('signinForm', 'submit', signinPost);
	
	// Initialize Login Form
	var signinForm = new Formfocus('signinForm');
		
	// Focus first element
	signinForm.focusFirst();
	
	// Initialize AJAX indicator
	new Indicator();

});

// SIGNIN POST
function signinPost(e)
{
	// Prevent page refresh
	Event.stop(e);

	// Clear previous error messages
	$('usernameError').update(''); $('usernameError').hide();
	$('userpassError').update(''); $('userpassError').hide();
	$('invaliduserError').update(''); $('invaliduserError').hide();
	
	// Send AJAX request
	var url = 'signin.php?state=signin';
	var params = Form.serialize('signinForm');
	var ajax = new Ajax.Request( url, { method: 'post', postBody: params, onSuccess: signinResponse });	
}

// SIGNIN RESPONSE
function signinResponse(resp)
{
	// Obtain JSON response
	var json = resp.responseText.evalJSON();

	// If success, redirect to administrator
	if (json.status == 'success')
	{
		window.location = 'dashboard.php';
	}
	
	// If failure, display errors
	if (json.status == 'failure')
	{
		if(json.error.username)    { $('usernameError').update(json.error.username); Effect.Appear('usernameError'); }
		if(json.error.userpass)    { $('userpassError').update(json.error.userpass); Effect.Appear('userpassError'); }
		if(json.error.invaliduser) { $('invaliduserError').update(json.error.invaliduser); Effect.Appear('invaliduserError'); }
	}
}
