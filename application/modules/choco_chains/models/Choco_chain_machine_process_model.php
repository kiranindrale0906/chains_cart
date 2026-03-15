<?php 

include_once APPPATH . "modules/processes/models/Process_model.php";
class Choco_chain_machine_process_model extends Process_model{
  public $next_process_model = 'choco_chains/Choco_chain_final_process_model';

	public $router_class = 'machine_processes';
	public $departments = array('Chain Making');
  
  public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'Choco Chain';
		$this->attributes['process_name'] = 'Machine Process';
		$this->attributes['chain_name']   = 'Choco Chain';
		
		$this->department_not_deleted = array('Chain Making');
    $this->split_out_weight_departments = array('Chain Making');
    $this->set_wastage_purity_equal_to_in_purity = array('Chain Making');
    $this->auto_compute_loss_departments = array('Chain Making');
    $this->load->model(array('choco_chains/Choco_chain_hand_cutting_process_model'));
  }

  protected function get_next_process_model($process_field_attributes = array()) {
    $melting_details=$this->melting_lot_model->find('',array('id'=>$this->attributes['melting_lot_id']));
    // if(!empty($melting_details)&&$melting_details['chain']=='Casting 75'){
    //   $this->next_model_name = 'choco_chains/Choco_chain_casting_seventy_final_process_model';
    // }elseif(!empty($melting_details)&&$melting_details['chain']=='Casting 92'){ 
    //     $this->next_model_name = 'choco_chains/Choco_chain_casting_ninety_final_process_model';
   
    // }else{
    if ($this->attributes['in_lot_purity'] == '75.15')
      $this->next_model_name = 'choco_chains/Choco_chain_imp_final_process_model';
    else 
      $this->next_model_name = 'choco_chains/Choco_chain_final_process_model';
    
    return $this->next_model_name;
  }
  public function after_save($action) {
      parent::after_save($action);
      if($this->attributes['department_name']=='Chain Making' && $this->attributes['factory_out']>0)
      $this->create_next_process_start_record();    
  }
  private function create_next_process_start_record(){
    $start_process=array(
      'department_name' => 'Start',
      'lot_no' => $this->attributes['lot_no'],
      'parent_id' => $this->attributes['id'],
      'parent_lot_id' => $this->attributes['parent_lot_id'],
      'parent_lot_name' => $this->attributes['parent_lot_name'],
      'order_detail_id' => $this->attributes['order_detail_id'],
      'melting_lot_id' => $this->attributes['melting_lot_id'],
      'row_id' => $this->attributes['melting_lot_id'].'-'.rand().'-'.$this->attributes['parent_id'],
      'in_lot_purity' => $this->attributes['out_lot_purity'],
      'out_lot_purity' => $this->attributes['out_lot_purity'],
      'in_weight' => $this->attributes['factory_out'],
      'out_weight' => 0,
      'status' => 'Pending',
      'in_purity' => $this->attributes['out_purity'],
      'hook_kdm_purity' => $this->attributes['hook_kdm_purity'],
      'design_code' => $this->attributes['design_code'],
      'machine_size' => $this->attributes['machine_size'],
      'karigar' => $this->attributes['karigar'],
      'length' => $this->attributes['length'],
      'remark' => $this->attributes['remark'], 
      'tone'=>$this->attributes['tone'],
      'tounch_no'=>$this->attributes['tounch_no'],
      'tounch_purity'=>$this->attributes['tounch_purity'],
      'description'=>$this->attributes['description'],
      'chain_name' => $this->attributes['chain_name'],
      'melting_lot_category_one'=>$this->attributes['melting_lot_category_one'],
      'melting_lot_category_two'=>$this->attributes['melting_lot_category_two'],
      'melting_lot_category_three'=>$this->attributes['melting_lot_category_three'],
      'melting_lot_category_four'=>$this->attributes['melting_lot_category_four'],
      'melting_lot_chain_name'=>$this->attributes['melting_lot_chain_name']);
      $start_process['department_name']='Hand Cutting';
      $process_obj = new Choco_chain_hand_cutting_process_model($start_process);
      $process_obj->before_validate();
      $process_obj->store();
    
    parent::set_current_process_status_completed();
  }
}
		