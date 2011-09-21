<?php
include_once('../config_path.php');
include_once($config_path.'config.php');

function run_cron($cron_url, $seconds, $now, $curl){
	$return = '';
	if((filemtime($cron_url) + $seconds) < $now){
		$return = filemtime($cron_url)."<div>Running $cron_url - ";
		$result = curl_exec($curl);
		$errno = curl_errno($curl);
		$errmsg = curl_error($curl);
		if($errno){
			$return .= "Error: $errmsg</div>";
		}else{
			$return .= "OK: $result</div>";
			touch($cron_url);
		}

	}else{
		$return .= "<div>Ignoring $cron_url</div>";
	}
	return $return;
}

$ch = curl_init();
$urls = array(
        'register-cleanup.php',
        'confirm.php',
        'gasprices.php',
        'insertleaders.php',
        'itinerary.php'
);
$output = '';
$ch = curl_init();
$current_time = time();
foreach($urls as $key => $url){
	curl_setopt($ch, CURLOPT_URL, $MISC['site_url'].'cron/'.$url);
	switch($key){
		case 0:
			$output .= run_cron($url, -1, $current_time, $ch);
			break;
		case 1:
			$output .= run_cron($url, 86400, $current_time, $ch);
			break;
		case 2:
			$output .= run_cron($url, 604800, $current_time, $ch);
			break;
		case 3:
			if(date('d') == 1 && ($current_time - filemtime($url) > 172800)){
				$output .= run_cron($url, -1, $current_time, $ch);
			}else{
				$output .= "<div>Ignoring $url</div>";
			}
			break;
		case 4:
			$output .= run_cron($url, 86400, $current_time, $ch);
			break;


	}
}
echo $output;
?>

