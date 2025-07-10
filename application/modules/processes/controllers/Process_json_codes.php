<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_json_codes extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('processes/process_model','settings/category_model'));
    $this->redirect_after_save = 'view';
  }

  public function edit($id){
    $this->data['id']=$id;
    $process=$this->process_model->find('', array('id' => $id));
    $this->data['record']['id'] = !empty($this->data['record']['id']) ? $this->data['record']['id'] : $id;
    parent::edit($id);
  }

  public function _get_form_data() {
    $this->data['record']['id'] = !empty($this->data['record']['id']) ? $this->data['record']['id'] : $_POST['process_json_codes']['id'];
    $data=$this->process_model->find('product_name,process_name,department_name,
       karigar,balance as in_weight,
       0 as out_weight,
       in_purity,in_lot_purity,hook_kdm_purity,
       0 as tounch_in, 0 as daily_drawer_wastage, 0 as melting_wastage,
       0 as hcl_wastage, 0 as ghiss, 0 as loss,
       concat(lot_no," ",description) as description,design_code,machine_size,
       melting_lot_category_one,melting_lot_category_two,melting_lot_category_three,
       melting_lot_category_four,melting_lot_chain_name,
       order_id,order_detail_id, lot_no', 
       array('id'=>$this->data['record']['id']));
    $this->data['json_code']= json_encode(array('process_detail'=>$data));
 	
  }
  
  public function _after_save($formdata, $axyction){
    $this->data['redirect_url'] = base_url().'processes/processes/view/'.$formdata['process_json_codes']['id'];
  }
}
