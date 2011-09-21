<?php
// Gas Price scraper
$file = file_get_contents('http://www.fuelgaugereport.com/sbsavg.asp');

$pieces = explode("<tr><td><b>State</td><td><b>Regular</td><td><b>Mid</td><td><b>Premium</td><td><b>Diesel<td></tr>",$file);
$states =explode("<tr>",$pieces[1]);
//echo $states[1];


for($i=1;$i<=50;$i++){
	$parts = explode( "</td><td>",$states[$i]);
	$gasPrices[$i] = array(substr($parts[1],1),substr($parts[2],1),substr($parts[3],1),substr($parts[4],1,-4));
}
for($i=1;$i<=50;$i++){
	echo $gasPrices[$i][0]." ".$gasPrices[$i][1]." ".$gasPrices[$i][2]." ".$gasPrices[$i][3]."<br>";
}


?>
