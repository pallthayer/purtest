<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script language="javascript" src="js/formfocus.js"></script>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key={$google_key}" type="text/javascript"></script>

{literal}

<script type="text/javascript">
	
	// INITIAL EVENT LISTENERS
	document.observe("dom:loaded", function() 
	{
		
		// Initialize Pool Form
		var poiForm = new Formfocus("myform");
				
		// Focus first element
		poiForm.focusFirst();
		
		// Listen for form submission
		Event.observe('myform', 'submit', addPoiPost);
	
	});
	
	// Add Point of Interest Post
	function addPoiPost(e)
	{
		// Prevent form submission
		Event.stop(e);
		
		// Clear previous errors
		$('titleError').update(''); 
		$('addressError').update(''); 
		$('cityError').update(''); 
		$('stateError').update(''); 
		$('zipError').update(''); 
		
		// Send AJAX request
		var url = 'community-map.php?state=addpoi';
		var params = Form.serialize('myform');
		var ajax = new Ajax.Request( url, { method: 'post', postBody: params, onSuccess: addPoiResponse }); 
	}
	
	// Add Point of Interest Response
	function addPoiResponse(resp)
	{
		// Obtain JSON response
		var json = resp.responseText.evalJSON();
		
		// If successful
		if(json.status == 'success')
		{
			// Redirect user
			alert('poi of interest has been added.');
		}
		
		// If errors, display errors
		if(json.status == 'failure')
		{
			if(json.error.title)    { $('titleError').update(json.error.title); }
			if(json.error.address)  { $('addressError').update(json.error.address); }
			if(json.error.city)     { $('cityError').update(json.error.city); }
			if(json.error.state)    { $('stateError').update(json.error.state); }
			if(json.error.zip)     	{ $('zipError').update(json.error.zip); }
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
        <h2>Community Map</h2>
        
    </div>
        
    <!-- Tabs 
    <div id="tabs">
        <ul>
            <li class="first current"><a href="pools.php">My Pools</a></li>
            <li><a href="pools.php?state=browsepools">Browse Pools</a></li>
        </ul>
    </div>
    -->

        
	<div id="tabtop"></div>
        
        <!-- Content -->
        <div class="content">
        	
            
            <!-- Display Map -->
            <div id="map" style="width: 400px; height: 400px; float: left; margin-top: 50px"></div>
            
            
            <!-- Add Point of Interest -->
            <h3>Add Point of Interest</h3>
            
            <form id="myform" name="myform" style="margin-left: 425px">
            
            	<div class="formelement">
                	<label for="title">Title: </label>
                    <input id="title" name="title" type="text" class="textbox" />
                    <span id="titleError" class="formerror"></span>
                </div>
                <div class="formelement">
                	<label for="address">Address: </label>
                    <input id="address" name="address" type="text" class="textbox" />
                    <span id="addressError" class="formerror"></span>
                </div>
                <div class="formelement">
                	<label for="city">City: </label>
                    <input id="city" name="city" type="text" class="textbox" />
                    <span id="cityError" class="formerror"></span>
                </div>
                <div class="formelement">
                	<label for="state">State: </label>
                    <select id="state" name="state" class="select">
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
                    <span id="stateError" class="formerror"></span>
                </div>
                <div class="formelement">
                	<label for="zip">Zip: </label>
                    <input id="zip" name="zip" type="text" class="textbox" />
                    <span id="zipError" class="formerror"></span>
                </div>
                <div class="formelement">
                	<label for="description">Description: </label>
                    <input id="description" name="description" type="text" class="textbox" />
                    <span id="descriptionError" class="formerror"></span>
                </div>
                <div class="formelement">
                	<label for="url">Url: </label>
                    <input id="url" name="url" type="text" class="textbox" />
                    <span id="urlError" class="formerror"></span>
                </div>
                <div class="formelement">
                	<label for="title">Tags: (ex: food, entertainment, etc) </label>
                    <input id="tags" name="tags" type="text" class="textbox" />
                    <span id="tagsError" class="formerror"></span>
                </div>
                <div class="formelement">
                    <input id="submit" name="submit" type="submit" value="Add" class="submit" />
                </div>
            </form>
            
            <!-- Display Points of Interest -->
            {if $poi}
                <table class="table4">
                    <tr class="tablehead">
                        <th>Title</th>
                        <th>Address</th>
                        <th>Description</th>
                    </tr>
                    {section name=info loop=$poi}
                        <tr>
                            <td>{if $poi[info].url}<a href="{$poi[info].url}" target="_blank">{$poi[info].title}</a>{else}{$poi[info].title}{/if}</td>
                            <td>{if $poi[info].address}{$poi[info].address} {$poi[info].city} {$poi[info].state} {$poi[info].zip} {else} --- {/if}</td>
                            <td>{if $poi[info].description}{$poi[info].description} {else} --- {/if}</td>
                        </tr>
                    {/section}
                </table>
            {/if}                
                            
			<div class="clear"></div>
        </div>

    <div id="onecolumnbtm"></div>

</body>
</html>
