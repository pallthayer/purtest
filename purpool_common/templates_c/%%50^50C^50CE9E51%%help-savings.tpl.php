<?php /* Smarty version 2.6.19, created on 2008-12-31 05:54:41
         compiled from help-savings.tpl */ ?>
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
<h2>Savings Visualizations</h2>
<p>
<a name="1"><h3>What is the Purpool Index?</h3></a>
The Purpool index is a weighted combination of the miles not driven and the number of cars off the road due to carpooling as part of the Purpool network. The precise formula is<br />
Purpool Index = w*(miles not driven) + (1-w)*(cars off the road) where w=1/11.<br />
It is used to rank pools in terms of carpooling effectiveness in the the top ten leaders visualization. The intention is to promote some friendly competition as a way to encourage increased participation.
</p>

<p>
<a name="2"><h3>What are GH Emissions?</h3></a> 
Cars are one of the major factors in the increase of greenhouse gases. According to the EPA cars account for 51% of an average family's greenhouse gases. The savings value displayed in our visualizations is in units of pounds and is calculated using the car's mpg rating and the miles not driven as collected by Purpool. According to the EPA  (http://www.epa.gov/cleanenergy/energy-resources/refs.html) the amount of carbon dioxide emitted per gallon of motor gasoline burned is 8.81*10-3 metric tons. We convert this to pounds.
</p>


<p>
<a name="3"><h3>How do you calculate savings in $? </h3></a> 
We get up-to-date gas prices on weekly a basis, use the car's mpg as rated by the EPA, and the distance traveled as collected by Purpool.
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