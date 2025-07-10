<?php 
class Fire_tounch_out_process_model extends BaseModel{
	public $router_class = 'fire_tounch_out_processes';
	protected $table_name= 'processes';
	public function __construct($data = array()){
		parent::__construct($data);
	}

	public function validation_rules($klass='') {
    $rules= array(array('field' => 'fire_tounch_out_processes[in_weight]', 'label' => 'Weight',
                        'rules' => 'trim|required|numeric|greater_than[0]'));
    return $rules;
  }

  public function before_validate(){
    if (isset($this->formdata['process_out_wastage_details']) 
        && !empty($this->formdata['process_out_wastage_details'])) {
      $process_ids = array_column($this->formdata['process_out_wastage_details'], 'process_id');
      $process = $this->process_model->find('sum(balance_fire_tounch_out) as in_weight,
                                             100 as out_purity,
                                             sum(wastage_lot_purity * balance_fire_tounch_out) / sum(balance_fire_tounch_out) as out_lot_purity',
                                             array('where_in' => array('id' => $process_ids)));
      $this->attributes['in_weight'] = $process['in_weight'];
      $this->attributes['in_purity'] = 100;
      $this->attributes['in_lot_purity'] = $process['out_lot_purity'];
    }
  }
  
  public function save($after_save = true) {
    $srno= $this->process_model->find('count(*) + 1 as srno',array('product_name'=>'Fire Tounch Out','department_name'=>'Melting'))['srno'];
    $start_process=array(
      'lot_no'=>strtoupper('FTO-'.sprintf("%02d", $srno)),
      'department_name' => 'Melting',
      'in_purity' => $this->attributes['in_purity'],
      'in_lot_purity' => $this->attributes['in_lot_purity'],
      'in_weight' => $this->attributes['in_weight'],
      'row_id' => rand(),
      'out_weight' => 0,
      'status' => 'Pending'
      );
     
    $process_obj=new fire_tounch_out_melting_process_model($start_process);
    $process_obj->before_validate();
    $process_obj->store();
    $this->save_association_data($process_obj->attributes);
  }

  function save_association_data($attributes) {
    if (isset($this->formdata['process_out_wastage_details'])) {
      foreach ($this->formdata['process_out_wastage_details'] as $index => $process_out_wastage_detail) {
        if (isset($process_out_wastage_detail['process_id']) && !empty($process_out_wastage_detail['process_id'])) {
          $process = $this->process_model->find('', array('id' => $process_out_wastage_detail['process_id']));
          $process_out_wastage_detail_obj = new process_out_wastage_detail_model($process_out_wastage_detail);
          $process_out_wastage_detail_obj->attributes['parent_id'] = $attributes['id'];
          $process_out_wastage_detail_obj->attributes['out_weight'] = $process['balance_fire_tounch_out'];
          $process_out_wastage_detail_obj->attributes['field_name'] = 'Fire Tounch Out';
          $process_out_wastage_detail_obj->save();
        }
      }
    }
  }

}
