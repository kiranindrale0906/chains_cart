<?php 
require_once APPPATH . "modules/processes/models/Process_model.php";
class Fire_tounch_out_melting_process_model extends Process_model{
	public $router_class = 'fire_tounch_out_melting_processes';
  protected $next_process_model = '';
	public $departments = array('Melting');
	
	public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'Fire Tounch Out';
		$this->attributes['process_name'] = 'Melting';
    $this->attributes['chain_name'] = 'Wastage Melting';
		$this->department_not_deleted=array('Melting');
	}

  //$this->load->model('tounch_outs/Tounch_out_melting_process_model');
  //$this->Tounch_out_melting_process_model->update_all_tounch_out_start_records();
  public function update_all_tounch_out_start_records() {
    $this->load->model('processes/process_out_wastage_detail_model');
    $start_processes = $this->get('id', array('department_name' => 'Start'));
    foreach ($start_processes as $start_process) {
      $in_weight = 0;
      $in_fine = 0;
      $process_out_wastage_details = $this->process_out_wastage_detail_model->get('process_id', 
                                                                            array('parent_id' => $start_process['id']));
      if (empty($process_out_wastage_details)) pd('No process_out_wastage_details for: '.$start_process['id']);

      foreach ($process_out_wastage_details as $process_out_wastage_detail) {
        $process = $this->process_model->find('fire_tounch_out, fire_tounch_purity', array('id' => $process_out_wastage_detail['process_id']));
        if (!empty($process)) {
          $in_weight += $process['fire_tounch_out'];
          $in_fine += ($process['fire_tounch_out'] * $process['fire_tounch_purity'] / 100);
        }
      }

      $start_process['in_weight'] = $in_weight;
      $start_process['in_lot_purity'] = ($in_weight==0) ? 0 : $in_fine / $in_weight * 100;
      
      $start_process_obj = new Fire_tounch_out_melting_process_model($start_process);
      $start_process_obj->update(false); 
    }
  }
}