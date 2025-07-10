<?php
class Preview_emails extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->xss_clean_form_data = false;
    $this->load->model(array('preview_email_model','template_model','libraries/library_email','libraries/template_rendering'));
  }
  
  public function create($template_id='') {
    $this->data['record']['template_id'] = $template_id;
    parent::create();
  }

  public function _get_form_data(){
    $select_columns = 'emailbody, sampledata, cc, bcc, fromemail, emailto, emailsubject,fromname';
    $template = $this->template_model->get($select_columns,array("id" => $this->data['record']['template_id']), '',array('row_array' => true));
    $sample_data = json_decode($template['sampledata'],true);
    $this->data['template'] = $this->template_model->render_email($template,$sample_data['data'],true);
    if (empty($template))
      redirect(ADMIN_PATH.'communications/templates'); 
  }

  public function store() {
    $check_validation=  $this->preview_email_model->validate();
    if($check_validation == true){
      $this->data = $_POST['preview_emails'];  
      $template = $this->template_model->get('',array('id'=> $this->data['template_id']));
      if (empty($template)) return;
      $result= $this->library_email->send($template[0], $this->getsampledata($this->data, $template[0]), 'api', true);
      if ($result['status']=="success") {
          $this->session->set_flashdata('success', $result['msg']);
      }else{
          $this->session->set_flashdata('error', $result['msg']);
      }
      redirect(ADMIN_PATH.'communications/preview_emails/create/'.$data['template_id']);
    }else{ 
      $this->data['record'] = @$_POST['preview_emails'];
      $this->load->render('layouts/application/forms/index', $this->data);
    }
  }

  private function getsampledata($data, $template) {
    $sample_data = json_decode($template['sampledata'], true);
    $response =  array('subject'=>  $template['emailsubject'],
                       'emailto'     =>  $data['emailto'],
                       'id'=>$data['template_id'],
                       'data'=>@$sample_data['data']);
    return $response;
  }  
}