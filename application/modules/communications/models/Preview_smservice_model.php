<?php
class Preview_smservice_model extends BaseModel {
  protected $table_name = 'library_sms_logs';
  protected $id = 'id';
  public $router_class = 'preview_smservices';

  public function __construct($data=array()) {
    parent::__construct($data);
  }

  public function validation_rules($klass='') {
    return array(
              array('field'=>'preview_smservices[mobile_no]',
                    'label'=>'mobile',
                    'rules'=>'numeric|min_length[8]|max_length[15]|trim|required')
            );
  }
}