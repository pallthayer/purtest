//////////////////////////////////////////////////////////////
// Title: pool-members.js									//
// Author: John Kuiphoff									//
// Description: Handles all project ajax requests			//
//////////////////////////////////////////////////////////////

// INITIAL EVENT LISTENERS
document.observe("dom:loaded", function() 
{
	
	// Initialize Members Form
	var membersForm = new Formfocus('myform');
			
	// Focus first element
	membersForm.focusFirst();
	
	// Initialize autocomplete
	new Ajax.Autocompleter("email", "autocomplete_choices", "pools.php?state=getinviteemail", { tokens: [',', ', ', ' '] });
	
});