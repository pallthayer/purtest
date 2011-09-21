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
    
    <!-- Left Column 
    <div id="leftcolumn">
    	
        {include file="sidenavigation.tpl"}

    </div>
    //-->

	
    
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
                
	        <h3 style="margin-bottom:0;">{$poolname}</h3>
            <div id="wizard">
                <ul>
                    <li ><a href="pools.php?state=viewprofile&pool={$pool_id}">Profile</a></li>
                    
                    {if $editmode}<li><a href="pools.php?state=editschedule&pool={$pool_id}">Scheduler</a></li>{/if}
                    <li><a href="pools.php?state=viewschedule&pool={$pool_id}">Upcoming Rides</a></li>
                    <li><a href="pools.php?state=shoutbox&pool={$pool_id}">Shoutbox</a></li>
                    {if $editmode}<li class="current"><a href="pools.php?state=editpool&pool={$pool_id}">Edit General</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=editmembers&pool={$pool_id}">Edit Members</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=viewroutes&pool={$pool_id}">Edit Routes</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=deletepool&pool={$pool_id}">Delete Pool</a></li>{/if}
                </ul>
            </div>
            <br/><br/><br/>
            <!-- Pool Form -->
            <form id="myform" method="post" action="pools.php?state=editpool&pool={$pool_id}">
                
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
                
                <!-- Default Route -->
                <div class="formelement">
                    <label for="route">Default Route</label>
                    <select name="route" class="select">
			    <option value="">-- select --</option>
			    {section name=info loop=$routes}
				<option value="{$routes[info].route_id}" {if $route eq $routes[info].route_id}selected="selected"{/if}>{$routes[info].title}</option>
			    {/section}
                    </select>
                    <span id="routError" class="formerror">{$error.route}</span>
                </div>
                
                <!-- Default Driver -->
                <div class="formelement">
                    <label for="driver">Default Driver</label>
                    <select name="driver" class="select">
			    <option value="">-- select --</option>
			    {section name=info loop=$members}
				<option value="{$members[info].user_id}" {if $driver eq $members[info].user_id}selected="selected"{/if}>{$members[info].name}</option>
			    {/section}
                    </select>
                    <span id="driverError" class="formerror">{$error.driver}</span>
                </div>
     
                <!-- Submit Button -->
                <div class="formelement">
                    <input id="submit" name="submit" type="submit" value="Save" class="submit" />
                </div>

            </form>
        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}     
        </div>


    
    <div id="onecolumnbtm"></div>
	<div id="tooltip">&nbsp;</div>
</body>
</html>
