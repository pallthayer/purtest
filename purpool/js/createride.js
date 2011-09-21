//////////////////////////////////////////////////////////////
// Title: createride.js										//
// Author: John Kuiphoff									//
// Description: Handles all project ajax requests			//
//////////////////////////////////////////////////////////////

// INITIAL EVENT LISTENERS
document.observe("dom:loaded", function() 
{
	
	// Initialize Login Form
	var rideForm = new Formfocus('rideForm');
		
	// Focus first element
	rideForm.focusFirst();
	
	// Listen for destination status
	Event.observe('endPlace', 'change', function(e) {
		
		// PEPSI Destination
		if($F('endPlace') == 'pepsi')
		{
			$('endAddress1').value = '700 Anderson Hill Road';
			$('endCity').value = 'Purchase';
			$('endState').value = 'NY';
			$('endZip').value = '10577';
		}
		
		// OTHER Destination
		if($F('endPlace') == 'other')
		{
			$('endAddress1').value = '';
			$('endCity').value = '';
			$('endState').value = '';
			$('endZip').value = '';
		}
		
	});
	
	// Listen for ride type status
	Event.observe('typeRound', 'change', function(e) { $('endDepart').show(); });
	Event.observe('typeOneWay', 'change', function(e) { $('endDepart').hide(); });
	
	// Initialize AJAX indicator
	new Indicator();

});