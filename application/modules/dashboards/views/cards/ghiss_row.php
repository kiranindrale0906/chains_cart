<?php 
	if(isset($ghiss_process_balance) || (isset($ghiss_process_balance) && empty($ghiss_process_balance))) 
		load_view('dashboards/cards/common_card',array('process'=>'ghiss_process_balance')); 

	if(isset($pending_ghiss_balance) || (isset($pending_ghiss_balance) && empty($pending_ghiss_balance)))  
		load_view('dashboards/cards/common_card',array('process'=>'pending_ghiss_balance')); 

	if(isset($ghiss_balance) || (isset($ghiss_balance) && empty($ghiss_balance)))  
		load_view('dashboards/cards/common_card',array('process'=>'ghiss_balance')); 
	
	if(isset($tounch_out_ghiss) || (isset($tounch_out_ghiss) && empty($tounch_out_ghiss)))  
		load_view('dashboards/cards/common_card',array('process'=>'tounch_out_ghiss'));
?>