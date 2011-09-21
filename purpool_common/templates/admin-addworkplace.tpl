<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script language="javascript" src="js/formfocus.js"></script>
<script language="javascript" src="js/sorttable.js"></script>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key={$google_key}" type="text/javascript"></script>
<script src="js/icons.js"></script>
<script language="javascript" src="js/workplace-create.js"></script>
</head>

<body>

	<!-- Header -->
    <div id="header">
    	<a href="{$site_url}" id="logo"><h1>Purpool</h1></a>
    </div>
    
	<!-- Top Navigation -->
   		{include file="topnavigation.tpl"}
    
    
    	<!-- Content Bar -->
        <div id="contentbar">
        
            <!-- Page Heading -->
            <h2>Admin</h2>
            
        </div>
        
		<div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
        
        	<!-- Back to Main Menu -->
            <p><a href="admin.php">Back to Main Menu</a></p>
            
             <div class="clear"></div>
        	<!-- Workplace Location  map -->
            <div id="map" style="width: 400px; height: 400px; float: right; margin-left: 20px; margin-right: 20px; border: 1px solid #5d1db8;"></div>
            
            <!-- Add Workplace -->
            <form id="myform" method="post" action="{$formaction}">
            	<div class="formelement">
                	<label for="name">Name</label>
                    <input id="name" name="name" type="text" value="{$name}" class="textbox" />
                    <span id="nameError" class="formerror">{$error.name}</span>
                </div>
                <div class="formelement">
                	<label for="suffix">Suffix (@companyname.com)</label>
                    <input id="suffix" name="suffix" type="text" value="{$suffix}" class="textbox" />
                    <span id="suffixError" class="formerror">{$error.suffix}</span>
                </div>
                <div class="formelement">
                	<label for="address">Address</label>
                    <input id="address" name="address" type="text" value="{$address}" class="textbox" />
                    <span id="addressError" class="formerror">{$error.address}</span>
                </div>
                <div class="formelement">
                	<label for="city">City</label>
                    <input id="city" name="city" type="text" value="{$city}" class="textbox" />
                    <span id="cityError" class="formerror">{$error.city}</span>
                </div>
                <div class="formelement">
                	<label for="state">State</label>
                    <select id="state" name="state" class="select">
                        <option value="">-- select --</option>
                        <option value="AL" {if $state eq 'AL'}selected="selected"{/if}>Alabama</option>
                        <option value="AK" {if $state eq 'AK'}selected="selected"{/if}>Alaska</option>
                        <option value="AZ" {if $state eq 'AZ'}selected="selected"{/if}>Arizona</option>
                        <option value="AR" {if $state eq 'AR'}selected="selected"{/if}>Arkansas</option>
                        <option value="CA" {if $state eq 'CA'}selected="selected"{/if}>California</option>
                        <option value="CO" {if $state eq 'CO'}selected="selected"{/if}>Colorado</option>
                        <option value="CT" {if $state eq 'CT'}selected="selected"{/if}>Connecticut</option>
                        <option value="DE" {if $state eq 'DE'}selected="selected"{/if}>Delaware</option>
                        <option value="DC" {if $state eq 'DC'}selected="selected"{/if}>District of Columbia</option>
                        <option value="FL" {if $state eq 'FL'}selected="selected"{/if}>Florida</option>
                        <option value="GA" {if $state eq 'GA'}selected="selected"{/if}>Georgia</option>
                        <option value="HI" {if $state eq 'HI'}selected="selected"{/if}>Hawaii</option>
                        <option value="ID" {if $state eq 'ID'}selected="selected"{/if}>Idaho</option>
                        <option value="IL" {if $state eq 'IL'}selected="selected"{/if}>Illinois</option>
                        <option value="IN" {if $state eq 'IN'}selected="selected"{/if}>Indiana</option>
                        <option value="IA" {if $state eq 'IA'}selected="selected"{/if}>Iowa</option>
                        <option value="KS" {if $state eq 'KS'}selected="selected"{/if}>Kansas</option>
                        <option value="KY" {if $state eq 'KY'}selected="selected"{/if}>Kentucky</option>
                        <option value="LA" {if $state eq 'LA'}selected="selected"{/if}>Louisiana</option>
                        <option value="ME" {if $state eq 'ME'}selected="selected"{/if}>Maine</option>
                        <option value="MD" {if $state eq 'MD'}selected="selected"{/if}>Maryland</option>
                        <option value="MA" {if $state eq 'MA'}selected="selected"{/if}>Massachusetts</option>
                        <option value="MI" {if $state eq 'MI'}selected="selected"{/if}>Michigan</option>
                        <option value="MN" {if $state eq 'MN'}selected="selected"{/if}>Minnesota</option>
                        <option value="MS" {if $state eq 'MS'}selected="selected"{/if}>Mississippi</option>
                        <option value="MO" {if $state eq 'MO'}selected="selected"{/if}>Missouri</option>
                        <option value="MT" {if $state eq 'MT'}selected="selected"{/if}>Montana</option>
                        <option value="NE" {if $state eq 'NE'}selected="selected"{/if}>Nebraska</option>
                        <option value="NV" {if $state eq 'NV'}selected="selected"{/if}>Nevada</option>
                        <option value="NH" {if $state eq 'NH'}selected="selected"{/if}>New Hampshire</option>
                        <option value="NJ" {if $state eq 'NJ'}selected="selected"{/if}>New Jersey</option>
                        <option value="NM" {if $state eq 'NM'}selected="selected"{/if}>New Mexico</option>
                        <option value="NY" {if $state eq 'NY'}selected="selected"{/if}>New York</option>
                        <option value="NC" {if $state eq 'NC'}selected="selected"{/if}>North Carolina</option>
                        <option value="ND" {if $state eq 'ND'}selected="selected"{/if}>North Dakota</option>
                        <option value="OH" {if $state eq 'OH'}selected="selected"{/if}>Ohio</option>
                        <option value="OK" {if $state eq 'OK'}selected="selected"{/if}>Oklahoma</option>
                        <option value="OR" {if $state eq 'OR'}selected="selected"{/if}>Oregon</option>
                        <option value="PA" {if $state eq 'PA'}selected="selected"{/if}>Pennsylvania</option>
                        <option value="RI" {if $state eq 'RI'}selected="selected"{/if}>Rhode Island</option>
                        <option value="SC" {if $state eq 'SC'}selected="selected"{/if}>South Carolina</option>
                        <option value="SD" {if $state eq 'SD'}selected="selected"{/if}>South Dakota</option>
                        <option value="TN" {if $state eq 'TN'}selected="selected"{/if}>Tennessee</option>
                        <option value="TX" {if $state eq 'TX'}selected="selected"{/if}>Texas</option>
                        <option value="UT" {if $state eq 'UT'}selected="selected"{/if}>Utah</option>
                        <option value="VT" {if $state eq 'VT'}selected="selected"{/if}>Vermont</option>
                        <option value="VA" {if $state eq 'VA'}selected="selected"{/if}>Virginia</option>
                        <option value="WA" {if $state eq 'WA'}selected="selected"{/if}>Washington</option>
                        <option value="WV" {if $state eq 'WV'}selected="selected"{/if}>West Virginia</option>
                        <option value="WI" {if $state eq 'WI'}selected="selected"{/if}>Wisconsin</option>
                        <option value="WY" {if $state eq 'WY'}selected="selected"{/if}>Wyoming</option>
                    </select>
                    <span id="stateError" class="formerror">{$error.state}</span>
                </div>
                <div class="formelement">
                	<label for="zip">Zipcode</label>
                    <input id="zip" name="zip" type="text" value="{$zip}" class="textbox" />
                    <span id="zipError" class="formerror">{$error.zip}</span>
                </div>
                <div class="formelement">
                    <input id="geocode" name="geocode" type="button" value="Get Latitute/Longitude Values" class="submit"/>
                </div>
                <div class="formelement">
                	<label for="latitude">Latitude</label>
                    <input id="latitude" name="latitude" type="text" value="{$latitude}" class="textbox" />
                    <span id="latitudeError" class="formerror">{$error.latitude}</span>
                </div>
                <div class="formelement">
                	<label for="longitude">Longitude</label>
                    <input id="longitude" name="longitude" type="text" value="{$longitude}" class="textbox" />
                    <span id="longitudeError" class="formerror">{$error.longitude}</span>
                </div>
                <div class="formelement">
                    <input id="submit" name="submit" type="submit" value="Save" class="submit" />
                </div>
            
            </form>
            
        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}
        </div>


    
    <div id="onecolumnbtm"></div>

</body>
</html>
