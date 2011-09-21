<?php /* Smarty version 2.6.19, created on 2009-01-08 15:21:03
         compiled from events-create.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="js/datepicker.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/fonts/fonts-min.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/calendar/assets/skins/sam/calendar.css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script language="javascript" src="js/formfocus.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/calendar/calendar-min.js"></script>
<?php echo '
<style>
	#startContainer { display:none; }
	#endContainer { display:none; }
</style>
'; ?>

<?php echo '
<script type="text/javascript">

	// INITIAL EVENT LISTENERS
	document.observe("dom:loaded", function() 
	{
		
		// Listen for form submission
		Event.observe(\'type\', \'change\', checkType);
	
	});
	
	function checkType()
	{
		if($(\'type\').value == \'other\')
		{
			$(\'typeother\').show();
		} else {
			$(\'typeother\').hide();
		}
	}

</script>


<script type="text/javascript">
	YAHOO.namespace("example.calendar");

	YAHOO.example.calendar.init = function() {
		var eLog = YAHOO.util.Dom.get("evtentries");
		var eCount = 1;

		function logEvent(msg) {
			eLog.innerHTML = \'<pre class="entry"><strong>\' + eCount + \').</strong> \' + msg + \'</pre>\' + eLog.innerHTML;
			eCount++;
		}

		function dateToLocaleString(dt, cal) {
                	var wStr = cal.cfg.getProperty("WEEKDAYS_LONG")[dt.getDay()];
                	var dStr = dt.getDate();
                	var mStr = cal.cfg.getProperty("MONTHS_LONG")[dt.getMonth()];
               	 	var yStr = dt.getFullYear();
                	return (wStr + ", " + dStr + " " + mStr + " " + yStr);
		}
		function dateToString(dt, cal){
                var dStr = dt.getDate();
				if(parseInt(dStr)<10){
				 	dStr = \'0\' + dStr;
				}
                var mStr = dt.getMonth()+1;
				if(parseInt(mStr)<10){
				 	mStr = \'0\' + mStr;
				}
               	var yStr = dt.getFullYear();
                return (mStr + "-" + dStr + "-" + yStr);		
		}

		function startSelectHandler(type,args,obj) {
			var selected = args[0];
			var selDate = this.toDate(selected[0]);
			 
			 document.getElementById(\'startdate_decoy\').value = dateToString(selDate, this);
			 document.getElementById(\'startdate\').value = dateToString(selDate, this);
			 document.getElementById(\'startContainer\').style.display = \'none\';
			 
			//#fefaf7
		};
		function endSelectHandler(type,args,obj) {
			var selected = args[0];
			var selDate = this.toDate(selected[0]);
			 
			 document.getElementById(\'enddate_decoy\').value = dateToString(selDate, this);
			 document.getElementById(\'enddate\').value = dateToString(selDate, this);
			 document.getElementById(\'endContainer\').style.display = \'none\';
			//#fefaf7
		};

		function myDeselectHandler(type, args, obj) {
			var deselected = args[0];
			var deselDate = this.toDate(deselected[0]);

			//alert("DESELECTED: " + dateToLocaleString(deselDate, this));
		};

		YAHOO.example.calendar.cal1 = new YAHOO.widget.Calendar("cal1","startContainer");
		YAHOO.example.calendar.cal2 = new YAHOO.widget.Calendar("cal2","endContainer");


		YAHOO.example.calendar.cal1.selectEvent.subscribe(startSelectHandler, YAHOO.example.calendar.cal1, true);
		YAHOO.example.calendar.cal2.selectEvent.subscribe(endSelectHandler, YAHOO.example.calendar.cal2, true);
		//YAHOO.example.calendar.cal1.deselectEvent.subscribe(myDeselectHandler, YAHOO.example.calendar.cal1, true);
		
		// Listener to show the 1-up Calendar when the button is clicked
		//YAHOO.util.Event.addListener("showstartcal", "click", YAHOO.example.calendar.cal1.show, YAHOO.example.calendar.cal1, true);
		//YAHOO.util.Event.addListener("showendcal", "click", YAHOO.example.calendar.cal2.show, YAHOO.example.calendar.cal2, true);
		YAHOO.util.Event.addListener("showstartcal", "click", YAHOO.example.calendar.cal1.show, YAHOO.example.calendar.cal1, true);
		YAHOO.util.Event.addListener("showendcal", "click", YAHOO.example.calendar.cal2.show, YAHOO.example.calendar.cal2, true);

		YAHOO.util.Event.addListener("showstartcal", "click", function(e) { 
				var startdatepos = $(\'startdate_decoy\').viewportOffset(); 
				$(\'startContainer\').setStyle({
				  \'position\': \'absolute\',
				  \'left\': startdatepos[0],
				  \'top\': startdatepos[1]
				});
			});
			
		YAHOO.util.Event.addListener("showendcal", "click", function(e) { 
				var enddatepos = $(\'enddate_decoy\').viewportOffset(); 
				$(\'endContainer\').setStyle({
				  \'position\': \'absolute\',
				  left: enddatepos[0],
				  top: enddatepos[1]
				});
			});


		YAHOO.example.calendar.cal1.render();
		YAHOO.example.calendar.cal2.render();
	}

	YAHOO.util.Event.onDOMReady(YAHOO.example.calendar.init);
</script>


'; ?>


</head>

<body class=" yui-skin-sam">

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
            <h2>Events</h2>
            
            <!-- Tabs -->
            <div id="tabs">
                <ul>
                    <li class="first"><a href="events.php?state=browse">Browse/Search</a></li>
                    <li class="current"><a href="events.php?state=createevent">Create/Edit</a></li>
                </ul>
            </div>

        </div>
        
		<div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
            
			<!-- Events Form -->
            <form id="myform" method="post" action="<?php echo $this->_tpl_vars['formaction']; ?>
">
            
            	<!-- Title -->
                <div class="formelement">
                    <label for="title"><span class="required">*</span> Event Title</label>
                    <input id="title" name="title" type="text" value="<?php echo $this->_tpl_vars['title']; ?>
" maxlength="100" class="textbox" />
                    <span id="titleError" class="formerror"><?php echo $this->_tpl_vars['error']['title']; ?>
</span>
                </div>
                
                <!-- Type -->
                <div class="formelement">
                    <label for="type"><span class="required">*</span> Type</label>
                    <select id="type" name="type" class="select">
                    	<option value="general" <?php if ($this->_tpl_vars['type'] == 'general'): ?>selected="selected"<?php endif; ?>>General</option>
                        <option value="ride" <?php if ($this->_tpl_vars['type'] == 'ride'): ?>selected="selected"<?php endif; ?>>Ride</option>
                        <option value="social event" <?php if ($this->_tpl_vars['type'] == 'social event'): ?>selected="selected"<?php endif; ?>>Social Event</option>
                        <option value="meeting" <?php if ($this->_tpl_vars['type'] == 'meeting'): ?>selected="selected"<?php endif; ?>>Meeting</option>
                        <option value="other" <?php if ($this->_tpl_vars['type'] == 'other'): ?>selected="selected"<?php endif; ?>>Other</option>
                    </select>
                    <span id="typeError" class="formerror"><?php echo $this->_tpl_vars['error']['type']; ?>
</span>
                    
                    <!-- Type Other -->
                     <input id="typeother" name="typeother" type="text" value="<?php echo $this->_tpl_vars['typeother']; ?>
" maxlength="100" class="textbox" <?php if ($this->_tpl_vars['typeother']): ?>style="display: block"<?php else: ?>style="display: none"<?php endif; ?> />
               
                </div>
                
                <!-- Description -->
                <div class="formelement">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="5" class="textarea"><?php echo $this->_tpl_vars['description']; ?>
</textarea>
                    <span id="descriptionError" class="formerror"><?php echo $this->_tpl_vars['error']['description']; ?>
</span>
                </div>
                
                <!-- Location -->
                <div class="formelement">
                    <label for="location">Location</label>
                    <textarea id="location" name="location" rows="3" class="textarea"><?php echo $this->_tpl_vars['location']; ?>
</textarea>
                    <span id="locationError" class="formerror"><?php echo $this->_tpl_vars['error']['location']; ?>
</span>
                </div>
                
                <!-- Start Date -->
                <div class="formelement">
                    <label for="startdate"><span class="required">*</span> Start Date (mm-dd-yyyy)</label>
                    <input id="startdate_decoy" name="startdate_decoy" value="<?php echo $this->_tpl_vars['startdate']; ?>
" disabled="disabled" type="text" class="textbox" />
                    <input id="startdate" name="startdate" type="hidden" value="<?php echo $this->_tpl_vars['startdate']; ?>
" />
                    <input id="showstartcal" type="button" value="Show Calendar" />
                    <div id="startContainer"></div>
                    <span id="startdateError" class="formerror"><?php echo $this->_tpl_vars['error']['startdate']; ?>
</span>
                </div>
                
                
                
                <!-- Start Time -->
                <div class="formelement">
                    <label for="starthour"><span class="required">*</span> Start Time</label>
                    <select name="starthour" class="select" style="width: auto">
                        <option value="1" <?php if ($this->_tpl_vars['starthour'] == '1'): ?>selected="selected"<?php endif; ?>>1</option>
                        <option value="2" <?php if ($this->_tpl_vars['starthour'] == '2'): ?>selected="selected"<?php endif; ?>>2</option>
                        <option value="3" <?php if ($this->_tpl_vars['starthour'] == '3'): ?>selected="selected"<?php endif; ?>>3</option>
                        <option value="4" <?php if ($this->_tpl_vars['starthour'] == '4'): ?>selected="selected"<?php endif; ?>>4</option>
                        <option value="5" <?php if ($this->_tpl_vars['starthour'] == '5'): ?>selected="selected"<?php endif; ?>>5</option>
                        <option value="6" <?php if ($this->_tpl_vars['starthour'] == '6'): ?>selected="selected"<?php endif; ?>>6</option>
                        <option value="7" <?php if ($this->_tpl_vars['starthour'] == '7'): ?>selected="selected"<?php endif; ?>>7</option>
                        <option value="8" <?php if ($this->_tpl_vars['starthour'] == '8'): ?>selected="selected"<?php endif; ?>>8</option>
                        <option value="9" <?php if ($this->_tpl_vars['starthour'] == '9'): ?>selected="selected"<?php endif; ?>>9</option>
                        <option value="10" <?php if ($this->_tpl_vars['starthour'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
                        <option value="11" <?php if ($this->_tpl_vars['starthour'] == '11'): ?>selected="selected"<?php endif; ?>>11</option>
                        <option value="12" <?php if ($this->_tpl_vars['starthour'] == '12'): ?>selected="selected"<?php endif; ?>>12</option>
                    </select>
                    <select name="startminute" class="select" style="width: auto">
                        <option value="00" <?php if ($this->_tpl_vars['startminute'] == '00'): ?>selected="selected"<?php endif; ?>>00</option>
                        <option value="05" <?php if ($this->_tpl_vars['startminute'] == '05'): ?>selected="selected"<?php endif; ?>>05</option>
                        <option value="10" <?php if ($this->_tpl_vars['startminute'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
                        <option value="15" <?php if ($this->_tpl_vars['startminute'] == '15'): ?>selected="selected"<?php endif; ?>>15</option>
                        <option value="20" <?php if ($this->_tpl_vars['startminute'] == '20'): ?>selected="selected"<?php endif; ?>>20</option>
                        <option value="25" <?php if ($this->_tpl_vars['startminute'] == '25'): ?>selected="selected"<?php endif; ?>>25</option>
                        <option value="30" <?php if ($this->_tpl_vars['startminute'] == '30'): ?>selected="selected"<?php endif; ?>>30</option>
                        <option value="35" <?php if ($this->_tpl_vars['startminute'] == '35'): ?>selected="selected"<?php endif; ?>>35</option>
                        <option value="40" <?php if ($this->_tpl_vars['startminute'] == '40'): ?>selected="selected"<?php endif; ?>>40</option>
                        <option value="45" <?php if ($this->_tpl_vars['startminute'] == '45'): ?>selected="selected"<?php endif; ?>>45</option>
                        <option value="50" <?php if ($this->_tpl_vars['startminute'] == '50'): ?>selected="selected"<?php endif; ?>>50</option>
                        <option value="55" <?php if ($this->_tpl_vars['startminute'] == '55'): ?>selected="selected"<?php endif; ?>>55</option>
                    </select>
                    <select name="startampm" class="select" style="width: auto">
                        <option value="am" <?php if ($this->_tpl_vars['startampm'] == 'am'): ?>selected="selected"<?php endif; ?>>am</option>
                        <option value="pm" <?php if ($this->_tpl_vars['startampm'] == 'pm'): ?>selected="selected"<?php endif; ?>>pm</option>
                    </select>
           		</div>
                
                <!-- End Date -->
                <div class="formelement">
                    <label for="enddate">End Date (mm-dd-yyyy)</label>
                    <input id="enddate_decoy" name="enddate_decoy" value="<?php echo $this->_tpl_vars['enddate']; ?>
" disabled="disabled" type="text" class="textbox" />
                    <input id="enddate" name="enddate" type="hidden" value="<?php echo $this->_tpl_vars['enddate']; ?>
" />
                    <input id="showendcal" type="button" value="Show Calendar" />
                     <div id="endContainer"></div>
                    <span id="enddateError" class="formerror"><?php echo $this->_tpl_vars['error']['enddate']; ?>
</span>
                </div>
                
               
                
                <!-- End Time -->
                <div class="formelement">
                    <label for="endhour">End Time</label>
                    <select name="endhour" class="select" style="width: auto">
                        <option value="1" <?php if ($this->_tpl_vars['endhour'] == '1'): ?>selected="selected"<?php endif; ?>>1</option>
                        <option value="2" <?php if ($this->_tpl_vars['endhour'] == '2'): ?>selected="selected"<?php endif; ?>>2</option>
                        <option value="3" <?php if ($this->_tpl_vars['endhour'] == '3'): ?>selected="selected"<?php endif; ?>>3</option>
                        <option value="4" <?php if ($this->_tpl_vars['endhour'] == '4'): ?>selected="selected"<?php endif; ?>>4</option>
                        <option value="5" <?php if ($this->_tpl_vars['endhour'] == '5'): ?>selected="selected"<?php endif; ?>>5</option>
                        <option value="6" <?php if ($this->_tpl_vars['endhour'] == '6'): ?>selected="selected"<?php endif; ?>>6</option>
                        <option value="7" <?php if ($this->_tpl_vars['endhour'] == '7'): ?>selected="selected"<?php endif; ?>>7</option>
                        <option value="8" <?php if ($this->_tpl_vars['endhour'] == '8'): ?>selected="selected"<?php endif; ?>>8</option>
                        <option value="9" <?php if ($this->_tpl_vars['endhour'] == '9'): ?>selected="selected"<?php endif; ?>>9</option>
                        <option value="10" <?php if ($this->_tpl_vars['endhour'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
                        <option value="11" <?php if ($this->_tpl_vars['endhour'] == '11'): ?>selected="selected"<?php endif; ?>>11</option>
                        <option value="12" <?php if ($this->_tpl_vars['endhour'] == '12'): ?>selected="selected"<?php endif; ?>>12</option>
                    </select>
                    <select name="endminute" class="select" style="width: auto">
                        <option value="00" <?php if ($this->_tpl_vars['endminute'] == '00'): ?>selected="selected"<?php endif; ?>>00</option>
                        <option value="05" <?php if ($this->_tpl_vars['endminute'] == '05'): ?>selected="selected"<?php endif; ?>>05</option>
                        <option value="10" <?php if ($this->_tpl_vars['endminute'] == '10'): ?>selected="selected"<?php endif; ?>>10</option>
                        <option value="15" <?php if ($this->_tpl_vars['endminute'] == '15'): ?>selected="selected"<?php endif; ?>>15</option>
                        <option value="20" <?php if ($this->_tpl_vars['endminute'] == '20'): ?>selected="selected"<?php endif; ?>>20</option>
                        <option value="25" <?php if ($this->_tpl_vars['endminute'] == '25'): ?>selected="selected"<?php endif; ?>>25</option>
                        <option value="30" <?php if ($this->_tpl_vars['endminute'] == '30'): ?>selected="selected"<?php endif; ?>>30</option>
                        <option value="35" <?php if ($this->_tpl_vars['endminute'] == '35'): ?>selected="selected"<?php endif; ?>>35</option>
                        <option value="40" <?php if ($this->_tpl_vars['endminute'] == '40'): ?>selected="selected"<?php endif; ?>>40</option>
                        <option value="45" <?php if ($this->_tpl_vars['endminute'] == '45'): ?>selected="selected"<?php endif; ?>>45</option>
                        <option value="50" <?php if ($this->_tpl_vars['endminute'] == '50'): ?>selected="selected"<?php endif; ?>>50</option>
                        <option value="55" <?php if ($this->_tpl_vars['endminute'] == '55'): ?>selected="selected"<?php endif; ?>>55</option>
                    </select>
                    <select name="endampm" class="select" style="width: auto">
                        <option value="am" <?php if ($this->_tpl_vars['endampm'] == 'am'): ?>selected="selected"<?php endif; ?>>am</option>
                        <option value="pm" <?php if ($this->_tpl_vars['endampm'] == 'pm'): ?>selected="selected"<?php endif; ?>>pm</option>
                    </select>
           		</div>
            
                <!-- Url -->
                <div class="formelement">
                    <label for="url">Url</label>
                    <input id="url" name="url" type="text" value="<?php echo $this->_tpl_vars['url']; ?>
" maxlength="100" class="textbox" />
                    <span id="urlError" class="formerror"><?php echo $this->_tpl_vars['error']['url']; ?>
</span>
                </div>
                
                <!-- Notes -->
                <div class="formelement">
                    <label for="notes">Notes</label>
                    <input id="notes" name="notes" type="text" value="<?php echo $this->_tpl_vars['notes']; ?>
" maxlength="100" class="textbox" />
                    <span id="notesError" class="formerror"><?php echo $this->_tpl_vars['error']['notes']; ?>
</span>
                </div>
                
                <div class="formelement" >
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