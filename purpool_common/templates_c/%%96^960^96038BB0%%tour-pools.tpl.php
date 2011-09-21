<?php /* Smarty version 2.6.19, created on 2010-03-23 10:18:27
         compiled from tour-pools.tpl */ ?>
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

<body onload="window.location.hash = '#'+<?php echo $this->_tpl_vars['anchor']; ?>
";>

	<!-- Header -->
    <div id="header">
    	<a href="/" id="logo"><h1>Purpool</h1></a>
    </div>
    
	<!-- Top Navigation -->
   	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "topnavigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

    
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
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tournavigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>     
        <div class="tour_contents" >
		<h2>Pools</h2>
            <p>A pool is a group of people who carpool on a regular or semi-regular basis . You can see if there are existing pools in your area using either the map interface or the pool list, which can be sorted by name or zip code. If none are available you can create your own pool!</p>
			<p>You can zoom and pan the map to center it on the geographic area where you live. The markers on the map represent zip codes where there are active pools. When you click on a marker the pools in that zip code are listed to the left of the map. Click on a pool name to see the pool profile.
</p>
            <div align="center"><img src="images/tour/pools_sc.png" width="500"/ ></div><br /><br />
            <p>The pool profile includes links to member profiles, the pools’ recurring schedule, and savings data.</p>
            <div align="center"><img src="images/tour/poolprofile_sc.png" width="500"/ ></div><br /><br />
           
            
            <h3>Joining an Existing Pool</h3>
<p>You can request, or accept an invitation, to join an existing pool. After joining you can communicate with other pool members using the Shoutbox, a bulletin board like interface intended for short messages (“can’t carpool this Wednesday”, “can we leave at 5:30 today?”)  you want to share with other pool members</p>
			<div align="center"><img src="images/tour/poolmember_sc.png" width="500"/ ></div><br /><br />
           <p> The Upcoming Rides page is where pool members accept/decline daily rides set up by the pool leader (see below). This facilitates communication among pool members and also allows Purpool to calculate your savings which are displayed on the profile pages and in the Savings visualizations. </p>
           <p> You will receive a reminder to confirm email 48 hours in advance of a scheduled ride if you haven’t accepted/declined, and an itinerary email 24 hours in advance of a ride.</p>
           
           <h3>Creating a New Pool</h3>
           	<p>Purpool provides a wizard-like interface for creating a pool. After entering some basic info you can invite members, create an initial schedule, and create routes for your pool.</p>
		<div align="center"><img src="images/tour/createpool_sc.png" width="500"/ ></div><br /><br />
        
            <h3>Administering a Pool</h3>
           	<p>The pool leader administers the pool. This includes
				<ul>
                	<li>Creating route(s) and weekly schedule for Pool;</li>
 					<li>Inviting new pool members and removing members who are no longer active;</li>
   					<li>Confirming the details of each Pool ride for the upcoming week, and encourage members to accept/decline for each ride;</li>
                    <li>Selecting the method that Purpool uses to assign drivers automatically. The pool leader chooses (on the Edit General page) from three assignment methods: 
<ol>
<li>a single default driver (useful when one person does all the driving);</li> 
<li>the driver is assigned by day of the week based on one-time input from the pool leader; </li>
<li>the driver is assigned by a fairness algorithm: Each pool member has a driver score.
The score for each passenger increases by 1/n  points when n people participate in a
carpool. This reflects the amount the passenger &quot;owes&quot; the driver. Scores accumulate over time and the algorithm assigns the driver to be the participant with the largest score.

</li>
</ol></li>
    				<li>Giving another member leader status to help you fulfill or take over your leader duties.</li>
                </ul>
</p>
		<div align="center"><img src="images/tour/upcomingrides_sc.png" width="500"/ ></div><br /><br />       
        

			<p>After you save (&quot;finalize&quot;) the driver/route/times info for each ride the other members of your pool can confirm their participation and view the itinerary. (Note: Pool members are listed inthe dropdown in the order of whose turn it is to drive based on the Purpool fairness.)</p>
            <p>Members receive email a reminder to confirm 48 hours in advance of a scheduled ride and an itinerary email 24 hours in advance of a ride.</p>
            <div align="center"><img src="images/tour/viewdetails_sc.png" width="500"/ ></div><br /><br />       

      
		  <div align="right" style="font-size:16pt"><a href="tour.php?state=savings">Next: Savings</a></div>

		</div>
        <!-- Bottom Navigation Bar -->
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "bottomnavigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>                    
        </div>
        
    </div>

    <div id="onecolumnbtm"></div>

</body>
</html>