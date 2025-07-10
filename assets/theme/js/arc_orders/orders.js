	function onload_generate_lots_processes() {

		$('.reject_comment').hide();
		on_click_process_id_calculate_in_weight();
		on_click_order_melting_lot_generate_lot_id_calculate_in_weight();
		// on_click_investment_id_calculate_in_weight();
		onclick_select_all_check_all_checkboxes();
	 }
	$('select[name*="orders[order_status]"]').on('change', function() {
		var order_status = $(this).val();
		if(order_status=="Approved"){
		$('.reject_comment').hide();
		}else{
		$('.reject_comment').show();
		}
	});
	function on_click_process_id_calculate_in_weight(){
		$('.genarate_lot_id').click(function(){
			calculate_generate_lot_in_weight();
		});
	}function on_click_order_melting_lot_generate_lot_id_calculate_in_weight(){
		$('.genarate_lot_id').click(function(){
			calculate_order_melting_lot_in_weight();
		});
	}
	function on_click_investment_id_calculate_in_weight(){
		$('.investment_id').click(function(){
			calculate_investment_gross_weight();
		});
	}

	// function onclick_select_all_check_all_checkboxes(){
	  	$('.generate_out_select_all').click(function(){
	    check_generate_lot_all_checkboxes();   
	  });
	// }
	$('.investment_select_all').click(function(){
	    check_investment_all_checkboxes();   
	  });
	function check_generate_lot_all_checkboxes() {
	  $('.genarate_lot_id').each(function() {
	    $(this).prop("checked", true);
	  });
	  calculate_generate_lot_in_weight();
	}
	function check_investment_all_checkboxes() {
	  $('.investment_id').each(function() {
	    $(this).prop("checked", true);
	  });
	  calculate_investment_gross_weight();
	}

	function calculate_generate_lot_in_weight(){
		var total_in_weight = 0;
		var total_balance_in_weight = 0;
		var total_quantity = 0;
		$('.genarate_lot_id:checked').each(function() {
			weight_of_lot=$(this).closest("tr").find(".order_weight").text();
			quantity_of_lot=$(this).closest("tr").find(".balance_quantity").val();

			order_quantity_of_lot=$(this).closest("tr").find(".order_quantity").text();

			balance_qty_of_lot=order_quantity_of_lot-quantity_of_lot;
			per_quantity_order_weight=parseFloat(weight_of_lot)/parseInt(order_quantity_of_lot);

			total_in_weight = total_in_weight + parseFloat(per_quantity_order_weight*quantity_of_lot);
			total_balance_in_weight = total_balance_in_weight + parseFloat(total_in_weight);
			total_quantity = total_quantity + parseFloat(quantity_of_lot);

		});
		set_generate_lot_process_field_value('generate_lot_in_weight',total_in_weight);
		set_generate_lot_process_field_value('generate_lot_balance_in_weight',total_balance_in_weight);
		set_generate_lot_process_field_value('quantity',total_quantity);
	}
	function calculate_order_melting_lot_in_weight(){
		var total_in_weight = 0;
		var total_quantity = 0;
		$('.genarate_lot_id:checked').each(function() {
			total_in_weight = total_in_weight + parseFloat($(this).closest("tr").find(".weight").text());
			total_quantity = total_quantity + parseFloat($(this).closest("tr").find(".quantity").text());
		});
		set_generate_lot_process_field_value('order_melting_lot_in_weight',total_in_weight);
		set_generate_lot_process_field_value('order_melting_lot_quantity',total_quantity);
	}
	function calculate_investment_gross_weight(){
		var total_in_weight = 0;
		$('.investment_id:checked').each(function() {
			total_in_weight = total_in_weight + parseFloat($(this).closest("tr").find(".weight").text());
	});
		set_generate_lot_process_field_value('investment_gross_wt',total_in_weight);
	}

	function set_generate_lot_process_field_value(field_name, value) {
		$("."+field_name+"").val((value).toFixed(4));
	}

	function onchange_order_quantity(index,$this) {
	  $('input[name="order_details['+index+'][quantity]"]').keyup(function() {
	  	var sum=0;
	    $(".quantity").each(function(){
	        if($(this).val() != "")
	          sum += parseInt($(this).val());   
	    });
	    $('input[name="orders[quantity]"]').val(sum);
	  
	  });
	}

	  function onchange_order_weight(index,$this) {
	  $('input[name="order_details['+index+'][weight]"]').keyup(function() {
	  	weight=$('input[name="order_details['+index+'][weight]"]').val();
	  	// quantity=$('input[name="order_details['+index+'][quantity]"]').val();
	  	// total_weight=weight*quantity;
	  	total_weight=weight;
	  	$('input[name="order_details['+index+'][total_weight]"]').val(total_weight);

	  	var sum=0;
	    $(".total_weight").each(function(){
	        if($(this).val() != "")
	          sum += parseFloat($(this).val());   
	    });
	    $('input[name="orders[weight]"]').val(sum);
	  
	  });
	}
	function onchange_export_order_weight(index,$this) {
	  $('input[name="order_details['+index+'][weight]"]').keyup(function() {
	  	weight=$('input[name="order_details['+index+'][weight]"]').val();
	  	// quantity=$('input[name="order_details['+index+'][quantity]"]').val();
	  	// total_weight=weight*quantity;
	  	total_weight=weight;
	  	$('input[name="order_details['+index+'][total_weight]"]').val(total_weight);

	  	var sum=0;
	    $(".total_weight").each(function(){
	        if($(this).val() != "")
	          sum += parseFloat($(this).val());   
	    });
	    $('input[name="export_orders[weight]"]').val(sum);
	  
	  });
	}function onchange_swarnshilp_order_weight(index,$this) {
	  $('input[name="order_details['+index+'][weight]"]').keyup(function() {
	  	weight=$('input[name="order_details['+index+'][weight]"]').val();
	  	// quantity=$('input[name="order_details['+index+'][quantity]"]').val();
	  	// total_weight=weight*quantity;
	  	total_weight=weight;
	  	$('input[name="order_details['+index+'][total_weight]"]').val(total_weight);

	  	var sum=0;
	    $(".total_weight").each(function(){
	        if($(this).val() != "")
	          sum += parseFloat($(this).val());   
	    });
	    $('input[name="swarnshilp_orders[weight]"]').val(sum);
	  
	  });
	}
	$('select[name*="investments[purity]"]').on('change', function() {
		var purity = $('select[name*="investments[purity]"]').val();	
		var tone = $('select[name*="investments[tone]"]').val();	
		var process_name = $('select[name*="investments[process_name]"]').val();	
		var customer_name = $('select[name*="investments[customer_name]"]').val();	
		if(tone == "" || tone == "undefined"){
			tone="";
		}if(process_name == "" || process_name == "undefined"){
			process_name="";
		}if(customer_name == "" || customer_name == "undefined"){
			customer_name="";
		}if(purity == "" || purity == "undefined"){
			purity="";
		}
		window.location = base_url+'arc_orders/investments/create?process_name='+process_name+'&purity='+purity+'&tone='+tone+'&customer_name='+customer_name;	
	});$('select[name*="investments[customer_name]"]').on('change', function() {
		var purity = $('select[name*="investments[purity]"]').val();	
		var tone = $('select[name*="investments[tone]"]').val();	
		var process_name = $('select[name*="investments[process_name]"]').val();	
		var customer_name = $('select[name*="investments[customer_name]"]').val();	
		if(tone == "" || tone == "undefined"){
			tone="";
		}if(process_name == "" || process_name == "undefined"){
			process_name="";
		}if(customer_name == "" || customer_name == "undefined"){
			customer_name="";
		}if(purity == "" || purity == "undefined"){
			purity="";
		}
		window.location = base_url+'arc_orders/investments/create?process_name='+process_name+'&purity='+purity+'&tone='+tone+'&customer_name='+customer_name;	
	});
	$('select[name*="investments[process_name]"]').on('change', function() {
		var purity = $('select[name*="investments[purity]"]').val();	
		var tone = $('select[name*="investments[tone]"]').val();	
		var process_name = $('select[name*="investments[process_name]"]').val();	
		var customer_name = $('select[name*="investments[customer_name]"]').val();	
		if(tone == "" || tone == "undefined"){
			tone="";
		}if(process_name == "" || process_name == "undefined"){
			process_name="";
		}if(customer_name == "" || customer_name == "undefined"){
			customer_name="";
		}if(purity == "" || purity == "undefined"){
			purity="";
		}
		window.location = base_url+'arc_orders/investments/create?process_name='+process_name+'&purity='+purity+'&tone='+tone+'&customer_name='+customer_name;	
	});
	$('select[name*="investments[tone]"]').on('change', function() {
		var purity = $('select[name*="investments[purity]"]').val();	
		var tone = $('select[name*="investments[tone]"]').val();	
		var process_name = $('select[name*="investments[process_name]"]').val();	
		var customer_name = $('select[name*="investments[customer_name]"]').val();	
		if(tone == "" || tone == "undefined"){
			tone="";
		}if(process_name == "" || process_name == "undefined"){
			process_name="";
		}if(customer_name == "" || customer_name == "undefined"){
			customer_name="";
		}if(purity == "" || purity == "undefined"){
			purity="";
		}
		window.location = base_url+'arc_orders/investments/create?process_name='+process_name+'&purity='+purity+'&tone='+tone+'&customer_name='+customer_name;	
	});
	$(".investment_gross_wt").on('keyup', function() {
	   calculate_investment_net_wt();
	});
	$(".investment_base_wt").on('keyup', function() {
	   calculate_investment_net_wt();
	});
	$(".investment_stone_wt").on('keyup', function() {
	   calculate_investment_net_wt();
	});

	$(document).on("click", ".show_img_popup", function(){

		var image_path = $(this).attr("src");
		let html_data = '<img src="'+image_path+'" style="overflow:auto;margin:5%;">';
		$("#img_popup_box").html(html_data);
		$("#ima_popup_modal").modal("show");
	});


	function calculate_investment_net_wt() {
	  var investment_gross_wt=$(".investment_gross_wt").val();
	  var investment_base_wt=$(".investment_base_wt").val();
	  var investment_stone_wt = $(".investment_stone_wt").val();
	  // var gold_ratio = $(".gold_ratio").val();
	  if(isNaN(investment_gross_wt) || investment_gross_wt=="") investment_gross_wt=0;
	  if(isNaN(investment_base_wt) || investment_base_wt=="") investment_base_wt=0;
	  if(isNaN(investment_stone_wt) || investment_stone_wt=="") investment_stone_wt=0;
	  if(isNaN(investment_net_wt) || investment_net_wt=="") investment_net_wt=0;
	  // alert(investment_stone_wt);
	  var investment_net_wt = (parseFloat(investment_gross_wt) - parseFloat(investment_base_wt) - parseFloat(investment_stone_wt));

	  $(".investment_net_wt").val(investment_net_wt.toFixed(4));
	}
	
	//////////////////////arc order melting lot//////////////////////////

	  var order_melting_lot = {

			filter_order_melting_lot_form : function(){
				var purity = $('select[name="order_melting_lots[purity]"]').val();	
				var colour = $('select[name="order_melting_lots[colour]"]').val();
				var process_name = $('select[name="order_melting_lots[process_name]"]').val();	
				window.location = base_url+'arc_orders/order_melting_lots/create?process_name='+process_name+'&purity='+purity+'&colour='+colour;
			},
		  check_generate_lot_all_checkboxes : function() {
			  $('.genarate_lot_id').each(function() {
			    $(this).prop("checked", true);
			  });
			  order_melting_lot.calculate_generate_lot_in_weight();
			},
			calculate_generate_lot_in_weight : function(){
				var total_in_weight = 0;
				var total_quantity = 0;
				$('.genarate_lot_id:checked').each(function() {
					total_in_weight = total_in_weight + parseFloat($(this).closest("tr").find(".weight").text());
					total_quantity = total_quantity + parseFloat($(this).closest("tr").find(".quantity").text());
				});
				set_generate_lot_process_field_value('order_melting_lot_in_weight',total_in_weight);
				set_generate_lot_process_field_value('order_melting_lot_quantity',total_quantity);
			}
	  };

		// $('select[name="order_melting_lots[process_name]"]').on('change', function() {
		// 	order_melting_lot.filter_order_melting_lot_form();
		// });
		$('select[name="order_melting_lots[colour]"]').on('change', function() {
			order_melting_lot.filter_order_melting_lot_form();
		});
		$('select[name="order_melting_lots[purity]"]').on('change', function() {
			order_melting_lot.filter_order_melting_lot_form();
		});

		$('.order_meling_lots_select_all').click(function(){
	    order_melting_lot.check_generate_lot_all_checkboxes();   
	  });

	//////////////////////arc order melting lot//////////////////////////


	//////////////////////arc order melting lot reject quantity//////////////////////////

		$(".omlr_reject_quantity").on("change", function(){
			var reject_qty = parseInt($(this).val());
			var total_qty = parseInt($(this).closest("tr").find(".omlr_quantity").text());
			var balance_qty = parseInt($(this).closest("tr").find(".omlr_balance_quantity").val());

			if($.isNumeric(reject_qty)){
				if(reject_qty > total_qty){
					$(this).val("0");
					$(this).closest("tr").find(".omlr_balance_quantity").val(balance_qty);
					toastr.error("Reject Quantity Should Be Less Than Previous Quantity");
				}
				else {
					let balance_qty = total_qty - reject_qty;
					$(this).closest("tr").find(".omlr_balance_quantity").val(balance_qty);
				}
			}
			else {
				$(this).val("0");
				$(this).closest("tr").find(".omlr_balance_quantity").val(balance_qty);
				toastr.error("Enter Numbers Only");
			}
		});
	//////////////////////arc order melting lot reject quantity//////////////////////////

function onchange_order_category(index){
    var category = $(`select[id=category_${index}]`).val();
    var next_process = {"Chain" : "ARC Chain","Ornament" : "ARC Ornament","Turkey" : "ARC Turkey"};
    $(`select[id=next_process_${index}]`).val(next_process[category]).change();
}

$('select[name*="generate_lots[process_name]"]').on('change', function() { change_of_generate_lots_fields(); });
$('select[name*="generate_lots[customer_name]"]').on('change', function() { change_of_generate_lots_fields(); });
$('select[name*="generate_lots[order_type]"]').on('change', function() { change_of_generate_lots_fields(); });
$('select[name*="generate_lots[purity]"]').on('change', function() { change_of_generate_lots_fields(); });
$('select[name*="generate_lots[colour]"]').on('change', function() { change_of_generate_lots_fields(); });
$('select[name="generate_lots[next_process]"]').on('change', function() { change_of_generate_lots_fields(); });
$('select[name="generate_lots[huid]"]').on('change', function() { change_of_generate_lots_fields();});
$('select[name="generate_lots[cutting_type]"]').on('change',function(){ change_of_generate_lots_fields(); } );

function delete_all_uri_params(searchParams){
    for (const [key, value] of searchParams.entries()) {
        searchParams.delete(key);
    }
}

function change_of_generate_lots_fields() {
    
    var start_date = $('input[name*="start_date').val();
    var end_date = $('input[name*="end_date"]').val();
    var customer_name = $('select[name*="generate_lots[customer_name]').val();
    var process_name = $('select[name*="generate_lots[process_name]"]').val();	
    var order_type = $('select[name*="generate_lots[order_type]"]').val();	
    var purity = $('select[name*="generate_lots[purity]"]').val();	
    var colour = $('select[name*="generate_lots[colour]"]').val();	
    var next_process = $('select[name="generate_lots[next_process]"]').val();
    var cutting_type = $('select[name*="cutting_type"]').val();
    var huid = $('select[name*="huid"]').val();
    
    if((start_date=="" && end_date!='')||(start_date!="" && end_date=='')){
        alert("Please select both dates.");
        return false;
      }
  
    if(moment(start_date, 'DD MMM YYYY').unix() > moment(end_date, 'DD MMM YYYY').unix())
    {
    alert("From Date Can't be greater than To date");
    return false;
    }

    date_wise='';
    
    var params = new window.URLSearchParams(window.location.search);
    delete_all_uri_params(params);
    if(start_date!=""&&end_date!=''){
        params.set('start_date',start_date);
        params.set('end_date',end_date);
    }
    if(customer_name) params.set('customer_name',customer_name);
    if(process_name) params.set('process_name',process_name);
    if(order_type) params.set('order_type',order_type);
    if(purity) params.set('purity',purity);
    if(colour) params.set('colour',colour);
    if(cutting_type) params.set('cutting_type',cutting_type);
    if(huid) params.set('huid',huid);
    if(next_process) params.set('next_process',next_process); 

    var uri_string = (params.toString()) ? "?"+params.toString() : '';
    window.location = base_url+'arc_orders/generate_lots/create'+uri_string;	
}

function change_order_status_report(){
	var customer_name = $("#order_status_report_customer_name").val();
	var from_date = $("#order_status_report_from_date").val();
	var to_date = $("#order_status_report_to_date").val();
	var next_process = $("#order_status_report_next_process").val();
	var status = $("#order_status_report_status").val();
	//alert(status);
	var url = "customer_name="+customer_name+"&from_date="+from_date+"&to_date="+to_date+"&next_process="+next_process+"&status="+status;
		window.location = base_url+'reports/order_status_reports?'+url;
}
