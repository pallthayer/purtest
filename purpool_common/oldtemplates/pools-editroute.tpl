<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects,controls"></script>
<script language="javascript" src="js/formfocus.js"></script>

<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key={$google_key}" type="text/javascript"></script>
<script src="js/icons.js"></script>
<script language="javascript" src="js/routemaker.js"></script>

{literal}

<script type="text/javascript">
function html_entity_decode(s) {
	var t=document.createElement('textarea');
	t.innerHTML = s;
	var v = t.value;
	t.hide();
	return v;
}
</script>

{/literal}

<script type="text/javascript">

		// Populate end address
		var endaddress = '{$endaddress} {$endcity}, {$endstate} {$endzip}';
		var endlat = '{$endlat}';
		var endlng = '{$endlng}';
		
		//var geopositions = '["41.2206,-73.81359", "41.159012,-73.754654", "41.097206,-73.725128", "41.052949,-73.722382", "41.0192,-73.69905"]';
		var geopositions = '{$vertices}';
		
		// Get route
		var route = '{$route}';
		var title = html_entity_decode('{$title}');
	
</script>

{literal}
<script type="text/javascript">

// INITIAL EVENT LISTENERS
document.observe("dom:loaded", function() 
{
	// Load Map
	if (GBrowserIsCompatible()) {
         loadGMap(endlat, endlng);
		 //drawDirections(geopositions);
		 drawDirections(geopositions.evalJSON());
    }
	
	// Initialize Pool Form
	var routeForm = new Formfocus('myform');
			
	// Focus first element
	routeForm.focusFirst();
	
	// Listen for adding a point via click
	//Event.observe('addpoint', 'click', getStartAddress);
	
	// Listen for form submission
	Event.observe('myform', 'submit', addRoutePost);
	
	// Listen for start address fields
	Event.observe('startaddress', 'change', checkRoute);
	Event.observe('startcity', 'change', checkRoute);
	Event.observe('startstate', 'change', checkRoute);
	
	// Add ending point to map
	addStreetAddressToRoute(endaddress);

});

// CHECK START ADDRESS
function checkRoute()
{
	// Check to see if all required fields are inputted
	if(($('startaddress').value != '') && ($('startcity').value != '') && ($('startstate').value != ''))
	{
		// Get starting point string
		var startaddress = $('startaddress').value + ' ' + $('startcity').value + ' ' + $('startstate').value + ' ' + $('startzip').value;
		
		// Add starting point to map
		addStreetAddressToRoute(startaddress);
	}
}

// PLOT STARTING POINT TO MAP
function getStartAddress(e)
{
	// Prevent form submission
	Event.stop(e);
	
	// Get starting point string
	var startaddress = $('startaddress').value + ' ' + $('startcity').value + ' ' + $('startstate').value + ' ' + $('startzip').value;
	
	// Add starting point to map
	addStreetAddressToRoute(startaddress);
	
}

// ADD ROUTE POST
function addRoutePost(e)
{
	// Prevent form submission
	Event.stop(e);
	
	// Get distance
	var distance = getDistance();
	
	// Get vertices
	var vertices = getDirectionsInJSON();
	
	// Check to see if the distance calculation is finished rendering
	new PeriodicalExecuter(function(pe) 
	{
		if ((distance != '') && (vertices != ''))
		{
			// Place distance in a hidden form variable
			$('distance').value = distance;
			$('vertices').value = vertices;
			
			// Stop listening
			pe.stop();
			
			// Clear previous errors
			$('titleError').update(''); 
			$('startplaceError').update(''); 
			
			// Send AJAX request
			var url = 'pools.php?state=saveroute&pool=' + $('pool').value + '&route=' + route;
			var params = Form.serialize('myform');
			var ajax = new Ajax.Request( url, { method: 'post', postBody: params, onSuccess: addRouteResponse }); 
		} 
	}, 0.25);
}

// ADD ROUTE RESPONSE
function addRouteResponse(resp)
{
	// Obtain JSON response
	var json = resp.responseText.evalJSON();
	
	// If successful, goto step three (interests)
	if(json.status == 'success')
	{
		// Redirect user
		window.location = 'pools.php?state=viewroutes&pool=' + json.pool + '&confirmation=editroute';
	}
	
	// If errors, display errors
	if(json.status == 'failure')
	{
		if(json.error.title)     	{ $('titleError').update(json.error.title); }
		if(json.error.startplace)   { $('startplaceError').update(json.error.startplace); }
	}	
}

</script>
{/literal}
</head>

<body>

	<!-- Header -->
    <div id="header">
    	<a href="/" id="logo"><h1>Purpool</h1></a>
    </div>
    
	<!-- Top Navigation -->
   	{include file="topnavigation.tpl"}

	
    
    	<!-- Content Bar -->
        <div id="contentbar">
        
            <!-- Page Heading -->
            <h2>Pools</h2>
            
			<!-- Tabs -->
			<div id="tabs">
                <ul>
                    <li class="current"><a href="pools.php">View Pools</a></li>
                    <li><a href="pools.php?state=browsepools">Browse Pools</a></li>
                </ul>
            </div>
        </div>
        
            

        
		<div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
                
	        <h3 style="margin-bottom:0;">{$poolname}</h3>
            <div id="wizard">
                <ul>
                    <li ><a href="pools.php?state=viewprofile&pool={$pool_id}">Profile</a></li>
                    
                    {if $editmode}<li><a href="pools.php?state=editschedule&pool={$pool_id}">Scheduler</a></li>{/if}
                    <li><a href="pools.php?state=viewschedule&pool={$pool_id}">Upcoming Rides</a></li>
                    <li><a href="pools.php?state=shoutbox&pool={$pool_id}">Shoutbox</a></li>
                    {if $editmode}<li><a href="pools.php?state=editpool&pool={$pool_id}">Edit General</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=editmembers&pool={$pool_id}">Edit Members</a></li>{/if}
                    {if $editmode}<li class="current"><a href="pools.php?state=viewroutes&pool={$pool_id}">Edit Routes</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=deletepool&pool={$pool_id}">Delete Pool</a></li>{/if}
                </ul>
            </div>
            
        	<!-- Route maker map -->
            <div id="map" style="width: 400px; height: 400px; float: right; margin-left: 20px; margin-right: 20px; border: 1px solid #5d1db8;"></div>
        	<br /><br /><br />
        	<!-- Instructions -->
            <p>Enter the starting point of your route by typing in the address below or by 
            clicking on the map. A route to your workplace should appear on the map. You 
            can customize your route by dragging and releasing.</p> 
            
            <!-- Create Route Form -->
            <form id="myform">

                <!-- Pool id -->
                <input id="pool" name="pool" type="hidden" value="{$pool_id}" />
                
                <!-- Distance and vertices -->
                <input id="distance" name="distance" type="hidden" value="{$distance}" />
                <input id="vertices" name="vertices" type="hidden" value="{$vertices}" />
                
                <!-- End point -->
                <input id="endaddress" name="endaddress" type="hidden" value="{$endaddress}" />
                <input id="endcity" name="endcity" type="hidden" value="{$endcity}" />
                <input id="endstate" name="endstate" type="hidden" value="{$endstate}" />
                <input id="endzip" name="endzip" type="hidden" value="{$endzip}" />
                <input id="endlatitude" name="endlatitude" type="hidden" value="{$endlat}" />
                <input id="endlongitude" name="endlongitude" type="hidden" value="{$endlng}" />
                
                <!-- Title -->
                <div class="formelement">
                    <label for="title"><span class="required">*</span> Route Name (ex: Tom's house)</label>
                    <input id="title" name="title" type="text" value="{$title}" maxlength="100" class="textbox" />
                    <span id="titleError" class="formerror"></span>
                </div>
                
                <!-- Start Address -->
                <div class="formelement">
                    <label for="startaddress">Address</label>
                    <input id="startaddress" name="startaddress" type="text" value="{$startaddress}" maxlength="100" class="textbox" />
                    <span id="startplaceError" class="formerror"></span>
                </div>
                
                <!-- Start City -->
                <div class="formelement">
                    <label for="startcity">City</label>
                    <input id="startcity" name="startcity" type="text" value="{$startcity}" maxlength="100" class="textbox" />
                    <span id="startcityError" class="formerror"></span>
                </div>
                
                <!-- Start State -->
                <div class="formelement">
                    <label for="startstate">State</label>
                    <select id="startstate" name="startstate" class="select">
                        <option value="">-- select --</option>
                        <option value="AL" {if $startstate eq 'AL'}selected="selected"{/if}>Alabama</option>
                        <option value="AK" {if $startstate eq 'AK'}selected="selected"{/if}>Alaska</option>
                        <option value="AZ" {if $startstate eq 'AZ'}selected="selected"{/if}>Arizona</option>
                        <option value="AR" {if $startstate eq 'AR'}selected="selected"{/if}>Arkansas</option>
                        <option value="CA" {if $startstate eq 'CA'}selected="selected"{/if}>California</option>
                        <option value="CO" {if $startstate eq 'CO'}selected="selected"{/if}>Colorado</option>
                        <option value="CT" {if $startstate eq 'CT'}selected="selected"{/if}>Connecticut</option>
                        <option value="DE" {if $startstate eq 'DE'}selected="selected"{/if}>Delaware</option>
                        <option value="DC" {if $startstate eq 'DC'}selected="selected"{/if}>District of Columbia</option>
                        <option value="FL" {if $startstate eq 'FL'}selected="selected"{/if}>Florida</option>
                        <option value="GA" {if $startstate eq 'GA'}selected="selected"{/if}>Georgia</option>
                        <option value="HI" {if $startstate eq 'HI'}selected="selected"{/if}>Hawaii</option>
                        <option value="ID" {if $startstate eq 'ID'}selected="selected"{/if}>Idaho</option>
                        <option value="IL" {if $startstate eq 'IL'}selected="selected"{/if}>Illinois</option>
                        <option value="IN" {if $startstate eq 'IN'}selected="selected"{/if}>Indiana</option>
                        <option value="IA" {if $startstate eq 'IA'}selected="selected"{/if}>Iowa</option>
                        <option value="KS" {if $startstate eq 'KS'}selected="selected"{/if}>Kansas</option>
                        <option value="KY" {if $startstate eq 'KY'}selected="selected"{/if}>Kentucky</option>
                        <option value="LA" {if $startstate eq 'LA'}selected="selected"{/if}>Louisiana</option>
                        <option value="ME" {if $startstate eq 'ME'}selected="selected"{/if}>Maine</option>
                        <option value="MD" {if $startstate eq 'MD'}selected="selected"{/if}>Maryland</option>
                        <option value="MA" {if $startstate eq 'MA'}selected="selected"{/if}>Massachusetts</option>
                        <option value="MI" {if $startstate eq 'MI'}selected="selected"{/if}>Michigan</option>
                        <option value="MN" {if $startstate eq 'MN'}selected="selected"{/if}>Minnesota</option>
                        <option value="MS" {if $startstate eq 'MS'}selected="selected"{/if}>Mississippi</option>
                        <option value="MO" {if $startstate eq 'MO'}selected="selected"{/if}>Missouri</option>
                        <option value="MT" {if $startstate eq 'MT'}selected="selected"{/if}>Montana</option>
                        <option value="NE" {if $startstate eq 'NE'}selected="selected"{/if}>Nebraska</option>
                        <option value="NV" {if $startstate eq 'NV'}selected="selected"{/if}>Nevada</option>
                        <option value="NH" {if $startstate eq 'NH'}selected="selected"{/if}>New Hampshire</option>
                        <option value="NJ" {if $startstate eq 'NJ'}selected="selected"{/if}>New Jersey</option>
                        <option value="NM" {if $startstate eq 'NM'}selected="selected"{/if}>New Mexico</option>
                        <option value="NY" {if $startstate eq 'NY'}selected="selected"{/if}>New York</option>
                        <option value="NC" {if $startstate eq 'NC'}selected="selected"{/if}>North Carolina</option>
                        <option value="ND" {if $startstate eq 'ND'}selected="selected"{/if}>North Dakota</option>
                        <option value="OH" {if $startstate eq 'OH'}selected="selected"{/if}>Ohio</option>
                        <option value="OK" {if $startstate eq 'OK'}selected="selected"{/if}>Oklahoma</option>
                        <option value="OR" {if $startstate eq 'OR'}selected="selected"{/if}>Oregon</option>
                        <option value="PA" {if $startstate eq 'PA'}selected="selected"{/if}>Pennsylvania</option>
                        <option value="RI" {if $startstate eq 'RI'}selected="selected"{/if}>Rhode Island</option>
                        <option value="SC" {if $startstate eq 'SC'}selected="selected"{/if}>South Carolina</option>
                        <option value="SD" {if $startstate eq 'SD'}selected="selected"{/if}>South Dakota</option>
                        <option value="TN" {if $startstate eq 'TN'}selected="selected"{/if}>Tennessee</option>
                        <option value="TX" {if $startstate eq 'TX'}selected="selected"{/if}>Texas</option>
                        <option value="UT" {if $startstate eq 'UT'}selected="selected"{/if}>Utah</option>
                        <option value="VT" {if $startstate eq 'VT'}selected="selected"{/if}>Vermont</option>
                        <option value="VA" {if $startstate eq 'VA'}selected="selected"{/if}>Virginia</option>
                        <option value="WA" {if $startstate eq 'WA'}selected="selected"{/if}>Washington</option>
                        <option value="WV" {if $startstate eq 'WV'}selected="selected"{/if}>West Virginia</option>
                        <option value="WI" {if $startstate eq 'WI'}selected="selected"{/if}>Wisconsin</option>
                        <option value="WY" {if $startstate eq 'WY'}selected="selected"{/if}>Wyoming</option>
                    </select>
                    <span id="startstateError" class="formerror"></span>
                </div>
                
                <!-- Start Zip -->
                <div class="formelement">
                    <label for="startzip">Zipcode</label>
                    <input id="startzip" name="startzip" type="text" value="{$startzip}" maxlength="100" class="textbox" />
                    <span id="startzipError" class="formerror"></span>
                </div>
                
                <!-- Map Controls -->
                <div class="formelement">
                	<!--<input id="addpoint" type="button" value="Add Address to Map" />-->
                	<input type="button" value="Clear Map" onClick="clearMyOverlays();">
                </div>
                
                <!-- Additional Information -->
                <div class="formelement">
                    <label for="description">Additional Information</label>
                    <input id="description" name="description" type="text" value="{$description}" maxlength="100" class="textbox" />
                </div>
     
                <!-- Submit Button -->
                <div class="formelement">
                    <input id="submit" name="submit" type="submit" value="Save" class="submit" />
                </div>
         <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}     
            
            </form>

        </div>


    
    <div id="onecolumnbtm"></div>

</body>
</html>
