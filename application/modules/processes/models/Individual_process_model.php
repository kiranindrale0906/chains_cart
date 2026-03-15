<?php 
include_once APPPATH . "modules/processes/models/Process_model.php";
class Individual_process_model extends Process_model{
	public $router_class = 'individual_processes';
	protected $table_name= 'processes';
	public function __construct($data = array()){
		parent::__construct($data);
    $this->load->model(array('receipt_departments/receipt_department_model'));
	}
  public function validation_rules($klass='') {
    $rules = array(array('field' => 'individual_processes[product_name]',
                         'label' => 'product name',
                         'rules' => array('trim', 'required')),
                   array('field' => 'individual_processes[process_name]',
                         'label' => 'process name',
                         'rules' => array('trim', 'required')),
                   array('field' => 'individual_processes[department_name]',
                         'label' => 'department name',
                         'rules' => array('trim', 'required')));
    return $rules;
  }
  public function before_validate(){
    $this->attributes['row_id']=rand();
    // $this->set_tounch_no();
    // $this->set_fire_tounch_no();
    $this->set_quantity_from_repair_out_quantity();
    // $this->set_process_fields();
    $this->calculate_loss();
    //$this->calculate_micro_coating();
    $this->calculate_balance();
    $this->calculate_balance_wastage();
    // $this->calculate_hook_kdm_purity();
    // $this->calculate_out_purity();
    $this->set_wastage_purities();
    $this->calcuate_balance_gross_and_fine();
    $this->calculate_tounch_loss_fine();
    $this->set_karigar_name();
    // parent::before_validate();
  }
  function before_save($action) {
    
    $melting_lot=array(
      'lot_purity'=>$this->attributes['in_lot_purity'],
      'hook_kdm_purity'=>$this->attributes['hook_kdm_purity'],
      'process_name'=>$this->attributes['product_name'],
      'gross_weight'=>$this->attributes['in_weight'],
      );
    $melting_lot_obj = new melting_lot_model($melting_lot);
    $melting_lot_obj->before_validate();
    $melting_lot_obj->set_lot_no();
    $melting_lot_obj->save(false);
    $this->attributes['lot_no']=$melting_lot_obj->attributes['lot_no'];
    $this->attributes['melting_lot_id']=$melting_lot_obj->attributes['id'];
    if(in_array($this->attributes['product_name'],array('Indo tally Chain','Rope Chain','Machine Chain','Hollow Choco Chain','Imp Italy Chain','Office Outside Hollow Pipe'))){
      $parent_lot=array(
      'lot_purity'=>$this->attributes['in_lot_purity'],
      'hook_kdm_purity'=>$this->attributes['hook_kdm_purity'],
      'process_name'=>$this->attributes['product_name'],
      );
      $parent_lot_obj = new parent_lot_model($parent_lot);
      $parent_lot_obj->before_validate();
      $parent_lot_obj->save(false);
      $this->attributes['parent_lot_name']=$parent_lot_obj->attributes['name'];
      $this->attributes['parent_lot_id']=$parent_lot_obj->attributes['id'];
     }
    parent::before_save($action);
  }
  public function after_save($action){
    $receipt_records=array(
      'in_lot_purity'=>$this->attributes['in_lot_purity'],
      'hook_kdm_purity'=>$this->attributes['in_lot_purity'],
      'in_weight'=>$this->attributes['in_weight'],
      'out_opening_melting_wastage'=>$this->attributes['in_weight'],
      );
    $receipt_record_obj = new receipt_department_model($receipt_records);
    $receipt_record_obj->before_validate();
    $receipt_record_obj->save();
    $this->attributes['parent_id'] =$receipt_record_obj->attributes['id'] ;
    $this->update(false);

    if ($this->attributes['tounch_in'] > 0) {
        $this->attributes['tounch_no'] = $this->attributes['id'];
        $this->update(FALSE);
    }
    if ($this->attributes['fire_tounch_in'] > 0) {
        $this->attributes['fire_tounch_in'] = $this->attributes['id'];
        $this->update(FALSE);
    }
    if($this->attributes['balance']==0){
      $this->set_current_process_status_completed();
    }else{
      $this->attributes['status'] = 'Pending';
      $this->update(false);
    }
  }
}