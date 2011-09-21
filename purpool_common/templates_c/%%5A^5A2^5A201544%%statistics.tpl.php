<?php /* Smarty version 2.6.19, created on 2008-07-17 11:38:19
         compiled from statistics.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Purpool</title>

<link href="css/styles.css" rel="stylesheet" type="text/css" />

<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>

<script language="javascript" src="js/scriptaculous/src/scriptaculous.js"></script>

<script language="javascript" src="js/formfocus.js"></script>

<script language="javascript" src="js/indicator.js"></script>

</head>



<body>



	<!-- Header -->

    <div id="header">

    	

        <!-- Purpool Logo -->

        <img src="images/logo.gif" alt="Purpool" />

        

        <!-- Top Navigation -->

        <div id="topnav">

        	<ul>

            	<li><a href="index.php">Signout</a></li>

            </ul>

        </div>

        

    </div>

    

    <!-- Left Column -->

    <div id="leftcolumn">

    

    	<!-- Display User Photo -->

        <?php if ($this->_tpl_vars['userphoto']): ?>

        	<div id="userPhoto">

	        	<img src="users/<?php echo $this->_tpl_vars['userphoto']; ?>
" alt="" />

			</div>

        <?php endif; ?>

        

        <!-- Display User Information -->

        <div id="userInfo">

        	<?php echo $this->_tpl_vars['fullname']; ?>


        </div>

        

        <!-- User Options -->

        <ul id="leftnav">

        	<li><a href="admin.php" class="current">View My Rides</a></li>

        	<li><a href="admin.php?state=updateprofile">Update Profile</a></li>

            <li><a href="admin.php?state=createride">Create a Ride</a></li>

            <li><a href="admin.php?state=requestride">Request a Ride</a></li>

        </ul>

    

    </div>

    

    <!-- Right Column -->

    <div id="rightcolumn">

    

    	<!-- Page Title -->

        <h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>

        

        <!-- Tabs -->

        <div id="tabs">

        	<ul>

            	<li><a href="admin.php?state=manageride&ride=<?php echo $this->_tpl_vars['ride_id']; ?>
">Ride Information</a></li>

                <li><a href="admin.php?state=displaymap&ride=<?php echo $this->_tpl_vars['ride_id']; ?>
">Directions</a></li>

                <li class="current"><a href="admin.php?state=statistics&ride=<?php echo $this->_tpl_vars['ride_id']; ?>
">Savings</a></li>

            </ul>

        </div>

        

        <div style="margin-top: 75px"></div>

        

        <!-- Display Charts -->

        <img src="http://chart.apis.google.com/chart?cht=lc&chs=400x200&chd=s:ATSTaVd21981uocA&chco=224499&chxt=x,y&chxl=0:|Sep|Oct|Nov|Dec|1:||50|100&chm=B,76A4FB,0,0,0"/>

        

        <p><a href="http://code.google.com/apis/chart/">Google Chart API</a>: Maybe we can use this? It's very easy and relatively flexible.</p>

        

        

    </div>

    

    <!-- Clear -->

    <div style="clear: both;"></div>

    

    <!-- Indicator -->

    <img id="indicator" src="images/indicator.gif" alt="" style="display: none;"/>

    

</body>

</html>