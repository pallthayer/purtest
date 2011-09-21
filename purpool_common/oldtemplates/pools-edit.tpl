<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />

<script language="javascript" src="js/jquery.js"></script>
{literal}
<script type="text/javascript">
	//var inputs = $('#driver');
	//Event.observe(inputs, 'click', function() {alert("triggered");});
	    //$$('#driver input[type="radio"]').addClassName("disabled");
	    //$(this).up('div.radio').removeClassName("disabled");
	    
	jQuery.noConflict();
	
	jQuery(document).ready(function($){
		$("input[name='rotationtype']").click(function(){
			$("input[name='rotationtype']").parent('div.radio').addClass("disabled");
			//$("input[name='rotationtype']").parent('div.radio').style.display = 'none';
			$(this).parent('div.radio').removeClass("disabled");
			
		});
	});
</script>
<style>
.disabled, .disabled option{
	color:#bbbbbb;
}
.disabled .reveal{
	display:none;
}
</style>
{/literal}

<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script language="javascript" src="js/formfocus.js"></script>
<script language="javascript" src="js/tooltips.js"></script>
</head>

<body  onload="addToolTipListeners()">

	<!-- Header -->
    <div id="header">
    	<a href="/" id="logo"><h1>Purpool</h1></a>
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
            <div class="innercolumn" style="width:300px;">  
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
                
 
                </div>
                <div class="innercolumn2" style="width:470px;">  
           <!-- Default Route -->
                <div class="formelement">
                    <label for="route">Default Route
                     <a name="private" class="tooltipClass" id="default_route"><img src="images/icon_tooltip.gif" border="0"/> </a>
                    </label>
                    <select name="route" class="select">
			    <option value="">-- select --</option>
			    {section name=info loop=$routes}
				<option value="{$routes[info].route_id}" {if $route eq $routes[info].route_id}selected="selected"{/if}>{$routes[info].title}</option>
			    {/section}
                    </select>
                    <span id="routError" class="formerror">{$error.route}</span>
                </div>
                <br />
			<!-- Default Driver -->
			
			<div class="formelement" id="driver">
			    <label for="driver">Driver Assignment
                <a name="private" class="tooltipClass" id="driver_assignment"><img src="images/icon_tooltip.gif" border="0"/> </a>
                </label>
	
			    <div class="radio {if $rotation_type != 'default'}disabled{/if}">
                
			    <input type="radio" name="rotationtype" value="default" {if $rotation_type eq "default"} checked="checked"{/if}>Select one:</input> <a name="private" class="tooltipClass" id="default"><img src="images/icon_tooltip.gif" border="0"/> </a>
			    	<div style="float:right;" class="reveal">
                    	<select name="driver" class="select">
                            <option value="">-- select --</option>
                            {assign var='day' value=$daysInSchedule[1]}
                            
                            {section name=info loop=$members}
                            <option value="{$members[info].user_id}" {if $default_driver.monday eq $members[info].user_id &&  $rotation_type eq "default"}selected="selected"{/if}>{$members[info].name}</option>
                            {/section}
			    		</select>
                	</div>
			    </div>
			    <!--<div class="radio {if $rotation_type != 'rotation'}disabled{/if}">
				    <input type="radio" name="rotationtype" value="rotation" {if $rotation_type eq "rotation"} checked="checked"{/if}>Simple rotation</input>
			    </div> -->
			    <div class="radio {if $rotation_type != 'day_of_week'}disabled{/if}">
				    <input type="radio" name="rotationtype" value="day_of_week" 
                    {if $rotation_type eq "day_of_week"} checked="checked"{/if}>By day of the week:</input> <a name="private" class="tooltipClass" id="day_of_week"><img src="images/icon_tooltip.gif" border="0"/> </a>
				    <div style="float:right;" class="reveal">
                    {if count($daysInSchedule) == 0}
    					 <div style="width:200px"><a href="pools.php?state=editschedule&pool={$pool_id}">Decide upon a daily schedule</a> before you begin assigning drivers by day of the week. 
                         </div>
                    {else}
                        {section name=i loop=$daysInSchedule}
                        {assign var='day' value=$daysInSchedule[i]}
                            <div class="reveal">
                                {$daysInSchedule[i]}: &nbsp;&nbsp;<select name="{$daysInSchedule[i]}" class="select" style="float:right;">
                                    <option value="">-- select --</option>
                                    {section name=info loop=$members}
                                    <option value="{$members[info].user_id}" {if $default_driver.$day eq $members[info].user_id && $rotation_type eq "day_of_week"}selected="selected"{/if}>{$members[info].name}</option>
                                    {/section}
                                </select>
                               <br />
                                <br />
                            </div>
                        {/section}
                    {/if}
                    </div>
			    </div>
			    <div class="radio {if $rotation_type != 'fairness'}disabled{/if}">
				    <input type="radio" name="rotationtype" value="fairness" {if $rotation_type eq "fairness"} checked="checked"{/if}>Fairness Algorithm</input> <a name="private" class="tooltipClass" id="fairness"><img src="images/icon_tooltip.gif" border="0"/> </a>
			    </div>
			    
			    
			    <span id="driverError" class="formerror">{$error.driver}</span>
			</div>
     		</div>
                <!-- Submit Button -->
                <div class="formelement" style="clear:both;">
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
