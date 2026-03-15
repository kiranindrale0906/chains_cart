<?php
class Tounch_report_model extends BaseModel{
	protected $table_name = 'processes';
	protected $id = 'id';
  public $router_class="tounch_reports";
  public function __construct($data=array()) {
    parent::__construct($data);
    $this->load->model(array('processes/process_model'));
  }

  public function before_validate() {
    $this->attributes['tounch_ghiss'] = $this->attributes['tounch_in']-$this->attributes['tounch_out'];
    $this->attributes['out_tounch_ghiss'] = $this->process_model->get_out_weight('process_out_wastage_detail_model', 'Tounch Ghiss Out');
    $this->attributes['balance_tounch_ghiss'] = $this->attributes['tounch_ghiss'] - $this->attributes['out_tounch_ghiss'];
    $this->attributes['balance_tounch_out'] = $this->attributes['tounch_out'];

    if (($this->attributes['product_name']=='HCL' && $this->attributes['department_name']=='Melting')
         || ($this->attributes['product_name']=='HCL Ghiss Out' && $this->attributes['department_name']=='Melting')
         || ($this->attributes['product_name']=='Daily Drawer' && $this->attributes['department_name']=='Melting')
         || ($this->attributes['product_name']=='Daily Drawer' && $this->attributes['department_name']=='Daily Drawer Wastage')
         || ($this->attributes['product_name']=='Daily Drawer' && $this->attributes['department_name']=='Daily Drawer Melting II')
         || ($this->attributes['product_name']=='Tounch Out' && $this->attributes['department_name']=='Melting')
         || ($this->attributes['product_name']=='Loss Out' && $this->attributes['department_name']=='Loss Melting')
         || ($this->attributes['product_name']=='Solder Wastage' && $this->attributes['department_name']=='Melting')
         || ($this->attributes['product_name']=='Melting Loss Out' && $this->attributes['department_name']=='Loss Melting')
       ) {
      $this->attributes['out_lot_purity'] = $this->attributes['tounch_purity'];
      $this->attributes['balance_gross'] = 0;
      $this->attributes['balance_fine'] = 0;
    }

    if ($this->attributes['product_name']=='Ghiss Out' && $this->attributes['department_name']=='Ghiss Melting') {
      $this->attributes['wastage_lot_purity'] = $this->attributes['tounch_purity'];
      $this->attributes['balance_gross'] = 0;
      $this->attributes['balance_fine'] = 0; 
    }
  }

  public function validation_rules($klass='') {
    $greater_than=$this->attributes['in_lot_purity']-2;
    $less_than=$this->attributes['in_lot_purity']+2;
    $less_than_tounch_in=$this->attributes['tounch_in'];
    $rules= array(array('field' => 'tounch_reports[tounch_out]', 'label' => 'Tounch out',
                       'rules' => 'trim|required|greater_than[0]|less_than_equal_to['.$less_than_tounch_in.']',
                       'errors'=>array('required'=>'Tounch out required.')),
                 array('field' => 'tounch_reports[tounch_ghiss]', 'label' => 'Tounch Ghiss',
                       'rules' => 'trim|required|greater_than_equal_to[0]|less_than[0.2]',
                       'errors'=>array('required'=>'Tounch out required.')),); 
    if(HOST=='ARF'){
      $rules[]=array('field' => 'tounch_reports[tounch_purity]', 'label' => 'Tounch out',
                     'rules' => 'trim|required|greater_than_equal_to['.$greater_than.']|less_than_equal_to['.$less_than.']',
                     'errors'=>array('greater_than_equal_to'=>'Tounch purity should be between '.$greater_than.' and '.$less_than.'.',
                      'less_than_equal_to'=>'Tounch purity should be between '.$greater_than.' and '.$less_than.'.'));
    }else{
      $rules[]=array('field' => 'tounch_reports[tounch_purity]', 'label' => 'Tounch out',
                     'rules' => 'trim|required');
    }
    return $rules;                  
  }


  public function after_save($action=true){
    $process = $this->process_model->find('', array('id' => $this->attributes['tounch_no']));
    $process_obj = $this->process_model->get_model_object($process);
    $process_obj->before_validate();
    $process_obj->update(false);
  }
}
