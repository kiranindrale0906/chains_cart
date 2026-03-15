<?php 
	if(isset($tounch_process) || (isset($tounch_process) && empty($tounch_process)))  
		load_view('dashboards/cards/common_card',array('process'=>'tounch_process'));

	if(isset($tounch) || (isset($tounch) && empty($tounch)))  
		load_view('dashboards/cards/common_card',array('process'=>'tounch'));

?>