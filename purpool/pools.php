<?php

#################################################################
# Name: pools.php                      		                    #
# Author: John Kuiphoff                                         #
# Description: Allows users to create and manage pools          #
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

// Validate user
if(!$_SESSION['username'])
{
	header("Location: index.php");
}

$tpl->assign('google_key', $MISC['google_key']);

// Get pool name
function getPoolName($pool_id)
{
	global $dbh;

	$sql = "SELECT title FROM pools WHERE pool_id = '$pool_id'";
	$row = $dbh->queryRow($sql);

	return $row['title'];
}

// Switch state
switch($_GET['state'])
{
	# CREATE POOL
	case "createpool":

		// Assign current side navigation
		$tpl->assign('poolscurrent', true);

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
				} else {
					$tpl->assign('title', $_POST['title']);
				}
			}

			// Populate template values
			$tpl->assign('access', $_POST['access']);
			$tpl->assign('description', $_POST['description']);

			// Otherwise, display errors
			if(sizeof($error) == 0)
			{
				// Get workplace_id of pool creator
				$sql = "SELECT workplace FROM users WHERE user_id = '{$_SESSION['user_id']}'";
				$row = $dbh->queryRow($sql);
				$workplace = $row['workplace'];

				// Insert pool information
				$sql = "INSERT INTO pools (
					pool_id,
					title,
					access,
					description,
					workplace_id,
					rotation_type,
					createdate
				) VALUES (
					NULL,
					'{$_POST['title']}',
					'{$_POST['access']}',
					'{$_POST['description']}',
					'$workplace',
					'default',
					NOW()
				)";
				//echo $sql;
				$dbh->query($sql);

				// Get pool_id
				$sql = "SELECT pool_id FROM pools WHERE title = '{$_POST['title']}'";
				$row = $dbh->queryRow($sql);
				$pool_id = $row['pool_id'];

				// Insert pool owner into poolmembers table
				$sql = "INSERT INTO poolmembers (
					id,
					pool_id,
					user_id,
					email,
					message,
					role,
					status
				) VALUES (
					NULL,
					'$pool_id',
					'{$_SESSION['user_id']}',
					'',
					'',
					'owner',
					'accepted'
				)";
				$dbh->query($sql);

				// Log action
				Utils::logAction($_SESSION['username'], 'Created New Pool', $_POST['title']);

				// Redirect user to confirmation screen
				header("Location: pools.php?state=createpoolconfirmation&pool=" . $pool_id);

				// Disconnect from database
				$dbh->disconnect();
				exit();

			} else {

				// Display errors
				$tpl->assign('error', $error);

			}

		} else {

			// Create default values for pool
			$tpl->assign('access', 'private');

		}

		// Display template
		$tpl->display('pools-create.tpl');

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

	# CREATE POOL CONFIRMATION
	case "createpoolconfirmation":

		// Get pool organizer
		$sql = "SELECT role FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = {$_SESSION['user_id']}";
		$row = $dbh->queryRow($sql);
		if($row['role'] == 'owner')
		{
			// Allow editing
			$tpl->assign('editmode', true);
		} else {
			// Do not allow editing
			header("Location: index.php?state=sessionexpired");
		}

		// Get pool name
		$poolname = getPoolName($_GET['pool']);
		$tpl->assign('poolname', $poolname);

		// Assign current side navigation
		$tpl->assign('poolscurrent', true);

		// Assign pool_id
		$tpl->assign('pool_id', $_GET['pool']);

		// Display template
		$tpl->display('pools-create-confirmation.tpl');

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

	# EDIT POOL
	case "editpool":

		// Get pool organizer
		$sql = "SELECT role FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = {$_SESSION['user_id']}";
		$row = $dbh->queryRow($sql);
		if($row['role'] == 'owner')
		{
			// Allow editing
			$tpl->assign('editmode', true);
		} else {
			// Do not allow editing
			header("Location: index.php?state=sessionexpired");
		}

		// Check to make sure that the user is allowed to access this page (prevents hacking)
		$sql = "SELECT user_id FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		if(!$row) { header("Location: index.php?state=sessionexpired"); exit(); }

		//Get days in reoccuring schedule
		$sql = "SELECT
				monday,
				tuesday,
				wednesday,
				thursday,
				friday,
				saturday,
				sunday
			FROM
				poolschedules
			WHERE
				pool_id = '{$_GET['pool']}'
			ORDER BY
				savedate DESC LIMIT 1";
		$res = $dbh->query($sql);
		$row = $res->fetchRow();
		$daysOfWeek = array("monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday");
		$daysInSchedule = array();
		for($i=0; $i<7; $i++){
			if($row[$daysOfWeek[$i]] == 'y'){ 
				array_push($daysInSchedule, $daysOfWeek[$i]);
			}
		}
		$tpl->assign('daysInSchedule', $daysInSchedule);

		// Get pool name
		$poolname = getPoolName($_GET['pool']);
		$tpl->assign('poolname', $poolname);

		// Assign current side navigation
		$tpl->assign('poolscurrent', true);

		// Assign pool_id
		$tpl->assign('pool_id', $_GET['pool']);

		$sql = "SELECT
					a.user_id AS user_id,
					b.firstname AS firstname,
					b.lastname AS lastname
				FROM
					poolmembers a, users b
				WHERE
					a.user_id = b.user_id AND a.pool_id = '{$_GET['pool']}'
				ORDER BY
					b.lastname";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			$members[] = array(
				'user_id' => $row['user_id'],
				'name' => $row['firstname'] . ' ' . $row['lastname']
			);
		}
		$tpl->assign('members', $members);

		// Get routes
		$sql = "SELECT route_id, title FROM poolroutes WHERE pool_id = '{$_GET['pool']}' ORDER BY title";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			$routes[] = array(
				'route_id' => $row['route_id'],
				'title' => $row['title']
			);
		}
		$tpl->assign('routes', $routes);


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
				$sql = "SELECT title FROM pools WHERE title = '{$_POST['title']}' and pool_id != '{$_GET['pool']}'";
				$row = $dbh->queryRow($sql);
				if($row)
				{
					$error['title'] = 'This title is already taken. Please choose another.';
				} else {
					$tpl->assign('title', $_POST['title']);
				}
			}
			if(empty($_POST['route']))
			{
				$error['route'] = 'A default route is required.';
			}else {
				$tpl->assign('route', $_POST['route']);
			}
			/*if(empty($_POST['driver']))
			{
				$error['driver'] = 'A default driver is required.';
			}else {
				$tpl->assign('driver', $_POST['driver']);
			}*/

			// Populate template values
			$tpl->assign('access', $_POST['access']);
			$tpl->assign('description', $_POST['description']);

			// Otherwise, display errors
			
			//To Do: Add default route by day of week
			if(sizeof($error) == 0)
			{
				foreach ($daysOfWeek as $day){
					switch ($_POST['rotationtype']){
						case "default":
							$default_driver[$day] =$_POST['driver'];
						break;
						case "rotation":
						case "fairness":
							$default_driver[$day] ="NULL";
						break;
						case "day_of_week":
							if(isset($_POST[$day])){
								$default_driver[$day] =$_POST[$day];
							}
							else{
								$default_driver[$day] ="";
							}
						break;
					}					
				}
				$tpl->assign('default_driver', $default_driver);
				
				$sql = "UPDATE  poolschedules SET 
							monday_driver='{$default_driver['monday']}',
							tuesday_driver='{$default_driver['tuesday']}',
							wednesday_driver='{$default_driver['wednesday']}',
							thursday_driver='{$default_driver['thursday']}',
							friday_driver='{$default_driver['friday']}',
							saturday_driver='{$default_driver['saturday']}',
							sunday_driver='{$default_driver['sunday']}'
						WHERE pool_id = '{$_GET['pool']}'";

				$dbh->query($sql);
				// UPDATE pool information
				$sql = "UPDATE pools SET
								title = '{$_POST['title']}',
								access = '{$_POST['access']}',
								description = '{$_POST['description']}',
								rotation_type = '{$_POST['rotationtype']}',
								default_route = '{$_POST['route']}'
							WHERE
								pool_id = '{$_GET['pool']}';";
				$dbh->query($sql);

				// Log action
				Utils::logAction($_SESSION['username'], 'Edit Pool', $_POST['title']);

				// Redirect user to confirmation screen
				header("Location: pools.php?state=editpool&pool=" . $_GET['pool'] . '&confirmation=editpool');

				// Disconnect from database
				$dbh->disconnect();
				exit();

			} else {

				// Display errors
				$tpl->assign('error', $error);

			}

		} else {

			// Get current pool values
			$sql = "SELECT title, access, description, rotation_type, default_route FROM pools WHERE pool_id = '{$_GET['pool']}'";
			$row = $dbh->queryRow($sql);
		
			//Creating an array of the default drivers for each day
			$sql1 = "SELECT 
				monday_driver, tuesday_driver, wednesday_driver, thursday_driver, friday_driver, saturday_driver, sunday_driver FROM poolschedules 
					WHERE pool_id = '{$_GET['pool']}'
					
					ORDER BY savedate DESC LIMIT 1";
			$row1 = $dbh->queryRow($sql1);
			foreach ($daysOfWeek as $day){
				$default_driver[$day] =$row1[$day.'_driver'];
			}
			// Assign template values
			$tpl->assign('title', $row['title']);
			$tpl->assign('access', $row['access']);
			$tpl->assign('description', $row['description']);
			$tpl->assign('rotation_type', $row['rotation_type']);
			$tpl->assign('default_driver', $default_driver);
			$tpl->assign('route', $row['default_route']);
		}
		// Display template
		$tpl->display('pools-edit.tpl');

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

	# EDIT MEMBERS
	case "editmembers":

		// Get pool organizer
		$sql = "SELECT role FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = {$_SESSION['user_id']}";
		$row = $dbh->queryRow($sql);
		if($row['role'] == 'owner')
		{
			// Allow editing
			$tpl->assign('editmode', true);
		} else {
			// Do not allow editing
			header("Location: index.php?state=sessionexpired");
		}

		// Check to make sure that the user is allowed to access this page (prevents hacking)
		$sql = "SELECT user_id FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		if(!$row) { header("Location: index.php?state=sessionexpired"); exit();  }

		// Get pool name
		$poolname = getPoolName($_GET['pool']);
		$tpl->assign('poolname', $poolname);

		// Assign pool_id
		$tpl->assign('pool_id', $_GET['pool']);

		// Assign current side navigation
		$tpl->assign('poolscurrent', true);

		// If the invitation submit button has been pressed
		if(isset($_POST['submit']))
		{
			// Create error array
			$error = array();

			//Create array of email addresses entered in form
			$addresses = preg_split("/[\s,]+/", $_POST['email']);

			// Check for an e-mail address
			if(empty($_POST['email']))
			{
				$error['email'] = 'An e-mail address is required.';

			} else {

				foreach($addresses as $i=>$address){

					// Check to see if the user is registered with Purpool
					$sql = "SELECT user_id FROM users WHERE email = '{$address}'";
					$row = $dbh->queryRow($sql);
					if($row)
					{
						$user_id = $row['user_id'];
					}

					// Check to see if user has already been invited to this pool
					$sql = "SELECT email FROM poolmembers WHERE email = '{$address}' AND pool_id = '{$_GET['pool']}'";
					$row = $dbh->queryRow($sql);
					if($row)
					{
						$error['email'] = $address.' has already been invited.';
					}

					// Check to see if user is attempting to invite themself to this pool
					$sql = "SELECT user_id FROM users WHERE email = '{$address}' AND user_id = '{$_SESSION['user_id']}'";
					$row = $dbh->queryRow($sql);
					if($row)
					{
						$error['email'] = 'You can not invite yourself to this pool.';
					}

					// Check to see if the user is registered with Purpool
					$sql = "SELECT user_id, firstname, lastname FROM users WHERE email = '{$address}'";
					$row = $dbh->queryRow($sql);
					if($row)
					{
						// Invited user_id, firstname, lastname
						$inviteduser[$i] = $row['user_id'];
						$invitedfirstname[$i] = $row['firstname'];
						$invitedlastname[$i] = $row['lastname'];

						// User is registered
						$purpoolregistered[$i] = true;

					} else {

						// User is not registered
						$inviteduser[$i] = 0;
						$purpoolregistered[$i] = false;

					}
				}
			}

			// Assign personalized message
			$tpl->assign('message', $_POST['message']);
			$tpl->assign('email', $_POST['email']);

			// If there are no errors, invite user
			// Otherwise, display error
			if(sizeof($error) == 0)
			{
				foreach($addresses as $i=>$address){
					// Insert user into poolmembers table
					$sql = "INSERT INTO poolmembers (
								id,
								pool_id,
								user_id,
								email,
								message,
								role,
								status
							) VALUES (
								NULL,
								'{$_GET['pool']}',
								'$inviteduser[$i]',
								'{$address}',
								'{$_POST['message']}',
								'member',
								'pending'
							)";
					$dbh->query($sql);

					// Compose message
					if($purpoolregistered[$i])
					{
						// If the invited user is already registered
						$message = 'Dear ' . $invitedfirstname[$i] . ' ' . $invitedlastname[$i] . ', ' . "\n\n";
						$message = $message . $_SESSION['fullname'] . ' has invited you to join a pool. Please login to Purpool at '.$MISC['site_url'].' to view the invitation. As a member of Purpool you already know the benefits of carpools and you are just a few clicks away from being part of one!' . "\n\n";
						$message = $message . 'Happy Carpooling,' . "\n\n";
						$message = $message . 'The Purpool Team' . "\n\n";
						if($_POST['message'])
						{
							// Include personalized message
							$message = $message . '---' . "\n\n";
							$message = $message . $_POST['message'];
						}

					} else {

						// If the invited user has not yet registered with Purpool
						$message = 'Dear ' . $address . ', ' . "\n\n";
						$message = $message . $_SESSION['fullname'] . ' has invited you to join a carpool at  purpool.com, where we build community through ride-sharing . Please register for Purpool at ';
						$message = $message . $MISC['site_url'].'register.php?email=' . $address;
						$message = $message . ' to view the complete invitation.' . "\n\n";
						$message = $message . 'Carpooling is a great way to save money, help the environment and get to know other people in your workplace. We created Purpool to bring the benefits of carpools to people like you and you are just a few clicks away from being part of one!' . "\n\n";
						$message = $message . 'Happy Carpooling,' . "\n\n";
						$message = $message . 'The Purpool Team' . "\n\n";
						if($_POST['message'])
						{
							// Include personalized message
							$message = $message . '---' . "\n\n";
							$message = $message . $_POST['message'];
						}

					}

					// E-mail user
					mail($address, 'Purpool Invitation', $message, "From: ".$MISC['admin_email']);
				}

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

		// If the role-change submit button has been pressed
		if(isset($_POST['role_submit']))
		{
			// Create error array
			$error = array();

			$keys = array_keys($_POST);
			$values = array_values($_POST);

			// Check for at least one pool owner
			if(!in_array("owner", $_POST))
			{
				$error['role'] = 'Pool must have at least <br />one owner assigned.';

			}

			if(sizeof($error) == 0)
			{
				$sql="";

				for($i=0; $i<(count($_POST)-1);$i++){
					// Update user roles in poolmembers table
					$sql = "UPDATE poolmembers SET role = '".$values[$i]."' WHERE user_id = ".$keys[$i]." AND pool_id=".$_GET['pool'];
					$dbh->query($sql);
				}

				// Refresh page
				header("Location: pools.php?state=editmembers&pool=".$_GET['pool']);

				// Disconnect from database
				$dbh->disconnect();
				exit();

			} else {

				// Display errors
				$tpl->assign('error', $error);

			}
		}

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
			$role_select = '<option value="member" selected>member</option><option value="owner">owner</option>';
			if($row['role'] == "owner")
				$role_select = '<option value="member">member</option><option value="owner" selected>owner</option>';
			$accepted[] = array(
				'user_id' => $row['user_id'],
				'name' => $row['firstname'] . ' ' . $row['lastname'],
				'email' => $row['email'],
				'role' => $row['role'],
				'role_select' => $role_select
			);

		}
		$tpl->assign('accepted', $accepted);

		// Check to see how many accepted members there are
		$numaccepted = $result->numRows();

		// Get invited purpool members
		$sql = "SELECT
					a.user_id AS user_id,
					a.firstname AS firstname,
					a.lastname AS lastname,
					a.email AS email,
					b.id AS id,
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
				'id' => $row['id'],
				'name' => $row['firstname'] . ' ' . $row['lastname'],
				'email' => $row['email'],
				'status' => $row['status']
			);
		}

		// Get invited purpool NON members
		$sql = "SELECT
					id,
					email,
					status
				FROM
					poolmembers
				WHERE
					pool_id = '{$_GET['pool']}' AND user_id = '0' AND status != 'accepted'
				ORDER BY
					email";
		$result = $dbh->query($sql);
		$invited=array();
		while($row = $result->fetchRow())
		{
			$invited[] = array(
				'id' => $row['id'],
				'email' => $row['email'],
				'status' => $row['status']
			);
		}

		$tpl->assign('invited', $invited);

		// Check to see how many invited members there are
		$numinvited = $result->numRows();

		// Check to see if instructions are needed
		if($numaccepted + $numinvited == 1)
		{
			$tpl->assign('instructions', true);
		}

		// Display Template
		$tpl->display('pools-members.tpl');

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

	# REMOVE MEMBER
	case "removemember":

		// Check to make sure that the user is allowed to access this page (prevents hacking)
		$sql = "SELECT user_id, role FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		if((!$row) || ($row['role'] != 'owner')) { header("Location: index.php?state=sessionexpired"); exit();  }

		// Assign current side navigation
		$tpl->assign('poolscurrent', true);

		// Assign member_id
		$tpl->assign('member', $_GET['member']);
		$tpl->assign('pool_id', $_GET['pool']);

		// Assign formaction
		$formaction = 'pools.php?state=removemember&pool='.$_GET['pool']."&member=".$_GET['member'];
		$tpl->assign('formaction', $formaction);

		// Assign warning message
		$tpl->assign('warning', 'member');

		// If the yes button has been pressed
		if(isset($_POST['yes']))
		{
			// Delete poolmember from database
			$sql = "DELETE FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = {$_GET['member']}";
			$dbh->query($sql);

			// Delete poolpassengers from database
			//$sql = "DELETE FROM poolpassengers WHERE pool_id = '{$_GET['pool']}' AND user_id = {$_GET['member']}";
			//$dbh->query($sql);


			// Redirect user
			$redirect = 'pools.php?confirmation=removemember';
			header("Location: $redirect");

			// Disconnect from database
			$dbh->disconnect();
			exit();
		}

		// If the yes button has been pressed
		if(isset($_POST['no']))
		{
			// Redirect user
			$redirect = 'pools.php';
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


	# ACCEPT INVITATION
	case "accept":

		// Update status in poolmembers table
		$sql = "UPDATE poolmembers SET status = 'accepted' WHERE user_id = '{$_SESSION['user_id']}' AND pool_id = '{$_GET['pool']}'";
		$dbh->query($sql);

		// Redirect user
		$redirect = 'pools.php?state=viewprofile&pool=' . $_GET['pool'] . '&confirmation=accept';
		header("Location: $redirect");

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

	# GET EMAIL ADDRESSES FOR AUTOCOMPLETE BOX
	case "getinviteemail":

		// Get user's workplace
		$sql = "SELECT workplace FROM users WHERE user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		$workplace = $row['workplace'];

		// Get e-mail addresses
		$sql = "SELECT email FROM users WHERE email LIKE '{$_POST['email']}%' AND workplace = '$workplace'";
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

	# RESEND INVITATION
	case "resendinvite":

		// Get pool organizer
		$sql = "SELECT role FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = {$_SESSION['user_id']}";
		$row = $dbh->queryRow($sql);
		if($row['role'] != 'owner')
		{
			// Do not allow editing
			header("Location: index.php?state=sessionexpired");
		}

		// Get invitation message
		$sql = "SELECT email, message FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND id = '{$_GET['user']}'";
		$row = $dbh->queryRow($sql);
		$email = $row['email'];
		$invitemessage = $row['message'];

		// Check to see if the user is registered with Purpool
		$sql = "SELECT user_id, firstname, lastname FROM users WHERE email = '{$row['email']}'";
		$row = $dbh->queryRow($sql);
		if($row)
		{
			// Invited user_id, firstname, lastname
			$inviteduser = $row['user_id'];
			$invitedfirstname = $row['firstname'];
			$invitedlastname = $row['lastname'];

			// User is registered
			$purpoolregistered = true;

		} else {

			// User is not registered
			$purpoolregistered = false;

		}

		// Compose message
		if($purpoolregistered)
		{
			// If the invited user is already registered
			$message = 'Dear ' . $invitedfirstname . ' ' . $invitedlastname . ', ' . "\n\n";
			$message = $message . $_SESSION['fullname'] . ' has invited you to join a pool. Please login to Purpool
			at '.$MISC['site_url'].' to view the invitation. As a member of Purpool you already know the benefits of carpools
			and you are just a few clicks away from being part of one!' . "\n\n";
			$message = $message . 'Happy Carpooling,' . "\n\n";
			$message = $message . 'The Purpool Team' . "\n\n";
			if($invitemessage)
			{
				// Include personalized message
				$message = $message . '---' . "\n\n";
				$message = $message . $invitemessage;
			}

		} else {

			// If the invited user has not yet registered with Purpool
			$message = 'Dear ' . $invitedfirstname . ' ' . $invitedlastname . ', ' . "\n\n";
			$message = $message . $_SESSION['fullname'] . ' has invited you to join a carpool at  purpool.com
			where we build community through ride-sharing . Please register for Purpool at ';
			$message = $MISC['site_url'].'register.php?email=' . $email;
			$message = $message . ' to view the complete invitation.' . "\n\n";
			$message = $message . 'Carpooling is a great way to save money, help the environment and get to know
			other people in your workplace. We created Purpool to bring the benefits of carpools to people like
			you and are just a few clicks away from being part of one!' . "\n\n";
			$message = $message . 'Happy Carpooling,' . "\n\n";
			$message = $message . 'The Purpool Team' . "\n\n";
			if($invitemessage)
			{
				// Include personalized message
				$message = $message . '---' . "\n\n";
				$message = $message . $invitemessage;
			}

		}

		// E-mail user
		mail($email, 'RE: Purpool Invitation', $message, "From: ".$MISC['admin_email']);

		// Redirect user
		$redirect = 'pools.php?state=editmembers&pool=' . $_GET['pool'] . '&confirmation=resendinvite';
		header("Location: $redirect");

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

	# REMOVE INVITATION
	case "removeinvite":

		// Check to make sure that the user is allowed to access this page (prevents hacking)
		$sql = "SELECT user_id FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		if(!$row) { header("Location: index.php?state=sessionexpired"); exit();  }

		// Remove invited member
		$sql = "DELETE FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND id = '{$_GET['user']}' LIMIT 1";
		$dbh->queryRow($sql);

		// Redirect user
		$redirect = 'pools.php?state=editmembers&pool=' . $_GET['pool'] . '&confirmation=removeinvite';
		header("Location: $redirect");

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

	# VIEW ROUTES
	case "viewroutes":

		// Get pool organizer
		$sql = "SELECT role FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = {$_SESSION['user_id']}";
		$row = $dbh->queryRow($sql);
		if($row['role'] == 'owner')
		{
			// Allow editing
			$tpl->assign('editmode', true);
		} else {
			// Do not allow editing
			header("Location: index.php?state=sessionexpired");
		}

		// Check to make sure that the user is allowed to access this page (prevents hacking)
		$sql = "SELECT user_id FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		if(!$row) { header("Location: index.php?state=sessionexpired"); exit();  }

		// Get pool name
		$poolname = getPoolName($_GET['pool']);
		$tpl->assign('poolname', $poolname);

		// Assign current side navigation
		$tpl->assign('poolscurrent', true);

		// Assign pool_id
		$tpl->assign('pool_id', $_GET['pool']);

		// Get current routes
		$sql = "SELECT
					route_id,
					title,
					distance
				FROM
					poolroutes
				WHERE
					pool_id = '{$_GET['pool']}'
				ORDER BY
					title";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			// Clean distance (1 meter = 0.000621371192 miles)
			$nummiles = round($row['distance'] * 0.000621371192);

			// Create route array
			$routes[] = array(
				'route_id' => $row['route_id'],
				'pool_id' => $_GET['pool'],
				'title' => $row['title'],
				'distance' => $nummiles
			);
		}
		$tpl->assign('routes', $routes);

		// Display Template
		$tpl->display('pools-routes.tpl');

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

	# CREATE ROUTE
	case "createroute":

		// Get pool organizer
		$sql = "SELECT role FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = {$_SESSION['user_id']}";
		$row = $dbh->queryRow($sql);
		if($row['role'] == 'owner')
		{
			// Allow editing
			$tpl->assign('editmode', true);
		} else {
			// Do not allow editing
			header("Location: index.php?state=sessionexpired");
		}

		// Check to make sure that the user is allowed to access this page (prevents hacking)
		$sql = "SELECT user_id FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		if(!$row) { header("Location: index.php?state=sessionexpired"); exit();  }

		// Get pool name
		$poolname = getPoolName($_GET['pool']);
		$tpl->assign('poolname', $poolname);

		// Assign current side navigation
		$tpl->assign('poolscurrent', true);

		// Assign pool_id
		$tpl->assign('pool_id', $_GET['pool']);

		// Get workplace information
		$sql = "SELECT
					a.workplace AS workplace,
					b.address AS address,
					b.city AS city,
					b.state AS state,
					b.zip AS zip,
					b.latitude AS latitude,
					b.longitude AS longitude
				FROM
					users a, workplaces b
				WHERE
					a.user_id = '{$_SESSION['user_id']}' AND a.workplace = b.workplace_id";
		$row = $dbh->queryRow($sql);

		// Assign workplace information
		$tpl->assign('endaddress', $row['address']);
		$tpl->assign('endcity', $row['city']);
		$tpl->assign('endstate', $row['state']);
		$tpl->assign('endzip', $row['zip']);
		$tpl->assign('endlat', $row['latitude']);
		$tpl->assign('endlng', $row['longitude']);

		// Display Template
		$tpl->display('pools-createroute.tpl');

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

	# VIEW/EDIT ROUTE
	case "editroute":

		// Get pool organizer
		$sql = "SELECT role FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = {$_SESSION['user_id']}";
		$row = $dbh->queryRow($sql);
		if($row['role'] == 'owner')
		{
			// Allow editing
			$tpl->assign('editmode', true);
		} else {
			// Do not allow editing
			header("Location: index.php?state=sessionexpired");
		}

		// Check to make sure that the user is allowed to access this page (prevents hacking)
		$sql = "SELECT user_id FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		if(!$row) { header("Location: index.php?state=sessionexpired"); exit();  }

		// Get pool name
		$poolname = getPoolName($_GET['pool']);
		$tpl->assign('poolname', $poolname);

		// Assign current side navigation
		$tpl->assign('poolscurrent', true);

		// Assign pool_id
		$tpl->assign('pool_id', $_GET['pool']);

		// Assign route_id
		$tpl->assign('route', $_GET['route']);

		// Get route information
		$sql = "SELECT
					title,
					startaddress,
					startcity,
					startstate,
					startzip,
					endaddress,
					endcity,
					endstate,
					endzip,
					endlatitude,
					endlongitude,
					distance,
					vertices,
					description
				FROM
				poolroutes
					WHERE
					route_id = '{$_GET['route']}'";
		$row = $dbh->queryRow($sql);

		$tpl->assign('title', htmlspecialchars($row['title'], ENT_QUOTES));
		$tpl->assign('startaddress', $row['startaddress']);
		$tpl->assign('startcity', $row['startcity']);
		$tpl->assign('startstate', $row['startstate']);
		$tpl->assign('startzip', $row['startzip']);
		$tpl->assign('endaddress', $row['endaddress']);
		$tpl->assign('endcity', $row['endcity']);
		$tpl->assign('endstate', $row['endstate']);
		$tpl->assign('endzip', $row['endzip']);

	$tpl->assign('endlat', $row['endlatitude']); // Temporary
	$tpl->assign('endlng', $row['endlongitude']); // Temporary
		$tpl->assign('distance', $row['distance']);
		$tpl->assign('vertices', $row['vertices']);
		$tpl->assign('description', $row['description']);

		// Display Template
		$tpl->display('pools-editroute.tpl');

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

	# DELETE ROUTE
	case "deleteroute":

		// Get pool organizer
		$sql = "SELECT role FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = {$_SESSION['user_id']}";
		$row = $dbh->queryRow($sql);
		if($row['role'] == 'owner')
		{
			// Allow editing
			$tpl->assign('editmode', true);
		} else {
			// Do not allow editing
			header("Location: index.php?state=sessionexpired");
		}

		// Check to make sure that the user is allowed to access this page (prevents hacking)
		$sql = "SELECT user_id FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		if(!$row) { header("Location: index.php?state=sessionexpired"); exit();  }

		// Assign current side navigation
		$tpl->assign('poolscurrent', true);

		// Assign pool_id
		$tpl->assign('pool_id', $_GET['pool']);

		// Assign formaction
		$formaction = 'pools.php?state=deleteroute&route=' . $_GET['route'] . '&pool=' . $_GET['pool'];
		$tpl->assign('formaction', $formaction);

		// Assign warning message
		$tpl->assign('warning', 'route');

		// If the yes button has been pressed
		if(isset($_POST['yes']))
		{
			// Delete route from database
			$sql = "DELETE FROM poolroutes WHERE route_id = '{$_GET['route']}'";
			$dbh->query($sql);

			// Redirect user
			$redirect = 'pools.php?state=viewroutes&pool=' . $_GET['pool'] . '&confirmation=deleteroute';
			header("Location: $redirect");


			// Disconnect from database
			$dbh->disconnect();
			exit();
		}

		// If the yes button has been pressed
		if(isset($_POST['no']))
		{
			// Redirect user
			$redirect = 'pools.php?state=viewroutes&pool=' . $_GET['pool'];
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

	# CREATE ROUTE SAVE
	case "saveroute":

		// Get pool organizer
		$sql = "SELECT role FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = {$_SESSION['user_id']}";
		$row = $dbh->queryRow($sql);
		if($row['role'] == 'owner')
		{
			// Allow editing
			$tpl->assign('editmode', true);
		} else {
			// Do not allow editing
			header("Location: index.php?state=sessionexpired");
			exit();
		}

		// Check to make sure that the user is allowed to access this page (prevents hacking)
		$sql = "SELECT user_id FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		if(!$row) { header("Location: index.php?state=sessionexpired"); exit();  }

		// Create error array
		$error = array();

		// Check for a title
		if(isset($_POST['title']) && empty($_POST['title'])){
			$error['title'] = 'A title is required.';
		} 
		else if(isset($_GET['title'])){
				// Check to see that the title is unique
				$sql = "SELECT title FROM poolroutes WHERE title = '{$_POST['title']}'";
				$row = $dbh->queryRow($sql);
				if($row){
					$error['title'] = 'This title is already taken. Please choose another.';
				}
		}

		// If there are no errors, create route
		// Otherwise, display errors
		if(sizeof($error) == 0){
			// Check to see if we are inserting or updating a route
			if(isset($_GET['route'])){
				// Update existing route
				$sql = "UPDATE poolroutes SET
							title = '{$_POST['title']}',
							startaddress = '{$_POST['startaddress']}',
							startcity = '{$_POST['startcity']}',
							startstate = '{$_POST['startstate']}',
							startzip = '{$_POST['startzip']}',
							startlatitude = '{$_POST['startlat']}',
							startlongitude = '{$_POST['startlng']}',
							endaddress = '{$_POST['endaddress']}',
							endcity = '{$_POST['endcity']}',
							endstate = '{$_POST['endstate']}',
							endzip = '{$_POST['endzip']}',
							endlatitude = '{$_POST['endlatitude']}',
							endlongitude = '{$_POST['endlongitude']}',
							distance = '{$_POST['distance']}',
							vertices = '{$_POST['vertices']}',
							description = '{$_POST['description']}'
						WHERE
							route_id = '{$_GET['route']}' AND pool_id = '{$_GET['pool']}'";
				$dbh->query($sql);
	
					// Log action
				Utils::logAction($_SESSION['username'], 'Updated Route', $_POST['title']);
			}
			else {
				// Insert pool information
				$sql = "INSERT INTO poolroutes (
					route_id,
					pool_id,
					title,
					startaddress,
					startcity,
					startstate,
					startzip,
					startlatitude,
					startlongitude,
					endaddress,
					endcity,
					endstate,
					endzip,
					endlatitude,
					endlongitude,
					distance,
					vertices,
					description
				) VALUES (
					NULL,
					'{$_POST['pool']}',
					'{$_POST['title']}',
					'{$_POST['startaddress']}',
					'{$_POST['startcity']}',
					'{$_POST['startstate']}',
					'{$_POST['startzip']}',
					'{$_POST['startlat']}',
					'{$_POST['startlng']}',
					'{$_POST['endaddress']}',
					'{$_POST['endcity']}',
					'{$_POST['endstate']}',
					'{$_POST['endzip']}',
					'{$_POST['endlatitude']}',
					'{$_POST['endlongitude']}',
					'{$_POST['distance']}',
					'{$_POST['vertices']}',
					'{$_POST['description']}'
				)";
				$dbh->query($sql);
			
				// Log action
				Utils::logAction($_SESSION['username'], 'Created New Route', $_POST['title']);
				//The first route entered by pool leader becomes the default route
				$sql = "SELECT 
							route_id
						FROM 
							poolroutes
						WHERE
							pool_id = '{$_POST['pool']}'";
				$result = $dbh->queryAll($sql);
				//queryAll returns a 2-dim array: 1st index is rwo in returned table
				if(count($result)==1){//if pool's first route can set default_route field in pool table
					$sql = "UPDATE pools SET
								default_route = '{$result[0]['route_id']}'
							WHERE
								pool_id = '{$_GET['pool']}';";
					$dbh->query($sql);
				}

			// Build JSON array
			}
			$json = array(
				"status" => "success",
				"pool" => $_GET['pool']
			);
		}
		else {
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

	break;






	# VIEW SCHEDULE
	case "viewschedule":

		// Get pool organizer
		$sql = "SELECT role FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = {$_SESSION['user_id']}";
		$row = $dbh->queryRow($sql);
		if($row['role'] == 'owner')
		{
			// Allow editing
			$tpl->assign('editmode', true);
		}

		// Check to make sure that the user is allowed to access this page (prevents hacking)
		$sql = "SELECT user_id FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		if(!$row) { header("Location: index.php?state=sessionexpired"); exit();  }

		// Check to see if the pool has a reoccurring schedule
		// If they do not, redirect them to the edit schedule page
		$sql = "SELECT schedule_id FROM poolschedules WHERE pool_id = '{$_GET['pool']}'";
		$result = $dbh->query($sql);
		$numrows = $result->numRows();
		if($numrows == 0){
			// Redirect to edit schedule screen
			$redirect = 'pools.php?state=editschedule&pool=' . $_GET['pool'];
			header("Location: $redirect");

			// Disconnect from database
			$dbh->disconnect();
			exit();
		}

		// Get pool name
		$poolname = getPoolName($_GET['pool']);
		$tpl->assign('poolname', $poolname);

		// Assign pool_id
		$tpl->assign('pool_id', $_GET['pool']);

		// Assign current side navigation
		$tpl->assign('poolscurrent', true);

		// Get the number of weeks in the current year
		if(isset($_GET['year'])){
			$lastdaycurrentyear = '12/31/' . $_GET['year'];
			$lastdaypreviousyear = '12/31/' . $_GET['year'] - 1;
		} else {
			$lastdaycurrentyear = '12/31/' . date('Y');
			$lastdaypreviousyear = '12/31/' . date('Y') - 1;
		}
		$numweekscurrentyear = strftime("%W",strtotime("12/31/$lastdaycurrentyear"));
		$numweekspreviousyear = strftime("%W",strtotime("12/31/$lastdaypreviousyear"));

		// Get current week and year
		if(isset($_GET['week']) && isset($_GET['year'])){
			$week = $_GET['week'];
			$year = $_GET['year'];
		} else {
			$week = date('W');
			$year = date('Y');

			//check if any rides remain in current week
			$sql = "SELECT
					monday,
					tuesday,
					wednesday,
					thursday,
					friday,
					saturday,
					sunday
				FROM
					poolschedules
				WHERE
					pool_id = '{$_GET['pool']}'
				ORDER BY
					savedate DESC LIMIT 1";
			$row = $dbh->queryRow($sql);
			$remainingrides = 0;
			$index = 0;
			$currdayofweek = date('w');

			foreach($row as $day){
				if($index >= $currdayofweek){
					if($day == 'y') $remainingrides++;
				}
				$index++;
			}

			if($remainingrides == 0){
				if($week == $numweekscurrentyear)
				{
					$week = '01';
					$year = $year+1;
				}
				else{
					$week = date('W', mktime(0, 0, 0, date("m")  , date("d")+7, date("Y")));
				}
			}
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

		// Fix weird year-end date('W') issue
		// date('W') will return '01' even if the date is set at ('12-30-08') because of the way ISO dates are set
		// This will fix the issue, although it seems really odd to have to do this
		if(!isset($_GET['week']))
		{
			if(($week == 01) && (date('m') == '12'))
			{
				$year = $year + 1;

				$tpl->assign('pweek', sprintf("%02d", $numweekscurrentyear));
				$tpl->assign('pyear', $year - 1);
				$tpl->assign('nweek', sprintf("%02d",$week + 1));
				$tpl->assign('nyear', $year);
			}
		}

		// Get current date
		$currentdate = date("Y") . '-' . date("m") . '-' . date("d");

		//Calculate dates
		$dates=array();
		$fulldates=array();
		$shortdates=array();
		for($i=1; $i<=7; $i++){
			$dates[$i] = date("l, m/d/Y", strtotime("{$year}-W{$week}-".$i));
			$fulldates[$i] = date("Y-m-d", strtotime("{$year}-W{$week}-".$i));
			$shortdates[$i] = date("l, m/d", strtotime("{$year}-W{$week}-".$i));
		}
		
		//Assign Dates
		$tpl->assign('fulldates', $fulldates);
		$tpl->assign('dates', $dates);
		$tpl->assign('shortdates', $shortdates);

		// Assign date range
		$daterange = $dates[1].' to '.$dates[7];
		$tpl->assign('daterange', $daterange);

		// Gets confirms for the week for all users
		$sql2 = "SELECT 
					confirm, user_id, DATE_FORMAT(rdate, '%Y-%m-%d') AS rdate 
				FROM poolpassengers 
				WHERE  pool_id = '{$_GET['pool']}' AND rdate >= '$fulldates[1]' AND  rdate <= '$fulldates[7]'";
		
		$result = $dbh->query($sql2);
		$confirms=array();
		for($i=1; $i<=7; $i++){
			$fulldate = $fulldates[$i];
			$result = $dbh->query($sql2);
			while($row = $result->fetchRow()){
				if($row['rdate'] == $fulldate){
					$confirms[$i][$row['user_id']] = $row['confirm'];
				}
			}
		}

		// Create weekdates array
		$daysOfWeek = array("","monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday");
		
		$sql4 = "SELECT rotation_type FROM pools WHERE pool_id = '{$_GET['pool']}'";
		$row4 = $dbh->queryRow($sql4);
		$rotation_type = $row4['rotation_type'];
		
		//Get started on driver assignments
		$default_drivers=array();
		switch($rotation_type){
			case "fairness":
				$fairness=array();
				$sql5 = "SELECT user_id, fairness FROM poolmembers WHERE pool_id = '{$_GET['pool']}'";
				
				$result = $dbh->query($sql5);
				while($row = $result->fetchRow()){
					$fairness[$row['user_id']] = $row['fairness'];
				}	
			break;
			case "day_of_week":
			case "default":
				$sql5 = "SELECT 
								monday_driver, tuesday_driver, wednesday_driver, thursday_driver, friday_driver, saturday_driver, sunday_driver 
							FROM poolschedules 
							WHERE pool_id = '{$_GET['pool']}'";
				$row5 = $dbh->queryRow($sql5);
				$default_drivers['monday'] = $row5['monday_driver'];
				$default_drivers['tuesday'] = $row5['tuesday_driver'];
				$default_drivers['wednesday'] = $row5['wednesday_driver'];
				$default_drivers['thursday'] = $row5['thursday_driver'];
				$default_drivers['friday'] = $row5['friday_driver'];
				$default_drivers['saturday'] = $row5['saturday_driver'];
				$default_drivers['sunday'] = $row5['sunday_driver'];			
			break;
		}

		//Get  Assigned Drivers for week if they exist
		$drivers=array();
		$sql3 = "SELECT 
					driver, DATE_FORMAT(rdate, '%Y-%m-%d') 
				AS rdate 
				FROM poolitineraries 
				WHERE pool_id = '{$_GET['pool']}' AND rdate >= '$fulldates[1]' AND  rdate <= '$fulldates[7]'";
		
	// Get pool days
		$sql = "SELECT monday,tuesday, wednesday,thursday,friday,saturday, sunday
				FROM
					poolschedules
				WHERE
					pool_id = '{$_GET['pool']}' AND DATE_FORMAT(savedate, '%Y-%m-%d') <= '{$fulldates[7]}'
				ORDER BY
					savedate DESC LIMIT 1";
		$daysInSchedule = $dbh->queryRow($sql);

		// Check which days are part of schedule and have been saved
		$daysSaved = array();
		for($i=1; $i<=7; $i++){
			$fulldate = $fulldates[$i];
			$day=$daysOfWeek[$i];
			if($daysInSchedule[$day] == 'y'){
				$tpl->assign($day, true);
				$tpl->assign('date'.$day, $dates[$i]);
	
				//test if itinerary has been saved before
				$dayIsSaved = true;
				$sql  = "SELECT ride_id FROM poolitineraries WHERE pool_id = '{$_GET['pool']}' AND rdate = '$fulldates[$i]'";
				$result = $dbh->query($sql);
				if($result->numRows() == 0){
					$dayIsSaved = false;
				}
				$tpl->assign($day.'issaved', $dayIsSaved);
	
				//Find # of members accepted for this date
				$sql  = "SELECT passenger_id FROM poolpassengers WHERE pool_id = '{$_GET['pool']}' AND rdate = '$fulldates[$i]' AND confirm = 'accept'";
				$result = $dbh->query($sql);
				$dayAccepted = $result->numRows();
				$tpl->assign($day.'accepted', $dayAccepted);
			}
		}
		
		//Use queryAll to get a two dimensional array of results. Other methods, including queryRow are pop type methods.
		$result = $dbh->queryAll($sql3);
		for($i=1; $i<=7; $i++){
			$fulldate = $fulldates[$i];
			for($row=0; $row<count($result); $row++){							
				if($result[$row]['rdate'] == $fulldate){
					$drivers[$i] = $result[$row]['driver'];
				}
			}
			if(!isset($drivers[$i])){
				//assign driver by rotation_type
				if($rotation_type == "default" || $rotation_type == "day_of_week"){
					$drivers[$i] = $default_drivers[$daysOfWeek[$i]];
				}
				else if($rotation_type == "fairness"){
					//check if date is in the future
					$dayispast = false;
					if(strtotime($fulldates[$i]." 23:59:59") > strtotime("now") && $daysInSchedule[$daysOfWeek[$i]]=='y'){
						arsort($fairness);
						$drivers[$i] = key($fairness);
						$fairness[$drivers[$i]] -= 1/3;
					}
					else {
						$drivers[$i]=" ";
					}
				}
				else{
					$drivers[$i]=" ";
				}
			}
			$tpl->assign($daysOfWeek[$i].'driver', $drivers[$i]);
		}
		

		// Get pool members
		$sql = "SELECT
					a.user_id AS user_id,
					a.role AS role,
					b.firstname AS firstname,
					b.lastname AS lastname,
					status
				FROM
					poolmembers a, users b
				WHERE
					a.user_id = b.user_id AND a.pool_id = '{$_GET['pool']}' AND a.status = 'accepted'
				ORDER BY
					fairness DESC";	
			
		//echo $sql;			
		$result = $dbh->query($sql);
		while($row = $result->fetchRow()){
			// Check for user confirmation
			if($row['user_id'] == $_SESSION['user_id']){
				$editable = true;
			} else {
				$editable = false;
			}
	 	
			// Check to see if this ride occurred in the past
			$daysEditable=array();
			for($i=1; $i<=7; $i++){
				if ($fulldates[$i] >= $currentdate) { 
					$daysEditable[$i] = true;
				} 
				else { 
					$daysEditable[$i] = false; 
				}
				if(!isset($confirms[$i][$row['user_id']])){
					$confirms[$i][$row['user_id']]='';
				}
			}

			$members[] = array(
				'user_id' => $row['user_id'],
				'name' => $row['firstname'] . ' ' . $row['lastname'],
				'status' => $row['status'],
				'editable' => $editable,
				'mondayconfirm' => $confirms[1][$row['user_id']],
				'tuesdayconfirm' => $confirms[2][$row['user_id']],
				'wednesdayconfirm' => $confirms[3][$row['user_id']],
				'thursdayconfirm' => $confirms[4][$row['user_id']],
				'fridayconfirm' => $confirms[5][$row['user_id']],
				'saturdayconfirm' => $confirms[6][$row['user_id']],
				'sundayconfirm' => $confirms[7][$row['user_id']],
				'mondayeditable' => $daysEditable[1],
				'tuesdayeditable' => $daysEditable[2],
				'wednesdayeditable' => $daysEditable[3],
				'thursdayeditable' => $daysEditable[4],
				'fridayeditable' => $daysEditable[5],
				'saturdayeditable' => $daysEditable[6],
				'sundayeditable' => $daysEditable[7]
			);
		}
		
		$tpl->assign('members', $members);
	
		// Get routes
		$sql = "SELECT route_id, title FROM poolroutes WHERE pool_id = '{$_GET['pool']}' ORDER BY title";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			$routes[] = array(
				'route_id' => $row['route_id'],
				'title' => $row['title']
			);
		}
		$tpl->assign('routes', $routes);

		$sql = "SELECT
					route,
					DATE_FORMAT(dm_time, '%k:%i') AS dm,
					DATE_FORMAT(aw_time, '%k:%i') AS aw,
					DATE_FORMAT(dw_time, '%k:%i') AS dw,
					notes,
					DATE_FORMAT(rdate, '%Y-%m-%d') AS rdate
				FROM
					poolitineraries
				WHERE pool_id = '{$_GET['pool']}' AND rdate >= '$fulldates[1]' AND  rdate <= '$fulldates[7]'";
		$result = $dbh->queryAll($sql);
			
		for($i=1; $i<=7; $i++){
			$fulldate = $fulldates[$i];
			$day=$daysOfWeek[$i];
			$row=0;
			$itinerary = false;
			for($row=0; $row<count($result); $row++){							
				if($result[$row]['rdate'] == $fulldate){//if there is an itinerary for the day
					// Assign route
					$tpl->assign($day.'_route', $result[$row]['route']);
		
					// Depart from meeting place time
					$cleandm = Utils::cleantime($result[$row]['dm']);
					$tpl->assign($day.'_dm_hour', $cleandm['hour']);
					$tpl->assign($day.'_dm_minute', $cleandm['minute']);
					$tpl->assign($day.'_dm_ampm', $cleandm['ampm']);
	
					// Arrive at workplace
					$cleanaw = Utils::cleantime($result[$row]['aw']);
					$tpl->assign($day.'_aw_hour', $cleanaw['hour']);
					$tpl->assign($day.'_aw_minute', $cleanaw['minute']);
					$tpl->assign($day.'_aw_ampm', $cleanaw['ampm']);
		
					// Depart from workplace
					$cleandw = Utils::cleantime($result[$row]['dw']);
					$tpl->assign($day.'_dw_hour', $cleandw['hour']);
					$tpl->assign($day.'_dw_minute', $cleandw['minute']);
					$tpl->assign($day.'_dw_ampm', $cleandw['ampm']);
		
					// Assign additional notes
					$tpl->assign($day.'_notes', $result[$row]['notes']);
		
					// Assign ride_id
					$tpl->assign($day.'_ride', $fulldate);
					
					//Setting the $itinerary flag to true to indicate that day has one
					$itinerary = true;
				}
			}
			if(!$itinerary){ //in the event that there is no itinerary for the day			
				$defroute="";
				$sql = "SELECT default_route FROM pools WHERE pool_id = '{$_GET['pool']}'";
				$row = $dbh->queryRow($sql);
				$defroute = $row['default_route'];
				if(!isset($defroute) || $defroute==null){
					$sql = "SELECT route_id FROM poolroutes WHERE pool_id = '{$_GET['pool']}' ORDER BY route_id LIMIT 1";
					$row = $dbh->queryRow($sql);
					$defroute = $row['route_id'];
				}
				$tpl->assign($day.'_route',  $defroute);
					
				// Check to see if this day exists in the reocurring schedule
				$sql6 = "SELECT
							$day,
							{$day}_aw AS aw,
							{$day}_dw AS dw
						FROM
							poolschedules
						WHERE
							pool_id = '{$_GET['pool']}' 
						AND DATE_FORMAT(savedate, '%Y-%m-%d') <= '$dates[$i]'
						ORDER BY
							savedate DESC LIMIT 1";	
				$row6 = $dbh->queryRow($sql6);
	
				// If this day exists, get the times
				if($row6[$day] == 'y'){	
				// Depart from meeting place time (defaults to 1 hour less than aw time)
					$dm = explode(':', $row6['aw']);
					if($dm[0] < 24){
						$dmtime = $dm[0] + 1 . ':' . $dm[1];
					} else {
						$dmtime = "1" . ':' . $dm[1];
					}
					$cleandm = Utils::cleantime($dmtime);
					$tpl->assign($day.'_aw_hour', $cleandm['hour']);
					$tpl->assign($day.'_aw_minute', $cleandm['minute']);
					$tpl->assign($day.'_aw_ampm', $cleandm['ampm']);
		
					// Arrive at workplace
					$cleanaw = Utils::cleantime($row6['aw']);
					$tpl->assign($day.'_dm_hour', $cleanaw['hour']);
					$tpl->assign($day.'_dm_minute', $cleanaw['minute']);
					$tpl->assign($day.'_dm_ampm', $cleanaw['ampm']);
	
					// Depart from workplace
					$cleandw = Utils::cleantime($row6['dw']);
					$tpl->assign($day.'_dw_hour', $cleandw['hour']);
					$tpl->assign($day.'_dw_minute', $cleandw['minute']);
					$tpl->assign($day.'_dw_ampm', $cleandw['ampm']);
	
					// Assign ride_id
					$tpl->assign($day.'_ride', $fulldate);
	
					// Assign additional notes
					$tpl->assign($day.'_notes', '');
		
					// Assign ride_id
					$tpl->assign($day.'_ride', $fulldate);							
				}
			}
		}

	
		
		// Display Template
		$tpl->display('pools-schedule.tpl');

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

	# SAVE ITINERARY
	case "saveitinerary":

		// Get pool organizer
		$sql = "SELECT role FROM poolmembers WHERE pool_id = '{$_POST['pool']}' AND user_id = {$_SESSION['user_id']}";
		$row = $dbh->queryRow($sql);
		if($row['role'] == 'owner')
		{
			// Allow editing
			$tpl->assign('editmode', true);
		} else {
			// Do not allow editing
			//header("Location: index.php?state=sessionexpired");
			//exit();
		}

		// Check to make sure that the user is allowed to access this page (prevents hacking)
		$sql = "SELECT user_id FROM poolmembers WHERE pool_id = '{$_POST['pool']}' AND user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		if(!$row) { header("Location: index.php?state=sessionexpired"); exit();  }

		$error=array();
		// Check driver
		if(empty($_POST['driver']))
		{
			$error['driver'] = 'A driver is required';
		}

		// Check route
		if(empty($_POST['route']))
		{
			$error['route'] = 'A route is required';
		}

		// Get weekday
		$weekday = $_POST['day'];

		// Get notes
		$notes = $_POST[$weekday.'_notes'];


		// Get times
		$dm_time = Utils::inputtime($_POST[$weekday.'_dm_hour'], $_POST[$weekday.'_dm_minute'], $_POST[$weekday.'_dm_ampm']);
		//$aw_time = Utils::inputtime($_POST[$weekday.'_aw_hour'], $_POST[$weekday.'_aw_minute'], $_POST[$weekday.'_aw_ampm']);
		$dw_time = Utils::inputtime($_POST[$weekday.'_dw_hour'], $_POST[$weekday.'_dw_minute'], $_POST[$weekday.'_dw_ampm']);

		// If there are no errors, insert or update errors
		// Otherwise, display errors
		if(sizeof($error) == 0)
		{

			// Check to see if there is already a record on file for this day
			$sql  = "SELECT ride_id FROM poolitineraries WHERE pool_id = '{$_POST['pool']}' AND rdate = '{$_POST['rdate']}'";
			$result = $dbh->query($sql);

			if($result->numRows() == 0)
			{

				// Insert itinerary record into database
				$sql = "INSERT INTO poolitineraries (
							ride_id,
							pool_id,
							day,
							driver,
							route,
							rdate,
							dm_time,
							
							dw_time,
							notes
						) VALUES (
							NULL,
							'{$_POST['pool']}',
							'{$_POST['day']}',
							'{$_POST['driver']}',
							'{$_POST['route']}',
							'{$_POST['rdate']}',
							'$dm_time',
							
							'$dw_time',
							'$notes'
						)";
				$dbh->query($sql);

				// Loop through pool passengers
				$sql = "SELECT user_id FROM poolmembers WHERE pool_id = '{$_POST['pool']}' AND status = 'accepted'";
				$result = $dbh->query($sql);
				while($row = $result->fetchRow())
				{
					// Check to see if the pool member already has a confirmation on file for this date
					// They shouldn't but it's good to double check
					$sql2 = "SELECT passenger_id FROM poolpassengers WHERE pool_id = '{$_POST['pool']}' AND user_id = '{$row['user_id']}' AND rdate = '{$_POST['rdate']}'";
					$row2 = $dbh->queryRow($sql2);

					if(!$row2)
					{
						// Insert records into poolpassengers
						$sql = "INSERT INTO poolpassengers (
								passenger_id,
								pool_id,
								user_id,
								confirm,
								rdate
							) VALUES (
								NULL,
								'{$_POST['pool']}',
								'{$row['user_id']}',
								'',
								'{$_POST['rdate']}'
							)";
						$dbh->query($sql);
					}

				}

			} else {

				// Update existing record
				$sql = "UPDATE poolitineraries SET
							driver = '{$_POST['driver']}',
							route = '{$_POST['route']}',
							dm_time = '$dm_time',
							
							dw_time = '$dw_time',
							notes = '$notes'
						WHERE
							pool_id = '{$_POST['pool']}' AND rdate = '{$_POST['rdate']}'";
				$dbh->query($sql);

			}

			// Build JSON array
			$json = array(
				"status" => "success",
				"day" => $_POST['day']
			);

			// Log action
			//Utils::logAction($_SESSION['username'], 'Updated Daily Schedule', $_POST['rdate']);


		} else {

			// Build JSON array
			$json = array(
				"status" => "failure",
				"day" => $_POST['day'],
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


	break;
	
	# SAVE ITINERARY FOR ENTIRE WEEK
	case "saveweekitinerary":

		// Get pool organizer
		$sql = "SELECT role FROM poolmembers WHERE pool_id = '{$_POST['pool']}' AND user_id = {$_SESSION['user_id']}";
		$row = $dbh->queryRow($sql);
		if($row['role'] == 'owner')
		{
			// Allow editing
			$tpl->assign('editmode', true);
		} else {
			// Do not allow editing
			header("Location: index.php?state=sessionexpired");
			exit();
		}

		// Check to make sure that the user is allowed to access this page (prevents hacking)
		$sql = "SELECT user_id FROM poolmembers WHERE pool_id = '{$_POST['pool']}' AND user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		if(!$row) { header("Location: index.php?state=sessionexpired"); exit();  }
		$weekdays=array("monday", "tuesday", "wednesday", "thursday", "friday","saturday", "sunday");
		$days=array();
		$totalError=array();
		for($i=0; $i<7; $i++){
			if(array_key_exists($weekdays[$i].'_day', $_POST)){
				$error=null; 
				array_push($days, $weekdays[$i]);
				$driver = $_POST[$weekdays[$i].'_driver'];
				// Check driver
				if(empty($driver)){
					$error['driver'] = 'A driver is required';
				}

				// Check route
				$route = $_POST[$weekdays[$i].'_route'];
				if(empty($route)){
					$error['route'] = 'A route is required';
				}
				// Get notes
				$notes = $_POST[$weekdays[$i].'_notes'];

				// Get times
				$dm_time = Utils::inputtime($_POST[$weekdays[$i].'_dm_hour'], $_POST[$weekdays[$i].'_dm_minute'], $_POST[$weekdays[$i].'_dm_ampm']);
				//$aw_time = Utils::inputtime($_POST[$weekdays[$i].'_aw_hour'], $_POST[$weekdays[$i].'_aw_minute'], $_POST[$weekdays[$i].'_aw_ampm']);
				$aw_time = '00:00:00';
				$dw_time = Utils::inputtime($_POST[$weekdays[$i].'_dw_hour'], $_POST[$weekdays[$i].'_dw_minute'], $_POST[$weekdays[$i].'_dw_ampm']);

				// If there are no errors, insert or update errors
				// Otherwise, display errors
				if(sizeof($error) == 0){
					// Check to see if there is already a record on file for this day
					$mydate = $_POST[$weekdays[$i].'_rdate'];
					$sql  = "SELECT ride_id FROM poolitineraries WHERE pool_id = '{$_POST['pool']}' AND rdate = '{$mydate}'";
					$result = $dbh->query($sql);
					if($result->numRows() == 0){
						$pool = $_POST['pool'];
						

						// Insert itinerary record into database
						$sql = "INSERT INTO poolitineraries (
									ride_id,
									pool_id,
									day,
									driver,
									route,
									rdate,
									dm_time,
									aw_time,
									dw_time,
									notes
								) VALUES (
									NULL,
									'{$pool}',
									'{$weekdays[$i]}',
									'{$driver}',
									'{$route}',
									'{$mydate}',
									'{$dm_time}',
									'{$aw_time}',
									'{$dw_time}',
									'{$notes}'
								)";
							
						$dbh->query($sql);
		
						// Loop through pool passengers
						$sql = "SELECT user_id FROM poolmembers WHERE pool_id = '{$_POST['pool']}' AND status = 'accepted'";
						$result = $dbh->query($sql);
						while($row = $result->fetchRow())
						{
							// Check to see if the pool member already has a confirmation on file for this date
							// They shouldn't but it's good to double check
							$sql2 = "SELECT passenger_id FROM poolpassengers WHERE pool_id = '{$_POST['pool']}' AND user_id = '{$row['user_id']}' AND rdate = '{$mydate}'";
							$row2 = $dbh->queryRow($sql2);
		
							if(!$row2)
							{
								// Insert records into poolpassengers
								$sql = "INSERT INTO poolpassengers (
										passenger_id,
										pool_id,
										user_id,
										confirm,
										rdate
									) VALUES (
										NULL,
										'{$_POST['pool']}',
										'{$row['user_id']}',
										'',
										'{$mydate}'
									)";
								$dbh->query($sql);
								$sql1=$sql;
							}
						}
					} else {
		
						// Update existing record
						$sql = "UPDATE poolitineraries SET
									driver = '{$driver}',
									route = '{$route}',
									dm_time = '$dm_time',
									aw_time = '$aw_time',
									dw_time = '$dw_time',
									notes = '$notes'
								WHERE
									pool_id = '{$_POST['pool']}' AND rdate = '{$mydate}'";
						$dbh->query($sql);
					}
				}
				else{
					$totalError[$weekdays[$i]]=$error;
				}
			}//end of if statement that checks if day of week is in the recurring schedule
		}//end of loop over days
		if(sizeof($totalError)==0){	
			// Build JSON array
			$json = array(
				"status" => "success",
				"day" => $days
			);
		}
		else {
			// Build JSON array
			$json = array(
				"status" => "failure",
				"day" => $days,
				"error" => $totalError
			);
		}
			// Log action
			//Utils::logAction($_SESSION['username'], 'Updated Daily Schedule', $_POST['rdate']);



			
			
		// Out response to browser
		$output = json_encode($json);

		// Output to browser
		echo $output;

		// Disconnect from database
		$dbh->disconnect();
		exit();


	break;


	# CONFIRM ITINERARY
	case "confirmitinerary":

		// Check to make sure that the user is allowed to access this page (prevents hacking)
		$sql = "SELECT user_id FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		if(!$row) { header("Location: index.php?state=sessionexpired"); exit();  }

		// Check to see if a passengers has already confirmed
		$sql = "SELECT passenger_id FROM poolpassengers WHERE pool_id = '{$_GET['pool']}' AND rdate = '{$_GET['rdate']}' AND user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		if(!$row)
		{
			// Insert new record
			$sql = "INSERT INTO poolpassengers (pool_id, user_id, confirm, rdate) VALUES ('{$_GET['pool']}', '{$_SESSION['user_id']}', '{$_GET['confirmation']}', DATE_FORMAT('{$_GET['rdate']}', \"%Y-%m-%d\"))";
			$dbh->query($sql);
		} else {
			// Update existing record
			$sql = "UPDATE poolpassengers SET confirm = '{$_GET['confirmation']}' WHERE pool_id = '{$_GET['pool']}' AND rdate = DATE_FORMAT('{$_GET['rdate']}', \"%Y-%m-%d\") AND user_id = '{$_SESSION['user_id']}'";
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

	# VIEW ITINERARY
	case "viewitinerary":

		// Get pool organizer
		$sql = "SELECT role FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = {$_SESSION['user_id']}";
		$row = $dbh->queryRow($sql);
		if($row['role'] == 'owner')
		{
			// Allow editing
			$tpl->assign('editmode', true);
		}

		// Check to make sure that the user is allowed to access this page (prevents hacking)
		$sql = "SELECT user_id FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		if(!$row) { header("Location: index.php?state=sessionexpired"); exit();  }

		// Get pool name
		$poolname = getPoolName($_GET['pool']);
		$tpl->assign('poolname', $poolname);

		// Assign current side navigation
		$tpl->assign('poolscurrent', true);

		// Assign pool_id
		$tpl->assign('pool_id', $_GET['pool']);

		// Get itinerary information
		$sql = "SELECT
					day,
					driver,
					route,
					DATE_FORMAT(rdate, '%M %d, %Y') AS rdate,
					DATE_FORMAT(dm_time, '%k:%i') AS dm_time,
					DATE_FORMAT(aw_time, '%k:%i') AS aw_time,
					DATE_FORMAT(dw_time, '%k:%i') AS dw_time,
					notes
				FROM
					poolitineraries
				WHERE
					pool_id = '{$_GET['pool']}' AND rdate = '{$_GET['rdate']}'";
		$row = $dbh->queryRow($sql);
		$ridedate = $row['rdate'];

		// Check to see if the itinerary is complete
		if(!$row)
		{

			// Assign template values
			$tpl->assign('rdate', $_GET['rdate']);

			// Display Incomplete template
			$tpl->display('pools-viewitinerary-incomplete.tpl');

			// Disconnect from database
			$dbh->disconnect();
			exit();

		}

		// Depart from meeting place
		$cleandm = Utils::cleantime($row['dm_time']);
		$tpl->assign('dm_hour', $cleandm['hour']);
		$tpl->assign('dm_minute', $cleandm['minute']);
		$tpl->assign('dm_ampm', $cleandm['ampm']);

		// Arrive at workplace
		$cleanaw = Utils::cleantime($row['aw_time']);
		$tpl->assign('aw_hour', $cleanaw['hour']);
		$tpl->assign('aw_minute', $cleanaw['minute']);
		$tpl->assign('aw_ampm', $cleanaw['ampm']);

		// Depart from workplace
		$cleandw = Utils::cleantime($row['dw_time']);
		$tpl->assign('dw_hour', $cleandw['hour']);
		$tpl->assign('dw_minute', $cleandw['minute']);
		$tpl->assign('dw_ampm', $cleandw['ampm']);

		// Get driver name
		$sql2 = "SELECT firstname, lastname FROM users WHERE user_id = '{$row['driver']}'";
		$row2 = $dbh->queryRow($sql2);
		$drivername = $row2['firstname'] . ' ' . $row2['lastname'];

		// Get route information
		$sql3 = "SELECT
					title,
					startaddress,
					startcity,
					startstate,
					startzip,
					startlatitude,
					startlongitude,
					endaddress,
					endcity,
					endstate,
					endzip,
					endlatitude,
					endlongitude,
					distance,
					vertices,
					description
				FROM
					poolroutes
				WHERE
					route_id = '{$row['route']}'";
		$row3 = $dbh->queryRow($sql3);

		// Clean distance (1 meter = 0.000621371192 miles)
		$nummiles = round($row3['distance'] * 0.000621371192);

		// Assign additional notes
		$tpl->assign('notes', $row['notes']);

		// Get the members that are participating in the ride
		$sql = "SELECT user_id, confirm FROM poolpassengers WHERE rdate = '{$_GET['rdate']}' AND pool_id = '{$_GET['pool']}'";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			// Get member names
			$sql2 = "SELECT firstname, lastname FROM users WHERE user_id = '{$row['user_id']}'";
			$row2 = $dbh->queryRow($sql2);

			$members[] = array(
				'user_id' => $row['user_id'],
				'firstname' => $row2['firstname'],
				'lastname' => $row2['lastname'],
				'confirm' => $row['confirm']
			);
		}
		$tpl->assign('members', $members);

		// Get workplace_id
		$sql = "SELECT workplace FROM users WHERE user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);

		// Get workplace title
		$sql = "SELECT name FROM workplaces WHERE workplace_id = '{$row['workplace']}'";
		$row = $dbh->queryRow($sql);
		$tpl->assign('workplace', $row['name']);

		// Assign route information
		$tpl->assign('title', htmlspecialchars($row3['title'], ENT_QUOTES));
		$tpl->assign('startaddress', $row3['startaddress']);
		$tpl->assign('startcity', $row3['startcity']);
		$tpl->assign('startstate', $row3['startstate']);
		$tpl->assign('startzip', $row3['startzip']);
		$tpl->assign('startlatitude', $row3['startlatitude']);
		$tpl->assign('startlongitude', $row3['startlongitude']);
		$tpl->assign('endaddress', $row3['endaddress']);
		$tpl->assign('endcity', $row3['endcity']);
		$tpl->assign('endstate', $row3['endstate']);
		$tpl->assign('endzip', $row3['endzip']);
		$tpl->assign('endlatitude', $row3['endlatitude']);
		$tpl->assign('endlongitude', $row3['endlongitude']);

		$tpl->assign('endlat', $row3['endlatitude']);
		$tpl->assign('endlng', $row3['endlongitude']);

		$tpl->assign('distance', $nummiles);
		$tpl->assign('vertices', $row3['vertices']);
		$tpl->assign('description', $row3['description']);

		// Assign general template values
		$tpl->assign('day', $row['day']);
		$tpl->assign('driver', $drivername);
		$tpl->assign('rdate', $ridedate);


		// Display Template
		$tpl->display('pools-viewitinerary.tpl');

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

	# EDIT SCHEDULE
	case "editschedule":

		$error=array();
		// Get pool organizer
		$sql = "SELECT role FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = {$_SESSION['user_id']}";
		$row = $dbh->queryRow($sql);
		if($row['role'] == 'owner')
		{
			// Allow editing
			$tpl->assign('editmode', true);
		}

		// Check to make sure that the user is allowed to access this page (prevents hacking)
		$sql = "SELECT user_id FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		if(!$row) { header("Location: index.php?state=sessionexpired"); exit();  }

		// Get pool name
		$poolname = getPoolName($_GET['pool']);
		$tpl->assign('poolname', $poolname);

		// Assign current side navigation
		$tpl->assign('poolscurrent', true);

		// Assign pool_id
		$tpl->assign('pool_id', $_GET['pool']);
		
		// Create weekdates array
		$weekdays = array("monday","tuesday","wednesday","thursday","friday","saturday","sunday");
		
		// If the submit button has been pressed
		if(isset($_POST['submit']))
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
			){
				$error['daysofweek'] = 'At least one day is required.';
			} 
			else {
				foreach ($weekdays as $day){
					if(isset($_POST[$day])){
						$tpl->assign($day, $_POST[$day]);
					}
					else{
						$tpl->assign($day, '');
					}
				}
			}

			// Check to see that the start date is not in the past
			$startseconds = mktime(0, 0, 0,  $_POST['month'],  $_POST['day'],  $_POST['year']);
			$currentseconds = mktime(0, 0, 0,  date("m"), date("d"),  date("Y"));
			if($currentseconds > $startseconds)
			{
				$error['startdate'] = 'The starting date that you specified can not occur in the past.';
			}
			$tpl->assign('month', $_POST['month']);
			$tpl->assign('day', $_POST['day']);
			$tpl->assign('year', $_POST['year']);

			// Create week array
			$weekdays = array("monday","tuesday","wednesday","thursday","friday","saturday","sunday");

			foreach ($weekdays as $weekday){
				if(isset($_POST[$weekday])){
					${$weekday . '_aw_time'} = Utils::inputtime($_POST[$weekday.'_aw_hour'], $_POST[$weekday.'_aw_minute'], $_POST[$weekday.'_aw_ampm']);
					$tpl->assign($weekday.'_aw_hour', $_POST[$weekday.'_aw_hour']);
					$tpl->assign($weekday.'_aw_minute', $_POST[$weekday.'_aw_minute']);
					$tpl->assign($weekday.'_aw_ampm', $_POST[$weekday.'_aw_ampm']);

					${$weekday . '_dw_time'} = Utils::inputtime($_POST[$weekday.'_dw_hour'], $_POST[$weekday.'_dw_minute'], $_POST[$weekday.'_dw_ampm']);
					$tpl->assign($weekday.'_dw_hour', $_POST[$weekday.'_dw_hour']);
					$tpl->assign($weekday.'_dw_minute', $_POST[$weekday.'_dw_minute']);
					$tpl->assign($weekday.'_dw_ampm', $_POST[$weekday.'_dw_ampm']);

					${$weekday} = 'y';

				} 
				else {
					${$weekday . '_aw_time'} = '';
					$tpl->assign($weekday.'_aw_hour', '');
					$tpl->assign($weekday.'_aw_minute', '');
					$tpl->assign($weekday.'_aw_ampm','');

					${$weekday . '_dw_time'} = '';
					$tpl->assign($weekday.'_dw_hour', '');
					$tpl->assign($weekday.'_dw_minute', '');
					$tpl->assign($weekday.'_dw_ampm', '');
					${$weekday} = 'n';
				}
			}
			// Assign deleteconfirm option
			//$tpl->assign('deleteconfirm', $_POST['deleteconfirm']);

			// If there are no errors
			if(sizeof($error) == 0)
			{
				// Create startdate
				$startdate = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];

				// Remove any previous reocurring schedule that contains the current startdate or later
				$sql = "DELETE FROM poolschedules WHERE pool_id = '{$_GET['pool']}' AND startdate >= DATE_FORMAT('$startdate', \"%Y-%m-%d\")";
				$dbh->query($sql);

				// Remove any confirmations that were recorded on the current startdate or later
				/*if($_POST['deleteconfirm'] == 'y')
				{*/
					$sql = "DELETE FROM poolitineraries WHERE pool_id = '{$_GET['pool']}' AND rdate >= DATE_FORMAT('$startdate', \"%Y-%m-%d\")";
					$dbh->query($sql);

					$sql = "DELETE FROM poolpassengers WHERE pool_id = '{$_GET['pool']}' AND rdate >= DATE_FORMAT('$startdate', \"%Y-%m-%d\")";
					$dbh->query($sql);
				//}

				$default_driver = $_SESSION['user_id'];
				// Insert new schedule
				$sql = "INSERT INTO poolschedules (
							schedule_id,
							pool_id,
							startdate,
							monday,
							monday_driver,
							monday_aw,
							monday_dw,
							tuesday,
							tuesday_driver,
							tuesday_aw,
							tuesday_dw,
							wednesday,
							wednesday_driver,
							wednesday_aw,
							wednesday_dw,
							thursday,
							thursday_driver,
							thursday_aw,
							thursday_dw,
							friday,
							friday_driver,
							friday_aw,
							friday_dw,
							saturday,
							saturday_driver,
							saturday_aw,
							saturday_dw,
							sunday,
							sunday_driver,
							sunday_aw,
							sunday_dw,
							savedate
						) VALUES (
							NULL,
							'{$_GET['pool']}',
							DATE_FORMAT('$startdate', \"%Y-%m-%d\"),
							'$monday',
							'$default_driver',
							'$monday_aw_time',
							'$monday_dw_time',
							'$tuesday',
							'$default_driver',
							'$tuesday_aw_time',
							'$tuesday_dw_time',
							'$wednesday',
							'$default_driver',
							'$wednesday_aw_time',
							'$wednesday_dw_time',
							'$thursday',
							'$default_driver',
							'$thursday_aw_time',
							'$thursday_dw_time',
							'$friday',
							'$default_driver',
							'$friday_aw_time',
							'$friday_dw_time',
							'$saturday',
							'$default_driver',
							'$saturday_aw_time',
							'$saturday_dw_time',
							'$sunday',
							'$default_driver',
							'$sunday_aw_time',
							'$sunday_dw_time',
							NOW()
						)";

					$dbh->query($sql);

					// Log action
					Utils::logAction($_SESSION['username'], 'Updated Reocurring schedule', '');

					// Redirect user
					$redirect = 'pools.php?state=viewschedule&pool=' . $_GET['pool'] . '&confirmation=updateschedule';
					header("Location: $redirect");

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
						DATE_FORMAT(startdate, '%m') AS month,
						DATE_FORMAT(startdate, '%d') AS day,
						DATE_FORMAT(startdate, '%Y') AS year,
						monday,
						DATE_FORMAT(monday_aw, '%k:%i') AS monday_aw,
						DATE_FORMAT(monday_dw, '%k:%i') AS monday_dw,
						tuesday,
						DATE_FORMAT(tuesday_aw, '%k:%i') AS tuesday_aw,
						DATE_FORMAT(tuesday_dw, '%k:%i') AS tuesday_dw,
						wednesday,
						DATE_FORMAT(wednesday_aw, '%k:%i') AS wednesday_aw,
						DATE_FORMAT(wednesday_dw, '%k:%i') AS wednesday_dw,
						thursday,
						DATE_FORMAT(thursday_aw, '%k:%i') AS thursday_aw,
						DATE_FORMAT(thursday_dw, '%k:%i') AS thursday_dw,
						friday,
						DATE_FORMAT(friday_aw, '%k:%i') AS friday_aw,
						DATE_FORMAT(friday_dw, '%k:%i') AS friday_dw,
						saturday,
						DATE_FORMAT(saturday_aw, '%k:%i') AS saturday_aw,
						DATE_FORMAT(saturday_dw, '%k:%i') AS saturday_dw,
						sunday,
						DATE_FORMAT(sunday_aw, '%k:%i') AS sunday_aw,
						DATE_FORMAT(sunday_dw, '%k:%i') AS sunday_dw
					FROM
						poolschedules
					WHERE
						pool_id = '{$_GET['pool']}'
					ORDER BY
						savedate DESC
					LIMIT 1";
			$row = $dbh->queryRow($sql);

			// Assign days
			$tpl->assign('monday', $row['monday']);
			$tpl->assign('tuesday', $row['tuesday']);
			$tpl->assign('wednesday', $row['wednesday']);
			$tpl->assign('thursday', $row['thursday']);
			$tpl->assign('friday', $row['friday']);
			$tpl->assign('saturday', $row['saturday']);
			$tpl->assign('sunday', $row['sunday']);

			// Assign default template values
			if($row['month'] && $row['day'] && $row['year']){
				$oldstart = date("F j, Y", mktime(0, 0, 0, $row['month'], $row['day'], $row['year']));
				$tpl->assign('oldstart', $oldstart);
			}
			$tpl->assign('month', date("m"));
			$tpl->assign('day',  date("d"));
			$tpl->assign('year',  date("Y"));

			// Create week array
			$weekdays = array("monday","tuesday","wednesday","thursday","friday","saturday","sunday");

			foreach ($weekdays as $weekday)
			{
    			// Create temp variables
				$aw = $weekday . '_aw';
				$dw = $weekday . '_dw';

				if($row[$weekday] == 'y')
				{

					// Arrive at workplace
					$cleanaw = Utils::cleantime($row[$aw]);
					$tpl->assign($aw.'_hour', $cleanaw['hour']);
					$tpl->assign($aw.'_minute', $cleanaw['minute']);
					$tpl->assign($aw.'_ampm', $cleanaw['ampm']);

					// Depart from workplace
					$cleandw = Utils::cleantime($row[$dw]);
					$tpl->assign($dw.'_hour', $cleandw['hour']);
					$tpl->assign($dw.'_minute', $cleandw['minute']);
					$tpl->assign($dw.'_ampm', $cleandw['ampm']);

				} else {

					// Default values (9:00 and 5:00)
					$tpl->assign($aw.'_hour', '9');
					$tpl->assign($aw.'_minute', '00');
					$tpl->assign($aw.'_ampm', 'am');
					$tpl->assign($dw.'_hour', '5');
					$tpl->assign($dw.'_minute', '00');
					$tpl->assign($dw.'_ampm', 'pm');
				}
			}
		}

		// Get comments
		$comments=array();
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

		// Assign deleteconfirm option
		//$tpl->assign('deleteconfirm', 'y');

		// Display Template
		$tpl->display('pools-schedule-edit.tpl');

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

	# ADD COMMENT
	case "addcomment":

		// Check to make sure that the user is allowed to access this page (prevents hacking)
		$sql = "SELECT user_id FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		if(!$row) { header("Location: index.php?state=sessionexpired"); exit();  }

		// Check to see if there is a comment
		if($_POST['comment'])
		{

			// Insert new comment
			$sql = "INSERT INTO schedule_comments (pool_id, user_id, comment, submitdate) VALUES ('{$_GET['pool']}', '{$_SESSION['user_id']}', '{$_POST['comment']}', NOW())";
			$dbh->query($sql);


			// Insert into shoutbox area as well
			$comment = 'Comment on the schedule: ' . $_POST['comment'];
			$sql = "INSERT INTO poolshouts (shout_id, user_id, pool_id, message, shoutdate) VALUES (null, '{$_SESSION['user_id']}', '{$_GET['pool']}', '$comment', NOW())";
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

	# REQUEST INVITE
	case "requestinvite":

		// Insert new invitation request
		$sql = "INSERT INTO poolsrequestinvite (request_id, pool_id, user_id, status) VALUES (null, '{$_GET['pool']}', '{$_SESSION['user_id']}', 'pending')";
		$dbh->query($sql);

		// Redirect user
		$redirect = 'pools.php?state=viewprofile&pool=' . $_GET['pool'] . '&confirmation=inviterequest';
		header("Location: $redirect");

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

	# CONFIRM REQUEST
	case "confirmrequest":

		// Check to make sure that the user is not already in the pool
		$sql = "SELECT user_id FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = '{$_GET['user']}'";
		$row = $dbh->queryRow($sql);
		if(!$row)
		{
			if($_GET['confirm'] == 'accept')
			{
				// Insert users into the poolmembers table
				$sql = "INSERT INTO poolmembers (id, pool_id, user_id, role, status) VALUES (null, '{$_GET['pool']}', '{$_GET['user']}', 'member', 'accepted')";
				$dbh->query($sql);

				// Update poolrequest invite table
				$sql = "UPDATE poolsrequestinvite SET status = 'accepted' WHERE pool_id = '{$_GET['pool']}' AND user_id = '{$_GET['user']}' LIMIT 1";
				$dbh->query($sql);

				// Get user's name and e-mail address
				$sql = "SELECT firstname, lastname, email FROM users WHERE user_id = '{$_GET['user']}'";
				$row = $dbh->queryRow($sql);
				$firstname = $row['firstname'];
				$lastname = $row['lastname'];
				$email = $row['email'];

				// Get pool title
				$sql = "SELECT title FROM pools WHERE pool_id = '{$_GET['pool']}'";
				$row = $dbh->queryRow($sql);
				$title = $row['title'];

				// Compose email to user
				$message = 'Dear ' . $firstname . ' ' . $lastname . ', ' . "\n\n";
				$message = $message . $title . ' has accepted your request join their pool!' . "\n\n";
				$message = $message . 'Happy Carpooling,' . "\n\n";
				$message = $message . 'The Purpool Team' . "\n\n";
				mail($email, 'Purpool: Requested Invitation', $message, "From: ".$MISC['admin_email']);

				// Redirect to dashboard
				header("Location: dashboard.php");

				// Disconnect from database
				$dbh->disconnect();
				exit();
			}
			if($_GET['confirm'] == 'decline')
			{
				// Update poolrequest invite table
				$sql = "UPDATE poolsrequestinvite SET status = 'decline' WHERE pool_id = '{$_GET['pool']}' AND user_id = '{$_GET['user']}' LIMIT 1";
				$dbh->query($sql);

				// Get user's name and e-mail address
				$sql = "SELECT firstname, lastname, email FROM users WHERE user_id = '{$_GET['user']}'";
				$row = $dbh->queryRow($sql);
				$firstname = $row['firstname'];
				$lastname = $row['lastname'];
				$email = $row['email'];

				// Get pool title
				$sql = "SELECT title FROM pools WHERE pool_id = '{$_GET['pool']}'";
				$row = $dbh->queryRow($sql);
				$title = $row['title'];

				// Compose email to user
				$message = 'Dear ' . $firstname . ' ' . $lastname . ', ' . "\n\n";
				$message = $message . $title . ' has declined your request join their pool. However, you may try to join another pool or initiate your own pool.' . "\n\n";
				$message = $message . 'Thank you,' . "\n\n";
				$message = $message . 'The Purpool Team' . "\n\n";
				mail($email, 'Purpool: Requested Invitation', $message, "From: ".$MISC['admin_email']);

				// Redirect to dashboard
				header("Location: dashboard.php");

				// Disconnect from database
				$dbh->disconnect();
				exit();
			}
		} else {

			// User is already a member of this pool
			// Redirect to dashboard
			header("Location: dashboard.php");

			// Disconnect from database
			$dbh->disconnect();
			exit();

		}

	break;

	# VIEW PROFILE
	case "viewprofile":

		// Get pool name
		$poolname = getPoolName($_GET['pool']);
		$tpl->assign('poolname', $poolname);

		// Assign current side navigation
		$tpl->assign('poolscurrent', true);

		// Assign pool_id
		$tpl->assign('pool_id', $_GET['pool']);

		$_SESSION['displayprofile'] = false;
		$_SESSION['displaypool'] = true;
		$_SESSION['displaykey'] = $_GET['pool'];

		// Check for a confirmation
		if(isset($_GET['confirmation'])){
			if($_GET['confirmation'] == 'inviterequest')
			{
				$tpl->assign('requestinvite', true);
			}
		}
					 

		// Check to see if they are a member of this pool
		$sql = "SELECT user_id FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND status = 'accepted' AND user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		if($row)
		{
			$tpl->assign('membermode', true);
		} else {
			$tpl->assign('membermode', false);
		}

		// Check to see if they have been invited
		$sql = "SELECT user_id FROM poolmembers WHERE status = 'pending' AND user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		if($row)
		{
			$tpl->assign('invitation', true);
		}

		// Get pool organizer
		$sql = "SELECT role FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = {$_SESSION['user_id']}";
		$row = $dbh->queryRow($sql);
		if($row['role'] == 'owner')
		{
			$tpl->assign('editmode', true);
		}

		// Get pool route
		$sql = "SELECT endlatitude, endlongitude, vertices FROM poolroutes WHERE pool_id = '{$_GET['pool']}' LIMIT 1";
		$row = $dbh->queryRow($sql);

		$tpl->assign('endlat', $row['endlatitude']);
		$tpl->assign('endlng', $row['endlongitude']);
		$tpl->assign('vertices', $row['vertices']);


		// Get workplace name
		$sql = "SELECT workplace FROM users WHERE user_id = '{$_SESSION['user_id']}' LIMIT 1";
		$row2 = $dbh->queryRow($sql);
		$sql = "SELECT name FROM workplaces WHERE workplace_id = '{$row2['workplace']}' LIMIT 1";
		$row2 = $dbh->queryRow($sql);
		$tpl->assign('workplace', $row2['name']);

		// If there is no row, use the workplace as the defalt endlatitude and longitude
		if($row['endlatitude'] == '')
		{
			$sql = "SELECT workplace FROM users WHERE user_id = '{$_SESSION['user_id']}' LIMIT 1";
			$row = $dbh->queryRow($sql);

			$sql = "SELECT latitude, longitude, name FROM workplaces WHERE workplace_id = '{$row['workplace']}' LIMIT 1";
			$row = $dbh->queryRow($sql);

			$tpl->assign('endlat', $row['latitude']);
			$tpl->assign('endlng', $row['longitude']);
			$tpl->assign('workplace', $row['name']);
			$tpl->assign('vertices', '["0,0", "0,0"]');
		}

		// Get pool information
		$sql = "SELECT title, access, description, DATE_FORMAT(createdate, '%M %D, %Y') AS createdate FROM pools WHERE pool_id = '{$_GET['pool']}'";
		$row = $dbh->queryRow($sql);
		//$tpl->assign('title', htmlspecialchars($row['title'], ENT_QUOTES));
		$tpl->assign('title', htmlspecialchars($row['title'], ENT_QUOTES));
		$tpl->assign('access', $row['access']);
		$tpl->assign('description', $row['description']);
		$tpl->assign('createdate', $row['createdate']);

		// Is the user allowed to request an invitation
		if($row['access'] == 'public')
		{
			// Check to see if the user is already in the pool
			$sql = "SELECT user_id, status FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = '{$_SESSION['user_id']}'";
			$row = $dbh->queryRow($sql);
			if($row)
			{
				$tpl->assign('allowinvite', false);
			} else {
				// Check to see if they already requested an invite
				$sql = "SELECT user_id FROM poolsrequestinvite WHERE pool_id = '{$_GET['pool']}' AND user_id = '{$_SESSION['user_id']}'";
				$row = $dbh->queryRow($sql);
				if(!$row)
				{
					$tpl->assign('allowinvite', true);
				}
			}
		}

		// Get number of pool members
		$membercount = 0;
		$sql = "SELECT user_id FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND status = 'accepted'";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			// Get member information
			$sql2 = "SELECT username, firstname, lastname, occupation FROM users WHERE user_id = '{$row['user_id']}'";
			$row2 = $dbh->queryRow($sql2);

			$members[] = array(
				'user_id' => $row['user_id'],
				'username' => $row2['username'],
				'firstname' => $row2['firstname'],
				'lastname' => $row2['lastname'],
				'occupation' => $row2['occupation']
			);

			$membercount++;
		}
		$tpl->assign('members', $members);
		$tpl->assign('membercount', $membercount);

		// Get current date
		$currentdate = date("Y") . '-' . date("m") . '-' . date("d");

		// Get the number of rides that the pool has performed
		$sql = "SELECT ride_id FROM poolitineraries WHERE pool_id = '{$_GET['pool']}' AND driver != '' AND rdate < '$currentdate'";
		$result = $dbh->query($sql);
		$numrides = $result->numRows($sql);
		$tpl->assign('numrides', $numrides);

		// Get cummulative pool savings
		$poolsavings = getPoolSavings($_GET['pool']);
		$tpl->assign('poolgas', $poolsavings['gas']);
		$tpl->assign('poolmiles', $poolsavings['miles']);
		$tpl->assign('poolcars', $poolsavings['cars']);
		$tpl->assign('poolemissions', $poolsavings['emissions']);

		// Get cummulative pool savings
		$weekpoolsavings = getPoolSavingsForWeek($_GET['pool']);
		$tpl->assign('weekpoolgas', $weekpoolsavings['gas']);
		$tpl->assign('weekpoolmiles', $weekpoolsavings['miles']);
		$tpl->assign('weekpoolcars', $weekpoolsavings['cars']);
		$tpl->assign('weekpoolemissions', $weekpoolsavings['emissions']);

		// Get pool days
		$sql = "SELECT
					monday,
					tuesday,
					wednesday,
					thursday,
					friday,
					saturday,
					sunday
				FROM
					poolschedules
				WHERE
					pool_id = '{$_GET['pool']}'
				ORDER BY
					savedate DESC LIMIT 1";
		//$result = $dbh->query($sql);
		//$row = $result->fetchRow();
		$row = $dbh->queryRow($sql);

		$days = array();
		$times = array();
		$arrivecolumns = "";
		$departcolumns = "";
		$abbr = array('monday'=>'M', 'tuesday'=>'Tu', 'wednesday'=>'W', 'thursday'=>'Th', 'friday'=>'F', 'saturday'=>'Sa', 'sunday'=>'Su');
		if(!empty($row)){
			foreach($row as $day=>$bool){
				if($bool == 'y') $days[]=$day;
			}
		}

		foreach($days as $day){
			$arrivecolumns.= $day."_aw, ";
			$departcolumns.= $day."_dw, ";
		}
		$arrivecolumns = substr($arrivecolumns, 0, -2);
		$departcolumns = substr($departcolumns, 0, -2);

		$sql = "SELECT ".$arrivecolumns." FROM poolschedules
				WHERE
					pool_id = '{$_GET['pool']}'
				ORDER BY
					savedate DESC LIMIT 1";
		$arrivaltimes = $dbh->queryRow($sql);
		$sql = "SELECT ".$departcolumns." FROM poolschedules
				WHERE
					pool_id = '{$_GET['pool']}'
				ORDER BY
					savedate DESC LIMIT 1";
		$departuretimes = $dbh->queryRow($sql);

		foreach($days as $day){
			$times[] = array(
				'string' => "<tr><td>".$abbr[$day]."</td><td>".date("g:ia", strtotime("today ".$arrivaltimes[$day."_aw"]))." &amp; ".date("g:ia", strtotime("today ".$departuretimes[$day."_dw"]))."</td></tr>"
			);
		}
		$tpl->assign('times', $times);

		// Display template
		$tpl->display('pools-profile.tpl');

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

	# BROWSE POOLS
	case "browsepools":

		// Assign current side navigation
		$tpl->assign('poolscurrent', true);

		// Get workplace of user
		$sql = "SELECT workplace FROM users WHERE user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);

		//Get workplace name, lat and lng for workplace marker
		$sql = "SELECT latitude, longitude, name FROM workplaces WHERE workplace_id = '{$row['workplace']}' LIMIT 1";
		$row2 = $dbh->queryRow($sql);

		$tpl->assign('lat', $row2['latitude']);
		$tpl->assign('lng', $row2['longitude']);
		$tpl->assign('workplace', $row2['name']);


		// Get pool information
		$sql = "SELECT pool_id, title, access, description, createdate FROM pools WHERE workplace_id = '{$row['workplace']}' ORDER BY title";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			// Get number of pool members
			$sql2 = "SELECT id FROM poolmembers WHERE pool_id = '{$row['pool_id']}' AND status = 'accepted'";
			$result2 = $dbh->query($sql2);
			$nummembers = $result2->numRows();

			// Get user_id of pool organizer
			$sql3 = "SELECT user_id FROM poolmembers WHERE pool_id = '{$row['pool_id']}' AND role = 'owner'";
			$row3 = $dbh->queryRow($sql3);

			// Get zipcode of pool leader
			$sql4 = "SELECT zipcode FROM users WHERE user_id = '{$row3['user_id']}'";
			$row4 = $dbh->queryRow($sql4);

			// Get longitude and latitude
			$sql5 = "SELECT latitude, longitude FROM zipcodes WHERE zipcode = '{$row4['zipcode']}'";
			$row5 = $dbh->queryRow($sql5);

			$pools[] = array(
				'pool_id' => $row['pool_id'],
				'title' => htmlentities($row['title']),
				'description' => $row['description'],
				'nummembers' => $nummembers,
				'createdate' => $row['createdate'],
				'zipcode' => $row4['zipcode'],
				'latitude' => $row5['latitude'],
				'longitude' => $row5['longitude']
			);
		}
		$tpl->assign('pools', $pools);

		// Display Template
		$tpl->display('pools-browse.tpl');

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

	# BROWSE SORT
	case "browsesort":

		// Get workplace of user
		$sql = "SELECT workplace FROM users WHERE user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);

		// Get pool information
		if($_GET['pool'])
		{
			$sql = "SELECT pool_id, title, access, description, createdate FROM pools WHERE workplace_id = '{$row['workplace']}' ORDER BY title";
		} else {
			$sql = "SELECT pool_id, title, access, description, createdate FROM pools WHERE workplace_id = '{$row['workplace']}' ORDER BY title";
		}
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			// Get number of pool members
			$sql2 = "SELECT id FROM poolmembers WHERE pool_id = '{$row['pool_id']}' AND status = 'accepted'";
			$result2 = $dbh->query($sql2);
			$nummembers = $result2->numRows();

			// Get user_id of pool organizer
			$sql3 = "SELECT user_id FROM poolmembers WHERE pool_id = '{$row['pool_id']}' AND role = 'owner'";
			$row3 = $dbh->queryRow($sql3);

			// Get zipcode of pool leader
			$sql4 = "SELECT zipcode FROM users WHERE user_id = '{$row3['user_id']}'";
			$row4 = $dbh->queryRow($sql4);

			// Check to see if we should include this pool
			if(($row4['zipcode'] == $_GET['zipcode']) || (!$_GET['zipcode']))
			{

				$pools[] = array(
					'pool_id' => $row['pool_id'],
					'title' => $row['title'],
					'description' => $row['description'],
					'nummembers' => $nummembers,
					'zipcode' => $row4['zipcode'],
					'createdate' => $row['createdate']
				);
			}
		}
		$tpl->assign('pools', $pools);

		// Display Template
		$contents = $tpl->fetch('pools-browsesort.tpl');

		// Build json array
		$json = array(
			"status" => "success",
			"contents" => $contents
		);

		// Out response to browser
		$output = json_encode($json);

		// Output to browser
		echo $output;

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

	# DELETE ENTIRE POOL
	case "deletepool":

		// Check to make sure that the user is allowed to access this page (prevents hacking)
		$sql = "SELECT user_id, role FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		if((!$row) || ($row['role'] != 'owner')) { header("Location: index.php?state=sessionexpired"); exit();  }

		// Assign current side navigation
		$tpl->assign('poolscurrent', true);

		// Assign pool_id
		$tpl->assign('pool_id', $_GET['pool']);

		// Assign formaction
		$formaction = 'pools.php?state=deletepool&pool=' . $_GET['pool'];
		$tpl->assign('formaction', $formaction);

		// Assign warning message
		$tpl->assign('warning', 'pool');

		// If the yes button has been pressed
		if(isset($_POST['yes']))
		{
			// Delete pool from database
			$sql = "DELETE FROM pools WHERE pool_id = '{$_GET['pool']}' LIMIT 1";
			$dbh->query($sql);

			// Delete poolmembers from database
			$sql = "DELETE FROM poolmembers WHERE pool_id = '{$_GET['pool']}'";
			$dbh->query($sql);

			// Delete poolpassengers from database
			$sql = "DELETE FROM poolpassengers WHERE pool_id = '{$_GET['pool']}'";
			$dbh->query($sql);

			// Delete poolschedules from database
			$sql = "DELETE FROM poolschedules WHERE pool_id = '{$_GET['pool']}'";
			$dbh->query($sql);

			// Delete poolitineraries from database
			$sql = "DELETE FROM poolitineraries WHERE pool_id = '{$_GET['pool']}'";
			$dbh->query($sql);

			// Delete poolitineraries from database
			$sql = "DELETE FROM schedule_comments WHERE pool_id = '{$_GET['pool']}'";
			$dbh->query($sql);

			// Delete route from database
			$sql = "DELETE FROM poolroutes WHERE pool_id = '{$_GET['pool']}'";
			$dbh->query($sql);

			// Redirect user
			$redirect = 'pools.php?confirmation=deletepool';
			header("Location: $redirect");

			// Disconnect from database
			$dbh->disconnect();
			exit();
		}

		// If the yes button has been pressed
		if(isset($_POST['no']))
		{
			// Redirect user
			$redirect = 'pools.php';
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

	# DISPLAY SAVING
	case "viewsavings":

		// Display Template
		$tpl->display('pools-savings.tpl');

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

	# SHOUT BOX
	case "shoutbox":

		// Check to make sure that the user is allowed to access this page (prevents hacking)
		$sql = "SELECT user_id FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		if(!$row) { header("Location: index.php?state=sessionexpired"); exit();  }

		// Get pool name
		$poolname = getPoolName($_GET['pool']);
		$tpl->assign('poolname', $poolname);

		// Assign current side navigation
		$tpl->assign('poolscurrent', true);

		// Assign pool_id
		$tpl->assign('pool_id', $_GET['pool']);

		// Get pool organizer
		$sql = "SELECT role FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND user_id = {$_SESSION['user_id']}";
		$row = $dbh->queryRow($sql);
		if($row['role'] == 'owner')
		{
			// Allow editing
			$tpl->assign('editmode', true);
		}

		// Get title of pool
		$sql = "SELECT title FROM pools WHERE pool_id = '{$_GET['pool']}'";
		$row = $dbh->queryRow($sql);
		$tpl->assign('poolname', $row['title']);

		// If the submit button has been pressed
		if(isset($_POST['submit']))
		{
			$error = array();

			// Check for a message
			if(empty($_POST['message']))
			{
				$error['message'] = 'A message is required.';
			} else {
				$_POST['message'] = nl2br($_POST['message']);
				$tpl->assign('message', $_POST['message']);
			}

			// If there are no error, insert shout
			// Otherwise, display errors
			if(sizeof($error) == 0)
			{
				// Insert shout
				$sql = "INSERT INTO poolshouts (shout_id, user_id, pool_id, message, shoutdate) VALUES (null, '{$_SESSION['user_id']}', '{$_GET['pool']}', '{$_POST['message']}', NOW())";
				$dbh->query($sql);

				// Send e-mail messages if checkbox is selected
				if($_POST['email'] == 'y')
				{
					// Get pool name
					$sql = "SELECT title FROM pools WHERE pool_id = '{$_GET['pool']}'";
					$row = $dbh->queryRow($sql);
					$poolname = $row['title'];

					// Get sender email address
					$sql = "SELECT email FROM users WHERE user_id = '{$_SESSION['user_id']}'";
					$row = $dbh->queryRow($sql);
					$fromemail = $row['email'];

					// Get all pool members
					$sql = "SELECT user_id FROM poolmembers WHERE pool_id = '{$_GET['pool']}' AND status = 'accepted'";
					$result = $dbh->query($sql);
					while($row = $result->fetchRow())
					{
						// Get pool email address
						$sql2 = "SELECT email FROM users WHERE user_id = '{$row['user_id']}'";
						$row2 = $dbh->queryRow($sql2);

						// E-mail shout to member
						$subject = $poolname . ' : Shoutbox Message';
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$link = '<br /><br /><a href="http://purpool.com/pools.php?state=shoutbox&pool='.$_GET['pool'].'">Go to '.$poolname.' Shoutbox on Purpool</a>';
						mail($row2['email'], $subject, stripslashes($_POST['message']).$link, $headers."From: $fromemail");
					}
				}

				// Log action
				Utils::logAction($_SESSION['username'], 'Sent Shoutbox Message', '');

				// Redirect user
				$redirect = 'pools.php?state=shoutbox&pool=' . $_GET['pool'] . '&confirmation=shout';
				header("Location: $redirect");

				// Disconnect from database
				$dbh->disconnect();
				exit();

			} else {

				// Display errors
				$tpl->assign('error', $error);

			}
		}

		// Get shouts
		$sql = "SELECT shout_id, user_id, message, DATE_FORMAT(shoutdate, '%M %d, %Y') AS date FROM poolshouts WHERE pool_id = '{$_GET['pool']}' ORDER BY shoutdate DESC";
		$result = $dbh->query($sql);
		$shouts=array();
		while($row = $result->fetchRow())
		{
			// Get name of shouter
			$sql2 = "SELECT user_id, firstname, lastname FROM users WHERE user_id = '{$row['user_id']}'";
			$row2 = $dbh->queryRow($sql2);

			$shouts[] = array(
				'user_id' => $row2['user_id'],
				'name' => $row2['firstname'] . ' ' . $row2['lastname'],
				'message' => $row['message'],
				'shoutdate' => $row['date']
			);
		}
		$tpl->assign('shouts', $shouts);

		// Display template
		$tpl->display('pools-shoutbox.tpl');

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

	# DISPLAY POOLS
	default:

		// Assign current side navigation
		$tpl->assign('poolscurrent', true);

		// Define current week and year (for rides)
		$week = date('W');
		$year = date('Y');

		// Calculate full dates
		$fulldates[1] = date("Y-m-d", strtotime("{$year}-W{$week}-1"));
		$fulldates[2] = date("Y-m-d", strtotime("{$year}-W{$week}-2"));
		$fulldates[3] = date("Y-m-d", strtotime("{$year}-W{$week}-3"));
		$fulldates[4] = date("Y-m-d", strtotime("{$year}-W{$week}-4"));
		$fulldates[5] = date("Y-m-d", strtotime("{$year}-W{$week}-5"));
		$fulldates[6] = date("Y-m-d", strtotime("{$year}-W{$week}-6"));
    	$fulldates[7] = date("Y-m-d", strtotime("{$year}-W{$week}-7"));

		// Create weekdates array
		$weekdates = array(
						'monday' => $fulldates[1],
						'tuesday' => $fulldates[2],
						'wednesday' => $fulldates[3],
						'thursday' => $fulldates[4],
						'friday' => $fulldates[5],
						'saturday' => $fulldates[6],
						'sunday' => $fulldates[7]
					);

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
			// Clear members and shouts array
			$members = null;
			$shouts = null;
			$rides = null;

			// Get pool members
			$sql2 = "SELECT user_id FROM poolmembers WHERE pool_id = '{$row['pool_id']}' AND status = 'accepted'";
			$result2 = $dbh->query($sql2);
			while($row2 = $result2->fetchRow())
			{
				// Get pool member names
				$sql3 = "SELECT user_id, firstname, lastname FROM users WHERE user_id = '{$row2['user_id']}' ORDER BY lastname";
				$row3 = $dbh->queryRow($sql3);

				$members[] = array(
					'user_id' => $row3['user_id'],
					'firstname' => $row3['firstname'],
					'lastname' => $row3['lastname'],
				);
			}

			// Cycle through dates and get ride specifics
			foreach($weekdates AS $day => $date)
			{
				// Get day specifics
				$sql6 = "SELECT
							DATE_FORMAT(rdate, '%M %d, %Y') AS ridedate
						FROM
							poolitineraries
						WHERE pool_id = '{$row['pool_id']}' AND rdate = '$date' AND route != '' AND driver != ''";
				$row6 = $dbh->queryRow($sql6);

				// Create rides array
				if($row6)
				{
					// Check to see if the user has confirmed
					$sql7 = "SELECT confirm FROM poolpassengers WHERE pool_id = '{$row['pool_id']}' AND rdate = '$date' AND user_id = '{$_SESSION['user_id']}'";
					$row7 = $dbh->queryRow($sql7);

					$rides[] = array(
						'pool_id' => $row['pool_id'],
						'ridedate' => $row6['ridedate'],
						'rdate' => $date,
						'confirm' => $row7['confirm']
					);
				}
			}

			// Get shouts
			$sql3 = "SELECT shout_id, user_id, message, DATE_FORMAT(shoutdate, '%M %d, %Y') AS date FROM poolshouts WHERE pool_id = '{$row['pool_id']}' ORDER BY shoutdate DESC LIMIT 2";
			$result3 = $dbh->query($sql3);
			while($row3 = $result3->fetchRow())
			{
				// Get name of shouter
				$sql4 = "SELECT user_id, firstname, lastname FROM users WHERE user_id = '{$row3['user_id']}'";
				$row4 = $dbh->queryRow($sql4);

				$shouts[] = array(
					'user_id' => $row4['user_id'],
					'name' => $row4['firstname'] . ' ' . $row4['lastname'],
					'message' => $row3['message'],
					'shoutdate' => $row3['date']
				);
			}

			$pools[] = array(
				'pool_id' => $row['pool_id'],
				'title' => $row['title'],
				'members' => $members,
				'shouts' => $shouts,
				'rides' => $rides
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
