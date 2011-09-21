<?php

#################################################################
# Name: contact.php                                             #
# Author: John Kuiphoff                                         #
# Description: Allows users to contact purpool support          #
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
	# DISPLAY CONFIRMATION
	case "confirmation":
		
		// Display template
		$tpl->display('contact-confirmation.tpl');
		
		// Disconnect from database
		$dbh->disconnect();
		exit();
	
	break;
	
	
	# COMPOSE EMAIL
	default:
	
		// If the submit button has been pressed
		if(isset($_POST['submit']))
		{
			// Create an error array
			$error = array();
			
			// Check for a name
			if(empty($_POST['name']))
			{
				$error['name'] = 'A name is required';
			} else {
				$tpl->assign('name', $_POST['name']);
			}
			
			// Check for an email address
			if(empty($_POST['email']))
			{
				$error['email'] = 'An email address is required';
			} else {
				$tpl->assign('email', $_POST['email']);
			}
			
			// Check for a message
			if(empty($_POST['message']))
			{
				$error['message'] = 'A message is required';
			} else {
				$tpl->assign('message', $_POST['message']);
			}
			
			// If there are no errors, send the email
			// Otherwise, dislay errors
			if(sizeof($error) == 0)
			{
				// Compose message
				mail($MISC['admin_email'], "Purpool Support", $_POST['message'], "From: {$_POST['email']}");
				
				// Insert email message into database for backup purposes
				$sql = "INSERT INTO support (message_id, name, email, message, submitdate) VALUES (NULL, '{$_POST['name']}', '{$_POST['email']}', '{$_POST['message']}', NOW())";
				$dbh->query($sql);
				
				// Redirect user
				header("Location: contact.php?state=confirmation");
				
				// Disconnect from database
				$dbh->disconnect();
				exit();
	
			} else {
			
				// Display errors
				$tpl->assign('error', $error);
			
			}
	
		}
		
		// Display Template
		$tpl->display('contact-compose.tpl');
		
		// Disconnect from database
		$dbh->disconnect();
		exit();
	
	break;
	
}




?>
