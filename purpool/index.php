<?php


#################################################################
# Name: index.php                                               #
# Author: John Kuiphoff                                         #
# Description: Allows users to sigin in to Purpool              #
#################################################################

// Include configuration file
include_once('config_path.php'); include_once($config_path.'config.php');

// Include common utility library
include_once($DIR['inc'].'Utils.class.php');

// Include database package
include_once($DIR['pear'].'MDB2.php');

// Include SMARTY templating engine
include_once($DIR['smarty'].'Smarty.class.php');

// Include visualization library
include_once($DIR['inc'].'visdata.php');


// Initialize database connection
$dbh = Utils::initDB();

// Initialize templating engine
$tpl = Utils::initTPL();$tpl->assign('site_url', $MISC['site_url']);

// Switch state
switch($_GET['state']){

	// Display Main Menu
	default:
		$remember = isset($_COOKIE['cookname']) && isset($_COOKIE['cookpass']);
		if($remember){
			
			//authenticate based on cookie data and go to dashboard
      		$email = $_COOKIE['cookname'];
      		$userpass = $_COOKIE['cookpass'];
			
			$sql = "SELECT user_id, email, username, firstname, lastname, hasloggedin, isworkplaceadmin FROM users WHERE email = '{$email}' AND userpass = SHA('{$userpass}')";
			
			//echo $sql;
			
			$row = $dbh->queryRow($sql);
			if(!$row){
				$error['invaliduser'] = 'Invalid username/password.';
			}
			
			// If there are no errors, sign in user
			// Otherwise, display errors
			if(sizeof($error) == 0){
				// Create new session
				session_start();
				
				// Add user information to session variables
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['username'] = $row['username'];
				$_SESSION['fullname'] = $row['firstname'] . ' ' . $row['lastname'];
				
				// If the user is a workplace admin
				if($row['isworkplaceadmin'] == '1'){
					$_SESSION['isworkplaceadmin'] = 1;
				}
				header("Location: dashboard.php");
				
			}
			else{
				$error = True;
				
			}
   		}
		
		// display normal home page if user hasn't requested to remember login info or if cookie login info doesn't authenticate
		if (!$remember || $error){
			// Get overall leaders
			$leaders = getOverallLeaders();
			$tpl->assign('leaders', $leaders);
			$sql="SELECT COUNT(*) FROM users WHERE hasloggedin = '1'";
			$result = $dbh->query($sql);
			$row = $result->fetchRow();
			$activemembers = $row['count(*)'];
			$tpl->assign('activemembers', $activemembers);
			$sql="SELECT COUNT(*) FROM pools";
			$result = $dbh->query($sql);
			$row = $result->fetchRow();
			$poolcount = $row['count(*)'];
			$tpl->assign('poolcount', $poolcount);
	
			// Display Template
			$tpl->display('index.tpl');
		}
		// Disconnect database
		$dbh->disconnect();
		exit();

	break;
}

?>