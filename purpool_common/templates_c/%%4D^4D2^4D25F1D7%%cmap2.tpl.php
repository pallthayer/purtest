<?php /* Smarty version 2.6.19, created on 2008-12-21 20:50:39
         compiled from cmap2.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script language="javascript" src="js/formfocus.js"></script>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAA_2hDlr8GGBfE4xaODwzMdBTXq9fpoqsVDQwusP8wnl1JoF5PeRRah3cG9ATfaTXFHd6W2kdTXUmoow" type="text/javascript"></script>

<?php echo '

<script type="text/javascript">
	
	// INITIAL EVENT LISTENERS
	document.observe("dom:loaded", function() 
	{
		
		// Initialize Pool Form
		var poiForm = new Formfocus("myform");
				
		// Focus first element
		poiForm.focusFirst();
		
		// Listen for form submission
		Event.observe(\'myform\', \'submit\', addPoiPost);
	
	});
	
	// Add Point of Interest Post
	function addPoiPost(e)
	{
		// Prevent form submission
		Event.stop(e);
		
		// Clear previous errors
		$(\'titleError\').update(\'\'); 
		$(\'addressError\').update(\'\'); 
		$(\'cityError\').update(\'\'); 
		$(\'stateError\').update(\'\'); 
		$(\'zipError\').update(\'\'); 
		
		// Send AJAX request
		var url = \'community-map.php?state=addpoi\';
		var params = Form.serialize(\'myform\');
		var ajax = new Ajax.Request( url, { method: \'post\', postBody: params, onSuccess: addPoiResponse }); 
	}
	
	// Add Point of Interest Response
	function addPoiResponse(resp)
	{
		// Obtain JSON response
		var json = resp.responseText.evalJSON();
		
		// If successful
		if(json.status == \'success\')
		{
			// Redirect user
			alert(\'poi of interest has been added.\');
		}
		
		// If errors, display errors
		if(json.status == \'failure\')
		{
			if(json.error.title)    { $(\'titleError\').update(json.error.title); }
			if(json.error.address)  { $(\'addressError\').update(json.error.address); }
			if(json.error.city)     { $(\'cityError\').update(json.error.city); }
			if(json.error.state)    { $(\'stateError\').update(json.error.state); }
			if(json.error.zip)     	{ $(\'zipError\').update(json.error.zip); }
		}	
	}
	
	
</script>

'; ?>


</head>

<body>

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
        <h2>Community Map</h2>
        
    </div>
        
    <!-- Tabs 
    <div id="tabs">
        <ul>
            <li class="first current"><a href="pools.php">My Pools</a></li>
            <li><a href="pools.php?state=browsepools">Browse Pools</a></li>
        </ul>
    </div>
    -->

        
	<div id="tabtop"></div>
        
        <!-- Content -->
        <div class="content">
        	
            
            <!-- Display Map -->
            <div id="map" style="width: 400px; height: 400px; float: left; margin-top: 50px"></div>
            
            
            <!-- Add Point of Interest -->
            <h3>Add Point of Interest</h3>
            
            <form id="myform" name="myform" style="margin-left: 425px">
            
            	<div class="formelement">
                	<label for="title">Title: </label>
                    <input id="title" name="title" type="text" class="textbox" />
                    <span id="titleError" class="formerror"></span>
                </div>
                <div class="formelement">
                	<label for="address">Address: </label>
                    <input id="address" name="address" type="text" class="textbox" />
                    <span id="addressError" class="formerror"></span>
                </div>
                <div class="formelement">
                	<label for="city">City: </label>
                    <input id="city" name="city" type="text" class="textbox" />
                    <span id="cityError" class="formerror"></span>
                </div>
                <div class="formelement">
                	<label for="state">State: </label>
                    <select id="state" name="state" class="select">
                        <option value="">-- select --</option>
                        <option value="AL" <?php if ($this->_tpl_vars['startstate'] == 'AL'): ?>selected="selected"<?php endif; ?>>Alabama</option>
                        <option value="AK" <?php if ($this->_tpl_vars['startstate'] == 'AK'): ?>selected="selected"<?php endif; ?>>Alaska</option>
                        <option value="AZ" <?php if ($this->_tpl_vars['startstate'] == 'AZ'): ?>selected="selected"<?php endif; ?>>Arizona</option>
                        <option value="AR" <?php if ($this->_tpl_vars['startstate'] == 'AR'): ?>selected="selected"<?php endif; ?>>Arkansas</option>
                        <option value="CA" <?php if ($this->_tpl_vars['startstate'] == 'CA'): ?>selected="selected"<?php endif; ?>>California</option>
                        <option value="CO" <?php if ($this->_tpl_vars['startstate'] == 'CO'): ?>selected="selected"<?php endif; ?>>Colorado</option>
                        <option value="CT" <?php if ($this->_tpl_vars['startstate'] == 'CT'): ?>selected="selected"<?php endif; ?>>Connecticut</option>
                        <option value="DE" <?php if ($this->_tpl_vars['startstate'] == 'DE'): ?>selected="selected"<?php endif; ?>>Delaware</option>
                        <option value="DC" <?php if ($this->_tpl_vars['startstate'] == 'DC'): ?>selected="selected"<?php endif; ?>>District of Columbia</option>
                        <option value="FL" <?php if ($this->_tpl_vars['startstate'] == 'FL'): ?>selected="selected"<?php endif; ?>>Florida</option>
                        <option value="GA" <?php if ($this->_tpl_vars['startstate'] == 'GA'): ?>selected="selected"<?php endif; ?>>Georgia</option>
                        <option value="HI" <?php if ($this->_tpl_vars['startstate'] == 'HI'): ?>selected="selected"<?php endif; ?>>Hawaii</option>
                        <option value="ID" <?php if ($this->_tpl_vars['startstate'] == 'ID'): ?>selected="selected"<?php endif; ?>>Idaho</option>
                        <option value="IL" <?php if ($this->_tpl_vars['startstate'] == 'IL'): ?>selected="selected"<?php endif; ?>>Illinois</option>
                        <option value="IN" <?php if ($this->_tpl_vars['startstate'] == 'IN'): ?>selected="selected"<?php endif; ?>>Indiana</option>
                        <option value="IA" <?php if ($this->_tpl_vars['startstate'] == 'IA'): ?>selected="selected"<?php endif; ?>>Iowa</option>
                        <option value="KS" <?php if ($this->_tpl_vars['startstate'] == 'KS'): ?>selected="selected"<?php endif; ?>>Kansas</option>
                        <option value="KY" <?php if ($this->_tpl_vars['startstate'] == 'KY'): ?>selected="selected"<?php endif; ?>>Kentucky</option>
                        <option value="LA" <?php if ($this->_tpl_vars['startstate'] == 'LA'): ?>selected="selected"<?php endif; ?>>Louisiana</option>
                        <option value="ME" <?php if ($this->_tpl_vars['startstate'] == 'ME'): ?>selected="selected"<?php endif; ?>>Maine</option>
                        <option value="MD" <?php if ($this->_tpl_vars['startstate'] == 'MD'): ?>selected="selected"<?php endif; ?>>Maryland</option>
                        <option value="MA" <?php if ($this->_tpl_vars['startstate'] == 'MA'): ?>selected="selected"<?php endif; ?>>Massachusetts</option>
                        <option value="MI" <?php if ($this->_tpl_vars['startstate'] == 'MI'): ?>selected="selected"<?php endif; ?>>Michigan</option>
                        <option value="MN" <?php if ($this->_tpl_vars['startstate'] == 'MN'): ?>selected="selected"<?php endif; ?>>Minnesota</option>
                        <option value="MS" <?php if ($this->_tpl_vars['startstate'] == 'MS'): ?>selected="selected"<?php endif; ?>>Mississippi</option>
                        <option value="MO" <?php if ($this->_tpl_vars['startstate'] == 'MO'): ?>selected="selected"<?php endif; ?>>Missouri</option>
                        <option value="MT" <?php if ($this->_tpl_vars['startstate'] == 'MT'): ?>selected="selected"<?php endif; ?>>Montana</option>
                        <option value="NE" <?php if ($this->_tpl_vars['startstate'] == 'NE'): ?>selected="selected"<?php endif; ?>>Nebraska</option>
                        <option value="NV" <?php if ($this->_tpl_vars['startstate'] == 'NV'): ?>selected="selected"<?php endif; ?>>Nevada</option>
                        <option value="NH" <?php if ($this->_tpl_vars['startstate'] == 'NH'): ?>selected="selected"<?php endif; ?>>New Hampshire</option>
                        <option value="NJ" <?php if ($this->_tpl_vars['startstate'] == 'NJ'): ?>selected="selected"<?php endif; ?>>New Jersey</option>
                        <option value="NM" <?php if ($this->_tpl_vars['startstate'] == 'NM'): ?>selected="selected"<?php endif; ?>>New Mexico</option>
                        <option value="NY" <?php if ($this->_tpl_vars['startstate'] == 'NY'): ?>selected="selected"<?php endif; ?>>New York</option>
                        <option value="NC" <?php if ($this->_tpl_vars['startstate'] == 'NC'): ?>selected="selected"<?php endif; ?>>North Carolina</option>
                        <option value="ND" <?php if ($this->_tpl_vars['startstate'] == 'ND'): ?>selected="selected"<?php endif; ?>>North Dakota</option>
                        <option value="OH" <?php if ($this->_tpl_vars['startstate'] == 'OH'): ?>selected="selected"<?php endif; ?>>Ohio</option>
                        <option value="OK" <?php if ($this->_tpl_vars['startstate'] == 'OK'): ?>selected="selected"<?php endif; ?>>Oklahoma</option>
                        <option value="OR" <?php if ($this->_tpl_vars['startstate'] == 'OR'): ?>selected="selected"<?php endif; ?>>Oregon</option>
                        <option value="PA" <?php if ($this->_tpl_vars['startstate'] == 'PA'): ?>selected="selected"<?php endif; ?>>Pennsylvania</option>
                        <option value="RI" <?php if ($this->_tpl_vars['startstate'] == 'RI'): ?>selected="selected"<?php endif; ?>>Rhode Island</option>
                        <option value="SC" <?php if ($this->_tpl_vars['startstate'] == 'SC'): ?>selected="selected"<?php endif; ?>>South Carolina</option>
                        <option value="SD" <?php if ($this->_tpl_vars['startstate'] == 'SD'): ?>selected="selected"<?php endif; ?>>South Dakota</option>
                        <option value="TN" <?php if ($this->_tpl_vars['startstate'] == 'TN'): ?>selected="selected"<?php endif; ?>>Tennessee</option>
                        <option value="TX" <?php if ($this->_tpl_vars['startstate'] == 'TX'): ?>selected="selected"<?php endif; ?>>Texas</option>
                        <option value="UT" <?php if ($this->_tpl_vars['startstate'] == 'UT'): ?>selected="selected"<?php endif; ?>>Utah</option>
                        <option value="VT" <?php if ($this->_tpl_vars['startstate'] == 'VT'): ?>selected="selected"<?php endif; ?>>Vermont</option>
                        <option value="VA" <?php if ($this->_tpl_vars['startstate'] == 'VA'): ?>selected="selected"<?php endif; ?>>Virginia</option>
                        <option value="WA" <?php if ($this->_tpl_vars['startstate'] == 'WA'): ?>selected="selected"<?php endif; ?>>Washington</option>
                        <option value="WV" <?php if ($this->_tpl_vars['startstate'] == 'WV'): ?>selected="selected"<?php endif; ?>>West Virginia</option>
                        <option value="WI" <?php if ($this->_tpl_vars['startstate'] == 'WI'): ?>selected="selected"<?php endif; ?>>Wisconsin</option>
                        <option value="WY" <?php if ($this->_tpl_vars['startstate'] == 'WY'): ?>selected="selected"<?php endif; ?>>Wyoming</option>
                    </select>
                    <span id="stateError" class="formerror"></span>
                </div>
                <div class="formelement">
                	<label for="zip">Zip: </label>
                    <input id="zip" name="zip" type="text" class="textbox" />
                    <span id="zipError" class="formerror"></span>
                </div>
                <div class="formelement">
                	<label for="description">Description: </label>
                    <input id="description" name="description" type="text" class="textbox" />
                    <span id="descriptionError" class="formerror"></span>
                </div>
                <div class="formelement">
                	<label for="url">Url: </label>
                    <input id="url" name="url" type="text" class="textbox" />
                    <span id="urlError" class="formerror"></span>
                </div>
                <div class="formelement">
                	<label for="title">Tags: (ex: food, entertainment, etc) </label>
                    <input id="tags" name="tags" type="text" class="textbox" />
                    <span id="tagsError" class="formerror"></span>
                </div>
                <div class="formelement">
                    <input id="submit" name="submit" type="submit" value="Add" class="submit" />
                </div>
            </form>
            
            <!-- Display Points of Interest -->
            <?php if ($this->_tpl_vars['poi']): ?>
                <table class="table4">
                    <tr class="tablehead">
                        <th>Title</th>
                        <th>Address</th>
                        <th>Description</th>
                    </tr>
                    <?php unset($this->_sections['info']);
$this->_sections['info']['name'] = 'info';
$this->_sections['info']['loop'] = is_array($_loop=$this->_tpl_vars['poi']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                            <td><?php if ($this->_tpl_vars['poi'][$this->_sections['info']['index']]['url']): ?><a href="<?php echo $this->_tpl_vars['poi'][$this->_sections['info']['index']]['url']; ?>
" target="_blank"><?php echo $this->_tpl_vars['poi'][$this->_sections['info']['index']]['title']; ?>
</a><?php else: ?><?php echo $this->_tpl_vars['poi'][$this->_sections['info']['index']]['title']; ?>
<?php endif; ?></td>
                            <td><?php if ($this->_tpl_vars['poi'][$this->_sections['info']['index']]['address']): ?><?php echo $this->_tpl_vars['poi'][$this->_sections['info']['index']]['address']; ?>
 <?php echo $this->_tpl_vars['poi'][$this->_sections['info']['index']]['city']; ?>
 <?php echo $this->_tpl_vars['poi'][$this->_sections['info']['index']]['state']; ?>
 <?php echo $this->_tpl_vars['poi'][$this->_sections['info']['index']]['zip']; ?>
 <?php else: ?> --- <?php endif; ?></td>
                            <td><?php if ($this->_tpl_vars['poi'][$this->_sections['info']['index']]['description']): ?><?php echo $this->_tpl_vars['poi'][$this->_sections['info']['index']]['description']; ?>
 <?php else: ?> --- <?php endif; ?></td>
                        </tr>
                    <?php endfor; endif; ?>
                </table>
            <?php endif; ?>                
                            
			<div class="clear"></div>
        </div>

    <div id="onecolumnbtm"></div>

</body>
</html>