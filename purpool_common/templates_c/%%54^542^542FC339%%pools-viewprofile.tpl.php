<?php /* Smarty version 2.6.19, created on 2008-08-15 16:54:16
         compiled from pools-viewprofile.tpl */ ?>
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

        <div id="contentbar" style="border-bottom: 1px solid #909">

        

            <!-- Page Heading -->

            <h1>Pools</h1>

            

        </div>

        

        <!-- Content -->

        <div id="content">

        	

            <!-- User profile -->        

            <table>

            	<?php if ($this->_tpl_vars['userphoto']): ?>

                	<tr>

                	    <td><span class="purple">Photo</span></td><td><img src="users/<?php echo $this->_tpl_vars['userphoto']; ?>
" alt="" /></td>

                	</tr>

                <?php endif; ?>

                <tr>

                    <td><span class="purple">Name</span></td><td><?php echo $this->_tpl_vars['firstname']; ?>
 <?php echo $this->_tpl_vars['lastname']; ?>
</td>

                </tr>

                <tr>

                    <td><span class="purple">Gender</span></td><td><?php echo $this->_tpl_vars['gender']; ?>
</td>

                </tr>

                <tr>

                    <td><span class="purple">E-mail</span></td><td><?php echo $this->_tpl_vars['email']; ?>
</td>

                </tr>

                <tr>

                    <td><span class="purple">Cell Phone</span></td><td><?php echo $this->_tpl_vars['cellphone']; ?>
</td>

                </tr>

                <tr>

                    <?php if ($this->_tpl_vars['workphone']): ?><td><span class="purple">Work Phone</span></td><td><?php echo $this->_tpl_vars['workphone']; ?>
</td><?php endif; ?>

                </tr>

                <tr>

                    <?php if ($this->_tpl_vars['occupation']): ?><td><span class="purple">Occupation</span></td><td><?php echo $this->_tpl_vars['occupation']; ?>
</td><?php endif; ?>

                </tr>

                <tr>

                    <td><span class="purple">Vehicle</span></td><td><?php echo $this->_tpl_vars['year']; ?>
 <?php echo $this->_tpl_vars['color']; ?>
 <?php echo $this->_tpl_vars['make']; ?>
 <?php echo $this->_tpl_vars['model']; ?>
 (<?php echo $this->_tpl_vars['seats']; ?>
 seats)</td>

                </tr>

                <tr>

                    <?php if ($this->_tpl_vars['music']): ?><td><span class="purple">Musical Preferences</span></td><td><?php echo $this->_tpl_vars['music']; ?>
</td><?php endif; ?>

                </tr>

                <tr>

                    <?php if ($this->_tpl_vars['interests']): ?><td><span class="purple">Interests</span></td><td><?php echo $this->_tpl_vars['interests']; ?>
</td><?php endif; ?>

                </tr>

            </table>



        </div>

        

    </div>





</body>

</html>