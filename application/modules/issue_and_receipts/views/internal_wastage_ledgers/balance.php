<?php  
	if (isset($balance[$created_date][$type])) { 
		$this->load->view('issue_and_receipts/internal_wastage_ledgers/total', 
													array('label' => $label,
														    'weight' => $balance[$created_date][$type]['weight'], 
														    'fine' => $balance[$created_date][$type]['fine'],
														    'issue_fine' => $balance[$created_date][$type]['issue_fine'],'vodator' => $balance[$created_date][$type]['vodator'],
														));
	}
?>
