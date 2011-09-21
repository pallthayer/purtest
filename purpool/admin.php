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

// Include visualization library
include_once($DIR['inc'] . 'visdata.php');

// Initialize database connection
$dbh = Utils::initDB();

// Initialize templating engine
$tpl = Utils::initTPL();$tpl->assign('site_url', $MISC['site_url']);

// Start new session
session_start();

// Validate user (make sure this is the admin user)
if(($_SESSION['username'] != 'admin') && ($_SESSION['user_id'] != 'admin'))
{
	header("Location: index.php");
}
$tpl->assign('hidetopnav', true);
$tpl->assign('google_key', $MISC['google_key']);

// Switch state
switch($_GET['state'])
{
	# ADD WORKPLACE
	case "addworkplace":
		// Assign formaction
		$tpl->assign('formaction', 'admin.php?state=addworkplace');
		// If the submit button has been pressed
		if(isset($_POST['submit']))
		{

			// Create error array
			$error = array();
			
			// Check for a name
			if(empty($_POST['name']))
			{
				$error['name'] = 'A title is required.';
			} else {
				$tpl->assign('name', $_POST['name']);
			}
			
			// Check for an email suffix
			if(empty($_POST['suffix']))
			{
				$error['suffix'] = 'An email suffix is required.';
			} else {
				if(substr($_POST['suffix'],0,1) != "@")
				{
					$error['suffix'] = 'An @ is required.';
				}
				else{
					$tpl->assign('suffix', $_POST['suffix']);
				}
			}
			
			// Check for an address
			if(empty($_POST['address']))
			{
				$error['address'] = 'An address is required.';
			} else {
				$tpl->assign('address', $_POST['address']);
			}
			
			// Check for a city
			if(empty($_POST['city']))
			{
				$error['city'] = 'A city is required.';
			} else {
				$tpl->assign('city', $_POST['city']);
			}
			
			// Check for a state
			if(empty($_POST['state']))
			{
				$error['state'] = 'A state is required.';
			} else {
				$tpl->assign('state', $_POST['state']);
			}
			
			// Check for a zipcode
			$tpl->assign('zip', $_POST['zip']);
			
			// Check for a latitude
			if(empty($_POST['latitude']))
			{
				$error['latitude'] = 'A latitude is required.';
			} else {
				$tpl->assign('latitude', $_POST['latitude']);
			}
			
			// Check for a longitude
			if(empty($_POST['longitude']))
			{
				$error['longitude'] = 'A longitude is required.';
			} else {
				$tpl->assign('longitude', $_POST['longitude']);
			}
			
			// Otherwise, display errors
			if(sizeof($error) == 0)
			{
			
				// Insert workplace into database
				$sql = "INSERT INTO workplaces (
								workplace_id, 
								name,
								suffix, 
								address,
								city,
								state,
								zip,
								latitude, 
								longitude
							) VALUES (
								null, 
								'{$_POST['name']}', 
								'{$_POST['suffix']}', 
								'{$_POST['address']}', 
								'{$_POST['city']}', 
								'{$_POST['state']}', 
								'{$_POST['zip']}', 
								'{$_POST['latitude']}', 
								'{$_POST['longitude']}'
							)";
				$dbh->query($sql);
				
				// Redirect user
				header("Location: admin.php?state=addworkplace&confirmation=addworkplace");
				
				// Disconnect from database
				$dbh->disconnect();
				exit();	
				
			} else {
			
				// Display errors
				$tpl->assign('error', $error);
				
				// Display Template
				$tpl->display('admin-addworkplace.tpl');
		
				// Disconnect from database
				$dbh->disconnect();
				exit();	
				
			}
			
		} else {
			
			// Display Template
			$tpl->display('admin-addworkplace.tpl');
	
			// Disconnect from database
			$dbh->disconnect();
			exit();	
		}
	
	break;
	
	# EDIT WORKPLACE
	case "editworkplace":
		
		// Assign formaction
		$tpl->assign('formaction', 'admin.php?state=editworkplace');
		
		// If the submit button has been pressed
		if(isset($_POST['submit']))
		{
			// Create error array
			$error = array();
			
			// Check for a name
			if(empty($_POST['name']))
			{
				$error['name'] = 'A title is required.';
			} else {
				$tpl->assign('name', $_POST['name']);
			}
			
			// Check for an email suffix
			if(empty($_POST['suffix']))
			{
				$error['suffix'] = 'An email suffix is required.';
			} else {
				if($_POST['suffix'].substr(0,1) != "@")
				{
					$error['suffix'] = 'An @ is required.';
				}
				else{
					$tpl->assign('suffix', $_POST['suffix']);
				}
			}
			
			// Check for an address
			if(empty($_POST['address']))
			{
				$error['address'] = 'An address is required.';
			} else {
				$tpl->assign('address', $_POST['address']);
			}
			
			// Check for a city
			if(empty($_POST['city']))
			{
				$error['city'] = 'A city is required.';
			} else {
				$tpl->assign('city', $_POST['city']);
			}
			
			// Check for a state
			if(empty($_POST['state']))
			{
				$error['state'] = 'A state is required.';
			} else {
				$tpl->assign('state', $_POST['state']);
			}
			
			// Check for a zipcode
			$tpl->assign('zip', $_POST['zip']);
			
			// Check for a latitude
			if(empty($_POST['latitude']))
			{
				$error['latitude'] = 'A latitude is required.';
			} else {
				$tpl->assign('latitude', $_POST['latitude']);
			}
			
			// Check for a longitude
			if(empty($_POST['longitude']))
			{
				$error['longitude'] = 'A longitude is required.';
			} else {
				$tpl->assign('longitude', $_POST['longitude']);
			}
			
			// Otherwise, display errors
			if(sizeof($error) == 0)
			{
			
				// Edit workplace in database
				$sql = "UPDATE workplaces SET 
							'name' = '{$_POST['name']}',
							'suffix' = '{$_POST['suffix']}',
							'address' = '{$_POST['address']}',
							'city' = '{$_POST['city']}',
							'state' = '{$_POST['state']}',
							'zip' = '{$_POST['zip']}',
							'latitude' = '{$_POST['latitude']}',
							'longitude' = '{$_POST['longitude']}'
						WHERE
							workplace_id = '{$_GET['workplace']}' 
						LIMIT 1";
				$dbh->query($sql);
				
				// Redirect user
				header("Location: admin.php?state=viewworkplaces&confirmation=editworkplace");
				
				// Disconnect from database
				$dbh->disconnect();
				exit();	
				
			} else {
			
				// Display errors
				$tpl->assign('error', $error);
				
				// Display Template
				$tpl->display('admin-addworkplace.tpl');
		
				// Disconnect from database
				$dbh->disconnect();
				exit();	
				
			}
			
		} else {
			
			// Get workplace information
			$sql = "SELECT workplace_id, name, suffix, address, city, state, zip, latitude, longitude FROM workplaces WHERE workplace_id = '{$_GET['workplace']}'";
			$row = $dbh->queryRow($sql);
			
			$tpl->assign('workplace_id', $row['workplace_id']);
			$tpl->assign('name', $row['name']);
			$tpl->assign('suffix', $row['suffix']);
			$tpl->assign('address', $row['address']);
			$tpl->assign('city', $row['city']);
			$tpl->assign('state', $row['state']);
			$tpl->assign('zip', $row['zip']);
			$tpl->assign('latitude', $row['latitude']);
			$tpl->assign('longitude', $row['longitude']);
			
			// Display Template
			$tpl->display('admin-addworkplace.tpl');
	
			// Disconnect from database
			$dbh->disconnect();
			exit();	
		}
	
	break;
	
	# DELETE WORKPLACE
	case "deleteworkplace":
	
		// Assign warning message
		$tpl->assign('warning', 'workplace');
		
		// Assign formaction
		$formaction = 'admin.php?state=deleteworkplace&workplace=' . $_GET['workplace'];
		$tpl->assign('formaction', $formaction);
		
		// If the yes button has been pressed
		if(isset($_POST['yes']))
		{
			// Delete workplace from workplaces table
			//$sql = "DELETE FROM workplaces WHERE workplace_id = '{$_GET['workplace']}' LIMIT 1";
			//$dbh->query($sql);
			
			// Get all pools associated with this workplace
			$sql = "SELECT pool_id FROM pools WHERE workplace_id = '{$_GET['workplace']}'";
			$result = $dbh->query($sql);
			while($row = $result->fetchRow())
			{
				
				/*
				// Delete pool from pools table
				$sql = "DELETE FROM pools WHERE pool_id = '{$row['pool_id']}' LIMIT 1";
				$dbh->query($sql);
				
				// Delete pool from poolitineraries table
				$sql = "DELETE FROM poolitineraries WHERE pool_id = '{$row['pool_id']}'";
				$dbh->query($sql);
				
				// Delete pool from poolmembers table
				$sql = "DELETE FROM poolmembers WHERE pool_id = '{$row['pool_id']}'";
				$dbh->query($sql);
				
				// Delete pool from poolpassengers table
				$sql = "DELETE FROM poolpassengers WHERE pool_id = '{$row['pool_id']}'";
				$dbh->query($sql);
				
				// Delete pool from poolroutes table
				$sql = "DELETE FROM poolroutes WHERE pool_id = '{$row['pool_id']}'";
				$dbh->query($sql);
				
				// Delete pool from poolshoutes table
				$sql = "DELETE FROM poolshouts WHERE pool_id = '{$row['pool_id']}'";
				$dbh->query($sql);
				
				// Delete pool from poolsrequestinvite table
				$sql = "DELETE FROM poolsrequestinvite WHERE pool_id = '{$row['pool_id']}'";
				$dbh->query($sql);
				
				// Delete pool from schedulecomments table
				$sql = "DELETE FROM schedule_comments WHERE pool_id = '{$row['pool_id']}'";
				$dbh->query($sql);
				*/
			}
			
			// Redirect user
			$redirect = 'admin.php?state=viewworkplaces&confirmation=deleteworkplace';
			header("Location: $redirect");
			
			// Disconnect from database
			$dbh->disconnect();
			exit();	
		}
		
		// If the yes button has been pressed
		if(isset($_POST['no']))
		{
			// Redirect user
			$redirect = 'admin.php?state=viewworkplaces';
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
	
	# VIEW WORKPLACES
	case "viewworkplaces":
		
		// Get workplaces
		$sql = "SELECT
					workplace_id,
					name,
					suffix,
					address,
					city,
					state,
					zip,
					latitude,
					longitude
				FROM
					workplaces
				ORDER BY
					name";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			// Get number of active members
			$sql2 = "SELECT count(user_id) AS nummembers FROM users WHERE workplace = '{$row['workplace_id']}'";
			$row2 = $dbh->queryRow($sql2);
			
			// Get number of admins
			$sql3 = "SELECT count(user_id) AS numadmins FROM users WHERE workplace = '{$row['workplace_id']}' AND isworkplaceadmin = 1";
			$row3 = $dbh->queryRow($sql3);
			
			// Create workplaces array
			$workplaces[] = array(
				'workplace_id' => $row['workplace_id'],
				'name' => $row['name'],
				'suffix' => $row['suffix'],
				'address' => $row['address'],
				'city' => $row['city'],
				'state' => $row['state'],
				'zip' => $row['zip'],
				'latitude' => $row['latitude'],
				'longitude' => $row['longitude'],
				'nummembers' => $row2['nummembers'],
				'numadmins' => $row3['numadmins']
			);
			$tpl->assign('workplaces', $workplaces);
		}
		
		// Display Template
		$tpl->display('admin-viewworkplaces.tpl');
		
		// Disconnect from database
		$dbh->disconnect();
		exit();	
	
	break;
	
	# MANAGE ANNOUNCEMENTS
	case "manageannouncements":
	
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
				$sql = "INSERT INTO announcements (announcement_id, announcement, startdate, enddate, workplace) VALUES (null, '{$_POST['announcement']}', '$cstartdate', '$cenddate', 'all')";
				$dbh->query($sql);
				
				// Check for an e-mail blast
				if($_POST['emailblast'] == 'y')
				{
					// Get all users of purpool
					$sql = "SELECT firstname, lastname, email FROM users WHERE hasloggedin = '1' ORDER BY user_id";
					$result = $dbh->query($sql);
					while($row = $result->fetchRow())
					{
					
						// Compose message
						mail($row['email'], 'Purpool Announcement', stripslashes($_POST['announcement']), "From: ".$MISC['admin_email']);
						//echo 'Mailing: ' . $row['email'] . "<br />";
					}
				}
			}
			
			// Redirect user
			$redirect = 'admin.php?state=manageannouncements&confirmation=addannouncement';
			header("Location: $redirect");
			
			// Disconnect from database
			$dbh->disconnect();
			exit();	
		}
		
		// Get all mass announcements
		$sql = "SELECT announcement_id, announcement, startdate, DATE_FORMAT(startdate, '%M %d, %Y') AS cstartdate, DATE_FORMAT(enddate, '%M %d, %Y') AS cenddate FROM announcements WHERE workplace = 'all' ORDER BY startdate";
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
		$formaction = 'admin.php?state=manageannouncements';
		$tpl->assign('formaction', $formaction);
		
		// Display Template
		$tpl->display('admin-manageannouncements.tpl');
		
		// Disconnect from database
		$dbh->disconnect();
		exit();	
	
	break;
	
	# DELETE ANNOUNCEMENT
	case "deleteannouncement":
		
		// Delete announcement from database
		$sql = "DELETE FROM announcements WHERE announcement_id = '{$_GET['announcement']}' LIMIT 1";
		$dbh->query($sql);
		
		// Redirect user
		$redirect = 'admin.php?state=manageannouncements&confirmation=deleteannouncement';
		header("Location: $redirect");
		
		// Disconnect from database
		$dbh->disconnect();
		exit();	
	
	break;
	
	# MANAGE ADMINS
	case "manageadmins":
	
		// Assign workplace_id
		$tpl->assign('workplace_id', $_GET['workplace']);
		
		// Get title of workplace
		$sql = "SELECT name FROM workplaces WHERE workplace_id = '{$_GET['workplace']}'";
		$row = $dbh->queryRow($sql);
		$tpl->assign('workplacename', $row['name']);
	
		// Get all current user who are not admins for the selected workplace
		$sql = "SELECT user_id, firstname, lastname, email FROM users WHERE workplace = '{$_GET['workplace']}' AND isworkplaceadmin != '1' AND hasloggedin = '1'";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			// Create users array
			$users[] = array(
				'user_id' => $row['user_id'],
				'firstname' => $row['firstname'],
				'lastname' => $row['lastname'],
				'email' => $row['email']
			);
		}
		$tpl->assign('users', $users);
		
		// If the submit button has been pressed
		if((isset($_POST['submit'])) && ($_POST['user'] != ''))
		{
			// Update admin status of user
			$sql = "UPDATE users SET isworkplaceadmin = '1' WHERE workplace = '{$_GET['workplace']}' AND user_id = '{$_POST['user']}' LIMIT 1";
			$dbh->query($sql);
			
			// Redirect user
			$redirect = 'admin.php?state=manageadmins&workplace=' . $_GET['workplace'] . '&confirmation=addadmin';
			header("Location: $redirect");
			
			// Disconnect from database
			$dbh->disconnect();
			exit();	
			
		}
		
		// Get all current admins for the selected workplace
		$sql = "SELECT user_id, firstname, lastname, email FROM users WHERE workplace = '{$_GET['workplace']}' AND isworkplaceadmin = 1";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			// Create admins array
			$admins[] = array(
				'user_id' => $row['user_id'],
				'firstname' => $row['firstname'],
				'lastname' => $row['lastname'],
				'email' => $row['email']
			);
		}
		$tpl->assign('admins', $admins);
		
		// Display Template
		$tpl->display('admin-viewworkplaces-manageadmins.tpl');
		
		// Disconnect from database
		$dbh->disconnect();
		exit();	
	
	break;
	
	# REMOVE ADMINS
	case "removeadmin":
	
		// Remove admin status
		$sql = "UPDATE users SET isworkplaceadmin = '0' WHERE workplace = '{$_GET['workplace']}' AND user_id = '{$_GET['user']}' LIMIT 1";
		$dbh->query($sql);
		
		// Redirect user
		$redirect = 'admin.php?state=manageadmins&workplace=' . $_GET['workplace'] . '&confirmation=removeadmin';
		header("Location: $redirect");
		
		// Disconnect from database
		$dbh->disconnect();
		exit();	
	
	break;
	
	# VIEW USERS
	case "viewusers":
	
		// Get all users
		$sql = "SELECT user_id, workplace, firstname, lastname, email, hasloggedin FROM users ORDER BY lastname";
		$result = $dbh->query($sql);
		$counter = 1;
		while($row = $result->fetchRow())
		{
			// Get workplace name
			$sql2 = "SELECT name FROM workplaces WHERE workplace_id = '{$row['workplace']}'";
			$row2 = $dbh->queryRow($sql2);
			
			// Create users array
			$users[] = array(
				'user_id' => $row['user_id'],
				'firstname' => $row['firstname'],
				'lastname' => $row['lastname'],
				'email' => $row['email'],
				'hasloggedin' => $row['hasloggedin'],
				'workplace' => $row2['name'],
				'counter' => $counter,
			);
			$counter++;
		}
		$tpl->assign('users', $users);
		
		// Display Template
		$tpl->display('admin-viewusers.tpl');
		
		// Disconnect from database
		$dbh->disconnect();
		exit();	
	
	break;
	
	# DELETE USER
	case "deleteuser":
		
		// Assign warning message
		$tpl->assign('warning', 'user');
		
		// Assign formaction
		$formaction = 'admin.php?state=deleteuser&user=' . $_GET['user'];
		$tpl->assign('formaction', $formaction);
		
		// If the yes button has been pressed
		if(isset($_POST['yes']))
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
			
			// Redirect user
			$redirect = 'admin.php?state=viewusers&confirmation=deleteuser';
			header("Location: $redirect");
			
			// Disconnect from database
			$dbh->disconnect();
			exit();	
		}
		
		// If the yes button has been pressed
		if(isset($_POST['no']))
		{
			// Redirect user
			$redirect = 'admin.php?state=viewusers';
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
	
	# VIEW SAVINGS
	case "viewsavings":
	
		// Get workplace name
		$sql = "SELECT name FROM workplaces WHERE workplace_id = '{$_GET['workplace']}'";
		$row = $dbh->queryRow($sql);
		$tpl->assign('workplace', $row['name']);
		
		// Get total savings
		$savings = getWorkplaceSavings($_GET['workplace']);
		$tpl->assign('gas', $savings['gas']);
		$tpl->assign('cars', $savings['cars']);
		$tpl->assign('miles', $savings['miles']);
		$tpl->assign('emissions', $savings['emissions']);
		
		// Get number of members
		$sql = "SELECT count(user_id) AS nummembers FROM users WHERE workplace = '{$_GET['workplace']}'";
		$row = $dbh->queryRow($sql);
		$tpl->assign('nummembers', $row['nummembers']);
		
		// Get number of pools
		$sql = "SELECT count(pool_id) AS numpools FROM pools WHERE workplace_id = '{$_GET['workplace']}'";
		$row = $dbh->queryRow($sql);
		$tpl->assign('numpools', $row['numpools']);
		
		// Display template
		$tpl->display('admin-viewsavings.tpl');
	
	break;
	
	# SHOW OPTIONS
	default:
		
		// Display Template
		$tpl->display('admin.tpl');
		
		// Disconnect from database
		$dbh->disconnect();
		exit();	
	
	break;

}

?>
