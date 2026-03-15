<?php 
  defined('BASEPATH') OR exit('No direct script access allowed');
class Preview_smservices extends BaseController {

  public function __construct() {
    parent::__construct();
    $this->load->model(array('template_model',
                             'libraries/library_sms',
                             'preview_smservice_model'));
  }

  public function create($template_id='') {
    $this->data['record']['template_id'] = $template_id;
    parent::create();
  }

  public function _get_form_data() {      
   $template = $this->template_model->get('smstext,sampledata', array('id' => $this->data['record']['template_id']),'',array('row_array' => true));
    $sample_data = json_decode($template['sampledata'],true);
    $this->data['template'] = $this->template_model->render_sms($template,$sample_data['data'],true);
    if (empty($template))
     redirect(ADMIN_PATH.'communications/templates'); 
  }

  public function store() {
    $check_validation = $this->preview_smservice_model->validate();
    if($check_validation ==true){
      $this->data = $_POST['preview_smservices'];
      $template = $this->template_model->get('id, smstext,smsto',array('id' => $this->data['template_id']));
      if(empty($template)) return;
      $result= $this->library_sms->send($template[0],$this->getsampledata($this->data, $template[0]), true);
      if ($result['status']=="success") {
          $this->session->set_flashdata('success', $result['msg']);
      }else{
          $this->session->set_flashdata('error', $result['msg']);
      }
      redirect(ADMIN_PATH.'communications/preview_smservices/create/'.$this->data['template_id']);
    }else{
      $this->data['record'] = @$_POST['preview_smservices'];
      $this->load->render('layouts/application/forms/index', $this->data);
    }
  }

  private function getsampledata($data, $template) {
    $sample_data = json_decode($template['sampledata'], true);
    $response =  array('mobile_no' => $data['mobile_no'],
                       'id'  =>$data['template_id'],
                       'data'=>$sample_data['data']);

    return $response;
  }
}
