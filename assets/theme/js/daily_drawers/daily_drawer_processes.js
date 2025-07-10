function onload_daily_drawer_processes() {
	onchange_in_purity_get_daily_drawer_processes();
	onchange_in_purity_get_cz_processes();
	on_click_hold_process_id_calculate_in_weight();
	on_click_dd_process_id_calculate_in_weight();
	on_click_cz_process_id_calculate_in_weight();
	onchange_in_purity_get_daily_drawer_hold_processes();
	onchange_in_purity_get_daily_drawer_hold_processes();
	onclick_daily_drawer_select_all_check_all_checkboxes();
	onclick_cz_select_all_check_all_checkboxes();
	onclick_daily_drawer_hold_select_all_check_all_checkboxes();
	on_click_section_processes_search();
	on_click_section_cz_processes_search();
	// get_section_and_refresh_page();
	// alert('hii');
}
function on_click_dd_process_id_calculate_in_weight(){
	$('.daily_drawer_wastage_process_id').click(function(){
		calculate_in_weight();
	});
}function on_click_cz_process_id_calculate_in_weight(){
	$('.cz_wastage_process_id').click(function(){
		calculate_cz_in_weight();
	});
}
function on_click_section_processes_search(){
	$('.daily_drawer_processes_search').click(function(){
		get_section_and_refresh_page();		
	});
}
function on_click_section_cz_processes_search(){
	$('.cz_processes_search').click(function(){
		get_section_and_refresh_page();		
	});
}
function onchange_in_purity_get_daily_drawer_hold_processes(){
	$('.daily_drawer_hold_processes_search').click(function(){
		get_hold_section_and_refresh_page();		
	});
}


function onchange_in_purity_get_daily_drawer_processes() {
	$('select[name*="daily_drawer_processes[in_purity]"]').on('change', function() {
		var in_purity = $(this).val();	
		window.location = base_url+ 'daily_drawers/daily_drawer_processes/create?in_purity='+in_purity;	
	})
}
function onchange_in_purity_get_cz_processes() {
	$('select[name*="cz_processes[in_purity]"]').on('change', function() {
		var in_purity = $(this).val();	
		window.location = base_url+ 'daily_drawers/cz_processes/create?in_purity='+in_purity;	
	})
}function onchange_in_purity_get_daily_drawer_hold_processes() {
	$('select[name*="daily_drawer_hold_processes[in_purity]"]').on('change', function() {
		var in_purity = $(this).val();	
		window.location = base_url+ 'daily_drawers/daily_drawer_hold_processes/create?in_purity='+in_purity;	
	})
}

function get_section_and_refresh_page() {
	var sections = [];
	var in_purity = $('select[name*="in_purity"]').val();
  
	$('.daily_drawer_sections:checked').each(function() {
		sections.push(""+$(this).val()+"");
	});

	sections = encodeURIComponent(sections);

	window.location = base_url+'daily_drawers/daily_drawer_processes/create?in_purity='+in_purity+'&sections='+sections;
}
function get_cz_section_and_refresh_page() {
	var sections = [];
	var in_purity = $('select[name*="in_purity"]').val();
  
	$('.cz_sections:checked').each(function() {
		sections.push(""+$(this).val()+"");
	});

	sections = encodeURIComponent(sections);

	window.location = base_url+'daily_drawers/cz_processes/create?in_purity='+in_purity+'&sections='+sections;
}
function get_hold_section_and_refresh_page() {
	var sections = [];
	var in_purity = $('select[name*="in_purity"]').val();
	window.location = base_url+'daily_drawers/daily_drawer_hold_processes/create?in_purity='+in_purity;
}



function on_click_hold_process_id_calculate_in_weight(){
	$('.daily_drawer_wastage_hold_process_id').click(function(){
		calculate_hold_in_weight();
	});
}

function onclick_daily_drawer_select_all_check_all_checkboxes(){
  $('.daily_drawer_wastage_select_all').click(function(){
    check_daily_drawer_wastage_all_checkboxes();   
  })
}function onclick_cz_select_all_check_all_checkboxes(){
  $('.cz_wastage_select_all').click(function(){
    check_cz_wastage_all_checkboxes();   
  })
}

function check_daily_drawer_wastage_all_checkboxes() {
  $('.daily_drawer_wastage_process_id').each(function() {
    $(this).prop("checked", true);
  });
  calculate_in_weight();
}function check_cz_wastage_all_checkboxes() {
  $('.cz_wastage_process_id').each(function() {
    $(this).prop("checked", true);
  });
  calculate_cz_in_weight();
}
function onclick_daily_drawer_hold_select_all_check_all_checkboxes(){
  $('.daily_drawer_wastage_hold_select_all').click(function(){
    check_daily_drawer_wastage_hold_all_checkboxes();   
  })
}

function check_daily_drawer_wastage_hold_all_checkboxes() {
  $('.daily_drawer_wastage_hold_process_id').each(function() {
    $(this).prop("checked", true);
  });
  calculate_hold_in_weight();
}

function calculate_in_weight(){
	var total_in_weight = 0;
	$('.daily_drawer_wastage_process_id:checked').each(function() {
		total_in_weight = total_in_weight + parseFloat($(this).closest("tr").find(".balance_daily_drawer_wastage").text());
	});
	set_daily_drawer_process_field_value('daily_drawer_in_weight',total_in_weight);
}function calculate_cz_in_weight(){
	var total_in_weight = 0;
	$('.cz_wastage_process_id:checked').each(function() {
		total_in_weight = total_in_weight + parseFloat($(this).closest("tr").find(".balance_cz_wastage").text());
	});
	set_daily_drawer_process_field_value('cz_in_weight',total_in_weight);
}
function calculate_hold_in_weight(){
	var total_in_weight = 0;
	$('.daily_drawer_wastage_hold_process_id:checked').each(function() {
		total_in_weight = total_in_weight + parseFloat($(this).closest("tr").find(".balance_hold_daily_drawer_wastage").text());
	});
	set_daily_drawer_process_field_value('daily_drawer_hold_in_weight',total_in_weight);
}

function set_daily_drawer_process_field_value(field_name, value) {
	$("."+field_name+"").val(value);
}

