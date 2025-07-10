<?php 
	function getTableSettings(){}

	function in_columns(){
		return array('in_weight','hook_in','fe_in');
	};

	function out_columns(){
		return array('out_weight','daily_drawer_wastage','melting_wastage','hcl_wastage','tounch_in','loss,ghiss','hcl_ghiss');
	};

	function balance_columns(){
		return array("balance","balance_fine","balance_gross");
	};
?>