<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects,controls"></script>
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
                    <li ><a href="pools.php?state=viewprofile&pool={$pool_id}">Profile</a></li>
                    
                    {if $editmode}<li><a href="pools.php?state=editschedule&pool={$pool_id}">Scheduler</a></li>{/if}
                    <li><a href="pools.php?state=viewschedule&pool={$pool_id}">Upcoming Rides</a></li>
                    <li><a href="pools.php?state=shoutbox&pool={$pool_id}">Shoutbox</a></li>
                    {if $editmode}<li><a href="pools.php?state=editpool&pool={$pool_id}">Edit General</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=editmembers&pool={$pool_id}">Edit Members</a></li>{/if}
                    {if $editmode}<li class="current"><a href="pools.php?state=viewroutes&pool={$pool_id}">Edit Routes</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=deletepool&pool={$pool_id}">Delete Pool</a></li>{/if}
                </ul>
            </div>
        
        	
            
            <!-- Current Routes <h4>My Routes</h4> -->
            
            <div class="innercolumn2">
	            {if $routes}
                	<img src="images/table2.gif" /><br/>
	                <table class="table2">
	                    <tr class="tablehead">
	                        <th>Route</th>
	                        <th>Distance</th>
	                        <th>Options</th>
	                    </tr>
	                    {section name=info loop=$routes}
	                        <tr>
	                            <td><a href="pools.php?state=editroute&pool={$routes[info].pool_id}&route={$routes[info].route_id}">{$routes[info].title}</a></td>
	                            <td>{$routes[info].distance} Miles</td>
	                            <td>
	                                <img src="icons/delete_small.gif" class="icon" />
	                                <a href="pools.php?state=deleteroute&pool={$routes[info].pool_id}&route={$routes[info].route_id}">Delete</a>
	                            </td>
	                        </tr>
	                    {/section}
	                </table>
	            {else}
	                <p>You currently do not have any routes.</p>
	            {/if}
	
	        <!-- Pool Buttons -->
	            <div class="btn_container" style="margin-top: 5px;">
	            
	                <!-- Create New Route -->
	                <span class="btn">
	                    
	                    <a href="pools.php?state=createroute&pool={$pool_id}"><img src="icons/add.gif" alt ="" class="icon" />Create Route</a>
	                </span>
	                
	                
	            </div>
            </div>

			<div class="clear"></div>
        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}     			
        </div>
        
		
    
    <div id="onecolumnbtm"></div>

</body>
</html>
