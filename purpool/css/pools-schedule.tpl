<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects,controls"></script>
<script language="javascript" src="js/formfocus.js"></script>

{literal}
<style type="text/css">

.accept, .accept:link, .accept:visited {
	color: #690;
	font-weight: bold;
	text-decoration: none;
}

.accept:hover {
	color: #9c0;
	font-weight: bold;
	text-decoration: none;
}

.decline, .decline:link, .decline:visited {
	color: #900;
	font-weight: bold;
	text-decoration: none;
}

.decline:hover {
	color: #c00;
	font-weight: bold;
	text-decoration: none;
}


</style>
{/literal}

</head>

<body>

	<!-- Header -->
    <div id="header">
    	<img src="images/logo.jpg" alt="Purpool" />
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
            <h1>Pools</h1>
            
			<!-- Tabs -->
            <div id="tabs">
                <ul>
                    <li class="first"><a href="pools.php?state=editpool&pool={$pool_id}">General</a></li>
                    <li><a href="pools.php?state=editmembers&pool={$pool_id}">Members</a></li>
                    <li class="current"><a href="pools.php?state=viewschedule&pool={$pool_id}">Schedule</a></li>
                </ul>
            </div>
            
        </div>
        
        <!-- Content -->
        <div id="content">
        	
            <!-- Edit Schedule -->
            <span class="btn">
	            <img src="icons/pencil.gif" alt ="" class="icon" />
	            <a href="pools.php?state=editschedule">Edit Schedule</a>
            </span>
            
            <!-- View New Schedule -->
            {if $proposedschedule}
                <span class="btn" style="float: none; margin-top: 35px; width: 225px">
                    <img src="icons/alert.gif" alt ="" class="icon" />
                    <a href="pools.php?state=editschedule">View Proposed Schedule</a>
                </span>
            {/if}
            
            <!-- Departure -->
            <div class="purplebox" style="padding: 15px;">
                <div style="position: relative">
                    {$dates}
                    <div style="position: absolute; top: -2px; right: 0">
                        <a href="pools.php?state=viewschedule&pool={$pool_id}&week={$previous}" style="text-decoration: none">
                        <img src="icons/previous.gif" class="icon" border="0" style="margin-right: 0" /> Previous</a>  | 
                        <a href="pools.php?state=viewschedule&pool={$pool_id}&week={$next}" style="text-decoration: none">
                        Next <img src="icons/next.gif" class="icon" border="0" /></a>
                    </div>
                </div>
            </div>
    
            <!-- General Information -->
			<table style="width: 100%">
            	<tr>
                	<th colspan="2">General Information</th>
                </tr>
                <tr>
                    <td style="width: 15%; white-space: nowrap"><span class="purple">Pool name:</span></td>
                    <td style="width: 85%">{$title}</td>
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
            
            <!-- View Schedule -->
            {if $monday}
			
            	<table style="width: 100%">
            	<tr>
                	<th colspan="2">Monday</th>
                </tr>
                <tr>
                    <td colspan="2" style="background-color: #ffc">
                    	<form id="mondayform">
                            <select name="driver" class="select">
                            <option value="">-- select driver --</option>
                                {section name=info loop=$members}
                                    <option value="{$members[info].user_id}">{$members[info].name}</option>
                                {/section}
                            </select>
                            <input id="mondaysubmit" name="submit" type="submit" value="Save" class="submit" />
                        </form>
                    </td>
                </tr>
                   {section name=info loop=$members}
                        {if $members[info].confirmation}
                            <tr>
                                <td style="width: 15%; white-space: nowrap"><a href="pools.php?state=viewprofile&user={$members[info].user_id}">{$members[info].name}</a></td>
                                <td style="width: 85%">
                                    <a href="#" onclick="confirmPost('accept', '{$pool_id}', '{$daymonday}'); return false;" {if $members[info].accept}class="accept"{/if}>Accept</a> | 
                                    <a href="#" onclick="confirmPost('decline', '{$pool_id}', '{$daymonday}'); return false;" {if $members[info].decline}class="decline"{/if}>Decline</a>
                                </td>
                            </tr>
                        {else}
                            <tr>
                                <td style="width: 15%; white-space: nowrap"><a href="pools.php?state=viewprofile&user={$members[info].user_id}">{$members[info].name}</a></td>
                                <td style="width: 85% color: #ccc;">
                                    {if $members[info].accept}<span class="accept">Accept</span>{else}Accept{/if} | 
                                    {if $members[info].decline}<span class="decline">Decline</span>{else}Decline{/if}  
                                </td>
                            </tr>
                        {/if}
                    {/section}
                </table>
            {/if}

        </div>
        
    </div>


</body>
</html>
