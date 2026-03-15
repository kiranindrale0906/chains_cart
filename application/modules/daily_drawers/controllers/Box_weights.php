<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Box_weights extends BaseController {	
	public function __construct(){
		parent::__construct();
	  $this->load->model(array('settings/same_karigar_model','settings/chain_purity_model', 'processes/process_model'));
  } 
  public function _get_form_data() {
    $this->data['karigars']=$this->same_karigar_model->get('distinct(karigar_name) as name,karigar_name as id');
    $this->data['purities']=$this->chain_purity_model->get('distinct(lot_purity) as name,lot_purity as id');
  }
}

