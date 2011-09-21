<?php /* Smarty version 2.6.19, created on 2011-08-18 18:10:35
         compiled from pools-schedule.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'pools-schedule.tpl', 230, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects,controls"></script>
<script language="javascript" src="js/formfocus.js"></script>
<script language="javascript" src="js/pools-schedule.js"></script>
<script language="javascript" src="js/lightbox.js"></script>
<script language="javascript" src="js/tooltips.js"></script>

<?php echo '

<style type="text/css">

.accept, .accept:link, .accept:visited {
	color: #690;
	text-decoration: none;
}

.accept:hover {
	color: #9c0;
	text-decoration: none;
}

.decline, .decline:link, .decline:visited {
	color: #900;
	text-decoration: none;
}

.decline:hover {
	color: #c00;
	text-decoration: none;
}
#calendar, #calendar tr, #calendar td{
	border-width:0px;
	margin:0px;
	padding:0px;
}

#calendar td{
	width:120px;
	padding:0px;
	margin:0px 4px 0px 0px;
	border: solid #cecece;
	border-width:0px 1px 1px;
	background-color: #FFFFFF;
}

#calendar{
	margin-top: 25px;
	background-color: #cecece;
	width:848px;
}
#calendar div{
	background-color:#ffffff;
	color: #505050;
	font-size:10px;
	padding:15px 4px 5px 6px;
	line-height:120%;
}
#calendar div.saved{
	background-color: #DCEADB;
	border-color: #7FA48C;
}
#calendar div.unsaved{
	background-color: #FDD5D2;
	border-color: #CD1111;
}
#calendar div.past{
	background-color: #dedede;
	border-color: #777777;
	color:#aaaaaa;
}
#calendar td.past{
	background-color: #dedede;
}
#calendar .head{
	height:auto;
	color:#ffffff;
	background-color:#5D1DB9;
	border:solid 2px #4A1596;
	font-size:0.8em;
	padding:8px 0px;
	text-align:center;
}
.finalized, .unfinalized{
	display:block;
	height:30px;
	padding:4px 0px 0px 30px;
	background-image: url(icons/finalized.gif);
	background-repeat:no-repeat;
}

.unfinalized{
	background-image: url(icons/unfinalized.gif);
	color: #CD1111;
}
.past .unfinalized{color:#AC6F69;}

.leightbox {
	color: #333;
	display: none;
	position: absolute;
	top: 25%;
	left: 5%;
	width: 880px;
	padding: 1em;
	border: 2px solid #B8B8B8;
	background-color: white;
	text-align: left;
	z-index:1001;
	overflow: auto;	
}

#overlay{
	display:none;
	position:absolute;
	top:0;
	left:0;
	width:100%;
	height:100%;
	z-index:1000;
	background-color:#333;
	-moz-opacity: 0.8;
	opacity:.80;
	filter: alpha(opacity=80);
}

.lbAction{
	float:right;
}

.lightbox[id]{ /* IE6 and below Can\'t See This */    position:fixed;    }#overlay[id]{ /* IE6 and below Can\'t See This */    position:fixed;    }
</style>

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
                    <li class="first"><a href="pools.php?state=viewprofile&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
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
                
                
                
            <div class="clear">
                <!-- View New Schedule                 
                <div class="btn_container">
                <?php if ($this->_tpl_vars['proposedschedule']): ?>
                    <span class="btn">
                        <img src="icons/alert.gif" alt ="" class="icon" />
                        <a href="pools.php?state=editschedule&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">View Proposed Schedule</a>
                    </span>
                <?php endif; ?>
	            </div>
	            -->
            
            
            <!-- Departure -->
            <div class="purplebox" style="padding: 15px;">
                <div style="position: relative">
                    <?php echo $this->_tpl_vars['daterange']; ?>

                    <div style="position: absolute; top: -2px; right: 0">
                        <a href="pools.php?state=viewschedule&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
&week=<?php echo $this->_tpl_vars['pweek']; ?>
&year=<?php echo $this->_tpl_vars['pyear']; ?>
" style="text-decoration: none">
                        Previous Week <img src="icons/previous.gif" class="icon" border="0" alt="Previous Week" title="Previous Week" style="margin-right: 0" /></a>&nbsp;                        <a href="pools.php?state=viewschedule&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
&week=<?php echo $this->_tpl_vars['nweek']; ?>
&year=<?php echo $this->_tpl_vars['nyear']; ?>
" style="text-decoration: none">
                        <img src="icons/next.gif" class="icon" alt="Next Week" title="Next Week" border="0" /> Next Week</a>
                    </div>
                </div>
                
                <table id="calendar" border="0" cellspacing="0" cellpadding="0">
                	<tr>
                		<td <?php if ($this->_tpl_vars['mondayispast']): ?>class="past"<?php endif; ?>>
                			<div class="head"><?php echo $this->_tpl_vars['shortdates'][1]; ?>
</div>
                			<div class="<?php if ($this->_tpl_vars['monday']): ?><?php if ($this->_tpl_vars['mondayissaved']): ?>saved <?php else: ?>unsaved <?php endif; ?><?php endif; ?><?php if ($this->_tpl_vars['mondayispast']): ?>past<?php endif; ?>">
                				<?php if ($this->_tpl_vars['monday']): ?>
                					Depart from Meeting Place: 
                					<?php echo $this->_tpl_vars['monday_dm_hour']; ?>
:<?php echo $this->_tpl_vars['monday_dm_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['monday_dm_ampm']; ?>
<br /><br />
                					
                					Depart from Workplace: 
                        				<?php echo $this->_tpl_vars['monday_dw_hour']; ?>
:<?php echo $this->_tpl_vars['monday_dw_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['monday_dw_ampm']; ?>
<br /><br />
                        				
                        				<?php if ($this->_tpl_vars['mondayissaved']): ?>
	                        				<?php echo $this->_tpl_vars['mondayaccepted']; ?>
/<?php echo count($this->_tpl_vars['members']); ?>
 members accepted<br /><br />
	                        			<?php endif; ?>
                        				
                        				Driver:<br />
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
							    <?php if ($this->_tpl_vars['mondaydriver'] == $this->_tpl_vars['members'][$this->_sections['info']['index']]['user_id']): ?><?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['name']; ?>
<?php endif; ?>
                        				<?php endfor; endif; ?><br /><br />
                        				
                        				<?php if ($this->_tpl_vars['mondayissaved']): ?>
	                        				<span class="finalized">Finalized by <br />Pool Leader</span><br />
	                        				
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
	                        					<?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['editable']): ?>
										<?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['mondayeditable'] == true): ?>
										    <span>
											<a id="<?php echo $this->_tpl_vars['fulldates'][1]; ?>
_accept" onclick="confirmPost('accept', '<?php echo $this->_tpl_vars['pool_id']; ?>
', '<?php echo $this->_tpl_vars['fulldates'][1]; ?>
'); return false;" href="#" 
											<?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['mondayconfirm'] == 'accept'): ?>class="accept"<?php endif; ?>>Accept</a>
											&nbsp;|&nbsp;
											<a id="<?php echo $this->_tpl_vars['fulldates'][1]; ?>
_decline" onclick="confirmPost('decline', '<?php echo $this->_tpl_vars['pool_id']; ?>
', '<?php echo $this->_tpl_vars['fulldates'][1]; ?>
'); return false;" href="#" 
											<?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['mondayconfirm'] == 'decline'): ?>class="decline"<?php endif; ?>>Decline</a>
										    </span>
										<?php else: ?>
										    <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['mondayconfirm'] == 'accept'): ?><span class="accept">Accept</span><?php endif; ?>
										    <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['mondayconfirm'] == 'decline'): ?><span class="decline">Decline</span><?php endif; ?>
										    <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['mondayconfirm'] == ''): ?><span class="decline">Unconfirmed</span><?php endif; ?>
										<?php endif; ?>
									<?php endif; ?>
	                        				<?php endfor; endif; ?><br /><br />
	                        			<?php else: ?>
	                        				<span class="unfinalized">Not Finalized<br /> by Pool Leader!</span><br />
	                        			<?php endif; ?>
                        				
                        				<a href="javascript:void();" rel="mondaydiv" class="lbOn">
                        					<?php if ($this->_tpl_vars['editmode']): ?>
                        						View/Edit Details
                        					<?php else: ?>
                        						View Details
                        					<?php endif; ?>
                        				</a>
                				<?php endif; ?>
                			</div>
                		</td>
                		<td <?php if ($this->_tpl_vars['tuesdayispast']): ?>class="past"<?php endif; ?>>
                			<div class="head"><?php echo $this->_tpl_vars['shortdates'][2]; ?>
</div>
                			<div class="<?php if ($this->_tpl_vars['tuesday']): ?><?php if ($this->_tpl_vars['tuesdayissaved']): ?>saved <?php else: ?>unsaved <?php endif; ?><?php endif; ?><?php if ($this->_tpl_vars['tuesdayispast']): ?>past<?php endif; ?>">
                				<?php if ($this->_tpl_vars['tuesday']): ?>
                					Depart from Meeting Place: 
                					<?php echo $this->_tpl_vars['tuesday_dm_hour']; ?>
:<?php echo $this->_tpl_vars['tuesday_dm_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['tuesday_dm_ampm']; ?>
<br /><br />
                					
                					Depart from Workplace: 
                        				<?php echo $this->_tpl_vars['tuesday_dw_hour']; ?>
:<?php echo $this->_tpl_vars['tuesday_dw_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['tuesday_dw_ampm']; ?>
<br /><br />
                        				
                        				<?php if ($this->_tpl_vars['tuesdayissaved']): ?>
	                        				<?php echo $this->_tpl_vars['tuesdayaccepted']; ?>
/<?php echo count($this->_tpl_vars['members']); ?>
 members accepted<br /><br />
	                        			<?php endif; ?>
                        				
                        				Driver:<br />
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
							    <?php if ($this->_tpl_vars['tuesdaydriver'] == $this->_tpl_vars['members'][$this->_sections['info']['index']]['user_id']): ?><?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['name']; ?>
<?php endif; ?>
                        				<?php endfor; endif; ?><br /><br />
                        				
                        				<?php if ($this->_tpl_vars['tuesdayissaved']): ?>
	                        				<span class="finalized">Finalized by <br />Pool Leader</span><br />
	                        				
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
	                        					<?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['editable']): ?>
										<?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['tuesdayeditable'] == true): ?>
										    <span>
											<a id="<?php echo $this->_tpl_vars['fulldates'][2]; ?>
_accept" onclick="confirmPost('accept', '<?php echo $this->_tpl_vars['pool_id']; ?>
', '<?php echo $this->_tpl_vars['fulldates'][2]; ?>
'); return false;" href="#" 
											<?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['tuesdayconfirm'] == 'accept'): ?>class="accept"<?php endif; ?>>Accept</a>
											&nbsp;|&nbsp;
											<a id="<?php echo $this->_tpl_vars['fulldates'][2]; ?>
_decline" onclick="confirmPost('decline', '<?php echo $this->_tpl_vars['pool_id']; ?>
', '<?php echo $this->_tpl_vars['fulldates'][2]; ?>
'); return false;" href="#" 
											<?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['tuesdayconfirm'] == 'decline'): ?>class="decline"<?php endif; ?>>Decline</a>
										    </span>
										<?php else: ?>
										    <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['tuesdayconfirm'] == 'accept'): ?><span class="accept">Accept</span><?php endif; ?>
										    <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['tuesdayconfirm'] == 'decline'): ?><span class="decline">Decline</span><?php endif; ?>
										    <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['tuesdayconfirm'] == ''): ?><span class="decline">Unconfirmed</span><?php endif; ?>
										<?php endif; ?>
									<?php endif; ?>
	                        				<?php endfor; endif; ?><br /><br />
	                        			<?php else: ?>
	                        				<span class="unfinalized">Not Finalized<br /> by Pool Leader!</span><br />
	                        			<?php endif; ?>
                        				
                        				<a href="javascript:void();" rel="tuesdaydiv" class="lbOn">
                        					<?php if ($this->_tpl_vars['editmode']): ?>
                        						View/Edit Details
                        					<?php else: ?>
                        						View Details
                        					<?php endif; ?>
                        				</a>
                				<?php endif; ?>
                			</div>
                		</td>
                		<td <?php if ($this->_tpl_vars['wednesdayispast']): ?>class="past"<?php endif; ?>>
                			<div class="head"><?php echo $this->_tpl_vars['shortdates'][3]; ?>
</div>
                			<div class="<?php if ($this->_tpl_vars['wednesday']): ?><?php if ($this->_tpl_vars['wednesdayissaved']): ?>saved <?php else: ?>unsaved <?php endif; ?><?php endif; ?><?php if ($this->_tpl_vars['wednesdayispast']): ?>past<?php endif; ?>">
                				<?php if ($this->_tpl_vars['wednesday']): ?>
                					Depart from Meeting Place: 
                					<?php echo $this->_tpl_vars['wednesday_dm_hour']; ?>
:<?php echo $this->_tpl_vars['wednesday_dm_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['wednesday_dm_ampm']; ?>
<br /><br />
                					
                					Depart from Workplace: 
                        				<?php echo $this->_tpl_vars['wednesday_dw_hour']; ?>
:<?php echo $this->_tpl_vars['wednesday_dw_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['wednesday_dw_ampm']; ?>
<br /><br />
                        				
                        				<?php if ($this->_tpl_vars['wednesdayissaved']): ?>
	                        				<?php echo $this->_tpl_vars['wednesdayaccepted']; ?>
/<?php echo count($this->_tpl_vars['members']); ?>
 members accepted<br /><br />
	                        			<?php endif; ?>
                        				
                        				Driver:<br />
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
							    <?php if ($this->_tpl_vars['wednesdaydriver'] == $this->_tpl_vars['members'][$this->_sections['info']['index']]['user_id']): ?><?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['name']; ?>
<?php endif; ?>
                        				<?php endfor; endif; ?><br /><br />
                        				
                        				<?php if ($this->_tpl_vars['wednesdayissaved']): ?>
	                        				<span class="finalized">Finalized by <br />Pool Leader</span><br />
	                        				
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
	                        					<?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['editable']): ?>
										<?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['wednesdayeditable'] == true): ?>
										    <span>
											<a id="<?php echo $this->_tpl_vars['fulldates'][3]; ?>
_accept" onclick="confirmPost('accept', '<?php echo $this->_tpl_vars['pool_id']; ?>
', '<?php echo $this->_tpl_vars['fulldates'][3]; ?>
'); return false;" href="#" 
											<?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['wednesdayconfirm'] == 'accept'): ?>class="accept"<?php endif; ?>>Accept</a>
											&nbsp;|&nbsp;
											<a id="<?php echo $this->_tpl_vars['fulldates'][3]; ?>
_decline" onclick="confirmPost('decline', '<?php echo $this->_tpl_vars['pool_id']; ?>
', '<?php echo $this->_tpl_vars['fulldates'][3]; ?>
'); return false;" href="#" 
											<?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['wednesdayconfirm'] == 'decline'): ?>class="decline"<?php endif; ?>>Decline</a>
										    </span>
										<?php else: ?>
										    <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['wednesdayconfirm'] == 'accept'): ?><span class="accept">Accept</span><?php endif; ?>
										    <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['wednesdayconfirm'] == 'decline'): ?><span class="decline">Decline</span><?php endif; ?>
										    <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['wednesdayconfirm'] == ''): ?><span class="decline">Unconfirmed</span><?php endif; ?>
										<?php endif; ?>
									<?php endif; ?>
	                        				<?php endfor; endif; ?><br /><br />
	                        			<?php else: ?>
	                        				<span class="unfinalized">Not Finalized<br /> by Pool Leader!</span><br />
	                        			<?php endif; ?>
                        				
                        				<a href="javascript:void();" rel="wednesdaydiv" class="lbOn">
                        					<?php if ($this->_tpl_vars['editmode']): ?>
                        						View/Edit Details
                        					<?php else: ?>
                        						View Details
                        					<?php endif; ?>
                        				</a>
                				<?php endif; ?>
                			</div>
                		</td>
                		<td <?php if ($this->_tpl_vars['thursdayispast']): ?>class="past"<?php endif; ?>>
                			<div class="head"><?php echo $this->_tpl_vars['shortdates'][4]; ?>
</div>
                			<div class="<?php if ($this->_tpl_vars['thursday']): ?><?php if ($this->_tpl_vars['thursdayissaved']): ?>saved <?php else: ?>unsaved <?php endif; ?><?php endif; ?><?php if ($this->_tpl_vars['thursdayispast']): ?>past<?php endif; ?>">
               				<?php if ($this->_tpl_vars['thursday']): ?>
                					Depart from Meeting Place: 
                					<?php echo $this->_tpl_vars['thursday_dm_hour']; ?>
:<?php echo $this->_tpl_vars['thursday_dm_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['thursday_dm_ampm']; ?>
<br /><br />
                					
                					Depart from Workplace: 
                        				<?php echo $this->_tpl_vars['thursday_dw_hour']; ?>
:<?php echo $this->_tpl_vars['thursday_dw_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['thursday_dw_ampm']; ?>
<br /><br />
                        				
                        				<?php if ($this->_tpl_vars['thursdayissaved']): ?>
	                        				<?php echo $this->_tpl_vars['thursdayaccepted']; ?>
/<?php echo count($this->_tpl_vars['members']); ?>
 members accepted<br /><br />
	                        			<?php endif; ?>
                        				
                        				Driver:<br />
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
							    <?php if ($this->_tpl_vars['thursdaydriver'] == $this->_tpl_vars['members'][$this->_sections['info']['index']]['user_id']): ?><?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['name']; ?>
<?php endif; ?>
                        				<?php endfor; endif; ?><br /><br />
                        				
                        				<?php if ($this->_tpl_vars['thursdayissaved']): ?>
	                        				<span class="finalized">Finalized by <br />Pool Leader</span><br />
	                        				
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
	                        					<?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['editable']): ?>
										<?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['thursdayeditable'] == true): ?>
										    <span>
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
										    </span>
										<?php else: ?>
										    <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['thursdayconfirm'] == 'accept'): ?><span class="accept">Accept</span><?php endif; ?>
										    <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['thursdayconfirm'] == 'decline'): ?><span class="decline">Decline</span><?php endif; ?>
										    <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['thursdayconfirm'] == ''): ?><span class="decline">Unconfirmed</span><?php endif; ?>
										<?php endif; ?>
									<?php endif; ?>
	                        				<?php endfor; endif; ?><br /><br />
	                        			<?php else: ?>
	                        				<span class="unfinalized">Not Finalized<br /> by Pool Leader!</span><br />
	                        			<?php endif; ?>
                        				
                        				<a href="javascript:void();" rel="thursdaydiv" class="lbOn">
                        					<?php if ($this->_tpl_vars['editmode']): ?>
                        						View/Edit Details
                        					<?php else: ?>
                        						View Details
                        					<?php endif; ?>
                        				</a>
                				<?php endif; ?>
                			</div>
                		</td>
                		<td <?php if ($this->_tpl_vars['fridayispast']): ?>class="past"<?php endif; ?>>
                			<div class="head"><?php echo $this->_tpl_vars['shortdates'][5]; ?>
</div>
                			<div class="<?php if ($this->_tpl_vars['friday']): ?><?php if ($this->_tpl_vars['fridayissaved']): ?>saved <?php else: ?>unsaved <?php endif; ?><?php endif; ?><?php if ($this->_tpl_vars['fridayispast']): ?>past<?php endif; ?>">
                				<?php if ($this->_tpl_vars['friday']): ?>
                					Depart from Meeting Place: 
                					<?php echo $this->_tpl_vars['friday_dm_hour']; ?>
:<?php echo $this->_tpl_vars['friday_dm_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['friday_dm_ampm']; ?>
<br /><br />
                					
                					Depart from Workplace: 
                        				<?php echo $this->_tpl_vars['friday_dw_hour']; ?>
:<?php echo $this->_tpl_vars['friday_dw_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['friday_dw_ampm']; ?>
<br /><br />
                        				
                        				<?php if ($this->_tpl_vars['fridayissaved']): ?>
	                        				<?php echo $this->_tpl_vars['fridayaccepted']; ?>
/<?php echo count($this->_tpl_vars['members']); ?>
 members accepted<br /><br />
	                        			<?php endif; ?>
                        				
                        				Driver:<br />
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
							    <?php if ($this->_tpl_vars['fridaydriver'] == $this->_tpl_vars['members'][$this->_sections['info']['index']]['user_id']): ?><?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['name']; ?>
<?php endif; ?>
                        				<?php endfor; endif; ?><br /><br />
                        				
                        				<?php if ($this->_tpl_vars['fridayissaved']): ?>
	                        				<span class="finalized">Finalized by <br />Pool Leader</span><br />
	                        				
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
	                        					<?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['editable']): ?>
										<?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['fridayeditable'] == true): ?>
										    <span>
											<a id="<?php echo $this->_tpl_vars['fulldates'][5]; ?>
_accept" onclick="confirmPost('accept', '<?php echo $this->_tpl_vars['pool_id']; ?>
', '<?php echo $this->_tpl_vars['fulldates'][5]; ?>
'); return false;" href="#" 
											<?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['fridayconfirm'] == 'accept'): ?>class="accept"<?php endif; ?>>Accept</a>
											&nbsp;|&nbsp;
											<a id="<?php echo $this->_tpl_vars['fulldates'][5]; ?>
_decline" onclick="confirmPost('decline', '<?php echo $this->_tpl_vars['pool_id']; ?>
', '<?php echo $this->_tpl_vars['fulldates'][5]; ?>
'); return false;" href="#" 
											<?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['fridayconfirm'] == 'decline'): ?>class="decline"<?php endif; ?>>Decline</a>
										    </span>
										<?php else: ?>
										    <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['fridayconfirm'] == 'accept'): ?><span class="accept">Accept</span><?php endif; ?>
										    <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['fridayconfirm'] == 'decline'): ?><span class="decline">Decline</span><?php endif; ?>
										    <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['fridayconfirm'] == ''): ?><span class="decline">Unconfirmed</span><?php endif; ?>
										<?php endif; ?>
									<?php endif; ?>
	                        				<?php endfor; endif; ?><br /><br />
	                        			<?php else: ?>
	                        				<span class="unfinalized">Not Finalized<br /> by Pool Leader!</span><br />
	                        			<?php endif; ?>
                        				
                        				<a href="javascript:void();" rel="fridaydiv" class="lbOn">
                        					<?php if ($this->_tpl_vars['editmode']): ?>
                        						View/Edit Details
                        					<?php else: ?>
                        						View Details
                        					<?php endif; ?>
                        				</a>
                				<?php endif; ?>
                			</div>
                		</td>
                		<td  <?php if ($this->_tpl_vars['saturdayispast']): ?>class="past"<?php endif; ?>>
                			<div class="head"><?php echo $this->_tpl_vars['shortdates'][6]; ?>
</div>
                			<div class="<?php if ($this->_tpl_vars['saturday']): ?><?php if ($this->_tpl_vars['saturdayissaved']): ?>saved <?php else: ?>unsaved <?php endif; ?><?php endif; ?><?php if ($this->_tpl_vars['saturdayispast']): ?>past<?php endif; ?>">
                				<?php if ($this->_tpl_vars['saturday']): ?>
                					Depart from Meeting Place: 
                					<?php echo $this->_tpl_vars['saturday_dm_hour']; ?>
:<?php echo $this->_tpl_vars['saturday_dm_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['saturday_dm_ampm']; ?>
<br /><br />
                					
                					Depart from Workplace: 
                        				<?php echo $this->_tpl_vars['saturday_dw_hour']; ?>
:<?php echo $this->_tpl_vars['saturday_dw_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['saturday_dw_ampm']; ?>
<br /><br />
                        				
                        				<?php if ($this->_tpl_vars['saturdayissaved']): ?>
	                        				<?php echo $this->_tpl_vars['saturdayaccepted']; ?>
/<?php echo count($this->_tpl_vars['members']); ?>
 members accepted<br /><br />
	                        			<?php endif; ?>
                        				
                        				Driver:<br />
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
							    <?php if ($this->_tpl_vars['saturdaydriver'] == $this->_tpl_vars['members'][$this->_sections['info']['index']]['user_id']): ?><?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['name']; ?>
<?php endif; ?>
                        				<?php endfor; endif; ?><br /><br />
                        				
                        				<?php if ($this->_tpl_vars['saturdayissaved']): ?>
	                        				<span class="finalized">Finalized by <br />Pool Leader</span><br />
	                        				
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
	                        					<?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['editable']): ?>
										<?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['saturdayeditable'] == true): ?>
										    <span>
											<a id="<?php echo $this->_tpl_vars['fulldates'][6]; ?>
_accept" onclick="confirmPost('accept', '<?php echo $this->_tpl_vars['pool_id']; ?>
', '<?php echo $this->_tpl_vars['fulldates'][6]; ?>
'); return false;" href="#" 
											<?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['saturdayconfirm'] == 'accept'): ?>class="accept"<?php endif; ?>>Accept</a>
											&nbsp;|&nbsp;
											<a id="<?php echo $this->_tpl_vars['fulldates'][6]; ?>
_decline" onclick="confirmPost('decline', '<?php echo $this->_tpl_vars['pool_id']; ?>
', '<?php echo $this->_tpl_vars['fulldates'][6]; ?>
'); return false;" href="#" 
											<?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['saturdayconfirm'] == 'decline'): ?>class="decline"<?php endif; ?>>Decline</a>
										    </span>
										<?php else: ?>
										    <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['saturdayconfirm'] == 'accept'): ?><span class="accept">Accept</span><?php endif; ?>
										    <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['saturdayconfirm'] == 'decline'): ?><span class="decline">Decline</span><?php endif; ?>
										    <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['saturdayconfirm'] == ''): ?><span class="decline">Unconfirmed</span><?php endif; ?>
										<?php endif; ?>
									<?php endif; ?>
	                        				<?php endfor; endif; ?><br /><br />
	                        			<?php else: ?>
	                        				<span class="unfinalized">Not Finalized<br /> by Pool Leader!</span><br />
	                        			<?php endif; ?>
                        				
                        				<a href="javascript:void();" rel="saturdaydiv" class="lbOn">
                        					<?php if ($this->_tpl_vars['editmode']): ?>
                        						View/Edit Details
                        					<?php else: ?>
                        						View Details
                        					<?php endif; ?>
                        				</a>
                				<?php endif; ?>
                			</div>
                		</td>
                		<td <?php if ($this->_tpl_vars['sundayispast']): ?>class="past"<?php endif; ?>>
                			<div class="head"><?php echo $this->_tpl_vars['shortdates'][7]; ?>
</div>
                			<div class="<?php if ($this->_tpl_vars['sunday']): ?><?php if ($this->_tpl_vars['sundayissaved']): ?>saved <?php else: ?>unsaved <?php endif; ?><?php endif; ?><?php if ($this->_tpl_vars['sundayispast']): ?>past<?php endif; ?>">
                				<?php if ($this->_tpl_vars['sunday']): ?>
                					Depart from Meeting Place: 
                					<?php echo $this->_tpl_vars['sunday_dm_hour']; ?>
:<?php echo $this->_tpl_vars['sunday_dm_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['sunday_dm_ampm']; ?>
<br /><br />
                					
                					Depart from Workplace: 
                        				<?php echo $this->_tpl_vars['sunday_dw_hour']; ?>
:<?php echo $this->_tpl_vars['sunday_dw_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['sunday_dw_ampm']; ?>
<br /><br />
                        				
                        				<?php if ($this->_tpl_vars['sundayissaved']): ?>
	                        				<?php echo $this->_tpl_vars['sundayaccepted']; ?>
/<?php echo count($this->_tpl_vars['members']); ?>
 members accepted<br /><br />
	                        			<?php endif; ?>
                        				
                        				Driver:<br />
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
							    <?php if ($this->_tpl_vars['sundaydriver'] == $this->_tpl_vars['members'][$this->_sections['info']['index']]['user_id']): ?><?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['name']; ?>
<?php endif; ?>
                        				<?php endfor; endif; ?><br /><br />
                        				
                        				<?php if ($this->_tpl_vars['sundayissaved']): ?>
	                        				<span class="finalized">Finalized by <br />Pool Leader</span><br />
	                        				
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
	                        					<?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['editable']): ?>
										<?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['sundayeditable'] == true): ?>
										    <span>
											<a id="<?php echo $this->_tpl_vars['fulldates'][7]; ?>
_accept" onclick="confirmPost('accept', '<?php echo $this->_tpl_vars['pool_id']; ?>
', '<?php echo $this->_tpl_vars['fulldates'][7]; ?>
'); return false;" href="#" 
											<?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['sundayconfirm'] == 'accept'): ?>class="accept"<?php endif; ?>>Accept</a>
											&nbsp;|&nbsp;
											<a id="<?php echo $this->_tpl_vars['fulldates'][7]; ?>
_decline" onclick="confirmPost('decline', '<?php echo $this->_tpl_vars['pool_id']; ?>
', '<?php echo $this->_tpl_vars['fulldates'][7]; ?>
'); return false;" href="#" 
											<?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['sundayconfirm'] == 'decline'): ?>class="decline"<?php endif; ?>>Decline</a>
										    </span>
										<?php else: ?>
										    <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['sundayconfirm'] == 'accept'): ?><span class="accept">Accept</span><?php endif; ?>
										    <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['sundayconfirm'] == 'decline'): ?><span class="decline">Decline</span><?php endif; ?>
										    <?php if ($this->_tpl_vars['members'][$this->_sections['info']['index']]['sundayconfirm'] == ''): ?><span class="decline">Unconfirmed</span><?php endif; ?>
										<?php endif; ?>
									<?php endif; ?>
	                        				<?php endfor; endif; ?><br /><br />
	                        			<?php else: ?>
	                        				<span class="unfinalized">Not Finalized<br /> by Pool Leader!</span><br />
	                        			<?php endif; ?>
                        				
                        				<a href="javascript:void();" rel="sundaydiv" class="lbOn">
                        					<?php if ($this->_tpl_vars['editmode']): ?>
                        						View/Edit Details
                        					<?php else: ?>
                        						View Details
                        					<?php endif; ?>
                        				</a>
                				<?php endif; ?>
                			</div>
                		</td>

                	</tr>
                </table>
                <?php if ($this->_tpl_vars['editmode']): ?>
                <div style="height:20px; padding:10px 0px;">
                	<div style="float:right;width:250px">
                    <img id="_indicator" src="images/indicator.gif" alt="" class="indicator" style="display: none;"/>
                	<button value="Save" name="submit" class="btn" onclick="finalizeWeek();" >
				<span>
			        	Finalize All Rides for This Week
			        </span>
                	</button>
                    
                    </div>
                </div>
                <?php endif; ?>
            </div>
            
            <!-- View Schedule -->
            <?php if ($this->_tpl_vars['monday']): ?>
            	<div id="mondaydiv" class="leightbox">
                	<div id="monday_tooltip">&nbsp;</div>
                	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pools-schedule-monday.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><a href="javascript:void();" class="lbAction" rel="deactivate">Close</a>
                    <?php echo '
                    	<script>addMondayToolTipListener()</script>
                    '; ?>

                </div>
            <?php endif; ?>
            <?php if ($this->_tpl_vars['tuesday']): ?>
            	<div id="tuesdaydiv" class="leightbox">
                	<div id="tuesday_tooltip">&nbsp;</div>
                	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pools-schedule-tuesday.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><a href="javascript:void();" class="lbAction" rel="deactivate">Close</a>
                    <?php echo '
                    	<script>addTuesdayToolTipListener()</script>
                    '; ?>

                </div>
            <?php endif; ?>
            <?php if ($this->_tpl_vars['wednesday']): ?>
            	<div id="wednesdaydiv" class="leightbox">
                	<div id="wednesday_tooltip">&nbsp;</div>
                	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pools-schedule-wednesday.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><a href="javascript:void();" class="lbAction" rel="deactivate">Close</a>
                    <?php echo '
                    	<script>addWednesdayToolTipListener()</script>
                    '; ?>

            	</div>
            <?php endif; ?>
            <?php if ($this->_tpl_vars['thursday']): ?>
            	<div id="thursdaydiv" class="leightbox">
                	<div id="thursday_tooltip">&nbsp;</div>
                	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pools-schedule-thursday.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><a href="javascript:void();" class="lbAction" rel="deactivate">Close</a>
                    <?php echo '
                    	<script>addThursdayToolTipListener()</script>
                    '; ?>

              	</div>
            <?php endif; ?>
            <?php if ($this->_tpl_vars['friday']): ?>
            	<div id="fridaydiv" class="leightbox">
                	<div id="friday_tooltip">&nbsp;</div>
            		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pools-schedule-friday.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><a href="javascript:void();" class="lbAction" rel="deactivate">Close</a>
                    <?php echo '
                    	<script>addFridayToolTipListener()</script>
                    '; ?>

                </div>
            <?php endif; ?>
            <?php if ($this->_tpl_vars['saturday']): ?>
            	<div id="saturdaydiv" class="leightbox">
                	<div id="saturday_tooltip">&nbsp;</div>
                	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pools-schedule-saturday.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><a href="javascript:void();" class="lbAction" rel="deactivate">Close</a>
                    <?php echo '
                    	<script>addSaturdayToolTipListener()</script>
                    '; ?>

                </div>
            <?php endif; ?>
            <?php if ($this->_tpl_vars['sunday']): ?>
            	<div id="sundaydiv" class="leightbox">
                	<div id="sunday_tooltip">&nbsp;</div>
                	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pools-schedule-sunday.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><a href="javascript:void();" class="lbAction" rel="deactivate">Close</a>
                    <?php echo '
                    	<script>addSundayToolTipListener()</script>
                    '; ?>

                </div>
            <?php endif; ?>

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