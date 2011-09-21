<?php

#################################################################
# Name: cron_gasprices.php                                      #
# Author: Peter Gordenstein                                     #
# Description: Uploads current gas prices into database		    #
#################################################################

// Include configuration file
include_once('config_path.php'); include_once($config_path.'config.php');

// Include common utility library
include_once($DIR['inc'] . 'Utils.class.php');

// Include database package
include_once($DIR['pear'] . 'MDB2.php');

// Initialize database connection
$dbh = Utils::initDB();

// Get the date for tomorrow
$tomorrow = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
$tomorrow = date("Y-m-d", $tomorrow);

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
	$sql4 = "SELECT user_id, confirm FROM poolpassengers WHERE pool_id = '{$row['pool_id']}' AND rdate = '$tomorrow' AND confirm != 'decline'";
	$result4 = $dbh->query($sql4);
	while($row4 = $result4->fetchRow())
	{
		// Get e-mail address of pool member
		$sql5 = "SELECT firstname, lastname, email FROM users WHERE user_id = '{$row4['user_id']}'";
		$row5 = $dbh->queryRow($sql5);

		// Compose message
		$message  = 'Dear ' . $row5['firstname'] . ' ' . $row5['lastname'] . ', ' . "\n\n";

		// If the user has not yet replied
		if($row4['confirm'] == '')
		{
			$message .= 'It appears that you have not yet confirmed your participation in your carpool occuring on ' . $tomorrow . '. Please login to <a href="'.$MISC['site_url'].'">Purpool</a> to set your confirmation:' . "\n\n";
		} else {
			$message .= 'Listed below are the details for your carpool occuring on ' . $tomorrow . ':' . "\n\n";
		}
		$message .= 'Driver: ' . $row2['driver'] . "\n";
		$message .= 'Route: ' . $row6['title'] . "\n";
		$message .= 'Depart from meeting place: ' . $departmeeting . "\n";
		$message .= 'Arrive at workplace: ' . $arriveworkplace . "\n";
		$message .= 'Depart from workplace: ' . $departworkplace . "\n";

		if($row2['notes'])
		{
			$message .= 'Notes: ' . $row2['notes'] . "\n";
		}

		$message .= 'Please log into Purpool to view a detailed itinerary.';

		// Send the message
		echo 'mailed: ' . $row5['email'] . "<br />";
		mail($row5['email'], 'Purpool Reminder', $message, 'MIME-Version: 1.0'."\r\n".'Content-type: text/html; charset=iso-8859-1'."\r\n"."From: ".$MISC['admin_email']);

	}

}

// Check to make sure that the query is successful
if (PEAR::isError($result))
{
	$message = 'Purpool may have encountered an error in sending confirmation reminder emails for: ' . $tomorrow . '.' . "\n\n";
	$message = $message . 'The database returned the following error: ' . $result->getMessage();
	mail('john@johnkuiphoff.com', 'Purpool Error: Confirmation emails', $message, "From: ".$MISC['admin_email']);
} else {
	mail('john@johnkuiphoff.com', 'Purpool Success: Confirmation emails', 'Confirmation emails have been sent today', "From: ".$MISC['admin_email']);
}


?>

