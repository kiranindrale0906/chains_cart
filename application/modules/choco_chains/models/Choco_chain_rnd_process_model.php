<?php 

include_once APPPATH . "modules/processes/models/Process_model.php";
class Choco_chain_rnd_process_model extends Process_model{
	protected $next_process_model = '';
	public $router_class = 'rnd_processes';
	public $departments = array('Melting Start','Filing','Lobster','Hand Cutting','Hand Dull','Buffing','Hallmark Out','GPC','Quality','Hallmarking');
	protected $table_name= 'processes';
	
	public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'Choco Chain';
		$this->attributes['process_name'] = 'RND Process';
		$this->attributes['chain_name'] = 'Choco Chain';

		$this->department_not_deleted = array('Melting Start','Hand Cutting');
    $this->compute_tounch_loss_fine_departments = array('GPC','Quality','Hallmarking');
		$this->load->model(array('melting_lots/melting_lot_model'));
	}

	private function create_gpc_department_record(){
			$start_process=array(
      'department_name' => 'GPC',
      'lot_no' => $this->attributes['lot_no'],
      'parent_id' => $this->attributes['id'],
      'melting_lot_id' => $this->attributes['melting_lot_id'],
      'row_id' => $this->attributes['row_id'],
      'in_lot_purity' => $this->attributes['in_lot_purity'],
      'out_lot_purity' => $this->attributes['out_lot_purity'],
      'hook_kdm_purity' => $this->attributes['hook_kdm_purity'],
      'quantity' => $this->attributes['quantity'],
      'in_weight' => $this->attributes['out_weight'],
      'in_purity' => $this->attributes['out_purity'],
      'no_of_bunch' => $this->attributes['no_of_bunch'],
      'design_code' => $this->attributes['design_code'],
    	'machine_size' => $this->attributes['machine_size'],
    	'quantity' => $this->attributes['quantity'],
      'karigar' => $this->attributes['karigar'],
      'length' => $this->attributes['length'],
      'tone' => $this->attributes['tone'],
      'remark' => $this->attributes['remark']);
      $process_obj = new Choco_chain_rnd_process_model($start_process);
			$process_obj->store();
			parent::set_current_process_status_completed();
	}

  protected function get_departments() {  
    $melting_lot = $this->melting_lot_model->find('department_sequence', array('id' => $this->attributes['melting_lot_id']));
    
    if ($melting_lot['department_sequence'] == 'Hand Cutting')
      $this->departments = array('Melting Start','Hand Cutting','Buffing','GPC','Quality','Hallmarking');
    elseif ($melting_lot['department_sequence'] == 'Hand Dull')
      $this->departments = array('Melting Start','Hand Dull','Buffing','GPC','Quality','Hallmarking');
    elseif ($melting_lot['department_sequence'] == 'Hand Cutting,Hand Dull')
      $this->departments = array('Melting Start','Hand Cutting','Hand Dull','Buffing','GPC','Quality','Hallmarking');
    elseif ($melting_lot['department_sequence'] == 'Hand Dull,Hand Cutting')
      $this->departments = array('Melting Start','Hand Dull','Hand Cutting','Buffing','GPC','Quality','Hallmarking');
    elseif ($melting_lot['department_sequence'] == 'Filing')
      $this->departments = array('Melting Start','Filing','Hand Cutting','Hand Dull','Buffing','GPC','Quality','Hallmarking');

    return $this->departments;
  }
}