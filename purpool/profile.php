<?php

#################################################################
# Name: profile.php   	                                        #
# Author: John Kuiphoff                                         #
# Description: Allows users to update their user profile        #
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

// Check for workplace admin
if($_SESSION['isworkplaceadmin'] == 1) { 
	$tpl->assign('adminmode', 1);
	$tpl->assign('hidetopnav', true);
}

$tpl->assign('google_key', $MISC['google_key']);

// Switch state
switch($_GET['state'])
{

	# GET MAKE
	case "getmake":

		$sql = "SELECT DISTINCT make FROM car_data WHERE year='{$_GET['year']}' ORDER BY make";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			$makes[] = $row['make'];
		}

		// Assign template variables
		$tpl->assign('getmake', true);
		$tpl->assign('makes', $makes);

		// Get HTML contents
		$contents = $tpl->fetch('cardata.tpl');

		// Build JSON array
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

	# GET MODEL
	case "getmodel":

		$sql = "SELECT DISTINCT
						model
					FROM
						car_data
					WHERE
						year='{$_GET['year']}'
					AND
						make='{$_GET['make']}'
					ORDER BY
						model";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			$models[] = $row['model'];
		}

		// Assign template variables
		$tpl->assign('getmodel', true);
		$tpl->assign('models', $models);

		// Get HTML contents
		$contents = $tpl->fetch('cardata.tpl');

		// Build JSON array
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

	# GET TRANSMISSION
	case "gettrans":

		$sql = "SELECT DISTINCT
						trans
					FROM
						car_data
					WHERE
						year='{$_GET['year']}'
					AND
						make='{$_GET['make']}'
					AND
						model='{$_GET['model']}'
					ORDER BY
						trans";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			$trans[] = $row['trans'];
		}

		// Assign template variables
		$tpl->assign('gettrans', true);
		$tpl->assign('trans', $trans);

		// Get HTML contents
		$contents = $tpl->fetch('cardata.tpl');

		// Build JSON array
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

	# GET CYLINDERS
	case "getcylinders":

		$sql = "SELECT DISTINCT
							cylinders
						FROM
							car_data
						WHERE
							year='{$_GET['year']}'
						AND
							make='{$_GET['make']}'
						AND
							model='{$_GET['model']}'
						AND
							trans='{$_GET['trans']}'
						ORDER BY
							trans";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			$cylinders[] = $row['cylinders'];
		}

		// Assign template variables
		$tpl->assign('getcylinders', true);
		$tpl->assign('cylinders', $cylinders);

		// Get HTML contents
		$contents = $tpl->fetch('cardata.tpl');

		// Build JSON array
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

	# GET MPG
	case "getmpg":

		$sql = "SELECT DISTINCT
						cmbMpg08,
						c0208
					FROM
						car_data
					WHERE
						year='{$_GET['year']}'
					AND
						make='{$_GET['make']}'
					AND
						model='{$_GET['model']}'
					AND
						trans='{$_GET['trans']}'
					AND
						cylinders = '{$_GET['cylinders']}'
					ORDER BY
						trans";
		$row = $dbh->queryRow($sql);

		// Build JSON array
		$json = array(
			"status" => "success",
			"mpg" => $row['cmbmpg08'],
			"emissions" => $row['c0208']
		);

		// Out response to browser
		$output = json_encode($json);

		// Output to browser
		echo $output;

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

	# Update car information
	case "editvehicle":

		// Check to make sure that the user is allowed to access this page (prevents hacking)
		$sql = "SELECT user_id FROM users WHERE user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		if(!$row) { header("Location: index.php?state=sessionexpired"); exit();  }

		// If user owns a vehicle
		if($_POST['ownvehicle'] == 'y')
		{

			// Create error array
			$error = array();

			// Check for a color
			if(empty($_POST['color']))
			{
				$error['color'] = 'A color is required';
			}

			// Check for a year
			if(empty($_POST['year']))
			{
				$error['year'] = 'A year is required';
			}

			// Check for a make
			if(empty($_POST['make']))
			{
				$error['make'] = 'A make is required';
			}

			// Check for a model
			if(empty($_POST['model']))
			{
				$error['model'] = 'A model is required';
			}

			// Check for a transmission type
			if(empty($_POST['trans']))
			{
				$error['trans'] = 'A transmission type is required';
			}

			// Check for number of cylinders
			if(empty($_POST['cylinders']))
			{
				$error['cylinders'] = 'The number of cylinders is required';
			}

			// Check for mpg
			if(empty($_POST['mpg']))
			{
				$error['mpg'] = 'The miles per gallon can not be found';
			}

			// Check for emissions
			if(empty($_POST['emissions']))
			{
				$error['emissions'] = 'The carbon emissions can not be found';
			}

			// If there are no errors, update vehicle.
			// Otherwise, display errors.
			if(sizeof($error) == 0)
			{
				// Update car information
				$sql = "UPDATE
								users
							SET
								ownvehicle		 = 'y',
								vehicleseats     = '{$_POST['seats']}',
								vehiclecolor     = '{$_POST['color']}',
								vehicleyear      = '{$_POST['year']}',
								vehiclemake      = '{$_POST['make']}',
								vehiclemodel     = '{$_POST['model']}',
								vehicletrans     = '{$_POST['trans']}',
								vehiclecylinders = '{$_POST['cylinders']}',
								vehiclempg       = '{$_POST['mpg']}',
								vehicleco2       = '{$_POST['emissions']}'
							WHERE
								user_id = '{$_SESSION['user_id']}'";
				$dbh->query($sql);

				// Build JSON array
				$json = array(
					"status" => "success",
					"contents" => $contents
				);

			} else {

				// Build JSON array
				$json = array(
					"status" => "failure",
					"error" => $error
				);

			}

		} else {

			// Update car information
			$sql = "UPDATE
							users
						SET
							ownvehicle		 = 'n',
							vehicleseats     = '',
							vehiclecolor     = '',
							vehicleyear      = '',
							vehiclemake      = '',
							vehiclemodel     = '',
							vehicletrans     = '',
							vehiclecylinders = '',
							vehiclempg       = '',
							vehicleco2       = ''
						WHERE
							user_id = '{$_SESSION['user_id']}'";
			$dbh->query($sql);

			// User does not own a vehicle
			$json = array(
				"status" => "success"
			);
		}

		// Out response to browser
		$output = json_encode($json);

		// Output to browser
		echo $output;

	break;

	# Car Information (step two of three)
	case "updatevehicle":

		// Check to make sure that the user is allowed to access this page (prevents hacking)
		$sql = "SELECT user_id FROM users WHERE user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		if(!$row) { header("Location: index.php?state=sessionexpired"); exit();  }

		// Check for confirmation
		if($_GET['confirmation'])
		{
			$tpl->assign('confirmation', 'Your vehicle has been updated');
		}

		// Get current car information
		$sql = "SELECT ownvehicle, vehicleseats, vehiclecolor, vehicleyear, vehiclemake, vehiclemodel, vehicletrans, vehiclecylinders, vehiclempg, vehicleco2 FROM users WHERE user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);

		// Assign values to template
		$tpl->assign('ownvehicle', $row['ownvehicle']);
		$tpl->assign('seats', $row['vehicleseats']);
		$tpl->assign('color', $row['vehiclecolor']);
		$tpl->assign('year', $row['vehicleyear']);
		$tpl->assign('currentmake', $row['vehiclemake']);
		$tpl->assign('currentmodel', $row['vehiclemodel']);
		$tpl->assign('currenttrans', $row['vehicletrans']);
		$tpl->assign('currentcylinders', $row['vehiclecylinders']);
		$tpl->assign('mpg', $row['vehiclempg']);
		$tpl->assign('emissions', $row['vehicleco2']);

		// Populate Make Dropdown
		$sql = "SELECT DISTINCT make FROM car_data WHERE year='{$row['vehicleyear']}' ORDER BY make";
		$result = $dbh->query($sql);
		while($row2 = $result->fetchRow())
		{
			$makes[] = $row2['make'];
		}
		$tpl->assign('makes', $makes);

		// Populate model dropdown
		$sql = "SELECT DISTINCT
						model
					FROM
						car_data
					WHERE
						year='{$row['vehicleyear']}'
					AND
						make='{$row['vehiclemake']}'
					ORDER BY
						model";
		$result = $dbh->query($sql);
		while($row2 = $result->fetchRow())
		{
			$models[] = $row2['model'];
		}
		$tpl->assign('models', $models);

		// Populate trans dropdown
		$sql = "SELECT DISTINCT
						trans
					FROM
						car_data
					WHERE
						year='{$row['vehicleyear']}'
					AND
						make='{$row['vehiclemake']}'
					AND
						model='{$row['vehiclemodel']}'
					ORDER BY
						trans";
		$result = $dbh->query($sql);
		while($row2 = $result->fetchRow())
		{
			$trans[] = $row2['trans'];
		}
		$tpl->assign('trans', $trans);

		// Populate cylinders dropdown
		$sql = "SELECT DISTINCT
							cylinders
						FROM
							car_data
						WHERE
							year='{$row['vehicleyear']}'
						AND
							make='{$row['vehiclemake']}'
						AND
							model='{$row['vehiclemodel']}'
						AND
							trans='{$row['vehicletrans']}'
						ORDER BY
							trans";
		$result = $dbh->query($sql);
		while($row2 = $result->fetchRow())
		{
			$cylinders[] = $row2['cylinders'];
		}
		$tpl->assign('cylinders', $cylinders);

		// Display Template
		$tpl->display('profile-editvehicle.tpl');

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

	# EDIT PASSWORD
	case "editpassword":

		// Check to make sure that the user is allowed to access this page (prevents hacking)
		$sql = "SELECT user_id FROM users WHERE user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		if(!$row) { header("Location: index.php?state=sessionexpired"); exit();  }

		// Check for confirmation
		if($_GET['confirmation'])
		{
			$tpl->assign('confirmation', 'Your password has been updated');
		}

		// If the submit button has been pressed
		if(isset($_POST['submit']))
		{
			// Create an error array
			$error = array();

			// Check for a password (1)
			if(empty($_POST['userpass1']))
			{
				$error['userpass1'] = 'A password is required';
			}

			// Check for a password (2)
			if(empty($_POST['userpass2']))
			{
				$error['userpass2'] = 'A password is required';
			}

			// Check to make sure that both passwords match
			if(($_POST['userpass1'] != $_POST['userpass2']) && (sizeof($error) == 0))
			{
				$error['userpass1'] = 'Passwords must match. Please try again.';
			}

			// If there are no errors, update password
			// Otherwise, display errors
			if(sizeof($error) == 0)
			{
				// Update password
				$userpass = $_POST['userpass1'];
				$sql = "UPDATE users SET userpass = SHA('$userpass') WHERE user_id = '{$_SESSION['user_id']}'";
				$dbh->query($sql);

				// Log action
				Utils::logAction($_SESSION['username'], 'Updated Password', '');

				// Redirect user
				header("Location: profile.php?state=editpassword&confirmation=1");

				// Disconnect from database
				$dbh->disconnect();
				exit();

			} else {

				// Assign errors
				$tpl->assign('error', $error);

			}
		}

		// Display Template
		$tpl->display('profile-editpassword.tpl');

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

	# Interests
	case "editinterests":

		// Check to make sure that the user is allowed to access this page (prevents hacking)
		$sql = "SELECT user_id FROM users WHERE user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		if(!$row) { header("Location: index.php?state=sessionexpired"); exit();  }

		// Check for confirmation
		if($_GET['confirmation'])
		{
			$tpl->assign('confirmation', 'Your profile has been updated');
		}

		// If the submit button has been pressed, final registration
		if(isset($_POST['submit']))
		{
			// Get interests
			$music = '';
			for ($i=0; $i<count($_POST['music']); $i++)
			{
				$musictypes .= $_POST['music'][$i] . '|';
			}

			// Update users table
			$sql = "UPDATE users SET music = '$musictypes', interests = '{$_POST['interests']}', registercomplete = '1' WHERE user_id = '{$_SESSION['user_id']}'";
			$dbh->query($sql);

			// Log action
			Utils::logAction($_SESSION['username'], 'Updated Profile', 'Interests');

			// Redirect user
			header("Location: profile.php?state=editinterests&confirmation=1");

			// Disconnect from database
			$dbh->disconnect();
			exit();

		} else {

			// Get user interests
			$sql = "SELECT music, interests FROM users WHERE user_id = '{$_SESSION['user_id']}'";
			$row = $dbh->queryRow($sql);

			// Clean music types
			$music = explode('|', $row['music']);
			for($i = 0; $i < sizeof($music); $i++)
			{
				$tpl->assign($music[$i], 'y');
			}
			$tpl->assign('interests', $row['interests']);
		}

		// Display Template
		$tpl->display('profile-editinterests.tpl');

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

	# GENERAL INFORMATION
	case "editgeneral":

		// Check to make sure that the user is allowed to access this page (prevents hacking)
		$sql = "SELECT user_id FROM users WHERE user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		if(!$row) { header("Location: index.php?state=sessionexpired"); exit();  }

		// Check for confirmation
		if($_GET['confirmation'])
		{
			$tpl->assign('confirmation', 'Your profile has been updated');
		}

		// Get workplaces
		$sql = "SELECT workplace_id, name, suffix FROM workplaces ORDER BY name";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			$workplaces[] = array(
				'workplace_id' => $row['workplace_id'],
				'name' => $row['name'],
				'suffix' => $row['suffix']
			);
		}
		$tpl->assign('workplaces', $workplaces);

		// If the submit button has been pressed
		if(isset($_POST['submit']))
		{
			// Create error array
			$error = array();

			// Check for a firstname
			if(empty($_POST['firstname']))
			{
				$error['firstname'] = 'A first name is required.';
			} else {
				$tpl->assign('firstname', $_POST['firstname']);
			}

			// Check for a lastname
			if(empty($_POST['lastname']))
			{
				$error['lastname'] = 'A last name is required.';
			} else {
				$tpl->assign('lastname', $_POST['lastname']);
			}

			// Assign gender
			$tpl->assign('gender', $_POST['gender']);

			// Check for a zipcode
			if((!is_numeric($_POST['zipcode'])) || (strlen($_POST['zipcode']) != 5))
			{
				$error['zipcode'] = 'A valid zipcode is required.';
			}
			$tpl->assign('zipcode', $_POST['zipcode']);

			// Assign schedule
			$tpl->assign('schedule', $_POST['schedule']);

			// Check for an e-mail address
			if(empty($_POST['email']))
			{
				$error['email'] = 'An e-mail address is required.';
			} else {
				$tpl->assign('email', $_POST['email']);
			}

			// Check for a phone number
			if($_POST['cellphone1'] && $_POST['cellphone2'] && $_POST['cellphone3'])
			{
				$cellphone = $_POST['cellphone1'] . '-' . $_POST['cellphone2'] . '-' . $_POST['cellphone3'];
				$tpl->assign('cellphone1', $_POST['cellphone1']);
				$tpl->assign('cellphone2', $_POST['cellphone2']);
				$tpl->assign('cellphone3', $_POST['cellphone3']);
			}

			// Check for a work number
			if(!empty($_POST['workphone1']) && !empty($_POST['workphone2']) && !empty($_POST['workphone3']) || !empty($_POST['workphone4']))
			{
				if(empty($_POST['workphone4']))
				{
					$workphone = $_POST['workphone1'] . '-' . $_POST['workphone2'] . '-' . $_POST['workphone3'];
				} else {
					$workphone = $_POST['workphone1'] . '-' . $_POST['workphone2'] . '-' . $_POST['workphone3'] . ' Ext:' . $_POST['workphone4'];
				}
				$tpl->assign('workphone1', $_POST['workphone1']);
				$tpl->assign('workphone2', $_POST['workphone2']);
				$tpl->assign('workphone3', $_POST['workphone3']);
				$tpl->assign('workphone4', $_POST['workphone4']);
			}

			// Check for a workplace
			if(empty($_POST['workplace']))
			{
				$error['workplace'] = 'A workplace is required.';
			} else {
				$tpl->assign('workplace', $_POST['workplace']);
			}

			// Assign occupation
			$tpl->assign('occupation', $_POST['occupation']);

			// Check for image errors
			if($_FILES['file']['name'])
			{
				
				// Check to see if image is a JPEG
				if(($_FILES['file']['type'] != 'image/jpg') && ($_FILES['file']['type'] != 'image/jpeg') && ($_FILES['file']['type'] != 'image/pjpeg'))
				{
					$error['photo'] = 'Invalid image format';
				}

				if($_FILES['file']['error'])
				{
					switch($_FILES['file']['error'])
					{
						case 1:
							$error['photo'] = 'Image is too large';
						break;

						case 2:
							$error['photo'] = 'Image is too large';
						break;

						case 3:
							$error['photo'] = 'This file could not be uploaded';
						break;

						case 4:
							$error['photo'] = 'This file could not be uploaded';
						break;
					}
				}
			}

			// If there are no errors, update user info
			// Otherwise, display errors
			if(sizeof($error) == 0)
			{
				// Update user information
				$sql = "UPDATE users SET
							firstname = '{$_POST['firstname']}',
							lastname = '{$_POST['lastname']}',
							gender = '{$_POST['gender']}',
							email = '{$_POST['email']}',
							cellphone = '$cellphone',
							workphone = '$workphone',
							workplace = '{$_POST['workplace']}',
							zipcode = '{$_POST['zipcode']}',
							schedule = '{$_POST['schedule']}',
							occupation = '{$_POST['occupation']}'
						WHERE
							user_id = '{$_SESSION['user_id']}'";
				$dbh->query($sql);

				// Get user_id of new user (used in session)
				$sql = "SELECT user_id FROM users WHERE username = '$username'";
				$row = $dbh->queryRow($sql);
				$user_id = $row['user_id'];

				// Upload user photo
				if($_FILES['file']['name'])
				{
					$photo  = Utils::resizeImage($_FILES['file']['tmp_name'], $_SESSION['user_id'], $DIR['users'], 'small');
					$photo2 = Utils::resizeImage($_FILES['file']['tmp_name'], $_SESSION['user_id'], $DIR['users'], 'medium');
					$photo3 = Utils::resizeImage($_FILES['file']['tmp_name'], $_SESSION['user_id'], $DIR['users'], 'large');
				}

				// Log action
				Utils::logAction($_POST['username'], 'Updated Profile', 'General');

				// Redirect user
				header("Location: profile.php?state=editgeneral&confirmation=1");

				// Disconnect from database
				$dbh->disconnect();
				exit();

			} else {

				// Assign errors to template
				$tpl->assign('error', $error);

				// Display Template
				$tpl->display('profile-editgeneral.tpl');

				// Disconnect from database
				$dbh->disconnect();
				exit();

			}

		} else {

			// Assign pagetitle
			$tpl->assign('pagetitle', 'Profile');

			// Get user profile
			$sql = "SELECT
						username,
						firstname,
						lastname,
						gender,
						email,
						cellphone,
						workphone,
						workplace,
						zipcode,
						schedule,
						occupation
					FROM
						users
					WHERE
						user_id = '{$_SESSION['user_id']}'";
			$row = $dbh->queryRow($sql);

			// Clean cellphone
			$cellphone = explode('-', $row['cellphone']);

			// Clean workphone
			$workphone = explode('-', $row['workphone']);
			$workphoneext = explode(' Ext:', $workphone[2]);

			// Assign profile values to template
			$tpl->assign('username', $row['username']);
			$tpl->assign('firstname', $row['firstname']);
			$tpl->assign('lastname', $row['lastname']);
			$tpl->assign('gender', $row['gender']);
			$tpl->assign('email', $row['email']);
			$tpl->assign('cellphone1', $cellphone[0]);
			$tpl->assign('cellphone2', $cellphone[1]);
			$tpl->assign('cellphone3', $cellphone[2]);
			$tpl->assign('workphone1', $workphone[0]);
			$tpl->assign('workphone2', $workphone[1]);
			$tpl->assign('workphone3', $workphone[2]);
			$tpl->assign('workphone4', $workphoneext[1]);
			$tpl->assign('workplace', $row['workplace']);
			$tpl->assign('zipcode', $row['zipcode']);
			$tpl->assign('schedule', $row['schedule']);
			$tpl->assign('occupation', $row['occupation']);

			// Display Template
			$tpl->display('profile-editgeneral.tpl');

			// Disconnect from database
			$dbh->disconnect();
			exit();

		}

	break;

	# DISPLAY USER PROFILE
		case "viewprofile":

			// Assign current side navigation
			$tpl->assign('profilecurrent', true);

			// Is this the user's profile, or a profile of another user?
			if($_GET['user'] == $_SESSION['user_id'])
			{
				$user_id = $_SESSION['user_id'];
				$tpl->assign('editmode', true);
			} elseif($_GET['user']) {
				$user_id = $_GET['user'];
				$tpl->assign('editmode', false);
			} else {
				$user_id = $_SESSION['user_id'];
				$tpl->assign('editmode', true);
			}
			$_SESSION['displayprofile'] = true;
			$_SESSION['displaypool'] = false;
			$_SESSION['displaykey'] = $user_id;

			$tpl->assign('user_id', $user_id);

			// Check for a user photo
			$userPhoto = $DIR['users'] . $user_id . '_medium.jpg';
			if(file_exists($userPhoto))
			{
				$tpl->assign('userphoto', $user_id . '_medium.jpg');
				$tpl->assign('userphotolarge', $user_id . '_large.jpg');
			}

			// Get user profile
			$sql = "SELECT
						firstname,
						lastname,
						gender,
						email,
						cellphone,
						workphone,
						workplace,
						zipcode,
						schedule,
						occupation,
						ownvehicle,
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
						user_id = '$user_id'";
			$row = $dbh->queryRow($sql);

			// Get pools that user belongs to
			$sql2 = "SELECT pool_id FROM poolmembers WHERE user_id = '$user_id'";
			$result2 = $dbh->query($sql2);
			while($row2 = $result2->fetchRow())
			{
				// Get pool title
				$sql3 = "SELECT title FROM pools WHERE pool_id = '{$row2['pool_id']}'";
				$row3 = $dbh->queryRow($sql3);

				// Create pools array
				$pools[] = array(
					'pool_id' => $row2['pool_id'],
					'title' => $row3['title']
				);
			}
			$tpl->assign('pools', $pools);

			// Get total user savings
			$usersavings = getUserSavings($user_id);

			$tpl->assign('usergas', $usersavings['gas']);
			$tpl->assign('usermiles', $usersavings['miles']);
			$tpl->assign('usercars', $usersavings['cars']);
			$tpl->assign('useremissions', $usersavings['emissions']);

			// Get user savings for this week
			$weekusersavings = getUserSavingsForWeek($user_id);

			$tpl->assign('weekusergas', $weekusersavings['gas']);
			$tpl->assign('weekusermiles', $weekusersavings['miles']);
			$tpl->assign('weekusercars', $weekusersavings['cars']);
			$tpl->assign('weekuseremissions', $weekusersavings['emissions']);

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
			$tpl->assign('zipcode', $row['zipcode']);
			$tpl->assign('schedule', $row['schedule']);
			$tpl->assign('occupation', $row['occupation']);
			$tpl->assign('ownvehicle', $row['ownvehicle']);
			$tpl->assign('seats', $row['vehicleseats']);
			$tpl->assign('color', $row['vehiclecolor']);
			$tpl->assign('year', $row['vehicleyear']);
			$tpl->assign('make', $row['vehiclemake']);
			$tpl->assign('model', $row['vehiclemodel']);
			$tpl->assign('music', $cleanmusic);
			$tpl->assign('interests', $row['interests']);

			// Get workplace
			$sql = "SELECT workplace_id, name, address, city, state, zip FROM workplaces WHERE workplace_id = '{$row['workplace']}'";
			$row = $dbh->queryRow($sql);
			$tpl->assign('workplace_id', $row['workplace_id']);
			$tpl->assign('workplacename', $row['name']);
			$tpl->assign('workplaceaddress', $row['address']);
			$tpl->assign('workplacecity', $row['city']);
			$tpl->assign('workplacestate', $row['state']);
			$tpl->assign('workplacezip', $row['zip']);

			// Display Template
			$tpl->display('profile-userprofile.tpl');

			// Disconnect from database
			$dbh->disconnect();
			exit();

	break;











	# BROWSE SORT
	case "browsesort":

		// Get workplace of user
		$sql = "SELECT workplace FROM users WHERE user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);

		// Get all members
		if($_GET['zipcode'])
		{
			$sql = "SELECT
						a.user_id AS user_id,
						a.firstname AS firstname,
						a.lastname AS lastname,
						a.workplace AS workplace,
						a.zipcode AS zipcode,
						b.name AS name
					FROM
						users a, workplaces b
					WHERE
						a.registercomplete = '1' AND a.hasloggedin = '1' AND a.workplace = b.workplace_id AND a.workplace = '{$row['workplace']}' AND zipcode = '{$_GET['zipcode']}'
					ORDER BY
						lastname";
		} else {
			$sql = "SELECT
						a.user_id AS user_id,
						a.firstname AS firstname,
						a.lastname AS lastname,
						a.workplace AS workplace,
						a.zipcode AS zipcode,
						b.name AS name
					FROM
						users a, workplaces b
					WHERE
						a.registercomplete = '1' AND a.hasloggedin = '1' AND a.workplace = b.workplace_id AND a.workplace = '{$row['workplace']}'
					ORDER BY
						lastname";

		}
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			// Get longitude and latitude for each user
			$sql2 = "SELECT latitude, longitude FROM zipcodes WHERE zipcode = '{$row['zipcode']}'";
			$row2 = $dbh->queryRow($sql2);

			$members[] = array(
				'user_id' => $row['user_id'],
				'firstname' => $row['firstname'],
				'lastname' => $row['lastname'],
				'workplace' => $row['name'],
				'zipcode' => $row['zipcode'],
				'latitude' => $row2['latitude'],
				'longitude' => $row2['longitude']
			);
		}
		$tpl->assign('members', $members);

		// Display Template
		$contents = $tpl->fetch('profile-browsesort.tpl');

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


	# BROWSE PROFILES
		default:

			// Assign current side navigation
			$tpl->assign('profilecurrent', true);

			// Get workplace of user
			$sql = "SELECT workplace FROM users WHERE user_id = '{$_SESSION['user_id']}'";
			$row = $dbh->queryRow($sql);


			//Get workplace name, lat and lng for workplace marker
			$sql = "SELECT latitude, longitude, name FROM workplaces WHERE workplace_id = '{$row['workplace']}' LIMIT 1";
			$row2 = $dbh->queryRow($sql);

			$tpl->assign('lat', $row2['latitude']);
			$tpl->assign('lng', $row2['longitude']);
			$tpl->assign('workplace', $row2['name']);

			// Check for a default zipcode (clicked via user profile)
			if($_GET['zipcode'])
			{
				$tpl->assign('defaultzip', $_GET['zipcode']);
			}

			// Get sortby information
			switch($_GET['sortby'])
			{
				case "member":
					$sortby = 'a.lastname';
				break;
				case "workplace":
					$sortby = 'b.name ASC';
				break;
				case "zipcode":
					$sortby = 'a.zipcode ASC';
				break;
				case "alphabet":
					$sortby = 'a.lastname';
					$filter = ' AND a.lastname LIKE \'' . $_GET['letter'] . '%\'';
				break;
				default:
					$sortby = 'a.lastname';
				break;
			}

			// Get all members
			$sql = "SELECT
						a.user_id AS user_id,
						a.firstname AS firstname,
						a.lastname AS lastname,
						a.workplace AS workplace,
						a.zipcode AS zipcode,
						b.name AS name
					FROM
						users a, workplaces b
					WHERE
						a.registercomplete = '1' AND a.hasloggedin = '1' AND a.workplace = b.workplace_id AND a.workplace = '{$row['workplace']}' {$filter}
					ORDER BY
						{$sortby}";
			$result = $dbh->query($sql);
			$counter = 1;
			while($row = $result->fetchRow())
			{
				// Get longitude and latitude for each user
				$sql2 = "SELECT latitude, longitude FROM zipcodes WHERE zipcode = '{$row['zipcode']}'";
				$row2 = $dbh->queryRow($sql2);

				$members[] = array(
					'user_id' => $row['user_id'],
					'firstname' => $row['firstname'],
					'lastname' => $row['lastname'],
					'workplace' => $row['name'],
					'zipcode' => $row['zipcode'],
					'latitude' => $row2['latitude'],
					'longitude' => $row2['longitude'],
					'counter' => $counter
				);
				$counter++;
			}
			$tpl->assign('members', $members);

			// Display Template
			$tpl->display('profile-browse.tpl');

			// Disconnect from database
			$dbh->disconnect();
			exit();

	break;



}




?>
