<?php /* Smarty version 2.6.19, created on 2011-09-07 17:27:35
         compiled from profile-editgeneral.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script language="javascript" src="js/formfocus.js"></script>
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
            <h2>People</h2>
            
            <!-- Tabs -->
            <div id="tabs">
              	<ul>
                	<li class="first"><a href="profile.php?state=browseprofiles">Browse People</a></li>
                	<li><a href="profile.php?state=viewprofile">View Profile</a></li>
                    <li class="current"><a href="profile.php?state=editgeneral">Edit Profile</a></li>
                    
                </ul>
            </div>

        </div>
        
        <div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
        	<h3 style="margin-bottom:0;">Edit Profile</h3>
        	
            <div id="wizard">
                <ul>
                    <li class="current"><a href="profile.php?state=editgeneral">Edit General Info</a></li>
                    <li><a href="profile.php?state=updatevehicle">Edit Vehicle</a></li>
                    <li><a href="profile.php?state=editinterests">Edit Interests</a></li>
                    <li><a href="profile.php?state=editpassword">Change Password</a></li>
                </ul>
            </div>
            <div class="clear"></div>
            <!-- Confirmation -->
            <?php if ($this->_tpl_vars['confirmation']): ?><p class="green"><?php echo $this->_tpl_vars['confirmation']; ?>
</p><?php endif; ?>
            
            <!-- General Form -->
            <form id="myform" method="post" enctype="multipart/form-data" action="profile.php?state=editgeneral">
                
                <!-- Workplace -->
                <div class="formelement">
                    <label for="workplace"><span class="required">*</span> Workplace</label>
                    <select id="workplace" name="workplace" class="select">
                        <option value="">-- select --</option>
                        <?php unset($this->_sections['info']);
$this->_sections['info']['name'] = 'info';
$this->_sections['info']['loop'] = is_array($_loop=$this->_tpl_vars['workplaces']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                            <option value="<?php echo $this->_tpl_vars['workplaces'][$this->_sections['info']['index']]['workplace_id']; ?>
" <?php if ($this->_tpl_vars['workplace'] == $this->_tpl_vars['workplaces'][$this->_sections['info']['index']]['workplace_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['workplaces'][$this->_sections['info']['index']]['name']; ?>
</option>
                        <?php endfor; endif; ?>
                    </select>
                    <span id="workplaceError" class="formerror"><?php echo $this->_tpl_vars['error']['workplace']; ?>
</span>
                </div>
                
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
                
                <!-- Gender -->
                <div class="formelement">
                    <label for="gender"><span class="required">*</span> Gender</label>
                    <input id="gender_female" name="gender" type="radio" value="female" <?php if ($this->_tpl_vars['gender'] == 'female'): ?>checked="checked"<?php endif; ?> /> Female<br />
                    <input id="gender_male" name="gender" type="radio" value="male" <?php if ($this->_tpl_vars['gender'] == 'male'): ?>checked="checked"<?php endif; ?> /> Male
                </div>
                
                <!-- E-mail -->
                <div class="formelement">
                    <label for="email"><span class="required">*</span> E-mail (read only)</label>
                    <input id="email_disabled" name="email_disabled" type="text" value="<?php echo $this->_tpl_vars['email']; ?>
" disabled="disabled" maxlength="50" class="textbox" />
                    <input id="email" name="email" type="hidden" value="<?php echo $this->_tpl_vars['email']; ?>
"  />
                    <span id="emailError" class="formerror"><?php echo $this->_tpl_vars['error']['email']; ?>
</span>
                </div>
                
                <!-- Cell Phone -->
                <div class="formelement">
                    <label for="cellphone1">Cell Phone</label>
                    ( <input id="cellphone1" name="cellphone1" type="text" value="<?php echo $this->_tpl_vars['cellphone1']; ?>
" maxlength="3" style="width: 30px" class="textbox" /> )
                    <input id="cellphone2" name="cellphone2" type="text" value="<?php echo $this->_tpl_vars['cellphone2']; ?>
" maxlength="3" style="width: 30px" class="textbox" /> - 
                    <input id="cellphone3" name="cellphone3" type="text" value="<?php echo $this->_tpl_vars['cellphone3']; ?>
" maxlength="4" style="width: 125px" class="textbox" />
                    <span id="cellphoneError" class="formerror"><?php echo $this->_tpl_vars['error']['cellphone']; ?>
</span>
                </div>
                
                <!-- Work Phone -->
                <div class="formelement">
                    <label for="workphone1">Work Phone</label>
                    ( <input id="workphone1" name="workphone1" type="text" value="<?php echo $this->_tpl_vars['workphone1']; ?>
" maxlength="3" style="width: 30px" class="textbox" /> )
                    <input id="workphone2" name="workphone2" type="text" value="<?php echo $this->_tpl_vars['workphone2']; ?>
" maxlength="3" style="width: 30px" class="textbox" /> - 
                    <input id="workphone3" name="workphone3" type="text" value="<?php echo $this->_tpl_vars['workphone3']; ?>
" maxlength="4" style="width: 125px" class="textbox" />
                    Ext: <input id="workphone4" name="workphone4" type="text" value="<?php echo $this->_tpl_vars['workphone4']; ?>
" maxlength="4" style="width: 125px" class="textbox" />
                    <span id="workphoneError" class="formerror"><?php echo $this->_tpl_vars['error']['workphone']; ?>
</span>
                </div>
                
                 <!-- Zipcode -->
                <div class="formelement">
                    <label for="zipcode"><span class="required">*</span> Zipcode of primary residence:</label>
                    <input id="zipcode" name="zipcode" type="text" value="<?php echo $this->_tpl_vars['zipcode']; ?>
" maxlength="5" class="textbox" />
                    <span id="zipcodeError" class="formerror"><?php echo $this->_tpl_vars['error']['zipcode']; ?>
</span>
                </div>
                
                <!-- Schedule -->
                <div class="formelement">
                    <label for="schedule">In general, what is your work schedule?</label>
                    <textarea id="schedule" name="schedule" rows="5" class="textarea"><?php echo $this->_tpl_vars['schedule']; ?>
</textarea>
                    <span id="scheduleError" class="formerror"><?php echo $this->_tpl_vars['error']['schedule']; ?>
</span>
                </div>
                
                <!-- Job Title -->
                <div class="formelement">
                    <label for="occupation">Occupation</label>
                    <input id="occupation" name="occupation" type="text" value="<?php echo $this->_tpl_vars['occupation']; ?>
" maxlength="100" class="textbox" />
                </div>
                
                <!-- Photo -->
                <div class="formelement">
                    <label for="upload"><?php if ($this->_tpl_vars['photo']): ?>Replace Photo<?php else: ?>Photo<?php endif; ?> (.jpg format)</label>
                    <input id="file" name="file" type="file" class="textbox"  />
                    <span id="photoError" class="formerror"><?php echo $this->_tpl_vars['error']['photo']; ?>
</span>
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