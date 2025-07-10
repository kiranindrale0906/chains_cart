<?php

class Packing_slip_detail_model extends BaseModel {

  protected $table_name = "packing_slip_details";
  protected $id = "id";

  public function __construct($data = array()){
		parent::__construct($data);
  }
  public function validation_rules($klass='') {
    $rules[] = array('field' => 'packing_slip_details[packing_slip_id]', 
                     'label' => 'packing_slip_id',
                     'rules' => 'trim|required');
    return $rules;
  }
  public function update_packing_slip_ids($process_details,$packing_slip_details) {
    if(!empty($process_details)){
      foreach ($process_details as $index => $process_detail) {
        if (isset($process_detail['id'])) {
        $process_obj = new process_model($process_detail);
        $process_obj->attributes['packing_slip_balance'] = $process_detail['packing_slip_balance']+$packing_slip_details['gross_weight'];
        if($packing_slip_details['weight']==$process_obj->attributes['packing_slip_balance']){
          $process_obj->attributes['packing_slip_id'] = 0;
        }
        $process_obj->update(false);
        // $ledger_details=$this->ledger_model->find('',array('process_id'=>$process_detail['id']));
        // $ledger_obj = new ledger_model($ledger_details);
        // $ledger_obj->attributes['packing_slip_id'] = 0;
        // $ledger_obj->update(false);
        }
      }
    }
  }
}