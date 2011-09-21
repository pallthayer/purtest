<?php /* Smarty version 2.6.19, created on 2010-03-25 06:37:34
         compiled from pools-schedule-thursday.tpl */ ?>
<?php if (! $this->_tpl_vars['thursday_route'] && ! $this->_tpl_vars['editmode']): ?>
<img src="images/table4.gif" /><br/>
  <table class="table4 ">
    <tr class="tablehead">
        <th class="nowrap"><?php echo $this->_tpl_vars['datethursday']; ?>
</th>
    </tr>
    <tr>
    	<td>The details of this ride have not yet been set.</td>
    </tr>
   </table>
<?php else: ?>

<form id="thursdayform">
<img src="images/table4.gif" /><br/>
<table class="table4 ">
    <tr class="tablehead">
        <th class="nowrap" colspan="4"><?php echo $this->_tpl_vars['datethursday']; ?>
</th>
    </tr>
            <tr>
            <td class="alert nowrap" style="width:25%">
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
    	<div class="formelement">
            <div class="rightcell">
            	
            	<a href="pools.php?state=viewprofile&user=<?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['user_id']; ?>
"><?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['name']; ?>
</a>   
            
            </div>

            <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['thursdayconfirm'] == 'accept'): ?>
                <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['editable']): ?>
                	<div id="<?php echo $this->_tpl_vars['fulldates'][4]; ?>
_usericon" class="leftcell">
                        <img class="icon" title="Confirmed" src="icons/confirmed.gif" />
                    </div>
                <?php else: ?>
                    <div id="<?php echo $this->_tpl_vars['fulldates'][4]; ?>
_icon" class="leftcell">
                        <img class="icon" title="Confirmed" src="icons/confirmed.gif" />
                    </div>
                <?php endif; ?>
                <?php if (! $this->_tpl_vars['members'][$this->_sections['info']['index']]['editable']): ?>
                	<div class="rightcell accept">Accept</div>
                <?php endif; ?>
            <?php endif; ?>
            <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['thursdayconfirm'] == 'decline'): ?>
                <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['editable']): ?>
                    <div id="<?php echo $this->_tpl_vars['fulldates'][4]; ?>
_usericon" class="leftcell">
                        <img class="icon" title="Declined" src="icons/declined.gif" />
                    </div>
                <?php else: ?>
                	<div id="<?php echo $this->_tpl_vars['fulldates'][4]; ?>
_icon" class="leftcell">
                        <img class="icon" title="Declined" src="icons/declined.gif" />
                    </div>
                <?php endif; ?>
                <?php if (! $this->_tpl_vars['members'][$this->_sections['info']['index']]['editable']): ?>
                	<div class="rightcell decline">Decline</div>
                <?php endif; ?>
            <?php endif; ?>
            <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['thursdayconfirm'] == ''): ?>
                <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['editable']): ?>
                    <div id="<?php echo $this->_tpl_vars['fulldates'][4]; ?>
_usericon" class="leftcell">
                        <img class="icon" title="Unconfirmed" src="icons/unconfirmed.gif" />
                    </div>
                <?php else: ?>
                    <div id="<?php echo $this->_tpl_vars['fulldates'][4]; ?>
_icon" class="leftcell">
                        <img class="icon" title="Unconfirmed" src="icons/unconfirmed.gif" />
                    </div>
                <?php endif; ?>
                <?php if (! $this->_tpl_vars['members'][$this->_sections['info']['index']]['editable']): ?>
                	<div class="rightcell decline">Unconfirmed</div>
                <?php endif; ?>
            <?php endif; ?>
            <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['editable']): ?>
            	<?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['thursdayeditable'] == true): ?>
                    <div class="rightcell">
                        <a id="<?php echo $this->_tpl_vars['fulldates'][4]; ?>
_accept" onclick="confirmPost('accept', '<?php echo $this->_tpl_vars['pool_id']; ?>
', '<?php echo $this->_tpl_vars['fulldates'][4]; ?>
'); return false;" href="#" 
                        <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['thursdayconfirm'] == 'accept'): ?>class="accept"<?php endif; ?>>Accept</a>
                        &nbsp;|&nbsp;
                        <a id="<?php echo $this->_tpl_vars['fulldates'][4]; ?>
_decline" onclick="confirmPost('decline', '<?php echo $this->_tpl_vars['pool_id']; ?>
', '<?php echo $this->_tpl_vars['fulldates'][4]; ?>
'); return false;" href="#" 
                        <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['thursdayconfirm'] == 'decline'): ?>class="decline"<?php endif; ?>>Decline</a>
                    </div>
                <?php else: ?>
                	<?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['thursdayconfirm'] == 'accept'): ?><div class="rightcell accept">Accept</div><?php endif; ?>
                    <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['thursdayconfirm'] == 'decline'): ?><div class="rightcell decline">Decline</div><?php endif; ?>
                    <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['thursdayconfirm'] == ''): ?><div class="rightcell decline">Unconfirmed</div><?php endif; ?>
                <?php endif; ?>
             <?php endif; ?>
            </div>        
    <?php endfor; endif; ?>
                </td>
                
                <?php if ($this->_tpl_vars['editmode']): ?>
                
            
            
                <td class="nowrap" style="width:25%">
                	<div class="formelement">
                    <label for="route">Route</label>
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
" <?php if ($this->_tpl_vars['thursday_route'] == $this->_tpl_vars['routes'][$this->_sections['info']['index']]['route_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['routes'][$this->_sections['info']['index']]['title']; ?>
</option>
                        <?php endfor; endif; ?>
                    </select>
                    <div id="thursdayRouteError" class="formerror"><?php echo $this->_tpl_vars['error']['route']; ?>
</div>
                    </div>
                    
                	<div class="formelement">
                    <label for="driver">Driver <a name="public" class="driverTooltipClass" id="thursday_driver_ranking"><img src="images/icon_tooltip.gif" border="0"/> </a>
                    </label>
                    <select name="driver" class="select">
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
" <?php if ($this->_tpl_vars['thursdaydriver'] == $this->_tpl_vars['members'][$this->_sections['info']['index']]['user_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['name']; ?>
</option>
                        <?php endfor; endif; ?>
                    </select>
                	<div id="thursdayDriverError" class="formerror"><?php echo $this->_tpl_vars['error']['driver']; ?>
</div>
                	</div>
               </td>   
                <td class="nowrap" style="width:25%">
                
                	<div class="formelement">
                    <label for="thursday_dm_hour">Depart from meeting place</label>
                    <select name="thursday_dm_hour" class="select" style="width: auto">
                        <option value="1" <?php if ($this->_tpl_vars['thursday_dm_hour'] == '1'): ?>selected="selected"<?php endif; ?>>1</option>
                        <option value="2" <?php if ($this->_tpl_vars['thursday_dm_hour'] == '2'): ?>selected="selected"<?php endif; ?>>2</option>
                        <option value="3" <?php if ($this->_tpl_vars['thursday_dm_hour'] == '3'): ?>selected="selected"<?php endif; ?>>3</option>
                        <option value="4" <?php if ($this->_tpl_vars['thursday_dm_hour'] == '4'): ?>selected="selected"<?php endif; ?>>4</option>
                        <option value="5" <?php if ($this->_tpl_vars['thursday_dm_hour'] == '5'): ?>selected="selected"<?php endif; ?>>5</option>
                        <option value="6" <?php if ($this->_tpl_vars['thursday_dm_hour'] == '6'): ?>selected="selected"<?php endif; ?>>6</option>
                        <option value="7" <?php if ($this->_tpl_vars['thursday_dm_hour'] == '7'): ?>selected="selected"<?php endif; ?>>7</option>
                        <option value="8" <?php if ($this->_tpl_vars['thursday_dm_hour'] == '8'): ?>selected="selected"<?php endif; ?>>8</option>
                        <option value="9" <?php if ($this->_tpl_vars['thursday_dm_hour'] == '9'): ?>selected="selected"<?php endif; ?>>9</option>
                        <option value="10" <?php if ($this->_tpl_vars['thursday_dm_hour'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
                        <option value="11" <?php if ($this->_tpl_vars['thursday_dm_hour'] == '11'): ?>selected="selected"<?php endif; ?>>11</option>
                        <option value="12" <?php if ($this->_tpl_vars['thursday_dw_hour'] == '12'): ?>selected="selected"<?php endif; ?>>12</option>
                    </select>
                    <select name="thursday_dm_minute" class="select" style="width: auto">
                        <option value="00" <?php if ($this->_tpl_vars['thursday_dm_minute'] == '00'): ?>selected="selected"<?php endif; ?>>00</option>
                        <option value="05" <?php if ($this->_tpl_vars['thursday_dm_minute'] == '05'): ?>selected="selected"<?php endif; ?>>05</option>
                        <option value="10" <?php if ($this->_tpl_vars['thursday_dm_minute'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
                        <option value="15" <?php if ($this->_tpl_vars['thursday_dm_minute'] == '15'): ?>selected="selected"<?php endif; ?>>15</option>
                        <option value="20" <?php if ($this->_tpl_vars['thursday_dm_minute'] == '20'): ?>selected="selected"<?php endif; ?>>20</option>
                        <option value="25" <?php if ($this->_tpl_vars['thursday_dm_minute'] == '25'): ?>selected="selected"<?php endif; ?>>25</option>
                        <option value="30" <?php if ($this->_tpl_vars['thursday_dm_minute'] == '30'): ?>selected="selected"<?php endif; ?>>30</option>
                        <option value="35" <?php if ($this->_tpl_vars['thursday_dm_minute'] == '35'): ?>selected="selected"<?php endif; ?>>35</option>
                        <option value="40" <?php if ($this->_tpl_vars['thursday_dm_minute'] == '40'): ?>selected="selected"<?php endif; ?>>40</option>
                        <option value="45" <?php if ($this->_tpl_vars['thursday_dm_minute'] == '45'): ?>selected="selected"<?php endif; ?>>45</option>
                        <option value="50" <?php if ($this->_tpl_vars['thursday_dm_minute'] == '50'): ?>selected="selected"<?php endif; ?>>50</option>
                        <option value="55" <?php if ($this->_tpl_vars['thursday_dm_minute'] == '55'): ?>selected="selected"<?php endif; ?>>55</option>
                    </select>
                    <select name="thursday_dm_ampm" class="select" style="width: auto">
                        <option value="am" <?php if ($this->_tpl_vars['thursday_dm_ampm'] == 'am'): ?>selected="selected"<?php endif; ?>>am</option>
                        <option value="pm" <?php if ($this->_tpl_vars['thursday_dm_ampm'] == 'pm'): ?>selected="selected"<?php endif; ?>>pm</option>
                    </select>
                    </div>
                    
                	<!--<div class="formelement">
                    <label for="thursday_aw_hour">Arrive at Workplace</label>
                   
                    <select name="thursday_aw_hour" class="select" style="width: auto">
                        <option value="1" <?php if ($this->_tpl_vars['thursday_aw_hour'] == '1'): ?>selected="selected"<?php endif; ?>>1</option>
                        <option value="2" <?php if ($this->_tpl_vars['thursday_aw_hour'] == '2'): ?>selected="selected"<?php endif; ?>>2</option>
                        <option value="3" <?php if ($this->_tpl_vars['thursday_aw_hour'] == '3'): ?>selected="selected"<?php endif; ?>>3</option>
                        <option value="4" <?php if ($this->_tpl_vars['thursday_aw_hour'] == '4'): ?>selected="selected"<?php endif; ?>>4</option>
                        <option value="5" <?php if ($this->_tpl_vars['thursday_aw_hour'] == '5'): ?>selected="selected"<?php endif; ?>>5</option>
                        <option value="6" <?php if ($this->_tpl_vars['thursday_aw_hour'] == '6'): ?>selected="selected"<?php endif; ?>>6</option>
                        <option value="7" <?php if ($this->_tpl_vars['thursday_aw_hour'] == '7'): ?>selected="selected"<?php endif; ?>>7</option>
                        <option value="8" <?php if ($this->_tpl_vars['thursday_aw_hour'] == '8'): ?>selected="selected"<?php endif; ?>>8</option>
                        <option value="9" <?php if ($this->_tpl_vars['thursday_aw_hour'] == '9'): ?>selected="selected"<?php endif; ?>>9</option>
                        <option value="10" <?php if ($this->_tpl_vars['thursday_aw_hour'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
                        <option value="11" <?php if ($this->_tpl_vars['thursday_aw_hour'] == '11'): ?>selected="selected"<?php endif; ?>>11</option>
                        <option value="12" <?php if ($this->_tpl_vars['thursday_aw_hour'] == '12'): ?>selected="selected"<?php endif; ?>>12</option>
                    </select>
                    <select name="thursday_aw_minute" class="select" style="width: auto">
                        <option value="00" <?php if ($this->_tpl_vars['thursday_aw_minute'] == '00'): ?>selected="selected"<?php endif; ?>>00</option>
                        <option value="05" <?php if ($this->_tpl_vars['thursday_aw_minute'] == '05'): ?>selected="selected"<?php endif; ?>>05</option>
                        <option value="10" <?php if ($this->_tpl_vars['thursday_aw_minute'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
                        <option value="15" <?php if ($this->_tpl_vars['thursday_aw_minute'] == '15'): ?>selected="selected"<?php endif; ?>>15</option>
                        <option value="20" <?php if ($this->_tpl_vars['thursday_aw_minute'] == '20'): ?>selected="selected"<?php endif; ?>>20</option>
                        <option value="25" <?php if ($this->_tpl_vars['thursday_aw_minute'] == '25'): ?>selected="selected"<?php endif; ?>>25</option>
                        <option value="30" <?php if ($this->_tpl_vars['thursday_aw_minute'] == '30'): ?>selected="selected"<?php endif; ?>>30</option>
                        <option value="35" <?php if ($this->_tpl_vars['thursday_aw_minute'] == '35'): ?>selected="selected"<?php endif; ?>>35</option>
                        <option value="40" <?php if ($this->_tpl_vars['thursday_aw_minute'] == '40'): ?>selected="selected"<?php endif; ?>>40</option>
                        <option value="45" <?php if ($this->_tpl_vars['thursday_aw_minute'] == '45'): ?>selected="selected"<?php endif; ?>>45</option>
                        <option value="50" <?php if ($this->_tpl_vars['thursday_aw_minute'] == '50'): ?>selected="selected"<?php endif; ?>>50</option>
                        <option value="55" <?php if ($this->_tpl_vars['thursday_aw_minute'] == '55'): ?>selected="selected"<?php endif; ?>>55</option>
                    </select>
                    <select name="thursday_aw_ampm" class="select" style="width: auto">
                        <option value="am" <?php if ($this->_tpl_vars['thursday_aw_ampm'] == 'am'): ?>selected="selected"<?php endif; ?>>am</option>
                        <option value="pm" <?php if ($this->_tpl_vars['thursday_aw_ampm'] == 'pm'): ?>selected="selected"<?php endif; ?>>pm</option>
                    </select>
                    </div> /-->
                    
                	<div class="formelement">
                    <label for="thursday_dw_hour">Depart from Workplace</label>
                    <select name="thursday_dw_hour" class="select" style="width: auto">
                        <option value="1" <?php if ($this->_tpl_vars['thursday_dw_hour'] == '1'): ?>selected="selected"<?php endif; ?>>1</option>
                        <option value="2" <?php if ($this->_tpl_vars['thursday_dw_hour'] == '2'): ?>selected="selected"<?php endif; ?>>2</option>
                        <option value="3" <?php if ($this->_tpl_vars['thursday_dw_hour'] == '3'): ?>selected="selected"<?php endif; ?>>3</option>
                        <option value="4" <?php if ($this->_tpl_vars['thursday_dw_hour'] == '4'): ?>selected="selected"<?php endif; ?>>4</option>
                        <option value="5" <?php if ($this->_tpl_vars['thursday_dw_hour'] == '5'): ?>selected="selected"<?php endif; ?>>5</option>
                        <option value="6" <?php if ($this->_tpl_vars['thursday_dw_hour'] == '6'): ?>selected="selected"<?php endif; ?>>6</option>
                        <option value="7" <?php if ($this->_tpl_vars['thursday_dw_hour'] == '7'): ?>selected="selected"<?php endif; ?>>7</option>
                        <option value="8" <?php if ($this->_tpl_vars['thursday_dw_hour'] == '8'): ?>selected="selected"<?php endif; ?>>8</option>
                        <option value="9" <?php if ($this->_tpl_vars['thursday_dw_hour'] == '9'): ?>selected="selected"<?php endif; ?>>9</option>
                        <option value="10" <?php if ($this->_tpl_vars['thursday_dw_hour'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
                        <option value="11" <?php if ($this->_tpl_vars['thursday_dw_hour'] == '11'): ?>selected="selected"<?php endif; ?>>11</option>
                        <option value="12" <?php if ($this->_tpl_vars['thursday_dw_hour'] == '12'): ?>selected="selected"<?php endif; ?>>12</option>
                    </select>
                    <select name="thursday_dw_minute" class="select" style="width: auto">
                        <option value="00" <?php if ($this->_tpl_vars['thursday_dw_minute'] == '00'): ?>selected="selected"<?php endif; ?>>00</option>
                        <option value="05" <?php if ($this->_tpl_vars['thursday_dw_minute'] == '05'): ?>selected="selected"<?php endif; ?>>05</option>
                        <option value="10" <?php if ($this->_tpl_vars['thursday_dw_minute'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
                        <option value="15" <?php if ($this->_tpl_vars['thursday_dw_minute'] == '15'): ?>selected="selected"<?php endif; ?>>15</option>
                        <option value="20" <?php if ($this->_tpl_vars['thursday_dw_minute'] == '20'): ?>selected="selected"<?php endif; ?>>20</option>
                        <option value="25" <?php if ($this->_tpl_vars['thursday_dw_minute'] == '25'): ?>selected="selected"<?php endif; ?>>25</option>
                        <option value="30" <?php if ($this->_tpl_vars['thursday_dw_minute'] == '30'): ?>selected="selected"<?php endif; ?>>30</option>
                        <option value="35" <?php if ($this->_tpl_vars['thursday_dw_minute'] == '35'): ?>selected="selected"<?php endif; ?>>35</option>
                        <option value="40" <?php if ($this->_tpl_vars['thursday_dw_minute'] == '40'): ?>selected="selected"<?php endif; ?>>40</option>
                        <option value="45" <?php if ($this->_tpl_vars['thursday_dw_minute'] == '45'): ?>selected="selected"<?php endif; ?>>45</option>
                        <option value="50" <?php if ($this->_tpl_vars['thursday_dw_minute'] == '50'): ?>selected="selected"<?php endif; ?>>50</option>
                        <option value="55" <?php if ($this->_tpl_vars['thursday_dw_minute'] == '55'): ?>selected="selected"<?php endif; ?>>55</option>
                    </select>
                    <select name="thursday_dw_ampm" class="select" style="width: auto">
                        <option value="am" <?php if ($this->_tpl_vars['thursday_dw_ampm'] == 'am'): ?>selected="selected"<?php endif; ?>>am</option>
                        <option value="pm" <?php if ($this->_tpl_vars['thursday_dw_ampm'] == 'pm'): ?>selected="selected"<?php endif; ?>>pm</option>
                    </select>
                    </div> 
                </td>
	                <td style="width:25%">
	                    <label for="thursday_notes">Additional Notes</label>
	                    <input name="thursday_notes" type="text" maxlength="255" value="<?php echo $this->_tpl_vars['thursday_notes']; ?>
" class="textbox" />
	                    <!--<textarea id="message" name="thursday_notes" class="textbox" value="<?php echo $this->_tpl_vars['thursday_notes']; ?>
" rows="6" style="width: 199px;"><?php echo $this->_tpl_vars['message']; ?>
</textarea> -->
	                    
                <input name="day" type="hidden" value="thursday" />
                <input name="pool" type="hidden" value="<?php echo $this->_tpl_vars['pool_id']; ?>
" />
                <input name="rdate" type="hidden" value="<?php echo $this->_tpl_vars['fulldates'][4]; ?>
" />
                <!-- <input id="thursday_submit" name="submit" type="submit" value="Save" class="submit" /> -->
                <button value="Save" id="thursday_submit" name="submit" type="submit" class="btn">
                	<span>
                    Finalize
                	</span>
                </button>
                <?php if ($this->_tpl_vars['thursdayissaved']): ?>
                <span class="btn" >
                    <a href="pools.php?state=viewitinerary&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
&rdate=<?php echo $this->_tpl_vars['thursday_ride']; ?>
">
                    <img src="icons/schedule.gif" alt ="" class="icon" />View Itinerary</a>
                </span>
                <?php endif; ?>
                <br />
                <img id="thursday_indicator" src="images/indicator.gif" alt="" class="indicator" style="display: none;"/>
                </td>
           
                
                <?php else: ?>
                <td class="nowrap" style="width:25%">
                	<div class="formelement">
                    <span class="purple">Route</span><br />
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
                            <?php if ($this->_tpl_vars['thursday_route'] == $this->_tpl_vars['routes'][$this->_sections['info']['index']]['route_id']): ?><?php echo $this->_tpl_vars['routes'][$this->_sections['info']['index']]['title']; ?>
<?php endif; ?>
                        <?php endfor; endif; ?>
                    </div>
                	<div class="formelement">
                    <span class="purple">Driver</span><br />
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
                            <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['thursdaydriver'] == $this->_tpl_vars['members'][$this->_sections['info']['index']]['user_id']): ?><?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['name']; ?>
<?php endif; ?>
                        <?php endfor; endif; ?>
                    </div>
                </td>
                <td class="nowrap" style="width:25%">
                	<div class="formelement">
                    <span class="purple">Depart from meeting place</span><br />
                        <?php echo $this->_tpl_vars['thursday_dm_hour']; ?>
:<?php echo $this->_tpl_vars['thursday_dm_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['thursday_dm_ampm']; ?>

                    </div>
                	<!-- <div class="formelement">
                    <span class="purple">Arrive at Workplace</span><br />
                        <?php echo $this->_tpl_vars['thursday_aw_hour']; ?>
:<?php echo $this->_tpl_vars['thursday_aw_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['thursday_aw_ampm']; ?>

                    </div> /-->
                	<div class="formelement">
                    <span class="purple">Depart from Workplace</span><br />
                        <?php echo $this->_tpl_vars['thursday_dw_hour']; ?>
:<?php echo $this->_tpl_vars['thursday_dw_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['thursday_dw_ampm']; ?>

                    </div>
                </td>
                <td>
                	<label for="thursday_notes">Additional Notes</label>
	                    <input name="thursday_notes" type="text" maxlength="255" readonly="readonly" value="<?php echo $this->_tpl_vars['thursday_notes']; ?>
" class="textbox" />
	               <span class="btn" >
                    <a href="pools.php?state=viewitinerary&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
&rdate=<?php echo $this->_tpl_vars['thursday_ride']; ?>
">
                    <img src="icons/schedule.gif" alt ="" class="icon" />View Itinerary</a>
                </span>
                </td>    
                        <?php endif; ?>

                
        </tr>
</table>
 </form>
<?php endif; ?>
                <div class="clear"></div>