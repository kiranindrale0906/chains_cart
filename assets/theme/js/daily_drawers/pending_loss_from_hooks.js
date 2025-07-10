function onload_pending_loss_from_hook_processes() {
	onchange_karigar_get_hook_processes();
	onchange_purity_get_hook_processes();
	on_click_process_id_calculate_hook_in_weight();
	onclick_pending_loss_from_hooks_select_all_check_all_checkboxes();
	onchange_daily_drawer_weight_calculate_loss();
}

function onchange_karigar_get_hook_processes() {
	$('select[name*="pending_loss_from_hooks[karigar]"]').on('change', function() {
		var karigar = $(this).val();	
		window.location = base_url+ 'daily_drawers/pending_loss_from_hooks/create?karigar='+karigar;	
	})
}
function onchange_purity_get_hook_processes() {
	$('select[name*="pending_loss_from_hooks[in_lot_purity]"]').on('change', function() {
		var in_lot_purity = $(this).val();	
		var karigar = $('select[name*="pending_loss_from_hooks[karigar]"]').val();	
		window.location = base_url+ 'daily_drawers/pending_loss_from_hooks/create?karigar='+karigar+'&purity='+in_lot_purity;	
	})
}

function on_click_process_id_calculate_hook_in_weight(){
	$('.pending_loss_from_hook_process_id').click(function(){
		calculate_hook_in_weight();
	});
}

function onclick_pending_loss_from_hooks_select_all_check_all_checkboxes(){
  $('.pending_loss_from_hook_select_all').click(function(){
    check_pending_loss_from_hooks_all_checkboxes();   
  })
}

function check_pending_loss_from_hooks_all_checkboxes() {
  $('.pending_loss_from_hook_process_id').each(function() {
    $(this).prop("checked", true);
  });
  calculate_hook_in_weight();
}

function calculate_hook_in_weight(){
	var total_in_weight = 0;
	var total_hook_in_weight = 0;
	$('.pending_loss_from_hook_process_id:checked').each(function() {
		total_in_weight = total_in_weight + parseFloat($(this).closest("tr").find(".in_weight").text());
		total_hook_in_weight = total_hook_in_weight + parseFloat($(this).closest("tr").find(".balance_hook_in_weight").text());
	});
	set_hook_in_field_value('process_in_weight',total_in_weight);
	set_hook_in_field_value('process_hook_in',total_hook_in_weight);
}

function set_hook_in_field_value(field_name, value) {
	$("."+field_name+"").val(value);
}

function onchange_daily_drawer_weight_calculate_loss() {
	$('input[name*="pending_loss_from_hooks[out_weight]"]').on('keyup', function() {
		in_weight = parseFloat($('input[name*="pending_loss_from_hooks[in_weight]"]').val());
		out_weight = parseFloat($('input[name*="pending_loss_from_hooks[out_weight]"]').val());
		//hook_in = parseFloat($('input[name*="pending_loss_from_hooks[hook_in]"]').val());
	  total_loss = in_weight - out_weight;	
	  set_hook_in_field_value('loss', total_loss);
	});
}

