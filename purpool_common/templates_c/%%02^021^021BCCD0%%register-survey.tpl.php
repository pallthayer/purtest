<?php /* Smarty version 2.6.19, created on 2009-05-26 05:02:45
         compiled from register-survey.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script language="javascript" src="js/formfocus.js"></script>
<?php echo '
<style type="text/css">
	.formerror{font-weight:bold;}
</style>
'; ?>

</head>

<body>

	<!-- Header -->
    <div id="header">
    	<a href="/" id="logo"><h1>Purpool</h1></a>
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
            <h2>Registration Survey</h2>
        </div>
        
		<div id="onecolumntop"></div>
        <!-- Content -->
        <div class="content">
        	
            <!-- User Profile -->
            
            <div class="clear"></div> 
            <!-- General Form -->
            <form id="myform" method="post" action="register.php?state=survey">
            
            	<!-- Experience -->
		<div class="formelement">
		    <label for="experience"><span class="required">*</span> Please indicate which of the following best describes your past carpooling experiences?</label>
		    <input id="experience_never" name="experience" type="radio" value="Never" <?php if ($this->_tpl_vars['experience'] == 'Never'): ?>checked="checked"<?php endif; ?> /> Never<br />
		    
		    <input id="experience_five" name="experience" type="radio" value="Less than 5 times" <?php if ($this->_tpl_vars['experience'] == 'Less than 5 times'): ?>checked="checked"<?php endif; ?> /> Less than 5 times<br />
		    
		    <input id="experience_twenty" name="experience" type="radio" value="Between 6 and 20 times" <?php if ($this->_tpl_vars['experience'] == 'Between 6 and 20 times'): ?>checked="checked"<?php endif; ?> /> Between 6 and 20 times<br />
		    
		    <input id="experience_regularly" name="experience" type="radio" value="Regularly" <?php if ($this->_tpl_vars['experience'] == 'Regularly'): ?>checked="checked"<?php endif; ?> /> Regularly<br />
		    <div id="experienceError" class="formerror"><?php echo $this->_tpl_vars['error']['experience']; ?>
</div>		    
                </div>
                
            	<!-- Routine -->
		<div class="formelement">
		    <label for="routine"><span class="required">*</span> Please indicate which of the following best describes your current  carpooling routine?</label>
		    <input id="routine_never" name="routine" type="radio" value="Never" <?php if ($this->_tpl_vars['routine'] == 'Never'): ?>checked="checked"<?php endif; ?> /> Never<br />
		    
		    <input id="routine_monthly" name="routine" type="radio" value="Once a month" <?php if ($this->_tpl_vars['routine'] == 'Once a month'): ?>checked="checked"<?php endif; ?> /> Once a month<br />
		    
		    <input id="routine_weekly" name="routine" type="radio" value="Once a week" <?php if ($this->_tpl_vars['routine'] == 'Once a week'): ?>checked="checked"<?php endif; ?> /> Once a week<br />
		    
		    <input id="routine_more" name="routine" type="radio" value="More than once a week" <?php if ($this->_tpl_vars['routine'] == 'More than once a week'): ?>checked="checked"<?php endif; ?> /> More than once a week<br />
		    <div id="routineError" class="formerror"><?php echo $this->_tpl_vars['error']['routine']; ?>
</div>		  
                </div>
            
                <!-- Recruitment -->
                <div class="formelement">
                    <label for="recruitment"><span class="required">*</span> How did you find out about Purpool?</label>
                    <select id="recruitment" name="recruitment" class="select">
                        <option value="">-- select --</option>
                        <option value="Employer referral" <?php if ($this->_tpl_vars['recruitment'] == 'Employer referral'): ?>selected="selected"<?php endif; ?>>Employer referral</option>
                        
                        <option value="Invited to join a car pool" <?php if ($this->_tpl_vars['recruitment'] == 'Invited to join a car pool'): ?>selected="selected"<?php endif; ?>>Invited to join a car pool</option>
                        
                        <option value="Word of mouth" <?php if ($this->_tpl_vars['recruitment'] == 'Word of mouth'): ?>selected="selected"<?php endif; ?>>Word of mouth</option>
                        
                        <option value="Promotional materials" <?php if ($this->_tpl_vars['recruitment'] == 'Promotional materials'): ?>selected="selected"<?php endif; ?>>Promotional materials (posters, etc...)</option>
                        
                        <option value="Internet search" <?php if ($this->_tpl_vars['recruitment'] == 'Internet search'): ?>selected="selected"<?php endif; ?>>Internet search</option>
                        
                        <option value="Other" <?php if ($this->_tpl_vars['recruitment'] == 'Other'): ?>selected="selected"<?php endif; ?>>Other</option>
                    </select>
                    <span id="recruitmentError" class="formerror"><?php echo $this->_tpl_vars['error']['recruitment']; ?>
</span>
                </div>
                
                <!-- Motivation -->
                <div class="formelement">
                    <label for="motivation"><span class="required">*</span> Which statement below describes the strongest motivation you have for wanting to carpool? </label>
                    <select id="motivation" name="motivation" class="select">
                        <option value="">-- select --</option>
                        <option value="I want to save money" <?php if ($this->_tpl_vars['motivation'] == 'I want to save money'): ?>selected="selected"<?php endif; ?>>I want to save money</option>
                        
                        <option value="I want to meet new people in the community" <?php if ($this->_tpl_vars['motivation'] == 'I want to meet new people in the community'): ?>selected="selected"<?php endif; ?>>I want to meet new people in the community</option>
                        
                        <option value="I am concerned about the environment" <?php if ($this->_tpl_vars['motivation'] == 'I am concerned about the environment'): ?>selected="selected"<?php endif; ?>>I am concerned about the environment</option>
                        
                        <option value="I do not like driving during peak hours" <?php if ($this->_tpl_vars['motivation'] == 'I do not like driving during peak hours'): ?>selected="selected"<?php endif; ?>>I do not like driving during peak hours</option>
                        
                        <option value="I do not have a car" <?php if ($this->_tpl_vars['motivation'] == 'I do not have a car'): ?>selected="selected"<?php endif; ?>>I do not have a car</option>
                        
                        <option value="Other" <?php if ($this->_tpl_vars['motivation'] == 'Other'): ?>selected="selected"<?php endif; ?>>Other</option>
                    </select>
                    <span id="motivationError" class="formerror"><?php echo $this->_tpl_vars['error']['motivation']; ?>
</span>
                </div>
                
                <!-- Comments -->
                <div class="formelement">
                    <label for="comments"> Any other comments?</label>
                    <textarea name="comments" rows="8" class="textarea"><?php echo $this->_tpl_vars['comments']; ?>
</textarea>
                </div>
                
                <!-- Submit Button -->
                <div class="formelement">
                    <input id="submit" name="submit" type="submit" value="Submit" class="submit" />
                </div>
                
            </form>
        <!-- Bottom Navigation Bar -->
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "bottomnavigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>            
        </div>

    </div>


    
    <div id="onecolumnbtm"></div>

</body>
</html>