<?php
include_once APPPATH . "modules/processes/models/Process_model.php";
class Finished_goods_receipt_model extends Process_model {
  protected $next_process_model = '';
  
  public $router_class = 'finished_goods_receipts';
  public $departments = array('GPC');
  
  public function __construct($data = array()) {
    parent::__construct($data);
    $this->attributes['product_name'] = 'Finished Goods Receipt';
    $this->attributes['process_name'] =  'Final Process';
    $this->attributes['chain_name'] =  'KA Chain';
  }

  public function before_validate() {
    $this->attributes['process_sequence'] = 0;
    $this->attributes['department_name'] = 'GPC';
    $this->attributes['gpc_out'] = $this->attributes['in_weight'];
    $this->attributes['finish_good'] = 1;
    $this->attributes['in_purity'] = 100;
    $this->attributes['wastage_purity'] = 100;
    $this->attributes['out_purity'] = 100;
    $this->attributes['melting_lot_id'] = 0;
    $this->attributes['out_lot_purity'] = $this->attributes['in_lot_purity'];
    $this->attributes['wastage_lot_purity'] = $this->attributes['in_lot_purity'];
    $this->attributes['melting_lot_category_one'] = $this->attributes['description'];
    $this->attributes['design_code'] = '';
    $this->attributes['machine_size'] = '';
    $this->attributes['row_id'] = rand();
    parent::before_validate();
  }
}