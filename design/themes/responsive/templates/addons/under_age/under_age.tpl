<div id="under_age_dialog">
{$under_age_type = fn_get_cookie('under_age_type')}
    {if $under_age_type == 'verify' || $under_age_type == 'deny'}
        <div class="under_age-bg">
            {if $under_age_type == 'deny'}
                {include "addons/under_age/components/deny.tpl"}
            {/if}
            {if $under_age_type == 'verify'}   
				{include "addons/under_age/components/verify.tpl"}
            {/if}
        </div>
    {/if}
<!--under_age_dialog--></div>
