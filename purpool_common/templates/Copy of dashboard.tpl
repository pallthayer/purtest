<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script language="javascript" src="js/formfocus.js"></script>
<script language="javascript" src="js/dashboard.js"></script>
<script language="javascript" src="js/tooltips.js"></script>
<script language="javascript">
var daysOfTheWeek = Array('Sunday','Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
var months = Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November','December');
var now = new Date();
var today = daysOfTheWeek[now.getDay()] + ", " + months[now.getMonth()] + " " + now.getDate() + ", " + now.getFullYear();
</script>
</head>

<body onload="addToolTipListeners()">

	<!-- Header -->
    <div id="header">
    	<a href="{$site_url}" id="logo"><h1>Purpool</h1></a>
    </div>
    
    <!-- Top Navigation -->
   	{include file="topnavigation.tpl"}
    
    <!-- Content Bar -->
    <div id="contentbar">
        
		<!-- Page Heading -->
        <h2>Dashboard</h2>
            
    </div>
        
	<div id="onecolumntop"></div>
        
        <!-- Content -->
        <div class="content">
        	<h3>
            <!-- Today's date -->
            <script language="javascript">document.write(today)</script>
            </h3>
            {if $isnew}
            <div>
            	<h4 style="font-size:1.0em;">Welcome to Purpool! <a href="javascript:void(0);" onclick="document.getElementById('gettingstarted').style.display = 'block';">Need help getting started?</a></h4>
            	<div>
            		<ul id="gettingstarted" style="display:none;">
            			<li><a href="profile.php">Browse People</a> - Connect with people from your workplace!</li>
				<li><a href="pools.php?state=browsepools">Browse Pools</a> - Find existing carpools in your area</li>
				<li><a href="pools.php?state=createpool">Create Pool</a> - No pools for your workplace yet? Create one!</li>
				<li><a href="community-map.php">Community Map</a> - Check out local restaurants, parks, and other points of interest</li>
				<li><a href="events.php">Events</a> - See what's happening in your workplace community, or post a new event.</li>
				<li>Need more help? Visit our <a href="help.php?state=faq">FAQ</a> page.</li>
				<li style="list-style-type:none;"><a href="javascript:void(0);" onclick="document.getElementById('gettingstarted').style.display = 'none';">(hide this)</a>

            		</ul><br />
            	</div>
            </div>
            {/if}
        	<div class="innercolumn">
            	<img src="images/table1.gif" /><br/>
        	 	<table class="table1">
                    <tr class="tablehead">
                    	<th>What's New?</th>
                    	</tr>
	        		<!-- Newest Members -->
	     			<tr>
	     			<td>
					<strong>Newest Members</strong>	
					<br />
					<div id="members">
						<span id="memberlinks" style="margin:5px 0px 5px 0px;display:block;">
							{section name=info loop=$memberlinks}
								<img src="icons/person.gif" /> <a href="profile.php?state=viewprofile&user={$memberlinks[info].user_id}">{$memberlinks[info].name}</a><br />
							{/section}
						</span>
					</div>
			        	
			        </td>
			        </tr>
	        		<!-- Weather -->
	     			<tr>
	     			<td>
					<div class="leftcell"><img src="icons/weather.gif" class="icon"/></div>
					<div class="rightcell">
				            <div id="weather">
				                <span id="weatherstatus"></span>
				                <span id="weathertemp"></span>
				                <span id="weathertext"></span>
				            </div>
			        	</div>
			        </td>
			        </tr>
	             <!-- Invitiations -->
                {if $invitations}
                                                   {section name=info loop=$invitations}
			        <tr>
			        	<td class="alert">
                                    <div class="leftcell"><img src="icons/alert.gif" class="icon"/></div>
                                    <div class="rightcell">
                                        You have been invited to join <a href="pools.php?state=viewprofile&pool={$invitations[info].pool_id}">{$invitations[info].title}</a>
                                </div>
                                        </td>
                                        </tr>
                            {/section}
            	{/if}
                
                
                <!-- Requested Invitiations -->
                {if $requesters}
                	{section name=info loop=$requesters}
			        <tr>
			        	<td class="alert">
                        	<div class="leftcell"><img src="icons/alert.gif" class="icon"/></div>
                            <div class="rightcell">
                            	<a href="profile.php?state=viewprofile&user={$requesters[info].user_id}">{$requesters[info].firstname} {$requesters[info].lastname}</a> 
                                has requested to join your pool: {$requesters[info].title}<br />
                                <a href="pools.php?state=confirmrequest&pool={$requesters[info].pool_id}&user={$requesters[info].user_id}&confirm=accept">Accept</a> | 
                                <a href="pools.php?state=confirmrequest&pool={$requesters[info].pool_id}&user={$requesters[info].user_id}&confirm=decline">Decline</a> 
                            </div>
                        </td>
                     </tr>
                     {/section}
            	{/if}
                
                
                
                
                </table>
			</div>
			
			<div class="innercolumn">
           
           <!-- My Rides -->
                 <table class="table1">
                 	<img src="images/table1.gif" /><br/>
                    <tr class="tablehead"><th>My Rides</th></tr>
                    	{if $rides}
                            {section name=info loop=$rides}
                                <tr><td {if $rides[info].confirm eq ''}class="alert"{/if}>
                                
                                <div class="leftcell"><img src="icons/pools.gif" /></div><div class="rightcell"><a href="pools.php?state=viewprofile&pool={$rides[info].pool_id}">{$rides[info].title}</a></div>
                                <div class="clear"></div>
                                
                                <div class="rightcell">
                                    <a href="pools.php?state=viewitinerary&pool={$rides[info].pool_id}&rdate={$rides[info].rdate}">{$rides[info].ridedate}</a> 
                                </div>
                                <div class="clear"></div>
                                
                                
                                 {if $rides[info].confirm eq 'accept'}
                                    	<div class="leftcell"><img src="icons/confirmed.gif" title="Confirmed" /></div>
                                    	<div class="rightcell">
		                                    <span class="green"><a href="pools.php?state=viewschedule&pool={$rides[info].pool_id}">Confirmed</a></span> ({$rides[info].accepted}/{$rides[info].total} confirmed)
	                                    </div>                                 {/if}
                                    {if $rides[info].confirm eq 'decline'}
                                    	<div class="leftcell"><img src="icons/declined.gif" title="Declined" /></div>
                                    	<div class="rightcell">
		                                    <span class="red"><a href="pools.php?state=viewschedule&pool={$rides[info].pool_id}">Declined</a></span> ({$rides[info].accepted}/{$rides[info].total} confirmed)
	                                    </div>
                                    {/if}
                                    {if $rides[info].confirm eq ''}
                                    	<div class="leftcell"><a href="pools.php?state=viewschedule&pool={$rides[info].pool_id}"><img src="icons/unconfirmed.gif" title="Not Confirmed" /></a></div>
                                    	<div class="rightcell">
		                                    <span class="red"><a href="pools.php?state=viewschedule&pool={$rides[info].pool_id}">Awaiting Confirmation</a></span> ({$rides[info].accepted}/{$rides[info].total} confirmed)
	                                    </div>
                                    {/if}
                                
                                <div class="clear"></div>
                                </td></tr>
                            {/section}
                                
                        {else}
                        	<tr><td>No upcoming rides.</td></tr>
                        {/if}
                    
                    
                    
                    <!--<div class="tablerow">
                    </div>-->
                 </table>
            </div>
                             
				
           <div class="innercolumn" >
                <!-- Savings -->
                 <img src="images/table1.gif" /><br/>
                 <table class="table1">
                    <tr class="tablehead"><th>Savings</th></tr>
                    <tr><td>
                    <strong>My Savings Overall</strong><br />
	                Gas savings: {$usergas}<br />
	                Miles not driven <a name="milesnotdriven" class="tooltipClass" id="milesnotdriven"><img src="images/icon_tooltip.gif" border="0"/> </a>: {$usermiles}<br />
	                Cars off road <a name="carsoffroad" class="tooltipClass" id="carsoffroad"><img src="images/icon_tooltip.gif" border="0"/> </a>: {$usercars}<br />
	                Emissions savings <a name="emissions" class="tooltipClass" id="emissions"><img src="images/icon_tooltip.gif" border="0"/> </a>: {$useremissions} lbs
	                </td></tr>
	                                    <tr><td>
                    <strong>Global Savings Overall</strong><br />
	                Gas savings: {$workplacegas}<br />
	                Miles not driven: {$workplacemiles}<br />
	                Cars off road: {$workplacecars}<br />
	                Emissions savings: {$workplaceemissions} lbs
	                </td></tr>
	                
	                 <!--<tr><td>
                    <strong>This Week's Leaders</strong><br />
	                Gas savings: {$workplacegas}<br />
	                Miles not driven: {$workplacemiles}<br />
	                Cars off road: {$workplacecars}<br />
	                Emissions savings: {$workplaceemissions} lbs
	                </td></tr> -->
	                
	                
                </table>
           </div>
                
                 <div class="innercolumn" id="last">              
                <!-- Shoutbox -->
                <img src="images/table1.gif" /><br/>
                <table class="table1">
                    <tr class="tablehead"><th>Recent Shouts</th></tr>
                        {if $shouts}
                            {section name=info loop=$shouts}
                                <tr>
                                <td>
                                
                                <div class="leftcell"><img src="icons/shout.gif" /></div>
                                <div class="farrightcell">
                                	{$shouts[info].shoutdate}
                                </div>
                                
                                <div class="rightcell">
                                    <a href="profile.php?state=viewprofile&user={$shouts[info].user_id}">{$shouts[info].name}</a> (<a href="pools.php?state=shoutbox&pool={$shouts[info].pool_id}">{$shouts[info].title}</a>):
                                
                                    
                                    <br />
                                    {$shouts[info].message}
                                </div>
                                </td>
                                </tr>
                            {/section}
                        {else}
                        
                        	<tr><td>No one has left a shout recently.</td></tr>
                        {/if}
                 </table>
                 </div>

	
        	
           <div class="clear"></div> 
           {include file="bottomnavigation.tpl"}
           
    </div>    
    <div id="onecolumnbtm"></div>
	<div id="tooltip">&nbsp;</div>
</body>
</html>
