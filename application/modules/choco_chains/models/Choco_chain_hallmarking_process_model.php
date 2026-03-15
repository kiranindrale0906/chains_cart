<?php 
include_once APPPATH . "modules/processes/models/Process_model.php";
class Choco_chain_hallmarking_process_model extends Process_model{
  public $next_process_model = '';

  public $router_class = 'hallmarking_processes';
  public $departments = array('Hallmarking','GPC');
  
  public function __construct($data = array()){
    parent::__construct($data);
    $this->attributes['product_name'] = 'Choco Chain';
    $this->attributes['process_name'] = 'Hallmarking Process';
    $this->department_not_deleted = array('Start', 'Polish');
    $this->compute_tounch_loss_fine_departments = array('GPC');
  }
  /*protected function get_departments() {  
    $buffing_record = $this->find('id, skip_department', array('department_name' => 'Steel Vibrator', 'row_id' => $this->attributes['row_id']));
    if (!empty($buffing_record) && $buffing_record['skip_department'] == 'No'){
        $this->departments = array('Hallmarking','GPC');
    }else{
       $this->departments = array('Hallmarking','GPC');
    }
    return $this->departments;
  }*/
}