<?php
	if(isset($office_outside) || (isset($office_outside) &&empty($office_outside)))
		load_view('dashboards/cards/common_card',array('process'=>'office_outside'));
	
	if(isset($daily_drawer_balance) || (isset($daily_drawer_balance) && empty($daily_drawer_balance)))
  	load_view('dashboards/cards/common_card',array('process'=>'daily_drawer_balance'));?>