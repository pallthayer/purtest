<?php /* Smarty version 2.6.19, created on 2009-05-26 04:23:03
         compiled from register-survey-complete.tpl */ ?>
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
    	<a href="/" id="logo"><h1>Purpool</h1></a>
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
            <h2>Registration Survey</h2>
        </div>
        
		<div id="onecolumntop"></div>
        <!-- Content -->
        <div class="content">
        	
            <!-- User Profile -->
            
            <div class="clear"></div> 
           
           <div>
           	You have completed the registration survey. Thank you for your help!
           </div>
                
            </form>
        <!-- Bottom Navigation Bar -->
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "bottomnavigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>            
        </div>

    </div>


    
    <div id="onecolumnbtm"></div>

</body>
</html>