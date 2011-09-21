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

// Include common utility library
include_once($DIR['inc'] . 'visdata.php');

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
// Check for workplace admin
if($_SESSION['isworkplaceadmin'] == 1) { 
	$tpl->assign('adminmode', 1);
	$tpl->assign('hidetopnav', true);
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

		// Get user's workplace
		$sql = "SELECT workplace FROM users WHERE user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);

		// Get workplace savings
		$workplace = $row['workplace'];

		// Get current date
		$currentdate = date("Y") . '-' . date("m") . '-' . date("d");

		// Get announcements
		$sql = "SELECT
					announcement,
					DATE_FORMAT(startdate, '%Y-%m-%d') AS startdate,
					DATE_FORMAT(enddate, '%Y-%m-%d') AS enddate
				FROM
					announcements
				WHERE
					workplace = '$workplace' OR workplace = 'all'
				ORDER BY
					startdate";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			if(($row['startdate'] <= $currentdate) && ($row['enddate'] >= $currentdate))
			{
				// Create announcements array
				$announcements[] = array(
					'announcement' => $row['announcement']
				);
			}
		}
		$tpl->assign('announcements', $announcements);

		//Get newest users (in workplace who have activated their account within the last 30 days)
		$sql = "SELECT
					user_id,
					firstname,
					lastname
				FROM
					users
				WHERE
					hasloggedin = '1' AND workplace = '{$workplace}' AND DATEDIFF(CURDATE(), registerdate) < 30
				ORDER BY
					registerdate
				DESC LIMIT 5";
		$result = $dbh->query($sql);
		//$memberlinks = "";
		while($row = $result->fetchRow())
		{
			$memberlinks[] = array(
				'user_id' => $row['user_id'],
				'name' => $row['firstname']." ".$row['lastname']
			);
		}
		$tpl->assign('memberlinks', $memberlinks);


		//Check if user is new (has registered in the last three weeks)
		$sql = "SELECT
					user_id
				FROM
					users
				WHERE
					user_id = '{$_SESSION['user_id']}' AND DATEDIFF(CURDATE(), registerdate) < 21";
		$result = $dbh->query($sql);
		if($result->numRows() > 0) $isnew = true;
		else $isnew = false;
		$tpl->assign('isnew', $isnew);

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

		// Get request invitations
		$sql = "SELECT pool_id FROM poolmembers WHERE user_id = '{$_SESSION['user_id']}' AND role = 'owner'";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			$sql2 = "SELECT request_id, user_id FROM poolsrequestinvite WHERE pool_id = '{$row['pool_id']}' AND status = 'pending'";
			$result2 = $dbh->query($sql2);
			while($row2 = $result2->fetchRow())
			{
				// Get requesters name
				$sql3 = "SELECT firstname, lastname FROM users WHERE user_id = '{$row2['user_id']}'";
				$row3 = $dbh->queryRow($sql3);

				// Get pool name
				$sql4 = "SELECT title FROM pools WHERE pool_id = '{$row['pool_id']}'";
				$row4 = $dbh->queryRow($sql4);

				// Create requesters array
				$requesters[] = array(
					'request_id' => $row2['request_id'],
					'user_id' => $row2['user_id'],
					'pool_id' => $row['pool_id'],
					'firstname' => $row3['firstname'],
					'lastname' => $row3['lastname'],
					'title' => $row4['title']
				);
			}
		}
		$tpl->assign('requesters', $requesters);

		// Get user savings
		$usersavings = getUserSavings($_SESSION['user_id']);

		$tpl->assign('usergas', $usersavings['gas']);
		$tpl->assign('usermiles', $usersavings['miles']);
		$tpl->assign('usercars', $usersavings['cars']);
		$tpl->assign('useremissions', $usersavings['emissions']);

		// Get user's workplace
		$sql = "SELECT workplace FROM users WHERE user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		$tpl->assign('workplace', $row['workplace']);

		// Get workplace savings
		$workplacesavings = getWorkplaceSavings($row['workplace']);

		$tpl->assign('workplacegas', $workplacesavings['gas']);
		$tpl->assign('workplacemiles', $workplacesavings['miles']);
		$tpl->assign('workplacecars', $workplacesavings['cars']);
		$tpl->assign('workplaceemissions', $workplacesavings['emissions']);

		// Get all pools that user belongs to
		$sql = "SELECT pool_id FROM poolmembers WHERE user_id = '{$_SESSION['user_id']}'";

		$result = $dbh->query($sql);

		while($row = $result->fetchRow())
		{
			// Get pool title
			$sql4 = "SELECT title FROM pools WHERE pool_id = '{$row['pool_id']}'";
			$row4 = $dbh->queryRow($sql4);

			// Get current date
			$currentdate = date("Y") . '-' . date("m") . '-' . date("d");

			// Get day specifics
				$sql6 = "SELECT
							DATE_FORMAT(rdate, '%M %d, %Y') AS ridedate,
							DATE_FORMAT(rdate, '%Y-%m-%d') AS rdate
						FROM
							poolitineraries
						WHERE
							pool_id = '{$row['pool_id']}' AND rdate >= '$currentdate' AND route != '' AND driver != ''
						ORDER BY
							rdate
						LIMIT 5";
				$result6 = $dbh->query($sql6);
				while($row6 = $result6->fetchRow())
				{

					// Check to see if the user has confirmed
					$sql7 = "SELECT confirm FROM poolpassengers WHERE pool_id = '{$row['pool_id']}' AND rdate = '{$row6['rdate']}' AND user_id = '{$_SESSION['user_id']}'";
					$row7 = $dbh->queryRow($sql7);

					$sql8  = "SELECT confirm FROM poolpassengers WHERE pool_id = '{$row['pool_id']}' AND rdate = '{$row6['rdate']}'";
					$result8 = $dbh->query($sql8);
					$totalmembers = $result8->numRows();

					$sql8  = "SELECT confirm FROM poolpassengers WHERE pool_id = '{$row['pool_id']}' AND rdate = '{$row6['rdate']}' AND confirm = 'accept'";
					$result8 = $dbh->query($sql8);
					$acceptedmembers = $result8->numRows();

					$rides[] = array(
						'pool_id' => $row['pool_id'],
						'title' => $row4['title'],
						'ridedate' => $row6['ridedate'],
						'rdate' => $row6['rdate'],
						'confirm' => $row7['confirm'],
						'accepted' => $acceptedmembers,
						'total' => $totalmembers
					);
				}








			/*
			// Cycle through dates and get ride specifics
			foreach($weekdates AS $day => $date)
			{
				// Get day specifics
				$sql6 = "SELECT
							DATE_FORMAT(rdate, '%M %d, %Y') AS ridedate
						FROM
							poolitineraries
						WHERE pool_id = '{$row['pool_id']}' AND rdate = '$date' AND route != '' AND driver != ''";
				$row6 = $dbh->queryRow($sql6);

				// Create rides array
				if($row6)
				{
					// Check to see if the user has confirmed
					$sql7 = "SELECT confirm FROM poolpassengers WHERE pool_id = '{$row['pool_id']}' AND rdate = '$date' AND user_id = '{$_SESSION['user_id']}'";
					$row7 = $dbh->queryRow($sql7);

					$sql8  = "SELECT confirm FROM poolpassengers WHERE pool_id = '{$row['pool_id']}' AND rdate = '$date'";
					$result8 = $dbh->query($sql);
					$totalmembers = $result->numRows();

					$sql8  = "SELECT confirm FROM poolpassengers WHERE pool_id = '{$row['pool_id']}' AND rdate = '$date' AND confirm = 'accept'";
					$result8 = $dbh->query($sql);
					$acceptedmembers = $result->numRows();

					$rides[] = array(
						'pool_id' => $row['pool_id'],
						'title' => $row4['title'],
						'ridedate' => $row6['ridedate'],
						'rdate' => $date,
						'confirm' => $row7['confirm'],
						'accepted' => $acceptedmembers,
						'total' => $totalmembers
					);
				}
			}
			*/
			// Get shouts
			$sql2 = "SELECT shout_id, user_id, message, DATE_FORMAT(shoutdate, '%M %d, %Y') AS date FROM poolshouts WHERE pool_id = '{$row['pool_id']}' AND DATEDIFF(CURDATE(), shoutdate) < 30 ORDER BY shoutdate DESC LIMIT 3";
			$result2 = $dbh->query($sql2);
			while($row2 = $result2->fetchRow())
			{
				// Get name of shouter
				$sql3 = "SELECT user_id, firstname, lastname FROM users WHERE user_id = '{$row2['user_id']}'";
				$row3 = $dbh->queryRow($sql3);

				//Peter (5/3/2009: replaced  'message' => htmlentities($row2['message']), with the following
				$shouts[] = array(
					'pool_id' => $row['pool_id'],
					'title' => $row4['title'],
					'user_id' => $row3['user_id'],
					'name' => $row3['firstname'] . ' ' . $row3['lastname'],
					'message' => $row2['message'],
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
