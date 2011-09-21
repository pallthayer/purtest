{if $pools}
<img src="images/table2.gif" /><br/>
<table class="table2">
    <tr class="tablehead">
              <th>Pool</th>
              <th>Zip Code</th>
              <th>Description</th>
        </tr>
        {section name=info loop=$pools}
            <tr>
                <td class="nowrap"><a href="pools.php?state=viewprofile&pool={$pools[info].pool_id}">{$pools[info].title}</a>&nbsp;({$pools[info].nummembers})</td>
                <td><a href="#" onclick="markerSelected('{$pools[info].zipcode}'); return false;">{$pools[info].zipcode}</a></td>
                <td>{$pools[info].description}</td>
            </tr>
        {/section}
    </table>
{else}
    <p>There are currently no pools that match this criteria.</p>
{/if}