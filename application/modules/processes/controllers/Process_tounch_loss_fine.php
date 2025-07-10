<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_tounch_loss_fine extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('refresh/refresh_model', 'processes/process_field_model'));
    $this->redirect_after_save = 'view';
  }

  public function update($id) {
    if(isset($_GET['from']) && $_GET['from']=='view') {
      $process = $this->model->find('id', array('id' => $id));
      $process['issue_tounch_loss_fine']=0;
      $process['balance_tounch_loss_fine']=$process['tounch_loss_fine'];
      $process_obj = new $this->model($process);
      // $process_archive_obj->before_validate();
      $process_obj->save(false);
      redirect($_SERVER['HTTP_REFERER']);
    } else {
      parent::update($id);
    }
  }

  public function _after_save($formdata, $action){
    $this->data['redirect_url'] = base_url().'processes/processes/view/'.$formdata['process_tounch_loss_fine']['id'];
  }
}