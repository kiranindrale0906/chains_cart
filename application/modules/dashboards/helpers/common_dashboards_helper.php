<?php function getTableSettings() {
  return array();
}

function model_names(){
	if (HOST=='ARF')
		return array(array('ka_chains','ka_chain_dashboard_model'));
	else
		return array(array('rope_chains','rope_chain_dashboard_model'),
							array('sisma_chains','sisma_chain_dashboard_model'),
							array('hollow_choco_chains','hollow_choco_chain_dashboard_model'),
							array('indo_tally_chains','indo_taly_chain_dashboard_model'),
							array('imp_italy_chains','imp_italy_chain_dashboard_model'),
							array('choco_chains','choco_chain_dashboard_model'),
							array('machine_chains','machine_chain_dashboard_model'),
							array('round_box_chains','round_box_chain_dashboard_model'),
							array('refresh','refresh_chain_dashboard_model'),
							array('fancy_chains','fancy_chain_dashboard_model'));
}
?>