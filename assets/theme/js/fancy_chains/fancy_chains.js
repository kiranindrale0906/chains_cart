function delete_fancy_chain_design_chain(index) {
  $("input[name*='fancy_chain_design_chains["+index+"][delete]']").val(1);
  $("tr.fancy_chain_design_chains_"+index).remove();
}

function delete_fancy_chain_design_accessories(index) {
  $("input[name*='fancy_chain_design_accessories["+index+"][delete]']").val(1);
  $("tr.fancy_chain_design_accessories_"+index).remove();
}

function delete_fancy_chain_order_details(index) {
  $("input[name*='fancy_chain_order_details["+index+"][delete]']").val(1);
  $("tr.fancy_chain_order_details_"+index).remove();
}