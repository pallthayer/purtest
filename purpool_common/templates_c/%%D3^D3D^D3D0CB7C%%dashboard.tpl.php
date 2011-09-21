<?php /* Smarty version 2.6.19, created on 2011-08-18 17:03:14
         compiled from dashboard.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script language="javascript" src="js/formfocus.js"></script>
<script language="javascript" src="js/dashboard.js"></script>
<script language="javascript" src="js/tooltips.js"></script>
<script language="javascript">
var daysOfTheWeek = Array('Sunday','Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
var months = Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November','December');
var now = new Date();
var today = daysOfTheWeek[now.getDay()] + ", " + months[now.getMonth()] + " " + now.getDate() + ", " + now.getFullYear();
</script>
</head>

<body onload="addToolTipListeners()">

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
        <h2>Dashboard</h2>
            
    </div>
        
	<div id="onecolumntop"></div>
        
        <!-- Content -->
        <div class="content">
        	<h3>
            <!-- Today's date -->
            <script language="javascript">document.write(today)</script>
            </h3>
            <?php if ($this->_tpl_vars['isnew']): ?>
            <div>
            	<h4 style="font-size:1.0em;">Welcome to Purpool! <a href="javascript:void(0);" onclick="document.getElementById('gettingstarted').style.display = 'block';">Need help getting started?</a></h4>
            	<div>
            		<ul id="gettingstarted" style="display:none;">
            			<li><a href="profile.php">Browse People</a> - Connect with people from your workplace!</li>
				<li><a href="pools.php?state=browsepools">Browse Pools</a> - Find existing carpools in your area</li>
				<li><a href="pools.php?state=createpool">Create Pool</a> - No pools for your workplace yet? Create one!</li>
				<li><a href="community-map.php">Community Map</a> - Check out local restaurants, parks, and other points of interest</li>
				<li><a href="events.php">Events</a> - See what's happening in your workplace community, or post a new event.</li>
				<li>Need more help? Visit our <a href="help.php?state=faq">FAQ</a> page.</li>
				<li style="list-style-type:none;"><a href="javascript:void(0);" onclick="document.getElementById('gettingstarted').style.display = 'none';">(hide this)</a>

            		</ul><br />
            	</div>
            </div>
            <?php endif; ?>
        	<div class="innercolumn">
            	<img src="images/table1.gif" /><br/>
        	 	<table class="table1">
                    <tr class="tablehead">
                    	<th>What's New?</th>
                    	</tr>
	        		<!-- Newest Members -->
	     			<tr>
	     			<td>
					<strong>Newest Members</strong>	
					<br />
					<div id="members">
						<span id="memberlinks" style="margin:5px 0px 5px 0px;display:block;">
							<?php unset($this->_sections['info']);
$this->_sections['info']['name'] = 'info';
$this->_sections['info']['loop'] = is_array($_loop=$this->_tpl_vars['memberlinks']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
								<img src="icons/person.gif" /> <a href="profile.php?state=viewprofile&user=<?php echo $this->_tpl_vars['memberlinks'][$this->_sections['info']['index']]['user_id']; ?>
"><?php echo $this->_tpl_vars['memberlinks'][$this->_sections['info']['index']]['name']; ?>
</a><br />
							<?php endfor; endif; ?>
						</span>
					</div>
			        	
			        </td>
			        </tr>
	        		<!-- Weather -->
	     			<tr>
	     			<td>
					<div class="leftcell"><img src="icons/weather.gif" class="icon"/></div>
					<div class="rightcell">
				            <div id="weather">
				                <span id="weatherstatus"></span>
				                <span id="weathertemp"></span>
				                <span id="weathertext"></span>
				            </div>
			        	</div>
			        </td>
			        </tr>
	             <!-- Invitiations -->
                <?php if ($this->_tpl_vars['invitations']): ?>
                                                   <?php unset($this->_sections['info']);
$this->_sections['info']['name'] = 'info';
$this->_sections['info']['loop'] = is_array($_loop=$this->_tpl_vars['invitations']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			        	<td class="alert">
                                    <div class="leftcell"><img src="icons/alert.gif" class="icon"/></div>
                                    <div class="rightcell">
                                        You have been invited to join <a href="pools.php?state=viewprofile&pool=<?php echo $this->_tpl_vars['invitations'][$this->_sections['info']['index']]['pool_id']; ?>
"><?php echo $this->_tpl_vars['invitations'][$this->_sections['info']['index']]['title']; ?>
</a>
                                </div>
                                        </td>
                                        </tr>
                            <?php endfor; endif; ?>
            	<?php endif; ?>
                
                <!-- Announcements -->
                <?php if ($this->_tpl_vars['announcements']): ?>
                    <?php unset($this->_sections['info']);
$this->_sections['info']['name'] = 'info';
$this->_sections['info']['loop'] = is_array($_loop=$this->_tpl_vars['announcements']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                            <td class="alert">
                                <div class="leftcell"><img src="icons/shout.gif" class="icon"/></div>
                                <div class="rightcell">
                                	<strong>Announcement</strong><br />
                                    <?php echo $this->_tpl_vars['announcements'][$this->_sections['info']['index']]['announcement']; ?>

                                </div>
                             </td>
                        </tr>
                    <?php endfor; endif; ?>
            	<?php endif; ?>
                
                <!-- Requested Invitiations -->
                <?php if ($this->_tpl_vars['requesters']): ?>
                	<?php unset($this->_sections['info']);
$this->_sections['info']['name'] = 'info';
$this->_sections['info']['loop'] = is_array($_loop=$this->_tpl_vars['requesters']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			        	<td class="alert">
                        	<div class="leftcell"><img src="icons/alert.gif" class="icon"/></div>
                            <div class="rightcell">
                            	<a href="profile.php?state=viewprofile&user=<?php echo $this->_tpl_vars['requesters'][$this->_sections['info']['index']]['user_id']; ?>
"><?php echo $this->_tpl_vars['requesters'][$this->_sections['info']['index']]['firstname']; ?>
 <?php echo $this->_tpl_vars['requesters'][$this->_sections['info']['index']]['lastname']; ?>
</a> 
                                has requested to join your pool: <?php echo $this->_tpl_vars['requesters'][$this->_sections['info']['index']]['title']; ?>
<br />
                                <a href="pools.php?state=confirmrequest&pool=<?php echo $this->_tpl_vars['requesters'][$this->_sections['info']['index']]['pool_id']; ?>
&user=<?php echo $this->_tpl_vars['requesters'][$this->_sections['info']['index']]['user_id']; ?>
&confirm=accept">Accept</a> | 
                                <a href="pools.php?state=confirmrequest&pool=<?php echo $this->_tpl_vars['requesters'][$this->_sections['info']['index']]['pool_id']; ?>
&user=<?php echo $this->_tpl_vars['requesters'][$this->_sections['info']['index']]['user_id']; ?>
&confirm=decline">Decline</a> 
                            </div>
                        </td>
                     </tr>
                     <?php endfor; endif; ?>
            	<?php endif; ?>
                <?php if ($this->_tpl_vars['workplace'] == '6'): ?>
                		<tr>
                            <td class="alert">
                                <div class="leftcell"><img src="icons/cdtc.jpg" class="icon"/></div>
                                <div class="rightcell">
                                	<strong>Guaranteed Ride Home</strong><br />
                                    DEC employees are covered by the CDTA's <a href="http://www.ipool2.org/grh.aspx" target="_blank">Guaranteed Ride Home</a> program. Note that you must <a href="http://www.ipool2.org/grh.aspx" target="_blank">register</a> for this free benefit!
                                </div>
                             </td>
                        </tr>
                <?php endif; ?>
                
                
                
                </table>
			</div>
			
			<div class="innercolumn">
           
           <!-- My Rides -->
                 <table class="table1">
                 	<img src="images/table1.gif" /><br/>
                    <tr class="tablehead"><th>My Rides</th></tr>
                    	<?php if ($this->_tpl_vars['rides']): ?>
                            <?php unset($this->_sections['info']);
$this->_sections['info']['name'] = 'info';
$this->_sections['info']['loop'] = is_array($_loop=$this->_tpl_vars['rides']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                <tr><td <?php if ($this->_tpl_vars['rides'][$this->_sections['info']['index']]['confirm'] == ''): ?>class="alert"<?php endif; ?>>
                                
                                <div class="leftcell"><img src="icons/pools.gif" /></div><div class="rightcell"><a href="pools.php?state=viewprofile&pool=<?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['pool_id']; ?>
"><?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['title']; ?>
</a></div>
                                <div class="clear"></div>
                                
                                <div class="rightcell">
                                    <a href="pools.php?state=viewitinerary&pool=<?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['pool_id']; ?>
&rdate=<?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['rdate']; ?>
"><?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['ridedate']; ?>
</a> 
                                </div>
                                <div class="clear"></div>
                                
                                
                                 <?php if ($this->_tpl_vars['rides'][$this->_sections['info']['index']]['confirm'] == 'accept'): ?>
                                    	<div class="leftcell"><img src="icons/confirmed.gif" title="Confirmed" /></div>
                                    	<div class="rightcell">
		                                    <span class="green"><a href="pools.php?state=viewschedule&pool=<?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['pool_id']; ?>
">Confirmed</a></span> (<?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['accepted']; ?>
/<?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['total']; ?>
 confirmed)
	                                    </div>                                 <?php endif; ?>
                                    <?php if ($this->_tpl_vars['rides'][$this->_sections['info']['index']]['confirm'] == 'decline'): ?>
                                    	<div class="leftcell"><img src="icons/declined.gif" title="Declined" /></div>
                                    	<div class="rightcell">
		                                    <span class="red"><a href="pools.php?state=viewschedule&pool=<?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['pool_id']; ?>
">Declined</a></span> (<?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['accepted']; ?>
/<?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['total']; ?>
 confirmed)
	                                    </div>
                                    <?php endif; ?>
                                    <?php if ($this->_tpl_vars['rides'][$this->_sections['info']['index']]['confirm'] == ''): ?>
                                    	<div class="leftcell"><a href="pools.php?state=viewschedule&pool=<?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['pool_id']; ?>
"><img src="icons/unconfirmed.gif" title="Not Confirmed" /></a></div>
                                    	<div class="rightcell">
		                                    <span class="red"><a href="pools.php?state=viewschedule&pool=<?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['pool_id']; ?>
">Awaiting Confirmation</a></span> (<?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['accepted']; ?>
/<?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['total']; ?>
 confirmed)
	                                    </div>
                                    <?php endif; ?>
                                
                                <div class="clear"></div>
                                </td></tr>
                            <?php endfor; endif; ?>
                                
                        <?php else: ?>
                        	<tr><td>No upcoming rides.</td></tr>
                        <?php endif; ?>
                    
                    
                    
                    <!--<div class="tablerow">
                    </div>-->
                 </table>
            </div>
                             
				
           <div class="innercolumn" >
                <!-- Savings -->
                 <img src="images/table1.gif" /><br/>
                 <table class="table1">
                    <tr class="tablehead"><th>Savings</th></tr>
                    <tr><td>
                    <strong>My Savings</strong><br />
	                Gas savings: <?php echo $this->_tpl_vars['usergas']; ?>
<br />
	                Miles not driven <a name="milesnotdriven" class="tooltipClass" id="milesnotdriven"><img src="images/icon_tooltip.gif" border="0"/> </a>: <?php echo $this->_tpl_vars['usermiles']; ?>
<br />
	                Cars off road <a name="carsoffroad" class="tooltipClass" id="carsoffroad"><img src="images/icon_tooltip.gif" border="0"/> </a>: <?php echo $this->_tpl_vars['usercars']; ?>
<br />
	                Emissions savings <a name="emissions" class="tooltipClass" id="emissions"><img src="images/icon_tooltip.gif" border="0"/> </a>: <?php echo $this->_tpl_vars['useremissions']; ?>
 lbs
	                </td></tr>
	                                    <tr><td>
                    <strong>Overall Savings </strong><br />
	                Gas savings: <?php echo $this->_tpl_vars['workplacegas']; ?>
<br />
	                Miles not driven: <?php echo $this->_tpl_vars['workplacemiles']; ?>
<br />
	                Cars off road: <?php echo $this->_tpl_vars['workplacecars']; ?>
<br />
	                Emissions savings: <?php echo $this->_tpl_vars['workplaceemissions']; ?>
 lbs
	                </td></tr>
	                
	                 <!--<tr><td>
                    <strong>This Week's Leaders</strong><br />
	                Gas savings: <?php echo $this->_tpl_vars['workplacegas']; ?>
<br />
	                Miles not driven: <?php echo $this->_tpl_vars['workplacemiles']; ?>
<br />
	                Cars off road: <?php echo $this->_tpl_vars['workplacecars']; ?>
<br />
	                Emissions savings: <?php echo $this->_tpl_vars['workplaceemissions']; ?>
 lbs
	                </td></tr> -->
	                
	                
                </table>
           </div>
                
                 <div class="innercolumn" id="last">              
                <!-- Shoutbox -->
                <img src="images/table1.gif" /><br/>
                <table class="table1">
                    <tr class="tablehead"><th>Recent Shouts</th></tr>
                        <?php if ($this->_tpl_vars['shouts']): ?>
                            <?php unset($this->_sections['info']);
$this->_sections['info']['name'] = 'info';
$this->_sections['info']['loop'] = is_array($_loop=$this->_tpl_vars['shouts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                <td>
                                
                                <div class="leftcell"><img src="icons/shout.gif" /></div>
                                <div class="farrightcell">
                                	<?php echo $this->_tpl_vars['shouts'][$this->_sections['info']['index']]['shoutdate']; ?>

                                </div>
                                
                                <div class="rightcell">
                                    <a href="profile.php?state=viewprofile&user=<?php echo $this->_tpl_vars['shouts'][$this->_sections['info']['index']]['user_id']; ?>
"><?php echo $this->_tpl_vars['shouts'][$this->_sections['info']['index']]['name']; ?>
</a> (<a href="pools.php?state=shoutbox&pool=<?php echo $this->_tpl_vars['shouts'][$this->_sections['info']['index']]['pool_id']; ?>
"><?php echo $this->_tpl_vars['shouts'][$this->_sections['info']['index']]['title']; ?>
</a>):
                                
                                    
                                    <br />
                                    <?php echo $this->_tpl_vars['shouts'][$this->_sections['info']['index']]['message']; ?>

                                </div>
                                </td>
                                </tr>
                            <?php endfor; endif; ?>
                        <?php else: ?>
                        
                        	<tr><td>No one has left a shout recently.</td></tr>
                        <?php endif; ?>
                 </table>
                 </div>

	
        	
           <div class="clear"></div> 
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