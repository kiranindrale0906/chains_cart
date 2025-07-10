function onload_chitties() {
  on_click_chitties_process_id_calculate_in_weight();
  onclick_chitties_select_all_check_all_checkboxes();
  
}

function on_click_chitties_process_id_calculate_in_weight(){
  $('.chitti_details_process_id').click(function(){
    calculate_chitties_in_weight();
  });
}

function onclick_chitties_select_all_check_all_checkboxes(){
  $('.chitties_select_all').click(function(){
    check_chitties_all_checkboxes();   
  })
}

function check_chitties_all_checkboxes() {
  $('.chitti_details_process_id').each(function() {
    $(this).prop("checked", true);
  });
  calculate_chitties_in_weight();
}

function calculate_chitties_in_weight(){
  var total_in_weight = 0;
  var total_wastage_fine = 0;
  var total_wastage_purity = 0;
  var out_purity = 0;
  $('.chitti_details_process_id:checked').each(function() {
    total_in_weight = total_in_weight + parseFloat($(this).closest("tr").find(".gross_weight").text());
    total_wastage_fine = total_wastage_fine + parseFloat($(this).closest("tr").find(".wastage_fine_detail").text());
    total_wastage_purity = total_wastage_purity + parseFloat($(this).closest("tr").find(".wastage_purity").text());
  });
  $lenght=$('.chitti_details_process_id:checked').length;
  out_purity=total_wastage_purity/$lenght;
  set_chitties_process_field_value('chitties_in_weight',total_in_weight.toFixed(4));
  set_chitties_process_field_value('wastage_fine',total_wastage_fine.toFixed(4));
  set_chitties_process_field_value('out_purity', out_purity.toFixed(4));
}

function set_chitties_process_field_value(field_name, value) {
  $("."+field_name+"").val(value);
}
$('select[name*="chitties[in_lot_purity]"]').on('change', function() {
    var in_lot_purity = $(this).val(); 
    var product_name = $('select[name*="chitties[product_name]"]').val(); 
    window.location = base_url+ 'chitties/chitties/create?product_name='+product_name+'&in_lot_purity='+in_lot_purity;  
    
});
$('select[name*="chitties[issue_chain_name]"]').on('change', function() {
    var issue_chain_name = $(this).val(); 
    var product_name = $('select[name*="chitties[product_name]"]').val(); 
    var in_lot_purity = $('select[name*="chitties[in_lot_purity]"]').val(); 
    window.location = base_url+ 'chitties/chitties/create?product_name='+product_name+'&in_lot_purity='+in_lot_purity+'&issue_chain_name='+issue_chain_name;  
    
});
$('select[name*="chitties[product_name]"]').on('change', function() {
    var product_name = $(this).val();
    window.location = base_url+ 'chitties/chitties/create?product_name='+product_name;  
    
});
function calculate_wastage_fine() {
  var in_weight = parseFloat($('input[name*="chitties[in_weight]"]').val());
  var out_purity = parseFloat($('input[name*="chitties[out_purity]"]').val());
  out_purity = (isNaN(out_purity)) ? 0 : out_purity;
  out_fine = ((in_weight * out_purity) / 100).toFixed(4); 
  set_chitties_process_field_value('wastage_fine', out_fine);
}
