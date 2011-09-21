<?php /* Smarty version 2.6.19, created on 2011-09-07 17:04:49
         compiled from visualizations-stackedchart.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />

<script language="javascript">AC_FL_RunContent = 0;</script>
<script src="js/AC_RunActiveContent.js" language="javascript"></script>
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects,controls"></script>
<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript">
    swfobject.embedSWF("visualizations/stackedchart/stackchart.swf", "stackedchart", "860", "430", "9.0.0");
</script>
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
            <h2>Savings</h2>
            
            <!-- Tabs -->
            <div id="tabs">
                <ul>
                    <li class="first"><a href="visualizations.php?state=monthly">Monthly Top Ten</a></li>
                   <!-- <li><a href="visualizations.php?state=overall">Overall Top Ten</a></li> -->
                    <li class="current"><a href="visualizations.php?state=savings">Global Savings</a></li>
                </ul>
            </div>

        </div>
        
<div id="tabtop"></div>
        <!-- Content -->
        <div class="content" style="position: relative">
            
			
              <!-- Page Heading -->
            <h3>Global Savings (Miles Not Driven)</h3>
            <div id="stackedchart"></div>

	<!--<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="860" height="430" id="stackchart" align="middle">
	<param name="allowScriptAccess" value="sameDomain" />
	<param name="allowFullScreen" value="false" />
	<param name="movie" value="visualizations/stackedchart/stackchart.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" />	<embed src="visualizations/stackedchart/stackchart.swf" quality="high" bgcolor="#ffffff" width="860" height="430" name="stackchart" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
	</object> -->


            
            
            
            
            
            
            
        </div>
	

    	<div class="clear"></div>
    <div id="onecolumnbtm"></div>

</body>
</html>