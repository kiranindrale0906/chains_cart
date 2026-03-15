function onload_category_four_process() {
  onchange_of_product_name_set_category_one();
  onchange_of_product_name_hide_category();
}

function onchange_of_product_name_set_category_one() {
  $("select[name='category_fours[product_name]']").on('change', function() {
    var product_name = $("select[name='category_fours[product_name]']").val();
    window.location = base_url+ 'settings/category_fours/create?product_name='+product_name;
  });
}
function onchange_of_product_name_hide_category() {
  $("select[name='categories[product_name]']").on('change', function() {
    var product_name = $("select[name='categories[product_name]']").val();
    window.location = base_url+ 'settings/categories/create?product_name='+product_name;
  });
}
$('select[name*="item_code_masters[product_name]"]').on('change', function() {
    var product_name = $(this).val();
    window.location = base_url+'masters/item_code_masters/create?product_name='+product_name;  
  });