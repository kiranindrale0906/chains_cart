function onload_melting_wastage_refine_out_processes() {
	on_click_melting_wastage_refine_out_process_id_calculate_in_weight();
	onclick_melting_wastage_refine_out_select_all_check_all_checkboxes();
}

function on_click_melting_wastage_refine_out_process_id_calculate_in_weight(){
	$('.melting_wastage_refine_out_process_id').click(function(){
		calculate_melting_wastage_refine_out_in_weight();
	});
}

function onclick_melting_wastage_refine_out_select_all_check_all_checkboxes(){
  $('.melting_wastage_refine_out_select_all').click(function(){
    check_melting_wastage_refine_out_all_checkboxes();   
  })
}

function check_melting_wastage_refine_out_all_checkboxes() {
  $('.melting_wastage_refine_out_process_id').each(function() {
    $(this).prop("checked", true);
  });
  calculate_melting_wastage_refine_out_in_weight();
}

function calculate_melting_wastage_refine_out_in_weight(){
	var total_in_weight = 0;
	$('.melting_wastage_refine_out_process_id:checked').each(function() {
		total_in_weight = total_in_weight + parseFloat($(this).closest("tr").find(".balance_melting_wastage").text());
	});
	set_melting_wastage_refine_out_process_field_value('melting_wastage_refine_out_in_weight',total_in_weight);
}

function set_melting_wastage_refine_out_process_field_value(field_name, value) {
	$("."+field_name+"").val((value).toFixed(4));
}