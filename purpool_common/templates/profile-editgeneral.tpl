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


    
    	<!-- Content Bar -->
        <div id="contentbar">
        
            <!-- Page Heading -->
            <h2>People</h2>
            
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
                    <li class="current"><a href="profile.php?state=editgeneral">Edit General Info</a></li>
                    <li><a href="profile.php?state=updatevehicle">Edit Vehicle</a></li>
                    <li><a href="profile.php?state=editinterests">Edit Interests</a></li>
                    <li><a href="profile.php?state=editpassword">Change Password</a></li>
                </ul>
            </div>
            <div class="clear"></div>
            <!-- Confirmation -->
            {if $confirmation}<p class="green">{$confirmation}</p>{/if}
            
            <!-- General Form -->
            <form id="myform" method="post" enctype="multipart/form-data" action="profile.php?state=editgeneral">
                
                <!-- Workplace -->
                <div class="formelement">
                    <label for="workplace"><span class="required">*</span> Workplace</label>
                    <select id="workplace" name="workplace" class="select">
                        <option value="">-- select --</option>
                        {section name=info loop=$workplaces}
                            <option value="{$workplaces[info].workplace_id}" {if $workplace eq $workplaces[info].workplace_id}selected="selected"{/if}>{$workplaces[info].name}</option>
                        {/section}
                    </select>
                    <span id="workplaceError" class="formerror">{$error.workplace}</span>
                </div>
                
                <!-- Firstname -->
                <div class="formelement">
                    <label for="firstname"><span class="required">*</span> First Name</label>
                    <input id="firstname" name="firstname" type="text" value="{$firstname}" maxlength="25" class="textbox" />
                    <span id="firstnameError" class="formerror">{$error.firstname}</span>
                </div>
                
                <!-- Lastname -->
                <div class="formelement">
                    <label for="lastname"><span class="required">*</span> Last Name</label>
                    <input id="lastname" name="lastname" type="text" value="{$lastname}" maxlength="50" class="textbox" />
                    <span id="lastnameError" class="formerror">{$error.lastname}</span>
                </div>
                
                <!-- Gender -->
                <div class="formelement">
                    <label for="gender"><span class="required">*</span> Gender</label>
                    <input id="gender_female" name="gender" type="radio" value="female" {if $gender eq 'female'}checked="checked"{/if} /> Female<br />
                    <input id="gender_male" name="gender" type="radio" value="male" {if $gender eq 'male'}checked="checked"{/if} /> Male
                </div>
                
                <!-- E-mail -->
                <div class="formelement">
                    <label for="email"><span class="required">*</span> E-mail (read only)</label>
                    <input id="email_disabled" name="email_disabled" type="text" value="{$email}" disabled="disabled" maxlength="50" class="textbox" />
                    <input id="email" name="email" type="hidden" value="{$email}"  />
                    <span id="emailError" class="formerror">{$error.email}</span>
                </div>
                
                <!-- Cell Phone -->
                <div class="formelement">
                    <label for="cellphone1">Cell Phone</label>
                    ( <input id="cellphone1" name="cellphone1" type="text" value="{$cellphone1}" maxlength="3" style="width: 30px" class="textbox" /> )
                    <input id="cellphone2" name="cellphone2" type="text" value="{$cellphone2}" maxlength="3" style="width: 30px" class="textbox" /> - 
                    <input id="cellphone3" name="cellphone3" type="text" value="{$cellphone3}" maxlength="4" style="width: 125px" class="textbox" />
                    <span id="cellphoneError" class="formerror">{$error.cellphone}</span>
                </div>
                
                <!-- Work Phone -->
                <div class="formelement">
                    <label for="workphone1">Work Phone</label>
                    ( <input id="workphone1" name="workphone1" type="text" value="{$workphone1}" maxlength="3" style="width: 30px" class="textbox" /> )
                    <input id="workphone2" name="workphone2" type="text" value="{$workphone2}" maxlength="3" style="width: 30px" class="textbox" /> - 
                    <input id="workphone3" name="workphone3" type="text" value="{$workphone3}" maxlength="4" style="width: 125px" class="textbox" />
                    Ext: <input id="workphone4" name="workphone4" type="text" value="{$workphone4}" maxlength="4" style="width: 125px" class="textbox" />
                    <span id="workphoneError" class="formerror">{$error.workphone}</span>
                </div>
                
                 <!-- Zipcode -->
                <div class="formelement">
                    <label for="zipcode"><span class="required">*</span> Zipcode of primary residence:</label>
                    <input id="zipcode" name="zipcode" type="text" value="{$zipcode}" maxlength="5" class="textbox" />
                    <span id="zipcodeError" class="formerror">{$error.zipcode}</span>
                </div>
                
                <!-- Schedule -->
                <div class="formelement">
                    <label for="schedule">In general, what is your work schedule?</label>
                    <textarea id="schedule" name="schedule" rows="5" class="textarea">{$schedule}</textarea>
                    <span id="scheduleError" class="formerror">{$error.schedule}</span>
                </div>
                
                <!-- Job Title -->
                <div class="formelement">
                    <label for="occupation">Occupation</label>
                    <input id="occupation" name="occupation" type="text" value="{$occupation}" maxlength="100" class="textbox" />
                </div>
                
                <!-- Photo -->
                <div class="formelement">
                    <label for="upload">{if $photo}Replace Photo{else}Photo{/if} (.jpg format)</label>
                    <input id="file" name="file" type="file" class="textbox"  />
                    <span id="photoError" class="formerror">{$error.photo}</span>
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
