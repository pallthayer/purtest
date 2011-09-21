<?php /* Smarty version 2.6.19, created on 2009-09-12 12:25:53
         compiled from pools-browsesort.tpl */ ?>
<?php if ($this->_tpl_vars['pools']): ?>
<img src="images/table2.gif" /><br/>
<table class="table2">
    <tr class="tablehead">
              <th>Pool</th>
              <th>Zip Code</th>
              <th>Description</th>
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
</a>&nbsp;(<?php echo $this->_tpl_vars['pools'][$this->_sections['info']['index']]['nummembers']; ?>
)</td>
                <td><a href="#" onclick="markerSelected('<?php echo $this->_tpl_vars['pools'][$this->_sections['info']['index']]['zipcode']; ?>
'); return false;"><?php echo $this->_tpl_vars['pools'][$this->_sections['info']['index']]['zipcode']; ?>
</a></td>
                <td><?php echo $this->_tpl_vars['pools'][$this->_sections['info']['index']]['description']; ?>
</td>
            </tr>
        <?php endfor; endif; ?>
    </table>
<?php else: ?>
    <p>There are currently no pools that match this criteria.</p>
<?php endif; ?>