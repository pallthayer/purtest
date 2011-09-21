<?php /* Smarty version 2.6.19, created on 2008-09-12 05:35:50
         compiled from pools-create3.tpl */ ?>
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

                  <li class="current">1. General</li>

                  <li>2. Departure Points</li>

                  <li>3. Members</li>

                  <li>4. Propose Schedule</li>

                </ul>

                <div class="step">

                    Step 1 of 4            

                </div>

            </div>

            

            <!-- Pool Form -->

            <form id="myform" method="post" action="pools.php?state=createpool">

                

                <!-- Departure 

                <div class="purplebox">

                    <img src="icons/star.gif" alt="" class="icon" /> General Ride Information

                </div>

                -->

                

                <!-- Start Place -->

                <div class="formelement">

                    <label for="title"><span class="required">*</span> Name your pool</label>

                    <input id="title" name="title" type="text" value="<?php echo $this->_tpl_vars['title']; ?>
" maxlength="100" class="textbox" />

                    <span id="titleError" class="formerror"></span>

                </div>



				<!-- Access Options -->

                <div class="formelement">

                    <label for="access"><span class="required">*</span> Who is allowed to join this pool?</label>

                    <input id="accessprivate" name="access" type="radio" value="private" <?php if ($this->_tpl_vars['access'] == 'private'): ?>checked="checked"<?php endif; ?> /> Private: By invitation only<br />

                    <input id="accesspublic" name="access" type="radio" value="public" <?php if ($this->_tpl_vars['access'] == 'public'): ?>checked="checked"<?php endif; ?> /> Public: Anyone can join<br />

                    <input id="accessexclusive" name="access" type="radio" value="exclusive" <?php if ($this->_tpl_vars['access'] == 'exclusive'): ?>checked="checked"<?php endif; ?> /> Exclusive: Only those in your workplace can join

                </div>               

               

                <!-- Smoking -->

                <div class="formelement">

                    <label for="smoking"><span class="required">*</span> Smoking Allowed?</label>

                    <input id="smokingNo" name="smoking" type="radio" value="no" <?php if ($this->_tpl_vars['smoking'] == 'no'): ?>checked="checked"<?php endif; ?> /> No <br />

                    <input id="smokingYes" name="smoking" type="radio" value="yes" <?php if ($this->_tpl_vars['smoking'] == 'yes'): ?>checked="checked"<?php endif; ?> /> Yes <br />

                </div>

                

                <!-- Additional Information -->

                <div class="formelement">

                    <label for="additionalinfo">Additional Information</label>

                    <textarea id="additionalinfo" name="additionalinfo" class="textbox" rows="8" style="width: 350px;"><?php echo $this->_tpl_vars['additionalinfo']; ?>
</textarea>

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