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

<body onload="window.location.hash = '#'+{$anchor}";>

	<!-- Header -->
    <div id="header">
    	<a href="{$site_url}" id="logo"><h1>Purpool</h1></a>
    </div>
    
	<!-- Top Navigation -->
   	{include file="topnavigation.tpl"}

    
    	<!-- Content Bar -->
        <div id="contentbar">
        
            <!-- Page Heading -->
            <h2>Help</h2>
            
        </div>
        
        <!-- Tabs -->
            <div id="tabs">
                <ul>
                    <li class="first"><a href="help.php?state=about">About</a></li>
                    <li class="current"><a href="help.php?state=faq">FAQ</a></li>
                    <li><a href="help.php?state=tour">Tour</a></li>
                    <li><a href="help.php?state=privacy">Privacy Policy</a></li>
                    <li><a href="help.php?state=tos">Terms of Service</a></li>
                </ul>
            </div>

        
<div id="tabtop"></div>
        <!-- Content -->
        <div class="content">
<h2>Your Profile</h2>
<p>
<a name="1"><h3>Who will see my profile?</h3>
</a> 
People at your workplace who have registered for Purpool will be able to see your profile. Purpool members from other workplaces will not be able to see your profile without your permission.
</p>

<p>
<a name="2"><h3>Why must I use my workplace email to register?</h3></a> 
This is how we ensure that only employees in your workplace community participate in your Purpool community. After you register an email is sent to your workplace email with a temporary password.
</p>


<p>
<a name="3">
<h3>How can I change my password? </h3>
</a> 
After you register you will receive an email with your temporary password. Use it to sign on to Purpool. You can then change your password by visiting the People page and then selecting the Edit Profile tab.
</p>

<p>
<a name="4"><h3>Why don't you include my home address in the registration form?</h3>
</a> 
We don't require your home address in order to protect your privacy. We do ask for your zip code. This allows people who live near you to find you using the search/browse map interface on the Browse People page.
</p>


<p>
<a name="5"><h3>Why am I asked for my car year, make and model?</h3></a> 
This info helps us calculate your savings. These savings are calculated on an individual basis, for each of the pools, and for the entire workplace community and are displayed throughout the site in order to help you appreciate the benefits of carpooling.
</p>

        <!-- Bottom Navigation Bar -->
        {include file="bottomnavigation.tpl"}                    
        </div>
        
    </div>

    <div id="onecolumnbtm"></div>

</body>
</html>
