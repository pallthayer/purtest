{if $members}
<img src="images/table2.gif" /><br/>
<table class="table2">
    <tr class="tablehead">
        <th><a href="profile.php?state=browseprofiles&sortby=member">Member</a></th>
        <th><a href="profile.php?state=browseprofiles&sortby=workplace">Workplace</a></th>
        <th><a href="profile.php?state=browseprofiles&sortby=zipcode">Zipcode</a></th>
    </tr>
    {section name=info loop=$members}
        <tr>
            <td><a href="profile.php?state=viewprofile&user={$members[info].user_id}">{$members[info].firstname} {$members[info].lastname}</a></td>
            <td>{$members[info].workplace}</td>
            <td><a href="#" onclick="markerSelected('{$members[info].zipcode}'); return false;">{$members[info].zipcode}</a></td> 
        </tr>
    {/section}
</table>
{else}
    <p>There are currently no members that match this criteria.</p>
{/if}