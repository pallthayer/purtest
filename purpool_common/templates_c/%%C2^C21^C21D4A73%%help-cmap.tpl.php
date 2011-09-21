<?php /* Smarty version 2.6.19, created on 2008-12-31 05:51:42
         compiled from help-cmap.tpl */ ?>
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

<body onload="window.location.hash = '#'+<?php echo $this->_tpl_vars['anchor']; ?>
";>

	<!-- Header -->
    <div id="header">
    	<a href="/" id="logo"><h1>Purpool</h1></a>
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
            <h2>Help</h2>
            
        </div>
        
        <!-- Tabs -->
            <div id="tabs">
                <ul>
                    <li class="first"><a href="help.php?state=about">About</a></li>
                    <li class="current"><a href="help.php?state=faq">FAQ</a></li>
                    <li><a href="help.php?state=tour">Tour</a></li>
                    <li><a href="help.php?state=privacy">Privacy Policy</a></li>
                    <li><a href="help.php?state=tos">Terms of Service</a></li>
                </ul>
            </div>

        
<div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
        
<h2>Community Map (cMap)</h2>
<p>
<a name="1"><h3>What is the cMap?</h3></a>
The Community Map (cMap) is a way for Purpool members to share points of interest with other members. Members can add  points of interest to the community map, describing and sharing places that are meaningful to them in the region surrounding the workplace. This functionality provides a platform for exploring the local area, highlighting favorite places like restaurants, parks and shops that are close to work or may fall along members’ commuting routes.
</p>

<p>
<a name="2"><h3>How can I add new points of interest?</h3></a> 
In the add/edit points of interest tab add a marker to the map by either clicking on the map or by entering an address. Once the marker appears on the map you can add information describing the point of interest including  a required title, a description, a url to link to a related website, and tags that capture the nature of the point of interest. Be sure to click on the save button when you are ready to save the point of interest to the Purpool database. You can always modify or delete later.
</p>


<p>
<a name="3"><h3>How do I modify or remove points of interest that I have created? </h3></a> 
In the add/edit points of interest tab click on the marker and edit the info in the form. If the location needs to be modified you'll need to delete and add a new point of interest. 
</p>

<p>
<a name="4"><h3>How do I find places that have been posted by a friend? </h3></a> 
In the browse page enter the member's name in the search box to search for points of interest that have been posted by that member.
</p>
<p>
<a name="5"><h3>How do tags work? </h3></a>
When someone posts a new point of interest they have an opportunity to add associated tags, also called keywords, to the point . For example a gas station might be tagged with "gas", "cheap", and "coffee". These tags get saved alongside other info about the point of interest in the purpool database and are displayed in a tag cloud on the cMap browse page. When you click on a tag only those points of interest that have been tagged with that tag are visible on the map. For exmplae clicking on the tag "coffee" will display all the points of interest that have been tagged with the word "coffee". The size of the tag in the tag cloud is proportional to the poularity of the tag among community members.

</p> 
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