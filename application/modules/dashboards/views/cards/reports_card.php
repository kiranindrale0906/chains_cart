<?php 
	if(isset($cards)){
		foreach($cards as $card_key => $card_value){
			if(   !empty($card_value) 
         && $card_value != '0.00' 
         && $card_key != 'buffing_ii' 
         && $card_key != 'start'  
         && $card_key !='buffing_hold_i' 
         // && $card_key !='filing_ii' 
         && $card_key !='pl_flatting' && $card_key !='ag_flatting' 
         && $card_key !='ag_melting' && $card_key !='gpc_or_rodium'&& $card_key !='bunch_gpc') { 
				load_view('dashboards/cards/common_card',array('process'=>$card_key, 'value'=>$card_value));
			}
		}
	}
?>