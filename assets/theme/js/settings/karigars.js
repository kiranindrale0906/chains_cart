
// function onload_karigar_process() {
//   onchange_of_product_name_set_process_name();
//   onchange_of_process_name_set_deparment_name();
// }

// function onchange_of_product_name_set_process_name() {
//   $("select[name*='same_karigars[product_name]']").on('change', function() {
//     var product_name = $("select[name*='same_karigars[product_name]']").val();
//     window.location = base_url+ 'settings/same_karigars/create?product_name='+product_name;
//   });
// }
// function onchange_of_process_name_set_deparment_name() {
//   $("select[name*='same_karigars[process_name]']").on('change', function() {
//     var product_name = $("select[name*='same_karigars[product_name]']").val();
//     var process_name = $("select[name*='same_karigars[process_name]']").val();
//     window.location = base_url+ 'settings/same_karigars/create?product_name='+product_name+'&process_name='+process_name;
//   });
// }


$(".onchane_process_name").change(function(e){
  var value = $(this).val();
  window.location = base_url+'settings/alloy_details/create?process_name='+value;
});


