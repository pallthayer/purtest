<?php /* Smarty version 2.6.19, created on 2011-09-06 15:40:44
         compiled from profile-browse.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo $this->_tpl_vars['google_key']; ?>
" type="text/javascript"></script>
<script language="javascript" src="js/sorttable.js"></script>

<script type="text/javascript">

	var profileData = [
		<?php unset($this->_sections['info']);
$this->_sections['info']['name'] = 'info';
$this->_sections['info']['loop'] = is_array($_loop=$this->_tpl_vars['members']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<?php echo '{'; ?>

			'zipcode':'<?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['zipcode']; ?>
','location':'<?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['latitude']; ?>
,<?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['longitude']; ?>
'<?php echo '}'; ?>
,
		<?php endfor; endif; ?>
		];
		
	var defaultzip = "<?php echo $this->_tpl_vars['defaultzip']; ?>
";
	var lat = '<?php echo $this->_tpl_vars['lat']; ?>
';
	var lng = '<?php echo $this->_tpl_vars['lng']; ?>
';
	var workplace ='<?php echo $this->_tpl_vars['workplace']; ?>
';
</script>

<?php echo '
<script type="text/javascript">
	
	var type = "profile";
	
	// INITIAL EVENT LISTENERS
	document.observe("dom:loaded", function() 
	{
		
		if (GBrowserIsCompatible()) {
			loadGMap(lat, lng);
			
			// Go to default zipcode
			if(defaultzip != \'\')
			{
				markerSelected(defaultzip);
			}
		}
	});
	
</script>
'; ?>


<script  language="javascript" src="js/icons.js"></script>
<script language="javascript1.3" src="js/browse.js"></script>
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
    
    <!-- Left Column 
    <div id="leftcolumn">
    	
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "sidenavigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

    </div>
    //-->

    
    	<!-- Content Bar -->
        <div id="contentbar">
        
            <!-- Page Heading -->
            <h2>People</h2>
            
            <!-- Tabs -->
            <div id="tabs">
              	<ul>
                	<li class="current"><a href="profile.php?state=browseprofiles">Browse People</a></li>
                	<li class="first"><a href="profile.php?state=viewprofile">View Profile</a></li>
                    <li><a href="profile.php?state=editgeneral">Edit Profile</a></li>
                    
                </ul>
            </div>
            
        </div>
        
        <div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
        	<h3>Browse People</h3>
        	
            <div class="innercolumn2" style="height:375px;width:449px;overflow-x:hidden;overflow-y:scroll;">
	            <!-- Displays current zipcode -->
	            <div id="list"></div>
	        	
	            <!-- A through Z directory -->
	            <a href="profile.php?state=browseprofiles&sortby=member">All</a> | 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=a">A</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=b">B</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=c">C</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=d">D</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=e">E</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=f">F</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=g">G</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=h">H</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=i">I</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=j">J</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=k">K</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=m">L</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=n">M</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=n">N</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=o">O</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=p">P</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=q">Q</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=r">R</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=s">S</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=t">T</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=u">U</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=v">V</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=w">W</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=x">X</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=y">Y</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=z">Z</a> 
	            
	            <br /><br />
	            <div id="browsetable">
	                <?php if ($this->_tpl_vars['members']): ?>
                    <img src="images/table2.gif" /><br/>
	                <table class="table2 sortable" style="width:434px;">
	                    <tr class="tablehead">
	                        <th id="first_col">Member</th>
	                        <th>Workplace</th>
	                        <th>Zipcode</th>
	                    </tr>
	                    <?php unset($this->_sections['info']);
$this->_sections['info']['name'] = 'info';
$this->_sections['info']['loop'] = is_array($_loop=$this->_tpl_vars['members']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	                            <td sorttable_customkey="<?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['counter']; ?>
"><a href="profile.php?state=viewprofile&user=<?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['user_id']; ?>
"><?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['firstname']; ?>
 <?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['lastname']; ?>
</a></td>
	                            <td><?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['workplace']; ?>
</td>
	                            <td><a href="#" onclick="markerSelected('<?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['zipcode']; ?>
'); return false;"><?php echo $this->_tpl_vars['members'][$this->_sections['info']['index']]['zipcode']; ?>
</a></td> 
	                        </tr>
	                    <?php endfor; endif; ?>
	                </table>
	                <?php else: ?>
	                    <p>There are currently no members that match this criteria.</p>
	                <?php endif; ?>
	            </div>
            </div>
        	<div class="innercolumn2" id="last" style="width:417px;">
	       		<!-- Map -->
	            <div id="map" style="width: 417px; height: 370px;"></div>
            </div>
			<div class="clear"></div>
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