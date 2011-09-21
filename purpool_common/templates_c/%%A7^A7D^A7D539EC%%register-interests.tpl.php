<?php /* Smarty version 2.6.19, created on 2011-08-18 17:04:59
         compiled from register-interests.tpl */ ?>
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
    	<a href="<?php echo $this->_tpl_vars['site_url']; ?>
" id="logo"><h1>Purpool</h1></a>
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
                    <input name="music[]" type="checkbox" value="rock" <?php if ($this->_tpl_vars['rock']): ?>checked="checked"<?php endif; ?> /> Rock<br />
                    <input name="music[]" type="checkbox" value="alternative" <?php if ($this->_tpl_vars['alternative']): ?>checked="checked"<?php endif; ?> /> Alternative<br />
                    <input name="music[]" type="checkbox" value="country" <?php if ($this->_tpl_vars['country']): ?>checked="checked"<?php endif; ?> /> Country<br />
                    <input name="music[]" type="checkbox" value="jazz" <?php if ($this->_tpl_vars['jazz']): ?>checked="checked"<?php endif; ?> /> Jazz<br />
                    <input name="music[]" type="checkbox" value="folk" <?php if ($this->_tpl_vars['folk']): ?>checked="checked"<?php endif; ?> /> Folk<br />
                    <input name="music[]" type="checkbox" value="classical" <?php if ($this->_tpl_vars['classical']): ?>checked="checked"<?php endif; ?> /> Classical<br />
                    <input name="music[]" type="checkbox" value="world" <?php if ($this->_tpl_vars['world']): ?>checked="checked"<?php endif; ?> /> World<br />
                    <input name="music[]" type="checkbox" value="oldies" <?php if ($this->_tpl_vars['oldies']): ?>checked="checked"<?php endif; ?> /> Oldies<br />
                    <input name="music[]" type="checkbox" value="talk" <?php if ($this->_tpl_vars['talk']): ?>checked="checked"<?php endif; ?> /> Talk Radio<br />
                    <input name="music[]" type="checkbox" value="other" <?php if ($this->_tpl_vars['other']): ?>checked="checked"<?php endif; ?> /> Other
                </div>
                
                <!-- Interests -->
                <div class="formelement">
                    <label for="interests"> Interests</label>
                    <textarea name="interests" rows="8" class="textarea"><?php echo $this->_tpl_vars['interests']; ?>
</textarea>
                </div>
                
                <!-- Submit Button -->
                <div class="formelement">
                    <input id="submit" name="submit" type="submit" value="Register" class="submit" />
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