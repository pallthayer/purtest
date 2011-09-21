<?php /* Smarty version 2.6.19, created on 2008-07-17 14:57:25
         compiled from passengers.tpl */ ?>
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

<script language="javascript" src="js/admin.js"></script>

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

        	<li><a href="admin.php?state=updateprofile">Update Profile</a></li>

            <li><a href="admin.php?state=createride">Create a Ride</a></li>

            <li><a href="admin.php?state=requestride" class="current">Request a Ride</a></li>

        </ul>

    

    </div>

    

    <!-- Right Column -->

    <div id="rightcolumn">

    

    	<!-- Page Title -->

        <h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>

            

         <!-- Tabs -->

        <div id="tabs">

        	<ul>

            	<li><a href="admin.php?state=viewride&ride=<?php echo $this->_tpl_vars['ride_id']; ?>
">Ride Information</a></li>

                <li><a href="admin.php?state=displaymap&ride=<?php echo $this->_tpl_vars['ride_id']; ?>
">Map</a></li>

                <li class="current"><a href="admin.php?state=passengers&ride=<?php echo $this->_tpl_vars['ride_id']; ?>
">Passengers</a></li>

            </ul>

        </div>

        

        <div style="margin-top: 75px"></div>

        

        <!-- Show Ride Information -->

        <table cellspacing="0">

        	<tr>

            	<th>Name</th>

                <th>Email</th>

                <th>Phone</th>

                <th>Occupation</th>

                <th>Car</th>

            </tr>

            <?php unset($this->_sections['info']);
$this->_sections['info']['name'] = 'info';
$this->_sections['info']['loop'] = is_array($_loop=$this->_tpl_vars['passengers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

            	<tr>

                	<td><?php echo $this->_tpl_vars['passengers'][$this->_sections['info']['index']]['firstname']; ?>
 <?php echo $this->_tpl_vars['passengers'][$this->_sections['info']['index']]['lastname']; ?>
</td>

                    <td><?php echo $this->_tpl_vars['passengers'][$this->_sections['info']['index']]['email']; ?>
</td>

                    <td><?php echo $this->_tpl_vars['passengers'][$this->_sections['info']['index']]['phone']; ?>
</td>

                    <td><?php echo $this->_tpl_vars['passengers'][$this->_sections['info']['index']]['job']; ?>
</td>

                    <td><?php echo $this->_tpl_vars['passengers'][$this->_sections['info']['index']]['caryear']; ?>
 <?php echo $this->_tpl_vars['passengers'][$this->_sections['info']['index']]['carmake']; ?>
 <?php echo $this->_tpl_vars['passengers'][$this->_sections['info']['index']]['carmodel']; ?>
</td>

                </tr>

            <?php endfor; endif; ?>

		</table>



    </div>

    

    <!-- Clear -->

    <div style="clear: both;"></div>

    

    <!-- Indicator -->

    <img id="indicator" src="images/indicator.gif" alt="" style="display: none;"/>

    





</body>

</html>