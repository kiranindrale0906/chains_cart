<?php  
	if (isset($balance[$created_date][$type])) { 
		$this->load->view('reports/gpc_out_reports/total', 
													array('label' => $label,
														    'weight' => $balance[$created_date][$type]['weight'], 
														    'fine' => $balance[$created_date][$type]['fine']));
	}
?>
