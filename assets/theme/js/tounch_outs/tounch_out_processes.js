function onload_tounch_out_processes() {
	on_click_tounch_out_process_id_calculate_in_weight();
	onclick_tounch_out_select_all_check_all_checkboxes();
}

function on_click_tounch_out_process_id_calculate_in_weight(){
	$('.tounch_out_process_id').click(function(){
		calculate_tounch_out_in_weight();
	});
}

function onclick_tounch_out_select_all_check_all_checkboxes(){
  $('.tounch_out_select_all').click(function(){
    check_tounch_out_all_checkboxes();   
  })
}

function check_tounch_out_all_checkboxes() {
  $('.tounch_out_process_id').each(function() {
    $(this).prop("checked", true);
  });
  calculate_tounch_out_in_weight();
}

function calculate_tounch_out_in_weight(){
	var total_in_weight = 0;
	$('.tounch_out_process_id:checked').each(function() {
		total_in_weight = total_in_weight + parseFloat($(this).closest("tr").find(".balance_tounch_out").text());
	});
	set_tounch_out_process_field_value('tounch_out_in_weight',total_in_weight);
}

function set_tounch_out_process_field_value(field_name, value) {
	$("."+field_name+"").val((value).toFixed(4));
}