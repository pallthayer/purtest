<?php

#################################################################
# Name: confirm.php                  		                    #
# Author: John Kuiphoff		                                    #
# Description: Reminds users who haven't yet confimed		    #
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

// Get the date for 2 days from now
$twodays = mktime(0, 0, 0, date("m")  , date("d")+2, date("Y"));
$twodays = date("Y-m-d", $twodays);

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
					pool_id = '{$row['pool_id']}' AND driver != '' AND route != '' AND rdate = '$twodays'";
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
		$sql6 = "SELECT user_id, confirm FROM poolpassengers WHERE pool_id = '{$row['pool_id']}' AND rdate = '$twodays' AND confirm = 'accept'";
		$result6 = $dbh->query($sql6);
		while($row6 = $result6->fetchRow()){
			$sql7 = "SELECT firstname, lastname FROM users WHERE user_id = '{$row6['user_id']}'";
			$row7 = $dbh->queryRow($sql7);
			$passengers.=$row7['firstname']." ".$row7['lastname']."<br />";
		}

		$sql4 = "SELECT user_id, confirm FROM poolpassengers WHERE pool_id = '{$row['pool_id']}' AND rdate = '$twodays' AND confirm = ''";
		$result4 = $dbh->query($sql4);
		while($row4 = $result4->fetchRow())
		{
			// Get e-mail address of pool member
			$sql5 = "SELECT firstname, lastname, email FROM users WHERE user_id = '{$row4['user_id']}'";
			$row5 = $dbh->queryRow($sql5);

			// Compose message
			$message  = '<html><body>Dear ' . $row5['firstname'] . ' ' . $row5['lastname'] . ', ' . "<br /><br />";

			// If the user has not yet replied
			$message .= 'Please confirm your participation in a ride occurring on ' . $twodays . '. either by visiting <a href="'.$MISC['site_url'].'">'.$MISC['site_url'].'</a>. Below is the itinerary:' . "<br /><br />";

			$message .= 'Driver: ' . $row3['firstname'] . ' '. $row3['lastname'] . "<br />";
			$message .= 'Route: ' . $row6['title'] . "<br />";
			$message .= 'Depart from meeting place: ' . $departmeeting . "<br />";
			$message .= 'Arrive at workplace: ' . $arriveworkplace . "<br />";
			$message .= 'Depart from workplace: ' . $departworkplace . "<br />";
			$message .= 'Other passengers: ' . $passengers . "<br />";

			if($row2['notes'])
			{
				$message .= 'Notes: ' . $row2['notes'] . "<br />";
			}

			$message = $message . 'Happy Carpooling,' . "<br /><br />";
			$message = $message . 'The Purpool Team' . "<br /><br /></body></html>";

			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			// Send the message
			mail($row5['email'], 'Purpool Confirmation Request', $message, $headers."From: ".$MISC['admin_email']);

		}
	}

}

// Check to make sure that the query is successful
if (PEAR::isError($result))
{
	$message = 'Purpool may have encountered an error in sending request confirmation reminder emails for: ' . $twodays . '.' . "\n\n";
	$message = $message . 'The database returned the following error: ' . $result->getMessage();
	mail($MISC['admin_email'], 'Purpool Error: Request Confirmation emails', $message, "From: ".$MISC['admin_email']);
}

?>

