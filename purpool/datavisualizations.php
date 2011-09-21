<?php

#################################################################
# Name: register.php                                            #
# Author: John Kuiphoff                                         #
# Description: Allows users to register for purpool             #
#################################################################

// Include configuration file
include_once('config_path.php'); include_once($config_path.'config.php');

// Include common utility library
include_once($DIR['inc'] . 'Utils.class.php');

// Include database package
include_once($DIR['pear'] . 'MDB2.php');

// Include SMARTY templating engine
include_once($DIR['smarty'] . 'Smarty.class.php');

// Initialize database connection
$dbh = Utils::initDB();

// Initialize templating engine
$tpl = Utils::initTPL();$tpl->assign('site_url', $MISC['site_url']);

// Continue session
session_start();

// Default values
$gassavings = 0;
$emissionssavings = 0;
$carsoffroad = 0;

// Get users workplace
$sql = "SELECT workplace FROM users WHERE user_id = '{$_SESSION['user_id']}'";
$row = $dbh->queryRow($sql);

$workplace = $row['workplace'];

// Get users workplace information
$sql = "SELECT state FROM workplaces WHERE workplace_id = '$workplace'";
$row = $dbh->queryRow($sql);

$state = $row['state'];

// Get the users car and location information
$sql = "SELECT vehiclempg, vehicleco2 FROM users WHERE user_id = '{$_SESSION['user_id']}'";
$row = $dbh->queryRow($sql);

if($row)
{
	$mpg = $row['vehiclempg'];
	$co2 = $row['vehicleco2'];
} else {
	$mpg = 0;
	$co2 = 0;
}

echo 'Workplace: ' . $workplace . "<br />";
echo 'State: ' . $state . "<br />";
echo 'Mpg: ' . $mpg . "<br />";
echo 'Co2: ' . $co2 . "<br />";

// Get number of confirmed rides
$sql = "SELECT pool_id, DATE_FORMAT(rdate, '%v') AS week, DATE_FORMAT(rdate, '%Y') AS year, rdate FROM poolpassengers WHERE user_id = '{$_SESSION['user_id']}' AND confirm = 'accept'";
$result = $dbh->query($sql);
while($row = $result->fetchRow())
{
	$pool_id = $row['pool_id'];
	$rdate = $row['rdate'];
	$week = $row['week'];
	$year = $row['year'];
	
	echo 'Week: ' . $week . "<br />";
	echo 'Year: ' . $year . "<br />";
	
	// Get the pool itinerary information
	$sql2 = "SELECT driver, route FROM poolitineraries WHERE pool_id = '$pool_id' AND rdate = '$rdate'";
	$row2 = $dbh->queryRow($sql2);
	
	$driver = $row2['driver'];
	$route = $row2['route'];
	
	echo 'Route: ' . $route . "<br />";
	echo 'Driver: ' . $driver . "<br />";
	
	// Get route distance
	$sql3 = "SELECT distance FROM poolroutes WHERE route_id = '{$row2['route']}'";
	$row3 = $dbh->queryRow($sql3);
	
	// Clean distance (1 meter = 0.000621371192 miles)
	$distance = round($row3['distance'] * 0.000621371192);
	
	echo 'distance: ' . $distance . "<br />";
	
	// Get week number and year that rdate occurs on
	$gasdate = $week . '|' . $year;
	
	// Get gas prices for the week
	$sql4 = "SELECT $state AS gasprices FROM gasprices WHERE uploaddate = '$gasdate'";
	$row4 = $dbh->queryRow($sql4);
	
	// Clean gas data (get 'regular' price)
	$gasprices = explode(",", $row4['gasprices']);
	$gasprice = $gasprices[0];
	
	echo 'Gas price: ' . $gasprice . "<br />";
	
	// Determine if user has driven
	if($driver != $_SESSION['user_id'])
	{
		// Calculate savings in gas
		$gassavings = $gassavings + ($distance * ($gasprice / $mpg));
		
		// Calculate savings
		$emissionssavings = $emissonssavings + ($distance * $co2);
		
		// Calculate miles not driven
		$milesnotdriven = $milesnotdriven + $distance;
		
		$carsoffroad++;
	}
}

echo '-----' . "<br /><br />";
echo 'Savings in gas: ' . '$' . number_format($gassavings, 2) . "<br />";
echo 'Miles not driven: ' . $milesnotdriven . "<br />";
echo 'Cars off the road: ' . $carsoffroad . "<br />";
echo 'Savings in co2: ' . $emissionssavings . "<br />";


?>

<!--

<week start="10/5/2008" end="10/11/2008" number="46">
		<savings_in_gas>11.49</savings_in_gas>
		<miles_not_driven>234</miles_not_driven>
		<cars_off_the_road>11</cars_off_the_road>
		<savings_in_co2>212</savings_in_co2>
	</week>
    
    poolitineraries
    ------
    pool_id  	mediumint(8)  	 	  	No  	0  	 	  Browse distinct values   	  Change   	  Drop   	  Primary   	  Unique   	  Index   	 Fulltext
	day 	varchar(25) 	latin1_swedish_ci 		No 	0 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	driver 	mediumint(9) 			No 	0 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	route 	mediumint(9) 			No 	0 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	rdate 	datetime 			No 	0000-00-00 00:00:00 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	dm_time 	time 			Yes 	NULL 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	aw_time 	time 			Yes 	NULL 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	dw_time 	time 			Yes 	NULL 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	notes
    
    poolpassengers
    ------
    passenger_id  	mediumint(8)  	 	  	No  	 	auto_increment  	  Browse distinct values   	  Change   	  Drop   	  Primary   	  Unique   	  Index   	 Fulltext
	pool_id 	mediumint(8) 			No 	0 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	user_id 	mediumint(8) 			No 	0 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	confirm 	varchar(25) 	latin1_swedish_ci 		Yes 	NULL 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	rdate
    
    
    -->