<?php
class Inapp_users extends BaseController {
  protected $load_helper = false;
  public function __construct() {
    parent::__construct();
  }
 
  public function update($user_id=''){
		$_POST['inapp_users']['id'] = $user_id;
		$_POST['inapp_users']['last_read_notification'] = date('Y-m-d H:i:s');
		$user_obj = new Inapp_user_model($_POST);
		$user_obj->update($after_save=true);
 }

}