<?php

class Preview_email_model extends BaseModel {
  protected $table_name = 'library_email_logs';
  protected $id = 'id';
  public $router_class = 'preview_emails';

  public function __construct($data=array()) {
    parent::__construct($data);
  }
  public function validate($validation_klass='') {
    $rules = $this->validation_rules($validation_klass);
    if(empty($rules)) return false;
    $this->form_validation->set_rules($rules);
    $this->form_validation->set_data($this->formdata);
    return $this->form_validation->run();
  }

  private function validation_rules($klass='') {
    $rules =  array(
               array('field'=>'preview_emails[emailto]',
                      'label'=>'email',
                      'rules'=>'trim|required|valid_email'),
    );
    return $rules;
  }
}