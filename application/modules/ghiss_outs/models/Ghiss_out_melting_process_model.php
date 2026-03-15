<?php 
require_once APPPATH . "modules/processes/models/Process_model.php";
class Ghiss_out_melting_process_model extends Process_model{
  public $next_process_model = 'ghiss_outs/Ghiss_out_final_process_model';

	public $router_class = 'ghiss_out_melting_processes';
	public $departments = array('Ghiss Melting'); //Melting II
	
	public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'Ghiss Out';
		$this->attributes['process_name'] = 'Melting';
    $this->attributes['chain_name']   = 'Wastage Melting';

		$this->department_not_deleted = array('Ghiss Melting');
    $this->set_wastage_lot_purity_from_tounch_purity = array('Ghiss Melting');
    $this->split_out_weight_departments = array('Ghiss Melting');
	}

  //$this->load->model('ghiss_outs/ghiss_out_melting_process_model');
  //$this->ghiss_out_melting_process_model->update_all_ghiss_out_process_records();
  public function update_all_ghiss_out_process_records() {
    $this->load->model('processes/process_out_wastage_detail_model');
    $start_processes = $this->get('id', array('department_name' => 'Start'));
    foreach ($start_processes as $start_process) {
      $in_weight = 0;
      $in_fine = 0;
      $process_out_wastage_details = $this->process_out_wastage_detail_model->get('process_id, out_weight', 
                                                                            array('parent_id' => $start_process['id']));
      if (empty($process_out_wastage_details)) pd('No process_out_wastage_details for: '.$start_process['id']);

      foreach ($process_out_wastage_details as $process_out_wastage_detail) {
        $process = $this->process_model->find('wastage_lot_purity', array('id' => $process_out_wastage_detail['process_id']));
        if (!empty($process)) {
          $in_weight += $process_out_wastage_detail['out_weight'];
          $in_fine += ($process_out_wastage_detail['out_weight'] * $process['wastage_lot_purity'] / 100);
        }
      }

      $start_process['in_weight'] = $in_weight;
      $start_process['in_purity'] = 100;
      $start_process['in_lot_purity'] = ($in_weight==0) ? 0 : $in_fine / $in_weight * 100;
      
      $start_process['out_weight'] = $in_weight;
      $start_process['out_purity'] = 100;
      $start_process['out_lot_purity'] = ($in_weight==0) ? 0 : $in_fine / $in_weight * 100;
      
      $start_process_obj = new Ghiss_out_melting_process_model($start_process);
      $start_process_obj->update(false); 

      $melting_process = $this->find('', array('parent_id' => $start_process_obj->attributes['id']));
      $melting_process['in_purity'] = $start_process['out_purity'];
      $melting_process['in_lot_purity'] = $start_process['out_lot_purity'];
      $melting_process_obj = new Ghiss_out_melting_process_model($melting_process);
      $melting_process_obj->before_validate();
      $melting_process_obj->update(false);
    }
  }
}