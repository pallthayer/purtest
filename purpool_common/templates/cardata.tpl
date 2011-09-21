{* RETURNS A LIST OF POSSIBLE MAKES OF THE VEHICLE *}
{if $getmake}
	<select id="make" name="make" class="select">
    	<option value="" selected="selected"> -- select -- </option>
	   	{foreach from=$makes item=make name=myloop}
	   		<option value="{$make}">{$make}</option>
	   	{/foreach}
	</select>
{/if}

{* RETURNS A LIST OF POSSIBLE MODELS OF THE VEHICLE *}
{if $getmodel}
	{if $models}
		<select id="model" name="model" class="select">
        	<option value="" selected="selected"> -- select -- </option>
	    	{foreach from=$models item=model name=myloop}
	    		<option value="{$model}">{$model}</option>
	    	{/foreach}
	    </select>
	{else}
    	no model - what now?
    {/if}
{/if}

{* RETURNS A LIST OF POSSIBLE TRANSMISSION OF THE VEHICLE *}
{if $gettrans}
	{if $trans}
		<select id="trans" name="trans" class="select">
        	<option value="" selected="selected"> -- select -- </option>
	    	{foreach from=$trans item=tran name=myloop}
	    		<option value="{$tran}">{$tran}</option>
	    	{/foreach}
	    </select>
	{else}
    	no transmission - what now?
    {/if}
{/if}

{* RETURNS A LIST OF POSSIBLE CYLINDERS OF THE VEHICLE *}
{if $getcylinders}
	{if $cylinders}
		<select id="cylinders" name="cylinders" class="select">
        	<option value="" selected="selected"> -- select -- </option>
	    	{foreach from=$cylinders item=cylinder name=myloop}
	    		<option value="{$cylinder}">{$cylinder}</option>
	    	{/foreach}
	    </select>
	{else}
    	no cylinders - what now?
    {/if}
{/if}

