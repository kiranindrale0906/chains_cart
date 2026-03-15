function onload_stone_vatav_processes() {
	onchange_stone_vatav_purity();
	on_click_stone_vatav_process_id_calculate_in_weight();
	onclick_stone_vatav_select_all_check_all_checkboxes();
	onchange_in_purity_get_stone_vatav_processes();
	onchange_process_name_get_stone_vatav_processes();
	onchange_karigar_get_stone_vatav_processes();
	onchange_in_purity_get_stone_processes();
	onchange_process_name_get_stone_processes();
}

function onchange_stone_vatav_purity(){
	$('.stone_vatav_melting_lots_purity').on('change', function() {
		var purity = $(this).val();	
		if(purity!=''){
		window.location = base_url+'stone_vatav_outs/stone_vatav_processes/create?in_lot_purity='+purity;	
		}
	})
}
function onchange_in_purity_get_stone_processes() {
	$('select[name="stone_ledgers[in_purity]"]').on('change', function() {
		var in_purity = $(this).val();	
		var process_name = $('select[name="stone_ledgers[in_purity]"]').val();	
		window.location = base_url+ 'issue_and_receipts/stone_ledgers/create?in_purity='+in_purity+'&process_name='+process_name;	
	})
}
function onchange_process_name_get_stone_processes() {
	$('select[name="stone_ledgers[process_name]"]').on('change', function() {
		var process_name = $(this).val();	
		var in_purity = $('select[name="stone_ledgers[in_purity]"]').val();
		window.location = base_url+ 'issue_and_receipts/stone_ledgers/create?in_purity='+in_purity+'&process_name='+process_name;	
	})
}

function onchange_in_purity_get_stone_vatav_processes() {
	$('select[name="stone_vatav_ledgers[in_lot_purity]"]').on('change', function() {
		var in_purity = $(this).val();	
		var process_name = $('select[name="stone_vatav_ledgers[process_name]"]').val();	
		var from_date = $('input[name*="stone_vatav_ledgers[from_date]').val();
    var to_date = $('input[name*="stone_vatav_ledgers[to_date]"]').val();
   if((from_date=="" && to_date!='')||(from_date!="" && to_date=='')){
      alert("Please select both dates.");
      return false;
    }

    if(moment(from_date, 'DD MMM YYYY').unix() > moment(to_date, 'DD MMM YYYY').unix())
    {
      alert("From Date Can't be greater than To date");
      return false;
    }
    date_wise='';
    if(from_date!=""&&to_date!=''){
      date_wise='&from_date='+from_date+'&to_date='+to_date;
    }
		var karigar = $('select[name="stone_vatav_ledgers[karigar]"]').val();	
		window.location = base_url+ 'reports/stone_vatav_ledgers?in_lot_purity='+in_purity+'&process_name='+process_name+'&karigar='+karigar+date_wise;
	})
}
function onchange_process_name_get_stone_vatav_processes() {
	$('select[name="stone_vatav_ledgers[process_name]"]').on('change', function() {
		var process_name = $(this).val();	
		var from_date = $('input[name*="stone_vatav_ledgers[from_date]').val();
    var to_date = $('input[name*="stone_vatav_ledgers[to_date]"]').val();
   if((from_date=="" && to_date!='')||(from_date!="" && to_date=='')){
      alert("Please select both dates.");
      return false;
    }

    if(moment(from_date, 'DD MMM YYYY').unix() > moment(to_date, 'DD MMM YYYY').unix())
    {
      alert("From Date Can't be greater than To date");
      return false;
    }
    date_wise='';
    if(from_date!=""&&to_date!=''){
      date_wise='&from_date='+from_date+'&to_date='+to_date;
    }
		var in_purity = $('select[name="stone_vatav_ledgers[in_lot_purity]"]').val();	
		var karigar = $('select[name="stone_vatav_ledgers[karigar]"]').val();	
		window.location = base_url+ 'reports/stone_vatav_ledgers?in_lot_purity='+in_purity+'&process_name='+process_name+'&karigar='+karigar+date_wise;	
	})
}
function onchange_karigar_get_stone_vatav_processes() {
	$('select[name="stone_vatav_ledgers[karigar]"]').on('change', function() {
		var karigar = $(this).val();	
		var from_date = $('input[name*="stone_vatav_ledgers[from_date]').val();
    var to_date = $('input[name*="stone_vatav_ledgers[to_date]"]').val();
   if((from_date=="" && to_date!='')||(from_date!="" && to_date=='')){
      alert("Please select both dates.");
      return false;
    }

    if(moment(from_date, 'DD MMM YYYY').unix() > moment(to_date, 'DD MMM YYYY').unix())
    {
      alert("From Date Can't be greater than To date");
      return false;
    }
    date_wise='';
    if(from_date!=""&&to_date!=''){
      date_wise='&from_date='+from_date+'&to_date='+to_date;
    }
		var in_purity = $('select[name="stone_vatav_ledgers[in_lot_purity]"]').val();
		var process_name = $('select[name="stone_vatav_ledgers[process_name]"]').val();
		window.location = base_url+ 'reports/stone_vatav_ledgers?in_lot_purity='+in_purity+'&process_name='+process_name+'&karigar='+karigar+date_wise;	
	})
}



function on_click_stone_vatav_process_id_calculate_in_weight(){
	$('.stone_vatav_process_id').click(function(){
		calculate_stone_vatav_in_weight();
	});
}

function onclick_stone_vatav_select_all_check_all_checkboxes(){
  $('.stone_vatav_select_all').click(function(){
    check_stone_vatav_all_checkboxes();   
  })
}

function check_stone_vatav_all_checkboxes() {
  $('.stone_vatav_process_id').each(function() {
    $(this).prop("checked", true);
  });
  calculate_stone_vatav_in_weight();
}

function calculate_stone_vatav_in_weight(){
	var total_in_weight = 0;
	$('.stone_vatav_process_id:checked').each(function() {
		total_in_weight = total_in_weight + parseFloat($(this).closest("tr").find(".balance_stone_vatav").text());
	});
	set_stone_vatav_process_field_value('stone_vatav_in_weight',total_in_weight);
}

function set_stone_vatav_process_field_value(field_name, value) {
	$("."+field_name+"").val((value).toFixed(4));
}

