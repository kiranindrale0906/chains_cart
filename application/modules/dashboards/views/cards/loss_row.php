<?php 
	if(isset($refine_loss) || (isset($refine_loss) && empty($refine_loss)))  
		load_view('dashboards/cards/common_card',array('process'=>'refine_loss'));

	if(isset($tounch_fine_loss) || (isset($tounch_fine_loss) && empty($tounch_fine_loss)))  
		load_view('dashboards/cards/common_card',array('process'=>'tounch_fine_loss'));

	if(isset($hcl_loss) || (isset($hcl_loss) && empty($hcl_loss)))  
		load_view('dashboards/cards/common_card',array('process'=>'hcl_loss'));
?>