<?php /* Smarty version 2.6.19, created on 2008-10-03 14:39:29
         compiled from sidenavigation.tpl */ ?>


    <div id="topnav">
    
<ul id="sidenav">

    <li><a id="dashboard" href="dashboard.php"<?php if ($this->_tpl_vars['dashboardcurrent']): ?> class="current"<?php endif; ?>>Dashboard</a></li>

    <li><a id="profile" href="profile.php"<?php if ($this->_tpl_vars['profilecurrent']): ?> class="current"<?php endif; ?>>Profile</a></li>

    <li><a id="pools" href="pools.php"<?php if ($this->_tpl_vars['poolscurrent']): ?> class="current"<?php endif; ?>>Pools</a></li>

    <li><a id="viz" href="viz.php"<?php if ($this->_tpl_vars['vizcurrent']): ?> class="current"<?php endif; ?>>Viz</a></li>

    <li><a id="cmap" href="cmap.php"<?php if ($this->_tpl_vars['cmapcurrent']): ?> class="current"<?php endif; ?>>cMap</a></li>

    <li><a id="events" href="events.php"<?php if ($this->_tpl_vars['eventscurrent']): ?> class="current"<?php endif; ?>>Events</a></li>

</ul>


    </div>


    <div id="topnav2">

    	<ul >

        	<li><a href="authenticate.php?state=signout">Signout</a></li>

		</ul>
		<ul >

        	<li><a href="help.php">Help</a> | <a href="contact.php">Contact</a></li>

		</ul>
	</div>