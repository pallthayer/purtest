<?php

#################################################################
# Name: events.php                                  		    #
# Author: John Kuiphoff                                         #
# Description: Allows users to create events				    #
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

// Validate user (make sure this is the admin user)
$sql = "SELECT isworkplaceadmin FROM users WHERE user_id = '{$_SESSION['user_id']}'";
$row = $dbh->queryRow($sql);
if($row['isworkplaceadmin'] != '1')
{
	header("Location: index.php");
}

// Switch state
switch($_GET['state'])
{
	
	# MANAGE ANNOUNCEMENTS
	case "manageannouncements":
	
		// Get workplace
		$sql = "SELECT workplace FROM users WHERE user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		$workplace = $row['workplace'];
		
		// If the submit button has been pressed
		if(isset($_POST['submit']))
		{
			// Check for a startdate
			if(empty($_POST['startdate']))
			{
				$error['startdate'] = 'A startdate is required.';
			} else {
				$tpl->assign('startdate', $_POST['startdate']);
			}
			
			// Check for an enddate
			if(empty($_POST['enddate']))
			{
				$error['enddate'] = 'An enddate is required.';
			} else {
				$tpl->assign('enddate', $_POST['enddate']);
			}
			
			// Check for an announcement
			if(empty($_POST['announcement']))
			{
				$error['announcement'] = 'An announcement is required.';
			} else {
				$tpl->assign('announcement', $_POST['announcement']);
			}
			
			// Clean startdate and enddate (convert from mm-dd-yyyy to yyyy-mm-dd)
			$startdate = explode('-', $_POST['startdate']);
			$cstartdate = $startdate[2] . '-' . $startdate[0] . '-' . $startdate[1];
			$enddate = explode('-', $_POST['enddate']);
			$cenddate = $enddate[2] . '-' . $enddate[0] . '-' . $enddate[1];
			
			// E-mail blast
			$tpl->assign('emailblast', $_POST['emailblast']);
			
			// If there are no errors
			if(sizeof($error) == 0)
			{
				// Insert message into database
				$sql = "INSERT INTO announcements (announcement_id, announcement, startdate, enddate, workplace) VALUES (null, '{$_POST['announcement']}', '$cstartdate', '$cenddate', '$workplace')";
				$dbh->query($sql);
				
				// Check for an e-mail blast
				if($_POST['emailblast'] == 'y')
				{
					// Get all users in the workplace
					$sql = "SELECT firstname, lastname, email FROM users WHERE hasloggedin = '1' AND workplace = '$workplace' ORDER BY user_id";
					$result = $dbh->query($sql);
					while($row = $result->fetchRow())
					{
						// Compose message
						mail($row['email'], 'Purpool Announcement', stripslashes($_POST['announcement']), "From: ".$MISC['admin_email']);
					}
				}
			}
			
			// Redirect user
			$redirect = 'wkplaceadmin.php?state=manageannouncements&confirmation=addannouncement';
			header("Location: $redirect");
			
			// Disconnect from database
			$dbh->disconnect();
			exit();	
		}
		
		// Get all announcements for workplace
		$sql = "SELECT announcement_id, announcement, startdate, DATE_FORMAT(startdate, '%M %d, %Y') AS cstartdate, DATE_FORMAT(enddate, '%M %d, %Y') AS cenddate FROM announcements WHERE workplace = '$workplace' ORDER BY startdate";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			// Create announcements array
			$announcements[] = array(
				'announcement_id' => $row['announcement_id'],
				'announcement' => $row['announcement'],
				'startdate' => $row['cstartdate'],
				'enddate' => $row['cenddate']
			);
		}
		$tpl->assign('announcements', $announcements);
		
		// Assign formaction
		$formaction = 'wkplaceadmin.php?state=manageannouncements';
		$tpl->assign('formaction', $formaction);
		
		// Display Template
		$tpl->display('wkplaceadmin-manageannouncements.tpl');
		
		// Disconnect from database
		$dbh->disconnect();
		exit();	
	
	break;
	
	# DELETE ANNOUNCEMENT
	case "deleteannouncement":
	
		// Get workplace
		$sql = "SELECT workplace FROM users WHERE user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		$workplace = $row['workplace'];
		
		// Delete announcement from database
		$sql = "DELETE FROM announcements WHERE announcement_id = '{$_GET['announcement']}' AND workplace = '$workplace' LIMIT 1";
		$dbh->query($sql);
		
		// Redirect user
		$redirect = 'wkplaceadmin.php?state=manageannouncements&confirmation=deleteannouncement';
		header("Location: $redirect");
		
		// Disconnect from database
		$dbh->disconnect();
		exit();	
	
	break;
	
	# VIEW USERS
	case "viewusers":
	
		// Get workplace
		$sql = "SELECT workplace FROM users WHERE user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		$workplace = $row['workplace'];
		
		// Get all users
		$sql = "SELECT user_id, workplace, firstname, lastname, email, hasloggedin FROM users WHERE workplace = '$workplace' ORDER BY lastname";
		$result = $dbh->query($sql);
		$counter = 1;
		while($row = $result->fetchRow())
		{

			// Create users array
			$users[] = array(
				'user_id' => $row['user_id'],
				'firstname' => $row['firstname'],
				'lastname' => $row['lastname'],
				'email' => $row['email'],
				'hasloggedin' => $row['hasloggedin'],
				'counter' => $counter,
			);
			$counter++;
		}
		$tpl->assign('users', $users);
		
		// Display Template
		$tpl->display('wkplaceadmin-viewusers.tpl');
		
		// Disconnect from database
		$dbh->disconnect();
		exit();	
	
	break;
	
	# DELETE USER
	case "deleteuser":
		
		// Assign warning message
		$tpl->assign('warning', 'user');
		
		// Get workplace
		$sql = "SELECT workplace FROM users WHERE user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		$workplace = $row['workplace'];
		
		// Assign formaction
		$formaction = 'wkplaceadmin.php?state=deleteuser&user=' . $_GET['user'];
		$tpl->assign('formaction', $formaction);
		
		// If the yes button has been pressed
		if(isset($_POST['yes']))
		{
			// Check to make sure that the user belongs to this workplace
			$sql = "SELECT user_id FROM users WHERE user_id = '{$_GET['user']}' AND workplace = '$workplace'";
			$row = $dbh->queryRow($sql);
			if($row)
			{
			
				// Delete the user from the users table
				$sql = "DELETE FROM users WHERE user_id = '{$_GET['user']}' LIMIT 1";
				$dbh->query($sql);
				
				// Delete the user from the pool members table
				$sql = "DELETE FROM poolmembers WHERE user_id = '{$_GET['user']}' LIMIT 1";
				$dbh->query($sql);
				
				// Delete the user from the pool passengers table
				$sql = "DELETE FROM poolpassengers WHERE user_id = '{$_GET['user']}' LIMIT 1";
				$dbh->query($sql);
				
			}
			
			// Redirect user
			$redirect = 'wkplaceadmin.php?state=viewusers&confirmation=deleteuser';
			header("Location: $redirect");
			
			// Disconnect from database
			$dbh->disconnect();
			exit();	
		}
		
		// If the yes button has been pressed
		if(isset($_POST['no']))
		{
			// Redirect user
			$redirect = 'wkplaceadmin.php?state=viewusers';
			header("Location: $redirect");
			
			// Disconnect from database
			$dbh->disconnect();
			exit();
		}
		
		// Display Template
		$tpl->display('deleteconfirm.tpl');
		
		// Disconnect from database
		$dbh->disconnect();
		exit();	
	
	break;
	
	# SHOW OPTIONS
	default:
		
		// Display Template
		$tpl->display('wkplaceadmin.tpl');
		
		// Disconnect from database
		$dbh->disconnect();
		exit();	
	
	break;

}

?>
