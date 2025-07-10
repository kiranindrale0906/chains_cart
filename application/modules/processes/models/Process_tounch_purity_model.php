<?php 
class Process_tounch_purity_model extends BaseModel{
	protected $table_name= 'processes';
	public $router_class= 'process_tounch_purities';
	public function __construct($data = array()){
		parent::__construct($data);
		$this->load->model(array('processes/Process_model','processes/Process_field_model'));
	}
	public function validation_rules($klass='') {
    $rules= array(array('field' => 'process_tounch_purities[tounch_purity]', 'label' => 'Tounch Purity',
                        'rules' => 'trim|required'),
                );
    return $rules;
  }

    public function before_validate() {
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
}