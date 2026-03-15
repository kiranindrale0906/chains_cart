<?php
class Parent_lot_model extends BaseModel{
  protected $table_name = 'parent_lots';
  protected $id = 'id';
  
  public function __construct($data=array()) {
    parent::__construct($data);
  }

  public function before_validate() {
    if($this->router->method == 'store'){
      $this->set_name();
    }
  }

  public function validation_rules($klass='record') {
    $rules = array(array('field' => 'parent_lots[process_name]', 'label' => 'Process',
                    'rules' => 'trim|required|max_length[64]',
                    'errors'=>array('required'=>'Process is required')));
    return $rules;
  }


  private function set_name() {
    $srno = $this->find('max(srno) + 1 as srno', array('process_name' => $this->attributes['process_name']))['srno'];
    $srno = (!empty($srno) ? $srno : 1);
    $lot_purity = round($this->attributes['lot_purity']);
    $this->attributes['srno'] = $srno;
    if($this->attributes['process_name']=='Rope Chain'){
      $this->attributes['name'] = strtoupper($lot_purity.'RC-'.sprintf("%02d", $srno));
    } else {
      pd($this->attributes['process_name'].' to be added in list');
    }
  }

}