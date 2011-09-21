<?php /* Smarty version 2.6.19, created on 2008-07-17 14:40:14
         compiled from viewride.tpl */ ?>
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

<script language="javascript" src="js/admin.js"></script>

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

        	<li><a href="admin.php">View My Rides</a></li>

        	<li><a href="admin.php?state=updateprofile">Update Profile</a></li>

            <li><a href="admin.php?state=createride">Create a Ride</a></li>

            <li><a href="admin.php?state=requestride" class="current">Request a Ride</a></li>

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

            	<li class="current"><a href="admin.php?state=viewride&ride=<?php echo $this->_tpl_vars['ride_id']; ?>
">Ride Information</a></li>

                <li><a href="admin.php?state=displaymap&ride=<?php echo $this->_tpl_vars['ride_id']; ?>
">Map</a></li>

                <li><a href="admin.php?state=passengers&ride=<?php echo $this->_tpl_vars['ride_id']; ?>
">Passengers</a></li>

            </ul>

        </div>

        

        <div style="margin-top: 75px"></div>

        

        <!-- Show Ride Information -->

        <table class="horizontal" cellspacing="0">

        	<tr>

            	<th>Ride Title</th>

                <td><?php echo $this->_tpl_vars['ridetitle']; ?>
</td>

            </tr>

            <tr>

            	<th>Ride Type</th>

                <td>

                	<?php if ($this->_tpl_vars['ridetype'] == 'round'): ?>Round Trip<?php endif; ?>

					<?php if ($this->_tpl_vars['ridetype'] == 'oneway'): ?>One Way<?php endif; ?>

                </td>

            </tr>

            <tr>

            	<th>Available Seats</th>

                <td><?php echo $this->_tpl_vars['availableseats']; ?>
</td>

            </tr>

            <tr>

            	<th>Ride Title</th>

                <td><?php echo $this->_tpl_vars['ridetitle']; ?>
</td>

            </tr>

            <tr>

            	<th>Frequency</th>

                <td><?php echo $this->_tpl_vars['ridefrequency']; ?>
</td>

            </tr>

            <tr>

            	<th>Days</th>

                <td>

                	<?php if ($this->_tpl_vars['sunday']): ?>Su <?php endif; ?>

                    <?php if ($this->_tpl_vars['monday']): ?>M <?php endif; ?>

                    <?php if ($this->_tpl_vars['tuesday']): ?>Tu <?php endif; ?>

                    <?php if ($this->_tpl_vars['wednesday']): ?>W<?php endif; ?>

                    <?php if ($this->_tpl_vars['thursday']): ?>Th<?php endif; ?>

                    <?php if ($this->_tpl_vars['friday']): ?>F<?php endif; ?>

                    <?php if ($this->_tpl_vars['saturday']): ?>Sa<?php endif; ?>

                </td>

            </tr>

            <tr>

            	<th>Depart</th>

                <td>

                	<?php echo $this->_tpl_vars['startaddress1']; ?>
<br />

                    <?php if ($this->_tpl_vars['rstartaddress2']): ?><?php echo $this->_tpl_vars['startaddress2']; ?>
<br /><?php endif; ?>

                    <?php echo $this->_tpl_vars['startcity']; ?>
 <?php echo $this->_tpl_vars['startstate']; ?>
, <?php echo $this->_tpl_vars['startzip']; ?>


                </td>

            </tr>

            <tr>

            	<th>Destination</th>

                <td>

                	<?php echo $this->_tpl_vars['endaddress1']; ?>
<br />

                    <?php if ($this->_tpl_vars['endaddress2']): ?><?php echo $this->_tpl_vars['endaddress2']; ?>
<br /><?php endif; ?>

                    <?php echo $this->_tpl_vars['endcity']; ?>
 <?php echo $this->_tpl_vars['endstate']; ?>
, <?php echo $this->_tpl_vars['endzip']; ?>


                </td>

            </tr>

            <?php if ($this->_tpl_vars['additionalinfo']): ?>

                <tr>

                    <th>Additional Information</th>

                    <td><?php echo $this->_tpl_vars['additionalinfo']; ?>
</td>

                </tr>

            <?php endif; ?>

        </table>

        

    </div>

    

    <!-- Clear -->

    <div style="clear: both;"></div>

    

    <!-- Indicator -->

    <img id="indicator" src="images/indicator.gif" alt="" style="display: none;"/>

    





</body>

</html>