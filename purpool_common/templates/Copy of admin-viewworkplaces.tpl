<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script language="javascript" src="js/formfocus.js"></script>
<script language="javascript" src="js/sorttable.js"></script>

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
            <h2>Admin</h2>
            
        </div>
        
		<div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
        
        	<!-- Back to Main Menu -->
            <p><a href="admin.php">Back to Main Menu</a></p>
            
            <!-- Back to Main Menu -->
            <p><a href="admin.php?state=addworkplace">Add Workplace</a></p>
            
            <!-- Workplaces -->
            {if $workplaces}
                <table class="table4 sortable">
                    <tr>
                        <th>Workplace</th>
                        <th>Number of Memebers</th>
                        <th>Location (lat, lng)</th>
                        <th>Options</th>
                    </tr>
                    {section name=info loop=$workplaces}
                        <tr>
                            <td>{$workplaces[info].name}</td>
                            <td>{$workplaces[info].nummembers}</td>
                            <td>{$workplaces[info].latitude}, {$workplaces[info].longitude}</td>
                            <td>
                            	<a href="admin.php?state=sendmassmessage&workplace={$workplaces[info].workplace_id}">Send Message</a><br />
                                <a href="admin.php?state=manageadmins&workplace={$workplaces[info].workplace_id}">Manage Admins</a> ({$workplaces[info].numadmins})<br />
                                <a href="admin.php?state=editworkplace&workplace={$workplaces[info].workplace_id}">Edit</a><br />
                                <a href="admin.php?state=deleteworkplace&workplace={$workplaces[info].workplace_id}">Delete</a>
                            </td>
                        </tr>
                    {/section}
                </table>
            {else}
            	<p>There are currently no Purpool workplaces on file</p>
            {/if}
            
            
        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}
        </div>


    
    <div id="onecolumnbtm"></div>

</body>
</html>