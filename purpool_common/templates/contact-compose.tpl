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
            <h2>Contact</h2>
        
        </div>
        
		<div id="onecolumntop"></div>
        
        <!-- Content -->
        <div class="content">
        	
            <!-- Contact Form -->
            <form id="myform" method="post" action="contact.php">
                <div class="formelement">
                    <label for="name">Your Name:</label>
                    <input id="name" name="name" type="text" value="{$name}" class="textbox" />
                    <div id="nameError" class="formerror">{$error.name}</div>
                </div>
                <div class="formelement">
                    <label for="email">Your E-mail Address:</label>
                    <input id="email" name="email" type="text" value="{$email}" class="textbox" />
                    <div id="emailError" class="formerror">{$error.email}</div>
                </div>
                <div class="formelement">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="12" class="textarea" style="width: 450px">{$message}</textarea>
                    <div id="messageError" class="formerror">{$error.message}</div>
                </div>
                <div class="formelement">
                    <input id="submit" name="submit" type="submit" value="Send" class="submit" />
                </div>
            </form>
         <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}                
        </div>
        
    </div>

    <div id="onecolumnbtm"></div>

</body>
</html>
