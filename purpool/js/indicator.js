//////////////////////////////////////////////////////////////
// Title: indicator.js										//
// Author: John Kuiphoff									//
// Description: Shows/hides ajax indicator					//
//////////////////////////////////////////////////////////////

var Indicator = Class.create({
	
	initialize: function()
	{
		// Listen for mousemove event. 
		Event.observe(document, "mousemove", this.moveindicator);

		// Create handles
		var indicatorhandlers = 
		{ 
			onCreate: function() 
			{
				// Listen for mousemove event. 
				Element.show('indicator'); 
			},

			onComplete: function() 
			{
				if(Ajax.activeRequestCount == 0)
				{
					Effect.Fade('indicator');
				}
			}
		};
		
		Ajax.Responders.register(indicatorhandlers);
	},
	
	showindicator: function(e)
	{
		// Listen for mousemove event. 
		Event.observe(document, "mousemove", this.moveindicator);
		Element.show('indicator'); 
	},
	
	moveindicator: function(e) 
	{
		// Get mouse coordinates and add offset value
		var mouse_x = Event.pointerX(e) + 15;
		var mouse_y = Event.pointerY(e) - 15;

		// Attach indicator to mouse position.
		Element.setStyle('indicator', { position: "absolute", top: mouse_y + "px", left: mouse_x + "px", zIndex: 10000 });
	}
	
}); 