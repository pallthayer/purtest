<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script language="javascript" src="js/formfocus.js"></script>
<script language="javascript">AC_FL_RunContent = 0;</script>
<script src="js/AC_RunActiveContent.js" language="javascript"></script>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key={$google_key}" type="text/javascript"></script>
<script src="js/icons.js"></script>
<script language="javascript" src="js/route-viewer.js"></script>

<script type="text/javascript">

	var geopositions = '{$vertices}';
	var endlat = '{$endlat}';
	var endlng = '{$endlng}';
	var title ='{$title}';
	var workplace ='{$workplace}';

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
                    <li class="current"><a href="pools.php">{if $membermode}My Pools{else}View Pools{/if}</a></li>
                    <li><a href="pools.php?state=browsepools">Browse Pools</a></li>
                </ul>
            </div>
        </div>
        
            

        
		<div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
                
	        <h3 style="margin-bottom: 0">{$poolname}</h3>
            <div id="wizard">
                <ul>
                    <li class="first current"><a href="pools.php?state=viewprofile&pool={$pool_id}">Profile</a></li>
                    {if $editmode}<li><a href="pools.php?state=editschedule&pool={$pool_id}">Scheduler</a></li>{/if}
                    {if $membermode}<li><a href="pools.php?state=viewschedule&pool={$pool_id}">Upcoming Rides</a></li>{/if}
                    {if $membermode}<li><a href="pools.php?state=shoutbox&pool={$pool_id}">Shoutbox</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=editpool&pool={$pool_id}">Edit General</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=editmembers&pool={$pool_id}">Edit Members</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=viewroutes&pool={$pool_id}">Edit Routes</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=deletepool&pool={$pool_id}">Delete Pool</a></li>{/if}
                </ul>
            </div>
            
            {if $invitation}
            	<div class="yellowbox clear">
	            	You have been invited to join this pool. 
	            	<a href="pools.php?state=accept&pool={$pool_id}">Accept</a> <a href="pools.php?state=decline&pool={$pool_id}">Decline</a>
            	</div>
            {/if}
            
            {if $allowinvite eq true}
            	<div class="yellowbox clear">
	            	This pool is accepting new members. <a href="pools.php?state=requestinvite&pool={$pool_id}">Invitation Request</a> 
            	</div>
            {/if}
            
            {if $requestinvite eq true}
            	<div class="yellowbox clear">
	            	Your request has been received. Thank you! 
            	</div>
            {/if}
            
            <div class="innercolumn clear">
            <!-- Pool Profile -->
            
            <div id="map" class="userphoto"></div>
            
            
            
            <img src="icons/access.gif" class="icon" />{$access}<br />
            <div class="leftcell"><img src="icons/description.gif"  /></div><div class="rightcell">{$description}</div>
            <img src="icons/created.gif" class="icon" />{$createdate}<br /><br />
            
            <strong>Members ({$membercount})</strong><br />
            {section name=info loop=$members}
            	<div class="leftcell"><img src="icons/person.gif" /></div><div class="rightcell"><a href="profile.php?user={$members[info].user_id}">{$members[info].firstname}&nbsp;{$members[info].lastname}</a>  ({$members[info].occupation})</div>
            {/section}<br /><br />
            
            <strong>General Schedule <br />
            (May vary week-to-week):</strong><br />
            <table>
		{section name=info loop=$times}
			{$times[info].string}
	    	{/section}
	    </table>
            
            </div>
            <div class="innercolumn3" id="last">
            

            <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','657','height','255','src','visualizations/linechart/linechart','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','visualizations/linechart/linechart' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="640" height="255">
              <param name="movie" value="visualizations/linechart/linechart.swf" />
              <param name="quality" value="high" />
              <embed src="visualizations/linechart/linechart.swf" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="657" height="255"></embed>
            </object></noscript>
            </div>
            
            <div class="innercolumn">
	            <!-- Savings Information -->
                <img src="images/table1.gif" /><br/>
	            <table class="table1">
          			<tr class="tablehead">
          			<th>Cumulative Savings</th>
          			</tr>
          			<tr><td>
	            Gas Savings: {$poolgas}
	            	</td></tr>
          			<tr><td>
	            Miles not driven: {$poolmiles}
	            	</td></tr>
          			<tr><td>
	            Cars off road: {$poolcars}
	            	</td></tr>
          			<tr><td>
	            GH emissions savings: {$poolemissions}
	            	</td></tr>
	            	</table>
            </div>
            <div class="innercolumn">
            	<img src="images/table1.gif" /><br/>
	            <table class="table1">
          			<tr class="tablehead">
          			<th>This Week's Savings</th>
          			</tr>
          			<tr><td>
	            Gas Savings: {$weekpoolgas}</td></tr>
          			<tr><td>
	            Miles not driven: {$weekpoolmiles}</td></tr>
          			<tr><td>
	            Cars off road: {$weekpoolcars}</td></tr>
          			<tr><td>
	            GH emissions savings: {$weekpoolemissions}</td></tr>
	            </table>
			</div>
			
            <div class="clear"></div>
        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}     
        </div>


    
    <div id="onecolumnbtm"></div>

</body>
</html>
