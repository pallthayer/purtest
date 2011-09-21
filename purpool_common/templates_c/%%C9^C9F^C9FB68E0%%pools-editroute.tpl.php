<?php /* Smarty version 2.6.19, created on 2009-04-07 13:52:03
         compiled from pools-editroute.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects,controls"></script>
<script language="javascript" src="js/formfocus.js"></script>

<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAA_2hDlr8GGBfE4xaODwzMdBTXq9fpoqsVDQwusP8wnl1JoF5PeRRah3cG9ATfaTXFHd6W2kdTXUmoow" type="text/javascript"></script>
<script src="js/icons.js"></script>
<script language="javascript" src="js/routemaker.js"></script>

<?php echo '

<script type="text/javascript">
function html_entity_decode(s) {
	var t=document.createElement(\'textarea\');
	t.innerHTML = s;
	var v = t.value;
	t.hide();
	return v;
}
</script>

'; ?>


<script type="text/javascript">

		// Populate end address
		var endaddress = '<?php echo $this->_tpl_vars['endaddress']; ?>
 <?php echo $this->_tpl_vars['endcity']; ?>
, <?php echo $this->_tpl_vars['endstate']; ?>
 <?php echo $this->_tpl_vars['endzip']; ?>
';
		var endlat = '<?php echo $this->_tpl_vars['endlat']; ?>
';
		var endlng = '<?php echo $this->_tpl_vars['endlng']; ?>
';
		
		//var geopositions = '["41.2206,-73.81359", "41.159012,-73.754654", "41.097206,-73.725128", "41.052949,-73.722382", "41.0192,-73.69905"]';
		var geopositions = '<?php echo $this->_tpl_vars['vertices']; ?>
';
		
		// Get route
		var route = '<?php echo $this->_tpl_vars['route']; ?>
';
		var title = html_entity_decode('<?php echo $this->_tpl_vars['title']; ?>
');
	
</script>

<?php echo '
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
	var routeForm = new Formfocus(\'myform\');
			
	// Focus first element
	routeForm.focusFirst();
	
	// Listen for adding a point via click
	//Event.observe(\'addpoint\', \'click\', getStartAddress);
	
	// Listen for form submission
	Event.observe(\'myform\', \'submit\', addRoutePost);
	
	// Listen for start address fields
	Event.observe(\'startaddress\', \'change\', checkRoute);
	Event.observe(\'startcity\', \'change\', checkRoute);
	Event.observe(\'startstate\', \'change\', checkRoute);
	
	// Add ending point to map
	addStreetAddressToRoute(endaddress);

});

// CHECK START ADDRESS
function checkRoute()
{
	// Check to see if all required fields are inputted
	if(($(\'startaddress\').value != \'\') && ($(\'startcity\').value != \'\') && ($(\'startstate\').value != \'\'))
	{
		// Get starting point string
		var startaddress = $(\'startaddress\').value + \' \' + $(\'startcity\').value + \' \' + $(\'startstate\').value + \' \' + $(\'startzip\').value;
		
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
	var startaddress = $(\'startaddress\').value + \' \' + $(\'startcity\').value + \' \' + $(\'startstate\').value + \' \' + $(\'startzip\').value;
	
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
		if ((distance != \'\') && (vertices != \'\'))
		{
			// Place distance in a hidden form variable
			$(\'distance\').value = distance;
			$(\'vertices\').value = vertices;
			
			// Stop listening
			pe.stop();
			
			// Clear previous errors
			$(\'titleError\').update(\'\'); 
			$(\'startplaceError\').update(\'\'); 
			
			// Send AJAX request
			var url = \'pools.php?state=saveroute&pool=\' + $(\'pool\').value + \'&route=\' + route;
			var params = Form.serialize(\'myform\');
			var ajax = new Ajax.Request( url, { method: \'post\', postBody: params, onSuccess: addRouteResponse }); 
		} 
	}, 0.25);
}

// ADD ROUTE RESPONSE
function addRouteResponse(resp)
{
	// Obtain JSON response
	var json = resp.responseText.evalJSON();
	
	// If successful, goto step three (interests)
	if(json.status == \'success\')
	{
		// Redirect user
		window.location = \'pools.php?state=viewroutes&pool=\' + json.pool + \'&confirmation=editroute\';
	}
	
	// If errors, display errors
	if(json.status == \'failure\')
	{
		if(json.error.title)     	{ $(\'titleError\').update(json.error.title); }
		if(json.error.startplace)   { $(\'startplaceError\').update(json.error.startplace); }
	}	
}

</script>
'; ?>

</head>

<body>

	<!-- Header -->
    <div id="header">
    	<a href="/" id="logo"><h1>Purpool</h1></a>
    </div>
    
	<!-- Top Navigation -->
   	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "topnavigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	
    
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
                
	        <h3 style="margin-bottom:0;"><?php echo $this->_tpl_vars['poolname']; ?>
</h3>
            <div id="wizard">
                <ul>
                    <li ><a href="pools.php?state=viewprofile&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Profile</a></li>
                    
                    <?php if ($this->_tpl_vars['editmode']): ?><li><a href="pools.php?state=editschedule&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Scheduler</a></li><?php endif; ?>
                    <li><a href="pools.php?state=viewschedule&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Upcoming Rides</a></li>
                    <li><a href="pools.php?state=shoutbox&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Shoutbox</a></li>
                    <?php if ($this->_tpl_vars['editmode']): ?><li><a href="pools.php?state=editpool&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Edit General</a></li><?php endif; ?>
                    <?php if ($this->_tpl_vars['editmode']): ?><li><a href="pools.php?state=editmembers&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Edit Members</a></li><?php endif; ?>
                    <?php if ($this->_tpl_vars['editmode']): ?><li class="current"><a href="pools.php?state=viewroutes&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Edit Routes</a></li><?php endif; ?>
                    <?php if ($this->_tpl_vars['editmode']): ?><li><a href="pools.php?state=deletepool&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Delete Pool</a></li><?php endif; ?>
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
                <input id="pool" name="pool" type="hidden" value="<?php echo $this->_tpl_vars['pool_id']; ?>
" />
                
                <!-- Distance and vertices -->
                <input id="distance" name="distance" type="hidden" value="<?php echo $this->_tpl_vars['distance']; ?>
" />
                <input id="vertices" name="vertices" type="hidden" value="<?php echo $this->_tpl_vars['vertices']; ?>
" />
                
                <!-- End point -->
                <input id="endaddress" name="endaddress" type="hidden" value="<?php echo $this->_tpl_vars['endaddress']; ?>
" />
                <input id="endcity" name="endcity" type="hidden" value="<?php echo $this->_tpl_vars['endcity']; ?>
" />
                <input id="endstate" name="endstate" type="hidden" value="<?php echo $this->_tpl_vars['endstate']; ?>
" />
                <input id="endzip" name="endzip" type="hidden" value="<?php echo $this->_tpl_vars['endzip']; ?>
" />
                <input id="endlatitude" name="endlatitude" type="hidden" value="<?php echo $this->_tpl_vars['endlat']; ?>
" />
                <input id="endlongitude" name="endlongitude" type="hidden" value="<?php echo $this->_tpl_vars['endlng']; ?>
" />
                
                <!-- Title -->
                <div class="formelement">
                    <label for="title"><span class="required">*</span> Route Name (ex: Tom's house)</label>
                    <input id="title" name="title" type="text" value="<?php echo $this->_tpl_vars['title']; ?>
" maxlength="100" class="textbox" />
                    <span id="titleError" class="formerror"></span>
                </div>
                
                <!-- Start Address -->
                <div class="formelement">
                    <label for="startaddress">Address</label>
                    <input id="startaddress" name="startaddress" type="text" value="<?php echo $this->_tpl_vars['startaddress']; ?>
" maxlength="100" class="textbox" />
                    <span id="startplaceError" class="formerror"></span>
                </div>
                
                <!-- Start City -->
                <div class="formelement">
                    <label for="startcity">City</label>
                    <input id="startcity" name="startcity" type="text" value="<?php echo $this->_tpl_vars['startcity']; ?>
" maxlength="100" class="textbox" />
                    <span id="startcityError" class="formerror"></span>
                </div>
                
                <!-- Start State -->
                <div class="formelement">
                    <label for="startstate">State</label>
                    <select id="startstate" name="startstate" class="select">
                        <option value="">-- select --</option>
                        <option value="AL" <?php if ($this->_tpl_vars['startstate'] == 'AL'): ?>selected="selected"<?php endif; ?>>Alabama</option>
                        <option value="AK" <?php if ($this->_tpl_vars['startstate'] == 'AK'): ?>selected="selected"<?php endif; ?>>Alaska</option>
                        <option value="AZ" <?php if ($this->_tpl_vars['startstate'] == 'AZ'): ?>selected="selected"<?php endif; ?>>Arizona</option>
                        <option value="AR" <?php if ($this->_tpl_vars['startstate'] == 'AR'): ?>selected="selected"<?php endif; ?>>Arkansas</option>
                        <option value="CA" <?php if ($this->_tpl_vars['startstate'] == 'CA'): ?>selected="selected"<?php endif; ?>>California</option>
                        <option value="CO" <?php if ($this->_tpl_vars['startstate'] == 'CO'): ?>selected="selected"<?php endif; ?>>Colorado</option>
                        <option value="CT" <?php if ($this->_tpl_vars['startstate'] == 'CT'): ?>selected="selected"<?php endif; ?>>Connecticut</option>
                        <option value="DE" <?php if ($this->_tpl_vars['startstate'] == 'DE'): ?>selected="selected"<?php endif; ?>>Delaware</option>
                        <option value="DC" <?php if ($this->_tpl_vars['startstate'] == 'DC'): ?>selected="selected"<?php endif; ?>>District of Columbia</option>
                        <option value="FL" <?php if ($this->_tpl_vars['startstate'] == 'FL'): ?>selected="selected"<?php endif; ?>>Florida</option>
                        <option value="GA" <?php if ($this->_tpl_vars['startstate'] == 'GA'): ?>selected="selected"<?php endif; ?>>Georgia</option>
                        <option value="HI" <?php if ($this->_tpl_vars['startstate'] == 'HI'): ?>selected="selected"<?php endif; ?>>Hawaii</option>
                        <option value="ID" <?php if ($this->_tpl_vars['startstate'] == 'ID'): ?>selected="selected"<?php endif; ?>>Idaho</option>
                        <option value="IL" <?php if ($this->_tpl_vars['startstate'] == 'IL'): ?>selected="selected"<?php endif; ?>>Illinois</option>
                        <option value="IN" <?php if ($this->_tpl_vars['startstate'] == 'IN'): ?>selected="selected"<?php endif; ?>>Indiana</option>
                        <option value="IA" <?php if ($this->_tpl_vars['startstate'] == 'IA'): ?>selected="selected"<?php endif; ?>>Iowa</option>
                        <option value="KS" <?php if ($this->_tpl_vars['startstate'] == 'KS'): ?>selected="selected"<?php endif; ?>>Kansas</option>
                        <option value="KY" <?php if ($this->_tpl_vars['startstate'] == 'KY'): ?>selected="selected"<?php endif; ?>>Kentucky</option>
                        <option value="LA" <?php if ($this->_tpl_vars['startstate'] == 'LA'): ?>selected="selected"<?php endif; ?>>Louisiana</option>
                        <option value="ME" <?php if ($this->_tpl_vars['startstate'] == 'ME'): ?>selected="selected"<?php endif; ?>>Maine</option>
                        <option value="MD" <?php if ($this->_tpl_vars['startstate'] == 'MD'): ?>selected="selected"<?php endif; ?>>Maryland</option>
                        <option value="MA" <?php if ($this->_tpl_vars['startstate'] == 'MA'): ?>selected="selected"<?php endif; ?>>Massachusetts</option>
                        <option value="MI" <?php if ($this->_tpl_vars['startstate'] == 'MI'): ?>selected="selected"<?php endif; ?>>Michigan</option>
                        <option value="MN" <?php if ($this->_tpl_vars['startstate'] == 'MN'): ?>selected="selected"<?php endif; ?>>Minnesota</option>
                        <option value="MS" <?php if ($this->_tpl_vars['startstate'] == 'MS'): ?>selected="selected"<?php endif; ?>>Mississippi</option>
                        <option value="MO" <?php if ($this->_tpl_vars['startstate'] == 'MO'): ?>selected="selected"<?php endif; ?>>Missouri</option>
                        <option value="MT" <?php if ($this->_tpl_vars['startstate'] == 'MT'): ?>selected="selected"<?php endif; ?>>Montana</option>
                        <option value="NE" <?php if ($this->_tpl_vars['startstate'] == 'NE'): ?>selected="selected"<?php endif; ?>>Nebraska</option>
                        <option value="NV" <?php if ($this->_tpl_vars['startstate'] == 'NV'): ?>selected="selected"<?php endif; ?>>Nevada</option>
                        <option value="NH" <?php if ($this->_tpl_vars['startstate'] == 'NH'): ?>selected="selected"<?php endif; ?>>New Hampshire</option>
                        <option value="NJ" <?php if ($this->_tpl_vars['startstate'] == 'NJ'): ?>selected="selected"<?php endif; ?>>New Jersey</option>
                        <option value="NM" <?php if ($this->_tpl_vars['startstate'] == 'NM'): ?>selected="selected"<?php endif; ?>>New Mexico</option>
                        <option value="NY" <?php if ($this->_tpl_vars['startstate'] == 'NY'): ?>selected="selected"<?php endif; ?>>New York</option>
                        <option value="NC" <?php if ($this->_tpl_vars['startstate'] == 'NC'): ?>selected="selected"<?php endif; ?>>North Carolina</option>
                        <option value="ND" <?php if ($this->_tpl_vars['startstate'] == 'ND'): ?>selected="selected"<?php endif; ?>>North Dakota</option>
                        <option value="OH" <?php if ($this->_tpl_vars['startstate'] == 'OH'): ?>selected="selected"<?php endif; ?>>Ohio</option>
                        <option value="OK" <?php if ($this->_tpl_vars['startstate'] == 'OK'): ?>selected="selected"<?php endif; ?>>Oklahoma</option>
                        <option value="OR" <?php if ($this->_tpl_vars['startstate'] == 'OR'): ?>selected="selected"<?php endif; ?>>Oregon</option>
                        <option value="PA" <?php if ($this->_tpl_vars['startstate'] == 'PA'): ?>selected="selected"<?php endif; ?>>Pennsylvania</option>
                        <option value="RI" <?php if ($this->_tpl_vars['startstate'] == 'RI'): ?>selected="selected"<?php endif; ?>>Rhode Island</option>
                        <option value="SC" <?php if ($this->_tpl_vars['startstate'] == 'SC'): ?>selected="selected"<?php endif; ?>>South Carolina</option>
                        <option value="SD" <?php if ($this->_tpl_vars['startstate'] == 'SD'): ?>selected="selected"<?php endif; ?>>South Dakota</option>
                        <option value="TN" <?php if ($this->_tpl_vars['startstate'] == 'TN'): ?>selected="selected"<?php endif; ?>>Tennessee</option>
                        <option value="TX" <?php if ($this->_tpl_vars['startstate'] == 'TX'): ?>selected="selected"<?php endif; ?>>Texas</option>
                        <option value="UT" <?php if ($this->_tpl_vars['startstate'] == 'UT'): ?>selected="selected"<?php endif; ?>>Utah</option>
                        <option value="VT" <?php if ($this->_tpl_vars['startstate'] == 'VT'): ?>selected="selected"<?php endif; ?>>Vermont</option>
                        <option value="VA" <?php if ($this->_tpl_vars['startstate'] == 'VA'): ?>selected="selected"<?php endif; ?>>Virginia</option>
                        <option value="WA" <?php if ($this->_tpl_vars['startstate'] == 'WA'): ?>selected="selected"<?php endif; ?>>Washington</option>
                        <option value="WV" <?php if ($this->_tpl_vars['startstate'] == 'WV'): ?>selected="selected"<?php endif; ?>>West Virginia</option>
                        <option value="WI" <?php if ($this->_tpl_vars['startstate'] == 'WI'): ?>selected="selected"<?php endif; ?>>Wisconsin</option>
                        <option value="WY" <?php if ($this->_tpl_vars['startstate'] == 'WY'): ?>selected="selected"<?php endif; ?>>Wyoming</option>
                    </select>
                    <span id="startstateError" class="formerror"></span>
                </div>
                
                <!-- Start Zip -->
                <div class="formelement">
                    <label for="startzip">Zipcode</label>
                    <input id="startzip" name="startzip" type="text" value="<?php echo $this->_tpl_vars['startzip']; ?>
" maxlength="100" class="textbox" />
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
                    <input id="description" name="description" type="text" value="<?php echo $this->_tpl_vars['description']; ?>
" maxlength="100" class="textbox" />
                </div>
     
                <!-- Submit Button -->
                <div class="formelement">
                    <input id="submit" name="submit" type="submit" value="Save" class="submit" />
                </div>
         <!-- Bottom Navigation Bar -->
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "bottomnavigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>     
            
            </form>

        </div>


    
    <div id="onecolumnbtm"></div>

</body>
</html>