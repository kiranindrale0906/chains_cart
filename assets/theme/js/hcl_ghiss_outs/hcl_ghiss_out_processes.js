function onload_hcl_ghiss_out_processes() {
	onchange_melting_lot_department_name();
	onchange_hcl_ghiss_out_process_parent_name();
	onchange_hcl_ghiss_out_process_lot_name();
	on_click_hcl_ghiss_out_process_id_calculate_in_weight();
	onclick_hcl_ghiss_out_select_all_check_all_checkboxes();
}

function onchange_melting_lot_department_name(){
	$('select[name*="hcl_ghiss_out_chain_name"]').on('change', function() {
		var chain_name = $(this).val();	
		window.location = base_url+'hcl_ghiss_outs/hcl_ghiss_out_processes/create?chain_name='+chain_name;	
	})
}

function onchange_hcl_ghiss_out_process_parent_name(){
	$('select[name*="hcl_ghiss_out_parent_lot_name"]').on('change', function() {
		var chain_name = $('select[name*="hcl_ghiss_out_chain_name"]').val();
		var parent_lot_name = $(this).val();	
		window.location = base_url+'hcl_ghiss_outs/hcl_ghiss_out_processes/create?chain_name='+chain_name+'&&parent_lot_name='+parent_lot_name;	
	})
}

function onchange_hcl_ghiss_out_process_lot_name(){
	$('select[name*="hcl_ghiss_out_lot_name"]').on('change', function() {
		var chain_name = $('select[name*="hcl_ghiss_out_chain_name"]').val();
		var lot_name = $(this).val();	
		window.location = base_url+'hcl_ghiss_outs/hcl_ghiss_out_processes/create?chain_name='+chain_name+'&&lot_no='+lot_name;	
	})
}

function on_click_hcl_ghiss_out_process_id_calculate_in_weight(){
	$('.hcl_ghiss_out_process_id').click(function(){
		calculate_hcl_ghiss_out_in_weight();
	});
}

function onclick_hcl_ghiss_out_select_all_check_all_checkboxes(){
  $('.hcl_ghiss_out_select_all').click(function(){
    check_hcl_ghiss_out_all_checkboxes();   
  })
}

function check_hcl_ghiss_out_all_checkboxes() {
  $('.hcl_ghiss_out_process_id').each(function() {
    $(this).prop("checked", true);
  });
  calculate_hcl_ghiss_out_in_weight();
}

function calculate_hcl_ghiss_out_in_weight(){
	var total_in_weight = 0;
	$('.hcl_ghiss_out_process_id:checked').each(function() {
		total_in_weight = total_in_weight + parseFloat($(this).closest("tr").find(".balance_hcl_ghiss").text());
	});
	set_hcl_ghiss_out_process_field_value('hcl_ghiss_out_in_weight',total_in_weight);
}

function set_hcl_ghiss_out_process_field_value(field_name, value) {
	$("."+field_name+"").val((value).toFixed(4));
}

