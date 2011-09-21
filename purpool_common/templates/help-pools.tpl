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
                    <li class="current"><a href="help.php?state=faq">FAQ</a></li>
                    <li><a href="help.php?state=tour">Tour</a></li>
                    <li><a href="help.php?state=privacy">Privacy Policy</a></li>
                    <li><a href="help.php?state=tos">Terms of Service</a></li>
                </ul>
            </div>

        
<div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
<h2>Pools</h2>
<p>
<a name="1"><h3>What is a pool?</h3>
</a> 
A pool is a group of people who carpool on a regular or semi-regular basis. Purpool provides a number of features that facilitate setting up and maintaining pools including a scheduling application, a confirmation process, and automatic email itineraries.
</p>

<p>
<a name="2"><h3>How do I find other people to carpool with?</h3></a> 
Purpool allows you to search for other members of your workplace community who live in your area using a map interface as well as an alphabetical index. You can view their profiles and decide if you want to explore carpooling with them. Then one of you can create a pool and invite the others in order to get the ball rolling. You can also search and join existing pools in your area.
</p>


<p>
<a name="3"><h3>How can I create a pool? </h3>
</a> 
Purpool provides a wizard-like interface for creating a pool. After entering some basic info you can invite members, create an initial schedule, and create routes for your pool. When you and the other members of your pool have agreed on a tentative schedule you can go ahead and set up the daily rides by entering driver, route and time info. This will trigger the confirm process which requires members to confirm their participation in individual rides and avoids confusion about who is driving and where you are meeting.
</ul>
</p>

<p>
<a name="4"><h3>What is the difference between a public and private pool?</h3></a> 
Public pools allow workplace community members to request to join.Private pools do not have an option to request to join. 
</p>


<p>
<a name="5"><h3>How do I modify my pool's schedule?</h3></a> 
You can modify the recurring schedule as long as you are the pool leader. Go to the Schedule page in the pools application to modify the schedule. Once you save changes you will still need to go to the Rides page and enter driver/route/time info.
</p>

<p>
<a name="6"><h3>How do I set up my pool's daily rides?</h3>
</a> 
Once you have saved a tentative recurring schedule Purpool automatically sets up daily rides templates for you on the Rides page. You can view the daily rides on a weekly basis from the current week on. After you save the driver/route/times info for each ride the other members of your pool can confirm their participation and view the itinerary.
</p>


<p>
<a name="7"><h3>Can there be more than one pool leader? </h3></a> 
At the moment this is not possible. This is a feature we will introduce in the near future.
</p>

<p>
<a name="8"><h3>How do I create and customize a route?</h3></a> 
Purpool provides a route creation tool.  You can enter the starting point of your route by typing in the address  or by clicking on the map provided. A route to your workplace should appear on the map. You can customize your route by dragging and releasing. At anytime you can clear the map to start over. (Be sure to save your route.)
</p>

<p>
<a name="9"><h3>Why do I have to confirm each ride?</h3></a> 
This helps make the pool function better as it makes it simple for pool members to communicate with other members about their plans. It also allows us to calculate your savings automatically.
</p>

<p>
<a name="10"><h3>What happens if I don't confirm a ride?</h3>
</a> 
You will receive a reminder 48 hours before the scheduled ride. If you don't confirm it will be assumed that you are not participating the ride.
</p>

<p>
<a name="11">
<h3>When is the itinerary sent to my email address?</h3>
</a> 
24 hours before the scheduled ride. It can also be viewed at any time online.
</p>

<p>
<a name="12"><h3>What is a shout? </h3></a> 
A shout is a short message that is sent to other members of your pool
</p>

<p>
<a name="13"><h3>How does Purpool determine whose turn it is to drive? </h3></a> 
One of the challenges in coordinating a pool is deciding whose turn it is to drive. Purpool makes this easy by assigning drivers automatically. The pool leader chooses (on the Edit General page) from three assignment strategies: 
<ol>
<li>a single default driver (useful when one person does all the driving);</li> 
<li>the driver is assigned by day of the week based on one-time input from the pool leader; </li>
<li>the driver is assigned by a fairness algorithm: Each pool member has a driver score.
The score for each passenger increases by 1/n  points when n people participate in a
carpool. This reflects the amount the passenger &quot;owes&quot; the driver. Scores accumulate over time and the algorithm assigns the driver to be the participant with the largest score.

</li>
</ol>

</p>

        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}                    
        </div>
        
    </div>

    <div id="onecolumnbtm"></div>

</body>
</html>