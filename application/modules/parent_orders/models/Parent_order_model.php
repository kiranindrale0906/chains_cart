<?php
class Parent_order_model extends BaseModel{
  protected $table_name = 'parent_orders';
  protected $id = 'id';

  public function __construct($data=array()) {
    parent::__construct($data);
  }

  public function validation_rules($klass='record') {
    $rules = array(array('field' => 'parent_orders[person_name]',
                         'label' => 'person name',
                         'rules' => 'trim|required'),
                   array('field' => 'parent_orders[chain_name]',
                         'label' => 'chain',
                         'rules' => 'trim|required'),
                   array('field' => 'parent_orders[melting]',
                         'label' => 'melting',
                         'rules' => 'trim|required'),
                   array('field' => 'parent_orders[name]',
                         'label' => 'name',
                         'rules' => array('trim','required',
                                          array('check_unique_name',
                                                array($this, 'check_unique_name')))),
                   );
    return $rules;
  }

  public function before_validate() {
    $this->attributes['year']   = date('Y');
  }
  public function before_save($action) {
    $this->attributes['srno']   = $this->get_srno($this->attributes['person_name'], $this->attributes['chain_name'], $this->attributes['melting']);
    if($action == 'store') {
      $this->attributes['status'] = 'Open';
    }
  }

  public function check_unique_name($name) {
    if($name) {
      $this->form_validation->set_message('check_unique_name', 'The parent order name already exists.');
      return parent::check_unique(array('name', 'year'));
    }
  }

  public function get_name($person_name, $chain_name, $melting, $id = null) {
    $srno = $this->get_srno($person_name, $chain_name, $melting, $id);
    if($chain_name == 'Imp Italy Chain') {
      $name = strtoupper($person_name.' IMP-'.$melting.sprintf(" %02d", $srno));
    }
    if($chain_name == 'Indo tally Chain') {
      $name = strtoupper($person_name.' INDO-'.$melting.sprintf(" %02d", $srno));
    }

    return $name;
  }

  public function get_srno($person_name, $chain_name, $melting, $id = null) {
    $year = date('Y');
    if(!empty($id)) {
      $parent_order = $this->find('', array('id' => $id));
      if($person_name == $parent_order['person_name'] && $chain_name == $parent_order['chain_name'] && $melting == $parent_order['melting']) {
        return $parent_order['srno'];
      }
    }
    $srno = $this->find('max(srno) + 1 as srno', array('person_name' => $person_name, 'chain_name' => $chain_name, 'melting' => $melting, 'year' => $year))['srno'];
    return (!empty($srno) ? $srno : 1);
  }
}