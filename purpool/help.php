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

// Switch state
switch($_GET['state'])
{
	case "about":
		$tpl->display('help-about.tpl');
	break;
	case "faq":
		$tpl->display('help-faq.tpl');
	break;
	case "tour":
		$tpl->display('tour-intro.tpl');
	break;
	case "privacy":
		$tpl->display('help-privacy.tpl');
	break;
	case "tos":
		$tpl->display('help-tos.tpl');
	break;
	// Display Main Menu
	default:

		// Display Template
		$tpl->display('help-faq.tpl');
		
		// Disconnect database
		$dbh->disconnect();
		exit();
	
	break;
}




?>