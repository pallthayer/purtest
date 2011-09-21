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
                    <li><a href="profile.php?state=editinterests">Edit Interests</a></li>
                    <li class="current"><a href="profile.php?state=editpassword">Change Password</a></li>
                </ul>
            </div>
            <div class="clear"></div>

            <!-- Confirmation -->
            {if $confirmation}<p class="green">{$confirmation}</p>{/if}
            
            <!-- General Form -->
            <form id="myform" method="post" action="profile.php?state=editpassword">
            
                <!-- Userpass1 -->
                <div class="formelement">
                    <label for="userpass1"><span class="required">*</span> New Password</label>
                    <input id="userpass1" name="userpass1" type="password" value="" maxlength="25" class="textbox" />
                    <span id="userpass1Error" class="formerror">{$error.userpass1}</span>
                </div>
                
                <!-- Userpass2 -->
                <div class="formelement">
                    <label for="userpass2"><span class="required">*</span> Retype New Password</label>
                    <input id="userpass2" name="userpass2" type="password" value="" maxlength="25" class="textbox" />
                    <span id="userpass2Error" class="formerror">{$error.userpass2}</span>
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
