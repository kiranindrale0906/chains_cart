<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Melting_lot_details extends BaseController {
  
  public function __construct(){
    parent::__construct();
    $this->load->model(array('melting_lots/melting_lot_model', 'processes/process_model'));
  }

  public function create($id='') {
    $this->data['melting_lot_id'] = $id; 
    parent::create($this->data);
	}

  public function store() {
    $_POST['add_to_existing_melting_lot'] = TRUE;
    $this->data['melting_lot_id'] = $_POST['melting_lot_id']; 
    parent::store();
  }

  public function _get_form_data() {
    $this->data['record']['process_name'] =  isset($_GET['process_name']) ? $_GET['process_name'] : ''; 
    $this->data['record']['out_lot_purity'] =  isset($_GET['out_lot_purity']) ? $_GET['out_lot_purity'] : $_POST['out_lot_purity'];
    $this->data['out_lot_purity'] =  isset($_GET['out_lot_purity']) ? $_GET['out_lot_purity'] :''; 

    $select = 'id as process_id, product_name, process_name, department_name, melting_lot_category_one, design_code, description, balance_melting_wastage as in_weight,out_lot_purity as in_purity,created_by,karigar as karigar_name,machine_size';
      
    $where = array('balance_melting_wastage >' => 0,
                   'wastage_lot_purity' => $this->data['record']['out_lot_purity'],
                   'product_name IN ("Chain Receipt",  "KA Chain", "Ball Chain", "Internal Receipt", "Internal")' => NULL,
                   'department_name IN ("Start", "Fancy Out", "Final")' => NULL);
    

    $this->data['melting_lot_details'] = $this->process_model->get($select, $where);
  }

  public function delete($id) {
    $melting_lot_detail=$this->melting_lot_detail_model->find('process_id,id,in_purity',array('id'=>$id));
      $process_data = $this->process_model->find('', array('id' => $melting_lot_detail['process_id']));
      $process_data['balance_melting_wastage']=$process_data['out_melting_wastage'];
      $process_data['out_melting_wastage']=0;
      $process_obj = $this->process_model->get_model_object($process_data);
      $process_obj->attributes['wastage_lot_purity']=$melting_lot_detail['in_purity'];
      $process_obj->attributes['out_lot_purity']=$melting_lot_detail['in_purity'];
      $process_obj->update(false);
      parent::delete($id);
  }
  public function _after_save($formdata, $action){
    $this->data['redirect_url']= ADMIN_PATH.'melting_lots/melting_lots';
    return $formdata;
  }
  public function _after_delete($formdata){
    $this->data['redirect_url']= ADMIN_PATH.'melting_lots/melting_lots';
    return $formdata;
  }
}
  