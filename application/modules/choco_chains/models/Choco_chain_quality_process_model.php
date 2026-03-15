<?php 
include_once APPPATH . "modules/processes/models/Process_model.php";
class Choco_chain_quality_process_model extends Process_model{
	protected $next_process_model = '';
	public $router_class = 'quality_processes';
	public $departments = array('Hand Cutting','Hand Dull','Buffing','Hallmark Out','GPC Or Rodium');
  	protected $table_name= 'processes';
	
	public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'Choco Chain';
		$this->attributes['process_name'] = 'Quality Process';
	}

	public function create_quality_process_record($process,$process_field){
	$this->load->model('choco_chains/choco_chain_quality_process_model');
    $start_process=array(
      'lot_no' => $process['lot_no'],
      'parent_id' => $process['id'],
      'parent_process_detail_id' => $process['id'],
      'order_detail_id' => $process['order_detail_id'],
      'melting_lot_id' => $process['melting_lot_id'],
      'row_id' => $process['melting_lot_id'].'-'.rand().'-'.$process['parent_id'],
      'in_lot_purity' => $process['out_lot_purity'],
      'out_lot_purity' => $process['out_lot_purity'],
      'hook_kdm_purity' => $process['hook_kdm_purity'],
      'in_weight' => $process_field['recutting_out'],
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

    );
      $start_process['department_name']='Hand Cutting';
      $process_obj = new choco_chain_quality_process_model($start_process);
      $process_obj->before_validate();
      $process_obj->store();
    }
}