<?php /* Smarty version 2.6.19, created on 2011-09-06 15:16:33
         compiled from admin-viewworkplaces.tpl */ ?>
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
            <h2>Admin</h2>
            
        </div>
        
		<div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
        
        	<!-- Back to Main Menu -->
            <p><a href="admin.php">Back to Main Menu</a></p>
            
            <!-- Back to Main Menu -->
            <p><a href="admin.php?state=addworkplace">Add Workplace</a></p>
            
            <!-- Workplaces -->
            <?php if ($this->_tpl_vars['workplaces']): ?>
                <table class="table4 sortable">
                    <tr>
                        <th>Workplace</th>
                        <th>Number of Memebers</th>
                        <th>Location (lat, lng)</th>
                        <th>Options</th>
                    </tr>
                    <?php unset($this->_sections['info']);
$this->_sections['info']['name'] = 'info';
$this->_sections['info']['loop'] = is_array($_loop=$this->_tpl_vars['workplaces']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['info']['show'] = true;
$this->_sections['info']['max'] = $this->_sections['info']['loop'];
$this->_sections['info']['step'] = 1;
$this->_sections['info']['start'] = $this->_sections['info']['step'] > 0 ? 0 : $this->_sections['info']['loop']-1;
if ($this->_sections['info']['show']) {
    $this->_sections['info']['total'] = $this->_sections['info']['loop'];
    if ($this->_sections['info']['total'] == 0)
        $this->_sections['info']['show'] = false;
} else
    $this->_sections['info']['total'] = 0;
if ($this->_sections['info']['show']):

            for ($this->_sections['info']['index'] = $this->_sections['info']['start'], $this->_sections['info']['iteration'] = 1;
                 $this->_sections['info']['iteration'] <= $this->_sections['info']['total'];
                 $this->_sections['info']['index'] += $this->_sections['info']['step'], $this->_sections['info']['iteration']++):
$this->_sections['info']['rownum'] = $this->_sections['info']['iteration'];
$this->_sections['info']['index_prev'] = $this->_sections['info']['index'] - $this->_sections['info']['step'];
$this->_sections['info']['index_next'] = $this->_sections['info']['index'] + $this->_sections['info']['step'];
$this->_sections['info']['first']      = ($this->_sections['info']['iteration'] == 1);
$this->_sections['info']['last']       = ($this->_sections['info']['iteration'] == $this->_sections['info']['total']);
?>
                        <tr>
                            <td><?php echo $this->_tpl_vars['workplaces'][$this->_sections['info']['index']]['name']; ?>
</td>
                            <td><?php echo $this->_tpl_vars['workplaces'][$this->_sections['info']['index']]['nummembers']; ?>
</td>
                            <td><?php echo $this->_tpl_vars['workplaces'][$this->_sections['info']['index']]['latitude']; ?>
, <?php echo $this->_tpl_vars['workplaces'][$this->_sections['info']['index']]['longitude']; ?>
</td>
                            <td>
                            	<a href="admin.php?state=sendmassmessage&workplace=<?php echo $this->_tpl_vars['workplaces'][$this->_sections['info']['index']]['workplace_id']; ?>
">Send Message</a><br />
                                <a href="admin.php?state=manageadmins&workplace=<?php echo $this->_tpl_vars['workplaces'][$this->_sections['info']['index']]['workplace_id']; ?>
">Manage Admins</a> (<?php echo $this->_tpl_vars['workplaces'][$this->_sections['info']['index']]['numadmins']; ?>
)<br />
                                <a href="admin.php?state=editworkplace&workplace=<?php echo $this->_tpl_vars['workplaces'][$this->_sections['info']['index']]['workplace_id']; ?>
">Edit</a><br />
                                <a href="admin.php?state=viewsavings&workplace=<?php echo $this->_tpl_vars['workplaces'][$this->_sections['info']['index']]['workplace_id']; ?>
">View Savings</a><br />
                                <a href="admin.php?state=deleteworkplace&workplace=<?php echo $this->_tpl_vars['workplaces'][$this->_sections['info']['index']]['workplace_id']; ?>
">Delete</a>
                            </td>
                        </tr>
                    <?php endfor; endif; ?>
                </table>
            <?php else: ?>
            	<p>There are currently no Purpool workplaces on file</p>
            <?php endif; ?>
            
            
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