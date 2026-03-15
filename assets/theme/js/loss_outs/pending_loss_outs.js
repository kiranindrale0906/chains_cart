function onload_pending_loss_outs() {
  onchange_process_name_get_tar_chain_processes();
  on_click_process_id_calculate_pending_loss_weight();
  onclick_pending_loss_outs_select_all_check_all_checkboxes();
}

function onchange_process_name_get_tar_chain_processes() {
  $('select[name*="pending_loss_outs[process_name]"]').on('change', function() {
    var process_name = $(this).val(); 
    window.location = base_url+ 'loss_outs/pending_loss_outs/create?process_name='+process_name;  
  })
}

function on_click_process_id_calculate_pending_loss_weight(){
  $('.pending_loss_out_process_id').click(function(){
    calculate_pending_loss_weight();
  });
}

function onclick_pending_loss_outs_select_all_check_all_checkboxes(){
  $('.pending_loss_out_select_all').click(function(){
    check_pending_loss_outs_all_checkboxes();   
  })
}

function check_pending_loss_outs_all_checkboxes() {
  $('.pending_loss_out_process_id').each(function() {
    $(this).prop("checked", true);
  });
  calculate_pending_loss_weight();
}

function calculate_pending_loss_weight(){
  var total_pending_loss = 0;
  var total_daily_drawer_wastage = 0;
  $('.pending_loss_out_process_id:checked').each(function() {
    total_daily_drawer_wastage = total_daily_drawer_wastage + parseFloat($(this).closest("tr").find(".daily_drawer_wastage").text());
    total_pending_loss         = total_pending_loss         + parseFloat($(this).closest("tr").find(".pending_loss").text());
  });
  set_hook_in_field_value('in_weight', total_pending_loss.toFixed(4));
}

function set_hook_in_field_value(field_name, value) {
  $("."+field_name+"").val(value);
}