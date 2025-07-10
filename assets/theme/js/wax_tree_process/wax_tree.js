function onload_wax_tree_processes() {
	onclick_wax_tree_select_all_check_all_checkboxes();
}
function onclick_wax_tree_select_all_check_all_checkboxes(){
  $('.wax_tree_select_all').click(function(){
    check_wax_tree_all_checkboxes();   
  })
}

function check_wax_tree_all_checkboxes() {
  $('.wax_tree_process_id').each(function() {
    $(this).prop("checked", true);
  });
}
$(".tree_gross_wt").on('keyup', function() {
   calculate_net_wt();
});
$(".tree_base_wt").on('keyup', function() {
   calculate_net_wt();
});
$(".stone_wt").on('keyup', function() {
   calculate_net_wt();
});


function calculate_net_wt() {
  var tree_gross_wt=$(".tree_gross_wt").val();
  var tree_base_wt=$(".tree_base_wt").val();
  var stone_wt = $(".stone_wt").val();
  // var gold_ratio = $(".gold_ratio").val();


  if(isNaN(tree_gross_wt)) tree_gross_wt=0;
  if(isNaN(tree_base_wt)) tree_base_wt=0;
  if(isNaN(stone_wt)) stone_wt=0;

  var net_wt = (parseFloat(tree_gross_wt) - parseFloat(tree_base_wt)- parseFloat(stone_wt));
  if(isNaN(net_wt)) net_wt=0;
  $(".tree_net_wt").val(net_wt.toFixed(4));

  // var total_required_gold = (parseFloat(net_wt) * parseFloat(gold_ratio));
  // if(isNaN(total_required_gold)) total_required_gold=0;
  // $(".total_required_gold").val(total_required_gold.toFixed(4));
}

