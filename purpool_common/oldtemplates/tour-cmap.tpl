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
    	<a href="/" id="logo"><h1>Purpool</h1></a>
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

  
        <!-- Content -->

        <div class="content" >
		<!-- subnav -->
        {include file="tournavigation.tpl"}   
        <div class="tour_contents" >
		<h2>Community Map (cMap)</h2>
            <p>The Community Map (cMap) is a way for Purpool members to share points of interest with other members. Members can add points of interest to the community map, describing and sharing places that are meaningful to them in the region surrounding the workplace. This functionality provides a platform for exploring the local area, highlighting favorite places like restaurants, parks and shops that are close to work or may fall along members’ commuting routes.</p>
            <div align="center"><img src="images/tour/cmap_sc.png" width="500"/ ></div>
            
		  <div align="right" style="font-size:16pt"><a href="tour.php?state=events">Next: Events</a></div>

		</div>
        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}                    
        </div>
        
    </div>

    <div id="onecolumnbtm"></div>

</body>
</html>
