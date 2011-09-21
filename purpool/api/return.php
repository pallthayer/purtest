<?php
/* Parameters
$year = '2000';
$make = 'BMW';
$model = '328i';
$trans = 'Auto-L5';
$drive = '2WD';
$return = 'citympg, greenhousegasscore';
$format = 'xml';*/

	// Create array from params
	$params = array(
		'method' => 'getModel',
		'year' => '1985',
		'make' => 'BMW',
		'format' => 'xml'
	);
	
	$encoded_params = array();
	
	// Format for URL
	foreach ($params as $k => $v){
	$encoded_params[] = urlencode($k).'='.urlencode($v);
	}
	
	// Add to URL and retrieve contents
	$url = $MISC['site_url']."api/call.php?".implode('&', $encoded_params);
	$rsp = file_get_contents($url);
	
	// If format is XML, add header
	if($params['format'] == 'xml'){
		header("Content-type: text/xml");
	}
	// echo response
	echo $rsp;

?>
