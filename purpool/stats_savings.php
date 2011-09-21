<?php

#################################################################
# Name: dashobard.php                                           #
# Author: John Kuiphoff                                         #
# Description: Allows users to view all purpool related info    #
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

// Start new session
session_start();

// Validate user
if(!$_SESSION['username'])
{
//	echo 'not validated';
}

// Get the workplace info
$sql = "SELECT endstate FROM";


// Calculate the savings in gas for the entire pool for one day
$sql = "SELECT user_id, DATE_FORMAT(rdate, '%Y-%m-%d') AS rdate FROM passengers WHERE pool_id = '{$_GET['pool']}' AND confirm = 'accept' ORDER BY rdate";
$result = $dbh->query($sql);
while($row = $result->fetchRow())
{
	// Get the number of passengers for the day
	$numpassengers = $result->numRows();
	
	// Get the distance and driver for the ride
	$sql2 = "SELECT driver, distance FROM rides WHERE pool_id = '{$_GET['pool']}' AND rdate = '{$row['rdate']}'";
	$row2 = $dbh->queryRow($sql2);
	
	// Extract the driver
	$driver = $row2['driver'];
	
	// Extract the distance
	$distance = $row2['distance'];
	
	// Get the current gas prices
	$sql3 = "SELECT 
	
	// Get the miles per gallon for each passenger 
	$sql3 = "SELECT vehiclempg, vehicleco2 FROM users WHERE user_id = '{$row['user_id']}'";
	$result3 = $dbh->query($sql3);
	while($row3 = $result3->fetchRow())
	{
		// Do not include the driver in the savings calculation
		if($row['user_id'] != $driver)
		{
			// Calculate the 
		}
	}

	
	echo $sql2 . "<br />";
	echo $row['rdate'] . ' - ' . $row2['driver'];
}
	
	// Calculate the saving in gas
	//$sql3 = "SELECT mpg
	
	
	
	/*
	// Get week number
	$weeknumber = date("W", 
	
	
	$datemonday = date("l, m/d/Y", strtotime("{$year}-W{$week}-1"));
	
	// Calculate days of week
	$datemonday = date("l, m/d/Y", strtotime("{$year}-W{$week}-1"));
	$datetuesday = date("l, m/d/Y", strtotime("{$year}-W{$week}-2"));
	$datewednesday = date("l, m/d/Y", strtotime("{$year}-W{$week}-3"));
	$datethursday = date("l, m/d/Y", strtotime("{$year}-W{$week}-4"));
	$datefriday = date("l, m/d/Y", strtotime("{$year}-W{$week}-5"));
	$datesaturday = date("l, m/d/Y", strtotime("{$year}-W{$week}-6"));
	$datesunday = date("l, m/d/Y", strtotime("{$year}-W{$week}-7"));
	
	
	// Get user_id
	$user_id = $row['user_id'];
	
	// Get miles per gallon
	$sql2 = "SELECT vehiclempg FROM users WHERE user_id = '$user_id'";
	$row2 = $dbh->queryRow($sql2);
	$milespergallon = $row2['vehiclempg'];
	
	// Get the driver for that day
	$sql2 = "SELECT driver FROM rides WHERE day = '$daynumber'";
	$row2 = $dbh->queryRow($sql2);
	$driver = $row2['driver'];
	
	// Check to see if the current user is the driver
	if($user_id != $driver)
	{
		$savings = $savings +  ($gasprice / $milespergallon) * $distance;
	}
	*/




?>