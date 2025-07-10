<?php 
class Gpc_powder_issue_model extends BaseModel{
	protected $table_name= 'issue_departments';
	public $router_class= 'gpc_powder_issues';
	public function __construct($data = array()){
		parent::__construct($data);
    $this->load->model(array('processes/Process_model','api/Receipt_not_sent_argold_account_model','issue_departments/issue_department_model'));
	}

	public function validation_rules($klass='') {
	    $rules= array(array('field' => 'gpc_powder_issues[in_weight]', 'label' => 'Weight',
										      'rules' => 'trim|required'),
	    	 		  array('field' => 'gpc_powder_issues[in_purity]', 'label' => 'Melting',
										      'rules' => 'trim|required')
	  								);
	    return $rules;
	}
	public function after_save($action){
		$this->attributes['out_purity']=$this->attributes['in_purity'];
		$this->attributes['department_name']='';
    	$this->issue_department_model->send_request_to_argold_accounts($this->attributes);  
	}         


}
