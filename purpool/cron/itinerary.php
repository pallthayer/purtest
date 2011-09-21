<?php

#################################################################
# Name: cron_gasprices.php                                      #
# Author: Peter Gordenstein                                     #
# Description: Uploads current gas prices into database		    #
#################################################################

// Include configuration file
include_once('../config_path.php');
include_once($config_path.'config.php');

// Include common utility library
include_once($DIR['inc'] . 'Utils.class.php');

// Include database package
include_once($DIR['pear'] . 'MDB2.php');

// Initialize database connection
$dbh = Utils::initDB();

// Get the date for today
$today = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
$today = date("Y-m-d", $today);

// Get the date for tomorrow
$tomorrow = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
$tomorrow = date("Y-m-d", $tomorrow);

$sql = "SELECT pool_id FROM pools ORDER BY title";
$result = $dbh->query($sql);
$message='';
while($row = $result->fetchRow())
{
	// Get itinerary information for the pool
	$sql2 = "SELECT
					driver, route
				FROM
					poolitineraries
				WHERE
					pool_id = '{$row['pool_id']}' AND driver != '' AND route != '' AND rdate = '$today'";
	$row2 = $dbh->queryRow($sql2);

	// Check for a driver and route
	if(($row2['driver'] != '') && ($row2['route'] != ''))
	{
		// Get passenger information
		$passenger_ids = array();
		$sql6 = "SELECT user_id, confirm FROM poolpassengers WHERE pool_id = '{$row['pool_id']}' AND rdate = '$today' AND confirm = 'accept'";
		$result6 = $dbh->query($sql6);
		while($row6 = $result6->fetchRow()){
			array_push($passenger_ids,$row6['user_id']);
		}
		$numberOfPassengers = count($passenger_ids);
		if($numberOfPassengers > 1){
			$fairnessIncrement = 1/$numberOfPassengers;
			for($i=0; $i<$numberOfPassengers; $i++){
				if($passenger_ids[$i] != $row2['driver']){
					$passenger_id = $passenger_ids[$i];
					$sql = "UPDATE poolmembers SET
									fairness = fairness + '{$fairnessIncrement}'
								WHERE
									pool_id = '{$row['pool_id']}' AND user_id = '{$passenger_id}'";
					//echo $sql;
					$message .= $sql;
					$dbh->query($sql);			}
			}
		}
	}

}


$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Get all pools
$sql = "SELECT pool_id FROM pools ORDER BY title";
$result = $dbh->query($sql);
while($row = $result->fetchRow())
{
	// Get itinerary information for the pool
	$sql2 = "SELECT
					driver,
					route,
					DATE_FORMAT(rdate, '%M %d, %Y') AS rdate,
					DATE_FORMAT(dm_time, '%k:%i') AS dm_time,
					DATE_FORMAT(aw_time, '%k:%i') AS aw_time,
					DATE_FORMAT(dw_time, '%k:%i') AS dw_time,
					notes
				FROM
					poolitineraries
				WHERE
					pool_id = '{$row['pool_id']}' AND driver != '' AND route != '' AND rdate = '$tomorrow'";
	$row2 = $dbh->queryRow($sql2);

	// Check for a driver and route
	if(($row2['driver'] != '') && ($row2['route'] != ''))
	{

		// Depart from meeting place
		$cleandm = Utils::cleantime($row2['dm_time']);
		$departmeeting = $cleandm['hour'] . ':' . $cleandm['minute'] . $cleandm['ampm'];

		// Arrive at workplace
		$cleanaw = Utils::cleantime($row2['aw_time']);
		$arriveworkplace = $cleanaw['hour'] . ':' . $cleanaw['minute'] . $cleanaw['ampm'];

		// Depart from workplace
		$cleandw = Utils::cleantime($row2['dw_time']);
		$departworkplace = $cleandw['hour'] . ':' . $cleandw['minute'] . $cleandw['ampm'];

		// Get route title
		$sql6 = "SELECT title FROM poolroutes WHERE route_id = '{$row2['route']}'";
		$row6 = $dbh->queryRow($sql6);

		// Get driver information
		$sql3 = "SELECT firstname, lastname FROM users WHERE user_id = '{$row2['driver']}'";
		$row3 = $dbh->queryRow($sql3);

		// Get passenger information
		$passengers = "";
		$sql6 = "SELECT user_id, confirm FROM poolpassengers WHERE pool_id = '{$row['pool_id']}' AND rdate = '$tomorrow' AND confirm = 'accept'";
		$result6 = $dbh->query($sql6);
		while($row6 = $result6->fetchRow()){
			$sql7 = "SELECT firstname, lastname FROM users WHERE user_id = '{$row6['user_id']}'";
			$row7 = $dbh->queryRow($sql7);
			$passengers.=$row7['firstname']." ".$row7['lastname']."<br />";
		}

		$sql4 = "SELECT user_id, confirm FROM poolpassengers WHERE pool_id = '{$row['pool_id']}' AND rdate = '$tomorrow' AND confirm != 'decline'";
		$result4 = $dbh->query($sql4);
		while($row4 = $result4->fetchRow())
		{
			// Get e-mail address of pool member
			$sql5 = "SELECT firstname, lastname, email FROM users WHERE user_id = '{$row4['user_id']}'";
			$row5 = $dbh->queryRow($sql5);

			// Compose message
			$message  = '<html><body>Dear ' . $row5['firstname'] . ' ' . $row5['lastname'] . ', ' . "<br /><br />";

			// If the user has not yet replied
			if($row4['confirm'] == '')
			{
				$message .= 'It appears that you have not yet confirmed your participation in your carpool occuring on ' . $tomorrow . '. Please login to Purpool to set your confirmation:' . "<br /><br />";
			} else {
				$message .= 'Listed below are the details for your carpool occuring on ' . $tomorrow . ':' . "<br /><br />";
			}
			$message .= 'Driver: ' . $row3['firstname'] . ' '. $row3['lastname'] . "<br />";
			$message .= 'Route: ' . $row6['title'] . "<br />";
			$message .= 'Depart from meeting place: ' . $departmeeting . "<br />";
			/*$message .= 'Arrive at workplace: ' . $arriveworkplace . "<br />";*/
			$message .= 'Depart from workplace: ' . $departworkplace . "<br />";
			$message .= 'Other passengers: ' . $passengers . "<br />";

			if($row2['notes'])
			{
				$message .= 'Notes: ' . $row2['notes'] . "<br />";
			}

			$message .= 'Please log into <a href="'.$MISC['site_url'].'">Purpool</a> to view a detailed itinerary.</body></html>';

			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			// Send the message
			mail($row5['email'], 'Purpool Reminder', $message, $headers."From: ".$MISC['admin_email']);

		}
	}

}

// Check to make sure that the query is successful
if (PEAR::isError($result))
{
	$message = 'Purpool may have encountered an error in sending confirmation reminder emails for: ' . $tomorrow . '.' . "\n\n";
	$message = $message . 'The database returned the following error: ' . $result->getMessage();
	mail($MISC['admin_email'], 'Purpool Error: Confirmation emails', $message, "From: ".$MISC['admin_email']);
}


?>

