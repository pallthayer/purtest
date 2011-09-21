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
<script language="javascript" src="js/register-car.js"></script>

</head>

<body>

	<!-- Header -->
    <div id="header">
    	
        <!-- Purpool Logo -->
        <img src="images/logo.jpg" alt="Purpool" />
        
        <!-- Top Navigation -->
        <div id="topnav">
        	<ul>
            	<li><a href="signin.php">Signin</a></li>
                <li><a href="register.php">Register</a></li>
            </ul>
        </div>
        
    </div>
    
   	<!-- Full Column -->
    <div id="fullcolumn">
    
    	<!-- Page Title -->
        <h1>{$pagetitle}</h1>
        
        <!-- User Profile -->
        <div id="wizard">
        	<ul>
           	  <li><a href="register.php">1. General</a></li>
              <li class="current">2. Vehicle</li>
              <li>3. Interests</li>
            </ul>
            <div class="step">
            	Step 2 of 3            
            </div>
      </div>
        	
        <!-- General Form -->
        <form id="profileCar" method="post" action="register.php?state=car">
        
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
            </div>
            
            <!-- Color -->
            <div id="color_container" class="formelement">
                <label for="color"><span class="required">*</span> Color</label>
                <select id="color" name="color" class="select" />
                    <option value=""> -- select -- </option>
                    <option value="silver" {if $color eq 'silver'}selected="selected"{/if}>Silver</option>
                    <option value="white" {if $color eq 'white'}selected="selected"{/if}>White</option>
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
            </div>
 
            <!-- Year -->
            <div id="year_container" class="formelement">
                <label for="year"><span class="required">*</span> Year</label>
                <select id="year" name="year" class="select" />
                    <option value=""> -- select -- </option>
                    <option value="2009" {if $year == '2009'}selected="selected"{/if}>2009</option>
                    <option value="2008" {if $year == '2008'}selected="selected"{/if}>2008</option>
                    <option value="2007" {if $year == '2007'}selected="selected"{/if}>2007</option>
                    <option value="2006" {if $year == '2006'}selected="selected"{/if}>2006</option>
                    <option value="2005" {if $year == '2005'}selected="selected"{/if}>2005</option>
                    <option value="2004" {if $year == '2004'}selected="selected"{/if}>2004</option>
                    <option value="2003" {if $year == '2003'}selected="selected"{/if}>2003</option>
                    <option value="2002" {if $year == '2002'}selected="selected"{/if}>2002</option>
                    <option value="2001" {if $year == '2001'}selected="selected"{/if}>2001</option>
                    <option value="2000" {if $year == '2000'}selected="selected"{/if}>2000</option>
                    <option value="1999" {if $year == '1999'}selected="selected"{/if}>1999</option>
                    <option value="1998" {if $year == '1998'}selected="selected"{/if}>1998</option>
                    <option value="1997" {if $year == '1997'}selected="selected"{/if}>1997</option>
                    <option value="1996" {if $year == '1996'}selected="selected"{/if}>1996</option>
                    <option value="1995" {if $year == '1995'}selected="selected"{/if}>1995</option>
                    <option value="1994" {if $year == '1994'}selected="selected"{/if}>1994</option>
                    <option value="1993" {if $year == '1993'}selected="selected"{/if}>1993</option>
                    <option value="1992" {if $year == '1992'}selected="selected"{/if}>1992</option>
                    <option value="1991" {if $year == '1991'}selected="selected"{/if}>1991</option>
                    <option value="1990" {if $year == '1990'}selected="selected"{/if}>1990</option>
                    <option value="other" {if $year == 'other'}selected="selected"{/if}>Other</option>
                </select>
            </div>
            
            <!-- Make -->
            <div id="make_container" class="formelement">
                <label for="make"><span class="required">*</span> Make</label>
                <select id="make" name="make" class="select" disabled="disabled" />
                     <option value=""> -- select -- </option>
                </select>
                <img id="make_indicator" src="images/indicator.gif" alt="" style="display: none;"/>
                <span id="makeError" class="formerror" style="display: none"></span>
            </div>
            
            <!-- Model -->
            <div id="model_container" class="formelement">
                <label for="model"><span class="required">*</span> Model</label>
                <select id="model" name="model" class="select" disabled="disabled"/>
                    <option value=""> -- select -- </option>
                </select>
                 <img id="model_indicator" src="images/indicator.gif" alt="" style="display: none;"/>
            </div>
            
            <!-- Style -->
            <div id="style_container" class="formelement">
                <label for="style"><span class="required">*</span> Style</label>
                <select id="style" name="style" class="select" disabled="disabled"/>
                    <option value=""> -- select -- </option>
                </select>
                 <img id="style_indicator" src="images/indicator.gif" alt="" style="display: none;"/>
            </div>

            <!-- Combined MPG -->
            <div id="mpg_container" class="formelement">
                <label for="mpg"><span class="required">*</span> Combined Miles Per Gallon</label>
                <input id="mpg" name="mpg" type="text" value="{$mpg}" maxlength="3" class="textbox" disabled="disabled" />
                 <img id="mpg_indicator" src="images/indicator.gif" alt="" style="display: none;"/>
                <span id="mpgError" class="formerror" style="display: none"></span>
            </div>
            
            <!-- Submit Button -->
            <div class="formelement">
                <input id="submit" name="submit" type="submit" value="Next >>" class="submit" />
            </div>
            
        </form>
        
    </div>
    
    <!-- Indicator -->
    <img id="indicator" src="images/indicator.gif" alt="" style="display: none;"/>

</body>
</html>
