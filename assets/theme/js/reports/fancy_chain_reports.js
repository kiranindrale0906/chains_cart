function onload_fancy_chain_reports() {
  onchange_of_fancy_chain_report_karigar();
  onchange_of_fancy_chain_chain_making_report_purity();
  onchange_of_fancy_chain_fancy_hold_report_karigar();
  onchange_of_fancy_chain_fancy_hold_report_purity();
  onchange_of_fancy_chain_report_purity();
  onchange_of_fancy_chain_purity_closing();
}
function onchange_of_fancy_chain_report_karigar() {
  $("select[name='fancy_chain_chain_making_ledgers[karigar]']").on('change', function() {
    var karigar = $(this).val();
    window.location = base_url+ 'issue_and_receipts/fancy_chain_chain_making_ledgers/create?karigar='+karigar;
  });
}
function onchange_of_fancy_chain_chain_making_report_purity() {
  $("select[name='fancy_chain_chain_making_ledgers[in_lot_purity]']").on('change', function() {
    var in_lot_purity = $(this).val();
    var karigar = $("select[name='fancy_chain_chain_making_ledgers[karigar]']").val();
    window.location = base_url+ 'issue_and_receipts/fancy_chain_chain_making_ledgers/create?karigar='+karigar+'&in_purity='+in_lot_purity;
  });
}function onchange_of_fancy_chain_fancy_hold_report_karigar() {
  $("select[name='fancy_chain_fancy_hold_ledgers[karigar]']").on('change', function() {
    var karigar = $(this).val();
    window.location = base_url+ 'issue_and_receipts/fancy_chain_fancy_hold_ledgers/create?karigar='+karigar;
  });
}
function onchange_of_fancy_chain_fancy_hold_report_purity() {
  $("select[name='fancy_chain_fancy_hold_ledgers[in_lot_purity]']").on('change', function() {
    var in_lot_purity = $(this).val();
    var karigar = $("select[name='fancy_chain_fancy_hold_ledgers[karigar]']").val();
    window.location = base_url+ 'issue_and_receipts/fancy_chain_fancy_hold_ledgers/create?karigar='+karigar+'&in_purity='+in_lot_purity;
  });
}
function onchange_of_fancy_chain_report_purity() {
  $("select[name='fancy_chain_ledgers[in_lot_purity]']").on('change', function() {
    var in_lot_purity = $(this).val();
    window.location = base_url+ 'issue_and_receipts/fancy_chain_ledgers/create?in_purity='+in_lot_purity;
  });
}
function onchange_of_fancy_chain_purity_closing() {
  $("select[name='fancy_chain_closing_reports[in_lot_purity]']").on('change', function() {
    var in_lot_purity = $(this).val();
    window.location = base_url+ 'reports/fancy_chain_closing_reports?in_purity='+in_lot_purity;
  });
}