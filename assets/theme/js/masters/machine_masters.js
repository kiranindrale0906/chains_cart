function onready_machine_master() {
	onchange_machine_master_product_name();
	onchange_machine_master_process_name();
	onchange_machine_master_department_name();
}

function onchange_machine_master_product_name() {
	$('select[name*="machine_masters[product_name]"]').on('change', function() {
		machine_master_refresh_page('product_name');
	})
}

function onchange_machine_master_process_name() {
	$('select[name*="machine_masters[process_name]"]').on('change', function() {
		machine_master_refresh_page('process_name');
	})
}

function onchange_machine_master_department_name() {
	$('select[name*="machine_masters[department_name]"]').on('change', function() {
		machine_master_refresh_page('department_name');
	})
}

function machine_master_refresh_page(field_name) {
	//var params = new window.URLSearchParams(window.location.search);
	//var product_name = params.get('product_name');
	var product_name = $('select[name*="machine_masters[product_name]"] option:selected').val();
	var process_name = $('select[name*="machine_masters[process_name]"] option:selected').val();
	var department_name = $('select[name*="machine_masters[department_name]"] option:selected').val();

	var get_params = '';
	if (	 product_name != '' 
			&& product_name != undefined 
			&& (   field_name == 'product_name'
					|| field_name == 'process_name'
					|| field_name == 'department_name')) {
		get_params = get_params + 'product_name='+product_name+'&';
	if (   process_name != '' 
		  && process_name != undefined
		  && (   field_name == 'process_name'
					|| field_name == 'department_name')) {
			get_params = get_params + 'process_name='+process_name+'&';
	if (   department_name != '' 
		  && department_name != undefined
		  && field_name == 'department_name') 
				get_params = get_params + 'department_name='+department_name+'&';
		}
	}
	
	window.location = base_url+ 'masters/machine_masters/create?'+get_params;
	
}