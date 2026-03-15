<?php
class Inapp_notifications extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('users/user_model','inapp_notification_model'));
  }
 
  public function view($id=''){
		$this->data['record'] = $this->inapp_notification_model->get('',
														array('id' => $id), '',array('row_array' => true));

		$this->data['users'] = $this->user_model->find('id,last_read_notification',
														array('id' => $this->data['record']['user_id']));

		$this->data['inapp_data'] = $this->inapp_notification_model->get('',
														array('user_id' => $this->data['record']['user_id'],
																	'status!=' =>1)); 

		$this->data['count'] = $this->inapp_notification_model->get('',
														array('user_id' => $this->data['record']['user_id'],
																	'created_at >' => $this->data['users']['last_read_notification']));
		$this->load->render('communications/inapp_notifications/view',$this->data);
  }

	public function update($id=''){
		$_POST['inapp_notifications']['status'] = '1';
		$_POST['inapp_notifications']['id'] = $id;
		$inapp_notification_obj = new Inapp_notification_model($_POST);
		$inapp_notification_obj->update($after_save=false);
		redirect(base_url().'communications/inapp_notifications/view/'.$id);
	}	
}