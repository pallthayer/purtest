<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script language="javascript" src="js/formfocus.js"></script>
</head>

<body>

	<!-- Header -->
    <div id="header">
    	<a href="/" id="logo"><h1>Purpool</h1></a>
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
                
	        <h3 style="margin-bottom:0;">{$poolname}</h3>
            <div id="wizard">
                <ul>
                    <li ><a href="pools.php?state=viewprofile&pool={$pool_id}">Profile</a></li>
                    
                    {if $editmode}<li><a href="pools.php?state=editschedule&pool={$pool_id}">Scheduler</a></li>{/if}
                    <li><a href="pools.php?state=viewschedule&pool={$pool_id}">Upcoming Rides</a></li>
                    <li class="current"><a href="pools.php?state=shoutbox&pool={$pool_id}">Shoutbox</a></li>
                    {if $editmode}<li><a href="pools.php?state=editpool&pool={$pool_id}">Edit General</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=editmembers&pool={$pool_id}">Edit Members</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=viewroutes&pool={$pool_id}">Edit Routes</a></li>{/if}
                    {if $editmode}<li><a href="pools.php?state=deletepool&pool={$pool_id}">Delete Pool</a></li>{/if}
                </ul>
            </div>

			<div class="innercolumn3">
			<!-- Display Shouts -->
            {if $shouts}
            	<img src="images/table3.gif" /><br/>
                <table class="table3">
                    <tr class="tablehead">
                        <th>Name</th>
                        <th>Date</th>
                        <th>Message</th>
                    </tr>
                    {section name=info loop=$shouts}
                        <tr>
                            <td class="nowrap"><a href="profile.php?state=viewprofile&user={$shouts[info].user_id}">{$shouts[info].name}</a></td>
                            <td class="nowrap">{$shouts[info].shoutdate}</td>
                            <td>{$shouts[info].message}</td>
                        </tr>
                    {/section}
                </table>
            {else}
            	<p>There are current no shouts on file for this pool.</p>
            {/if}
            </div>
            
            <div class="innercolumn" id="last">
            <!-- Pool Form -->
            <img src="images/table1.gif" /><br/>
            <table class="table1">
            	<tr><th>Leave a Shout</th></tr>
            	<tr><td>
            <form id="myform" method="post" action="pools.php?state=shoutbox&pool={$pool_id}">      
                
                <!-- Message -->
                <div class="formelement">
                    <textarea id="message" name="message" class="textbox" rows="6" style="width: 189px;">{$message}</textarea>
                    <span id="messageError" class="formerror">{$error.message}</span>
                </div>
                
                <div class="formelement">
		                	<input id="email" name="email" type="hidden" value="y" />
                </div>
     
                <!-- Submit Button -->
                <div class="formelement">
                    <input id="submit" name="submit" type="submit" value="Send" class="submit" />
                </div>

            </form>
            	</td></tr>
            	</table>
			</div>
			<div class="clear"></div>
        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}     
        </div>


    
    <div id="onecolumnbtm"></div>

</body>
</html>
