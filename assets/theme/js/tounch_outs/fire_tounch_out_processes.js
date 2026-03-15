function onload_fire_tounch_out_processes() {
	on_click_fire_tounch_out_process_id_calculate_in_weight();
	onclick_fire_tounch_out_select_all_check_all_checkboxes();
	onkey_fire_tounch_gross();
}

function on_click_fire_tounch_out_process_id_calculate_in_weight(){
	$('.fire_tounch_out_process_id').click(function(){
		calculate_fire_tounch_out_in_weight();
	});
}

function onclick_fire_tounch_out_select_all_check_all_checkboxes(){
  $('.fire_tounch_out_select_all').click(function(){
    check_fire_tounch_out_all_checkboxes();   
  })
}

function onkey_fire_tounch_gross(){
fire_tounch_in=parseFloat($('.fire_tounch_in').val());	
$('.fire_tounch_out,.fire_tounch_purity').on('input',function() {
	var fire_tounch_out = parseFloat($('.fire_tounch_out').val());
	var fire_tounch_purity = parseFloat($('.fire_tounch_purity').val());
	var fire_tounch_balance=fire_tounch_in-fire_tounch_out;
	$('.fire_tounch_gross').val((fire_tounch_balance*fire_tounch_purity/100).toFixed(4));
});
}

function check_fire_tounch_out_all_checkboxes() {
  $('.fire_tounch_out_process_id').each(function() {
    $(this).prop("checked", true);
  });
  calculate_fire_tounch_out_in_weight();
}

function calculate_fire_tounch_out_in_weight(){
	var total_in_weight = 0;
	$('.fire_tounch_out_process_id:checked').each(function() {
		total_in_weight = total_in_weight + parseFloat($(this).closest("tr").find(".balance_fire_tounch_out").text());
	});
	set_fire_tounch_out_process_field_value('fire_tounch_out_in_weight',total_in_weight);
}

function set_fire_tounch_out_process_field_value(field_name, value) {
	$("."+field_name+"").val((value).toFixed(4));
}



