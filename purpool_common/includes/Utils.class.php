<?php

#################################################################
# Name: Utils.class.php                                         #
# Author: John Kuiphoff                                         #
# Description: Includes various static methods.			        #
# 	initDB: Initializes a database connection					#
#   initTPL: Initializes the SMARTY templating engine			#
#	randomKey: Generates a random string						#
#	logAction: Logs user interactions							#
#################################################################

class Utils
{
	# Initializes database connection
	public static function initDB()
	{
		global $DB;
		
		// Build connection array
		$dsn = array(
			'phptype'  => $DB['type'],
			'username' => $DB['user'],
			'password' => $DB['pass'],
			'hostspec' => $DB['host'],
			'database' => $DB['database']
		);

		// Build options array
		$options = array(
			'debug'       => 2,
			'portability' => MDB2_PORTABILITY_ALL
		);

		// Connect to database
		$dbh = MDB2::factory($dsn, $options);
                
		// Change default return method to use associative arrays
		$dbh->setFetchMode(MDB2_FETCHMODE_ASSOC);

		return $dbh;
	}

	# Initializes Smarty templating engine
	public static function initTPL()
	{
		global $SMARTY;

		// Initialize a new template object.
		$tpl = new Smarty;
		$tpl->template_dir = $SMARTY['orig'];
		$tpl->compile_dir  = $SMARTY['comp'];
        
		return $tpl;
	}

	# Creates a random key
	public static function randomKey($length)
	{
		$pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
		$key  = $pattern{rand(0,36)};
		for($i=1; $i<$length; $i++)
		{
			$key .= $pattern{rand(0,36)};
		}

		return $key;
	}

	# Logs user interactions
	public static function logAction($username, $action, $note)
	{
		global $DIR;
        
		// Create data string
		$data = date("m/d/Y") . '+++' . date("g:ia") . '+++' . $action . '+++' . $note . "\n";
        
		// Write to log file.
		$fp = fopen($DIR['logs'] . $username . '.txt', "a");
		flock($fp, LOCK_EX);
		fwrite($fp, $data);
		flock($fp, LOCK_UN);
		fclose($fp);
	}
	
	# RESIZE IMAGE (tmpfile, image_id, filepath, thumbail)
	public static function resizeImage($tempfile, $image_id, $filepath, $size)
	{
		// Check for small
		if($size == 'small')
		{
			// Define thumbnail parameters
			$maxwidth = 100;
			$maxheight = 5000;
			$destination = $filepath . $image_id . '_small.jpg';
		}
		
		// Check for medium
		if($size == 'medium')
		{
			// Define thumbnail parameters
			$maxwidth = 200;
			$maxheight = 5000;
			$destination = $filepath . $image_id . '_medium.jpg';
		}
		
		// Check for large
		if($size == 'large')
		{
			// Define thumbnail parameters
			$maxwidth = 500;
			$maxheight = 5000;
			$destination = $filepath . $image_id . '_large.jpg';
		}
		
		global $DIR;
		
		// Check image size
		$size = @getimagesize($tempfile);
		if(!$size)
		{
			return false;
		}
		$width = $size[0];
		$height = $size[1];
		$scale = min($maxwidth/$width, $maxheight/$height);
		
		// Create new jpeg holder
		$img = null;
		$img = @imagecreatefromjpeg($tempfile);
		
		// Calculate new dimensions.
		$newwidth = floor($scale * $width);
		$newheight = floor($scale * $height);

		// Create a new temporary image.
		$tmpimg = imagecreatetruecolor($newwidth, $newheight);

		// Copy and resize old image into new image.
		imagecopyresampled($tmpimg, $img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		imagejpeg($tmpimg, $destination, 100);
		imagedestroy($img);
		
		return true;
		
	}
	
	# Cleans time for returning
	public static function cleantime($time)
	{
		// Convert time to an array
		$timearray = explode(':', $time);
		if($timearray[0] > 12)
		{
			$timeHour = $timearray[0] - 12;
			$timeMinute = $timearray[1];
			$timeAmpm = 'pm';
		} else {
			$timeHour = $timearray[0];
			$timeMinute = $timearray[1];
			$timeAmpm = 'am';
		}
		$cleantime = array('hour'=>$timeHour, 'minute'=>$timeMinute, 'ampm'=>$timeAmpm);
		return $cleantime;
	}
	
	# Cleans time for inputting
	public static function inputtime($hour, $minute, $ampm)
	{
		if($ampm == 'pm')
		{
			$time = $hour + 12 . ':' . $minute . ':00';
		} else {
			$time = $hour . ':' . $minute . ':00';
		}
		return $time;
	}
}

?>
