<?php

	if(isset($metal_balance)) 
		load_view('dashboards/cards/common_card',array('process'=>'metal_balance'));

	if(isset($melting_wastage_balance)) {
		load_view('dashboards/cards/common_card',array('process'=>'melting_wastage_balance'));
	}
															

	if(isset($alloy_balance)) load_view('dashboards/cards/common_card',array('process'=>'alloy_balance'));
?>
