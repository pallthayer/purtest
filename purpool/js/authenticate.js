//////////////////////////////////////////////////////////////
// Title: authenticate.js									//
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

});

// SIGNIN POST
function signinPost(e)
{
	// Prevent page refresh
	Event.stop(e);

	// Clear previous error messages
	$('emailError').update(''); 
	$('userpassError').update(''); 
	$('invaliduserError').update('');
	
	// Send AJAX request
	var url = 'authenticate.php?state=signin';
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
		// If the admin is logging in to the administrator account, redirect to admin
		// Otherwise, redirect to member account
		if(json.usertype == 'admin')
		{
			window.location = 'admin.php';
		} else {
			window.location = 'dashboard.php';
		}
		
	}
	
	// If failure, display errors
	if (json.status == 'failure')
	{
		if(json.error.email)    { $('emailError').update(json.error.email);  }
		if(json.error.userpass)    { $('userpassError').update(json.error.userpass);  }
		if(json.error.invaliduser) { $('invaliduserError').update(json.error.invaliduser);  }
	}
}