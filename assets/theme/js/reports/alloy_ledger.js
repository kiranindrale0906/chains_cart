function onload_alloy_reports() {
  onchange_of_alloy_name();
}
function onchange_of_alloy_name() {
  $("select[name='alloy_ledgers[alloy_name]']").on('change', function() {
    var alloy_name = $(this).val();
    window.location = base_url+ 'issue_and_receipts/alloy_ledgers/create?alloy_name='+alloy_name;
  });
}