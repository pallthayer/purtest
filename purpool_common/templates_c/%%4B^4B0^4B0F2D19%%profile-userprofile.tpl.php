<?php /* Smarty version 2.6.19, created on 2011-09-06 15:40:49
         compiled from profile-userprofile.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript">AC_FL_RunContent = 0;</script>
<script src="js/AC_RunActiveContent.js" language="javascript"></script>
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>

<!--
<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript">
    swfobject.embedSWF("visualizations/linechart/linechart.swf", "linechart", "640", "255", "9.0.0");
</script>
-->


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
            <h2>People</h2>
            
            <div id="tabs">
              <ul>
                <li class="first"><a href="profile.php?state=browseprofiles">Browse People</a></li>
                <li class="current"><a href="profile.php?state=viewprofile"><?php if ($this->_tpl_vars['editmode']): ?>My Profile<?php else: ?>View Profile<?php endif; ?></a></li>
                    <?php if ($this->_tpl_vars['editmode']): ?><li><a href="profile.php?state=editgeneral">Edit Profile</a></li><?php endif; ?>
                    
                </ul>
            </div>
            

		</div>
        
        <div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
            
            <!-- Profile heading -->
            <h3 style="margin-bottom:2px;"><?php echo $this->_tpl_vars['firstname']; ?>
 <?php echo $this->_tpl_vars['lastname']; ?>
's Profile</h3>
            
            <div class="innercolumn" >
	            <!-- Profile Image -->
	            <div class="userphoto">
		            <?php if ($this->_tpl_vars['userphoto']): ?><a href="users/<?php echo $this->_tpl_vars['userphotolarge']; ?>
"><img src="users/<?php echo $this->_tpl_vars['userphoto']; ?>
" width="200px" alt="" /></a>
		            <?php else: ?><img src="images/defaultmemberpic.gif" alt="" />
		            <?php endif; ?>
	            </div>
	            <!-- Workplace -->
	            <img src="icons/workplace.gif" class="icon" /><a href="profile.php?state=browseprofiles&filter=workplace&workplace=<?php echo $this->_tpl_vars['workplace_id']; ?>
"><?php echo $this->_tpl_vars['workplacename']; ?>
</a><br />
	            
	            <!-- Male/Female -->
	            <img src="icons/person.gif" class="icon" /><?php echo $this->_tpl_vars['gender']; ?>
<br />
	            
	            <!-- Email -->
	            <div class="leftcell"><img src="icons/email.gif" class="icon" alt="Email" /></div><div class="rightcell"><a href="mailto:<?php echo $this->_tpl_vars['email']; ?>
"><?php echo $this->_tpl_vars['email']; ?>
</a></div>
	            
	            <!-- Phone -->
	            <img src="icons/phone.gif" class="icon" alt="Cell Phone" /><?php echo $this->_tpl_vars['cellphone']; ?>
<br />
	            <?php if ($this->_tpl_vars['workphone']): ?><img src="icons/workphone.gif" class="icon" alt="Work Phone" /><?php echo $this->_tpl_vars['workphone']; ?>
<br /><?php endif; ?>
	            
	            <!-- Zipcode -->
	            <img src="icons/marker-person.gif" class="icon" /><a href="profile.php?state=browseprofiles&zipcode=<?php echo $this->_tpl_vars['zipcode']; ?>
"><?php echo $this->_tpl_vars['zipcode']; ?>
</a><br />
	            
	            <!-- Schedule Availability -->
	            <?php if ($this->_tpl_vars['schedule']): ?><div class="leftcell"><img src="icons/schedule.gif" class="icon" /></div><div class="rightcell"><?php echo $this->_tpl_vars['schedule']; ?>
</div><?php endif; ?>
	            
	            <!-- Music preferences -->
	            <?php if ($this->_tpl_vars['music']): ?><img src="icons/music.gif" class="icon" alt="Music"/><?php echo $this->_tpl_vars['music']; ?>
<br /><?php endif; ?>
	            
	            <!-- Interests -->
	            <?php if ($this->_tpl_vars['interests']): ?><div class="leftcell"><img src="icons/loves.gif" class="icon" alt="Interests"/></div> <div class="rightcell"><?php echo $this->_tpl_vars['interests']; ?>
</div><?php endif; ?>
	            
	            <!-- Vehicle -->
	            <?php if ($this->_tpl_vars['year']): ?><div class="leftcell"><img src="icons/vehicle.gif" class="icon" alt="Vehicle" /></div> <div class="rightcell"> <?php echo $this->_tpl_vars['year']; ?>
 <?php echo $this->_tpl_vars['color']; ?>
 <?php echo $this->_tpl_vars['make']; ?>
 <?php echo $this->_tpl_vars['model']; ?>
 (<?php echo $this->_tpl_vars['seats']; ?>
 seats)</div><?php endif; ?>
                
                <!-- Pools -->
                <?php if ($this->_tpl_vars['pools']): ?>
                	<div class="leftcell"><img src="icons/vehicle.gif" class="icon" alt="Vehicle" /></div> 
                    <div class="rightcell">
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
                            <a href="pools.php?state=viewprofile&pool=<?php echo $this->_tpl_vars['pools'][$this->_sections['info']['index']]['pool_id']; ?>
"><?php echo $this->_tpl_vars['pools'][$this->_sections['info']['index']]['title']; ?>
</a><br />
	                	<?php endfor; endif; ?>
                	</div>
                <?php endif; ?>
	            
            </div>
            
            <div class="innercolumn3" id="last">
	            <!-- Savings graph 
	          	<script type="text/javascript">
				AC_FL_RunContent( 
					'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0',
					'width','640',
					'height','255',
					'src','visualizations/linechart/linechart',
					'quality','high',
					'pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash',
					'movie','visualizations/linechart/linechart'
					 ); //end AC code
				</script>
				<noscript>
                -->
                
                <div id="linechart"></div>
                
				
                	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="640" height="255">
	              <param name="movie" value="visualizations/linechart/linechart.swf" />
	              <param name="quality" value="high" />
	              <embed src="visualizations/linechart/linechart.swf" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="657" height="255"></embed>
	          		</object>
                    
                   
                    
                    
	          	<!--</noscript>-->
               
	        </div>
            
            <div class="innercolumn">
	            <!-- Savings Information -->
                <img src="images/table1.gif" /><br/>
	            <table class="table1">
          			<tr class="tablehead">
          			<th>Cumulative Savings</th>
          			</tr>
          			<tr><td>
	            Gas Savings: <?php echo $this->_tpl_vars['usergas']; ?>

	            	</td></tr>
          			<tr><td>
	            Miles not driven: <?php echo $this->_tpl_vars['usermiles']; ?>

	            	</td></tr>
          			<tr><td>
	            Cars off road: <?php echo $this->_tpl_vars['usercars']; ?>

	            	</td></tr>
          			<tr><td>
	            GH emissions savings: <?php echo $this->_tpl_vars['useremissions']; ?>

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
	            Gas Savings: <?php echo $this->_tpl_vars['weekusergas']; ?>
</td></tr>
          			<tr><td>
	            Miles not driven: <?php echo $this->_tpl_vars['weekusermiles']; ?>
</td></tr>
          			<tr><td>
	            Cars off road: <?php echo $this->_tpl_vars['weekusercars']; ?>
</td></tr>
          			<tr><td>
	            GH emissions savings: <?php echo $this->_tpl_vars['weekuseremissions']; ?>
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