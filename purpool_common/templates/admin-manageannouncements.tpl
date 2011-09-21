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

{literal}

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
			eLog.innerHTML = '<pre class="entry"><strong>' + eCount + ').</strong> ' + msg + '</pre>' + eLog.innerHTML;
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
				 	dStr = '0' + dStr;
				}
                var mStr = dt.getMonth()+1;
				if(parseInt(mStr)<10){
				 	mStr = '0' + mStr;
				}
               	var yStr = dt.getFullYear();
                return (mStr + "-" + dStr + "-" + yStr);		
		}

		function startSelectHandler(type,args,obj) {
			var selected = args[0];
			var selDate = this.toDate(selected[0]);
			 
			 document.getElementById('startdate_decoy').value = dateToString(selDate, this);
			 document.getElementById('startdate').value = dateToString(selDate, this);
			 document.getElementById('startContainer').style.display = 'none';
			 
			//#fefaf7
		};
		function endSelectHandler(type,args,obj) {
			var selected = args[0];
			var selDate = this.toDate(selected[0]);
			 
			 document.getElementById('enddate_decoy').value = dateToString(selDate, this);
			 document.getElementById('enddate').value = dateToString(selDate, this);
			 document.getElementById('endContainer').style.display = 'none';
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
				var startdatepos = $('startdate_decoy').viewportOffset(); 
				$('startContainer').setStyle({
				  'position': 'absolute',
				  'left': startdatepos[0],
				  'top': startdatepos[1]
				});
			});
			
		YAHOO.util.Event.addListener("showendcal", "click", function(e) { 
				var enddatepos = $('enddate_decoy').viewportOffset(); 
				$('endContainer').setStyle({
				  'position': 'absolute',
				  left: enddatepos[0],
				  top: enddatepos[1]
				});
			});


		YAHOO.example.calendar.cal1.render();
		YAHOO.example.calendar.cal2.render();
	}

	YAHOO.util.Event.onDOMReady(YAHOO.example.calendar.init);
</script>


{/literal}

</head>

<body class="yui-skin-sam">

	<!-- Header -->
    <div id="header">
    	<a href="{$site_url}" id="logo"><h1>Purpool</h1></a>
    </div>
    
	<!-- Top Navigation -->
   		{include file="topnavigation.tpl"}
    
    
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
            {if $confirmation eq 'sendmessage'}<p class="green">Your message has been sent.</p>{/if}
            
            <!-- Mass Message Form -->
            <form id="myform" method="post" action="{$formaction}">
            	<!-- Start Date -->
                <div class="formelement">
                    <label for="startdate"><span class="required">*</span> Start Date (mm-dd-yyyy)</label>
                    <input id="startdate_decoy" name="startdate_decoy" value="{$startdate}" disabled="disabled" type="text" class="textbox" />
                    <input id="startdate" name="startdate" type="hidden" value="{$startdate}" />
                    <input id="showstartcal" type="button" value="Show Calendar" />
                    <div id="startContainer"></div>
                    <span id="startdateError" class="formerror">{$error.startdate}</span>
                </div>
                <!-- End Date -->
                <div class="formelement">
                    <label for="enddate">End Date (mm-dd-yyyy)</label>
                    <input id="enddate_decoy" name="enddate_decoy" value="{$enddate}" disabled="disabled" type="text" class="textbox" />
                    <input id="enddate" name="enddate" type="hidden" value="{$enddate}" />
                    <input id="showendcal" type="button" value="Show Calendar" />
                     <div id="endContainer"></div>
                    <span id="enddateError" class="formerror">{$error.enddate}</span>
                </div>
            	<div class="formelement">
                	<label for="announcement">Announcement:</label>
                    <textarea id="announcement" name="announcement" rows="6" class="textarea" style="width: 400px"></textarea>
                </div>
                <div class="formelement">
                	<input id="emailblast" name="emailblast" type="checkbox" value="y" {if $emailblast eq 'y'}checked="checked"{/if} />
                    Send announcement to entire purpool community via e-mail?
                    
                </div>
                <div class="formelement">
                	<input id="submit" name="submit" type="submit" value="Post" class="submit" />
                </div>
            </form>
            
            <!-- Announcements -->
            {if $announcements}
                <table class="table4 sortable">
                    <tr>
                        <th>Date</th>
                        <th>Announcement</th>
                        <th>Options</th>
                    </tr>
                    {section name=info loop=$announcements}
                        <tr>
                            <td>{$announcements[info].startdate} - {$announcements[info].enddate}</td>
                            <td>{$announcements[info].announcement}</td>
                            <td>
                                <a href="admin.php?state=deleteannouncement&announcement={$announcements[info].announcement_id}">Delete</a>
                            </td>
                        </tr>
                    {/section}
                </table>
            {else}
            	<p>There are currently no Purpool announcements</p>
            {/if}
            
        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}
        </div>


    
    <div id="onecolumnbtm"></div>

</body>
</html>