<?php /* Smarty version 2.6.19, created on 2008-08-16 08:25:01
         compiled from pools-map.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Purpool</title>

<link href="css/styles.css" rel="stylesheet" type="text/css" />

<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>

<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects,controls"></script>

<script language="javascript" src="js/formfocus.js"></script>

<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAA_2hDlr8GGBfE4xaODwzMdBTXq9fpoqsVDQwusP8wnl1JoF5PeRRah3cG9ATfaTXFHd6W2kdTXUmoow" type="text/javascript"></script>

<script language="javascript1.3" src="http://www.purpool.com/po/googlemaps/js/routemaker.js"></script>



</head>



<body>



	<!-- Header -->

    <div id="header">

    	<img src="images/logo.jpg" alt="Purpool" />

    </div>

    

    <!-- Top Navigation -->

    <div id="topnav">

    	<ul>

        	<li><a href="authenticate.php?state=signout">Signout</a></li>

		</ul>

    </div>

    

    <!-- Left Column -->

    <div id="leftcolumn">

    	

        <!-- Side Navigation -->

        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "sidenavigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>



    </div>



	<!-- Right Column -->

    <div id="rightcolumn">

    

    	<!-- Content Bar -->

        <div id="contentbar">

        

            <!-- Page Heading -->

            <h1>Pools</h1>

            

			<!-- Tabs -->

            <div id="tabs">

                <ul>

                    <li class="first"><a href="pools.php?state=editpool&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">General</a></li>

                    <li><a href="pools.php?state=editmembers&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Members</a></li>

                    <li><a href="pools.php?state=viewschedule&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Schedule</a></li>

                    <li class="current"><a href="pools.php?state=viewmap&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Map</a></li>

                    <li><a href="pools.php?state=viewsavings&pool=<?php echo $this->_tpl_vars['pool_id']; ?>
">Savings</a></li>

                </ul>

            </div>

            

        </div>

        

        <!-- Content -->

        <div id="content">

        	

            <div id="map" style="width: 400px; height: 300px; margin-top: 35px">

            </div>

            <?php echo '

			<script>

            if (GBrowserIsCompatible()) {

                loadGMap();

            }

            </script>

            

            <script>

            //var geolocations = \'["41.09247,-73.63456", "41.09979,-73.56382"]\';

            var geopositions = \'["41.2206,-73.81359", "41.159012,-73.754654", "41.097206,-73.725128", "41.052949,-73.722382", "41.0192,-73.69905"]\';

            //alert(geolocations.evalJSON());

            //drawDirections(geopositions.evalJSON());

            

            var start="16 Macbean Drive,New Fairfield,CT";

            var end="730 Anderson Hill Road, Purchase, NY";

            

            //addStreetAddressToRoute(start);

            //addStreetAddressToRoute(end);

            addStartAndEndStreetAddressToRoute(start, end);

              

            

            </script>

            '; ?>


            <br>

            <!--<div><input type="button" value="Click for Directions" onClick="document.getElementById('directions').innerHTML=getDirectionsInJSON();"> -->

            <div><input type="button" value="Click for Directions" onClick="getTextDirections();">

            <input type="button" value="Undo Clear Waypoint" onClick="undo();">

            <input type="button" value="Clear" onClick="clearMyOverlays();">

            <input type="button" value="Click for Vertices" onClick="getVertices();">

            <input type="button" value="Save to Server" onClick="savetoserver();">

            </div>

            

            </div>

            <div id="directions"></div>



        </div>

        

    </div>





</body>

</html>