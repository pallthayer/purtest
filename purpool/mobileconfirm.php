<?php
/*$from=$_GET['from'];
$subject=$_GET['subject'];
$message=$_GET['message'];
$message = convert_uudecode($message);
$c=$_GET['c'];*/
//$message=$message.$c;
$from=$_POST['from'];
$subject=$_POST['subject'];
$message=$_POST['message'];
//$message = convert_uudecode($message);

//Purpool: Key=36453643

mail("peter.ohring@gmail.com", "Test Message", 'from: '.$from."\n subject: ".$subject."\nmessage:".$message);
?>
