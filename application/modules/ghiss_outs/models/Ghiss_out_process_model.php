<?php 
class Ghiss_out_process_model extends BaseModel{
  public $router_class = 'ghiss_out_processes';
  protected $table_name= 'processes';
  public function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules($klass='') {
    $rules= array(array('field' => 'ghiss_out_processes[in_weight]', 'label' => 'Weight',
                        'rules' => 'trim|required|numeric|greater_than[0]'));
    return $rules;
  }

  public function before_validate(){
    if (isset($this->formdata['process_out_wastage_details']) 
        && !empty($this->formdata['process_out_wastage_details'])) {
      $process_ids = array_column($this->formdata['process_out_wastage_details'], 'process_id');
      $process = $this->process_model->find('sum(balance_ghiss) as in_weight,
                                             sum(out_purity * balance_ghiss) / sum(balance_ghiss) as out_purity,
                                             sum(out_lot_purity * balance_ghiss * out_purity) / sum(balance_ghiss * out_purity) as out_lot_purity',
                                             array('where_in' => array('id' => $process_ids)));
      $this->attributes['in_weight'] = $process['in_weight'];
      $this->attributes['in_purity'] = 100;
      $this->attributes['in_lot_purity'] = $process['out_lot_purity']; 
    }
  }
  
  public function save($after_save = true) {
    // $product_name_abbr = $this->get_category_abbr();
    $srno = $this->process_model->find('count(*) + 1 as srno',
                                       array('product_name'=>'Ghiss Out','department_name'=>'Ghiss Melting'))['srno'];
    $start_process=array(
      'lot_no'=>strtoupper('GOP-'.$this->formdata['department_name'].'-'.sprintf("%02d", $srno)),
      'department_name' => 'Ghiss Melting',
      'in_purity' => $this->attributes['in_purity'],
      'in_lot_purity' => $this->attributes['in_lot_purity'],
      'in_weight' => $this->attributes['in_weight'],
      'row_id' => rand(),
      'out_weight' => 0,
      'status' => 'Pending'
      );
     
    $process_obj=new ghiss_out_melting_process_model($start_process);
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
          $process_out_wastage_detail_obj->attributes['out_weight'] = $process['balance_ghiss'];
          $process_out_wastage_detail_obj->attributes['field_name'] = 'Ghiss Out';
          $process_out_wastage_detail_obj->save(false);
          $model_name = get_model_name($process['product_name'], $process['process_name']);
          $this->load->model($model_name['module_name'].'/'.$model_name['model_name']);
          
          $process_obj = new $model_name['model_name'](array('id' => $process['id']));
          $process_obj->attributes['out_ghiss']=$process['ghiss'];
          $process_obj->before_validate();
          $process_obj->save(false);
        }
      }
    }
  }

  // private function get_category_abbr() {
  //   if ($this->formdata['product_name'] == 'Round Box Chain') {
  //     $abbr = 'RBC';
  //   } elseif ($this->formdata['product_name'] == 'Machine Chain') {
  //     $abbr = 'MC';
  //   } elseif ($this->formdata['product_name'] == 'Rope Chain') {
  //     $abbr = 'RC';
  //   } elseif ($this->formdata['product_name'] == 'Choco Chain') {
  //     $abbr = 'CC';
  //   } elseif ($this->formdata['product_name'] == 'Imp Italy Chain') {
  //     $abbr = 'IMP';
  //   } elseif ($this->formdata['product_name'] == 'Hollow Choco Chain') {
  //     $abbr = 'HCC';
  //   } elseif ($this->formdata['product_name'] == 'Milano Chain') {
  //     $abbr = 'MIC';
  //   } elseif ($this->formdata['product_name'] == 'Pipe Chain') {
  //     $abbr = 'PC';
  //   } elseif ($this->formdata['product_name'] == 'Office Outside Hook') {
  //     $abbr = 'HOOK';
  //   } elseif ($this->formdata['product_name'] == 'Office Outside KDM') {
  //     $abbr = 'KDM';
  //   } elseif ($this->formdata['product_name'] == 'Office Outside Lobster') {
  //     $abbr = 'LOB';
  //   } elseif ($this->formdata['product_name'] == 'Office Outside Solid Pipe') {
  //     $abbr = 'SP';
  //   } elseif ($this->formdata['product_name'] == 'Office Outside Solid Wire') {
  //     $abbr = 'SW';
  //   } elseif ($this->formdata['product_name'] == 'Office Outside Hollow Pipe') {
  //     $abbr = 'HP';
  //   } elseif ($this->formdata['product_name'] == 'Office Outside Sisma Stripe') {
  //     $abbr = 'SS';
  //   } elseif ($this->formdata['product_name'] == 'Fancy Chain') {
  //     $abbr = 'FC';
  //   } elseif ($this->formdata['product_name'] == 'Sisma Chain') {
  //     $abbr = 'SISMA';
  //   } elseif ($this->formdata['product_name'] == 'ARC') {
  //     $abbr = 'ARC';   
  //   } elseif($this->formdata['product_name']=='Indo tally Chain'){
  //     $abbr = 'ITC';
  //   } elseif ($this->formdata['product_name'] == 'Office Outside Ball') {
  //     $abbr = 'BA';
  //   } elseif ($this->formdata['product_name'] == 'Office Outside Cutting Wire') {
  //     $abbr = 'CW';
  //   } elseif ($this->formdata['product_name'] == 'Office Outside Cutting Pipe') {
  //     $abbr = 'CP';
  //   } elseif ($this->formdata['product_name'] == 'KA Chain') {
  //     $abbr = 'KA';
  //   } elseif ($this->formdata['product_name'] == 'Office Outside') {
  //     $abbr = 'OF';
  //   } else {
  //     pd(11);
  //   }
  //   return $abbr;
  // }

}
