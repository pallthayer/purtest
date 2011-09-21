<?php /* Smarty version 2.6.19, created on 2011-08-18 17:03:42
         compiled from deleteconfirm.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects,controls"></script>
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

	
    
    	<br /><br />
        
        <div id="onecolumntop"></div>

        <!-- Content -->
        <div class="content">
            <h3>Delete Confirmation</h3>
            
            <!-- Warning Box -->
            <div class="red" style="margin-bottom: 15px">
            	<?php if ($this->_tpl_vars['warning'] == 'route'): ?>
                	<img src="icons/warning.gif" class="icon" />Are you sure that you would like to delete this route?
                <?php endif; ?>
                <?php if ($this->_tpl_vars['warning'] == 'pool'): ?>
                	<img src="icons/warning.gif" class="icon" />Are you sure that you would like to delete this pool?
                <?php endif; ?>
                <?php if ($this->_tpl_vars['warning'] == 'event'): ?>
                	<img src="icons/warning.gif" class="icon" />Are you sure that you would like to delete this event?
                <?php endif; ?>
                <?php if ($this->_tpl_vars['warning'] == 'member'): ?>
		        <img src="icons/warning.gif" class="icon" />Are you sure that you would like to remove this member from the pool?
                <?php endif; ?>
                <?php if ($this->_tpl_vars['warning'] == 'workplace'): ?>
		        <img src="icons/warning.gif" class="icon" />Are you sure that you would like to remove this workplace from purpool?
                <?php endif; ?>
                <?php if ($this->_tpl_vars['warning'] == 'user'): ?>
		        <img src="icons/warning.gif" class="icon" />Are you sure that you would like to remove this user from purpool?
                <?php endif; ?>
            </div>
            
            
            <!-- Delete Form -->
            <form id="myform" method="post" action="<?php echo $this->_tpl_vars['formaction']; ?>
">
            	<input id="yes" name="yes" type="submit" value="Yes" class="submit" /> 
                <input id="no" name="no" type="submit" value="No" class="cancel" />
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