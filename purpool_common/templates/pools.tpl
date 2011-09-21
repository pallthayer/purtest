<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script language="javascript" src="js/formfocus.js"></script>
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
            
        </div>
        
        <!-- Tabs -->
            <div id="tabs">
                <ul>
                    <li class="first current"><a href="pools.php">My Pools</a></li>
                    <li><a href="pools.php?state=browsepools">Browse Pools</a></li>
                </ul>
            </div>

        
<div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
        	
            
            <!-- Current Pools -->
            <h3>My Pools</h3>
            
            
            
            {if $pools}
            	<img src="images/table4.gif" /><br/>
                <table class="table4">
                    <tr class="tablehead">
                        <th>Pool</th>
                        <th>Members</th>
                        <th>Rides</th>
                        <th width="370">Recent Shouts</th>
                    </tr>
                    {section name=info loop=$pools}
                        <tr>
                            <td class="nowrap"><a href="pools.php?state=viewprofile&pool={$pools[info].pool_id}">{$pools[info].title}</a></td>
                            <td>
                            	{section name=info2 loop=$pools[info].members}
                            		<a href="profile.php?state=viewprofile&user={$pools[info].members[info2].user_id}">{$pools[info].members[info2].firstname} {$pools[info].members[info2].lastname}</a><br />
                                {/section}
                            </td>
                            <td class="nowrap">
                            	{if $pools[info].rides}
                                    {section name=info3 loop=$pools[info].rides}
                                            <a href="pools.php?state=viewitinerary&pool={$pools[info].rides[info3].pool_id}&rdate={$pools[info].rides[info3].rdate}">{$pools[info].rides[info3].ridedate}</a> <br />
                                            {if $pools[info].rides[info3].confirm eq 'accept'}
                                                <div class="leftcell"><img src="icons/confirmed.gif" title="Confirmed" /></div>
                                    	<div class="rightcell">
		                                    <span class="green"><a href="pools.php?state=viewschedule&pool={$pools[info].rides[info3].pool_id}">Confirmed</a></span>
	                                    </div>                  
                                            {/if}
                                            {if $pools[info].rides[info3].confirm eq 'decline'}
                                                <div class="leftcell"><img src="icons/declined.gif" title="Declined" /></div>
                                    	<div class="rightcell">
		                                    <span class="red"><a href="pools.php?state=viewschedule&pool={$pools[info].rides[info3].pool_id}">Declined</a></span>
	                                    </div>
                                            {/if}
                                            {if $pools[info].rides[info3].confirm eq ''}
                                               <div class="leftcell"><a href="pools.php?state=viewschedule&pool={$rides[info].pool_id}"><img src="icons/unconfirmed.gif" title="Not Confirmed" /></a></div>
                                    	<div class="rightcell">
		                                    <span class="red"><a href="pools.php?state=viewschedule&pool={$pools[info].rides[info3].pool_id}">Awaiting Confirmation</a></span>
	                                    </div>
                                            {/if}
                                    {/section}
                                {else}
                                    No rides scheduled yet.
                                {/if}
                            </td>
                            <td>
                            	{if $pools[info].shouts}
                                    {section name=info3 loop=$pools[info].shouts}
                                        <a href="profile.php?state=viewprofile&user={$pools[info].shouts[info3].user_id}">{$pools[info].shouts[info3].name}</a> ({$pools[info].shouts[info3].shoutdate}):<br />
                                        {$pools[info].shouts[info3].message}<br /><br />
                                    {/section}
                                {else}
                                	No one&rsquo;s left a shout yet.
                                {/if}
                            </td>
                            <!--
                            <td>
                                <img src="icons/delete_small.gif" class="icon" /><a href="pools.php?state=deletepool&pool={$pools[info].pool_id}">Delete</a>
                            </td>
                            -->
                        </tr>
                    {/section}
                </table>
            {else}
                <div class="yellowbox">You currently do not belong to any pools.</div>
            {/if}
            
            <!-- Pool Buttons -->
            <div class="btn_container" >
            
                <!-- Create New Pool -->
                <span class="btn">
                  
                    <a href="pools.php?state=createpool"><img src="icons/add.gif" alt ="" class="icon" />Create Pool</a>
                </span>
                
            
            </div>
			<div class="clear"></div>
        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}     
        </div>


    
    <div id="onecolumnbtm"></div>

</body>
</html>
