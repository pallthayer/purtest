//////////////////////////////////////////////////////////////
// Title: formfocus.js										//
// Author: John Kuiphoff									//
// Description: Assists in general form behaviors			//
//////////////////////////////////////////////////////////////

// FORM FOCUS CLASS
var Formfocus = Class.create({

	initialize: function(frm)
	{
		
		this.frm = frm;
		
		// Get all form elements
		var frmElements = Form.getElements(this.frm);
		
		// Set up a listener for each element
		for(var i=0; i < frmElements.length; i++)
		{
			if((frmElements[i].type == 'text') || (frmElements[i].type == 'select') || (frmElements[i].type == 'password')|| (frmElements[i].type == 'textarea'))
			{
				Event.observe(frmElements[i], 'blur', this.blurInput.bindAsEventListener(this, frmElements[i]));
				Event.observe(frmElements[i], 'focus', this.focusInput.bindAsEventListener(this, frmElements[i]));
			}
		}
	},
	
	// HIGHLIGHTS FIELD
	focusInput: function(e, elm)
	{
		Element.setStyle(elm, {borderColor: '#939'});
	},
	
	// UNHIGHLIGHTS FIELD
	blurInput: function(e, elm)
	{
		Element.setStyle(elm, {borderColor: '#cccccc'});
	},
	
	// FOCUSES FIRST ELEMENT
	focusFirst: function()
	{
		Form.focusFirstElement(this.frm);
	},
	
	// RESET FORM
	resetForm: function()
	{
		Form.reset(this.frm);
	}
	
});
