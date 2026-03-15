function onload_solder_wastage_processes() {
  on_click_solder_wastage_process_id_calculate_in_weight();
  onclick_solder_wastage_select_all_check_all_checkboxes();
}

function on_click_solder_wastage_process_id_calculate_in_weight(){
  $('.solder_wastage_out_process_id').click(function(){
    calculate_solder_wastage_out_in_weight();
  });
}

function onclick_solder_wastage_select_all_check_all_checkboxes(){
  $('.solder_wastage_out_select_all').click(function(){
    check_solder_wastage_out_all_checkboxes();   
  })
}

function check_solder_wastage_out_all_checkboxes() {
  $('.solder_wastage_out_process_id').each(function() {
    $(this).prop("checked", true);
  });
  calculate_solder_wastage_out_in_weight();
}

function calculate_solder_wastage_out_in_weight(){
  var total_in_weight = 0;
  $('.solder_wastage_out_process_id:checked').each(function() {
    total_in_weight = total_in_weight + parseFloat($(this).closest("tr").find(".balance_solder_wastage_out").text());
  });
  set_solder_wastage_process_field_value('solder_wastage_in_weight',total_in_weight);
}

function set_solder_wastage_process_field_value(field_name, value) {
  $("."+field_name+"").val((value).toFixed(4));
}

