<?php 
class Stone_vatav_process_model extends BaseModel{
  public $router_class = 'stone_vatav_processes';
  protected $table_name= 'processes';
  public function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules($klass='') {
    $rules= array(array('field' => 'stone_vatav_processes[in_weight]', 'label' => 'Weight',
                        'rules' => 'trim|required|numeric|greater_than[0]'));
    return $rules;
  }

  public function before_validate(){
    if (isset($this->formdata['process_out_wastage_details']) 
        && !empty($this->formdata['process_out_wastage_details'])) {
      $process_ids = array_column($this->formdata['process_out_wastage_details'], 'process_id');
      $process = $this->process_model->find('sum(stone_vatav) as in_weight,
                                             sum(stone_vatav * in_purity) / sum(stone_vatav) as out_purity,
                                             sum(in_lot_purity * stone_vatav * in_purity) / sum(stone_vatav * in_purity) as out_lot_purity',
                                             array('where_in' => array('id' => $process_ids)));
      $this->attributes['in_weight'] = $process['in_weight'];
      $this->attributes['in_purity'] = 100;
      $this->attributes['in_lot_purity'] = $process['out_lot_purity']; 
    }
  }
  
  public function save($after_save = true) {
    // $product_name_abbr = $this->get_category_abbr();
    $srno = $this->process_model->find('count(*) + 1 as srno',
                                        array('product_name'=>'Stone Melting','department_name'=>'Start'))['srno'];
    $start_process=array(
      'lot_no'=>strtoupper('SV-'.sprintf("%02d", $srno)),
      'department_name' => 'Start',
      'in_weight' => $this->attributes['in_weight'] + $this->attributes['loss'],
      'in_purity' => $this->attributes['in_purity'],
      'in_lot_purity' => $this->attributes['in_lot_purity'],
      'factory_out' => $this->attributes['ghiss'],
      'row_id' => rand(),
      'out_weight' => $this->attributes['loss']);
     
    $process_obj=new stone_vatav_melting_process_model($start_process);
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
          $process_out_wastage_detail_obj->attributes['out_weight'] = $process['stone_vatav'];
          $process_out_wastage_detail_obj->attributes['field_name'] = 'Stone Melting';
          $process_out_wastage_detail_obj->save(false);

          $proportionate_ghiss = $process['stone_vatav'] / $this->attributes['in_weight'] * $this->attributes['ghiss'];
          $proportionate_loss = $process['stone_vatav'] / $this->attributes['in_weight'] * $this->attributes['loss'];
          $process['stone_vatav'] = $process['stone_vatav'] + $proportionate_ghiss + $proportionate_loss;
          $process['loss'] = $proportionate_loss; 
          $process['ghiss'] = $proportionate_ghiss; 
          $process_obj = $this->process_model->get_model_object($process);
          $process_obj->before_validate();
          $process_obj->save(false);
        }
      }
    

    }
  }
}
