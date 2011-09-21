<?php /* Smarty version 2.6.19, created on 2009-04-14 20:32:47
         compiled from admin-manageannouncements.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/fonts/fonts-min.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/calendar/assets/skins/sam/calendar.css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script language="javascript" src="js/formfocus.js"></script>
<script language="javascript" src="js/sorttable.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/calendar/calendar-min.js"></script>

<?php echo '

<style type="text/css">
	#startContainer { display:none; }
	#endContainer { display:none; }
</style>

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

<body class="yui-skin-sam">

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
            <h2>Admin</h2>
            
        </div>
        
		<div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
        
        	<!-- Back to Main Menu -->
            <p><a href="admin.php">Back to Main Menu</a></p>
            
            <!-- Check for confirmation -->
            <?php if ($this->_tpl_vars['confirmation'] == 'sendmessage'): ?><p class="green">Your message has been sent.</p><?php endif; ?>
            
            <!-- Mass Message Form -->
            <form id="myform" method="post" action="<?php echo $this->_tpl_vars['formaction']; ?>
">
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
            	<div class="formelement">
                	<label for="announcement">Announcement:</label>
                    <textarea id="announcement" name="announcement" rows="6" class="textarea" style="width: 400px"></textarea>
                </div>
                <div class="formelement">
                	<input id="emailblast" name="emailblast" type="checkbox" value="y" <?php if ($this->_tpl_vars['emailblast'] == 'y'): ?>checked="checked"<?php endif; ?> />
                    Send announcement to entire purpool community via e-mail?
                    
                </div>
                <div class="formelement">
                	<input id="submit" name="submit" type="submit" value="Post" class="submit" />
                </div>
            </form>
            
            <!-- Announcements -->
            <?php if ($this->_tpl_vars['announcements']): ?>
                <table class="table4 sortable">
                    <tr>
                        <th>Date</th>
                        <th>Announcement</th>
                        <th>Options</th>
                    </tr>
                    <?php unset($this->_sections['info']);
$this->_sections['info']['name'] = 'info';
$this->_sections['info']['loop'] = is_array($_loop=$this->_tpl_vars['announcements']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                            <td><?php echo $this->_tpl_vars['announcements'][$this->_sections['info']['index']]['startdate']; ?>
 - <?php echo $this->_tpl_vars['announcements'][$this->_sections['info']['index']]['enddate']; ?>
</td>
                            <td><?php echo $this->_tpl_vars['announcements'][$this->_sections['info']['index']]['announcement']; ?>
</td>
                            <td>
                                <a href="admin.php?state=deleteannouncement&announcement=<?php echo $this->_tpl_vars['announcements'][$this->_sections['info']['index']]['announcement_id']; ?>
">Delete</a>
                            </td>
                        </tr>
                    <?php endfor; endif; ?>
                </table>
            <?php else: ?>
            	<p>There are currently no Purpool announcements</p>
            <?php endif; ?>
            
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