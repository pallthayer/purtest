<?php

#################################################################
# Name: index.php                                               #
# Author: John Kuiphoff                                         #
# Description: Allows users to sigin in to Purpool              #
#################################################################

// Include configuration file
include_once('config_path.php'); include_once($config_path.'config.php');

// Include common utility library
include_once($DIR['inc'] . 'Utils.class.php');

// Include database package
include_once($DIR['pear'] . 'MDB2.php');

// Include SMARTY templating engine
include_once($DIR['smarty'] . 'Smarty.class.php');

// Initialize database connection
$dbh = Utils::initDB();

// Initialize templating engine
$tpl = Utils::initTPL();$tpl->assign('site_url', $MISC['site_url']);

// Start new session
session_start();

// Validate user
if(!$_SESSION['username'])
{
	$tpl->assign('hidetopnav', true);
}

$tpl->assign('anchor', $_GET['anchor']);
// Switch state
switch($_GET['state'])
{
	case "general":
		$tpl->display('tour-intro.tpl');
	break;
	case "people":
		$tpl->display('tour-people.tpl');
	break;
	case "pools":
		$tpl->display('tour-pools.tpl');
	break;
	case "savings":
		$tpl->display('tour-savings.tpl');
	break;
	case "cmap":
		$tpl->display('tour-cmap.tpl');
	break;
	case "events":
		$tpl->display('tour-events.tpl');
	break;
	// Display Main Menu
	default:

		// Display Template
		$tpl->display('tour-intro.tpl');
		
		// Disconnect database
		$dbh->disconnect();
		exit();
	
	break;
}




?>