<?php /* Smarty version 2.6.19, created on 2008-07-17 11:37:42
         compiled from manageride.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Purpool</title>

<link href="css/styles.css" rel="stylesheet" type="text/css" />

<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>

<script language="javascript" src="js/scriptaculous/src/scriptaculous.js"></script>

<script language="javascript" src="js/formfocus.js"></script>

<script language="javascript" src="js/indicator.js"></script>

<script language="javascript" src="js/createride.js"></script>

</head>



<body>



	<!-- Header -->

    <div id="header">

    	

        <!-- Purpool Logo -->

        <img src="images/logo.gif" alt="Purpool" />

        

        <!-- Top Navigation -->

        <div id="topnav">

        	<ul>

            	<li><a href="index.php">Home</a></li>

                <li><a href="about.php">About</a></li>

                <li><a href="contact.php">Contact</a></li>

            </ul>

        </div>

        

    </div>

    

    <!-- Left Column -->

    <div id="leftcolumn">

    

    	<!-- Display User Photo -->

        <?php if ($this->_tpl_vars['userphoto']): ?>

        	<div id="userPhoto">

	        	<img src="users/<?php echo $this->_tpl_vars['userphoto']; ?>
" alt="" />

			</div>

        <?php endif; ?>

        

        <!-- Display User Information -->

        <div id="userInfo">

        	<?php echo $this->_tpl_vars['fullname']; ?>


        </div>

        

        <!-- User Options -->

        <ul id="leftnav">

        	<li><a href="admin.php" class="current">View My Rides</a></li>

        	<li><a href="admin.php?state=updateprofile">Update Profile</a></li>

            <li><a href="admin.php?state=createride">Create a Ride</a></li>

            <li><a href="admin.php?state=requestride">Request a Ride</a></li>

        </ul>

    

    </div>

    

    <!-- Right Column -->

    <div id="rightcolumn">

    

    	<!-- Page Title -->

        <h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>

        

        <!-- Tabs -->

        <div id="tabs">

        	<ul>

            	<li class="current"><a href="admin.php?state=manageride&ride=<?php echo $this->_tpl_vars['ride_id']; ?>
">Ride Information</a></li>

                <li><a href="admin.php?state=directions&ride=<?php echo $this->_tpl_vars['ride_id']; ?>
">Directions</a></li>

                <li><a href="admin.php?state=statistics&ride=<?php echo $this->_tpl_vars['ride_id']; ?>
">Savings</a></li>

            </ul>

        </div>

        

        <div style="margin-top: 75px"></div>

        

        <!-- Ride Form -->

        <form id="rideForm" method="post" action="admin.php?state=manageride">

            

   			<!-- Departure -->

            <div class="purplebox">

                <img src="icons/icon-users.gif" alt="" class="icon" /> General Ride Information

            </div>

            

            <!-- Start Place -->

            <div class="formelement">

                <label for="rideTitle"><span class="required">*</span> Title of Ride</label>

                <input id="rideTitle" name="rideTitle" type="text" value="<?php echo $this->_tpl_vars['ridetitle']; ?>
" maxlength="100" class="textbox" />

                <span id="rideTitleError" class="formerror"><?php echo $this->_tpl_vars['error']['rideTitle']; ?>
</span>

            </div>

            

            <!-- Total number of seats -->

            <div class="formelement">

                <label for="rideSeats"><span class="required">*</span> Total number of seats (excluding you)</label>

                <select name="rideSeats" class="select">

                    <option value="2" <?php if ($this->_tpl_vars['rideseats'] == '2'): ?>selected="selected"<?php endif; ?>>2</option>

                    <option value="3" <?php if ($this->_tpl_vars['rideseats'] == '3'): ?>selected="selected"<?php endif; ?>>3</option>

                    <option value="4" <?php if ($this->_tpl_vars['rideseats'] == '4'): ?>selected="selected"<?php endif; ?>>4</option>

                    <option value="5" <?php if ($this->_tpl_vars['rideseats'] == '5'): ?>selected="selected"<?php endif; ?>>5</option>

                    <option value="6" <?php if ($this->_tpl_vars['rideseats'] == '6'): ?>selected="selected"<?php endif; ?>>6</option>

                    <option value="7" <?php if ($this->_tpl_vars['rideseats'] == '7'): ?>selected="selected"<?php endif; ?>>7</option>

                    <option value="8" <?php if ($this->_tpl_vars['rideseats'] == '8'): ?>selected="selected"<?php endif; ?>>8</option>

                    <option value="9" <?php if ($this->_tpl_vars['rideseats'] == '9'): ?>selected="selected"<?php endif; ?>>9</option>

                    <option value="10" <?php if ($this->_tpl_vars['rideseats'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>

                </select>

            </div>

            

            <!-- Ride Type -->

            <div class="formelement">

                <label for="rideType"><span class="required">*</span> Ride Type</label>

                <input id="typeRound" name="rideType" type="radio" value="round" <?php if ($this->_tpl_vars['ridetype'] == 'round'): ?>checked="checked"<?php endif; ?> /> Round Trip<br />

                <input id="typeOneWay" name="rideType" type="radio" value="oneway" <?php if ($this->_tpl_vars['ridetype'] == 'oneway'): ?>checked="checked"<?php endif; ?> /> One Way

			</div>

            

            <!-- Frequency -->

            <div class="formelement">

                <label for="frequencyWeek"><span class="required">*</span> Frequency</label>

                <input id="frequencyNone" name="rideFrequency" type="radio" value="once" <?php if ($this->_tpl_vars['ridefrequency'] == 'once'): ?>checked="checked"<?php endif; ?> /> Once<br />

                <input id="frequencyWeek" name="rideFrequency" type="radio" value="weekly" <?php if ($this->_tpl_vars['ridefrequency'] == 'weekly'): ?>checked="checked"<?php endif; ?> /> Weekly <br />

                <input id="frequencyBiWeekly" name="rideFrequency" type="radio" value="biweekly" <?php if ($this->_tpl_vars['ridefrequency'] == 'biweekly'): ?>checked="checked"<?php endif; ?> /> Bi-weekly <br />

                <input id="frequencyMonthly" name="rideFrequency" type="radio" value="monthly" <?php if ($this->_tpl_vars['ridefrequency'] == 'monthly'): ?>checked="checked"<?php endif; ?> /> Monthly <br />

			</div>

            

             <!-- Start Frequency -->

            <div class="formelement">

                <label for="startSunday"><span class="required">*</span> Days of Week</label>

                <input id="sunday" name="sunday" type="checkbox" value="y" <?php if ($this->_tpl_vars['sunday']): ?>checked="checked"<?php endif; ?> /> Sunday <br />

                <input id="monday" name="monday" type="checkbox" value="y" <?php if ($this->_tpl_vars['monday']): ?>checked="checked"<?php endif; ?> /> Monday <br />

                <input id="tuesday" name="tuesday" type="checkbox" value="y" <?php if ($this->_tpl_vars['tuesday']): ?>checked="checked"<?php endif; ?> /> Tuesday <br />

                <input id="wednesday" name="wednesday" type="checkbox" value="y" <?php if ($this->_tpl_vars['wednesday']): ?>checked="checked"<?php endif; ?> /> Wednesday <br />

                <input id="thursday" name="thursday" type="checkbox" value="y" <?php if ($this->_tpl_vars['thursday']): ?>checked="checked"<?php endif; ?> /> Thursday <br />

                <input id="friday" name="friday" type="checkbox" value="y" <?php if ($this->_tpl_vars['friday']): ?>checked="checked"<?php endif; ?> /> Friday <br />

                <input id="saturday" name="saturday" type="checkbox" value="y" <?php if ($this->_tpl_vars['saturday']): ?>checked="checked"<?php endif; ?> /> Saturday

                <div id="daysofweekError" class="formerror"><?php echo $this->_tpl_vars['error']['daysofweek']; ?>
</div>

			</div>

            

            <!-- Smoking -->

            <div class="formelement">

                <label for="smoking"><span class="required">*</span> Smoking Allowed?</label>

                <input id="smokingNo" name="smoking" type="radio" value="no" <?php if ($this->_tpl_vars['smoking'] == 'n'): ?>checked="checked"<?php endif; ?> /> No <br />

                <input id="smokingYes" name="smoking" type="radio" value="yes" <?php if ($this->_tpl_vars['smoking'] == 'y'): ?>checked="checked"<?php endif; ?> /> Yes <br />

			</div>

            

            <!-- Departure -->

            <div class="purplebox">

                <img src="icons/arrow_orange_right.gif" alt="" class="icon" /> Departure

            </div>

           

            <!-- General error -->

            <div id="generalError" class="formerror" style="display: none; margin-bottom: 15px;"></div>

            

            <!-- Start Address 1 -->

            <div class="formelement">

                <label for="startAddress1"><span class="required">*</span> Address</label>

                <input id="startAddress1" name="startAddress1" type="text" value="<?php echo $this->_tpl_vars['startaddress1']; ?>
" maxlength="100" class="textbox" />

                <span id="startAddress1Error" class="formerror"><?php echo $this->_tpl_vars['error']['startAddress1']; ?>
</span><br />

                <input id="startAddress2" name="startAddress2" type="text" value="<?php echo $this->_tpl_vars['startaddress2']; ?>
" maxlength="100" class="textbox" style="margin-top: 5px;" />

            </div>

            

            <!-- Start City -->

            <div class="formelement">

                <label for="startCity"><span class="required">*</span> City</label>

                <input id="startCity" name="startCity" type="text" value="<?php echo $this->_tpl_vars['startcity']; ?>
" maxlength="100" class="textbox" />

                <span id="startCityError" class="formerror"><?php echo $this->_tpl_vars['error']['startCity']; ?>
</span>

            </div>

            

            <!-- Start State -->

            <div class="formelement">

                <label for="startState"><span class="required">*</span> State</label>

                <select name="startState" class="select">

                	<option value="">-- select --</option>

                    <option value="AL" <?php if ($this->_tpl_vars['startstate'] == 'AL'): ?>selected="selected"<?php endif; ?>>Alabama</option>

                    <option value="AK" <?php if ($this->_tpl_vars['startstate'] == 'AK'): ?>selected="selected"<?php endif; ?>>Alaska</option>

                    <option value="AZ" <?php if ($this->_tpl_vars['startstate'] == 'AZ'): ?>selected="selected"<?php endif; ?>>Arizona</option>

                    <option value="AR" <?php if ($this->_tpl_vars['startstate'] == 'AR'): ?>selected="selected"<?php endif; ?>>Arkansas</option>

                    <option value="CA" <?php if ($this->_tpl_vars['startstate'] == 'CA'): ?>selected="selected"<?php endif; ?>>California</option>

                    <option value="CO" <?php if ($this->_tpl_vars['startstate'] == 'CO'): ?>selected="selected"<?php endif; ?>>Colorado</option>

                    <option value="CT" <?php if ($this->_tpl_vars['startstate'] == 'CT'): ?>selected="selected"<?php endif; ?>>Connecticut</option>

                    <option value="DE" <?php if ($this->_tpl_vars['startstate'] == 'DE'): ?>selected="selected"<?php endif; ?>>Delaware</option>

                    <option value="DC" <?php if ($this->_tpl_vars['startstate'] == 'DC'): ?>selected="selected"<?php endif; ?>>District of Columbia</option>

                    <option value="FL" <?php if ($this->_tpl_vars['startstate'] == 'FL'): ?>selected="selected"<?php endif; ?>>Florida</option>

                    <option value="GA" <?php if ($this->_tpl_vars['startstate'] == 'GA'): ?>selected="selected"<?php endif; ?>>Georgia</option>

                    <option value="HI" <?php if ($this->_tpl_vars['startstate'] == 'HI'): ?>selected="selected"<?php endif; ?>>Hawaii</option>

                    <option value="ID" <?php if ($this->_tpl_vars['startstate'] == 'ID'): ?>selected="selected"<?php endif; ?>>Idaho</option>

                    <option value="IL" <?php if ($this->_tpl_vars['startstate'] == 'IL'): ?>selected="selected"<?php endif; ?>>Illinois</option>

                    <option value="IN" <?php if ($this->_tpl_vars['startstate'] == 'IN'): ?>selected="selected"<?php endif; ?>>Indiana</option>

                    <option value="IA" <?php if ($this->_tpl_vars['startstate'] == 'IA'): ?>selected="selected"<?php endif; ?>>Iowa</option>

                    <option value="KS" <?php if ($this->_tpl_vars['startstate'] == 'KS'): ?>selected="selected"<?php endif; ?>>Kansas</option>

                    <option value="KY" <?php if ($this->_tpl_vars['startstate'] == 'KY'): ?>selected="selected"<?php endif; ?>>Kentucky</option>

                    <option value="LA" <?php if ($this->_tpl_vars['startstate'] == 'LA'): ?>selected="selected"<?php endif; ?>>Louisiana</option>

                    <option value="ME" <?php if ($this->_tpl_vars['startstate'] == 'ME'): ?>selected="selected"<?php endif; ?>>Maine</option>

                    <option value="MD" <?php if ($this->_tpl_vars['startstate'] == 'MD'): ?>selected="selected"<?php endif; ?>>Maryland</option>

                    <option value="MA" <?php if ($this->_tpl_vars['startstate'] == 'MA'): ?>selected="selected"<?php endif; ?>>Massachusetts</option>

                    <option value="MI" <?php if ($this->_tpl_vars['startstate'] == 'MI'): ?>selected="selected"<?php endif; ?>>Michigan</option>

                    <option value="MN" <?php if ($this->_tpl_vars['startstate'] == 'MN'): ?>selected="selected"<?php endif; ?>>Minnesota</option>

                    <option value="MS" <?php if ($this->_tpl_vars['startstate'] == 'MS'): ?>selected="selected"<?php endif; ?>>Mississippi</option>

                    <option value="MO" <?php if ($this->_tpl_vars['startstate'] == 'MO'): ?>selected="selected"<?php endif; ?>>Missouri</option>

                    <option value="MT" <?php if ($this->_tpl_vars['startstate'] == 'MT'): ?>selected="selected"<?php endif; ?>>Montana</option>

                    <option value="NE" <?php if ($this->_tpl_vars['startstate'] == 'NE'): ?>selected="selected"<?php endif; ?>>Nebraska</option>

                    <option value="NV" <?php if ($this->_tpl_vars['startstate'] == 'NV'): ?>selected="selected"<?php endif; ?>>Nevada</option>

                    <option value="NH" <?php if ($this->_tpl_vars['startstate'] == 'NH'): ?>selected="selected"<?php endif; ?>>New Hampshire</option>

                    <option value="NJ" <?php if ($this->_tpl_vars['startstate'] == 'NJ'): ?>selected="selected"<?php endif; ?>>New Jersey</option>

                    <option value="NM" <?php if ($this->_tpl_vars['startstate'] == 'NM'): ?>selected="selected"<?php endif; ?>>New Mexico</option>

                    <option value="NY" <?php if ($this->_tpl_vars['startstate'] == 'NY'): ?>selected="selected"<?php endif; ?>>New York</option>

                    <option value="NC" <?php if ($this->_tpl_vars['startstate'] == 'NC'): ?>selected="selected"<?php endif; ?>>North Carolina</option>

                    <option value="ND" <?php if ($this->_tpl_vars['startstate'] == 'ND'): ?>selected="selected"<?php endif; ?>>North Dakota</option>

                    <option value="OH" <?php if ($this->_tpl_vars['startstate'] == 'OH'): ?>selected="selected"<?php endif; ?>>Ohio</option>

                    <option value="OK" <?php if ($this->_tpl_vars['startstate'] == 'OK'): ?>selected="selected"<?php endif; ?>>Oklahoma</option>

                    <option value="OR" <?php if ($this->_tpl_vars['startstate'] == 'OR'): ?>selected="selected"<?php endif; ?>>Oregon</option>

                    <option value="PA" <?php if ($this->_tpl_vars['startstate'] == 'PA'): ?>selected="selected"<?php endif; ?>>Pennsylvania</option>

                    <option value="RI" <?php if ($this->_tpl_vars['startstate'] == 'RI'): ?>selected="selected"<?php endif; ?>>Rhode Island</option>

                    <option value="SC" <?php if ($this->_tpl_vars['startstate'] == 'SC'): ?>selected="selected"<?php endif; ?>>South Carolina</option>

                    <option value="SD" <?php if ($this->_tpl_vars['startstate'] == 'SD'): ?>selected="selected"<?php endif; ?>>South Dakota</option>

                    <option value="TN" <?php if ($this->_tpl_vars['startstate'] == 'TN'): ?>selected="selected"<?php endif; ?>>Tennessee</option>

                    <option value="TX" <?php if ($this->_tpl_vars['startstate'] == 'TX'): ?>selected="selected"<?php endif; ?>>Texas</option>

                    <option value="UT" <?php if ($this->_tpl_vars['startstate'] == 'UT'): ?>selected="selected"<?php endif; ?>>Utah</option>

                    <option value="VT" <?php if ($this->_tpl_vars['startstate'] == 'VT'): ?>selected="selected"<?php endif; ?>>Vermont</option>

                    <option value="VA" <?php if ($this->_tpl_vars['startstate'] == 'VA'): ?>selected="selected"<?php endif; ?>>Virginia</option>

                    <option value="WA" <?php if ($this->_tpl_vars['startstate'] == 'WA'): ?>selected="selected"<?php endif; ?>>Washington</option>

                    <option value="WV" <?php if ($this->_tpl_vars['startstate'] == 'WV'): ?>selected="selected"<?php endif; ?>>West Virginia</option>

                    <option value="WI" <?php if ($this->_tpl_vars['startstate'] == 'WI'): ?>selected="selected"<?php endif; ?>>Wisconsin</option>

                    <option value="WY" <?php if ($this->_tpl_vars['startstate'] == 'WY'): ?>selected="selected"<?php endif; ?>>Wyoming</option>

                </select>

                <span id="startStateError" class="formerror"><?php echo $this->_tpl_vars['error']['startState']; ?>
</span>

            </div>

            

            <!-- Start Zip -->

            <div class="formelement">

                <label for="startZip"><span class="required">*</span> Zipcode</label>

                <input id="startZip" name="startZip" type="text" value="<?php echo $this->_tpl_vars['startzip']; ?>
" maxlength="100" class="textbox" />

                <span id="startZipError" class="formerror"><?php echo $this->_tpl_vars['error']['startZip']; ?>
</span>

            </div>

            

            <!-- Desination -->

            <div class="purplebox">

                <img src="icons/arrow_orange_right.gif" alt="" class="icon" /> Destination

            </div>

           

            <!-- General error -->

            <div id="generalError" class="formerror" style="display: none; margin-bottom: 15px;"></div>

            

			<!-- Default Destination Dropdown -->

            <div class="formelement">

            	<label for="endPlace"><span class="required">*</span> Place of Destination</label>

                <select id="endPlace" name="endPlace" class="select">

                	<option value="">-- select --</option>

                    <option value="pepsi">PepsiCo: Purchase, NY</option>

                    <option value="other">Other</option>

                </select>

            </div>

            

            <!-- End Address 1 -->

            <div class="formelement">

                <label for="endAddress1"><span class="required">*</span> Address</label>

                <input id="endAddress1" name="endAddress1" type="text" value="<?php echo $this->_tpl_vars['endaddress1']; ?>
" maxlength="100" class="textbox" />

                <span id="endAddress1Error" class="formerror"><?php echo $this->_tpl_vars['error']['endAddress1']; ?>
</span><br />

                <input id="endAddress2" name="endAddress2" type="text" value="<?php echo $this->_tpl_vars['endaddress2']; ?>
" maxlength="100" class="textbox" style="margin-top: 5px;" />

                <span id="endAddress2Error" class="formerror"></span>

            </div>

            

            <!-- End City -->

            <div class="formelement">

                <label for="endCity"><span class="required">*</span> City</label>

                <input id="endCity" name="endCity" type="text" value="<?php echo $this->_tpl_vars['endcity']; ?>
" maxlength="100" class="textbox" />

                <span id="endCityError" class="formerror"><?php echo $this->_tpl_vars['error']['endCity']; ?>
</span>

            </div>

            

            <!-- End State -->

            <div class="formelement">

                <label for="endState"><span class="required">*</span> State</label>

                <select id="endState" name="endState" class="select">

                    <option value="">-- select --</option>

                    <option value="AL" <?php if ($this->_tpl_vars['endstate'] == 'AL'): ?>selected="selected"<?php endif; ?>>Alabama</option>

                    <option value="AK" <?php if ($this->_tpl_vars['endstate'] == 'AK'): ?>selected="selected"<?php endif; ?>>Alaska</option>

                    <option value="AZ" <?php if ($this->_tpl_vars['endstate'] == 'AZ'): ?>selected="selected"<?php endif; ?>>Arizona</option>

                    <option value="AR" <?php if ($this->_tpl_vars['endstate'] == 'AR'): ?>selected="selected"<?php endif; ?>>Arkansas</option>

                    <option value="CA" <?php if ($this->_tpl_vars['endstate'] == 'CA'): ?>selected="selected"<?php endif; ?>>California</option>

                    <option value="CO" <?php if ($this->_tpl_vars['endstate'] == 'CO'): ?>selected="selected"<?php endif; ?>>Colorado</option>

                    <option value="CT" <?php if ($this->_tpl_vars['endstate'] == 'CT'): ?>selected="selected"<?php endif; ?>>Connecticut</option>

                    <option value="DE" <?php if ($this->_tpl_vars['endstate'] == 'DE'): ?>selected="selected"<?php endif; ?>>Delaware</option>

                    <option value="DC" <?php if ($this->_tpl_vars['endstate'] == 'DC'): ?>selected="selected"<?php endif; ?>>District of Columbia</option>

                    <option value="FL" <?php if ($this->_tpl_vars['endstate'] == 'FL'): ?>selected="selected"<?php endif; ?>>Florida</option>

                    <option value="GA" <?php if ($this->_tpl_vars['endstate'] == 'GA'): ?>selected="selected"<?php endif; ?>>Georgia</option>

                    <option value="HI" <?php if ($this->_tpl_vars['endstate'] == 'HI'): ?>selected="selected"<?php endif; ?>>Hawaii</option>

                    <option value="ID" <?php if ($this->_tpl_vars['endstate'] == 'ID'): ?>selected="selected"<?php endif; ?>>Idaho</option>

                    <option value="IL" <?php if ($this->_tpl_vars['endstate'] == 'IL'): ?>selected="selected"<?php endif; ?>>Illinois</option>

                    <option value="IN" <?php if ($this->_tpl_vars['endstate'] == 'IN'): ?>selected="selected"<?php endif; ?>>Indiana</option>

                    <option value="IA" <?php if ($this->_tpl_vars['endstate'] == 'IA'): ?>selected="selected"<?php endif; ?>>Iowa</option>

                    <option value="KS" <?php if ($this->_tpl_vars['endstate'] == 'KS'): ?>selected="selected"<?php endif; ?>>Kansas</option>

                    <option value="KY" <?php if ($this->_tpl_vars['endstate'] == 'KY'): ?>selected="selected"<?php endif; ?>>Kentucky</option>

                    <option value="LA" <?php if ($this->_tpl_vars['endstate'] == 'LA'): ?>selected="selected"<?php endif; ?>>Louisiana</option>

                    <option value="ME" <?php if ($this->_tpl_vars['endstate'] == 'ME'): ?>selected="selected"<?php endif; ?>>Maine</option>

                    <option value="MD" <?php if ($this->_tpl_vars['endstate'] == 'MD'): ?>selected="selected"<?php endif; ?>>Maryland</option>

                    <option value="MA" <?php if ($this->_tpl_vars['endstate'] == 'MA'): ?>selected="selected"<?php endif; ?>>Massachusetts</option>

                    <option value="MI" <?php if ($this->_tpl_vars['endstate'] == 'MI'): ?>selected="selected"<?php endif; ?>>Michigan</option>

                    <option value="MN" <?php if ($this->_tpl_vars['endstate'] == 'MN'): ?>selected="selected"<?php endif; ?>>Minnesota</option>

                    <option value="MS" <?php if ($this->_tpl_vars['endstate'] == 'MS'): ?>selected="selected"<?php endif; ?>>Mississippi</option>

                    <option value="MO" <?php if ($this->_tpl_vars['endstate'] == 'MO'): ?>selected="selected"<?php endif; ?>>Missouri</option>

                    <option value="MT" <?php if ($this->_tpl_vars['endstate'] == 'MT'): ?>selected="selected"<?php endif; ?>>Montana</option>

                    <option value="NE" <?php if ($this->_tpl_vars['endstate'] == 'NE'): ?>selected="selected"<?php endif; ?>>Nebraska</option>

                    <option value="NV" <?php if ($this->_tpl_vars['endstate'] == 'NV'): ?>selected="selected"<?php endif; ?>>Nevada</option>

                    <option value="NH" <?php if ($this->_tpl_vars['endstate'] == 'NH'): ?>selected="selected"<?php endif; ?>>New Hampshire</option>

                    <option value="NJ" <?php if ($this->_tpl_vars['endstate'] == 'NJ'): ?>selected="selected"<?php endif; ?>>New Jersey</option>

                    <option value="NM" <?php if ($this->_tpl_vars['endstate'] == 'NM'): ?>selected="selected"<?php endif; ?>>New Mexico</option>

                    <option value="NY" <?php if ($this->_tpl_vars['endstate'] == 'NY'): ?>selected="selected"<?php endif; ?>>New York</option>

                    <option value="NC" <?php if ($this->_tpl_vars['endstate'] == 'NC'): ?>selected="selected"<?php endif; ?>>North Carolina</option>

                    <option value="ND" <?php if ($this->_tpl_vars['endstate'] == 'ND'): ?>selected="selected"<?php endif; ?>>North Dakota</option>

                    <option value="OH" <?php if ($this->_tpl_vars['endstate'] == 'OH'): ?>selected="selected"<?php endif; ?>>Ohio</option>

                    <option value="OK" <?php if ($this->_tpl_vars['endstate'] == 'OK'): ?>selected="selected"<?php endif; ?>>Oklahoma</option>

                    <option value="OR" <?php if ($this->_tpl_vars['endstate'] == 'OR'): ?>selected="selected"<?php endif; ?>>Oregon</option>

                    <option value="PA" <?php if ($this->_tpl_vars['endstate'] == 'PA'): ?>selected="selected"<?php endif; ?>>Pennsylvania</option>

                    <option value="RI" <?php if ($this->_tpl_vars['endstate'] == 'RI'): ?>selected="selected"<?php endif; ?>>Rhode Island</option>

                    <option value="SC" <?php if ($this->_tpl_vars['endstate'] == 'SC'): ?>selected="selected"<?php endif; ?>>South Carolina</option>

                    <option value="SD" <?php if ($this->_tpl_vars['endstate'] == 'SD'): ?>selected="selected"<?php endif; ?>>South Dakota</option>

                    <option value="TN" <?php if ($this->_tpl_vars['endstate'] == 'TN'): ?>selected="selected"<?php endif; ?>>Tennessee</option>

                    <option value="TX" <?php if ($this->_tpl_vars['endstate'] == 'TX'): ?>selected="selected"<?php endif; ?>>Texas</option>

                    <option value="UT" <?php if ($this->_tpl_vars['endstate'] == 'UT'): ?>selected="selected"<?php endif; ?>>Utah</option>

                    <option value="VT" <?php if ($this->_tpl_vars['endstate'] == 'VT'): ?>selected="selected"<?php endif; ?>>Vermont</option>

                    <option value="VA" <?php if ($this->_tpl_vars['endstate'] == 'VA'): ?>selected="selected"<?php endif; ?>>Virginia</option>

                    <option value="WA" <?php if ($this->_tpl_vars['endstate'] == 'WA'): ?>selected="selected"<?php endif; ?>>Washington</option>

                    <option value="WV" <?php if ($this->_tpl_vars['endstate'] == 'WV'): ?>selected="selected"<?php endif; ?>>West Virginia</option>

                    <option value="WI" <?php if ($this->_tpl_vars['endstate'] == 'WI'): ?>selected="selected"<?php endif; ?>>Wisconsin</option>

                    <option value="WY" <?php if ($this->_tpl_vars['endstate'] == 'WY'): ?>selected="selected"<?php endif; ?>>Wyoming</option>

                </select>

                <span id="endStateError" class="formerror"><?php echo $this->_tpl_vars['error']['endState']; ?>
</span>

            </div>

            

            <!-- End Zip -->

            <div class="formelement">

                <label for="endZip"><span class="required">*</span> Zipcode</label>

                <input id="endZip" name="endZip" type="text" value="<?php echo $this->_tpl_vars['endzip']; ?>
" maxlength="100" class="textbox" />

                <span id="endZipError" class="formerror"><?php echo $this->_tpl_vars['error']['endZip']; ?>
</span>

            </div>



            <!-- Destination Arrival  -->

            <div class="formelement">

                <label for="arriveTime"><span class="required">*</span> Arrive at Destination</label>

                <select name="arriveHour" class="select" style="width: auto">

                	<option value="1" <?php if ($this->_tpl_vars['arrivehour'] == '1'): ?>selected="selected"<?php endif; ?>>1</option>

                    <option value="2" <?php if ($this->_tpl_vars['arrivehour'] == '2'): ?>selected="selected"<?php endif; ?>>2</option>

                    <option value="3" <?php if ($this->_tpl_vars['arrivehour'] == '3'): ?>selected="selected"<?php endif; ?>>3</option>

                    <option value="4" <?php if ($this->_tpl_vars['arrivehour'] == '4'): ?>selected="selected"<?php endif; ?>>4</option>

                    <option value="5" <?php if ($this->_tpl_vars['arrivehour'] == '5'): ?>selected="selected"<?php endif; ?>>5</option>

                    <option value="6" <?php if ($this->_tpl_vars['arrivehour'] == '6'): ?>selected="selected"<?php endif; ?>>6</option>

                    <option value="7" <?php if ($this->_tpl_vars['arrivehour'] == '7'): ?>selected="selected"<?php endif; ?>>7</option>

                    <option value="8" <?php if ($this->_tpl_vars['arrivehour'] == '8'): ?>selected="selected"<?php endif; ?>>8</option>

                    <option value="9" <?php if ($this->_tpl_vars['arrivehour'] == '9'): ?>selected="selected"<?php endif; ?>>9</option>

                    <option value="10" <?php if ($this->_tpl_vars['arrivehour'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>

                    <option value="11" <?php if ($this->_tpl_vars['arrivehour'] == '11'): ?>selected="selected"<?php endif; ?>>11</option>

                    <option value="12" <?php if ($this->_tpl_vars['arrivehour'] == '12'): ?>selected="selected"<?php endif; ?>>12</option>

                </select>

                <select name="arriveMinute" class="select" style="width: auto">

                	<option value="00" <?php if ($this->_tpl_vars['arriveminute'] == '00'): ?>selected="selected"<?php endif; ?>>00</option>

                    <option value="05" <?php if ($this->_tpl_vars['arriveminute'] == '05'): ?>selected="selected"<?php endif; ?>>05</option>

                    <option value="10" <?php if ($this->_tpl_vars['arriveminute'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>

                    <option value="15" <?php if ($this->_tpl_vars['arriveminute'] == '05'): ?>selected="selected"<?php endif; ?>>15</option>

                    <option value="20" <?php if ($this->_tpl_vars['arriveminute'] == '20'): ?>selected="selected"<?php endif; ?>>20</option>

                    <option value="25" <?php if ($this->_tpl_vars['arriveminute'] == '25'): ?>selected="selected"<?php endif; ?>>25</option>

                    <option value="30" <?php if ($this->_tpl_vars['arriveminute'] == '30'): ?>selected="selected"<?php endif; ?>>30</option>

                    <option value="35" <?php if ($this->_tpl_vars['arriveminute'] == '35'): ?>selected="selected"<?php endif; ?>>35</option>

                    <option value="40" <?php if ($this->_tpl_vars['arriveminute'] == '40'): ?>selected="selected"<?php endif; ?>>40</option>

                    <option value="45" <?php if ($this->_tpl_vars['arriveminute'] == '45'): ?>selected="selected"<?php endif; ?>>45</option>

                    <option value="50" <?php if ($this->_tpl_vars['arriveminute'] == '50'): ?>selected="selected"<?php endif; ?>>50</option>

                    <option value="55" <?php if ($this->_tpl_vars['arriveminute'] == '55'): ?>selected="selected"<?php endif; ?>>55</option>

                </select>

                <select name="arriveAmpm" class="select" style="width: auto">

                	<option value="am" <?php if ($this->_tpl_vars['arriveampm'] == 'am'): ?>selected="selected"<?php endif; ?>>am</option>

                    <option value="pm" <?php if ($this->_tpl_vars['arriveampm'] == 'pm'): ?>selected="selected"<?php endif; ?>>pm</option>

                </select>

                <span id="arriveTimeError" class="formerror"><?php echo $this->_tpl_vars['error']['arriveTime']; ?>
</span>

            </div>

 

			<!-- Destination Departure  -->

            <div id="departTime" class="formelement">

                <label for="departTime"><span class="required">*</span> Depart from Destination</label>

                <select name="departHour" class="select" style="width: auto">

                	<option value="1" <?php if ($this->_tpl_vars['departhour'] == '1'): ?>selected="selected"<?php endif; ?>>1</option>

                    <option value="2" <?php if ($this->_tpl_vars['departhour'] == '2'): ?>selected="selected"<?php endif; ?>>2</option>

                    <option value="3" <?php if ($this->_tpl_vars['departhour'] == '3'): ?>selected="selected"<?php endif; ?>>3</option>

                    <option value="4" <?php if ($this->_tpl_vars['departhour'] == '4'): ?>selected="selected"<?php endif; ?>>4</option>

                    <option value="5" <?php if ($this->_tpl_vars['departhour'] == '5'): ?>selected="selected"<?php endif; ?>>5</option>

                    <option value="6" <?php if ($this->_tpl_vars['departhour'] == '6'): ?>selected="selected"<?php endif; ?>>6</option>

                    <option value="7" <?php if ($this->_tpl_vars['departhour'] == '7'): ?>selected="selected"<?php endif; ?>>7</option>

                    <option value="8" <?php if ($this->_tpl_vars['departhour'] == '8'): ?>selected="selected"<?php endif; ?>>8</option>

                    <option value="9" <?php if ($this->_tpl_vars['departhour'] == '9'): ?>selected="selected"<?php endif; ?>>9</option>

                    <option value="10" <?php if ($this->_tpl_vars['departhour'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>

                    <option value="11" <?php if ($this->_tpl_vars['departhour'] == '11'): ?>selected="selected"<?php endif; ?>>11</option>

                    <option value="12" <?php if ($this->_tpl_vars['departhour'] == '12'): ?>selected="selected"<?php endif; ?>>12</option>

                </select>

                <select name="departMinute" class="select" style="width: auto">

                	<option value="00" <?php if ($this->_tpl_vars['departminute'] == '00'): ?>selected="selected"<?php endif; ?>>00</option>

                    <option value="05" <?php if ($this->_tpl_vars['departminute'] == '05'): ?>selected="selected"<?php endif; ?>>05</option>

                    <option value="10" <?php if ($this->_tpl_vars['departminute'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>

                    <option value="15" <?php if ($this->_tpl_vars['departminute'] == '15'): ?>selected="selected"<?php endif; ?>>15</option>

                    <option value="20" <?php if ($this->_tpl_vars['departminute'] == '20'): ?>selected="selected"<?php endif; ?>>20</option>

                    <option value="25" <?php if ($this->_tpl_vars['departminute'] == '25'): ?>selected="selected"<?php endif; ?>>25</option>

                    <option value="30" <?php if ($this->_tpl_vars['departminute'] == '30'): ?>selected="selected"<?php endif; ?>>30</option>

                    <option value="35" <?php if ($this->_tpl_vars['departminute'] == '35'): ?>selected="selected"<?php endif; ?>>35</option>

                    <option value="40" <?php if ($this->_tpl_vars['departminute'] == '40'): ?>selected="selected"<?php endif; ?>>40</option>

                    <option value="45" <?php if ($this->_tpl_vars['departminute'] == '45'): ?>selected="selected"<?php endif; ?>>45</option>

                    <option value="50" <?php if ($this->_tpl_vars['departminute'] == '50'): ?>selected="selected"<?php endif; ?>>50</option>

                    <option value="55" <?php if ($this->_tpl_vars['departminute'] == '55'): ?>selected="selected"<?php endif; ?>>55</option>

                </select>

                <select name="departAmpm" class="select" style="width: auto">

                	<option value="am" <?php if ($this->_tpl_vars['departampm'] == 'am'): ?>selected="selected"<?php endif; ?>>am</option>

                    <option value="pm" <?php if ($this->_tpl_vars['departampm'] == 'pm'): ?>selected="selected"<?php endif; ?>>pm</option>

                </select>

                <span id="departTimeError" class="formerror"><?php echo $this->_tpl_vars['error']['departTime']; ?>
</span>

            </div> 

            

            <!-- Additional Information -->

            <div class="purplebox">

                <img src="icons/icon-info.gif" alt="" class="icon" /> Additional Information

            </div>

            

            <!-- Additional Information -->

            <div class="formelement">

            	<textarea id="additionalinfo" name="additionalinfo" class="textbox" rows="8" style="width: 350px;"><?php echo $this->_tpl_vars['additionalinfo']; ?>
</textarea>

            </div>

 

            <!-- Submit Button -->

           	<div class="formelement">

                <input id="submit" name="submit" type="submit" value="Update Ride" class="submit" />

            </div>

            

        </form>

        

    </div>

    

    <!-- Clear -->

    <div style="clear: both;"></div>

    

    <!-- Indicator -->

    <img id="indicator" src="images/indicator.gif" alt="" style="display: none;"/>

    

</body>

</html>