$(function() {
  $(".parent_order_field").on('change', function() {
  var person_name = $('input[name="parent_orders[person_name]"]').val();
  var chain_name  = $('select[name="parent_orders[chain_name]"]').val();
  var melting     = $('select[name="parent_orders[melting]"]').val();
  var id          = $('input[name="parent_orders[id]"]').val();
  if(person_name != '' && chain_name != '' && melting != '') {
    var url = base_url+'parent_orders/parent_orders?person_name='+person_name+'&chain_name='+chain_name+'&melting='+melting;
    if(id != undefined) {
      url += '&id='+id;
    }
    ajax_get_request(url,'');
  }
  });
});

function set_parent_order_name(name) {
  $('input[name="parent_orders[name]"]').val(name);
}