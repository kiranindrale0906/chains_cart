<?php 
include_once APPPATH . "modules/processes/models/Process_model.php";
class Pending_loss_from_hook_model extends Process_model{
  protected $next_process_model ='';
	public $router_class = 'pending_loss_from_hooks';
	public $departments = array('Start');
  protected $table_name= 'processes';
  
	
  public function __construct($data = array()){
		parent::__construct($data);
    $this->attributes['product_name'] = 'Pending Loss from Hook';
    $this->attributes['process_name'] = 'Pending Loss from Hook';
    $this->attributes['chain_name'] = 'KA Chain';
    $this->department_not_deleted=array('Start');
    $this->load->model(array('processes/Process_field_model'));
	}

  public function before_validate() {
    if (isset($this->formdata['process_out_wastage_details']) && !empty($this->formdata['process_out_wastage_details'])) {
      $this->attributes['in_weight'] = $this->process_model->find('sum(daily_drawer_in_weight - daily_drawer_out_weight 
                                                                   - hook_in + hook_out) as daily_drawer_weight',
                                                               array('karigar' => $this->attributes['karigar'],'hook_kdm_purity >' => $this->attributes['in_lot_purity']-2,'hook_kdm_purity <' => $this->attributes['in_lot_purity']+2))['daily_drawer_weight'];
      $this->attributes['department_name'] = 'Start';
      $this->attributes['in_lot_purity'] = 100;
      $this->attributes['out_lot_purity'] = 100;
      $this->attributes['row_id'] = rand();
      //$process_ids = array_column($this->formdata['process_out_wastage_details'], 'process_id');
      //$this->attributes['hook_records'] = $this->process_model->find('sum(hook_in) as hook_in_weight', 
      //                                                                array('where_in' => array('id' => $process_ids)));
      $this->attributes['loss'] = $this->attributes['in_weight'] - $this->attributes['out_weight'];
    }
    parent::before_validate();
  }


  public function after_save($after_save = true) {
    parent::after_save($after_save);
    if (isset($this->formdata['process_out_wastage_details']) 
        && !empty($this->formdata['process_out_wastage_details'])) {
      $process_ids = array_column($this->formdata['process_out_wastage_details'], 'process_id');
      $process = $this->process_model->find('sum(hook_in) as hook_in_weight', array('where_in' => array('id' => $process_ids)));
      $total_hook_in_weight = $process['hook_in_weight'];
      
      foreach ($this->formdata['process_out_wastage_details'] as $index => $process_out_wastage_detail) {
        $hook_department = $this->process_model->find('', array('id' => $process_out_wastage_detail['process_id']));
        $hook_department['karigar_loss'] = ($hook_department['hook_in'] * $this->attributes['loss'] / $total_hook_in_weight );
        $hook_department['hook_out'] = -1 * $hook_department['karigar_loss'];
        $hook_department_obj = $this->process_model->get_model_object($hook_department);
        //$hook_department_obj = new Ka_chain_hook_process_model($hook_department);
        $hook_department_obj->update(false);

        $process_detail = array('process_id' => $hook_department['id'],
                                'karigar' => $hook_department['karigar'],
                                'daily_drawer_type' => 'ARF Accessories',
                                'hook_out' => $hook_department['hook_out'],
                                'hook_kdm_purity' => $hook_department['hook_kdm_purity']);
        $process_detail_obj = new Process_field_model($process_detail);
        $process_detail_obj->formdata['field_name'] = 'hook_out';
        $process_detail_obj->store();
        
        $this->save_association_data($hook_department_obj->attributes);
      }
    }

    $this->attributes['factory_out'] = $this->attributes['loss'];
    $this->attributes['loss'] = 0;
    $this->attributes['balance_loss'] = 0;
    $this->update(false);
  }
  
  function save_association_data($hook_department_attributes) {
    $process_out_wastage_detail = array('parent_id'  => $this->attributes['id'],
                                        'process_id' => $hook_department_attributes['id'],
                                        'out_weight' => $hook_department_attributes['karigar_loss'],
                                        'field_name' => 'Pending Loss from Hook');
    $process_out_wastage_detail_obj = new process_out_wastage_detail_model($process_out_wastage_detail);
    $process_out_wastage_detail_obj->save();
  }

}
