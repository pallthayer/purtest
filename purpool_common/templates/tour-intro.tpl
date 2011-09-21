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
        <div class="content">
        {include file="tournavigation.tpl"}
        <div class="tour_contents" >
		<h2>What is Purpool?</h2>
        <p>Purpool is a great tool for helping people set up and manage carpools . It is a 
        social networking site that centers on the commute and promotes ride-sharing as a community building activity.</p>
        <p>And since membeship is free, there's no reason not to explore further...</p>
        
		<p><a href="tour.php?state=people"><strong>People:</strong></a> Connect with people from your workplace </p>

		<p> <a href="tour.php?state=pools" ><strong>Pools:</strong></a> Find existing carpools in your area or create a new pool</p>
		
        <p><a href="tour.php?state=savings"><strong>Savings:</strong></a> View how your pool stacks up against others at Purchase and other visualizations</p>

		<p><a href="tour.php?state=cmap"><strong>Community Map:</strong></a> Check out or add local restaurants, parks, and other points of interest</p> 

		<p> <a href="tour.php?state=events"><strong>Events:</strong></a> See what's happening in your workplace community, or post a new event.</p>
		<br /><br />
		<a href="tour.php?state=people" style="font-size:16pt"><strong>Start Feature Tour >></strong></a><br /><br />

           <!-- <div align="center"><img src="images/tour/dashboard_sc.png" width="500"/ ></div> -->
        </div>

        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}                    
        </div>
        
    </div>

    <div id="onecolumnbtm"></div>

</body>
</html>
