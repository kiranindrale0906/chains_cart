<?php
include_once APPPATH . "modules/processes/models/Process_model.php";
class Qc_department_model extends Process_model {
	protected $next_process_model = '';
	
	public $router_class = 'qc_departments';
	public $departments = array('QC Department');
    
	
	public function __construct($data = array()) {
		parent::__construct($data);
		$this->department_not_deleted=array('QC Department');
	    $this->load->model(array('refresh/refresh_hold_model'));
	}

	public function before_validate() {
		$this->attributes['process_sequence'] = 0;
		$this->attributes['product_name'] = $this->attributes['product_name'];
		$this->attributes['process_name'] = $this->attributes['process_name'];
		$this->attributes['row_id'] = rand();
		if ($this->attributes['product_name']=='KA Chain')
			$this->attributes['issue_chain_name'] = $this->attributes['melting_lot_category_one'].' '.$this->attributes['melting_lot_category_three'].' '.$this->attributes['melting_lot_category_four'];
		elseif ($this->attributes['product_name']=='Sisma Chain')
			$this->attributes['issue_chain_name'] = $this->attributes['melting_lot_category_one'];
		elseif ($this->attributes['product_name']=='Finished Goods Receipt')
        	$this->attributes['issue_chain_name'] = $this->attributes['melting_lot_category_one'];
      	else 
      		$this->attributes['issue_chain_name'] = $this->attributes['product_name'];
      	
		parent::before_validate();
	}
}