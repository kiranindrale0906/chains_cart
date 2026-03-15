<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Karigars extends BaseController {
  public function __construct(){
    parent::__construct();

    $this->load->model(array('settings/chain_purity_model'));
  }
  public function _get_form_data(){
    $this->data['chain_name'] = get_process();
    $this->data['hook_kdm_purity']= $this->chain_purity_model->get('lot_purity as name,lot_purity as id',
                                                                      array(),
                                                                      array(),
                                                                      array('group_by'=>'lot_purity'));
  }
}
