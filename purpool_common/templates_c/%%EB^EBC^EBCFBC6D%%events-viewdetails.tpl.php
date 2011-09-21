<?php /* Smarty version 2.6.19, created on 2009-01-08 12:48:22
         compiled from events-viewdetails.tpl */ ?>
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
            <h2>Events</h2>
            
            <!-- Tabs -->
            <div id="tabs">
                <ul>
                    <li class="first current"><a href="events.php?state=browse">Search/Browse</a></li>
                    <li><a href="events.php?state=createevent">Create/Edit</a></li>
                </ul>
            </div>

        </div>
        
		<div id="tabtop"></div>
        <!-- Content -->
        <div class="content">

            <!-- Detailed Event Information -->
            <h2 style="margin: 0 0 10px 0; padding: 0"><?php echo $this->_tpl_vars['title']; ?>
</h2>
            
            <table style="border: none; width: auto">
            	<?php if ($this->_tpl_vars['description']): ?><tr style="border: none"><td><span class="purple">Description:</span></td><td><?php echo $this->_tpl_vars['description']; ?>
</td></tr><?php endif; ?>
                <tr style="border: none"><td><span class="purple">Type:</span></td><td><?php echo $this->_tpl_vars['type']; ?>
 <?php if ($this->_tpl_vars['typeother']): ?>: <?php echo $this->_tpl_vars['typeother']; ?>
<?php endif; ?></td></tr>
                <?php if ($this->_tpl_vars['location']): ?><tr style="border: none"><td><span class="purple">Location:</span></td><td><?php echo $this->_tpl_vars['location']; ?>
</td></tr><?php endif; ?>
                <tr style="border: none"><td><span class="purple">Start Date/Time:</span></td><td><?php echo $this->_tpl_vars['startdate']; ?>
 at <?php echo $this->_tpl_vars['starttime']; ?>
</td></tr>
                <?php if ($this->_tpl_vars['enddate']): ?><tr style="border: none"><td><span class="purple">End Date/Time:</span></td><td><?php echo $this->_tpl_vars['enddate']; ?>
 at <?php echo $this->_tpl_vars['endtime']; ?>
</td></tr><?php endif; ?>
                <?php if ($this->_tpl_vars['url']): ?><tr style="border: none"><td><span class="purple">Url:</span></td><td><a href="<?php echo $this->_tpl_vars['url']; ?>
" target="_blank"><?php echo $this->_tpl_vars['url']; ?>
</a></td></tr><?php endif; ?>
                <?php if ($this->_tpl_vars['notes']): ?><tr style="border: none"><td><span class="purple">Notes:</span></td><td><?php echo $this->_tpl_vars['notes']; ?>
</td></tr><?php endif; ?>
                <tr style="border: none"><td><span class="purple">Posted By:</span></td><td><a href="profile.php?state=viewprofile&user=<?php echo $this->_tpl_vars['user_id']; ?>
"><?php echo $this->_tpl_vars['postedby']; ?>
</a></td></tr>
            </table>

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