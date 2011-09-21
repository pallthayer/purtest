<?php
/*
 * Emissions Calculator by Michael Mausler
 * 
 * Outputs greenhouse gas emissions in kg based on
 * miles traveled and mpg of vehicle.
 * 
 * According to the EPA, 8.8kg of C02 is emitted for
 * every gallon of gasoline burned. So we first calculate
 * the amount of gallons burned, multiply by 8.8, then
 * mulptiply by (100/95). This takes into account the
 * other greenhouse gases other than C02.
 *
 */
	function emissionCalc ($miles, $mpg) {
		$res = ($miles/$mpg) * 8.8 * (100/95);
		$res = sprintf("%01.2f", $res);
		return $res;
	}
	
	// Sample
	//echo emissionCalc(200, 23);
?>
