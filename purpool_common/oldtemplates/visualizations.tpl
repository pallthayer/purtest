<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />

<script language="javascript">AC_FL_RunContent = 0;</script>
<script src="js/AC_RunActiveContent.js" language="javascript"></script>
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects,controls"></script>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key={$google_key}"
      type="text/javascript"></script>
<script language="javascript1.3" src="js/route_vis.js"></script>
<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript">
    swfobject.embedSWF("leaders.swf", "leaders", "760", "420", "9.0.0");
</script>
{literal}




{/literal}
<script type="text/javascript">
	var json = {$json};
	var latitude = "{$latitude}";
	var longitude =  "{$longitude}";
</script>

</head>

<body>

	<!-- Header -->
    <div id="header">
    	<a href="/" id="logo"><h1>Purpool</h1></a>
    </div>
    
	<!-- Top Navigation -->
   		{include file="topnavigation.tpl"}
    
    <!-- Left Column 
    <div id="leftcolumn">
    	
        {include file="sidenavigation.tpl"}

    </div>
    //-->

	
    
    	<!-- Content Bar -->
        <div id="contentbar">
        
            <!-- Page Heading -->
            <h2>Savings</h2>
            
            <!-- Tabs -->
            <div id="tabs">
                <ul>
                    <li class="first current"><a href="visualizations.php?state=monthly">Monthly Top Ten</a></li>
                    <!--<li><a href="visualizations.php?state=overall">Overall Top Ten</a></li> -->
                    <li><a href="visualizations.php?state=stackedchart">Global Savings</a></li>
                </ul>
            </div>

        </div>
        
<div id="tabtop"></div>
        <!-- Content -->
        <div class="content" style="position: relative">
            
			
            
            
            
            
            
            
            
                    	<div id="map" style="position:absolute; top:5px;left:10px	; width: 340px; height: 370px; visibility:hidden">
</div> 

						<div id="leaders">
								<p>A Flash-based visualization of the top ten pools: </p>
						</div>

            
            
            
            
            
            
        </div>

	<div class="clear"></div>
    
    <div id="onecolumnbtm"></div>

</body>
</html>
