<?php
class Inapp_notification_model extends BaseModel {
  protected $table_name = 'inapp_notification_logs';
  protected $id = 'id';
  public $router_class ='inapp_notifications';
  	
  public function __construct($data=array()) {
    parent::__construct($data);
  }

  public function validation_rules($klass='') {
    return array(
              array('field'=>'inapp_notifications[id]',
                    'label'=>'user id',
                    'rules'=>'numeric|trim'),
              array('field'=>'inapp_notifications[status]',
                    'label'=>'mobile',
                    'rules'=>'trim'),
              array('field'=>'inapp_notifications[user_id]',
                    'label'=>'user_id',
                    'rules'=>'numeric|trim|required'),
              array('field'=>'inapp_notifications[link]',
                    'label'=>'mobile',
                    'rules'=>'trim|required'),
              array('field' => 'inapp_notifications[message]',
                    'label'=> 'message',
                    'rules' => 'trim|required'),
          );
    }
}