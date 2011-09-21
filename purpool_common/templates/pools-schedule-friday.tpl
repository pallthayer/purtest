{if !$friday_route && !$editmode}
<img src="images/table4.gif" /><br/>
  <table class="table4 ">
    <tr class="tablehead">
        <th class="nowrap">{$datefriday}</th>
    </tr>
    <tr>
    	<td>The details of this ride have not yet been set.</td>
    </tr>
   </table>
{else}

<form id="fridayform">
<img src="images/table4.gif" /><br/>
<table class="table4 ">
    <tr class="tablehead">
        <th class="nowrap" colspan="4">{$datefriday}</th>
    </tr>
            <tr>
            <td class="alert nowrap" style="width:25%">
    {section name=info loop=$members}
    	<div class="formelement">
            <div class="rightcell">
            	
            	<a href="pools.php?state=viewprofile&user={$members[info].user_id}">{$members[info].name}</a>   
            
            </div>

            {if $members[info].fridayconfirm eq 'accept'}
                {if $members[info].editable}
                	<div id="{$fulldates[5]}_usericon" class="leftcell">
                        <img class="icon" title="Confirmed" src="icons/confirmed.gif" />
                    </div>
                {else}
                    <div id="{$fulldates[5]}_icon" class="leftcell">
                        <img class="icon" title="Confirmed" src="icons/confirmed.gif" />
                    </div>
                {/if}
                {if !$members[info].editable}
                	<div class="rightcell accept">Accept</div>
                {/if}
            {/if}
            {if $members[info].fridayconfirm eq 'decline'}
                {if $members[info].editable}
                    <div id="{$fulldates[5]}_usericon" class="leftcell">
                        <img class="icon" title="Declined" src="icons/declined.gif" />
                    </div>
                {else}
                	<div id="{$fulldates[5]}_icon" class="leftcell">
                        <img class="icon" title="Declined" src="icons/declined.gif" />
                    </div>
                {/if}
                {if !$members[info].editable}
                	<div class="rightcell decline">Decline</div>
                {/if}
            {/if}
            {if $members[info].fridayconfirm eq ''}
                {if $members[info].editable}
                    <div id="{$fulldates[5]}_usericon" class="leftcell">
                        <img class="icon" title="Unconfirmed" src="icons/unconfirmed.gif" />
                    </div>
                {else}
                    <div id="{$fulldates[5]}_icon" class="leftcell">
                        <img class="icon" title="Unconfirmed" src="icons/unconfirmed.gif" />
                    </div>
                {/if}
                {if !$members[info].editable}
                	<div class="rightcell decline">Unconfirmed</div>
                {/if}
            {/if}
            {if $members[info].editable}
            	{if $members[info].fridayeditable eq true}
                    <div class="rightcell">
                        <a id="{$fulldates[5]}_accept" onclick="confirmPost('accept', '{$pool_id}', '{$fulldates[5]}'); return false;" href="#" 
                        {if $members[info].fridayconfirm eq 'accept'}class="accept"{/if}>Accept</a>
                        &nbsp;|&nbsp;
                        <a id="{$fulldates[5]}_decline" onclick="confirmPost('decline', '{$pool_id}', '{$fulldates[5]}'); return false;" href="#" 
                        {if $members[info].fridayconfirm eq 'decline'}class="decline"{/if}>Decline</a>
                    </div>
                {else}
                	{if $members[info].fridayconfirm eq 'accept'}<div class="rightcell accept">Accept</div>{/if}
                    {if $members[info].fridayconfirm eq 'decline'}<div class="rightcell decline">Decline</div>{/if}
                    {if $members[info].fridayconfirm eq ''}<div class="rightcell decline">Unconfirmed</div>{/if}
                {/if}
             {/if}
            </div>        
    {/section}
                </td>
                
                {if $editmode}
                
            
            
                <td class="nowrap" style="width:25%">
                	<div class="formelement">
                    <label for="route">Route</label>
                    <select name="route" class="select">
                        <option value="">-- select --</option>
                        {section name=info loop=$routes}
                            <option value="{$routes[info].route_id}" {if $friday_route eq $routes[info].route_id}selected="selected"{/if}>{$routes[info].title}</option>
                        {/section}
                    </select>
                    <div id="fridayRouteError" class="formerror">{$error.route}</div>
                    </div>
                    
                	<div class="formelement">
                    <label for="driver">Driver <a name="public" class="driverTooltipClass" id="friday_driver_ranking"><img src="images/icon_tooltip.gif" border="0"/> </a>
                    
                    </label>
                    
                    <select name="driver" class="select">
                        <option value="">-- select --</option>
                        {section name=info loop=$members}
                            <option value="{$members[info].user_id}" {if $fridaydriver eq $members[info].user_id}selected="selected"{/if}>{$members[info].name}</option>
                        {/section}
                    </select>
                	<div id="fridayDriverError" class="formerror">{$error.driver}</div>
                	</div>
               </td>   
                <td class="nowrap" style="width:25%">
                
                	<div class="formelement">
                    <label for="friday_dm_hour">Depart from meeting place</label>
                    <select name="friday_dm_hour" class="select" style="width: auto">
                        <option value="1" {if $friday_dm_hour eq '1'}selected="selected"{/if}>1</option>
                        <option value="2" {if $friday_dm_hour eq '2'}selected="selected"{/if}>2</option>
                        <option value="3" {if $friday_dm_hour eq '3'}selected="selected"{/if}>3</option>
                        <option value="4" {if $friday_dm_hour eq '4'}selected="selected"{/if}>4</option>
                        <option value="5" {if $friday_dm_hour eq '5'}selected="selected"{/if}>5</option>
                        <option value="6" {if $friday_dm_hour eq '6'}selected="selected"{/if}>6</option>
                        <option value="7" {if $friday_dm_hour eq '7'}selected="selected"{/if}>7</option>
                        <option value="8" {if $friday_dm_hour eq '8'}selected="selected"{/if}>8</option>
                        <option value="9" {if $friday_dm_hour eq '9'}selected="selected"{/if}>9</option>
                        <option value="10" {if $friday_dm_hour eq '10'}selected="selected"{/if}>10</option>
                        <option value="11" {if $friday_dm_hour eq '11'}selected="selected"{/if}>11</option>
                        <option value="12" {if $friday_dw_hour eq '12'}selected="selected"{/if}>12</option>
                    </select>
                    <select name="friday_dm_minute" class="select" style="width: auto">
                        <option value="00" {if $friday_dm_minute eq '00'}selected="selected"{/if}>00</option>
                        <option value="05" {if $friday_dm_minute eq '05'}selected="selected"{/if}>05</option>
                        <option value="10" {if $friday_dm_minute eq '10'}selected="selected"{/if}>10</option>
                        <option value="15" {if $friday_dm_minute eq '15'}selected="selected"{/if}>15</option>
                        <option value="20" {if $friday_dm_minute eq '20'}selected="selected"{/if}>20</option>
                        <option value="25" {if $friday_dm_minute eq '25'}selected="selected"{/if}>25</option>
                        <option value="30" {if $friday_dm_minute eq '30'}selected="selected"{/if}>30</option>
                        <option value="35" {if $friday_dm_minute eq '35'}selected="selected"{/if}>35</option>
                        <option value="40" {if $friday_dm_minute eq '40'}selected="selected"{/if}>40</option>
                        <option value="45" {if $friday_dm_minute eq '45'}selected="selected"{/if}>45</option>
                        <option value="50" {if $friday_dm_minute eq '50'}selected="selected"{/if}>50</option>
                        <option value="55" {if $friday_dm_minute eq '55'}selected="selected"{/if}>55</option>
                    </select>
                    <select name="friday_dm_ampm" class="select" style="width: auto">
                        <option value="am" {if $friday_dm_ampm eq 'am'}selected="selected"{/if}>am</option>
                        <option value="pm" {if $friday_dm_ampm eq 'pm'}selected="selected"{/if}>pm</option>
                    </select>
                    </div>
                    
                	<!--<div class="formelement">
                    <label for="friday_aw_hour">Arrive at Workplace</label>
                   
                    <select name="friday_aw_hour" class="select" style="width: auto">
                        <option value="1" {if $friday_aw_hour eq '1'}selected="selected"{/if}>1</option>
                        <option value="2" {if $friday_aw_hour eq '2'}selected="selected"{/if}>2</option>
                        <option value="3" {if $friday_aw_hour eq '3'}selected="selected"{/if}>3</option>
                        <option value="4" {if $friday_aw_hour eq '4'}selected="selected"{/if}>4</option>
                        <option value="5" {if $friday_aw_hour eq '5'}selected="selected"{/if}>5</option>
                        <option value="6" {if $friday_aw_hour eq '6'}selected="selected"{/if}>6</option>
                        <option value="7" {if $friday_aw_hour eq '7'}selected="selected"{/if}>7</option>
                        <option value="8" {if $friday_aw_hour eq '8'}selected="selected"{/if}>8</option>
                        <option value="9" {if $friday_aw_hour eq '9'}selected="selected"{/if}>9</option>
                        <option value="10" {if $friday_aw_hour eq '10'}selected="selected"{/if}>10</option>
                        <option value="11" {if $friday_aw_hour eq '11'}selected="selected"{/if}>11</option>
                        <option value="12" {if $friday_aw_hour eq '12'}selected="selected"{/if}>12</option>
                    </select>
                    <select name="friday_aw_minute" class="select" style="width: auto">
                        <option value="00" {if $friday_aw_minute eq '00'}selected="selected"{/if}>00</option>
                        <option value="05" {if $friday_aw_minute eq '05'}selected="selected"{/if}>05</option>
                        <option value="10" {if $friday_aw_minute eq '10'}selected="selected"{/if}>10</option>
                        <option value="15" {if $friday_aw_minute eq '15'}selected="selected"{/if}>15</option>
                        <option value="20" {if $friday_aw_minute eq '20'}selected="selected"{/if}>20</option>
                        <option value="25" {if $friday_aw_minute eq '25'}selected="selected"{/if}>25</option>
                        <option value="30" {if $friday_aw_minute eq '30'}selected="selected"{/if}>30</option>
                        <option value="35" {if $friday_aw_minute eq '35'}selected="selected"{/if}>35</option>
                        <option value="40" {if $friday_aw_minute eq '40'}selected="selected"{/if}>40</option>
                        <option value="45" {if $friday_aw_minute eq '45'}selected="selected"{/if}>45</option>
                        <option value="50" {if $friday_aw_minute eq '50'}selected="selected"{/if}>50</option>
                        <option value="55" {if $friday_aw_minute eq '55'}selected="selected"{/if}>55</option>
                    </select>
                    <select name="friday_aw_ampm" class="select" style="width: auto">
                        <option value="am" {if $friday_aw_ampm eq 'am'}selected="selected"{/if}>am</option>
                        <option value="pm" {if $friday_aw_ampm eq 'pm'}selected="selected"{/if}>pm</option>
                    </select>
                    </div> /-->
                    
                	<div class="formelement">
                    <label for="friday_dw_hour">Depart from Workplace</label>
                    <select name="friday_dw_hour" class="select" style="width: auto">
                        <option value="1" {if $friday_dw_hour eq '1'}selected="selected"{/if}>1</option>
                        <option value="2" {if $friday_dw_hour eq '2'}selected="selected"{/if}>2</option>
                        <option value="3" {if $friday_dw_hour eq '3'}selected="selected"{/if}>3</option>
                        <option value="4" {if $friday_dw_hour eq '4'}selected="selected"{/if}>4</option>
                        <option value="5" {if $friday_dw_hour eq '5'}selected="selected"{/if}>5</option>
                        <option value="6" {if $friday_dw_hour eq '6'}selected="selected"{/if}>6</option>
                        <option value="7" {if $friday_dw_hour eq '7'}selected="selected"{/if}>7</option>
                        <option value="8" {if $friday_dw_hour eq '8'}selected="selected"{/if}>8</option>
                        <option value="9" {if $friday_dw_hour eq '9'}selected="selected"{/if}>9</option>
                        <option value="10" {if $friday_dw_hour eq '10'}selected="selected"{/if}>10</option>
                        <option value="11" {if $friday_dw_hour eq '11'}selected="selected"{/if}>11</option>
                        <option value="12" {if $friday_dw_hour eq '12'}selected="selected"{/if}>12</option>
                    </select>
                    <select name="friday_dw_minute" class="select" style="width: auto">
                        <option value="00" {if $friday_dw_minute eq '00'}selected="selected"{/if}>00</option>
                        <option value="05" {if $friday_dw_minute eq '05'}selected="selected"{/if}>05</option>
                        <option value="10" {if $friday_dw_minute eq '10'}selected="selected"{/if}>10</option>
                        <option value="15" {if $friday_dw_minute eq '15'}selected="selected"{/if}>15</option>
                        <option value="20" {if $friday_dw_minute eq '20'}selected="selected"{/if}>20</option>
                        <option value="25" {if $friday_dw_minute eq '25'}selected="selected"{/if}>25</option>
                        <option value="30" {if $friday_dw_minute eq '30'}selected="selected"{/if}>30</option>
                        <option value="35" {if $friday_dw_minute eq '35'}selected="selected"{/if}>35</option>
                        <option value="40" {if $friday_dw_minute eq '40'}selected="selected"{/if}>40</option>
                        <option value="45" {if $friday_dw_minute eq '45'}selected="selected"{/if}>45</option>
                        <option value="50" {if $friday_dw_minute eq '50'}selected="selected"{/if}>50</option>
                        <option value="55" {if $friday_dw_minute eq '55'}selected="selected"{/if}>55</option>
                    </select>
                    <select name="friday_dw_ampm" class="select" style="width: auto">
                        <option value="am" {if $friday_dw_ampm eq 'am'}selected="selected"{/if}>am</option>
                        <option value="pm" {if $friday_dw_ampm eq 'pm'}selected="selected"{/if}>pm</option>
                    </select>
                    </div> 
                </td>
	                <td style="width:25%">
	                    <label for="friday_notes">Additional Notes</label>
	                    <input name="friday_notes" type="text" maxlength="255" value="{$friday_notes}" class="textbox" />
	                    <!--<textarea id="message" name="friday_notes" class="textbox" value="{$friday_notes}" rows="6" style="width: 199px;">{$message}</textarea> -->
	                    
                <input name="day" type="hidden" value="friday" />
                <input name="pool" type="hidden" value="{$pool_id}" />
                <input name="rdate" type="hidden" value="{$fulldates[5]}" />
                <!-- <input id="friday_submit" name="submit" type="submit" value="Save" class="submit" /> -->
                <button value="Save" id="friday_submit" name="submit" type="submit" class="btn">
                	<span>
                    Finalize
                	</span>
                </button>
                {if $fridayissaved}
                <span class="btn" >
                    <a href="pools.php?state=viewitinerary&pool={$pool_id}&rdate={$friday_ride}">
                    <img src="icons/schedule.gif" alt ="" class="icon" />View Itinerary</a>
                </span>
                {/if}
                <br />
                <img id="friday_indicator" src="images/indicator.gif" alt="" class="indicator" style="display: none;"/>
                </td>
           
                
                {else}
                <td class="nowrap" style="width:25%">
                	<div class="formelement">
                    <span class="purple">Route</span><br />
                        {section name=info loop=$routes}
                            {if $friday_route eq $routes[info].route_id}{$routes[info].title}{/if}
                        {/section}
                    </div>
                	<div class="formelement">
                    <span class="purple">Driver</span><br />
                        {section name=info loop=$members}
                            {if $members[info].fridaydriver eq $members[info].user_id}{$members[info].name}{/if}
                        {/section}
                    </div>
                </td>
                <td class="nowrap" style="width:25%">
                	<div class="formelement">
                    <span class="purple">Depart from meeting place</span><br />
                        {$friday_dm_hour}:{$friday_dm_minute}&nbsp;{$friday_dm_ampm}
                    </div>
                	<!-- <div class="formelement">
                    <span class="purple">Arrive at Workplace</span><br />
                        {$friday_aw_hour}:{$friday_aw_minute}&nbsp;{$friday_aw_ampm}
                    </div> /-->
                	<div class="formelement">
                    <span class="purple">Depart from Workplace</span><br />
                        {$friday_dw_hour}:{$friday_dw_minute}&nbsp;{$friday_dw_ampm}
                    </div>
                </td>
                <td>
                	<label for="friday_notes">Additional Notes</label>
	                    <input name="friday_notes" type="text" maxlength="255" readonly="readonly" value="{$friday_notes}" class="textbox" />
	               <span class="btn" >
                    <a href="pools.php?state=viewitinerary&pool={$pool_id}&rdate={$friday_ride}">
                    <img src="icons/schedule.gif" alt ="" class="icon" />View Itinerary</a>
                </span>
                </td>    
                        {/if}

                
        </tr>
</table>
 </form>
{/if}
                <div class="clear"></div>
