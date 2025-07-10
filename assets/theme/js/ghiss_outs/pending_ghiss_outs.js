function onload_pending_ghiss_out_processes() {
	onchange_pending_ghiss_out_department_name();
	onchange_pending_ghiss_out_karigar_name();
	onchange_pending_ghiss_ledger_department_name();
	on_click_pending_ghiss_out_process_id_calculate_in_weight();
	onclick_pending_ghiss_out_select_all_check_all_checkboxes();
}

function onchange_pending_ghiss_out_department_name(){
	$('.pending_ghiss_out_processes_department_name').on('change', function() {
		var department_name = $(this).val();	
		if(department_name!=''){
		window.location = base_url+'pending_ghiss_outs/pending_ghiss_out_processes/create?department_name='+department_name;	
		}
	})
}
function onchange_pending_ghiss_out_karigar_name(){
	$('.pending_ghiss_out_processes_karigar_name').on('change', function() {
		var karigar_name = $('select[name*="pending_ghiss_out_processes[karigar]"]').val();
		var department_name = $('select[name*="pending_ghiss_out_processes[department_name]"]').val();
		if(department_name!=''){
		window.location = base_url+'pending_ghiss_outs/pending_ghiss_out_processes/create?department_name='+department_name+'&karigar='+karigar_name;	
		}
	})
}
function onchange_pending_ghiss_ledger_department_name(){
	$('.pending_ghiss_out_ledger_processes_department_name').on('change', function() {
		var department_name = $(this).val();	
		if(department_name!=''){
		window.location = base_url+'issue_and_receipts/pending_ghiss_ledgers/create?department_name='+department_name;	
		}
	})
}

function on_click_pending_ghiss_out_process_id_calculate_in_weight(){
	$('.pending_ghiss_out_process_id').click(function(){
		calculate_pending_ghiss_out_in_weight();
	});
}

function onclick_pending_ghiss_out_select_all_check_all_checkboxes(){
  $('.pending_ghiss_out_select_all').click(function(){
    check_pending_ghiss_out_all_checkboxes();   
  })
}

function check_pending_ghiss_out_all_checkboxes() {
  $('.pending_ghiss_out_process_id').each(function() {
    $(this).prop("checked", true);
  });
  calculate_pending_ghiss_out_in_weight();
}

function calculate_pending_ghiss_out_in_weight(){
	var total_in_weight = 0;
	$('.pending_ghiss_out_process_id:checked').each(function() {
		total_in_weight = total_in_weight + parseFloat($(this).closest("tr").find(".balance_pending_ghiss").text());
	});
	set_pending_ghiss_out_process_field_value('pending_ghiss_out_in_weight',total_in_weight);
}

function set_pending_ghiss_out_process_field_value(field_name, value) {
	$("."+field_name+"").val((value).toFixed(4));
}



