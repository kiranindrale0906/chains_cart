<?php 
require_once APPPATH . "modules/processes/models/Process_model.php";
class Stone_vatav_melting_process_model extends Process_model{
	public $router_class = 'stone_vatav_melting_processes';
	public $departments = array('Start');
	protected $next_process_model = '';
	
	public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'Stone Melting';
		$this->attributes['process_name'] = 'Melting';
        $this->attributes['chain_name'] = 'Wastage Melting';
		$this->department_not_deleted = array('Start');
	}

  // public function before_validate() {
  //   if ($this->attributes['department_name'] == 'Melting') {
  //     $this->attributes['out_weight'] = $this->attributes['in_weight'] - $this->attributes['factory_out'];
  //   }
  // }

  // public function after_save($after_save = true) {
  //   if ($this->attributes['factoty_out'] <= 0) return;


  // }
}