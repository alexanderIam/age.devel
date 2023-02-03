<div class="hidden cm-dialog-auto-open cm-dialog-auto-size verify_window" title="{__("popup_title_check")}" value={$dialog_titlebar_close}>
    <form name="under_age_form" action="{""|fn_url}" method="post" class="cm-ajax">
		<div class="text-error lead"> 
			<div class="ty-control-group">
				<label class="ty-control-group__title" for="birthday">{__("birthday_date")}</label>
				<div class="controls ">
					{include "common/calendar.tpl" 
						date_id="elm_under_age_timestamp" 
						date_name="birthday" 
						date_val=$under_age.timestamp|default:$smarty.const.TIME
					}
            	</div>
			</div>
			<div class="buttons-container">
				<div class="ty-float-left">
					{include "buttons/button.tpl" 
						but_name="dispatch[under_age.verify]" 
						but_text=__("submit") 
						but_role="submit" 
						but_meta="ty-btn__primary ty-btn__big cm-form-dialog-closer ty-btn"
					}
				</div>
			</div>
		</div>
    </form>
</div> 
