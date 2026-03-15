// $('select[name*="ka_chain_order_details[category_one]"]').change(function(){
//   var category_one = $(this).val();
//   ajax_get_request(base_url+'ka_chains/ka_chain_order_details?category_one='+category_one);
  
// });
$('.autocomplete_market_design_name').keyup(function(){
  on_keyup_market_design_name();
});
// function set_category_three_for_order_options(category_three) {
//   set_options(category_three, '#category_three');
// }


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

$('select[name*="ka_chain_factory_orders[category_name]"]').change(function(){
  var category_name = $(this).val();
  ajax_get_request(base_url+'ka_chains/ka_chain_factory_orders?category_name='+category_name);
  
});
$('select[name*="ka_chain_factory_orders[design_name]"]').change(function(){
  var design_name = $(this).val();
  var category_name = $('select[name*="ka_chain_factory_orders[category_name]"]').find(":selected").val();
  ajax_get_request(base_url+'ka_chains/ka_chain_factory_orders?category_name='+category_name+'&design_name='+design_name);
  
});

$('select[name*="ka_chain_order_details[category_one]"]').change(function(){
  var category_one = $(this).val();
  var order_type = $('input[name*="order_type"]').val();
  ajax_get_request(base_url+'ka_chains/ka_chain_order_details?type=1&category_one='+category_one+'&order_type='+order_type);
  
});
$('select[name*="ka_chain_market_order_details[category_name]"]').change(function(){
  var category_one = $(this).val();
  var order_id = $('input[name*="ka_chain_market_order_details[order_id]"]').val();
  var machine_size = $('select[name*="ka_chain_market_order_details[machine_size]"]').val();
  var design_name = $('select[name*="ka_chain_market_order_details[design_name]"]').val();
  if(category_one!="" && category_one!='undefined'){
    category_one="&category_name="+category_one;
  }if(machine_size!="" && machine_size!='undefined'){
    machine_size="&machine_size="+machine_size;
  }if(design_name!="" && design_name!='undefined'){
    design_name="&design_name="+design_name;
  }
  window.location=base_url+'ka_chains/ka_chain_market_order_details/create?order_id='+order_id+category_one+machine_size+design_name;
});$('select[name*="ka_chain_market_order_details[machine_size]"]').change(function(){
  var machine_size = $(this).val();
  var order_id = $('input[name*="ka_chain_market_order_details[order_id]"]').val();
  var category_one = $('select[name*="ka_chain_market_order_details[category_name]"]').val();
  var design_name = $('select[name*="ka_chain_market_order_details[design_name]"]').val();
  if(category_one!="" && category_one!='undefined'){
    category_one="&category_name="+category_one;
  }if(machine_size!="" && machine_size!='undefined'){
    machine_size="&machine_size="+machine_size;
  }if(design_name!="" && design_name!='undefined'){
    design_name="&design_name="+design_name;
  }
  window.location=base_url+'ka_chains/ka_chain_market_order_details/create?order_id='+order_id+category_one+machine_size+design_name;
});$('select[name*="ka_chain_market_order_details[design_name]"]').change(function(){
  var design_name = $(this).val();
  var order_id = $('input[name*="ka_chain_market_order_details[order_id]"]').val();
  var machine_size = $('select[name*="ka_chain_market_order_details[machine_size]"]').val();
  var category_one = $('select[name*="ka_chain_market_order_details[category_name]"]').val();
  if(category_one!="" && category_one!='undefined'){
    category_one="&category_name="+category_one;
  }if(machine_size!="" && machine_size!='undefined'){
    machine_size="&machine_size="+machine_size;
  }if(design_name!="" && design_name!='undefined'){
    design_name="&design_name="+design_name;
  }
  window.location=base_url+'ka_chains/ka_chain_market_order_details/create?order_id='+order_id+category_one+machine_size+design_name;
});
$('select[name*="ka_chain_order_details[category_three]"]').change(function(){
  var category_three = $(this).val();
  var order_type = $('input[name*="order_type').val();
  var category_one = $('select[name*="ka_chain_order_details[category_one]"]').find(":selected").val();
  ajax_get_request(base_url+'ka_chains/ka_chain_order_details?type=1&category_one='+category_one+'&category_three='+category_three+'&order_type='+order_type);
  
});
function set_design_name_for_order_options(design_name) {
  set_options(design_name, '#category_four');
}
function set_gauge_for_order_options(gauge) {
  set_options(gauge, '#category_three');
}
function on_change_market_design_name(index){
  $('input[name*="ka_chain_factory_order_details['+index+'][market_design_name]"]').autocomplete({
    source: function (request, response) {
      jQuery.get(base_url+'ka_chains/ka_chain_factory_order_details/index', {
        query: request.term
      }, function (data) {
        response(JSON.parse(data));
      });
    },
    minLength: 1
  });
}
function on_change_bunch_market_design_name(index){
  $('input[name*="ka_chain_bunch_order_details['+index+'][market_design_name]"]').autocomplete({
    source: function (request, response) {
      jQuery.get(base_url+'ka_chains/ka_chain_factory_order_details/index', {
        query: request.term
      }, function (data) {
        response(JSON.parse(data));
      });
    },
    select: function (event, ui) {
        onselect_market_design_name_get_per_inch(ui.item.value,index);
    },
    minLength: 1
  });
}

function on_keyup_market_design_name(){
  $('.autocomplete_market_design_name').autocomplete({
    source: function (request, response) {
      jQuery.get(base_url+'ka_chains/ka_chain_factory_order_details/index', {
        query: request.term
      }, function (data) {
        response(JSON.parse(data));
      });
    },
    select: function (event, ui) {
        onselect_market_design_name(ui.item.value);
    },
    minLength: 1
  });
}

function onselect_market_design_name(market_design_name){
  window.location= base_url+'ka_chains/ka_chain_factory_pending_orders/create?market_design_name='+market_design_name;
}
$('select[name*="ka_chain_factory_pending_orders[market_design_name]"]').change(function(){
  var market_design_name = $(this).val();
  window.location= base_url+'ka_chains/ka_chain_factory_pending_orders/create?market_design_name='+market_design_name;
});
$('select[name*="ka_chain_bunch_pending_orders[market_design_name]"]').change(function(){
  var market_design_name = $(this).val();
  window.location= base_url+'ka_chains/ka_chain_bunch_pending_orders/create?market_design_name='+market_design_name;
});


$('.process_factory_order_detail_select_all').click(function(){
  check_pending_ghiss_issue_all_checkboxes();   
});

function check_pending_ghiss_issue_all_checkboxes() {
  $('.factory_order_detail_id').each(function() {
    $(this).prop("checked", true);
  });
  // calculate_pending_ghiss_issue_in_weight();
}
function on_select_factory_order(index,parent_id,process_id){
  window.location=base_url+'processes/process_factory_order_hook_details/create?order_id='+index+'&parent_id='+parent_id+'&process_id='+process_id;
}

$('.get_factory_order').click(function(){
  var category_one = $('select[name*="ka_chain_order_details[category_one]"]').find(":selected").val();
  var category_three = $('select[name*="ka_chain_order_details[category_three]"]').find(":selected").val();
  var category_four = $('select[name*="ka_chain_order_details[category_four]"]').find(":selected").val();
  var customer_name = $('select[name*="ka_chain_order_details[customer_name]"]').find(":selected").val();
  var order_type = $('input[name*="order_type"]').val();

  ajax_get_request(base_url+'ka_chains/ka_chain_order_details?type=2&category_name='+category_one+'&machine_size='+category_three+'&design_name='+category_four+'&customer_name='+customer_name+'&order_type='+order_type);
  
});
function set_html_data(html){
  $("#apend_html").html(html);

}
function onselect_market_design_name_get_per_inch(market_design_name,index){
  ajax_get_request(base_url+'ka_chains/ka_chain_bunch_order_details/index?market_design_name='+market_design_name+'&index='+index);
  
}
function set_per_inch_weight_for_order_options(per_inch_weight,index) {
  $('#per_inch_weight_'+index).val(per_inch_weight);
}

function onchange_bunch_length(index,$this) {
  $(".bunch_length").keyup(function() {
  per_inch_weight=$('#per_inch_weight_'+index).val();
  bunch_length = $(this).val();
  estimate_weight=per_inch_weight*bunch_length;
  $('#estimate_bunch_weight_'+index).val(estimate_weight);
  });
}


$(document).on('click','.del_order_melting_lot_details',function(){
    var url = $(this).attr('del_url');
    let text = "Are You Sure?";
    if (confirm(text) == true) {
        window.location.href = url;
    } 
});

