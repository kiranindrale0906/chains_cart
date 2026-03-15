<?php  
	if (isset($balance[$created_date][$type])) { 
		$this->load->view('issue_and_receipts/ledgers/total', 
													array('label' => $label,
														    'weight' => $balance[$created_date][$type]['weight'], 
														    'gross' => @$balance[$created_date][$type]['gross'],
														    'fine' => $balance[$created_date][$type]['fine'],
														    'wastage_fine' => $balance[$created_date][$type]['wastage_fine'],
														    'wastage_diff' => $balance[$created_date][$type]['wastage_diff']));
	}
?>
