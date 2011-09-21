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

{literal}
<script type="text/javascript">

// INITIAL EVENT LISTENERS
document.observe("dom:loaded", function() 
{
	
	// Listen for day selection
	if($('monday')) { Event.observe('monday', 'change', showDay.bindAsEventListener(this, 'monday')); }
	if($('tuesday')) { Event.observe('tuesday', 'change', showDay.bindAsEventListener(this, 'tuesday')); }
	if($('wednesday')) { Event.observe('wednesday', 'change', showDay.bindAsEventListener(this, 'wednesday')); }
	if($('thursday')) { Event.observe('thursday', 'change', showDay.bindAsEventListener(this, 'thursday')); }
	if($('friday')) { Event.observe('friday', 'change', showDay.bindAsEventListener(this, 'friday')); }
	if($('saturday')) { Event.observe('saturday', 'change', showDay.bindAsEventListener(this, 'saturday')); }
	if($('sunday')) { Event.observe('sunday', 'change', showDay.bindAsEventListener(this, 'sunday')); }
	
	// Listen for cancel button
	if($('cancel'))
	{
		Event.observe('cancel', 'click', returntoschedule);
	}
	
	// Listen for comments
	Event.observe('commentform', 'submit', addCommentPost);
	addToolTipListeners();
});

// RETURN TO SCHEDULE
function returntoschedule()
{
	window.location = 'pools.php?state=viewschedule&pool=' + $('pool').value;
}

// SHOW / HIDE DAY
function showDay(e, day)
{
	if($(day).checked)
	{
		$(day + 'container').show();
	} else {
		$(day + 'container').hide();
	}
}

// ADD COMMENT POST
function addCommentPost(e)
{
	// Prevent page refresh
	Event.stop(e);
	
	// Send AJAX request
	var url = 'pools.php?state=addcomment&pool=' + $('pool').value;
	var params = Form.serialize('commentform');
	var ajax = new Ajax.Request( url, { method: 'post', postBody: params, onSuccess: addCommentResponse });
	
	// Show/hide Indicator
	$('comment_submit').hide();
	$('comment_indicator').show();
}

// ADD COMMENT RESPONSE
function addCommentResponse(resp)
{

	// Obtain JSON response
	var json = resp.responseText.evalJSON();
	
	// If successful, add table row
	if(json.status == 'success')
	{
		// Reset tag form
		Form.reset('commentform');
		
		// Show/hide Indicator
		$('comment_submit').show();
		$('comment_indicator').hide();
		
		// Add new row to table
		$('comments').insert({after: json.contents});
		
		// Highlight row
		var row1 = json.randomnumber + '_1';
		var row2 = json.randomnumber + '_2';
		new Effect.Highlight(row1);
		new Effect.Highlight(row2);
	}
}

</script>
{/literal}

</head>

<body>

	<!-- Header -->
    <div id="header">
    	<a href="{$site_url}" id="logo"><h1>Purpool</h1></a>
    </div>
    
	<!-- Top Navigation -->
   	{include file="topnavigation.tpl"}

	
    
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
                
	        <h3 style="margin-bottom:0;">{$poolname}</h3>
            <div id="wizard">
                <ul>
                    <li><a href="pools.php?state=viewprofile&pool={$pool_id}">Profile</a></li>
                    {if $editmode}<li class="current"><a href="pools.php?state=editschedule&pool={$pool_id}">Scheduler</a></li>{/if}
                    <li><a href="pools.php?state=viewschedule&pool={$pool_id}">Upcoming Rides</a></li>
                    <li><a href="pools.php?state=shoutbox&pool={$pool_id}">Shoutbox</a></li>
                    {if $editmode}<li><a href="pools.php?state=editpool&pool={$pool_id}">Edit General</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=editmembers&pool={$pool_id}">Edit Members</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=viewroutes&pool={$pool_id}">Edit Routes</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=deletepool&pool={$pool_id}">Delete Pool</a></li>{/if}
                </ul>
            </div>
			
			<div class="innercolumn4 clear">
            
            	<!-- Store pool_id -->
	            <form><input id="pool" name="pool" type="hidden" value="{$pool_id}" /></form>
				
				{if $editmode}
				
				
	            <form id="daysform" method="post" action="pools.php?state=editschedule&pool={$pool_id}">
	                
	                <img src="images/table4.gif" /><br/>
	                <table class="table4">
	                
	                	
	                <!-- Days checkboxes -->
	                <tr class="tablehead">
	                	<th></th>
	                	<th>
	                    		<input id="monday" name="monday" type="checkbox" value="y" {if $monday == 'y'}checked="checked"{/if} /> Mon <br />
	                    	</th> 
	                    	<th>
					<input id="tuesday" name="tuesday" type="checkbox" value="y" {if $tuesday == 'y'}checked="checked"{/if} /> Tues
	                	</th>
	                    	<th>
					<input id="wednesday" name="wednesday" type="checkbox" value="y" {if $wednesday == 'y'}checked="checked"{/if} /> Wed 
	                    	</th>
	                    	<th>
					<input id="thursday" name="thursday" type="checkbox" value="y" {if $thursday == 'y'}checked="checked"{/if} /> Thur
	                    	</th>
	                    	<th>
					<input id="friday" name="friday" type="checkbox" value="y" {if $friday == 'y'}checked="checked"{/if} /> Fri 
	                    	</th>
				<th>
	                    		<input id="saturday" name="saturday" type="checkbox" value="y" {if $saturday == 'y'}checked="checked"{/if} /> Sat
	                    	</th>
	                    	<th>
					<input id="sunday" name="sunday" type="checkbox" value="y" {if $sunday == 'y'}checked="checked"{/if} /> Sun
	                	</th>
	                </tr>
	                
	                
	                <!-- Arrive at Workplace -->	
	                <tr>
	                    <td>Arrive at Workplace</td>
	                    <td>
	                        <select name="monday_aw_hour" class="select" style="width: auto">
	                            <option value="1" {if $monday_aw_hour eq '1'}selected="selected"{/if}>1</option>
	                            <option value="2" {if $monday_aw_hour eq '2'}selected="selected"{/if}>2</option>
	                            <option value="3" {if $monday_aw_hour eq '3'}selected="selected"{/if}>3</option>
	                            <option value="4" {if $monday_aw_hour eq '4'}selected="selected"{/if}>4</option>
	                            <option value="5" {if $monday_aw_hour eq '5'}selected="selected"{/if}>5</option>
	                            <option value="6" {if $monday_aw_hour eq '6'}selected="selected"{/if}>6</option>
	                            <option value="7" {if $monday_aw_hour eq '7'}selected="selected"{/if}>7</option>
	                            <option value="8" {if $monday_aw_hour eq '8'}selected="selected"{/if}>8</option>
	                            <option value="9" {if $monday_aw_hour eq '9'}selected="selected"{/if}>9</option>
	                            <option value="10" {if $monday_aw_hour eq '10'}selected="selected"{/if}>10</option>
	                            <option value="11" {if $monday_aw_hour eq '11'}selected="selected"{/if}>11</option>
	                            <option value="12" {if $monday_aw_hour eq '12'}selected="selected"{/if}>12</option>
	                        </select>
	                        <select name="monday_aw_minute" class="select" style="width: auto">
	                            <option value="00" {if $monday_aw_minute eq '00'}selected="selected"{/if}>00</option>
	                            <option value="05" {if $monday_aw_minute eq '05'}selected="selected"{/if}>05</option>
	                            <option value="10" {if $monday_aw_minute eq '10'}selected="selected"{/if}>10</option>
	                            <option value="15" {if $monday_aw_minute eq '15'}selected="selected"{/if}>15</option>
	                            <option value="20" {if $monday_aw_minute eq '20'}selected="selected"{/if}>20</option>
	                            <option value="25" {if $monday_aw_minute eq '25'}selected="selected"{/if}>25</option>
	                            <option value="30" {if $monday_aw_minute eq '30'}selected="selected"{/if}>30</option>
	                            <option value="35" {if $monday_aw_minute eq '35'}selected="selected"{/if}>35</option>
	                            <option value="40" {if $monday_aw_minute eq '40'}selected="selected"{/if}>40</option>
	                            <option value="45" {if $monday_aw_minute eq '45'}selected="selected"{/if}>45</option>
	                            <option value="50" {if $monday_aw_minute eq '50'}selected="selected"{/if}>50</option>
	                            <option value="55" {if $monday_aw_minute eq '55'}selected="selected"{/if}>55</option>
	                        </select>
	                        <select name="monday_aw_ampm" class="select" style="width: auto">
	                            <option value="am" {if $monday_aw_ampm eq 'am'}selected="selected"{/if}>am</option>
	                            <option value="pm" {if $monday_aw_ampm eq 'pm'}selected="selected"{/if}>pm</option>
	                        </select>
	                    </td>
			<td>
	                        <select name="tuesday_aw_hour" class="select" style="width: auto">
	                            <option value="1" {if $tuesday_aw_hour eq '1'}selected="selected"{/if}>1</option>
	                            <option value="2" {if $tuesday_aw_hour eq '2'}selected="selected"{/if}>2</option>
	                            <option value="3" {if $tuesday_aw_hour eq '3'}selected="selected"{/if}>3</option>
	                            <option value="4" {if $tuesday_aw_hour eq '4'}selected="selected"{/if}>4</option>
	                            <option value="5" {if $tuesday_aw_hour eq '5'}selected="selected"{/if}>5</option>
	                            <option value="6" {if $tuesday_aw_hour eq '6'}selected="selected"{/if}>6</option>
	                            <option value="7" {if $tuesday_aw_hour eq '7'}selected="selected"{/if}>7</option>
	                            <option value="8" {if $tuesday_aw_hour eq '8'}selected="selected"{/if}>8</option>
	                            <option value="9" {if $tuesday_aw_hour eq '9'}selected="selected"{/if}>9</option>
	                            <option value="10" {if $tuesday_aw_hour eq '10'}selected="selected"{/if}>10</option>
	                            <option value="11" {if $tuesday_aw_hour eq '11'}selected="selected"{/if}>11</option>
	                            <option value="12" {if $tuesday_aw_hour eq '12'}selected="selected"{/if}>12</option>
	                        </select>
	                        <select name="tuesday_aw_minute" class="select" style="width: auto">
	                            <option value="00" {if $tuesday_aw_minute eq '00'}selected="selected"{/if}>00</option>
	                            <option value="05" {if $tuesday_aw_minute eq '05'}selected="selected"{/if}>05</option>
	                            <option value="10" {if $tuesday_aw_minute eq '10'}selected="selected"{/if}>10</option>
	                            <option value="15" {if $tuesday_aw_minute eq '15'}selected="selected"{/if}>15</option>
	                            <option value="20" {if $tuesday_aw_minute eq '20'}selected="selected"{/if}>20</option>
	                            <option value="25" {if $tuesday_aw_minute eq '25'}selected="selected"{/if}>25</option>
	                            <option value="30" {if $tuesday_aw_minute eq '30'}selected="selected"{/if}>30</option>
	                            <option value="35" {if $tuesday_aw_minute eq '35'}selected="selected"{/if}>35</option>
	                            <option value="40" {if $tuesday_aw_minute eq '40'}selected="selected"{/if}>40</option>
	                            <option value="45" {if $tuesday_aw_minute eq '45'}selected="selected"{/if}>45</option>
	                            <option value="50" {if $tuesday_aw_minute eq '50'}selected="selected"{/if}>50</option>
	                            <option value="55" {if $tuesday_aw_minute eq '55'}selected="selected"{/if}>55</option>
	                        </select>
	                        <select name="tuesday_aw_ampm" class="select" style="width: auto">
	                            <option value="am" {if $tuesday_aw_ampm eq 'am'}selected="selected"{/if}>am</option>
	                            <option value="pm" {if $tuesday_aw_ampm eq 'pm'}selected="selected"{/if}>pm</option>
	                        </select>
	                    </td>
	                    <td>
				<select name="wednesday_aw_hour" class="select" style="width: auto">
				    <option value="1" {if $wednesday_aw_hour eq '1'}selected="selected"{/if}>1</option>
				    <option value="2" {if $wednesday_aw_hour eq '2'}selected="selected"{/if}>2</option>
				    <option value="3" {if $wednesday_aw_hour eq '3'}selected="selected"{/if}>3</option>
				    <option value="4" {if $wednesday_aw_hour eq '4'}selected="selected"{/if}>4</option>
				    <option value="5" {if $wednesday_aw_hour eq '5'}selected="selected"{/if}>5</option>
				    <option value="6" {if $wednesday_aw_hour eq '6'}selected="selected"{/if}>6</option>
				    <option value="7" {if $wednesday_aw_hour eq '7'}selected="selected"{/if}>7</option>
				    <option value="8" {if $wednesday_aw_hour eq '8'}selected="selected"{/if}>8</option>
				    <option value="9" {if $wednesday_aw_hour eq '9'}selected="selected"{/if}>9</option>
				    <option value="10" {if $wednesday_aw_hour eq '10'}selected="selected"{/if}>10</option>
				    <option value="11" {if $wednesday_aw_hour eq '11'}selected="selected"{/if}>11</option>
				    <option value="12" {if $wednesday_aw_hour eq '12'}selected="selected"{/if}>12</option>
				</select>
				<select name="wednesday_aw_minute" class="select" style="width: auto">
				    <option value="00" {if $wednesday_aw_minute eq '00'}selected="selected"{/if}>00</option>
				    <option value="05" {if $wednesday_aw_minute eq '05'}selected="selected"{/if}>05</option>
				    <option value="10" {if $wednesday_aw_minute eq '10'}selected="selected"{/if}>10</option>
				    <option value="15" {if $wednesday_aw_minute eq '15'}selected="selected"{/if}>15</option>
				    <option value="20" {if $wednesday_aw_minute eq '20'}selected="selected"{/if}>20</option>
				    <option value="25" {if $wednesday_aw_minute eq '25'}selected="selected"{/if}>25</option>
				    <option value="30" {if $wednesday_aw_minute eq '30'}selected="selected"{/if}>30</option>
				    <option value="35" {if $wednesday_aw_minute eq '35'}selected="selected"{/if}>35</option>
				    <option value="40" {if $wednesday_aw_minute eq '40'}selected="selected"{/if}>40</option>
				    <option value="45" {if $wednesday_aw_minute eq '45'}selected="selected"{/if}>45</option>
				    <option value="50" {if $wednesday_aw_minute eq '50'}selected="selected"{/if}>50</option>
				    <option value="55" {if $wednesday_aw_minute eq '55'}selected="selected"{/if}>55</option>
				</select>
				<select name="wednesday_aw_ampm" class="select" style="width: auto">
				    <option value="am" {if $wednesday_aw_ampm eq 'am'}selected="selected"{/if}>am</option>
				    <option value="pm" {if $wednesday_aw_ampm eq 'pm'}selected="selected"{/if}>pm</option>
				</select>
	                    </td>
	                    <td>
	                        <select name="thursday_aw_hour" class="select" style="width: auto">
	                            <option value="1" {if $thursday_aw_hour eq '1'}selected="selected"{/if}>1</option>
	                            <option value="2" {if $thursday_aw_hour eq '2'}selected="selected"{/if}>2</option>
	                            <option value="3" {if $thursday_aw_hour eq '3'}selected="selected"{/if}>3</option>
	                            <option value="4" {if $thursday_aw_hour eq '4'}selected="selected"{/if}>4</option>
	                            <option value="5" {if $thursday_aw_hour eq '5'}selected="selected"{/if}>5</option>
	                            <option value="6" {if $thursday_aw_hour eq '6'}selected="selected"{/if}>6</option>
	                            <option value="7" {if $thursday_aw_hour eq '7'}selected="selected"{/if}>7</option>
	                            <option value="8" {if $thursday_aw_hour eq '8'}selected="selected"{/if}>8</option>
	                            <option value="9" {if $thursday_aw_hour eq '9'}selected="selected"{/if}>9</option>
	                            <option value="10" {if $thursday_aw_hour eq '10'}selected="selected"{/if}>10</option>
	                            <option value="11" {if $thursday_aw_hour eq '11'}selected="selected"{/if}>11</option>
	                            <option value="12" {if $thursday_aw_hour eq '12'}selected="selected"{/if}>12</option>
	                        </select>
	                        <select name="thursday_aw_minute" class="select" style="width: auto">
	                            <option value="00" {if $thursday_aw_minute eq '00'}selected="selected"{/if}>00</option>
	                            <option value="05" {if $thursday_aw_minute eq '05'}selected="selected"{/if}>05</option>
	                            <option value="10" {if $thursday_aw_minute eq '10'}selected="selected"{/if}>10</option>
	                            <option value="15" {if $thursday_aw_minute eq '15'}selected="selected"{/if}>15</option>
	                            <option value="20" {if $thursday_aw_minute eq '20'}selected="selected"{/if}>20</option>
	                            <option value="25" {if $thursday_aw_minute eq '25'}selected="selected"{/if}>25</option>
	                            <option value="30" {if $thursday_aw_minute eq '30'}selected="selected"{/if}>30</option>
	                            <option value="35" {if $thursday_aw_minute eq '35'}selected="selected"{/if}>35</option>
	                            <option value="40" {if $thursday_aw_minute eq '40'}selected="selected"{/if}>40</option>
	                            <option value="45" {if $thursday_aw_minute eq '45'}selected="selected"{/if}>45</option>
	                            <option value="50" {if $thursday_aw_minute eq '50'}selected="selected"{/if}>50</option>
	                            <option value="55" {if $thursday_aw_minute eq '55'}selected="selected"{/if}>55</option>
	                        </select>
	                        <select name="thursday_aw_ampm" class="select" style="width: auto">
	                            <option value="am" {if $thursday_aw_ampm eq 'am'}selected="selected"{/if}>am</option>
	                            <option value="pm" {if $thursday_aw_ampm eq 'pm'}selected="selected"{/if}>pm</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select name="friday_aw_hour" class="select" style="width: auto">
	                            <option value="1" {if $friday_aw_hour eq '1'}selected="selected"{/if}>1</option>
	                            <option value="2" {if $friday_aw_hour eq '2'}selected="selected"{/if}>2</option>
	                            <option value="3" {if $friday_aw_hour eq '3'}selected="selected"{/if}>3</option>
	                            <option value="4" {if $friday_aw_hour eq '4'}selected="selected"{/if}>4</option>
	                            <option value="5" {if $friday_aw_hour eq '5'}selected="selected"{/if}>5</option>
	                            <option value="6" {if $friday_aw_hour eq '6'}selected="selected"{/if}>6</option>
	                            <option value="7" {if $friday_aw_hour eq '7'}selected="selected"{/if}>7</option>
	                            <option value="8" {if $friday_aw_hour eq '8'}selected="selected"{/if}>8</option>
	                            <option value="9" {if $friday_aw_hour eq '9'}selected="selected"{/if}>9</option>
	                            <option value="10" {if $friday_aw_hour eq '10'}selected="selected"{/if}>10</option>
	                            <option value="11" {if $friday_aw_hour eq '11'}selected="selected"{/if}>11</option>
	                            <option value="12" {if $friday_aw_hour eq '12'}selected="selected"{/if}>12</option>
	                        </select>
	                        <select name="friday_aw_minute" class="select" style="width: auto">
	                            <option value="00" {if $friday_aw_minute eq '00'}selected="selected"{/if}>00</option>
	                            <option value="05" {if $friday_aw_minute eq '05'}selected="selected"{/if}>05</option>
	                            <option value="10" {if $friday_aw_minute eq '10'}selected="selected"{/if}>10</option>
	                            <option value="15" {if $friday_aw_minute eq '15'}selected="selected"{/if}>15</option>
	                            <option value="20" {if $friday_aw_minute eq '20'}selected="selected"{/if}>20</option>
	                            <option value="25" {if $friday_aw_minute eq '25'}selected="selected"{/if}>25</option>
	                            <option value="30" {if $friday_aw_minute eq '30'}selected="selected"{/if}>30</option>
	                            <option value="35" {if $friday_aw_minute eq '35'}selected="selected"{/if}>35</option>
	                            <option value="40" {if $friday_aw_minute eq '40'}selected="selected"{/if}>40</option>
	                            <option value="45" {if $friday_aw_minute eq '45'}selected="selected"{/if}>45</option>
	                            <option value="50" {if $friday_aw_minute eq '50'}selected="selected"{/if}>50</option>
	                            <option value="55" {if $friday_aw_minute eq '55'}selected="selected"{/if}>55</option>
	                        </select>
	                        <select name="friday_aw_ampm" class="select" style="width: auto">
	                            <option value="am" {if $friday_aw_ampm eq 'am'}selected="selected"{/if}>am</option>
	                            <option value="pm" {if $friday_aw_ampm eq 'pm'}selected="selected"{/if}>pm</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select name="saturday_aw_hour" class="select" style="width: auto">
	                            <option value="1" {if $saturday_aw_hour eq '1'}selected="selected"{/if}>1</option>
	                            <option value="2" {if $saturday_aw_hour eq '2'}selected="selected"{/if}>2</option>
	                            <option value="3" {if $saturday_aw_hour eq '3'}selected="selected"{/if}>3</option>
	                            <option value="4" {if $saturday_aw_hour eq '4'}selected="selected"{/if}>4</option>
	                            <option value="5" {if $saturday_aw_hour eq '5'}selected="selected"{/if}>5</option>
	                            <option value="6" {if $saturday_aw_hour eq '6'}selected="selected"{/if}>6</option>
	                            <option value="7" {if $saturday_aw_hour eq '7'}selected="selected"{/if}>7</option>
	                            <option value="8" {if $saturday_aw_hour eq '8'}selected="selected"{/if}>8</option>
	                            <option value="9" {if $saturday_aw_hour eq '9'}selected="selected"{/if}>9</option>
	                            <option value="10" {if $saturday_aw_hour eq '10'}selected="selected"{/if}>10</option>
	                            <option value="11" {if $saturday_aw_hour eq '11'}selected="selected"{/if}>11</option>
	                            <option value="12" {if $saturday_aw_hour eq '12'}selected="selected"{/if}>12</option>
	                        </select>
	                        <select name="saturday_aw_minute" class="select" style="width: auto">
	                            <option value="00" {if $saturday_aw_minute eq '00'}selected="selected"{/if}>00</option>
	                            <option value="05" {if $saturday_aw_minute eq '05'}selected="selected"{/if}>05</option>
	                            <option value="10" {if $saturday_aw_minute eq '10'}selected="selected"{/if}>10</option>
	                            <option value="15" {if $saturday_aw_minute eq '15'}selected="selected"{/if}>15</option>
	                            <option value="20" {if $saturday_aw_minute eq '20'}selected="selected"{/if}>20</option>
	                            <option value="25" {if $saturday_aw_minute eq '25'}selected="selected"{/if}>25</option>
	                            <option value="30" {if $saturday_aw_minute eq '30'}selected="selected"{/if}>30</option>
	                            <option value="35" {if $saturday_aw_minute eq '35'}selected="selected"{/if}>35</option>
	                            <option value="40" {if $saturday_aw_minute eq '40'}selected="selected"{/if}>40</option>
	                            <option value="45" {if $saturday_aw_minute eq '45'}selected="selected"{/if}>45</option>
	                            <option value="50" {if $saturday_aw_minute eq '50'}selected="selected"{/if}>50</option>
	                            <option value="55" {if $saturday_aw_minute eq '55'}selected="selected"{/if}>55</option>
	                        </select>
	                        <select name="saturday_aw_ampm" class="select" style="width: auto">
	                            <option value="am" {if $saturday_aw_ampm eq 'am'}selected="selected"{/if}>am</option>
	                            <option value="pm" {if $saturday_aw_ampm eq 'pm'}selected="selected"{/if}>pm</option>
	                        </select>
	                    </td>
	                <td>
	                        <select name="sunday_aw_hour" class="select" style="width: auto">
	                            <option value="1" {if $sunday_aw_hour eq '1'}selected="selected"{/if}>1</option>
	                            <option value="2" {if $sunday_aw_hour eq '2'}selected="selected"{/if}>2</option>
	                            <option value="3" {if $sunday_aw_hour eq '3'}selected="selected"{/if}>3</option>
	                            <option value="4" {if $sunday_aw_hour eq '4'}selected="selected"{/if}>4</option>
	                            <option value="5" {if $sunday_aw_hour eq '5'}selected="selected"{/if}>5</option>
	                            <option value="6" {if $sunday_aw_hour eq '6'}selected="selected"{/if}>6</option>
	                            <option value="7" {if $sunday_aw_hour eq '7'}selected="selected"{/if}>7</option>
	                            <option value="8" {if $sunday_aw_hour eq '8'}selected="selected"{/if}>8</option>
	                            <option value="9" {if $sunday_aw_hour eq '9'}selected="selected"{/if}>9</option>
	                            <option value="10" {if $sunday_aw_hour eq '10'}selected="selected"{/if}>10</option>
	                            <option value="11" {if $sunday_aw_hour eq '11'}selected="selected"{/if}>11</option>
	                            <option value="12" {if $sunday_aw_hour eq '12'}selected="selected"{/if}>12</option>
	                        </select>
	                        <select name="sunday_aw_minute" class="select" style="width: auto">
	                            <option value="00" {if $sunday_aw_minute eq '00'}selected="selected"{/if}>00</option>
	                            <option value="05" {if $sunday_aw_minute eq '05'}selected="selected"{/if}>05</option>
	                            <option value="10" {if $sunday_aw_minute eq '10'}selected="selected"{/if}>10</option>
	                            <option value="15" {if $sunday_aw_minute eq '15'}selected="selected"{/if}>15</option>
	                            <option value="20" {if $sunday_aw_minute eq '20'}selected="selected"{/if}>20</option>
	                            <option value="25" {if $sunday_aw_minute eq '25'}selected="selected"{/if}>25</option>
	                            <option value="30" {if $sunday_aw_minute eq '30'}selected="selected"{/if}>30</option>
	                            <option value="35" {if $sunday_aw_minute eq '35'}selected="selected"{/if}>35</option>
	                            <option value="40" {if $sunday_aw_minute eq '40'}selected="selected"{/if}>40</option>
	                            <option value="45" {if $sunday_aw_minute eq '45'}selected="selected"{/if}>45</option>
	                            <option value="50" {if $sunday_aw_minute eq '50'}selected="selected"{/if}>50</option>
	                            <option value="55" {if $sunday_aw_minute eq '55'}selected="selected"{/if}>55</option>
	                        </select>
	                        <select name="sunday_aw_ampm" class="select" style="width: auto">
	                            <option value="am" {if $sunday_aw_ampm eq 'am'}selected="selected"{/if}>am</option>
	                            <option value="pm" {if $sunday_aw_ampm eq 'pm'}selected="selected"{/if}>pm</option>
	                        </select>
	                    </td>
	                    
	                    
	                    
	                    
	                    
	                    
	                    
	                    
	                    
	                    
	                    
	                    
	                    
	                    
	                    
	                    
	                    
	                    
	                    
	                    
	                    
	                    
			</tr>
			<!-- Depart from Workplace -->	
			<tr>
	                    <td>Depart from Workplace</td>
	                    <td>
	                        <select name="monday_dw_hour" class="select" style="width: auto">
	                            <option value="1" {if $monday_dw_hour eq '1'}selected="selected"{/if}>1</option>
	                            <option value="2" {if $monday_dw_hour eq '2'}selected="selected"{/if}>2</option>
	                            <option value="3" {if $monday_dw_hour eq '3'}selected="selected"{/if}>3</option>
	                            <option value="4" {if $monday_dw_hour eq '4'}selected="selected"{/if}>4</option>
	                            <option value="5" {if $monday_dw_hour eq '5'}selected="selected"{/if}>5</option>
	                            <option value="6" {if $monday_dw_hour eq '6'}selected="selected"{/if}>6</option>
	                            <option value="7" {if $monday_dw_hour eq '7'}selected="selected"{/if}>7</option>
	                            <option value="8" {if $monday_dw_hour eq '8'}selected="selected"{/if}>8</option>
	                            <option value="9" {if $monday_dw_hour eq '9'}selected="selected"{/if}>9</option>
	                            <option value="10" {if $monday_dw_hour eq '10'}selected="selected"{/if}>10</option>
	                            <option value="11" {if $monday_dw_hour eq '11'}selected="selected"{/if}>11</option>
	                            <option value="12" {if $monday_dw_hour eq '12'}selected="selected"{/if}>12</option>
	                        </select>
	                        <select name="monday_dw_minute" class="select" style="width: auto">
	                            <option value="00" {if $monday_dw_minute eq '00'}selected="selected"{/if}>00</option>
	                            <option value="05" {if $monday_dw_minute eq '05'}selected="selected"{/if}>05</option>
	                            <option value="10" {if $monday_dw_minute eq '10'}selected="selected"{/if}>10</option>
	                            <option value="15" {if $monday_dw_minute eq '15'}selected="selected"{/if}>15</option>
	                            <option value="20" {if $monday_dw_minute eq '20'}selected="selected"{/if}>20</option>
	                            <option value="25" {if $monday_dw_minute eq '25'}selected="selected"{/if}>25</option>
	                            <option value="30" {if $monday_dw_minute eq '30'}selected="selected"{/if}>30</option>
	                            <option value="35" {if $monday_dw_minute eq '35'}selected="selected"{/if}>35</option>
	                            <option value="40" {if $monday_dw_minute eq '40'}selected="selected"{/if}>40</option>
	                            <option value="45" {if $monday_dw_minute eq '45'}selected="selected"{/if}>45</option>
	                            <option value="50" {if $monday_dw_minute eq '50'}selected="selected"{/if}>50</option>
	                            <option value="55" {if $monday_dw_minute eq '55'}selected="selected"{/if}>55</option>
	                        </select>
	                        <select name="monday_dw_ampm" class="select" style="width: auto">
	                            <option value="am" {if $monday_dw_ampm eq 'am'}selected="selected"{/if}>am</option>
	                            <option value="pm" {if $monday_dw_ampm eq 'pm'}selected="selected"{/if}>pm</option>
	                        </select>
	                    </td>
	                    <td >
	                        <select name="tuesday_dw_hour" class="select" style="width: auto">
	                            <option value="1" {if $tuesday_dw_hour eq '1'}selected="selected"{/if}>1</option>
	                            <option value="2" {if $tuesday_dw_hour eq '2'}selected="selected"{/if}>2</option>
	                            <option value="3" {if $tuesday_dw_hour eq '3'}selected="selected"{/if}>3</option>
	                            <option value="4" {if $tuesday_dw_hour eq '4'}selected="selected"{/if}>4</option>
	                            <option value="5" {if $tuesday_dw_hour eq '5'}selected="selected"{/if}>5</option>
	                            <option value="6" {if $tuesday_dw_hour eq '6'}selected="selected"{/if}>6</option>
	                            <option value="7" {if $tuesday_dw_hour eq '7'}selected="selected"{/if}>7</option>
	                            <option value="8" {if $tuesday_dw_hour eq '8'}selected="selected"{/if}>8</option>
	                            <option value="9" {if $tuesday_dw_hour eq '9'}selected="selected"{/if}>9</option>
	                            <option value="10" {if $tuesday_dw_hour eq '10'}selected="selected"{/if}>10</option>
	                            <option value="11" {if $tuesday_dw_hour eq '11'}selected="selected"{/if}>11</option>
	                            <option value="12" {if $tuesday_dw_hour eq '12'}selected="selected"{/if}>12</option>
	                        </select>
	                        <select name="tuesday_dw_minute" class="select" style="width: auto">
	                            <option value="00" {if $tuesday_dw_minute eq '00'}selected="selected"{/if}>00</option>
	                            <option value="05" {if $tuesday_dw_minute eq '05'}selected="selected"{/if}>05</option>
	                            <option value="10" {if $tuesday_dw_minute eq '10'}selected="selected"{/if}>10</option>
	                            <option value="15" {if $tuesday_dw_minute eq '15'}selected="selected"{/if}>15</option>
	                            <option value="20" {if $tuesday_dw_minute eq '20'}selected="selected"{/if}>20</option>
	                            <option value="25" {if $tuesday_dw_minute eq '25'}selected="selected"{/if}>25</option>
	                            <option value="30" {if $tuesday_dw_minute eq '30'}selected="selected"{/if}>30</option>
	                            <option value="35" {if $tuesday_dw_minute eq '35'}selected="selected"{/if}>35</option>
	                            <option value="40" {if $tuesday_dw_minute eq '40'}selected="selected"{/if}>40</option>
	                            <option value="45" {if $tuesday_dw_minute eq '45'}selected="selected"{/if}>45</option>
	                            <option value="50" {if $tuesday_dw_minute eq '50'}selected="selected"{/if}>50</option>
	                            <option value="55" {if $tuesday_dw_minute eq '55'}selected="selected"{/if}>55</option>
	                        </select>
	                        <select name="tuesday_dw_ampm" class="select" style="width: auto">
	                            <option value="am" {if $tuesday_dw_ampm eq 'am'}selected="selected"{/if}>am</option>
	                            <option value="pm" {if $tuesday_dw_ampm eq 'pm'}selected="selected"{/if}>pm</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select name="wednesday_dw_hour" class="select" style="width: auto">
	                            <option value="1" {if $wednesday_dw_hour eq '1'}selected="selected"{/if}>1</option>
	                            <option value="2" {if $wednesday_dw_hour eq '2'}selected="selected"{/if}>2</option>
	                            <option value="3" {if $wednesday_dw_hour eq '3'}selected="selected"{/if}>3</option>
	                            <option value="4" {if $wednesday_dw_hour eq '4'}selected="selected"{/if}>4</option>
	                            <option value="5" {if $wednesday_dw_hour eq '5'}selected="selected"{/if}>5</option>
	                            <option value="6" {if $wednesday_dw_hour eq '6'}selected="selected"{/if}>6</option>
	                            <option value="7" {if $wednesday_dw_hour eq '7'}selected="selected"{/if}>7</option>
	                            <option value="8" {if $wednesday_dw_hour eq '8'}selected="selected"{/if}>8</option>
	                            <option value="9" {if $wednesday_dw_hour eq '9'}selected="selected"{/if}>9</option>
	                            <option value="10" {if $wednesday_dw_hour eq '10'}selected="selected"{/if}>10</option>
	                            <option value="11" {if $wednesday_dw_hour eq '11'}selected="selected"{/if}>11</option>
	                            <option value="12" {if $wednesday_dw_hour eq '12'}selected="selected"{/if}>12</option>
	                        </select>
	                        <select name="wednesday_dw_minute" class="select" style="width: auto">
	                            <option value="00" {if $wednesday_dw_minute eq '00'}selected="selected"{/if}>00</option>
	                            <option value="05" {if $wednesday_dw_minute eq '05'}selected="selected"{/if}>05</option>
	                            <option value="10" {if $wednesday_dw_minute eq '10'}selected="selected"{/if}>10</option>
	                            <option value="15" {if $wednesday_dw_minute eq '15'}selected="selected"{/if}>15</option>
	                            <option value="20" {if $wednesday_dw_minute eq '20'}selected="selected"{/if}>20</option>
	                            <option value="25" {if $wednesday_dw_minute eq '25'}selected="selected"{/if}>25</option>
	                            <option value="30" {if $wednesday_dw_minute eq '30'}selected="selected"{/if}>30</option>
	                            <option value="35" {if $wednesday_dw_minute eq '35'}selected="selected"{/if}>35</option>
	                            <option value="40" {if $wednesday_dw_minute eq '40'}selected="selected"{/if}>40</option>
	                            <option value="45" {if $wednesday_dw_minute eq '45'}selected="selected"{/if}>45</option>
	                            <option value="50" {if $wednesday_dw_minute eq '50'}selected="selected"{/if}>50</option>
	                            <option value="55" {if $wednesday_dw_minute eq '55'}selected="selected"{/if}>55</option>
	                        </select>
	                        <select name="wednesday_dw_ampm" class="select" style="width: auto">
	                            <option value="am" {if $wednesday_dw_ampm eq 'am'}selected="selected"{/if}>am</option>
	                            <option value="pm" {if $wednesday_dw_ampm eq 'pm'}selected="selected"{/if}>pm</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select name="thursday_dw_hour" class="select" style="width: auto">
	                            <option value="1" {if $thursday_dw_hour eq '1'}selected="selected"{/if}>1</option>
	                            <option value="2" {if $thursday_dw_hour eq '2'}selected="selected"{/if}>2</option>
	                            <option value="3" {if $thursday_dw_hour eq '3'}selected="selected"{/if}>3</option>
	                            <option value="4" {if $thursday_dw_hour eq '4'}selected="selected"{/if}>4</option>
	                            <option value="5" {if $thursday_dw_hour eq '5'}selected="selected"{/if}>5</option>
	                            <option value="6" {if $thursday_dw_hour eq '6'}selected="selected"{/if}>6</option>
	                            <option value="7" {if $thursday_dw_hour eq '7'}selected="selected"{/if}>7</option>
	                            <option value="8" {if $thursday_dw_hour eq '8'}selected="selected"{/if}>8</option>
	                            <option value="9" {if $thursday_dw_hour eq '9'}selected="selected"{/if}>9</option>
	                            <option value="10" {if $thursday_dw_hour eq '10'}selected="selected"{/if}>10</option>
	                            <option value="11" {if $thursday_dw_hour eq '11'}selected="selected"{/if}>11</option>
	                            <option value="12" {if $thursday_dw_hour eq '12'}selected="selected"{/if}>12</option>
	                        </select>
	                        <select name="thursday_dw_minute" class="select" style="width: auto">
	                            <option value="00" {if $thursday_dw_minute eq '00'}selected="selected"{/if}>00</option>
	                            <option value="05" {if $thursday_dw_minute eq '05'}selected="selected"{/if}>05</option>
	                            <option value="10" {if $thursday_dw_minute eq '10'}selected="selected"{/if}>10</option>
	                            <option value="15" {if $thursday_dw_minute eq '15'}selected="selected"{/if}>15</option>
	                            <option value="20" {if $thursday_dw_minute eq '20'}selected="selected"{/if}>20</option>
	                            <option value="25" {if $thursday_dw_minute eq '25'}selected="selected"{/if}>25</option>
	                            <option value="30" {if $thursday_dw_minute eq '30'}selected="selected"{/if}>30</option>
	                            <option value="35" {if $thursday_dw_minute eq '35'}selected="selected"{/if}>35</option>
	                            <option value="40" {if $thursday_dw_minute eq '40'}selected="selected"{/if}>40</option>
	                            <option value="45" {if $thursday_dw_minute eq '45'}selected="selected"{/if}>45</option>
	                            <option value="50" {if $thursday_dw_minute eq '50'}selected="selected"{/if}>50</option>
	                            <option value="55" {if $thursday_dw_minute eq '55'}selected="selected"{/if}>55</option>
	                        </select>
	                        <select name="thursday_dw_ampm" class="select" style="width: auto">
	                            <option value="am" {if $thursday_dw_ampm eq 'am'}selected="selected"{/if}>am</option>
	                            <option value="pm" {if $thursday_dw_ampm eq 'pm'}selected="selected"{/if}>pm</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select name="friday_dw_hour" class="select" style="width: auto">
	                            <option value="1" {if $friday_dw_hour eq '1'}selected="selected"{/if}>1</option>
	                            <option value="2" {if $friday_dw_hour eq '2'}selected="selected"{/if}>2</option>
	                            <option value="3" {if $friday_dw_hour eq '3'}selected="selected"{/if}>3</option>
	                            <option value="4" {if $friday_dw_hour eq '4'}selected="selected"{/if}>4</option>
	                            <option value="5" {if $friday_dw_hour eq '5'}selected="selected"{/if}>5</option>
	                            <option value="6" {if $friday_dw_hour eq '6'}selected="selected"{/if}>6</option>
	                            <option value="7" {if $friday_dw_hour eq '7'}selected="selected"{/if}>7</option>
	                            <option value="8" {if $friday_dw_hour eq '8'}selected="selected"{/if}>8</option>
	                            <option value="9" {if $friday_dw_hour eq '9'}selected="selected"{/if}>9</option>
	                            <option value="10" {if $friday_dw_hour eq '10'}selected="selected"{/if}>10</option>
	                            <option value="11" {if $friday_dw_hour eq '11'}selected="selected"{/if}>11</option>
	                            <option value="12" {if $friday_dw_hour eq '12'}selected="selected"{/if}>12</option>
	                        </select>
	                        <select name="friday_dw_minute" class="select" style="width: auto">
	                            <option value="00" {if $friday_dw_minute eq '00'}selected="selected"{/if}>00</option>
	                            <option value="05" {if $friday_dw_minute eq '05'}selected="selected"{/if}>05</option>
	                            <option value="10" {if $friday_dw_minute eq '10'}selected="selected"{/if}>10</option>
	                            <option value="15" {if $friday_dw_minute eq '15'}selected="selected"{/if}>15</option>
	                            <option value="20" {if $friday_dw_minute eq '20'}selected="selected"{/if}>20</option>
	                            <option value="25" {if $friday_dw_minute eq '25'}selected="selected"{/if}>25</option>
	                            <option value="30" {if $friday_dw_minute eq '30'}selected="selected"{/if}>30</option>
	                            <option value="35" {if $friday_dw_minute eq '35'}selected="selected"{/if}>35</option>
	                            <option value="40" {if $friday_dw_minute eq '40'}selected="selected"{/if}>40</option>
	                            <option value="45" {if $friday_dw_minute eq '45'}selected="selected"{/if}>45</option>
	                            <option value="50" {if $friday_dw_minute eq '50'}selected="selected"{/if}>50</option>
	                            <option value="55" {if $friday_dw_minute eq '55'}selected="selected"{/if}>55</option>
	                        </select>
	                        <select name="friday_dw_ampm" class="select" style="width: auto">
	                            <option value="am" {if $friday_dw_ampm eq 'am'}selected="selected"{/if}>am</option>
	                            <option value="pm" {if $friday_dw_ampm eq 'pm'}selected="selected"{/if}>pm</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select name="saturday_dw_hour" class="select" style="width: auto">
	                            <option value="1" {if $saturday_dw_hour eq '1'}selected="selected"{/if}>1</option>
	                            <option value="2" {if $saturday_dw_hour eq '2'}selected="selected"{/if}>2</option>
	                            <option value="3" {if $saturday_dw_hour eq '3'}selected="selected"{/if}>3</option>
	                            <option value="4" {if $saturday_dw_hour eq '4'}selected="selected"{/if}>4</option>
	                            <option value="5" {if $saturday_dw_hour eq '5'}selected="selected"{/if}>5</option>
	                            <option value="6" {if $saturday_dw_hour eq '6'}selected="selected"{/if}>6</option>
	                            <option value="7" {if $saturday_dw_hour eq '7'}selected="selected"{/if}>7</option>
	                            <option value="8" {if $saturday_dw_hour eq '8'}selected="selected"{/if}>8</option>
	                            <option value="9" {if $saturday_dw_hour eq '9'}selected="selected"{/if}>9</option>
	                            <option value="10" {if $saturday_dw_hour eq '10'}selected="selected"{/if}>10</option>
	                            <option value="11" {if $saturday_dw_hour eq '11'}selected="selected"{/if}>11</option>
	                            <option value="12" {if $saturday_dw_hour eq '12'}selected="selected"{/if}>12</option>
	                        </select>
	                        <select name="saturday_dw_minute" class="select" style="width: auto">
	                            <option value="00" {if $saturday_dw_minute eq '00'}selected="selected"{/if}>00</option>
	                            <option value="05" {if $saturday_dw_minute eq '05'}selected="selected"{/if}>05</option>
	                            <option value="10" {if $saturday_dw_minute eq '10'}selected="selected"{/if}>10</option>
	                            <option value="15" {if $saturday_dw_minute eq '15'}selected="selected"{/if}>15</option>
	                            <option value="20" {if $saturday_dw_minute eq '20'}selected="selected"{/if}>20</option>
	                            <option value="25" {if $saturday_dw_minute eq '25'}selected="selected"{/if}>25</option>
	                            <option value="30" {if $saturday_dw_minute eq '30'}selected="selected"{/if}>30</option>
	                            <option value="35" {if $saturday_dw_minute eq '35'}selected="selected"{/if}>35</option>
	                            <option value="40" {if $saturday_dw_minute eq '40'}selected="selected"{/if}>40</option>
	                            <option value="45" {if $saturday_dw_minute eq '45'}selected="selected"{/if}>45</option>
	                            <option value="50" {if $saturday_dw_minute eq '50'}selected="selected"{/if}>50</option>
	                            <option value="55" {if $saturday_dw_minute eq '55'}selected="selected"{/if}>55</option>
	                        </select>
	                        <select name="saturday_dw_ampm" class="select" style="width: auto">
	                            <option value="am" {if $saturday_dw_ampm eq 'am'}selected="selected"{/if}>am</option>
	                            <option value="pm" {if $saturday_dw_ampm eq 'pm'}selected="selected"{/if}>pm</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select name="sunday_dw_hour" class="select" style="width: auto">
	                            <option value="1" {if $sunday_dw_hour eq '1'}selected="selected"{/if}>1</option>
	                            <option value="2" {if $sunday_dw_hour eq '2'}selected="selected"{/if}>2</option>
	                            <option value="3" {if $sunday_dw_hour eq '3'}selected="selected"{/if}>3</option>
	                            <option value="4" {if $sunday_dw_hour eq '4'}selected="selected"{/if}>4</option>
	                            <option value="5" {if $sunday_dw_hour eq '5'}selected="selected"{/if}>5</option>
	                            <option value="6" {if $sunday_dw_hour eq '6'}selected="selected"{/if}>6</option>
	                            <option value="7" {if $sunday_dw_hour eq '7'}selected="selected"{/if}>7</option>
	                            <option value="8" {if $sunday_dw_hour eq '8'}selected="selected"{/if}>8</option>
	                            <option value="9" {if $sunday_dw_hour eq '9'}selected="selected"{/if}>9</option>
	                            <option value="10" {if $sunday_dw_hour eq '10'}selected="selected"{/if}>10</option>
	                            <option value="11" {if $sunday_dw_hour eq '11'}selected="selected"{/if}>11</option>
	                            <option value="12" {if $sunday_dw_hour eq '12'}selected="selected"{/if}>12</option>
	                        </select>
	                        <select name="sunday_dw_minute" class="select" style="width: auto">
	                            <option value="00" {if $sunday_dw_minute eq '00'}selected="selected"{/if}>00</option>
	                            <option value="05" {if $sunday_dw_minute eq '05'}selected="selected"{/if}>05</option>
	                            <option value="10" {if $sunday_dw_minute eq '10'}selected="selected"{/if}>10</option>
	                            <option value="15" {if $sunday_dw_minute eq '15'}selected="selected"{/if}>15</option>
	                            <option value="20" {if $sunday_dw_minute eq '20'}selected="selected"{/if}>20</option>
	                            <option value="25" {if $sunday_dw_minute eq '25'}selected="selected"{/if}>25</option>
	                            <option value="30" {if $sunday_dw_minute eq '30'}selected="selected"{/if}>30</option>
	                            <option value="35" {if $sunday_dw_minute eq '35'}selected="selected"{/if}>35</option>
	                            <option value="40" {if $sunday_dw_minute eq '40'}selected="selected"{/if}>40</option>
	                            <option value="45" {if $sunday_dw_minute eq '45'}selected="selected"{/if}>45</option>
	                            <option value="50" {if $sunday_dw_minute eq '50'}selected="selected"{/if}>50</option>
	                            <option value="55" {if $sunday_dw_minute eq '55'}selected="selected"{/if}>55</option>
	                        </select>
	                        <select name="sunday_dw_ampm" class="select" style="width: auto">
	                            <option value="am" {if $sunday_dw_ampm eq 'am'}selected="selected"{/if}>am</option>
	                            <option value="pm" {if $sunday_dw_ampm eq 'pm'}selected="selected"{/if}>pm</option>
	                        </select>
	                    </td>
	                </tr>
	                </table>
	                
	                   <!-- Start date -->
	                <div style="float:left;"
	                <div class="formelement">
	                	<label for="month">Start Date</label>
	                    <select name="month" class="select" style="width: auto">
	                        <option value="1" {if $month eq '1'}selected="selected"{/if}>January</option>
	                        <option value="2" {if $month eq '2'}selected="selected"{/if}>February</option>
	                        <option value="3" {if $month eq '3'}selected="selected"{/if}>March</option>
	                        <option value="4" {if $month eq '4'}selected="selected"{/if}>April</option>
	                        <option value="5" {if $month eq '5'}selected="selected"{/if}>May</option>
	                        <option value="6" {if $month eq '6'}selected="selected"{/if}>June</option>
	                        <option value="7" {if $month eq '7'}selected="selected"{/if}>July</option>
	                        <option value="8" {if $month eq '8'}selected="selected"{/if}>August</option>
	                        <option value="9" {if $month eq '9'}selected="selected"{/if}>September</option>
	                        <option value="10" {if $month eq '10'}selected="selected"{/if}>October</option>
	                        <option value="11" {if $month eq '11'}selected="selected"{/if}>November</option>
	                        <option value="12" {if $month eq '12'}selected="selected"{/if}>December</option>
	                    </select>
	                    <select name="day" class="select" style="width: auto">
	                        <option value="1" {if $day eq '1'}selected="selected"{/if}>1</option>
	                        <option value="2" {if $day eq '2'}selected="selected"{/if}>2</option>
	                        <option value="3" {if $day eq '3'}selected="selected"{/if}>3</option>
	                        <option value="4" {if $day eq '4'}selected="selected"{/if}>4</option>
	                        <option value="5" {if $day eq '5'}selected="selected"{/if}>5</option>
	                        <option value="6" {if $day eq '6'}selected="selected"{/if}>6</option>
	                        <option value="7" {if $day eq '7'}selected="selected"{/if}>7</option>
	                        <option value="8" {if $day eq '8'}selected="selected"{/if}>8</option>
	                        <option value="9" {if $day eq '9'}selected="selected"{/if}>9</option>
	                        <option value="10" {if $day eq '10'}selected="selected"{/if}>10</option>
	                        <option value="11" {if $day eq '11'}selected="selected"{/if}>11</option>
	                        <option value="12" {if $day eq '12'}selected="selected"{/if}>12</option>
	                        <option value="13" {if $day eq '13'}selected="selected"{/if}>13</option>
	                        <option value="14" {if $day eq '14'}selected="selected"{/if}>14</option>
	                        <option value="15" {if $day eq '15'}selected="selected"{/if}>15</option>
	                        <option value="16" {if $day eq '16'}selected="selected"{/if}>16</option>
	                        <option value="17" {if $day eq '17'}selected="selected"{/if}>17</option>
	                        <option value="18" {if $day eq '18'}selected="selected"{/if}>18</option>
	                        <option value="19" {if $day eq '19'}selected="selected"{/if}>19</option>
	                        <option value="20" {if $day eq '20'}selected="selected"{/if}>20</option>
	                        <option value="21" {if $day eq '21'}selected="selected"{/if}>21</option>
	                        <option value="22" {if $day eq '22'}selected="selected"{/if}>22</option>
	                        <option value="23" {if $day eq '23'}selected="selected"{/if}>23</option>
	                        <option value="24" {if $day eq '24'}selected="selected"{/if}>24</option>
	                        <option value="25" {if $day eq '25'}selected="selected"{/if}>25</option>
	                        <option value="26" {if $day eq '26'}selected="selected"{/if}>26</option>
	                        <option value="27" {if $day eq '27'}selected="selected"{/if}>27</option>
	                        <option value="28" {if $day eq '28'}selected="selected"{/if}>28</option>
	                        <option value="29" {if $day eq '29'}selected="selected"{/if}>29</option>
	                        <option value="30" {if $day eq '30'}selected="selected"{/if}>30</option>
	                        <option value="31" {if $day eq '31'}selected="selected"{/if}>31</option>
	                    </select>
	                    <select name="year" class="select" style="width: auto">
	                        <option value="2008" {if $year eq '2008'}selected="selected"{/if}>2008</option>
	                        <option value="2009" {if $year eq '2009'}selected="selected"{/if}>2009</option>
	                        <option value="2010" {if $year eq '2010'}selected="selected"{/if}>2010</option>
	                        <option value="2011" {if $year eq '2011'}selected="selected"{/if}>2011</option>
	                        <option value="2012" {if $year eq '2012'}selected="selected"{/if}>2012</option>
	                    </select>
	                    <div id="daysofweekError" class="formerror">{$error.daysofweek}</div>	
	                    <div id="startdateError" class="formerror">{$error.startdate}</div>
	                </div>
                    
                    <!--<div class="formelement">
                    	<input name="deleteconfirm" type="checkbox" value="y" {if $deleteconfirm == 'y'}checked="checked"{/if} /> Trigger reconfirmation process? <a name="confirmation_trigger" class="tooltipClass" id="confirmation_trigger"><img src="images/icon_tooltip.gif" border="0"/> </a>
                    </div>-->
	                
	                <div class="formelement" >
		                <input id="submit" name="submit" type="submit" value="Save Schedule" class="submit" />
		                <input id="cancel" name="cancel" type="button" value="Cancel" class="cancel" />
					</div>
	            </form>
	            </div>
	
            
            	{else}
            			
            		{if $monday != 'y' && $tuesday != 'y' && $wednesday != 'y' && $thursday != 'y' && $friday !='y' && $saturday !='y' && $sunday != 'y'}
            			<div class="yellowbox" >The schedule has not yet been set up by the group leader.</div>
            			{else}
                    <img src="images/table4.gif" /><br/>
          			<table class="table4">
	                	<tr class="tablehead">
	                		<th>Days of the Week</th>
	                		<th>Arrive at Workplace</th>
	                		<th>Depart from Workplace</th>
	                	</tr>
            			{if $monday == 'y'}
		                	<tr>
            				<td>Monday</td>
            				<td>{$monday_aw_hour}:{$monday_aw_minute}&nbsp;{$monday_aw_ampm}</td>
            				<td>{$monday_dw_hour}:{$monday_dw_minute}&nbsp;{$monday_dw_ampm}</td>
            				</tr>
            			{/if}
            			{if $tuesday == 'y'}
		                	<tr>
            				<td>Tuesday</td>
            				<td>{$tuesday_aw_hour}:{$tuesday_aw_minute}&nbsp;{$tuesday_aw_ampm}</td>
            				<td>{$tuesday_dw_hour}:{$tuesday_dw_minute}&nbsp;{$tuesday_dw_ampm}</td>
            				</tr>
            			{/if}
            			{if $wednesday == 'y'}
		                	<tr>
            				<td>Wednesday</td>
            				<td>{$wednesday_aw_hour}:{$wednesday_aw_minute}&nbsp;{$wednesday_aw_ampm}</td>
            				<td>{$wednesday_dw_hour}:{$wednesday_dw_minute}&nbsp;{$wednesday_dw_ampm}</td>
            				</tr>
            			{/if}
            			{if $thursday == 'y'}
		                	<tr>
            				<td>Thursday</td>
            				<td>{$thursday_aw_hour}:{$thursday_aw_minute}&nbsp;{$thursday_aw_ampm}</td>
            				<td>{$thursday_dw_hour}:{$thursday_dw_minute}&nbsp;{$thursday_dw_ampm}</td>
            				</tr>
            			{/if}
            			
            			{if $friday == 'y'}
		                	<tr>
            				<td>Friday</td>
            				<td>{$friday_aw_hour}:{$friday_aw_minute}&nbsp;{$friday_aw_ampm}</td>
            				<td>{$friday_dw_hour}:{$friday_dw_minute}&nbsp;{$friday_dw_ampm}</td>
            				</tr>
            			{/if}
            			
            			{if $saturday == 'y'}
		                	<tr>
            				<td>Saturday</td>
            				<td>{$saturday_aw_hour}:{$saturday_aw_minute}&nbsp;{$saturday_aw_ampm}</td>
            				<td>{$saturday_dw_hour}:{$saturday_dw_minute}&nbsp;{$saturday_dw_ampm}</td>
            				</tr>
            			{/if}
            			
            			{if $sunday == 'y'}
		                	<tr>
            				<td>Sunday</td>
            				<td>{$sunday_aw_hour}:{$sunday_aw_minute}&nbsp;{$sunday_aw_ampm}</td>
            				<td>{$sunday_dw_hour}:{$sunday_dw_minute}&nbsp;{$sunday_dw_ampm}</td>
            				</tr>
            			{/if}
            			
            			</table>
          			{/if}
            	{/if}
            
            </div>
            
            <div class="innercolumn" id="last" style="float:right;">
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
                {section name=info loop=$comments}
                    <tr>
                    	<td>
                        <div class="leftcell"><img src="icons/shout.gif" alt="" class="icon" /></div>
                        <div class="rightcell"><span class="purple"> {$comments[info].name}</span><br /><span class="grey">{$comments[info].date}</span><br />
                        
                            {$comments[info].comment} 
                            </div>
                    	</td>
                    </tr>
                {/section}
            </table>
			</div>
        <div class="clear"></div>
         <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}     
    </div>

    
    <div id="onecolumnbtm"></div>
	<div id="tooltip">&nbsp;</div>
</body>
</html>
