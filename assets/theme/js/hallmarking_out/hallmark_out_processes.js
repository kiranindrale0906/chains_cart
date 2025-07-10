function onload_hallmark_out_processes() {
	onchange_hallmark_out_department_name();
	on_click_hallmark_out_process_id_calculate_in_weight();
	onclick_hallmark_out_select_all_check_all_checkboxes();
}
// function on_click_hallmark_ledger_processes_search(){
// 	$('.ghiss_ledger_processes_search').click(function(){
// 		get_ghiss_department_names_and_refresh_page();		
// 	});
// }

function onchange_hallmark_out_department_name(){
	$('.hallmark_out_account').on('change', function() {
		var account = $(this).val();	
		if(account!=''){
		window.location = base_url+'hallmarking/hallmark_out_processes/create?account='+account;	
		}
	})
}


function on_click_hallmark_out_process_id_calculate_in_weight(){
	$('.hallmark_out_process_id').click(function(){
		calculate_hallmark_out_in_weight();
	});
}

function onclick_hallmark_out_select_all_check_all_checkboxes(){
  $('.hallmark_out_select_all').click(function(){
    check_hallmark_out_all_checkboxes();   
  })
}

function check_hallmark_out_all_checkboxes() {
  $('.hallmark_out_process_id').each(function() {
    $(this).prop("checked", true);
  });
  calculate_hallmark_out_in_weight();
}

function calculate_hallmark_out_in_weight(){

	var total_in_weight = 0;
	$('.hallmark_out_process_id:checked').each(function() {
		total_in_weight = total_in_weight + parseFloat($(this).closest("tr").find(".balance_hallmark_out").text());
	});
	set_hallmark_out_process_field_value('hallmark_out_in_weight',total_in_weight);
}

function set_hallmark_out_process_field_value(field_name, value) {
	$("."+field_name+"").val((value).toFixed(4));
}

$(".hallmark_out_account").change(function(e){
  var value = $(this).val();
  if(value!="All"){
  window.location = base_url+'hallmarking/hallmark_out_processes/create?account='+value;
  }else{
  window.location = base_url+'hallmarking/hallmark_out_processes/create';
  }
});

