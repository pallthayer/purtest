<?php

#################################################################
# Name: cron_gasprices.php                                      #
# Description: Uploads current gas prices into database		    #
#################################################################

// Include configuration file
include_once('../config_path.php');
include_once($config_path.'config.php');

// Include common utility library
include_once($DIR['inc'] . 'Utils.class.php');

// Include database package
include_once($DIR['pear'] . 'MDB2.php');

// Initialize database connection
$dbh = Utils::initDB();

// Insert Leaders (by workplace)
function insertLeaders()
{

	global $dbh;
	
	// Default values for savings
	$milesnotdriven = 0;
	$carsoffroad = 0;
	
	// Get the current month and year (actually get last month since cron job runs on the first of every month)
	// So if we run the job on February 1st at midnight, we want to calculate all of January's data
	if(date("m") == 1)
	{
		$currentmonth = 12;
		$currentyear = date("Y") - 1;
	} else {
		$currentmonth = date("m") - 1;
		$currentyear = date("Y");
	}
	
	// Pad with a zero if under 10
	if($currentmonth < 10)
	{
		$currentmonth = '0' . $currentmonth;	
	}
	
	// Uncomment for manual override
	//$currentmonth = $_GET['month'];
	//$currentyear = $_GET['year'];
	

	// Get all pools
	$sql = "SELECT pool_id, title, workplace_id FROM pools ORDER BY pool_id";
	$result = $dbh->query($sql);
	while($row = $result->fetchRow())
	{
		$sql1 = "SELECT count(pool_id) AS totalpools FROM pools WHERE workplace_id = '{$row['workplace_id']}'";
		$row1 = $dbh->queryRow($sql1);
		$totalnumberofpools = $row1['totalpools'];
	
		$pool_id = $row['pool_id'];
		$title = $row['title'];
		$workplace_id = $row['workplace_id'];
		
		// Get number of pool members
		$sql2 = "SELECT user_id FROM poolmembers WHERE pool_id = '$pool_id' AND status = 'accepted'";
		$result2 = $dbh->query($sql2);
		$nummembers = $result2->numRows();
	
		// Get all members of the pool
		$sql4 = "SELECT user_id FROM poolmembers WHERE pool_id = '$pool_id' AND status = 'accepted'";
		$result4 = $dbh->query($sql4);
		while($row4 = $result4->fetchRow())
		{
			$user_id = $row4['user_id'];
			
			// Get pool member's name
			$sql5 = "SELECT firstname, lastname FROM users WHERE user_id = '$user_id'";
			$row5 = $dbh->queryRow($sql5);
			$membernames = $membernames . $row5['firstname'] . ' ' . $row5['lastname'] . ', ';
	
			// Get number of confirmed rides
			$sql6 = "SELECT 
						pool_id, 
						DATE_FORMAT(rdate, '%m') AS month, 
						DATE_FORMAT(rdate, '%Y') AS year, 
						rdate 
					FROM 
						poolpassengers 
					WHERE 
						pool_id = '$pool_id' AND user_id = '$user_id' AND confirm = 'accept' 
					ORDER BY 
						rdate";
			$result6 = $dbh->query($sql6);
			while($row6 = $result6->fetchRow())
			{
				//$pool_id = $row6['pool_id'];
				$rdate = $row6['rdate'];
				$month = $row6['month'];
				$year = $row6['year'];
	
				// If the ride occurs in the current month and year
				if(($year == $currentyear) && ($month == $currentmonth))
				{
	
					// Get the pool itinerary information
					$sql7 = "SELECT driver, route FROM poolitineraries WHERE pool_id = '$pool_id' AND rdate = '$rdate'";
					$row7 = $dbh->queryRow($sql7);
				
					$driver = $row7['driver'];
					$route = $row7['route'];
	
					// Get route distance
					$sql8 = "SELECT distance FROM poolroutes WHERE route_id = '$route'";
					$row8 = $dbh->queryRow($sql8);
				
					// Clean distance (1 meter = 0.000621371192 miles)
					$distance = round($row8['distance'] * 0.000621371192);

					// Check to make sure that a driver and a route has been designated for this ride
					if($driver && $route)
					{
				
						// Determine if user has driven
						if($driver != $user_id)
						{
		
							// Calculate miles not driven
							$milesnotdriven = $milesnotdriven + $distance;
						
							// Calculate cars off road
							$carsoffroad++;

						}
					} 
				}	
			}
		}
	
		// Calculate Purpool Index
		$w = 0.09;
		$purpoolindex = ($w*$milesnotdriven) + ((1-$w)*$carsoffroad);
				
		// Clean up member names (trim comma)
		if($membernames != '') { $membernames = substr($membernames,0,-2); }
		
		// Build cdate
		if($currentmonth < 10)
		{
			$ccurrentmonth = '0' . $currentmonth;
		} else {
			$ccurrentmonth = $currentmonth;
		}
		$cdate = $currentyear . '-' . $ccurrentmonth . '-' . '01';
						
		// Insert a record for this pool
		$sql9 = "INSERT INTO leaders (
					id, 
					pool_id,
					workplace_id, 
					cmonth, 
					cyear, 
					cdate,
					cindex, 
					ranking, 
					members, 
					shift
				) VALUES (
					null, 
					'$pool_id', 
					'$workplace_id',
					'$currentmonth', 
					'$currentyear', 
					'$cdate',
					'$purpoolindex', 
					'0', 
					'$membernames', 
					'0'
				)";
		$dbh->query($sql9);
		
		// Get all leaders for this month to update the ranking (order by the index in reverse so that the highest is first)
		$sql10 = "SELECT pool_id, workplace_id FROM leaders WHERE cmonth = '$currentmonth' AND cyear = '$currentyear' AND cindex != '0' ORDER BY workplace_id, cindex DESC";
		$result10 = $dbh->query($sql10);
		$ranking = 1;
		while($row10 = $result10->fetchRow())
		{
			// Reset ranking for each workplace
			if($previousworkplace != $row10['workplace_id'])
			{
				$ranking = 1;
			}
			
			// Update ranking based on ranking counter variable
			$sql11 = "UPDATE leaders SET ranking = '$ranking' WHERE pool_id = '{$row10['pool_id']}' AND cmonth = '$currentmonth' AND cyear = '$currentyear'";
			$dbh->query($sql11);
			$ranking++;
			
			// Set previous workplace
			$previousworkplace = $row10['workplace_id'];
		}
	
		// Getting ready to calculate the shift, but first we need to figure out the previous month and year
		if($currentmonth == 1)
		{
			$previousmonth = 12;
			$previousyear = $currentyear - 1;
		} else {
			$previousmonth = $currentmonth - 1;
			$previousyear = $currentyear;
		}
	
		if($previousmonth < 10)
		{
			$previousmonth = '0' . $previousmonth;
		}
		
		// Get current ranking
		$sql12 = "SELECT pool_id, ranking FROM leaders WHERE cmonth = '$currentmonth' AND cyear = '$currentyear' ORDER BY pool_id";
		$result12 = $dbh->query($sql12);
		while($row12 = $result12->fetchRow())
		{
			$currentranking = $row12['ranking'];
		
			// Get previous ranking
			$sql13 = "SELECT ranking FROM leaders WHERE cmonth = '$previousmonth' AND cyear = '$previousyear'  AND pool_id = '{$row12['pool_id']}' ORDER BY pool_id";
			$row13 = $dbh->queryRow($sql13);
			if($row13)
			{
				$previousranking = $row13['ranking'];
			} else {
				$previousranking = 0;
			}
			
			// Compare rankings (current vs previous)
			if($currentranking > $previousranking)
			{
				// Moved up in shift
				$shift = '+' . abs($currentranking - $previousranking);
			} elseif ($currentranking == $previousranking) {
				// Stayed the same in shift
				$shift = '0';
			} else {
				// Slacking off in shift
				$shift = '-' . abs($currentranking - $previousranking);
			}
			
			// Update shift to new shift value
			$sql14 = "UPDATE leaders SET shift = '$shift' WHERE cmonth = '$currentmonth' AND cyear = '$currentyear' AND pool_id = '{$row12['pool_id']}'";
			$dbh->query($sql14);
		}
		
		// Reset values
		$milesnotdriven = 0;
		$carsoffroad = 0;
		$membernames = '';
		
	}	
}

// Insert OverallLeaders
function insertOverallLeaders()
{

	global $dbh;
	
	// Default values for savings
	$milesnotdriven = 0;
	$carsoffroad = 0;
	
	// Get the current month and year (actually get last month since cron job runs on the first of every month)
	// So if we run the job on February 1st at midnight, we want to calculate all of January's data
	if(date("m") == 1)
	{
		$currentmonth = 12;
		$currentyear = date("Y") - 1;
	} else {
		$currentmonth = date("m") - 1;
		$currentyear = date("Y");
	}
	
	// Pad with a zero if under 10
	if($currentmonth < 10)
	{
		$currentmonth = '0' . $currentmonth;	
	}
	
	// Uncomment for manual override
	//$currentmonth = $_GET['month'];
	//$currentyear = $_GET['year'];

	// Get all pools
	$sql = "SELECT pool_id, title, workplace_id FROM pools ORDER BY pool_id";
	$result = $dbh->query($sql);
	while($row = $result->fetchRow())
	{
		$sql1 = "SELECT count(pool_id) AS totalpools FROM pools";
		$row1 = $dbh->queryRow($sql1);
		$totalnumberofpools = $row1['totalpools'];
	
		$pool_id = $row['pool_id'];
		$title = $row['title'];
		$workplace_id = $row['workplace_id'];
		
		// Get number of pool members
		$sql2 = "SELECT user_id FROM poolmembers WHERE pool_id = '$pool_id' AND status = 'accepted'";
		$result2 = $dbh->query($sql2);
		$nummembers = $result2->numRows();
	
		// Get all members of the pool
		$sql4 = "SELECT user_id FROM poolmembers WHERE pool_id = '$pool_id' AND status = 'accepted'";
		$result4 = $dbh->query($sql4);
		while($row4 = $result4->fetchRow())
		{
			$user_id = $row4['user_id'];
			
			// Get pool member's name
			$sql5 = "SELECT firstname, lastname FROM users WHERE user_id = '$user_id'";
			$row5 = $dbh->queryRow($sql5);
			$membernames = $membernames . $row5['firstname'] . ' ' . $row5['lastname'] . ', ';
	
			// Get number of confirmed rides
			$sql6 = "SELECT 
						pool_id, 
						DATE_FORMAT(rdate, '%m') AS month, 
						DATE_FORMAT(rdate, '%Y') AS year, 
						rdate 
					FROM 
						poolpassengers 
					WHERE 
						pool_id = '$pool_id' AND user_id = '$user_id' AND confirm = 'accept' 
					ORDER BY 
						rdate";
			$result6 = $dbh->query($sql6);
			while($row6 = $result6->fetchRow())
			{
				//$pool_id = $row6['pool_id'];
				$rdate = $row6['rdate'];
				$month = $row6['month'];
				$year = $row6['year'];
	
				// If the ride occurs in the current month and year
				if(($year == $currentyear) && ($month == $currentmonth))
				{
	
					// Get the pool itinerary information
					$sql7 = "SELECT driver, route FROM poolitineraries WHERE pool_id = '$pool_id' AND rdate = '$rdate'";
					$row7 = $dbh->queryRow($sql7);
				
					$driver = $row7['driver'];
					$route = $row7['route'];
	
					// Get route distance
					$sql8 = "SELECT distance FROM poolroutes WHERE route_id = '$route'";
					$row8 = $dbh->queryRow($sql8);
				
					// Clean distance (1 meter = 0.000621371192 miles)
					$distance = round($row8['distance'] * 0.000621371192);

					// Check to make sure that a driver and a route has been designated for this ride
					if($driver && $route)
					{
				
						// Determine if user has driven
						if($driver != $user_id)
						{
		
							// Calculate miles not driven
							$milesnotdriven = $milesnotdriven + $distance;
						
							// Calculate cars off road
							$carsoffroad++;

						}
					} 
				}	
			}
		}
	
		// Calculate Purpool Index
		$w = 0.09;
		$purpoolindex = ($w*$milesnotdriven) + ((1-$w)*$carsoffroad);
				
		// Clean up member names (trim comma)
		if($membernames != '') { $membernames = substr($membernames,0,-2); }
		
		// Build cdate
		if($currentmonth < 10)
		{
			$ccurrentmonth = '0' . $currentmonth;
		} else {
			$ccurrentmonth = $currentmonth;
		}
		$cdate = $currentyear . '-' . $ccurrentmonth . '-' . '01';
						
		// Insert a record for this pool
		$sql9 = "INSERT INTO leaders_overall (
					id, 
					pool_id,
					workplace_id, 
					cmonth, 
					cyear, 
					cdate,
					cindex, 
					ranking, 
					members, 
					shift
				) VALUES (
					null, 
					'$pool_id', 
					'$workplace_id',
					'$currentmonth', 
					'$currentyear', 
					'$cdate',
					'$purpoolindex', 
					'0', 
					'$membernames', 
					'0'
				)";
		$dbh->query($sql9);
		
		// Get all leaders for this month to update the ranking (order by the index in reverse so that the highest is first)
		$sql10 = "SELECT pool_id, workplace_id FROM leaders_overall WHERE cmonth = '$currentmonth' AND cyear = '$currentyear' AND cindex != '0' ORDER BY cindex DESC";
		$result10 = $dbh->query($sql10);
		$ranking = 1;
		while($row10 = $result10->fetchRow())
		{
			
			// Update ranking based on ranking counter variable
			$sql11 = "UPDATE leaders_overall SET ranking = '$ranking' WHERE pool_id = '{$row10['pool_id']}' AND cmonth = '$currentmonth' AND cyear = '$currentyear'";
			$dbh->query($sql11);
			$ranking++;
			
		}
	
		// Getting ready to calculate the shift, but first we need to figure out the previous month and year
		if($currentmonth == 1)
		{
			$previousmonth = 12;
			$previousyear = $currentyear - 1;
		} else {
			$previousmonth = $currentmonth - 1;
			$previousyear = $currentyear;
		}
		
		if($previousmonth < 10)
		{
			$previousmonth = '0' . $previousmonth;
		}
		
		// Get current ranking
		$sql12 = "SELECT pool_id, ranking FROM leaders_overall WHERE cmonth = '$currentmonth' AND cyear = '$currentyear' ORDER BY pool_id";
		$result12 = $dbh->query($sql12);
		while($row12 = $result12->fetchRow())
		{
			$currentranking = $row12['ranking'];
		
			// Get previous ranking
			$sql13 = "SELECT ranking FROM leaders_overall WHERE cmonth = '$previousmonth' AND cyear = '$previousyear'  AND pool_id = '{$row12['pool_id']}' ORDER BY pool_id";
			$row13 = $dbh->queryRow($sql13);
			if($row13)
			{
				$previousranking = $row13['ranking'];
			} else {
				$previousranking = 0;
			}
			
			// Compare rankings (current vs previous)
			if($currentranking > $previousranking)
			{
				// Moved up in shift
				$shift = '+' . abs($currentranking - $previousranking);
			} elseif ($currentranking == $previousranking) {
				// Stayed the same in shift
				$shift = '0';
			} else {
				// Slacking off in shift
				$shift = '-' . abs($currentranking - $previousranking);
			}
			
			// Update shift to new shift value
			$sql14 = "UPDATE leaders_overall SET shift = '$shift' WHERE cmonth = '$currentmonth' AND cyear = '$currentyear' AND pool_id = '{$row12['pool_id']}'";
			$dbh->query($sql14);
		}
		
		// Reset values
		$milesnotdriven = 0;
		$carsoffroad = 0;
		$membernames = '';
		
	}	
}

// Call functions
insertLeaders();
insertOverallLeaders();

// Check to make sure that the query is successful
if (PEAR::isError($result)) 
{
	$message = 'Purpool may have encountered an error in updating leaders: ' . $tomorrow . '.' . "\n\n";
	$message = $message . 'The database returned the following error: ' . $result->getMessage(); 
	mail($MISC['admin_email'], 'Purpool Error: Confirmation emails', $message, "From: ".$MISC['admin_email']);
}

?>

