<?php
class Fire_tounch_report_model extends BaseModel{
	protected $table_name = 'processes';
	protected $id = 'id';
  public $router_class="fire_tounch_reports";
  public function __construct($data=array()) {
    parent::__construct($data);
    $this->load->model(array('processes/process_model', 
                             'tounch_outs/fire_tounch_daily_drawer_process_model', 'tounch_outs/fire_tounch_tounch_out_model'));
  }

  public function before_validate() {
    $this->attributes['fire_tounch_gross'] = $this->attributes['fire_tounch_in'] - $this->attributes['fire_tounch_out']; //$fire_tounch_balance*$this->attributes['fire_tounch_purity']/100;
    
    
    //$this->attributes['refine_loss'] = $this->attributes['fire_tounch_gross']-$this->attributes['fire_tounch_fine'];
    //$this->attributes['hook_kdm_purity'] = 100;

    // if (($this->attributes['product_name']=='HCL' && $this->attributes['department_name']=='Melting')
    //     || ($this->attributes['product_name']=='HCL Ghiss Out' && $this->attributes['department_name']=='Melting')
    //     || ($this->attributes['product_name']=='Daily Drawer' && $this->attributes['department_name']=='Melting')
    //     || ($this->attributes['product_name']=='Tounch Out' && $this->attributes['department_name']=='Melting')
    //     || ($this->attributes['product_name']=='Fire Tounch Out' && $this->attributes['department_name']=='Melting')
    //     || ($this->attributes['product_name']=='Ghiss Out' && $this->attributes['department_name']=='Melting')
    //     || ($this->attributes['product_name']=='Loss Out' && $this->attributes['department_name']=='Melting')) {
    //   $this->attributes['out_lot_purity'] = 100;
    //   $this->attributes['balance_gross'] = 0;
    //   $this->attributes['balance_fine'] = 0;
    // } 
  }

  public function after_save($action) {
    if(!empty($this->attributes['fire_tounch_fine']) || !empty($this->attributes['fire_tounch_gross'])){
      $this->create_fire_tounch_out_daily_drawer_wastage_record($this->attributes);
    } else {
     parent::after_save($action);
    }

  }

  public function create_fire_tounch_out_daily_drawer_wastage_record($process) {
    $start_process=array(
      'lot_no'               => $process['lot_no'],
      'parent_id'            => $process['id'],
      'in_purity'            => 100,
      'in_lot_purity'        => $this->attributes['wastage_lot_purity'],
      'out_lot_purity'       => $this->attributes['wastage_lot_purity'],
      'hook_kdm_purity'      => $this->attributes['hook_kdm_purity'],
      'in_weight'            => $this->attributes['fire_tounch_out'],
      'out_weight'           => 0,
      'tounch_in'            => $this->attributes['fire_tounch_out'],
      'tounch_out'           => $this->attributes['fire_tounch_out'],
      'wastage_purity'       => 100,
      'wastage_lot_purity'   => $this->attributes['wastage_lot_purity'],
      'status'               => 'Complete'
    );
    $process_obj = new fire_tounch_tounch_out_model($start_process);
    $process_obj->before_validate();
    $process_obj->store();  

    //$fine_loss_weight  = ($process['fire_tounch_gross'] * $process['wastage_lot_purity'] / 100) - $process['fire_tounch_fine'];
    $start_process=array(
      'lot_no'               => $process['lot_no'],
      'parent_id'            => $process['id'],
      // 'in_purity'            => 100,
      // 'in_lot_purity'        => $process['wastage_lot_purity'],
      // 'out_lot_purity'       => 100,
      // 'hook_kdm_purity'      => 100,
      // 'in_weight'            => $process['fire_tounch_gross'],
      // 'out_weight'           => 0,
      // 'daily_drawer_wastage' => $process['fire_tounch_fine'],
      // 'refine_loss'          => $process['fire_tounch_gross'] - $process['fire_tounch_fine'],
      // 'tounch_loss_fine'     => -1 * $process['fire_tounch_gross'] * (100 - $process['wastage_lot_purity']) / 100,
      // 'wastage_purity'       => 100,
      // 'wastage_lot_purity'   => 100,
      // 'status'               => 'Complete'
    );
    $process_obj = new fire_tounch_daily_drawer_process_model($start_process);
    $process_obj->before_validate();
    $process_obj->store();
  }

  
  public function validation_rules($klass='') {
    $greater_than = $this->attributes['in_lot_purity']-2;
    $less_than = $this->attributes['in_lot_purity']+2;
    $less_than_fire_tounch_in = $this->attributes['fire_tounch_in'];
    $less_than_fire_tounch_gross = $this->attributes['fire_tounch_gross'];
    return array(array('field' => 'fire_tounch_reports[fire_tounch_out]',
                       'label' => 'Fire Tounch out',
                       'rules' => 'trim|required|greater_than[0]|less_than_equal_to['.$less_than_fire_tounch_in.']',
                       'errors'=>array('required'=>'Fire Tounch out required.')),
                 array('field' => 'fire_tounch_reports[fire_tounch_purity]', 'label' => 'Fire Tounch out',
                       'rules' => 'trim|required|greater_than_equal_to['.$greater_than.']|less_than_equal_to['.$less_than.']',
                       'errors'=>array('greater_than_equal_to'=>'Fire Tounch purity should be between '.$greater_than.' and '.$less_than.'.',
                        'less_than_equal_to'=>'Fire Tounch purity should be between '.$greater_than.' and '.$less_than.'.')),
                 array('field' => 'fire_tounch_reports[fire_tounch_fine]', 'label' => 'Fire Tounch out',
                       'rules' => 'trim|required|greater_than[0]|less_than_equal_to['.$less_than_fire_tounch_gross.']',
                       'errors'=>array('required'=>'Fire Tounch out required.')),
                 );  
  }

  public function create_all_records() {
    $processes = $this->process_model->get('', array('fire_tounch_out != ' => 0));
    foreach ($processes as $process) {
      $this->create_fire_tounch_out_daily_drawer_wastage_record($process);
    }
  }
}