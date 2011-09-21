<?php /* Smarty version 2.6.19, created on 2009-02-10 07:42:42
         compiled from profile-editpassword.tpl */ ?>
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
   		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "topnavigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    
    <!-- Left Column 
    <div id="leftcolumn">
    	
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "sidenavigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

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
            <?php if ($this->_tpl_vars['confirmation']): ?><p class="green"><?php echo $this->_tpl_vars['confirmation']; ?>
</p><?php endif; ?>
            
            <!-- General Form -->
            <form id="myform" method="post" action="profile.php?state=editpassword">
            
                <!-- Userpass1 -->
                <div class="formelement">
                    <label for="userpass1"><span class="required">*</span> New Password</label>
                    <input id="userpass1" name="userpass1" type="password" value="" maxlength="25" class="textbox" />
                    <span id="userpass1Error" class="formerror"><?php echo $this->_tpl_vars['error']['userpass1']; ?>
</span>
                </div>
                
                <!-- Userpass2 -->
                <div class="formelement">
                    <label for="userpass2"><span class="required">*</span> Retype New Password</label>
                    <input id="userpass2" name="userpass2" type="password" value="" maxlength="25" class="textbox" />
                    <span id="userpass2Error" class="formerror"><?php echo $this->_tpl_vars['error']['userpass2']; ?>
</span>
                </div>
                
                <!-- Submit Button -->
                <div class="formelement">
                    <input id="submit" name="submit" type="submit" value="Save" class="submit" />
                </div>
                
            </form>
        <!-- Bottom Navigation Bar -->
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "bottomnavigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 
        </div>
	<div id="onecolumnbtm"></div>
</body>
</html>