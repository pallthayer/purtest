<?php /* Smarty version 2.6.19, created on 2011-09-14 15:29:29
         compiled from contact-compose.tpl */ ?>
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
   		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "topnavigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        
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
                    <input id="name" name="name" type="text" value="<?php echo $this->_tpl_vars['name']; ?>
" class="textbox" />
                    <div id="nameError" class="formerror"><?php echo $this->_tpl_vars['error']['name']; ?>
</div>
                </div>
                <div class="formelement">
                    <label for="email">Your E-mail Address:</label>
                    <input id="email" name="email" type="text" value="<?php echo $this->_tpl_vars['email']; ?>
" class="textbox" />
                    <div id="emailError" class="formerror"><?php echo $this->_tpl_vars['error']['email']; ?>
</div>
                </div>
                <div class="formelement">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="12" class="textarea" style="width: 450px"><?php echo $this->_tpl_vars['message']; ?>
</textarea>
                    <div id="messageError" class="formerror"><?php echo $this->_tpl_vars['error']['message']; ?>
</div>
                </div>
                <div class="formelement">
                    <input id="submit" name="submit" type="submit" value="Send" class="submit" />
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