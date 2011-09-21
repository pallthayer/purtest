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
                    <li class="first current"><a href="events.php?state=browse">Search/Browse</a></li>
                    <li><a href="events.php?state=createevent">Create/Edit</a></li>
                </ul>
            </div>

        </div>
        
		<div id="tabtop"></div>
        <!-- Content -->
        <div class="content">

            <!-- Detailed Event Information -->
            <h2 style="margin: 0 0 10px 0; padding: 0">{$title}</h2>
            
            <table style="border: none; width: auto">
            	{if $description}<tr style="border: none"><td><span class="purple">Description:</span></td><td>{$description}</td></tr>{/if}
                <tr style="border: none"><td><span class="purple">Type:</span></td><td>{$type} {if $typeother}: {$typeother}{/if}</td></tr>
                {if $location}<tr style="border: none"><td><span class="purple">Location:</span></td><td>{$location}</td></tr>{/if}
                <tr style="border: none"><td><span class="purple">Start Date/Time:</span></td><td>{$startdate} at {$starttime}</td></tr>
                {if $enddate}<tr style="border: none"><td><span class="purple">End Date/Time:</span></td><td>{$enddate} at {$endtime}</td></tr>{/if}
                {if $url}<tr style="border: none"><td><span class="purple">Url:</span></td><td><a href="{$url}" target="_blank">{$url}</a></td></tr>{/if}
                {if $notes}<tr style="border: none"><td><span class="purple">Notes:</span></td><td>{$notes}</td></tr>{/if}
                <tr style="border: none"><td><span class="purple">Posted By:</span></td><td><a href="profile.php?state=viewprofile&user={$user_id}">{$postedby}</a></td></tr>
            </table>

        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}
        </div>

    <div id="onecolumnbtm"></div>

</body>
</html>