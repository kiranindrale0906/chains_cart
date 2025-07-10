function onload_loss_percentage_process() {
  onchange_of_product_name_set_process_name();
  onchange_of_process_name_set_deparment_name();
  onchange_of_department_name_set_karigar_name();
}

function onchange_of_product_name_set_process_name() {
  $("select[name*='loss_percentages[product_name]']").on('change', function() {
    var product_name = $("select[name*='loss_percentages[product_name]']").val();
    window.location = base_url+ 'settings/loss_percentages/create?product_name='+product_name;
  });
}

function onchange_of_process_name_set_deparment_name() {
  var product_name = $("select[name*='loss_percentages[product_name]']").val();
  $("select[name*='loss_percentages[process_name]']").on('change', function() {
    var process_name = $("select[name*='loss_percentages[process_name]']").val();
    window.location = base_url+ 'settings/loss_percentages/create?product_name='+product_name+'&process_name='+process_name;
  });
}

function onchange_of_department_name_set_karigar_name() {
  var product_name = $("select[name*='loss_percentages[product_name]']").val();
  var process_name = $("select[name*='loss_percentages[process_name]']").val();
  $("select[name*='loss_percentages[department_name]']").on('change', function() {
    var department_name = $("select[name*='loss_percentages[department_name]']").val();
    window.location = base_url+ 'settings/loss_percentages/create?product_name='+product_name+'&process_name='+process_name+'&department_name='+department_name;
  });
}

// function onchange_of_process_name_set_deparment_name() {
//   $("select[name*='loss_percentages[process_name]']").on('change', function() {
//     var product_name = $("select[name*='loss_percentages[product_name]']").val();
//     var process_name = $("select[name*='loss_percentages[process_name]']").val();
//     window.location = base_url+ 'settings/loss_percentages/create?product_name='+product_name+'&process_name='+process_name;
//   });
// }
