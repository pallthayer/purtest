<?php /* Smarty version 2.6.19, created on 2009-04-15 08:18:17
         compiled from wkplaceadmin.tpl */ ?>
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
            <h2>Workplace Admin</h2>
            
        </div>
        
		<div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
        
            
            <!-- Options -->
            <h3 style="margin-left: 0;">Options</h3>
            <ul>
            	<li><a href="wkplaceadmin.php?state=viewusers">View Users</a><br />
                This option allows you to view and remove Purpool user accounts associated with your workplace.<br /><br /></li>
                <li><a href="wkplaceadmin.php?state=manageannouncements">Manage Announcements</a><br />
                This option allows you to post workplace related announcements on the dashboard. Announcements can also be sent as an e-mailed as well.<br /><br /></li>
            </ul>
            
            
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