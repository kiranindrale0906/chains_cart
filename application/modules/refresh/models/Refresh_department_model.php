<?php
class Refresh_department_model extends BaseModel{
  public $router_class = 'refresh_departments';
  protected $table_name= 'processes';
  public function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules($klass='') {
    $rules= array(array('field' => 'refresh_departments[in_lot_purity]', 'label' => 'Melting',
                        'rules' => 'trim|required|numeric|greater_than[0]'),
                  array('field' => 'refresh_departments[in_weight]', 'label' => 'Weight',
                        'rules' => 'trim|required|numeric|greater_than[0]'
                        ));
    return $rules;
  }
  
  public function save($after_save = true) {
    $start_process=array(
      'department_name' => 'Refresh Hold',
      'row_id' => rand(),
      'in_lot_purity' => $this->attributes['in_lot_purity'],
      'hook_kdm_purity' => $this->attributes['hook_kdm_purity'],
      'lot_no' => $this->set_lot_no() ,
      'in_weight' => $this->attributes['in_weight'],
      'quantity' => !empty($this->attributes['quantity']) ? $this->attributes['quantity'] : 1,
      'account' => $this->attributes['account'],
      'description' => $this->attributes['description'],
      'out_weight' => 0,
      'status'=>'Pending'
    );
    if(HOST=="AR Gold Internal"){
      $this->load->model(array('refresh/refresh_internal_gpc_process_model'));
      $start_process['department_name']="Cleaning";
      $process_obj=new refresh_internal_gpc_process_model($start_process);
    }else{  
      $process_obj=new refresh_hold_model($start_process);
    }
    $process_obj->before_validate();
    $process_obj->store();
  }

  private function set_lot_no() {
    $processes = $this->process_model->get('', array('department_name' => 'Refresh Hold'));
    $srno = count($processes);
    return $this->attributes['lot_no'] = strtoupper(sprintf("%02d",$this->attributes['in_lot_purity']).'RF-'.sprintf("%02d", $srno));
  }

  public function after_delete($id,$condition) {
    if(!empty($id)) {
      $get_delete_row_id=$this->find('row_id',array('parent_id'=>$id))['row_id'];
      $this->delete_dependent_records($id,$get_delete_row_id,"refresh_model"); //id,row_id ,model name
    }
  }
  private function delete_dependent_records($id,$row_id,$model_name) {
    $get_delete_record_ids=$this->$model_name->get('id',array('row_id'=>$row_id));
    if(!empty($get_delete_record_ids)){
      foreach ($get_delete_record_ids as $index => $get_delete_record_id) {
        if(!empty($get_delete_record_id['id']))
        $this->delete($get_delete_record_id['id']);
      }
    }
  }
}
