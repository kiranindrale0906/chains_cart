<?php
include_once APPPATH . "modules/processes/models/Process_model.php";
class Stone_karigar_issue_department_model extends Process_model {
  protected $next_process_model = '';
  
  public $router_class = 'stone_karigar_issue_departments';
  public $departments = array('Start');
  
  public function __construct($data = array()) {
    parent::__construct($data);
    $this->load->model(array('processes/Process_field_model', 'daily_drawers/Daily_drawer_receipt_model'));
    $this->attributes['product_name'] = 'Stone Transfer';
    $this->attributes['process_name'] = 'Karigar To Factory';
    $this->attributes['chain_name'] = 'Office Outside';
  }

  public function before_validate() {
    $this->attributes['process_sequence'] = 0;
    $this->attributes['melting_lot_id'] = rand();
    $this->attributes['department_name'] = 'Start';
    $this->attributes['type'] = 'Stone';
    $this->attributes['hook_kdm_purity'] = $this->attributes['in_lot_purity'];
    $this->attributes['stone_in'] = $this->attributes['in_weight'];
    $this->attributes['karigar'] = $this->formdata['karigar'];
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
    $this->attributes['lot_no'] = 'SI-'.$this->attributes['id'];
    $this->update(false);
    $process_detail = array('process_id' => $this->attributes['id'],
                   'stone_out' => $this->attributes['in_weight'],
                   'type' => $this->attributes['type'],
                   'hook_kdm_purity' => $this->attributes['hook_kdm_purity'],
                   'karigar' => $this->formdata['karigar'],
                   'chain_name' => $this->attributes['chain_name']); 
    $process_detail_obj = new Process_field_model($process_detail);
    $process_detail_obj->save(false);


    $record['department_name'] = 'Start';
    $record['type'] = 'Stone';
    $record['karigar']= 'Factory';
    $record['in_weight']= $this->attributes['in_weight'];
    $record['stone_out']= $this->attributes['in_weight'];
    $record['in_lot_purity']= $this->attributes['in_lot_purity'];
    $record['hook_kdm_purity']= $this->attributes['in_lot_purity'];
    $record['out_weight']= 0;
    $record['in_purity']=100; 
    $record['process_sequence'] = 0;
    $record['melting_lot_id'] = rand();
    $record['row_id'] = rand();
    $process_obj = new Stone_karigar_issue_department_model($record);
    $process_obj->save(false);
  }
}