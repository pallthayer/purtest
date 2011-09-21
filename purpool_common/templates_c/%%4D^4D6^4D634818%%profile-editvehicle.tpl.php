<?php /* Smarty version 2.6.19, created on 2011-09-07 17:27:37
         compiled from profile-editvehicle.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script language="javascript" src="js/formfocus.js"></script>
<script language="javascript" src="js/profile-editvehicle.js"></script>
</head>

<body>

	<!-- Header -->
    <div id="header">
    	<a href="<?php echo $this->_tpl_vars['site_url']; ?>
" id="logo"><h1>Purpool</h1></a>
    </div>
    
    <!-- Top Navigation -->
   		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "topnavigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    
    <!-- Left Column 
    <div id="leftcolumn">
    	
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "sidenavigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

    </div>
    //-->

    
    	<!-- Content Bar -->
        <div id="contentbar">
        
            <!-- Page Heading -->
            <h2>Members</h2>
            
            <!-- Tabs -->
            <div id="tabs">
              	<ul>
                	<li class="first"><a href="profile.php">View Profile</a></li>
                    <li class="current"><a href="profile.php?state=editgeneral">Edit Profile</a></li>
                    <li><a href="profile.php?state=browseprofiles">Browse People</a></li>
                </ul>
            </div>
            
        </div>
        
        <div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
        	<h3 style="margin-bottom:0;">Edit Profile</h3>
        	<div id="wizard">
                <ul>
                    <li><a href="profile.php?state=editgeneral">Edit General Info</a></li>
                    <li class="current"><a href="profile.php?state=updatevehicle">Edit Vehicle</a></li>
                    <li><a href="profile.php?state=editinterests">Edit Interests</a></li>
                    <li><a href="profile.php?state=editpassword">Change Password</a></li>
                </ul>
            </div>
            <div class="clear"></div>
            <!-- Confirmation -->
            <?php if ($this->_tpl_vars['confirmation']): ?><p class="green"><?php echo $this->_tpl_vars['confirmation']; ?>
</p><?php endif; ?>
        	<p>Information about your vehicle is used to calculate your fuel savings.</p>
            <!-- General Form -->
            <form id="myform" method="post">
            
                <!-- Profile mode (neccesary for javascript determination) -->
                <input id="profilemode" name="profilemode" type="hidden" value="1" />
                
                <!-- Do you own a vehicle -->
                <div class="formelement">
                	 <label for="seats"><span class="required">*</span> Do you own a vehicle?</label>
                     <input id="ownvehicle_yes" name="ownvehicle" value="y" type="radio" <?php if ($this->_tpl_vars['ownvehicle'] == 'y'): ?>checked="checked"<?php endif; ?> /> Yes<br />
                	 <input id="ownvehicle_no" name="ownvehicle" value="n" type="radio" <?php if ($this->_tpl_vars['ownvehicle'] == 'n'): ?>checked="checked"<?php endif; ?> /> No
                </div>
                
               <!-- Vehicle Wrapper -->
               <div id="vehiclewrapper">
                
                    <!-- Total number of seats -->
                    <div class="formelement">
                        <label for="seats"><span class="required">*</span> Number of Seats (including driver)</label>
                        <select id="seats" name="seats" class="select">
                            <option value=""> -- select -- </option>
                            <option value="1" <?php if ($this->_tpl_vars['seats'] == '1'): ?>selected="selected"<?php endif; ?>>1</option>
                            <option value="2" <?php if ($this->_tpl_vars['seats'] == '2'): ?>selected="selected"<?php endif; ?>>2</option>
                            <option value="3" <?php if ($this->_tpl_vars['seats'] == '3'): ?>selected="selected"<?php endif; ?>>3</option>
                            <option value="4" <?php if ($this->_tpl_vars['seats'] == '4'): ?>selected="selected"<?php endif; ?>>4</option>
                            <option value="5" <?php if ($this->_tpl_vars['seats'] == '5'): ?>selected="selected"<?php endif; ?>>5</option>
                            <option value="6" <?php if ($this->_tpl_vars['seats'] == '6'): ?>selected="selected"<?php endif; ?>>6</option>
                            <option value="7" <?php if ($this->_tpl_vars['seats'] == '7'): ?>selected="selected"<?php endif; ?>>7</option>
                            <option value="8" <?php if ($this->_tpl_vars['seats'] == '8'): ?>selected="selected"<?php endif; ?>>8</option>
                            <option value="9" <?php if ($this->_tpl_vars['seats'] == '9'): ?>selected="selected"<?php endif; ?>>9</option>
                            <option value="10" <?php if ($this->_tpl_vars['seats'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
                        </select>
                        <span id="seatsError" class="formerror"></span>
                    </div>
                    
                    <!-- Color -->
                    <div id="color_container" class="formelement">
                        <label for="color"><span class="required">*</span> Color</label>
                        <select id="color" name="color" class="select">
                            <option value=""> -- select -- </option>
                            <option value="silver" <?php if ($this->_tpl_vars['color'] == 'silver'): ?>selected="selected"<?php endif; ?>>Silver</option>
                            <option value="white" <?php if ($this->_tpl_vars['color'] == 'white'): ?>selected="selected"<?php endif; ?>>White</option>
                            <option value="blue" <?php if ($this->_tpl_vars['color'] == 'blue'): ?>selected="selected"<?php endif; ?>>Blue</option>
                            <option value="red" <?php if ($this->_tpl_vars['color'] == 'red'): ?>selected="selected"<?php endif; ?>>Red</option>
                            <option value="taupe" <?php if ($this->_tpl_vars['color'] == 'taupe'): ?>selected="selected"<?php endif; ?>>Taupe</option>
                            <option value="black" <?php if ($this->_tpl_vars['color'] == 'black'): ?>selected="selected"<?php endif; ?>>Black</option>
                            <option value="grey" <?php if ($this->_tpl_vars['color'] == 'grey'): ?>selected="selected"<?php endif; ?>>Grey</option>
                            <option value="green" <?php if ($this->_tpl_vars['color'] == 'green'): ?>selected="selected"<?php endif; ?>>Green</option>
                            <option value="yellow" <?php if ($this->_tpl_vars['color'] == 'yellow'): ?>selected="selected"<?php endif; ?>>Yellow</option>
                            <option value="brown" <?php if ($this->_tpl_vars['color'] == 'brown'): ?>selected="selected"<?php endif; ?>>Brown</option>
                            <option value="orange" <?php if ($this->_tpl_vars['color'] == 'orange'): ?>selected="selected"<?php endif; ?>>Orange</option>
                            <option value="purple" <?php if ($this->_tpl_vars['color'] == 'purple'): ?>selected="selected"<?php endif; ?>>Purple</option>
                            <option value="other" <?php if ($this->_tpl_vars['color'] == 'other'): ?>selected="selected"<?php endif; ?>>Other</option>
                        </select>
                        <span id="colorError" class="formerror"></span>
                    </div>
         
                    <!-- Year -->
                    <div id="year_container" class="formelement">
                        <label for="year"><span class="required">*</span> Year</label>
                        <select id="year" name="year" class="select">
                            <option value=""> -- select -- </option> 
                            <option value="2011" <?php if ($this->_tpl_vars['year'] == '2011'): ?>selected="selected"<?php endif; ?>>2011</option>
                            <option value="2010" <?php if ($this->_tpl_vars['year'] == '2010'): ?>selected="selected"<?php endif; ?>>2010</option>
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
                            <option value="1989" <?php if ($this->_tpl_vars['year'] == '1989'): ?>selected="selected"<?php endif; ?>>1989</option>
                            <option value="1988" <?php if ($this->_tpl_vars['year'] == '1988'): ?>selected="selected"<?php endif; ?>>1988</option>
                            <option value="1987" <?php if ($this->_tpl_vars['year'] == '1987'): ?>selected="selected"<?php endif; ?>>1987</option>
                            <option value="1986" <?php if ($this->_tpl_vars['year'] == '1986'): ?>selected="selected"<?php endif; ?>>1986</option>
                            <option value="1985" <?php if ($this->_tpl_vars['year'] == '1985'): ?>selected="selected"<?php endif; ?>>1985</option>
                            <option value="other" <?php if ($this->_tpl_vars['year'] == 'other'): ?>selected="selected"<?php endif; ?>>Other</option>
                        </select>
                        <span id="yearError" class="formerror"></span>
                    </div>
                    
                    <!-- Make -->
                    <div id="make_container" class="formelement">
                        <label for="make"><span class="required">*</span> Make</label>
                        <select id="make" name="make" class="select">
                            <option value=""> -- select -- </option>
                            <?php $_from = $this->_tpl_vars['makes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['myloop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['myloop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['make']):
        $this->_foreach['myloop']['iteration']++;
?>
                                <option value="<?php echo $this->_tpl_vars['make']; ?>
" <?php if ($this->_tpl_vars['currentmake'] == $this->_tpl_vars['make']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['make']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select>
                        <img id="make_indicator" src="images/indicator.gif" alt="" class="indicator" style="display: none;"/>
                        <span id="makeError" class="formerror"></span>
                    </div>
                    
                    <!-- Model -->
                    <div id="model_container" class="formelement">
                        <label for="model"><span class="required">*</span> Model</label>
                        <select id="model" name="model" class="select">
                            <option value=""> -- select -- </option>
                            <?php $_from = $this->_tpl_vars['models']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['myloop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['myloop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['model']):
        $this->_foreach['myloop']['iteration']++;
?>
                                <option value="<?php echo $this->_tpl_vars['model']; ?>
" <?php if ($this->_tpl_vars['currentmodel'] == $this->_tpl_vars['model']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['model']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select>
                        <img id="model_indicator" src="images/indicator.gif" alt="" class="indicator" style="display: none;"/>
                        <span id="modelError" class="formerror"></span>
                    </div>
                    
                    <!-- Transmission -->
                    <div id="trans_container" class="formelement">
                        <label for="trans"><span class="required">*</span> Transmission</label>
                        <select id="trans" name="trans" class="select">
                            <option value=""> -- select -- </option>
                            <?php $_from = $this->_tpl_vars['trans']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['myloop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['myloop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['trans']):
        $this->_foreach['myloop']['iteration']++;
?>
                                <option value="<?php echo $this->_tpl_vars['trans']; ?>
" <?php if ($this->_tpl_vars['currenttrans'] == $this->_tpl_vars['trans']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['trans']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select>
                        <img id="trans_indicator" src="images/indicator.gif" alt="" class="indicator" style="display: none;"/>
                        <span id="transError" class="formerror"></span>
                    </div>
                    
                    <!-- Cylinders -->
                    <div id="cylinders_container" class="formelement">
                        <label for="cylinders"><span class="required">*</span> Cylinders</label>
                        <select id="cylinders" name="cylinders" class="select">
                            <option value=""> -- select -- </option>
                            <?php $_from = $this->_tpl_vars['cylinders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['myloop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['myloop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['cylinders']):
        $this->_foreach['myloop']['iteration']++;
?>
                                <option value="<?php echo $this->_tpl_vars['cylinders']; ?>
" <?php if ($this->_tpl_vars['currentcylinders'] == $this->_tpl_vars['cylinders']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['cylinders']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select>
                        <img id="cylinders_indicator" src="images/indicator.gif" alt="" class="indicator" style="display: none;"/>
                        <span id="cylindersError" class="formerror"></span>
                    </div>
        
                    <!-- Combined MPG -->
                    <div id="mpg_container" class="formelement">
                        <label for="mpg"><span class="required">*</span> Combined Miles Per Gallon</label>
                        <input id="mpg" name="mpg" type="text" value="<?php echo $this->_tpl_vars['mpg']; ?>
" maxlength="3" class="textbox" disabled="disabled" />
                        <img id="mpg_indicator" src="images/indicator.gif" alt="" class="indicator" style="display: none;"/>
                        <span id="mpgError" class="formerror"></span>
                    </div>
                    
                    <!-- Carbon Emissions -->
                    <div id="emissions_container" class="formelement">
                        <label for="emissions"><span class="required">*</span> Carbon Emissions</label>
                        <input id="emissions" name="emissions" type="text" value="<?php echo $this->_tpl_vars['emissions']; ?>
" maxlength="25" class="textbox" disabled="disabled" />
                        <img id="emissions_indicator" src="images/indicator.gif" alt="" class="indicator" style="display: none;"/>
                        <span id="emissionsError" class="formerror"></span>
                    </div>
                
                </div>
                
                <!-- Submit Button -->
                <div class="formelement">
                    <input id="submit" name="submit" type="submit" value="Save" class="submit" />
                </div>
                
            </form>
        <!-- Bottom Navigation Bar -->
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "bottomnavigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 
        </div>
	<div id="onecolumnbtm"></div>
</body>
</html>