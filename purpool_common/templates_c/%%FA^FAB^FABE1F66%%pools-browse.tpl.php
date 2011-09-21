<?php /* Smarty version 2.6.19, created on 2011-09-06 15:41:11
         compiled from pools-browse.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo $this->_tpl_vars['google_key']; ?>
" type="text/javascript"></script>

<script language="javascript" src="js/sorttable.js"></script>

<script type="text/javascript">

	var poolData = [
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
		<?php echo '{'; ?>

			'pool_id':'<?php echo $this->_tpl_vars['pools'][$this->_sections['info']['index']]['pool_id']; ?>
','location':'<?php echo $this->_tpl_vars['pools'][$this->_sections['info']['index']]['latitude']; ?>
,<?php echo $this->_tpl_vars['pools'][$this->_sections['info']['index']]['longitude']; ?>
', 'zipcode':'<?php echo $this->_tpl_vars['pools'][$this->_sections['info']['index']]['zipcode']; ?>
'<?php echo '}'; ?>
,
		<?php endfor; endif; ?>
		];
		
	var lat = '<?php echo $this->_tpl_vars['lat']; ?>
';
	var lng = '<?php echo $this->_tpl_vars['lng']; ?>
';
	var workplace ='<?php echo $this->_tpl_vars['workplace']; ?>
';
</script>

<?php echo '
<script type="text/javascript">
	
	var type = "pool";
	
	// INITIAL EVENT LISTENERS
	document.observe("dom:loaded", function() 
	{
		
		if (GBrowserIsCompatible()) {
			loadGMap(lat, lng);
		}
	});
	
</script>
'; ?>


<script  language="javascript" src="js/icons.js"></script>
<script language="javascript1.3" src="js/browse.js"></script>

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
                    <li class="first"><a href="pools.php">My Pools</a></li>
                    <li class="current"><a href="pools.php?state=browsepools">Browse Pools</a></li>
                </ul>
            </div>

        
		<div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
        
        
            <h3>Browse Pools</h3>
            <div class="innercolumn2" style="height:375px;width:449px;overflow-x:hidden;overflow-y:scroll;">
            <!-- Displays pool ID -->
            <div id="list"></div>

            
            <div id="browsetable">
            	<img src="images/table2.gif" /><br/>
                <table class="table2 sortable" style="width:434px;">
                	<thead>
                        <tr class="tablehead">
                            <th id="first_col">Pool</th>
                            <th>Zip Code</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
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
                                <td><?php if ($this->_tpl_vars['pools'][$this->_sections['info']['index']]['description']): ?><?php echo $this->_tpl_vars['pools'][$this->_sections['info']['index']]['description']; ?>
<?php else: ?>&nbsp;<?php endif; ?></td>
                            </tr>
                        <?php endfor; endif; ?>
                    </tbody>
                </table>
            </div>
			</div>
			
            <div class="innercolumn2" id="last" style="width:417px;">
            <!-- Map -->
            <div id="map" style="width: 417px; height: 370px;"></div>
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