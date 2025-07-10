function onload_ghiss_out_processes() {
	onchange_ghiss_out_department_name();
	on_click_ghiss_out_process_id_calculate_in_weight();
	onclick_ghiss_out_select_all_check_all_checkboxes();
	onchange_ghiss_ledger_department_name();
	on_click_ghiss_ledger_processes_search();
}
function on_click_ghiss_ledger_processes_search(){
	$('.ghiss_ledger_processes_search').click(function(){
		get_ghiss_department_names_and_refresh_page();		
	});
}

function onchange_ghiss_out_department_name(){
	$('.ghiss_melting_lots_department_name').on('change', function() {
		var department_name = $(this).val();	
		if(department_name!=''){
		window.location = base_url+'ghiss_outs/ghiss_out_processes/create?department_name='+department_name;	
		}
	})
}

function onchange_ghiss_ledger_department_name(){
	$('.ghiss_ledger_department_name').on('change', function() {
		var department_name = $(this).val();	
		if(department_name!=''){
		window.location = base_url+'issue_and_receipts/department_wise_ghiss_ledgers/create?department_name='+department_name;	
		}
	})
}

function get_ghiss_department_names_and_refresh_page() {
	var start_date = $('input[name*="department_wise_ghiss_ledgers[start_date]').val();
    var end_date = $('input[name*="department_wise_ghiss_ledgers[end_date]"]').val();
    var department_names = $('select[name*="department_name"]').val();
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

	window.location = base_url+'issue_and_receipts/department_wise_ghiss_ledgers/create?department_name='+department_names+date_wise;
}

function on_click_ghiss_out_process_id_calculate_in_weight(){
	$('.ghiss_out_process_id').click(function(){
		calculate_ghiss_out_in_weight();
	});
}

function onclick_ghiss_out_select_all_check_all_checkboxes(){
  $('.ghiss_out_select_all').click(function(){
    check_ghiss_out_all_checkboxes();   
  })
}

function check_ghiss_out_all_checkboxes() {
  $('.ghiss_out_process_id').each(function() {
    $(this).prop("checked", true);
  });
  calculate_ghiss_out_in_weight();
}

function calculate_ghiss_out_in_weight(){
	var total_in_weight = 0;
	$('.ghiss_out_process_id:checked').each(function() {
		total_in_weight = total_in_weight + parseFloat($(this).closest("tr").find(".balance_ghiss").text());
	});
	set_ghiss_out_process_field_value('ghiss_out_in_weight',total_in_weight);
}

function set_ghiss_out_process_field_value(field_name, value) {
	$("."+field_name+"").val((value).toFixed(4));
}

$(".onchange_department_name").change(function(e){
  var value = $(this).val();
  if(value!="All"){
  window.location = base_url+'issue_and_receipts/department_wise_ghiss_ledgers/create?department_name='+value;
  }else{
  window.location = base_url+'issue_and_receipts/department_wise_ghiss_ledgers/create';
  }
});

