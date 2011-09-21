<?php

#################################################################
# Name: visdata.php      		                                #
# Author: John Kuiphoff                                         #
# Description: Calculates visualization information			    #
#################################################################

// Get total user savings (profile cummulative savings box)
function getUserSavings($user_id)
{

	global $dbh;
	
	// Default values for my savings
	$gassavings = 0;
	$emissionssavings = 0;
	$milesnotdriven = 0;
	$carsoffroad = 0;
	
	// Get users workplace
	$sql = "SELECT workplace FROM users WHERE user_id = '$user_id'";
	$row = $dbh->queryRow($sql);
	
	$workplace = $row['workplace'];
	
	// Get users workplace information
	$sql = "SELECT state FROM workplaces WHERE workplace_id = '$workplace'";
	$row = $dbh->queryRow($sql);
	
	$state = $row['state'];
	
	// Get the users car and location information
	$sql = "SELECT vehiclempg, vehicleco2 FROM users WHERE user_id = '$user_id'";
	$row = $dbh->queryRow($sql);
	
	if($row)
	{
		$mpg = $row['vehiclempg'];
		$co2 = $row['vehicleco2'];
	} else {
		$mpg = 0;
		$co2 = 0;
	}
	
	// Get current date
	$currentdate = date("Y") . '-' . date("m") . '-' . date("d");
	
	// Get number of confirmed rides
	$sql = "SELECT 
				pool_id, 
				DATE_FORMAT(rdate, '%v') AS week, 
				DATE_FORMAT(rdate, '%Y') AS year, 
				rdate 
			FROM 
				poolpassengers 
			WHERE 
				user_id = '$user_id' AND rdate <= '$currentdate' AND confirm = 'accept'
			ORDER BY rdate";
	$result = $dbh->query($sql);
	while($row = $result->fetchRow())
	{
		$pool_id = $row['pool_id'];
		$rdate = $row['rdate'];
		$week = $row['week'];
		$year = $row['year'];
		
		// Get the pool itinerary information
		$sql2 = "SELECT driver, route FROM poolitineraries WHERE pool_id = '$pool_id' AND rdate = '$rdate'";
		$row2 = $dbh->queryRow($sql2);
		
		$driver = $row2['driver'];
		$route = $row2['route'];
		
		// Get route distance
		$sql3 = "SELECT distance FROM poolroutes WHERE route_id = '{$row2['route']}'";
		$row3 = $dbh->queryRow($sql3);
		
		// Clean distance (1 meter = 0.000621371192 miles)
		$distance = round($row3['distance'] * 0.000621371192);

		// Get week number and year that rdate occurs on
		$gasdate = $week . '|' . $year;
	
		// Get gas prices for the week
		$sql4 = "SELECT $state AS gasprices FROM gasprices WHERE uploaddate = '$gasdate'";
		$row4 = $dbh->queryRow($sql4);
		
		// If there are no gas prices posted, get last weeks price (to prevent complete visualization error)
		if(!$row4)
		{
			$sql4 = "SELECT $state AS gasprices FROM gasprices ORDER BY uploaddate DESC LIMIT 1";
			$row4 = $dbh->queryRow($sql4);
		}
		
		// Clean gas data (get 'regular' price)
		$gasprices = explode(",", $row4['gasprices']);
		$gasprice = $gasprices[0];
	
		// Check to make sure that a driver and a route has been designated for this ride
		if($driver && $route)
		{
		
			// Determine if user has driven
			if($driver != $user_id)
			{
				// Calculate savings in gas and emissions
				if($mpg == 0)
				{
					$gassavings = $gassavings + 0;
					$emissionssavings = $emissionssavings + 0;
				} else {
					$gassavings = $gassavings + ($distance * ($gasprice / $mpg));
					$emissionssavings = $emissionssavings + ($distance * $co2);
				}
				
				// Calculate miles not driven
				$milesnotdriven = $milesnotdriven + $distance;
				
				// Calculate cars off road
				$carsoffroad++;
			} 
		
		}
	}
	
	// Format gas savings
	$gassavings = '$' . number_format($gassavings*2, 2);
	
	// Create savings array
	$usersavings['gas'] = $gassavings;
	$usersavings['miles'] = $milesnotdriven*2;
	$usersavings['cars'] = $carsoffroad;
	$usersavings['emissions'] = $emissionssavings*2;
	
	return $usersavings;
	
}

// Get user savings for the current week (profile current week box)
function getUserSavingsForWeek($user_id)
{

	global $dbh;
	
	// Default values for my savings
	$gassavings = 0;
	$emissionssavings = 0;
	$milesnotdriven = 0;
	$carsoffroad = 0;
	
	// Get current date
	$currentdate = date("Y") . '-' . date("m") . '-' . date("d");
	
	// Get users workplace
	$sql = "SELECT workplace FROM users WHERE user_id = '$user_id'";
	$row = $dbh->queryRow($sql);
	
	$workplace = $row['workplace'];
	
	// Get users workplace information
	$sql = "SELECT state FROM workplaces WHERE workplace_id = '$workplace'";
	$row = $dbh->queryRow($sql);
	
	$state = $row['state'];
	
	// Get the users car and location information
	$sql = "SELECT vehiclempg, vehicleco2 FROM users WHERE user_id = '$user_id'";
	$row = $dbh->queryRow($sql);
	
	if($row)
	{
		$mpg = $row['vehiclempg'];
		$co2 = $row['vehicleco2'];
	} else {
		$mpg = 0;
		$co2 = 0;
	}
	
	// Get current week and year
	$currentweek = date('W');
	$currentyear = date('Y');
	
	// Get number of confirmed rides
	$sql = "SELECT pool_id, DATE_FORMAT(rdate, '%v') AS week, DATE_FORMAT(rdate, '%Y') AS year, rdate 
	FROM poolpassengers WHERE user_id = '$user_id' AND rdate <= '$currentdate' AND confirm = 'accept' ORDER BY rdate";
	$result = $dbh->query($sql);
	while($row = $result->fetchRow())
	{
		// If it occurs on the current week
		if(($row['week'] == $currentweek) && ($row['year'] == $currentyear))
		{
			$pool_id = $row['pool_id'];
			$rdate = $row['rdate'];
			$week = $row['week'];
			$year = $row['year'];
			
			// Get the pool itinerary information
			$sql2 = "SELECT driver, route FROM poolitineraries WHERE pool_id = '$pool_id' AND rdate = '$rdate'";
			$row2 = $dbh->queryRow($sql2);
			
			$driver = $row2['driver'];
			$route = $row2['route'];
			
			// Get route distance
			$sql3 = "SELECT distance FROM poolroutes WHERE route_id = '{$row2['route']}'";
			$row3 = $dbh->queryRow($sql3);
			
			// Clean distance (1 meter = 0.000621371192 miles)
			$distance = round($row3['distance'] * 0.000621371192);
	
			// Get week number and year that rdate occurs on
			$gasdate = $week . '|' . $year;
			
			// Get gas prices for the week
			$sql4 = "SELECT $state AS gasprices FROM gasprices WHERE uploaddate = '$gasdate'";
			$row4 = $dbh->queryRow($sql4);
			
			// If there are no gas prices posted, get last weeks price (to prevent complete visualization error)
			if(!$row4)
			{
				$sql4 = "SELECT $state AS gasprices FROM gasprices ORDER BY uploaddate DESC LIMIT 1";
				$row4 = $dbh->queryRow($sql4);
			}
			
			// Clean gas data (get 'regular' price)
			$gasprices = explode(",", $row4['gasprices']);
			$gasprice = $gasprices[0];
			
			// Check to make sure that a driver and a route has been designated for this ride
			if($driver && $route)
			{
				
				// Determine if user has driven
				if($driver != $user_id)
				{
					// Calculate savings in gas and emissions
					if($mpg == 0)
					{
						$gassavings = $gassavings + 0;
						$emissionssavings = $emissionssavings + 0;
					} else {
						$gassavings = $gassavings + ($distance * ($gasprice / $mpg));
						$emissionssavings = $emissionssavings + ($distance * $co2);
					}
					
					// Calculate miles not driven
					$milesnotdriven = $milesnotdriven + $distance;
					
					// Calculate cars off road
					$carsoffroad++;
				}
			
			}
			
		}
	}
	
	// Format gas savings
	$gassavings = '$' . number_format($gassavings*2, 2);
	
	// Create savings array
	$weekusersavings['gas'] = $gassavings;
	$weekusersavings['miles'] = $milesnotdriven*2;
	$weekusersavings['cars'] = $carsoffroad;
	$weekusersavings['emissions'] = $emissionssavings*2;
	
	return $weekusersavings;
	
}

// Get user savings by week (linechart)
function getUserSavingsByWeek($user_id)
{

	global $dbh;
	
	// Get current date
	$currentdate = date("Y") . '-' . date("m") . '-' . date("d");
	
	// Start XML string
	$xml = '<?xml version="1.0" encoding="UTF-8"?>';
	$xml = $xml . '<savings>';
	
	// Define beginning week
	$startWeek  = mktime(0, 0, 0, 10, 06, 2008);
	
	// Get current week
	$currentWeek  = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
	
	// Calculate difference of startweek and current week (in seconds)
	$numSeconds = $currentWeek - $startWeek;
	
	// Find out how many weeks have elapsed
	$numWeeks = floor($numSeconds / 604800); 
	
	// Build week array
	for($i = 0; $i < $numWeeks+2; $i++)
	{
		// Calculate the week	
		$weekCalc =  strtotime(date("r", mktime(04, 0, 0, 10, 06, 2008)) . "+" . $i . " week");
		$weekDate =  date('m/d/Y', $weekCalc);
		
		// Create default (empty) values for each week - these may get overridden depending on activity
		$gassavingsweek[$weekDate] = 0;
		$emissionssavingsweek[$weekDate] = 0;
		$milesnotdrivenweek[$weekDate] = 0;
		$carsoffroadweek[$weekDate] = 0;
		$weekstart2[$weekDate] = $weekDate;
	}
	
	// Default values for my savings
	$gassavings = 0;
	$emissionssavings = 0;
	$milesnotdriven = 0;
	$carsoffroad = 0;

	// Get users workplace
	$sql = "SELECT workplace FROM users WHERE user_id = '$user_id'";
	$row = $dbh->queryRow($sql);
	
	$workplace = $row['workplace'];
	
	// Get users workplace information
	$sql = "SELECT state FROM workplaces WHERE workplace_id = '$workplace'";
	$row = $dbh->queryRow($sql);
	
	$state = $row['state'];
	
	// Get the users car and location information
	$sql = "SELECT vehiclempg, vehicleco2 FROM users WHERE user_id = '$user_id'";
	$row = $dbh->queryRow($sql);
	
	if($row)
	{
		$mpg = $row['vehiclempg'];
		$co2 = $row['vehicleco2'];
	} else {
		$mpg = 0;
		$co2 = 0;
	}
	
	// Get number of confirmed rides
	$sql = "SELECT pool_id, DATE_FORMAT(rdate, '%v') AS week, DATE_FORMAT(rdate, '%Y') AS year, rdate FROM poolpassengers WHERE user_id = '$user_id' AND rdate <= '$currentdate' AND confirm = 'accept' ORDER BY rdate";
	$result = $dbh->query($sql);
	while($row = $result->fetchRow())
	{
		$pool_id = $row['pool_id'];
		$rdate = $row['rdate'];
		$week = $row['week'];
		$year = $row['year'];
		
		// Get date of week start
		$datemonday = date("m/d/Y", strtotime("{$year}-W{$week}-1"));
		$datesunday = date("m/d/Y", strtotime("{$year}-W{$week}-7"));
		
		// Reset values if we are entering a different week
		if($lastvalue != $datemonday)
		{
			// Reset values
			$gassavings = 0;
			$emissionssavings = 0;
			$milesnotdriven = 0;
			$carsoffroad = 0;
		}
		
		// Get the pool itinerary information
		$sql2 = "SELECT driver, route FROM poolitineraries WHERE pool_id = '$pool_id' AND rdate = '$rdate'";
		$row2 = $dbh->queryRow($sql2);
		
		$driver = $row2['driver'];
		$route = $row2['route'];
		
		// Get route distance
		$sql3 = "SELECT distance FROM poolroutes WHERE route_id = '{$row2['route']}'";
		$row3 = $dbh->queryRow($sql3);
		
		// Clean distance (1 meter = 0.000621371192 miles)
		$distance = round($row3['distance'] * 0.000621371192);

		// Get week number and year that rdate occurs on
		$gasdate = $week . '|' . $year;
		
		// Get gas prices for the week
		$sql4 = "SELECT $state AS gasprices FROM gasprices WHERE uploaddate = '$gasdate'";
		$row4 = $dbh->queryRow($sql4);
		
		// If there are no gas prices posted, get last weeks price (to prevent complete visualization error)
		if(!$row4)
		{
			$sql4 = "SELECT $state AS gasprices FROM gasprices ORDER BY uploaddate DESC LIMIT 1";
			$row4 = $dbh->queryRow($sql4);
		}
		
		// Clean gas data (get 'regular' price)
		$gasprices = explode(",", $row4['gasprices']);
		$gasprice = $gasprices[0];
		
		// Check to make sure that a driver and a route has been designated for this ride
		if($driver && $route)
		{
		
			// Determine if user has driven
			if($driver != $user_id)
			{
				
				// Calculate savings in gas
				$gassavingsweek[$datemonday] += ($distance * ($gasprice / $mpg));
				
				// Calculate emissions
				$emissionssavingsweek[$datemonday] = $emissonssavings[$datemonday] + ($distance * $co2);
				
				// Calculate miles not driven
				$milesnotdrivenweek[$datemonday] += $distance;
				
				// Calculate cars off road
				$carsoffroadweek[$datemonday]++;
				
				// Append dates to array
				$weekstart2[$datemonday] = $datemonday;
				$weekend2[$datemonday] = $datesunday;
				$week2[$datemonday] = $week;
				
				$lastvalue = $datemonday;
	
			} 
		
		}
	}
	
	// Create savings array
	foreach ($gassavingsweek as $key => $value)
	{
		$savings[$key] = array(
			'weekstart' => $weekstart2[$key],
			'weekend' => $weekend2[$key],
			'week' => $week2[$key],
			'gas' =>  number_format($value * 2, 2),
			'miles' => $milesnotdrivenweek[$key] * 2,
			'car' => $carsoffroadweek[$key],
			'emissions' => $emissionssavingsweek[$key] * 2
		);
		
		// Print XML
		$xml = $xml . '<week start="' . $savings[$key]['weekstart'] . '" end="' . $savings[$key]['weekend'] . '" number="' . $savings[$key]['week'] . '">';
		$xml = $xml . '<savings_in_gas>' . $savings[$key]['gas'] . '</savings_in_gas>';
		$xml = $xml . '<miles_not_driven>' . $savings[$key]['miles'] . '</miles_not_driven>';
		$xml = $xml . '<cars_off_the_road>' . $savings[$key]['car'] . '</cars_off_the_road>';
		$xml = $xml . '<savings_in_co2>' . $savings[$key]['emissions'] . '</savings_in_co2>';
		$xml = $xml . '</week>';
	}
	
	// Print xml
	$xml = $xml . '</savings>';

	return $xml;
}

// Stacked chart
function getGlobalSavings($workplace)
{
	global $dbh;
	
	// Get current date
	$currentdate = date("Y") . '-' . date("m") . '-' . date("d");
	
	// Start XML string
	$xml = '<?xml version="1.0" encoding="UTF-8"?>';
	$xml = $xml . '<stacked_chart>';
	
	// Define beginning week
	$startWeek  = mktime(0, 0, 0, 10, 6, 2008);
	
	// Get current week
	$currentWeek  = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
	
	// Calculate difference of startweek and current week (in seconds)
	$numSeconds = $currentWeek - $startWeek;
	
	// Find out how many weeks have elapsed
	$numWeeks = floor($numSeconds / 604800); 
	
	// Build week array
	for($i = 0; $i < $numWeeks+2; $i++)
	{
		// Calculate the week	
		$weekCalc =  strtotime(date("r", mktime(04, 0, 0, 10, 06, 2008)) . "+" . $i . " week");
		$weekDate =  date('m/d/Y', $weekCalc);
		$weeksString = $weeksString . $weekDate . ', ';
	}
	// Get rid of extra comma
	$weeksString = substr($weeksString,'', -2);
	
	// Add weeks element to xml string
	$xml = $xml . '<weeks>' . $weeksString . '</weeks>';
	
	// Get all pools
	$sql = "SELECT pool_id, title FROM pools WHERE workplace_id = '$workplace'";
	$result = $dbh->query($sql);
	while($row = $result->fetchRow())
	{
		// Define pool id and title
		$pool_id = $row['pool_id'];
		$title = $row['title'];
		
		// Reset values
		$milesnotdriven = 0;
		$carsoffroad = 0;
		for($i = 0; $i < $numWeeks+2; $i++)
		{
			// Calculate the week	
			$weekCalc =  strtotime(date("r", mktime(04, 0, 0, 10, 06, 2008)) . "+" . $i . " week");
			$weekDate =  date('m/d/Y', $weekCalc);
			$milesnotdrivenweek[$weekDate] = 0;
			$carsoffroadweek[$weekDate] = 0;
			$purpoolindex[$weekDate] = 0;
		}
		
		// Get number of members for this pool
		$sql2 = "SELECT user_id FROM poolmembers WHERE pool_id = '$pool_id' AND status = 'accepted'";
		$result2 = $dbh->query($sql2);
		$nummembers = $result2->numRows();
		
		// Get the user_ids for everyone in the pool
		$sql2 = "SELECT user_id FROM poolmembers WHERE pool_id = '$pool_id' AND status = 'accepted'";
		$result2 = $dbh->query($sql2);
		while($row2 = $result2->fetchRow())
		{
			$user_id = $row2['user_id'];
			
			// Get number of confirmed rides
			$sql9 = "SELECT 
						pool_id, 
						DATE_FORMAT(rdate, '%u') AS week, 
						DATE_FORMAT(rdate, '%Y') AS year, 
						rdate 
					FROM 
						poolpassengers 
					WHERE 
						user_id = '$user_id' AND rdate <= '$currentdate' AND pool_id = '$pool_id' AND confirm = 'accept' 
					ORDER BY 
						rdate";
			$result9 = $dbh->query($sql9);
			while($row9 = $result9->fetchRow())
			{
				$pool_id = $row9['pool_id'];
				$rdate = $row9['rdate'];
				$week = $row9['week'];
				$year = $row9['year'];
	
				// Get date of week start
				$datemonday = date("m/d/Y", strtotime("{$year}-W{$week}-1"));
				$datesunday = date("m/d/Y", strtotime("{$year}-W{$week}-7"));

				// Reset values if we are starting a new week
				if($lastvalue != $datemonday)
				{
					// Reset values
					$milesnotdriven = 0;
					$carsoffroad = 0;
				}
				
				// Get the pool itinerary information
				$sql2 = "SELECT driver, route FROM poolitineraries WHERE pool_id = '$pool_id' AND rdate = '$rdate'";
				$row2 = $dbh->queryRow($sql2);
				
				$driver = $row2['driver'];
				$route = $row2['route'];
				
				// Get route distance
				$sql3 = "SELECT distance FROM poolroutes WHERE route_id = '{$row2['route']}'";
				$row3 = $dbh->queryRow($sql3);
				
				// Clean distance (1 meter = 0.000621371192 miles)
				$distance = round($row3['distance'] * 0.000621371192);
				
				// Check to make sure that a driver and a route has been designated for this ride
				if($driver && $route)
				{
				
					// Determine if user has driven
					if($driver != $user_id)
					{
	
						// Calculate miles not driven
						$milesnotdrivenweek[$datemonday] += $distance;
						
						// Calculate cars off road
						$carsoffroadweek[$datemonday]++;
						
						// Calculate Purpool Index
						$w = 0.09;
						$purpoolindex[$datemonday] = ($w*$milesnotdrivenweek[$datemonday]) + ((1-$w)*$carsoffroadweek[$datemonday]);
		
						// Append dates to array
						$weekstart2[$datemonday] = $datemonday;
						$weekend2[$datemonday] = $datesunday;
						$week2[$datemonday] = $week;
						
						$lastvalue = $datemonday;
						
					} 
				}
			}
		}	
		
		// Build XML string
		$xml = $xml . '<pool name="' . htmlentities($title) . '" members="' . $nummembers . '" cars_off_road="' . $carsoffroadweek[$datemonday] . '"  index="' . $purpoolindex[$datemonday] * 2 . '">';
		
		// Start miles XML node
		$xml = $xml . '<miles_not_driven>';
		
		// Loop through miles array and create xml string
		foreach ($milesnotdrivenweek as $key => $value)
		{
			$xml = $xml . $value . ', ';
		}
		
		// Get rid of extra comma
		$xml = substr($xml,intval(''), -2);
		
		// End miles XML node
		$xml = $xml . '</miles_not_driven>';
		
		// End pool node
		$xml = $xml . '</pool>';
			
	}	
	
	// End stacked chart node
	$xml = $xml . '</stacked_chart>';
	
	return $xml;
}

// Get total pool savings (pool cummulative savings box)
function getPoolSavings($pool_id)
{

	global $dbh;
	
	// Default values for my savings
	$gassavings = 0;
	$emissionssavings = 0;
	$milesnotdriven = 0;
	$carsoffroad = 0;
	
	// Get current date
	$currentdate = date("Y") . '-' . date("m") . '-' . date("d");
	
	// Get pools workplace
	$sql = "SELECT workplace_id FROM pools WHERE pool_id = '$pool_id'";
	$row = $dbh->queryRow($sql);
	
	$workplace = $row['workplace_id'];
	
	// Get users workplace information
	$sql = "SELECT state FROM workplaces WHERE workplace_id = '$workplace'";
	$row = $dbh->queryRow($sql);
	
	$state = $row['state'];
	
	// Get all members of the pool
	$sql = "SELECT user_id FROM poolmembers WHERE pool_id = '$pool_id' AND status = 'accepted'";
	$result = $dbh->query($sql);
	while($row = $result->fetchRow())
	{
		$user_id = $row['user_id'];
	
		// Get the users car and location information
		$sql = "SELECT vehiclempg, vehicleco2 FROM users WHERE user_id = '$user_id'";
		$row = $dbh->queryRow($sql);
		
		if($row)
		{
			$mpg = $row['vehiclempg'];
			$co2 = $row['vehicleco2'];
		} else {
			$mpg = 0;
			$co2 = 0;
		}
		
		// Get number of confirmed rides
		$sql2 = "SELECT pool_id, DATE_FORMAT(rdate, '%v') AS week, DATE_FORMAT(rdate, '%Y') AS year, rdate FROM poolpassengers 
		WHERE user_id = '$user_id' AND rdate <= '$currentdate' AND pool_id = '$pool_id' AND confirm = 'accept' ORDER BY rdate";
		$result2 = $dbh->query($sql2);
		while($row2 = $result2->fetchRow())
		{
			
			$pool_id = $row2['pool_id'];
			$rdate = $row2['rdate'];
			$week = $row2['week'];
			$year = $row2['year'];
	
			// Get the pool itinerary information
			$sql3 = "SELECT driver, route FROM poolitineraries WHERE pool_id = '$pool_id' AND rdate = '$rdate'";
			$row3 = $dbh->queryRow($sql3);
		
			$driver = $row3['driver'];
			$route = $row3['route'];
		
			// Get route distance
			$sql4 = "SELECT distance FROM poolroutes WHERE route_id = '{$row3['route']}'";
			$row4 = $dbh->queryRow($sql4);
		
			// Clean distance (1 meter = 0.000621371192 miles)
			$distance = round($row4['distance'] * 0.000621371192);
	
			// Get week number and year that rdate occurs on
			$gasdate = $week . '|' . $year;
	
			// Get gas prices for the week
			$sql5 = "SELECT $state AS gasprices FROM gasprices WHERE uploaddate = '$gasdate'";
			$row5 = $dbh->queryRow($sql5);
		
			// If there are no gas prices posted, get last weeks price (to prevent complete visualization error)
			if(!$row5)
			{
				$sql5 = "SELECT $state AS gasprices FROM gasprices ORDER BY uploaddate DESC LIMIT 1";
				$row5 = $dbh->queryRow($sql5);
			}
		
			// Clean gas data (get 'regular' price)
			$gasprices = explode(",", $row5['gasprices']);
			$gasprice = $gasprices[0];
	
			// Check to make sure that a driver and a route has been designated for this ride
			if($driver && $route)
			{
				// Determine if user has driven
				if($driver != $user_id)
				{
					// Calculate savings in gas
					$gassavings = $gassavings + ($distance * ($gasprice / $mpg));
				
					// Calculate emissions
					$emissionssavings = $emissionssavings + ($distance * $co2);
				
					// Calculate miles not driven
					$milesnotdriven = $milesnotdriven + $distance;
					
					// Calculate cars off road
					$carsoffroad++;
				}
				
			}

		}
		
	}
	
	// Format gas savings
	$gassavings = '$' . number_format($gassavings*2, 2);
	
	// Create savings array
	$poolsavings['gas'] = $gassavings;
	$poolsavings['miles'] = $milesnotdriven * 2;
	$poolsavings['cars'] = $carsoffroad;
	$poolsavings['emissions'] = $emissionssavings * 2;
	
	return $poolsavings;
			
}

// Get pool savings for the current week (pool current week box)
function getPoolSavingsForWeek($pool_id)
{

	global $dbh;
	
	// Default values for my savings
	$gassavings = 0;
	$emissionssavings = 0;
	$milesnotdriven = 0;
	$carsoffroad = 0;
	
	// Get current date
	$currentdate = date("Y") . '-' . date("m") . '-' . date("d");
	
	// Get current week and year
	$currentweek = date('W');
	$currentyear = date('Y');
	
	// Get pools workplace
	$sql = "SELECT workplace_id FROM pools WHERE pool_id = '$pool_id'";
	$row = $dbh->queryRow($sql);
	
	$workplace = $row['workplace_id'];
	
	// Get users workplace information
	$sql = "SELECT state FROM workplaces WHERE workplace_id = '$workplace'";
	$row = $dbh->queryRow($sql);
	
	$state = $row['state'];
	
	// Get all members of the pool
	$sql = "SELECT user_id FROM poolmembers WHERE pool_id = '$pool_id' AND status = 'accepted'";
	$result = $dbh->query($sql);
	while($row = $result->fetchRow())
	{
		$user_id = $row['user_id'];
	
		// Get the users car and location information
		$sql = "SELECT vehiclempg, vehicleco2 FROM users WHERE user_id = '$user_id'";
		$row = $dbh->queryRow($sql);
		
		if($row)
		{
			$mpg = $row['vehiclempg'];
			$co2 = $row['vehicleco2'];
		} else {
			$mpg = 0;
			$co2 = 0;
		}
		
		// Get number of confirmed rides
		$sql2 = "SELECT pool_id, DATE_FORMAT(rdate, '%v') AS week, DATE_FORMAT(rdate, '%Y') AS year, rdate FROM poolpassengers 
		WHERE user_id = '$user_id' AND rdate <= '$currentdate' AND pool_id = '$pool_id' AND confirm = 'accept' ORDER BY rdate";
		$result2 = $dbh->query($sql2);
		while($row2 = $result2->fetchRow())
		{
			// If it occurs on the current week
			if(($row2['week'] == $currentweek) && ($row2['year'] == $currentyear))
			{
			
				$pool_id = $row2['pool_id'];
				$rdate = $row2['rdate'];
				$week = $row2['week'];
				$year = $row2['year'];
		
				// Get the pool itinerary information
				$sql3 = "SELECT driver, route FROM poolitineraries WHERE pool_id = '$pool_id' AND rdate = '$rdate'";
				$row3 = $dbh->queryRow($sql3);
			
				$driver = $row3['driver'];
				$route = $row3['route'];
			
				// Get route distance
				$sql4 = "SELECT distance FROM poolroutes WHERE route_id = '{$row3['route']}'";
				$row4 = $dbh->queryRow($sql4);
			
				// Clean distance (1 meter = 0.000621371192 miles)
				$distance = round($row4['distance'] * 0.000621371192);
		
				// Get week number and year that rdate occurs on
				$gasdate = $week . '|' . $year;
		
				// Get gas prices for the week
				$sql5 = "SELECT $state AS gasprices FROM gasprices WHERE uploaddate = '$gasdate'";
				$row5 = $dbh->queryRow($sql5);
			
				// If there are no gas prices posted, get last weeks price (to prevent complete visualization error)
				if(!$row5)
				{
					$sql5 = "SELECT $state AS gasprices FROM gasprices ORDER BY uploaddate DESC LIMIT 1";
					$row5 = $dbh->queryRow($sql5);
				}
			
				// Clean gas data (get 'regular' price)
				$gasprices = explode(",", $row5['gasprices']);
				$gasprice = $gasprices[0];
		
				// Check to make sure that a driver and a route has been designated for this ride
				if($driver && $route)
				{
					// Determine if user has driven
					if($driver != $user_id)
					{
						// Calculate savings in gas
						$gassavings = $gassavings + ($distance * ($gasprice / $mpg));
					
						// Calculate emissions
						$emissionssavings = $emissionssavings + ($distance * $co2);
					
						// Calculate miles not driven
						$milesnotdriven = $milesnotdriven + $distance;
						
						// Calculate cars off road
						$carsoffroad++;
					} 
				}
			}
		}	
	}
	
	// Format gas savings
	$gassavings = '$' . number_format($gassavings * 2, 2);
	
	// Create savings array
	$weekpoolsavings['gas'] = $gassavings;
	$weekpoolsavings['miles'] = $milesnotdriven * 2;
	$weekpoolsavings['cars'] = $carsoffroad;
	$weekpoolsavings['emissions'] = $emissionssavings * 2;
	
	return $weekpoolsavings;
	
}

// Get pool savings by week (pool line chart)
function getPoolSavingsByWeek($pool_id)
{

	global $dbh;
	
	// Get current date
	$currentdate = date("Y") . '-' . date("m") . '-' . date("d");
	
	// Start XML string
	$xml = '<?xml version="1.0" encoding="UTF-8"?>';
	$xml = $xml . '<savings>';
	
	// Define beginning week
	$startWeek  = mktime(0, 0, 0, 10, 06, 2008);
	
	// Get current week
	$currentWeek  = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
	
	// Calculate difference of startweek and current week (in seconds)
	$numSeconds = $currentWeek - $startWeek;
	
	// Find out how many weeks have elapsed
	$numWeeks = floor($numSeconds / 604800); 
	
	// Build week array
	for($i = 0; $i < $numWeeks+1; $i++)
	{
		// Calculate the week	
		$weekCalc =  strtotime(date("r", mktime(04, 0, 0, 10, 06, 2008)) . "+" . $i . " week");
		$weekDate =  date('m/d/Y', $weekCalc);
		
		// Create default (empty) values for each week - these may get overridden depending on activity
		$gassavingsweek[$weekDate] = 0;
		$emissionssavingsweek[$weekDate] = 0;
		$milesnotdrivenweek[$weekDate] = 0;
		$carsoffroadweek[$weekDate] = 0;
		$weekstart2[$weekDate] = $weekDate;
	}
	
	// Default values for my savings
	$gassavings = 0;
	$emissionssavings = 0;
	$milesnotdriven = 0;
	$carsoffroad = 0;

	// Get pools workplace
	$sql = "SELECT workplace_id FROM pools WHERE pool_id = '$pool_id'";
	$row = $dbh->queryRow($sql);
	
	$workplace = $row['workplace_id'];
	
	// Get users workplace information
	$sql = "SELECT state FROM workplaces WHERE workplace_id = '$workplace'";
	$row = $dbh->queryRow($sql);
	
	$state = $row['state'];
	
	// Get all members of the pool
	$sql = "SELECT user_id FROM poolmembers WHERE pool_id = '$pool_id' AND status = 'accepted'";
	$result = $dbh->query($sql);
	while($rowj = $result->fetchRow())
	{
		$user_id = $rowj['user_id'];
		
		//echo $user_id . '(further up the loop)' . "<br />";
		// Get the users car and location information
		$sql = "SELECT vehiclempg, vehicleco2 FROM users WHERE user_id = '$user_id'";
		$row = $dbh->queryRow($sql);
		
		if($row)
		{
			$mpg = $row['vehiclempg'];
			$co2 = $row['vehicleco2'];
		} else {
			$mpg = 0;
			$co2 = 0;
		}
		
		// Get number of confirmed rides
		$sql9 = "SELECT pool_id, DATE_FORMAT(rdate, '%v') AS week, DATE_FORMAT(rdate, '%Y') AS year, rdate FROM poolpassengers 
		WHERE user_id = '$user_id' AND rdate <= '$currentdate' AND pool_id = '$pool_id' AND confirm = 'accept' ORDER BY rdate";
		$result9 = $dbh->query($sql9);
		
		while($row9 = $result9->fetchRow())
		{
			$pool_id = $row9['pool_id'];
			$rdate = $row9['rdate'];
			$week = $row9['week'];
			$year = $row9['year'];
			
			// Get date of week start
			$datemonday = date("m/d/Y", strtotime("{$year}-W{$week}-1"));
			$datesunday = date("m/d/Y", strtotime("{$year}-W{$week}-7"));
			
			// If it is a new day, reset the values
			if($lastvalue != $datemonday)
			{
				// Reset values
				$gassavings = 0;
				$emissionssavings = 0;
				$milesnotdriven = 0;
				$carsoffroad = 0;
			}
			
			// Get the pool itinerary information
			$sql2 = "SELECT driver, route FROM poolitineraries WHERE pool_id = '$pool_id' AND rdate = '$rdate'";
			$row2 = $dbh->queryRow($sql2);
			
			$driver = $row2['driver'];
			$route = $row2['route'];
			
			// Get route distance
			$sql3 = "SELECT distance FROM poolroutes WHERE route_id = '{$row2['route']}'";
			$row3 = $dbh->queryRow($sql3);
			
			// Clean distance (1 meter = 0.000621371192 miles)
			$distance = round($row3['distance'] * 0.000621371192);
	
			// Get week number and year that rdate occurs on
			$gasdate = $week . '|' . $year;
			
			// Get gas prices for the week
			$sql4 = "SELECT $state AS gasprices FROM gasprices WHERE uploaddate = '$gasdate'";
			$row4 = $dbh->queryRow($sql4);
			
			// If there are no gas prices posted, get last weeks price (to prevent complete visualization error)
			if(!$row4)
			{
				$sql4 = "SELECT $state AS gasprices FROM gasprices ORDER BY uploaddate DESC LIMIT 1";
				$row4 = $dbh->queryRow($sql4);
			}
	
			// Clean gas data (get 'regular' price)
			$gasprices = explode(",", $row4['gasprices']);
			$gasprice = $gasprices[0];
			
			// Determine if user has driven
			if($driver != $user_id)
			{
	
				// Calculate savings in gas
				$gassavingsweek[$datemonday] += ($distance * ($gasprice / $mpg));
				
				// Calculate emissions
				$emissionssavingsweek[$datemonday] = $emissonssavings[$datemonday] + ($distance * $co2);
				
				// Calculate miles not driven
				$milesnotdrivenweek[$datemonday] += $distance;
				
				// Calculate cars off road
				$carsoffroadweek[$datemonday]++;
				
				// Append dates to array
				$weekstart2[$datemonday] = $datemonday;
				$weekend2[$datemonday] = $datesunday;
				$week2[$datemonday] = $week;
				
				$lastvalue = $datemonday;
			} 
		}
	}
	
	foreach ($gassavingsweek as $key => $value)
	{
		$savings[$key] = array(
			'weekstart' => $weekstart2[$key],
			'weekend' => $weekend2[$key],
			'week' => $week2[$key],
			'gas' =>  number_format(($value*2), 2),
			'miles' => $milesnotdrivenweek[$key] * 2,
			'car' => $carsoffroadweek[$key],
			'emissions' => $emissionssavingsweek[$key] * 2
		);
		
		// Print XML
		$xml = $xml . '<week start="' . $savings[$key]['weekstart'] . '" end="' . $savings[$key]['weekend'] . '" number="' . $savings[$key]['week'] . '">';
		$xml = $xml . '<savings_in_gas>' . $savings[$key]['gas'] . '</savings_in_gas>';
		$xml = $xml . '<miles_not_driven>' . $savings[$key]['miles'] . '</miles_not_driven>';
		$xml = $xml . '<cars_off_the_road>' . $savings[$key]['car'] . '</cars_off_the_road>';
		$xml = $xml . '<savings_in_co2>' . $savings[$key]['emissions'] . '</savings_in_co2>';
		$xml = $xml . '</week>';
	}
	
	$xml = $xml . '</savings>';
	
	return $xml;
}

// Get total workplace savings
function getWorkplaceSavings($workplace)
{

	global $dbh;
	
	// Get current date
	$currentdate = date("Y") . '-' . date("m") . '-' . date("d");

	// Default values for my savings
	$gassavings = 0;
	$emissionssavings = 0;
	$milesnotdriven = 0;
	$carsoffroad = 0;

	// Get users workplace information
	$sql = "SELECT state FROM workplaces WHERE workplace_id = '$workplace'";
	$row = $dbh->queryRow($sql);
	
	$state = $row['state'];

	
	// Get all users that belong to the workplace
	$sql9 = "SELECT user_id FROM users WHERE workplace = '$workplace'";
	$result9 = $dbh->query($sql9);

	while($row9 = $result9->fetchRow())
	{
		
		// Current user_id
		$user_id = $row9['user_id'];


		// Get the users car and location information
		$sql = "SELECT vehiclempg, vehicleco2 FROM users WHERE user_id = '$user_id'";
		$row = $dbh->queryRow($sql);

		if($row)
		{
			$mpg = $row['vehiclempg'];
			$co2 = $row['vehicleco2'];
		} else {
			$mpg = 0;
			$co2 = 0;
		}
		// Get number of confirmed rides
		$sql = "SELECT pool_id, DATE_FORMAT(rdate, '%v') AS week, DATE_FORMAT(rdate, '%Y') AS year, rdate FROM poolpassengers 
		WHERE user_id = '$user_id' AND rdate <= '$currentdate'  AND confirm = 'accept'";
		$result = $dbh->query($sql);


		while($row = $result->fetchRow())
		{
			$pool_id = $row['pool_id'];
			$rdate = $row['rdate'];
			$week = $row['week'];
			$year = $row['year'];
			
			// Get the pool itinerary information
			$sql2 = "SELECT driver, route FROM poolitineraries WHERE pool_id = '$pool_id' AND rdate = '$rdate'";
			$row2 = $dbh->queryRow($sql2);
			
			$driver = $row2['driver'];
			$route = $row2['route'];
			
			// Get route distance
			$sql3 = "SELECT distance FROM poolroutes WHERE route_id = '{$row2['route']}'";
			$row3 = $dbh->queryRow($sql3);
			
			// Clean distance (1 meter = 0.000621371192 miles)
			$distance = round($row3['distance'] * 0.000621371192);
	
			// Get week number and year that rdate occurs on
			$gasdate = $week . '|' . $year;
			
			// Get gas prices for the week
			$sql4 = "SELECT $state AS gasprices FROM gasprices WHERE uploaddate = '$gasdate'";
			$row4 = $dbh->queryRow($sql4);
			
			// If there are no gas prices posted, get last weeks price (to prevent complete visualization error)
			if(!$row4)
			{
				$sql4 = "SELECT $state AS gasprices FROM gasprices ORDER BY uploaddate DESC LIMIT 1";
				$row4 = $dbh->queryRow($sql4);
			}
			
			// Clean gas data (get 'regular' price)
			$gasprices = explode(",", $row4['gasprices']);
			$gasprice = $gasprices[0];	
			// Determine if user has driven

			if($driver != $user_id)
			{
				// Calculate savings in gas and emissions
				if($mpg == 0)
				{
					$gassavings = $gassavings + 0;
					$emissionssavings = $emissionssavings + 0;
				} else {
					$gassavings = $gassavings + ($distance * ($gasprice / $mpg));
					$emissionssavings = $emissionssavings + ($distance * $co2);
				}
				
				// Calculate miles not driven
				$milesnotdriven = $milesnotdriven + $distance;
				
				// Calculate cars off road
				$carsoffroad++;
			}
		}


	}
	// Format gas savings
	$gassavings = '$' . number_format($gassavings * 2, 2);
	
	// Create savings array
	$workplacesavings['gas'] = $gassavings;
	$workplacesavings['miles'] = $milesnotdriven * 2;
	$workplacesavings['cars'] = $carsoffroad;
	$workplacesavings['emissions'] = $emissionssavings * 2;
	
	return $workplacesavings;
	
}

// Insert Leaders
function insertLeaders()
{

	global $dbh;
	
	// Default values for savings
	$milesnotdriven = 0;
	$carsoffroad = 0;
	
	// Get the current month and year
	if($_GET['currentmonth'] && $_GET['currentyear'])
	{
		$currentmonth = $_GET['currentmonth'];
		$currentyear = $_GET['currentyear'];
	} else {
		$currentmonth = date("m");
		$currentyear = date("Y");
	}

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

// Get workplace Leaders
function getLeaders($workplace)
{

	global $dbh;
	
	// Get the current month and year
	$currentmonth = date("m");
	$currentyear = date("Y");

	// Get total number of pools
	$sql = "SELECT count(pool_id) AS totalnumberofpools FROM pools WHERE workplace_id = '$workplace'";
	$row = $dbh->queryRow($sql);
	$totalnumberofpools = $row['totalnumberofpools'];
	
	// Get number of pools for this month - buggy. Corrected code is below
	//$sql = "SELECT count(pool_id) AS monthnumberofpools FROM leaders WHERE workplace_id = '$workplace' AND cindex != '0'";

		
	// Get leader info
	$sql = "SELECT pool_id, cmonth, cyear, cdate, cindex, ranking, members, shift FROM leaders WHERE workplace_id = '$workplace' AND cindex != '0' ORDER BY cdate DESC, ranking";
	$result = $dbh->query($sql);
	while($row = $result->fetchRow())
	{
		// Clean month
		switch($row['cmonth']) 
		{
			case "1": $month = 'January'; break; 
			case "2": $month = 'February'; break; 
			case "3": $month = 'March'; break; 
			case "4": $month = 'April'; break; 
			case "5": $month = 'May'; break; 
			case "6": $month = 'June'; break; 
			case "7": $month = 'July'; break; 
			case "8": $month = 'August'; break; 
			case "9": $month = 'September'; break; 
			case "10": $month = 'October'; break; 
			case "11": $month = 'November'; break; 
			case "12": $month = 'December'; break; 
		}
		
		// Set current cdate iteration
		$currentdate = $row['cdate'];
		
		// Reset teams array if it's a different month
		if($currentdate != $previousdate)
		{
			$teams = '';
		}
	
		// Get pool title
		$sql2 = "SELECT title FROM pools WHERE pool_id = '{$row['pool_id']}'";
		$row2 = $dbh->queryRow($sql2);
		$pooltitle = $row2['title'];
		
		// Get pool route
		$sql3 = "SELECT vertices FROM poolroutes WHERE pool_id = '{$row['pool_id']}' LIMIT 1";
		$row3 = $dbh->queryRow($sql3);
		$vertices = $row3['vertices'];
		
		// Build teams array
		$teams[] = array(
			"team" => $pooltitle,
			"members" => $row['members'],
			"rank" => $row['ranking'],
			"overall" => "1",
			"route" => $vertices,
			"purpool_index" => $row['cindex'],
			"shift" => $row['shift']
		);
		
		// Push teams array onto month array (overwriting previous iteration)
		$months[$currentdate]['teams'] = $teams;
		
		//Get number of active pools for current month 
		//Modified by Peter on 1/22/10 to fix bug that
		//reurned the total number of pools that were active from
		//the start of the workplace
		
		$currentYear=$row['cyear'];
		$currentMonth=$row['cmonth'];
		$sql = "SELECT count(pool_id) AS monthnumberofpools FROM leaders WHERE workplace_id = '$workplace' AND cindex > 0 AND cmonth='$currentMonth' AND cyear='$currentYear'";
	$row4 = $dbh->queryRow($sql);
	$monthnumberofpools = $row4['monthnumberofpools'];
	
		// Build month array
		$months[$currentdate] = array(
			"month" => $month,
			"year" => $row['cyear'],
			"number_of_pools" => $monthnumberofpools,
			"number_of_pools_overall" => $totalnumberofpools,
			"teams" => $teams
		);
		
		//foreach ($months[$currentdate] as $key => $value) {
		//	echo "Key: $key; Value: $value<br />\n";
		//}
		
		// Set previous cdate iteration
		$previousdate = $row['cdate'];
	}
	
	// Build JSON array
	$json = array(
		"type" => "monthly",
		"months" => array_values($months)
	);
	
	return json_encode($json);
}

// Insert OverallLeaders
function insertOverallLeaders()
{

	global $dbh;
	
	// Default values for savings
	$milesnotdriven = 0;
	$carsoffroad = 0;
	
	// Get the current month and year
	if($_GET['currentmonth'] && $_GET['currentyear'])
	{
		$currentmonth = $_GET['currentmonth'];
		$currentyear = $_GET['currentyear'];
	} else {
		$currentmonth = date("m");
		$currentyear = date("Y");
	}

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

// Get overall Leaders
function getOverallLeaders()
{

	global $dbh;
	
	// Get the current month and year
	$currentmonth = date("m");
	$currentyear = date("Y");

	// Get total number of pools
	$sql = "SELECT count(pool_id) AS totalnumberofpools FROM pools";
	$row = $dbh->queryRow($sql);
	$totalnumberofpools = $row['totalnumberofpools'];
	
	// Get number of pools for this month
	$sql = "SELECT count(pool_id) AS monthnumberofpools FROM leaders WHERE cindex != '0'";
	$row = $dbh->queryRow($sql);
	$monthnumberofpools = $row['monthnumberofpools'];
	
	// Get latest month on file
	$sql = "SELECT cmonth, cyear FROM leaders_overall WHERE cindex != '0' ORDER BY cdate DESC LIMIT 1";
	$row = $dbh->queryRow($sql);
	$latestmonth = $row['cmonth'];
	$latestyear = $row['cyear'];
		
	// Get leader info
	$sql = "SELECT 
				pool_id, 
				cmonth, 
				cyear, 
				cdate, 
				cindex, 
				ranking, 
				members, 
				shift 
			FROM 
				leaders_overall 
			WHERE 
				cindex != '0' AND cmonth = '$latestmonth' AND cyear = '$latestyear' 
			ORDER BY 
				cdate DESC, ranking
			LIMIT 5";
	$result = $dbh->query($sql);
	while($row = $result->fetchRow())
	{
		// Clean month
		switch($row['cmonth']) 
		{
			case "1": $month = 'January'; break; 
			case "2": $month = 'February'; break; 
			case "3": $month = 'March'; break; 
			case "4": $month = 'April'; break; 
			case "5": $month = 'May'; break; 
			case "6": $month = 'June'; break; 
			case "7": $month = 'July'; break; 
			case "8": $month = 'August'; break; 
			case "9": $month = 'September'; break; 
			case "10": $month = 'October'; break; 
			case "11": $month = 'November'; break; 
			case "12": $month = 'December'; break; 
		}
		
		// Set current cdate iteration
		$currentdate = $row['cdate'];
	
		// Get pool title
		$sql2 = "SELECT title, workplace_id FROM pools WHERE pool_id = '{$row['pool_id']}'";
		$row2 = $dbh->queryRow($sql2);
		$pooltitle = $row2['title'];
		$workplace_id = $row2['workplace_id'];
		
		// Select workplace title
		$sql3 = "SELECT name FROM workplaces WHERE workplace_id = '{$workplace_id}'";
		$row3 = $dbh->queryRow($sql3);
		$workplacetitle = $row3['name'];
		
		// Build leaders array
		$leaders[] = array(
			"team" => $pooltitle,
			"workplace" => $workplacetitle,
			"members" => $row['members'],
			"rank" => $row['ranking'],
			"overall" => "1",
			"purpool_index" => $row['cindex'],
			"shift" => $row['shift'],
			"month" => $month,
			"year" => $row['cyear'],
			"number_of_pools" => $monthnumberofpools,
			"number_of_pools_overall" => $totalnumberofpools
		);
	
	}
	
	return $leaders;
}



?>
