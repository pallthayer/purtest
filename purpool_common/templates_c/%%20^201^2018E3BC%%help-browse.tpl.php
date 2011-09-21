<?php /* Smarty version 2.6.19, created on 2009-04-21 05:25:35
         compiled from help-browse.tpl */ ?>
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

<body onload="window.location.hash = '#'+<?php echo $this->_tpl_vars['anchor']; ?>
";>

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
            <h2>Help</h2>
            
        </div>
        
        <!-- Tabs -->
            <div id="tabs">
                <ul>
                    <li class="first"><a href="help.php?state=about">About</a></li>
                    <li class="current"><a href="help.php?state=faq">FAQ</a></li>
                    <li><a href="help.php?state=tour">Tour</a></li>
                    <li><a href="help.php?state=privacy">Privacy Policy</a></li>
                    <li><a href="help.php?state=tos">Terms of Service</a></li>
                </ul>
            </div>

        
<div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
<h2>Browsing People Profiles and Pools</h2>
<p>
<a name="1"><h3>How do determine I if someone I know is a member?</h3>
You can use the alphabetical index on the Browse Profiles page.
</a> 

</p>

<p>
<a name="2"><h3>How do I find people who live near me?</h3></a> 
Use the map on the Browse Profiles map. You can zoom and pan the map to center it on the geographic area where you live. The markers on the map represent zip codes where Purpool members live. When you click on a marker the people at your workplace who have joined Purpool and who live in that zipcode are listed to the left of the map. Click on a name to see their profile.
</p>


<p>
<a name="3">
<h3>How do I find out if there are existing pools near me? </h3>
Use the map on the Browse Pools map. You can zoom and pan the map to center it on the geographic area where you live. The markers on the map represent zip codes where there are active pools. When you click on a marker the pools in that zipcode are listed to the left of the map. Click on a pool name to see the pool profile.
</a> 

</p>

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