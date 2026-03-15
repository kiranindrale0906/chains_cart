<?php 
class Melting_wastage_refine_out_process_model extends BaseModel{
  public $router_class = 'melting_wastage_refine_out_processes';
  protected $table_name= 'processes';
  public function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules($klass='') {
    $rules= array(array('field' => 'melting_wastage_refine_out_processes[in_weight]', 'label' => 'Weight','rules' => 'trim|required|numeric|greater_than[0]'));
    return $rules;
  }

  public function before_validate(){
    if (isset($this->formdata['process_out_wastage_details']) 
        && !empty($this->formdata['process_out_wastage_details'])) {
      $process_ids = array_column($this->formdata['process_out_wastage_details'], 'process_id');
      $process = $this->process_model->find('sum(balance_melting_wastage) as in_weight,
                                             sum(out_purity * balance_melting_wastage) / sum(balance_melting_wastage) as out_purity,
                                             sum(out_lot_purity * balance_melting_wastage * out_purity) / sum(balance_melting_wastage * out_purity) as out_lot_purity',
                                             array('where_in' => array('id' => $process_ids)));
      $this->attributes['in_weight'] = $process['in_weight'];
      $this->attributes['in_purity'] = 100;
      $this->attributes['in_lot_purity'] = $process['out_lot_purity']; 
    }
  }
  
  public function save($after_save = true) {
    // $product_name_abbr = $this->get_category_abbr();
    $srno = $this->process_model->find('count(*) + 1 as srno',
                                       array('product_name'=>'Melting Wastage Refine Out','department_name'=>'Melting'))['srno'];
    $start_process=array(
      'lot_no'=>strtoupper('MWROP-'.sprintf("%02d", $srno)),
      'department_name' => 'Refine Melting',
      'in_purity' => $this->attributes['in_purity'],
      'in_lot_purity' => $this->attributes['in_lot_purity'],
      'in_weight' => $this->attributes['in_weight'],
      'row_id' => rand(),
      'out_weight' => 0,
      'status' => 'Pending'
      );
     
    $process_obj=new melting_wastage_refine_out_melting_process_model($start_process);
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
            $process_out_wastage_detail_obj->attributes['out_weight'] = $process['balance_melting_wastage'];
            $process_out_wastage_detail_obj->attributes['field_name'] = 'Melting Wastage Refine Out';
             $process_out_wastage_detail_obj->save(false);
            $model_name = get_model_name($process['product_name'], $process['process_name']);
            $this->load->model($model_name['module_name'].'/'.$model_name['model_name']);
            
            $process_obj = new $model_name['model_name'](array('id' => $process['id']));
            $process_obj->attributes['out_melting_wastage']=$process['balance_melting_wastage'];
            $process_obj->before_validate();
            $process_obj->calculate_balance_wastage('Melting Wastage Refine Out');
            $process_obj->save(false);
        }
      }
    }
  }
}
