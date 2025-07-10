function onload_loss_out_processes() {
	// on_click_department_id();
	// enabled_disabled_search_button();
	on_click_loss_out_process_id_calculate_in_weight();
	onclick_loss_out_select_all_check_all_checkboxes();
  on_click_loss_out_processes_search();
	on_click_melting_loss_out_processes_search();
	on_click_loss_ledger_processes_search();
	on_click_combine_loss_ledger_processes_search();
}

// function on_click_department_id() {
// 	$('select[name*="loss_out_processes[department_id]"]').on('change', function() {
// 		department_names=$(this).val();
// 		var start_date = $('input[name*="loss_out_processes[start_date]').val();
//     	var end_date = $('input[name*="loss_out_processes[end_date]"]').val();
//     if((start_date=="" && end_date!='')||(start_date!="" && end_date=='')){
//       alert("Please select both dates.");
//       return false;
//     }

//     if(moment(start_date, 'DD MMM YYYY').unix() > moment(end_date, 'DD MMM YYYY').unix())
//     {
//       alert("From Date Can't be greater than To date");
//       return false;
//     }
//     date_wise='';
//     if(start_date!=""&&end_date!=''){
//    	  date_wise='&start_date='+start_date+'&end_date='+end_date;
// 	}
// 	if(start_date!=''){
// 		window.location = base_url+'loss_outs/loss_out_processes/create?department_names='+department_names+date_wise;
// 	}else{
// 	window.location = base_url+'loss_outs/loss_out_processes/create?department_names='+department_names+date_wise;
// 	}
// });
// }

function on_click_loss_out_processes_search(){
  $('.loss_out_processes_search').click(function(){
    get_department_names_and_refresh_page();    
  });
}function on_click_melting_loss_out_processes_search(){
	$('.melting_loss_out_processes_search').click(function(){
		get_date_and_refresh_page();		
	});
}
function on_click_loss_ledger_processes_search(){
	$('select[name*="loss_ledgers[department_name]"]').change(function(){
		get_department_names_and_refresh_ledger_page();		
	});
}function on_click_combine_loss_ledger_processes_search(){
	$('select[name*="combine_loss_ledgers[department_name]"]').change(function(){
		get_department_names_and_refresh_combine_loss_ledger_page();		
	});
}

// function enabled_disabled_search_button() {
// 	if ($('.loss_out_processes_department_id:checked').length > 0) {
// 		$(".loss_out_processes_search").removeClass("disabled");
// 	} else {
// 		$(".loss_out_processes_search").addClass("disabled");
// 	}
// }
function get_date_and_refresh_page() {
  var start_date = $('input[name*="melting_loss_outs[start_date]').val();
    var end_date = $('input[name*="melting_loss_outs[end_date]"]').val();
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
    if(start_date!=""&&end_date!=''){
      date_wise='&start_date='+start_date+'&end_date='+end_date;
    }
  //  $('select[name*="loss_out_processes_department_id"]').on('change', function() {
  //  department_names.push(""+$(this).val()+"");
  // });

  // department_names = encodeURIComponent(JSON.stringify(department_names));

  window.location = base_url+'loss_outs/melting_loss_outs/create?'+date_wise;
}

function get_department_names_and_refresh_page() {
	var start_date = $('input[name*="loss_out_processes[start_date]').val();
    var end_date = $('input[name*="loss_out_processes[end_date]"]').val();
    var department_names = $('select[name*="loss_out_processes[department_id]"]').val();
    var product_name = $('select[name*="loss_out_processes[product_name]"]').val();
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
    if(start_date!=""&&end_date!=''){
   	  date_wise='&start_date='+start_date+'&end_date='+end_date;
		}
	// 	$('select[name*="loss_out_processes_department_id"]').on('change', function() {
	// 	department_names.push(""+$(this).val()+"");
	// });

	// department_names = encodeURIComponent(JSON.stringify(department_names));

	window.location = base_url+'loss_outs/loss_out_processes/create?department_names='+department_names+'&product_name='+product_name+date_wise;
}
function get_department_names_and_refresh_ledger_page() {
	// var start_date = $('input[name*="loss_ledgers[start_date]').val();
 //    var end_date = $('input[name*="loss_ledgers[end_date]"]').val();
    var department_names = $('select[name*="loss_ledgers[department_name]"]').val();
  //   if((start_date=="" && end_date!='')||(start_date!="" && end_date=='')){
  //     alert("Please select both dates.");
  //     return false;
  //   }

  //   if(moment(start_date, 'DD MMM YYYY').unix() > moment(end_date, 'DD MMM YYYY').unix())
  //   {
  //     alert("From Date Can't be greater than To date");
  //     return false;
  //   }
  //   date_wise='';
  //   if(start_date!=""&&end_date!=''){
  //  	  date_wise='&start_date='+start_date+'&end_date='+end_date;
		// }
	// 	$('select[name*="loss_ledgers_department_id"]').on('change', function() {
	// 	department_names.push(""+$(this).val()+"");
	// });

	// department_names = encodeURIComponent(JSON.stringify(department_names));

	window.location = base_url+'issue_and_receipts/loss_ledgers/create?department_name='+department_names;
}
function get_department_names_and_refresh_combine_loss_ledger_page() {
	// var start_date = $('input[name*="loss_ledgers[start_date]').val();
 //    var end_date = $('input[name*="loss_ledgers[end_date]"]').val();
    var department_names = $('select[name*="combine_loss_ledgers[department_name]"]').val();
  //   if((start_date=="" && end_date!='')||(start_date!="" && end_date=='')){
  //     alert("Please select both dates.");
  //     return false;
  //   }

  //   if(moment(start_date, 'DD MMM YYYY').unix() > moment(end_date, 'DD MMM YYYY').unix())
  //   {
  //     alert("From Date Can't be greater than To date");
  //     return false;
  //   }
  //   date_wise='';
  //   if(start_date!=""&&end_date!=''){
  //  	  date_wise='&start_date='+start_date+'&end_date='+end_date;
		// }
	// 	$('select[name*="loss_ledgers_department_id"]').on('change', function() {
	// 	department_names.push(""+$(this).val()+"");
	// });

	// department_names = encodeURIComponent(JSON.stringify(department_names));

	window.location = base_url+'issue_and_receipts/combine_loss_ledgers/create?department_name='+department_names;
}

function on_click_loss_out_process_id_calculate_in_weight(){
	$('.loss_out_process_id').click(function(){
		calculate_loss_out_in_weight();
	});
}

function onclick_loss_out_select_all_check_all_checkboxes(){
  $('.loss_out_select_all').click(function(){
    check_loss_out_all_checkboxes();   
  })
}

function check_loss_out_all_checkboxes() {
  $('.loss_out_process_id').each(function() {
    $(this).prop("checked", true);
  });
  calculate_loss_out_in_weight();
}

function calculate_loss_out_in_weight(){
	var total_in_weight = 0;
	$('.loss_out_process_id:checked').each(function() {
		total_in_weight = total_in_weight + parseFloat($(this).closest("tr").find(".balance_loss").text());
	});
	set_loss_out_process_field_value('loss_out_in_weight',total_in_weight);
}

function set_loss_out_process_field_value(field_name, value) {
	$("."+field_name+"").val((value).toFixed(4));
}

