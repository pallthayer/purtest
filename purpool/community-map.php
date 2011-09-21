<?php

#################################################################
# Name: cmap.php                                      #
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
	header("Location: index.php");
}

// Check for workplace admin
if($_SESSION['isworkplaceadmin'] == 1) { $tpl->assign('adminmode', 1); }

$tpl->assign('google_key', $MISC['google_key']);

// Calculate font size for tag cloud
function calculateFontSize($frequency, $min, $max)
{
	$minFontSize=7;
	$maxFontSize=20;

	if($min != $max){
		// Use point-slope formula to calculate the font size
		$slope=($maxFontSize-$minFontSize)/($max-$min);
		return floor($minFontSize + $slope*($frequency-$min));
	}
	else{
		return floor(($minFontSize + $maxFontSize)/2);
	}

}

// Assign current side navigation
$tpl->assign('cmapcurrent', true);

// Switch state
switch($_GET['state'])
{
	# SAVE POINT OF INTEREST
	case "savepoi":

		// Get user workplace
		$sql = "SELECT workplace FROM users WHERE user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		$workplace_id = $row['workplace'];

		// Create error array
		$error = array();

		// Check for a title
		if(empty($_POST['title']))
		{
			$error['title'] = 'A title is required.';
		}

		// Check for an address
		if(empty($_POST['latitude']))
		{
			//$error['address'] = 'An address or a point is required.';
		}

		if(isset($_POST['url'])){
			if(substr($_POST['url'], 0, 7) == "http://" || substr($_POST['url'], 0, 8) == "https://") $url=$_POST['url'];
			else $url = "http://".$_POST['url'];
		}
		else $url="";

		// If there are no errors
		if(sizeof($error) == 0)
		{
			// If the 'id' is empty, it is a new poi.
			// If the 'id' contains an 'id', we are updating an existing poi.
			if(empty($_POST['id']))
			{

				// Insert point of interest into the database
				$sql = "INSERT INTO poi (
							poi_id,
							workplace_id,
							user_id,
							fullname,
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
							'$workplace_id',
							'{$_SESSION['user_id']}',
							'{$_SESSION['fullname']}',
							'{$_POST['title']}',
							'{$_POST['address']}',
							'{$_POST['city']}',
							'{$_POST['state']}',
							'{$_POST['zip']}',
							'{$_POST['latitude']}',
							'{$_POST['longitude']}',
							'{$_POST['description']}',
							'{$url}',
							'{$_POST['tags']}',
							NOW()
						)";
				$dbh->query($sql);

				// Get poi_id
				//$id = $dbh->lastInsertID('poi', 'poi_id'); (Not working for some reason)

				// Get poi_id
				$sql = "SELECT poi_id FROM poi WHERE user_id = '{$_SESSION['user_id']}' AND tags = '{$_POST['tags']}' ORDER BY submitdate LIMIT 1";
				$row = $dbh->queryRow($sql);

				// Insert tags into tag table
				$tags = explode(' ', $_POST['tags']);
				foreach($tags AS $value)
				{
					// Clean off comma (for mixed up users)
					$tag = str_replace(',','',$value);

					// Insert new record
					$sql = "INSERT INTO poitags (tag_id, poi_id, workplace_id, tag) VALUES (null, '{$row['poi_id']}', '$workplace_id', '$tag')";
					$dbh->query($sql);
				}

			} else {

				// Update the existing poi
				$sql = "UPDATE
							poi
						SET
							title = '{$_POST['title']}',
							address = '{$_POST['address']}',
							city = '{$_POST['city']}',
							state = '{$_POST['state']}',
							zip = '{$_POST['zip']}',
							latitude = '{$_POST['latitude']}',
							longitude = '{$_POST['longitude']}',
							description = '{$_POST['description']}',
							url = '{$url}',
							tags = '{$_POST['tags']}'
						WHERE
							poi_id = '{$_POST['id']}'";
				$dbh->query($sql);

				// Delete tags for this poi
				$sql = "DELETE FROM poitags WHERE poi_id = '{$_POST['id']}'";
				$dbh->query($sql);

				// Insert new tags into tag table
				$tags = explode(' ', $_POST['tags']);
				foreach($tags AS $value)
				{
					// Clean off comma (for mixed up users)
					$tag = str_replace(',','',$value);

					// Insert new record
					$sql = "INSERT INTO poitags (tag_id, poi_id, tag) VALUES (null, '{$row['poi_id']}', '$workplace_id', '$tag')";
					$dbh->query($sql);
				}

			}

			// Build JSON array
			$json = array(
				"status" => "success",
				"title" => $_POST['title'],
				"id" => $row['poi_id']
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

		// Get workplace of user
		$sql = "SELECT firstname, lastname, workplace FROM users WHERE user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		$workplace_id = $row['workplace'];
		$fullname = $row['firstname'] . ' ' . $row['lastname'];

		// Get workplace information
		$sql = "SELECT name, latitude, longitude FROM workplaces WHERE workplace_id = '$workplace_id'";
		$row = $dbh->queryRow($sql);
		$tpl->assign('workplacetitle', $row['name']);
		$tpl->assign('workplacelat', $row['latitude']);
		$tpl->assign('workplacelng', $row['longitude']);

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
					submitdate
				FROM
					poi
				WHERE
					user_id = '{$_SESSION['user_id']}'";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			// Get tags for this poi
			$tags = '';
			$sql2 = "SELECT tag FROM poitags WHERE poi_id = '{$row['poi_id']}'";
			$result2 = $dbh->query($sql2);
			while($row2 = $result2->fetchRow())
			{
				$tags .= $row2['tag'] . ' ';
			}

			$poiData[] = array(
				'id' => $row['poi_id'],
				'title' => $row['title'],
				'location' => $row['latitude'] . ',' . $row['longitude'],
				'name' => $fullname,
				'description' => $row['description'],
				'address' => $row['address'],
				'city' => $row['city'],
				'state' => $row['state'],
				'zip' => $row['zip'],
				'tags' => $tags,
				'url' => $row['url']
			);
		}
		$poiDataJSON = json_encode($poiData);
		$tpl->assign('poiData', $poiDataJSON);

		// Display Template
		$tpl->display('cmap-edit.tpl');

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

	# REMOVE POINT OF INTEREST
	case "removepoi":

		// Get user workplace
		$sql = "SELECT workplace FROM users WHERE user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		$workplace_id = $row['workplace'];

		// Create error array
		$error = array();

		// Check for a title
		if(empty($_GET['id']))
		{
			$error['id'] = 'An id is required.';
		}



		// If there are no errors
		if(sizeof($error) == 0){
			// Remove the existing poi
			$sql = "DELETE FROM poi WHERE poi_id = '{$_GET['id']}'";
			$dbh->query($sql);

			// Delete tags for this poi
			$sql = "DELETE FROM poitags WHERE poi_id = '{$_GET['id']}'";
			$dbh->query($sql);

			// Build JSON array
			$json = array(
				"status" => "success",
				"id" => $_GET['id']
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
	# SEARCH POINTS OF INTEREST
	case "searchpoi":

		// Get workplace of user
		$sql = "SELECT workplace FROM users WHERE user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		$workplace_id = $row['workplace'];

		// Get workplace information
		$sql = "SELECT name, latitude, longitude FROM workplaces WHERE workplace_id = '$workplace_id'";
		$row = $dbh->queryRow($sql);

		// Get points of interest based on search
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
					submitdate
				FROM
					poi
				WHERE
					title LIKE '%{$_POST['search']}%' OR
					fullname LIKE '%{$_POST['search']}%' OR
					address LIKE '%{$_POST['search']}%' OR
					city LIKE '%{$_POST['search']}%' OR
					state LIKE '%{$_POST['search']}%' OR
					zip LIKE '%{$_POST['search']}%' OR
					description LIKE '%{$_POST['search']}%' OR
					url LIKE '%{$_POST['search']}%' OR
					tags LIKE '%{$_POST['search']}%'
					AND workplace_id = '$workplace_id'
				GROUP BY
					poi_id";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			// Get name of person who posted poi
			$sql2 = "SELECT firstname, lastname FROM users WHERE user_id = '{$row['user_id']}'";
			$row2 = $dbh->queryRow($sql2);
			$fullname = $row2['firstname'] . ' ' . $row2['lastname'];

			// Get tags for this poi
			$tags = '';
			$sql2 = "SELECT tag FROM poitags WHERE poi_id = '{$row['poi_id']}'";
			$result2 = $dbh->query($sql2);
			while($row2 = $result2->fetchRow())
			{
				$tags .= $row2['tag'] . ' ';
			}

			$poiList[] = array($row['poi_id']);
			$poiData[] = array(
				'id' => $row['poi_id'],
				'title' => $row['title'],
				'location' => $row['latitude'] . ',' . $row['longitude'],
				'name' => $fullname,
				'description' => $row['description'],
				'address' => $row['address'],
				'city' => $row['city'],
				'state' => $row['state'],
				'zip' => $row['zip'],
				'tags' => $tags,
				'url' => $row['url']
			);
		}
		//$output = json_encode($poiData);
		$output = json_encode($poiList);

		// Build JSON array
		///$json = array(
		//	"status" => "success",
		//	"poiData" => $poiDataJSON
		//);

		// Out response to browser
		//$output = json_encode($json);

		// Output to browser
		echo $output;

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

	# DISPLAY COMMUNITY MAP
	default:

		// Get workplace of user
		$sql = "SELECT workplace FROM users WHERE user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		$workplace_id = $row['workplace'];

		// Get workplace information
		$sql = "SELECT name, latitude, longitude FROM workplaces WHERE workplace_id = '$workplace_id'";
		$row = $dbh->queryRow($sql);
		$tpl->assign('workplacetitle', $row['name']);
		$tpl->assign('workplacelat', $row['latitude']);
		$tpl->assign('workplacelng', $row['longitude']);

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
					submitdate
				FROM
					poi
				WHERE
					workplace_id = '$workplace_id'";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			// Get name of person who posted poi
			$sql2 = "SELECT firstname, lastname FROM users WHERE user_id = '{$row['user_id']}'";
			$row2 = $dbh->queryRow($sql2);
			$fullname = $row2['firstname'] . ' ' . $row2['lastname'];

			// Get tags for this poi
			$tags = '';
			$sql2 = "SELECT tag FROM poitags WHERE poi_id = '{$row['poi_id']}'";
			$result2 = $dbh->query($sql2);
			while($row2 = $result2->fetchRow())
			{
				$tags .= $row2['tag'] . ' ';
			}

			$poiData[] = array(
				'id' => $row['poi_id'],
				'title' => $row['title'],
				'location' => $row['latitude'] . ',' . $row['longitude'],
				'name' => $fullname,
				'description' => $row['description'],
				'address' => $row['address'],
				'city' => $row['city'],
				'state' => $row['state'],
				'zip' => $row['zip'],
				'tags' => $tags,
				'url' => $row['url']
			);
		}
		$poiDataJSON = json_encode($poiData);
		$tpl->assign('poiData', $poiDataJSON);

		// Get tag min and max
		$sql = "SELECT min(a.no_count) AS min FROM (SELECT count(tag_id) AS no_count FROM poitags WHERE workplace_id = '$workplace_id' GROUP BY tag) AS a";
		$row = $dbh->queryRow($sql);
		$min = $row['min'];
		$sql = "SELECT max(a.no_count) AS max FROM (SELECT count(tag_id) AS no_count FROM poitags WHERE workplace_id = '$workplace_id' GROUP BY tag) AS a";
		$row = $dbh->queryRow($sql);
		$max = $row['max'];

		// Get all tags
		$sql = "SELECT distinct(tag) AS tag FROM poitags WHERE workplace_id = '$workplace_id' ORDER BY tag";
		$result = $dbh->query($sql);
		while($row = $result->fetchRow())
		{
			// Get the tag frequency
			$sql2 = "SELECT count(tag_id) AS frequency FROM poitags WHERE tag = '{$row['tag']}'";
			$row2 = $dbh->queryRow($sql2);
			$frequency = $row2['frequency'];
			$fontSize=calculateFontSize($frequency, $min, $max);
			$taglist[] = array(
				'size' => $fontSize . 'pt',
				'tag' => $row['tag']
			);
		}
		$tpl->assign('taglist', $taglist);

		// Display Template
		$tpl->display('cmap.tpl');

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;
}

?>
