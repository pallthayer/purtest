<?php

#################################################################
# Name: pools.php                      		                    #
# Author: John Kuiphoff                                         #
# Description: Allows users to create and manage pools          #
#################################################################

// Turn off error mesasges
ini_set('display_errors', 0);

// Include configuration file
include_once('config_path.php'); include_once($config_path.'config.php');

// Include common utility library
include_once($DIR['inc'] . 'Utils.class.php');

// Include database package
include_once($DIR['pear'] . 'MDB2.php');

// Include SMARTY templating engine
include_once($DIR['smarty'] . 'Smarty.class.php');

// Include visualization library
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
if($_SESSION['isworkplaceadmin'] == 1) { $tpl->assign('adminmode', 1); }

$tpl->assign('google_key', $MISC['google_key']);

// Switch state
switch($_GET['state'])
{
	
	case "stackedchart":
	
	
		// Assign current side navigation
		$tpl->assign('vizcurrent', true);
		
	
		// Get workplace of user
		$sql = "SELECT workplace FROM users WHERE user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
	
		$numWeeks = getGlobalSavings($row['workplace']);
	
		$tpl->display('visualizations-stackedchart.tpl');

		// Disconnect from database
		$dbh->disconnect();
		exit();	
	
	break;
	
	# CREATE POOL CONFIRMATION
	default:
	
		
		// Assign current side navigation
		$tpl->assign('vizcurrent', true);
		
		
		
		// Get workplace of user
		$sql = "SELECT workplace FROM users WHERE user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		
		// Get JSON data
		$json = getLeaders($row['workplace']);
		
		// Get route start and end lat/lng
		$sql = "SELECT latitude, longitude FROM workplaces WHERE workplace_id = '{$row['workplace']}'";
		$row = $dbh->queryRow($sql);
		
		// Assign JSON
		$tpl->assign('json', $json);
		
		// Assign JSON
		$tpl->assign('latitude', $row['latitude']);
		$tpl->assign('longitude', $row['longitude']);
		
		// Display template
		$tpl->display('visualizations.tpl');

		// Disconnect from database
		$dbh->disconnect();
		exit();	
	
	break;
	
}


?>
