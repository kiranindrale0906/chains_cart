function onload_rod_process() {
  on_click_rod_process_id_calculate_in_weight();
  onclick_rod_select_all_check_all_checkboxes();
  
}

function on_click_rod_process_id_calculate_in_weight(){
  $('.rod_process_id').click(function(){
    calculate_rod_in_weight();
  });
}

function onclick_rod_select_all_check_all_checkboxes(){
  $('.rod_select_all').click(function(){
    check_rod_all_checkboxes();   
  })
}

function check_rod_all_checkboxes() {
  $('.rod_process_id').each(function() {
    $(this).prop("checked", true);
  });
  calculate_rod_in_weight();
}

function calculate_rod_in_weight(){
  var total_in_weight = 0;
  $('.rod_process_id:checked').each(function() {
    total_in_weight = total_in_weight + parseFloat($(this).closest("tr").find(".out_rod").text());
  });
  set_rod_process_field_value('rod_in_weight',total_in_weight.toFixed(4));
}

function set_rod_process_field_value(field_name, value) {
  $("."+field_name+"").val(value);
}
$('select[name*="rod_ledgers[rods]"]').on('change', function() {
    var rod_id = $(this).val(); 
    window.location = base_url+ 'issue_and_receipts/rod_ledgers/create?rod_id='+rod_id;  
    
});