<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key={$google_key}" type="text/javascript"></script>

<script language="javascript" src="js/sorttable.js"></script>

<script type="text/javascript">

	var poolData = [
		{section name=info loop=$pools}
		{literal}{{/literal}
			'pool_id':'{$pools[info].pool_id}','location':'{$pools[info].latitude},{$pools[info].longitude}', 'zipcode':'{$pools[info].zipcode}'{literal}}{/literal},
		{/section}
		];
		
	var lat = '{$lat}';
	var lng = '{$lng}';
	var workplace ='{$workplace}';
</script>

{literal}
<script type="text/javascript">
	
	var type = "pool";
	
	// INITIAL EVENT LISTENERS
	document.observe("dom:loaded", function() 
	{
		
		if (GBrowserIsCompatible()) {
			loadGMap(lat, lng);
		}
	});
	
</script>
{/literal}

<script  language="javascript" src="js/icons.js"></script>
<script language="javascript1.3" src="js/browse.js"></script>

</head>

<body>

	<!-- Header -->
    <div id="header">
    	<a href="/" id="logo"><h1>Purpool</h1></a>
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
                    <li class="first"><a href="pools.php">My Pools</a></li>
                    <li class="current"><a href="pools.php?state=browsepools">Browse Pools</a></li>
                </ul>
            </div>

        
		<div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
        
        
            <h3>Browse Pools</h3>
            <div class="innercolumn2" style="height:375px;width:449px;overflow-x:hidden;overflow-y:scroll;">
            <!-- Displays pool ID -->
            <div id="list"></div>

            
            <div id="browsetable">
            	<img src="images/table2.gif" /><br/>
                <table class="table2 sortable" style="width:434px;">
                	<thead>
                        <tr class="tablehead">
                            <th id="first_col">Pool</th>
                            <th>Zip Code</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        {section name=info loop=$pools}
                            <tr>
                                <td class="nowrap"><a href="pools.php?state=viewprofile&pool={$pools[info].pool_id}">{$pools[info].title}</a>&nbsp;({$pools[info].nummembers})</td>
                                <td><a href="#" onclick="markerSelected('{$pools[info].zipcode}'); return false;">{$pools[info].zipcode}</a></td>
                                <td>{if $pools[info].description}{$pools[info].description}{else}&nbsp;{/if}</td>
                            </tr>
                        {/section}
                    </tbody>
                </table>
            </div>
			</div>
			
            <div class="innercolumn2" id="last" style="width:417px;">
            <!-- Map -->
            <div id="map" style="width: 417px; height: 370px;"></div>
            </div>
            
    	<div class="clear"></div>
        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}     
        </div>


    <div id="onecolumnbtm"></div>

</body>
</html>
