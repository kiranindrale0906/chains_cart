<?php
function APPLICATION_CSS($type='application'){
	$css =  array(
		CORE_PATH().'plugins/bootstrap-4.3.1/css/bootstrap.min.css',
		CORE_PATH().'plugins/bootstrap-select-1.13.10/dist/css/bootstrap-select.css',
		CORE_PATH().'plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',

		CORE_PATH().'plugins/toastr-2.1.3/toastr.min.css',

		CORE_PATH().'plugins/perfect-scrollbar-0.6.10/perfect-scrollbar.css',

		CORE_PATH().'plugins/fontawesome-pro-5.6.1-web/css/all.css',
		CORE_PATH().'plugins/slim/slim.min.css',
		CORE_PATH().'plugins/jquery-ui-1.12.1/jquery-ui.min.css',

	    CORE_PATH().'plugins/bootstrap-sweetalert/sweet-alert.css',
	    CORE_PATH().'plugins/duration_picker/jquery.durationpicker.min.css',

		CORE_PATH().'css/base.css',
		CORE_PATH().'css/style.css',
		THEME_PATH().'css/style.css',
		THEME_PATH().'css/print.css'
	);
	return $css;
}

function APPLICATION_JS($type='application'){
	return array(
		CORE_PATH().'plugins/js/jquery-3.3.1.min.js',
		CORE_PATH().'plugins/jquery-ui-1.12.1/jquery-ui.min.js',
		CORE_PATH().'plugins/bootstrap-4.3.1/js/popper.min.js',
		CORE_PATH().'plugins/bootstrap-4.3.1/js/bootstrap.min.js',

		CORE_PATH().'plugins/bootstrap-select-1.13.10/dist/js/bootstrap-select.min.js',
		CORE_PATH().'js/config/selectpicker.js',
		CORE_PATH().'plugins/duration_picker/jquery.durationpicker.min.js',
		CORE_PATH().'plugins/js/moment.min.js',
		CORE_PATH().'plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
		CORE_PATH().'js/config/datetimepicker.js',

		CORE_PATH().'plugins/slim/slim.kickstart.min.js',
		CORE_PATH().'js/core/slimcropper.js',


		CORE_PATH().'plugins/jquery.scrollbar-0.2.11/jquery.scrollbar.min.js',
		CORE_PATH().'js/config/scrollbar.js',

		CORE_PATH().'plugins/fancybox/jquery.fancybox.min.js',


		CORE_PATH().'js/core/hideshow.js',
		//CORE_PATH().'js/core/sidemenu.js',
		CORE_PATH().'js/core/sidebar.js',

		CORE_PATH().'js/core/truncate_text.js',
		CORE_PATH().'plugins/printThis/printThis.js',
		CORE_PATH().'js/core/autocomplete.js',
		CORE_PATH().'js/core/barcode.js',
		CORE_PATH().'js/core/modal.js',
		THEME_PATH().'js/autofocus_field/autofocus_field.js',

		CORE_PATH().'js/core/filter.js',
		CORE_PATH().'js/core/ajax_library.js',
		CORE_PATH().'js/core/tablefilter.js',

		CORE_PATH().'plugins/toastr-2.1.3/toastr.min.js',
		CORE_PATH().'js/config/toastr.js',

		THEME_PATH().'js/hcl_process/hcl_process.js',
		THEME_PATH().'js/lot_loss/parent_lot_loss.js',
		THEME_PATH().'js/lot_loss/melting_lot_loss.js',
		THEME_PATH().'js/reports/lot_reports.js',
		THEME_PATH().'js/reports/rolling_reports.js',
		THEME_PATH().'js/reports/alloy_ledger.js',
		THEME_PATH().'js/reports/gpc_out_process_report.js',
		THEME_PATH().'js/reports/fancy_chain_reports.js',
		THEME_PATH().'js/reports/hook_process_reports.js',
		THEME_PATH().'js/solder_process/solder_process.js',
		THEME_PATH().'js/settings/karigars.js',
		THEME_PATH().'js/settings/category_four.js',
		THEME_PATH().'js/settings/issue_purities.js',
		THEME_PATH().'js/settings/daily_drawer_wastage_category.js',
		THEME_PATH().'js/settings/loss_percentages.js',
		THEME_PATH().'js/settings/karigars.js',
		THEME_PATH().'js/fancy_chains/fancy_chains.js',
		THEME_PATH().'js/hcl_ghiss_process/hcl_ghiss_process.js',
		THEME_PATH().'js/calculator/calculator.js',
		THEME_PATH().'js/daily_drawers/daily_drawer_processes.js',
		THEME_PATH().'js/daily_drawers/pending_loss_from_hooks.js',

		THEME_PATH().'js/daily_drawers/chain_wise_daily_drawer_summeries.js',

		THEME_PATH().'js/tounch_outs/tounch_out_processes.js',
		THEME_PATH().'js/wax_tree_process/wax_tree.js',
		THEME_PATH().'js/tounch_outs/fire_tounch_out_processes.js',

		THEME_PATH().'js/ghiss_outs/ghiss_out_processes.js',
		THEME_PATH().'js/hallmarking_out/hallmark_out_processes.js',
		THEME_PATH().'js/domestics/approval_process.js',
		THEME_PATH().'js/arc_orders/orders.js',
		THEME_PATH().'js/melting_wastage_refine_outs/melting_wastage_refine_out_processes.js',
		THEME_PATH().'js/stone_vatav/stone_vatav_processes.js',
		THEME_PATH().'js/karigar_legders/karigar_legder.js',
		THEME_PATH().'js/ghiss_outs/tounch_ghiss_out_processes.js',
		THEME_PATH().'js/ghiss_outs/pending_ghiss_outs.js',
		THEME_PATH().'js/ghiss_outs/pending_ghiss_issues.js',
		THEME_PATH().'js/hcl_ghiss_outs/hcl_ghiss_out_processes.js',
		THEME_PATH().'js/loss_outs/loss_out_processes.js',
		THEME_PATH().'js/loss_outs/pending_loss_outs.js',
		THEME_PATH().'js/processes/processes.js',

		THEME_PATH().'js/karigar_rates/karigar_rates.js',
		THEME_PATH().'js/settings/karigars.js',
		THEME_PATH().'js/karigar_calculations/karigar_calculations.js',

		/*THEME_PATH().'js/daily_drawers/daily_drawer.js',*/
		THEME_PATH().'js/custom.js',
		THEME_PATH().'js/stock_summary/stock_summary.js',
		THEME_PATH().'js/loss_reports/loss_reports.js',
		THEME_PATH().'js/loss_reports/karigar_loss_report.js',
		THEME_PATH().'js/out_weight_reports/out_weight_reports.js',
		THEME_PATH().'js/toggle_table.js',
		THEME_PATH().'js/melting_lots/melting_lots.js',
		THEME_PATH().'js/melting_lots/melting_lot_details.js',
		THEME_PATH().'js/issue_departments/issue_departments.js',
		THEME_PATH().'js/finish_goods/finish_goods.js',
		THEME_PATH().'js/search/search.js',
		THEME_PATH().'js/barcode/barcode.js',
		THEME_PATH().'js/dashboards/chain_dashboards.js',
		THEME_PATH().'js/dashboards/karigar_balance_dashboards.js',
		THEME_PATH().'js/rod_process/rod_process.js',
		THEME_PATH().'js/chitties/chitties.js',
		THEME_PATH().'js/qr_codes/qr_codes.js',
		THEME_PATH().'js/base.js',

		THEME_PATH().'js/rope_chains/rope_chain_boms.js',
		THEME_PATH().'js/ka_chains/orders.js',
		THEME_PATH().'js/ka_chains/melting_lot_reports.js',
		THEME_PATH().'js/round_box_chains/round_box_chain_orders.js',
		THEME_PATH().'js/machine_chains/machine_chain_orders.js',
		THEME_PATH().'js/choco_chains/choco_chain_orders.js',
		THEME_PATH().'js/imp_italy_chains/imp_italy_chain_orders.js',
  		THEME_PATH().'js/indo_tally_chains/indo_tally_chain_orders.js',
  		THEME_PATH().'js/parent_orders/parent_orders.js',
		THEME_PATH().'js/same_karigars/same_karigars.js',
		TABLE_PATH().'js/processes/processes.js',
		THEME_PATH().'js/lengths/lengths.js',
		
		THEME_PATH().'js/masters/machine_masters.js',
		THEME_PATH().'js/masters/alloy_element_details.js',
	);
}
?>