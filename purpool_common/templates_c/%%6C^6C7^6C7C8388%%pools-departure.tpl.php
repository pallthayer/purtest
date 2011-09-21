<?php /* Smarty version 2.6.19, created on 2008-09-12 05:40:57
         compiled from pools-departure.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Purpool</title>

<link href="css/styles.css" rel="stylesheet" type="text/css" />

<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>

<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>

<script language="javascript" src="js/formfocus.js"></script>

<script language="javascript" src="js/pools-create.js"></script>

<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAA_2hDlr8GGBfE4xaODwzMdBTXq9fpoqsVDQwusP8wnl1JoF5PeRRah3cG9ATfaTXFHd6W2kdTXUmoow" type="text/javascript"></script>



<?php echo '

<style type="text/css">



.toggle {

	position: absolute; 

	top: 15px; 

	right: 15px;

	color: #939;

	font-size: 0.8em;

}



.toggle:alink, .toggle:avisited {

	text-decoration: underline;

}



.toggle:hover {

	text-decoration: none;

}



.toggle .current {

	font-weight: bold;

}



#startmap, #endmap {

	width: 400px;

	height: 300px;

	margin-bottom: 20px;

}



</style>



'; ?>




</head>



<body>

<div id="dpanel"></div>

<div id="dist"></div>

	<!-- Header -->

    <div id="header">

    	<img src="images/logo.jpg" alt="Purpool" />

    </div>

    

    <!-- Top Navigation -->

    <div id="topnav">

    	<ul>

        	<li><a href="authenticate.php?state=signout">Signout</a></li>

		</ul>

    </div>

    

    <!-- Left Column -->

    <div id="leftcolumn">

    	

        <!-- Side Navigation -->

        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "sidenavigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>



    </div>



	<!-- Right Column -->

    <div id="rightcolumn">

    

    	<!-- Content Bar -->

        <div id="contentbar" style="border-bottom: 1px solid #909;">

        

            <!-- Page Heading -->

            <h1>Pools</h1>



        </div>

        

        <!-- Content -->

        <div id="content">

        	

            <!-- User Profile -->

            <div id="wizard">

                <ul>

                  <li>1. General</li>

                  <li class="current">2. Departure Points</li>

                  <li>3. Members</li>

                  <li>4. Propose Schedule</li>

                </ul>

                <div class="step">

                    Step 2 of 4            

                </div>

            </div>

            

            <!-- Pool Form -->

            <form id="myform" method="post" action="pools.php?state=createpool">

                

                <!-- Store latitude, longitude and distance -->      

                <input id="startlat" name="startlat" type="hidden" value="<?php echo $this->_tpl_vars['startlat']; ?>
" />

                <input id="startlng" name="startlng" type="hidden" value="<?php echo $this->_tpl_vars['startlng']; ?>
" />

                <input id="endlat" name="endlat" type="hidden" value="<?php echo $this->_tpl_vars['endlat']; ?>
" />

                <input id="endlng" name="endlng" type="hidden" value="<?php echo $this->_tpl_vars['endlng']; ?>
" />

                <input id="distance" name="distance" type="hidden" value="<?php echo $this->_tpl_vars['distance']; ?>
" />

               

                <!-- Start Address Error -->

                <div id="startplaceError" class="formerror"></div>

                

                <!-- Start Address -->

                <div id="startaddress">

                

                    <!-- Default Departure Dropdown -->

                    <div class="formelement">

                        <label for="startplace"><span class="required">*</span> Place of Departure</label>

                        <select id="startplace" name="startplace" class="select">

                            <option value="">-- select --</option>

                            <?php unset($this->_sections['info']);
$this->_sections['info']['name'] = 'info';
$this->_sections['info']['loop'] = is_array($_loop=$this->_tpl_vars['parkandrides']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['info']['show'] = true;
$this->_sections['info']['max'] = $this->_sections['info']['loop'];
$this->_sections['info']['step'] = 1;
$this->_sections['info']['start'] = $this->_sections['info']['step'] > 0 ? 0 : $this->_sections['info']['loop']-1;
if ($this->_sections['info']['show']) {
    $this->_sections['info']['total'] = $this->_sections['info']['loop'];
    if ($this->_sections['info']['total'] == 0)
        $this->_sections['info']['show'] = false;
} else
    $this->_sections['info']['total'] = 0;
if ($this->_sections['info']['show']):

            for ($this->_sections['info']['index'] = $this->_sections['info']['start'], $this->_sections['info']['iteration'] = 1;
                 $this->_sections['info']['iteration'] <= $this->_sections['info']['total'];
                 $this->_sections['info']['index'] += $this->_sections['info']['step'], $this->_sections['info']['iteration']++):
$this->_sections['info']['rownum'] = $this->_sections['info']['iteration'];
$this->_sections['info']['index_prev'] = $this->_sections['info']['index'] - $this->_sections['info']['step'];
$this->_sections['info']['index_next'] = $this->_sections['info']['index'] + $this->_sections['info']['step'];
$this->_sections['info']['first']      = ($this->_sections['info']['iteration'] == 1);
$this->_sections['info']['last']       = ($this->_sections['info']['iteration'] == $this->_sections['info']['total']);
?>

                                <option value="<?php echo $this->_tpl_vars['parkandrides'][$this->_sections['info']['index']]['parkandride_id']; ?>
" <?php if ($this->_tpl_vars['parkandride'] == $this->_tpl_vars['parkandrides'][$this->_sections['info']['index']]['parkandride_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['parkandrides'][$this->_sections['info']['index']]['name']; ?>
</option>

                            <?php endfor; endif; ?>

                            <option value="other">other</option>

                        </select>

                        <img id="startplace_indicator" src="images/indicator.gif" alt="" class="indicator" style="display: none;"/>

                    </div>

                    

                    <!-- Start Address 1 -->

                    <div class="formelement">

                        <label for="startaddress1"><span class="required">*</span> Address</label>

                        <input id="startaddress1" name="startaddress1" type="text" value="<?php echo $this->_tpl_vars['startaddress1']; ?>
" maxlength="100" class="textbox" />

                        <span id="startaddress1Error" class="formerror"></span><br />

                        <input id="startaddress2" name="startaddress2" type="text" value="<?php echo $this->_tpl_vars['startaddress2']; ?>
" maxlength="100" class="textbox" style="margin-top: 5px;" />

                    </div>

                    

                    <!-- Start City -->

                    <div class="formelement">

                        <label for="startcity"><span class="required">*</span> City</label>

                        <input id="startcity" name="startcity" type="text" value="<?php echo $this->_tpl_vars['startcity']; ?>
" maxlength="100" class="textbox" />

                        <span id="startcityError" class="formerror"></span>

                    </div>

                    

                    <!-- Start State -->

                    <div class="formelement">

                        <label for="startstate"><span class="required">*</span> State</label>

                        <select id="startstate" name="startstate" class="select">

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

                        <span id="startstateError" class="formerror"></span>

                    </div>

                    

                    <!-- Start Zip -->

                    <div class="formelement">

                        <label for="startzip"><span class="required">*</span> Zipcode</label>

                        <input id="startzip" name="startzip" type="text" value="<?php echo $this->_tpl_vars['startzip']; ?>
" maxlength="100" class="textbox" />

                        <span id="startzipError" class="formerror"></span>

                    </div>

                

                </div>

                

                <!-- Start Map -->

                <div id="startmap_container" style="display: none">

                

                	<!-- Display Map -->

                    <div id="startmap"></div>

    

                </div>

     

                <!-- Submit Button -->

                <div class="formelement">

                    <input id="submit" name="submit" type="submit" value="Next" class="submit" />

                </div>

  

            </form>



        </div>

        

    </div>





</body>

</html>