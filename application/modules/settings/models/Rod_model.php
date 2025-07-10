<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Rod_model extends BaseModel {
  protected $table_name = 'rods';
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
  }

  public function after_save($action) {
      $this->attributes['name'] = $this->attributes['purity'].'R'.$this->attributes['id'];
      $this->update(FALSE);
  }

  public function validation_rules() {
    $rules = array(
                  array('field' => 'rods[purity]', 'label' => 'purity',
                          'rules' => array('trim', 'required')),
                  array('field' => 'rods[weight]', 'label' => 'Weight',
                          'rules' => array('trim', 'required','numeric')),
                  );
    return $rules;
  }
}
