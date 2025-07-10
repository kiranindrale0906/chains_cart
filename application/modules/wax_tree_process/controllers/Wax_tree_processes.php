<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Wax_tree_processes extends BaseController {
  public function __construct(){
    parent::__construct();
  }
  public function _get_form_data() {
  	if($this->router->method=='create' || $this->router->method=='store'){
  	 $id=$this->wax_tree_process_model->find('id',array(),array(),array('order_by'=>'id desc'))['id'];
  	 $this->data['record']['id']=$id+1;
  	}
  }
}
