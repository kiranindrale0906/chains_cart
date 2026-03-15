<?php 

include_once APPPATH . "modules/processes/models/Process_model.php";
class Choco_chain_imp_final_process_model extends Process_model{
	protected $next_process_model = '';
	public $router_class = 'imp_final_processes';
	public $departments = array('Filing','Hook','Pasta','Castic Process','Lobster','Steel Vibrator II',"Buffing",'Hand Cutting', 'Hand Dull','Buffing II','Hallmark Out','GPC Or Rodium','Quality','Hallmarking');
    protected $table_name= 'processes';
	
	public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'Choco Chain';
		$this->attributes['process_name'] = 'Imp Final Process';
		$this->department_not_deleted=array('Start','Filing');
		$this->compute_tounch_loss_fine_departments = array('GPC Or Rodium','Quality','Hallmarking');
		$this->set_wastage_purity_equal_to_in_purity = array('Lobster');
	}

	// protected function get_departments() {
	// 	return parent::unset_excluded_departments();
	// }
	protected function get_departments() {  
    $hook_record = $this->find('id, skip_department', array('department_name' => 'Hook', 'row_id' => $this->attributes['row_id']));

    /*if (!empty($buffing_record) && $buffing_record['skip_department'] == 'No'){
        $this->departments = array('Filing','Hook','Pasta','Castic Process','Lobster','Steel Vibrator II','Buffing','Hand Dull','Hand Cutting','Buffing II','Hallmark Out','GPC Or Rodium','Quality','Hallmarking');
   }elseif (!empty($buffing_record) && $buffing_record['skip_department'] == 'Yes'){
        $this->departments = array('Filing','Hook','Pasta','Castic Process','Lobster','Steel Vibrator II','Buffing','Hand Cutting','Hand Dull','Buffing II','Hallmark Out','GPC Or Rodium','Quality','Hallmarking');
   }else*/if(!empty($hook_record) && $hook_record['skip_department'] == 'No'){
        $this->departments = array('Filing','Hook','Castic Process','Lobster','Steel Vibrator II','Buffing','Hand Cutting','Hand Dull','Buffing II','Hallmark Out','GPC Or Rodium','Quality','Hallmarking');
    }else{
       $this->departments = array('Filing','Hook','Pasta','Castic Process','Lobster','Steel Vibrator II','Buffing','Hand Cutting','Hand Dull','Buffing II','Hallmark Out','GPC Or Rodium','Quality','Hallmarking');
    }
    return $this->departments;
  }

  public function before_validate() {
    if (   $this->attributes['department_name'] == 'Buffing II'
        && $this->attributes['recutting_out'] > 0
        && $this->attributes['out_weight'] > 0
        && !empty($this->attributes['id'])) {
      $next_process = $this->find('id', array('process_name' => $this->attributes['process_name'],
                                              'parent_id' => $this->attributes['id']));
      if (empty($next_process))
        $this->formdata['force_create'] = TRUE;
    }
    parent::before_validate();
  }
}