<?php

#################################################################
# Name: register-cleanup.php                                    #
# Author: John Kuiphoff		                                    #
# Description: Deletes unfinished registration				    #
#################################################################

// Include configuration file
include_once('config_path.php'); include_once($config_path.'config.php');

// Include common utility library
include_once($DIR['inc'] . 'Utils.class.php');

// Include database package
include_once($DIR['pear'] . 'MDB2.php');

// Initialize database connection
$dbh = Utils::initDB();

// Get the current date and time
$currenttime = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));

// Get all registered users that have not yet completed their registration
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
$result = $dbh->query($sql);
while($row = $result->fetchRow())
{
	// Calculate registration time difference
	$registrationdate = mktime($row['hour'], $row['minute'], $row['seconds'], $row['month'], $row['day'], $row['year']);
	$difference = $currenttime - $registrationdate;
	echo $row['user_id'] . ': ' . $difference . ' seconds' . "<br />";
}

/*
// Check to make sure that the query is successful
if (PEAR::isError($result)) 
{
	$message = 'Purpool may have encountered an error in sending confirmation reminder emails for: ' . $tomorrow . '.' . "\n\n";
	$message = $message . 'The database returned the following error: ' . $result->getMessage(); 
	mail('john@johnkuiphoff.com', 'Purpool Error: Confirmation emails', $message, "From: ".$MISC['admin_email']);
} else {
	mail('john@johnkuiphoff.com', 'Purpool Success: Confirmation emails', 'Confirmation emails have been sent today', "From: ".$MISC['admin_email']);
}
*/


?>

