
$("select[name='rolling_reports[product_name]']").on('change', function() {
    var product_name = $("select[name='rolling_reports[product_name]']").val();
    window.location = base_url+ 'reports/rolling_reports?product_name='+product_name+'&detail=no';
  });
$("select[name='melting_lot_time_reports[product_name]']").on('change', function() {
    var product_name = $("select[name='melting_lot_time_reports[product_name]']").val();
    var genarate_lot_no = $("select[name='melting_lot_time_reports[genarate_lot_no]']").val();
    var order_type = $("select[name='melting_lot_time_reports[order_type]']").val();
    var customer_name = $("select[name='melting_lot_time_reports[customer_name]']").val();
    window.location = base_url+ 'reports/melting_lot_time_reports?genarate_lot_no='+genarate_lot_no+'&product_name='+product_name+'&order_type='+order_type+'&customer_name='+customer_name;
 });
$("select[name='melting_lot_time_reports[genarate_lot_no]']").on('change', function() {
	var product_name = $("select[name='melting_lot_time_reports[product_name]']").val();
    var genarate_lot_no = $("select[name='melting_lot_time_reports[genarate_lot_no]']").val();
    var order_type = $("select[name='melting_lot_time_reports[order_type]']").val();
    var customer_name = $("select[name='melting_lot_time_reports[customer_name]']").val();
   window.location = base_url+ 'reports/melting_lot_time_reports?genarate_lot_no='+genarate_lot_no+'&product_name='+product_name+'&order_type='+order_type+'&customer_name='+customer_name;
 });
$("select[name='melting_lot_time_reports[order_type]']").on('change', function() {
	var product_name = $("select[name='melting_lot_time_reports[product_name]']").val();
    var genarate_lot_no = $("select[name='melting_lot_time_reports[genarate_lot_no]']").val();
    var order_type = $("select[name='melting_lot_time_reports[order_type]']").val();
    var customer_name = $("select[name='melting_lot_time_reports[customer_name]']").val();
   window.location = base_url+ 'reports/melting_lot_time_reports?genarate_lot_no='+genarate_lot_no+'&product_name='+product_name+'&order_type='+order_type+'&customer_name='+customer_name;
 });
$("select[name='melting_lot_time_reports[customer_name]']").on('change', function() {
	var product_name = $("select[name='melting_lot_time_reports[product_name]']").val();
    var genarate_lot_no = $("select[name='melting_lot_time_reports[genarate_lot_no]']").val();
    var order_type = $("select[name='melting_lot_time_reports[order_type]']").val();
    var customer_name = $("select[name='melting_lot_time_reports[customer_name]']").val();
   window.location = base_url+ 'reports/melting_lot_time_reports?genarate_lot_no='+genarate_lot_no+'&product_name='+product_name+'&order_type='+order_type+'&customer_name='+customer_name;
 });
$("select[name='daily_change_rolling_balance_reports[chain_name]']").on('change', function() {
    var chain_name = $("select[name='daily_change_rolling_balance_reports[chain_name]']").val();
    window.location = base_url+ 'reports/daily_change_rolling_balance_reports?chain_name='+chain_name;
  });
$('.rolling_search').click(function(){
		get_processes_for_rolling();		
});

function get_processes_for_rolling() {
	product_name='';
	lot_no='';
	var product_name = $('select[name*="rolling_reports[product_name]"]').val();
	var lot_no = $('input[name*="rolling_reports[lot_no]"]').val();
	if(product_name!=''){
		product_name='product_name='+product_name;
	}
	if(lot_no!=''){
		lot_no='&lot_no='+lot_no;
	}
	search=product_name+lot_no;

	window.location = base_url+'reports/rolling_reports?'+search;
}

$('.gpc_out_city_report_date').on('click', function() {
    var from_date = $('#arc_stock_reports_from_date').val();
	var to_date = $('#arc_stock_reports_to_date').val();
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
    window.location = base_url+ 'reports/packing_detail_reports?'+date_wise;
});
