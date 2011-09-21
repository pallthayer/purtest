<?php

#################################################################
# Name: register-cleanup.php                                    #
# Author: John Kuiphoff		                                    #
# Description: Deletes unfinished registration				    #
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

// Get the current date and time
$currenttime = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));

// Get all registered users that have not yet completed their registration
/*
$sql = "SELECT 
			user_id, 
			DATE_FORMAT('%H', registerdate) AS hour,
			DATE_FORMAT('%i', registerdate) AS minute,
			DATE_FORMAT('%s', registerdate) AS seconds,
			DATE_FORMAT('%m', registerdate) AS month,
			DATE_FORMAT('%d', registerdate) AS day,
			DATE_FORMAT('%Y', registerdate) AS year
		FROM 
			users 
		WHERE 
			registercomplete != '1'";
*/
$sql = "SELECT 
			user_id, 
			DATE_FORMAT(registerdate, '%H') AS hour,
			DATE_FORMAT(registerdate, '%i') AS minute,
			DATE_FORMAT(registerdate, '%s') AS seconds,
			DATE_FORMAT(registerdate, '%m') AS month,
			DATE_FORMAT(registerdate, '%d') AS day,
			DATE_FORMAT(registerdate, '%Y') AS year
		FROM 
			users 
		WHERE 
			registercomplete != '1'";
$result = $dbh->query($sql);
while($row = $result->fetchRow())
{
	// Get registration date
	$registrationdate = mktime($row['hour'], $row['minute'], $row['seconds'], $row['month'], $row['day'], $row['year']);
	
	// Calculate time difference in number of seconds
	$difference = $currenttime - $registrationdate;
	// If the difference is greater than one hour, delete the user
	if($difference > 3600)
	{
		// Delete user
		$sql = "DELETE FROM users WHERE user_id = '{$row['user_id']}' AND registercomplete != '1' LIMIT 1";
		$dbh->query($sql);
	}
	
}

?>

