function onload_chain_wise_dd_summery() {
	onchange_chain_wise_dd_summery_chain_name();
}


function onchange_chain_wise_dd_summery_chain_name(){
	$('.chain_wise_dd_summery_chain_name').on('change', function() {
		var chain_name = $(this).val();	
		if(chain_name!=''){
			window.location = base_url+'daily_drawers/chain_wise_daily_drawer_summeries/index?chain_name='+chain_name;	
		}
	})
}

