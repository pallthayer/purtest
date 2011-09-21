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

{literal}

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

.lightbox[id]{ /* IE6 and below Can't See This */    position:fixed;    }#overlay[id]{ /* IE6 and below Can't See This */    position:fixed;    }
</style>

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
                    <li class="current"><a href="pools.php">View Pools</a></li>
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
                    <li class="first"><a href="pools.php?state=viewprofile&pool={$pool_id}">Profile</a></li>
                    {if $editmode}<li><a href="pools.php?state=editschedule&pool={$pool_id}">Scheduler</a></li>{/if}
                    <li class="current"><a href="pools.php?state=viewschedule&pool={$pool_id}">Upcoming Rides</a></li>
                    <li><a href="pools.php?state=shoutbox&pool={$pool_id}">Shoutbox</a></li>
                    {if $editmode}<li><a href="pools.php?state=editpool&pool={$pool_id}">Edit General</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=editmembers&pool={$pool_id}">Edit Members</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=viewroutes&pool={$pool_id}">Edit Routes</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=deletepool&pool={$pool_id}">Delete Pool</a></li>{/if}
                </ul>
            </div>
                
                
                
            <div class="clear">
                <!-- View New Schedule                 
                <div class="btn_container">
                {if $proposedschedule}
                    <span class="btn">
                        <img src="icons/alert.gif" alt ="" class="icon" />
                        <a href="pools.php?state=editschedule&pool={$pool_id}">View Proposed Schedule</a>
                    </span>
                {/if}
	            </div>
	            -->
            
            
            <!-- Departure -->
            <div class="purplebox" style="padding: 15px;">
                <div style="position: relative">
                    {$daterange}
                    <div style="position: absolute; top: -2px; right: 0">
                        <a href="pools.php?state=viewschedule&pool={$pool_id}&week={$pweek}&year={$pyear}" style="text-decoration: none">
                        Previous Week <img src="icons/previous.gif" class="icon" border="0" alt="Previous Week" title="Previous Week" style="margin-right: 0" /></a>&nbsp;                        <a href="pools.php?state=viewschedule&pool={$pool_id}&week={$nweek}&year={$nyear}" style="text-decoration: none">
                        <img src="icons/next.gif" class="icon" alt="Next Week" title="Next Week" border="0" /> Next Week</a>
                    </div>
                </div>
                
                <table id="calendar" border="0" cellspacing="0" cellpadding="0">
                	<tr>
                		<td {if $mondayispast}class="past"{/if}>
                			<div class="head">{$shortdates[1]}</div>
                			<div class="{if $monday}{if $mondayissaved}saved {else}unsaved {/if}{/if}{if $mondayispast}past{/if}">
                				{if $monday}
                					Depart from Meeting Place: 
                					{$monday_dm_hour}:{$monday_dm_minute}&nbsp;{$monday_dm_ampm}<br /><br />
                					
                					Depart from Workplace: 
                        				{$monday_dw_hour}:{$monday_dw_minute}&nbsp;{$monday_dw_ampm}<br /><br />
                        				
                        				{if $mondayissaved}
	                        				{$mondayaccepted}/{$members|@count} members accepted<br /><br />
	                        			{/if}
                        				
                        				Driver:<br />
                        				{section name=info loop=$members}
							    {if $mondaydriver eq $members[info].user_id}{$members[info].name}{/if}
                        				{/section}<br /><br />
                        				
                        				{if $mondayissaved}
	                        				<span class="finalized">Finalized by <br />Pool Leader</span><br />
	                        				
	                        				{section name=info loop=$members}
	                        					{if $members[info].editable}
										{if $members[info].mondayeditable eq true}
										    <span>
											<a id="{$fulldates[1]}_accept" onclick="confirmPost('accept', '{$pool_id}', '{$fulldates[1]}'); return false;" href="#" 
											{if $members[info].mondayconfirm eq 'accept'}class="accept"{/if}>Accept</a>
											&nbsp;|&nbsp;
											<a id="{$fulldates[1]}_decline" onclick="confirmPost('decline', '{$pool_id}', '{$fulldates[1]}'); return false;" href="#" 
											{if $members[info].mondayconfirm eq 'decline'}class="decline"{/if}>Decline</a>
										    </span>
										{else}
										    {if $members[info].mondayconfirm eq 'accept'}<span class="accept">Accept</span>{/if}
										    {if $members[info].mondayconfirm eq 'decline'}<span class="decline">Decline</span>{/if}
										    {if $members[info].mondayconfirm eq ''}<span class="decline">Unconfirmed</span>{/if}
										{/if}
									{/if}
	                        				{/section}<br /><br />
	                        			{else}
	                        				<span class="unfinalized">Not Finalized<br /> by Pool Leader!</span><br />
	                        			{/if}
                        				
                        				<a href="javascript:void();" rel="mondaydiv" class="lbOn">
                        					{if $editmode}
                        						View/Edit Details
                        					{else}
                        						View Details
                        					{/if}
                        				</a>
                				{/if}
                			</div>
                		</td>
                		<td {if $tuesdayispast}class="past"{/if}>
                			<div class="head">{$shortdates[2]}</div>
                			<div class="{if $tuesday}{if $tuesdayissaved}saved {else}unsaved {/if}{/if}{if $tuesdayispast}past{/if}">
                				{if $tuesday}
                					Depart from Meeting Place: 
                					{$tuesday_dm_hour}:{$tuesday_dm_minute}&nbsp;{$tuesday_dm_ampm}<br /><br />
                					
                					Depart from Workplace: 
                        				{$tuesday_dw_hour}:{$tuesday_dw_minute}&nbsp;{$tuesday_dw_ampm}<br /><br />
                        				
                        				{if $tuesdayissaved}
	                        				{$tuesdayaccepted}/{$members|@count} members accepted<br /><br />
	                        			{/if}
                        				
                        				Driver:<br />
                        				{section name=info loop=$members}
							    {if $tuesdaydriver eq $members[info].user_id}{$members[info].name}{/if}
                        				{/section}<br /><br />
                        				
                        				{if $tuesdayissaved}
	                        				<span class="finalized">Finalized by <br />Pool Leader</span><br />
	                        				
	                        				{section name=info loop=$members}
	                        					{if $members[info].editable}
										{if $members[info].tuesdayeditable eq true}
										    <span>
											<a id="{$fulldates[2]}_accept" onclick="confirmPost('accept', '{$pool_id}', '{$fulldates[2]}'); return false;" href="#" 
											{if $members[info].tuesdayconfirm eq 'accept'}class="accept"{/if}>Accept</a>
											&nbsp;|&nbsp;
											<a id="{$fulldates[2]}_decline" onclick="confirmPost('decline', '{$pool_id}', '{$fulldates[2]}'); return false;" href="#" 
											{if $members[info].tuesdayconfirm eq 'decline'}class="decline"{/if}>Decline</a>
										    </span>
										{else}
										    {if $members[info].tuesdayconfirm eq 'accept'}<span class="accept">Accept</span>{/if}
										    {if $members[info].tuesdayconfirm eq 'decline'}<span class="decline">Decline</span>{/if}
										    {if $members[info].tuesdayconfirm eq ''}<span class="decline">Unconfirmed</span>{/if}
										{/if}
									{/if}
	                        				{/section}<br /><br />
	                        			{else}
	                        				<span class="unfinalized">Not Finalized<br /> by Pool Leader!</span><br />
	                        			{/if}
                        				
                        				<a href="javascript:void();" rel="tuesdaydiv" class="lbOn">
                        					{if $editmode}
                        						View/Edit Details
                        					{else}
                        						View Details
                        					{/if}
                        				</a>
                				{/if}
                			</div>
                		</td>
                		<td {if $wednesdayispast}class="past"{/if}>
                			<div class="head">{$shortdates[3]}</div>
                			<div class="{if $wednesday}{if $wednesdayissaved}saved {else}unsaved {/if}{/if}{if $wednesdayispast}past{/if}">
                				{if $wednesday}
                					Depart from Meeting Place: 
                					{$wednesday_dm_hour}:{$wednesday_dm_minute}&nbsp;{$wednesday_dm_ampm}<br /><br />
                					
                					Depart from Workplace: 
                        				{$wednesday_dw_hour}:{$wednesday_dw_minute}&nbsp;{$wednesday_dw_ampm}<br /><br />
                        				
                        				{if $wednesdayissaved}
	                        				{$wednesdayaccepted}/{$members|@count} members accepted<br /><br />
	                        			{/if}
                        				
                        				Driver:<br />
                        				{section name=info loop=$members}
							    {if $wednesdaydriver eq $members[info].user_id}{$members[info].name}{/if}
                        				{/section}<br /><br />
                        				
                        				{if $wednesdayissaved}
	                        				<span class="finalized">Finalized by <br />Pool Leader</span><br />
	                        				
	                        				{section name=info loop=$members}
	                        					{if $members[info].editable}
										{if $members[info].wednesdayeditable eq true}
										    <span>
											<a id="{$fulldates[3]}_accept" onclick="confirmPost('accept', '{$pool_id}', '{$fulldates[3]}'); return false;" href="#" 
											{if $members[info].wednesdayconfirm eq 'accept'}class="accept"{/if}>Accept</a>
											&nbsp;|&nbsp;
											<a id="{$fulldates[3]}_decline" onclick="confirmPost('decline', '{$pool_id}', '{$fulldates[3]}'); return false;" href="#" 
											{if $members[info].wednesdayconfirm eq 'decline'}class="decline"{/if}>Decline</a>
										    </span>
										{else}
										    {if $members[info].wednesdayconfirm eq 'accept'}<span class="accept">Accept</span>{/if}
										    {if $members[info].wednesdayconfirm eq 'decline'}<span class="decline">Decline</span>{/if}
										    {if $members[info].wednesdayconfirm eq ''}<span class="decline">Unconfirmed</span>{/if}
										{/if}
									{/if}
	                        				{/section}<br /><br />
	                        			{else}
	                        				<span class="unfinalized">Not Finalized<br /> by Pool Leader!</span><br />
	                        			{/if}
                        				
                        				<a href="javascript:void();" rel="wednesdaydiv" class="lbOn">
                        					{if $editmode}
                        						View/Edit Details
                        					{else}
                        						View Details
                        					{/if}
                        				</a>
                				{/if}
                			</div>
                		</td>
                		<td {if $thursdayispast}class="past"{/if}>
                			<div class="head">{$shortdates[4]}</div>
                			<div class="{if $thursday}{if $thursdayissaved}saved {else}unsaved {/if}{/if}{if $thursdayispast}past{/if}">
               				{if $thursday}
                					Depart from Meeting Place: 
                					{$thursday_dm_hour}:{$thursday_dm_minute}&nbsp;{$thursday_dm_ampm}<br /><br />
                					
                					Depart from Workplace: 
                        				{$thursday_dw_hour}:{$thursday_dw_minute}&nbsp;{$thursday_dw_ampm}<br /><br />
                        				
                        				{if $thursdayissaved}
	                        				{$thursdayaccepted}/{$members|@count} members accepted<br /><br />
	                        			{/if}
                        				
                        				Driver:<br />
                        				{section name=info loop=$members}
							    {if $thursdaydriver eq $members[info].user_id}{$members[info].name}{/if}
                        				{/section}<br /><br />
                        				
                        				{if $thursdayissaved}
	                        				<span class="finalized">Finalized by <br />Pool Leader</span><br />
	                        				
	                        				{section name=info loop=$members}
	                        					{if $members[info].editable}
										{if $members[info].thursdayeditable eq true}
										    <span>
											<a id="{$fulldates[4]}_accept" onclick="confirmPost('accept', '{$pool_id}', '{$fulldates[4]}'); return false;" href="#" 
											{if $members[info].thursdayconfirm eq 'accept'}class="accept"{/if}>Accept</a>
											&nbsp;|&nbsp;
											<a id="{$fulldates[4]}_decline" onclick="confirmPost('decline', '{$pool_id}', '{$fulldates[4]}'); return false;" href="#" 
											{if $members[info].thursdayconfirm eq 'decline'}class="decline"{/if}>Decline</a>
										    </span>
										{else}
										    {if $members[info].thursdayconfirm eq 'accept'}<span class="accept">Accept</span>{/if}
										    {if $members[info].thursdayconfirm eq 'decline'}<span class="decline">Decline</span>{/if}
										    {if $members[info].thursdayconfirm eq ''}<span class="decline">Unconfirmed</span>{/if}
										{/if}
									{/if}
	                        				{/section}<br /><br />
	                        			{else}
	                        				<span class="unfinalized">Not Finalized<br /> by Pool Leader!</span><br />
	                        			{/if}
                        				
                        				<a href="javascript:void();" rel="thursdaydiv" class="lbOn">
                        					{if $editmode}
                        						View/Edit Details
                        					{else}
                        						View Details
                        					{/if}
                        				</a>
                				{/if}
                			</div>
                		</td>
                		<td {if $fridayispast}class="past"{/if}>
                			<div class="head">{$shortdates[5]}</div>
                			<div class="{if $friday}{if $fridayissaved}saved {else}unsaved {/if}{/if}{if $fridayispast}past{/if}">
                				{if $friday}
                					Depart from Meeting Place: 
                					{$friday_dm_hour}:{$friday_dm_minute}&nbsp;{$friday_dm_ampm}<br /><br />
                					
                					Depart from Workplace: 
                        				{$friday_dw_hour}:{$friday_dw_minute}&nbsp;{$friday_dw_ampm}<br /><br />
                        				
                        				{if $fridayissaved}
	                        				{$fridayaccepted}/{$members|@count} members accepted<br /><br />
	                        			{/if}
                        				
                        				Driver:<br />
                        				{section name=info loop=$members}
							    {if $fridaydriver eq $members[info].user_id}{$members[info].name}{/if}
                        				{/section}<br /><br />
                        				
                        				{if $fridayissaved}
	                        				<span class="finalized">Finalized by <br />Pool Leader</span><br />
	                        				
	                        				{section name=info loop=$members}
	                        					{if $members[info].editable}
										{if $members[info].fridayeditable eq true}
										    <span>
											<a id="{$fulldates[5]}_accept" onclick="confirmPost('accept', '{$pool_id}', '{$fulldates[5]}'); return false;" href="#" 
											{if $members[info].fridayconfirm eq 'accept'}class="accept"{/if}>Accept</a>
											&nbsp;|&nbsp;
											<a id="{$fulldates[5]}_decline" onclick="confirmPost('decline', '{$pool_id}', '{$fulldates[5]}'); return false;" href="#" 
											{if $members[info].fridayconfirm eq 'decline'}class="decline"{/if}>Decline</a>
										    </span>
										{else}
										    {if $members[info].fridayconfirm eq 'accept'}<span class="accept">Accept</span>{/if}
										    {if $members[info].fridayconfirm eq 'decline'}<span class="decline">Decline</span>{/if}
										    {if $members[info].fridayconfirm eq ''}<span class="decline">Unconfirmed</span>{/if}
										{/if}
									{/if}
	                        				{/section}<br /><br />
	                        			{else}
	                        				<span class="unfinalized">Not Finalized<br /> by Pool Leader!</span><br />
	                        			{/if}
                        				
                        				<a href="javascript:void();" rel="fridaydiv" class="lbOn">
                        					{if $editmode}
                        						View/Edit Details
                        					{else}
                        						View Details
                        					{/if}
                        				</a>
                				{/if}
                			</div>
                		</td>
                		<td  {if $saturdayispast}class="past"{/if}>
                			<div class="head">{$shortdates[6]}</div>
                			<div class="{if $saturday}{if $saturdayissaved}saved {else}unsaved {/if}{/if}{if $saturdayispast}past{/if}">
                				{if $saturday}
                					Depart from Meeting Place: 
                					{$saturday_dm_hour}:{$saturday_dm_minute}&nbsp;{$saturday_dm_ampm}<br /><br />
                					
                					Depart from Workplace: 
                        				{$saturday_dw_hour}:{$saturday_dw_minute}&nbsp;{$saturday_dw_ampm}<br /><br />
                        				
                        				{if $saturdayissaved}
	                        				{$saturdayaccepted}/{$members|@count} members accepted<br /><br />
	                        			{/if}
                        				
                        				Driver:<br />
                        				{section name=info loop=$members}
							    {if $saturdaydriver eq $members[info].user_id}{$members[info].name}{/if}
                        				{/section}<br /><br />
                        				
                        				{if $saturdayissaved}
	                        				<span class="finalized">Finalized by <br />Pool Leader</span><br />
	                        				
	                        				{section name=info loop=$members}
	                        					{if $members[info].editable}
										{if $members[info].saturdayeditable eq true}
										    <span>
											<a id="{$fulldates[6]}_accept" onclick="confirmPost('accept', '{$pool_id}', '{$fulldates[6]}'); return false;" href="#" 
											{if $members[info].saturdayconfirm eq 'accept'}class="accept"{/if}>Accept</a>
											&nbsp;|&nbsp;
											<a id="{$fulldates[6]}_decline" onclick="confirmPost('decline', '{$pool_id}', '{$fulldates[6]}'); return false;" href="#" 
											{if $members[info].saturdayconfirm eq 'decline'}class="decline"{/if}>Decline</a>
										    </span>
										{else}
										    {if $members[info].saturdayconfirm eq 'accept'}<span class="accept">Accept</span>{/if}
										    {if $members[info].saturdayconfirm eq 'decline'}<span class="decline">Decline</span>{/if}
										    {if $members[info].saturdayconfirm eq ''}<span class="decline">Unconfirmed</span>{/if}
										{/if}
									{/if}
	                        				{/section}<br /><br />
	                        			{else}
	                        				<span class="unfinalized">Not Finalized<br /> by Pool Leader!</span><br />
	                        			{/if}
                        				
                        				<a href="javascript:void();" rel="saturdaydiv" class="lbOn">
                        					{if $editmode}
                        						View/Edit Details
                        					{else}
                        						View Details
                        					{/if}
                        				</a>
                				{/if}
                			</div>
                		</td>
                		<td {if $sundayispast}class="past"{/if}>
                			<div class="head">{$shortdates[7]}</div>
                			<div class="{if $sunday}{if $sundayissaved}saved {else}unsaved {/if}{/if}{if $sundayispast}past{/if}">
                				{if $sunday}
                					Depart from Meeting Place: 
                					{$sunday_dm_hour}:{$sunday_dm_minute}&nbsp;{$sunday_dm_ampm}<br /><br />
                					
                					Depart from Workplace: 
                        				{$sunday_dw_hour}:{$sunday_dw_minute}&nbsp;{$sunday_dw_ampm}<br /><br />
                        				
                        				{if $sundayissaved}
	                        				{$sundayaccepted}/{$members|@count} members accepted<br /><br />
	                        			{/if}
                        				
                        				Driver:<br />
                        				{section name=info loop=$members}
							    {if $sundaydriver eq $members[info].user_id}{$members[info].name}{/if}
                        				{/section}<br /><br />
                        				
                        				{if $sundayissaved}
	                        				<span class="finalized">Finalized by <br />Pool Leader</span><br />
	                        				
	                        				{section name=info loop=$members}
	                        					{if $members[info].editable}
										{if $members[info].sundayeditable eq true}
										    <span>
											<a id="{$fulldates[7]}_accept" onclick="confirmPost('accept', '{$pool_id}', '{$fulldates[7]}'); return false;" href="#" 
											{if $members[info].sundayconfirm eq 'accept'}class="accept"{/if}>Accept</a>
											&nbsp;|&nbsp;
											<a id="{$fulldates[7]}_decline" onclick="confirmPost('decline', '{$pool_id}', '{$fulldates[7]}'); return false;" href="#" 
											{if $members[info].sundayconfirm eq 'decline'}class="decline"{/if}>Decline</a>
										    </span>
										{else}
										    {if $members[info].sundayconfirm eq 'accept'}<span class="accept">Accept</span>{/if}
										    {if $members[info].sundayconfirm eq 'decline'}<span class="decline">Decline</span>{/if}
										    {if $members[info].sundayconfirm eq ''}<span class="decline">Unconfirmed</span>{/if}
										{/if}
									{/if}
	                        				{/section}<br /><br />
	                        			{else}
	                        				<span class="unfinalized">Not Finalized<br /> by Pool Leader!</span><br />
	                        			{/if}
                        				
                        				<a href="javascript:void();" rel="sundaydiv" class="lbOn">
                        					{if $editmode}
                        						View/Edit Details
                        					{else}
                        						View Details
                        					{/if}
                        				</a>
                				{/if}
                			</div>
                		</td>

                	</tr>
                </table>
                {if $editmode}
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
                {/if}
            </div>
            
            <!-- View Schedule -->
            {if $monday}
            	<div id="mondaydiv" class="leightbox">
                	<div id="monday_tooltip">&nbsp;</div>
                	{include file="pools-schedule-monday.tpl"}<a href="javascript:void();" class="lbAction" rel="deactivate">Close</a>
                    {literal}
                    	<script>addMondayToolTipListener()</script>
                    {/literal}
                </div>
            {/if}
            {if $tuesday}
            	<div id="tuesdaydiv" class="leightbox">
                	<div id="tuesday_tooltip">&nbsp;</div>
                	{include file="pools-schedule-tuesday.tpl"}<a href="javascript:void();" class="lbAction" rel="deactivate">Close</a>
                    {literal}
                    	<script>addTuesdayToolTipListener()</script>
                    {/literal}
                </div>
            {/if}
            {if $wednesday}
            	<div id="wednesdaydiv" class="leightbox">
                	<div id="wednesday_tooltip">&nbsp;</div>
                	{include file="pools-schedule-wednesday.tpl"}<a href="javascript:void();" class="lbAction" rel="deactivate">Close</a>
                    {literal}
                    	<script>addWednesdayToolTipListener()</script>
                    {/literal}
            	</div>
            {/if}
            {if $thursday}
            	<div id="thursdaydiv" class="leightbox">
                	<div id="thursday_tooltip">&nbsp;</div>
                	{include file="pools-schedule-thursday.tpl"}<a href="javascript:void();" class="lbAction" rel="deactivate">Close</a>
                    {literal}
                    	<script>addThursdayToolTipListener()</script>
                    {/literal}
              	</div>
            {/if}
            {if $friday}
            	<div id="fridaydiv" class="leightbox">
                	<div id="friday_tooltip">&nbsp;</div>
            		{include file="pools-schedule-friday.tpl"}<a href="javascript:void();" class="lbAction" rel="deactivate">Close</a>
                    {literal}
                    	<script>addFridayToolTipListener()</script>
                    {/literal}
                </div>
            {/if}
            {if $saturday}
            	<div id="saturdaydiv" class="leightbox">
                	<div id="saturday_tooltip">&nbsp;</div>
                	{include file="pools-schedule-saturday.tpl"}<a href="javascript:void();" class="lbAction" rel="deactivate">Close</a>
                    {literal}
                    	<script>addSaturdayToolTipListener()</script>
                    {/literal}
                </div>
            {/if}
            {if $sunday}
            	<div id="sundaydiv" class="leightbox">
                	<div id="sunday_tooltip">&nbsp;</div>
                	{include file="pools-schedule-sunday.tpl"}<a href="javascript:void();" class="lbAction" rel="deactivate">Close</a>
                    {literal}
                    	<script>addSundayToolTipListener()</script>
                    {/literal}
                </div>
            {/if}

    	    </div>
			<div class="clear"></div>
        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}     
		</div>
    
    <div id="onecolumnbtm"></div>
	
</body>
</html>
