<?php

#################################################################
# Name: linechart.php                                           #
# Author: John Kuiphoff                                         #
# Description: Feeds Flash line chart with user savings         #
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

// Continue session
session_start();

// Get workplace of user
$sql = "SELECT workplace FROM users WHERE user_id = '{$_SESSION['user_id']}'";
$row = $dbh->queryRow($sql);

// Get JSON data
$json = getLeaders($row['workplace']);

// JSON Content type
//header('content-type: text/json'); 

// Print JSON
echo $json;

// Disconnect from database
$dbh->disconnect();
exit();

?>

