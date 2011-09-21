<?php /* Smarty version 2.6.19, created on 2009-06-27 08:40:39
         compiled from admin-viewsavings.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script language="javascript" src="js/formfocus.js"></script>
<script language="javascript" src="js/sorttable.js"></script>

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
    
    
    	<!-- Content Bar -->
        <div id="contentbar">
            
            <!-- Page Heading -->
            <h2>Admin</h2>
            
        </div>
        
		<div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
        
        	<!-- Back to Main Menu -->
            <p><a href="admin.php?state=viewworkplaces">Back to View Workplaces</a></p>
            
            <h1>Total Savings: <?php echo $this->_tpl_vars['workplace']; ?>
</h1>
            
            <p><strong>Gas:</strong> <?php echo $this->_tpl_vars['gas']; ?>
</p>
            <p><strong>Miles:</strong> <?php echo $this->_tpl_vars['miles']; ?>
</p>
            <p><strong>Cars:</strong> <?php echo $this->_tpl_vars['cars']; ?>
</p>
            <p><strong>Emissions:</strong> <?php echo $this->_tpl_vars['emissions']; ?>
</p>
            <p><strong>Number of Pools:</strong> <?php echo $this->_tpl_vars['numpools']; ?>
</p>
            <p><strong>Number of Members:</strong> <?php echo $this->_tpl_vars['nummembers']; ?>
</p>
            
            
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