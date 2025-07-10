function onload_tounch_ghiss_out_processes() {
	onchange_tounch_ghiss_out_department_name();
	on_click_tounch_ghiss_out_process_id_calculate_in_weight();
	onclick_tounch_ghiss_out_select_all_check_all_checkboxes();
}

function onchange_tounch_ghiss_out_department_name(){
	$('.tounch_ghiss_melting_lots_department_name').on('change', function() {
		var department_name = $(this).val();	
		if(department_name!=''){
		window.location = base_url+'ghiss_outs/tounch_ghiss_out_processes/create?department_name='+department_name;	
		}
	})
}

function on_click_tounch_ghiss_out_process_id_calculate_in_weight(){
	$('.tounch_ghiss_out_process_id').click(function(){
		calculate_tounch_ghiss_out_in_weight();
	});
}

function onclick_tounch_ghiss_out_select_all_check_all_checkboxes(){
  $('.tounch_ghiss_out_select_all').click(function(){
    check_tounch_ghiss_out_all_checkboxes();   
  })
}

function check_tounch_ghiss_out_all_checkboxes() {
  $('.tounch_ghiss_out_process_id').each(function() {
    $(this).prop("checked", true);
  });
  calculate_tounch_ghiss_out_in_weight();
}

function calculate_tounch_ghiss_out_in_weight(){
	var total_in_weight = 0;
	$('.tounch_ghiss_out_process_id:checked').each(function() {
		total_in_weight = total_in_weight + parseFloat($(this).closest("tr").find(".balance_tounch_ghiss").text());
	});
	set_tounch_ghiss_out_process_field_value('tounch_ghiss_out_in_weight',total_in_weight);
}

function set_tounch_ghiss_out_process_field_value(field_name, value) {
	$("."+field_name+"").val((value).toFixed(4));
}

