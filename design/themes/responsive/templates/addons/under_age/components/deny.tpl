{$age_restriction_text = $addons.under_age.age_restriction_text}
{$minimal_age = $addons.under_age.minimal_age}
<div class="hidden cm-dialog-auto-open cm-dialog-auto-size" title="{__("popup_title_forbidden")}">
       <p class="text-error lead">
              {__("popup_text_pre")} {$minimal_age}
       </p>
       <p class="text-error lead">
              {$age_restriction_text}
       </p>            
</div>   
    