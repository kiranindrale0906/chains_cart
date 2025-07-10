<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parent_lots extends BaseController {

  public function __construct() {
    parent::__construct();
    $this->load->model(array('processes/process_model','settings/chain_purity_model'));
  }

  public function _get_form_data() {
    $this->data['process']=get_parent_lot_process();
    $this->data['lot_purity']=$this->chain_purity_model->get('lot_purity as name,lot_purity as id',
                                                                      array(),
                                                                      array(),
                                                                      array('group_by'=>'lot_purity'));
  }
}
  