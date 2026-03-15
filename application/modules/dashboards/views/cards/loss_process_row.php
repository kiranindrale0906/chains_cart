<?php 
	if(isset($loss_process_balance) || (isset($loss_process_balance) && empty($loss_process_balance)))  
		load_view('dashboards/cards/common_card',array('process'=>'loss_process_balance'));

	if(isset($loss_balance) || (isset($loss_balance) && empty($loss_balance)))  
		load_view('dashboards/cards/common_card',array('process'=>'loss_balance'));

?>