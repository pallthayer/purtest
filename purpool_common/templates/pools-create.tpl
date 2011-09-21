<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script language="javascript" src="js/formfocus.js"></script>
<script language="javascript" src="js/tooltips.js"></script>
</head>

<body  onload="addToolTipListeners()">

	<!-- Header -->
    <div id="header">
    	<a href="{$site_url}" id="logo"><h1>Purpool</h1></a>
    </div>
    
	<!-- Top Navigation -->
   	{include file="topnavigation.tpl"}	
    
    	<!-- Content Bar -->
        <div id="contentbar">
        
            <!-- Page Heading -->
            <h2>Pools</h2>
            
            <!-- Tabs -->
			<div id="tabs">
                <ul>
                    <li class="current"><a href="pools.php">View Pools</a></li>
                    <li><a href="pools.php?state=browsepools">Browse Pools</a></li>
                </ul>
            </div>
        </div>
        
            

        
		<div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
                
	        <!-- <h3 style="margin-bottom:0;">Pool Name{$poolname}</h3> -->
            <div id="wizard">
                <ul>
                    <li ><a href="#">Profile</a></li>
                    <li><a href="#">Schedule</a></li>
                    <li><a href="#">Upcoming Rides</a></li>
                    <li><a href="#">Shoutbox</a></li>
                    {if $editmode}<li class="current"><a href="#">Edit General</a></li>{/if}
                    {if $editmode}<li><a href="#">Edit Members</a></li>{/if}
                    {if $editmode}<li><a href="#">Edit Routes</a></li>{/if}
                    {if $editmode}<li><a href="#">Delete Pool</a></li>{/if}
                </ul>
            </div>
            <br/><br/><br/>
            <div>
		<h4 style="font-size:1.0em;">Is this your first time creating a Pool? <a href="javascript:void(0);" onclick="document.getElementById('gettingstarted').style.display = 'block';">Click here</a> to review the responsibilities of a Pool leader.</h4>
		<div id="gettingstarted" style="display:none;">
			<strong>Duties/Privileges of Pool Leader:</strong>
			<ul>
				<li>Create route(s) and weekly schedule for Pool</li>
				<li>Invite new pool members and remove members who are no longer active</li>
				<li>Confirm the details of each Pool ride for the upcoming week, and encourage members to accept/decline for each ride</li>
				<li>Give another member leader status to help you fulfill or take over your leader duties</li>
				<li style="list-style-type:none;"><a href="javascript:void(0);" onclick="document.getElementById('gettingstarted').style.display = 'none';">(hide this)</a>

			</ul><br />
		</div>
            </div>
            <!-- Pool Form -->
            <form id="myform" method="post" action="pools.php?state=createpool">
                
                <!-- Title -->
                <div class="formelement">
                    <label for="title"><span class="required">*</span> Name your pool</label>
                    <input id="title" name="title" type="text" value="{$title}" maxlength="100" class="textbox" />
                    <span id="titleError" class="formerror">{$error.title}</span>
                </div>

				<!-- Access Options -->
                <div class="formelement">
                    <label for="access"><span class="required">*</span> Who is allowed to join this pool?</label>
                    <input id="accessprivate" name="access" type="radio" value="private" {if $access eq 'private'}checked="checked"{/if} /> Private: By invitation only <a name="private" class="tooltipClass" id="private"><img src="images/icon_tooltip.gif" border="0"/> </a><br />
                    <input id="accesspublic" name="access" type="radio" value="public" {if $access eq 'public'}checked="checked"{/if} /> Public: Anyone can join <a name="public" class="tooltipClass" id="public"><img src="images/icon_tooltip.gif" border="0"/> </a><br />
                </div>               
                
                <!-- Additional Information -->
                <div class="formelement">
                   	<label for="description">Description</label>
                    <textarea id="description" name="description" class="textbox" rows="8">{$description}</textarea>
                </div>
     
                <!-- Submit Button -->
                <div class="formelement">
                    <input id="submit" name="submit" type="submit" value="Create Pool" class="submit" />
                </div>

            </form>
        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}     
        </div>


    
    <div id="onecolumnbtm"></div>
	<div id="tooltip">&nbsp;</div>
</body>
</html>
