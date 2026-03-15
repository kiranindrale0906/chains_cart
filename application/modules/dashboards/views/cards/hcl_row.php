<?php 
	if(isset($hcl_process_balance) || (isset($hcl_process_balance) && empty($hcl_process_balance)))  
		load_view('dashboards/cards/common_card',array('process'=>'hcl_process_balance'));

	if(isset($hcl_wastage_balance) || (isset($hcl_wastage_balance) && empty($hcl_wastage_balance)))  
		load_view('dashboards/cards/common_card',array('process'=>'hcl_wastage_balance'));
?>
