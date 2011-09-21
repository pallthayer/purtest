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
		<h2>Savings</h2>
            <p>One of the benefits of the pools application is that in the process of scheduling, we collect information that can be used to calculate savings. These savings are calculated on an individual basis, for each of the pools, and for the entire workplace community and are displayed throughout the site in order to help members appreciate the immediate benefits of carpooling.  The site also has several dynamic visualizations that give individuals a better understanding of how their behaviors have real consequences on large-scale problems like reduction of emissions and oil consumption.  One of these visualizations stacks the savings of each pool on top of each other while another (above or below) encourages friendly competition among pools by creating a top ten list that is accompanied by a visualization of the network of routes pools use to drive to the workplace.</p>
            <div align="center"><img src="images/tour/savings_sc.png" width="500"/ ></div>
            
		  <div align="right" style="font-size:16pt"><a href="tour.php?state=cmap">Next:Community Map</a></div>

		</div>
        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}                    
        </div>
        
    </div>

    <div id="onecolumnbtm"></div>

</body>
</html>
