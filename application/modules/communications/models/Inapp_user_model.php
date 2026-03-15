<?php
class Inapp_user_model extends BaseModel {
  protected $table_name = 'users';
  protected $id = 'id';
  public $router_class ='inapp_users';
  	
  public function __construct($data=array()) {
    parent::__construct($data);
  }

  public function validation_rules($klass='') {
    return array(
              array('field'=>'inapp_users[id]',
                    'label'=>'user id',
                    'rules'=>'trim'),
              array('field'=>'inapp_users[status]',
                    'label'=>'mobile',
                    'rules'=>'trim'),
             
          );
    }

  public function after_save($action){
  	echo json_encode(array('js_function'=>'change_count_after_update()','status'=>'success',));
 	}
}