<?php
include_once APPPATH . "modules/processes/models/Process_model.php";
class Daily_drawer_wastage_model extends Process_model {
  protected $next_process_model = '';
  
  public $router_class = 'daily_drawer_wastages';
  public $departments = array('Daily Drawer Wastage');
  
  public function __construct($data = array()) {
    parent::__construct($data);
    $this->load->model(array('processes/Process_field_model'));
    $this->attributes['product_name'] = 'Daily Drawer Wastage';
    $this->attributes['process_name'] = 'Daily Drawer Wastage';
    $this->attributes['chain_name'] = 'Office Outside';
  }

  public function after_save($action) {
    $this->attributes['lot_no'] = 'DDW-'.$this->attributes['id'];
    $this->update(false);

    $record = array('process_id' => $this->attributes['id'],
                    'daily_drawer_out_weight' => $this->attributes['daily_drawer_out_weight'],
                    'daily_drawer_type' => $this->attributes['type'],
                    'hook_kdm_purity' => $this->attributes['hook_kdm_purity'],
                    'karigar' => $this->attributes['karigar'],
                    'chain_name' => $this->attributes['chain_name']); 
    $process_obj = new Process_field_model($record);
    $process_obj->save(false);
  }
}
