<?php

#################################################################
# Name: cron_gasprices.php                                      #
# Author: Peter Ohring		                                    #
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

// Gas Price scraper
//$file = file_get_contents("http://www.fuelgaugereport.com/sbsavg.asp");
$curl_handle=curl_init();
curl_setopt($curl_handle,CURLOPT_URL,'http://fuelgaugereport.opisnet.com/sbsavg.html');
curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
$file = curl_exec($curl_handle);
curl_close($curl_handle);

// Obtain gas prices
//$pieces = explode("<tr><td><b>State</td><td><b>Regular</td><td><b>Mid</td><td><b>Premium</td><td><b>Diesel<td></tr>",$file);
$pieces = explode('<strong>Diesel</strong></td>',$file);
$states = explode("<tr>",$pieces[1]);

for($i=1;$i<=51;$i++)
{
/*	$parts = explode( "</td><td>",$states[$i]);
	//$gasPrices[$i] = array(substr($parts[1],1),substr($parts[2],1),substr($parts[3],1),substr($parts[4],1,-4));
	$gasPrices[$i] = array(substr($parts[1],1),substr($parts[2],1),substr($parts[3],1),substr($parts[4],1,-12));*/
	
//Modified on 9/29/09 by Peter to reflect changes in the way AAA is marking up gas price page. Old version is commented out above.
$parts = explode( "</td>",$states[$i]);
	//$gasPrices[$i] = array(substr($parts[1],1),substr($parts[2],1),substr($parts[3],1),substr($parts[4],1,-4));
	$gasPrices[$i] = array(substr($parts[1],-5),substr($parts[2],-5),substr($parts[3],-5),substr($parts[4],-5));
}

// Get current date
$uploaddate = date('W') . "|" . date('Y');

// Assign prices to state variable
$AK = $gasPrices[1][0] . ',' . $gasPrices[1][1] . ',' . $gasPrices[1][2] . ',' . $gasPrices[1][3];
$AL = $gasPrices[2][0] . ',' . $gasPrices[2][1] . ',' . $gasPrices[2][2] . ',' . $gasPrices[2][3];
$AR = $gasPrices[3][0] . ',' . $gasPrices[3][1] . ',' . $gasPrices[3][2] . ',' . $gasPrices[3][3];
$AZ = $gasPrices[4][0] . ',' . $gasPrices[4][1] . ',' . $gasPrices[4][2] . ',' . $gasPrices[4][3];
$CA = $gasPrices[5][0] . ',' . $gasPrices[5][1] . ',' . $gasPrices[5][2] . ',' . $gasPrices[5][3];
$CO = $gasPrices[6][0] . ',' . $gasPrices[6][1] . ',' . $gasPrices[6][2] . ',' . $gasPrices[6][3];
$CT = $gasPrices[7][0] . ',' . $gasPrices[7][1] . ',' . $gasPrices[7][2] . ',' . $gasPrices[7][3];
$DC = $gasPrices[8][0] . ',' . $gasPrices[8][1] . ',' . $gasPrices[8][2] . ',' . $gasPrices[8][3];
$DE = $gasPrices[9][0] . ',' . $gasPrices[9][1] . ',' . $gasPrices[9][2] . ',' . $gasPrices[9][3];
$FL = $gasPrices[10][0] . ',' . $gasPrices[10][1] . ',' . $gasPrices[10][2] . ',' . $gasPrices[10][3];
$GA = $gasPrices[11][0] . ',' . $gasPrices[11][1] . ',' . $gasPrices[11][2] . ',' . $gasPrices[11][3];
$HI = $gasPrices[12][0] . ',' . $gasPrices[12][1] . ',' . $gasPrices[12][2] . ',' . $gasPrices[12][3];
$IA = $gasPrices[13][0] . ',' . $gasPrices[13][1] . ',' . $gasPrices[13][2] . ',' . $gasPrices[13][3];
$ID = $gasPrices[14][0] . ',' . $gasPrices[14][1] . ',' . $gasPrices[14][2] . ',' . $gasPrices[14][3];
$IL = $gasPrices[15][0] . ',' . $gasPrices[15][1] . ',' . $gasPrices[15][2] . ',' . $gasPrices[15][3];
$IN = $gasPrices[16][0] . ',' . $gasPrices[16][1] . ',' . $gasPrices[16][2] . ',' . $gasPrices[16][3];
$KS = $gasPrices[17][0] . ',' . $gasPrices[17][1] . ',' . $gasPrices[17][2] . ',' . $gasPrices[17][3];
$KY = $gasPrices[18][0] . ',' . $gasPrices[18][1] . ',' . $gasPrices[18][2] . ',' . $gasPrices[18][3];
$LA = $gasPrices[19][0] . ',' . $gasPrices[19][1] . ',' . $gasPrices[19][2] . ',' . $gasPrices[19][3];
$MA = $gasPrices[20][0] . ',' . $gasPrices[20][1] . ',' . $gasPrices[20][2] . ',' . $gasPrices[20][3];
$MD = $gasPrices[21][0] . ',' . $gasPrices[21][1] . ',' . $gasPrices[21][2] . ',' . $gasPrices[21][3];
$ME = $gasPrices[22][0] . ',' . $gasPrices[22][1] . ',' . $gasPrices[22][2] . ',' . $gasPrices[22][3];
$MI = $gasPrices[23][0] . ',' . $gasPrices[23][1] . ',' . $gasPrices[23][2] . ',' . $gasPrices[23][3];
$MN = $gasPrices[24][0] . ',' . $gasPrices[24][1] . ',' . $gasPrices[24][2] . ',' . $gasPrices[24][3];
$MO = $gasPrices[25][0] . ',' . $gasPrices[25][1] . ',' . $gasPrices[25][2] . ',' . $gasPrices[25][3];
$MS = $gasPrices[26][0] . ',' . $gasPrices[26][1] . ',' . $gasPrices[26][2] . ',' . $gasPrices[26][3];
$MT = $gasPrices[27][0] . ',' . $gasPrices[27][1] . ',' . $gasPrices[27][2] . ',' . $gasPrices[27][3];
$NC = $gasPrices[28][0] . ',' . $gasPrices[28][1] . ',' . $gasPrices[28][2] . ',' . $gasPrices[28][3];
$ND = $gasPrices[29][0] . ',' . $gasPrices[29][1] . ',' . $gasPrices[29][2] . ',' . $gasPrices[29][3];
$NE = $gasPrices[30][0] . ',' . $gasPrices[30][1] . ',' . $gasPrices[30][2] . ',' . $gasPrices[30][3];
$NH = $gasPrices[31][0] . ',' . $gasPrices[31][1] . ',' . $gasPrices[31][2] . ',' . $gasPrices[31][3];
$NJ = $gasPrices[32][0] . ',' . $gasPrices[32][1] . ',' . $gasPrices[32][2] . ',' . $gasPrices[32][3];
$NM = $gasPrices[33][0] . ',' . $gasPrices[33][1] . ',' . $gasPrices[33][2] . ',' . $gasPrices[33][3];
$NV = $gasPrices[34][0] . ',' . $gasPrices[34][1] . ',' . $gasPrices[34][2] . ',' . $gasPrices[34][3];
$NY = $gasPrices[35][0] . ',' . $gasPrices[35][1] . ',' . $gasPrices[35][2] . ',' . $gasPrices[35][3];
$OH = $gasPrices[36][0] . ',' . $gasPrices[36][1] . ',' . $gasPrices[36][2] . ',' . $gasPrices[36][3];
$OK = $gasPrices[37][0] . ',' . $gasPrices[37][1] . ',' . $gasPrices[37][2] . ',' . $gasPrices[37][3];
$OR = $gasPrices[38][0] . ',' . $gasPrices[38][1] . ',' . $gasPrices[38][2] . ',' . $gasPrices[38][3];
$PA = $gasPrices[39][0] . ',' . $gasPrices[39][1] . ',' . $gasPrices[39][2] . ',' . $gasPrices[39][3];
$RI = $gasPrices[40][0] . ',' . $gasPrices[40][1] . ',' . $gasPrices[40][2] . ',' . $gasPrices[40][3];
$SC = $gasPrices[41][0] . ',' . $gasPrices[41][1] . ',' . $gasPrices[41][2] . ',' . $gasPrices[41][3];
$SD = $gasPrices[42][0] . ',' . $gasPrices[42][1] . ',' . $gasPrices[42][2] . ',' . $gasPrices[42][3];
$TN = $gasPrices[43][0] . ',' . $gasPrices[43][1] . ',' . $gasPrices[43][2] . ',' . $gasPrices[43][3];
$TX = $gasPrices[44][0] . ',' . $gasPrices[44][1] . ',' . $gasPrices[44][2] . ',' . $gasPrices[44][3];
$UT = $gasPrices[45][0] . ',' . $gasPrices[45][1] . ',' . $gasPrices[45][2] . ',' . $gasPrices[45][3];
$VA = $gasPrices[46][0] . ',' . $gasPrices[46][1] . ',' . $gasPrices[46][2] . ',' . $gasPrices[46][3];
$VT = $gasPrices[47][0] . ',' . $gasPrices[47][1] . ',' . $gasPrices[47][2] . ',' . $gasPrices[47][3];
$WA = $gasPrices[48][0] . ',' . $gasPrices[48][1] . ',' . $gasPrices[48][2] . ',' . $gasPrices[48][3];
$WI = $gasPrices[49][0] . ',' . $gasPrices[49][1] . ',' . $gasPrices[49][2] . ',' . $gasPrices[49][3];
$WV = $gasPrices[50][0] . ',' . $gasPrices[50][1] . ',' . $gasPrices[50][2] . ',' . $gasPrices[50][3];
$WY = $gasPrices[51][0] . ',' . $gasPrices[51][1] . ',' . $gasPrices[51][2] . ',' . $gasPrices[51][3];

// Insert prices into database
$sql = "INSERT INTO gasprices (
			uploaddate, 
			AK,
			AL,
			AR,
			AZ,
			CA,
			CO,
			CT,
			DC,
			DE,
			FL,
			GA,
			HI,
			IA,
			ID,
			IL,
			IN2,
			KS,
			KY,
			LA,
			MA,
			MD,
			ME,
			MI,
			MN,
			MO,
			MS,
			MT,
			NC,
			ND,
			NE,
			NH,
			NJ,
			NM,
			NV,
			NY,
			OH,
			OK,
			OR2,
			PA,
			RI,
			SC,
			SD,
			TN,
			TX,
			UT,
			VA,
			VT,
			WA,
			WI,
			WV,
			WY
		) VALUES (
			'$uploaddate',
			'$AK',
			'$AL',
			'$AR',
			'$AZ',
			'$CA',
			'$CO',
			'$CT',
			'$DC',
			'$DE',
			'$FL',
			'$GA',
			'$HI',
			'$IA',
			'$ID',
			'$IL',
			'$IN',
			'$KS',
			'$KY',
			'$LA',
			'$MA',
			'$MD',
			'$ME',
			'$MI',
			'$MN',
			'$MO',
			'$MS',
			'$MT',
			'$NC',
			'$ND',
			'$NE',
			'$NH',
			'$NJ',
			'$NM',
			'$NV',
			'$NY',
			'$OH',
			'$OK',
			'$OR',
			'$PA',
			'$RI',
			'$SC',
			'$SD',
			'$TN',
			'$TX',
			'$UT',
			'$VA',
			'$VT',
			'$WA',
			'$WI',
			'$WV',
			'$WY'
		)";
		$result = $dbh->query($sql);
		
		
		
		// Check to make sure that the query is successful
		if (PEAR::isError($result)) 
		{
			$message = 'Purpool may have encountered an error in inserting gas prices for: ' . $uploaddate . '.' . "\n\n";
			$message = $message . 'The database returned the following error: ' . $result->getMessage(); 
			mail($MISC['admin_email'], 'Purpool Error: Gas prices', $message, "From: ".$MISC['admin_email']);
		}

?>

