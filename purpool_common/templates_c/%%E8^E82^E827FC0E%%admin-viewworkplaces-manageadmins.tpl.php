<?php /* Smarty version 2.6.19, created on 2009-01-14 12:45:09
         compiled from admin-viewworkplaces-manageadmins.tpl */ ?>
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
            <p><a href="admin.php">Back to Main Menu</a></p>

            <!-- Check for confirmation -->
            <?php if ($this->_tpl_vars['confirmation'] == 'addadmin'): ?><p class="green">A workplace administrator has been added.</p><?php endif; ?>
            <?php if ($this->_tpl_vars['confirmation'] == 'removeadmin'): ?><p class="green">A workplace administrator has been removed.</p><?php endif; ?>
            
            <!-- Back to Main Menu -->
            <form id="myform" method="post" action="admin.php?state=manageadmins&workplace=<?php echo $this->_tpl_vars['workplace_id']; ?>
">
            	<div class="formelement">
                	<label for="user">Name of Workplace Administrator for <?php echo $this->_tpl_vars['workplacename']; ?>
:</label>
                    <select name="user" class="select">
                    	<option value="">-- Select --</option>
                        <?php unset($this->_sections['info']);
$this->_sections['info']['name'] = 'info';
$this->_sections['info']['loop'] = is_array($_loop=$this->_tpl_vars['users']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                        	<option value="<?php echo $this->_tpl_vars['users'][$this->_sections['info']['index']]['user_id']; ?>
"><?php echo $this->_tpl_vars['users'][$this->_sections['info']['index']]['firstname']; ?>
 <?php echo $this->_tpl_vars['users'][$this->_sections['info']['index']]['lastname']; ?>
 (<?php echo $this->_tpl_vars['users'][$this->_sections['info']['index']]['email']; ?>
)</option>
                        <?php endfor; endif; ?>
                    </select>
                    <input id="submit" name="submit" type="submit" value="Add Workplace Administrator" class="submit" />
                </div>
            </form>
            
            <!-- Workplace Administrators -->
            <?php if ($this->_tpl_vars['admins']): ?>
                <table class="sortable">
                    <tr>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Options</th>
                    </tr>
                    <?php unset($this->_sections['info']);
$this->_sections['info']['name'] = 'info';
$this->_sections['info']['loop'] = is_array($_loop=$this->_tpl_vars['admins']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                            <td><?php echo $this->_tpl_vars['admins'][$this->_sections['info']['index']]['firstname']; ?>
 <?php echo $this->_tpl_vars['admins'][$this->_sections['info']['index']]['lastname']; ?>
</td>
                            <td><?php echo $this->_tpl_vars['admins'][$this->_sections['info']['index']]['email']; ?>
</td>
                            <td>
                                <a href="admin.php?state=removeadmin&workplace=<?php echo $this->_tpl_vars['workplace_id']; ?>
&user=<?php echo $this->_tpl_vars['admins'][$this->_sections['info']['index']]['user_id']; ?>
">Remove Administrator Role (does not delete user entirely)</a>
                            </td>
                        </tr>
                    <?php endfor; endif; ?>
                </table>
            <?php else: ?>
            	<p>There are currently no Purpool workplace administrators on file for this workplace</p>
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