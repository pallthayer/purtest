<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects,controls"></script>

<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key={$google_key}" type="text/javascript"></script>
<script src="js/icons.js"></script>
<script language="javascript" src="js/route-viewer.js"></script>

{literal}

<script type="text/javascript">
function html_entity_decode(s) {
	var t=document.createElement('textarea');
	t.innerHTML = s;
	var v = t.value;
	t.hide();
	return v;
}
</script>

{/literal}

<script type="text/javascript">

	var workplace = '{$workplace}';
	var geopositions = '{$vertices}';
	var endlat = '{$endlat}';
	var endlng = '{$endlng}';
	var title = html_entity_decode('{$title}');

</script>

{literal}
<script type="text/javascript">

// INITIAL EVENT LISTENERS
document.observe("dom:loaded", function() 
{
	if (GBrowserIsCompatible()) 
	{
		loadGMap(endlat, endlng);
		drawDirections(geopositions.evalJSON());
	}
});

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
                    <li class="current"><a href="pools.php?state=viewschedule&pool={$pool_id}">Upcoming Rides</a></li>
                    <li><a href="pools.php?state=shoutbox&pool={$pool_id}">Shoutbox</a></li>
                    {if $editmode}<li><a href="pools.php?state=editpool&pool={$pool_id}">Edit General</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=editmembers&pool={$pool_id}">Edit Members</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=viewroutes&pool={$pool_id}">Edit Routes</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=deletepool&pool={$pool_id}">Delete Pool</a></li>{/if}
                </ul>
            </div>
        
        	
            <div class="innercolumn2 clear">
            <!-- Pool Itinerary -->
            <h4>General Information</h4>
            Date: {$rdate}<br />
            Driver: {$driver}<br />
            Depart from meeting place or home: {$dm_hour}:{$dm_minute}{$dm_ampm}<br />
			Arrive at Workplace: {$aw_hour}:{$aw_minute}{$aw_ampm}<br />
			Depart from Workplace: {$dw_hour}:{$dw_minute}{$dw_ampm}<br />
			Additional Notes: {if $notes}{$notes}{else}---{/if}<br /><br />
            
            <h4>Route Information</h4>

            Title: {$title}<br />
            Distance: {$distance} Miles<br />
            {if $startaddress}
            	Start Address: {$startaddress} {$startcity} {$startstate} {$startzip}<br />
                End Address: {$endaddress} {$endcity} {$endstate} {$endzip}<br />
            {/if}
            {if $description}
            	Description: {$description}<br />
            {/if}
            <br />
            
            <h4>Members</h4>
            {section name=info loop=$members}
            	<a href="profile.php?state=viewprofile&user={$members[info].user_id}">{$members[info].firstname} {$members[info].lastname}</a> - 
                {if $members[info].confirm eq 'accept'}
                	<span class="green">Accepted</span>
                {/if}
                {if $members[info].confirm eq 'decline'}
                	<span class="red">Declined</span>
                {/if}
                {if $members[info].confirm eq ''}
                	<span class="red">Not yet confirmed</span>
                {/if}
                <br />
            {/section}
            </div>

            <div class="innercolumn2" id="last">
            <div id="map" style="width: 100%; height: 400px;"></div>
            </div>
            <div class="clear"></div>
        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}     
        </div>


    
    <div id="onecolumnbtm"></div>

</body>
</html>
