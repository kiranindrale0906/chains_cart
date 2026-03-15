<?php 
class Process_out_wastage_detail_model extends BaseModel{
	protected $table_name= 'process_out_wastage_details';
	
	public function __construct($data = array()){
		parent::__construct($data);
		$this->load->model(array('processes/process_model'));
	}

	public function after_save($action) {
		$process = $this->process_model->find('',array('id' => $this->attributes['process_id']));

		$model_name = get_model_name($process['product_name'], $process['process_name']);
		$this->load->model($model_name['module_name'].'/'.$model_name['model_name']);
		$process_object = new $model_name['model_name']($process);
		if (!empty($this->attributes['out_weight'])) {
			if ($this->attributes['field_name'] == 'Daily Drawer Wastage') {
				$process_object->attributes['out_daily_drawer_wastage'] = $this->attributes['out_weight'] + $process['out_daily_drawer_wastage'];
			} elseif ($this->attributes['field_name'] == 'CZ Wastage') {
				$process_object->attributes['out_cz_wastage'] = $this->attributes['out_weight'] + $process['out_cz_wastage'];
			} elseif ($this->attributes['field_name'] == 'HCL Wastage') {
				$process_object->attributes['out_hcl_wastage'] = $this->attributes['out_weight'] + $process['out_hcl_wastage'];
			}elseif ($this->attributes['field_name'] == 'Rod Cleaning') {
				$process_object->attributes['out_hcl_wastage'] = $this->attributes['out_weight'] + $process['out_hcl_wastage'];
			} elseif ($this->attributes['field_name'] == 'Tounch Out') {
				$process_object->attributes['out_tounch_out'] = $this->attributes['out_weight'] + $process['out_tounch_out'];
			}elseif ($this->attributes['field_name'] == 'Fire Tounch Out') {
				$process_object->attributes['out_fire_tounch_out'] = $this->attributes['out_weight'] + $process['out_fire_tounch_out'];
			} elseif ($this->attributes['field_name'] == 'Ghiss Out') {
				$process_object->attributes['out_ghiss'] = $this->attributes['out_weight'] + $process['out_ghiss'];
			}elseif ($this->attributes['field_name'] == 'Melting Wastage Refine Out') {
				$process_object->attributes['out_melting_wastage'] = $this->attributes['out_weight'] + $process['out_melting_wastage'];
			} elseif ($this->attributes['field_name'] == 'Hcl Ghiss Out') {
				$process_object->attributes['out_hcl_ghiss'] = $this->attributes['out_weight'] + $process['out_hcl_ghiss'];
			} elseif ($this->attributes['field_name'] == 'Loss Out') {
				$process_object->attributes['out_loss'] = $this->attributes['out_weight'] + $process['out_loss'];
			}elseif ($this->attributes['field_name'] == 'Melting Loss Out') {
				$process_object->attributes['out_loss'] = $this->attributes['out_weight'] + $process['out_loss'];
			} elseif ($this->attributes['field_name'] == 'Pending Ghiss Out' || $this->attributes['field_name'] == 'Pending Ghiss Issue') {
				$process_object->attributes['out_pending_ghiss'] = $this->attributes['out_weight'] + $process['out_pending_ghiss'];
			} elseif ($this->attributes['field_name'] == 'Solder Wastage') {
				$process_object->attributes['out_solder_wastage'] = $this->attributes['out_weight'] + $process['out_solder_wastage'];
			} elseif ($this->attributes['field_name'] == 'Tounch Ghiss Out') {
				$process_object->attributes['out_tounch_ghiss'] = $this->attributes['out_weight'] + $process['out_tounch_ghiss'];
			}
			//elseif ($this->attributes['field_name'] == 'Stone Melting') {
			//	$process_object->attributes['stone_vatav'] = $this->attributes['out_weight'] + $process['stone_vatav'];
		  //		$process_object->attributes['ghiss'] = $this->attributes['out_weight'];
		  //	}
		}
		$process_object->before_validate();
		$process_object->save(false);
	}
}