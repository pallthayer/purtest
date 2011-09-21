<?php
// Include configuration file
include_once('/home/41684/domains/purpool.com/common/includes/api_config.php');

// Include common utility library
include_once($DIR['inc'] . 'Utils.class.php');

// Include database package
include_once($DIR['pear'] . 'MDB2.php');

// Initialize database connection
$dbh = Utils::initDB();

GLOBAL $method, $year, $make, $model, $data;

require 'emission_calc.php';

// Set variables
$method = $_GET['method'];
$year = $_GET['year'];
$make = $_GET['make'];
$model = $_GET['model'];
$trans = $_GET['trans'];
$drive = $_GET['drive'];
$return = $_GET['return'];
$format = $_GET['format'];
$mpg = $_GET['mpg'];
$miles = $_GET['miles'];

// Check if, and what, method is set. Act accordingly and return result array in $data var
if(isset($method)){
	switch ($method){
	case getMake:
		$query = 'SELECT DISTINCT make FROM car_data WHERE year="'.$year.'" ORDER BY make';
		$res = $dbh->query($query);
		$data = $res->fetchCol();
		break;
	case getModel:
		$query = 'SELECT DISTINCT model FROM car_data WHERE year="'.$year.'" AND make="'.$make.'" ORDER BY model';
		$res = $dbh->query($query);
		$data = $res->fetchCol();
		break;
	case getStyle:
		$query = 'SELECT DISTINCT trans, cylinders FROM car_data WHERE year="'.$year.'" AND model="'.$model.'"';
		$res = $dbh->query($query);
		break;
	case getMpg:
		$query = 'SELECT cityMpg08, hwyMpg08, cmbMpg08 FROM car_data WHERE year="'.$year.'" AND model="'.$model.'" AND trans="'.$trans.'"';
		$res = $dbh->query($query);
		$data = $res->fetchRow(MDB2_FETCHMODE_ASSOC);
		break;
	case getC02:
		$query = 'SELECT c0208 FROM car_data WHERE year="'.$year.'" AND model="'.$model.'" AND trans="'.$trans.'"';
		$res = $dbh->query($query);
		$data = $res->fetchRow(MDB2_FETCHMODE_ASSOC);
		break;
	case getMpgHigh:
	// Couldn't quite figure this out, need to insert a WHERE clause
	// into the query based on $_GET parameters defined.
		foreach($_GET as $k => $v){
			echo $k.'='.$v;
			if(count($_GET) > 2){
				echo ' AND ';
			}
		}
		$query = 'SELECT year, make, model, trans, cylinders, cmbMpg08 FROM `car_data` GROUP BY make ORDER BY cmbMpg08 DESC LIMIT 10 ';
		$res = $dbh->query($query);
		$data = $res->fetchRow(MDB2_FETCHMODE_ASSOC);
		break;
	case emissionCalc:
		$data = emissionCalc($miles, $mpg);
		break;
	}

//Determine format and echo
		if($format == 'json'){
			echo json_encode($data);
		} else {
			header("Content-type: text/xml");
			//echo the XML declaration
			echo chr(60).chr(63).'xml version="1.0" encoding="utf-8" '.chr(63).chr(62)."\n";
?>
<response>
	<parameters>
<?
// Depending on method used, format xml differently
	if($method == 'getMake'){
		foreach($data as $k => $v){
			echo '<make>'.$v.'</make>'."\n";
		}
	} elseif($method == 'getModel') {
		foreach($data as $k => $v){
			echo '<model>'.$v.'</model>'."\n";
		}
	} elseif($method == 'getStyle'){
		while($row = $res->fetchRow(MDB2_FETCHMODE_ASSOC)){
			echo '
				<style>'.$row['trans'].' '.$row['cylinders'].' cylinders</style>'."\n"
			;
		}
	} elseif($method == 'emissionCalc'){
		echo '<greenhousegases>'.$data.'</greenhousegases>';
	} else {
		foreach($data as $k => $v){
			echo '<'.$k.'>'.$v.'</'.$k.'>'."\n";
		}
	}
?>
	</parameters>
</response>
<?
		}
} else {
	echo 'Whoops! You haven\'t set a method.';
}


?>
