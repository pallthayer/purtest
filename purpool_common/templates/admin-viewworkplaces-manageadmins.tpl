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

            <!-- Check for confirmation -->
            {if $confirmation eq 'addadmin'}<p class="green">A workplace administrator has been added.</p>{/if}
            {if $confirmation eq 'removeadmin'}<p class="green">A workplace administrator has been removed.</p>{/if}
            
            <!-- Back to Main Menu -->
            <form id="myform" method="post" action="admin.php?state=manageadmins&workplace={$workplace_id}">
            	<div class="formelement">
                	<label for="user">Name of Workplace Administrator for {$workplacename}:</label>
                    <select name="user" class="select">
                    	<option value="">-- Select --</option>
                        {section name=info loop=$users}
                        	<option value="{$users[info].user_id}">{$users[info].firstname} {$users[info].lastname} ({$users[info].email})</option>
                        {/section}
                    </select>
                    <input id="submit" name="submit" type="submit" value="Add Workplace Administrator" class="submit" />
                </div>
            </form>
            
            <!-- Workplace Administrators -->
            {if $admins}
                <table class="sortable">
                    <tr>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Options</th>
                    </tr>
                    {section name=info loop=$admins}
                        <tr>
                            <td>{$admins[info].firstname} {$admins[info].lastname}</td>
                            <td>{$admins[info].email}</td>
                            <td>
                                <a href="admin.php?state=removeadmin&workplace={$workplace_id}&user={$admins[info].user_id}">Remove Administrator Role (does not delete user entirely)</a>
                            </td>
                        </tr>
                    {/section}
                </table>
            {else}
            	<p>There are currently no Purpool workplace administrators on file for this workplace</p>
            {/if}
            
            
        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}
        </div>


    
    <div id="onecolumnbtm"></div>

</body>
</html>