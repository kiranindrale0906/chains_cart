<?php 
include_once APPPATH . "modules/processes/models/Process_model.php";
class Para_model extends Process_model{
  protected $next_process_model = '';

  public $router_class = 'paras';
  public $departments = array('Melting Start', 'Melting', 'Flatting','Pipe And Para Making');
  //public $auto_compute_loss_departments= array('Grinding', 'Laminar', 'Stone Setting','Buffing','GPC','Meena');
  
  public function __construct($data = array()){
    parent::__construct($data);
    $this->attributes['product_name'] = 'Office Outside';
    $this->attributes['process_name'] = 'Para';
    $this->department_not_deleted=array('Melting Start', 'Melting');
    $this->load->model(array('processes/Process_field_model', 'office_outside/para_final_process_model'));
  }

  public function after_save($action) {
    if($this->attributes['department_name']=='Pipe And Para Making' && $this->attributes['out_weight'] != 0
                                                                    && $this->attributes['balance'] == 0) {
      $this->create_para_final_process();
    }else{
      parent::after_save($action);
    }
  }

  public function create_para_final_process() {
    $process_fields = $this->Process_field_model->get('',array('process_id' => $this->attributes['id'],
                                                               'out_weight >' => 0));
    foreach ($process_fields as $index => $process_field) {
      $start_process=array(
      'department_name' => 'Dull ',
      'lot_no' => $this->attributes['lot_no'],
      'parent_id' => $this->attributes['id'],
      'parent_lot_id' => $this->attributes['parent_lot_id'],
      'parent_lot_name' => $this->attributes['parent_lot_name'],
      'melting_lot_id' => $this->attributes['melting_lot_id'],
      'row_id' => $this->attributes['melting_lot_id'].'-'.$index.'-'.$this->attributes['parent_id'],
      'in_lot_purity' => $this->attributes['in_lot_purity'],
      'out_lot_purity' => $this->attributes['out_lot_purity'],
      'in_weight' => $process_field['out_weight'],
      'out_weight' =>0,
      'in_purity' => $this->attributes['out_purity'],
      'hook_kdm_purity' => $this->attributes['hook_kdm_purity'],
      'out_weight' => $process_field['out_weight'],
      'no_of_bunch' => $this->attributes['no_of_bunch'],
      'design_code' => $this->attributes['design_code'],
      'machine_size' => $this->attributes['machine_size'],
      'karigar' => $this->attributes['karigar'],
      'length' => $this->attributes['length'],
      'remark' => $this->attributes['remark'], 
      'tone'=>$this->attributes['tone'],
      'chain_name' => $this->attributes['chain_name']);
      $process_obj = new Para_final_process_model($start_process);
      $process_obj->before_validate();
      $process_obj->store();
    }

    // parent::set_current_process_status_completed();
  }
  
  // protected function get_departments() {
  //   return parent::unset_excluded_departments();
  // }

  // public function before_validate() {
  //   if ($this->attributes['department_name'] == 'Pipe And Para Making') {
  //     $next_department_record = $this->find('id', array('row_id' => $this->attributes['row_id'],
  //                                                       'department_name' => $this->attributes['next_department_name']));
  //     if (!empty($next_department_record))
  //       $this->attributes['out_weight'] = 0;
  //   }
  //   parent::before_validate();
  // }

  // protected function get_departments() {  
  //   if ($this->attributes['department_name'] == 'Pipe And Para Making')  
  //     $final_process['next_department_name'] = $this->attributes['next_department_name'];
  //   else 
  //     $final_process = $this->find('next_department_name', array('row_id' => $this->attributes['row_id'],
  //                                                                       'department_name' => 'Pipe And Para Making'));
    
  //   if (!empty($final_process['next_department_name']))
  //     $this->departments = array('Start', 'Melting', 'Flatting','Pipe And Para Making',$final_process['next_department_name']);
  //   return $this->departments;
  // }
  
}