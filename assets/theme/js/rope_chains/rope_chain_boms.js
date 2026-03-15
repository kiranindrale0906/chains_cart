$(function(){
  $("#melting").on('change', function() {
    var melting = $(this).val();
    ajax_get_request(base_url+'rope_chains/rope_chain_bom_settings?melting='+melting,'');
  });

  $("#chain_code").on('change', function() {
    var melting    = $('#melting').val();
    var chain_code = $(this).val();
    ajax_get_request(base_url+'rope_chains/rope_chain_bom_settings?melting='+melting+'&chain_code='+chain_code,'');
  });

});

function set_chain_codes_options(chain_codes) {
  set_options(chain_codes, '#chain_code');
}

function set_varients_options(varients) {
  set_options(varients, '#varient');
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