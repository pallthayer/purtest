<?php

#################################################################
# Name: dashobard.php                                           #
# Author: John Kuiphoff                                         #
# Description: Allows users to view all purpool related info    #
#################################################################

// Include configuration file
//include_once('/home/41684/domains/purpool.com/common/includes/config.php');

// Include common utility library
include_once($DIR['inc'] . 'Utils.class.php');

// Include database package
include_once($DIR['pear'] . 'MDB2.php');

// Include SMARTY templating engine
include_once($DIR['smarty'] . 'Smarty.class.php');

// Initialize database connection
$dbh = Utils::initDB();

// Initialize templating engine
$tpl = Utils::initTPL();

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
	# GET WEATHER FORECAST
	case "getweather":
	
		// Load in XML file)
		$xml = simplexml_load_file("http://weather.yahooapis.com/forecastrss?p=08628");
		
		// Get the current condition from the XML file
		$condition = $xml->xpath('//yweather:condition');
		
		// Assign template variables
		$tpl->assign('code', $condition[0]['code']);
		$tpl->assign('temp', $condition[0]['temp']);
		$tpl->assign('text', $condition[0]['text']);
		
		// Build JSON array
		$json = array(
			"status" => "success",
			"code" => $condition[0]['code'],
			"temp" => $condition[0]['temp'],
			"text" => $condition[0]['text']
		);
		
		// Output response to browser
		$output = json_encode($json);
		echo $output;
		
		// Disconnect from database
		$dbh->disconnect();
		exit();	
	
	break;
	
	# DISPLAY DASHBOARD
	default:
	
		// Assign pagetitle
		$tpl->assign('pagetitle', 'Dashboard');
		
		// Assign current side navigation
		$tpl->assign('dashboardcurrent', true);
		
		// Assign full name
		$tpl->assign('fullname', $_SESSION['fullname']);
		
		// Define current week and year (for rides)
		$week = date('W');
		$year = date('Y');
		
		// Calculate full dates
		$fulldatemonday = date("Y-m-d", strtotime("{$year}-W{$week}-1"));
		$fulldatetuesday = date("Y-m-d", strtotime("{$year}-W{$week}-2"));
		$fulldatewednesday = date("Y-m-d", strtotime("{$year}-W{$week}-3"));
		$fulldatethursday = date("Y-m-d", strtotime("{$year}-W{$week}-4"));
		$fulldatefriday = date("Y-m-d", strtotime("{$year}-W{$week}-5"));
		$fulldatesaturday = date("Y-m-d", strtotime("{$year}-W{$week}-6"));
    	$fulldatesunday = date("Y-m-d", strtotime("{$year}-W{$week}-7"));
		
		// Create weekdates array
		$weekdates = array(
						'monday' => $fulldatemonday, 
						'tuesday' => $fulldatetuesday, 
						'wednesday' => $fulldatewednesday, 
						'thursday' => $fulldatethursday, 
						'friday' => $fulldatefriday, 
						'saturday' => $fulldatesaturday, 
						'sunday' => $fulldatesunday
					);
	
		// Get invitations
		$sql = "SELECT
					a.pool_id AS pool_id,
					a.title AS title
				FROM
					pools a, poolmembers b
				WHERE
					a.pool_id = b.pool_id AND b.user_id = '{$_SESSION['user_id']}' AND b.status = 'pending'
				ORDER BY
					a.title";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			$invitations[] = array(
				'pool_id' => $row['pool_id'],
				'title' => $row['title']
			);
		}
		$tpl->assign('invitations', $invitations);
		
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
				// Calculate savings in gas
				if($mpg == 0)
				{
					$gassavings = $gassavings + 0;
				} else {
					$gassavings = $gassavings + ($distance * ($gasprice / $mpg));
				}
				
				// Calculate savings
				$emissionssavings = $emissonssavings + ($distance * $co2);
				
				// Calculate miles not driven
				$milesnotdriven = $milesnotdriven + $distance;
				
				$carsoffroad++;
			}
			
			// Format gas savings
			$gassavings = '$' . number_format($gassavings, 2);
		}
		
		$tpl->assign('mygassavings', $gassavings);
		$tpl->assign('mymilesnotdriven', $milesnotdriven);
		$tpl->assign('mycarsoffroad', $carsoffroad);
		$tpl->assign('myemissionssavings', $emissionssavings);
		
		// Get all pools that user belongs to
		$sql = "SELECT pool_id FROM poolmembers WHERE user_id = '{$_SESSION['user_id']}'";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			// Get pool title
			$sql4 = "SELECT title FROM pools WHERE pool_id = '{$row['pool_id']}'";
			$row4 = $dbh->queryRow($sql4);
			
			// Cycle through dates and get ride specifics
			foreach($weekdates AS $day => $date)
			{
				// Get day specifics
				$sql6 = "SELECT 
							route,
							DATE_FORMAT(dm_time, '%k:%i') AS dm,
							DATE_FORMAT(aw_time, '%k:%i') AS aw,
							DATE_FORMAT(dw_time, '%k:%i') AS dw,
							DATE_FORMAT(rdate, '%M %d, %Y) AS ridedate
							notes
						FROM 
							poolitineraries 
						WHERE pool_id = '{$row['pool_id']}' AND rdate = '$date'";
				$row6 = $dbh->queryRow($sql6);
				
				// Get route name
				$sql7 = "SELECT title FROM poolroutes WHERE route_id = '{$row6['route']}'";
				$row7 = $dbh->queryRow($sql7);
				
				// Create rides array
				if($row6)
				{
					$rides[] = array(
						'title' => $row4['title'],
						'rdate' => $row6['ridedate'],
						'route' => $row7['title']
					);	
				}
			}
			
			// Get shouts
			$sql2 = "SELECT shout_id, user_id, message, DATE_FORMAT(shoutdate, '%M %d, %Y') AS date FROM poolshouts WHERE pool_id = '{$row['pool_id']}' ORDER BY shoutdate DESC LIMIT 3";
			$result2 = $dbh->query($sql2);
			while($row2 = $result2->fetchRow())
			{
				// Get name of shouter
				$sql3 = "SELECT user_id, firstname, lastname FROM users WHERE user_id = '{$row2['user_id']}'";
				$row3 = $dbh->queryRow($sql3);
				
				$shouts[] = array(
					'pool_id' => $row['pool_id'], 
					'title' => $row4['title'],
					'user_id' => $row3['user_id'],
					'name' => $row3['firstname'] . ' ' . $row3['lastname'],
					'message' => htmlentities($row2['message']),
					'shoutdate' => $row2['date']
				);
			}
		}
		$tpl->assign('shouts', $shouts);
		$tpl->assign('rides', $rides);		
	
		// Display Template
		$tpl->display('dashboard.tpl');
		
		// Disconnect from database
		$dbh->disconnect();
		exit();	
	
	break;
}

?>
