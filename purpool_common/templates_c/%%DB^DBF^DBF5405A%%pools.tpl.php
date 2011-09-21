<?php /* Smarty version 2.6.19, created on 2011-09-06 15:41:07
         compiled from pools.tpl */ ?>
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
            
        </div>
        
        <!-- Tabs -->
            <div id="tabs">
                <ul>
                    <li class="first current"><a href="pools.php">My Pools</a></li>
                    <li><a href="pools.php?state=browsepools">Browse Pools</a></li>
                </ul>
            </div>

        
<div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
        	
            
            <!-- Current Pools -->
            <h3>My Pools</h3>
            
            
            
            <?php if ($this->_tpl_vars['pools']): ?>
            	<img src="images/table4.gif" /><br/>
                <table class="table4">
                    <tr class="tablehead">
                        <th>Pool</th>
                        <th>Members</th>
                        <th>Rides</th>
                        <th width="370">Recent Shouts</th>
                    </tr>
                    <?php unset($this->_sections['info']);
$this->_sections['info']['name'] = 'info';
$this->_sections['info']['loop'] = is_array($_loop=$this->_tpl_vars['pools']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                            <td class="nowrap"><a href="pools.php?state=viewprofile&pool=<?php echo $this->_tpl_vars['pools'][$this->_sections['info']['index']]['pool_id']; ?>
"><?php echo $this->_tpl_vars['pools'][$this->_sections['info']['index']]['title']; ?>
</a></td>
                            <td>
                            	<?php unset($this->_sections['info2']);
$this->_sections['info2']['name'] = 'info2';
$this->_sections['info2']['loop'] = is_array($_loop=$this->_tpl_vars['pools'][$this->_sections['info']['index']]['members']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['info2']['show'] = true;
$this->_sections['info2']['max'] = $this->_sections['info2']['loop'];
$this->_sections['info2']['step'] = 1;
$this->_sections['info2']['start'] = $this->_sections['info2']['step'] > 0 ? 0 : $this->_sections['info2']['loop']-1;
if ($this->_sections['info2']['show']) {
    $this->_sections['info2']['total'] = $this->_sections['info2']['loop'];
    if ($this->_sections['info2']['total'] == 0)
        $this->_sections['info2']['show'] = false;
} else
    $this->_sections['info2']['total'] = 0;
if ($this->_sections['info2']['show']):

            for ($this->_sections['info2']['index'] = $this->_sections['info2']['start'], $this->_sections['info2']['iteration'] = 1;
                 $this->_sections['info2']['iteration'] <= $this->_sections['info2']['total'];
                 $this->_sections['info2']['index'] += $this->_sections['info2']['step'], $this->_sections['info2']['iteration']++):
$this->_sections['info2']['rownum'] = $this->_sections['info2']['iteration'];
$this->_sections['info2']['index_prev'] = $this->_sections['info2']['index'] - $this->_sections['info2']['step'];
$this->_sections['info2']['index_next'] = $this->_sections['info2']['index'] + $this->_sections['info2']['step'];
$this->_sections['info2']['first']      = ($this->_sections['info2']['iteration'] == 1);
$this->_sections['info2']['last']       = ($this->_sections['info2']['iteration'] == $this->_sections['info2']['total']);
?>
                            		<a href="profile.php?state=viewprofile&user=<?php echo $this->_tpl_vars['pools'][$this->_sections['info']['index']]['members'][$this->_sections['info2']['index']]['user_id']; ?>
"><?php echo $this->_tpl_vars['pools'][$this->_sections['info']['index']]['members'][$this->_sections['info2']['index']]['firstname']; ?>
 <?php echo $this->_tpl_vars['pools'][$this->_sections['info']['index']]['members'][$this->_sections['info2']['index']]['lastname']; ?>
</a><br />
                                <?php endfor; endif; ?>
                            </td>
                            <td class="nowrap">
                            	<?php if ($this->_tpl_vars['pools'][$this->_sections['info']['index']]['rides']): ?>
                                    <?php unset($this->_sections['info3']);
$this->_sections['info3']['name'] = 'info3';
$this->_sections['info3']['loop'] = is_array($_loop=$this->_tpl_vars['pools'][$this->_sections['info']['index']]['rides']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['info3']['show'] = true;
$this->_sections['info3']['max'] = $this->_sections['info3']['loop'];
$this->_sections['info3']['step'] = 1;
$this->_sections['info3']['start'] = $this->_sections['info3']['step'] > 0 ? 0 : $this->_sections['info3']['loop']-1;
if ($this->_sections['info3']['show']) {
    $this->_sections['info3']['total'] = $this->_sections['info3']['loop'];
    if ($this->_sections['info3']['total'] == 0)
        $this->_sections['info3']['show'] = false;
} else
    $this->_sections['info3']['total'] = 0;
if ($this->_sections['info3']['show']):

            for ($this->_sections['info3']['index'] = $this->_sections['info3']['start'], $this->_sections['info3']['iteration'] = 1;
                 $this->_sections['info3']['iteration'] <= $this->_sections['info3']['total'];
                 $this->_sections['info3']['index'] += $this->_sections['info3']['step'], $this->_sections['info3']['iteration']++):
$this->_sections['info3']['rownum'] = $this->_sections['info3']['iteration'];
$this->_sections['info3']['index_prev'] = $this->_sections['info3']['index'] - $this->_sections['info3']['step'];
$this->_sections['info3']['index_next'] = $this->_sections['info3']['index'] + $this->_sections['info3']['step'];
$this->_sections['info3']['first']      = ($this->_sections['info3']['iteration'] == 1);
$this->_sections['info3']['last']       = ($this->_sections['info3']['iteration'] == $this->_sections['info3']['total']);
?>
                                            <a href="pools.php?state=viewitinerary&pool=<?php echo $this->_tpl_vars['pools'][$this->_sections['info']['index']]['rides'][$this->_sections['info3']['index']]['pool_id']; ?>
&rdate=<?php echo $this->_tpl_vars['pools'][$this->_sections['info']['index']]['rides'][$this->_sections['info3']['index']]['rdate']; ?>
"><?php echo $this->_tpl_vars['pools'][$this->_sections['info']['index']]['rides'][$this->_sections['info3']['index']]['ridedate']; ?>
</a> <br />
                                            <?php if ($this->_tpl_vars['pools'][$this->_sections['info']['index']]['rides'][$this->_sections['info3']['index']]['confirm'] == 'accept'): ?>
                                                <div class="leftcell"><img src="icons/confirmed.gif" title="Confirmed" /></div>
                                    	<div class="rightcell">
		                                    <span class="green"><a href="pools.php?state=viewschedule&pool=<?php echo $this->_tpl_vars['pools'][$this->_sections['info']['index']]['rides'][$this->_sections['info3']['index']]['pool_id']; ?>
">Confirmed</a></span>
	                                    </div>                  
                                            <?php endif; ?>
                                            <?php if ($this->_tpl_vars['pools'][$this->_sections['info']['index']]['rides'][$this->_sections['info3']['index']]['confirm'] == 'decline'): ?>
                                                <div class="leftcell"><img src="icons/declined.gif" title="Declined" /></div>
                                    	<div class="rightcell">
		                                    <span class="red"><a href="pools.php?state=viewschedule&pool=<?php echo $this->_tpl_vars['pools'][$this->_sections['info']['index']]['rides'][$this->_sections['info3']['index']]['pool_id']; ?>
">Declined</a></span>
	                                    </div>
                                            <?php endif; ?>
                                            <?php if ($this->_tpl_vars['pools'][$this->_sections['info']['index']]['rides'][$this->_sections['info3']['index']]['confirm'] == ''): ?>
                                               <div class="leftcell"><a href="pools.php?state=viewschedule&pool=<?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['pool_id']; ?>
"><img src="icons/unconfirmed.gif" title="Not Confirmed" /></a></div>
                                    	<div class="rightcell">
		                                    <span class="red"><a href="pools.php?state=viewschedule&pool=<?php echo $this->_tpl_vars['pools'][$this->_sections['info']['index']]['rides'][$this->_sections['info3']['index']]['pool_id']; ?>
">Awaiting Confirmation</a></span>
	                                    </div>
                                            <?php endif; ?>
                                    <?php endfor; endif; ?>
                                <?php else: ?>
                                    No rides scheduled yet.
                                <?php endif; ?>
                            </td>
                            <td>
                            	<?php if ($this->_tpl_vars['pools'][$this->_sections['info']['index']]['shouts']): ?>
                                    <?php unset($this->_sections['info3']);
$this->_sections['info3']['name'] = 'info3';
$this->_sections['info3']['loop'] = is_array($_loop=$this->_tpl_vars['pools'][$this->_sections['info']['index']]['shouts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['info3']['show'] = true;
$this->_sections['info3']['max'] = $this->_sections['info3']['loop'];
$this->_sections['info3']['step'] = 1;
$this->_sections['info3']['start'] = $this->_sections['info3']['step'] > 0 ? 0 : $this->_sections['info3']['loop']-1;
if ($this->_sections['info3']['show']) {
    $this->_sections['info3']['total'] = $this->_sections['info3']['loop'];
    if ($this->_sections['info3']['total'] == 0)
        $this->_sections['info3']['show'] = false;
} else
    $this->_sections['info3']['total'] = 0;
if ($this->_sections['info3']['show']):

            for ($this->_sections['info3']['index'] = $this->_sections['info3']['start'], $this->_sections['info3']['iteration'] = 1;
                 $this->_sections['info3']['iteration'] <= $this->_sections['info3']['total'];
                 $this->_sections['info3']['index'] += $this->_sections['info3']['step'], $this->_sections['info3']['iteration']++):
$this->_sections['info3']['rownum'] = $this->_sections['info3']['iteration'];
$this->_sections['info3']['index_prev'] = $this->_sections['info3']['index'] - $this->_sections['info3']['step'];
$this->_sections['info3']['index_next'] = $this->_sections['info3']['index'] + $this->_sections['info3']['step'];
$this->_sections['info3']['first']      = ($this->_sections['info3']['iteration'] == 1);
$this->_sections['info3']['last']       = ($this->_sections['info3']['iteration'] == $this->_sections['info3']['total']);
?>
                                        <a href="profile.php?state=viewprofile&user=<?php echo $this->_tpl_vars['pools'][$this->_sections['info']['index']]['shouts'][$this->_sections['info3']['index']]['user_id']; ?>
"><?php echo $this->_tpl_vars['pools'][$this->_sections['info']['index']]['shouts'][$this->_sections['info3']['index']]['name']; ?>
</a> (<?php echo $this->_tpl_vars['pools'][$this->_sections['info']['index']]['shouts'][$this->_sections['info3']['index']]['shoutdate']; ?>
):<br />
                                        <?php echo $this->_tpl_vars['pools'][$this->_sections['info']['index']]['shouts'][$this->_sections['info3']['index']]['message']; ?>
<br /><br />
                                    <?php endfor; endif; ?>
                                <?php else: ?>
                                	No one&rsquo;s left a shout yet.
                                <?php endif; ?>
                            </td>
                            <!--
                            <td>
                                <img src="icons/delete_small.gif" class="icon" /><a href="pools.php?state=deletepool&pool=<?php echo $this->_tpl_vars['pools'][$this->_sections['info']['index']]['pool_id']; ?>
">Delete</a>
                            </td>
                            -->
                        </tr>
                    <?php endfor; endif; ?>
                </table>
            <?php else: ?>
                <div class="yellowbox">You currently do not belong to any pools.</div>
            <?php endif; ?>
            
            <!-- Pool Buttons -->
            <div class="btn_container" >
            
                <!-- Create New Pool -->
                <span class="btn">
                  
                    <a href="pools.php?state=createpool"><img src="icons/add.gif" alt ="" class="icon" />Create Pool</a>
                </span>
                
            
            </div>
			<div class="clear"></div>
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