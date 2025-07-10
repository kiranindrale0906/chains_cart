function onload_parent_lot_loss() {
  onchange_of_process_name_get_records();
}

function onchange_of_process_name_get_records() {
  $("select[name='parent_lot_process_name']").on('change', function() {
    var process_name = $("select[name='parent_lot_process_name']").val();
    if(process_name=='') var detail = '';
    else var detail = 'yes';
    window.location = base_url+ 'parent_lot_loss/parent_lot_loss?product_name='+process_name+'&detail='+detail;
  });
}