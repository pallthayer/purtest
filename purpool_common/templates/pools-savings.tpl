<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects,controls"></script>
<script language="javascript">AC_FL_RunContent = 0;</script>
<script src="js/AC_RunActiveContent.js" language="javascript"></script>
</head>

<body>

	<!-- Header -->
    <div id="header">
    	<a href="{$site_url}" id="logo"><h1>Purpool</h1></a>
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
            <h2>{$poolname}</h2>
            
			<!-- Tabs -->
            <div id="tabs">
                <ul>
                    <li class="first"><a href="pools.php?state=viewprofile&pool={$pool_id}">Profile</a></li>
                    {if $editmode}<li><a href="pools.php?state=editpool&pool={$pool_id}">Edit General</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=editmembers&pool={$pool_id}">Edit Members</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=viewroutes&pool={$pool_id}">Edit Routes</a></li>{/if}
                    <li><a href="pools.php?state=viewschedule&pool={$pool_id}">Schedule</a></li>
                    <li><a href="pools.php?state=shoutbox&pool={$pool_id}">Shoutbox</a></li>
                    <li class="current"><a href="pools.php?state=viewsavings&pool={$pool_id}">Savings</a></li>
                </ul>
            </div>
            
        </div>
        
<div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
        
        	
            
            
            <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="700" height="550" id="linechart" align="middle">
	<param name="allowScriptAccess" value="sameDomain" />
	<param name="allowFullScreen" value="false" />
	<param name="movie" value="visualizations/linechart/linechart.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" />	<embed src="visualizations/linechart/linechart.swf" quality="high" bgcolor="#ffffff" width="700" height="550" name="linechart" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
	</object>
            
        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}             

        </div>


    
    <div id="onecolumnbtm"></div>

</body>
</html>
