<?php /* Smarty version 2.6.19, created on 2011-09-06 15:41:15
         compiled from pools-profile.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script language="javascript" src="js/formfocus.js"></script>
<script language="javascript">AC_FL_RunContent = 0;</script>
<script src="js/AC_RunActiveContent.js" language="javascript"></script>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo $this->_tpl_vars['google_key']; ?>
" type="text/javascript"></script>
<script src="js/icons.js"></script>
<script language="javascript" src="js/route-viewer.js"></script>

<script type="text/javascript">

	var geopositions = '<?php echo $this->_tpl_vars['vertices']; ?>
';
	var endlat = '<?php echo $this->_tpl_vars['endlat']; ?>
';
	var endlng = '<?php echo $this->_tpl_vars['endlng']; ?>
';
	var title ='<?php echo $this->_tpl_vars['title']; ?>
';
	var workplace ='<?php echo $this->_tpl_vars['workplace']; ?>
';

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
            
            <!-- Tabs -->
			<div id="tabs">
                <ul>
                    <li class="current"><a href="pools.php"><?php if ($this->_tpl_vars['membermode']): ?>My Pools<?php else: ?>View Pools<?php endif; ?></a></li>
                    <li><a href="pools.php?state=browsepools">Browse Pools</a></li>
                </ul>
            </div>
        </div>
        
            

        
		<div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
                
	        <h3 style="margin-bottom: 0"><?php echo $this->_tpl_vars['poolname']; ?>
</h3>
            <div id="wizard">
                <ul>
                    <li class="first current"><a href="pools.php?state=viewprofile&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Profile</a></li>
                    <?php if ($this->_tpl_vars['editmode']): ?><li><a href="pools.php?state=editschedule&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Scheduler</a></li><?php endif; ?>
                    <?php if ($this->_tpl_vars['membermode']): ?><li><a href="pools.php?state=viewschedule&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Upcoming Rides</a></li><?php endif; ?>
                    <?php if ($this->_tpl_vars['membermode']): ?><li><a href="pools.php?state=shoutbox&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Shoutbox</a></li><?php endif; ?>
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
            
            <?php if ($this->_tpl_vars['invitation']): ?>
            	<div class="yellowbox clear">
	            	You have been invited to join this pool. 
	            	<a href="pools.php?state=accept&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Accept</a> <a href="pools.php?state=decline&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Decline</a>
            	</div>
            <?php endif; ?>
            
            <?php if ($this->_tpl_vars['allowinvite'] == true): ?>
            	<div class="yellowbox clear">
	            	This pool is accepting new members. <a href="pools.php?state=requestinvite&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Invitation Request</a> 
            	</div>
            <?php endif; ?>
            
            <?php if ($this->_tpl_vars['requestinvite'] == true): ?>
            	<div class="yellowbox clear">
	            	Your request has been received. Thank you! 
            	</div>
            <?php endif; ?>
            
            <div class="innercolumn clear">
            <!-- Pool Profile -->
            
            <div id="map" class="userphoto"></div>
            
            
            
            <img src="icons/access.gif" class="icon" /><?php echo $this->_tpl_vars['access']; ?>
<br />
            <div class="leftcell"><img src="icons/description.gif"  /></div><div class="rightcell"><?php echo $this->_tpl_vars['description']; ?>
</div>
            <img src="icons/created.gif" class="icon" /><?php echo $this->_tpl_vars['createdate']; ?>
<br /><br />
            
            <strong>Members (<?php echo $this->_tpl_vars['membercount']; ?>
)</strong><br />
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
            	<div class="leftcell"><img src="icons/person.gif" /></div><div class="rightcell"><a href="profile.php?user=<?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['user_id']; ?>
"><?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['firstname']; ?>
&nbsp;<?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['lastname']; ?>
</a>  (<?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['occupation']; ?>
)</div>
            <?php endfor; endif; ?><br /><br />
            
            <strong>General Schedule <br />
            (May vary week-to-week):</strong><br />
            <table>
		<?php unset($this->_sections['info']);
$this->_sections['info']['name'] = 'info';
$this->_sections['info']['loop'] = is_array($_loop=$this->_tpl_vars['times']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<?php echo $this->_tpl_vars['times'][$this->_sections['info']['index']]['string']; ?>

	    	<?php endfor; endif; ?>
	    </table>
            
            </div>
            <div class="innercolumn3" id="last">
            

            <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','657','height','255','src','visualizations/linechart/linechart','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','visualizations/linechart/linechart' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="640" height="255">
              <param name="movie" value="visualizations/linechart/linechart.swf" />
              <param name="quality" value="high" />
              <embed src="visualizations/linechart/linechart.swf" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="657" height="255"></embed>
            </object></noscript>
            </div>
            
            <div class="innercolumn">
	            <!-- Savings Information -->
                <img src="images/table1.gif" /><br/>
	            <table class="table1">
          			<tr class="tablehead">
          			<th>Cumulative Savings</th>
          			</tr>
          			<tr><td>
	            Gas Savings: <?php echo $this->_tpl_vars['poolgas']; ?>

	            	</td></tr>
          			<tr><td>
	            Miles not driven: <?php echo $this->_tpl_vars['poolmiles']; ?>

	            	</td></tr>
          			<tr><td>
	            Cars off road: <?php echo $this->_tpl_vars['poolcars']; ?>

	            	</td></tr>
          			<tr><td>
	            GH emissions savings: <?php echo $this->_tpl_vars['poolemissions']; ?>

	            	</td></tr>
	            	</table>
            </div>
            <div class="innercolumn">
            	<img src="images/table1.gif" /><br/>
	            <table class="table1">
          			<tr class="tablehead">
          			<th>This Week's Savings</th>
          			</tr>
          			<tr><td>
	            Gas Savings: <?php echo $this->_tpl_vars['weekpoolgas']; ?>
</td></tr>
          			<tr><td>
	            Miles not driven: <?php echo $this->_tpl_vars['weekpoolmiles']; ?>
</td></tr>
          			<tr><td>
	            Cars off road: <?php echo $this->_tpl_vars['weekpoolcars']; ?>
</td></tr>
          			<tr><td>
	            GH emissions savings: <?php echo $this->_tpl_vars['weekpoolemissions']; ?>
</td></tr>
	            </table>
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