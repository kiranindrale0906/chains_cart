<?php 

	if(isset($process_balance_custom[$data['process']])){
		foreach($process_balance_custom[$data['process']] as $prosess_key => $process_value){?>
		
				<?php 
				load_card(array('view'=>'layouts/application/dashboard/card',
												'card_style'=>'bg_orange bdr_orange white',
												'card_icon'=>THEME_PATH.'images/icons/new_order.png',
												'card_title'=> $process_value['title'],
												'card_count'=>isset($process_value['data'])?$process_value['data']:0,
												'col'=>'col-lg-3 col-md-6',
												));
			
			}
		}
?>	