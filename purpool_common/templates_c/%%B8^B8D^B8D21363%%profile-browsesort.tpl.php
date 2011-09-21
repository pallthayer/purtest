<?php /* Smarty version 2.6.19, created on 2009-02-24 04:14:28
         compiled from profile-browsesort.tpl */ ?>
<?php if ($this->_tpl_vars['members']): ?>
<img src="images/table2.gif" /><br/>
<table class="table2">
    <tr class="tablehead">
        <th><a href="profile.php?state=browseprofiles&sortby=member">Member</a></th>
        <th><a href="profile.php?state=browseprofiles&sortby=workplace">Workplace</a></th>
        <th><a href="profile.php?state=browseprofiles&sortby=zipcode">Zipcode</a></th>
    </tr>
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
        <tr>
            <td><a href="profile.php?state=viewprofile&user=<?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['user_id']; ?>
"><?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['firstname']; ?>
 <?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['lastname']; ?>
</a></td>
            <td><?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['workplace']; ?>
</td>
            <td><a href="#" onclick="markerSelected('<?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['zipcode']; ?>
'); return false;"><?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['zipcode']; ?>
</a></td> 
        </tr>
    <?php endfor; endif; ?>
</table>
<?php else: ?>
    <p>There are currently no members that match this criteria.</p>
<?php endif; ?>