<?php /* Smarty version 2.6.19, created on 2008-07-17 15:10:14
         compiled from viewallrides.tpl */ ?>
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

            

        <!-- Show Rides -->

        <?php if ($this->_tpl_vars['rides']): ?>

        	<table class="tabular" cellspacing="0">

            	<tr>

                	<th>Ride Title</th>

                    <th>Type</th>

                    <th>Frequency</th>

                    <th>Days</th>

                    <th>Depart</th>

                    <th>Destination</th>

                    <th>Options</th>

                </tr>

                <?php unset($this->_sections['info']);
$this->_sections['info']['name'] = 'info';
$this->_sections['info']['loop'] = is_array($_loop=$this->_tpl_vars['rides']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

                    	<td><?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['ridetitle']; ?>
</td>

                        <td>

                        	<?php if ($this->_tpl_vars['rides'][$this->_sections['info']['index']]['ridetype'] == 'round'): ?>Round Trip<?php endif; ?>

							<?php if ($this->_tpl_vars['rides'][$this->_sections['info']['index']]['ridetype'] == 'oneway'): ?>One Way<?php endif; ?>

						</td>

                        <td><?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['ridefrequency']; ?>
</td>

                        <td>

                        	<?php if ($this->_tpl_vars['rides'][$this->_sections['info']['index']]['sunday']): ?>Su <?php endif; ?>

                            <?php if ($this->_tpl_vars['rides'][$this->_sections['info']['index']]['monday']): ?>M <?php endif; ?>

                            <?php if ($this->_tpl_vars['rides'][$this->_sections['info']['index']]['tuesday']): ?>Tu <?php endif; ?>

                            <?php if ($this->_tpl_vars['rides'][$this->_sections['info']['index']]['wednesday']): ?>W<?php endif; ?>

                            <?php if ($this->_tpl_vars['rides'][$this->_sections['info']['index']]['thursday']): ?>Th<?php endif; ?>

                            <?php if ($this->_tpl_vars['rides'][$this->_sections['info']['index']]['friday']): ?>F<?php endif; ?>

                            <?php if ($this->_tpl_vars['rides'][$this->_sections['info']['index']]['saturday']): ?>Sa<?php endif; ?>

                        </td>

						<td>

                        	<?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['startaddress1']; ?>
<br />

                        	<?php if ($this->_tpl_vars['rides'][$this->_sections['info']['index']]['startaddress2']): ?><?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['startaddress2']; ?>
<br /><?php endif; ?>

                            <?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['startcity']; ?>
 <?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['startstate']; ?>
, <?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['startzip']; ?>


                        </td>

                        <td>

                        	<?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['endaddress1']; ?>
<br />

                        	<?php if ($this->_tpl_vars['rides'][$this->_sections['info']['index']]['endaddress2']): ?><?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['endaddress2']; ?>
<br /><?php endif; ?>

                            <?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['endcity']; ?>
 <?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['endstate']; ?>
, <?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['endzip']; ?>
<br />

                            Arrive: <?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['arrivehour']; ?>
:<?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['arriveminute']; ?>
 <?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['arriveampm']; ?>


                            <?php if ($this->_tpl_vars['rides'][$this->_sections['info']['index']]['departhour']): ?><br />Depart: <?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['departhour']; ?>
:<?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['departminute']; ?>
 <?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['departampm']; ?>
<?php endif; ?>

                        </td>

                        <td>

                        	<img src="icons/icon-edit.gif" alt="" class="icon" /> <a href="admin.php?state=viewride&ride=<?php echo $this->_tpl_vars['rides'][$this->_sections['info']['index']]['ride_id']; ?>
">View Details</a><br />

                        </td>

                    </tr>

                <?php endfor; endif; ?>

            </table>

		<?php else: ?>

        	<p class="red">There are currently no rides on file.</p>

        <?php endif; ?>

        

    </div>

    

    <!-- Clear -->

    <div style="clear: both;"></div>

    

    <!-- Indicator -->

    <img id="indicator" src="images/indicator.gif" alt="" style="display: none;"/>

    





</body>

</html>