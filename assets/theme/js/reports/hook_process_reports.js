function onload_hook_process_reports() {
  onchange_of_hook_report_process_name();
  onchange_of_hook_report_karigar();
  onchange_of_hook_report_purity();
}
function onchange_of_hook_report_process_name() {
  $("select[name='hook_process_ledgers[process_name]']").on('change', function() {
    var process_name = $(this).val();
    window.location = base_url+ 'issue_and_receipts/hook_process_ledgers/create?process_name='+process_name;
  });
}function onchange_of_hook_report_karigar() {
  $("select[name='hook_process_ledgers[karigar]']").on('change', function() {
    var karigar = $(this).val();
    var process_name = $("select[name='hook_process_ledgers[process_name]']").val();
    window.location = base_url+ 'issue_and_receipts/hook_process_ledgers/create?process_name='+process_name+'&karigar='+karigar;
  });
}
function onchange_of_hook_report_purity() {
  $("select[name='hook_process_ledgers[in_lot_purity]']").on('change', function() {
    var in_lot_purity = $(this).val();
    var process_name = $("select[name='hook_process_ledgers[process_name]']").val();
    var karigar = $("select[name='hook_process_ledgers[karigar]']").val();
    window.location = base_url+ 'issue_and_receipts/hook_process_ledgers/create?process_name='+process_name+'&karigar='+karigar+'&in_purity='+in_lot_purity;
  });
}