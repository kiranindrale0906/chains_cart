function onload_pending_ghiss_issue_processes() {
	onchange_pending_ghiss_issue_department_name();
	on_click_pending_ghiss_issue_process_id_calculate_in_weight();
	onclick_pending_ghiss_issue_select_all_check_all_checkboxes();
}

function onchange_pending_ghiss_issue_department_name(){
	$('.pending_ghiss_issue_processes_department_name').on('change', function() {
		var department_name = $(this).val();	
		if(department_name!=''){
		window.location = base_url+'pending_ghiss_outs/pending_ghiss_issue_processes/create?department_name='+department_name;	
		}
	})
}

function on_click_pending_ghiss_issue_process_id_calculate_in_weight(){
	$('.pending_ghiss_issue_process_id').click(function(){
		calculate_pending_ghiss_issue_in_weight();
	});
}

function onclick_pending_ghiss_issue_select_all_check_all_checkboxes(){
  $('.pending_ghiss_issue_select_all').click(function(){
    check_pending_ghiss_issue_all_checkboxes();   
  })
}

function check_pending_ghiss_issue_all_checkboxes() {
  $('.pending_ghiss_issue_process_id').each(function() {
    $(this).prop("checked", true);
  });
  calculate_pending_ghiss_issue_in_weight();
}

function calculate_pending_ghiss_issue_in_weight(){
	var total_in_weight = 0;
	$('.pending_ghiss_issue_process_id:checked').each(function() {
		total_in_weight = total_in_weight + parseFloat($(this).closest("tr").find(".balance_pending_ghiss").text());
	});
	set_pending_ghiss_issue_process_field_value('pending_ghiss_issue_in_weight',total_in_weight);
}

function set_pending_ghiss_issue_process_field_value(field_name, value) {
	$("."+field_name+"").val((value).toFixed(4));
}



