function onload_melting_lot_loss() {
  onchange_of_process_name_get_melting_lot_loss_records();
}

function onchange_of_process_name_get_melting_lot_loss_records() {
  $("select[name='melting_lot_process_name']").on('change', function() {
    var process_name = $("select[name='melting_lot_process_name']").val();
    window.location = base_url+ 'lot_loss/lot_loss?product_name='+process_name;
  });
}