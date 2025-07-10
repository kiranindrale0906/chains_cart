<?php 
	if(isset($rope_ghiss_process) || (isset($rope_ghiss_process) && empty($rope_ghiss_process)))  
		load_view('dashboards/cards/common_card',array('process'=>'rope_ghiss_process'));

	if(isset($rope_ghiss_balance) || (isset($rope_ghiss_balance) && empty($rope_ghiss_balance)))
		load_view('dashboards/cards/common_card',array('process'=>'rope_ghiss_balance'));

?>