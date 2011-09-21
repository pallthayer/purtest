    <div id="topnav">
    
<ul id="sidenav">
    {if $hidetopnav eq true}
    	<!-- Hide top navigation -->
    {else}
    	<!-- Show top navigation -->
        <li><a id="dashboard" href="dashboard.php"{if $dashboardcurrent} class="current"{/if}>Dashboard</a></li>
        <li><a id="profile" href="profile.php"{if $profilecurrent} class="current"{/if}>People</a></li>
        <li><a id="pools" href="pools.php"{if $poolscurrent} class="current"{/if}>Pools</a></li>
        <li><a id="viz" href="visualizations.php"{if $vizcurrent} class="current"{/if}>Savings</a></li>
        <li><a id="cmap" href="community-map.php"{if $cmapcurrent} class="current"{/if}>cMap</a></li>
        <li><a id="events" href="events.php"{if $eventscurrent} class="current"{/if}>Events</a></li>
    {/if}
</ul>

    </div>


    <div id="topnav2">
    	<ul >
        	<li><a href="authenticate.php?state=signout">Signout</a></li>
		</ul>
        <br/>
		<ul >
        	<li>{if $adminmode}<a id="admin" href="wkplaceadmin.php"{if $admincurrent} class="current"{/if}>Admin</a> | {/if}<a href="help.php">Help</a> | <a href="contact.php">Contact</a></li>
		</ul>
	</div>
