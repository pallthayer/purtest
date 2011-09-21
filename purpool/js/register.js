//////////////////////////////////////////////////////////////
// Title: register.js										//
// Author: John Kuiphoff									//
// Description: Handles all project ajax requests			//
//////////////////////////////////////////////////////////////

// INITIAL EVENT LISTENERS
document.observe("dom:loaded", function() 
{
	
	// Initialize Login Form
	var projectForm = new Formfocus('myform');
			
	// Focus first element
	projectForm.focusFirst();
	
	// Listen for new project submission
	//Event.observe('myform', 'submit', function(e) 	
	//	{ 
			//$('submit').disable();
	//	}
	//);

	

});