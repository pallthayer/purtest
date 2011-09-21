<?php

#################################################################
# Name: signin.php                                              #
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

// Switch state
switch($_GET['state'])
{
	// Signin
	case "signin":

		// Create error array
		$error = array();
		
		// Check for a username
		if(empty($_POST['username']))
		{
			$error['username'] = 'A username is required.';
		}
		
		// Check for a password
		if(empty($_POST['userpass']))
		{
			$error['userpass'] = 'A password is required.';
		}
		
		// Check to see if user is in database
		if($_POST['username'] && $_POST['userpass'])
		{
			$sql = "SELECT user_id, username, firstname, lastname FROM users WHERE username = '{$_POST['username']}' AND userpass = SHA('{$_POST['userpass']}')";
			$row = $dbh->queryRow($sql);
			if(!$row)
			{
				$error['invaliduser'] = 'Invalid username and/or password.';
			}
		}

		// If there are no errors, sign in user
		// Otherwise, display errors
		if(sizeof($error) == 0)
		{
			// Create new session
			session_start();
			
			// Add user information to session variables
			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['fullname'] = $row['firstname'] . ' ' . $row['lastname'];
			
			// Log action
			Utils::logAction($_POST['username'], 'Login', '');
			
			// Build JSON array
			$json = array(
				"status" => "success"
			);
			
			// Out response to browser
			$output = json_encode($json);
			echo $output;
		
		} else {
		
			// Build JSON array
			$json = array(
				"status" => "failure",
				"error" => $error
			);
		
			// Out response to browser
			$output = json_encode($json);
			echo $output;
		
		}

		// Disconnect from database
		$dbh->disconnect();
		exit();
	
	break;
	
	// Display register
	default:
	
		// Assign pagetitle
		$tpl->assign('pagetitle', 'Sign in');
		
		// Display Template
		$tpl->display('signin.tpl');
	
	break;
}




?>