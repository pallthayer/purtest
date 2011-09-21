<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects,controls"></script>
<script language="javascript" src="js/formfocus.js"></script>
<script language="javascript" src="js/pools-members.js"></script>
</head>

<body>

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
                    {if $editmode}<li><a href="pools.php?state=editpool&pool={$pool_id}">Edit General</a></li>{/if}
                    {if $editmode}<li class="current"><a href="pools.php?state=editmembers&pool={$pool_id}">Edit Members</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=viewroutes&pool={$pool_id}">Edit Routes</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=deletepool&pool={$pool_id}">Delete Pool</a></li>{/if}
                </ul>
            </div>
        	
        	<div class="innercolumn">
        	<!-- Instructions -->
            {if $instructions}
            	<div class="yellowbox">
                	You do not have any other members in your pool. <br />To invite a user, type in their
                    e-mail address and an optional personalized message.
                </div>
            {/if}
        	
            <!-- Invite Members -->
            <h4>Invite Members</h4>
            <form id="myform" method="post" action="pools.php?state=editmembers&pool={$pool_id}" style="margin-bottom: 15px">
                <div class="formelement">
                    <label for="email"><span class="required">*</span> E-mail Address</label>
                    <span>(Separate multiple addresses with <br />a comma or space.)</span>
                    <input id="email" name="email" type="text" value="{$email}" maxlength="500" autocomplete="off" class="textbox" />
                    <span id="emailError" class="formerror">{$error.email}</span>
                </div>
                <div class="formelement">
                    <label for="message">Personalized Invitiation</label>
                    <textarea id="message" name="message" class="textbox" rows="10">{$message}</textarea>
                </div>
                <input id="submit" name="submit" type="submit" value="Invite" class="submit" /> 
            </form>
            
            <!-- Line 
            <div style="margin: 20px 0 20px 0; border-bottom: 1px solid #FFC1FF"></div>-->
            
            <!-- Autocomplete choices -->
            <div id="autocomplete_choices" class="autocomplete"></div>
            </div>
            
            <div class="innercolumn3" id="last">
            
            <!-- Current Members -->
            <h4>Current Members</h4>
            <img src="images/table3.gif" /><br/>
            <form id="roleform" method="post" action="pools.php?state=editmembers&pool={$pool_id}">
		    <table class="table3">
			<tr class="tablehead">
			    <th>Name</th>
			    <th>E-mail</th>
			    <th>Role</th>
			    <th style="text-align:center;">Remove</th>
			</tr>
			{section name=info loop=$accepted}
			    <tr>
				<td><a href="profile.php?user={$accepted[info].user_id}">{$accepted[info].name}</a></td>
				<td><a href="mailto:{$accepted[info].email}">{$accepted[info].email}</a></td>
				<td>
					<select name="{$accepted[info].user_id}">
						{$accepted[info].role_select}
					</select>
				</td>
				<td style="text-align:center;"><a href="pools.php?state=removemember&pool={$pool_id}&member={$accepted[info].user_id}"><img src="icons/icon-delete.gif" /></a></td>
			    </tr>
			{/section}
			    <tr>
				<td></td>
				<td><span id="roleError" class="formerror">{$error.role}</span></td>
				<td><input id="role_submit" name="role_submit" type="submit" value="Save Roles" class="submit" /> </td>
				<td></td>
			    </tr>
		    </table>
            </form>
            
            <!-- Invited Members -->
            {if $invited}
        
                <h4>Invited Members</h4>
    
                <table class="table2">
                    <tr class="tablehead">
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Status</th>
                        <th>Options</th>
                    </tr>
                    {section name=info loop=$invited}
                        <tr>
                            <td>{if $invited[info].name}<a href="profile.php?user={$invited[info].user_id}">{$invited[info].name}</a>{else}<em>Not registered</em>{/if}</td>
                            <td><a href="mailto:{$invited[info].email}">{$invited[info].email}</a></td>
                            <td>{$invited[info].status}</td>
                            <td>
                                <img src="icons/arrowgreen_small.gif" class="icon" />
                            	<a href="pools.php?state=resendinvite&pool={$pool_id}&user={$invited[info].id}">Resend Invite</a><br />
                                <img src="icons/delete_small.gif" class="icon" />
                            	<a href="pools.php?state=removeinvite&pool={$pool_id}&user={$invited[info].id}">Remove</a>
                            </td>
                        </tr>
                    {/section}
                </table>
            {/if}

			</div>
			<div class="clear"></div>
        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}     
        </div>


    
    <div id="onecolumnbtm"></div>

</body>
</html>
