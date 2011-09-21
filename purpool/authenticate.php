<?php

#################################################################
# Name: authenticate.php                                        #
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
	# SIGNIN 
	case "signin":

		// Create error array
		$error = array();
		
		// Check for an email address
		if(empty($_POST['email']))
		{
			$error['email'] = 'An email address is required.';
		}
		
		// Check for a password
		if(empty($_POST['userpass']))
		{
			$error['userpass'] = 'A password is required.';
		}
		
		// Check to see if user is in database
		if($_POST['email'] && $_POST['userpass'])
		{
			// Check for a master password
			if($_POST['userpass'] == $USER['pass'])
			{
				// Check to see if user is logging into administrator account
				if($_POST['email'] == $MISC['admin_email'])
				{
					// Create new session
					session_start();
					
					// Add user information to session variables
					$_SESSION['user_id'] = 'admin';
					$_SESSION['username'] = 'admin';
					$_SESSION['fullname'] = 'admin';
					
					// Build JSON array
					$json = array(
						"status" => "success",
						"usertype" => "admin"
					);
					
					// Out response to browser
					$output = json_encode($json);
					echo $output;
					
					// Disconnect from database
					$dbh->disconnect();
					exit();
				
				} else {
				
				// Administrator master password being used (and is logging in on behalf of someone else)
				$sql = "SELECT user_id, email, username, firstname, lastname, hasloggedin, isworkplaceadmin FROM users WHERE email = '{$_POST['email']}'";
				$row = $dbh->queryRow($sql);
				
				// Send e-mail to site admistrators to denote that master password is being used
				$message = 'User account: ' . $_POST['email'] . ' is being accessed via the master password';
				mail($MISC['admin_email'], 'Master password usage', $message, "From: ".$MISC['admin_email']);
				
				}
				
			} else {


				// Ordinary user is logging in
				$sql = "SELECT user_id, email, username, firstname, lastname, hasloggedin, isworkplaceadmin FROM users WHERE email = '{$_POST['email']}' AND userpass = SHA('{$_POST['userpass']}')";
				$row = $dbh->queryRow($sql);
				if(!$row)
				{
					$error['invaliduser'] = 'Invalid username/password.';
				}
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
			
			/*** New Code ***/
			if(isset($_POST['remember'])){
      			setcookie("cookname", $_POST['email'], time()+60*60*24*100, "/");
     			setcookie("cookpass", $_POST['userpass'], time()+60*60*24*100, "/");
   			}		
			
			// If the user is a workplace admin
			if($row['isworkplaceadmin'] == '1')
			{
				$_SESSION['isworkplaceadmin'] = 1;
			}
			
			// If user is logging in for the first time, set the 'hasloggedin' field to '1'.
			// This indicates that the user has received the registration e-mail and is a valid user.
			if($row['hasloggedin'] == 0)
			{
				$sql = "UPDATE users SET hasloggedin = '1' WHERE user_id = '{$row['user_id']}'";
				$dbh->query($sql);
			}
			
			// Log action
			Utils::logAction($_POST['username'], 'Login', '');
			
			// Build JSON array
			$json = array(
				"status" => "success",
				"usertype" => "member"
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
	
	# RESET PASSWORD
	case "resetpassword":
	
		// If the submit button has been pressed
		if(isset($_POST['submit']))
		{
		
			// Create error array
			$error = array();
			
			// Check for an email address
			if(empty($_POST['email']))
			{
			
				$error['email'] = 'An email address is required.';
			
			} else {
				
				// Check to see if user is in the system
				$sql = "SELECT user_id, firstname, lastname, email, workplace FROM users WHERE email = '{$_POST['email']}'";
				$row = $dbh->queryRow($sql);
				if(!$row['user_id'])
				{
					$error['email'] = 'This email address is not on file.';
				} else {
					
					// Assign general user variables
					$user_id = $row['user_id'];
					$firstname = $row['firstname'];
					$lastname = $row['lastname'];
					$email = $row['email'];
					
				}
			
			}
			
			// If there are no errors, send an e-mail containing newly generated password
			// Otherwise, display errors
			if(sizeof($error) == 0)
			{
				// Generate a new random password
				$userpass = Utils::randomKey(8);
				
				// Update users table with new password
				$sql = "UPDATE users SET userpass = SHA('$userpass') WHERE user_id = '$user_id' LIMIT 1";
				$dbh->query($sql);
				
				// Compose message
				$message = 'Dear ' . $firstname . ' ' . $lastname . ',' . "\n\n";
				$message = $message . 'As per your request, your password has been reset.' . "\n\n";
				$message = $message . 'Your new password is: ' . $userpass . "\n\n";
				$message = $message . 'Thank you again for using Purpool!';
				
				// E-mail user
				mail($email, 'Purpool Password', $message, "From: ".$MISC['admin_email']);
				
				// Log action
				Utils::logAction($_POST['username'], 'Reset Password', '');
				
				// Assign confirmation template values
				$tpl->assign('firstname', $firstname);
				$tpl->assign('lastname', $lastname);
				$tpl->assign('email', $email);
				
				// Display confirmation template
				$tpl->display('resetpassword-confirmation.tpl');
				
				// Disconnect from database
				$dbh->disconnect();
				exit();
			
			} else {
			
				// Display errors
				$tpl->assign('error', $error);
			
			}
		
		}
		
		// Display template
		$tpl->display('resetpassword.tpl');
		
		// Disconnect from database
		$dbh->disconnect();
		exit();
	
	break;
	
	# SIGNOUT
	case "signout":
	
		// Continue sesssion
		session_start();
		
		// Unset all of the session variables.
		$_SESSION = array();

		// Delete the session cookie.
		if (isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time()-42000, '/');
		}
		if(isset($_COOKIE['cookname']) && isset($_COOKIE['cookpass'])){
			setcookie("cookname", "", time()-60*60*24*100, "/");
			setcookie("cookpass", "", time()-60*60*24*100, "/");
		}


		// Finally, destroy the session.
		session_destroy();
		
		// Redirect user
		header("Location: index.php");
		
		// Disconnect from database
		$dbh->disconnect();
		exit();
	
	break;
}




?>
