//////////////////////////////////////////////////////////////
// Title: dashboard.js										//
// Author: John Kuiphoff									//
// Description: Handles all project ajax requests			//
//////////////////////////////////////////////////////////////

// INITIAL EVENT LISTENERS
document.observe("dom:loaded", function() 
{
	// Get weather
	weatherGetConditionsPost();

	// Initialize an automatic timer
    weatherTimer = new PeriodicalExecuter(weatherGetConditionsPost, 900);
	
	// Default Loading Status
	$('weatherstatus').update('Loading...');
	
});

// GET WEATHER CONDITIONS POST
function weatherGetConditionsPost(feed)
{
	// Send Ajax Request
	var url = 'dashboard.php?state=getweather';
	var ajax = new Ajax.Request( url, { method: 'post', onSuccess: weatherGetConditionsResponse });
}

// GET WEATHER CONDITIONS RESPONSE
function weatherGetConditionsResponse(resp)
{
	// Obtain JSON message
	var json = resp.responseText.evalJSON();

	// Append current conditions
	$('weatherstatus').update('Current Conditions: ');
	$('weathertemp').update(json.temp[0] + "&deg;");
	$('weathertext').update(json.text[0]);
}
