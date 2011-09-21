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

// Validate user
if(!$_SESSION['username'])
{
	header("Location: index.php");
}

// Check for workplace admin
if($_SESSION['isworkplaceadmin'] == 1) { $tpl->assign('adminmode', 1); }

// Switch state
switch($_GET['state'])
{
	# CREATE EVENT
	case "createevent":

		// Assign current side navigation
		$tpl->assign('eventscurrent', true);

		// Set form action
		$formaction = 'events.php?state=createevent';
		$tpl->assign('formaction', $formaction);

		// Get user workplace
		$sql = "SELECT workplace FROM users WHERE user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		$workplace_id = $row['workplace'];

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
				$tpl->assign('title', $_POST['title']);
			}

			// Check for a description
			$tpl->assign('description', $_POST['description']);

			// Check for a type
			$tpl->assign('type', $_POST['type']);
			$tpl->assign('typeother', $_POST['typeother']);

			// Check for a startdate
			if(empty($_POST['startdate']))
			{
				$error['startdate'] = 'A start date is required.';
			} else {
				$tpl->assign('startdate', $_POST['startdate']);
				$startdate = explode('-', $_POST['startdate']);
				$startmonth = $startdate[0];
				$startday = $startdate[1];
				$startyear = $startdate[2];
			}

			// Check for a start time
			$tpl->assign('starthour', $_POST['starthour']);
			$tpl->assign('startminute', $_POST['startminute']);
			$tpl->assign('startampm', $_POST['startampm']);

			// Check for an end time
			$tpl->assign('enddate', $_POST['enddate']);
			$enddate = explode('-', $_POST['enddate']);
			$endmonth = $enddate[0];
			$endday = $enddate[1];
			$endyear = $enddate[2];

			// Check for an end time
			$tpl->assign('endhour', $_POST['endhour']);
			$tpl->assign('endminute', $_POST['endminute']);
			$tpl->assign('endampm', $_POST['endampm']);

			// Check for a location
			$tpl->assign('location', $_POST['location']);

			// Check for a url
			$tpl->assign('url', $_POST['url']);
			if(isset($_POST['url'])){
				if(substr($_POST['url'], 0, 7) == "http://" || substr($_POST['url'], 0, 8) == "https://") $url=$_POST['url'];
				else $url = "http://".$_POST['url'];
			}
			else $url="";

			// Check for notes
			$tpl->assign('notes', $_POST['notes']);

			// Otherwise, display errors
			if(sizeof($error) == 0)
			{
				// Clean event date (YYYY-MM-DD HH:mm:SS)
				if(($_POST['startampm'] == 'am') && ($_POST['starthour'] == '12'))
				{
					$starthour = '00';
				} elseif (($_POST['startampm'] == 'pm') && ($_POST['starthour'] == '12')) {
					$starthour = '12';
				} elseif ($_POST['startampm'] == 'pm') {
					$starthour = $_POST['starthour'] + 12;
				} else {
					$starthour = $_POST['starthour'];
				}
				$startdate = $startyear . '-' . $startmonth . '-' . $startday . ' ' . $starthour . ':' . $_POST['startminute'] . ':00';
				if($_POST['enddate'])
				{
					if(($_POST['endampm'] == 'am') && ($_POST['endhour'] == '12'))
					{
						$endhour = '00';
					} elseif (($_POST['endampm'] == 'pm') && ($_POST['endhour'] == '12')) {
						$endhour = '12';
					} elseif ($_POST['endampm'] == 'pm') {
						$endhour = $_POST['endhour'] + 12;
					} else {
						$endhour = $_POST['endhour'];
					}
					$enddate = $endyear . '-' . $endmonth . '-' . $endday . ' ' . $endhour . ':' . $_POST['endminute'] . ':00';
				}

				// Insert event into database
				$sql = "INSERT INTO events (
								event_id,
								user_id,
								postedby,
								workplace_id,
								title,
								type,
								typeother,
								description,
								location,
								startdate,
								enddate,
								url,
								notes
							) VALUES (
								null,
								'{$_SESSION['user_id']}',
								'{$_SESSION['fullname']}',
								'$workplace_id',
								'{$_POST['title']}',
								'{$_POST['type']}',
								'{$_POST['typeother']}',
								'{$_POST['description']}',
								'{$_POST['location']}',
								'$startdate',
								'$enddate',
								'{$url}',
								'{$_POST['notes']}'
							)";
				$dbh->query($sql);

				// Redirect user
				header("Location: events.php?confirmation=createevent");

				// Disconnect from database
				$dbh->disconnect();
				exit();

			} else {

				// Display errors
				$tpl->assign('error', $error);

				// Display Template
				$tpl->display('events-create.tpl');

			}

		} else {

			// Populate default date fields
			$startdate = date('m') . '-' . date('d') . '-' . date('Y');
			$tpl->assign('startdate', $startdate);

			// Display Template
			$tpl->display('events-create.tpl');

			// Disconnect from database
			$dbh->disconnect();
			exit();
		}

	break;

	# EDIT EVENT
	case "editevent":

		// Assign current side navigation
		$tpl->assign('eventscurrent', true);

		// Set form action
		$formaction = 'events.php?state=editevent&event=' . $_GET['event'];
		$tpl->assign('formaction', $formaction);

		// Get user workplace
		$sql = "SELECT workplace FROM users WHERE user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		$workplace_id = $row['workplace'];

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
				$tpl->assign('title', $_POST['title']);
			}

			// Check for a description
			$tpl->assign('description', $_POST['description']);

			// Check for a type
			$tpl->assign('type', $_POST['type']);
			$tpl->assign('typeother', $_POST['typeother']);

			// Check for a startdate
			if(empty($_POST['startdate']))
			{
				$error['startdate'] = 'A start date is required.';
			} else {
				$tpl->assign('startdate', $_POST['startdate']);
				$startdate = explode('-', $_POST['startdate']);
				$startmonth = $startdate[0];
				$startday = $startdate[1];
				$startyear = $startdate[2];
			}

			// Check for a start time
			$tpl->assign('starthour', $_POST['starthour']);
			$tpl->assign('startminute', $_POST['startminute']);
			$tpl->assign('startampm', $_POST['startampm']);

			// Check for an end time
			$tpl->assign('enddate', $_POST['enddate']);
			$enddate = explode('-', $_POST['enddate']);
			$endmonth = $enddate[0];
			$endday = $enddate[1];
			$endyear = $enddate[2];

			// Check for an end time
			$tpl->assign('endhour', $_POST['endhour']);
			$tpl->assign('endminute', $_POST['endminute']);
			$tpl->assign('endampm', $_POST['endampm']);

			// Check for a location
			$tpl->assign('location', $_POST['location']);

			// Check for a url
			$tpl->assign('url', $_POST['url']);
			if(isset($_POST['url'])){
				if(substr($_POST['url'], 0, 7) == "http://" || substr($_POST['url'], 0, 8) == "https://") $url=$_POST['url'];
				else $url = "http://".$_POST['url'];
			}
			else $url="";

			// Check for notes
			$tpl->assign('notes', $_POST['notes']);

			// Otherwise, display errors
			if(sizeof($error) == 0)
			{
				// Clean event date (YYYY-MM-DD HH:mm:SS)
				if(($_POST['startampm'] == 'am') && ($_POST['starthour'] == '12'))
				{
					$starthour = '00';
				} elseif (($_POST['startampm'] == 'pm') && ($_POST['starthour'] == '12')) {
					$starthour = '12';
				} elseif ($_POST['startampm'] == 'pm') {
					$starthour = $_POST['starthour'] + 12;
				} else {
					$starthour = $_POST['starthour'];
				}
				$startdate = $startyear . '-' . $startmonth . '-' . $startday . ' ' . $starthour . ':' . $_POST['startminute'] . ':00';
				if($_POST['enddate'])
				{
					if(($_POST['endampm'] == 'am') && ($_POST['endhour'] == '12'))
					{
						$endhour = '00';
					} elseif (($_POST['endampm'] == 'pm') && ($_POST['endhour'] == '12')) {
						$endhour = '12';
					} elseif ($_POST['endampm'] == 'pm') {
						$endhour = $_POST['endhour'] + 12;
					} else {
						$endhour = $_POST['endhour'];
					}
					$enddate = $endyear . '-' . $endmonth . '-' . $endday . ' ' . $endhour . ':' . $_POST['endminute'] . ':00';
				}

				// Insert event into database
				$sql = "UPDATE events SET
							title = '{$_POST['title']}',
							type = '{$_POST['type']}',
							typeother = '{$_POST['typeother']}',
							description = '{$_POST['description']}',
							location = '{$_POST['location']}',
							startdate = '$startdate',
							enddate = '$enddate',
							url = '{$url}',
							notes = '{$_POST['notes']}'
						WHERE
							event_id = '{$_GET['event']}'";
				$dbh->query($sql);

				// Redirect user
				header("Location: events.php?confirmation=editevent");

				// Disconnect from database
				$dbh->disconnect();
				exit();

			} else {

				// Display errors
				$tpl->assign('error', $error);

				// Display Template
				$tpl->display('events-create.tpl');

			}

		} else {

			// Get event values
			$sql = "SELECT
					event_id,
					user_id,
					title,
					type,
					typeother,
					description,
					location,
					DATE_FORMAT(startdate, '%m-%d-%Y') AS startdate,
					DATE_FORMAT(startdate, '%h:%i:%p') AS starttime,
					DATE_FORMAT(enddate, '%m-%d-%Y') AS enddate,
					DATE_FORMAT(enddate, '%h:%i:%p') AS endtime,
					url,
					notes
				FROM
					events
				WHERE
					workplace_id = '$workplace_id' AND event_id = '{$_GET['event']}'";
			$row = $dbh->queryRow($sql);

			// Clean times
			$starttime = explode(':', $row['starttime']);
			$tpl->assign('starthour', $starttime[0]);
			$tpl->assign('startminutes', $starttime[1]);
			$tpl->assign('startampm', strtolower($starttime[2]));
			$endtime = explode(':', $row['endtime']);
			$tpl->assign('endhour', $endtime[0]);
			$tpl->assign('endminutes', $endtime[1]);
			$tpl->assign('endampm', strtolower($endtime[2]));

			// Assign template values
			$tpl->assign('title', $row['title']);
			$tpl->assign('type', $row['type']);
			$tpl->assign('typeother', $row['typeother']);
			$tpl->assign('postedby', $postedby);
			$tpl->assign('description', $row['description']);
			$tpl->assign('location', $row['location']);
			$tpl->assign('startdate', $row['startdate']);
			$tpl->assign('enddate', $row['enddate']);
			$tpl->assign('url', $row['url']);
			$tpl->assign('notes', $row['notes']);
			$tpl->assign('user_id', $row['user_id']);

			// Display Template
			$tpl->display('events-create.tpl');

			// Disconnect from database
			$dbh->disconnect();
			exit();
		}

	break;

	# VIEW EVENT DETAILS
	case "viewdetails":

		// Assign current side navigation
		$tpl->assign('eventscurrent', true);

		// Get user workplace
		$sql = "SELECT workplace FROM users WHERE user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		$workplace_id = $row['workplace'];

		// Get detailed event information
		$sql = "SELECT
					event_id,
					user_id,
					title,
					type,
					typeother,
					description,
					location,
					DATE_FORMAT(startdate, '%M %d, %Y') AS startdate,
					DATE_FORMAT(startdate, '%h:%i%p') AS starttime,
					DATE_FORMAT(enddate, '%M %d, %Y') AS enddate,
					DATE_FORMAT(enddate, '%h:%i%p') AS endtime,
					url,
					notes
				FROM
					events
				WHERE
					workplace_id = '$workplace_id' AND event_id = '{$_GET['event']}'";
		$row = $dbh->queryRow($sql);

		// Get event submitter's name
		$sql2 = "SELECT firstname, lastname FROM users WHERE user_id = '{$row['user_id']}'";
		$row2 = $dbh->queryRow($sql2);
		$postedby = $row2['firstname'] . ' ' . $row2['lastname'];

		// Assign template values
		$tpl->assign('title', $row['title']);
		$tpl->assign('type', $row['type']);
		$tpl->assign('typeother', $row['typeother']);
		$tpl->assign('postedby', $postedby);
		$tpl->assign('description', nl2br($row['description']));
		$tpl->assign('location', $row['location']);
		$tpl->assign('startdate', $row['startdate']);
		$tpl->assign('starttime', $row['starttime']);
		$tpl->assign('enddate', $row['enddate']);
		$tpl->assign('endtime', $row['endtime']);
		$tpl->assign('url', $row['url']);
		$tpl->assign('notes', $row['notes']);
		$tpl->assign('user_id', $row['user_id']);

		// Display Template
		$tpl->display('events-viewdetails.tpl');

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

	# REMOVE EVENT
	case "removeevent":

		// Assign current side navigation
		$tpl->assign('eventscurrent', true);

		// Assign formaction
		$formaction = 'events.php?state=removeevent&event=' . $_GET['event'];
		$tpl->assign('formaction', $formaction);

		// Assign warning message
		$tpl->assign('warning', 'event');

		// If the yes button has been pressed
		if(isset($_POST['yes']))
		{
			// Check to make sure that this is the event owner
			$sql = "SELECT user_id FROM events WHERE event_id = '{$_GET['event']}'";
			$row = $dbh->queryRow($sql);
			if($row['user_id'] == $_SESSION['user_id'])
			{
				// Delete the event
				$sql = "DELETE FROM events WHERE event_id = '{$_GET['event']}' LIMIT 1";
				$dbh->query($sql);
			}

			// Redirect user
			$redirect = 'events.php?confirmation=removeevent';
			header("Location: $redirect");

			// Disconnect from database
			$dbh->disconnect();
			exit();
		}

		// If the yes button has been pressed
		if(isset($_POST['no']))
		{
			// Redirect user
			$redirect = 'events.php';
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

	# BROWSE EVENTS
	default:

		// Assign current side navigation
		$tpl->assign('eventscurrent', true);

		// Get user workplace
		$sql = "SELECT workplace FROM users WHERE user_id = '{$_SESSION['user_id']}'";
		$row = $dbh->queryRow($sql);
		$workplace_id = $row['workplace'];

		// Get current date
		$currentdate = date('Y') . '-' . date('m') . '-' . date('d');

		// Get events
		if((isset($_POST['submit'])) && ($_POST['search'] != ''))
		{
			// Searching - get all events with search term
			$sql = "SELECT
						event_id,
						user_id,
						title,
						type,
						DATE_FORMAT(startdate, '%M %d, %Y') AS startdate,
						DATE_FORMAT(startdate, '%h:%i%p') AS starttime,
						DATE_FORMAT(startdate, '%Y %m %d %H %i') AS fullstartdate,
						DATE_FORMAT(startdate, '%Y-%m-%d') AS abbrstartdate
					FROM
						events
					WHERE
						(title LIKE '%{$_POST['search']}%' OR
						description LIKE '%{$_POST['search']}%' OR
						type LIKE '%{$_POST['search']}%' OR
						typeother LIKE '%{$_POST['search']}%' OR
						description LIKE '%{$_POST['search']}%' OR
						location LIKE '%{$_POST['search']}%' OR
						notes LIKE '%{$_POST['search']}%' OR
						startdate LIKE '%{$_POST['search']}%' OR
						enddate LIKE '%{$_POST['search']}%' OR
						postedby LIKE '%{$_POST['search']}%'  )
						AND workplace_id = '$workplace_id' AND startdate >= '$currentdate'
					ORDER BY
						fullstartdate";

		} else {

			// No search - get all events
			$sql = "SELECT
						event_id,
						user_id,
						postedby,
						title,
						type,
						DATE_FORMAT(startdate, '%M %d, %Y') AS startdate,
						DATE_FORMAT(startdate, '%h:%i%p') AS starttime,
						DATE_FORMAT(startdate, '%Y %m %d %H %i') AS fullstartdate,
						DATE_FORMAT(startdate, '%Y-%m-%d') AS abbrstartdate
					FROM
						events
					WHERE
						workplace_id = '$workplace_id' AND startdate >= '$currentdate'
					ORDER BY
						fullstartdate";
		}
		$result = $dbh->query($sql);
		$counter = 1;
		while($row = $result->fetchRow())
		{

			// Check to see if user has edit and delete permissions
			if($row['user_id'] == $_SESSION['user_id'])
			{
				$editmode = true;
			} else {
				$editmode = false;
			}

			$events[] = array(
				'event_id' => $row['event_id'],
				'user_id' => $row['user_id'],
				'title' => $row['title'],
				'type' => ucfirst($row['type']),
				'startdate' => $row['startdate'],
				'starttime' => $row['starttime'],
				'editmode' => $editmode,
				'postedby' => $row['postedby'],
				'counter' => $counter
			);
			$counter++;
		}
		$tpl->assign('events', $events);

		// Display Template
		$tpl->display('events.tpl');

		// Disconnect from database
		$dbh->disconnect();
		exit();

	break;

}

?>