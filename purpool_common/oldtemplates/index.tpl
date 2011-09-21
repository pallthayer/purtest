<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purpool</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
<script language="javascript" src="js/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script language="javascript" src="js/formfocus.js"></script>
<script language="javascript" src="js/authenticate.js"></script>
</head>

<body>

	<!-- Header -->
    <div id="header">
    	<a href="/" id="logo"><h1>Purpool</h1></a>
    </div>
    
    <!-- Top Navigation -->
    <div id="topnav2">
    	<ul>
        	<li><a href="register.php">Register</a></li>
		</ul>
		<ul >
        	<li><a href="help.php">Help</a> | <a href="contact.php">Contact</a></li>
		</ul>
    </div>
    
    	<!-- Content Bar -->
        <div id="contentbar">
        
    	
        
            <!-- Page Heading -->
            <h2>Welcome to Purpool!</h2>
            
        </div>
        
        
        <div id="onecolumntop"></div>
        <!-- Content -->
        <div class="content">
	        
	    <!-- Left Column -->
	    <div class="innercolumn3" style="width: 636px">
    		<!--<div id="slideshow"><img src="images/promo1.jpg" height="282px"/></div> -->
            <div id="slideshow"><img id="billboard" /></div>
			<script type="text/javascript">
                var number=Math.floor(Math.random()*6)+1; 
                document.getElementById("billboard").src = "images/billboard" + number + ".jpg";
            </script>
        	<div class="innercolumn" style="width: 200px">
	        	<h3>What is Purpool?</h3>
				<!--With the ability to create and
				organize your carpools, you’ll
				want to use Purpool every day.
				Our visualizations will help you
				keep track of savings.  -->
                Purpool makes it easy for you to create and organize your workplace-based carpools and to track your savings while making new friends and helping the environment.
				<a href="help.php?state=about">Learn more</a>.
			</div>
			<div class="innercolumn" style="width: 200px">
	        	<h3>Take the Tour.</h3>
	            Take a <a href="help.php?state=tour">tour</a> to learn about the different ways  Purpool makes ride-sharing a fun, community building experience. <a href="help.php?state=tour">Tour</a>.
                
            </div>  
            {if $activemembers}
		<div class="innercolumn" style="width: 200px">
	   		 <h3>Purpool Stats</h3>
	    		 Purpool currently has {$activemembers} active members, and {$poolcount} registered carpools - join us today!
                </div> 
            {else}
                <div class="innercolumn" style="width: 200px">
                    <h3>Purpool Leaders</h3>
                    <table style="border: none;">
                        {section name=info loop=$leaders}
                            <tr style="border: none;">
                                <td style="border: none;">{$leaders[info].team}<br />({$leaders[info].workplace})</td>
                                <td style="border: none;">Rank: {$leaders[info].rank}</td>
                            </tr>
                        {/section}
                    </table>
                </div> 
            {/if} 
            
       	 </div>
        
	        <!-- Right Column -->
	    <div class="innercolumn" id="last">
	    
	        <!-- Signin -->
	        <div style="width: 180px; margin-bottom: 20px;">
	            <h3>Member Login</h3>
	           
	            <!-- Invalid user error -->
	            <div id="invaliduserError" class="formerror"></div>
	            
	            <!-- Signin Form -->
	            <form id="signinForm">
	                <div class="formelement">
	                    <label for="email">E-mail Address</label>
	                    <input id="emailAddress" name="email" type="text"  class="textbox" style="width: 172px" />
	                    <div id="emailError" class="formerror"></div>
	                </div>
	                <div class="formelement">
	                    <label for="username">Password</label>
	                    <input id="userpass" name="userpass" type="password"  class="textbox" style="width: 172px" />
	                    <div id="userpassError" class="formerror"></div>
	                </div>
	                <div class="formelement">
	                    <input id="submit" name="submit" type="submit" value="Sign In" class="submit" />
                        <input type="checkbox" name="remember" checked="checked">Stay signed in
	                </div>
	            </form>
	            
	            <!-- Forgot Password -->
	            <a href="authenticate.php?state=resetpassword">Forget your password?</a>
	        
	        </div>
	        
	        <h3>New Members</h3>
	        <a href="register.php">Register</a> in just a few simple steps.<br/><br/>
            This version is for employees at Bowdoin College, Colgate University, the NYS Department of Environmental Conservation in Albany,  and Purchase College only.
	    </div>
	
		
  	
        <div class="clear"></div>   
        {include file="bottomnavigation.tpl"}
    </div>
            
    <div id="onecolumnbtm"></div>

</body>
</html>
