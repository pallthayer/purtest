<?php /* Smarty version 2.6.19, created on 2011-09-06 16:09:52
         compiled from cmap.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script language="javascript" src="js/formfocus.js"></script>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo $this->_tpl_vars['google_key']; ?>
" type="text/javascript"></script>
<script language="javascript" src="js/icons.js"></script>
<script language="javascript" src="js/cmap.js"></script>

<?php echo '

<script type="text/javascript">
	
	// INITIAL EVENT LISTENERS
	document.observe("dom:loaded", function() 
	{
		
		// Load Map
        if (GBrowserIsCompatible()) {
            loadGMap();
        }
		
		// Listen for form submission
		Event.observe(\'myform\', \'submit\', searchPost);
	
	});
	
	// Search Post
	function searchPost(e)
	{
		// Prevent form submission
		Event.stop(e);
		
		// Send AJAX request
		var url = \'community-map.php?state=searchpoi\';
		var params = Form.serialize(\'myform\');
		var ajax = new Ajax.Request( url, { method: \'post\', postBody: params, onSuccess: searchResponse }); 
	}
	
	// Search Response
	function searchResponse(resp)
	{
		// Obtain JSON response
		var json = resp.responseText.evalJSON();
		
		// Clear markers and redraw with new JSON
		showMarkersById(json);
		
		
		
	}
	
</script>

'; ?>


<script type="text/javascript">

var mode="browse"; //edit or browse
var endlat = <?php echo $this->_tpl_vars['workplacelat']; ?>
;
var endlng = <?php echo $this->_tpl_vars['workplacelng']; ?>
;
var workplace = "<?php echo $this->_tpl_vars['workplacetitle']; ?>
";

var poiData = <?php echo $this->_tpl_vars['poiData']; ?>
;

</script>

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
        <h2>Community Map</h2>
        
    </div>
        
    <!-- Tabs -->
    <div id="tabs">
        <ul>
            <li class="first current"><a href="community-map.php">Browse cMap</a></li>
            <li><a href="community-map.php?state=editpoi">Add/Edit Points of Interest</a></li>
        </ul>
    </div>
      
	<div id="tabtop"></div>
        
        <!-- Content -->
        <div class="content">
        	
            
            <!-- Display Map -->
            <div id="map" style="width: 400px; height: 400px; float: right; margin-top: 50px"></div>
            
            
            <!-- Display Keywords -->
            <h3>Keywords</h3>
            
            <!-- Search box -->
            <div id="searchtags" style="margin-bottom: 25px">
            	<form id="myform">
                	<input id="search" name="search" type="text" class="textbox" />
                    <input id="submit" name="submit" type="submit" value="Search" class="submit" />
                    (by member name, title, tag, location)
                </form>
            </div>
            
            <div id="list">
                <?php if ($this->_tpl_vars['taglist']): ?>
                	<a href="#" onclick="showMarkersByTag('all'); return false;" style="font-size: 20pt">All</a> | 
                    <?php unset($this->_sections['info']);
$this->_sections['info']['name'] = 'info';
$this->_sections['info']['loop'] = is_array($_loop=$this->_tpl_vars['taglist']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                        <a href="#" onclick="showMarkersByTag('<?php echo $this->_tpl_vars['taglist'][$this->_sections['info']['index']]['tag']; ?>
'); return false;" style="font-size: <?php echo $this->_tpl_vars['taglist'][$this->_sections['info']['index']]['size']; ?>
"><?php echo $this->_tpl_vars['taglist'][$this->_sections['info']['index']]['tag']; ?>
</a>
                    <?php endfor; endif; ?>
                <?php endif; ?>
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