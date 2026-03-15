<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Karigar_model extends BaseModel {
  protected $table_name = 'karigar_masters';
  public $router_class = 'karigars';
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules() {
    $rules = array(
              array('field' => 'karigars[karigar_name]', 'label' => 'karigar name',
                    'rules' => array('trim', 'required')),
              array('field' => 'karigars[hook_kdm_purity]', 'label' => 'hook kdm purity',
                    'rules' => array('trim', 'required')),
             );
    return $rules;
  }
}