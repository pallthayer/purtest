<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript">AC_FL_RunContent = 0;</script>
<script src="js/AC_RunActiveContent.js" language="javascript"></script>
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>

<!--
<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript">
    swfobject.embedSWF("visualizations/linechart/linechart.swf", "linechart", "640", "255", "9.0.0");
</script>
-->


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
            <h2>People</h2>
            
            <div id="tabs">
              <ul>
                <li class="first"><a href="profile.php?state=browseprofiles">Browse People</a></li>
                <li class="current"><a href="profile.php?state=viewprofile">{if $editmode}My Profile{else}View Profile{/if}</a></li>
                    {if $editmode}<li><a href="profile.php?state=editgeneral">Edit Profile</a></li>{/if}
                    
                </ul>
            </div>
            

		</div>
        
        <div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
            
            <!-- Profile heading -->
            <h3 style="margin-bottom:2px;">{$firstname} {$lastname}'s Profile</h3>
            
            <div class="innercolumn" >
	            <!-- Profile Image -->
	            <div class="userphoto">
		            {if $userphoto}<a href="users/{$userphotolarge}"><img src="users/{$userphoto}" width="200px" alt="" /></a>
		            {else}<img src="images/defaultmemberpic.gif" alt="" />
		            {/if}
	            </div>
	            <!-- Workplace -->
	            <img src="icons/workplace.gif" class="icon" /><a href="profile.php?state=browseprofiles&filter=workplace&workplace={$workplace_id}">{$workplacename}</a><br />
	            
	            <!-- Male/Female -->
	            <img src="icons/person.gif" class="icon" />{$gender}<br />
	            
	            <!-- Email -->
	            <div class="leftcell"><img src="icons/email.gif" class="icon" alt="Email" /></div><div class="rightcell"><a href="mailto:{$email}">{$email}</a></div>
	            
	            <!-- Phone -->
	            <img src="icons/phone.gif" class="icon" alt="Cell Phone" />{$cellphone}<br />
	            {if $workphone}<img src="icons/workphone.gif" class="icon" alt="Work Phone" />{$workphone}<br />{/if}
	            
	            <!-- Zipcode -->
	            <img src="icons/marker-person.gif" class="icon" /><a href="profile.php?state=browseprofiles&zipcode={$zipcode}">{$zipcode}</a><br />
	            
	            <!-- Schedule Availability -->
	            {if $schedule}<div class="leftcell"><img src="icons/schedule.gif" class="icon" /></div><div class="rightcell">{$schedule}</div>{/if}
	            
	            <!-- Music preferences -->
	            {if $music}<img src="icons/music.gif" class="icon" alt="Music"/>{$music}<br />{/if}
	            
	            <!-- Interests -->
	            {if $interests}<div class="leftcell"><img src="icons/loves.gif" class="icon" alt="Interests"/></div> <div class="rightcell">{$interests}</div>{/if}
	            
	            <!-- Vehicle -->
	            {if $year}<div class="leftcell"><img src="icons/vehicle.gif" class="icon" alt="Vehicle" /></div> <div class="rightcell"> {$year} {$color} {$make} {$model} ({$seats} seats)</div>{/if}
                
                <!-- Pools -->
                {if $pools}
                	<div class="leftcell"><img src="icons/vehicle.gif" class="icon" alt="Vehicle" /></div> 
                    <div class="rightcell">
                		{section name=info loop=$pools}
                            <a href="pools.php?state=viewprofile&pool={$pools[info].pool_id}">{$pools[info].title}</a><br />
	                	{/section}
                	</div>
                {/if}
	            
            </div>
            
            <div class="innercolumn3" id="last">
	            <!-- Savings graph 
	          	<script type="text/javascript">
				AC_FL_RunContent( 
					'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0',
					'width','640',
					'height','255',
					'src','visualizations/linechart/linechart',
					'quality','high',
					'pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash',
					'movie','visualizations/linechart/linechart'
					 ); //end AC code
				</script>
				<noscript>
                -->
                
                <div id="linechart"></div>
                
				
                	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="640" height="255">
	              <param name="movie" value="visualizations/linechart/linechart.swf" />
	              <param name="quality" value="high" />
	              <embed src="visualizations/linechart/linechart.swf" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="657" height="255"></embed>
	          		</object>
                    
                   
                    
                    
	          	<!--</noscript>-->
               
	        </div>
            
            <div class="innercolumn">
	            <!-- Savings Information -->
                <img src="images/table1.gif" /><br/>
	            <table class="table1">
          			<tr class="tablehead">
          			<th>Cumulative Savings</th>
          			</tr>
          			<tr><td>
	            Gas Savings: {$usergas}
	            	</td></tr>
          			<tr><td>
	            Miles not driven: {$usermiles}
	            	</td></tr>
          			<tr><td>
	            Cars off road: {$usercars}
	            	</td></tr>
          			<tr><td>
	            GH emissions savings: {$useremissions}
	            	</td></tr>
	            	</table>
            </div>
            <div class="innercolumn">
            <img src="images/table1.gif" /><br/>
	            <table class="table1">
          			<tr class="tablehead">
          			<th>This Week's Savings</th>
          			</tr>
          			<tr><td>
	            Gas Savings: {$weekusergas}</td></tr>
          			<tr><td>
	            Miles not driven: {$weekusermiles}</td></tr>
          			<tr><td>
	            Cars off road: {$weekusercars}</td></tr>
          			<tr><td>
	            GH emissions savings: {$weekuseremissions}</td></tr>
	            </table>
			</div>
		<div class="clear"></div>
        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"} 
	</div>
	<div id="onecolumnbtm"></div>
</body>
</html>
