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
    <div id="topnav2">
    	<ul>
        	<li><a href="register.php">Register</a></li>
		</ul>
		<ul >
        	<li><a href="help.php">Help</a> | <a href="contact.php">Contact</a></li>
		</ul>
    </div>
        
    	<!-- Content Bar -->
        <div id="contentbar">    
            <!-- Page Heading -->
            <h2>Register</h2>
        </div>
        
		<div id="onecolumntop"></div>
        <!-- Content -->
        <div class="content">
        	
            <!-- User Profile -->
            <div id="wizard">
                <ul>
                    <li><span>1. General</span></li>
                    <li><span>2. Vehicle</span></li>
                    <li class="current"><span>3. Interests</span></li>
                </ul>
                <div class="step">
                    Step 3 of 3            
                </div>
            </div>
            <div class="clear"></div> 
            <!-- General Form -->
            <form id="myform" method="post" action="register.php?state=interests">
            
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
                    <input id="submit" name="submit" type="submit" value="Register" class="submit" />
                </div>
                
            </form>
        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}            
        </div>

    </div>


    
    <div id="onecolumnbtm"></div>

</body>
</html>
