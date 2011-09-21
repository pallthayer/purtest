<?php

ini_set('display_errors', 1);

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
	header("Location: index.php");
}

// Switch state
switch($_GET['state'])
{
	# TOTAL USER SAVINGS
	case "totalusersavings":
	
		// Default values for my savings
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
				// Calculate savings in gas and emissions
				if($mpg == 0)
				{
					$gassavings = $gassavings + 0;
					$emissionssavings = $emissionssavings + 0;
				} else {
					$gassavings = $gassavings + ($distance * ($gasprice / $mpg));
					$emissionssavings = $emissonssavings + ($distance * $co2);
				}
				
				// Calculate miles not driven
				$milesnotdriven = $milesnotdriven + $distance;
				
				$carsoffroad++;
			}
			
			
		}
		
		// Format gas savings
		$gassavings = '$' . number_format($gassavings, 2);
		
		$tpl->assign('mygassavings', $gassavings);
		$tpl->assign('mymilesnotdriven', $milesnotdriven);
		$tpl->assign('mycarsoffroad', $carsoffroad);
		$tpl->assign('myemissionssavings', $emissionssavings);
		
		echo 'Gas savings: ' . $gassavings . "<br />";
		echo 'Miles not driven: ' . $milesnotdriven . "<br />";
		echo 'Cars off road: ' . $carsoffroad . "<br />";
		echo 'Emissions: ' . $emissionssavings . "<br />";
	
	break;
	
	# TOTAL WORKPLACE SAVINGS
	case "totalworkplacesavings":
	
		// Default values for my savings
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
		
		// Get all users that belong to the workplace
		$sql9 = "SELECT user_id FROM users WHERE workplace = '$workplace'";
		$result9 = $dbh->query($sql9);
		while($row9 = $result9->fetchRow())
		{
			// Current user_id
			$user_id = $row9['user_id'];
	
			// Get the users car and location information
			$sql = "SELECT vehiclempg, vehicleco2 FROM users WHERE user_id = '$user_id'";
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
			$sql = "SELECT pool_id, DATE_FORMAT(rdate, '%v') AS week, DATE_FORMAT(rdate, '%Y') AS year, rdate FROM poolpassengers WHERE user_id = '$user_id' AND confirm = 'accept'";
			$result = $dbh->query($sql);
			while($row = $result->fetchRow())
			{
				$pool_id = $row['pool_id'];
				$rdate = $row['rdate'];
				$week = $row['week'];
				$year = $row['year'];
				
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
				if($driver != $user_id)
				{
					// Calculate savings in gas and emissions
					if($mpg == 0)
					{
						$gassavings = $gassavings + 0;
						$emissionssavings = $emissionssavings + 0;
					} else {
						$gassavings = $gassavings + ($distance * ($gasprice / $mpg));
						$emissionssavings = $emissonssavings + ($distance * $co2);
					}
					
					// Calculate miles not driven
					$milesnotdriven = $milesnotdriven + $distance;
					
					$carsoffroad++;
				}
	
			}
	
		}
		
		// Format gas savings
		$gassavings = '$' . number_format($gassavings, 2);
		
		$tpl->assign('mygassavings', $gassavings);
		$tpl->assign('mymilesnotdriven', $milesnotdriven);
		$tpl->assign('mycarsoffroad', $carsoffroad);
		$tpl->assign('myemissionssavings', $emissionssavings);
		
		echo 'Gas savings: ' . $gassavings . "<br />";
		echo 'Miles not driven: ' . $milesnotdriven . "<br />";
		echo 'Cars off road: ' . $carsoffroad . "<br />";
		echo 'Emissions: ' . $emissionssavings . "<br />";
	
	break;
	
	# DISPLAY DASHBOARD
	default:
	
		
	break;
}

?>