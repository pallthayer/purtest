<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script language="javascript" src="js/formfocus.js"></script>
<script language="javascript" src="js/sorttable.js"></script>

<script type="text/javascript">sortableinit = false; // Prevent initial javascript table sorting</script>

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
            <h2>Events</h2>
            
            <!-- Tabs -->
            <div id="tabs">
                <ul>
                    <li class="first current"><a href="events.php?state=browse">Search/Browse</a></li>
                    <li><a href="events.php?state=createevent">Create/Edit</a></li>
                </ul>
            </div>

        </div>
        
		<div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
        
        	<!-- Search box -->
            <div id="searchevents" style="margin-bottom: 25px">
            	<form id="myform" method="post" action="events.php">
                	<input id="search" name="search" type="text" class="textbox" />
                    <input id="submit" name="submit" type="submit" value="Search" class="submit" />
                    (by title, location, description, host, etc)
                </form>
            </div>

			{if $events}
            	<img src="images/table4.gif" /><br/>
            	<table class="table4 sortable">
                	<tr class="tablehead">
                    	<th id="first_col">Title</th>
                        <th>Date/Time</th>
                        <th>Type</th>
                        <th>Options</th>
                    </tr>
                    {section name=info loop=$events}
                    	<tr>
                        	<td>{$events[info].title}</td>
                            <td sorttable_customkey="{$events[info].counter}">{$events[info].startdate} at {$events[info].starttime}</td>
                            <td>{$events[info].type}</td>
                            <td class="sorttable_nosort">
                            	<a href="events.php?state=viewdetails&event={$events[info].event_id}">View Details</a>
                                {if $events[info].editmode} - <a href="events.php?state=editevent&event={$events[info].event_id}">Edit</a>{/if}
                                {if $events[info].editmode} - <a href="events.php?state=removeevent&event={$events[info].event_id}">Remove</a>{/if}
                            </td>
                        </tr>
                    {/section}
                </table>
            {else}
            
            	<p>There are currently no events scheduled at this time</p>
            
            {/if}
            
            
        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}
        </div>


    
    <div id="onecolumnbtm"></div>

</body>
</html>