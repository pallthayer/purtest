<?php /* Smarty version 2.6.19, created on 2011-09-14 14:21:56
         compiled from events.tpl */ ?>
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

<script type="text/javascript">sortableinit = false; // Prevent initial javascript table sorting</script>

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
        
        	<!-- Search box -->
            <div id="searchevents" style="margin-bottom: 25px">
            	<form id="myform" method="post" action="events.php">
                	<input id="search" name="search" type="text" class="textbox" />
                    <input id="submit" name="submit" type="submit" value="Search" class="submit" />
                    (by title, location, description, host, etc)
                </form>
            </div>

			<?php if ($this->_tpl_vars['events']): ?>
            	<img src="images/table4.gif" /><br/>
            	<table class="table4 sortable">
                	<tr class="tablehead">
                    	<th id="first_col">Title</th>
                        <th>Date/Time</th>
                        <th>Type</th>
                        <th>Options</th>
                    </tr>
                    <?php unset($this->_sections['info']);
$this->_sections['info']['name'] = 'info';
$this->_sections['info']['loop'] = is_array($_loop=$this->_tpl_vars['events']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                        	<td><?php echo $this->_tpl_vars['events'][$this->_sections['info']['index']]['title']; ?>
</td>
                            <td sorttable_customkey="<?php echo $this->_tpl_vars['events'][$this->_sections['info']['index']]['counter']; ?>
"><?php echo $this->_tpl_vars['events'][$this->_sections['info']['index']]['startdate']; ?>
 at <?php echo $this->_tpl_vars['events'][$this->_sections['info']['index']]['starttime']; ?>
</td>
                            <td><?php echo $this->_tpl_vars['events'][$this->_sections['info']['index']]['type']; ?>
</td>
                            <td class="sorttable_nosort">
                            	<a href="events.php?state=viewdetails&event=<?php echo $this->_tpl_vars['events'][$this->_sections['info']['index']]['event_id']; ?>
">View Details</a>
                                <?php if ($this->_tpl_vars['events'][$this->_sections['info']['index']]['editmode']): ?> - <a href="events.php?state=editevent&event=<?php echo $this->_tpl_vars['events'][$this->_sections['info']['index']]['event_id']; ?>
">Edit</a><?php endif; ?>
                                <?php if ($this->_tpl_vars['events'][$this->_sections['info']['index']]['editmode']): ?> - <a href="events.php?state=removeevent&event=<?php echo $this->_tpl_vars['events'][$this->_sections['info']['index']]['event_id']; ?>
">Remove</a><?php endif; ?>
                            </td>
                        </tr>
                    <?php endfor; endif; ?>
                </table>
            <?php else: ?>
            
            	<p>There are currently no events scheduled at this time</p>
            
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