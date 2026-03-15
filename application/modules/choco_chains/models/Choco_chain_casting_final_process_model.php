<?php 

include_once APPPATH . "modules/processes/models/Process_model.php";
class Choco_chain_casting_final_process_model extends Process_model{
	public $router_class = 'casting_final_processes';
	public $departments = array('Start','Filing','Pasta','Castic Process','Lobster Out',
															'Shampoo And Steel', 'Buffing','Hand Cutting','Hand Dull','Buffing II','GPC Or Rodium','QC Department');
  protected $table_name= 'processes';
	
	public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'Choco Chain';
		$this->attributes['process_name'] = 'Casting Final Process';
		$this->load->model(array('melting_lots/melting_lot_model','refresh/refresh_hold_model'));
		$this->department_not_deleted=array('Start','Filing');
		$this->set_wastage_purity_equal_to_in_purity = array('Lobster Out');
	}

	function before_validate() {
	  if (isset($this->attributes['skip_department'])) {
			if ($this->attributes['department_name'] == 'Buffing') {
				$melting_lot = $this->melting_lot_model->find('', array('id' => $this->attributes['melting_lot_id']));
				$melting_lot_obj = new melting_lot_model($melting_lot);
				if ($this->attributes['skip_department']=='Yes') 
					$melting_lot_obj->attributes['department_sequence'] = "Start,Filing,Shampoo Walnut,Castic Process,Lobster Out,Shampoo And Steel,Buffing,Hand Dull,Hand Cutting,Buffing II,GPC Or Rodium";
				else
					$melting_lot_obj->attributes['department_sequence'] = '';
					$melting_lot_obj->save(false);		 
			}
		}
    parent::before_validate();
	}

  protected function get_departments() {
		parent::change_department_sequence();
		parent::unset_excluded_departments();
		return $this->departments;
	}
}