<?php

#################################################################
# Name: index.php                                               #
# Author: John Kuiphoff                                         #
# Description: Allows users to sigin in to Purpool              #
#################################################################

// Include configuration file
//include_once('/home/41684/domains/purpool.com/common/includes/config.php');

// Include common utility library
include_once($DIR['inc'] . 'Utils.class.php');

// Include database package
include_once($DIR['pear'] . 'MDB2.php');

// Include SMARTY templating engine
include_once($DIR['smarty'] . 'Smarty.class.php');

// Initialize database connection
$dbh = Utils::initDB();

// Initialize templating engine
$tpl = Utils::initTPL();

// Switch state
switch($_GET['state'])
{
	case "general":
		$tpl->display('help-general.tpl');
	break;
	case "profile":
		$tpl->display('help-profile.tpl');
	break;
	// Display Main Menu
	default:

		// Display Template
		$tpl->display('help-general.tpl');
		
		// Disconnect database
		$dbh->disconnect();
		exit();
	
	break;
}




?>
