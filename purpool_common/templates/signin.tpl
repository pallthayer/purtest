<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js"></script>
<script language="javascript" src="js/formfocus.js"></script>
<script language="javascript" src="js/indicator.js"></script>
<script language="javascript" src="js/signin.js"></script>
</head>

<body>

	<!-- Header -->
    <div id="header">
    	<a href="{$site_url}" id="logo"><h1>Purpool</h1></a>
    </div>
        
        <!-- Top Navigation -->
        <div id="topnav2">
        	<ul>
            	<li><a href="signin.php?state=signout">Signout</a></li>
            </ul>
        </div>
        
    <!-- Left Column -->
    <div id="leftcolumn">
    
    	<p><img src="icons/icon-info.gif" alt="" class="icon" /> <span style="color: #333; font-size: 1.2em; font-weight: bold;">Instructions</span></p>
        <p>Type in your username and password to sign into Purpool.</p>
        <p>A link to register and to reset your password should go here as well.</p>
    
    </div>
    
    <!-- Right Column -->
    <div id="rightcolumn">
    
    	<!-- Page Title -->
        <h2>{$pagetitle}</h2>
        	
        <!-- Login Form -->
        <form id="signinForm">
            
            <!-- Invalid user error -->
            <div id="invaliduserError" class="formerror" style="display: none; margin-bottom: 15px;"></div>
            
            <!-- Username -->
            <div class="formelement">
                <label for="usename"><span class="required">*</span> Username</label>
                <input id="username" name="username" type="text" value="" maxlength="25" class="textbox" />
                <span id="usernameError" class="formerror" style="display: none"></span>
            </div>
            
            <!-- Password -->
            <div class="formelement">
                <label for="userpass"><span class="required">*</span> Password</label>
                <input id="userpass" name="userpass" type="password" value="" maxlength="25" class="textbox" />
                <span id="userpassError" class="formerror" style="display: none"></span>
            </div>
 
            <!-- Submit Button -->
            <div class="formelement">
                <input id="submit" name="submit" type="submit" value="Login" class="submit" />
            </div>
            
        </form>
        
    </div>
    
    <!-- Clear -->
    <div style="clear: both;"></div>
    
    <!-- Indicator -->
    <img id="indicator" src="images/indicator.gif" alt="" style="display: none;"/>
    


    
    <div id="onecolumnbtm"></div>

</body>
</html>
