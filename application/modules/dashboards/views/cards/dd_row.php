<?php  
	if(isset($daily_drawer_process))  
		load_view('dashboards/cards/common_card',array('process'=>'daily_drawer_process'));
	
	if(isset($daily_drawer_wastage)) 
		load_view('dashboards/cards/common_card',array('process'=>'daily_drawer_wastage'));
?>