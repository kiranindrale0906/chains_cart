
<?php 
include_once APPPATH . "modules/processes/models/Process_model.php";
class Refresh_hold_model extends Process_model{
  protected $next_process_model = 'refresh/Refresh_model';
  public $router_class = 'refresh_hold';
  public $departments = array('Refresh Hold');
  
  public function __construct($data = array()){
    parent::__construct($data);
    $this->attributes['product_name'] = 'Refresh';
    $this->attributes['process_name'] = 'Refresh Hold';
    $this->attributes['chain_name'] = 'Refresh';
    $this->department_not_deleted=array('Start','Refresh Hold');
    $this->load->model(array('processes/Process_field_model','processes/process_out_wastage_detail_model', 'refresh/Refresh_model'));
   $this->split_out_weight_departments =array('Refresh Hold');
  }
  
  protected function get_next_process_model($process_field_attributes = array()) {
    if (HOST=='AR Gold'){
      $this->next_model_name = 'refresh/Refresh_model';
    }else{
      if (empty($process_field_attributes)) return '';

      if ($process_field_attributes['next_department_name']=='KA Chain')
        $this->next_model_name = 'ka_chains/Ka_chain_hook_refresh_process_model';
      elseif($process_field_attributes['next_department_name']=='Fancy Out')
        $this->next_model_name = 'ka_chains/ka_chain_fancy_out_process_model';
      else
        $this->next_model_name = 'refresh/refresh_model';
    }
    
    
    return $this->next_model_name;    
  }
  public function before_validate() {
    if (HOST=='AR Gold' && $this->attributes['department_name'] == 'Refresh Hold') {
      $this->attributes['out_weight'] = $this->attributes['in_weight'];
      $this->attributes['status'] = 'Complete';
    }
    parent::before_validate();
  }


  public function after_save($action = true) {
    if (empty($this->attributes['lot_no']) || strpos($this->attributes['lot_no'], 'RF-')) {
      $this->attributes['lot_no'] = sprintf("%02d",$this->attributes['in_lot_purity']).'RF-'.$this->attributes['id'];
      $this->update(false);
    }
    parent::after_save($action);
  }

  public function create_refresh_records($process, $create_process_out_wastage_details_record = 'Yes') {
    $start_process=array(
      'department_name' => 'Refresh Hold',
      'row_id' => rand(),
      'parent_id' => $process['id'],
      'in_lot_purity' => $process['in_lot_purity'],
      'hook_kdm_purity' => $process['hook_kdm_purity'],
      // 'lot_no' => @$process['lot_no'] ,
      // 'melting_lot_id' => @$process['melting_lot_id'] ,
      // 'parent_lot_id' => @$process['parent_lot_id'] ,
      // 'parent_lot_name' => @$process['parent_lot_name'] ,
      'in_weight' => $process['repair_out'],
      'quantity' => $process['quantity'],
      'account' => $process['account'],
      'description' =>(isset($process['product_name'])&&$process['product_name']=='GPC Repair Out')?$process['description']: @$process['product_name'],
      'status' => 'Pending',
      'out_weight' => 0);
     
    $process_obj=new refresh_hold_model($start_process);
    $process_obj->before_validate();
    $process_obj->store();

    if ($create_process_out_wastage_details_record == 'Yes') {
      $this->save_refresh_details($process_obj->attributes, $process);
    }

    return $process_obj->attributes; 
  }

  // private function set_lot_no($process) {
  //   $processes = $this->process_model->get('', array('in_lot_purity' => $process['in_lot_purity'],
  //                                                    'department_name' => 'Refresh Hold'));
  //   $srno = count($processes);
  //   return $this->attributes['lot_no'] = strtoupper(sprintf("%02d",$process['in_lot_purity']).'RF-'.sprintf("%02d", $srno));
  // }

  private function save_refresh_details($attributes, $process) {
    $repair_out_details = array('process_id'=>$process['id']);
    $repair_out_detail_obj = new process_out_wastage_detail_model($repair_out_details);
    $repair_out_detail_obj->attributes['parent_id'] = $attributes['id'];
    $repair_out_detail_obj->attributes['out_weight'] = $process['repair_out'];
    $repair_out_detail_obj->attributes['field_name'] = 'Repair Out';
    $repair_out_detail_obj->save();
  }

  
  // protected function get_next_process_model($process_field_attributes = array()) {
  //   if (HOST=='AR Gold')
  //     $this->next_model_name = 'refresh/Refresh_model';
  //   else 
  //     $this->next_model_name = '';
  //   return $this->next_model_name;
  // }

  // public function create_next_process_department_record($process, $process_details_attributes){
  //     $start_process=array(
  //       'department_name' => 'Start',
  //       'lot_no' => $process['lot_no'],
  //       'parent_id' => $process['id'],
  //       'parent_process_detail_id' => $process_details_attributes['id'],
  //       'melting_lot_id' => $process['melting_lot_id'],
  //       'row_id' => $process['melting_lot_id'].'-'.rand().'-'.$process['parent_id'],
  //       'in_lot_purity' => $process['out_lot_purity'],
  //       'out_lot_purity' => $process['out_lot_purity'],
  //       'hook_kdm_purity' => $process['hook_kdm_purity'],
  //       'in_weight' => $process_details_attributes['out_weight'],
  //       'in_purity' => $process['out_purity'],
  //       'out_weight' => 0,
  //       'design_code' => $process['design_code'],
  //       'machine_size' => $process['machine_size'],
  //       'karigar' => $process_details_attributes['karigar'],
  //       'description' => $process['description'],
  //       'length' => $process['length'],
  //       'tone'=>$process['tone'],
  //       'remark' => $process['remark'],
  //       'quantity' => $process['quantity'],
  //       'status' => 'Pending',
  //     );
  //     if($process_details_attributes['next_department_name']=='KA Chain') {
  //       $this->load->model('ka_chains/Ka_chain_hook_refresh_process_model');
  //       $start_process['department_name']='Hook';
  //       $process_obj = new Ka_chain_hook_refresh_process_model($start_process);
  //     } elseif ($process_details_attributes['next_department_name']=='Fancy Out') {
  //       $this->load->model('ka_chains/ka_chain_fancy_out_process_model');
  //       $start_process['department_name']='Fancy Out';
  //       $process_obj = new Ka_chain_fancy_out_process_model($start_process);
  //     } else{
  //       $start_process['department_name']='Refresh-Repairing';
  //       $process_obj = new Refresh_model($start_process);
  //     }
      
  //     $process_obj->before_validate();
  //     $process_obj->store();
  // }
}
