<?php
include_once APPPATH . "modules/processes/models/Process_model.php";
class Fire_tounch_daily_drawer_process_model extends Process_model {
  protected $next_process_model = '';
  
  public $router_class = 'fire_tounch_daily_drawer_processes';
  public $departments = array('Fire Tounch Daily Drawer Wastage');
  
  public function __construct($data = array()) {
    parent::__construct($data);
    $this->attributes['product_name']    = 'Fire Tounch Out';
    $this->attributes['process_name']    = 'Fire Tounch Daily Drawer Wastage';
    $this->attributes['department_name'] = 'Fire Tounch Daily Drawer Wastage';
    $this->department_not_deleted=array('Fire Tounch Daily Drawer Wastage');
    //$this->compute_tounch_loss_fine_departments = array('Fire Tounch Daily Drawer Wastage');
  }

  public function before_validate() {
    $parent_process = $this->process_model->find('', array('id' => $this->attributes['parent_id']));
    $this->attributes['parent_lot_id']        = $parent_process['parent_lot_id'];
    $this->attributes['parent_lot_name']      = $parent_process['parent_lot_name'];
    $this->attributes['lot_no']               = $parent_process['lot_no'];
    $this->attributes['melting_lot_id']       = $parent_process['melting_lot_id'];
    $this->attributes['parent_id']            = $parent_process['id'];
    $this->attributes['in_purity']            = 100;
    $this->attributes['in_lot_purity']        = $parent_process['wastage_lot_purity'];
    $this->attributes['hook_kdm_purity']      = 100;
    $this->attributes['in_weight']            = $parent_process['fire_tounch_gross'];
    $this->attributes['out_weight']           = 0;
    $this->attributes['daily_drawer_wastage'] = $parent_process['fire_tounch_fine'];
    $this->attributes['refine_loss']          = $parent_process['fire_tounch_gross'] - $parent_process['fire_tounch_fine'];
    $this->attributes['status']               = 'Complete';
    parent::before_validate();
  }
}