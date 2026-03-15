$("select[name*='issue_purities[chain_name]']").on('change', function() {
  var product_name = $(this).val();
  window.location = base_url+ 'settings/issue_purities/create?product_name='+product_name;
});
$("select[name*='issue_purities[category_one]']").on('change', function() {
  var product_name = $("select[name*='issue_purities[chain_name]']").val();
  var category_one = $(this).val();
  var category_one = category_one.replace(/\+/g, "^^");
  window.location = base_url+ 'settings/issue_purities/create?product_name='+product_name+'&category_one='+category_one;
});