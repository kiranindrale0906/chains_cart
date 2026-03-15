function onready_melting_lot() {
	onchange_melting_lots_process_name();
	onkeyup_field_required_weight();
	onkeyup_field_alloy_vodatar();
	onchange_lot_purity();
	set_total_alloy_weight();
	onchange_category_one();
	onchange_category_two();
	onchange_category_three();
	onchange_category_four();
	set_form_fields();
	
	
	var host = '<?php echo HOST; ?>';
}

function onchange_melting_lots_process_name() {
	$('select[name="melting_lots[process_name]"]').on('change', function() {
		refresh_page();
	});
	$('select[name="melting_lots[order_id]"]').on('change', function() {
		refresh_order_page();
	});
}

function refresh_page() {
	var params = new window.URLSearchParams(window.location.search);
	var chain_order_id = params.get('chain_order_id');
	var process_name = $('select[name*="melting_lots[process_name]"] option:selected').val();
	if(chain_order_id != '' && chain_order_id != undefined){
		window.location = base_url+'melting_lots/melting_lots/create?process_name='+process_name+'&chain_order_id='+chain_order_id;
	}else{
		window.location = base_url+ 'melting_lots/melting_lots/create?process_name='+process_name;
	}
}

function onchange_sub_process() {
	var process_name = $('select[name*="melting_lots[process_name]"] option:selected').val();
	var sub_process_name = $('select[name*="melting_lots[sub_process_name]"] option:selected').val();
	window.location = base_url+ 'melting_lots/melting_lots/create?process_name='+process_name+'&sub_process_name='+sub_process_name;
}

function refresh_order_page() {
	var process_name = $('select[name*="melting_lots[process_name]"] option:selected').val();
	var sub_process_name = $('select[name*="melting_lots[sub_process_name]"] option:selected').val();
	var order_id = $('select[name*="melting_lots[order_id]"] option:selected').val();
	window.location = base_url+ 'melting_lots/melting_lots/create?process_name='+process_name+'&sub_process_name='+sub_process_name+'&order_id='+order_id;
}

function set_form_fields() {
	var process_name = $('select[name="melting_lots[process_name]"] option:selected').val();
	if (process_name == 'Rope Chain') {
		set_category_one_options();
	}

}

function onchange_category_one() {
	$('select[name*="melting_lots[category_one]"]').on('change', function() {
		var process_name = $('select[name*="melting_lots[process_name]"] option:selected').val();
		if (process_name != 'KA Chain' && process_name!='Ball Chain') {
			$('select[name*="melting_lots[category_two]"] option').remove();
			$("select[name*='melting_lots[category_two]']").selectpicker('refresh');
		}
		$('select[name*="melting_lots[category_four]"] option').remove();
		$("select[name*='melting_lots[category_four]']").selectpicker('refresh');
		$('select[name*="melting_lots[category_three]"] option').remove();
		$("select[name*='melting_lots[category_three]']").selectpicker('refresh');

		if (process_name == 'Rope Chain') {
			set_category_two_options();
		}
	});

}

function onchange_category_two() {
	$('select[name*="melting_lots[category_two]"]').on('change', function() {
		var process_name = $('select[name*="melting_lots[process_name]"] option:selected').val();
		if (process_name != 'KA Chain' && process_name != 'Ball Chain') {
			$('select[name*="melting_lots[category_three]"] option').remove();
			$("select[name*='melting_lots[category_three]']").selectpicker('refresh');
			$('select[name*="melting_lots[category_four]"] option').remove();
			$("select[name*='melting_lots[category_four]']").selectpicker('refresh');
		}
		var process_name = $('select[name*="melting_lots[process_name]"] option:selected').val();
		var category_one = $('select[name*="melting_lots[category_one]"] option:selected').val();
		if (process_name == 'Rope Chain') {
			set_category_three_options();
		}
	})
}

function onchange_category_three() {
	$('select[name*="melting_lots[category_three]"]').on('change', function() {
		var process_name = $('select[name*="melting_lots[process_name]"] option:selected').val();
		if (process_name != 'KA Chain' && process_name != 'Ball Chain') {
		$('select[name*="melting_lots[category_four]"] option').remove();
		$("select[name*='melting_lots[category_four]']").selectpicker('refresh');
	    }
		var process_name = $('select[name*="melting_lots[process_name]"] option:selected').val();
		if (process_name == 'Rope Chain') {
			set_category_four_options();
		}
	})
}function onchange_category_four() {
	$('select[name*="melting_lots[category_four]"]').on('change', function() {
		var process_name = $('select[name*="melting_lots[process_name]"] option:selected').val();
		if (process_name != 'KA Chain' && process_name != 'Ball Chain') {
		$('select[name*="melting_lots[category_five]"] option').remove();
		$("select[name*='melting_lots[category_five]']").selectpicker('refresh');
	    }
		var process_name = $('select[name*="melting_lots[process_name]"] option:selected').val();
		if (process_name == 'Rope Chain') {
			set_category_five_options();
		}
	})
}

function onchange_choco_chain_chain_type() {
	$('select[name*="melting_lots[chain]"]').on('change', function() {
		var process_name = $('select[name*="melting_lots[process_name]"] option:selected').val();
		var chain_type = $('select[name*="melting_lots[chain]"] option:selected').val();
		if (process_name == 'Choco Chain' && chain_type == 'Choco RND') {
			$('.department_sequence').show();
		} else {
			$('.department_sequence').hide();
		}
	})
}

function set_tone_optios() {
	$('#tone').empty();
	var process_name = $('select[name*="melting_lots[process_name]"] option:selected').val();
	if (process_name != null) {
		var tone_values = tone[process_name];
	}

	if (typeof tone_values  != 'undefined' ) {
		for (var i = 0; i < tone_values.length; i++) {
			$('#tone').append("<option value="+tone_values[i].id+">"+tone_values[i].name+"</option>");
		}
		$("select[name*='melting_lots[tone]']").selectpicker('refresh');
	}
}

function set_lot_purity_options() {
	$('#lot_purity').empty();
	var process_name = $('select[name*="melting_lots[process_name]"] option:selected').val();
	if (process_name != null) {
		var lot_purity_values = lot_purity[process_name]
	}
	if (typeof lot_purity_values  != 'undefined' ) {
		for (var i = 0; i < lot_purity_values.length; i++) {
			$('#lot_purity').append("<option value="+lot_purity_values[i].id+">"+lot_purity_values[i].name+"</option>");
		}
		$("select[name*='melting_lots[lot_purity]']").selectpicker('refresh');
	}
}

function set_category_one_options() {
	$('#category_one').empty();
	var process_name = $('select[name*="melting_lots[process_name]"] option:selected').val();

	var category_one_values = category_one[process_name];
	if (typeof category_one_values  != 'undefined' ) {
		for (var i = 0; i < category_one_values.length; i++) {
			$('#category_one').append("<option value="+category_one_values[i].id+">"+category_one_values[i].name+"</option>");
		}
		$("select[name*='melting_lots[category_one]']").selectpicker('refresh');
	}
	if (process_name == 'Rope Chain') {
		set_category_two_options();
	}
}

function set_category_two_options() {
	$('#category_two').empty();
	var process_name = $('select[name*="melting_lots[process_name]"] option:selected').val();
	var category_one = $('select[name*="melting_lots[category_one]"] option:selected').val();
	var category_two_values = category_two[process_name][category_one];
	if (typeof category_two_values != 'undefined' ) {
		for (var i = 0; i < category_two_values.length; i++) {
			$('#category_two').append("<option value="+category_two_values[i].id+">"+category_two_values[i].name+"</option>");
		}
		$("select[name*='melting_lots[category_two]']").selectpicker('refresh');
	}
	if (process_name == 'Rope Chain') {
		set_category_three_options();
	}
}

function set_category_three_options() {
	$('#category_three').empty();
	var process_name = $('select[name*="melting_lots[process_name]"] option:selected').val();
	var category_one = $('select[name*="melting_lots[category_one]"] option:selected').val();
	var category_two = $('select[name*="melting_lots[category_two]"] option:selected').val();
	var category_three_values = category_three[process_name][category_one][category_two];
		if (typeof category_three_values != 'undefined' ) {
			for (var i = 0; i < category_three_values.length; i++) {
				$('#category_three').append("<option value="+category_three_values[i].id+">"+category_three_values[i].name+"</option>");
			}
			$("select[name*='melting_lots[category_three]']").selectpicker('refresh');
		}
		if (process_name == 'Rope Chain') {
			set_category_four_options();
		}
}

function set_category_four_options() {
	$('#category_four').empty();
	var process_name = $('select[name*="melting_lots[process_name]"] option:selected').val();
	var category_one = $('select[name*="melting_lots[category_one]"] option:selected').val();
	var category_two = $('select[name*="melting_lots[category_two]"] option:selected').val();
	var category_three = $('select[name*="melting_lots[category_three]"] option:selected').val();
	var category_four_values = category_four[process_name][category_one][category_two][category_three];
	if (typeof category_four_values != 'undefined' ) {
		for (var i = 0; i < category_four_values.length; i++) {
			$('#category_four').append("<option value="+category_four_values[i].id+">"+category_four_values[i].name+"</option>");
		}
		$("select[name*='melting_lots[category_four]']").selectpicker('refresh');
	}
	if (process_name == 'Rope Chain') {
			set_category_five_options();
		}
}

function set_category_five_options() {
	$('#category_five').empty();
	var process_name = $('select[name*="melting_lots[process_name]"] option:selected').val();
	var category_one = $('select[name*="melting_lots[category_one]"] option:selected').val();
	var category_two = $('select[name*="melting_lots[category_two]"] option:selected').val();
	var category_three = $('select[name*="melting_lots[category_three]"] option:selected').val();
	var category_four = $('select[name*="melting_lots[category_four]"] option:selected').val();
	var category_five_values = category_five[process_name][category_one][category_two][category_three][category_four];

	if (typeof category_five_values != 'undefined' ) {
		for (var i = 0; i < category_five_values.length; i++) {
			$('#category_five').append("<option value="+category_five_values[i].id+">"+category_five_values[i].name+"</option>");
		}
		$("select[name*='melting_lots[category_five]']").selectpicker('refresh');
	}
}


function onchange_lot_purity(){
	$process_name=$('select[name*="melting_lots[process_name]"] option:selected').val();
	$lot_purity=$(".lot_purity").val();
	$chain_order_id=$("input[name*='melting_lots[chain_order_id]']").val();
	$(".lot_purity").on('keyup change', function() {
		//set_total_alloy_weight();
		$('.sub_melting_lot_details > tr').each(function() {
			set_total_alloy_weight($(this));
			set_required_alloy_weight($(this).closest('tr').find('.required_weight'));
		});
	});
}

function onkeyup_field_required_weight(){
	$(".required_weight").keyup(function() {
		set_required_alloy_weight($(this));
		set_alloy_details_on_form();
	});
}

function onkeyup_field_alloy_vodatar(){
	$(".alloy_vodatar").keyup(function() {
		set_gross_weight();
	});
}


function set_required_alloy_weight($this) {
	var in_weight = $this.closest('tr').find('.in_weight').text();
	var total_alloy_weight = $this.closest('tr').find('.total_alloy_weight').text();
	var required_weight = $this.val();
	var total_required_alloy_weight = calculate_required_alloy_weight(in_weight, total_alloy_weight, required_weight);
  $this.closest('tr').find('.required_alloy_weight').text(total_required_alloy_weight);
  set_total_alloy_required();
  set_total_wastage_weight();
  set_gross_weight();
  set_pure_gold_weight();
}

function set_total_alloy_required() {
	var total_alloy_required = calculate_total_alloy_required();
	$(".alloy_weight").val(total_alloy_required.toFixed(4));
	set_gross_weight();
}

function set_total_wastage_weight(){
	var total_wastage_weight = calculate_total_wastage_weight();
	$(".wastage_weight").val(total_wastage_weight.toFixed(4));
	set_gross_weight();
}

function set_gross_weight() {
	var gross_weight = calculate_gross_weight();
	$(".gross_weight").val(gross_weight.toFixed(4));
}

function set_pure_gold_weight(){
	var pure_gold_weight = calculate_pure_gold_weight();
	$("input[name*='melting_lots[pure_gold_weight]']").val(pure_gold_weight.toFixed(4));
	set_gross_weight();
}

function set_total_alloy_weight(response){
	$('.sub_melting_lot_details > tr').each(function() {
		total_alloy_weight = calculate_total_alloy_weight($(this));
		$(this).find('.total_alloy_weight').text(total_alloy_weight);
	});
}

function calculate_total_alloy_weight(response) {
	var purity = response.find('.in_purity').text();
	var lot_purity = response.find('.lot_purity').text();
	var in_weight = response.find('.in_weight').text();
	var process_name = $('select[name*="melting_lots[process_name]"] option:selected').val();
	var chain_order_id = $('input[name*="melting_lots[chain_order_id]"]').val();
	var pure_gold_weight = in_weight * purity / 100 ;

	var lot_purity = $('select[name*="melting_lots[lot_purity]"] option:selected').val();
	if (lot_purity != '' && lot_purity != 0 && lot_purity != null) {
		var total_weight = pure_gold_weight / lot_purity * 100;
		var max_alloy_weight = total_weight - in_weight;

		response.find('.required_weight').removeAttr("readonly");
	} else {
		max_alloy_weight = 0;
		response.find('.required_weight').attr("readonly","readonly");
	}
	return max_alloy_weight.toFixed(4);
}

function calculate_pure_gold_weight(){
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
	if(in_weight!=0){
		required_alloy_weight=((required_weight * total_alloy_weight) / in_weight).toFixed(4);
	}else{
		required_alloy_weight=0;
	}
	return required_alloy_weight;
}

function calculate_total_alloy_required(){
	var total_alloy_required = 0;
	$(".required_alloy_weight").each(function(){
		total_alloy_required = (parseFloat(total_alloy_required) + parseFloat($(this).text()));
	});
	return total_alloy_required;
}

function calculate_total_wastage_weight(){
	var total_wastage_weight = 0;
	$(".required_weight").each(function(){
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

/*function onchange_melting_lots_process_name_set_parent_lots() {
	var process_name = $('select[name*="melting_lots[process_name]"] option:selected').val();
	$.ajax({
	    type : 'POST',
	    url : base_url+'melting_lots/melting_lots/view/1?type=1&process_name='+process_name,
	    dataType: 'JSON',
	    success: function(response) {
	     parent_lot_options(response);
	    }
  });
}*/

function parent_lot_options(response) {
	//alert(selected_parent_lot_id);
  $("select[name*='melting_lots[parent_lot_id]'] option").remove();
  if(response.result.length==0){
  	var option_html="<option value=''>No Record Found.</option>";
  } else {
	  var option_html="<option value=''>Select</option>";
	  for (i=0; i < response.result.length; i++) {
	    var name = response.result[i].name;
	    var value = response.result[i].id;
	    var purity = response.result[i].lot_purity;
	    //var selected = (selected_parent_lot_id == value) ? 'selected' : '';
	    option_html += "<option data-subtext='' value='"+value+"' "+selected+">"+name+" (Putiry: "+purity+")</option>";
	  }
  }
  $("select[name*='melting_lots[parent_lot_id]']").append(option_html);
  $("select[name*='melting_lots[parent_lot_id]']").selectpicker('refresh');
}

$(function() { 
	
	$("select[name*='melting_lots[parent_lot_id]']").on('change', function() {
		var params = new window.URLSearchParams(window.location.search);
		var chain_order_id = params.get('chain_order_id');
		var process_name = $('select[name*="melting_lots[process_name]"]').val();
		var processes_with_melting_lot_filter = ['Rope Chain', 'Solid Rope Chain', 'Machine Chain', 'Indo tally Chain', 'Hollow Choco Chain'];
		if($.inArray(process_name, processes_with_melting_lot_filter) != -1) {
			var parent_lot_id = $(this).val();
			if (chain_order_id != '' && chain_order_id != undefined) {
				window.location = base_url+ 'melting_lots/melting_lots/create?process_name='+process_name+'&parent_lot_id='+parent_lot_id+'&chain_order_id='+chain_order_id;
			}else{
				window.location = base_url+ 'melting_lots/melting_lots/create?process_name='+process_name+'&parent_lot_id='+parent_lot_id;
			}
		}
	});

	$('#order_id').on('change', function() {
		var order_id = $('#order_id').val();
		order_id = Array.from(new Set(order_id));
		var process_name = $('select[name*="melting_lots[process_name]"]').val();
		if(process_name == 'Rope Chain') {
			$.each(order_ids, function(index, value) {
				if(value.id == order_id) {
					if(value.varient == '4gm')
						$('#category_one').val('04-grams');
					if(value.varient == '6gm')
						$('#category_one').val('06-grams');
					if(value.varient == '8gm')
						$('#category_one').val('08-grams');
					if(value.varient == '12gm')
						$('#category_one').val('12-grams');
					if(value.varient == '16gm')
						$('#category_one').val('16-grams');
					$('#category_one').selectpicker('refresh').trigger('change');
				}
			});
		}if(process_name == 'Solid Rope Chain') {
			$.each(order_ids, function(index, value) {
				if(value.id == order_id) {
					if(value.varient == '4gm')
						$('#category_one').val('04-grams');
					if(value.varient == '6gm')
						$('#category_one').val('06-grams');
					if(value.varient == '8gm')
						$('#category_one').val('08-grams');
					if(value.varient == '12gm')
						$('#category_one').val('12-grams');
					if(value.varient == '16gm')
						$('#category_one').val('16-grams');
					$('#category_one').selectpicker('refresh').trigger('change');
				}
			});
		}

		if(process_name == 'Round Box Chain') {
			$.each(order_ids, function(index, value) {
				if(value.id == order_id) {
					if(value.chain_name == 'AFFAIR 8 gm') {
						$('#category_one').val('Affair');
						$('#category_two').val('08');
					}
					if(value.chain_name == 'BAHUBALI 12 gm') {
						$('#category_one').val('Bahubali');
						$('#category_two').val('12');
					}
					if(value.chain_name == 'BAHUBALI 16 gm') {
						$('#category_one').val('Bahubali');
						$('#category_two').val('16');
					}
					if(value.chain_name == 'BOMBATO 12 gm') {
						$('#category_one').val('Bombarto_Code');
						$('#category_two').val('12');
					}
					if(value.chain_name == 'BOOMER 4gm') {
						$('#category_one').val('Boomer');
						$('#category_two').val('04');
					}
					if(value.chain_name == 'BOOMER 12') {
						$('#category_one').val('Boomer');
						$('#category_two').val('12');
					}
					if(value.chain_name == 'OMBI BIG (SPARK) 12 gm') {
						$('#category_one').val('Spark');
						$('#category_two').val('12');
					}
					if(value.chain_name == 'OMBI COMPUTER 12 GM') {
						$('#category_one').val('Computer_Code');
						$('#category_two').val('12');
					}
					if(value.chain_name == 'OMBI SMALL (WAZIR) 8 gm') {
						$('#category_one').val('Walzer');
						$('#category_two').val('08');
					}
					if(value.chain_name == 'PENTAGON 12 gm') {
						$('#category_one').val('Pentagon');
						$('#category_two').val('12');
					}
					if(value.chain_name == 'RACE 12 gm') {
						$('#category_one').val('Race_Code');
						$('#category_two').val('12');
					}
					if(value.chain_name == 'RACE 16 gm') {
						$('#category_one').val('Race_Code');
						$('#category_two').val('16');
					}
					if(value.chain_name == 'RAEES COMPUTER 12gm') {
						$('#category_one').val('Raes_Code');
						$('#category_two').val('12');
					}
					if(value.chain_name == 'RAEES SKODA 12 gm') {
						$('#category_one').val('Skoda');
						$('#category_two').val('12');
					}
					if(value.chain_name == 'RAEES WAZIR 12 gm') {
						$('#category_one').val('Walzer');
						$('#category_two').val('12');
					}
					if(value.chain_name == 'SKODA 8 gm') {
						$('#category_one').val('Skoda');
						$('#category_two').val('8');
					}
					if(value.chain_name == 'SPARK 12 gm') {
						$('#category_one').val('Spark');
						$('#category_two').val('12');
					}
					if(value.chain_name == 'SPARK WAZIR 12 gm') {
						$('#category_one').val('Walzer');
						$('#category_two').val('12');
					}
					if(value.chain_name == 'MERCURY 16 gm') {
						$('#category_one').val('New_Mercury');
						$('#category_two').val('16');
					}
					if(value.chain_name == 'BOMBATO 4 gm') {
						$('#category_one').val('Bombarto_Code');
						$('#category_two').val('04');
					}
					if(value.chain_name == 'MERCURY 12 gm') {
						$('#category_one').val('New_Mercury');
						$('#category_two').val('12');
					}
					if(value.chain_name == 'MERCURY 8 gm') {
						$('#category_one').val('New_Mercury');
						$('#category_two').val('08');
					}
					$('#category_one, #category_two').selectpicker('refresh').trigger('change');
					/* Added delay to avoid conflicts with other category changes */
					setTimeout(function(){
							$('#category_four').val(value.tone).selectpicker('refresh').trigger('change');
					}, 10);

					$('input[name="melting_lots[fancy_chain]"][value="'+value.fancy_chain+'"]').prop('checked', true);
				}
			});
		}

		var processes_with_multi_order = ['Imp Italy Chain', 'Indo tally Chain'];
		if($.inArray(process_name, processes_with_multi_order) != -1) {
			var langari = {};
			var html = '';
			$.each(order_id, function(key, selected_order_id) {
				$.each(order_ids, function(index, order_data) {
					if(selected_order_id == order_data.id) {
						$.each(order_data.langari, function(name, weight) {
							if(typeof(langari[name]) != "undefined" && langari[name] !== null) {
								langari[name] += weight;
							} else {
								langari[name] = weight;
							}
						});
					}
				});
			});

			$('#langari_data').removeClass('hidden');
			$.each(langari, function(name, total_weight) {
				html += '<span class="medium">'+name+'</span> : '+total_weight + 'gms, ';
			});
			$('#langari_data').find('#langari_total').html('').html(html);
		}
	});
});
function ka_chain_set_category_two(){
	$('select[name*="melting_lots[category_one]"]').change(function(){
	   var category_one = $(this).val();
	   var process_name = $('select[name*="melting_lots[process_name]"]').val();
	   if(process_name=='KA Chain'){
	    ajax_get_request(base_url+'melting_lots/melting_lots?process_name='+process_name+'&category_one='+category_one);
	   }
	});
}
function ka_chain_set_category_three(){
	$('select[name*="melting_lots[category_two]"]').change(function(){
	   var category_two = $(this).val();
	   var category_one = $('select[name*="melting_lots[category_one]"]').val();
	   var process_name = $('select[name*="melting_lots[process_name]"]').val();
	   if(process_name=='KA Chain'){
	    ajax_get_request(base_url+'melting_lots/melting_lots?process_name='+process_name+'&category_one='+category_one+'&category_two='+category_two);
	  }
	});
}


function set_category_two_for_category_options(category_two) {
  set_melting_options(category_two, '#category_two');
}

function set_category_three_for_category_options(category_three) {
  set_melting_options(category_three, '#category_three');
}
function onchange_melting_lots_ka_chain_order() {
	$('select[name*="melting_lots[order_id]"]').change(function(){
		var order_id = $(this).val();
		var process_name = $('select[name*="melting_lots[process_name]"]').val();
		if(process_name=='KA Chain' || process_name=='Ball Chain'){
		window.location = base_url+ 'melting_lots/melting_lots/create?process_name='+process_name+'&order_id='+order_id;
		}
	});
}


function set_melting_options(options, field) {
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

// function set_alloy_weight(response) {
//   // $("#alloy_weight_details").remove();
//   alert(response.alloy_details);
//   // if(response.alloy_details.length==0){
//   // 	var option_html="<tr>No Record Found.</tr>";
//   // } else {
// 	 //  for (i=0; i < response.result.length; i++) {
//   // 		var name = response.result[i].alloy_weight;
// 	 //    var value = response.result[i].alloy_name;
	    
// 	 //    html += "<td>"+value+"</td>"+value+"<td>"+value+"</td><td></td>";
// 	 //  }
//   // }
//   // $("#alloy_weight_details").append(html);
// }
function set_alloy_details_on_form(){
	var alloy_weight = $('[name="melting_lots[alloy_weight]"]').val();
	var process_name = $('select[name*="melting_lots[process_name]"]').val();
	var lot_purity = $('select[name*="melting_lots[lot_purity]"]').val();
	var tone = $('select[name*="melting_lots[tone]"]').val();
	if(alloy_weight!='' && alloy_weight!=undefined){
		alloy_weight='&alloy_weight='+alloy_weight;
	}
	
	if(tone!='' && tone!=undefined){
		tone='&tone='+tone;
	}
	//alert('melting_lots/melting_lots/view/1?type=2&process_name='+process_name+'&lot_purity='+lot_purity+alloy_weight+category_one+tone);
	$.ajax({
	    type : 'GET',
	    url : base_url+'melting_lots/melting_lots/view/1?type=2&process_name='+process_name+'&lot_purity='+lot_purity+alloy_weight+tone,
	    dataType: 'JSON',
	    success: function(response) {
	     set_alloy_weight(response);
	    }
  });
}
function set_alloy_weight(response) {
    total_weight=0;
  var field = $(".alloy_weight_details");
  var total_alloy_weight_details = $(".total_alloy_weight_details");
  var html = '';
	field.html('');
	$(".total_alloy_weight_details").html('');
	total_alloy_weight_details.html('');

	if(response.result.length==0){
	 field.html('');
	  $(".total_alloy_weight_details").html('');
	  total_alloy_weight_details.html('');
	}else{
    for (i=0; i < response.result.length; i++) {
    	weight=response.result[i].alloy_weight*response.result[i].percentage/100;
    	total_weight=response.result[i].alloy_weight;
    	alloy_name=response.result[i].alloy_name;
    	percentage=response.result[i].percentage;
      html += "<tr><td >"+alloy_name+"</td><td class='text-right'>"+percentage+"</td><td class='text-right'>"+weight.toFixed(4)+"</td></tr>";
    }
  }
    field.append(html);
    total_alloy_weight_details.append(total_weight);
}
 