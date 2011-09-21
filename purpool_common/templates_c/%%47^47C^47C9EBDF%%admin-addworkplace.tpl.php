<?php /* Smarty version 2.6.19, created on 2011-09-06 15:16:36
         compiled from admin-addworkplace.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script language="javascript" src="js/formfocus.js"></script>
<script language="javascript" src="js/sorttable.js"></script>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo $this->_tpl_vars['google_key']; ?>
" type="text/javascript"></script>
<script src="js/icons.js"></script>
<script language="javascript" src="js/workplace-create.js"></script>
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
    
    
    	<!-- Content Bar -->
        <div id="contentbar">
        
            <!-- Page Heading -->
            <h2>Admin</h2>
            
        </div>
        
		<div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
        
        	<!-- Back to Main Menu -->
            <p><a href="admin.php">Back to Main Menu</a></p>
            
             <div class="clear"></div>
        	<!-- Workplace Location  map -->
            <div id="map" style="width: 400px; height: 400px; float: right; margin-left: 20px; margin-right: 20px; border: 1px solid #5d1db8;"></div>
            
            <!-- Add Workplace -->
            <form id="myform" method="post" action="<?php echo $this->_tpl_vars['formaction']; ?>
">
            	<div class="formelement">
                	<label for="name">Name</label>
                    <input id="name" name="name" type="text" value="<?php echo $this->_tpl_vars['name']; ?>
" class="textbox" />
                    <span id="nameError" class="formerror"><?php echo $this->_tpl_vars['error']['name']; ?>
</span>
                </div>
                <div class="formelement">
                	<label for="suffix">Suffix (@companyname.com)</label>
                    <input id="suffix" name="suffix" type="text" value="<?php echo $this->_tpl_vars['suffix']; ?>
" class="textbox" />
                    <span id="suffixError" class="formerror"><?php echo $this->_tpl_vars['error']['suffix']; ?>
</span>
                </div>
                <div class="formelement">
                	<label for="address">Address</label>
                    <input id="address" name="address" type="text" value="<?php echo $this->_tpl_vars['address']; ?>
" class="textbox" />
                    <span id="addressError" class="formerror"><?php echo $this->_tpl_vars['error']['address']; ?>
</span>
                </div>
                <div class="formelement">
                	<label for="city">City</label>
                    <input id="city" name="city" type="text" value="<?php echo $this->_tpl_vars['city']; ?>
" class="textbox" />
                    <span id="cityError" class="formerror"><?php echo $this->_tpl_vars['error']['city']; ?>
</span>
                </div>
                <div class="formelement">
                	<label for="state">State</label>
                    <select id="state" name="state" class="select">
                        <option value="">-- select --</option>
                        <option value="AL" <?php if ($this->_tpl_vars['state'] == 'AL'): ?>selected="selected"<?php endif; ?>>Alabama</option>
                        <option value="AK" <?php if ($this->_tpl_vars['state'] == 'AK'): ?>selected="selected"<?php endif; ?>>Alaska</option>
                        <option value="AZ" <?php if ($this->_tpl_vars['state'] == 'AZ'): ?>selected="selected"<?php endif; ?>>Arizona</option>
                        <option value="AR" <?php if ($this->_tpl_vars['state'] == 'AR'): ?>selected="selected"<?php endif; ?>>Arkansas</option>
                        <option value="CA" <?php if ($this->_tpl_vars['state'] == 'CA'): ?>selected="selected"<?php endif; ?>>California</option>
                        <option value="CO" <?php if ($this->_tpl_vars['state'] == 'CO'): ?>selected="selected"<?php endif; ?>>Colorado</option>
                        <option value="CT" <?php if ($this->_tpl_vars['state'] == 'CT'): ?>selected="selected"<?php endif; ?>>Connecticut</option>
                        <option value="DE" <?php if ($this->_tpl_vars['state'] == 'DE'): ?>selected="selected"<?php endif; ?>>Delaware</option>
                        <option value="DC" <?php if ($this->_tpl_vars['state'] == 'DC'): ?>selected="selected"<?php endif; ?>>District of Columbia</option>
                        <option value="FL" <?php if ($this->_tpl_vars['state'] == 'FL'): ?>selected="selected"<?php endif; ?>>Florida</option>
                        <option value="GA" <?php if ($this->_tpl_vars['state'] == 'GA'): ?>selected="selected"<?php endif; ?>>Georgia</option>
                        <option value="HI" <?php if ($this->_tpl_vars['state'] == 'HI'): ?>selected="selected"<?php endif; ?>>Hawaii</option>
                        <option value="ID" <?php if ($this->_tpl_vars['state'] == 'ID'): ?>selected="selected"<?php endif; ?>>Idaho</option>
                        <option value="IL" <?php if ($this->_tpl_vars['state'] == 'IL'): ?>selected="selected"<?php endif; ?>>Illinois</option>
                        <option value="IN" <?php if ($this->_tpl_vars['state'] == 'IN'): ?>selected="selected"<?php endif; ?>>Indiana</option>
                        <option value="IA" <?php if ($this->_tpl_vars['state'] == 'IA'): ?>selected="selected"<?php endif; ?>>Iowa</option>
                        <option value="KS" <?php if ($this->_tpl_vars['state'] == 'KS'): ?>selected="selected"<?php endif; ?>>Kansas</option>
                        <option value="KY" <?php if ($this->_tpl_vars['state'] == 'KY'): ?>selected="selected"<?php endif; ?>>Kentucky</option>
                        <option value="LA" <?php if ($this->_tpl_vars['state'] == 'LA'): ?>selected="selected"<?php endif; ?>>Louisiana</option>
                        <option value="ME" <?php if ($this->_tpl_vars['state'] == 'ME'): ?>selected="selected"<?php endif; ?>>Maine</option>
                        <option value="MD" <?php if ($this->_tpl_vars['state'] == 'MD'): ?>selected="selected"<?php endif; ?>>Maryland</option>
                        <option value="MA" <?php if ($this->_tpl_vars['state'] == 'MA'): ?>selected="selected"<?php endif; ?>>Massachusetts</option>
                        <option value="MI" <?php if ($this->_tpl_vars['state'] == 'MI'): ?>selected="selected"<?php endif; ?>>Michigan</option>
                        <option value="MN" <?php if ($this->_tpl_vars['state'] == 'MN'): ?>selected="selected"<?php endif; ?>>Minnesota</option>
                        <option value="MS" <?php if ($this->_tpl_vars['state'] == 'MS'): ?>selected="selected"<?php endif; ?>>Mississippi</option>
                        <option value="MO" <?php if ($this->_tpl_vars['state'] == 'MO'): ?>selected="selected"<?php endif; ?>>Missouri</option>
                        <option value="MT" <?php if ($this->_tpl_vars['state'] == 'MT'): ?>selected="selected"<?php endif; ?>>Montana</option>
                        <option value="NE" <?php if ($this->_tpl_vars['state'] == 'NE'): ?>selected="selected"<?php endif; ?>>Nebraska</option>
                        <option value="NV" <?php if ($this->_tpl_vars['state'] == 'NV'): ?>selected="selected"<?php endif; ?>>Nevada</option>
                        <option value="NH" <?php if ($this->_tpl_vars['state'] == 'NH'): ?>selected="selected"<?php endif; ?>>New Hampshire</option>
                        <option value="NJ" <?php if ($this->_tpl_vars['state'] == 'NJ'): ?>selected="selected"<?php endif; ?>>New Jersey</option>
                        <option value="NM" <?php if ($this->_tpl_vars['state'] == 'NM'): ?>selected="selected"<?php endif; ?>>New Mexico</option>
                        <option value="NY" <?php if ($this->_tpl_vars['state'] == 'NY'): ?>selected="selected"<?php endif; ?>>New York</option>
                        <option value="NC" <?php if ($this->_tpl_vars['state'] == 'NC'): ?>selected="selected"<?php endif; ?>>North Carolina</option>
                        <option value="ND" <?php if ($this->_tpl_vars['state'] == 'ND'): ?>selected="selected"<?php endif; ?>>North Dakota</option>
                        <option value="OH" <?php if ($this->_tpl_vars['state'] == 'OH'): ?>selected="selected"<?php endif; ?>>Ohio</option>
                        <option value="OK" <?php if ($this->_tpl_vars['state'] == 'OK'): ?>selected="selected"<?php endif; ?>>Oklahoma</option>
                        <option value="OR" <?php if ($this->_tpl_vars['state'] == 'OR'): ?>selected="selected"<?php endif; ?>>Oregon</option>
                        <option value="PA" <?php if ($this->_tpl_vars['state'] == 'PA'): ?>selected="selected"<?php endif; ?>>Pennsylvania</option>
                        <option value="RI" <?php if ($this->_tpl_vars['state'] == 'RI'): ?>selected="selected"<?php endif; ?>>Rhode Island</option>
                        <option value="SC" <?php if ($this->_tpl_vars['state'] == 'SC'): ?>selected="selected"<?php endif; ?>>South Carolina</option>
                        <option value="SD" <?php if ($this->_tpl_vars['state'] == 'SD'): ?>selected="selected"<?php endif; ?>>South Dakota</option>
                        <option value="TN" <?php if ($this->_tpl_vars['state'] == 'TN'): ?>selected="selected"<?php endif; ?>>Tennessee</option>
                        <option value="TX" <?php if ($this->_tpl_vars['state'] == 'TX'): ?>selected="selected"<?php endif; ?>>Texas</option>
                        <option value="UT" <?php if ($this->_tpl_vars['state'] == 'UT'): ?>selected="selected"<?php endif; ?>>Utah</option>
                        <option value="VT" <?php if ($this->_tpl_vars['state'] == 'VT'): ?>selected="selected"<?php endif; ?>>Vermont</option>
                        <option value="VA" <?php if ($this->_tpl_vars['state'] == 'VA'): ?>selected="selected"<?php endif; ?>>Virginia</option>
                        <option value="WA" <?php if ($this->_tpl_vars['state'] == 'WA'): ?>selected="selected"<?php endif; ?>>Washington</option>
                        <option value="WV" <?php if ($this->_tpl_vars['state'] == 'WV'): ?>selected="selected"<?php endif; ?>>West Virginia</option>
                        <option value="WI" <?php if ($this->_tpl_vars['state'] == 'WI'): ?>selected="selected"<?php endif; ?>>Wisconsin</option>
                        <option value="WY" <?php if ($this->_tpl_vars['state'] == 'WY'): ?>selected="selected"<?php endif; ?>>Wyoming</option>
                    </select>
                    <span id="stateError" class="formerror"><?php echo $this->_tpl_vars['error']['state']; ?>
</span>
                </div>
                <div class="formelement">
                	<label for="zip">Zipcode</label>
                    <input id="zip" name="zip" type="text" value="<?php echo $this->_tpl_vars['zip']; ?>
" class="textbox" />
                    <span id="zipError" class="formerror"><?php echo $this->_tpl_vars['error']['zip']; ?>
</span>
                </div>
                <div class="formelement">
                    <input id="geocode" name="geocode" type="button" value="Get Latitute/Longitude Values" class="submit"/>
                </div>
                <div class="formelement">
                	<label for="latitude">Latitude</label>
                    <input id="latitude" name="latitude" type="text" value="<?php echo $this->_tpl_vars['latitude']; ?>
" class="textbox" />
                    <span id="latitudeError" class="formerror"><?php echo $this->_tpl_vars['error']['latitude']; ?>
</span>
                </div>
                <div class="formelement">
                	<label for="longitude">Longitude</label>
                    <input id="longitude" name="longitude" type="text" value="<?php echo $this->_tpl_vars['longitude']; ?>
" class="textbox" />
                    <span id="longitudeError" class="formerror"><?php echo $this->_tpl_vars['error']['longitude']; ?>
</span>
                </div>
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