<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Accessory_model extends BaseModel {
  protected $table_name = 'accessories';
  protected $id = 'id';
  public $router_class = 'accessories';

  function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules($klass=''){
  	$rules = array(array(
                    'field' => 'accessories[name]',
                    'label' => 'Name',
                    'rules' =>  array('trim', 'required',
                                      array('unique_name', array($this, 'is_name_unique'))),
                    'errors'=>array('unique_name'=>'Accessories name should be unique')
                    )
                  );
    return $rules;
  }

  public function is_name_unique($email_id) {
    $where_conditions = array('name' => $this->attributes['name']);
    if(isset($this->attributes['id']))
      $where_conditions['id!='] = $this->attributes['id'];

    $result = $this->get('id', $where_conditions);
    return (empty($result)) ? true : false;
  }
}