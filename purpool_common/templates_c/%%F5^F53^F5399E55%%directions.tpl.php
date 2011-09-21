<?php /* Smarty version 2.6.19, created on 2008-07-17 11:38:14
         compiled from directions.tpl */ ?>
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

<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAA0lWAhm-rLPPM1nyhoD7CwRRCcwunDFQGazm2Lv0-bORZDEWy9hT1lZWeA6kqEL2HQEPhoKEL3Uwksg" type="text/javascript"></script>



<script type="text/javascript">

	var string = "<?php echo $this->_tpl_vars['startaddress']; ?>
 to <?php echo $this->_tpl_vars['endaddress']; ?>
";

</script>



<?php echo '

<script type="text/javascript">



    var map;

    var directionsPanel;

    var directions;



    function initialize() {

      map = new GMap2(document.getElementById("map_canvas"));

      map.setCenter(new GLatLng(40.271424,-74.782868), 15);



		// Add controls

		map.addControl(new GLargeMapControl());

 		var mapControl = new GMapTypeControl();

		map.addControl(mapControl);





      directionsPanel = document.getElementById("route");

      directions = new GDirections(map, directionsPanel);

      directions.load(string);



	  

    }



</script>

'; ?>


</head>



<body onload="initialize()">



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

                <li class="current"><a href="admin.php?state=displaymap&ride=<?php echo $this->_tpl_vars['ride_id']; ?>
">Directions</a></li>

                <li><a href="admin.php?state=statistics&ride=<?php echo $this->_tpl_vars['ride_id']; ?>
">Savings</a></li>

            </ul>

        </div>

        

        <div style="margin-top: 75px"></div>

        

        <!-- Display Map -->

        <div id="map_canvas" style="width: 75%; height: 400px;"></div>

        <div id="route"></div>

        

        

    </div>

    

    <!-- Clear -->

    <div style="clear: both;"></div>

    

    <!-- Indicator -->

    <img id="indicator" src="images/indicator.gif" alt="" style="display: none;"/>

    

</body>

</html>