function change_total_stone(){
	$(".change_total_stone").keyup(function(){
		var id = $(this).attr('id');
		var index = id.replace('stone_',"");
		set_calculated_values(index);
	});
	$('.qr_code_detail_select_all').click(function(){
	    check_qr_code_view_all_checkboxes();   
	  });

}function change_km(){
	$(".change_km").keyup(function(){
		var id = $(this).attr('id');
		var index = id.replace('km_',"");
		set_calculated_values(index);
	});
	$('.qr_code_detail_select_all').click(function(){
	    check_qr_code_view_all_checkboxes();   
	  });

}function change_generate_lot_total_stone(index){
		set_calculated_values_in_generate_lot_qr_code(index);
}
function check_qr_code_view_all_checkboxes() {
  $('.qr_code_detail_id').each(function() {
    $(this).prop("checked", true);
  });
  calculate_investment_gross_weight();
}
function change_yellow_km(){
	$(".yellow_change_km").keyup(function(){
		var id = $(this).attr('id');
		var index = id.replace('yellow_km_',"");
		set_yellow_calculated_values(index);
	});
}function change_yellow_total_stone(){
	$(".yellow_change_total_stone").keyup(function(){
		var id = $(this).attr('id');
		var index = id.replace('yellow_stone_',"");
		set_yellow_calculated_values(index);
	});
}
function change_generate_lot_total_stone(){
	$(".generate_lot_change_total_stone").keyup(function(){
		var id = $(this).attr('id');
		var index = id.replace('generate_lot_total_stone_',"");
		set_generate_lot_calculated_values(index);
	});
}
function change_yellow_stone(index,$this){
	stone_weight=$('input[name="yellow_qr_code_details['+index+'][stone_weight]"]').val();
	percentage=$('select[name="yellow_qr_codes[percentage]"]').val();
	gross_weight=$('input[name="yellow_qr_code_details['+index+'][weight]"]').val();
	km=$('input[name="yellow_qr_code_details['+index+'][km]"]').val();
	less=$('input[name="yellow_qr_code_details['+index+'][less]"]').val();
	total_stone=$('input[name="yellow_qr_code_details['+index+'][total_stone]"]').val();
	total_less=parseFloat(stone_weight)+parseFloat(km);
	calculate_less=(((total_less)*percentage)/100);
	calculate_less=!isNaN(calculate_less)?calculate_less.toFixed(2):0;
	$('input[name="yellow_qr_code_details['+index+'][less]"]').val(calculate_less);
	less=$('input[name="yellow_qr_code_details['+index+'][less]"]').val();
	calculate_dispatch_weight=(parseFloat(gross_weight)- parseFloat(less));
	calculate_dispatch_weight=!isNaN(calculate_dispatch_weight)?calculate_dispatch_weight.toFixed(2):0;
	$('input[name="yellow_qr_code_details['+index+'][dispatch_weight]"]').val(calculate_dispatch_weight);
}
function change_generate_lot_stone(index,$this){
	stone_weight=$('input[name="generate_lot_qr_code_details['+index+'][stone_weight]"]').val();
	percentage=$('select[name="generate_lot_qr_codes[percentage]"]').val();
	gross_weight=$('input[name="generate_lot_qr_code_details['+index+'][weight]"]').val();
	
	less=$('input[name="generate_lot_qr_code_details['+index+'][less]"]').val();
	total_stone=$('input[name="generate_lot_qr_code_details['+index+'][total_stone]"]').val();
	calculate_less=((stone_weight*percentage)/100);
	$('input[name="generate_lot_qr_code_details['+index+'][less]"]').val(calculate_less);
	less=$('input[name="generate_lot_qr_code_details['+index+'][less]"]').val();
	calculate_dispatch_weight=(parseFloat(gross_weight)- parseFloat(less));
	calculate_dispatch_weight=!isNaN(calculate_dispatch_weight)?calculate_dispatch_weight.toFixed(2):0;
	$('input[name="generate_lot_qr_code_details['+index+'][dispatch_weight]"]').val(calculate_dispatch_weight);
}
function change_yellow_other_stone(index,$this){
	other_stone=$('input[name="yellow_qr_code_details['+index+'][other_stone]"]').val();
	gross_weight=$('input[name="yellow_qr_code_details['+index+'][weight]"]').val();
	less=$('input[name="yellow_qr_code_details['+index+'][less]"]').val();
	stone_weight=$('input[name="yellow_qr_code_details['+index+'][stone_weight]"]').val();
	km=$('input[name="yellow_qr_code_details['+index+'][km]"]').val();
	calculate_total_less=( parseFloat(stone_weight)+ parseFloat(other_stone)+ parseFloat(km));
	calculate_total_less=!isNaN(calculate_total_less)?calculate_total_less.toFixed(2):0;
	$('input[name="yellow_qr_code_details['+index+'][total_stone]"]').val(calculate_total_less);
	total_stone=$('input[name="yellow_qr_code_details['+index+'][total_stone]"]').val();
	calculate_net_weight=(parseFloat(gross_weight)-parseFloat(total_stone));
	calculate_net_weight=!isNaN(calculate_net_weight)?calculate_net_weight.toFixed(2):0;
	$('input[name="yellow_qr_code_details['+index+'][net_weight]"]').val(calculate_net_weight);
}
function change_generate_lot_other_stone(index,$this){
	other_stone=$('input[name="generate_lot_qr_code_details['+index+'][other_stone]"]').val();
	gross_weight=$('input[name="generate_lot_qr_code_details['+index+'][weight]"]').val();
	less=$('input[name="generate_lot_qr_code_details['+index+'][less]"]').val();
	stone_weight=$('input[name="generate_lot_qr_code_details['+index+'][stone_weight]"]').val();
	calculate_total_less=( parseFloat(stone_weight)+ parseFloat(other_stone));
	$('input[name="generate_lot_qr_code_details['+index+'][total_stone]"]').val(calculate_total_less);
	total_stone=$('input[name="generate_lot_qr_code_details['+index+'][total_stone]"]').val();
	calculate_net_weight=(parseFloat(gross_weight)-parseFloat(total_stone));
	calculate_net_weight=!isNaN(calculate_net_weight)?calculate_net_weight.toFixed(2):0;
	$('input[name="generate_lot_qr_code_details['+index+'][net_weight]"]').val(calculate_net_weight);
}

function change_catalog_total_stone(){
	$(".catalog_change_total_stone").keyup(function(){
		var id = $(this).attr('id');
		var index = id.replace('catalog_stone_',"");
		set_catalog_calculated_values(index);
	});
}

function set_calculated_values(index,object){
	var net_weight = 0;
	var gross_weight = $('input[name="qr_code_details['+index+'][weight]"]').val();
	var get_percentage_value = $('select[name="qr_codes[percentage]"]').val();
	if(get_percentage_value != "" && !isNaN(get_percentage_value)){
		var calculate_less = ($('input[name="qr_code_details['+index+'][total_stone]"]').val() * get_percentage_value) / 100;
		calculate_less = !isNaN(calculate_less)?calculate_less.toFixed(2):0;
		$('input[name="qr_code_details['+index+'][less]"]').val(calculate_less);
	}else{
		var calculate_less = ($('input[name="qr_code_details['+index+'][total_stone]"]').val() * 0) / 100;
		calculate_less = !isNaN(calculate_less)?calculate_less:0;
	}
    var calculate_km = $('input[name="qr_code_details['+index+'][km]"]').val();
		calculate_km = !isNaN(calculate_km)?calculate_km:0;
	if(gross_weight != ""){
		gross_weight = !isNaN(gross_weight)?gross_weight:0;
		net_weight = gross_weight - calculate_less - stone_weight-calculate_km;
	}
	$('input[name="qr_code_details['+index+'][net_weight]"]').val(net_weight.toFixed(4));
	}
	function set_calculated_values_in_generate_lot_qr_code(index,object){
		var net_weight = 0;
		var gross_weight = $('input[name="generate_lot_qr_code_details['+index+'][weight]"]').val();
		var stone_weight = $('input[name="generate_lot_qr_code_details['+index+'][stone_weight]"]').val();
		var get_percentage_value = $('select[name="generate_lot_qr_codes[percentage]"]').val();
		if(get_percentage_value != "" && !isNaN(get_percentage_value)){
			var calculate_less = ($('input[name="generate_lot_qr_code_details['+index+'][total_stone]"]').val() * get_percentage_value) / 100;
			calculate_less = !isNaN(calculate_less)?calculate_less.toFixed(2):0;
			$('input[name="generate_lot_qr_code_details['+index+'][less]"]').val(calculate_less);
		}else{
			var calculate_less = ($('input[name="generate_lot_qr_code_details['+index+'][total_stone]"]').val() * 0) / 100;
			calculate_less = !isNaN(calculate_less)?calculate_less:0;
		}

		if(gross_weight != ""){
			gross_weight = !isNaN(gross_weight)?gross_weight:0;
			net_weight = gross_weight - calculate_less- stone_weight;
	//		dispatch_weight = gross_weight - calculate_less;
		}
		$('input[name="generate_lot_qr_code_details['+index+'][net_weight]"]').val(net_weight.toFixed(4));
	//	$('input[name="generate_lot_qr_code_details['+index+'][dispatch_weight]"]').val(dispatch_weight.toFixed(4));
}
function set_yellow_calculated_values(index,object){
	var net_weight = 0;
	var gross_weight = $('input[name="yellow_qr_code_details['+index+'][weight]"]').val();
	var stone_weight = $('input[name="yellow_qr_code_details['+index+'][stone_weight]"]').val();
	var get_percentage_value = $('select[name="yellow_qr_codes[percentage]"]').val();
	if(get_percentage_value != "" && !isNaN(get_percentage_value)){
		var calculate_less = ($('input[name="yellow_qr_code_details['+index+'][total_stone]"]').val() * get_percentage_value) / 100;
		calculate_less = !isNaN(calculate_less)?calculate_less.toFixed(2):0;
		$('input[name="yellow_qr_code_details['+index+'][less]"]').val(calculate_less);
	}else{
		var calculate_less = ($('input[name="yellow_qr_code_details['+index+'][total_stone]"]').val() * 0) / 100;
		calculate_less = !isNaN(calculate_less)?calculate_less:0;
	}
	var calculate_km = $('input[name="yellow_qr_code_details['+index+'][km]"]').val();
		calculate_km = !isNaN(calculate_km)?calculate_km:0;
	if(gross_weight != ""){
		gross_weight = !isNaN(gross_weight)?gross_weight:0;
		net_weight = gross_weight - calculate_less- stone_weight-calculate_km;
//		dispatch_weight = gross_weight - calculate_less;
	}
	$('input[name="yellow_qr_code_details['+index+'][net_weight]"]').val(net_weight.toFixed(4));
//	$('input[name="yellow_qr_code_details['+index+'][dispatch_weight]"]').val(dispatch_weight.toFixed(4));

}
function set_generate_lot_calculated_values(index,object){
	var net_weight = 0;
	var gross_weight = $('input[name="generate_lot_qr_code_details['+index+'][weight]"]').val();
	var stone_weight = $('input[name="generate_lot_qr_code_details['+index+'][stone_weight]"]').val();
	var get_percentage_value = $('select[name="generate_lot_qr_codes[percentage]"]').val();
	if(get_percentage_value != "" && !isNaN(get_percentage_value)){
		var calculate_less = ($('input[name="generate_lot_qr_code_details['+index+'][total_stone]"]').val() * get_percentage_value) / 100;
		calculate_less = !isNaN(calculate_less)?calculate_less.toFixed(2):0;
		$('input[name="generate_lot_qr_code_details['+index+'][less]"]').val(calculate_less);
	}else{
		var calculate_less = ($('input[name="generate_lot_qr_code_details['+index+'][total_stone]"]').val() * 0) / 100;
		calculate_less = !isNaN(calculate_less)?calculate_less:0;
	}

	if(gross_weight != ""){
		gross_weight = !isNaN(gross_weight)?gross_weight:0;
		net_weight = gross_weight - calculate_less- stone_weight;
//		dispatch_weight = gross_weight - calculate_less;
	}
	$('input[name="generate_lot_qr_code_details['+index+'][net_weight]"]').val(net_weight.toFixed(4));
//	$('input[name="generate_lot_qr_code_details['+index+'][dispatch_weight]"]').val(dispatch_weight.toFixed(4));

}
function set_catalog_calculated_values(index,object){
	//alert(index);
	var net_weight = 0;
	var gross_weight = $('input[name="catalog_qr_code_details['+index+'][weight]"]').val();
	var get_percentage_value = $('select[name="catalog_qr_codes[percentage]"]').val();
	if(get_percentage_value != "" && !isNaN(get_percentage_value)){
		var calculate_less = ($('input[name="catalog_qr_code_details['+index+'][total_stone]"]').val() * get_percentage_value) / 100;
		calculate_less = !isNaN(calculate_less)?calculate_less.toFixed(2):0;
		$('input[name="catalog_qr_code_details['+index+'][less]"]').val(calculate_less);
	}else{
		var calculate_less = ($('input[name="catalog_qr_code_details['+index+'][total_stone]"]').val() * 0) / 100;
		calculate_less = !isNaN(calculate_less)?calculate_less:0;
	}

	if(gross_weight != ""){
		gross_weight = !isNaN(gross_weight)?gross_weight:0;
		net_weight = gross_weight - calculate_less;
	}
	$('input[name="catalog_qr_code_details['+index+'][net_weight]"]').val(net_weight.toFixed(4));
}

function set_image_qr_code(index,object,quantity){
  $('#img_'+index).attr('src',object);
  $('input[name="qr_code_details['+index+'][order_quantity]"]').val(quantity);
  $('input[name="qr_code_details['+index+'][quantity]"]').val(quantity);
}
function change_value_on_select_percentage(){
	$('.yellow_change_total_stone').each(function() {
		var index_value = $(this).attr("id");
		var value = $(this).val();
		if(value != "")
			set_calculated_values(index_value);
	});
	$('.generate_lot_total_stone').each(function() {
		var index_value = $(this).attr("id");
		var value = $(this).val();
		if(value != "")
			set_calculated_values_in_generate_lot_qr_code(index_value);
	});
}
function yellow_change_value_on_select_percentage(){
	$('.change_total_stone').each(function() {
		var index_value = $(this).attr("id");
		var value = $(this).val();
		if(value != "")
			set_yellow_calculated_values(index_value);
	});
        $('.generate_lot_total_stone').each(function() {
		var index_value = $(this).attr("id");
		var value = $(this).val();
		if(value != "")
			set_calculated_values_in_generate_lot_qr_code(index_value);
	});
}

function change_value_on_select_catalog_percentage(){
	$('.catalog_change_total_stone').each(function() {
		var index_value = $(this).attr("id");
		var value = $(this).val();
		if(value != "")
			set_calculated_values(index_value);
	});
}

function onchange_gross_weight(index){
	set_calculated_values(index);
}
function onchange_generate_lot_gross_weight(index){
	set_calculated_values_in_generate_lot_qr_code(index);
}
function onchange_item_code(index){
  lot_no=$('select[name="qr_code_details['+index+'][item_code]"]').val();
  ajax_get_request(base_url+'/qr_codes/index?lot_no='+lot_no+'&index='+index);
}
function onchange_catalog_gross_weight(index){
	set_catalog_calculated_values(index);
}
$
