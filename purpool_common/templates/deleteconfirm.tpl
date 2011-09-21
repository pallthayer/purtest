<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects,controls"></script>
</head>

<body>

	<!-- Header -->
    <div id="header">
    	<a href="{$site_url}" id="logo"><h1>Purpool</h1></a>
    </div>
    
	<!-- Top Navigation -->
   	{include file="topnavigation.tpl"}

	
    
    	<br /><br />
        
        <div id="onecolumntop"></div>

        <!-- Content -->
        <div class="content">
            <h3>Delete Confirmation</h3>
            
            <!-- Warning Box -->
            <div class="red" style="margin-bottom: 15px">
            	{if $warning eq 'route'}
                	<img src="icons/warning.gif" class="icon" />Are you sure that you would like to delete this route?
                {/if}
                {if $warning eq 'pool'}
                	<img src="icons/warning.gif" class="icon" />Are you sure that you would like to delete this pool?
                {/if}
                {if $warning eq 'event'}
                	<img src="icons/warning.gif" class="icon" />Are you sure that you would like to delete this event?
                {/if}
                {if $warning eq 'member'}
		        <img src="icons/warning.gif" class="icon" />Are you sure that you would like to remove this member from the pool?
                {/if}
                {if $warning eq 'workplace'}
		        <img src="icons/warning.gif" class="icon" />Are you sure that you would like to remove this workplace from purpool?
                {/if}
                {if $warning eq 'user'}
		        <img src="icons/warning.gif" class="icon" />Are you sure that you would like to remove this user from purpool?
                {/if}
            </div>
            
            
            <!-- Delete Form -->
            <form id="myform" method="post" action="{$formaction}">
            	<input id="yes" name="yes" type="submit" value="Yes" class="submit" /> 
                <input id="no" name="no" type="submit" value="No" class="cancel" />
            </form>
        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}     
        </div>


    
    <div id="onecolumnbtm"></div>

</body>
</html>
