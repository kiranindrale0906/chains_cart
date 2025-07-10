
<?php 
class Issue_department_detail_model extends BaseModel{
	protected $table_name= 'issue_department_details';
	public function __construct($data = array()){
		parent::__construct($data);
		$this->load->model(array('processes/process_detail_model'));
	}

	public function after_save($action) {

		$process = $this->Process_model->find('',array('id' => $this->attributes['process_id']));
		if(empty($process)) return;
		$model_name = get_model_name($process['product_name'], $process['process_name']);
		$this->load->model($model_name['module_name'].'/'.$model_name['model_name']);
		$process_object = new $model_name['model_name']($process);
		if (!isset($this->attributes['out_weight']) || empty($this->attributes['out_weight'])) return;
	
		if ($this->attributes['field_name'] == 'Melting Wastage') 
			$process_object->attributes['issue_melting_wastage'] = $this->attributes['out_weight'] + $process['issue_melting_wastage'];
		elseif ($this->attributes['field_name'] == 'Export Internal') 
			$process_object->attributes['issue_rejected'] = $this->attributes['out_weight'] + $process['issue_rejected'];
		elseif ($this->attributes['field_name'] == 'Domestic Internal') 
			$process_object->attributes['issue_rejected'] = $this->attributes['out_weight'] + $process['issue_rejected'];
		elseif ($this->attributes['field_name'] == 'Daily Drawer Wastage') 
			$process_object->attributes['issue_daily_drawer_wastage'] = $this->attributes['out_weight'] + $process['issue_daily_drawer_wastage'];
		elseif ($this->attributes['field_name'] == 'CZ Wastage') 
			$process_object->attributes['issue_cz_wastage'] = $this->attributes['out_weight'] + $process['issue_cz_wastage'];
		elseif ($this->attributes['field_name'] == 'HCL Loss') 
			$process_object->attributes['issue_hcl_loss'] = $this->attributes['out_weight'] + $process['issue_hcl_loss'];
		elseif ($this->attributes['field_name'] == 'Refine Loss') 
			$process_object->attributes['issue_refine_loss'] = $this->attributes['out_weight'] + $process['issue_refine_loss'];
		elseif ($this->attributes['field_name'] == 'Tounch Loss Fine') 
			$process_object->attributes['issue_tounch_loss_fine'] = $this->attributes['out_weight'] + $process['issue_tounch_loss_fine'];
		elseif ($this->attributes['field_name'] == 'Chitti Out') 
			$process_object->attributes['issue_chitti_out'] = $this->attributes['out_weight'] + $process['issue_chitti_out'];
		elseif ($this->attributes['field_name'] == 'Cutting Ghiss' || $this->attributes['field_name'] == 'Hand Cutting Ghiss'|| $this->attributes['field_name'] == 'Hand Dull Ghiss' || $this->attributes['field_name'] == 'Sand Dull Ghiss' || $this->attributes['field_name'] == 'Ice Cutting Ghiss')
			$process_object->attributes['issue_ghiss'] = $this->attributes['out_weight'] + $process['issue_ghiss'];
       	        elseif ($this->attributes['field_name'] == 'Ghiss Melting Loss') 
	  	$process_object->attributes['issue_loss'] = $this->attributes['out_weight'] + $process['issue_loss'];
		elseif ($this->attributes['field_name'] == 'Castic Loss') 
			$process_object->attributes['issue_loss'] = $this->attributes['out_weight'] + $process['issue_loss'];
		elseif ($this->attributes['field_name'] == 'Hallmark Out') 
			$process_object->attributes['issue_hallmark_out'] = $this->attributes['out_weight'] + $process['issue_hallmark_out'];
		elseif ($this->attributes['field_name'] == 'GPC Repair Out') {
			$process_object->attributes['issue_gpc_out'] = $this->attributes['out_weight'] + $process['issue_gpc_out'];
		}elseif ($this->attributes['field_name'] == 'Huid') {
			$process_object->attributes['issue_gpc_out'] = $this->attributes['out_weight'] + $process['issue_gpc_out'];
		}elseif ($this->attributes['field_name'] == 'QC Out') {
			$process_object->attributes['issue_gpc_out'] = $this->attributes['out_weight'] + $process['issue_gpc_out'];
		}elseif ($this->attributes['field_name'] == 'Hallmark Receipt') {
			$process_object->attributes['issue_gpc_out'] = $this->attributes['out_weight'] + $process['issue_gpc_out'];
		}elseif ($this->attributes['field_name'] == 'Fire Tounch Loss'){ 
			$process_object->attributes['issue_refine_loss'] = $this->attributes['out_weight'] + $process['issue_refine_loss'];
		}elseif ($this->attributes['field_name'] == 'GPC Loss Out') {
			$process_object->attributes['gpc_out'] = $process['gpc_out'] - $this->attributes['out_weight'];
			$process_object->attributes['loss'] = $this->attributes['out_weight'] + $process['loss'];
		}
		else {
			$process_object->attributes['issue_gpc_out'] = $this->attributes['out_weight'] + $process['issue_gpc_out'];
			$process_object->attributes['status'] = 'Complete';
		}
		if($this->attributes['field_name'] == 'Ice Cutting Ghiss' || $this->attributes['field_name'] == 'Hand Cutting Ghiss' || $this->attributes['field_name'] == 'Hand Dull Ghiss'|| $this->attributes['field_name'] == 'Sand Dull Ghiss' || $this->attributes['field_name'] == 'Ghiss Melting Loss' || $this->attributes['field_name'] == 'Tounch Loss Fine'){
			$process_object->calculate_balance_wastage($this->attributes['field_name']);

		}else{
			$process_object->calculate_balance_wastage();
		}	
		
		$process_object->save(false);
	}

	public function validation_rules($klass='') {
    $rules= array(array('field' => 'issue_department_details[issue_department_id]', 'label' => 'Issue Department ID',
									      'rules' => 'trim|required',));
    return $rules;
  }
}
?>
