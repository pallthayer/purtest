<?php

#################################################################
# Name: linechart.php                                           #
# Author: John Kuiphoff                                         #
# Description: Calculates savings for an individual user        #
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

$xml = '<?xml version="1.0" encoding="UTF-8"?>';
$xml = $xml . '<savings>';

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

// Get number of confirmed rides
$sql = "SELECT pool_id, DATE_FORMAT(rdate, '%v') AS week, DATE_FORMAT(rdate, '%Y') AS year, rdate FROM poolpassengers WHERE user_id = '{$_SESSION['user_id']}' AND confirm = 'accept'";
$result = $dbh->query($sql);
while($row = $result->fetchRow())
{
	$pool_id = $row['pool_id'];
	$rdate = $row['rdate'];
	$week = $row['week'];
	$year = $row['year'];
	
	// Get date of week start
	$datemonday = date("m/d/Y", strtotime("{$year}-W{$week}-1"));
    $datesunday = date("m/d/Y", strtotime("{$year}-W{$week}-7"));
	
	if($lastvalue != $datemonday)
	{
		// Reset values
		$gassavings = 0;
		$emissionssavings = 0;
		$milesnotdriven = 0;
		$carsoffroad = 0;
	}
	
	// Get the pool itinerary information
	$sql2 = "SELECT driver, route FROM poolitineraries WHERE pool_id = '$pool_id' AND rdate = '$rdate'";
	$row2 = $dbh->queryRow($sql2);
	
	$driver = $row2['driver'];
	$route = $row2['route'];
	
	// Get route distance
	$sql3 = "SELECT distance FROM poolroutes WHERE route_id = '{$row2['route']}'";
	$row3 = $dbh->queryRow($sql3);
	
	// Clean distance (1 meter = 0.000621371192 miles)
	$distance = round($row3['distance'] * 0.000621371192);

	// Get week number and year that rdate occurs on
	$gasdate = $week . '|' . $year;
	
	// Get gas prices for the week
	$sql4 = "SELECT $state AS gasprices FROM gasprices WHERE uploaddate = '$gasdate'";
	$row4 = $dbh->queryRow($sql4);
	
	// Clean gas data (get 'regular' price)
	$gasprices = explode(",", $row4['gasprices']);
	$gasprice = $gasprices[0];
	
	// Determine if user has driven
	if($driver != $_SESSION['user_id'])
	{
		
		// Calculate savings in gas
		$gassavings = $gassavings + ($distance * ($gasprice / $mpg));
		$gassavingsweek[$datemonday] = $gassavings;
	
		// Calculate savings
		$emissionssavings = $emissonssavings[$datemonday] + ($distance * $co2);
		$emissionssavingsweek[$datemonday] = $emissionssavings;
		
		// Calculate miles not driven
		$milesnotdriven = $milesnotdriven[$datemonday] + $distance;
		$milesnotdrivenweek[$datemonday] = $milesnotdriven;
		
		// Calculate cars off road
		$carsoffroad++;
		$carsoffroadweek[$datemonday] = $carsoffroad;
		
		$weekstart2[$datemonday] = $datemonday;
		$weekend2[$datemonday] = $datesunday;
		$week2[$datemonday] = $week;
		
		$lastvalue = $datemonday;
	} 
}

foreach ($gassavingsweek as $key => $value)
{
	$savings[$key] = array(
		'weekstart' => $weekstart2[$key],
		'weekend' => $weekend2[$key],
		'week' => $week2[$key],
		'gas' =>  number_format($value, 2),
		'miles' => $milesnotdrivenweek[$key],
		'car' => $carsoffroadweek[$key],
		'emissions' => $emissionssavingsweek[$key]
	);
	
	// Print XML
	$xml = $xml . '<week start="' . $savings[$key]['weekstart'] . '" end="' . $savings[$key]['weekend'] . '" number="' . $savings[$key]['week'] . '">';
	$xml = $xml . '<savings_in_gas>' . $savings[$key]['gas'] . '</savings_in_gas>';
	$xml = $xml . '<miles_not_driven>' . $savings[$key]['miles'] . '</miles_not_driven>';
	$xml = $xml . '<cars_off_the_road>' . $savings[$key]['car'] . '</cars_off_the_road>';
	$xml = $xml . '<savings_in_co2>' . $savings[$key]['emissions'] . '</savings_in_co2>';
	$xml = $xml . '</week>';
}

$xml = $xml . '</savings>';

$xml = '<?xml version="1.0" encoding="UTF-8"?>
<savings>
	<week start="10/5/2008" end="10/11/2008" number="46">
		<savings_in_gas>11.49</savings_in_gas>
		<miles_not_driven>234</miles_not_driven>
		<cars_off_the_road>11</cars_off_the_road>
		<savings_in_co2>212</savings_in_co2>
	</week>
	<week start="10/12/2008" end="10/18/2008" number="47">
		<savings_in_gas>15.36</savings_in_gas>
		<miles_not_driven>276</miles_not_driven>
		<cars_off_the_road>14</cars_off_the_road>
		<savings_in_co2>302</savings_in_co2>
	</week>
	<week start="10/19/2008" end="10/25/2008" number="46">
		<savings_in_gas>16.32</savings_in_gas>
		<miles_not_driven>312</miles_not_driven>
		<cars_off_the_road>14</cars_off_the_road>
		<savings_in_co2>242</savings_in_co2>
	</week>
	<week start="10/25/2008" end="11/1/2008" number="47">
		<savings_in_gas>15.45</savings_in_gas>
		<miles_not_driven>282</miles_not_driven>
		<cars_off_the_road>10</cars_off_the_road>
		<savings_in_co2>265</savings_in_co2>
	</week>
	<week start="11/2/2008" end="11/8/2008" number="46">
		<savings_in_gas>17.54</savings_in_gas>
		<miles_not_driven>304</miles_not_driven>
		<cars_off_the_road>13</cars_off_the_road>
		<savings_in_co2>300</savings_in_co2>
	</week>
	<week start="11/9/2008" end="11/15/2008" number="47">
		<savings_in_gas>15.36</savings_in_gas>
		<miles_not_driven>276</miles_not_driven>
		<cars_off_the_road>14</cars_off_the_road>
		<savings_in_co2>302</savings_in_co2>
	</week>
	<week start="11/16/2008" end="11/22/2008" number="46">
		<savings_in_gas>11.49</savings_in_gas>
		<miles_not_driven>234</miles_not_driven>
		<cars_off_the_road>11</cars_off_the_road>
		<savings_in_co2>212</savings_in_co2>
	</week>
	<week start="11/23/2008" end="11/29/2008" number="47">
		<savings_in_gas>4.43</savings_in_gas>
		<miles_not_driven>112</miles_not_driven>
		<cars_off_the_road>4</cars_off_the_road>
		<savings_in_co2>102</savings_in_co2>
	</week>
	<week start="11/30/2008" end="12/06/2008" number="46">
		<savings_in_gas>11.49</savings_in_gas>
		<miles_not_driven>234</miles_not_driven>
		<cars_off_the_road>11</cars_off_the_road>
		<savings_in_co2>212</savings_in_co2>
	</week>
	<week start="12/07/2008" end="12/13/2008" number="47">
		<savings_in_gas>15.36</savings_in_gas>
		<miles_not_driven>276</miles_not_driven>
		<cars_off_the_road>14</cars_off_the_road>
		<savings_in_co2>302</savings_in_co2>
	</week>
	<week start="12/14/2008" end="12/20/2008" number="46">
		<savings_in_gas>17.24</savings_in_gas>
		<miles_not_driven>434</miles_not_driven>
		<cars_off_the_road>16</cars_off_the_road>
		<savings_in_co2>212</savings_in_co2>
	</week>
	<week start="12/21/2008" end="12/27/2008" number="47">
		<savings_in_gas>15.36</savings_in_gas>
		<miles_not_driven>276</miles_not_driven>
		<cars_off_the_road>14</cars_off_the_road>
		<savings_in_co2>302</savings_in_co2>
	</week>
</savings>';

header('content-type: text/xml'); 
echo $xml;




?>

