$(function(){
  $('select[name="choco_chain_bom_settings[type]"]').on('change', function() {
    var type = $(this).val();
    ajax_get_request(base_url+'choco_chains/choco_chain_bom_settings?type='+type,'');
  });

  $('select[name="choco_chain_bom_settings[chain]"]').on('change', function() {
    var type  = $('select[name="choco_chain_bom_settings[type]"]').val();
    var chain = $(this).val();
    ajax_get_request(base_url+'choco_chains/choco_chain_bom_settings?type='+type+'&chain='+chain,'');
  });

});

function choco_bom_set_chains_options(chains) {
  set_options(chains, 'select[name="choco_chain_bom_settings[chain]"]');
}

function choco_bom_set_meltings_options(meltings) {
  set_options(meltings, 'select[name="choco_chain_bom_settings[melting]"]');
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