<?php

#################################################################
# Name: dashobard.php                                           #
# Author: John Kuiphoff                                         #
# Description: Allows users to view all purpool related info    #
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
	echo 'not validated';
}

// Switch state
switch($_GET['state'])
{
	# EDIT MEMBERS
	case "editmembers":
	
		// If the submit button has been pressed
		if(isset($_POST['submit']))
		{
			// Create error array
			$error = array();
			
			// Check for an e-mail address
			if(empty($_POST['email']))
			{
				$error['email'] = 'An e-mail address is required.';
			
			} else {
				
				// Get user_id of user
				$sql = "SELECT user_id, firstname, lastname FROM users WHERE email = '{$_POST['email']}'";
				$row = $dbh->queryRow($sql);
				if(!$row)
				{
					$error['email'] = 'This user does not exist.';
				} else {
				
					// Invited user_id, firstname, lastname
					$inviteduser = $row['user_id'];
					$invitedfirstname = $row['firstname'];
					$invitedlastname = $row['lastname'];
					
					// Check to see if user has already been invited to this pool
					$sql = "SELECT user_id FROM poolmembers WHERE user_id = '$inviteduser' AND pool_id = '{$_GET['pool']}'";
					$row = $dbh->queryRow($sql);
					if($row)
					{
						$error['email'] = 'This user has already been invited.';
					}
				}
			}
			
			// If there are no errors, invite user
			// Otherwise, display error
			if(sizeof($error) == 0)
			{
				// Insert user into poolmembers table
				$sql = "INSERT INTO poolmembers (
							pool_id, 
							user_id,
							role,
							status
						) VALUES (
							'{$_GET['pool']}', 
							'$inviteduser', 
							'member', 
							'pending'
						)";
				$dbh->query($sql);
				
				// Compose message
				$message = 'Dear ' . $invitedfirstname . ' ' . $invitedlastname . ', ' . "\n\n";
				$message .= 'You have been invited to participate in a carpool. Please login to Purpool... more instructions needed.' . "\n\n";
			
				// E-mail user
				mail($_POST['email'], 'Purpool Invitation', $message, "From: ".$MISC['admin_email']);
			
				// Redirect user to dashboard
				header("Location: pools.php?state=editmembers&pool={$_GET['pool']}&confirmation=invitemember");
			
				// Disconnect from database
				$dbh->disconnect();
				exit();
			
			} else {
				
				// Display errors
				$tpl->assign('error', $error);
			
			}
		}
		
		// Assign pool_id
		$tpl->assign('pool_id', $_GET['pool']);
		
		// Assign current side navigation
		$tpl->assign('poolscurrent', true);
		
		// Get current members
		$sql = "SELECT
					a.user_id AS user_id,
					a.firstname AS firstname,
					a.lastname AS lastname,
					a.email AS email,
					b.role AS role
				FROM
					users a, poolmembers b
				WHERE
					a.user_id = b.user_id AND b.pool_id = '{$_GET['pool']}' AND b.status = 'accepted'
				ORDER BY
					a.lastname";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			$accepted[] = array(
				'user_id' => $row['user_id'],
				'name' => $row['firstname'] . ' ' . $row['lastname'],
				'email' => $row['email'],
				'role' => $row['role']
			);
		}
		$tpl->assign('accepted', $accepted);
		
		// Get invited members
		$sql = "SELECT
					a.user_id AS user_id,
					a.firstname AS firstname,
					a.lastname AS lastname,
					a.email AS email,
					b.status AS status
				FROM
					users a, poolmembers b
				WHERE
					a.user_id = b.user_id AND b.pool_id = '{$_GET['pool']}' AND b.status != 'accepted'
				ORDER BY
					a.lastname";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			$invited[] = array(
				'user_id' => $row['user_id'],
				'name' => $row['firstname'] . ' ' . $row['lastname'],
				'email' => $row['email'],
				'status' => $row['status']
			);
		}
		$tpl->assign('invited', $invited);

		// Display Template
		$tpl->display('pools-members.tpl');
		
		// Disconnect from database
		$dbh->disconnect();
		exit();	
	
	break;
	
	// GET EMAIL ADDRESSES FOR AUTOCOMPLETE BOX
	case "getinviteemail":
	
		// Get e-mail addresses
		$sql = "SELECT email FROM users WHERE email LIKE '{$_POST['email']}%'";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			$emails[] = array(
				'email' => $row['email']
			);
		}
		$tpl->assign('emails', $emails);
		
		// Format results
		$output = $tpl->fetch('inviteemail.tpl');
		
		// Output to browser
		echo $output;
		
		// Disconnect from database
		$dbh->disconnect();
		exit();
	
	break;
	
	# GET PARKANDRIDE ADDRESS
	case "getparkandrideaddress":
	
		// Get address
		$sql = "SELECT address1, address2, city, state, zip FROM parkandrides WHERE parkandride_id = '{$_GET['parkandride']}'";
		$row = $dbh->queryRow($sql);
		
		// Build JSON array
		$json = array(
			"status" => "success",
			"address1" => $row['address1'],
			"address2" => $row['address2'],
			"city" => $row['city'],
			"state" => $row['state'],
			"zip" => $row['zip']
		);
		
		// Out response to browser
		$output = json_encode($json);
		
		// Output to browser
		echo $output;
		
		// Disconnect from database
		$dbh->disconnect();
		exit();
		
	break;
	
	# GET WORKPLACE ADDRESS
	case "getworkplaceaddress":
	
		// Get address
		$sql = "SELECT address1, address2, city, state, zip FROM workplaces WHERE workplace_id = '{$_GET['workplace']}'";
		$row = $dbh->queryRow($sql);
		
		// Build JSON array
		$json = array(
			"status" => "success",
			"address1" => $row['address1'],
			"address2" => $row['address2'],
			"city" => $row['city'],
			"state" => $row['state'],
			"zip" => $row['zip']
		);
		
		// Out response to browser
		$output = json_encode($json);
		
		// Output to browser
		echo $output;
		
		// Disconnect from database
		$dbh->disconnect();
		exit();
	
	break;

	# ADD NEW POOL
	case "addpool":
	
		// If the submit button has been pressed
		if(isset($_POST['submit']))
		{
			// Create error array
			$error = array();
			
			// Check for a title
			if(empty($_POST['title']))
			{
				$error['title'] = 'A title is required.';
			} else {
				// Check to see that the title is unique
				$sql = "SELECT title FROM pools WHERE title = '{$_POST['title']}'";
				$row = $dbh->queryRow($sql);
				if($row)
				{
					$error['title'] = 'This title is already taken. Please choose another.';
				}
			}
			
			// Check for a start latitude and longitude
			if((empty($_POST['startlat']) && (empty($_POST['startlng']))
			{
				$error['startplace'] = 'An starting place is required';
			}
			
			// Check for a end latitude and longitude
			if((empty($_POST['endlat']) && (empty($_POST['endlng']))
			{
				$error['endplace'] = 'An end place is required';
			}

			// If there are no errors, create pool
			// Otherwise, display errors
			if(sizeof($error) == 0)
			{
				// Insert pool information
				$sql = "INSERT INTO pools (
					pool_id,
					title, 
					smoking,
					startplace,
					startaddress1,
					startaddress2,
					startcity,
					startstate,
					startzip,
					startlatitude,
					startlongitude,
					endplace,
					endaddress1,
					endaddress2,
					endcity,
					endstate,
					endzip,
					endlatitude,
					endlongitude,
					distance,
					access,
					additionalinfo,
					submitdate
				) VALUES (
					NULL,
					'{$_POST['title']}',
					'{$_POST['smoking']}',
					'{$_POST['startplace']}',
					'{$_POST['startaddress1']}',
					'{$_POST['startaddress2']}',
					'{$_POST['startcity']}',
					'{$_POST['startstate']}',
					'{$_POST['startzip']}',
					'{$_POST['startlat']}',
					'{$_POST['startlng']}',
					'{$_POST['endplace']}',
					'{$_POST['endaddress1']}',
					'{$_POST['endaddress2']}',
					'{$_POST['endcity']}',
					'{$_POST['endstate']}',
					'{$_POST['endzip']}',
					'{$_POST['endlat']}',
					'{$_POST['endlng']}',
					'{$_POST['distance']}',
					'{$_POST['access']}',
					'{$_POST['additionalinfo']}',
					NOW()
				)";
				$dbh->query($sql);
				
				// Get pool_id
				$sql = "SELECT pool_id FROM pools WHERE title = '{$_POST['title']}'";
				$row = $dbh->queryRow($sql);
				
				// Insert pool owner into poolmembers table
				$sql = "INSERT INTO poolmembers (
					pool_id, 
					user_id,
					role, 
					status
				) VALUES (
					'{$row['pool_id']}',
					'{$_SESSION['user_id']}',
					'owner',
					'accepted'
				)";
				$dbh->query($sql);
				
				// Log action
				Utils::logAction($_SESSION['username'], 'Created New Pool', $_POST['title']);
				
				// Compose message
				$message = 'Dear ' . $_SESSION['fullname'] . ', ' . "\n\n";
				$message = $message . 'This is a test message. You created a pool.';
				
				// Build JSON array
				$json = array(
					"status" => "success",
					"day" => $_GET['dayofweek']
				);
				
				
			} else {
			
				// Build JSON array
				$json = array(
					"status" => "failure",
					"error" => $error
				);
			
			}
			
			// Out response to browser
			$output = json_encode($json);
			
			// Output to browser
			echo $output;
			
			// Disconnect from database
			$dbh->disconnect();
			exit();	
			
		}	
	
	break;
	
	# CREATE POOL
	case "createpool":
	
		// Get parkandrides
		$sql = "SELECT parkandride_id, name FROM parkandrides ORDER BY name";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			$parkandrides[] = array(
				'parkandride_id' => $row['parkandride_id'],
				'name' => $row['name']
			);
		}
		$tpl->assign('parkandrides', $parkandrides);
		
		// Get workplaces
		$sql = "SELECT workplace_id, name FROM workplaces ORDER BY name";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			$workplaces[] = array(
				'workplace_id' => $row['workplace_id'],
				'name' => $row['name']
			);
		}
		$tpl->assign('workplaces', $workplaces);
		
		// If the submit button has been pressed
		if(isset($_POST['submit']))
		{
			// Create error array
			$error = array();
			
			// Check for a title
			if(empty($_POST['title']))
			{
				$error['title'] = 'A title is required.';
			} else {
				// Check to see that the title is unique
				$sql = "SELECT title FROM pools WHERE title = '{$_POST['title']}'";
				$row = $dbh->queryRow($sql);
				if($row)
				{
					$error['title'] = 'This title is already taken. Please choose another.';
				}
				$tpl->assign('title', $_POST['title']);
			}
			
			// Check for type
			$tpl->assign('type', $_POST['type']);
			
			// Check for ride frequency
			$tpl->assign('frequency', $_POST['frequency']);
			
			// Check for days
			if(
				empty($_POST['sunday']) && 
				empty($_POST['monday']) && 
				empty($_POST['tuesday']) && 
				empty($_POST['wednesday']) && 
				empty($_POST['thursday']) && 
				empty($_POST['friday']) && 
				empty($_POST['saturday']) 
			)
			{
				$error['daysofweek'] = 'At least one day is required.';
			} else {
				$tpl->assign('sunday', $_POST['sunday']);
				$tpl->assign('monday', $_POST['monday']);
				$tpl->assign('tuesday', $_POST['tuesday']);
				$tpl->assign('wednesday', $_POST['wednesday']);
				$tpl->assign('thursday', $_POST['thursday']);
				$tpl->assign('friday', $_POST['friday']);
				$tpl->assign('saturday', $_POST['saturday']);
			}
			
			// Check for smoking
			$tpl->assign('smoking', $_POST['smoking']);
			
			// Check for access
			$tpl->assign('access', $_POST['access']);
			
			// Check for a start place
			$tpl->assign('startplace', $_POST['startplace']);
			
			// Check for a start address
			if(empty($_POST['startaddress1']))
			{
				$error['startaddress1'] = 'An address is required.';
			} else {
				$tpl->assign('startaddress1', $_POST['startaddress1']);
			}
			
			// Check for a start city
			if(empty($_POST['startcity']))
			{
				$error['startcity'] = 'A city is required.';
			} else {
				$tpl->assign('startcity', $_POST['startcity']);
			}
			
			// Check for a start state
			if(empty($_POST['startstate']))
			{
				$error['startstate'] = 'A state is required.';
			} else {
				$tpl->assign('startstate', $_POST['startstate']);
			}
			
			// Check for a start zipcode
			if(empty($_POST['startzip']))
			{
				$error['startzip'] = 'A zipcode is required.';
			} else {
				$tpl->assign('startzip', $_POST['startzip']);
			}
			
			// Check for an end place
			$tpl->assign('endplace', $_POST['endplace']);
			
			// Check for an end address
			if(empty($_POST['endaddress1']))
			{
				$error['endaddress1'] = 'An address is required.';
			} else {
				$tpl->assign('endaddress1', $_POST['endaddress1']);
			}
			
			// Check for a end city
			if(empty($_POST['endcity']))
			{
				$error['endcity'] = 'A city is required.';
			} else {
				$tpl->assign('endcity', $_POST['endcity']);
			}
			
			// Check for an end state
			if(empty($_POST['endstate']))
			{
				$error['endstate'] = 'A state is required.';
			} else {
				$tpl->assign('endstate', $_POST['endstate']);
			}
			
			// Check for an end zipcode
			if(empty($_POST['endzip']))
			{
				$error['endzip'] = 'A zipcode is required.';
			} else {
				$tpl->assign('endzip', $_POST['endzip']);
			}
			
			// Clean arrival time
			if($_POST['arriveampm'] == 'pm')
			{
				$arrivetime = $_POST['arrivehour'] + 12 . ':' . $_POST['arriveminute'] . ':00';
			} else {
				$arrivetime = $_POST['arrivehour']. ':' . $_POST['arriveminute'] . ':00';
			}
			$tpl->assign('arrivehour', $_POST['arrivehour']);
			$tpl->assign('arriveminute', $_POST['arriveminute']);
			$tpl->assign('arriveampm', $_POST['arriveampm']);
			
			// Clean departure time
			if($_POST['type'] == 'round')
			{
				if($_POST['departampm'] == 'pm')
				{
					$departtime = $_POST['departhour'] + 12 . ':' . $_POST['departminute'] . ':00';
				} else {
					$departtime = $_POST['departhour']. ':' . $_POST['departminute'] . ':00';
				}
			}
			$tpl->assign('departhour', $_POST['departhour']);
			$tpl->assign('departminute', $_POST['departminute']);
			$tpl->assign('departampm', $_POST['departampm']);
			
			// Assign access
			$tpl->assign('access', $_POST['access']);
			
			// If there are no errors, create pool
			// Otherwise, display errors
			if(sizeof($error) == 0)
			{
				// Insert pool information
				$sql = "INSERT INTO pools (
					pool_id,
					title, 
					ptype,
					frequency, 
					sunday, 
					monday, 
					tuesday, 
					wednesday,
					thursday,
					friday,
					saturday,
					smoking,
					startplace,
					startaddress1,
					startaddress2,
					startcity,
					startstate,
					startzip,
					endplace,
					endaddress1,
					endaddress2,
					endcity,
					endstate,
					endzip,
					arrivetime,
					departtime,
					access,
					additionalinfo,
					submitdate
				) VALUES (
					NULL,
					'{$_POST['title']}',
					'{$_POST['type']}',
					'{$_POST['frequency']}',
					'{$_POST['sunday']}',
					'{$_POST['monday']}',
					'{$_POST['tuesday']}',
					'{$_POST['wednesday']}',
					'{$_POST['thursday']}',
					'{$_POST['friday']}',
					'{$_POST['saturday']}',
					'{$_POST['smoking']}',
					'{$_POST['startplace']}',
					'{$_POST['startaddress1']}',
					'{$_POST['startaddress2']}',
					'{$_POST['startcity']}',
					'{$_POST['startstate']}',
					'{$_POST['startzip']}',
					'{$_POST['endplace']}',
					'{$_POST['endaddress1']}',
					'{$_POST['endaddress2']}',
					'{$_POST['endcity']}',
					'{$_POST['endstate']}',
					'{$_POST['endzip']}',
					'{$arrivetime}',
					'{$departtime}',
					'{$_POST['access']}',
					'{$_POST['additionalinfo']}',
					NOW()
				)";
				$dbh->query($sql);
				
				// Get pool_id
				$sql = "SELECT pool_id FROM pools WHERE title = '{$_POST['title']}'";
				$row = $dbh->queryRow($sql);
				
				// Insert pool owner into poolmembers table
				$sql = "INSERT INTO poolmembers (
					pool_id, 
					user_id,
					role, 
					status
				) VALUES (
					'{$row['pool_id']}',
					'{$_SESSION['user_id']}',
					'owner',
					'accepted'
				)";
				$dbh->query($sql);
				
				// Log action
				Utils::logAction($_SESSION['username'], 'Created New Pool', $_POST['title']);
				
				// Compose message
				$message = 'Dear ' . $_SESSION['fullname'] . ', ' . "\n\n";
				$message = $message . 'This is a test message. You created a pool.';
				
				// E-mail user
				//mail($_COOKIE['email'], 'Purpool Ride Confirmation', $message, "From: ".$MISC['admin_email']);
				
				// Redirect user
				header("Location: pools.php?confirmation=createpool");

			} else {
		
				// Assign errors to template
				$tpl->assign('error', $error);		
			
			}
		
		} else {
		
			// Get current workplace and populate departure fields
			$sql = "SELECT 
						a.workplace AS workplace, 
						b.address1 AS address1, 
						b.address2 AS address2, 
						b.city AS city, 
						b.state AS state, 
						b.zip AS zip 
					FROM
						users a, workplaces b 
					WHERE
						a.user_id = '{$_SESSION['user_id']}' AND a.workplace = b.workplace_id";
			$row = $dbh->queryRow($sql);
			$tpl->assign('workplace', $row['workplace']);
			$tpl->assign('endaddress1', $row['address1']);
			$tpl->assign('endaddress2', $row['address2']);
			$tpl->assign('endcity', $row['city']);
			$tpl->assign('endstate', $row['state']);
			$tpl->assign('endzip', $row['zip']);
			
			// Create default values for ride
			$tpl->assign('type', 'round');
			$tpl->assign('frequency', 'weekly');
			$tpl->assign('smoking', 'no');
			$tpl->assign('arrivehour', '9');
			$tpl->assign('arriveminute', '00');
			$tpl->assign('arriveampm', 'am');
			$tpl->assign('departhour', '5');
			$tpl->assign('departminute', '00');
			$tpl->assign('departampm', 'pm');
			$tpl->assign('access', 'private');
		
		}
		
		// Assign current side navigation
		$tpl->assign('poolscurrent', true);
		
		// Display template
		$tpl->display('pools-create.tpl');

		// Disconnect from database
		$dbh->disconnect();
		exit();	
	
	break;
	
	# EDIT POOL
	case "editpool":
	
		// If the submit button has been pressed
		if(isset($_POST['submit']))
		{
			// Create error array
			$error = array();
			
			// Check for a title
			if(empty($_POST['title']))
			{
				$error['title'] = 'A title is required.';
			} else {
				// Check to see that the title is unique
				$sql = "SELECT title FROM pools WHERE title = '{$_POST['title']}' AND pool_id != '{$_GET['pool']}'";
				$row = $dbh->queryRow($sql);
				if($row)
				{
					$error['title'] = 'This title is already taken. Please choose another.';
				}
				$tpl->assign('title', $_POST['title']);
			}
			
			// Check for type
			$tpl->assign('type', $_POST['type']);
			
			// Check for ride frequency
			$tpl->assign('frequency', $_POST['frequency']);
			
			// Check for days
			if(
				empty($_POST['sunday']) && 
				empty($_POST['monday']) && 
				empty($_POST['tuesday']) && 
				empty($_POST['wednesday']) && 
				empty($_POST['thursday']) && 
				empty($_POST['friday']) && 
				empty($_POST['saturday']) 
			)
			{
				$error['daysofweek'] = 'At least one day is required.';
			} else {
				$tpl->assign('sunday', $_POST['sunday']);
				$tpl->assign('monday', $_POST['monday']);
				$tpl->assign('tuesday', $_POST['tuesday']);
				$tpl->assign('wednesday', $_POST['wednesday']);
				$tpl->assign('thursday', $_POST['thursday']);
				$tpl->assign('friday', $_POST['friday']);
				$tpl->assign('saturday', $_POST['saturday']);
			}
			
			// Check for smoking
			$tpl->assign('smoking', $_POST['smoking']);
			
			// Check for a start place
			$tpl->assign('startplace', $_POST['startplace']);
			
			// Check for a start address
			if(empty($_POST['startaddress1']))
			{
				$error['startaddress1'] = 'An address is required.';
			} else {
				$tpl->assign('startaddress1', $_POST['startaddress1']);
			}
			
			// Check for a start city
			if(empty($_POST['startcity']))
			{
				$error['startcity'] = 'A city is required.';
			} else {
				$tpl->assign('startcity', $_POST['startcity']);
			}
			
			// Check for a start state
			if(empty($_POST['startstate']))
			{
				$error['startstate'] = 'A state is required.';
			} else {
				$tpl->assign('startstate', $_POST['startstate']);
			}
			
			// Check for a start zipcode
			if(empty($_POST['startzip']))
			{
				$error['startzip'] = 'A zipcode is required.';
			} else {
				$tpl->assign('startzip', $_POST['startzip']);
			}
			
			// Check for an end place
			$tpl->assign('endplace', $_POST['endplace']);
			
			// Check for an end address
			if(empty($_POST['endaddress1']))
			{
				$error['endaddress1'] = 'An address is required.';
			} else {
				$tpl->assign('endaddress1', $_POST['endaddress1']);
			}
			
			// Check for a end city
			if(empty($_POST['endcity']))
			{
				$error['endcity'] = 'A city is required.';
			} else {
				$tpl->assign('endcity', $_POST['endcity']);
			}
			
			// Check for an end state
			if(empty($_POST['endstate']))
			{
				$error['endstate'] = 'A state is required.';
			} else {
				$tpl->assign('endstate', $_POST['endstate']);
			}
			
			// Check for an end zipcode
			if(empty($_POST['endzip']))
			{
				$error['endzip'] = 'A zipcode is required.';
			} else {
				$tpl->assign('endzip', $_POST['endzip']);
			}
			
			// Clean arrival time
			if($_POST['arriveampm'] == 'pm')
			{
				$arrivetime = $_POST['arrivehour'] + 12 . ':' . $_POST['arriveminute'] . ':00';
			} else {
				$arrivetime = $_POST['arrivehour']. ':' . $_POST['arriveminute'] . ':00';
			}
			$tpl->assign('arrivehour', $_POST['arrivehour']);
			$tpl->assign('arriveminute', $_POST['arriveminute']);
			$tpl->assign('arriveampm', $_POST['arriveampm']);
			
			// Clean departure time
			if($_POST['type'] == 'round')
			{
				if($_POST['departampm'] == 'pm')
				{
					$departtime = $_POST['departhour'] + 12 . ':' . $_POST['departminute'] . ':00';
				} else {
					$departtime = $_POST['departhour']. ':' . $_POST['departminute'] . ':00';
				}
			}
			$tpl->assign('departhour', $_POST['departhour']);
			$tpl->assign('departminute', $_POST['departminute']);
			$tpl->assign('departampm', $_POST['departampm']);
			
			// If there are no errors, create pool
			// Otherwise, display errors
			if(sizeof($error) == 0)
			{
				// Update pool information
				$sql = "UPDATE pools SET
							title = '{$_POST['title']}',
							ptype = '{$_POST['type']}',
							frequency = '{$_POST['frequency']}',
							sunday = '{$_POST['sunday']}',
							monday = '{$_POST['monday']}',
							tuesday = '{$_POST['tuesday']}',
							wednesday = '{$_POST['wednesday']}',
							thursday = '{$_POST['thursday']}',
							friday = '{$_POST['friday']}',
							saturday = '{$_POST['saturday']}',
							smoking = '{$_POST['smoking']}',
							startplace = '{$_POST['startplace']}',
							startaddress1 = '{$_POST['startaddress1']}',
							startaddress2 = '{$_POST['startaddress2']}',
							startcity = '{$_POST['startcity']}',
							startstate = '{$_POST['startstate']}',
							startzip = '{$_POST['startzip']}',
							endplace = '{$_POST['endplace']}',
							endaddress1 = '{$_POST['endaddress1']}',
							endaddress2 = '{$_POST['endaddress2']}',
							endcity = '{$_POST['endcity']}',
							endstate = '{$_POST['endstate']}',
							endzip = '{$_POST['endzip']}',
							arrivetime = '$arrivetime',
							departtime = '$departtime',
							additionalInfo = '{$_POST['additionalinfo']}'
						WHERE
							pool_id = '{$_GET['pool']}'";		
				$dbh->query($sql);
				
				// Log action
				Utils::logAction($_SESSION['username'], 'Edit Pool', $_POST['title']);
				
				// Redirect user
				header("Location: pools.php?confirmation=editpool");
				
			} else {
		
				// Assign errors to template
				$tpl->assign('error', $error);		
			
			}
		
		} else {
		
			// Get current pool details
			$sql = "SELECT
						title,
						ptype,
						frequency,
						sunday,
						monday,
						tuesday,
						wednesday,
						thursday,
						friday,
						saturday,
						smoking,
						startplace,
						startaddress1,
						startaddress2,
						startcity,
						startstate,
						startzip,
						endplace,
						endaddress1,
						endaddress2,
						endcity,
						endstate,
						endzip,
						additionalinfo
					FROM
						pools
					WHERE
						pool_id = '{$_GET['pool']}'";
			$row = $dbh->queryRow($sql);
			
			
				
			// Assign template variables
			$tpl->assign('title', $row['title']);
			$tpl->assign('type', $row['ptype']);
			$tpl->assign('frequency', $row['frequency']);
			$tpl->assign('sunday', $row['sunday']);
			$tpl->assign('monday', $row['monday']);
			$tpl->assign('tuesday', $row['tuesday']);
			$tpl->assign('wednesday', $row['wednesday']);
			$tpl->assign('thursday', $row['thursday']);
			$tpl->assign('friday', $row['friday']);
			$tpl->assign('saturday', $row['saturday']);
			$tpl->assign('smoking', $row['smoking']);
			$tpl->assign('startplace', $row['startplace']);
			$tpl->assign('startaddress1', $row['startaddress1']);
			$tpl->assign('startaddress2', $row['startaddress2']);
			$tpl->assign('startcity', $row['startcity']);
			$tpl->assign('startstate', $row['startstate']);
			$tpl->assign('startzip', $row['startzip']);
			$tpl->assign('endplace', $row['endplace']);
			$tpl->assign('endaddress1', $row['endaddress1']);
			$tpl->assign('endaddress2', $row['endaddress2']);
			$tpl->assign('endcity', $row['endcity']);
			$tpl->assign('endstate', $row['endstate']);
			$tpl->assign('endzip', $row['endzip']);
			$tpl->assign('arrivehour', $arriveHour);
			$tpl->assign('arriveminute', $arriveMinute);
			$tpl->assign('arriveampm', $arriveAmpm);
			$tpl->assign('departhour', $departHour);
			$tpl->assign('departminute', $departMinute);
			$tpl->assign('departampm', $departAmpm);
			$tpl->assign('additionalinfo', $row['additionalinfo']);
		
		}
		
		// Assign pool_id
		$tpl->assign('pool_id', $_GET['pool']);
		
		// Assign current side navigation
		$tpl->assign('poolscurrent', true);
		
		// Display template
		$tpl->display('pools-edit.tpl');

		// Disconnect from database
		$dbh->disconnect();
		exit();	
	
	break;
	
	# ACCEPT INVITATION
	case "accept":
	
		// Update status in poolmembers table
		$sql = "UPDATE poolmembers SET status = 'accepted' WHERE user_id = '{$_SESSION['user_id']}' AND pool_id = '{$_GET['pool']}'";
		$dbh->query($sql);
		
		// Redirect user
		header("Location: dashboard.php?confirmation=accept");
	
		// Disconnect from database
		$dbh->disconnect();
		exit();
	
	break;
	
	# DECLINE INVITATION
	case "decline":
	
		// Update status in poolmembers table
		$sql = "UPDATE poolmembers SET status = 'declined' WHERE user_id = '{$_SESSION['user_id']}' AND pool_id = '{$_GET['pool']}'";
		$dbh->query($sql);
		
		// Redirect user
		header("Location: dashboard.php?confirmation=decline");
	
		// Disconnect from database
		$dbh->disconnect();
		exit();
	
	break;
	
	# VIEW SCHEDULE
	case "viewschedule":
	
		// Assign pagetitle
		$tpl->assign('pagetitle', 'Pools');
		
		// Assign pool_id
		$tpl->assign('pool_id', $_GET['pool']);
		
		// Assign current side navigation
		$tpl->assign('poolscurrent', true);
		
		// Get pool information
		$sql = "SELECT
					title,
					smoking,
					startplace,
					startaddress1,
					startaddress2,
					startcity,
					startstate,
					startzip,
					endplace,
					endaddress1,
					endaddress2,
					endcity,
					endstate,
					endzip,
					access,
					additionalinfo
				FROM 
					pools
				WHERE
					pool_id = '{$_GET['pool']}'";
		$row = $dbh->queryRow($sql);
		
		// Assign template variables
		$tpl->assign('title', $row['title']);
		$tpl->assign('smoking', $row['smoking']);
		$tpl->assign('startplace', $row['startplace']);
		$tpl->assign('startaddress1', $row['startaddress1']);
		$tpl->assign('startaddress2', $row['startaddress2']);
		$tpl->assign('startcity', $row['startcity']);
		$tpl->assign('startstate', $row['startstate']);
		$tpl->assign('startzip', $row['startzip']);
		$tpl->assign('endplace', $row['endplace']);
		$tpl->assign('endaddress1', $row['endaddress1']);
		$tpl->assign('endaddress2', $row['endaddress2']);
		$tpl->assign('endcity', $row['endcity']);
		$tpl->assign('endstate', $row['endstate']);
		$tpl->assign('endzip', $row['endzip']);
		$tpl->assign('access', $row['access']);
		$tpl->assign('additionalinfo', $row['additionalinfo']);
		
		// Get the number of weeks in the current year
		if($_GET['year'])
		{
			$lastdaycurrentyear = '12/31/' . $_GET['year'];
			$lastdaypreviousyear = '12/31/' . $_GET['year'] - 1;
		} else {
			$lastdaycurrentyear = '12/31/' . date('Y');
			$lastdaypreviousyear = '12/31/' . date('Y') - 1;
		}
		$numweekscurrentyear = strftime("%W",strtotime("12/31/$lastdaycurrentyear"));
		$numweekspreviousyear = strftime("%W",strtotime("12/31/$lastdaypreviousyear"));
		
		// Get current week and year
		if($_GET['week'] && $_GET['year'])
		{
			$week = $_GET['week'];
			$year = $_GET['year'];
		} else {
			$week = date('W');
			$year = date('Y');
		}
		
		// Create pagination links
		if($week == $numweekscurrentyear)
		{
			$tpl->assign('pweek', $week - 1);
			$tpl->assign('pyear', $year);
			$tpl->assign('nweek', '01');
			$tpl->assign('nyear', $year + 1);
		} elseif($week == '01') {
			$tpl->assign('pweek', $numweekspreviousyear);
			$tpl->assign('pyear', $year - 1);
			$tpl->assign('nweek', sprintf("%02d", $week + 1));
			$tpl->assign('nyear', $year);
		} else {
			$tpl->assign('pweek', sprintf("%02d", $week - 1));
			$tpl->assign('pyear', $year);
			$tpl->assign('nweek', sprintf("%02d",$week + 1));
			$tpl->assign('nyear', $year);
		}

		// Calculate days of week
		$datemonday = date("l, m/d/Y", strtotime("{$year}-W{$week}-1"));
		$datetuesday = date("l, m/d/Y", strtotime("{$year}-W{$week}-2"));
		$datewednesday = date("l, m/d/Y", strtotime("{$year}-W{$week}-3"));
		$datethursday = date("l, m/d/Y", strtotime("{$year}-W{$week}-4"));
		$datefriday = date("l, m/d/Y", strtotime("{$year}-W{$week}-5"));
		$datesaturday = date("l, m/d/Y", strtotime("{$year}-W{$week}-6"));
    	$datesunday = date("l, m/d/Y", strtotime("{$year}-W{$week}-7"));

		// Calculate day number
		$daymonday = date("z", strtotime("{$year}-W{$week}-1"));
		$daytuesday = date("z", strtotime("{$year}-W{$week}-2"));
		$daywednesday = date("z", strtotime("{$year}-W{$week}-3"));
		$daythursday = date("z", strtotime("{$year}-W{$week}-4"));
		$dayfriday = date("z", strtotime("{$year}-W{$week}-5"));
		$daysaturday = date("z", strtotime("{$year}-W{$week}-6"));
    	$daysunday = date("z", strtotime("{$year}-W{$week}-7"));
		
		// Assign day numbers
		$tpl->assign('daymonday', $daymonday);
		$tpl->assign('daytuesday', $daytuesday);
		$tpl->assign('daywednesday', $daywednesday);
		$tpl->assign('daythursday', $daythursday);
		$tpl->assign('dayfriday', $dayfriday);
		$tpl->assign('daysaturday', $daysaturday);
		$tpl->assign('daysunday', $daysunday);
		
		// Assign date range
		$daterange = $datemonday . ' through ' . $datesunday;
		$tpl->assign('dates', $daterange);
		
		// Get pool members
		$sql = "SELECT 
					a.user_id AS user_id, 
					a.role AS role,
					b.firstname AS firstname, 
					b.lastname AS lastname
				FROM 
					poolmembers a, users b
				WHERE 
					a.user_id = b.user_id AND a.pool_id = '{$_GET['pool']}' AND a.status = 'accepted'
				ORDER BY
					b.lastname";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			// Check for user confirmation
			if($row['user_id'] == $_SESSION['user_id'])
			{
				$editable = true;	
			} else {
				$editable = false;
			}

			// Check to see if the user has confirmed
			$sql2 = "SELECT confirm FROM passengers WHERE user_id = '{$row['user_id']}' AND pool_id = '{$_GET['pool']}' AND day = '$daymonday'";
			$row2 = $dbh->queryRow($sql2);
			$mondayconfirm = $row2['confirm'];
			$sql2 = "SELECT confirm FROM passengers WHERE user_id = '{$row['user_id']}' AND pool_id = '{$_GET['pool']}' AND day = '$daytuesday'";
			$row2 = $dbh->queryRow($sql2);
			$tuesdayconfirm = $row2['confirm'];
			$sql2 = "SELECT confirm FROM passengers WHERE user_id = '{$row['user_id']}' AND pool_id = '{$_GET['pool']}' AND day = '$daywednesday'";
			$row2 = $dbh->queryRow($sql2);
			$wednesdayconfirm = $row2['confirm'];
			$sql2 = "SELECT confirm FROM passengers WHERE user_id = '{$row['user_id']}' AND pool_id = '{$_GET['pool']}' AND day = '$daythursday'";
			$row2 = $dbh->queryRow($sql2);
			$thursdayconfirm = $row2['confirm'];
			$sql2 = "SELECT confirm FROM passengers WHERE user_id = '{$row['user_id']}' AND pool_id = '{$_GET['pool']}' AND day = '$dayfriday'";
			$row2 = $dbh->queryRow($sql2);
			$fridayconfirm = $row2['confirm'];
			$sql2 = "SELECT confirm FROM passengers WHERE user_id = '{$row['user_id']}' AND pool_id = '{$_GET['pool']}' AND day = '$daysaturday'";
			$row2 = $dbh->queryRow($sql2);
			$saturdayconfirm = $row2['confirm'];
			$sql2 = "SELECT confirm FROM passengers WHERE user_id = '{$row['user_id']}' AND pool_id = '{$_GET['pool']}' AND day = '$daysunday'";
			$row2 = $dbh->queryRow($sql2);
			$sundayconfirm = $row2['confirm'];
			
			// Check to see when the user is driving
			$sql3 = "SELECT driver FROM rides WHERE pool_id = '{$_GET['pool']}' AND day = '$daymonday'";
			$row3 = $dbh->queryRow($sql3);
			$mondaydriver = $row3['driver'];
			$sql3 = "SELECT driver FROM rides WHERE pool_id = '{$_GET['pool']}' AND day = '$daytuesday'";
			$row3 = $dbh->queryRow($sql3);
			$tuesdaydriver = $row3['driver'];
			$sql3 = "SELECT driver FROM rides WHERE pool_id = '{$_GET['pool']}' AND day = '$daywednesday'";
			$row3 = $dbh->queryRow($sql3);
			$wednesdaydriver = $row3['driver'];
			$sql3 = "SELECT driver FROM rides WHERE pool_id = '{$_GET['pool']}' AND day = '$daythursday'";
			$row3 = $dbh->queryRow($sql3);
			$thursdaydriver = $row3['driver'];
			$sql3 = "SELECT driver FROM rides WHERE pool_id = '{$_GET['pool']}' AND day = '$dayfriday'";
			$row3 = $dbh->queryRow($sql3);
			$fridaydriver = $row3['driver'];
			$sql3 = "SELECT driver FROM rides WHERE pool_id = '{$_GET['pool']}' AND day = '$daysaturday'";
			$row3 = $dbh->queryRow($sql3);
			$saturdaydriver = $row3['driver'];
			$sql3 = "SELECT driver FROM rides WHERE pool_id = '{$_GET['pool']}' AND day = '$daysunday'";
			$row3 = $dbh->queryRow($sql3);
			$sundaydriver = $row3['driver'];
			
			$members[] = array(
				'user_id' => $row['user_id'],
				'name' => $row['firstname'] . ' ' . $row['lastname'],
				'status' => $row['status'],
				'editable' => $editable,
				'mondayconfirm' => $mondayconfirm,
				'tuesdayconfirm' => $tuesdayconfirm,
				'wednesdayconfirm' => $wednesdayconfirm,
				'thursdayconfirm' => $thursdayconfirm,
				'fridayconfirm' => $fridayconfirm,
				'saturdayconfirm' => $mondayconfirm,
				'sundayconfirm' => $mondayconfirm,
				'mondaydriver' => $mondaydriver,
				'tuesdaydriver' => $tuesdaydriver,
				'wednesdaydriver' => $wednesdaydriver,
				'thursdaydriver' => $thursdaydriver,
				'fridaydriver' => $fridaydriver,
				'saturdaydriver' => $saturdaydriver,
				'sundaydriver' => $sundaydriver,
			);
		}
		$tpl->assign('members', $members);
		
		// Get pool days
		$sql = "SELECT monday, tuesday, wednesday, thursday, friday, saturday, sunday FROM schedule WHERE pool_id = '{$_GET['pool']}'";
		$row = $dbh->queryRow($sql);
		
		// Check for a monday
		if($row['monday'] == 'y')
		{
			$tpl->assign('monday', true);
			$tpl->assign('datemonday', $datemonday);
		}
		
		// Check for a tuesday
		if($row['tuesday'] == 'y')
		{
			$tpl->assign('tuesday', true);
			$tpl->assign('datetuesday', $datetuesday);
		}
		
		// Check for a wednesday
		if($row['wednesday'] == 'y')
		{
			$tpl->assign('wednesday', true);
			$tpl->assign('datewednesday', $datewednesday);
		}
		
		// Check for a thursday
		if($row['thursday'] == 'y')
		{
			$tpl->assign('thursday', true);
			$tpl->assign('datethursday', $datethursday);
		}
		
		// Check for a friday
		if($row['friday'] == 'y')
		{
			$tpl->assign('friday', true);
			$tpl->assign('datefriday', $datefriday);
		}
		
		// Check for a saturday
		if($row['saturday'] == 'y')
		{
			$tpl->assign('saturday', true);
			$tpl->assign('datesaturday', $datesaturday);
		}
		
		// Check for a sunday
		if($row['sunday'] == 'y')
		{
			$tpl->assign('sunday', true);
			$tpl->assign('datesunday', $datesunday);
		}
		
		// Display Template
		$tpl->display('pools-schedule.tpl');
		
		// Disconnect from database
		$dbh->disconnect();
		exit();	
	
	break;
	
	# UPDATE DRIVER
	case "updatedriver":
	
		// Check to see if a ride exists for this day
		$sql = "SELECT ride_id FROM rides WHERE pool_id = '{$_POST['pool']}' AND day = '{$_POST['day']}'";
		$row = $dbh->queryRow($sql);
		if(!$row)
		{
			// Insert new record
			$sql = "INSERT INTO rides (pool_id, day, driver) VALUES ('{$_POST['pool']}', '{$_POST['day']}', '{$_POST['driver']}')";
			$dbh->query($sql);
		} else {
			// Update existing record
			$sql = "UPDATE rides SET driver = '{$_POST['driver']}' WHERE pool_id = '{$_POST['pool']}' AND day = '{$_POST['day']}'";
			$dbh->query($sql);
		}
		
		// Build JSON array
		$json = array(
			"status" => "success",
			"day" => $_GET['dayofweek']
		);
		
		// Out response to browser
		$output = json_encode($json);
		
		// Output to browser
		echo $output;
		
		// Disconnect from database
		$dbh->disconnect();
		exit();
	
	break;
	
	# CONFIRM
	case "confirm":
	
		// Check to see if a passengers has already confirmed
		$sql = "SELECT passenger_id FROM passengers WHERE pool_id = '{$_GET['pool']}' AND day = '{$_GET['day']}' AND user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		if(!$row)
		{
			// Insert new record
			$sql = "INSERT INTO passengers (day, pool_id, user_id, confirm) VALUES ('{$_GET['day']}', '{$_GET['pool']}', '{$_SESSION['user_id']}', '{$_GET['confirmation']}')";
			$dbh->query($sql);
		} else {
			// Update existing record
			$sql = "UPDATE passengers SET confirm = '{$_GET['confirmation']}' WHERE pool_id = '{$_GET['pool']}' AND day = '{$_GET['day']}' AND user_id = '{$_SESSION['user_id']}'";
			$dbh->query($sql);
		}
		
		// Build JSON array
		$json = array(
			"status" => "success",
			"confirmation" => $_GET['confirmation']
		);
		
		// Out response to browser
		$output = json_encode($json);
		
		// Output to browser
		echo $output;
		
		// Disconnect from database
		$dbh->disconnect();
		exit();
	
	break;
	
	# VIEW PROFILE
	case "viewprofile":
		
		// Assign pool_id
		$tpl->assign('pool_id', $_GET['pool']);
		
		// Assign current side navigation
		$tpl->assign('poolscurrent', true);
		
		// Check for a user photo
		$userPhoto = $DIR['users'] . $_GET['user'] . '.jpg';
		if(file_exists($userPhoto))
		{
			$tpl->assign('userphoto', $_GET['user'] . '.jpg');
		}
		
		// Get user profile
		$sql = "SELECT 
					firstname,
					lastname,
					gender,
					email,
					cellphone,
					workphone,
					occupation,
					vehicleseats,
					vehiclecolor,
					vehicleyear,
					vehiclemake,
					vehiclemodel,
					music,
					interests
				FROM 
					users
				WHERE
					user_id = '{$_GET['user']}'";
		$row = $dbh->queryRow($sql);
		
		// Clean musical interests
		if($row['music'])
		{
			$music = explode("|", $row['music']);
			for($i = 0; $i < sizeof($music) - 1; $i++)
			{
				$cleanmusic .= $music[$i] . ', ';
			}
			$cleanmusic = substr($cleanmusic,'',-2);
		}
		
		// Assign template values
		$tpl->assign('firstname', $row['firstname']);
		$tpl->assign('lastname', $row['lastname']);
		$tpl->assign('gender', $row['gender']);
		$tpl->assign('email', $row['email']);
		$tpl->assign('cellphone', $row['cellphone']);
		$tpl->assign('workphone', $row['workphone']);
		$tpl->assign('occupation', $row['occupation']);
		$tpl->assign('seats', $row['vehicleseats']);
		$tpl->assign('color', $row['vehiclecolor']);
		$tpl->assign('year', $row['vehicleyear']);
		$tpl->assign('make', $row['vehiclemake']);
		$tpl->assign('model', $row['vehiclemodel']);
		$tpl->assign('music', $cleanmusic);
		$tpl->assign('interests', $row['interests']);
		
		// Display Template
		$tpl->display('pools-viewprofile.tpl');
		
		// Disconnect from database
		$dbh->disconnect();
		exit();	
	
	break;
	
	# EDIT SCHEDULE
	case "editschedule":
		
		// Assign current side navigation
		$tpl->assign('poolscurrent', true);
		
		// Assign pool_id
		$tpl->assign('pool_id', $_GET['pool']);
		
		// Get pool information
		$sql = "SELECT
					title,
					smoking,
					startplace,
					startaddress1,
					startaddress2,
					startcity,
					startstate,
					startzip,
					endplace,
					endaddress1,
					endaddress2,
					endcity,
					endstate,
					endzip,
					access,
					additionalinfo
				FROM 
					pools
				WHERE
					pool_id = '{$_GET['pool']}'";
		$row = $dbh->queryRow($sql);
		
		// Assign template variables
		$tpl->assign('title', $row['title']);
		$tpl->assign('smoking', $row['smoking']);
		$tpl->assign('startplace', $row['startplace']);
		$tpl->assign('startaddress1', $row['startaddress1']);
		$tpl->assign('startaddress2', $row['startaddress2']);
		$tpl->assign('startcity', $row['startcity']);
		$tpl->assign('startstate', $row['startstate']);
		$tpl->assign('startzip', $row['startzip']);
		$tpl->assign('endplace', $row['endplace']);
		$tpl->assign('endaddress1', $row['endaddress1']);
		$tpl->assign('endaddress2', $row['endaddress2']);
		$tpl->assign('endcity', $row['endcity']);
		$tpl->assign('endstate', $row['endstate']);
		$tpl->assign('endzip', $row['endzip']);
		$tpl->assign('access', $row['access']);
		$tpl->assign('additionalinfo', $row['additionalinfo']);
		
		// If the submit button has been pressed
		if((isset($_POST['start'])) || (isset($_POST['save'])))
		{
			// Check to see at least one day has been chosen
			if(
				empty($_POST['sunday']) && 
				empty($_POST['monday']) && 
				empty($_POST['tuesday']) && 
				empty($_POST['wednesday']) && 
				empty($_POST['thursday']) && 
				empty($_POST['friday']) && 
				empty($_POST['saturday']) 
			)
			{
				$error['daysofweek'] = 'At least one day is required.';
			} else {
				$tpl->assign('sunday', $_POST['sunday']);
				$tpl->assign('monday', $_POST['monday']);
				$tpl->assign('tuesday', $_POST['tuesday']);
				$tpl->assign('wednesday', $_POST['wednesday']);
				$tpl->assign('thursday', $_POST['thursday']);
				$tpl->assign('friday', $_POST['friday']);
				$tpl->assign('saturday', $_POST['saturday']);
			}
			
			// If there are no errors
			if(sizeof($error) == 0)
			{
			
				// Check monday
				if($_POST['monday']) 
				{ 
					$monday = 'y'; 
					
					$monday_dm_time = Utils::inputtime($_POST['monday_dm_hour'], $_POST['monday_dm_minute'], $_POST['monday_dm_ampm']);
					$tpl->assign('monday_dm_hour', $_POST['monday_dm_hour']);
					$tpl->assign('monday_dm_minute', $_POST['monday_dm_minute']);
					$tpl->assign('monday_dm_ampm', $_POST['monday_dm_ampm']);
					
					$monday_aw_time = Utils::inputtime($_POST['monday_aw_hour'], $_POST['monday_aw_minute'], $_POST['monday_aw_ampm']);
					$tpl->assign('monday_aw_hour', $_POST['monday_aw_hour']);
					$tpl->assign('monday_aw_minute', $_POST['monday_aw_minute']);
					$tpl->assign('monday_aw_ampm', $_POST['monday_aw_ampm']);
					
					$monday_dw_time = Utils::inputtime($_POST['monday_dw_hour'], $_POST['monday_dw_minute'], $_POST['monday_dw_ampm']);
					$tpl->assign('monday_dw_hour', $_POST['monday_dw_hour']);
					$tpl->assign('monday_dw_minute', $_POST['monday_dw_minute']);
					$tpl->assign('monday_dw_ampm', $_POST['monday_dw_ampm']);
				} else { 
					$monday = 'n'; 
				}
			
				// Check tuesday
				if($_POST['tuesday']) 
				{ 
					$tuesday = 'y'; 
					
					$tuesday_dm_time = Utils::inputtime($_POST['tuesday_dm_hour'], $_POST['tuesday_dm_minute'], $_POST['tuesday_dm_ampm']);
					$tpl->assign('tuesday_dm_hour', $_POST['tuesday_dm_hour']);
					$tpl->assign('tuesday_dm_minute', $_POST['tuesday_dm_minute']);
					$tpl->assign('tuesday_dm_ampm', $_POST['tuesday_dm_ampm']);
					
					$tuesday_aw_time = Utils::inputtime($_POST['tuesday_aw_hour'], $_POST['tuesday_aw_minute'], $_POST['tuesday_aw_ampm']);
					$tpl->assign('tuesday_aw_hour', $_POST['tuesday_aw_hour']);
					$tpl->assign('tuesday_aw_minute', $_POST['tuesday_aw_minute']);
					$tpl->assign('tuesday_aw_ampm', $_POST['tuesday_aw_ampm']);
					
					$tuesday_dw_time = Utils::inputtime($_POST['tuesday_dw_hour'], $_POST['tuesday_dw_minute'], $_POST['tuesday_dw_ampm']);
					$tpl->assign('tuesday_dw_hour', $_POST['tuesday_dw_hour']);
					$tpl->assign('tuesday_dw_minute', $_POST['tuesday_dw_minute']);
					$tpl->assign('tuesday_dw_ampm', $_POST['tuesday_dw_ampm']);
				} else { 
					$tuesday = 'n'; 
				}
			
				// Check Wednesday
				if($_POST['wednesday']) 
				{ 
					$wednesday = 'y'; 
					
					$wednesday_dm_time = Utils::inputtime($_POST['wednesday_dm_hour'], $_POST['wednesday_dm_minute'], $_POST['wednesday_dm_ampm']);
					$tpl->assign('wednesday_dm_hour', $_POST['wednesday_dm_hour']);
					$tpl->assign('wednesday_dm_minute', $_POST['wednesday_dm_minute']);
					$tpl->assign('wednesday_dm_ampm', $_POST['wednesday_dm_ampm']);
					
					$wednesday_aw_time = Utils::inputtime($_POST['wednesday_aw_hour'], $_POST['wednesday_aw_minute'], $_POST['wednesday_aw_ampm']);
					$tpl->assign('wednesday_aw_hour', $_POST['wednesday_aw_hour']);
					$tpl->assign('wednesday_aw_minute', $_POST['wednesday_aw_minute']);
					$tpl->assign('wednesday_aw_ampm', $_POST['wednesday_aw_ampm']);
					
					$wednesday_dw_time = Utils::inputtime($_POST['wednesday_dw_hour'], $_POST['wednesday_dw_minute'], $_POST['wednesday_dw_ampm']);
					$tpl->assign('wednesday_dw_hour', $_POST['wednesday_dw_hour']);
					$tpl->assign('wednesday_dw_minute', $_POST['wednesday_dw_minute']);
					$tpl->assign('wednesday_dw_ampm', $_POST['wednesday_dw_ampm']);
				} else { 
					$wednesday = 'n'; 
				}
			
				// Check Thursday
				if($_POST['thursday']) 
				{ 
					$thursday = 'y'; 
					
					$thursday_dm_time = Utils::inputtime($_POST['thursday_dm_hour'], $_POST['thursday_dm_minute'], $_POST['thursday_dm_ampm']);
					$tpl->assign('thursday_dm_hour', $_POST['thursday_dm_hour']);
					$tpl->assign('thursday_dm_minute', $_POST['thursday_dm_minute']);
					$tpl->assign('thursday_dm_ampm', $_POST['thursday_dm_ampm']);
					
					$thursday_aw_time = Utils::inputtime($_POST['thursday_aw_hour'], $_POST['thursday_aw_minute'], $_POST['thursday_aw_ampm']);
					$tpl->assign('thursday_aw_hour', $_POST['thursday_aw_hour']);
					$tpl->assign('thursday_aw_minute', $_POST['thursday_aw_minute']);
					$tpl->assign('thursday_aw_ampm', $_POST['thursday_aw_ampm']);
					
					$thursday_dw_time = Utils::inputtime($_POST['thursday_dw_hour'], $_POST['thursday_dw_minute'], $_POST['thursday_dw_ampm']);
					$tpl->assign('thursday_dw_hour', $_POST['thursday_dw_hour']);
					$tpl->assign('thursday_dw_minute', $_POST['thursday_dw_minute']);
					$tpl->assign('thursday_dw_ampm', $_POST['thursday_dw_ampm']);
				} else { 
					$thursday = 'n'; 
				}
			
				// Check Friday
				if($_POST['friday']) 
				{ 
					$friday = 'y'; 
					
					$friday_dm_time = Utils::inputtime($_POST['friday_dm_hour'], $_POST['friday_dm_minute'], $_POST['friday_dm_ampm']);
					$tpl->assign('friday_dm_hour', $_POST['friday_dm_hour']);
					$tpl->assign('friday_dm_minute', $_POST['friday_dm_minute']);
					$tpl->assign('friday_dm_ampm', $_POST['friday_dm_ampm']);
					
					$friday_aw_time = Utils::inputtime($_POST['friday_aw_hour'], $_POST['friday_aw_minute'], $_POST['friday_aw_ampm']);
					$tpl->assign('friday_aw_hour', $_POST['friday_aw_hour']);
					$tpl->assign('friday_aw_minute', $_POST['friday_aw_minute']);
					$tpl->assign('friday_aw_ampm', $_POST['friday_aw_ampm']);
					
					$friday_dw_time = Utils::inputtime($_POST['friday_dw_hour'], $_POST['friday_dw_minute'], $_POST['friday_dw_ampm']);
					$tpl->assign('friday_dw_hour', $_POST['friday_dw_hour']);
					$tpl->assign('friday_dw_minute', $_POST['friday_dw_minute']);
					$tpl->assign('friday_dw_ampm', $_POST['friday_dw_ampm']);
				} else { 
					$friday = 'n'; 
				}
			
				// Check Saturday
				if($_POST['saturday']) 
				{ 
					$saturday = 'y'; 
					
					$saturday_dm_time = Utils::inputtime($_POST['saturday_dm_hour'], $_POST['saturday_dm_minute'], $_POST['saturday_dm_ampm']);
					$tpl->assign('saturday_dm_hour', $_POST['saturday_dm_hour']);
					$tpl->assign('saturday_dm_minute', $_POST['saturday_dm_minute']);
					$tpl->assign('saturday_dm_ampm', $_POST['saturday_dm_ampm']);
					
					$saturday_aw_time = Utils::inputtime($_POST['saturday_aw_hour'], $_POST['saturday_aw_minute'], $_POST['saturday_aw_ampm']);
					$tpl->assign('saturday_aw_hour', $_POST['saturday_aw_hour']);
					$tpl->assign('saturday_aw_minute', $_POST['saturday_aw_minute']);
					$tpl->assign('saturday_aw_ampm', $_POST['saturday_aw_ampm']);
					
					$saturday_dw_time = Utils::inputtime($_POST['saturday_dw_hour'], $_POST['saturday_dw_minute'], $_POST['saturday_dw_ampm']);
					$tpl->assign('saturday_dw_hour', $_POST['saturday_dw_hour']);
					$tpl->assign('saturday_dw_minute', $_POST['saturday_dw_minute']);
					$tpl->assign('saturday_dw_ampm', $_POST['saturday_dw_ampm']);
				} else { 
					$saturday = 'n'; 
				}
			
				// Check Sunday
				if($_POST['sunday']) 
				{ 
					$sunday = 'y'; 
					
					$sunday_dm_time = Utils::inputtime($_POST['sunday_dm_hour'], $_POST['sunday_dm_minute'], $_POST['sunday_dm_ampm']);
					$tpl->assign('sunday_dm_hour', $_POST['sunday_dm_hour']);
					$tpl->assign('sunday_dm_minute', $_POST['sunday_dm_minute']);
					$tpl->assign('sunday_dm_ampm', $_POST['sunday_dm_ampm']);
					
					$sunday_aw_time = Utils::inputtime($_POST['sunday_aw_hour'], $_POST['sunday_aw_minute'], $_POST['sunday_aw_ampm']);
					$tpl->assign('sunday_aw_hour', $_POST['sunday_aw_hour']);
					$tpl->assign('sunday_aw_minute', $_POST['sunday_aw_minute']);
					$tpl->assign('sunday_aw_ampm', $_POST['sunday_aw_ampm']);
					
					$sunday_dw_time = Utils::inputtime($_POST['sunday_dw_hour'], $_POST['sunday_dw_minute'], $_POST['sunday_dw_ampm']);
					$tpl->assign('sunday_dw_hour', $_POST['sunday_dw_hour']);
					$tpl->assign('sunday_dw_minute', $_POST['sunday_dw_minute']);
					$tpl->assign('sunday_dw_ampm', $_POST['sunday_dw_ampm']);
				} else { 
					$sunday = 'n'; 
				}
			
				// Check for a status
				if(isset($_POST['start']))
				{
					$status = 'start';
				} else {
					$status = 'save';
				}
			
				// Delete previous records for this pool (cleaner than updating);
				$sql = "DELETE FROM schedule WHERE pool_id = '{$_GET['pool']}'";
				$dbh->query($sql);
			
				// Insert new schedule
				$sql = "INSERT INTO schedule (
							pool_id,
							monday,
							monday_dm,
							monday_aw,
							monday_dw,
							tuesday,
							tuesday_dm,
							tuesday_aw,
							tuesday_dw,
							wednesday,
							wednesday_dm,
							wednesday_aw,
							wednesday_dw,
							thursday,
							thursday_dm,
							thursday_aw,
							thursday_dw,
							friday,
							friday_dm,
							friday_aw,
							friday_dw,
							saturday,
							saturday_dm,
							saturday_aw,
							saturday_dw,
							sunday,
							sunday_dm,
							sunday_aw,
							sunday_dw,
							status
						) VALUES (
							'{$_GET['pool']}',
							'$monday',
							'$monday_dm_time',
							'$monday_aw_time',
							'$monday_dw_time',
							'$tuesday',
							'$tuesday_dm_time',
							'$tuesday_aw_time',
							'$tuesday_dw_time',
							'$wednesday',
							'$wednesday_dm_time',
							'$wednesday_aw_time',
							'$wednesday_dw_time',
							'$thursday',
							'$thursday_dm_time',
							'$thursday_aw_time',
							'$thursday_dw_time',
							'$friday',
							'$friday_dm_time',
							'$friday_aw_time',
							'$friday_dw_time',
							'$saturday',
							'$saturday_dm_time',
							'$saturday_aw_time',
							'$saturday_dw_time',
							'$sunday',
							'$sunday_dm_time',
							'$sunday_aw_time',
							'$sunday_dw_time',
							'$status'
						)";
					$dbh->query($sql);
				
					// Log action
					// Email everyone
					// Delete all acceptances after this date on the scheduler
					
					// Redirect user
					header("Location: pools.php?state=viewschedule&pool={$_GET['pool']}&confirmation=updateschedule");
					
					// Disconnect from database
					$dbh->disconnect();
					exit();	
			
			} else {
			
				// Display errors
				$tpl->assign('error', $error);
			
			}
		
		} else {
		
			// Get previous schedule
			$sql = "SELECT
						monday,
						DATE_FORMAT(monday_dm, '%k:%i') AS monday_dm,
						DATE_FORMAT(monday_aw, '%k:%i') AS monday_aw,
						DATE_FORMAT(monday_dw, '%k:%i') AS monday_dw,
						tuesday,
						DATE_FORMAT(tuesday_dm, '%k:%i') AS tuesday_dm,
						DATE_FORMAT(tuesday_aw, '%k:%i') AS tuesday_aw,
						DATE_FORMAT(tuesday_dw, '%k:%i') AS tuesday_dw,
						wednesday,
						DATE_FORMAT(wednesday_dm, '%k:%i') AS wednesday_dm,
						DATE_FORMAT(wednesday_aw, '%k:%i') AS wednesday_aw,
						DATE_FORMAT(wednesday_dw, '%k:%i') AS wednesday_dw,
						thursday,
						DATE_FORMAT(thursday_dm, '%k:%i') AS thursday_dm,
						DATE_FORMAT(thursday_aw, '%k:%i') AS thursday_aw,
						DATE_FORMAT(thursday_dw, '%k:%i') AS thursday_dw,
						friday,
						DATE_FORMAT(friday_dm, '%k:%i') AS friday_dm,
						DATE_FORMAT(friday_aw, '%k:%i') AS friday_aw,
						DATE_FORMAT(friday_dw, '%k:%i') AS friday_dw,
						saturday,
						DATE_FORMAT(saturday_dm, '%k:%i') AS saturday_dm,
						DATE_FORMAT(saturday_aw, '%k:%i') AS saturday_aw,
						DATE_FORMAT(saturday_dw, '%k:%i') AS saturday_dw,
						sunday,
						DATE_FORMAT(sunday_dm, '%k:%i') AS sunday_dm,
						DATE_FORMAT(sunday_aw, '%k:%i') AS sunday_aw,
						DATE_FORMAT(sunday_dw, '%k:%i') AS sunday_dw,
						status
					FROM
						schedule 
					WHERE
						pool_id = '{$_GET['pool']}'";
			$row = $dbh->queryRow($sql);
			
			// Assign days
			$tpl->assign('monday', $row['monday']);
			$tpl->assign('tuesday', $row['tuesday']);
			$tpl->assign('wednesday', $row['wednesday']);
			$tpl->assign('thursday', $row['thursday']);
			$tpl->assign('friday', $row['friday']);
			$tpl->assign('saturday', $row['saturday']);
			$tpl->assign('sunday', $row['sunday']);
			
			// Assign variables to template
			if($row['monday'] == 'y')
			{
				// Depart from meeting place
				$monday_dm = Utils::cleantime($row['monday_dm']);
				$tpl->assign('monday_dm_hour', $monday_dm['hour']);
				$tpl->assign('monday_dm_minute', $monday_dm['minute']);
				$tpl->assign('monday_dm_ampm', $monday_dm['ampm']);
				
				// Arrive at workplace
				$monday_aw = Utils::cleantime($row['monday_aw']);
				$tpl->assign('monday_aw_hour', $monday_aw['hour']);
				$tpl->assign('monday_aw_minute', $monday_aw['minute']);
				$tpl->assign('monday_aw_ampm', $monday_aw['ampm']);
				
				// Depart from workplace
				$monday_dw = Utils::cleantime($row['monday_dw']);
				$tpl->assign('monday_dw_hour', $monday_dw['hour']);
				$tpl->assign('monday_dw_minute', $monday_dw['minute']);
				$tpl->assign('monday_dw_ampm', $monday_dw['ampm']);
			}
			if($row['tuesday'] == 'y')
			{
				// Depart from meeting place
				$tuesday_dm = Utils::cleantime($row['tuesday_dm']);
				$tpl->assign('tuesday_dm_hour', $tuesday_dm['hour']);
				$tpl->assign('tuesday_dm_minute', $tuesday_dm['minute']);
				$tpl->assign('tuesday_dm_ampm', $tuesday_dm['ampm']);
				
				// Arrive at workplace
				$tuesday_aw = Utils::cleantime($row['tuesday_aw']);
				$tpl->assign('tuesday_aw_hour', $tuesday_aw['hour']);
				$tpl->assign('tuesday_aw_minute', $tuesday_aw['minute']);
				$tpl->assign('tuesday_aw_ampm', $tuesday_aw['ampm']);
				
				// Depart from workplace
				$tuesday_dw = Utils::cleantime($row['tuesday_dw']);
				$tpl->assign('tuesday_dw_hour', $tuesday_dw['hour']);
				$tpl->assign('tuesday_dw_minute', $tuesday_dw['minute']);
				$tpl->assign('tuesday_dw_ampm', $tuesday_dw['ampm']);
			}
			if($row['wednesday'] == 'y')
			{
				// Depart from meeting place
				$wednesday_dm = Utils::cleantime($row['wednesday_dm']);
				$tpl->assign('wednesday_dm_hour', $wednesday_dm['hour']);
				$tpl->assign('wednesday_dm_minute', $wednesday_dm['minute']);
				$tpl->assign('wednesday_dm_ampm', $wednesday_dm['ampm']);
				
				// Arrive at workplace
				$wednesday_aw = Utils::cleantime($row['wednesday_aw']);
				$tpl->assign('wednesday_aw_hour', $wednesday_aw['hour']);
				$tpl->assign('wednesday_aw_minute', $wednesday_aw['minute']);
				$tpl->assign('wednesday_aw_ampm', $wednesday_aw['ampm']);
				
				// Depart from workplace
				$wednesday_dw = Utils::cleantime($row['wednesday_dw']);
				$tpl->assign('wednesday_dw_hour', $wednesday_dw['hour']);
				$tpl->assign('wednesday_dw_minute', $wednesday_dw['minute']);
				$tpl->assign('wednesday_dw_ampm', $wednesday_dw['ampm']);
			}
			if($row['thursday'] == 'y')
			{
				// Depart from meeting place
				$thursday_dm = Utils::cleantime($row['thursday_dm']);
				$tpl->assign('thursday_dm_hour', $thursday_dm['hour']);
				$tpl->assign('thursday_dm_minute', $thursday_dm['minute']);
				$tpl->assign('thursday_dm_ampm', $thursday_dm['ampm']);
				
				// Arrive at workplace
				$thursday_aw = Utils::cleantime($row['thursday_aw']);
				$tpl->assign('thursday_aw_hour', $thursday_aw['hour']);
				$tpl->assign('thursday_aw_minute', $thursday_aw['minute']);
				$tpl->assign('thursday_aw_ampm', $thursday_aw['ampm']);
				
				// Depart from workplace
				$thursday_dw = Utils::cleantime($row['thursday_dw']);
				$tpl->assign('thursday_dw_hour', $thursday_dw['hour']);
				$tpl->assign('thursday_dw_minute', $thursday_dw['minute']);
				$tpl->assign('thursday_dw_ampm', $thursday_dw['ampm']);
			}
			if($row['friday'] == 'y')
			{
				// Depart from meeting place
				$friday_dm = Utils::cleantime($row['friday_dm']);
				$tpl->assign('friday_dm_hour', $friday_dm['hour']);
				$tpl->assign('friday_dm_minute', $friday_dm['minute']);
				$tpl->assign('friday_dm_ampm', $friday_dm['ampm']);
				
				// Arrive at workplace
				$friday_aw = Utils::cleantime($row['friday_aw']);
				$tpl->assign('friday_aw_hour', $friday_aw['hour']);
				$tpl->assign('friday_aw_minute', $friday_aw['minute']);
				$tpl->assign('friday_aw_ampm', $friday_aw['ampm']);
				
				// Depart from workplace
				$friday_dw = Utils::cleantime($row['friday_dw']);
				$tpl->assign('friday_dw_hour', $friday_dw['hour']);
				$tpl->assign('friday_dw_minute', $friday_dw['minute']);
				$tpl->assign('friday_dw_ampm', $friday_dw['ampm']);
			}
			if($row['saturday'] == 'y')
			{
				// Depart from meeting place
				$saturday_dm = Utils::cleantime($row['saturday_dm']);
				$tpl->assign('saturday_dm_hour', $saturday_dm['hour']);
				$tpl->assign('saturday_dm_minute', $saturday_dm['minute']);
				$tpl->assign('saturday_dm_ampm', $saturday_dm['ampm']);
				
				// Arrive at workplace
				$saturday_aw = Utils::cleantime($row['saturday_aw']);
				$tpl->assign('saturday_aw_hour', $saturday_aw['hour']);
				$tpl->assign('saturday_aw_minute', $saturday_aw['minute']);
				$tpl->assign('saturday_aw_ampm', $saturday_aw['ampm']);
				
				// Depart from workplace
				$saturday_dw = Utils::cleantime($row['saturday_dw']);
				$tpl->assign('saturday_dw_hour', $saturday_dw['hour']);
				$tpl->assign('saturday_dw_minute', $saturday_dw['minute']);
				$tpl->assign('saturday_dw_ampm', $saturday_dw['ampm']);
			}
			if($row['sunday'] == 'y')
			{
				// Depart from meeting place
				$sunday_dm = Utils::cleantime($row['sunday_dm']);
				$tpl->assign('sunday_dm_hour', $sunday_dm['hour']);
				$tpl->assign('sunday_dm_minute', $sunday_dm['minute']);
				$tpl->assign('sunday_dm_ampm', $sunday_dm['ampm']);
				
				// Arrive at workplace
				$sunday_aw = Utils::cleantime($row['sunday_aw']);
				$tpl->assign('sunday_aw_hour', $sunday_aw['hour']);
				$tpl->assign('sunday_aw_minute', $sunday_aw['minute']);
				$tpl->assign('sunday_aw_ampm', $sunday_aw['ampm']);
				
				// Depart from workplace
				$sunday_dw = Utils::cleantime($row['sunday_dw']);
				$tpl->assign('sunday_dw_hour', $sunday_dw['hour']);
				$tpl->assign('sunday_dw_minute', $sunday_dw['minute']);
				$tpl->assign('sunday_dw_ampm', $sunday_dw['ampm']);
			}
		}
		
		// Get pool members
		$sql = "SELECT 
					a.user_id AS user_id, 
					a.role AS role,
					b.firstname AS firstname, 
					b.lastname AS lastname
				FROM 
					poolmembers a, users b
				WHERE 
					a.user_id = b.user_id AND a.pool_id = '{$_GET['pool']}' AND a.status = 'accepted'
				ORDER BY
					b.lastname";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			// Get member availability
			$sql2 = "SELECT availability FROM schedule_availability WHERE user_id = '{$row['user_id']}' AND pool_id = '{$_GET['pool']}'";
			$row2 = $dbh->queryRow($sql2);
			
			// Check for user confirmation
			if($row['user_id'] == $_SESSION['user_id'])
			{
				$editable = true;	
			} else {
				$editable = false;
			}
			
			$members[] = array(
				'user_id' => $row['user_id'],
				'name' => $row['firstname'] . ' ' . $row['lastname'],
				'editable' => $editable,
				'availability' => $row2['availability']
			);
		}
		$tpl->assign('members', $members);
		
		// Get comments
		$sql = "SELECT 
					a.user_id AS user_id, 
					a.comment AS comment,
					DATE_FORMAT(a.submitdate, '%m/%d/%Y %h:%i') AS submitdate, 
					b.firstname AS firstname,
					b.lastname AS lastname 
				FROM 
					schedule_comments a, users b
				WHERE 
					a.user_id = b.user_id AND a.pool_id = '{$_GET['pool']}'
				ORDER BY
					a.submitdate DESC";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			$comments[] = array(
				'user_id' => $row['user_id'],
				'comment' => $row['comment'],
				'name' => $row['firstname'] . ' ' . $row['lastname'],
				'date' => $row['submitdate']
			);
		}
		$tpl->assign('comments', $comments);
		
		// Display Template
		$tpl->display('pools-schedule-edit.tpl');
		
		// Disconnect from database
		$dbh->disconnect();
		exit();	
	
	break;
	
	# SET AVAILABILITY
	case "setavailability":
	
		// Delete previous availability
		$sql = "DELETE FROM schedule_availability WHERE pool_id = '{$_GET['pool']}' AND user_id = '{$_SESSION['user_id']}'";
		$dbh->query($sql);
		
		// Insert new record
		$sql = "INSERT INTO schedule_availability (pool_id, user_id, availability) VALUES ('{$_GET['pool']}', '{$_SESSION['user_id']}', '{$_GET['availability']}')";
		$dbh->query($sql);
	
	break;
	
	# ADD COMMENT
	case "addcomment":
	
		// Check to see if there is a comment
		if($_POST['comment'])
		{
		
			// Insert new comment
			$sql = "INSERT INTO schedule_comments (pool_id, user_id, comment, submitdate) VALUES ('{$_GET['pool']}', '{$_SESSION['user_id']}', '{$_POST['comment']}', NOW())";
			$dbh->query($sql);

			// Create temporary random number to facilitate highlighting
			$randomnumber = Utils::randomKey(8);

			// Assign comment variables
			$tpl->assign('randomnumber', $randomnumber);
			$tpl->assign('name', stripslashes($_SESSION['fullname']));
			$tpl->assign('comment', stripslashes($_POST['comment']));
			$tpl->assign('date', date("m/d/Y g:i"));
			
			// Build the template code
			$contents = $tpl->fetch('pools-comments.tpl');
			
			// Build JSON array
			$json = array(
				"status" => "success",
				"randomnumber" => $randomnumber,
				"contents" => $contents
			);
			
			// Out response to browser
			$output = json_encode($json);
			
			// Output to browser
			echo $output;
			
			// Disconnect from database
			$dbh->disconnect();
			exit();

		}
	
	break;
	
	# VIEW MAP
	case "viewmap":

		// Assign current side navigation
		$tpl->assign('poolscurrent', true);
		
		// Assign pool_id
		$tpl->assign('pool_id', $_GET['pool']);
		
		// Display Template
		$tpl->display('pools-map4.tpl');
		
		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;
	
	# SAVE MAP
	case "savetoserver":
	
		// Insert points
		if($_POST['nodes'])
		{
			// Build JSON array
			$json = array(
				"status" => "success",
				"nodes" => $_POST['nodes']
			);

		} else {
		
			// Build JSON array
			$json = array(
				"status" => "failure"
			);
		
		}
		
		// Out response to browser
		$output = json_encode($json);
		
		// Output to browser
		echo $output;
		
		// Disconnect from database
		$dbh->disconnect();
		exit();
	
	break;
	
	# DISPLAY MANAGE POOLS
	default:
		
		// Assign current side navigation
		$tpl->assign('poolscurrent', true);
		
		// Get current pools
		$sql = "SELECT 
					a.pool_id AS pool_id, 
					a.title AS title
				FROM 
					pools a, poolmembers b
				WHERE
					a.pool_id = b.pool_id AND b.user_id = '{$_SESSION['user_id']}' AND b.status = 'accepted'
				ORDER BY
					a.title";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			$pools[] = array(
				'pool_id' => $row['pool_id'],
				'title' => $row['title']
			);
		}
		$tpl->assign('pools', $pools);
		
		// Display Template
		$tpl->display('pools.tpl');
		
		// Disconnect from database
		$dbh->disconnect();
		exit();	
	
	break;
}

?>