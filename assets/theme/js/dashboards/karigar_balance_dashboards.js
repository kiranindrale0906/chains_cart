function onload_karigar_balance_dashboards(){
	onchange_karigar_filter();
	onchange_worker_filter();
	onchange_department_filter();
	onchange_arc_order_filter();
}

function onchange_karigar_filter() {
	$('select[name*="karigar_balance_dashboards[karigar]"]').on('change', function() {
		var karigar = $(this).val();	
		window.location = base_url+ 'dashboards/karigar_balance_dashboards?karigar='+karigar;	
	})
}
function onchange_department_filter() {
	$('select[name*="department_dashboards[in_lot_purity]"]').on('change', function() {
		var in_lot_purity = $(this).val();	
		var lot_no = $('input[name*="lot_no"]').val();	
		window.location = base_url+ 'dashboards/department_dashboards?in_lot_purity='+in_lot_purity+'&lot_no='+lot_no;	
	})
}
function onchange_worker_filter() {
	$('select[name*="worker_balance_dashboards[worker]"]').on('change', function() {
		var worker = $(this).val();	
		window.location = base_url+ 'dashboards/worker_balance_dashboards?worker='+worker;	
	})
}
function onchange_arc_order_filter() {
	$('select[name*="arc_order_dashboard_reports[process_name]"]').on('change', function() {
		var process_name = $(this).val();	
		var type = $('input[name*="arc_order_dashboard_reports[type]"]').val();	
		var purity =$('select[name*="arc_order_dashboard_reports[purity]"]').val();
		var colour =$('select[name*="arc_order_dashboard_reports[colour]"]').val();
		var customer_name =$('select[name*="arc_order_dashboard_reports[customer_name]"]').val();
		var order_no =$('select[name*="arc_order_dashboard_reports[order_no]"]').val();
		var status =$('select[name*="arc_order_dashboard_reports[status]"]').val();
		window.location = base_url+ 'reports/arc_order_dashboard_reports?type='+type+'&process_name='+process_name+'&purity='+purity+'&colour='+colour+'&customer_name='+customer_name+'&status='+status+'&order_no='+order_no;	
	});
	$('select[name*="arc_order_dashboard_reports[purity]"]').on('change', function() {
		var purity = $(this).val();	
		var type = $('input[name*="arc_order_dashboard_reports[type]"]').val();	
		var process_name =$('select[name*="arc_order_dashboard_reports[process_name]"]').val();
		var colour =$('select[name*="arc_order_dashboard_reports[colour]"]').val();
		var customer_name =$('select[name*="arc_order_dashboard_reports[customer_name]"]').val();
		var order_no =$('select[name*="arc_order_dashboard_reports[order_no]"]').val();
		var status =$('select[name*="arc_order_dashboard_reports[status]"]').val();
		
		window.location = base_url+ 'reports/arc_order_dashboard_reports?type='+type+'&process_name='+process_name+'&purity='+purity+'&colour='+colour+'&customer_name='+customer_name+'&status='+status+'&order_no='+order_no;	
	});
	$('select[name*="arc_order_dashboard_reports[colour]"]').on('change', function() {
		var colour = $(this).val();	
		var type = $('input[name*="arc_order_dashboard_reports[type]"]').val();	
		var purity =$('select[name*="arc_order_dashboard_reports[purity]"]').val();
		var process_name =$('select[name*="arc_order_dashboard_reports[process_name]"]').val();
		var customer_name =$('select[name*="arc_order_dashboard_reports[customer_name]"]').val();
		var order_no =$('select[name*="arc_order_dashboard_reports[order_no]"]').val();
		var status =$('select[name*="arc_order_dashboard_reports[status]"]').val();
		
		window.location = base_url+ 'reports/arc_order_dashboard_reports?type='+type+'&process_name='+process_name+'&purity='+purity+'&colour='+colour+'&customer_name='+customer_name+'&status='+status+'&order_no='+order_no;	
	});
	$('select[name*="arc_order_dashboard_reports[customer_name]"]').on('change', function() {
			var customer_name = $(this).val();	
			var type = $('input[name*="arc_order_dashboard_reports[type]"]').val();	
			var purity =$('select[name*="arc_order_dashboard_reports[purity]"]').val();
			var colour =$('select[name*="arc_order_dashboard_reports[colour]"]').val();
			var process_name =$('select[name*="arc_order_dashboard_reports[process_name]"]').val();
			var order_no =$('select[name*="arc_order_dashboard_reports[order_no]"]').val();
		    var status =$('select[name*="arc_order_dashboard_reports[status]"]').val();
		
			window.location = base_url+ 'reports/arc_order_dashboard_reports?type='+type+'&process_name='+process_name+'&purity='+purity+'&colour='+colour+'&customer_name='+customer_name+'&status='+status+'&order_no='+order_no;		
		});
	$('select[name*="arc_order_dashboard_reports[order_no]"]').on('change', function() {
			var order_no = $(this).val();	
			var type = $('input[name*="arc_order_dashboard_reports[type]"]').val();	
			var purity =$('select[name*="arc_order_dashboard_reports[purity]"]').val();
			var colour =$('select[name*="arc_order_dashboard_reports[colour]"]').val();
			var process_name =$('select[name*="arc_order_dashboard_reports[process_name]"]').val();
			var customer_name =$('select[name*="arc_order_dashboard_reports[customer_name]"]').val();
		    var status =$('select[name*="arc_order_dashboard_reports[status]"]').val();
		
			window.location = base_url+ 'reports/arc_order_dashboard_reports?type='+type+'&process_name='+process_name+'&purity='+purity+'&colour='+colour+'&customer_name='+customer_name+'&status='+status+'&order_no='+order_no;		
		});
	$('select[name*="arc_order_dashboard_reports[status]"]').on('change', function() {
			var status = $(this).val();	
			var type = $('input[name*="arc_order_dashboard_reports[type]"]').val();	
			var purity =$('select[name*="arc_order_dashboard_reports[purity]"]').val();
			var colour =$('select[name*="arc_order_dashboard_reports[colour]"]').val();
			var process_name =$('select[name*="arc_order_dashboard_reports[process_name]"]').val();
			var customer_name =$('select[name*="arc_order_dashboard_reports[customer_name]"]').val();
		    var order_no =$('select[name*="arc_order_dashboard_reports[order_no]"]').val();
		
			window.location = base_url+ 'reports/arc_order_dashboard_reports?type='+type+'&process_name='+process_name+'&purity='+purity+'&colour='+colour+'&customer_name='+customer_name+'&status='+status+'&order_no='+order_no;		
		});
	$('select[name*="arc_order_dashboards[customer_name]"]').on('change', function() {
			var customer_name = $(this).val();	
			var order_no =$('select[name*="arc_order_dashboards[order_no]"]').val();
			if(order_no==undefined){
			order_no="";
			}
		   window.location = base_url+ 'dashboards/arc_order_dashboards?order_no='+order_no+'&customer_name='+customer_name;		
		});
	$('select[name*="arc_order_dashboards[order_no]"]').on('change', function() {
			var order_no = $(this).val();	
			var customer_name =$('select[name*="arc_order_dashboards[customer_name]"]').val();
			if(customer_name==undefined){
			customer_name="";
			}
		   window.location = base_url+ 'dashboards/arc_order_dashboards?order_no='+order_no+'&customer_name='+customer_name;		
		});
	}
