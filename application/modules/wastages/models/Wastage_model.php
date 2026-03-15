<?php
class Wastage_model extends BaseModel{
	protected $table_name = 'wastages';
	protected $id = 'id';
	public function __construct() {
		parent::__construct();
		//$this->load->model(array('../core/process_model'));
	}

	function create_wastage_record($action, $data) {
		if($data['melting_wastage'] != 0 && $data['department_name'] != 'HCL') {
			//pr($data);exit;
			$wastage_details = new wastage_model();
			$wastage_details->attributes['process_id'] = $data['id'];
			$wastage_details->attributes['product_name'] = $data['product_name'];
			$wastage_details->attributes['process_name'] = $data['process_name'];
			$wastage_details->attributes['department_name'] = $data['department_name'];
			$wastage_details->attributes['melting_lot_id'] = $data['melting_lot_id'];
			$wastage_details->attributes['lot_no'] = $data['lot_no'];
			//$wastage_details->attributes['process_date'] = datetime();
			$wastage_details->attributes['in_weight'] = $data['in_weight'];
			$wastage_details->attributes['in_purity'] = $data['in_purity'];
			$wastage_details->save();
		}
	}
}