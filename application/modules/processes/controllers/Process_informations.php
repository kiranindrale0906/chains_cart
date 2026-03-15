<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Process_informations extends BaseController {
	public function __construct(){
    parent::__construct();
  }
  public function _get_form_data() {
    $this->data['record']['process_id']=!empty($_GET['process_id'])?$_GET['process_id']:'';
  }  
	public function _after_save($formdata, $action){
		 $this->data['redirect_url'] = base_url().'processes/processes/view/'.$formdata['process_informations']['process_id'];
		 return $formdata;
	}
	public function _after_delete($id){
    $process_id = !empty($_GET['process_id']) ? $_GET['process_id'] : '';
    redirect(base_url().'processes/processes/view/'.$process_id);
  }

}

?>