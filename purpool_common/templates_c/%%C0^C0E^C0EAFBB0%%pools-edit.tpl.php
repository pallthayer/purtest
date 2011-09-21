<?php /* Smarty version 2.6.19, created on 2010-03-23 09:08:24
         compiled from pools-edit.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />

<script language="javascript" src="js/jquery.js"></script>
<?php echo '
<script type="text/javascript">
	//var inputs = $(\'#driver\');
	//Event.observe(inputs, \'click\', function() {alert("triggered");});
	    //$$(\'#driver input[type="radio"]\').addClassName("disabled");
	    //$(this).up(\'div.radio\').removeClassName("disabled");
	    
	jQuery.noConflict();
	
	jQuery(document).ready(function($){
		$("input[name=\'rotationtype\']").click(function(){
			$("input[name=\'rotationtype\']").parent(\'div.radio\').addClass("disabled");
			//$("input[name=\'rotationtype\']").parent(\'div.radio\').style.display = \'none\';
			$(this).parent(\'div.radio\').removeClass("disabled");
			
		});
	});
</script>
<style>
.disabled, .disabled option{
	color:#bbbbbb;
}
.disabled .reveal{
	display:none;
}
</style>
'; ?>


<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script language="javascript" src="js/formfocus.js"></script>
<script language="javascript" src="js/tooltips.js"></script>
</head>

<body  onload="addToolTipListeners()">

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
            <br/><br/><br/>
            <div class="innercolumn" style="width:300px;">  
            <!-- Pool Form -->
            <form id="myform" method="post" action="pools.php?state=editpool&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">
                
                <!-- Title -->
                <div class="formelement">
                    <label for="title"><span class="required">*</span> Name your pool</label>
                    <input id="title" name="title" type="text" value="<?php echo $this->_tpl_vars['title']; ?>
" maxlength="100" class="textbox" />
                    <span id="titleError" class="formerror"><?php echo $this->_tpl_vars['error']['title']; ?>
</span>
                </div>

				<!-- Access Options -->
                <div class="formelement">
                    <label for="access"><span class="required">*</span> Who is allowed to join this pool?</label>
                    <input id="accessprivate" name="access" type="radio" value="private" <?php if ($this->_tpl_vars['access'] == 'private'): ?>checked="checked"<?php endif; ?> /> Private: By invitation only <a name="private" class="tooltipClass" id="private"><img src="images/icon_tooltip.gif" border="0"/> </a><br />
                    <input id="accesspublic" name="access" type="radio" value="public" <?php if ($this->_tpl_vars['access'] == 'public'): ?>checked="checked"<?php endif; ?> /> Public: Anyone can join <a name="public" class="tooltipClass" id="public"><img src="images/icon_tooltip.gif" border="0"/> </a><br />
                </div>               
                
                <!-- Additional Information -->
                <div class="formelement">
                   	<label for="description">Description</label>
                    <textarea id="description" name="description" class="textbox" rows="8"><?php echo $this->_tpl_vars['description']; ?>
</textarea>
                </div>
                
 
                </div>
                <div class="innercolumn2" style="width:470px;">  
           <!-- Default Route -->
                <div class="formelement">
                    <label for="route">Default Route
                     <a name="private" class="tooltipClass" id="default_route"><img src="images/icon_tooltip.gif" border="0"/> </a>
                    </label>
                    <select name="route" class="select">
			    <option value="">-- select --</option>
			    <?php unset($this->_sections['info']);
$this->_sections['info']['name'] = 'info';
$this->_sections['info']['loop'] = is_array($_loop=$this->_tpl_vars['routes']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<option value="<?php echo $this->_tpl_vars['routes'][$this->_sections['info']['index']]['route_id']; ?>
" <?php if ($this->_tpl_vars['route'] == $this->_tpl_vars['routes'][$this->_sections['info']['index']]['route_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['routes'][$this->_sections['info']['index']]['title']; ?>
</option>
			    <?php endfor; endif; ?>
                    </select>
                    <span id="routError" class="formerror"><?php echo $this->_tpl_vars['error']['route']; ?>
</span>
                </div>
                <br />
			<!-- Default Driver -->
			
			<div class="formelement" id="driver">
			    <label for="driver">Driver Assignment
                <a name="private" class="tooltipClass" id="driver_assignment"><img src="images/icon_tooltip.gif" border="0"/> </a>
                </label>
	
			    <div class="radio <?php if ($this->_tpl_vars['rotation_type'] != 'default'): ?>disabled<?php endif; ?>">
                
			    <input type="radio" name="rotationtype" value="default" <?php if ($this->_tpl_vars['rotation_type'] == 'default'): ?> checked="checked"<?php endif; ?>>Select one:</input> <a name="private" class="tooltipClass" id="default"><img src="images/icon_tooltip.gif" border="0"/> </a>
			    	<div style="float:right;" class="reveal">
                    	<select name="driver" class="select">
                            <option value="">-- select --</option>
                            <?php $this->assign('day', $this->_tpl_vars['daysInSchedule'][1]); ?>
                            
                            <?php unset($this->_sections['info']);
$this->_sections['info']['name'] = 'info';
$this->_sections['info']['loop'] = is_array($_loop=$this->_tpl_vars['members']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                            <option value="<?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['user_id']; ?>
" <?php if ($this->_tpl_vars['default_driver']['monday'] == $this->_tpl_vars['members'][$this->_sections['info']['index']]['user_id'] && $this->_tpl_vars['rotation_type'] == 'default'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['name']; ?>
</option>
                            <?php endfor; endif; ?>
			    		</select>
                	</div>
			    </div>
			    <!--<div class="radio <?php if ($this->_tpl_vars['rotation_type'] != 'rotation'): ?>disabled<?php endif; ?>">
				    <input type="radio" name="rotationtype" value="rotation" <?php if ($this->_tpl_vars['rotation_type'] == 'rotation'): ?> checked="checked"<?php endif; ?>>Simple rotation</input>
			    </div> -->
			    <div class="radio <?php if ($this->_tpl_vars['rotation_type'] != 'day_of_week'): ?>disabled<?php endif; ?>">
				    <input type="radio" name="rotationtype" value="day_of_week" 
                    <?php if ($this->_tpl_vars['rotation_type'] == 'day_of_week'): ?> checked="checked"<?php endif; ?>>By day of the week:</input> <a name="private" class="tooltipClass" id="day_of_week"><img src="images/icon_tooltip.gif" border="0"/> </a>
				    <div style="float:right;" class="reveal">
                    <?php if (count ( $this->_tpl_vars['daysInSchedule'] ) == 0): ?>
    					 <div style="width:200px"><a href="pools.php?state=editschedule&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Decide upon a daily schedule</a> before you begin assigning drivers by day of the week. 
                         </div>
                    <?php else: ?>
                        <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['daysInSchedule']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
                        <?php $this->assign('day', $this->_tpl_vars['daysInSchedule'][$this->_sections['i']['index']]); ?>
                            <div class="reveal">
                                <?php echo $this->_tpl_vars['daysInSchedule'][$this->_sections['i']['index']]; ?>
: &nbsp;&nbsp;<select name="<?php echo $this->_tpl_vars['daysInSchedule'][$this->_sections['i']['index']]; ?>
" class="select" style="float:right;">
                                    <option value="">-- select --</option>
                                    <?php unset($this->_sections['info']);
$this->_sections['info']['name'] = 'info';
$this->_sections['info']['loop'] = is_array($_loop=$this->_tpl_vars['members']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                    <option value="<?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['user_id']; ?>
" <?php if ($this->_tpl_vars['default_driver'][$this->_tpl_vars['day']] == $this->_tpl_vars['members'][$this->_sections['info']['index']]['user_id'] && $this->_tpl_vars['rotation_type'] == 'day_of_week'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['name']; ?>
</option>
                                    <?php endfor; endif; ?>
                                </select>
                               <br />
                                <br />
                            </div>
                        <?php endfor; endif; ?>
                    <?php endif; ?>
                    </div>
			    </div>
			    <div class="radio <?php if ($this->_tpl_vars['rotation_type'] != 'fairness'): ?>disabled<?php endif; ?>">
				    <input type="radio" name="rotationtype" value="fairness" <?php if ($this->_tpl_vars['rotation_type'] == 'fairness'): ?> checked="checked"<?php endif; ?>>Fairness Algorithm</input> <a name="private" class="tooltipClass" id="fairness"><img src="images/icon_tooltip.gif" border="0"/> </a>
			    </div>
			    
			    
			    <span id="driverError" class="formerror"><?php echo $this->_tpl_vars['error']['driver']; ?>
</span>
			</div>
     		</div>
                <!-- Submit Button -->
                <div class="formelement" style="clear:both;">
                    <input id="submit" name="submit" type="submit" value="Save" class="submit" /> 
                </div>

            </form>
        <!-- Bottom Navigation Bar -->
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "bottomnavigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>     
        </div>


    
    <div id="onecolumnbtm"></div>
	<div id="tooltip">&nbsp;</div>
</body>
</html>