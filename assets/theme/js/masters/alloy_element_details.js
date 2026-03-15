function onready_alloy_element() {
	onchange_alloy_element_master_company_name();
	onchange_alloy_element_master_alloy_name();
}

function onchange_alloy_element_master_company_name() {
	$('select[name*="alloy_element_detail_reports[company_name]"]').on('change', function() {
		alloy_element_master_refresh_page('company_name');
	})
}

function onchange_alloy_element_master_alloy_name() {
	$('select[name*="alloy_element_detail_reports[alloy_name]"]').on('change', function() {
		alloy_element_master_refresh_page('alloy_name');
	})
}
function alloy_element_master_refresh_page(field_name) {
	var company_name = $('select[name*="alloy_element_detail_reports[company_name]"] option:selected').val();
	var alloy_name = $('select[name*="alloy_element_detail_reports[alloy_name]"] option:selected').val();
	
	var get_params = '';
	if (	 company_name != '' 
			&& company_name != undefined 
			&& (   field_name == 'company_name'
					|| field_name == 'alloy_name')) {
		get_params = get_params + 'company_name='+company_name+'&';
	if (   alloy_name != '' 
		  && alloy_name != undefined
		  && (   field_name == 'alloy_name')) {
			get_params = get_params + 'alloy_name='+alloy_name;
		}
	}
	
	window.location = base_url+ 'reports/alloy_element_detail_reports?'+get_params;
	
}