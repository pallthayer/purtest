<?php /* Smarty version 2.6.19, created on 2011-08-18 16:27:42
         compiled from topnavigation.tpl */ ?>
    <div id="topnav">
    
<ul id="sidenav">
    <?php if ($this->_tpl_vars['hidetopnav'] == true): ?>
    	<!-- Hide top navigation -->
    <?php else: ?>
    	<!-- Show top navigation -->
        <li><a id="dashboard" href="dashboard.php"<?php if ($this->_tpl_vars['dashboardcurrent']): ?> class="current"<?php endif; ?>>Dashboard</a></li>
        <li><a id="profile" href="profile.php"<?php if ($this->_tpl_vars['profilecurrent']): ?> class="current"<?php endif; ?>>People</a></li>
        <li><a id="pools" href="pools.php"<?php if ($this->_tpl_vars['poolscurrent']): ?> class="current"<?php endif; ?>>Pools</a></li>
        <li><a id="viz" href="visualizations.php"<?php if ($this->_tpl_vars['vizcurrent']): ?> class="current"<?php endif; ?>>Savings</a></li>
        <li><a id="cmap" href="community-map.php"<?php if ($this->_tpl_vars['cmapcurrent']): ?> class="current"<?php endif; ?>>cMap</a></li>
        <li><a id="events" href="events.php"<?php if ($this->_tpl_vars['eventscurrent']): ?> class="current"<?php endif; ?>>Events</a></li>
    <?php endif; ?>
</ul>

    </div>


    <div id="topnav2">
    	<ul >
        	<li><a href="authenticate.php?state=signout">Signout</a></li>
		</ul>
        <br/>
		<ul >
        	<li><?php if ($this->_tpl_vars['adminmode']): ?><a id="admin" href="wkplaceadmin.php"<?php if ($this->_tpl_vars['admincurrent']): ?> class="current"<?php endif; ?>>Admin</a> | <?php endif; ?><a href="help.php">Help</a> | <a href="contact.php">Contact</a></li>
		</ul>
	</div>