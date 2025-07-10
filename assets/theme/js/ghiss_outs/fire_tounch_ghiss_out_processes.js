function onload_fire_tounch_ghiss_out_processes() {
	onchange_fire_tounch_ghiss_out_department_name();
	on_click_fire_tounch_ghiss_out_process_id_calculate_in_weight();
	onclick_fire_tounch_ghiss_out_select_all_check_all_checkboxes();
}

function onchange_fire_tounch_ghiss_out_department_name(){
	$('.fire_tounch_ghiss_melting_lots_department_name').on('change', function() {
		var department_name = $(this).val();	
		if(department_name!=''){
		window.location = base_url+'ghiss_outs/fire_tounch_ghiss_out_processes/create?department_name='+department_name;	
		}
	})
}

function on_click_fire_tounch_ghiss_out_process_id_calculate_in_weight(){
	$('.fire_tounch_ghiss_out_process_id').click(function(){
		calculate_fire_tounch_ghiss_out_in_weight();
	});
}

function onclick_fire_tounch_ghiss_out_select_all_check_all_checkboxes(){
  $('.fire_tounch_ghiss_out_select_all').click(function(){
    check_fire_tounch_ghiss_out_all_checkboxes();   
  })
}

function check_fire_tounch_ghiss_out_all_checkboxes() {
  $('.fire_tounch_ghiss_out_process_id').each(function() {
    $(this).prop("checked", true);
  });
  calculate_fire_tounch_ghiss_out_in_weight();
}

function calculate_fire_tounch_ghiss_out_in_weight(){
	var total_in_weight = 0;
	$('.fire_tounch_ghiss_out_process_id:checked').each(function() {
		total_in_weight = total_in_weight + parseFloat($(this).closest("tr").find(".balance_fire_tounch_ghiss").text());
	});
	set_fire_tounch_ghiss_out_process_field_value('fire_tounch_ghiss_out_in_weight',total_in_weight);
}

function set_fire_tounch_ghiss_out_process_field_value(field_name, value) {
	$("."+field_name+"").val((value).toFixed(4));
}

