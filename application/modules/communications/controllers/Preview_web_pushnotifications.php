<?php 
  defined('BASEPATH') OR exit('No direct script access allowed');
class Preview_web_pushnotifications extends BaseController {

  public function __construct() {
    parent::__construct();
    $this->load->model(array('template_model',
                             'preview_web_pushnotification_model',
                             'users/user_model',
                             'libraries/library_web_push_notification'));
  }

  public function create($template_id=''){
    $this->data['record']['template_id'] = $template_id;
    parent::create(); 
  }
 
  public function _get_form_data() {
    $template = $this->template_model->get('webpushtext, sampledata', array('id' => $this->data['record']['template_id']),'',array('row_array' => true));
    $sample_data = json_decode($template['sampledata'],true);
    $this->data['users'] = $this->user_model->get('CONCAT(users.name, " (", users.email_id, ")") as name, users.id as id',
                                                  array(),
                                                  array(array('user_device_tokens udt', 'udt.user_id = users.id', 'INNER')),
                                                  array('order_by'=>'users.name ASC','group_by'=>'users.id'));
    $this->data['template'] = $this->template_model->render_web_pushnotification($template,$sample_data['data']);
    if (empty($template))
      redirect(ADMIN_PATH.'communications/templates');
  }

  public function store() {
    $this->data = @$_POST['preview_web_pushnotifications'];
    $select ='webpushto, webpushtext, sampledata, name, webpushurl, webpushimage';
    $template = $this->template_model->get($select,array('id' => $this->data['template_id']));
    if (empty($template)) return;
    $result= $this->library_web_push_notification->send($template[0],$this->getsampledata($this->data, $template[0]), true);
    if ($result['status']=="success") {
        $this->session->set_flashdata('success', $result['msg']);
    }else{
        $this->session->set_flashdata('error', $result['msg']);
    }
    redirect(ADMIN_PATH.'communications/preview_web_pushnotifications/create/'.$this->data['template_id']);
  }

  private function getsampledata($data, $template) {
    $sample_data = json_decode($template['sampledata'], true);
    $response =  array('user_id'     =>  $data['user_id'],
                       'url'         => $template['webpushurl'],
                       'image'       => $template['webpushimage'],
                       'template'    =>array('id'=>$data['template_id'],'data'=>$sample_data['data'])
                      );

    return $response;
  }

}
