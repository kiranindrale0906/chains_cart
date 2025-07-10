<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wastage_masters extends BaseController {
	
	public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
 	}
 	public function _get_form_data() {
 		$this->data['chains']=$this->process_model->get('distinct(product_name) as name, product_name id');
 		$this->data['purities']=$this->process_model->get('distinct(in_lot_purity) as name, in_lot_purity id');
 		$this->data['category_names']=$this->process_model->get('distinct(melting_lot_category_one) as name, melting_lot_category_one id');
 		$this->data['tones']=$this->process_model->get('distinct(tone) as name, tone id');
 		$this->data['machine_sizes']=$this->process_model->get('distinct(machine_size) as name, machine_size id');
 		$this->data['designs']=$this->process_model->get('distinct(melting_lot_category_four) as name, melting_lot_category_four id');
 		if($this->router->method == 'edit' || $this->router->method == 'update'){
 		$this->data['wastage_details'] = $this->wastage_master_detail_model->get('',
                                    array('wastage_master_id' => $this->data['record']['id']));
 		}

    }
    public function _get_view_data() {
    	$this->data['wastage_master_details'] = $this->wastage_master_detail_model->get('',
                                    array('wastage_master_id' => $this->data['record']['id']));

    }
}