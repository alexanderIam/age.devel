<div id="under_age_dialog">
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
</div>
