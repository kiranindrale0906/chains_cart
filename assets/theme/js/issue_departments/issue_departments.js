function onload_issue_department(){
	onclick_process_id_calculate_issue_department_fields();
	onkeyup_field('out_purity');
	onchange_product_name_get_issue_department_details();
	onchange_account_get_issue_department_details();
	on_click_gpc_out_hold_process_id_calculate_in_weight();
	onclick_gpc_out_hold_select_all_check_all_checkboxes();
	on_click_customer_out_hold_process_id_calculate_in_weight();
	on_click_approval_process_id_calculate_in_weight();
	onclick_customer_out_hold_select_all_check_all_checkboxes();
	onclick_approval_select_all_check_all_checkboxes();
	
	// onchange_chain_name_get_issue_department_details();
	onchange_category_one_get_purity();
	onchange_purity_get_issue_department_details();
	onchange_customer_name_get_issue_department_details();
	onclick_select_all_check_all_checkboxes();
	on_key_up_set_gross_weight_equal_to_out_melting_wastage();
	on_key_up_set_quantity_equal_to_out_quantity();
	onchange_department_name_get_issue_department_details();
	onchange_parent_lot_name_issue_department_details();
	onchange_melting_get_gpc_out_hold_process();
	onchange_product_name_get_gpc_out_hold_process();
	onchange_melting_get_customer_out_hold_process();
	onchange_customer_name_get_customer_out_hold_process();
	onchange_account_get_issue_department_details();
	}

function on_key_up_set_gross_weight_equal_to_out_melting_wastage(){
	$('.out_weight').keyup(function() {
		$(this).closest("tr").find(".gross_weight").text($(this).closest("tr").find('input[name*="out_weight"]').val());
		$(this).closest('tr').find('[type=checkbox]').prop('checked', true);
		calculate_issue_department_fields();
		calculate_fine($(this));
	});
}function on_key_up_set_quantity_equal_to_out_quantity(){
	$('.quantity').keyup(function() {
		$(this).closest("tr").find(".gross_quantity").text($(this).closest("tr").find('input[name*="quantity"]').val());
		$(this).closest('tr').find('[type=checkbox]').prop('checked', true);
		calculate_issue_department_fields();
		});
}
function onchange_account_get_issue_department_details() {
	$('select[name*="issue_departments[account_id]"]').on('change', function() {
		var account_name = $(this).val();	
		var product_name = $('select[name*="issue_departments[product_name]"]').val();	
		if(product_name=="Hallmark Receipt" || product_name=="Huid"){
		window.location = base_url+ 'issue_departments/issue_departments/create?product_name='+product_name+'&account_name='+account_name;	
		}
	});
}
function onclick_gpc_out_hold_select_all_check_all_checkboxes(){
  $('.gpc_out_hold_select_all').click(function(){
    check_gpc_out_wastage_hold_all_checkboxes();   
  })
}
function onclick_customer_out_hold_select_all_check_all_checkboxes(){
  $('.customer_out_hold_select_all').click(function(){
    check_customer_out_wastage_hold_all_checkboxes();   
  })
}function onclick_approval_select_all_check_all_checkboxes(){
  $('.approval_select_all').click(function(){
    check_approval_select_all_checkboxes();   
  })
}

function check_gpc_out_wastage_hold_all_checkboxes() {
  $('.gpc_out_process_id').each(function() {
    $(this).prop("checked", true);
  });
  calculate_gpc_out_in_weight();
}
function check_customer_out_wastage_hold_all_checkboxes() {
  $('.customer_out_process_id').each(function() {
    $(this).prop("checked", true);
  });
  calculate_customer_out_in_weight();
}function check_approval_select_all_checkboxes() {
  $('.approval_process_id').each(function() {
    $(this).prop("checked", true);
  });
  calculate_approval_in_weight();
}
function on_click_gpc_out_hold_process_id_calculate_in_weight(){
	$('.gpc_out_process_id').click(function(){
		calculate_gpc_out_in_weight();
	});
}function on_click_approval_process_id_calculate_in_weight(){
	$('.approval_process_id').click(function(){
		calculate_approval_in_weight();
	});
}function on_click_customer_out_hold_process_id_calculate_in_weight(){
	$('.customer_out_process_id').click(function(){
		calculate_customer_out_in_weight();
	});
}
function calculate_customer_out_in_weight(){
	var total_in_weight = 0;
	$('.customer_out_process_id:checked').each(function() {
		total_in_weight = total_in_weight + parseFloat($(this).closest("tr").find(".customer_out").text());
	});
	set_gpc_out_process_field_value('customer_out',total_in_weight);
}
function calculate_gpc_out_in_weight(){
	var total_in_weight = 0;
	$('.gpc_out_process_id:checked').each(function() {
		total_in_weight = total_in_weight + parseFloat($(this).closest("tr").find(".gpc_out").text());
	});
	set_gpc_out_process_field_value('gpc_out',total_in_weight);
}function calculate_approval_in_weight(){
	var total_in_weight = 0;
	$('.approval_process_id:checked').each(function() {
		total_in_weight = total_in_weight + parseFloat($(this).closest("tr").find(".approval_out").text());
	});
	set_gpc_out_process_field_value('gpc_out',total_in_weight);
}
function calculate_customer_out_in_weight(){
	var total_in_weight = 0;
	$('.customer_out_process_id:checked').each(function() {
		total_in_weight = total_in_weight + parseFloat($(this).closest("tr").find(".customer_out").text());
	});
	set_gpc_out_process_field_value('customer_out',total_in_weight);
}
function set_gpc_out_process_field_value(field_name, value) {
	$("."+field_name+"").val(value);
}



function onclick_select_all_check_all_checkboxes(){
	$('.select_all').click(function(){
		check_all_checkboxes();		
	})
}

function onclick_process_id_calculate_issue_department_fields(){
	$('.issue_department_details_process_id').click(function(){
		set_gross_weight_equal_to_out_melting_wastage($(this));
		calculate_issue_department_fields();
	});
}

function onchange_product_name_get_issue_department_details() {
	$('select[name*="issue_departments[product_name]"]').on('change', function() {
		var product_name = $(this).val();	
		window.location = base_url+ 'issue_departments/issue_departments/create?product_name='+product_name;	
	})
}
function onchange_account_get_issue_department_details() {
	$('select[name*="issue_departments[account_id]"]').on('change', function() {
		var account_name = $(this).val();	
		var product_name = $('select[name*="issue_departments[product_name]"]').val();	
		if(product_name=="Hallmark Receipt"){
		window.location = base_url+ 'issue_departments/issue_departments/create?product_name='+product_name+'&account='+account_name;	
		}
	});
}

function onchange_product_name_get_gpc_out_hold_process() {
	$('select[name*="gpc_out_hold_processes[product_name]"]').on('change', function() {
		var product_name = $(this).val();	
		var melting = $('select[name*="gpc_out_hold_processes[melting]"]').val();	
		if(melting!='' && melting!=undefined){
			melting='&melting='+melting;	
		}else{
			melting='';
		}if(product_name!='' && product_name!=undefined){
			product_name='product_name='+product_name;	
		}else{
			product_name='';
		}
		window.location = base_url+ 'gpc_outs/gpc_out_hold_processes/create?'+product_name+melting;	
	});
}
function onchange_melting_get_gpc_out_hold_process() {
	$('select[name*="gpc_out_hold_processes[melting]"]').on('change', function() {
		var product_name = $('select[name*="gpc_out_hold_processes[product_name]"]').val();	
			
		var melting = $(this).val();
		if(melting!='' && melting!=undefined){
			melting='&melting='+melting;	
		}else{
			melting='';
		}
		if(product_name!='' && product_name!=undefined){
			product_name=product_name;	
		}else{
			product_name='';
		}
		window.location = base_url+ 'gpc_outs/gpc_out_hold_processes/create?product_name='+product_name+melting;	
	});
}function onchange_melting_get_customer_out_hold_process() {
	$('select[name*="customer_out_hold_processes[melting]"]').on('change', function() {
		var customer_name = $('select[name*="customer_out_hold_processes[customer_name]"]').val();	
			
		var melting = $(this).val();
		if(melting!='' && melting!=undefined){
			melting='&melting='+melting;	
		}else{
			melting='';
		}
		if(customer_name!='' && customer_name!=undefined){
			customer_name=customer_name;	
		}else{
			customer_name='';
		}
		window.location = base_url+ 'ka_chains/customer_out_hold_processes/create?customer_name='+customer_name+melting;	
	});
}
function onchange_customer_name_get_customer_out_hold_process() {
	$('select[name*="customer_out_hold_processes[customer_name]"]').on('change', function() {
		var customer_name = $(this).val();	
		var melting = $('select[name*="customer_out_hold_processes[melting]"]').val();	
		if(melting!='' && melting!=undefined){
			melting='&melting='+melting;	
		}else{
			melting='';
		}if(customer_name!='' && customer_name!=undefined){
			customer_name='customer_name='+customer_name;	
		}else{
			customer_name='';
		}
		window.location = base_url+ 'ka_chains/customer_out_hold_processes/create?'+customer_name+melting;	
	});
}
// function onchange_chain_name_get_issue_department_details() {
// 	$('select[name*="issue_departments[chain_name]"]').on('change', function() {
// 		var chain_name = $(this).val();

// 		var chain_name = chain_name.replace(/\+/g, "^^");
// 		var product_name = $('select[name*="product_name"]').find(":selected").val();
// 		window.location = base_url+ 'issue_departments/issue_departments/create?product_name='+product_name+'&chain_name='+chain_name;	
// 	})
// }
function onchange_department_name_get_issue_department_details() {
	$('select[name*="issue_departments[department_name]"]').on('change', function() {
		var department_name = $(this).val();
		var product_name = $('select[name*="product_name"]').find(":selected").val();
		window.location = base_url+ 'issue_departments/issue_departments/create?product_name='+product_name+'&department_name='+department_name;	
	})
}
function onchange_parent_lot_name_issue_department_details() {
	$('select[name*="issue_departments[parent_lot_name]"]').on('change', function() {
		var parent_lot_name = $(this).val();
		var product_name = $('select[name*="product_name"]').find(":selected").val();
		var category_one = $('select[name*="category_one"]').find(":selected").val();
		window.location = base_url+ 'issue_departments/issue_departments/create?product_name='+product_name+'&category_one='+category_one+'&parent_lot_name='+parent_lot_name;	
	})
}
function onchange_category_one_get_purity() {
	$('select[name*="issue_departments[category_one]"]').on('change', function() {
		var category_one = $(this).val();	
		var category_one = category_one.replace(/\+/g, "^^");
		var product_name = $('select[name*="product_name"]').find(":selected").val();
		// var chain_name = $('select[name*="chain_name"]').find(":selected").val();
		window.location = base_url+ 'issue_departments/issue_departments/create?product_name='+product_name+'&category_one='+category_one;	
	})
}
function onchange_purity_get_issue_department_details() {
	$('select[name*="issue_departments[chain_purity]"]').on('change', function() {
		var chain_purity = $(this).val();
		var product_name = $('select[name*="product_name"]').find(":selected").val();
		// var chain_name = $('select[name*="chain_name"]').find(":selected").val();
		// var chain_name = chain_name.replace(/\+/g, "^^");
		
		
		var customer_name = $('select[name*="customer_name"]').find(":selected").val();
		var category_one = $('select[name*="category_one"]').find(":selected").val();
		if(category_one!='' && category_one!=undefined){
			category_one='&category_one='+category_one;	
		}else{
			category_one='';
		}

		if(customer_name!='' && customer_name!=undefined){
			customer_name='&customer_name='+customer_name;	
		}else{
			customer_name='';
		}
		// base_url=base_url+ 'issue_departments/issue_departments/create?product_name='+product_name+'&chain_purity='+chain_purity+category_one+customer_name+'&';	
		

		base_url=base_url+ 'issue_departments/issue_departments/create?product_name='+product_name+category_one+customer_name+'&chain_purity='+chain_purity+'&';	
		window.location = base_url;
	})
}
function onchange_customer_name_get_issue_department_details() {
	$('select[name*="issue_departments[customer_name]"]').on('change', function() {
		var customer_name = $(this).val();
		var chain_purity = $('select[name*="chain_purity"]').find(":selected").val();
		var product_name = $('select[name*="product_name"]').find(":selected").val();
		var category_one = $('select[name*="category_one"]').find(":selected").val();
		var account_name = $('index[name*="account_name"]').val();
		if(category_one!='' && category_one!=undefined){
			category_one='&category_one='+category_one;	
		}else{
			category_one='';
		}
		if(account_name!='' && account_name!=undefined){
			account_name='&customer_name='+account_name;	
		}else{
			account_name='';
		}
		
		base_url=base_url+ 'issue_departments/issue_departments/create?product_name='+product_name+'&chain_purity='+chain_purity+category_one+'&customer_name='+customer_name+account_name;	
		
		window.location = base_url;
	})
}

function onkeyup_field(field_name) {
	$('input[name*="'+field_name+'"]').keyup(function() {
		calculate_issue_fine();
		calculate_customer_wastage();
	});
}

function set_gross_weight_equal_to_out_melting_wastage($this){
	var product_name = $('select[name*="product_name"]').find(":selected").val();
	if (product_name == 'Melting Wastage' || 
		product_name == 'Daily Drawer Wastage' ||
	 	product_name == 'GPC Out' || 
	 	product_name == 'Finish Good' || 
	 	product_name == 'Finished Goods Receipt' || 
	 	product_name == 'GPC Repair Out' ||
	 	product_name == 'GPC Loss Out' ) {
		if ($this.is(':checked') == true){
			$this.closest("tr").find('input[name*="out_weight"]').val($this.closest("tr").find(".balance_weight").text());
			$this.closest("tr").find('input[name*="quantity"]').val($this.closest("tr").find(".balance_quantity").text());
			$this.closest("tr").find(".gross_weight").text($this.closest("tr").find(".balance_weight").text());
			$this.closest("tr").find(".gross_quantity").text($this.closest("tr").find(".balance_quantity").text());
		} else {
			$this.closest("tr").find('input[name*="out_weight"]').val(0);
			$this.closest("tr").find('input[name*="quantity"]').val(0);
		}
	}

	// if (product_name == 'Melting Wastage') {
	// 	if ($this.is(':checked') == true){
	// 		$this.closest("tr").find('input[name*="out_melting_wastage"]').val($this.closest("tr").find(".balance_melting_wastage").text());
	// 		$this.closest("tr").find(".gross_weight").text($this.closest("tr").find(".balance_melting_wastage").text());
	// 	} else {
	// 		$this.closest("tr").find('input[name*="out_melting_wastage"]').val(0);
	// 		$this.closest("tr").find(".gross_weight").text(0);		
	// 	}
	calculate_fine($this);
	
}

function calculate_fine($this){
	var product_name = $('select[name*="issue_departments[product_name]"]').val();

	var gorss_weight = parseFloat($this.closest("tr").find(".gross_weight").text());
	var fine = parseFloat($this.closest("tr").find(".fine").text());
	var out_purity = parseFloat($this.closest("tr").find(".purity").text());
	if(product_name=="Fire Tounch Loss"){
	$this.closest("tr").find(".fine").text((fine).toFixed(4));
	}else{
	$this.closest("tr").find(".fine").text((gorss_weight * out_purity / 100).toFixed(4));
	}
	calculate_issue_department_fields();
}

function calculate_issue_department_fields(){
	var total_gross_weight = 0;
	var total_quantity = 0;
	var total_purity = 0;
	var fine = 0;
	var wastage_fine = 0;
	$('.issue_department_details_process_id:checked').each(function() {
		total_gross_weight = total_gross_weight + parseFloat($(this).closest("tr").find(".gross_weight").text());
		total_quantity = total_quantity + parseFloat($(this).closest("tr").find(".gross_quantity").text());
		total_purity = total_purity + parseFloat($(this).closest("tr").find(".purity").text());
		fine = fine + parseFloat($(this).closest("tr").find(".fine").text());
		wastage_fine = wastage_fine + parseFloat($(this).closest("tr").find(".wastage_fine").text());
	});
	calculate_total_weights(total_gross_weight, total_purity, fine,wastage_fine,total_quantity);
	calculate_issue_fine();
	calculate_customer_wastage();
}

function calculate_total_weights(total_gross_weight, total_purity, fine,wastage_fine,quantity) {
	total_in_weight=0;
	total_quantity=0;
	total_in_purity=0;
	total_fine=0;
	total_wastage_fine=0;
	if (total_gross_weight != 0) {
		total_in_weight = (total_gross_weight).toFixed(4);
		total_quantity = (quantity).toFixed(1);
		total_wastage_fine = (wastage_fine).toFixed(4);
	 	total_in_purity = ((fine / total_gross_weight) * 100).toFixed(4); 
	 	total_fine = ((total_in_weight * total_in_purity) / 100).toFixed(4);	
	}
	set_issue_department_field_value('in_weight', total_gross_weight);
	set_issue_department_field_value('wastage_fine', total_wastage_fine);
	set_issue_department_field_value('in_purity', fine * 100 / total_gross_weight);
	set_issue_department_field_value('in_fine', total_in_weight * total_in_purity / 100);
	set_issue_department_field_value('quantity', total_quantity);
}


function calculate_issue_fine() {
	var in_weight = parseFloat($('input[name*="issue_departments[in_weight]"]').val());
	var out_purity = parseFloat($('input[name*="out_purity"]').val());
	out_purity = (isNaN(out_purity)) ? 0 : out_purity;
	out_fine = ((in_weight * out_purity) / 100).toFixed(4); 
	set_issue_department_field_value('out_fine', out_fine);
}

function calculate_customer_wastage() {
	var total_issue_fine = parseFloat($('input[name*="out_fine"]').val());
	var total_fine = parseFloat($('input[name*="in_fine"]').val());
	customer_wastage = (total_issue_fine - total_fine).toFixed(4); 
	set_issue_department_field_value('wastage_percentage', customer_wastage);
}

function check_all_checkboxes() {
	var count = 0;
	$('.issue_department_details_process_id').each(function() {
		count = count + 1;
		$(this).prop("checked", true);
		set_gross_weight_equal_to_out_melting_wastage($(this));
	});
	calculate_issue_department_fields();
}

function set_issue_department_field_value(input_name, value) {
	if (isNaN(value)) { value = 0; }
	if(input_name=='wastage_fine'){
		$('input[name*="wastage_fine"]').val(parseFloat(value).toFixed(4));	
	
	}else{
		$('input[name*="issue_departments[' + input_name + ']"]').val(parseFloat(value).toFixed(4));	
	}
}


$(document).ready(function(){

  $('#issue_department_print').click(function(e) { 
  	$(this).hide();
  	id=$('#issue_department_id').val();
  	window.location=url+'index?pdf=1&id='+id;
  });
  $('input[name*="issue_departments[account_id]"]').keyup(function(e) { 
	autocomplete_account_name('issue_department');
  	
  });
   $('input[name*="wastage_masters[customer_name]"]').keyup(function(e) { 
	autocomplete_account_name('wastage_master');
  	
  });
  $('input[name*="rnd_issues[account]"]').keyup(function(e) { 
	autocomplete_account_name('rnd');
  	
  });

  $('input[name*="packing_slips[account_name]"]').keyup(function(e) { 
	autocomplete_account_name('packing_slip');
  	
  });
});



function autocomplete_account_name(process_name=''){
  $(".autocomplete_account").autocomplete({
    source: function (request, response) {
      var getTable = $('.autocomplete').attr('data-table');
      var getColumn = $('.autocomplete').attr('data-column');
      jQuery.get(base_url+'issue_departments/issue_departments/index', {
        query: request.term
      }, function (data) {
        response(JSON.parse(data));
      });
    },
    select: function (event, ui) {
    	if(process_name=='issue_department'){
        onselect_account_name(ui.item.value);
    	}
    },
    minLength: 1
  });
}

function onselect_account_name(account_name){
  chain_purity='';
  department_name='';
  category_one='';
  var product_name = $('select[name*="issue_departments[product_name]"]').find(":selected").val();
  var chain_purity = $('select[name*="issue_departments[chain_purity]"]').find(":selected").val();
  var customer_name = $('select[name*="issue_departments[customer_name]"]').find(":selected").val();
  var department_name = $('select[name*="issue_departments[department_name]"]').find(":selected").val();
  var category_one = $('select[name*="issue_departments[category_one]"]').find(":selected").val();
  
  if(customer_name!=undefined){
	customer_name='&customer_name='+customer_name;
  }else{
  	customer_name='';
  }

  if(chain_purity!=undefined){
	chain_purity='&chain_purity='+chain_purity;
  }else{
  	chain_purity='';
  }
  if(department_name!=undefined){
	department_name='&department_name='+department_name;
  }else{
  	department_name='';
  }if(category_one!=undefined){
	category_one='&category_one='+category_one;
  }else{
  	category_one='';
  }
  window.location= base_url+'issue_departments/issue_departments/create?product_name='+product_name+'&account_name='+account_name+chain_purity+customer_name+department_name+category_one;
}



