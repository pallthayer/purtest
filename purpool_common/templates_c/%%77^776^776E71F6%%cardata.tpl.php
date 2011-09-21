<?php /* Smarty version 2.6.19, created on 2008-08-06 12:27:16
         compiled from cardata.tpl */ ?>
<?php if ($this->_tpl_vars['getmake']): ?>
	<select id="make" name="make" class="select">
    	<option value="" selected="selected"> -- select -- </option>
	   	<?php $_from = $this->_tpl_vars['makes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['myloop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['myloop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['make']):
        $this->_foreach['myloop']['iteration']++;
?>
	   		<option value="<?php echo $this->_tpl_vars['make']; ?>
"><?php echo $this->_tpl_vars['make']; ?>
</option>
	   	<?php endforeach; endif; unset($_from); ?>
	</select>
<?php endif; ?>

<?php if ($this->_tpl_vars['getmodel']): ?>
	<?php if ($this->_tpl_vars['models']): ?>
		<select id="model" name="model" class="select">
        	<option value="" selected="selected"> -- select -- </option>
	    	<?php $_from = $this->_tpl_vars['models']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['myloop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['myloop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['model']):
        $this->_foreach['myloop']['iteration']++;
?>
	    		<option value="<?php echo $this->_tpl_vars['model']; ?>
"><?php echo $this->_tpl_vars['model']; ?>
</option>
	    	<?php endforeach; endif; unset($_from); ?>
	    </select>
	<?php else: ?>
    	no model - what now?
    <?php endif; ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['gettrans']): ?>
	<?php if ($this->_tpl_vars['trans']): ?>
		<select id="trans" name="trans" class="select">
        	<option value="" selected="selected"> -- select -- </option>
	    	<?php $_from = $this->_tpl_vars['trans']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['myloop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['myloop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tran']):
        $this->_foreach['myloop']['iteration']++;
?>
	    		<option value="<?php echo $this->_tpl_vars['tran']; ?>
"><?php echo $this->_tpl_vars['tran']; ?>
</option>
	    	<?php endforeach; endif; unset($_from); ?>
	    </select>
	<?php else: ?>
    	no transmission - what now?
    <?php endif; ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['getcylinders']): ?>
	<?php if ($this->_tpl_vars['cylinders']): ?>
		<select id="cylinders" name="cylinders" class="select">
        	<option value="" selected="selected"> -- select -- </option>
	    	<?php $_from = $this->_tpl_vars['cylinders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['myloop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['myloop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['cylinder']):
        $this->_foreach['myloop']['iteration']++;
?>
	    		<option value="<?php echo $this->_tpl_vars['cylinder']; ?>
"><?php echo $this->_tpl_vars['cylinder']; ?>
</option>
	    	<?php endforeach; endif; unset($_from); ?>
	    </select>
	<?php else: ?>
    	no cylinders - what now?
    <?php endif; ?>
<?php endif; ?>
