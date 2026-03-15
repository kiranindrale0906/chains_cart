function onload_hcl_ghiss_process() {
  //onchange_of_lot_no();
  onchange_of_hcl_ghiss_processes_process_name_set_lot_nos();
//  onchange_hcl_ghiss_processes_process_name_show_hide_fields();
  //onchange_of_lot_no();
  on_click_hcl_ghiss_process_id_calculate_in_weight()
  onclick_hcl_ghiss_select_all_check_all_checkboxes();
}

function onchange_of_hcl_ghiss_processes_process_name_set_lot_nos() {
  $("select[name*='hcl_ghiss_processes[process_name]']").on('change', function() {
    var process_name = $("select[name*='hcl_ghiss_processes[process_name]']").val();
    window.location = base_url+ 'hcl_ghiss/hcl_ghiss_processes/create?process_name='+process_name;
  });
}

/*function onchange_of_process_name_set_lot_nos(){
  $("select[name*='hcl_processes[process_name]']").on('change', function() {
    var process_name = $(this).val();
    ajax_get_request(base_url+'hcl/hcl_processes/create?process_name='+process_name);
  });
}

function onchange_of_lot_no(){
  $("select[name*='hcl_processes[melting_lot_id]']").on('change', function() {
    var process_name = $("select[name*='hcl_processes[process_name]']").val();
    var lot_no = $(this).val();
    window.location = base_url+ 'hcl/hcl_processes/create?process_name='+process_name+'&lot_no='+lot_no;
  });
}*/

function on_click_hcl_ghiss_process_id_calculate_in_weight(){
  $('.hcl_ghiss_process_id').click(function(){
    calculate_hcl_ghiss_in_weight();
  });
}

function onclick_hcl_ghiss_select_all_check_all_checkboxes(){
  $('.hcl_ghiss_select_all').click(function(){
    check_hcl_ghiss_all_checkboxes();   
  })
}

function check_hcl_ghiss_all_checkboxes() {
  $('.hcl_ghiss_process_id').each(function() {
    $(this).prop("checked", true);
  });
  calculate_hcl_ghiss_in_weight();
}

function calculate_hcl_ghiss_in_weight(){
  var total_in_weight = 0;
  $('.hcl_ghiss_process_id:checked').each(function() {
    total_in_weight = total_in_weight + parseFloat($(this).closest("tr").find(".balance_hcl_ghiss").text());
  });
  set_hcl_ghiss_process_field_value('hcl_ghiss_in_weight',total_in_weight.toFixed(4));
}

function set_hcl_ghiss_process_field_value(field_name, value) {
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


function set_lots_select_options(data) {
  $("select[name*='hcl_ghiss_processes[melting_lot_id]'] option").remove();
    $.each(data.lot_nos, function(index, lot_name) {
      var option_html = '<option value="'+lot_name.id+'">'+lot_name.name +'</option>';
      $("select[name*='hcl_ghiss_processes[melting_lot_id]']").append(option_html);
    })
   
    if(data.lot_nos.length==0){
      var option_html = '<option value="">No Record Found.</option>';
      $("select[name*='hcl_ghiss_processes[melting_lot_id]']").append(option_html);
    }
  $("select[name*='hcl_ghiss_processes[melting_lot_id]']").selectpicker('refresh');
}
