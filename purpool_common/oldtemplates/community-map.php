<?php

#################################################################
# Name: cmap.php                                      #
# Author: John Kuiphoff                                         #
# Description: Allows users to view all purpool related info    #
#################################################################

// Include configuration file
//include_once('/home/41684/domains/purpool.com/common/includes/config.php');

// Include common utility library
include_once($DIR['inc'] . 'Utils.class.php');

// Include database package
include_once($DIR['pear'] . 'MDB2.php');

// Include SMARTY templating engine
include_once($DIR['smarty'] . 'Smarty.class.php');

// Initialize database connection
$dbh = Utils::initDB();

// Initialize templating engine
$tpl = Utils::initTPL();

// Start new session
session_start();

// Validate user
if(!$_SESSION['username'])
{
	echo 'not validated';
}

// Assign current side navigation
$tpl->assign('cmapcurrent', true);

// Switch state
switch($_GET['state'])
{
	# SAVE POINT OF INTEREST
	case "savepoi":
	
		// Create error array
		$error = array();
		
		// Check for a title
		if(empty($_POST['title']))
		{
			$error['title'] = 'A title is required.';
		}
		
		// Check for an address
		if(empty($_POST['address']))
		{
			$error['address'] = 'An address is required.';
		}
		
		// Check for a city
		if(empty($_POST['city']))
		{
			$error['city'] = 'A city is required.';
		}
		
		// Check for a state
		if(empty($_POST['state']))
		{
			$error['state'] = 'An state is required.';
		}
		
		// If there are no errors
		if(sizeof($error) == 0)
		{
			// Insert point of interest into the database
			$sql = "INSERT INTO poi (
						poi_id, 
						user_id,
						title, 
						address, 
						city, 
						state, 
						zip, 
						latitude,
						longitude,
						description, 
						url, 
						tags, 
						submitdate
					) VALUES (
						null,
						'{$_SESSION['user_id']}',
						'{$_POST['title']}',
						'{$_POST['address']}',
						'{$_POST['city']}',
						'{$_POST['state']}',
						'{$_POST['zip']}',
						'{$_POST['latitude']}',
						'{$_POST['longitude']}',
						'{$_POST['description']}',
						'{$_POST['url']}',
						'{$_POST['tags']}',
						NOW()
					)";
			$dbh->query($sql);
				
			// Build JSON array
			$json = array(
				"status" => "success",
				"title" => $_POST['title']
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
	
	break;
	
	# EDIT POINT OF INTEREST
	case "editpoi":
	
		// Get all markers that the user has posted
		$sql = "SELECT
					poi_id,
					title,
					address,
					city,
					state,
					zip,
					latitude,
					longitude,
					description,
					url,
					tags,
					submitdate
				FROM
					poi
				WHERE
					user_id = '{$_SESSION['user_id']}'";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			$poi[] = array(
				'poi_id' => $row['poi_id'],
				'title' => $row['title'], 
				'address' => $row['address'], 
				'city' => $row['city'], 
				'state' => $row['state'], 
				'zip' => $row['zip'], 
				'latitude' => $row['latitude'], 
				'longitude' => $row['longitude'], 
				'description' => $row['description'], 
				'url' => $row['url'], 
				'tags' => $row['tags'], 
				'submitdate' => $row['submitdate'] 
			);
		}
		$tpl->assign('poi', $poi);
		
		// Display Template
		$tpl->display('cmap-edit.tpl');
		
		// Disconnect from database
		$dbh->disconnect();
		exit();	

	break;
	
	# DISPLAY COMMUNITY MAP
	default:
		
		// Get workplace of user
		$sql = "SELECT workplace FROM users WHERE user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		
		// Get points of interest
		$sql = "SELECT
					poi_id,
					user_id,
					title,
					address,
					city,
					state,
					zip,
					latitude,
					longitude,
					description,
					url,
					tags,
					submitdate
				FROM
					poi";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			// Get name of person who posted poi
			$sql2 = "SELECT firstname, lastname FROM users WHERE user_id = '{$row['user_id']}'";
			$row2 = $dbh->queryRow($sql2);
			$fullname = $row['firstname'] . ' ' . $row['lastname'];
			
			$poi[] = array(
				'poi_id' => $row['poi_id'],
				'title' => $row['title'], 
				'user_id' => $row['user_id'],
				'fullname' => $fullname,
				'address' => $row['address'], 
				'city' => $row['city'], 
				'state' => $row['state'], 
				'zip' => $row['zip'], 
				'latitude' => $row['latitude'], 
				'longitude' => $row['longitude'], 
				'description' => $row['description'], 
				'url' => $row['url'], 
				'tags' => $row['tags'], 
				'submitdate' => $row['submitdate'] 
			);
		}
		$tpl->assign('poi', $poi);
		
		// Display Template
		$tpl->display('cmap.tpl');
		
		// Disconnect from database
		$dbh->disconnect();
		exit();	

	break;
}

?>
