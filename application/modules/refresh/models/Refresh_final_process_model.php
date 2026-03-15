<?php 
include_once APPPATH . "modules/processes/models/Process_model.php";
class Refresh_final_process_model extends Process_model{
  protected $next_process_model = '';
  
  public $router_class = 'refresh_final_processes';
  public $departments = array('GPC');
  
  public function __construct($data = array()){
    parent::__construct($data);
    //$this->attributes['product_name'] = 'Refresh';
    $this->attributes['process_name'] = 'Refresh Final Process';
    $this->attributes['chain_name'] = 'Refresh';

    $this->department_not_deleted = array('GPC');
  }

  public function before_validate() {
    if (empty($this->attributes['design_code'])) $this->attributes['design_code']= 'RTN';
    if (isset($this->attributes['product_name']) && $this->attributes['product_name']=='Fancy Chain') {
      $this->attributes['melting_lot_category_one']= '';
      $this->attributes['machine_size']= '';
    }


    if ($this->attributes['department_name']=='GPC') {
      // $start_department = $this->find('product_name', array('id' => $this->attributes['id']));
      $this->attributes['product_name'] = $this->attributes['product_name'];
      $this->attributes['gpc_out'] = $this->attributes['in_weight'];
    }
    parent::before_validate();
  }
}
