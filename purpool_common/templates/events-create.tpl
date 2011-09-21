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
{literal}
<style>
	#startContainer { display:none; }
	#endContainer { display:none; }
</style>
{/literal}
{literal}
<script type="text/javascript">

	// INITIAL EVENT LISTENERS
	document.observe("dom:loaded", function() 
	{
		
		// Listen for form submission
		Event.observe('type', 'change', checkType);
	
	});
	
	function checkType()
	{
		if($('type').value == 'other')
		{
			$('typeother').show();
		} else {
			$('typeother').hide();
		}
	}

</script>


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

<body class=" yui-skin-sam">

	<!-- Header -->
    <div id="header">
    	<a href="{$site_url}" id="logo"><h1>Purpool</h1></a>
    </div>
    
	<!-- Top Navigation -->
   		{include file="topnavigation.tpl"}
    
    
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
            <form id="myform" method="post" action="{$formaction}">
            
            	<!-- Title -->
                <div class="formelement">
                    <label for="title"><span class="required">*</span> Event Title</label>
                    <input id="title" name="title" type="text" value="{$title}" maxlength="100" class="textbox" />
                    <span id="titleError" class="formerror">{$error.title}</span>
                </div>
                
                <!-- Type -->
                <div class="formelement">
                    <label for="type"><span class="required">*</span> Type</label>
                    <select id="type" name="type" class="select">
                    	<option value="general" {if $type == 'general'}selected="selected"{/if}>General</option>
                        <option value="ride" {if $type == 'ride'}selected="selected"{/if}>Ride</option>
                        <option value="social event" {if $type == 'social event'}selected="selected"{/if}>Social Event</option>
                        <option value="meeting" {if $type == 'meeting'}selected="selected"{/if}>Meeting</option>
                        <option value="other" {if $type == 'other'}selected="selected"{/if}>Other</option>
                    </select>
                    <span id="typeError" class="formerror">{$error.type}</span>
                    
                    <!-- Type Other -->
                     <input id="typeother" name="typeother" type="text" value="{$typeother}" maxlength="100" class="textbox" {if $typeother}style="display: block"{else}style="display: none"{/if} />
               
                </div>
                
                <!-- Description -->
                <div class="formelement">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="5" class="textarea">{$description}</textarea>
                    <span id="descriptionError" class="formerror">{$error.description}</span>
                </div>
                
                <!-- Location -->
                <div class="formelement">
                    <label for="location">Location</label>
                    <textarea id="location" name="location" rows="3" class="textarea">{$location}</textarea>
                    <span id="locationError" class="formerror">{$error.location}</span>
                </div>
                
                <!-- Start Date -->
                <div class="formelement">
                    <label for="startdate"><span class="required">*</span> Start Date (mm-dd-yyyy)</label>
                    <input id="startdate_decoy" name="startdate_decoy" value="{$startdate}" disabled="disabled" type="text" class="textbox" />
                    <input id="startdate" name="startdate" type="hidden" value="{$startdate}" />
                    <input id="showstartcal" type="button" value="Show Calendar" />
                    <div id="startContainer"></div>
                    <span id="startdateError" class="formerror">{$error.startdate}</span>
                </div>
                
                
                
                <!-- Start Time -->
                <div class="formelement">
                    <label for="starthour"><span class="required">*</span> Start Time</label>
                    <select name="starthour" class="select" style="width: auto">
                        <option value="1" {if $starthour eq '1'}selected="selected"{/if}>1</option>
                        <option value="2" {if $starthour eq '2'}selected="selected"{/if}>2</option>
                        <option value="3" {if $starthour eq '3'}selected="selected"{/if}>3</option>
                        <option value="4" {if $starthour eq '4'}selected="selected"{/if}>4</option>
                        <option value="5" {if $starthour eq '5'}selected="selected"{/if}>5</option>
                        <option value="6" {if $starthour eq '6'}selected="selected"{/if}>6</option>
                        <option value="7" {if $starthour eq '7'}selected="selected"{/if}>7</option>
                        <option value="8" {if $starthour eq '8'}selected="selected"{/if}>8</option>
                        <option value="9" {if $starthour eq '9'}selected="selected"{/if}>9</option>
                        <option value="10" {if $starthour eq '10'}selected="selected"{/if}>10</option>
                        <option value="11" {if $starthour eq '11'}selected="selected"{/if}>11</option>
                        <option value="12" {if $starthour eq '12'}selected="selected"{/if}>12</option>
                    </select>
                    <select name="startminute" class="select" style="width: auto">
                        <option value="00" {if $startminute eq '00'}selected="selected"{/if}>00</option>
                        <option value="05" {if $startminute eq '05'}selected="selected"{/if}>05</option>
                        <option value="10" {if $startminute eq '10'}selected="selected"{/if}>10</option>
                        <option value="15" {if $startminute eq '15'}selected="selected"{/if}>15</option>
                        <option value="20" {if $startminute eq '20'}selected="selected"{/if}>20</option>
                        <option value="25" {if $startminute eq '25'}selected="selected"{/if}>25</option>
                        <option value="30" {if $startminute eq '30'}selected="selected"{/if}>30</option>
                        <option value="35" {if $startminute eq '35'}selected="selected"{/if}>35</option>
                        <option value="40" {if $startminute eq '40'}selected="selected"{/if}>40</option>
                        <option value="45" {if $startminute eq '45'}selected="selected"{/if}>45</option>
                        <option value="50" {if $startminute eq '50'}selected="selected"{/if}>50</option>
                        <option value="55" {if $startminute eq '55'}selected="selected"{/if}>55</option>
                    </select>
                    <select name="startampm" class="select" style="width: auto">
                        <option value="am" {if $startampm eq 'am'}selected="selected"{/if}>am</option>
                        <option value="pm" {if $startampm eq 'pm'}selected="selected"{/if}>pm</option>
                    </select>
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
                
               
                
                <!-- End Time -->
                <div class="formelement">
                    <label for="endhour">End Time</label>
                    <select name="endhour" class="select" style="width: auto">
                        <option value="1" {if $endhour eq '1'}selected="selected"{/if}>1</option>
                        <option value="2" {if $endhour eq '2'}selected="selected"{/if}>2</option>
                        <option value="3" {if $endhour eq '3'}selected="selected"{/if}>3</option>
                        <option value="4" {if $endhour eq '4'}selected="selected"{/if}>4</option>
                        <option value="5" {if $endhour eq '5'}selected="selected"{/if}>5</option>
                        <option value="6" {if $endhour eq '6'}selected="selected"{/if}>6</option>
                        <option value="7" {if $endhour eq '7'}selected="selected"{/if}>7</option>
                        <option value="8" {if $endhour eq '8'}selected="selected"{/if}>8</option>
                        <option value="9" {if $endhour eq '9'}selected="selected"{/if}>9</option>
                        <option value="10" {if $endhour eq '10'}selected="selected"{/if}>10</option>
                        <option value="11" {if $endhour eq '11'}selected="selected"{/if}>11</option>
                        <option value="12" {if $endhour eq '12'}selected="selected"{/if}>12</option>
                    </select>
                    <select name="endminute" class="select" style="width: auto">
                        <option value="00" {if $endminute eq '00'}selected="selected"{/if}>00</option>
                        <option value="05" {if $endminute eq '05'}selected="selected"{/if}>05</option>
                        <option value="10" {if $endminute eq '10'}selected="selected"{/if}>10</option>
                        <option value="15" {if $endminute eq '15'}selected="selected"{/if}>15</option>
                        <option value="20" {if $endminute eq '20'}selected="selected"{/if}>20</option>
                        <option value="25" {if $endminute eq '25'}selected="selected"{/if}>25</option>
                        <option value="30" {if $endminute eq '30'}selected="selected"{/if}>30</option>
                        <option value="35" {if $endminute eq '35'}selected="selected"{/if}>35</option>
                        <option value="40" {if $endminute eq '40'}selected="selected"{/if}>40</option>
                        <option value="45" {if $endminute eq '45'}selected="selected"{/if}>45</option>
                        <option value="50" {if $endminute eq '50'}selected="selected"{/if}>50</option>
                        <option value="55" {if $endminute eq '55'}selected="selected"{/if}>55</option>
                    </select>
                    <select name="endampm" class="select" style="width: auto">
                        <option value="am" {if $endampm eq 'am'}selected="selected"{/if}>am</option>
                        <option value="pm" {if $endampm eq 'pm'}selected="selected"{/if}>pm</option>
                    </select>
           		</div>
            
                <!-- Url -->
                <div class="formelement">
                    <label for="url">Url</label>
                    <input id="url" name="url" type="text" value="{$url}" maxlength="100" class="textbox" />
                    <span id="urlError" class="formerror">{$error.url}</span>
                </div>
                
                <!-- Notes -->
                <div class="formelement">
                    <label for="notes">Notes</label>
                    <input id="notes" name="notes" type="text" value="{$notes}" maxlength="100" class="textbox" />
                    <span id="notesError" class="formerror">{$error.notes}</span>
                </div>
                
                <div class="formelement" >
                    <input id="submit" name="submit" type="submit" value="Save" class="submit" />
                </div>
            
            </form>
        
        
        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}
        </div>

    <div id="onecolumnbtm"></div>
    
    

</body>
</html>