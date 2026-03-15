<?php
include_once APPPATH . "modules/processes/models/Process_model.php";
class Rhodium_receipt_model extends Process_model {
  protected $next_process_model = '';
  
  public $router_class = 'rhodium_receipts';
  public $departments = array('Start');
  
  public function __construct($data = array()) {
    parent::__construct($data);
    $this->attributes['product_name'] = 'Rhodium Receipt';
    $this->attributes['chain_name'] = 'Receipt';
    $this->department_not_deleted=array('Start');
  }

  public function before_validate() {
    $this->attributes['process_sequence'] = 0;
    $this->attributes['department_name'] = 'Start';
    $this->attributes['process_name'] = (!empty($this->attributes['type'])) ? $this->attributes['type'] : 'Chain Receipt';
    $this->attributes['melting_wastage'] = $this->attributes['in_weight'];
    $this->attributes['row_id'] = rand();
    parent::before_validate();
  }

  public function create_in_melting_wastage_record($process) {
    $start_process = array(
      'parent_id' => $process['id'],
      'in_purity' => 100,
      'in_lot_purity' => $process['out_lot_purity'],
      'lot_no' => $process['lot_no'],
      'melting_lot_id' => $process['melting_lot_id'] ,
      'parent_lot_id' => $process['parent_lot_id'] ,
      'parent_lot_name' => $process['parent_lot_name'] ,
      'in_weight' => $process['in_melting_wastage'], 
      'description' => $process['description'], 
    ); 

    $in_melting_wastage_record = $this->find('id', array('parent_id' => $process['id']));
    if (!empty($in_melting_wastage_record))
      $start_process['id'] = $in_melting_wastage_record['id'];

    $process_obj = new Rhodium_receipt_model($start_process);
    $process_obj->before_validate();
    $process_obj->save(false); 
  }
}