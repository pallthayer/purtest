<?php /* Smarty version 2.6.19, created on 2011-09-07 20:19:29
         compiled from pools-create-confirmation.tpl */ ?>
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
            <h2>Pools</h2>
            
            
			<!-- Tabs -->
			<div id="tabs">
                <ul>
                    <li class="current"><a href="pools.php">View Pools</a></li>
                    <li><a href="pools.php?state=browsepools">Browse Pools</a></li>
                </ul>
            </div>
        </div>
        
            

        
		<div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
                
	        <h3 style="margin-bottom:0;">Pool Name<!--<?php echo $this->_tpl_vars['poolname']; ?>
--></h3>
            <div id="wizard">
                <ul>
                    <li ><a href="pools.php?state=viewprofile&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Profile</a></li>
                    
                    <?php if ($this->_tpl_vars['editmode']): ?><li><a href="pools.php?state=editschedule&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Scheduler</a></li><?php endif; ?>
                    <li><a href="pools.php?state=viewschedule&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Upcoming Rides</a></li>
                    <li><a href="pools.php?state=shoutbox&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Shoutbox</a></li>
                    <?php if ($this->_tpl_vars['editmode']): ?><li class="current"><a href="pools.php?state=editpool&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Edit General</a></li><?php endif; ?>
                    <?php if ($this->_tpl_vars['editmode']): ?><li><a href="pools.php?state=editmembers&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Edit Members</a></li><?php endif; ?>
                    <?php if ($this->_tpl_vars['editmode']): ?><li><a href="pools.php?state=viewroutes&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Edit Routes</a></li><?php endif; ?>
                    <?php if ($this->_tpl_vars['editmode']): ?><li><a href="pools.php?state=deletepool&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Delete Pool</a></li><?php endif; ?>
                </ul>
            </div>
            
            <!-- Confirmation -->
            <div class="yellowbox" style="margin-top: 40px">
            	<p class="green">Your pool has been created!</p>
                <p>Before you can begin carpooling, a few more steps are required:</p>
                <ol>
                	<li><a href="pools.php?state=editmembers&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Invite users to your pool</a></li>
                    <li><a href="pools.php?state=viewroutes&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Create your route(s)</a></li>
                    <li><a href="pools.php?state=editschedule&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Decide upon a daily schedule</a></li>
                </ol>
            </div>
            
            <img src="icons/next.gif" alt="" class="icon" /><a href="pools.php?state=editmembers&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
" style="font-size: 1em">Next Step: Invite users</a>
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