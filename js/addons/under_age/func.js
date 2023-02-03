(function(_, $){
	
	$(document).ready(function(){
		$.ceAjax('request', fn_url("under_age.check"), {
			method: 'POST',
			data: {
				result_ids: 'under_age_dialog'
			},
		});	
	});

})(Tygh, Tygh.$);
