<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects,controls"></script>
<script language="javascript" src="js/formfocus.js"></script>
</head>

<body>

	<!-- Header -->
    <div id="header">
    	<a href="{$site_url}" id="logo"><h1>Purpool</h1></a>
    </div>
    
    <!-- Top Navigation -->
    <div id="topnav">
    	<ul>
        	<li><a href="authenticate.php?state=signout">Signout</a></li>
		</ul>
    </div>
    
    <!-- Left Column -->
    <div id="leftcolumn">
    	
        <!-- Side Navigation -->
        {include file="sidenavigation.tpl"}

    </div>

	<!-- Right Column -->
    <div id="rightcolumn">
    
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
                
	        <h3>{$poolname}</h3>
            <div id="wizard">
                <ul>
                    <li ><a href="pools.php?state=viewprofile&pool={$pool_id}">Profile</a></li>
                    {if $editmode}<li class="current"><a href="pools.php?state=editschedule&pool={$pool_id}">Scheduler</a></li>{/if}
                    <li><a href="pools.php?state=viewschedule&pool={$pool_id}">Upcoming Rides</a></li>
                    <li><a href="pools.php?state=shoutbox&pool={$pool_id}">Shoutbox</a></li>
                    {if $editmode}<li><a href="pools.php?state=editpool&pool={$pool_id}">Edit General</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=editmembers&pool={$pool_id}">Edit Members</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=viewroutes&pool={$pool_id}">Edit Routes</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=deletepool&pool={$pool_id}">Delete Pool</a></li>{/if}
                </ul>
            </div>
        	
            <!-- Edit Schedule -->
            <div class="btn" style="float: none; margin-top: 35px; width: 150px">
	            <img src="icons/pencil.gif" alt ="" class="icon" />
	            <a href="pools.php?state=editschedule">Edit Schedule</a>
            </div>
            
            <!-- Departure -->
            <div class="purplebox" style="padding: 15px">
                <div style="position: relative">
                    {$dates}
                    <div style="position: absolute; top: -2px; right: 0">
                        <a href="pools.php?state=viewschedule&pool={$pool_id}&week={$previous}" style="text-decoration: none">
                        <img src="icons/previous.gif" class="icon" border="0" /> Previous</a>  | 
                        <a href="pools.php?state=viewschedule&pool={$pool_id}&week={$next}" style="text-decoration: none">
                        Next <img src="icons/next.gif" class="icon" border="0" /></a>
                    </div>
                </div>
            </div>
    
            <!-- General Information -->
            <img src="images/table2.gif" /><br/>
			<table style="width: 100%">
            	<tr>
                	<th colspan="2">General Information</th>
                </tr>
                <tr>
                    <td><span class="purple">Pool name:</span></td>
                    <td>{$title}</td>
                </tr>
                <tr>
                    <td><span class="purple">Meeting Place:</span></td>
                    <td>{if $startplace != 'other'}{$startplace}: {/if}{$startaddress1}{if $startaddress2} {$startaddress2}{/if} {$startcity} {$startstate} {$startzip}</td>
                </tr>
                <tr>
                    <td><span class="purple">Workplace:</span></td>
                    <td>{if $endplace != 'other'}{$endplace}: {/if}{$endaddress1}{if $endaddress2} {$endaddress2}{/if} {$endcity} {$endstate} {$endzip}</td>
                </tr>
                <tr>
                    <td><span class="purple">Access:</span></td>
                    <td>{$access}</td>
                </tr>
                <tr>
                    <td><span class="purple">Smoking:</span></td>
                    <td>{$smoking}</td>
                </tr>
                {if $additionalinfo}
                    <tr>
                        <td><span class="purple">Additional Info:</span></td>
                        <td>{$additionalinfo}</td>
                    </tr>
                {/if}
            </table>
            
            <!-- Days -->
            <div class="purplebox">
                <img src="icons/arrow_orange_right.gif" alt="" class="icon" /> Days of week
            </div>
            
            <form id="myform" name="myform" method="post" action="pools.php?state=createschedule">
                <div class="formelement"> 
                    <input id="sunday" name="sunday" type="checkbox" value="y" {if $sunday}checked="checked"{/if} /> Sunday <br />
                    <input id="monday" name="monday" type="checkbox" value="y" {if $monday}checked="checked"{/if} /> Monday <br />
                    <input id="tuesday" name="tuesday" type="checkbox" value="y" {if $tuesday}checked="checked"{/if} /> Tuesday <br />
                    <input id="wednesday" name="wednesday" type="checkbox" value="y" {if $wednesday}checked="checked"{/if} /> Wednesday <br />
                    <input id="thursday" name="thursday" type="checkbox" value="y" {if $thursday}checked="checked"{/if} /> Thursday <br />
                    <input id="friday" name="friday" type="checkbox" value="y" {if $friday}checked="checked"{/if} /> Friday <br />
                    <input id="saturday" name="saturday" type="checkbox" value="y" {if $saturday}checked="checked"{/if} /> Saturday
                    <div id="daysofweekError" class="formerror">{$error.daysofweek}</div>
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
                        <option value="1" {if $monday_dm_hour eq '1'}selected="selected"{/if}>1</option>
                        <option value="2" {if $monday_dm_hour eq '2'}selected="selected"{/if}>2</option>
                        <option value="3" {if $monday_dm_hour eq '3'}selected="selected"{/if}>3</option>
                        <option value="4" {if $monday_dm_hour eq '4'}selected="selected"{/if}>4</option>
                        <option value="5" {if $monday_dm_hour eq '5'}selected="selected"{/if}>5</option>
                        <option value="6" {if $monday_dm_hour eq '6'}selected="selected"{/if}>6</option>
                        <option value="7" {if $monday_dm_hour eq '7'}selected="selected"{/if}>7</option>
                        <option value="8" {if $monday_dm_hour eq '8'}selected="selected"{/if}>8</option>
                        <option value="9" {if $monday_dm_hour eq '9'}selected="selected"{/if}>9</option>
                        <option value="10" {if $monday_dm_hour eq '10'}selected="selected"{/if}>10</option>
                        <option value="11" {if $monday_dm_hour eq '11'}selected="selected"{/if}>11</option>
                        <option value="12" {if $monday_dm_hour eq '12'}selected="selected"{/if}>12</option>
                    </select>
                    <select name="monday_dm_minute" class="select" style="width: auto">
                        <option value="00" {if $monday_dm_minute eq '00'}selected="selected"{/if}>00</option>
                        <option value="05" {if $monday_dm_minute eq '05'}selected="selected"{/if}>05</option>
                        <option value="10" {if $monday_dm_minute eq '10'}selected="selected"{/if}>10</option>
                        <option value="15" {if $monday_dm_minute eq '05'}selected="selected"{/if}>15</option>
                        <option value="20" {if $monday_dm_minute eq '20'}selected="selected"{/if}>20</option>
                        <option value="25" {if $monday_dm_minute eq '25'}selected="selected"{/if}>25</option>
                        <option value="30" {if $monday_dm_minute eq '30'}selected="selected"{/if}>30</option>
                        <option value="35" {if $monday_dm_minute eq '35'}selected="selected"{/if}>35</option>
                        <option value="40" {if $monday_dm_minute eq '40'}selected="selected"{/if}>40</option>
                        <option value="45" {if $monday_dm_minute eq '45'}selected="selected"{/if}>45</option>
                        <option value="50" {if $monday_dm_minute eq '50'}selected="selected"{/if}>50</option>
                        <option value="55" {if $monday_dm_minute eq '55'}selected="selected"{/if}>55</option>
                    </select>
                    <select name="monday_dm_ampm" class="select" style="width: auto">
                        <option value="am" {if $monday_dm_ampm eq 'am'}selected="selected"{/if}>am</option>
                        <option value="pm" {if $monday_dm_ampm eq 'pm'}selected="selected"{/if}>pm</option>
                    </select>
                </div>
                
                <div class="formelement">
                    <label for="monday_aw_hour">Depart from meeting place</label>
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
                        <option value="15" {if $monday_aw_minute eq '05'}selected="selected"{/if}>15</option>
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
                </div>
                
                <div class="formelement">
                    <label for="monday_dw_hour">Depart from meeting place</label>
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
                        <option value="15" {if $monday_dw_minute eq '05'}selected="selected"{/if}>15</option>
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
                </div>
                
                <!-- Does this work for you -->
                <div class="purplebox">
                    <img src="icons/arrow_orange_right.gif" alt="" class="icon" /> Does this work for you?
                </div>
                
                <table class="noborders">
                    {section name=info loop=$members}
                        <tr>
                            <td>{$members[info].name}</td>
                            <td>
                                <a href="#" class="available">Available</a> 
                                <a href="#" class="changesrequested">Changes Requested</a> 
                                <a href="#" class="notavailable">Not Available</a> 
                            </td>
                        </tr>
                    {/section}
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
                    {section name=info loop=$comments}
                        <tr>
                            <td>{$comments[info].name}<br />{$comments[info].date}</td>
                            <td>
                                {$comments[info].comment} 
                            </td>
                        </tr>
                    {/section}
                </table>

        </div>
        
    </div>


    
    <div id="onecolumnbtm"></div>

</body>
</html>
