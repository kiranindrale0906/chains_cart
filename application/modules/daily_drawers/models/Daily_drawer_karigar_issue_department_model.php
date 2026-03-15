<?php
include_once APPPATH . "modules/processes/models/Process_model.php";
class Daily_drawer_karigar_issue_department_model extends Process_model {
  protected $next_process_model = '';
  
  public $router_class = 'daily_drawer_karigar_issue_departments';
  public $departments = array('Start');
  
  public function __construct($data = array()) {
    parent::__construct($data);
    $this->load->model(array('processes/Process_field_model', 'daily_drawers/Daily_drawer_receipt_model'));
    $this->attributes['product_name'] = 'Issue';
    $this->attributes['process_name'] = 'Daily Drawer Issue';
    $this->attributes['chain_name'] = 'Office Outside';
  }

  public function before_validate() {
    $this->attributes['process_sequence'] = 0;
    $this->attributes['melting_lot_id'] = rand();
    $this->attributes['department_name'] = 'Start';
    $this->attributes['hook_kdm_purity'] = $this->attributes['in_lot_purity'];
    $this->attributes['daily_drawer_out_weight'] = $this->attributes['in_weight'];
    $this->attributes['row_id'] = rand();
    parent::before_validate();
  }

  // public function calculate_hook_kdm_purity() {
  //   if($this->attributes['in_lot_purity'] < 80)
  //     $this->attributes['hook_kdm_purity']=75.15;
  //   elseif($this->attributes['in_lot_purity'] >= 80 && $this->attributes['in_lot_purity'] < 88)
  //     $this->attributes['hook_kdm_purity']=83.65;
  //   else 
  //     $this->attributes['hook_kdm_purity']=92.00;
  // }

  public function after_save($action) {
    $record = array('process_id' => $this->attributes['id'],
                   'daily_drawer_out_weight' => $this->attributes['daily_drawer_out_weight'],
                   'daily_drawer_type' => $this->attributes['type'],
                   'hook_kdm_purity' => $this->attributes['hook_kdm_purity'],
                   'karigar' => $this->attributes['karigar'],
                   'chain_name' => $this->attributes['chain_name']); 
    $process_obj = new Process_field_model($record);
    $process_obj->save(false);

    $daily_drawer_receipt = array('process_sequence' => 0,
                                  'department_name' => 'Start',
                                  'process_name' => $this->get_process_name_from_account_name(),
                                  'type' => $this->get_process_name_from_account_name(),
                                  'account' => @$this->attributes['account'],
                                  'in_weight' => $this->attributes['in_weight'],
                                  'daily_drawer_in_weight' => $this->attributes['in_weight'],
                                  'row_id' => rand(),
                                  'parent_id' => $this->attributes['id'],
                                  'in_lot_purity' => $this->attributes['in_lot_purity'],
                                  'hook_kdm_purity' => $this->attributes['hook_kdm_purity']); 
    $daily_drawer_receipt_obj = new Daily_drawer_receipt_model($daily_drawer_receipt);
    $daily_drawer_receipt_obj->attributes['karigar'] = 'Factory';
    $daily_drawer_receipt_obj->save(true); 
  }

  protected function get_process_name_from_account_name() {
    // if ($this->attributes['account'] == 'Sisma Chain')
    //   $process_name = 'Sisma Accessories';
    // elseif ($this->attributes['account'] == 'ARF') 
    //   $process_name = 'Caping Accessories';
    // else 
      $process_name = $this->attributes['type'];

    return $process_name;
  }

  public function after_delete($id, $conditions = array()) {
    $process_detail_record = $this->Process_field_model->find('', array('process_id' => $id));
    $process_detail_obj = new Process_field_model($process_detail_record);
    $process_detail_obj->delete($process_detail_record['id'], array(), TRUE, FALSE);
  }
}