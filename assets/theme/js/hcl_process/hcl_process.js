function onload_hcl_process() {
  onchange_of_hcl_processes_process_name_set_parent_lot_nos();
  onchange_of_parent_lot_no_set_lot_nos();
  onchange_of_lot_no();
  onchange_hcl_processes_process_name_show_hide_fields()
  set_hcl_form_fields()
  on_click_hcl_process_id_calculate_in_weight();
  onclick_hcl_select_all_check_all_checkboxes();
  
}

function onchange_of_hcl_processes_process_name_set_parent_lot_nos() {
  $("select[name*='hcl_processes[process_name]']").on('change', function() {
    var process_name = $("select[name*='hcl_processes[process_name]']").val();
    window.location = base_url+ 'hcl/hcl_processes/create?process_name='+process_name;
  });
}

function onchange_of_parent_lot_no_set_lot_nos() {
  $("select[name*='hcl_processes[parent_lot_id]']").on('change', function() {
    var parent_lot_id = $("select[name*='hcl_processes[parent_lot_id]']").val();
    var process_name = $('select[name*="hcl_processes[process_name]"] option:selected').val();
    window.location = base_url+ 'hcl/hcl_processes/create?process_name='+process_name+'&parent_lot_id='+parent_lot_id;
  });
}

/*function onchange_of_process_name_set_lot_nos(){
  $("select[name*='hcl_processes[process_name]']").on('change', function() {
    var process_name = $(this).val();
    ajax_get_request(base_url+'hcl/hcl_processes/create?process_name='+process_name);
  });
}*/

function onchange_of_lot_no(){
  $("select[name*='hcl_processes[melting_lot_id]']").on('change', function() {
    var process_name = $("select[name*='hcl_processes[process_name]']").val();
    var melting_lot_id = $(this).val();
    window.location = base_url+ 'hcl/hcl_processes/create?process_name='+process_name+'&melting_lot_id='+melting_lot_id;
  });
}


function set_hcl_form_fields() {
  var process_name = $('select[name*="hcl_processes[process_name]"] option:selected').val();
  if (process_name != '' && process_name != undefined) {
    onchange_process_name_set_parent_lots();
    onchange_process_name_set_lots();
  }
  
}

function on_click_hcl_process_id_calculate_in_weight(){
  $('.hcl_wastage_process_id').click(function(){
    calculate_hcl_in_weight();
  });
}

function onclick_hcl_select_all_check_all_checkboxes(){
  $('.hcl_wastage_select_all').click(function(){
    check_hcl_wastage_all_checkboxes();   
  })
}

function check_hcl_wastage_all_checkboxes() {
  $('.hcl_wastage_process_id').each(function() {
    $(this).prop("checked", true);
  });
  calculate_hcl_in_weight();
}

function calculate_hcl_in_weight(){
  var total_in_weight = 0;
  $('.hcl_wastage_process_id:checked').each(function() {
    total_in_weight = total_in_weight + parseFloat($(this).closest("tr").find(".balance_hcl_wastage").text());
  });
  set_hcl_process_field_value('hcl_in_weight',total_in_weight.toFixed(4));
}

function set_hcl_process_field_value(field_name, value) {
  $("."+field_name+"").val(value);
}


/*function append_in_weight(response) {
  $("input[name*='in_weight']").val(response);
}

$(".hcl_melting_lot_id").change(function () {
  var lots=$(".hcl_melting_lot_id option:selected").val();
  var formData = new FormData();
  formData.append('melting_lot_id',lots);
  ajax_post_request(base_url+'hcl/hcl_processes/view/1?hcl_process=1',formData);
});


function append_hcl_in_weight(response) {
  $("input[name*='in_weight']").val(response);
}

$(document).delegate("select[name*='hcl_processes[process_name]']", "change", function(){
  var chain_name=$("select[name*='hcl_processes[process_name]']").val();
  var formData = new FormData();
  formData.append('product_name',chain_name);
  ajax_post_request(base_url+'hcl/hcl_processes/create?chain_name=1',formData);

});*/


// function set_lots_select_options(data) {
//   $("select[name*='hcl_processes[melting_lot_id]'] option").remove();
//     $.each(data.lot_nos, function(index, lot_name) {
//       var option_html = '<option value="'+lot_name.id+'">'+lot_name.name +'</option>';
//       $("select[name*='hcl_processes[melting_lot_id]']").append(option_html);
//     })
   
//     if(data.lot_nos.length==0){
//       var option_html = '<option value="">No Record Found.</option>';
//       $("select[name*='hcl_processes[melting_lot_id]']").append(option_html);
//     }
//   $("select[name*='hcl_processes[melting_lot_id]']").selectpicker('refresh');
// }

function onchange_process_name_set_parent_lots() {
  var process_name = $('select[name*="hcl_processes[process_name]"] option:selected').val();
  $.ajax({
      type : 'POST',
      url : base_url+'hcl/hcl_processes/view/1?type=1&process_name='+process_name,
      dataType: 'JSON',
      success: function(response) {
       hcl_parent_lot_options(response);
      }
  });
}

function hcl_parent_lot_options(response) {
  $("select[name*='hcl_processes[parent_lot_id]'] option").remove();
  var option_html="<option value=''>Select</option>";
  for (i=0; i < response.result.length; i++) {
    name = response.result[i].name;
    option_html += "<option data-subtext='' value="+response.result[i].id+">"+name+"</option>";
  }

  if(response.result.length==0){
    var option_html="<option value=''>No Record Found.</option>";
  }
  $("select[name*='hcl_processes[parent_lot_id]']").append(option_html);
  $("select[name*='hcl_processes[parent_lot_id]").selectpicker('refresh');

}

function onchange_process_name_set_lots() {
  var process_name = $('select[name*="hcl_processes[process_name]"] option:selected').val();
  $.ajax({
      type : 'POST',
      url : base_url+'hcl/hcl_processes/view/1?type=2&process_name='+process_name,
      dataType: 'JSON',
      success: function(response) {
       hcl_lot_options(response);
      }
  });
}

function hcl_lot_options(response) {
  var melting_lot_id = $("select[name*='hcl_processes[melting_lot_id]']").val();
  $("select[name*='hcl_processes[melting_lot_id]'] option").remove();
  var option_html="<option value=''>Select</option>";
  for (i=0; i < response.result.length; i++) {
    name = response.result[i].name;
    option_html += "<option data-subtext='' value="+response.result[i].id+">"+name+"</option>";
  }

  if(response.result.length==0){
    var option_html="<option value=''>No Record Found.</option>";
  }
  $("select[name*='hcl_processes[melting_lot_id]']").append(option_html);
  $("select[name*='hcl_processes[melting_lot_id]").selectpicker('refresh');

}

function onchange_hcl_processes_process_name_show_hide_fields(){
  var process_name = $('select[name*="hcl_processes[process_name]"] option:selected').val();
 
  if (   process_name == 'Indo tally Chain' 
      || process_name == 'Rope Chain' 
      || process_name == 'Machine Chain' 
      || process_name == 'Hollow Choco Chain'
      || process_name == 'Hollow Bangle Chain'
      || process_name == 'Imp Italy Chain'
      || process_name == 'Lotus Chain'
      || process_name == 'Office Outside') {
    $(".hcl_parent_lots").show();
    $(".hcl_lots").hide();
   } else {
    $(".hcl_parent_lots").hide();
    $(".hcl_lots").show();
  }
}