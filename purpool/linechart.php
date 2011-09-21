<?php

#################################################################
# Name: linechart.php                                           #
# Author: John Kuiphoff                                         #
# Description: Feeds Flash line chart with user savings         #
#################################################################

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

// Continue session
session_start();

// Is this a profile?
if($_SESSION['displayprofile'] == true)
{
	// Get savings for user
	$xml = getUserSavingsByWeek($_SESSION['displaykey']);
}

// Is this a pool?
if($_SESSION['displaypool'] == true)
{
	// Get pool savings
	$xml = getPoolSavingsByWeek($_SESSION['displaykey']);
}

// Set header to XML
//header("content-type: text/xml"); 

// Print XML
echo $xml;

?>

