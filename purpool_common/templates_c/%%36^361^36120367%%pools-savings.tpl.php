<?php /* Smarty version 2.6.19, created on 2008-10-26 11:25:11
         compiled from pools-savings.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects,controls"></script>
<script language="javascript">AC_FL_RunContent = 0;</script>
<script src="js/AC_RunActiveContent.js" language="javascript"></script>
</head>

<body>

	<!-- Header -->
    <div id="header">
    	<a href="/"><img src="images/logo.jpg" alt="Purpool" style="border:0" /></a>
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
            <h1>Pools</h1>
            
			<!-- Tabs -->
            <div id="tabs">
                <ul>
                    <li class="first"><a href="pools.php?state=viewprofile&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Profile</a></li>
                    <?php if ($this->_tpl_vars['editmode']): ?><li><a href="pools.php?state=editpool&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Edit General</a></li><?php endif; ?>
                    <?php if ($this->_tpl_vars['editmode']): ?><li><a href="pools.php?state=editmembers&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Edit Members</a></li><?php endif; ?>
                    <?php if ($this->_tpl_vars['editmode']): ?><li><a href="pools.php?state=viewroutes&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Edit Routes</a></li><?php endif; ?>
                    <li><a href="pools.php?state=viewschedule&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Schedule</a></li>
                    <li><a href="pools.php?state=shoutbox&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Shoutbox</a></li>
                    <li class="current"><a href="pools.php?state=viewsavings&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Savings</a></li>
                </ul>
            </div>
            
        </div>
        
<div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
        
        	
            
            
            <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="700" height="550" id="linechart" align="middle">
	<param name="allowScriptAccess" value="sameDomain" />
	<param name="allowFullScreen" value="false" />
	<param name="movie" value="visualizations/linechart/linechart.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" />	<embed src="visualizations/linechart/linechart.swf" quality="high" bgcolor="#ffffff" width="700" height="550" name="linechart" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
	</object>
            
            

        </div>


    
    <div id="onecolumnbtm"></div>

</body>
</html>