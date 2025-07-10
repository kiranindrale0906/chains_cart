$(function(){
  $("#chain_name").on('change', function() {
    var chain_name = $(this).val();
    ajax_get_request(base_url+'round_box_chains/round_box_chain_bom_settings?chain_name='+chain_name);
  });
});

function rbc_orders_set_meltings_options(meltings) {
  set_options(meltings, '#melting');
}

function set_options(options, field) {
  var _field = $(field);
  _field.html('');
  if(options != undefined){
    var option_html = '';
    $.each(options, function(index, option) {
      option_html += "<option value="+option.id+">"+option.name+"</option>";
    });
    _field.append(option_html);
    _field.selectpicker('refresh');
  }
}