<?php 
include_once APPPATH . "modules/processes/models/Process_model.php";
class Refresh_model extends Process_model{
	protected $next_process_model = 'refresh/Refresh_final_process_model';
	
	public $router_class = 'refresh';
	
	public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'Refresh';
		$this->attributes['process_name'] = 'Refresh';
    $this->attributes['chain_name'] = 'Refresh';

    if (HOST=='ARC' || HOST=='ARF')
	 	  $this->departments = array('Refresh-Repairing','Buffing', 'GPC', 'Factory Hold');
		else
		  $this->departments = array('Refresh-Repairing','Buffing','Hallmark Out', 'GPC', 'Factory Hold');	
				
		$this->department_not_deleted = array('Start', 'Refresh-Repairing');
		$this->compute_tounch_loss_fine_departments = array('GPC');
		$this->split_out_weight_departments = array('Factory Hold');
		$this->load->model(array('refresh/refresh_hand_cutting_process_model','refresh/refresh_hand_dull_process_model'));
	}

  public function before_validate() {
    if (   (   $this->attributes['department_name'] == 'Refresh-Repairing'
            || $this->attributes['department_name'] == 'GPC')
        && $this->attributes['out_weight'] > 0
        && isset($this->attributes['id'])) {
      $next_department_process = $this->find('id', array('parent_id' => $this->attributes['id']));
      if (empty($next_department_process))
        $this->formdata['force_create'] = TRUE;
    }
      
    parent::before_validate();
  }
  protected function get_departments() {  
    $buffing_record = $this->find('id, skip_department', array('department_name' => 'Buffing', 'row_id' => $this->attributes['row_id']));
    if (!empty($buffing_record) && $buffing_record['skip_department'] == 'No'){
        $this->departments = array('Refresh-Repairing','Buffing', 'GPC', 'Factory Hold');
    }else{
       $this->departments = array('Refresh-Repairing','Buffing','Hallmark Out' ,'GPC', 'Factory Hold');
    }
    return $this->departments;
  }

	public function create_next_process_department_record($process, $process_details_attributes){
    $start_process=array(
      'lot_no' => $process['lot_no'],
      'parent_id' => $process['id'],
      'parent_process_detail_id' => $process_details_attributes['id'],
      'order_detail_id' => $this->attributes['order_detail_id'],
      'melting_lot_id' => $process['melting_lot_id'],
      'row_id' => $process['melting_lot_id'].'-'.rand().'-'.$process['parent_id'],
      'in_lot_purity' => $process['out_lot_purity'],
      'out_lot_purity' => $process['out_lot_purity'],
      'hook_kdm_purity' => $process['hook_kdm_purity'],
      'in_weight' => $process_details_attributes['recutting_out'],
      'in_purity' => $process['out_purity'],
      'melting_wastage' => 0,
      'out_weight' => 0,
      'design_code' => $process['design_code'],
      'machine_size' => $process['machine_size'],
      'karigar' => $process['karigar'],
      'description' => $process['description'],
      'length' => $process['length'],
      'tone'=>$process['tone'],
      'tounch_no'=>$process['tounch_no'],
      'tounch_purity'=>$process['tounch_purity'],
      'remark' => $process['remark'],
      'status'=>'Pending',
      'melting_lot_category_one'=>$process['melting_lot_category_one'],
      'melting_lot_category_two'=>$process['melting_lot_category_two'],
      'melting_lot_category_three'=>$process['melting_lot_category_three'],
      'melting_lot_category_four'=>$process['melting_lot_category_four'],
      'melting_lot_chain_name'=>$process_details_attributes['next_department_name'],
    );
  
    if($process_details_attributes['next_department_name']=='Hand Cutting'){
        $start_process['department_name']='Hand Cutting';
        $process_obj = new refresh_hand_cutting_process_model($start_process);
    }elseif($process_details_attributes['next_department_name']=='Hand Dull'){
        $start_process['department_name']='Hand Dull';
      $process_obj = new refresh_hand_dull_process_model($start_process);
    }
    $process_obj->before_validate();
    $process_obj->store();
  }
	
}
