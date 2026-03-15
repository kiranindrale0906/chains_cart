function onload_dd_wastage_category_process() {
  onchange_of_product_name_set_process_name();
  onchange_of_process_name_set_deparment_name();
}

function onchange_of_product_name_set_process_name() {
  $("select[name*='daily_drawer_wastage_categories[product_name]']").on('change', function() {
    var product_name = $("select[name='daily_drawer_wastage_categories[product_name]']").val();
    window.location = base_url+ 'settings/daily_drawer_wastage_categories/create?product_name='+product_name;
  });
}
function onchange_of_process_name_set_deparment_name() {
  $("select[name*='daily_drawer_wastage_categories[process_name]']").on('change', function() {
    var product_name = $("select[name='daily_drawer_wastage_categories[product_name]']").val();
    var process_name = $("select[name='daily_drawer_wastage_categories[process_name]']").val();
    window.location = base_url+ 'settings/daily_drawer_wastage_categories/create?product_name='+product_name+'&process_name='+process_name;
  });
}
