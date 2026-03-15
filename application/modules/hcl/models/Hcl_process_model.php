<?php
class Hcl_process_model extends BaseModel{
	public $router_class = 'hcl_processes';
  public function __construct($data=array()) {
		parent::__construct($data);
    $this->load->model(array('processes/process_model'));

    // if (!isset($this->attributes['parent_lot_id'])) $this->attributes['parent_lot_id'] = 0;
    // if (!isset($this->attributes['parent_lot_name'])) $this->attributes['parent_lot_name'] = '';
    if (!isset($this->attributes['melting_lot_id'])) $this->attributes['melting_lot_id'] = 0;
    if (!isset($this->attributes['lot_no'])) $this->attributes['lot_no'] = '';
	}

  public function validation_rules($klass='') {
    $rules= array(array('field' => 'hcl_processes[in_purity]', 'label' => 'Melting',
                        'rules' => 'trim|required|numeric|greater_than[0]',
                        'errors'=>array('required'=>'Please Select Melting')),

                  array('field' => 'hcl_processes[in_weight]', 'label' => 'Weight',
                        'rules' => 'trim|required|numeric|greater_than[0]')
                );
    if($this->attributes['process_name']!='Solid Machine Chain'){
      $rules[]=array('field' => 'hcl_processes[parent_lot_id]', 'label' => 'Parent Lot ID',
                        'rules' => 'trim|required|numeric|greater_than[0]');
    }
    return $rules;
  }

  public function before_validate(){
    if (isset($this->formdata['process_out_wastage_details']) 
        && !empty($this->formdata['process_out_wastage_details'])) {
      $process_ids = array_column($this->formdata['process_out_wastage_details'], 'process_id');
      $process = $this->process_model->find('sum(balance_hcl_wastage) as hcl_wastage,
                                             sum(wastage_purity * balance_hcl_wastage) / sum(balance_hcl_wastage) as out_purity,
                                             sum(wastage_lot_purity * balance_hcl_wastage * wastage_purity) / sum(balance_hcl_wastage * wastage_purity) as out_lot_purity,parent_lot_id,parent_lot_name',
                                             array('where_in' => array('id' => $process_ids)),array(),
                                             array('group_by'=>'parent_lot_id,parent_lot_name'));
      
      $this->attributes['in_weight'] = $process['hcl_wastage'];
      $this->attributes['in_purity'] = $process['out_purity'];
      $this->attributes['in_lot_purity'] = $process['out_lot_purity'];
      $this->attributes['melting_lot_id'] = @$process['melting_lot_id'];
      $this->attributes['lot_no'] = @$process['lot_no'];
      $this->attributes['parent_lot_id'] = $process['parent_lot_id'];
      $this->attributes['parent_lot_name'] = $process['parent_lot_name'];
    }
  }
  
  public function save($after_save = true) {
    $srno= $this->process_model->find('count(*) + 1 as srno',
                                       array('product_name'=>'HCL','process_name'=>'HCL Melting Process','department_name'=>'HCL Process'))['srno'];
    $start_process=array(
      'department_name' => 'HCL Process',
      'row_id' => rand(),
      'parent_lot_id' => $this->attributes['parent_lot_id'],
      'parent_lot_name' => $this->attributes['parent_lot_name'],
      'melting_lot_id' => $this->attributes['melting_lot_id'],
      'lot_no'=>$this->attributes['lot_no'],
      'in_purity' => $this->attributes['in_purity'],
      'in_lot_purity' => $this->attributes['in_lot_purity'],
      'status' => 'Pending',
      'in_weight' => $this->attributes['in_weight'],
      'out_weight' => 0);
    $process_obj=new hcl_melting_process_model($start_process);
    $process_obj->before_validate();
    $process_obj->store();
    $this->save_association_data($process_obj->attributes);
  }

  public function save_association_data($attributes) {
    if (isset($this->formdata['process_out_wastage_details'])) {
      foreach ($this->formdata['process_out_wastage_details'] as $index => $process_out_wastage_detail) {
        if (isset($process_out_wastage_detail['process_id']) && !empty($process_out_wastage_detail['process_id'])) {
          $process = $this->process_model->find('', array('id' => $process_out_wastage_detail['process_id']));
          $process_out_wastage_detail_obj = new process_out_wastage_detail_model($process_out_wastage_detail);
          $process_out_wastage_detail_obj->attributes['parent_id'] = $attributes['id'];
          $process_out_wastage_detail_obj->attributes['out_weight'] = $process['balance_hcl_wastage'];
          $process_out_wastage_detail_obj->attributes['field_name'] = 'HCL Wastage';
          $process_out_wastage_detail_obj->save();
        }
      }
    }
  }
}

