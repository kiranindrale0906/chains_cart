<?php 
class Cz_process_model extends BaseModel{
	public $router_class = 'cz_processes';
	protected $table_name= 'processes';
	public function __construct($data = array()){
		parent::__construct($data);
	}

	public function validation_rules($klass='') {
    $rules= array(array('field' => 'cz_processes[in_purity]', 'label' => 'Melting',
									      'rules' => 'trim|required|numeric|greater_than[0]',
									      'errors'=>array('required'=>'Please Select Melting')),
                  array('field' => 'cz_processes[in_weight]', 'label' => 'Weight',
                        'rules' => 'trim|required|numeric|greater_than[0]'
                        ));
    return $rules;
  }

  public function before_validate(){
    $out_weight = 0;
    $out_purity = 0;
    $out_lot_purity = 0;
    if (isset($this->formdata['process_out_wastage_details']) 
        && !empty($this->formdata['process_out_wastage_details'])) {
      $process_ids = array_column($this->formdata['process_out_wastage_details'], 'process_id');
      $process = $this->process_model->find('sum(balance_cz_wastage) as in_weight,
                                             sum(out_purity * balance_cz_wastage) / sum(balance_cz_wastage) as out_purity,
                                             sum(out_lot_purity * balance_cz_wastage * out_purity) / sum(balance_cz_wastage * out_purity) as out_lot_purity,description',
                                             array('where_in' => array('id' => $process_ids)));
      $this->attributes['in_weight'] = round($process['in_weight'],4);
      $this->attributes['in_purity'] = $process['out_purity'];
      $this->attributes['in_lot_purity'] = $process['out_lot_purity'];
      $this->attributes['description'] = $process['description'];
    }
  }
  
  public function save($after_save = true) {
    if(HOST == 'ARF' || HOST == 'ARC'){
      $department_name = 'Daily Drawer Wastage';
    } else {
     $department_name='Melting';
       }
    $srno= $this->process_model->find('count(*) + 1 as srno',
                                      array('product_name'=>'Daily Drawer','department_name'=>$department_name))['srno'];
    $start_process=array(
      'lot_no'=>strtoupper('DD-'.sprintf("%02d", $srno)),
      'department_name' => $department_name,
      'in_purity' => $this->attributes['in_purity'],
      'in_lot_purity' => $this->attributes['in_lot_purity'],
      'description' => $this->attributes['description'],
      'in_weight' => round($this->attributes['in_weight'],4),
      'row_id' => rand(),
      'out_weight' =>0,
      'status'=>'Pending');
     
    $process_obj=new daily_drawer_melting_process_model($start_process);
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
          $process_out_wastage_detail_obj->attributes['out_weight'] = $process['balance_cz_wastage'];
          $process_out_wastage_detail_obj->attributes['field_name'] = 'CZ Wastage';
          $process_out_wastage_detail_obj->save();
        }
      }
    }
  }

}
