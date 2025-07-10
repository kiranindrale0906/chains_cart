function onload_finish_goods(){
	onclick_check_all_checkboxes();
	onchange_in_purity_get_finish_good_processes();
}
function onclick_check_all_checkboxes(){
	$('.check_all').click(function(){
		select_all_checkboxes();		
	})
}



function select_all_checkboxes() {
	var count = 0;
	$('.finish_good_details_process_id').each(function() {
		count = count + 1;
		$(this).prop("checked", true);
	});
}
function onchange_in_purity_get_finish_good_processes() {
	$('select[name*="finish_goods[out_lot_purity]"]').on('change', function() {
		var in_purity = $(this).val();	
		window.location = base_url+ 'issue_departments/finish_goods/create?purity='+in_purity;	
	})
}
