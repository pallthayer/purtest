<?php /* Smarty version 2.6.19, created on 2011-09-07 17:16:21
         compiled from pools-members.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects,controls"></script>
<script language="javascript" src="js/formfocus.js"></script>
<script language="javascript" src="js/pools-members.js"></script>
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
                
	        <h3 style="margin-bottom:0;"><?php echo $this->_tpl_vars['poolname']; ?>
</h3>
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
                    <?php if ($this->_tpl_vars['editmode']): ?><li><a href="pools.php?state=editpool&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Edit General</a></li><?php endif; ?>
                    <?php if ($this->_tpl_vars['editmode']): ?><li class="current"><a href="pools.php?state=editmembers&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Edit Members</a></li><?php endif; ?>
                    <?php if ($this->_tpl_vars['editmode']): ?><li><a href="pools.php?state=viewroutes&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Edit Routes</a></li><?php endif; ?>
                    <?php if ($this->_tpl_vars['editmode']): ?><li><a href="pools.php?state=deletepool&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Delete Pool</a></li><?php endif; ?>
                </ul>
            </div>
        	
        	<div class="innercolumn">
        	<!-- Instructions -->
            <?php if ($this->_tpl_vars['instructions']): ?>
            	<div class="yellowbox">
                	You do not have any other members in your pool. <br />To invite a user, type in their
                    e-mail address and an optional personalized message.
                </div>
            <?php endif; ?>
        	
            <!-- Invite Members -->
            <h4>Invite Members</h4>
            <form id="myform" method="post" action="pools.php?state=editmembers&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
" style="margin-bottom: 15px">
                <div class="formelement">
                    <label for="email"><span class="required">*</span> E-mail Address</label>
                    <span>(Separate multiple addresses with <br />a comma or space.)</span>
                    <input id="email" name="email" type="text" value="<?php echo $this->_tpl_vars['email']; ?>
" maxlength="500" autocomplete="off" class="textbox" />
                    <span id="emailError" class="formerror"><?php echo $this->_tpl_vars['error']['email']; ?>
</span>
                </div>
                <div class="formelement">
                    <label for="message">Personalized Invitiation</label>
                    <textarea id="message" name="message" class="textbox" rows="10"><?php echo $this->_tpl_vars['message']; ?>
</textarea>
                </div>
                <input id="submit" name="submit" type="submit" value="Invite" class="submit" /> 
            </form>
            
            <!-- Line 
            <div style="margin: 20px 0 20px 0; border-bottom: 1px solid #FFC1FF"></div>-->
            
            <!-- Autocomplete choices -->
            <div id="autocomplete_choices" class="autocomplete"></div>
            </div>
            
            <div class="innercolumn3" id="last">
            
            <!-- Current Members -->
            <h4>Current Members</h4>
            <img src="images/table3.gif" /><br/>
            <form id="roleform" method="post" action="pools.php?state=editmembers&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">
		    <table class="table3">
			<tr class="tablehead">
			    <th>Name</th>
			    <th>E-mail</th>
			    <th>Role</th>
			    <th style="text-align:center;">Remove</th>
			</tr>
			<?php unset($this->_sections['info']);
$this->_sections['info']['name'] = 'info';
$this->_sections['info']['loop'] = is_array($_loop=$this->_tpl_vars['accepted']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<td><a href="profile.php?user=<?php echo $this->_tpl_vars['accepted'][$this->_sections['info']['index']]['user_id']; ?>
"><?php echo $this->_tpl_vars['accepted'][$this->_sections['info']['index']]['name']; ?>
</a></td>
				<td><a href="mailto:<?php echo $this->_tpl_vars['accepted'][$this->_sections['info']['index']]['email']; ?>
"><?php echo $this->_tpl_vars['accepted'][$this->_sections['info']['index']]['email']; ?>
</a></td>
				<td>
					<select name="<?php echo $this->_tpl_vars['accepted'][$this->_sections['info']['index']]['user_id']; ?>
">
						<?php echo $this->_tpl_vars['accepted'][$this->_sections['info']['index']]['role_select']; ?>

					</select>
				</td>
				<td style="text-align:center;"><a href="pools.php?state=removemember&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
&member=<?php echo $this->_tpl_vars['accepted'][$this->_sections['info']['index']]['user_id']; ?>
"><img src="icons/icon-delete.gif" /></a></td>
			    </tr>
			<?php endfor; endif; ?>
			    <tr>
				<td></td>
				<td><span id="roleError" class="formerror"><?php echo $this->_tpl_vars['error']['role']; ?>
</span></td>
				<td><input id="role_submit" name="role_submit" type="submit" value="Save Roles" class="submit" /> </td>
				<td></td>
			    </tr>
		    </table>
            </form>
            
            <!-- Invited Members -->
            <?php if ($this->_tpl_vars['invited']): ?>
        
                <h4>Invited Members</h4>
    
                <table class="table2">
                    <tr class="tablehead">
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Status</th>
                        <th>Options</th>
                    </tr>
                    <?php unset($this->_sections['info']);
$this->_sections['info']['name'] = 'info';
$this->_sections['info']['loop'] = is_array($_loop=$this->_tpl_vars['invited']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                            <td><?php if ($this->_tpl_vars['invited'][$this->_sections['info']['index']]['name']): ?><a href="profile.php?user=<?php echo $this->_tpl_vars['invited'][$this->_sections['info']['index']]['user_id']; ?>
"><?php echo $this->_tpl_vars['invited'][$this->_sections['info']['index']]['name']; ?>
</a><?php else: ?><em>Not registered</em><?php endif; ?></td>
                            <td><a href="mailto:<?php echo $this->_tpl_vars['invited'][$this->_sections['info']['index']]['email']; ?>
"><?php echo $this->_tpl_vars['invited'][$this->_sections['info']['index']]['email']; ?>
</a></td>
                            <td><?php echo $this->_tpl_vars['invited'][$this->_sections['info']['index']]['status']; ?>
</td>
                            <td>
                                <img src="icons/arrowgreen_small.gif" class="icon" />
                            	<a href="pools.php?state=resendinvite&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
&user=<?php echo $this->_tpl_vars['invited'][$this->_sections['info']['index']]['id']; ?>
">Resend Invite</a><br />
                                <img src="icons/delete_small.gif" class="icon" />
                            	<a href="pools.php?state=removeinvite&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
&user=<?php echo $this->_tpl_vars['invited'][$this->_sections['info']['index']]['id']; ?>
">Remove</a>
                            </td>
                        </tr>
                    <?php endfor; endif; ?>
                </table>
            <?php endif; ?>

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