<?php 
require_once APPPATH . "modules/processes/models/Process_model.php";
class Melting_wastage_refine_out_melting_process_model extends Process_model{
  public $next_process_model = '';
	public $router_class = 'melting_wastage_refine_out_melting_processes';
	public $departments = array('Refine Melting'); //Melting II
	
	public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'Melting Wastage Refine Out';
		$this->attributes['process_name'] = 'Melting';
    $this->attributes['chain_name']   = 'Wastage Melting';

		$this->department_not_deleted = array('Refine Melting');
    $this->compute_tounch_loss_fine_for_refine_loss = array('Refine Melting');
	}

  public function before_validate(){
    if (   $this->attributes['department_name'] == 'Refine Melting' 
        && $this->attributes['melting_wastage'] > 0) {
      $this->attributes['refine_loss'] = $this->attributes['in_weight'] - $this->attributes['melting_wastage'];
    }
    parent::before_validate();
  }
  /*
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
      
      $start_process_obj = new melting_wastage_refine_out_melting_process_model($start_process);
      $start_process_obj->update(false); 

      $melting_process = $this->find('', array('parent_id' => $start_process_obj->attributes['id']));
      $melting_process['in_purity'] = $start_process['out_purity'];
      $melting_process['in_lot_purity'] = $start_process['out_lot_purity'];
      $melting_process_obj = new melting_wastage_refine_out_melting_process_model($melting_process);
      $melting_process_obj->before_validate();
      $melting_process_obj->update(false);
    }
  }*/
}