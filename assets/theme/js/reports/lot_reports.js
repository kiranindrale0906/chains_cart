function onload_lot_reports() {
  onchange_of_product_name_get_melting_lot_loss_records();
  onchange_of_department_daily_process_records();
  onchange_of_purity_daily_process_records();
  onchange_of_category_daily_process_records();
}

function onchange_of_product_name_get_melting_lot_loss_records() {
  $("select[name='lot_reports[melting_lot_product_name]']").on('change', function() {
    var product_name = $("select[name='lot_reports[melting_lot_product_name]']").val();
    window.location = base_url+ 'reports/lot_reports?product_name='+product_name;
  });
}
function onchange_of_department_daily_process_records() {
  $("select[name='daily_process_reports[department_name]']").on('change', function() {
    var category_one = $("select[name='daily_process_reports[category_one]']").val();
    var department_name = $("select[name='daily_process_reports[department_name]']").val();
    var day = $("input[name='daily_process_reports[day]']").val();
    var type = $("input[name='daily_process_reports[type]']").val();
    var in_purity = $("select[name='daily_process_reports[in_purity]']").val();
     	if(in_purity!="" || in_purity!="undefind"){
    		in_purity="&in_purity="+in_purity;
	    }else{
	    	in_purity=""
	    }
    window.location = base_url+ 'reports/daily_process_reports?type='+type+'&category_one='+category_one+'&day='+day+'&department_name='+department_name+in_purity;
  });
}
function onchange_of_category_daily_process_records() {
  $("select[name='daily_process_reports[category_one]']").on('change', function() {
    var category_one = $("select[name='daily_process_reports[category_one]']").val();
    var department_name = $("select[name='daily_process_reports[department_name]']").val();
    var day = $("input[name='daily_process_reports[day]']").val();
    var type = $("input[name='daily_process_reports[type]']").val();
    var in_purity = $("select[name='daily_process_reports[in_purity]']").val();
      if(in_purity!="" || in_purity!="undefind"){
        in_purity="&in_purity="+in_purity;
      }else{
        in_purity=""
      }
    window.location = base_url+ 'reports/daily_process_reports?type='+type+'&day='+day+'&category_one='+category_one+'&department_name='+department_name+in_purity;
  });
}
function onchange_of_purity_daily_process_records() {
  $("select[name='daily_process_reports[in_purity]']").on('change', function() {
    var in_purity = $("select[name='daily_process_reports[in_purity]']").val();
    var day = $("input[name='daily_process_reports[day]']").val();
    var type = $("input[name='daily_process_reports[type]']").val();
    var category_one = $("select[name='daily_process_reports[category_one]']").val();
    
    
    var department_name = $("select[name='daily_process_reports[department_name]']").val();
    	if(department_name!="" || department_name!="undefind"){
    		department_name="&department_name="+department_name;
	    }else{
	    	department_name=""
	    }
    window.location = base_url+ 'reports/daily_process_reports?type='+type+'&category_one='+category_one+'&day='+day+'&in_purity='+in_purity+department_name;
  });
}
