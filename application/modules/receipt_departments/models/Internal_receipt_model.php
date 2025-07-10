<?php
class Internal_receipt_model extends BaseModel{
  public $router_class = 'internal_receipts';
  protected $table_name= 'processes';
  public function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules($klass='') {
    $rules= array(array('field' => 'internal_receipts[in_lot_purity]', 'label' => 'Melting',
                        'rules' => 'trim|required|numeric|greater_than[0]'),
                  array('field' => 'internal_receipts[in_weight]', 'label' => 'Weight',
                        'rules' => 'trim|required|numeric|greater_than[0]'
                        ));
    return $rules;
  }
  
  public function save($after_save = true) {
    $start_process=array(
      'department_name' => 'Start',
      'row_id' => rand(),
      'in_lot_purity' => $this->attributes['in_lot_purity'],
      'hook_kdm_purity' => $this->attributes['hook_kdm_purity'],
      'lot_no' => $this->set_lot_no() ,
      'in_weight' => $this->attributes['in_weight'],
      'quantity' => !empty($this->attributes['quantity']) ? $this->attributes['quantity'] : 1,
      'account' => $this->attributes['account'],
      'description' => $this->attributes['description'],
      'out_weight' => $this->attributes['in_weight']);
     
    $process_obj=new internal_final_process_model($start_process);
    $process_obj->store();

  }

  private function set_lot_no() {
    $processes = $this->process_model->get('', array('process_name' => $this->attributes['process_name'],
                                                     'department_name' => 'Start'));
    $srno = count($processes);
    return $this->attributes['lot_no'] = strtoupper(sprintf("%02d",$this->attributes['in_lot_purity']).'IN-'.sprintf("%02d", $srno));
  }

  // public function after_delete($id,$condition) {
  //   if(!empty($id)) {
  //     $get_delete_row_id=$this->find('row_id',array('parent_id'=>$id))['row_id'];
  //     $this->delete_dependent_records($id,$get_delete_row_id,"internal_final_process_model"); //id,row_id ,model name
  //   }
  // }
  // private function delete_dependent_records($id,$row_id,$model_name) {
  //   $get_delete_record_ids=$this->$model_name->get('id',array('row_id'=>$row_id));
  //   if(!empty($get_delete_record_ids)){
  //     foreach ($get_delete_record_ids as $index => $get_delete_record_id) {
  //       if(!empty($get_delete_record_id['id']))
  //       $this->delete($get_delete_record_id['id']);
  //     }
  //   }
  // }
}
