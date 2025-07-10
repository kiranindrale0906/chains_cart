<?php 
include_once APPPATH . "modules/processes/models/Process_model.php";
class Hcl_melting_process_model extends Process_model{
  public $next_process_model = '';
	public $router_class = 'hcl_melting_processes';
	public $departments = array('HCL Process', 'Melting');
  
	public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'HCL';
		$this->attributes['process_name'] = 'HCL Melting Process';
    $this->attributes['chain_name'] = 'Wastage Melting';
		$this->department_not_deleted=array('HCL Process');
    $this->set_out_lot_purity_from_tounch_purity = array('Melting');
	}

  public function before_validate() {
    if (empty($this->attributes['parent_lot_id']) || $this->attributes['parent_lot_id'] == 0) {
      $this->attributes['parent_lot_id']   = $this->attributes['melting_lot_id'];
      $this->attributes['parent_lot_name'] = $this->attributes['lot_no'];
    }

    $this->set_strip_cutting_process_id();
    parent::before_validate();
  }

  public function after_save($action) {
    if ($this->attributes['department_name'] == 'HCL Process') 
      $this->update_chain_process_out_purity_after_strip_cutting();
    
    parent::after_save($action);
  }

  private function set_strip_cutting_process_id() {
    $this->attributes['strip_cutting_process_id'] = 0;
    if ($this->attributes['department_name'] == 'HCL Process') {
      //$start_record = $this->process_model->find('id', array('id' => $this->attributes['parent_id']));
      $this->load->model('processes/process_out_wastage_detail_model');
      $chain_process_id = $this->process_out_wastage_detail_model->find('process_id', array('parent_id' => $this->attributes['id']))['process_id'];
      $chain_process = $this->process_model->find('department_name, in_purity', array('id' => $chain_process_id));
      if ($chain_process['department_name'] == 'Strip Cutting') {
        $this->attributes['strip_cutting_process_id'] = $chain_process_id;
        $this->attributes['in_purity'] = $chain_process['in_purity'];
        $this->attributes['out_lot_purity'] = $this->attributes['in_lot_purity'];
        $this->attributes['hcl_loss'] = 0;
        $this->attributes['balance_fine'] = 0; 
      }
    }
  }

  private function update_chain_process_out_purity_after_strip_cutting() {
    if ($this->attributes['strip_cutting_process_id'] == 0) return;

    $process_after_strip_cutting = $this->process_model->find('', array('parent_id' => $this->attributes['strip_cutting_process_id']));
    $process_after_strip_cutting_obj = $this->process_model->get_model_object($process_after_strip_cutting);
    $process_after_strip_cutting_obj->calculate_in_purity();
    $process_after_strip_cutting_obj->save(false);
    $process_attributes = $process_after_strip_cutting_obj->attributes;
    $this->process_model->set_purity_from_previous_department($process_attributes['id'], $process_attributes['in_purity'], $process_attributes['in_lot_purity']);
  }

  //$this->load->model('hcl/hcl_melting_process_model');
  //$this->hcl_melting_process_model->update_all_hcl_melting_process_records();
  public function update_all_hcl_melting_process_records($start_department_ids = array()) {
    $this->load->model('processes/process_out_wastage_detail_model');
    if (empty($start_department_ids))
      $hcl_processes = $this->get('id, wastage_purity, wastage_lot_purity, in_purity, in_lot_purity', array('department_name' => 'HCL Process', 'strip_cutting_process_id' => 0));
    else
      $hcl_processes = $this->get('id, wastage_purity, wastage_lot_purity, in_purity, in_lot_purity', array('department_name' => 'HCL Process', 'where_in' => array('id' => $start_department_ids)));

    foreach ($hcl_processes as $hcl_process) {
      $in_weight = $in_gross = $in_fine = 0;
      $process_out_wastage_details = $this->process_out_wastage_detail_model->get('process_id, out_weight', 
                                                                                   array('parent_id' => $hcl_process['id']));
      if (empty($process_out_wastage_details)) continue;

      foreach ($process_out_wastage_details as $process_out_wastage_detail) {
        $process = $this->process_model->find('wastage_purity, wastage_lot_purity', 
                                              array('id' => $process_out_wastage_detail['process_id']));
        if (!empty($process)) {
          $in_weight += $process_out_wastage_detail['out_weight'];
          $in_gross  += ($process_out_wastage_detail['out_weight'] * $process['wastage_purity'] / 100);
          $in_fine   += ($process_out_wastage_detail['out_weight'] * $process['wastage_purity'] / 100 * $process['wastage_lot_purity'] / 100);
        }
      }

      $hcl_process_in_fine = $hcl_process['in_weight'] * $hcl_process['in_purity'] / 100 * $hcl_process['in_lot_purity'] / 100;
      if (abs(round($start_process_in_fine, 8) - round($in_fine, 8)) > 0.00001) {
        // $start_process['in_weight'] = $in_weight;
        // $start_process['in_purity'] = ($in_weight==0) ? 0 : $in_gross / $in_weight * 100;
        // $start_process['in_lot_purity'] = ($in_weight==0) ? 0 : $in_fine / $in_gross * 100;
        
        // $start_process['out_weight'] = $in_weight;
        // $start_process['out_purity'] = ($in_weight==0) ? 0 : $in_gross / $in_weight * 100;
        // $start_process['out_lot_purity'] = ($in_weight==0) ? 0 : $in_fine / $in_gross * 100;
        
        // $start_process_obj = new Hcl_melting_process_model($start_process);
        // $start_process_obj->update(false);

        //$hcl_process = $this->find('', array('parent_id' => $start_process_obj->attributes['id']));
        $hcl_process['in_purity']      = ($in_weight==0) ? 0 : $in_gross / $in_weight * 100;
        $hcl_process['in_lot_purity']  = ($in_weight==0) ? 0 : $in_fine / $in_gross * 100;
        //$hcl_process['out_lot_purity'] = $hcl_process['in_lot_purity'];
        $hcl_process_obj = new Hcl_melting_process_model($hcl_process);
        $hcl_process_obj->before_validate();
        $hcl_process_obj->update(false);

        $melting = $this->find('id', array('parent_id' => $hcl_process_obj->attributes['id']));
        if (!empty($melting)) {
          $melting['in_purity']     = $hcl_process_obj->attributes['out_purity'];
          $melting['in_lot_purity'] = $hcl_process_obj->attributes['out_lot_purity'];
          $melting_obj = new Hcl_melting_process_model($melting);
          $melting_obj->before_validate();
          $melting_obj->update(false);
        }
      }

    }
  }

  //$this->load->model('hcl/hcl_melting_process_model');
  //$this->hcl_melting_process_model->update_all_chain_out_purity_after_strip_cutting();
  public function update_all_chain_out_purity_after_strip_cutting() {
    $hcl_processes = $this->get('id', array('department_name' => 'HCL Process'));
    foreach ($hcl_processes as $hcl_process) {
      $hcl_process_obj = new hcl_melting_process_model($hcl_process);
      $hcl_process_obj->set_strip_cutting_process_id();
      $hcl_process_obj->update(false);
      $hcl_process_obj->update_chain_process_out_purity_after_strip_cutting();
    }   
  }
}

