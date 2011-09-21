<?php

#################################################################
# Name: visdata.php      		                                #
# Author: John Kuiphoff                                         #
# Description: Calculates visualization information			    #
#################################################################

// Get total user savings
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
	
	// Get number of confirmed rides
	$sql = "SELECT pool_id, DATE_FORMAT(rdate, '%v') AS week, DATE_FORMAT(rdate, '%Y') AS year, rdate FROM poolpassengers WHERE user_id = '$user_id' AND confirm = 'accept'";
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
			
			$carsoffroad++;
		}
		
		
	}
	
	// Format gas savings
	$gassavings = '$' . number_format($gassavings, 2);
	
	// Create savings array
	$usersavings['gas'] = $gassavings;
	$usersavings['miles'] = $milesnotdriven;
	$usersavings['cars'] = $carsoffroad;
	$usersavings['emissions'] = $emissionssavings;
	
	return $usersavings;
	
}

// Get user savings for the current week
function getUserSavingsForWeek($user_id)
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
	
	// Get current week and year
	$currentweek = date('W');
	$currentyear = date('Y');
	
	// Get number of confirmed rides
	$sql = "SELECT pool_id, DATE_FORMAT(rdate, '%v') AS week, DATE_FORMAT(rdate, '%Y') AS year, rdate FROM poolpassengers WHERE user_id = '$user_id' AND confirm = 'accept'";
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
				
				$carsoffroad++;
			}
		}
	}
	
	// Format gas savings
	$gassavings = '$' . number_format($gassavings, 2);
	
	// Create savings array
	$weekusersavings['gas'] = $gassavings;
	$weekusersavings['miles'] = $milesnotdriven;
	$weekusersavings['cars'] = $carsoffroad;
	$weekusersavings['emissions'] = $emissionssavings;
	
	return $weekusersavings;
	
}

// Get user savings by week
function getUserSavingsByWeek($user_id)
{

	global $dbh;
	
	// Start XML string
	$xml = '<?xml version="1.0" encoding="UTF-8"?>';
	$xml = $xml . '<savings>';
	
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
	$sql = "SELECT pool_id, DATE_FORMAT(rdate, '%v') AS week, DATE_FORMAT(rdate, '%Y') AS year, rdate FROM poolpassengers WHERE user_id = '$user_id' AND confirm = 'accept' ORDER BY rdate";
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
		
		// Clean gas data (get 'regular' price)
		$gasprices = explode(",", $row4['gasprices']);
		$gasprice = $gasprices[0];
		
		// Determine if user has driven
		if($driver != $user_id)
		{
			
			// Calculate savings in gas
			$gassavings = $gassavings + ($distance * ($gasprice / $mpg));
			$gassavingsweek[$datemonday] = $gassavings;
		
			// Calculate savings
			$emissionssavings = $emissonssavings[$datemonday] + ($distance * $co2);
			$emissionssavingsweek[$datemonday] = $emissionssavings;
			
			// Calculate miles not driven
			$milesnotdriven = $milesnotdriven[$datemonday] + $distance;
			$milesnotdrivenweek[$datemonday] = $milesnotdriven;
			
			// Calculate cars off road
			$carsoffroad++;
			$carsoffroadweek[$datemonday] = $carsoffroad;
			
			$weekstart2[$datemonday] = $datemonday;
			$weekend2[$datemonday] = $datesunday;
			$week2[$datemonday] = $week;
			
			$lastvalue = $datemonday;
		} 
	}
	
	foreach ($gassavingsweek as $key => $value)
	{
		$savings[$key] = array(
			'weekstart' => $weekstart2[$key],
			'weekend' => $weekend2[$key],
			'week' => $week2[$key],
			'gas' =>  number_format($value, 2),
			'miles' => $milesnotdrivenweek[$key],
			'car' => $carsoffroadweek[$key],
			'emissions' => $emissionssavingsweek[$key]
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

// Stacked chart
function getGlobalSavings($workplace)
{
	global $dbh;
	
	// Start XML string
	$xml = '<?xml version="1.0" encoding="UTF-8"?>';
	$xml = $xml . '<stacked_chart>';
	
	// Define beginning week
	$startWeek  = mktime(0, 0, 0, 9, 1, 2008);
	
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
		$weekCalc = $startWeek + (($i*7)*86400);
		$weekDate = date('m/d/Y', $weekCalc);
		
		$weeksString = $weeksString . $weekDate . ', ';
		
		// Create empty miles not driven array
		$milesnotdrivenweek[$weekDate] = 0;
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
			$sql = "SELECT 
						pool_id, 
						DATE_FORMAT(rdate, '%v') AS week, 
						DATE_FORMAT(rdate, '%Y') AS year, 
						rdate 
					FROM 
						poolpassengers 
					WHERE 
						user_id = '$user_id' AND confirm = 'accept' 
					ORDER BY 
						rdate";
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
				
				// Determine if user has driven
				if($driver != $user_id)
				{
					echo 'Date Monday :' . $datemonday . "<br />";
					
					// Calculate miles not driven
					$milesnotdriven = $milesnotdriven[$datemonday] + $distance;
					$milesnotdrivenweek[$datemonday] = $milesnotdriven;
					
					echo $milesnotdriven . "<br />";
					
					// Calculate cars off road
					$carsoffroad++;
					$carsoffroadweek[$datemonday] = $carsoffroad;
					
					// Calculate Purpool Index
					$w = 0.5;
					$purpoolindex[$datemonday] = ($w*$milesnotdrivenweek[$datemonday]) + ((1-$w)*$carsoffroadweek[$datemonday]);
	
					$weekstart2[$datemonday] = $datemonday;
					$weekend2[$datemonday] = $datesunday;
					$week2[$datemonday] = $week;
					
					$lastvalue = $datemonday;
				} 
			}
			
			//$milesnotdrivenarray[] = $milesnotdriven;
			
			
			
			
			
	
			
			
			
			
			// Build XML string
			$xml = $xml . '<pool name="' . $title . '" members="' . $nummembers . '" cars_off_road="' . $carsoffroadweek[$datemonday] . '"  index="' . $purpoolindex[$datemonday] . '">';
				$xml = $xml . '<milesnotdriven>';
				foreach ($milesnotdrivenweek as $key => $value)
				{
					$xml = $xml . $value . ', ';
				}
				// Get rid of extra comma
				$xml = substr($xml,'', -2);
				$xml = $xml . '</milesnotdriven>';
			$xml = $xml . '</pool>';
		}	
	}	
	
	$xml = $xml . '</stacked_chart>';
	
	echo $xml;
}

/*
<?xml version="1.0" encoding="UTF-8"?>
<stacked_chart>
	<weeks>10/5/2008, 10/12/2008, 10/19/2008, 10/25/2008, 11/2/2008, 11/9/2008, 11/16/2008, 11/23/2008, 11/30/2008, 12/07/2008, 12/14/2008, 12/21/2008, 12/28/2008, 01/04/2009, 01/11/2009, 01/18/2009, 01/25/2009, 02/01/2009, 02/08/2009, 02/15/2009, 02/22/2009, 03/01/2009, 03/08/2009, 03/15/2009</weeks>
	<pool name="Joyriders" members="4" cars_off_road="101"  index="242">
		<miles_not_driven>176, 204, 276, 325, 276, 112, 134, 206, 244, 244, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0 </miles_not_driven>
	</pool>
	<pool name="Fastlane" members="3" cars_off_road="98" index="368">
		<miles_not_driven>112, 134, 206, 244, 244, 320, 340, 400, 400,360, 0, 0, 0, 0, 0, 0, 400,360, 176, 204, 276, 325, 276, 400</miles_not_driven>
	</pool>
	<pool name="Brewster_north" members="5" cars_off_road="122"  index="322">
		<miles_not_driven>320, 340, 400, 400,360, 176, 204, 276, 325, 276, 320, 340, 400, 400,360, 176, 204, 276, 325, 276,360, 386, 342, 412</miles_not_driven>
	</pool>
	<pool name="Never on Sundays" members="5" cars_off_road="132"  index="542">
		<miles_not_driven>0, 0, 120, 200, 360, 386, 342, 412, 390, 412, 212, 249, 212, 220, 280, 276, 280, 300, 320, 320, 300, 324, 324, 300</miles_not_driven>
	</pool>
</stacked_chart>

*/


// Get pool savings by week
function getPoolSavingsByWeek($pool_id)
{

	global $dbh;
	
	// Start XML string
	$xml = '<?xml version="1.0" encoding="UTF-8"?>';
	$xml = $xml . '<savings>';
	
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
		$sql = "SELECT pool_id, DATE_FORMAT(rdate, '%v') AS week, DATE_FORMAT(rdate, '%Y') AS year, rdate FROM poolpassengers WHERE user_id = '$user_id' AND confirm = 'accept' ORDER BY rdate";
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
			
			// Clean gas data (get 'regular' price)
			$gasprices = explode(",", $row4['gasprices']);
			$gasprice = $gasprices[0];
			
			// Determine if user has driven
			if($driver != $user_id)
			{
				
				// Calculate savings in gas
				$gassavings = $gassavings + ($distance * ($gasprice / $mpg));
				$gassavingsweek[$datemonday] = $gassavings;
			
				// Calculate savings
				$emissionssavings = $emissonssavings[$datemonday] + ($distance * $co2);
				$emissionssavingsweek[$datemonday] = $emissionssavings;
				
				// Calculate miles not driven
				$milesnotdriven = $milesnotdriven[$datemonday] + $distance;
				$milesnotdrivenweek[$datemonday] = $milesnotdriven;
				
				// Calculate cars off road
				$carsoffroad++;
				$carsoffroadweek[$datemonday] = $carsoffroad;
				
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
			'gas' =>  number_format($value, 2),
			'miles' => $milesnotdrivenweek[$key],
			'car' => $carsoffroadweek[$key],
			'emissions' => $emissionssavingsweek[$key]
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
		$sql = "SELECT pool_id, DATE_FORMAT(rdate, '%v') AS week, DATE_FORMAT(rdate, '%Y') AS year, rdate FROM poolpassengers WHERE user_id = '$user_id' AND confirm = 'accept'";
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
				
				$carsoffroad++;
			}

		}

	}
	
	// Format gas savings
	$gassavings = '$' . number_format($gassavings, 2);
	
	// Create savings array
	$workplacesavings['gas'] = $gassavings;
	$workplacesavings['miles'] = $milesnotdriven;
	$workplacesavings['cars'] = $carsoffroad;
	$workplacesavings['emissions'] = $emissionssavings;
	
	return $workplacesavings;
	
}

?>
