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

<body onload="window.location.hash = '#'+{$anchor}";>

	<!-- Header -->
    <div id="header">
    	<a href="{$site_url}" id="logo"><h1>Purpool</h1></a>
    </div>
    
	<!-- Top Navigation -->
   	{include file="topnavigation.tpl"}

    
    	<!-- Content Bar -->
        <div id="contentbar">
        
            <!-- Page Heading -->
            <h2>Help</h2>
            
        </div>
        
        <!-- Tabs -->
            <div id="tabs">
                <ul>
                    <li class="first"><a href="help.php?state=about">About</a></li>
                    <li ><a href="help.php?state=faq">FAQ</a></li>
                    <li class="current"><a href="help.php?state=tour">Tour</a></li>
                    <li><a href="help.php?state=privacy">Privacy Policy</a></li>
                    <li><a href="help.php?state=tos">Terms of Service</a></li>
                </ul>
            </div>

        
<div id="tabtop"></div>

		<!-- subnav -->
        
        <!-- Content -->
        <div class="content" >
         {include file="tournavigation.tpl"}    
        <div class="tour_contents" >
		<h2>People</h2>
            <p>You can connect with people from your workplace who live in your area using either the map 			interface or the member list, which can be sorted by name or zip code.</p>
   		  <p>You can zoom and pan the map to center it on the geographic area where you live. The markers on the map represent zip codes where Purpool members live. When you click on a marker, the people at your workplace who have joined Purpool and who live in that zip code are listed to the left of the map. Click on a name to see their profile. Contact them by email or phone or create a pool and invite them to join.</p>
            <div align="center"><img src="images/tour/people_sc.png" width="500"/ ></div>
            
		  <div align="right" style="font-size:16pt"><a href="tour.php?state=pools">Next: Pools</a></div>

		</div>
        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}                    
        </div>
        
    </div>

    <div id="onecolumnbtm"></div>

</body>
</html>
