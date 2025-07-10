<?php 
	if(isset($ka_chain_karigar_balance) || (isset($ka_chain_karigar_balance) && empty($ka_chain_karigar_balance)))  
		load_view('dashboards/cards/common_card',array('process'=>'ka_chain_karigar_balance'));
?>