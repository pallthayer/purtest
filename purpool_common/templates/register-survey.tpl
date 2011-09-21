<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script language="javascript" src="js/formfocus.js"></script>
{literal}
<style type="text/css">
	.formerror{font-weight:bold;}
</style>
{/literal}
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
		    <input id="experience_never" name="experience" type="radio" value="Never" {if $experience eq 'Never'}checked="checked"{/if} /> Never<br />
		    
		    <input id="experience_five" name="experience" type="radio" value="Less than 5 times" {if $experience eq 'Less than 5 times'}checked="checked"{/if} /> Less than 5 times<br />
		    
		    <input id="experience_twenty" name="experience" type="radio" value="Between 6 and 20 times" {if $experience eq 'Between 6 and 20 times'}checked="checked"{/if} /> Between 6 and 20 times<br />
		    
		    <input id="experience_regularly" name="experience" type="radio" value="Regularly" {if $experience eq 'Regularly'}checked="checked"{/if} /> Regularly<br />
		    <div id="experienceError" class="formerror">{$error.experience}</div>		    
                </div>
                
            	<!-- Routine -->
		<div class="formelement">
		    <label for="routine"><span class="required">*</span> Please indicate which of the following best describes your current  carpooling routine?</label>
		    <input id="routine_never" name="routine" type="radio" value="Never" {if $routine eq 'Never'}checked="checked"{/if} /> Never<br />
		    
		    <input id="routine_monthly" name="routine" type="radio" value="Once a month" {if $routine eq 'Once a month'}checked="checked"{/if} /> Once a month<br />
		    
		    <input id="routine_weekly" name="routine" type="radio" value="Once a week" {if $routine eq 'Once a week'}checked="checked"{/if} /> Once a week<br />
		    
		    <input id="routine_more" name="routine" type="radio" value="More than once a week" {if $routine eq 'More than once a week'}checked="checked"{/if} /> More than once a week<br />
		    <div id="routineError" class="formerror">{$error.routine}</div>		  
                </div>
            
                <!-- Recruitment -->
                <div class="formelement">
                    <label for="recruitment"><span class="required">*</span> How did you find out about Purpool?</label>
                    <select id="recruitment" name="recruitment" class="select">
                        <option value="">-- select --</option>
                        <option value="Employer referral" {if $recruitment eq 'Employer referral'}selected="selected"{/if}>Employer referral</option>
                        
                        <option value="Invited to join a car pool" {if $recruitment eq 'Invited to join a car pool'}selected="selected"{/if}>Invited to join a car pool</option>
                        
                        <option value="Word of mouth" {if $recruitment eq 'Word of mouth'}selected="selected"{/if}>Word of mouth</option>
                        
                        <option value="Promotional materials" {if $recruitment eq 'Promotional materials'}selected="selected"{/if}>Promotional materials (posters, etc...)</option>
                        
                        <option value="Internet search" {if $recruitment eq 'Internet search'}selected="selected"{/if}>Internet search</option>
                        
                        <option value="Other" {if $recruitment eq 'Other'}selected="selected"{/if}>Other</option>
                    </select>
                    <span id="recruitmentError" class="formerror">{$error.recruitment}</span>
                </div>
                
                <!-- Motivation -->
                <div class="formelement">
                    <label for="motivation"><span class="required">*</span> Which statement below describes the strongest motivation you have for wanting to carpool? </label>
                    <select id="motivation" name="motivation" class="select">
                        <option value="">-- select --</option>
                        <option value="I want to save money" {if $motivation eq 'I want to save money'}selected="selected"{/if}>I want to save money</option>
                        
                        <option value="I want to meet new people in the community" {if $motivation eq 'I want to meet new people in the community'}selected="selected"{/if}>I want to meet new people in the community</option>
                        
                        <option value="I am concerned about the environment" {if $motivation eq 'I am concerned about the environment'}selected="selected"{/if}>I am concerned about the environment</option>
                        
                        <option value="I do not like driving during peak hours" {if $motivation eq 'I do not like driving during peak hours'}selected="selected"{/if}>I do not like driving during peak hours</option>
                        
                        <option value="I do not have a car" {if $motivation eq 'I do not have a car'}selected="selected"{/if}>I do not have a car</option>
                        
                        <option value="Other" {if $motivation eq 'Other'}selected="selected"{/if}>Other</option>
                    </select>
                    <span id="motivationError" class="formerror">{$error.motivation}</span>
                </div>
                
                <!-- Comments -->
                <div class="formelement">
                    <label for="comments"> Any other comments?</label>
                    <textarea name="comments" rows="8" class="textarea">{$comments}</textarea>
                </div>
                
                <!-- Submit Button -->
                <div class="formelement">
                    <input id="submit" name="submit" type="submit" value="Submit" class="submit" />
                </div>
                
            </form>
        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}            
        </div>

    </div>


    
    <div id="onecolumnbtm"></div>

</body>
</html>
