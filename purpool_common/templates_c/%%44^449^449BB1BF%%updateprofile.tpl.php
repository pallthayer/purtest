<?php /* Smarty version 2.6.19, created on 2008-07-17 09:03:00
         compiled from updateprofile.tpl */ ?>
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

<script language="javascript" src="js/register.js"></script>

</head>



<body>



	<!-- Header -->

    <div id="header">

    	

        <!-- Purpool Logo -->

        <img src="images/logo.gif" alt="Purpool" />

        

        <!-- Top Navigation -->

        <div id="topnav">

        	<ul>

            	<li><a href="index.php">Signout</a></li>

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

        	<li><a href="admin.php">View My Rides</a></li>

        	<li><a href="admin.php?state=updateprofile" class="current">Update Profile</a></li>

            <li><a href="admin.php?state=createride">Create a Ride</a></li>

            <li><a href="admin.php?state=requestride">Request a Ride</a></li>

        </ul>

    

    </div>

    

    <!-- Right Column -->

    <div id="rightcolumn">

    

    

    	<!-- Page Title -->

        <h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>

        

        <!-- User Profile -->

        <div class="purplebox">

        	<img src="icons/icon-users.gif" alt="" class="icon" /> User Profile

        </div>

        	

        <!-- General Form -->

        <form id="profileGeneral" method="post" enctype="multipart/form-data" action="admin.php?state=updateprofile">

            

            <!-- Password 

            <div class="formelement">

                <label for="userpass"><span class="required">*</span> Password</label>

                <input id="userpass" name="userpass" type="password" value="<?php echo $this->_tpl_vars['userpass']; ?>
" maxlength="25" class="textbox" />

                <span id="userpassError" class="formerror" style="display: none"></span>

            </div>

            -->

            

            <!-- Firstname -->

            <div class="formelement">

                <label for="firstname"><span class="required">*</span> First Name</label>

                <input id="firstname" name="firstname" type="text" value="<?php echo $this->_tpl_vars['firstname']; ?>
" maxlength="25" class="textbox" />

                <span id="firstnameError" class="formerror"><?php echo $this->_tpl_vars['error']['firstname']; ?>
</span>

            </div>

            

            <!-- Lastname -->

            <div class="formelement">

                <label for="lastname"><span class="required">*</span> Last Name</label>

                <input id="lastname" name="lastname" type="text" value="<?php echo $this->_tpl_vars['lastname']; ?>
" maxlength="50" class="textbox" />

                <span id="lastnameError" class="formerror"><?php echo $this->_tpl_vars['error']['lastname']; ?>
</span>

            </div>

            

            <!-- E-mail -->

            <div class="formelement">

                <label for="email"><span class="required">*</span> E-mail</label>

                <input id="email" name="email" type="text" value="<?php echo $this->_tpl_vars['email']; ?>
" maxlength="50" class="textbox" />

                <span id="emailError" class="formerror"><?php echo $this->_tpl_vars['error']['email']; ?>
</span>

            </div>

            

            <!-- Phone -->

            <div class="formelement">

                <label for="phone1"><span class="required">*</span> Phone</label>

                ( <input id="phone1" name="phone1" type="text" value="<?php echo $this->_tpl_vars['phone1']; ?>
" maxlength="3" style="width: 30px" class="textbox" /> )

                <input id="phone2" name="phone2" type="text" value="<?php echo $this->_tpl_vars['phone2']; ?>
" maxlength="3" style="width: 30px" class="textbox" /> - 

                <input id="phone3" name="phone3" type="text" value="<?php echo $this->_tpl_vars['phone3']; ?>
" maxlength="4" style="width: 125px" class="textbox" />

                <span id="phoneError" class="formerror"><?php echo $this->_tpl_vars['error']['phone']; ?>
</span>

            </div>

            

            <!-- Job Title -->

            <div class="formelement">

                <label for="job">Occupation</label>

                <input id="job" name="job" type="text" value="<?php echo $this->_tpl_vars['job']; ?>
" maxlength="100" class="textbox" />

            </div>

            

            <!-- Photo -->

            <div class="formelement">

            	<label for="upload">Photo</label>

                <input id="file" name="file" type="file" class="textbox"  />

                <span id="photoError" class="formerror"><?php echo $this->_tpl_vars['error']['photo']; ?>
</span>

            </div>



            <!-- User Profile -->

            <div class="purplebox">

                <img src="icons/icon-keys.gif" alt="" class="icon" /> Vehicle Information

            </div>



            <!-- Make -->

            <div id="make_container" class="formelement">

                <label for="make"><span class="required">*</span> Make</label>

                <select id="make" name="make" class="select" />

                    <option value=""> -- select -- </option>

                    <option value="none" <?php if ($this->_tpl_vars['make'] == 'none'): ?>selected="selected"<?php endif; ?>>I don't own a vehicle</option>

                    <option value="make1" <?php if ($this->_tpl_vars['make'] == 'make1'): ?>selected="selected"<?php endif; ?>>Make 1</option>

					<option value="make2" <?php if ($this->_tpl_vars['make'] == 'make2'): ?>selected="selected"<?php endif; ?>>Make 2</option>

                    <option value="make3" <?php if ($this->_tpl_vars['make'] == 'make3'): ?>selected="selected"<?php endif; ?>>Make 3</option>

                    <option value="make4" <?php if ($this->_tpl_vars['make'] == 'make4'): ?>selected="selected"<?php endif; ?>>Make 4</option>

                    <option value="other" <?php if ($this->_tpl_vars['make'] == 'other'): ?>selected="selected"<?php endif; ?>>Other</option>

                </select>

                <span id="makeError" class="formerror"><?php echo $this->_tpl_vars['error']['make']; ?>
</span>

            </div>

            

            <!-- Model -->

            <div id="model_container" class="formelement">

                <label for="model"><span class="required">*</span> Model</label>

                <select id="model" name="model" class="select" />

                    <option value=""> -- select -- </option>

                    <option value="model1" <?php if ($this->_tpl_vars['model'] == 'model1'): ?>selected="selected"<?php endif; ?>>Model 1</option>

                    <option value="model2" <?php if ($this->_tpl_vars['model'] == 'model2'): ?>selected="selected"<?php endif; ?>>Model 2</option>

                    <option value="model3" <?php if ($this->_tpl_vars['model'] == 'model3'): ?>selected="selected"<?php endif; ?>>Model 3</option>

                    <option value="other" <?php if ($this->_tpl_vars['model'] == 'other'): ?>selected="selected"<?php endif; ?>>Other</option>

                </select>

            </div>

            

            <!-- Year -->

            <div id="year_container" class="formelement">

                <label for="year"><span class="required">*</span> Year</label>

                <select id="year" name="year" class="select" />

                    <option value=""> -- select -- </option>

                    <option value="2009" <?php if ($this->_tpl_vars['year'] == '2009'): ?>selected="selected"<?php endif; ?>>2009</option>

                    <option value="2008" <?php if ($this->_tpl_vars['year'] == '2008'): ?>selected="selected"<?php endif; ?>>2008</option>

                    <option value="2007" <?php if ($this->_tpl_vars['year'] == '2007'): ?>selected="selected"<?php endif; ?>>2007</option>

                    <option value="2006" <?php if ($this->_tpl_vars['year'] == '2006'): ?>selected="selected"<?php endif; ?>>2006</option>

                    <option value="2005" <?php if ($this->_tpl_vars['year'] == '2005'): ?>selected="selected"<?php endif; ?>>2005</option>

                    <option value="2004" <?php if ($this->_tpl_vars['year'] == '2004'): ?>selected="selected"<?php endif; ?>>2004</option>

                    <option value="2003" <?php if ($this->_tpl_vars['year'] == '2003'): ?>selected="selected"<?php endif; ?>>2003</option>

                    <option value="2002" <?php if ($this->_tpl_vars['year'] == '2002'): ?>selected="selected"<?php endif; ?>>2002</option>

                    <option value="2001" <?php if ($this->_tpl_vars['year'] == '2001'): ?>selected="selected"<?php endif; ?>>2001</option>

                    <option value="2000" <?php if ($this->_tpl_vars['year'] == '2000'): ?>selected="selected"<?php endif; ?>>2000</option>

                    <option value="1999" <?php if ($this->_tpl_vars['year'] == '1999'): ?>selected="selected"<?php endif; ?>>1999</option>

                    <option value="1998" <?php if ($this->_tpl_vars['year'] == '1998'): ?>selected="selected"<?php endif; ?>>1998</option>

                    <option value="1997" <?php if ($this->_tpl_vars['year'] == '1997'): ?>selected="selected"<?php endif; ?>>1997</option>

                    <option value="1996" <?php if ($this->_tpl_vars['year'] == '1996'): ?>selected="selected"<?php endif; ?>>1996</option>

                    <option value="1995" <?php if ($this->_tpl_vars['year'] == '1995'): ?>selected="selected"<?php endif; ?>>1995</option>

                    <option value="1994" <?php if ($this->_tpl_vars['year'] == '1994'): ?>selected="selected"<?php endif; ?>>1994</option>

                    <option value="1993" <?php if ($this->_tpl_vars['year'] == '1993'): ?>selected="selected"<?php endif; ?>>1993</option>

                    <option value="1992" <?php if ($this->_tpl_vars['year'] == '1992'): ?>selected="selected"<?php endif; ?>>1992</option>

                    <option value="1991" <?php if ($this->_tpl_vars['year'] == '1991'): ?>selected="selected"<?php endif; ?>>1991</option>

                    <option value="1990" <?php if ($this->_tpl_vars['year'] == '1990'): ?>selected="selected"<?php endif; ?>>1990</option>

                    <option value="other" <?php if ($this->_tpl_vars['year'] == 'other'): ?>selected="selected"<?php endif; ?>>Other</option>

                </select>

            </div>

            

            <!-- Combined MPG -->

            <div id="mpg_container" class="formelement">

                <label for="mpg"><span class="required">*</span> Combined Miles Per Gallon</label>

                <input id="mpg" name="mpg" type="text" value="<?php echo $this->_tpl_vars['mpg']; ?>
" maxlength="3" class="textbox" />

                <span id="mpgError" class="formerror" style="display: none"></span>

            </div>

            

            <!-- Submit Button -->

            <div class="formelement">

                <input id="submit" name="submit" type="submit" value="Register" class="submit" />

            </div>

            

        </form>

        

    </div>    

    <!-- Indicator -->

    <img id="indicator" src="images/indicator.gif" alt="" style="display: none;"/>

    





</body>

</html>