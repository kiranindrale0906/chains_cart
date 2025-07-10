/*function onready_melting_lot_details() {
	onkeyup_field_melting_detail_required_weight();
	onkeyup_field_melting_detail_alloy_vodatar();
	set_total_melting_detail_alloy_weight();
}


// function refresh_page() {
// 	var process_name = $('select[name*="melting_lots[process_name]"] option:selected').val();
// 	window.location = base_url+ 'melting_lots/melting_lots/create?process_name='+process_name;
// }


// function set_tone_optios() {
// 	$('#tone').empty();
// 	var process_name = $('select[name*="melting_lots[process_name]"] option:selected').val();
// 	if (process_name != null) {
// 		var tone_values = tone[process_name];	
// 	}

// 	if (typeof tone_values  != 'undefined' ) {
// 		for (var i = 0; i < tone_values.length; i++) {
// 			$('#tone').append("<option value="+tone_values[i].id+">"+tone_values[i].name+"</option>");
// 		}
// 		$("select[name*='melting_lots[tone]']").selectpicker('refresh');
// 	}
// }

// function set_lot_purity_options() {
// 	$('#lot_purity').empty();
// 	var process_name = $('select[name*="melting_lots[process_name]"] option:selected').val();
// 	if (process_name != null) {
// 		if (process_name == 'Fancy Chain') {
// 			var lot_purity_values = lot_purity['Fancy Chain'];	
// 		} else if (process_name == 'Rope Chain') {
// 			var lot_purity_values = lot_purity['Rope Chain'];	
// 		} else if (process_name == 'Machine Chain') {
// 			var lot_purity_values = lot_purity['Machine Chain'];	
// 		} else if (process_name == 'Imp Italy Chain') {
// 			var lot_purity_values = lot_purity['Imp Italy Chain'];	
// 		} else if (process_name == 'Hollow Choco Chain') {
// 			var lot_purity_values = lot_purity['Hollow Choco Chain'];	
// 		} else if (process_name == 'Office Outside Solid Pipe') {
// 			var lot_purity_values = lot_purity['Office Outside Hollow Pipe'];	
// 		} else if (process_name == 'Office Outside Hollow Pipe') {
// 			var lot_purity_values = lot_purity['Office Outside Hollow Pipe'];	
// 		} else if (process_name == 'Office Outside Sisma Strip') {
// 			var lot_purity_values = lot_purity['Office Outside Hollow Pipe'];	
// 		} else {
// 			var lot_purity_values = lot_purity['Other Chain'];
// 		}
// 	}
	
// 	if (typeof lot_purity_values  != 'undefined' ) {
// 		for (var i = 0; i < lot_purity_values.length; i++) {
// 			$('#lot_purity').append("<option value="+lot_purity_values[i].id+">"+lot_purity_values[i].name+"</option>");
// 		}
// 		$("select[name*='melting_lots[lot_purity]']").selectpicker('refresh');
// 	}
// }

// function set_category_one_options() {
// 	$('#category_one').empty();
// 	var process_name = $('select[name*="melting_lots[process_name]"] option:selected').val();
// 	var category_one_values = category_one[process_name];
// 	if (typeof category_one_values  != 'undefined' ) {
// 		for (var i = 0; i < category_one_values.length; i++) {
// 			$('#category_one').append("<option value="+category_one_values[i].id+">"+category_one_values[i].name+"</option>");
// 		}
// 		$("select[name*='melting_lots[category_one]']").selectpicker('refresh');
// 	}
// 	if (process_name == 'Machine Chain' || process_name == 'Rope Chain' 
// 			|| process_name == 'Round Box Chain' || process_name == 'Choco Chain') {
// 		set_category_two_options();
// 	}
// }

// function set_category_two_options() {
// 	$('#category_two').empty();
// 	var process_name = $('select[name*="melting_lots[process_name]"] option:selected').val();
// 	var category_one = $('select[name*="melting_lots[category_one]"] option:selected').val();
// 	var category_two_values = category_two[process_name][category_one];
// 	if (typeof category_two_values != 'undefined' ) {
// 		for (var i = 0; i < category_two_values.length; i++) {
// 			$('#category_two').append("<option value="+category_two_values[i].id+">"+category_two_values[i].name+"</option>");
// 		}
// 		$("select[name*='melting_lots[category_two]']").selectpicker('refresh');
// 	}
// 	if (process_name == 'Machine Chain' || process_name == 'Rope Chain' 
// 			|| process_name == 'Round Box Chain') {
// 		set_category_three_options();
// 	}
// }

// function set_category_three_options() {
// 	$('#category_three').empty();
// 	var process_name = $('select[name*="melting_lots[process_name]"] option:selected').val();
// 	var category_one = $('select[name*="melting_lots[category_one]"] option:selected').val();
// 	var category_two = $('select[name*="melting_lots[category_two]"] option:selected').val();
// 	var category_three_values = category_three[process_name][category_one][category_two];
// 	if (typeof category_three_values != 'undefined' ) {
// 		for (var i = 0; i < category_three_values.length; i++) {
// 			$('#category_three').append("<option value="+category_three_values[i].id+">"+category_three_values[i].name+"</option>");
// 		}
// 		$("select[name*='melting_lots[category_three]']").selectpicker('refresh');
// 	}
// 	if (process_name == 'Round Box Chain') {
// 		set_category_four_options();
// 	}	
// }

// function set_category_four_options() {
// 	$('#category_four').empty();
// 	var process_name = $('select[name*="melting_lots[process_name]"] option:selected').val();
// 	var category_one = $('select[name*="melting_lots[category_one]"] option:selected').val();
// 	var category_two = $('select[name*="melting_lots[category_two]"] option:selected').val();
// 	var category_three = $('select[name*="melting_lots[category_three]"] option:selected').val();
// 	var category_four_values = category_four[process_name][category_one][category_two][category_three];
// 	if (typeof category_four_values != 'undefined' ) {
// 		for (var i = 0; i < category_four_values.length; i++) {
// 			$('#category_four').append("<option value="+category_four_values[i].id+">"+category_four_values[i].name+"</option>");
// 		}
// 		$("select[name*='melting_lots[category_four]']").selectpicker('refresh');
// 	}
// }


// function onchange_lot_purity(){
// 	$(".lot_purity").on('change', function() {	
// 		set_total_alloy_weight();
// 		$('.melting_lot_details > tr').each(function() {	
// 			set_total_alloy_weight($(this));
// 		});
// 	});	
// }

function onkeyup_field_melting_detail_required_weight(){
	$(".required_weight").keyup(function() {	
		set_required_melting_detail_alloy_weight($(this));
	});	
}

function onkeyup_field_melting_detail_alloy_vodatar(){
	$(".alloy_vodatar").keyup(function() {	
		set_gross_weight();
	});	
}


function set_required_melting_detail_alloy_weight($this) {
	var in_weight = $this.closest('tr').find('.in_weight').text();
	var total_alloy_weight = $this.closest('tr').find('.total_alloy_weight').text();
	var required_weight = $this.val();
	var total_required_alloy_weight = calculate_required_alloy_weight(in_weight, total_alloy_weight, required_weight);
  $this.closest('tr').find('.required_alloy_weight').text(total_required_alloy_weight);
  set_total_melting_detail_alloy_required();
  set_total_melting_detail_wastage_weight();
  set_melting_detail_gross_weight();
  set_melting_detail_pure_gold_weight();
}

function set_total_melting_detail_alloy_required() {
	var total_alloy_required = calculate_total_melting_detail_alloy_required();
	$(".alloy_weight").val(total_alloy_required.toFixed(4));
	set_gross_weight();
}

function set_total_melting_detail_wastage_weight(){
	var total_wastage_weight = calculate_total_melting_detail_wastage_weight();
	$(".wastage_weight").val(total_wastage_weight.toFixed(4));
	set_gross_weight();
}

function set_melting_detail_gross_weight() {
	var gross_weight = calculate_melting_detail_gross_weight();
	$(".gross_weight").val(gross_weight.toFixed(4));
}

function set_melting_detail_pure_gold_weight(){
	var pure_gold_weight = calculate_melting_detail_pure_gold_weight();
	$("input[name*='melting_lots[pure_gold_weight]']").val(pure_gold_weight.toFixed(4));
	set_gross_weight();
}

function set_total_melting_detail_alloy_weight(response){
	$('.melting_lot_details > tr').each(function() {	
		total_alloy_weight = calculate_total_melting_detail_alloy_weight($(this));
		
		$(this).find('.total_melting_detail_alloy_weight').text(total_alloy_weight);
	});
}

function calculate_total_melting_detail_alloy_weight(response) {
	var purity = response.find('.melting_detail_in_purity').text();
	var in_weight = response.find('.melting_detail_in_weight').text();
	var pure_gold_weight = in_weight * purity / 100 ;
	var lot_purity = $('.out_lot_purity').val();
	if (lot_purity != '' && lot_purity != 0 && lot_purity != null) {
		var total_weight = pure_gold_weight / lot_purity * 100;
		var max_alloy_weight = total_weight - in_weight;	
		response.find('.melting_detail_required_weight').removeAttr("readonly");
	} else {
		console.log(11);
		max_alloy_weight = 0;	
		response.find('.melting_detail_required_weight').attr("readonly","readonly");
	}
	return max_alloy_weight.toFixed(4);
} 

function calculate_melting_detail_pure_gold_weight(){
	var total_alloy_required = ($(".alloy_weight").val()=='') ? 0 : $(".alloy_weight").val();
	var lot_purity = $('select[name*="melting_lots[lot_purity]"] option:selected').val();
	var pure_gold_weight = 0;
	if (total_alloy_required < 0) {
		var alloy_weight = total_alloy_required * -1; 
		var pure_gold_weight = (parseFloat(lot_purity) * parseFloat(alloy_weight)) / (100 - parseFloat(lot_purity));
	} 
	return pure_gold_weight; 	
}

function calculate_required_alloy_weight(in_weight, total_alloy_weight, required_weight){
	return ((required_weight * total_alloy_weight) / in_weight).toFixed(4);
}

function calculate_total_melting_detail_alloy_required(){
	var total_melting_detail_alloy_required = 0;
	$(".melting_detail_required_alloy_weight").each(function(){
		total_alloy_required = (parseFloat(total_alloy_required) + parseFloat($(this).text()));
	});
	return total_alloy_required;	
}

function calculate_total_melting_detail_wastage_weight(){
	var total_wastage_weight = 0;
	$(".melting_detail_required_weight").each(function(){
		if ($(this).val()=='') {
			var wastage_weight = 0; 
		} else {
			var wastage_weight = $(this).val();
		}
		total_wastage_weight = (parseFloat(total_wastage_weight) + parseFloat(wastage_weight));
	});
	return total_wastage_weight;	
}

function calculate_gross_weight() {
	var wastage_weight = ($(".wastage_weight").val()=='') ? 0 : $(".wastage_weight").val();
	var alloy_required = ($(".alloy_weight").val()=='') ? 0 : $(".alloy_weight").val();
	var alloy_vodatar_weight = ($(".alloy_vodatar").val()=='') ? 0 : $(".alloy_vodatar").val();
	var pure_gold_weight = ($(".pure_gold_weight").val()=='') ? 0 : $(".pure_gold_weight").val();
	return (parseFloat(wastage_weight) + parseFloat(alloy_required) + parseFloat(alloy_vodatar_weight) + parseFloat(pure_gold_weight)); 
}




*/