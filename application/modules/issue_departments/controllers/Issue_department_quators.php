<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Issue_department_quators extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('processes/process_model'));
    $this->redirect_after_save = 'view';
  }
  
  public function _after_save($formdata, $action){
    $this->data['redirect_url']= $_SERVER['HTTP_REFERER'];
    return $formdata;
  }
  public function _get_form_data(){
    $this->data['quators']= $this->get_quarter_from_accounts();
  }
  private function get_quarter_from_accounts() {
    $data['get_quators']=1;
    $url=API_BASE_PATH."masters/quators/index";
    $records=json_decode(curl_post_request($url,$data));
    $quators=array();
    if(!empty($records->data)){
      foreach ($records->data as $index => $record) {
        $quators[$index]['name']=$record->name;
        $quators[$index]['id']=$record->id;
      }
    }
    return $quators;
  }
}