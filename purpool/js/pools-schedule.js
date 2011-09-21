// INITIAL EVENT LISTENERS
document.observe("dom:loaded", function() 
{
	
	// Listen for driver selection
	if($('mondayform')) { Event.observe('mondayform', 'submit', updateItineraryPost.bindAsEventListener(this, 'monday')); }
	if($('tuesdayform')) { Event.observe('tuesdayform', 'submit', updateItineraryPost.bindAsEventListener(this, 'tuesday')); }
	if($('wednesdayform')) { Event.observe('wednesdayform', 'submit', updateItineraryPost.bindAsEventListener(this, 'wednesday')); }
	if($('thursdayform')) { Event.observe('thursdayform', 'submit', updateItineraryPost.bindAsEventListener(this, 'thursday')); }
	if($('fridayform')) { Event.observe('fridayform', 'submit', updateItineraryPost.bindAsEventListener(this, 'friday')); }
	if($('saturdayform')) { Event.observe('saturdayform', 'submit', updateItineraryPost.bindAsEventListener(this, 'saturday')); }
	if($('sundayform')) { Event.observe('sundayform', 'submit', updateItineraryPost.bindAsEventListener(this, 'sunday')); }
	
});

var submitted = 0;
var saveAll = false;

function finalizeWeek(){
	//Modified by Peter on 02/22/2010
	//Instead of sending ajax requests for each day create one big request. Need to serialize all the data - concatenating the data from the day forms is tricky.
	saveAll = true;
	// Send AJAX request
	var url = 'pools.php?state=saveweekitinerary';
	var params="";
	var oneDayObject, oneDayString;
	//Loop over days of week that are part of the recurring schedule
	for(var i = 0; i < document.forms.length; i++) {
		//Need to prefix fields with day of week. Some already have this prefix in the form markup. This facilitates giving each field a unique name before sending to server
		oneDayObject = Form.serialize(document.forms[i].id, getHash=true);
		oneDayString = Form.serialize(document.forms[i].id, getHash=false);
		oneDayString = oneDayString.replace(/route/gi, oneDayObject.day + "_route");
	    oneDayString = oneDayString.replace(/driver/gi, oneDayObject.day + "_driver");
		oneDayString = oneDayString.replace(/day=/gi, oneDayObject.day + "_day=");
		oneDayString = oneDayString.replace(/rdate/gi, oneDayObject.day + "_rdate");
		params = params + oneDayString;
		if(i < document.forms.length-1){
			params += "&";
		}
		
	} 
	//alert(params);
	//toQueryParams is a prototype string method that converts a string ready for post or get to an associative array. This works well with the protoype Ajax.Request method
	var data = params.toQueryParams();
	//alert(data.monday_rdate);
	var ajax = new Ajax.Request( url, { method: 'post', parameters: data, onSuccess: updateItineraryResponseAll });
	$('_indicator').show();
	//var params = Form.serialize("monday" + 'form');
	//var ajax = new Ajax.Request( url, { method: 'post', postBody: params, onSuccess: updateItineraryResponse });
	
}

// UPDATE ITINERARY POST
function updateItineraryPost(e, day)
{
	// Prevent page refresh
	Event.stop(e);
	
	// Send AJAX request
	var url = 'pools.php?state=saveitinerary';
	var params = Form.serialize(day + 'form');
	var ajax = new Ajax.Request( url, { method: 'post', postBody: params, onSuccess: updateItineraryResponse });
	
	// Clear previous errors
	if($('mondayDriverError')) { $('mondayDriverError').update(''); }
	if($('mondayRouteError')) { $('mondayRouteError').update(''); }
	if($('tuesdayDriverError')) { $('tuesdayDriverError').update(''); } 
	if($('tuesdayRouteError')) { $('tuesdayRouteError').update(''); }
	if($('wednesdayDriverError')) { $('wednesdayDriverError').update(''); } 
	if($('wednesdayRouteError')) { $('wednesdayRouteError').update(''); }
	if($('thursdayDriverError')) { $('thursdayDriverError').update(''); }
	if($('thursdayRouteError')) { $('thursdayRouteError').update(''); }
	if($('fridayDriverError')) { $('fridayDriverError').update(''); }
	if($('fridayRouteError')) { $('fridayRouteError').update(''); }
	if($('saturdayDriverError')) { $('saturdayDriverError').update(''); } 
	if($('saturdayRouteError')) { $('saturdayRouteError').update(''); }
	if($('sundayDriverError')) { $('sundayDriverError').update(''); }
	if($('sundayRouteError')) { $('sundayRouteError').update(''); }
	
	// Show Indicator
	$(day + '_indicator').show();
	$(day + '_submit').hide();

}

// UPDATE ITINERARY RESPONSE
function updateItineraryResponse(resp)
{

	// Obtain JSON response
	var json = resp.responseText.evalJSON();
	
	// If successful
	if(json.status == 'success')
	{
		// Hide Indicator
		if(!saveAll) window.location.reload();
		//$(json.day + '_indicator').hide();
		//$(json.day + '_submit').show();
	}
	
	// If failure
	if(json.status == 'failure')
	{
		// Hide Indicator
		$(json.day + '_indicator').hide();
		$(json.day + '_submit').show();
		
		if(json.day == 'monday')
		{
			if(json.error.driver) { $('mondayDriverError').update(json.error.driver); }
			if(json.error.route) { $('mondayRouteError').update(json.error.route); }
		}
		if(json.day == 'tuesday')
		{
			if(json.error.driver) { $('tuesdayDriverError').update(json.error.driver); }
			if(json.error.route) { $('tuesdayRouteError').update(json.error.route); }
		}
		if(json.day == 'wednesday')
		{
			if(json.error.driver) { $('wednesdayDriverError').update(json.error.driver); }
			if(json.error.route) { $('wednesdayRouteError').update(json.error.route); }
		}
		if(json.day == 'thursday')
		{
			if(json.error.driver) { $('thursdayDriverError').update(json.error.driver); }
			if(json.error.route) { $('thursdayRouteError').update(json.error.route); }
		}
		if(json.day == 'friday')
		{
			if(json.error.driver) { $('fridayDriverError').update(json.error.driver); }
			if(json.error.route) { $('fridayRouteError').update(json.error.route); }
		}
		if(json.day == 'saturday')
		{
			if(json.error.driver) { $('saturdayDriverError').update(json.error.driver); }
			if(json.error.route) { $('saturdayRouteError').update(json.error.route); }
		}
		if(json.day == 'sunday')
		{
			if(json.error.driver) { $('sundayDriverError').update(json.error.driver); }
			if(json.error.route) { $('sundayRouteError').update(json.error.route); }
		}
	}
}

// UPDATE ITINERARY RESPONSE ALL
function updateItineraryResponseAll(resp)
{

	// Obtain JSON response
	var json = resp.responseText.evalJSON();
	
	// If successful
	if(json.status == 'success')
	{
		window.location.reload();
		var i;
		//alert("Success");
		/*
		for(i=0;i<json.day.length;i++){
			$(json.day[i] + '_indicator').hide();
			$(json.day[i] + '_submit').show();
		}*/
		
	}
	
	// If failure
	if(json.status == 'failure')
	{
		//alert("failure");
		// Hide Indicator
		$('_indicator').hide();
		//$(json.day + '_submit').show();
		
		//alert(json.error.monday.driver);
		for(i=0;i<json.day.length;i++){
			if(json.day[i] == 'monday')
			{
				if(json.error.monday.driver) { $('mondayDriverError').update(json.error.driver); }
				if(json.error.monday.route) { $('mondayRouteError').update(json.error.route); }
			}
			if(json.day[i] == 'tuesday')
			{
				if(json.error.tuesday.driver) { $('tuesdayDriverError').update(json.error.driver); }
				if(json.error.tuesday.route) { $('tuesdayRouteError').update(json.error.route); }
			}
			if(json.day[i] == 'wednesday')
			{
				if(json.error.wednesday.driver) { $('wednesdayDriverError').update(json.error.driver); }
				if(json.error.wednesday.route) { $('wednesdayRouteError').update(json.error.route); }
			}
			if(json.day[i] == 'thursday')
			{
				if(json.error.thursday.driver) { $('thursdayDriverError').update(json.error.driver); }
				if(json.error.thursday.route) { $('thursdayRouteError').update(json.error.route); }
			}
			if(json.day[i] == 'friday')
			{
				if(json.error.friday.driver) { $('fridayDriverError').update(json.error.driver); }
				if(json.error.friday.route) { $('fridayRouteError').update(json.error.route); }
			}
			if(json.day[i] == 'saturday')
			{
				if(json.error.saturday.driver) { $('saturdayDriverError').update(json.error.driver); }
				if(json.error.saturday.route) { $('saturdayRouteError').update(json.error.route); }
			}
			if(json.day[i] == 'sunday')
			{
				if(json.error.sunday.driver) { $('sundayDriverError').update(json.error.driver); }
				if(json.error.sunday.route) { $('sundayRouteError').update(json.error.route); }
			}
		}
	}
}


// CONFIRM POST
function confirmPost(confirmation, pool, rdate)
{

	// Send AJAX request
	var url = 'pools.php?state=confirmitinerary&pool=' + pool + '&confirmation=' + confirmation + '&rdate=' + rdate;
	
	var ajax = new Ajax.Request( url, { method: 'post', onSuccess: function(){window.location.reload();} });

	// Change confirmation class
	if(confirmation == 'accept')
	{
		$(rdate + '_accept').className = 'accept';
		$(rdate + '_decline').className = '';
		
		$(rdate + '_usericon').update('<img class="icon" title="Confirmed" src="icons/confirmed.gif" />');
	}
	if(confirmation == 'decline')
	{
		$(rdate + '_accept').className = '';
		$(rdate + '_decline').className = 'decline';
		
		$(rdate + '_usericon').update('<img class="icon" title="Declined" src="icons/declined.gif" />');
	}

}
