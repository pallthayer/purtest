<?php /* Smarty version 2.6.19, created on 2008-08-14 11:02:51
         compiled from pools-schedule-create.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Purpool</title>

<link href="css/styles.css" rel="stylesheet" type="text/css" />

<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>

<script language="javascript" src="js/scriptaculous/src/scriptaculous.js"></script>

<script language="javascript" src="js/formfocus.js"></script>

<script language="javascript" src="js/indicator.js"></script>



<?php echo '

<script type="text/javascript">



/*



// INITIAL EVENT LISTENERS

document.observe("dom:loaded", function() 

{

	// Listen for choosing a driver

	if($(\'mondayform\')) { Event.observe(\'mondayform\', \'submit\', updateDriverPost.bindAsEventListener(this, \'mondayform\')); }

	if($(\'tuesdayform\')) { Event.observe(\'tuesdayform\', \'submit\', updateDriverPost.bindAsEventListener(this, \'tuesdayform\')); }

	if($(\'wednesdayform\')) { Event.observe(\'wednesdayform\', \'submit\', updateDriverPost.bindAsEventListener(this, \'wednesdayform\')); }

	if($(\'thursdayform\')) { Event.observe(\'thursdayform\', \'submit\', updateDriverPost.bindAsEventListener(this, \'thursdayform\')); }

	if($(\'fridayform\')) { Event.observe(\'fridayform\', \'submit\', updateDriverPost.bindAsEventListener(this, \'fridayform\')); }

	if($(\'saturdayform\')) { Event.observe(\'saturdayform\', \'submit\', updateDriverPost.bindAsEventListener(this, \'saturdayform\')); }

	if($(\'sundayform\')) { Event.observe(\'sundayform\', \'submit\', updateDriverPost.bindAsEventListener(this, \'sundayform\')); }



});



// UPDATE DRIVER POST

function updateDriverPost(e, frm)

{

	// Prevent page refresh

	Event.stop(e);



	// Send AJAX request

	var url = \'pools.php?state=updatedriver\';

	var params = Form.serialize(frm);

	var ajax = new Ajax.Request( url, { method: \'post\', postBody: params, onSuccess: updateDriverResponse });

}



// UPDATE DRIVER RESPONSE

function updateDriverResponse(resp)

{

	// Obtain JSON response

	var json = resp.responseText.evalJSON();

	

	// If successful, goto step three (interests)

	if(json.status == \'success\')

	{

		alert (\'temporary confirmation\');

	}

}



// CONFIRM POST

function confirmPost(val, pool, day)

{

	// Send AJAX request

	var url = \'pools.php?state=confirm&val=\' + val + \'&pool=\' + pool + \'&day=\' + day;

	var ajax = new Ajax.Request( url, { method: \'post\', onSuccess: confirmResponse });

}



// CONFIRM RESPONSE

function confirmResponse(resp)

{

	// Obtain JSON response

	var json = resp.responseText.evalJSON();

	

	// If successful, goto step three (interests)

	if(json.status == \'success\')

	{

		alert (\'temporary confirmation. Your have selected \' + json.val);

	}

}



*/

</script>



<style type="text/css">



	.available:link, .available:visited {

		background-color: #f5f5f5;

		color: #999;

		border: 1px solid #ccc;

		padding: 3px 5px 3px 5px;

		margin-right: 5px;

		text-decoration: none;

	}

	

	.available:hover {

		background-color: #690;

		color: #fff;

		border: 1px solid #060;

		padding: 3px 5px 3px 5px;

		text-decoration: none;

	}

	

	.changesrequested:link, .changesrequested:visited {

		background-color: #f5f5f5;

		color: #999;

		border: 1px solid #ccc;

		padding: 3px 5px 3px 5px;

		margin-right: 5px;

		text-decoration: none;

	}

	

	.changesrequested:hover {

		background-color: #f60;

		color: #fff;

		border: 1px solid #f30;

		padding: 3px 5px 3px 5px;

		text-decoration: none;

	}

	

	.notavailable:link, .notavailable:visited {

		background-color: #f5f5f5;

		color: #999;

		border: 1px solid #ccc;

		padding: 3px 5px 3px 5px;

		text-decoration: none;

	}

	

	.notavailable:hover {

		background-color: #c00;

		color: #fff;

		border: 1px solid #900;

		padding: 3px 5px 3px 5px;

		text-decoration: none;

	}



</style>





'; ?>




</head>



<body>



	<!-- Header -->

    <div id="header">

    	

        <!-- Purpool Logo -->

        <img src="images/logo.jpg" alt="Purpool" />

        

        <!-- Top Navigation -->

        <div id="topnav">

        	<ul>

            	<li><a href="signin.php?state=signout">Sign out</a></li>

            </ul>

        </div>

        

    </div>

    

    <!-- Left Column -->

    <div id="leftcolumn">

    

    	<!-- Side Navigation -->

        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "sidenavigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

    

    </div>

    

    <!-- Right Column -->

    <div id="rightcolumn">

    

    	<!-- Page Title -->

        <h1>Pools</h1>

        

        <!-- Tabs -->

        <div id="tabs">

        	<ul>

            	<li><a href="pools.php?state=editpool&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">General</a></li>

                <li><a href="pools.php?state=editmembers&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Members</a></li>

                <li class="current"><a href="pools.php?state=editschedule&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Schedule</a></li>

            </ul>

        </div>



		<!-- General Information -->

		<div class="purplebox">

			<img src="icons/arrow_orange_right.gif" alt="" class="icon" /> General Information

		</div>

        

        <table class="noborders">

        	<tr>

            	<td><span class="purple">Pool name:</span></td>

                <td><?php echo $this->_tpl_vars['title']; ?>
</td>

            </tr>

            <tr>

            	<td><span class="purple">Meeting Place:</span></td>

                <td><?php if ($this->_tpl_vars['startplace'] != 'other'): ?><?php echo $this->_tpl_vars['startplace']; ?>
: <?php endif; ?><?php echo $this->_tpl_vars['startaddress1']; ?>
<?php if ($this->_tpl_vars['startaddress2']): ?> <?php echo $this->_tpl_vars['startaddress2']; ?>
<?php endif; ?> <?php echo $this->_tpl_vars['startcity']; ?>
 <?php echo $this->_tpl_vars['startstate']; ?>
 <?php echo $this->_tpl_vars['startzip']; ?>
</td>

            </tr>

            <tr>

            	<td><span class="purple">Workplace:</span></td>

                <td><?php if ($this->_tpl_vars['endplace'] != 'other'): ?><?php echo $this->_tpl_vars['endplace']; ?>
: <?php endif; ?><?php echo $this->_tpl_vars['endaddress1']; ?>
<?php if ($this->_tpl_vars['endaddress2']): ?> <?php echo $this->_tpl_vars['endaddress2']; ?>
<?php endif; ?> <?php echo $this->_tpl_vars['endcity']; ?>
 <?php echo $this->_tpl_vars['endstate']; ?>
 <?php echo $this->_tpl_vars['endzip']; ?>
</td>

            </tr>

            <tr>

            	<td><span class="purple">Access:</span></td>

                <td><?php echo $this->_tpl_vars['access']; ?>
</td>

            </tr>

            <tr>

            	<td><span class="purple">Smoking:</span></td>

                <td><?php echo $this->_tpl_vars['smoking']; ?>
</td>

            </tr>

			<?php if ($this->_tpl_vars['additionalinfo']): ?>

            	<tr>

            		<td><span class="purple">Additional Info:</span></td>

            	    <td><?php echo $this->_tpl_vars['additionalinfo']; ?>
</td>

            	</tr>

            <?php endif; ?>

        </table>

        

        <!-- Days -->

		<div class="purplebox">

			<img src="icons/arrow_orange_right.gif" alt="" class="icon" /> Days of week

		</div>

        

		<form id="myform" name="myform" method="post" action="pools.php?state=createschedule">

            <div class="formelement"> 

                <input id="sunday" name="sunday" type="checkbox" value="y" <?php if ($this->_tpl_vars['sunday']): ?>checked="checked"<?php endif; ?> /> Sunday <br />

                <input id="monday" name="monday" type="checkbox" value="y" <?php if ($this->_tpl_vars['monday']): ?>checked="checked"<?php endif; ?> /> Monday <br />

                <input id="tuesday" name="tuesday" type="checkbox" value="y" <?php if ($this->_tpl_vars['tuesday']): ?>checked="checked"<?php endif; ?> /> Tuesday <br />

                <input id="wednesday" name="wednesday" type="checkbox" value="y" <?php if ($this->_tpl_vars['wednesday']): ?>checked="checked"<?php endif; ?> /> Wednesday <br />

                <input id="thursday" name="thursday" type="checkbox" value="y" <?php if ($this->_tpl_vars['thursday']): ?>checked="checked"<?php endif; ?> /> Thursday <br />

                <input id="friday" name="friday" type="checkbox" value="y" <?php if ($this->_tpl_vars['friday']): ?>checked="checked"<?php endif; ?> /> Friday <br />

                <input id="saturday" name="saturday" type="checkbox" value="y" <?php if ($this->_tpl_vars['saturday']): ?>checked="checked"<?php endif; ?> /> Saturday

                <div id="daysofweekError" class="formerror"><?php echo $this->_tpl_vars['error']['daysofweek']; ?>
</div>

			</div>

        </form>

        

        <!-- Monday -->

        <div id="mondaycontainer">

			<div class="purplebox">

				<img src="icons/arrow_orange_right.gif" alt="" class="icon" /> Monday

			</div>



			<div class="formelement">

            	<label for="monday_dm_hour">Depart from meeting place</label>

            	<select name="monday_dm_hour" class="select" style="width: auto">

                    <option value="1" <?php if ($this->_tpl_vars['monday_dm_hour'] == '1'): ?>selected="selected"<?php endif; ?>>1</option>

                    <option value="2" <?php if ($this->_tpl_vars['monday_dm_hour'] == '2'): ?>selected="selected"<?php endif; ?>>2</option>

                    <option value="3" <?php if ($this->_tpl_vars['monday_dm_hour'] == '3'): ?>selected="selected"<?php endif; ?>>3</option>

                    <option value="4" <?php if ($this->_tpl_vars['monday_dm_hour'] == '4'): ?>selected="selected"<?php endif; ?>>4</option>

                    <option value="5" <?php if ($this->_tpl_vars['monday_dm_hour'] == '5'): ?>selected="selected"<?php endif; ?>>5</option>

                    <option value="6" <?php if ($this->_tpl_vars['monday_dm_hour'] == '6'): ?>selected="selected"<?php endif; ?>>6</option>

                    <option value="7" <?php if ($this->_tpl_vars['monday_dm_hour'] == '7'): ?>selected="selected"<?php endif; ?>>7</option>

                    <option value="8" <?php if ($this->_tpl_vars['monday_dm_hour'] == '8'): ?>selected="selected"<?php endif; ?>>8</option>

                    <option value="9" <?php if ($this->_tpl_vars['monday_dm_hour'] == '9'): ?>selected="selected"<?php endif; ?>>9</option>

                    <option value="10" <?php if ($this->_tpl_vars['monday_dm_hour'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>

                    <option value="11" <?php if ($this->_tpl_vars['monday_dm_hour'] == '11'): ?>selected="selected"<?php endif; ?>>11</option>

                    <option value="12" <?php if ($this->_tpl_vars['monday_dm_hour'] == '12'): ?>selected="selected"<?php endif; ?>>12</option>

                </select>

                <select name="monday_dm_minute" class="select" style="width: auto">

                    <option value="00" <?php if ($this->_tpl_vars['monday_dm_minute'] == '00'): ?>selected="selected"<?php endif; ?>>00</option>

                    <option value="05" <?php if ($this->_tpl_vars['monday_dm_minute'] == '05'): ?>selected="selected"<?php endif; ?>>05</option>

                    <option value="10" <?php if ($this->_tpl_vars['monday_dm_minute'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>

                    <option value="15" <?php if ($this->_tpl_vars['monday_dm_minute'] == '05'): ?>selected="selected"<?php endif; ?>>15</option>

                    <option value="20" <?php if ($this->_tpl_vars['monday_dm_minute'] == '20'): ?>selected="selected"<?php endif; ?>>20</option>

                    <option value="25" <?php if ($this->_tpl_vars['monday_dm_minute'] == '25'): ?>selected="selected"<?php endif; ?>>25</option>

                    <option value="30" <?php if ($this->_tpl_vars['monday_dm_minute'] == '30'): ?>selected="selected"<?php endif; ?>>30</option>

                    <option value="35" <?php if ($this->_tpl_vars['monday_dm_minute'] == '35'): ?>selected="selected"<?php endif; ?>>35</option>

                    <option value="40" <?php if ($this->_tpl_vars['monday_dm_minute'] == '40'): ?>selected="selected"<?php endif; ?>>40</option>

                    <option value="45" <?php if ($this->_tpl_vars['monday_dm_minute'] == '45'): ?>selected="selected"<?php endif; ?>>45</option>

                    <option value="50" <?php if ($this->_tpl_vars['monday_dm_minute'] == '50'): ?>selected="selected"<?php endif; ?>>50</option>

                    <option value="55" <?php if ($this->_tpl_vars['monday_dm_minute'] == '55'): ?>selected="selected"<?php endif; ?>>55</option>

                </select>

                <select name="monday_dm_ampm" class="select" style="width: auto">

                    <option value="am" <?php if ($this->_tpl_vars['monday_dm_ampm'] == 'am'): ?>selected="selected"<?php endif; ?>>am</option>

                    <option value="pm" <?php if ($this->_tpl_vars['monday_dm_ampm'] == 'pm'): ?>selected="selected"<?php endif; ?>>pm</option>

                </select>

			</div>

            

            <div class="formelement">

            	<label for="monday_aw_hour">Depart from meeting place</label>

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

                    <option value="15" <?php if ($this->_tpl_vars['monday_aw_minute'] == '05'): ?>selected="selected"<?php endif; ?>>15</option>

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

			</div>

            

            <div class="formelement">

            	<label for="monday_dw_hour">Depart from meeting place</label>

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

                    <option value="15" <?php if ($this->_tpl_vars['monday_dw_minute'] == '05'): ?>selected="selected"<?php endif; ?>>15</option>

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

			</div>

            

            <!-- Does this work for you -->

            <div class="purplebox">

                <img src="icons/arrow_orange_right.gif" alt="" class="icon" /> Does this work for you?

            </div>

            

            <table class="noborders">

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

                		<td><?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['name']; ?>
</td>

                	    <td>

                	    	<a href="#" class="available">Available</a> 

                	        <a href="#" class="changesrequested">Changes Requested</a> 

                	        <a href="#" class="notavailable">Not Available</a> 

                	    </td>

                	</tr>

                <?php endfor; endif; ?>

            </table>

            

            <!-- Comments -->

            <div class="purplebox">

                <img src="icons/arrow_orange_right.gif" alt="" class="icon" /> Comments

            </div>

            

            <form id="commentform">

            	<input id="comment" name="comment" type="text" class="textbox" /> 

                <input id="commentsubmit" name="submit" type="submit" value="Add Comment" />

            </form>

            

            <table>

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

                		<td><?php echo $this->_tpl_vars['comments'][$this->_sections['info']['index']]['name']; ?>
<br /><?php echo $this->_tpl_vars['comments'][$this->_sections['info']['index']]['date']; ?>
</td>

                	    <td>

                	    	<?php echo $this->_tpl_vars['comments'][$this->_sections['info']['index']]['comment']; ?>
 

                	    </td>

                	</tr>

                <?php endfor; endif; ?>

            </table>



    </div>

    

    <!-- Clear -->

    <div style="clear: both;"></div>

    

</body>

</html>