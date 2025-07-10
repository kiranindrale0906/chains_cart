<?php
class Configurations extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('configuration_model'));
    $this->data['layout'] = 'application';
  }

  public function create() {
    $configurations = $this->configuration_model->get('id',array(), '',array('row_array' => true)); 
    redirect(base_url().'communications/configurations/edit/'.$configurations['id']);
  }

  public function _after_save(){
    redirect(base_url().'communications/templates');
  }
}
