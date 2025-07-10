<?php 
	function list_array(){
		if (HOST=='ARF') 
			return array('ka_chain_hook_process_hook_department');
		else
			return array('rope_chain__final_process_hook_department',
									 'machine_chain_final_process_joining_department',
									 'choco_chain_machine_process_chain_making_department',
									 'round_box_chain_final_process_hook_department',
									 'sisma_chain_karigar_process_chain_making',
									 'sisma_chain_RND_process_chain_making_department',
									 'imp_chain_spring_process_spring_department',
									 'imp_chain_chain_making_process_chain_making_department',
									 'hollow_choco_chain_spring_process_spring_department',
									 'hollow_choco_chain_chain_making_process_chain_making_department',
									 'indo_tally_chain_spring_process_spring_department',
									 'indo_tally_chain_chain_making_process_chain_making_department');
	}

	function getTableSettings(){
		return array();
	}
	
?>