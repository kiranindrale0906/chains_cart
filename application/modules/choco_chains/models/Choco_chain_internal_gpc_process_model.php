<?php 

include_once APPPATH . "modules/processes/models/Process_model.php";
class Choco_chain_internal_gpc_process_model extends Process_model{
	protected $next_process_model = '';
	
  public $router_class = 'internal_gpc_processes';
	public $departments = array('Melting Start','Steel Vibrator',"Office Hold","GPC");
	
  public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'Choco Chain';
		$this->attributes['process_name'] = 'Internal GPC Process';
	
  	$this->department_not_deleted = array('Steel Vibrator');
    
    /*$this->gpc_out_purity_departments = array('Tounch Department', 'Castic Process');
    $this->compute_tounch_loss_fine_departments = array('Tounch Department', 'Castic Process', 'GPC');*/
	}
}
 