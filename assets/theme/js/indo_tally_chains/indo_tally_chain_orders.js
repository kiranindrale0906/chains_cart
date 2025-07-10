$(function(){
  $('select[name="indo_tally_chain_bom_settings[code]"]').on('change', function() {
    var code = $(this).val();
    ajax_get_request(base_url+'indo_tally_chains/indo_tally_chain_bom_settings?code='+code,'');
  });

  $('select[name="indo_tally_chain_bom_settings[melting]"]').on('change', function() {
    var code  = $('select[name="indo_tally_chain_bom_settings[code]"]').val();
    var melting = $(this).val();
    ajax_get_request(base_url+'indo_tally_chains/indo_tally_chain_bom_settings?code='+code+'&melting='+melting,'');
  });
});

function indo_tally_bom_set_varients_options(varients) {
  set_options(varients, 'select[name="indo_tally_chain_bom_settings[varient]"]');
}

function indo_tally_bom_set_meltings_options(meltings) {
  set_options(meltings, 'select[name="indo_tally_chain_bom_settings[melting]"]');
}

function set_options(options, field) {
  var _field = $(field);
  _field.html('');
  if(options != undefined){
    var option_html = '';
    $.each(options, function(index, option) {
      option_html += "<option value='"+option.id+"'>"+option.name+"</option>";
    });
    _field.append(option_html);
    _field.selectpicker('refresh');
  }
}