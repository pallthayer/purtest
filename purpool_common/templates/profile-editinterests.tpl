<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script language="javascript" src="js/formfocus.js"></script>
</head>

<body>

	<!-- Header -->
    <div id="header">
    	<a href="{$site_url}" id="logo"><h1>Purpool</h1></a>
    </div>
    
    <!-- Top Navigation -->
   		{include file="topnavigation.tpl"}
    
    <!-- Left Column 
    <div id="leftcolumn">
    	
        {include file="sidenavigation.tpl"}

    </div>
    //-->

    
    	<!-- Content Bar -->
        <div id="contentbar">
        
            <!-- Page Heading -->
            <h2>Members</h2>
            
            <!-- Tabs -->
            <div id="tabs">
              	<ul>
                	<li class="first"><a href="profile.php?state=browseprofiles">Browse People</a></li>
                	<li><a href="profile.php?state=viewprofile">View Profile</a></li>
                    <li class="current"><a href="profile.php?state=editgeneral">Edit Profile</a></li>
                    
                </ul>
            </div>
            
        </div>
        
        <div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
        	<h3 style="margin-bottom:0;">Edit Profile</h3>
        
        	<div id="wizard">
                <ul>
                    <li><a href="profile.php?state=editgeneral">Edit General Info</a></li>
                    <li><a href="profile.php?state=updatevehicle">Edit Vehicle</a></li>
                    <li class="current"><a href="profile.php?state=editinterests">Edit Interests</a></li>
                    <li><a href="profile.php?state=editpassword">Change Password</a></li>
                </ul>
            </div>
            <div class="clear"></div>
            <!-- Confirmation -->
            {if $confirmation}<p class="green">{$confirmation}</p>{/if}
        	
            <!-- General Form -->
            <form id="myform" method="post" enctype="multipart/form-data" action="profile.php?state=editinterests">
            
                <!-- Music Preferences -->
                <div class="formelement">
                    <label for="music"> Music Preferences</label>
                    <input name="music[]" type="checkbox" value="rock" {if $rock}checked="checked"{/if} /> Rock<br />
                    <input name="music[]" type="checkbox" value="alternative" {if $alternative}checked="checked"{/if} /> Alternative<br />
                    <input name="music[]" type="checkbox" value="country" {if $country}checked="checked"{/if} /> Country<br />
                    <input name="music[]" type="checkbox" value="jazz" {if $jazz}checked="checked"{/if} /> Jazz<br />
                    <input name="music[]" type="checkbox" value="folk" {if $folk}checked="checked"{/if} /> Folk<br />
                    <input name="music[]" type="checkbox" value="classical" {if $classical}checked="checked"{/if} /> Classical<br />
                    <input name="music[]" type="checkbox" value="world" {if $world}checked="checked"{/if} /> World<br />
                    <input name="music[]" type="checkbox" value="oldies" {if $oldies}checked="checked"{/if} /> Oldies<br />
                    <input name="music[]" type="checkbox" value="talk" {if $talk}checked="checked"{/if} /> Talk Radio<br />
                    <input name="music[]" type="checkbox" value="other" {if $other}checked="checked"{/if} /> Other
                </div>
                
                <!-- Interests -->
                <div class="formelement">
                    <label for="interests"> Interests</label>
                    <textarea name="interests" rows="8" class="textarea">{$interests}</textarea>
                </div>
                
                <!-- Submit Button -->
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
