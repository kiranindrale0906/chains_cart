<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_hook_kdm_purities extends BaseController {
    public function __construct() {
    parent::__construct();
    $this->load->model(array('processes/process_model','settings/chain_purity_model'));
    $this->redirect_after_save = 'view';
  }

  public function edit($id){
    $this->data['id']=$id;
    $process=$this->process_model->find('', array('id' => $id));
    $this->data['record']['id'] = !empty($this->data['record']['id']) ? $this->data['record']['id'] : $id;
    $this->data['record']['hook_kdm_purity'] = !empty($this->data['record']['hook_kdm_purity']) ? $this->data['record']['hook_kdm_purity'] : $process['hook_kdm_purity'];
    parent::edit($id);
  }

  public function _get_form_data() {
    $this->data['record']['id'] = !empty($this->data['record']['id']) ? $this->data['record']['id'] : $_POST['process_hook_kdm_purities']['id'];
    $processes=$this->process_model->find('',array('id' => $this->data['record']['id']));
    
    $this->data['hook_kdm_purities'] = $this->chain_purity_model->get('lot_purity as name,lot_purity as id',
                                                                      array('where_in' => array('product_name'=>get_office_ouside_product_name())),
                                                                      array(),
                                                                      array('group_by'=>'lot_purity'));
  }
  
  public function _after_save($formdata, $action){
    $this->data['redirect_url'] = base_url().'processes/processes/view/'.$formdata['process_hook_kdm_purities']['id'];
  }
}