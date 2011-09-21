<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script language="javascript" src="js/formfocus.js"></script>
<script language="javascript" src="js/register-car.js"></script>
</head>

<body>

	<!-- Header -->
    <div id="header">
    	<a href="{$site_url}" id="logo"><h1>Purpool</h1></a>
    </div>
    
    <!-- Top Navigation -->
    <div id="topnav2">
    	<ul>
        	<li><a href="register.php">Register</a></li>
		</ul>
		<ul >
        	<li><a href="help.php">Help</a> | <a href="contact.php">Contact</a></li>
		</ul>
    </div>
        
    	<!-- Content Bar -->
        <div id="contentbar">    
            <!-- Page Heading -->
            <h2>Register</h2>
        </div>
        
		<div id="onecolumntop"></div>
		
        <!-- Content -->
        <div class="content">
        	
            <!-- User Profile -->
            <div id="wizard">
                <ul>
                  <li><span>1. General</span></li>
                  <li class="current"><span>2. Vehicle</span></li>
                  <li><span>3. Interests</span></li>
                </ul>
                <div class="step">
                    Step 2 of 3            
                </div>
            </div>
                
            <div class="clear"></div> 
            <p>Information about your vehicle is used to calculate your fuel savings.</p>
            <!-- General Form -->
            <form id="myform">
            
            	<!-- Do you own a vehicle -->
                <div class="formelement">
                	 <label for="seats"><span class="required">*</span> Do you own a vehicle?</label>
                     <input id="ownvehicle_yes" name="ownvehicle" value="y" type="radio" {if $ownvehicle == 'y'}checked="checked"{/if} /> Yes<br />
                	 <input id="ownvehicle_no" name="ownvehicle" value="n" type="radio" {if $ownvehicle == 'n'}checked="checked"{/if} /> No
                </div>
                
                <!-- Vehicle Wrapper -->
                <div id="vehiclewrapper">
            
                    <!-- Total number of seats -->
                    <div class="formelement">
                        <label for="seats"><span class="required">*</span> Number of Seats (including driver)</label>
                        <select id="seats" name="seats" class="select">
                            <option value="1" {if $seats eq '1'}selected="selected"{/if}>1</option>
                            <option value="2" {if $seats eq '2'}selected="selected"{/if}>2</option>
                            <option value="3" {if $seats eq '3'}selected="selected"{/if}>3</option>
                            <option value="4" {if $seats eq '4'}selected="selected"{/if}>4</option>
                            <option value="5" {if $seats eq '5'}selected="selected"{/if}>5</option>
                            <option value="6" {if $seats eq '6'}selected="selected"{/if}>6</option>
                            <option value="7" {if $seats eq '7'}selected="selected"{/if}>7</option>
                            <option value="8" {if $seats eq '8'}selected="selected"{/if}>8</option>
                            <option value="9" {if $seats eq '9'}selected="selected"{/if}>9</option>
                            <option value="10" {if $seats eq '10'}selected="selected"{/if}>10</option>
                        </select>
                        <span id="seatsError" class="formerror"></span>
                    </div>
                    
                    <!-- Color -->
                    <div id="color_container" class="formelement">
                        <label for="color"><span class="required">*</span> Color</label>
                        <select id="color" name="color" class="select">
                            <option value=""> -- select -- </option>
                            <option value="silver" {if $color eq 'silver'}selected="selected"{/if}>Silver</option>
                            <option value="white" {if $color eq 'white'}selected="selected"{/if}>White</option>
                            <option value="blue" {if $color eq 'blue'}selected="selected"{/if}>Blue</option>
                            <option value="red" {if $color eq 'red'}selected="selected"{/if}>Red</option>
                            <option value="taupe" {if $color eq 'taupe'}selected="selected"{/if}>Taupe</option>
                            <option value="black" {if $color eq 'black'}selected="selected"{/if}>Black</option>
                            <option value="grey" {if $color eq 'grey'}selected="selected"{/if}>Grey</option>
                            <option value="green" {if $color eq 'green'}selected="selected"{/if}>Green</option>
                            <option value="yellow" {if $color eq 'yellow'}selected="selected"{/if}>Yellow</option>
                            <option value="brown" {if $color eq 'brown'}selected="selected"{/if}>Brown</option>
                            <option value="orange" {if $color eq 'orange'}selected="selected"{/if}>Orange</option>
                            <option value="purple" {if $color eq 'purple'}selected="selected"{/if}>Purple</option>
                            <option value="other" {if $color eq 'other'}selected="selected"{/if}>Other</option>
                        </select>
                        <span id="colorError" class="formerror"></span>
                    </div>
         
                    <!-- Year -->
                    <div id="year_container" class="formelement">
                        <label for="year"><span class="required">*</span> Year</label>
                        <select id="year" name="year" class="select">
                            <option value=""> -- select -- </option>
                            <option value="2011" {if $year eq '2011'}selected="selected"{/if}>2011</option>
                            <option value="2010" {if $year eq '2010'}selected="selected"{/if}>2010</option>
                            <option value="2009" {if $year eq '2009'}selected="selected"{/if}>2009</option>
                            <option value="2008" {if $year eq '2008'}selected="selected"{/if}>2008</option>
                            <option value="2007" {if $year eq '2007'}selected="selected"{/if}>2007</option>
                            <option value="2006" {if $year eq '2006'}selected="selected"{/if}>2006</option>
                            <option value="2005" {if $year eq '2005'}selected="selected"{/if}>2005</option>
                            <option value="2004" {if $year eq '2004'}selected="selected"{/if}>2004</option>
                            <option value="2003" {if $year eq '2003'}selected="selected"{/if}>2003</option>
                            <option value="2002" {if $year eq '2002'}selected="selected"{/if}>2002</option>
                            <option value="2001" {if $year eq '2001'}selected="selected"{/if}>2001</option>
                            <option value="2000" {if $year eq '2000'}selected="selected"{/if}>2000</option>
                            <option value="1999" {if $year eq '1999'}selected="selected"{/if}>1999</option>
                            <option value="1998" {if $year eq '1998'}selected="selected"{/if}>1998</option>
                            <option value="1997" {if $year eq '1997'}selected="selected"{/if}>1997</option>
                            <option value="1996" {if $year eq '1996'}selected="selected"{/if}>1996</option>
                            <option value="1995" {if $year eq '1995'}selected="selected"{/if}>1995</option>
                            <option value="1994" {if $year eq '1994'}selected="selected"{/if}>1994</option>
                            <option value="1993" {if $year eq '1993'}selected="selected"{/if}>1993</option>
                            <option value="1992" {if $year eq '1992'}selected="selected"{/if}>1992</option>
                            <option value="1991" {if $year eq '1991'}selected="selected"{/if}>1991</option>
                            <option value="1990" {if $year eq '1990'}selected="selected"{/if}>1990</option>
                            <option value="1989" {if $year eq '1989'}selected="selected"{/if}>1989</option>
                            <option value="1988" {if $year eq '1988'}selected="selected"{/if}>1988</option>
                            <option value="1987" {if $year eq '1987'}selected="selected"{/if}>1987</option>
                            <option value="1986" {if $year eq '1986'}selected="selected"{/if}>1986</option>
                            <option value="1985" {if $year eq '1985'}selected="selected"{/if}>1985</option>
                            <option value="other" {if $year eq 'other'}selected="selected"{/if}>Other</option>
                        </select>
                        <span id="yearError" class="formerror"></span>
                    </div>
                    
                    <!-- Make -->
                    <div id="make_container" class="formelement">
                        <label for="make"><span class="required">*</span> Make</label>
                        <select id="make" name="make" class="select" disabled="disabled">
                             <option value=""><span style="color: #ccc"> -- select -- </span></option>
                        </select>
                        <img id="make_indicator" src="images/indicator.gif" alt="" class="indicator" style="display: none;"/>
                        <span id="makeError" class="formerror"></span>
                    </div>
                    
                    <!-- Model -->
                    <div id="model_container" class="formelement">
                        <label for="model"><span class="required">*</span> Model</label>
                        <select id="model" name="model" class="select" disabled="disabled">
                            <option value=""> -- select -- </option>
                        </select>
                        <img id="model_indicator" src="images/indicator.gif" alt="" class="indicator" style="display: none;"/>
                        <span id="modelError" class="formerror"></span>
                    </div>
                    
                    <!-- Transmission -->
                    <div id="trans_container" class="formelement">
                        <label for="trans"><span class="required">*</span> Transmission</label>
                        <select id="trans" name="trans" class="select" disabled="disabled">
                            <option value=""> -- select -- </option>
                        </select>
                        <img id="trans_indicator" src="images/indicator.gif" alt="" class="indicator" style="display: none;"/>
                        <span id="transError" class="formerror"></span>
                    </div>
                    
                    <!-- Cylinders -->
                    <div id="cylinders_container" class="formelement">
                        <label for="cylinders"><span class="required">*</span> Cylinders</label>
                        <select id="cylinders" name="cylinders" class="select" disabled="disabled">
                            <option value=""> -- select -- </option>
                        </select>
                        <img id="cylinders_indicator" src="images/indicator.gif" alt="" class="indicator" style="display: none;"/>
                        <span id="cylindersError" class="formerror"></span>
                    </div>
        
                    <!-- Combined MPG -->
                    <div id="mpg_container" class="formelement">
                        <label for="mpg"><span class="required">*</span> Combined Miles Per Gallon</label>
                        <input id="mpg" name="mpg" type="text" value="{$mpg}" maxlength="3" class="textbox" disabled="disabled" />
                        <img id="mpg_indicator" src="images/indicator.gif" alt="" class="indicator" style="display: none;"/>
                        <span id="mpgError" class="formerror"></span>
                    </div>
                    
                    <!-- Carbon Emissions -->
                    <div id="emissions_container" class="formelement">
                        <label for="emissions"><span class="required">*</span> Carbon Emissions</label>
                        <input id="emissions" name="emissions" type="text" value="{$emissions}" maxlength="25" class="textbox" disabled="disabled" />
                        <img id="emissions_indicator" src="images/indicator.gif" alt="" class="indicator" style="display: none;"/>
                        <span id="emissionsError" class="formerror"></span>
                    </div>
                    
                </div>
                    
                <!-- Submit Button -->
                <div class="formelement">
                    <input id="submit" name="submit" type="submit" value="Next >>" class="submit" />
                </div>
                
            </form>
        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}            
        </div>
        

    </div>


    
    <div id="onecolumnbtm"></div>

</body>
</html>
