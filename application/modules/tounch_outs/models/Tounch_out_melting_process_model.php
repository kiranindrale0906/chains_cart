<?php 
require_once APPPATH . "modules/processes/models/Process_model.php";
class Tounch_out_melting_process_model extends Process_model{
	public $router_class = 'tounch_out_melting_processes';
	public $departments = array('Melting');
  protected $next_process_model = '';
	
	public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'Tounch Out';
		$this->attributes['process_name'] = 'Melting';
    $this->attributes['chain_name'] = 'Wastage Melting';
    
		$this->department_not_deleted=array('Melting');
    $this->set_out_lot_purity_from_tounch_purity = array('Melting');
	}

  //$this->load->model('tounch_outs/Tounch_out_melting_process_model');
  //$this->Tounch_out_melting_process_model->update_all_tounch_out_start_records();
  public function update_all_tounch_out_start_records() {
    $this->load->model('processes/process_out_wastage_detail_model');
    $start_processes = $this->get('', array('department_name' => 'Start'));
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

      $start_process_in_fine = $start_process['in_weight'] * $start_process['in_purity'] / 100 * $start_process['in_lot_purity'] / 100;
      if (abs(round($start_process_in_fine, 8) - round($in_fine, 8)) > 0.00001) {
        $start_process['in_weight'] = $in_weight;
        $start_process['in_lot_purity'] = ($in_weight==0) ? 0 : $in_fine / $in_weight * 100;
        
        $start_process['out_weight'] = $in_weight;
        $start_process['out_lot_purity'] = ($in_weight==0) ? 0 : $in_fine / $in_weight * 100;
        
        $start_process_obj = new Tounch_out_melting_process_model($start_process);
        $start_process_obj->update(false); 

        $melting_process = $this->find('', array('parent_id' => $start_process_obj->attributes['id']));
        $melting_process['in_purity'] = $start_process_obj->attributes['out_purity'];
        $melting_process['in_lot_purity'] = $start_process_obj->attributes['out_lot_purity'];
        $melting_process_obj = new Tounch_out_melting_process_model($melting_process);
        $melting_process_obj->before_validate();
        $melting_process_obj->update(false);
      }
    }
  }
}