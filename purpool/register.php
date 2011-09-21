<?php

#################################################################
# Name: register.php                                            #
# Author: John Kuiphoff                                         #
# Description: Allows users to register for purpool             #
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
	case "updatevehicle":

		// Continue session
		session_start();

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
				$error['emissions'] = 'The carbon emssions can not be found';
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
							vehiclempg       = '25',
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
	case "vehicle":

		// Continue session
		session_start();

		// Assign pagetitle
		$tpl->assign('pagetitle', 'Register');

		// Assign default 'own vehicle' setting
		$tpl->assign('ownvehicle', 'y');

		// Display Template
		$tpl->display('register-car.tpl');

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

	# Interests
	case "interests":

		// Continue session
		session_start();

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
			$sql = "UPDATE users SET music = '$musictypes', interests = '{$_POST['interests']}', registercomplete = '1', hasloggedin = '0' WHERE user_id = '{$_SESSION['user_id']}'";
			$dbh->query($sql);

			// Compose message
			$message = 'Dear ' . $_SESSION['fullname'] . ', ' . "\n\n";
			$message = $message . 'Thank you for registering with Purpool. Carpooling is a fun way to save money, help the environment and get to know other people in your workplace. We think Purpool is a great tool for helping people organize their carpools and hope you do too! Your temporary password is given below along with your workplace email address. Please login to Purpool at '.$MISC['site_url'].'. You can change your password at any time by visiting your profile page.' . "\n\n";

			$message = $message . 'Your workplace email address is: ' . $_SESSION['email'] . "\n";
			$message = $message . 'Your password is: ' . $_SESSION['userpass'] . "\n\n";

			$message = $message . 'Happy Carpooling,' . "\n\n";
			$message = $message . 'The Purpool Team';


			// E-mail user
			mail($_SESSION['email'], 'Purpool Registration', $message, "From: ".$MISC['admin_email']);

			// Redirect user to dashboard
			header("Location: register.php?state=confirmation");

			// Disconnect from database
			$dbh->disconnect();
			exit();
		}

		// Assign pagetitle
		$tpl->assign('pagetitle', 'Register');

		// Display Template
		$tpl->display('register-interests.tpl');

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

	# Survey
		case "survey":

		// Continue session
		session_start();

		//check and redirect if completed
		$sql = "SELECT survey_complete FROM users WHERE user_id = {$_SESSION['user_id']} AND survey_complete = 1";
		$result = $dbh->query($sql);
		if($result->numRows() > 0) $completed = true;
		else $completed = false;

		if(isset($_POST['submit']))
		{
			// Create error array
			$error = array();

			// Check all questions are answered
			if(empty($_POST['experience']))
			{
				$error['experience'] = 'Please choose one.';
			}
			if(empty($_POST['routine']))
			{
				$error['routine'] = 'Please choose one.';
			}
			if(empty($_POST['recruitment']))
			{
				$error['recruitment'] = 'Please choose one.';
			}
			if(empty($_POST['motivation']))
			{
				$error['motivation'] = 'Please choose one.';
			}
			$tpl->assign('experience', $_POST['experience']);
			$tpl->assign('routine', $_POST['routine']);
			$tpl->assign('recruitment', $_POST['recruitment']);
			$tpl->assign('motivation', $_POST['motivation']);
			$tpl->assign('comments', $_POST['comments']);


			if(sizeof($error) == 0)
			{

				//update users table
				$sql = "UPDATE users SET survey_complete = 1 WHERE user_id = {$_SESSION['user_id']}";
				$dbh->query($sql);

				// Insert survey information
				$sql = "INSERT INTO survey (
					user_id,
					experience,
					routine,
					recruitment,
					motivation,
					comments,
					date_completed
				) VALUES (
					{$_SESSION['user_id']},
					'{$_POST['experience']}',
					'{$_POST['routine']}',
					'{$_POST['recruitment']}',
					'{$_POST['motivation']}',
					'{$_POST['comments']}',
					NOW()
				)";
				$dbh->query($sql);
				$completed = true;
			}
		}

		// Assign pagetitle
		$tpl->assign('pagetitle', 'Registration Survey');

		// Assign errors to template
		$tpl->assign('error', $error);

		// Display Template
		if(!$completed) $tpl->display('register-survey.tpl');
		else $tpl->display('register-survey-complete.tpl');

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

	# DISPLAY REGISTRATION CONFIRMATION
	case "confirmation":

		// Continue session
		session_start();

		// Assign full name
		$tpl->assign('fullname', $_SESSION['fullname']);

		// Assign e-mail address
		$tpl->assign('email', $_SESSION['email']);

		// Display Template
		$tpl->display('register-confirmation.tpl');

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

	# General Information (step one of three)
	default:

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

			// Check for a username
			if(empty($_POST['username']))
			{
				$error['username'] = 'An email address is required.';
			} else {

				// Take out '@company.com' if a user types it in
				if(strripos($_POST['username'], '@'))
				{
					$username = strtok($_POST['username'], "@");
				} else {
					$username = $_POST['username'];
				}

				// Clean username
				$username = str_replace(' ', '', $username);
				$username = str_replace('\'', '', $username);
				$username = str_replace('&', '', $username);
				$username = str_replace('%', '', $username);
				$username = trim($username);

				// Generate an e-mail address for this user based on their workplace
				if(!empty($_POST['workplace']))
				{
					// THIS IS A SPECIAL CASE FOR PEPSICO SINCE E-MAIL CAN END IN '@PEPSI.COM' OR '@PEPSICO.COM'
					$pepsisuffix = stristr($_POST['username'], '@');
					if(($pepsisuffix == '@pepsi.com') || ($pepsisuffix == '@pepsico.com'))
					{
						// Build a custom suffix (pepsi users)
						$email = $username . $pepsisuffix;
					} 
					// THIS IS A SPECIAL CASE FOR DEC SINCE E-MAIL CAN END IN ONE OF THREE POSSIBILITIES
					else if($_POST['workplace'] == '6'){
						if(($pepsisuffix == '@gw.dec.state.ny.us') || ($pepsisuffix == '@efc.ny.gov') || ($pepsisuffix == '@suny.edu')){
						// Build a custom suffix (pepsi users)
							$email = $username . $pepsisuffix;
						}
						else{
							$error['workplace'] = 'Your workplace does not match the workplace e-mail you have entered.';
						}
					} 
					else {
						// Get the suffix of the workplace e-mail (normal users)
						$sql = "SELECT suffix FROM workplaces WHERE workplace_id = '{$_POST['workplace']}'";
						$row = $dbh->queryRow($sql);
						if($pepsisuffix != $row['suffix'])
							$error['workplace'] = 'Your workplace does not match the workplace e-mail you have entered.';
						$email = $username . $row['suffix'];

					}

					// Check for a duplicate email address
					$sql = "SELECT email FROM users WHERE email = '$email'";
					$result = $dbh->query($sql);
					if($result->numRows() > 0)
					{
						$error['username'] = 'This username already exists.';
					}

				} else {
					$error['workplace'] = 'A workplace is required.';
				}

				$tpl->assign('username', $username);
			}

			// Create a temporary password
			$userpass = Utils::randomKey(8);
			$sha1_userpass = sha1($userpass);

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

			// Check for a gender
			if(empty($_POST['gender']))
			{
				$error['gender'] = 'A gender is required.';
			} else {
				$tpl->assign('gender', $_POST['gender']);
			}

			// Check for a zipcode
			if((!is_numeric($_POST['zipcode'])) || (strlen($_POST['zipcode']) != 5))
			{
				$error['zipcode'] = 'A valid zipcode is required.';
			}
			$tpl->assign('zipcode', $_POST['zipcode']);

			// Assign schedule
			$tpl->assign('schedule', $_POST['schedule']);

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

			// If there are no errors, register user
			// Otherwise, display errors
			if(sizeof($error) == 0)
			{

				// Insert user information
				$sql = "INSERT INTO users (
					username,
					userpass,
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
					registerdate,
					isworkplaceadmin
				) VALUES (
					'$username',
					'$sha1_userpass',
					'{$_POST['firstname']}',
					'{$_POST['lastname']}',
					'{$_POST['gender']}',
					'$email',
					'$cellphone',
					'$workphone',
					'{$_POST['workplace']}',
					'{$_POST['zipcode']}',
					'{$_POST['schedule']}',
					'{$_POST['occupation']}',
					NOW(),
					'0'
				)";
				$dbh->query($sql);

				// Make a copy of the sql statement for debugging purposes
				$problematicsql = $sql;

				// Get user_id of new user (used in session)
				$sql = "SELECT user_id FROM users WHERE email = '$email'";
				$row = $dbh->queryRow($sql);
				$user_id = $row['user_id'];

				// Check for an unexpected error
				if(!$user_id)
				{
					// Assign pagetitle
					$tpl->assign('pagetitle', 'Register');

					// Assign unexpected error
					$error['unexpected'] = 'A general error has occurred. Please try again.';

					// Assign errors to template
					$tpl->assign('error', $error);

					// E-mail error to john and peter
					$message = 'A registration error has occurred. The problematic sql statement is below:' . "\n\n";
					$message = $message . $problematicsql . "\n\n";
					if($_FILES['file']['name'])
					{
						$message = $message . 'The user attempted to upload a photo';
					} else {
						$message = $message . 'The user did not attempt to upload a photo';
					}
					mail("john@johnkuiphoff.com", "Purpool Registration Error", $message, "From: ".$MISC['admin_email']);
					mail($MISC['admin_email'], "Purpool Registration Error", $message, "From: ".$MISC['admin_email']);

					// Display Template
					$tpl->display('register.tpl');

					// Disconnect from database
					$dbh->disconnect();
					exit();
				}

				// Check to see if this is an invited member
				// If it is, update the user_id in the pool members table
				$sql = "SELECT user_id, email FROM poolmembers WHERE email = '$email' AND user_id = 0";
				$row = $dbh->queryRow($sql);
				if($row)
				{
					// Update pool members table
					$sql = "UPDATE poolmembers SET user_id = '$user_id' WHERE email = '$email' AND user_id = '0'";
					$dbh->query($sql);
				}

				// Upload user photo
				if($_FILES['file']['name'])
				{
					$photo  = Utils::resizeImage($_FILES['file']['tmp_name'], $user_id, $DIR['users'], 'small');
					$photo2 = Utils::resizeImage($_FILES['file']['tmp_name'], $user_id, $DIR['users'], 'medium');
					$photo3 = Utils::resizeImage($_FILES['file']['tmp_name'], $user_id, $DIR['users'], 'large');
				}

				// Log action
				Utils::logAction($_POST['username'], 'Registered', '');

				// Create new session
				session_start();

				// Add user information to session variables
				$_SESSION['user_id'] = $user_id;
				$_SESSION['username'] = $_POST['username'];
				$_SESSION['userpass'] = $userpass;
				$_SESSION['fullname'] = $_POST['firstname'] . ' ' . $_POST['lastname'];
				$_SESSION['email'] = $email;

				// Redirect user
				header("Location: register.php?state=vehicle");

				// Disconnect from database
				$dbh->disconnect();
				exit();

			} else {

				// Assign pagetitle
				$tpl->assign('pagetitle', 'Register');

				// Assign errors to template
				$tpl->assign('error', $error);

				// Display Template
				$tpl->display('register.tpl');

				// Disconnect from database
				$dbh->disconnect();
				exit();

			}

		} else {

			// Assign pagetitle
			$tpl->assign('pagetitle', 'Register');

			// Check for an email address (via invitiation)
			if($_GET['email'])
			{
				$tpl->assign('email', $_GET['email']);
			}

			// Display Template
			$tpl->display('register.tpl');

			// Disconnect from database
			$dbh->disconnect();
			exit();

		}

	break;
}




?>
