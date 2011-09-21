<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key={$google_key}" type="text/javascript"></script>
<script language="javascript" src="js/sorttable.js"></script>

<script type="text/javascript">

	var profileData = [
		{section name=info loop=$members}
		{literal}{{/literal}
			'zipcode':'{$members[info].zipcode}','location':'{$members[info].latitude},{$members[info].longitude}'{literal}}{/literal},
		{/section}
		];
		
	var defaultzip = "{$defaultzip}";
	var lat = '{$lat}';
	var lng = '{$lng}';
	var workplace ='{$workplace}';
</script>

{literal}
<script type="text/javascript">
	
	var type = "profile";
	
	// INITIAL EVENT LISTENERS
	document.observe("dom:loaded", function() 
	{
		
		if (GBrowserIsCompatible()) {
			loadGMap(lat, lng);
			
			// Go to default zipcode
			if(defaultzip != '')
			{
				markerSelected(defaultzip);
			}
		}
	});
	
</script>
{/literal}

<script  language="javascript" src="js/icons.js"></script>
<script language="javascript1.3" src="js/browse.js"></script>
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
            <h2>People</h2>
            
            <!-- Tabs -->
            <div id="tabs">
              	<ul>
                	<li class="current"><a href="profile.php?state=browseprofiles">Browse People</a></li>
                	<li class="first"><a href="profile.php?state=viewprofile">View Profile</a></li>
                    <li><a href="profile.php?state=editgeneral">Edit Profile</a></li>
                    
                </ul>
            </div>
            
        </div>
        
        <div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
        	<h3>Browse People</h3>
        	
            <div class="innercolumn2" style="height:375px;width:449px;overflow-x:hidden;overflow-y:scroll;">
	            <!-- Displays current zipcode -->
	            <div id="list"></div>
	        	
	            <!-- A through Z directory -->
	            <a href="profile.php?state=browseprofiles&sortby=member">All</a> | 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=a">A</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=b">B</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=c">C</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=d">D</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=e">E</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=f">F</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=g">G</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=h">H</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=i">I</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=j">J</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=k">K</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=m">L</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=n">M</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=n">N</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=o">O</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=p">P</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=q">Q</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=r">R</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=s">S</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=t">T</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=u">U</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=v">V</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=w">W</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=x">X</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=y">Y</a> 
	            <a href="profile.php?state=browseprofiles&sortby=alphabet&letter=z">Z</a> 
	            
	            <br /><br />
	            <div id="browsetable">
	                {if $members}
                    <img src="images/table2.gif" /><br/>
	                <table class="table2 sortable" style="width:434px;">
	                    <tr class="tablehead">
	                        <th id="first_col">Member</th>
	                        <th>Workplace</th>
	                        <th>Zipcode</th>
	                    </tr>
	                    {section name=info loop=$members}
	                        <tr>
	                            <td sorttable_customkey="{$members[info].counter}"><a href="profile.php?state=viewprofile&user={$members[info].user_id}">{$members[info].firstname} {$members[info].lastname}</a></td>
	                            <td>{$members[info].workplace}</td>
	                            <td><a href="#" onclick="markerSelected('{$members[info].zipcode}'); return false;">{$members[info].zipcode}</a></td> 
	                        </tr>
	                    {/section}
	                </table>
	                {else}
	                    <p>There are currently no members that match this criteria.</p>
	                {/if}
	            </div>
            </div>
        	<div class="innercolumn2" id="last" style="width:417px;">
	       		<!-- Map -->
	            <div id="map" style="width: 417px; height: 370px;"></div>
            </div>
			<div class="clear"></div>
        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"} 
        </div>
	<div id="onecolumnbtm"></div>
</body>
</html>
