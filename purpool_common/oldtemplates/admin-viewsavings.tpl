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
    	<a href="/" id="logo"><h1>Purpool</h1></a>
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
            <p><a href="admin.php?state=viewworkplaces">Back to View Workplaces</a></p>
            
            <h1>Total Savings: {$workplace}</h1>
            
            <p><strong>Gas:</strong> {$gas}</p>
            <p><strong>Miles:</strong> {$miles}</p>
            <p><strong>Cars:</strong> {$cars}</p>
            <p><strong>Emissions:</strong> {$emissions}</p>
            <p><strong>Number of Pools:</strong> {$numpools}</p>
            <p><strong>Number of Members:</strong> {$nummembers}</p>
            
            
        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}
        </div>


    
    <div id="onecolumnbtm"></div>

</body>
</html>