<?php /* Smarty version 2.6.19, created on 2009-03-20 07:42:30
         compiled from pools-viewitinerary.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects,controls"></script>

<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAA_2hDlr8GGBfE4xaODwzMdBTXq9fpoqsVDQwusP8wnl1JoF5PeRRah3cG9ATfaTXFHd6W2kdTXUmoow" type="text/javascript"></script>
<script src="js/icons.js"></script>
<script language="javascript" src="js/route-viewer.js"></script>

<?php echo '

<script type="text/javascript">
function html_entity_decode(s) {
	var t=document.createElement(\'textarea\');
	t.innerHTML = s;
	var v = t.value;
	t.hide();
	return v;
}
</script>

'; ?>


<script type="text/javascript">

	var workplace = '<?php echo $this->_tpl_vars['workplace']; ?>
';
	var geopositions = '<?php echo $this->_tpl_vars['vertices']; ?>
';
	var endlat = '<?php echo $this->_tpl_vars['endlat']; ?>
';
	var endlng = '<?php echo $this->_tpl_vars['endlng']; ?>
';
	var title = html_entity_decode('<?php echo $this->_tpl_vars['title']; ?>
');

</script>

<?php echo '
<script type="text/javascript">

// INITIAL EVENT LISTENERS
document.observe("dom:loaded", function() 
{
	if (GBrowserIsCompatible()) 
	{
		loadGMap(endlat, endlng);
		drawDirections(geopositions.evalJSON());
	}
});

</script>
'; ?>


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
                    <li class="current"><a href="pools.php?state=viewschedule&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Upcoming Rides</a></li>
                    <li><a href="pools.php?state=shoutbox&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Shoutbox</a></li>
                    <?php if ($this->_tpl_vars['editmode']): ?><li><a href="pools.php?state=editpool&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Edit General</a></li><?php endif; ?>
                    <?php if ($this->_tpl_vars['editmode']): ?><li><a href="pools.php?state=editmembers&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Edit Members</a></li><?php endif; ?>
                    <?php if ($this->_tpl_vars['editmode']): ?><li><a href="pools.php?state=viewroutes&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Edit Routes</a></li><?php endif; ?>
                    <?php if ($this->_tpl_vars['editmode']): ?><li><a href="pools.php?state=deletepool&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Delete Pool</a></li><?php endif; ?>
                </ul>
            </div>
        
        	
            <div class="innercolumn2 clear">
            <!-- Pool Itinerary -->
            <h4>General Information</h4>
            Date: <?php echo $this->_tpl_vars['rdate']; ?>
<br />
            Driver: <?php echo $this->_tpl_vars['driver']; ?>
<br />
            Depart from meeting place or home: <?php echo $this->_tpl_vars['dm_hour']; ?>
:<?php echo $this->_tpl_vars['dm_minute']; ?>
<?php echo $this->_tpl_vars['dm_ampm']; ?>
<br />
			Arrive at Workplace: <?php echo $this->_tpl_vars['aw_hour']; ?>
:<?php echo $this->_tpl_vars['aw_minute']; ?>
<?php echo $this->_tpl_vars['aw_ampm']; ?>
<br />
			Depart from Workplace: <?php echo $this->_tpl_vars['dw_hour']; ?>
:<?php echo $this->_tpl_vars['dw_minute']; ?>
<?php echo $this->_tpl_vars['dw_ampm']; ?>
<br />
			Additional Notes: <?php if ($this->_tpl_vars['notes']): ?><?php echo $this->_tpl_vars['notes']; ?>
<?php else: ?>---<?php endif; ?><br /><br />
            
            <h4>Route Information</h4>

            Title: <?php echo $this->_tpl_vars['title']; ?>
<br />
            Distance: <?php echo $this->_tpl_vars['distance']; ?>
 Miles<br />
            <?php if ($this->_tpl_vars['startaddress']): ?>
            	Start Address: <?php echo $this->_tpl_vars['startaddress']; ?>
 <?php echo $this->_tpl_vars['startcity']; ?>
 <?php echo $this->_tpl_vars['startstate']; ?>
 <?php echo $this->_tpl_vars['startzip']; ?>
<br />
                End Address: <?php echo $this->_tpl_vars['endaddress']; ?>
 <?php echo $this->_tpl_vars['endcity']; ?>
 <?php echo $this->_tpl_vars['endstate']; ?>
 <?php echo $this->_tpl_vars['endzip']; ?>
<br />
            <?php endif; ?>
            <?php if ($this->_tpl_vars['description']): ?>
            	Description: <?php echo $this->_tpl_vars['description']; ?>
<br />
            <?php endif; ?>
            <br />
            
            <h4>Members</h4>
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
            	<a href="profile.php?state=viewprofile&user=<?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['user_id']; ?>
"><?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['firstname']; ?>
 <?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['lastname']; ?>
</a> - 
                <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['confirm'] == 'accept'): ?>
                	<span class="green">Accepted</span>
                <?php endif; ?>
                <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['confirm'] == 'decline'): ?>
                	<span class="red">Declined</span>
                <?php endif; ?>
                <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['confirm'] == ''): ?>
                	<span class="red">Not yet confirmed</span>
                <?php endif; ?>
                <br />
            <?php endfor; endif; ?>
            </div>

            <div class="innercolumn2" id="last">
            <div id="map" style="width: 100%; height: 400px;"></div>
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