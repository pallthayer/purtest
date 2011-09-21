<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script language="javascript" src="js/formfocus.js"></script>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key={$google_key}" type="text/javascript"></script>
<script language="javascript" src="js/icons.js"></script>
<script language="javascript" src="js/cmap.js"></script>

{literal}

<script type="text/javascript">
	
	// INITIAL EVENT LISTENERS
	document.observe("dom:loaded", function() 
	{
		
		// Load Map
        if (GBrowserIsCompatible()) {
            loadGMap();
        }
		
		// Listen for form submission
		Event.observe('myform', 'submit', searchPost);
	
	});
	
	// Search Post
	function searchPost(e)
	{
		// Prevent form submission
		Event.stop(e);
		
		// Send AJAX request
		var url = 'community-map.php?state=searchpoi';
		var params = Form.serialize('myform');
		var ajax = new Ajax.Request( url, { method: 'post', postBody: params, onSuccess: searchResponse }); 
	}
	
	// Search Response
	function searchResponse(resp)
	{
		// Obtain JSON response
		var json = resp.responseText.evalJSON();
		
		// Clear markers and redraw with new JSON
		showMarkersById(json);
		
		
		
	}
	
</script>

{/literal}

<script type="text/javascript">

var mode="browse"; //edit or browse
var endlat = {$workplacelat};
var endlng = {$workplacelng};
var workplace = "{$workplacetitle}";

var poiData = {$poiData};

</script>

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
        <h2>Community Map</h2>
        
    </div>
        
    <!-- Tabs -->
    <div id="tabs">
        <ul>
            <li class="first current"><a href="community-map.php">Browse cMap</a></li>
            <li><a href="community-map.php?state=editpoi">Add/Edit Points of Interest</a></li>
        </ul>
    </div>
      
	<div id="tabtop"></div>
        
        <!-- Content -->
        <div class="content">
        	
            
            <!-- Display Map -->
            <div id="map" style="width: 400px; height: 400px; float: right; margin-top: 50px"></div>
            
            
            <!-- Display Keywords -->
            <h3>Keywords</h3>
            
            <!-- Search box -->
            <div id="searchtags" style="margin-bottom: 25px">
            	<form id="myform">
                	<input id="search" name="search" type="text" class="textbox" />
                    <input id="submit" name="submit" type="submit" value="Search" class="submit" />
                    (by member name, title, tag, location)
                </form>
            </div>
            
            <div id="list">
                {if $taglist}
                	<a href="#" onclick="showMarkersByTag('all'); return false;" style="font-size: 20pt">All</a> | 
                    {section name=info loop=$taglist}
                        <a href="#" onclick="showMarkersByTag('{$taglist[info].tag}'); return false;" style="font-size: {$taglist[info].size}">{$taglist[info].tag}</a>
                    {/section}
                {/if}
            </div>
              
                               
			<div class="clear"></div>
        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}     
        </div>

    <div id="onecolumnbtm"></div>

</body>
</html>
