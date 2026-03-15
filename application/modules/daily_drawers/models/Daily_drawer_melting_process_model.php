<?php 
require_once APPPATH . "modules/processes/models/Process_model.php";
class Daily_drawer_melting_process_model extends Process_model{
  public $next_process_model = 'daily_drawers/Daily_drawer_melting_ii_process_model';

	public $router_class = 'melting_processes';

	public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'Daily Drawer';
    $this->attributes['process_name'] = 'Melting';
    $this->attributes['chain_name']   = 'Wastage Melting';
    
    if(HOST == 'ARF'){
      $this->departments = array('Daily Drawer Wastage');
      $this->department_not_deleted = array('Daily Drawer Wastage');
      $this->split_out_weight_departments = array('Daily Drawer Wastage');
    } elseif (HOST == 'ARC') {
      $this->departments = array('Daily Drawer Wastage');
      $this->department_not_deleted = array('Daily Drawer Wastage');
      $this->set_out_lot_purity_from_tounch_purity = array('Daily Drawer Wastage');
    }else {
      $this->departments = array('Melting');
      $this->department_not_deleted = array('Melting');
      $this->set_out_lot_purity_from_tounch_purity = array('Melting');
    }
    
    //$this->compute_tounch_loss_fine_departments = array('Daily Drawer Wastage', 'Melting');
  }

  protected function get_next_process_model($process_field_attributes = array()) {
    if (HOST=='AR Gold' || HOST=='ARC')
      $this->next_model_name = '';
    else 
      $this->next_model_name = 'daily_drawers/Daily_drawer_melting_ii_process_model';
    return $this->next_model_name;
  }
  

  // public function before_validate() {
  //   $this->attributes['balance'] = round($this->attributes['balance'],4);
  //   $this->attributes['balance_fine'] = round($this->attributes['balance_fine'],4);
  //   $this->attributes['balance_gross'] = round($this->attributes['balance_gross'],4);
  // }

  //$this->daily_drawer_melting_process_model->update_all_daily_drawer_melting_process_start_records();
  // public function after_save($action) {
  //   if (HOST=='ARF' and $this->attributes['department_name']=='Daily Drawer Wastage' and $this->attributes['out_weight'] > 0) {
  //     $this->create_melting_II_process_record();      
  //   } else {
  //     parent::after_save($action);
  //   }
  // }

  // private function create_melting_II_process_record(){
  //   $process_fields = $this->Process_field_model->get('',array('process_id' => $this->attributes['id'],
  //                                                              'out_weight >' => 0));
  //   foreach ($process_fields as $index => $process_field) {
  //     $start_process=array(
  //     'department_name' => 'Start',
  //     'lot_no' => $this->attributes['lot_no'],
  //     'parent_id' => $this->attributes['id'],
  //     'parent_lot_id' => $this->attributes['parent_lot_id'],
  //     'parent_lot_name' => $this->attributes['parent_lot_name'],
  //     'melting_lot_id' => $this->attributes['melting_lot_id'],
  //     'row_id' => $this->attributes['melting_lot_id'].'-'.$index.'-'.$this->attributes['parent_id'],
  //     'in_lot_purity' => $this->attributes['in_lot_purity'],
  //     'out_lot_purity' => $this->attributes['out_lot_purity'],
  //     'in_weight' => $process_field['out_weight'],
  //     'out_weight' => $process_field['out_weight'],
  //     'in_purity' => $this->attributes['out_purity'],
  //     'hook_kdm_purity' => $this->attributes['hook_kdm_purity'],
  //     'out_weight' => $process_field['out_weight'],
  //     'design_code' => $this->attributes['design_code'],
  //     'machine_size' => $this->attributes['machine_size'],
  //     'karigar' => $this->attributes['karigar'],
  //     'length' => $this->attributes['length'],
  //     'remark' => $this->attributes['remark'], 
  //     'tone'=>$this->attributes['tone'],
  //     'chain_name' => $this->attributes['chain_name'],);
  //     $process_obj = new Daily_drawer_melting_ii_process_model($start_process);
  //     $process_obj->store();
  //   }
  //   parent::set_current_process_status_completed();
  // }

  public function update_all_daily_drawer_melting_process_start_records() {
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
        
        $start_process_obj = new Daily_drawer_melting_process_model($start_process);
        $start_process_obj->update(false); 

        $melting_process = $this->find('', array('parent_id' => $start_process_obj->attributes['id']));
        $melting_process['in_purity'] = $start_process['out_purity'];
        $melting_process['in_lot_purity'] = $start_process['out_lot_purity'];
        $melting_process_obj = new Daily_drawer_melting_process_model($melting_process);
        $melting_process_obj->before_validate();
        $melting_process_obj->update(false);
      }
    }
  }
}
