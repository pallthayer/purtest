<?php
// Include configuration file
include_once('config_path.php'); include_once($config_path.'config.php');

// Include common utility library
include_once($DIR['inc'] . 'Utils.class.php');

// Include database package
include_once($DIR['pear'] . 'MDB2.php');

// Include SMARTY templating engine
include_once($DIR['smarty'] . 'Smarty.class.php');

// Initialize database connection
$dbh = Utils::initDB();

// Initialize templating engine
$tpl = Utils::initTPL();$tpl->assign('site_url', $MISC['site_url']);
	

?>
<html>
	<head>
		<title>Purpool test</title>
	</head>
	<body>
		<h1>Find Your Car</h1>
		<form method="get" name="testForm">
			Year:
			<select name="year">
				<?
				$year = $_GET["year"];
				if(isset($_GET["year"])){
					echo '<option value="'.$year.'">'.$year.'</option>'."\n";
				} else {
					echo '<option>Select Year</option>';
				}
				
				$query = 'SELECT DISTINCT year FROM car_data';
				$res = $mdb2->query($query);
				while($row = $res->fetchRow()){
					echo '<option value="'.$row[0].'">'.$row[0].'</option>'."\n";
				}
				?>
			</select>
			Make: 
			<select name="make">
				<?
				$make = $_GET["make"];
				if(isset($_GET["make"])){
					echo '<option value="'.$make.'">'.$make.'</option>'."\n";
				} else {
					echo '<option>Select Make</option>';
				}
				
				if(isset($_GET["year"])){
					$query = 'SELECT DISTINCT make FROM car_data WHERE year="'.$year.'"';
					$res = $mdb2->query($query);
					while($row = $res->fetchRow()){
						echo '<option value="'.$row[0].'">'.$row[0].'</option>'."\n";
					}
				}
				?>
			</select>
			Model: 
			<select name="model">
				<?
				$model = $_GET["model"];
				if(isset($_GET["model"])){
					echo '<option value="'.$model.'">'.$model.'</option>'."\n";
				} else {
					echo '<option>Select Model</option>';
				}
				
				if(isset($_GET["make"])){
					$query = 'SELECT DISTINCT model FROM car_data WHERE year="'.$year.'" AND make="'.$make.'"';
					$res = $mdb2->query($query);
					while($row = $res->fetchRow()){
						echo '<option value="'.$row[0].'">'.$row[0].'</option>'."\n";
					}
				}
				?>
			</select>
			Transmission:
			<select name="trans">
				<?
				$trans = $_GET["trans"];
				if(isset($_GET["trans"])){
					echo '<option value="'.$trans.'">'.$trans.'</option>'."\n";
				} else {
					echo '<option>Select Transmission</option>';
				}
				
				if(isset($_GET["model"])){
					$query = 'SELECT DISTINCT trans FROM car_data WHERE year="'.$year.'" AND model="'.$model.'"';
					$res = $mdb2->query($query);
					while($row = $res->fetchRow()){
						echo '<option value="'.$row[0].'">'.$row[0].'</option>'."\n";
					}
				}
				?>
			</select>
			Drive: 
			<select name="drive">
				<?
				$drive = $_GET["drive"];
				if(isset($_GET["drive"])){
					echo '<option value="'.$drive.'">'.$drive.'</option>'."\n";
				} else {
					echo '<option>Select Drive Type</option>';
				}
				
				if(isset($_GET["model"])){
					$query = 'SELECT DISTINCT drive FROM car_data WHERE year="'.$year.'" AND model="'.$model.'"';
					$res = $mdb2->query($query);
					while($row = $res->fetchRow()){
						echo '<option value="'.$row[0].'">'.$row[0].'</option>'."\n";
					}
				}
				?>
			</select>
			<input type="submit" name="submit" value="Find" /> <a href="test.php">Reset</a>		
			</form>
		<?
		if(isset($trans) && isset($drive)){
			$query = 'SELECT id FROM car_data WHERE year="'.$year.'" AND model="'.$model.'" AND trans="'.$trans.'"'.
					' AND drive="'.$drive.'"';
			$res = $mdb2->query($query);
			$id	= $res->fetchOne();
			
			$query = 'SELECT cityMPG, hwyMPG, cmbMPG, greenhouseGasScore, airPollutionScore FROM'.
					' car_data WHERE id="'.$id.'"';
			$res = $mdb2->query($query);
			
			$data = $res->fetchRow(MDB2_FETCHMODE_ASSOC);

			echo '
			<h3>Your Results</h3>
			<ul>
			<li>City MPG: '.$data['citympg'].'</li>
			<li>Highway MPG: '.$data['hwympg'].'</li>
			<li>Combined MPG: '.$data['cmbmpg'].'</li>
			<li>Greenhouse Gas Score: '.$data['greenhousegasscore'].'</li>
			<li>Air Pollution Score: '.$data['airpollutionscore'].'</li>
			</ul>
			
			<h4>JSON</h4>
			'.json_encode($data).'
			
			<h4>XML</h4>
			<car>
				<citympg>'.$data['citympg'].'</citympg>
				<hwympg>'.$data['hwympg'].'</hwympg>
				<cmbmpg>'.$data['cmbmpg'].'</cmbmpg>
				<greenhousegasscore>'.$data['greenhousegasscore'].'</greenhousegasscore>
				<airpollutionscore>'.$data['airpollutionscore'].'</airpollutionscore>
			</car>
			';
		}
		?>
	</body>
</html>
