<?php /* Smarty version 2.6.19, created on 2011-09-07 17:16:53
         compiled from pools-schedule-edit.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects,controls"></script>
<script language="javascript" src="js/formfocus.js"></script>
<script language="javascript" src="js/tooltips.js"></script>

<?php echo '
<script type="text/javascript">

// INITIAL EVENT LISTENERS
document.observe("dom:loaded", function() 
{
	
	// Listen for day selection
	if($(\'monday\')) { Event.observe(\'monday\', \'change\', showDay.bindAsEventListener(this, \'monday\')); }
	if($(\'tuesday\')) { Event.observe(\'tuesday\', \'change\', showDay.bindAsEventListener(this, \'tuesday\')); }
	if($(\'wednesday\')) { Event.observe(\'wednesday\', \'change\', showDay.bindAsEventListener(this, \'wednesday\')); }
	if($(\'thursday\')) { Event.observe(\'thursday\', \'change\', showDay.bindAsEventListener(this, \'thursday\')); }
	if($(\'friday\')) { Event.observe(\'friday\', \'change\', showDay.bindAsEventListener(this, \'friday\')); }
	if($(\'saturday\')) { Event.observe(\'saturday\', \'change\', showDay.bindAsEventListener(this, \'saturday\')); }
	if($(\'sunday\')) { Event.observe(\'sunday\', \'change\', showDay.bindAsEventListener(this, \'sunday\')); }
	
	// Listen for cancel button
	if($(\'cancel\'))
	{
		Event.observe(\'cancel\', \'click\', returntoschedule);
	}
	
	// Listen for comments
	Event.observe(\'commentform\', \'submit\', addCommentPost);
	addToolTipListeners();
});

// RETURN TO SCHEDULE
function returntoschedule()
{
	window.location = \'pools.php?state=viewschedule&pool=\' + $(\'pool\').value;
}

// SHOW / HIDE DAY
function showDay(e, day)
{
	if($(day).checked)
	{
		$(day + \'container\').show();
	} else {
		$(day + \'container\').hide();
	}
}

// ADD COMMENT POST
function addCommentPost(e)
{
	// Prevent page refresh
	Event.stop(e);
	
	// Send AJAX request
	var url = \'pools.php?state=addcomment&pool=\' + $(\'pool\').value;
	var params = Form.serialize(\'commentform\');
	var ajax = new Ajax.Request( url, { method: \'post\', postBody: params, onSuccess: addCommentResponse });
	
	// Show/hide Indicator
	$(\'comment_submit\').hide();
	$(\'comment_indicator\').show();
}

// ADD COMMENT RESPONSE
function addCommentResponse(resp)
{

	// Obtain JSON response
	var json = resp.responseText.evalJSON();
	
	// If successful, add table row
	if(json.status == \'success\')
	{
		// Reset tag form
		Form.reset(\'commentform\');
		
		// Show/hide Indicator
		$(\'comment_submit\').show();
		$(\'comment_indicator\').hide();
		
		// Add new row to table
		$(\'comments\').insert({after: json.contents});
		
		// Highlight row
		var row1 = json.randomnumber + \'_1\';
		var row2 = json.randomnumber + \'_2\';
		new Effect.Highlight(row1);
		new Effect.Highlight(row2);
	}
}

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
                    <li class="current"><a href="pools.php">My Pools</a></li>
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
                    <li><a href="pools.php?state=viewprofile&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Profile</a></li>
                    <?php if ($this->_tpl_vars['editmode']): ?><li class="current"><a href="pools.php?state=editschedule&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Scheduler</a></li><?php endif; ?>
                    <li><a href="pools.php?state=viewschedule&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
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
			
			<div class="innercolumn3 clear">
            
            	<!-- Store pool_id -->
	            <form><input id="pool" name="pool" type="hidden" value="<?php echo $this->_tpl_vars['pool_id']; ?>
" /></form>
				
				<?php if ($this->_tpl_vars['editmode']): ?>
				
				
	            <form id="daysform" method="post" action="pools.php?state=editschedule&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">
	                
	                <img src="images/table3.gif" /><br/>
	                <table class="table3">
	                	<tr class="tablehead">
	                		<th>Days of the Week</th>
	                		<th>Depart from Meeting Place</th>
	                		<th>Depart from Workplace</th>
	                	</tr>
	                	<tr>
	                	<td>
	                <!-- Days checkboxes -->
	                    <input id="monday" name="monday" type="checkbox" value="y" <?php if ($this->_tpl_vars['monday'] == 'y'): ?>checked="checked"<?php endif; ?> /> Monday <br />
	                    </td>                
	                
	                
	                <!-- Monday -->	                    
	                    <td>
	                        <select name="monday_aw_hour" class="select" style="width: auto">
	                            <option value="1" <?php if ($this->_tpl_vars['monday_aw_hour'] == '1'): ?>selected="selected"<?php endif; ?>>1</option>
	                            <option value="2" <?php if ($this->_tpl_vars['monday_aw_hour'] == '2'): ?>selected="selected"<?php endif; ?>>2</option>
	                            <option value="3" <?php if ($this->_tpl_vars['monday_aw_hour'] == '3'): ?>selected="selected"<?php endif; ?>>3</option>
	                            <option value="4" <?php if ($this->_tpl_vars['monday_aw_hour'] == '4'): ?>selected="selected"<?php endif; ?>>4</option>
	                            <option value="5" <?php if ($this->_tpl_vars['monday_aw_hour'] == '5'): ?>selected="selected"<?php endif; ?>>5</option>
	                            <option value="6" <?php if ($this->_tpl_vars['monday_aw_hour'] == '6'): ?>selected="selected"<?php endif; ?>>6</option>
	                            <option value="7" <?php if ($this->_tpl_vars['monday_aw_hour'] == '7'): ?>selected="selected"<?php endif; ?>>7</option>
	                            <option value="8" <?php if ($this->_tpl_vars['monday_aw_hour'] == '8'): ?>selected="selected"<?php endif; ?>>8</option>
	                            <option value="9" <?php if ($this->_tpl_vars['monday_aw_hour'] == '9'): ?>selected="selected"<?php endif; ?>>9</option>
	                            <option value="10" <?php if ($this->_tpl_vars['monday_aw_hour'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
	                            <option value="11" <?php if ($this->_tpl_vars['monday_aw_hour'] == '11'): ?>selected="selected"<?php endif; ?>>11</option>
	                            <option value="12" <?php if ($this->_tpl_vars['monday_aw_hour'] == '12'): ?>selected="selected"<?php endif; ?>>12</option>
	                        </select>
	                        <select name="monday_aw_minute" class="select" style="width: auto">
	                            <option value="00" <?php if ($this->_tpl_vars['monday_aw_minute'] == '00'): ?>selected="selected"<?php endif; ?>>00</option>
	                            <option value="05" <?php if ($this->_tpl_vars['monday_aw_minute'] == '05'): ?>selected="selected"<?php endif; ?>>05</option>
	                            <option value="10" <?php if ($this->_tpl_vars['monday_aw_minute'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
	                            <option value="15" <?php if ($this->_tpl_vars['monday_aw_minute'] == '15'): ?>selected="selected"<?php endif; ?>>15</option>
	                            <option value="20" <?php if ($this->_tpl_vars['monday_aw_minute'] == '20'): ?>selected="selected"<?php endif; ?>>20</option>
	                            <option value="25" <?php if ($this->_tpl_vars['monday_aw_minute'] == '25'): ?>selected="selected"<?php endif; ?>>25</option>
	                            <option value="30" <?php if ($this->_tpl_vars['monday_aw_minute'] == '30'): ?>selected="selected"<?php endif; ?>>30</option>
	                            <option value="35" <?php if ($this->_tpl_vars['monday_aw_minute'] == '35'): ?>selected="selected"<?php endif; ?>>35</option>
	                            <option value="40" <?php if ($this->_tpl_vars['monday_aw_minute'] == '40'): ?>selected="selected"<?php endif; ?>>40</option>
	                            <option value="45" <?php if ($this->_tpl_vars['monday_aw_minute'] == '45'): ?>selected="selected"<?php endif; ?>>45</option>
	                            <option value="50" <?php if ($this->_tpl_vars['monday_aw_minute'] == '50'): ?>selected="selected"<?php endif; ?>>50</option>
	                            <option value="55" <?php if ($this->_tpl_vars['monday_aw_minute'] == '55'): ?>selected="selected"<?php endif; ?>>55</option>
	                        </select>
	                        <select name="monday_aw_ampm" class="select" style="width: auto">
	                            <option value="am" <?php if ($this->_tpl_vars['monday_aw_ampm'] == 'am'): ?>selected="selected"<?php endif; ?>>am</option>
	                            <option value="pm" <?php if ($this->_tpl_vars['monday_aw_ampm'] == 'pm'): ?>selected="selected"<?php endif; ?>>pm</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select name="monday_dw_hour" class="select" style="width: auto">
	                            <option value="1" <?php if ($this->_tpl_vars['monday_dw_hour'] == '1'): ?>selected="selected"<?php endif; ?>>1</option>
	                            <option value="2" <?php if ($this->_tpl_vars['monday_dw_hour'] == '2'): ?>selected="selected"<?php endif; ?>>2</option>
	                            <option value="3" <?php if ($this->_tpl_vars['monday_dw_hour'] == '3'): ?>selected="selected"<?php endif; ?>>3</option>
	                            <option value="4" <?php if ($this->_tpl_vars['monday_dw_hour'] == '4'): ?>selected="selected"<?php endif; ?>>4</option>
	                            <option value="5" <?php if ($this->_tpl_vars['monday_dw_hour'] == '5'): ?>selected="selected"<?php endif; ?>>5</option>
	                            <option value="6" <?php if ($this->_tpl_vars['monday_dw_hour'] == '6'): ?>selected="selected"<?php endif; ?>>6</option>
	                            <option value="7" <?php if ($this->_tpl_vars['monday_dw_hour'] == '7'): ?>selected="selected"<?php endif; ?>>7</option>
	                            <option value="8" <?php if ($this->_tpl_vars['monday_dw_hour'] == '8'): ?>selected="selected"<?php endif; ?>>8</option>
	                            <option value="9" <?php if ($this->_tpl_vars['monday_dw_hour'] == '9'): ?>selected="selected"<?php endif; ?>>9</option>
	                            <option value="10" <?php if ($this->_tpl_vars['monday_dw_hour'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
	                            <option value="11" <?php if ($this->_tpl_vars['monday_dw_hour'] == '11'): ?>selected="selected"<?php endif; ?>>11</option>
	                            <option value="12" <?php if ($this->_tpl_vars['monday_dw_hour'] == '12'): ?>selected="selected"<?php endif; ?>>12</option>
	                        </select>
	                        <select name="monday_dw_minute" class="select" style="width: auto">
	                            <option value="00" <?php if ($this->_tpl_vars['monday_dw_minute'] == '00'): ?>selected="selected"<?php endif; ?>>00</option>
	                            <option value="05" <?php if ($this->_tpl_vars['monday_dw_minute'] == '05'): ?>selected="selected"<?php endif; ?>>05</option>
	                            <option value="10" <?php if ($this->_tpl_vars['monday_dw_minute'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
	                            <option value="15" <?php if ($this->_tpl_vars['monday_dw_minute'] == '15'): ?>selected="selected"<?php endif; ?>>15</option>
	                            <option value="20" <?php if ($this->_tpl_vars['monday_dw_minute'] == '20'): ?>selected="selected"<?php endif; ?>>20</option>
	                            <option value="25" <?php if ($this->_tpl_vars['monday_dw_minute'] == '25'): ?>selected="selected"<?php endif; ?>>25</option>
	                            <option value="30" <?php if ($this->_tpl_vars['monday_dw_minute'] == '30'): ?>selected="selected"<?php endif; ?>>30</option>
	                            <option value="35" <?php if ($this->_tpl_vars['monday_dw_minute'] == '35'): ?>selected="selected"<?php endif; ?>>35</option>
	                            <option value="40" <?php if ($this->_tpl_vars['monday_dw_minute'] == '40'): ?>selected="selected"<?php endif; ?>>40</option>
	                            <option value="45" <?php if ($this->_tpl_vars['monday_dw_minute'] == '45'): ?>selected="selected"<?php endif; ?>>45</option>
	                            <option value="50" <?php if ($this->_tpl_vars['monday_dw_minute'] == '50'): ?>selected="selected"<?php endif; ?>>50</option>
	                            <option value="55" <?php if ($this->_tpl_vars['monday_dw_minute'] == '55'): ?>selected="selected"<?php endif; ?>>55</option>
	                        </select>
	                        <select name="monday_dw_ampm" class="select" style="width: auto">
	                            <option value="am" <?php if ($this->_tpl_vars['monday_dw_ampm'] == 'am'): ?>selected="selected"<?php endif; ?>>am</option>
	                            <option value="pm" <?php if ($this->_tpl_vars['monday_dw_ampm'] == 'pm'): ?>selected="selected"<?php endif; ?>>pm</option>
	                        </select>
	                    </td>
	                </tr>
	                <tr>
	                <td>
	                    <input id="tuesday" name="tuesday" type="checkbox" value="y" <?php if ($this->_tpl_vars['tuesday'] == 'y'): ?>checked="checked"<?php endif; ?> /> Tuesday
	                </td>
	                <td>
	                        <select name="tuesday_aw_hour" class="select" style="width: auto">
	                            <option value="1" <?php if ($this->_tpl_vars['tuesday_aw_hour'] == '1'): ?>selected="selected"<?php endif; ?>>1</option>
	                            <option value="2" <?php if ($this->_tpl_vars['tuesday_aw_hour'] == '2'): ?>selected="selected"<?php endif; ?>>2</option>
	                            <option value="3" <?php if ($this->_tpl_vars['tuesday_aw_hour'] == '3'): ?>selected="selected"<?php endif; ?>>3</option>
	                            <option value="4" <?php if ($this->_tpl_vars['tuesday_aw_hour'] == '4'): ?>selected="selected"<?php endif; ?>>4</option>
	                            <option value="5" <?php if ($this->_tpl_vars['tuesday_aw_hour'] == '5'): ?>selected="selected"<?php endif; ?>>5</option>
	                            <option value="6" <?php if ($this->_tpl_vars['tuesday_aw_hour'] == '6'): ?>selected="selected"<?php endif; ?>>6</option>
	                            <option value="7" <?php if ($this->_tpl_vars['tuesday_aw_hour'] == '7'): ?>selected="selected"<?php endif; ?>>7</option>
	                            <option value="8" <?php if ($this->_tpl_vars['tuesday_aw_hour'] == '8'): ?>selected="selected"<?php endif; ?>>8</option>
	                            <option value="9" <?php if ($this->_tpl_vars['tuesday_aw_hour'] == '9'): ?>selected="selected"<?php endif; ?>>9</option>
	                            <option value="10" <?php if ($this->_tpl_vars['tuesday_aw_hour'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
	                            <option value="11" <?php if ($this->_tpl_vars['tuesday_aw_hour'] == '11'): ?>selected="selected"<?php endif; ?>>11</option>
	                            <option value="12" <?php if ($this->_tpl_vars['tuesday_aw_hour'] == '12'): ?>selected="selected"<?php endif; ?>>12</option>
	                        </select>
	                        <select name="tuesday_aw_minute" class="select" style="width: auto">
	                            <option value="00" <?php if ($this->_tpl_vars['tuesday_aw_minute'] == '00'): ?>selected="selected"<?php endif; ?>>00</option>
	                            <option value="05" <?php if ($this->_tpl_vars['tuesday_aw_minute'] == '05'): ?>selected="selected"<?php endif; ?>>05</option>
	                            <option value="10" <?php if ($this->_tpl_vars['tuesday_aw_minute'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
	                            <option value="15" <?php if ($this->_tpl_vars['tuesday_aw_minute'] == '15'): ?>selected="selected"<?php endif; ?>>15</option>
	                            <option value="20" <?php if ($this->_tpl_vars['tuesday_aw_minute'] == '20'): ?>selected="selected"<?php endif; ?>>20</option>
	                            <option value="25" <?php if ($this->_tpl_vars['tuesday_aw_minute'] == '25'): ?>selected="selected"<?php endif; ?>>25</option>
	                            <option value="30" <?php if ($this->_tpl_vars['tuesday_aw_minute'] == '30'): ?>selected="selected"<?php endif; ?>>30</option>
	                            <option value="35" <?php if ($this->_tpl_vars['tuesday_aw_minute'] == '35'): ?>selected="selected"<?php endif; ?>>35</option>
	                            <option value="40" <?php if ($this->_tpl_vars['tuesday_aw_minute'] == '40'): ?>selected="selected"<?php endif; ?>>40</option>
	                            <option value="45" <?php if ($this->_tpl_vars['tuesday_aw_minute'] == '45'): ?>selected="selected"<?php endif; ?>>45</option>
	                            <option value="50" <?php if ($this->_tpl_vars['tuesday_aw_minute'] == '50'): ?>selected="selected"<?php endif; ?>>50</option>
	                            <option value="55" <?php if ($this->_tpl_vars['tuesday_aw_minute'] == '55'): ?>selected="selected"<?php endif; ?>>55</option>
	                        </select>
	                        <select name="tuesday_aw_ampm" class="select" style="width: auto">
	                            <option value="am" <?php if ($this->_tpl_vars['tuesday_aw_ampm'] == 'am'): ?>selected="selected"<?php endif; ?>>am</option>
	                            <option value="pm" <?php if ($this->_tpl_vars['tuesday_aw_ampm'] == 'pm'): ?>selected="selected"<?php endif; ?>>pm</option>
	                        </select>
	                    </td>
	                    
	                    <td >
	                        <select name="tuesday_dw_hour" class="select" style="width: auto">
	                            <option value="1" <?php if ($this->_tpl_vars['tuesday_dw_hour'] == '1'): ?>selected="selected"<?php endif; ?>>1</option>
	                            <option value="2" <?php if ($this->_tpl_vars['tuesday_dw_hour'] == '2'): ?>selected="selected"<?php endif; ?>>2</option>
	                            <option value="3" <?php if ($this->_tpl_vars['tuesday_dw_hour'] == '3'): ?>selected="selected"<?php endif; ?>>3</option>
	                            <option value="4" <?php if ($this->_tpl_vars['tuesday_dw_hour'] == '4'): ?>selected="selected"<?php endif; ?>>4</option>
	                            <option value="5" <?php if ($this->_tpl_vars['tuesday_dw_hour'] == '5'): ?>selected="selected"<?php endif; ?>>5</option>
	                            <option value="6" <?php if ($this->_tpl_vars['tuesday_dw_hour'] == '6'): ?>selected="selected"<?php endif; ?>>6</option>
	                            <option value="7" <?php if ($this->_tpl_vars['tuesday_dw_hour'] == '7'): ?>selected="selected"<?php endif; ?>>7</option>
	                            <option value="8" <?php if ($this->_tpl_vars['tuesday_dw_hour'] == '8'): ?>selected="selected"<?php endif; ?>>8</option>
	                            <option value="9" <?php if ($this->_tpl_vars['tuesday_dw_hour'] == '9'): ?>selected="selected"<?php endif; ?>>9</option>
	                            <option value="10" <?php if ($this->_tpl_vars['tuesday_dw_hour'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
	                            <option value="11" <?php if ($this->_tpl_vars['tuesday_dw_hour'] == '11'): ?>selected="selected"<?php endif; ?>>11</option>
	                            <option value="12" <?php if ($this->_tpl_vars['tuesday_dw_hour'] == '12'): ?>selected="selected"<?php endif; ?>>12</option>
	                        </select>
	                        <select name="tuesday_dw_minute" class="select" style="width: auto">
	                            <option value="00" <?php if ($this->_tpl_vars['tuesday_dw_minute'] == '00'): ?>selected="selected"<?php endif; ?>>00</option>
	                            <option value="05" <?php if ($this->_tpl_vars['tuesday_dw_minute'] == '05'): ?>selected="selected"<?php endif; ?>>05</option>
	                            <option value="10" <?php if ($this->_tpl_vars['tuesday_dw_minute'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
	                            <option value="15" <?php if ($this->_tpl_vars['tuesday_dw_minute'] == '15'): ?>selected="selected"<?php endif; ?>>15</option>
	                            <option value="20" <?php if ($this->_tpl_vars['tuesday_dw_minute'] == '20'): ?>selected="selected"<?php endif; ?>>20</option>
	                            <option value="25" <?php if ($this->_tpl_vars['tuesday_dw_minute'] == '25'): ?>selected="selected"<?php endif; ?>>25</option>
	                            <option value="30" <?php if ($this->_tpl_vars['tuesday_dw_minute'] == '30'): ?>selected="selected"<?php endif; ?>>30</option>
	                            <option value="35" <?php if ($this->_tpl_vars['tuesday_dw_minute'] == '35'): ?>selected="selected"<?php endif; ?>>35</option>
	                            <option value="40" <?php if ($this->_tpl_vars['tuesday_dw_minute'] == '40'): ?>selected="selected"<?php endif; ?>>40</option>
	                            <option value="45" <?php if ($this->_tpl_vars['tuesday_dw_minute'] == '45'): ?>selected="selected"<?php endif; ?>>45</option>
	                            <option value="50" <?php if ($this->_tpl_vars['tuesday_dw_minute'] == '50'): ?>selected="selected"<?php endif; ?>>50</option>
	                            <option value="55" <?php if ($this->_tpl_vars['tuesday_dw_minute'] == '55'): ?>selected="selected"<?php endif; ?>>55</option>
	                        </select>
	                        <select name="tuesday_dw_ampm" class="select" style="width: auto">
	                            <option value="am" <?php if ($this->_tpl_vars['tuesday_dw_ampm'] == 'am'): ?>selected="selected"<?php endif; ?>>am</option>
	                            <option value="pm" <?php if ($this->_tpl_vars['tuesday_dw_ampm'] == 'pm'): ?>selected="selected"<?php endif; ?>>pm</option>
	                        </select>
	                    </td>
	                </tr>
	                <tr>
	                <td>
	                    <input id="wednesday" name="wednesday" type="checkbox" value="y" <?php if ($this->_tpl_vars['wednesday'] == 'y'): ?>checked="checked"<?php endif; ?> /> Wednesday 
	                    </td>
	                <td>
	                <!-- wednesday -->
	                        <select name="wednesday_aw_hour" class="select" style="width: auto">
	                            <option value="1" <?php if ($this->_tpl_vars['wednesday_aw_hour'] == '1'): ?>selected="selected"<?php endif; ?>>1</option>
	                            <option value="2" <?php if ($this->_tpl_vars['wednesday_aw_hour'] == '2'): ?>selected="selected"<?php endif; ?>>2</option>
	                            <option value="3" <?php if ($this->_tpl_vars['wednesday_aw_hour'] == '3'): ?>selected="selected"<?php endif; ?>>3</option>
	                            <option value="4" <?php if ($this->_tpl_vars['wednesday_aw_hour'] == '4'): ?>selected="selected"<?php endif; ?>>4</option>
	                            <option value="5" <?php if ($this->_tpl_vars['wednesday_aw_hour'] == '5'): ?>selected="selected"<?php endif; ?>>5</option>
	                            <option value="6" <?php if ($this->_tpl_vars['wednesday_aw_hour'] == '6'): ?>selected="selected"<?php endif; ?>>6</option>
	                            <option value="7" <?php if ($this->_tpl_vars['wednesday_aw_hour'] == '7'): ?>selected="selected"<?php endif; ?>>7</option>
	                            <option value="8" <?php if ($this->_tpl_vars['wednesday_aw_hour'] == '8'): ?>selected="selected"<?php endif; ?>>8</option>
	                            <option value="9" <?php if ($this->_tpl_vars['wednesday_aw_hour'] == '9'): ?>selected="selected"<?php endif; ?>>9</option>
	                            <option value="10" <?php if ($this->_tpl_vars['wednesday_aw_hour'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
	                            <option value="11" <?php if ($this->_tpl_vars['wednesday_aw_hour'] == '11'): ?>selected="selected"<?php endif; ?>>11</option>
	                            <option value="12" <?php if ($this->_tpl_vars['wednesday_aw_hour'] == '12'): ?>selected="selected"<?php endif; ?>>12</option>
	                        </select>
	                        <select name="wednesday_aw_minute" class="select" style="width: auto">
	                            <option value="00" <?php if ($this->_tpl_vars['wednesday_aw_minute'] == '00'): ?>selected="selected"<?php endif; ?>>00</option>
	                            <option value="05" <?php if ($this->_tpl_vars['wednesday_aw_minute'] == '05'): ?>selected="selected"<?php endif; ?>>05</option>
	                            <option value="10" <?php if ($this->_tpl_vars['wednesday_aw_minute'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
	                            <option value="15" <?php if ($this->_tpl_vars['wednesday_aw_minute'] == '15'): ?>selected="selected"<?php endif; ?>>15</option>
	                            <option value="20" <?php if ($this->_tpl_vars['wednesday_aw_minute'] == '20'): ?>selected="selected"<?php endif; ?>>20</option>
	                            <option value="25" <?php if ($this->_tpl_vars['wednesday_aw_minute'] == '25'): ?>selected="selected"<?php endif; ?>>25</option>
	                            <option value="30" <?php if ($this->_tpl_vars['wednesday_aw_minute'] == '30'): ?>selected="selected"<?php endif; ?>>30</option>
	                            <option value="35" <?php if ($this->_tpl_vars['wednesday_aw_minute'] == '35'): ?>selected="selected"<?php endif; ?>>35</option>
	                            <option value="40" <?php if ($this->_tpl_vars['wednesday_aw_minute'] == '40'): ?>selected="selected"<?php endif; ?>>40</option>
	                            <option value="45" <?php if ($this->_tpl_vars['wednesday_aw_minute'] == '45'): ?>selected="selected"<?php endif; ?>>45</option>
	                            <option value="50" <?php if ($this->_tpl_vars['wednesday_aw_minute'] == '50'): ?>selected="selected"<?php endif; ?>>50</option>
	                            <option value="55" <?php if ($this->_tpl_vars['wednesday_aw_minute'] == '55'): ?>selected="selected"<?php endif; ?>>55</option>
	                        </select>
	                        <select name="wednesday_aw_ampm" class="select" style="width: auto">
	                            <option value="am" <?php if ($this->_tpl_vars['wednesday_aw_ampm'] == 'am'): ?>selected="selected"<?php endif; ?>>am</option>
	                            <option value="pm" <?php if ($this->_tpl_vars['wednesday_aw_ampm'] == 'pm'): ?>selected="selected"<?php endif; ?>>pm</option>
	                        </select>
	                    </td>
	                    
	                    <td>
	                        <select name="wednesday_dw_hour" class="select" style="width: auto">
	                            <option value="1" <?php if ($this->_tpl_vars['wednesday_dw_hour'] == '1'): ?>selected="selected"<?php endif; ?>>1</option>
	                            <option value="2" <?php if ($this->_tpl_vars['wednesday_dw_hour'] == '2'): ?>selected="selected"<?php endif; ?>>2</option>
	                            <option value="3" <?php if ($this->_tpl_vars['wednesday_dw_hour'] == '3'): ?>selected="selected"<?php endif; ?>>3</option>
	                            <option value="4" <?php if ($this->_tpl_vars['wednesday_dw_hour'] == '4'): ?>selected="selected"<?php endif; ?>>4</option>
	                            <option value="5" <?php if ($this->_tpl_vars['wednesday_dw_hour'] == '5'): ?>selected="selected"<?php endif; ?>>5</option>
	                            <option value="6" <?php if ($this->_tpl_vars['wednesday_dw_hour'] == '6'): ?>selected="selected"<?php endif; ?>>6</option>
	                            <option value="7" <?php if ($this->_tpl_vars['wednesday_dw_hour'] == '7'): ?>selected="selected"<?php endif; ?>>7</option>
	                            <option value="8" <?php if ($this->_tpl_vars['wednesday_dw_hour'] == '8'): ?>selected="selected"<?php endif; ?>>8</option>
	                            <option value="9" <?php if ($this->_tpl_vars['wednesday_dw_hour'] == '9'): ?>selected="selected"<?php endif; ?>>9</option>
	                            <option value="10" <?php if ($this->_tpl_vars['wednesday_dw_hour'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
	                            <option value="11" <?php if ($this->_tpl_vars['wednesday_dw_hour'] == '11'): ?>selected="selected"<?php endif; ?>>11</option>
	                            <option value="12" <?php if ($this->_tpl_vars['wednesday_dw_hour'] == '12'): ?>selected="selected"<?php endif; ?>>12</option>
	                        </select>
	                        <select name="wednesday_dw_minute" class="select" style="width: auto">
	                            <option value="00" <?php if ($this->_tpl_vars['wednesday_dw_minute'] == '00'): ?>selected="selected"<?php endif; ?>>00</option>
	                            <option value="05" <?php if ($this->_tpl_vars['wednesday_dw_minute'] == '05'): ?>selected="selected"<?php endif; ?>>05</option>
	                            <option value="10" <?php if ($this->_tpl_vars['wednesday_dw_minute'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
	                            <option value="15" <?php if ($this->_tpl_vars['wednesday_dw_minute'] == '15'): ?>selected="selected"<?php endif; ?>>15</option>
	                            <option value="20" <?php if ($this->_tpl_vars['wednesday_dw_minute'] == '20'): ?>selected="selected"<?php endif; ?>>20</option>
	                            <option value="25" <?php if ($this->_tpl_vars['wednesday_dw_minute'] == '25'): ?>selected="selected"<?php endif; ?>>25</option>
	                            <option value="30" <?php if ($this->_tpl_vars['wednesday_dw_minute'] == '30'): ?>selected="selected"<?php endif; ?>>30</option>
	                            <option value="35" <?php if ($this->_tpl_vars['wednesday_dw_minute'] == '35'): ?>selected="selected"<?php endif; ?>>35</option>
	                            <option value="40" <?php if ($this->_tpl_vars['wednesday_dw_minute'] == '40'): ?>selected="selected"<?php endif; ?>>40</option>
	                            <option value="45" <?php if ($this->_tpl_vars['wednesday_dw_minute'] == '45'): ?>selected="selected"<?php endif; ?>>45</option>
	                            <option value="50" <?php if ($this->_tpl_vars['wednesday_dw_minute'] == '50'): ?>selected="selected"<?php endif; ?>>50</option>
	                            <option value="55" <?php if ($this->_tpl_vars['wednesday_dw_minute'] == '55'): ?>selected="selected"<?php endif; ?>>55</option>
	                        </select>
	                        <select name="wednesday_dw_ampm" class="select" style="width: auto">
	                            <option value="am" <?php if ($this->_tpl_vars['wednesday_dw_ampm'] == 'am'): ?>selected="selected"<?php endif; ?>>am</option>
	                            <option value="pm" <?php if ($this->_tpl_vars['wednesday_dw_ampm'] == 'pm'): ?>selected="selected"<?php endif; ?>>pm</option>
	                        </select>
	                    </td>
	                </tr>
	                <tr>
	                <td>
	                    <input id="thursday" name="thursday" type="checkbox" value="y" <?php if ($this->_tpl_vars['thursday'] == 'y'): ?>checked="checked"<?php endif; ?> /> Thursday
	                    </td>
	                    <td>
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
	                    </td>
	                    
	                    <td>
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
	                    </td>
	                    </tr>
	                    <tr>
	                    <td>
	                    <input id="friday" name="friday" type="checkbox" value="y" <?php if ($this->_tpl_vars['friday'] == 'y'): ?>checked="checked"<?php endif; ?> /> Friday 
	                    </td>
	                    <td>
	                        <select name="friday_aw_hour" class="select" style="width: auto">
	                            <option value="1" <?php if ($this->_tpl_vars['friday_aw_hour'] == '1'): ?>selected="selected"<?php endif; ?>>1</option>
	                            <option value="2" <?php if ($this->_tpl_vars['friday_aw_hour'] == '2'): ?>selected="selected"<?php endif; ?>>2</option>
	                            <option value="3" <?php if ($this->_tpl_vars['friday_aw_hour'] == '3'): ?>selected="selected"<?php endif; ?>>3</option>
	                            <option value="4" <?php if ($this->_tpl_vars['friday_aw_hour'] == '4'): ?>selected="selected"<?php endif; ?>>4</option>
	                            <option value="5" <?php if ($this->_tpl_vars['friday_aw_hour'] == '5'): ?>selected="selected"<?php endif; ?>>5</option>
	                            <option value="6" <?php if ($this->_tpl_vars['friday_aw_hour'] == '6'): ?>selected="selected"<?php endif; ?>>6</option>
	                            <option value="7" <?php if ($this->_tpl_vars['friday_aw_hour'] == '7'): ?>selected="selected"<?php endif; ?>>7</option>
	                            <option value="8" <?php if ($this->_tpl_vars['friday_aw_hour'] == '8'): ?>selected="selected"<?php endif; ?>>8</option>
	                            <option value="9" <?php if ($this->_tpl_vars['friday_aw_hour'] == '9'): ?>selected="selected"<?php endif; ?>>9</option>
	                            <option value="10" <?php if ($this->_tpl_vars['friday_aw_hour'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
	                            <option value="11" <?php if ($this->_tpl_vars['friday_aw_hour'] == '11'): ?>selected="selected"<?php endif; ?>>11</option>
	                            <option value="12" <?php if ($this->_tpl_vars['friday_aw_hour'] == '12'): ?>selected="selected"<?php endif; ?>>12</option>
	                        </select>
	                        <select name="friday_aw_minute" class="select" style="width: auto">
	                            <option value="00" <?php if ($this->_tpl_vars['friday_aw_minute'] == '00'): ?>selected="selected"<?php endif; ?>>00</option>
	                            <option value="05" <?php if ($this->_tpl_vars['friday_aw_minute'] == '05'): ?>selected="selected"<?php endif; ?>>05</option>
	                            <option value="10" <?php if ($this->_tpl_vars['friday_aw_minute'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
	                            <option value="15" <?php if ($this->_tpl_vars['friday_aw_minute'] == '15'): ?>selected="selected"<?php endif; ?>>15</option>
	                            <option value="20" <?php if ($this->_tpl_vars['friday_aw_minute'] == '20'): ?>selected="selected"<?php endif; ?>>20</option>
	                            <option value="25" <?php if ($this->_tpl_vars['friday_aw_minute'] == '25'): ?>selected="selected"<?php endif; ?>>25</option>
	                            <option value="30" <?php if ($this->_tpl_vars['friday_aw_minute'] == '30'): ?>selected="selected"<?php endif; ?>>30</option>
	                            <option value="35" <?php if ($this->_tpl_vars['friday_aw_minute'] == '35'): ?>selected="selected"<?php endif; ?>>35</option>
	                            <option value="40" <?php if ($this->_tpl_vars['friday_aw_minute'] == '40'): ?>selected="selected"<?php endif; ?>>40</option>
	                            <option value="45" <?php if ($this->_tpl_vars['friday_aw_minute'] == '45'): ?>selected="selected"<?php endif; ?>>45</option>
	                            <option value="50" <?php if ($this->_tpl_vars['friday_aw_minute'] == '50'): ?>selected="selected"<?php endif; ?>>50</option>
	                            <option value="55" <?php if ($this->_tpl_vars['friday_aw_minute'] == '55'): ?>selected="selected"<?php endif; ?>>55</option>
	                        </select>
	                        <select name="friday_aw_ampm" class="select" style="width: auto">
	                            <option value="am" <?php if ($this->_tpl_vars['friday_aw_ampm'] == 'am'): ?>selected="selected"<?php endif; ?>>am</option>
	                            <option value="pm" <?php if ($this->_tpl_vars['friday_aw_ampm'] == 'pm'): ?>selected="selected"<?php endif; ?>>pm</option>
	                        </select>
	                    </td>
	                    
	                    <td>
	                        <select name="friday_dw_hour" class="select" style="width: auto">
	                            <option value="1" <?php if ($this->_tpl_vars['friday_dw_hour'] == '1'): ?>selected="selected"<?php endif; ?>>1</option>
	                            <option value="2" <?php if ($this->_tpl_vars['friday_dw_hour'] == '2'): ?>selected="selected"<?php endif; ?>>2</option>
	                            <option value="3" <?php if ($this->_tpl_vars['friday_dw_hour'] == '3'): ?>selected="selected"<?php endif; ?>>3</option>
	                            <option value="4" <?php if ($this->_tpl_vars['friday_dw_hour'] == '4'): ?>selected="selected"<?php endif; ?>>4</option>
	                            <option value="5" <?php if ($this->_tpl_vars['friday_dw_hour'] == '5'): ?>selected="selected"<?php endif; ?>>5</option>
	                            <option value="6" <?php if ($this->_tpl_vars['friday_dw_hour'] == '6'): ?>selected="selected"<?php endif; ?>>6</option>
	                            <option value="7" <?php if ($this->_tpl_vars['friday_dw_hour'] == '7'): ?>selected="selected"<?php endif; ?>>7</option>
	                            <option value="8" <?php if ($this->_tpl_vars['friday_dw_hour'] == '8'): ?>selected="selected"<?php endif; ?>>8</option>
	                            <option value="9" <?php if ($this->_tpl_vars['friday_dw_hour'] == '9'): ?>selected="selected"<?php endif; ?>>9</option>
	                            <option value="10" <?php if ($this->_tpl_vars['friday_dw_hour'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
	                            <option value="11" <?php if ($this->_tpl_vars['friday_dw_hour'] == '11'): ?>selected="selected"<?php endif; ?>>11</option>
	                            <option value="12" <?php if ($this->_tpl_vars['friday_dw_hour'] == '12'): ?>selected="selected"<?php endif; ?>>12</option>
	                        </select>
	                        <select name="friday_dw_minute" class="select" style="width: auto">
	                            <option value="00" <?php if ($this->_tpl_vars['friday_dw_minute'] == '00'): ?>selected="selected"<?php endif; ?>>00</option>
	                            <option value="05" <?php if ($this->_tpl_vars['friday_dw_minute'] == '05'): ?>selected="selected"<?php endif; ?>>05</option>
	                            <option value="10" <?php if ($this->_tpl_vars['friday_dw_minute'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
	                            <option value="15" <?php if ($this->_tpl_vars['friday_dw_minute'] == '15'): ?>selected="selected"<?php endif; ?>>15</option>
	                            <option value="20" <?php if ($this->_tpl_vars['friday_dw_minute'] == '20'): ?>selected="selected"<?php endif; ?>>20</option>
	                            <option value="25" <?php if ($this->_tpl_vars['friday_dw_minute'] == '25'): ?>selected="selected"<?php endif; ?>>25</option>
	                            <option value="30" <?php if ($this->_tpl_vars['friday_dw_minute'] == '30'): ?>selected="selected"<?php endif; ?>>30</option>
	                            <option value="35" <?php if ($this->_tpl_vars['friday_dw_minute'] == '35'): ?>selected="selected"<?php endif; ?>>35</option>
	                            <option value="40" <?php if ($this->_tpl_vars['friday_dw_minute'] == '40'): ?>selected="selected"<?php endif; ?>>40</option>
	                            <option value="45" <?php if ($this->_tpl_vars['friday_dw_minute'] == '45'): ?>selected="selected"<?php endif; ?>>45</option>
	                            <option value="50" <?php if ($this->_tpl_vars['friday_dw_minute'] == '50'): ?>selected="selected"<?php endif; ?>>50</option>
	                            <option value="55" <?php if ($this->_tpl_vars['friday_dw_minute'] == '55'): ?>selected="selected"<?php endif; ?>>55</option>
	                        </select>
	                        <select name="friday_dw_ampm" class="select" style="width: auto">
	                            <option value="am" <?php if ($this->_tpl_vars['friday_dw_ampm'] == 'am'): ?>selected="selected"<?php endif; ?>>am</option>
	                            <option value="pm" <?php if ($this->_tpl_vars['friday_dw_ampm'] == 'pm'): ?>selected="selected"<?php endif; ?>>pm</option>
	                        </select>
	                    </td>
	                </tr>
	                <tr>
	                <td>
	                    <input id="saturday" name="saturday" type="checkbox" value="y" <?php if ($this->_tpl_vars['saturday'] == 'y'): ?>checked="checked"<?php endif; ?> /> Saturday
	                    </td>
	                    <td>
	                        <select name="saturday_aw_hour" class="select" style="width: auto">
	                            <option value="1" <?php if ($this->_tpl_vars['saturday_aw_hour'] == '1'): ?>selected="selected"<?php endif; ?>>1</option>
	                            <option value="2" <?php if ($this->_tpl_vars['saturday_aw_hour'] == '2'): ?>selected="selected"<?php endif; ?>>2</option>
	                            <option value="3" <?php if ($this->_tpl_vars['saturday_aw_hour'] == '3'): ?>selected="selected"<?php endif; ?>>3</option>
	                            <option value="4" <?php if ($this->_tpl_vars['saturday_aw_hour'] == '4'): ?>selected="selected"<?php endif; ?>>4</option>
	                            <option value="5" <?php if ($this->_tpl_vars['saturday_aw_hour'] == '5'): ?>selected="selected"<?php endif; ?>>5</option>
	                            <option value="6" <?php if ($this->_tpl_vars['saturday_aw_hour'] == '6'): ?>selected="selected"<?php endif; ?>>6</option>
	                            <option value="7" <?php if ($this->_tpl_vars['saturday_aw_hour'] == '7'): ?>selected="selected"<?php endif; ?>>7</option>
	                            <option value="8" <?php if ($this->_tpl_vars['saturday_aw_hour'] == '8'): ?>selected="selected"<?php endif; ?>>8</option>
	                            <option value="9" <?php if ($this->_tpl_vars['saturday_aw_hour'] == '9'): ?>selected="selected"<?php endif; ?>>9</option>
	                            <option value="10" <?php if ($this->_tpl_vars['saturday_aw_hour'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
	                            <option value="11" <?php if ($this->_tpl_vars['saturday_aw_hour'] == '11'): ?>selected="selected"<?php endif; ?>>11</option>
	                            <option value="12" <?php if ($this->_tpl_vars['saturday_aw_hour'] == '12'): ?>selected="selected"<?php endif; ?>>12</option>
	                        </select>
	                        <select name="saturday_aw_minute" class="select" style="width: auto">
	                            <option value="00" <?php if ($this->_tpl_vars['saturday_aw_minute'] == '00'): ?>selected="selected"<?php endif; ?>>00</option>
	                            <option value="05" <?php if ($this->_tpl_vars['saturday_aw_minute'] == '05'): ?>selected="selected"<?php endif; ?>>05</option>
	                            <option value="10" <?php if ($this->_tpl_vars['saturday_aw_minute'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
	                            <option value="15" <?php if ($this->_tpl_vars['saturday_aw_minute'] == '15'): ?>selected="selected"<?php endif; ?>>15</option>
	                            <option value="20" <?php if ($this->_tpl_vars['saturday_aw_minute'] == '20'): ?>selected="selected"<?php endif; ?>>20</option>
	                            <option value="25" <?php if ($this->_tpl_vars['saturday_aw_minute'] == '25'): ?>selected="selected"<?php endif; ?>>25</option>
	                            <option value="30" <?php if ($this->_tpl_vars['saturday_aw_minute'] == '30'): ?>selected="selected"<?php endif; ?>>30</option>
	                            <option value="35" <?php if ($this->_tpl_vars['saturday_aw_minute'] == '35'): ?>selected="selected"<?php endif; ?>>35</option>
	                            <option value="40" <?php if ($this->_tpl_vars['saturday_aw_minute'] == '40'): ?>selected="selected"<?php endif; ?>>40</option>
	                            <option value="45" <?php if ($this->_tpl_vars['saturday_aw_minute'] == '45'): ?>selected="selected"<?php endif; ?>>45</option>
	                            <option value="50" <?php if ($this->_tpl_vars['saturday_aw_minute'] == '50'): ?>selected="selected"<?php endif; ?>>50</option>
	                            <option value="55" <?php if ($this->_tpl_vars['saturday_aw_minute'] == '55'): ?>selected="selected"<?php endif; ?>>55</option>
	                        </select>
	                        <select name="saturday_aw_ampm" class="select" style="width: auto">
	                            <option value="am" <?php if ($this->_tpl_vars['saturday_aw_ampm'] == 'am'): ?>selected="selected"<?php endif; ?>>am</option>
	                            <option value="pm" <?php if ($this->_tpl_vars['saturday_aw_ampm'] == 'pm'): ?>selected="selected"<?php endif; ?>>pm</option>
	                        </select>
	                    </td>
	                    
	                    <td>
	                        <select name="saturday_dw_hour" class="select" style="width: auto">
	                            <option value="1" <?php if ($this->_tpl_vars['saturday_dw_hour'] == '1'): ?>selected="selected"<?php endif; ?>>1</option>
	                            <option value="2" <?php if ($this->_tpl_vars['saturday_dw_hour'] == '2'): ?>selected="selected"<?php endif; ?>>2</option>
	                            <option value="3" <?php if ($this->_tpl_vars['saturday_dw_hour'] == '3'): ?>selected="selected"<?php endif; ?>>3</option>
	                            <option value="4" <?php if ($this->_tpl_vars['saturday_dw_hour'] == '4'): ?>selected="selected"<?php endif; ?>>4</option>
	                            <option value="5" <?php if ($this->_tpl_vars['saturday_dw_hour'] == '5'): ?>selected="selected"<?php endif; ?>>5</option>
	                            <option value="6" <?php if ($this->_tpl_vars['saturday_dw_hour'] == '6'): ?>selected="selected"<?php endif; ?>>6</option>
	                            <option value="7" <?php if ($this->_tpl_vars['saturday_dw_hour'] == '7'): ?>selected="selected"<?php endif; ?>>7</option>
	                            <option value="8" <?php if ($this->_tpl_vars['saturday_dw_hour'] == '8'): ?>selected="selected"<?php endif; ?>>8</option>
	                            <option value="9" <?php if ($this->_tpl_vars['saturday_dw_hour'] == '9'): ?>selected="selected"<?php endif; ?>>9</option>
	                            <option value="10" <?php if ($this->_tpl_vars['saturday_dw_hour'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
	                            <option value="11" <?php if ($this->_tpl_vars['saturday_dw_hour'] == '11'): ?>selected="selected"<?php endif; ?>>11</option>
	                            <option value="12" <?php if ($this->_tpl_vars['saturday_dw_hour'] == '12'): ?>selected="selected"<?php endif; ?>>12</option>
	                        </select>
	                        <select name="saturday_dw_minute" class="select" style="width: auto">
	                            <option value="00" <?php if ($this->_tpl_vars['saturday_dw_minute'] == '00'): ?>selected="selected"<?php endif; ?>>00</option>
	                            <option value="05" <?php if ($this->_tpl_vars['saturday_dw_minute'] == '05'): ?>selected="selected"<?php endif; ?>>05</option>
	                            <option value="10" <?php if ($this->_tpl_vars['saturday_dw_minute'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
	                            <option value="15" <?php if ($this->_tpl_vars['saturday_dw_minute'] == '15'): ?>selected="selected"<?php endif; ?>>15</option>
	                            <option value="20" <?php if ($this->_tpl_vars['saturday_dw_minute'] == '20'): ?>selected="selected"<?php endif; ?>>20</option>
	                            <option value="25" <?php if ($this->_tpl_vars['saturday_dw_minute'] == '25'): ?>selected="selected"<?php endif; ?>>25</option>
	                            <option value="30" <?php if ($this->_tpl_vars['saturday_dw_minute'] == '30'): ?>selected="selected"<?php endif; ?>>30</option>
	                            <option value="35" <?php if ($this->_tpl_vars['saturday_dw_minute'] == '35'): ?>selected="selected"<?php endif; ?>>35</option>
	                            <option value="40" <?php if ($this->_tpl_vars['saturday_dw_minute'] == '40'): ?>selected="selected"<?php endif; ?>>40</option>
	                            <option value="45" <?php if ($this->_tpl_vars['saturday_dw_minute'] == '45'): ?>selected="selected"<?php endif; ?>>45</option>
	                            <option value="50" <?php if ($this->_tpl_vars['saturday_dw_minute'] == '50'): ?>selected="selected"<?php endif; ?>>50</option>
	                            <option value="55" <?php if ($this->_tpl_vars['saturday_dw_minute'] == '55'): ?>selected="selected"<?php endif; ?>>55</option>
	                        </select>
	                        <select name="saturday_dw_ampm" class="select" style="width: auto">
	                            <option value="am" <?php if ($this->_tpl_vars['saturday_dw_ampm'] == 'am'): ?>selected="selected"<?php endif; ?>>am</option>
	                            <option value="pm" <?php if ($this->_tpl_vars['saturday_dw_ampm'] == 'pm'): ?>selected="selected"<?php endif; ?>>pm</option>
	                        </select>
	                    </td>
	                </tr>
	                <tr>
	                <td>
	                    <input id="sunday" name="sunday" type="checkbox" value="y" <?php if ($this->_tpl_vars['sunday'] == 'y'): ?>checked="checked"<?php endif; ?> /> Sunday
	                </td>
	                <td>
	                        <select name="sunday_aw_hour" class="select" style="width: auto">
	                            <option value="1" <?php if ($this->_tpl_vars['sunday_aw_hour'] == '1'): ?>selected="selected"<?php endif; ?>>1</option>
	                            <option value="2" <?php if ($this->_tpl_vars['sunday_aw_hour'] == '2'): ?>selected="selected"<?php endif; ?>>2</option>
	                            <option value="3" <?php if ($this->_tpl_vars['sunday_aw_hour'] == '3'): ?>selected="selected"<?php endif; ?>>3</option>
	                            <option value="4" <?php if ($this->_tpl_vars['sunday_aw_hour'] == '4'): ?>selected="selected"<?php endif; ?>>4</option>
	                            <option value="5" <?php if ($this->_tpl_vars['sunday_aw_hour'] == '5'): ?>selected="selected"<?php endif; ?>>5</option>
	                            <option value="6" <?php if ($this->_tpl_vars['sunday_aw_hour'] == '6'): ?>selected="selected"<?php endif; ?>>6</option>
	                            <option value="7" <?php if ($this->_tpl_vars['sunday_aw_hour'] == '7'): ?>selected="selected"<?php endif; ?>>7</option>
	                            <option value="8" <?php if ($this->_tpl_vars['sunday_aw_hour'] == '8'): ?>selected="selected"<?php endif; ?>>8</option>
	                            <option value="9" <?php if ($this->_tpl_vars['sunday_aw_hour'] == '9'): ?>selected="selected"<?php endif; ?>>9</option>
	                            <option value="10" <?php if ($this->_tpl_vars['sunday_aw_hour'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
	                            <option value="11" <?php if ($this->_tpl_vars['sunday_aw_hour'] == '11'): ?>selected="selected"<?php endif; ?>>11</option>
	                            <option value="12" <?php if ($this->_tpl_vars['sunday_aw_hour'] == '12'): ?>selected="selected"<?php endif; ?>>12</option>
	                        </select>
	                        <select name="sunday_aw_minute" class="select" style="width: auto">
	                            <option value="00" <?php if ($this->_tpl_vars['sunday_aw_minute'] == '00'): ?>selected="selected"<?php endif; ?>>00</option>
	                            <option value="05" <?php if ($this->_tpl_vars['sunday_aw_minute'] == '05'): ?>selected="selected"<?php endif; ?>>05</option>
	                            <option value="10" <?php if ($this->_tpl_vars['sunday_aw_minute'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
	                            <option value="15" <?php if ($this->_tpl_vars['sunday_aw_minute'] == '15'): ?>selected="selected"<?php endif; ?>>15</option>
	                            <option value="20" <?php if ($this->_tpl_vars['sunday_aw_minute'] == '20'): ?>selected="selected"<?php endif; ?>>20</option>
	                            <option value="25" <?php if ($this->_tpl_vars['sunday_aw_minute'] == '25'): ?>selected="selected"<?php endif; ?>>25</option>
	                            <option value="30" <?php if ($this->_tpl_vars['sunday_aw_minute'] == '30'): ?>selected="selected"<?php endif; ?>>30</option>
	                            <option value="35" <?php if ($this->_tpl_vars['sunday_aw_minute'] == '35'): ?>selected="selected"<?php endif; ?>>35</option>
	                            <option value="40" <?php if ($this->_tpl_vars['sunday_aw_minute'] == '40'): ?>selected="selected"<?php endif; ?>>40</option>
	                            <option value="45" <?php if ($this->_tpl_vars['sunday_aw_minute'] == '45'): ?>selected="selected"<?php endif; ?>>45</option>
	                            <option value="50" <?php if ($this->_tpl_vars['sunday_aw_minute'] == '50'): ?>selected="selected"<?php endif; ?>>50</option>
	                            <option value="55" <?php if ($this->_tpl_vars['sunday_aw_minute'] == '55'): ?>selected="selected"<?php endif; ?>>55</option>
	                        </select>
	                        <select name="sunday_aw_ampm" class="select" style="width: auto">
	                            <option value="am" <?php if ($this->_tpl_vars['sunday_aw_ampm'] == 'am'): ?>selected="selected"<?php endif; ?>>am</option>
	                            <option value="pm" <?php if ($this->_tpl_vars['sunday_aw_ampm'] == 'pm'): ?>selected="selected"<?php endif; ?>>pm</option>
	                        </select>
	                    </td>
	                    
	                    <td>
	                        <select name="sunday_dw_hour" class="select" style="width: auto">
	                            <option value="1" <?php if ($this->_tpl_vars['sunday_dw_hour'] == '1'): ?>selected="selected"<?php endif; ?>>1</option>
	                            <option value="2" <?php if ($this->_tpl_vars['sunday_dw_hour'] == '2'): ?>selected="selected"<?php endif; ?>>2</option>
	                            <option value="3" <?php if ($this->_tpl_vars['sunday_dw_hour'] == '3'): ?>selected="selected"<?php endif; ?>>3</option>
	                            <option value="4" <?php if ($this->_tpl_vars['sunday_dw_hour'] == '4'): ?>selected="selected"<?php endif; ?>>4</option>
	                            <option value="5" <?php if ($this->_tpl_vars['sunday_dw_hour'] == '5'): ?>selected="selected"<?php endif; ?>>5</option>
	                            <option value="6" <?php if ($this->_tpl_vars['sunday_dw_hour'] == '6'): ?>selected="selected"<?php endif; ?>>6</option>
	                            <option value="7" <?php if ($this->_tpl_vars['sunday_dw_hour'] == '7'): ?>selected="selected"<?php endif; ?>>7</option>
	                            <option value="8" <?php if ($this->_tpl_vars['sunday_dw_hour'] == '8'): ?>selected="selected"<?php endif; ?>>8</option>
	                            <option value="9" <?php if ($this->_tpl_vars['sunday_dw_hour'] == '9'): ?>selected="selected"<?php endif; ?>>9</option>
	                            <option value="10" <?php if ($this->_tpl_vars['sunday_dw_hour'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
	                            <option value="11" <?php if ($this->_tpl_vars['sunday_dw_hour'] == '11'): ?>selected="selected"<?php endif; ?>>11</option>
	                            <option value="12" <?php if ($this->_tpl_vars['sunday_dw_hour'] == '12'): ?>selected="selected"<?php endif; ?>>12</option>
	                        </select>
	                        <select name="sunday_dw_minute" class="select" style="width: auto">
	                            <option value="00" <?php if ($this->_tpl_vars['sunday_dw_minute'] == '00'): ?>selected="selected"<?php endif; ?>>00</option>
	                            <option value="05" <?php if ($this->_tpl_vars['sunday_dw_minute'] == '05'): ?>selected="selected"<?php endif; ?>>05</option>
	                            <option value="10" <?php if ($this->_tpl_vars['sunday_dw_minute'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
	                            <option value="15" <?php if ($this->_tpl_vars['sunday_dw_minute'] == '15'): ?>selected="selected"<?php endif; ?>>15</option>
	                            <option value="20" <?php if ($this->_tpl_vars['sunday_dw_minute'] == '20'): ?>selected="selected"<?php endif; ?>>20</option>
	                            <option value="25" <?php if ($this->_tpl_vars['sunday_dw_minute'] == '25'): ?>selected="selected"<?php endif; ?>>25</option>
	                            <option value="30" <?php if ($this->_tpl_vars['sunday_dw_minute'] == '30'): ?>selected="selected"<?php endif; ?>>30</option>
	                            <option value="35" <?php if ($this->_tpl_vars['sunday_dw_minute'] == '35'): ?>selected="selected"<?php endif; ?>>35</option>
	                            <option value="40" <?php if ($this->_tpl_vars['sunday_dw_minute'] == '40'): ?>selected="selected"<?php endif; ?>>40</option>
	                            <option value="45" <?php if ($this->_tpl_vars['sunday_dw_minute'] == '45'): ?>selected="selected"<?php endif; ?>>45</option>
	                            <option value="50" <?php if ($this->_tpl_vars['sunday_dw_minute'] == '50'): ?>selected="selected"<?php endif; ?>>50</option>
	                            <option value="55" <?php if ($this->_tpl_vars['sunday_dw_minute'] == '55'): ?>selected="selected"<?php endif; ?>>55</option>
	                        </select>
	                        <select name="sunday_dw_ampm" class="select" style="width: auto">
	                            <option value="am" <?php if ($this->_tpl_vars['sunday_dw_ampm'] == 'am'): ?>selected="selected"<?php endif; ?>>am</option>
	                            <option value="pm" <?php if ($this->_tpl_vars['sunday_dw_ampm'] == 'pm'): ?>selected="selected"<?php endif; ?>>pm</option>
	                        </select>
	                    </td>
	                </tr>
	                </table>
	                <div class="formelement">
	                	<label for="oldstart">Schedule last changed</label>
	                	<span name="oldstart"><?php echo $this->_tpl_vars['oldstart']; ?>
</span>
	                </div>
	                
	                   <!-- Start date -->
	                <div class="formelement">
	                	<label for="month">Start Date</label>
	                    <select name="month" class="select" style="width: auto">
	                        <option value="1" <?php if ($this->_tpl_vars['month'] == '1'): ?>selected="selected"<?php endif; ?>>January</option>
	                        <option value="2" <?php if ($this->_tpl_vars['month'] == '2'): ?>selected="selected"<?php endif; ?>>February</option>
	                        <option value="3" <?php if ($this->_tpl_vars['month'] == '3'): ?>selected="selected"<?php endif; ?>>March</option>
	                        <option value="4" <?php if ($this->_tpl_vars['month'] == '4'): ?>selected="selected"<?php endif; ?>>April</option>
	                        <option value="5" <?php if ($this->_tpl_vars['month'] == '5'): ?>selected="selected"<?php endif; ?>>May</option>
	                        <option value="6" <?php if ($this->_tpl_vars['month'] == '6'): ?>selected="selected"<?php endif; ?>>June</option>
	                        <option value="7" <?php if ($this->_tpl_vars['month'] == '7'): ?>selected="selected"<?php endif; ?>>July</option>
	                        <option value="8" <?php if ($this->_tpl_vars['month'] == '8'): ?>selected="selected"<?php endif; ?>>August</option>
	                        <option value="9" <?php if ($this->_tpl_vars['month'] == '9'): ?>selected="selected"<?php endif; ?>>September</option>
	                        <option value="10" <?php if ($this->_tpl_vars['month'] == '10'): ?>selected="selected"<?php endif; ?>>October</option>
	                        <option value="11" <?php if ($this->_tpl_vars['month'] == '11'): ?>selected="selected"<?php endif; ?>>November</option>
	                        <option value="12" <?php if ($this->_tpl_vars['month'] == '12'): ?>selected="selected"<?php endif; ?>>December</option>
	                    </select>
	                    <select name="day" class="select" style="width: auto">
	                        <option value="1" <?php if ($this->_tpl_vars['day'] == '1'): ?>selected="selected"<?php endif; ?>>1</option>
	                        <option value="2" <?php if ($this->_tpl_vars['day'] == '2'): ?>selected="selected"<?php endif; ?>>2</option>
	                        <option value="3" <?php if ($this->_tpl_vars['day'] == '3'): ?>selected="selected"<?php endif; ?>>3</option>
	                        <option value="4" <?php if ($this->_tpl_vars['day'] == '4'): ?>selected="selected"<?php endif; ?>>4</option>
	                        <option value="5" <?php if ($this->_tpl_vars['day'] == '5'): ?>selected="selected"<?php endif; ?>>5</option>
	                        <option value="6" <?php if ($this->_tpl_vars['day'] == '6'): ?>selected="selected"<?php endif; ?>>6</option>
	                        <option value="7" <?php if ($this->_tpl_vars['day'] == '7'): ?>selected="selected"<?php endif; ?>>7</option>
	                        <option value="8" <?php if ($this->_tpl_vars['day'] == '8'): ?>selected="selected"<?php endif; ?>>8</option>
	                        <option value="9" <?php if ($this->_tpl_vars['day'] == '9'): ?>selected="selected"<?php endif; ?>>9</option>
	                        <option value="10" <?php if ($this->_tpl_vars['day'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
	                        <option value="11" <?php if ($this->_tpl_vars['day'] == '11'): ?>selected="selected"<?php endif; ?>>11</option>
	                        <option value="12" <?php if ($this->_tpl_vars['day'] == '12'): ?>selected="selected"<?php endif; ?>>12</option>
	                        <option value="13" <?php if ($this->_tpl_vars['day'] == '13'): ?>selected="selected"<?php endif; ?>>13</option>
	                        <option value="14" <?php if ($this->_tpl_vars['day'] == '14'): ?>selected="selected"<?php endif; ?>>14</option>
	                        <option value="15" <?php if ($this->_tpl_vars['day'] == '15'): ?>selected="selected"<?php endif; ?>>15</option>
	                        <option value="16" <?php if ($this->_tpl_vars['day'] == '16'): ?>selected="selected"<?php endif; ?>>16</option>
	                        <option value="17" <?php if ($this->_tpl_vars['day'] == '17'): ?>selected="selected"<?php endif; ?>>17</option>
	                        <option value="18" <?php if ($this->_tpl_vars['day'] == '18'): ?>selected="selected"<?php endif; ?>>18</option>
	                        <option value="19" <?php if ($this->_tpl_vars['day'] == '19'): ?>selected="selected"<?php endif; ?>>19</option>
	                        <option value="20" <?php if ($this->_tpl_vars['day'] == '20'): ?>selected="selected"<?php endif; ?>>20</option>
	                        <option value="21" <?php if ($this->_tpl_vars['day'] == '21'): ?>selected="selected"<?php endif; ?>>21</option>
	                        <option value="22" <?php if ($this->_tpl_vars['day'] == '22'): ?>selected="selected"<?php endif; ?>>22</option>
	                        <option value="23" <?php if ($this->_tpl_vars['day'] == '23'): ?>selected="selected"<?php endif; ?>>23</option>
	                        <option value="24" <?php if ($this->_tpl_vars['day'] == '24'): ?>selected="selected"<?php endif; ?>>24</option>
	                        <option value="25" <?php if ($this->_tpl_vars['day'] == '25'): ?>selected="selected"<?php endif; ?>>25</option>
	                        <option value="26" <?php if ($this->_tpl_vars['day'] == '26'): ?>selected="selected"<?php endif; ?>>26</option>
	                        <option value="27" <?php if ($this->_tpl_vars['day'] == '27'): ?>selected="selected"<?php endif; ?>>27</option>
	                        <option value="28" <?php if ($this->_tpl_vars['day'] == '28'): ?>selected="selected"<?php endif; ?>>28</option>
	                        <option value="29" <?php if ($this->_tpl_vars['day'] == '29'): ?>selected="selected"<?php endif; ?>>29</option>
	                        <option value="30" <?php if ($this->_tpl_vars['day'] == '30'): ?>selected="selected"<?php endif; ?>>30</option>
	                        <option value="31" <?php if ($this->_tpl_vars['day'] == '31'): ?>selected="selected"<?php endif; ?>>31</option>
	                    </select>
	                    <select name="year" class="select" style="width: auto">
	                        <option value="2008" <?php if ($this->_tpl_vars['year'] == '2008'): ?>selected="selected"<?php endif; ?>>2008</option>
	                        <option value="2009" <?php if ($this->_tpl_vars['year'] == '2009'): ?>selected="selected"<?php endif; ?>>2009</option>
	                        <option value="2010" <?php if ($this->_tpl_vars['year'] == '2010'): ?>selected="selected"<?php endif; ?>>2010</option>
	                        <option value="2011" <?php if ($this->_tpl_vars['year'] == '2011'): ?>selected="selected"<?php endif; ?>>2011</option>
	                        <option value="2012" <?php if ($this->_tpl_vars['year'] == '2012'): ?>selected="selected"<?php endif; ?>>2012</option>
	                    </select>
	                    <div id="daysofweekError" class="formerror"><?php echo $this->_tpl_vars['error']['daysofweek']; ?>
</div>	
	                    <div id="startdateError" class="formerror"><?php echo $this->_tpl_vars['error']['startdate']; ?>
</div>
	                </div>
                    
                    <!--<div class="formelement">
                    	<input name="deleteconfirm" type="checkbox" value="y" <?php if ($this->_tpl_vars['deleteconfirm'] == 'y'): ?>checked="checked"<?php endif; ?> /> Trigger reconfirmation process? <a name="confirmation_trigger" class="tooltipClass" id="confirmation_trigger"><img src="images/icon_tooltip.gif" border="0"/> </a>
                    </div>-->
	                
	                <div class="formelement" >
		                <input id="submit" name="submit" type="submit" value="Save Schedule" class="submit" />
		                <input id="cancel" name="cancel" type="button" value="Cancel" class="cancel" />
					</div>
	            </form>
	
            
            	<?php else: ?>
            			
            		<?php if ($this->_tpl_vars['monday'] != 'y' && $this->_tpl_vars['tuesday'] != 'y' && $this->_tpl_vars['wednesday'] != 'y' && $this->_tpl_vars['thursday'] != 'y' && $this->_tpl_vars['friday'] != 'y' && $this->_tpl_vars['saturday'] != 'y' && $this->_tpl_vars['sunday'] != 'y'): ?>
            			<div class="yellowbox" >The schedule has not yet been set up by the group leader.</div>
            			<?php else: ?>
                    <img src="images/table3.gif" /><br/>
          			<table class="table3">
	                	<tr class="tablehead">
	                		<th>Days of the Week</th>
	                		<th>Arrive at Workplace</th>
	                		<th>Depart from Workplace</th>
	                	</tr>
            			<?php if ($this->_tpl_vars['monday'] == 'y'): ?>
		                	<tr>
            				<td>Monday</td>
            				<td><?php echo $this->_tpl_vars['monday_aw_hour']; ?>
:<?php echo $this->_tpl_vars['monday_aw_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['monday_aw_ampm']; ?>
</td>
            				<td><?php echo $this->_tpl_vars['monday_dw_hour']; ?>
:<?php echo $this->_tpl_vars['monday_dw_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['monday_dw_ampm']; ?>
</td>
            				</tr>
            			<?php endif; ?>
            			<?php if ($this->_tpl_vars['tuesday'] == 'y'): ?>
		                	<tr>
            				<td>Tuesday</td>
            				<td><?php echo $this->_tpl_vars['tuesday_aw_hour']; ?>
:<?php echo $this->_tpl_vars['tuesday_aw_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['tuesday_aw_ampm']; ?>
</td>
            				<td><?php echo $this->_tpl_vars['tuesday_dw_hour']; ?>
:<?php echo $this->_tpl_vars['tuesday_dw_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['tuesday_dw_ampm']; ?>
</td>
            				</tr>
            			<?php endif; ?>
            			<?php if ($this->_tpl_vars['wednesday'] == 'y'): ?>
		                	<tr>
            				<td>Wednesday</td>
            				<td><?php echo $this->_tpl_vars['wednesday_aw_hour']; ?>
:<?php echo $this->_tpl_vars['wednesday_aw_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['wednesday_aw_ampm']; ?>
</td>
            				<td><?php echo $this->_tpl_vars['wednesday_dw_hour']; ?>
:<?php echo $this->_tpl_vars['wednesday_dw_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['wednesday_dw_ampm']; ?>
</td>
            				</tr>
            			<?php endif; ?>
            			<?php if ($this->_tpl_vars['thursday'] == 'y'): ?>
		                	<tr>
            				<td>Thursday</td>
            				<td><?php echo $this->_tpl_vars['thursday_aw_hour']; ?>
:<?php echo $this->_tpl_vars['thursday_aw_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['thursday_aw_ampm']; ?>
</td>
            				<td><?php echo $this->_tpl_vars['thursday_dw_hour']; ?>
:<?php echo $this->_tpl_vars['thursday_dw_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['thursday_dw_ampm']; ?>
</td>
            				</tr>
            			<?php endif; ?>
            			
            			<?php if ($this->_tpl_vars['friday'] == 'y'): ?>
		                	<tr>
            				<td>Friday</td>
            				<td><?php echo $this->_tpl_vars['friday_aw_hour']; ?>
:<?php echo $this->_tpl_vars['friday_aw_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['friday_aw_ampm']; ?>
</td>
            				<td><?php echo $this->_tpl_vars['friday_dw_hour']; ?>
:<?php echo $this->_tpl_vars['friday_dw_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['friday_dw_ampm']; ?>
</td>
            				</tr>
            			<?php endif; ?>
            			
            			<?php if ($this->_tpl_vars['saturday'] == 'y'): ?>
		                	<tr>
            				<td>Saturday</td>
            				<td><?php echo $this->_tpl_vars['saturday_aw_hour']; ?>
:<?php echo $this->_tpl_vars['saturday_aw_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['saturday_aw_ampm']; ?>
</td>
            				<td><?php echo $this->_tpl_vars['saturday_dw_hour']; ?>
:<?php echo $this->_tpl_vars['saturday_dw_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['saturday_dw_ampm']; ?>
</td>
            				</tr>
            			<?php endif; ?>
            			
            			<?php if ($this->_tpl_vars['sunday'] == 'y'): ?>
		                	<tr>
            				<td>Sunday</td>
            				<td><?php echo $this->_tpl_vars['sunday_aw_hour']; ?>
:<?php echo $this->_tpl_vars['sunday_aw_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['sunday_aw_ampm']; ?>
</td>
            				<td><?php echo $this->_tpl_vars['sunday_dw_hour']; ?>
:<?php echo $this->_tpl_vars['sunday_dw_minute']; ?>
&nbsp;<?php echo $this->_tpl_vars['sunday_dw_ampm']; ?>
</td>
            				</tr>
            			<?php endif; ?>
            			
            			</table>
          			<?php endif; ?>
            	<?php endif; ?>
            
            </div>
            
            <div class="innercolumn" id="last">
            <!-- Comments -->
            <img src="images/table1.gif" /><br/>
            <table class="table1">
                <tr class="tablehead">
                    <th >Shout About This</th>
                </tr>
                <tr id="comments">
                    <td  >
                        <form id="commentform">
                            <input id="comment" name="comment" type="text" class="textbox" /> 
                            <input id="comment_submit" name="submit" type="submit" value="Add Shout" />
                            <img id="comment_indicator" src="images/indicator.gif" alt="" class="indicator" style="display: none;"/>
                        </form>
                    </td>
                </tr>
                <?php unset($this->_sections['info']);
$this->_sections['info']['name'] = 'info';
$this->_sections['info']['loop'] = is_array($_loop=$this->_tpl_vars['comments']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                        <div class="leftcell"><img src="icons/shout.gif" alt="" class="icon" /></div>
                        <div class="rightcell"><span class="purple"> <?php echo $this->_tpl_vars['comments'][$this->_sections['info']['index']]['name']; ?>
</span><br /><span class="grey"><?php echo $this->_tpl_vars['comments'][$this->_sections['info']['index']]['date']; ?>
</span><br />
                        
                            <?php echo $this->_tpl_vars['comments'][$this->_sections['info']['index']]['comment']; ?>
 
                            </div>
                    	</td>
                    </tr>
                <?php endfor; endif; ?>
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
	<div id="tooltip">&nbsp;</div>
</body>
</html>