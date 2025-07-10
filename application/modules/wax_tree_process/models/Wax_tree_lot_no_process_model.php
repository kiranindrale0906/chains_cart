<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Wax_tree_lot_no_process_model extends BaseModel {
  protected $table_name = 'wax_tree_process';
  protected $id = 'id';
  public $router_class  = 'wax_tree_lot_no_processes';

  function __construct($data = array()){
    parent::__construct($data);
  }
  public function before_validate() {
    $this->attributes['status'] = 'Complete';
  }

  public function validation_rules($klass=''){
  	$rules = array(array(
                    'field' => 'wax_tree_lot_no_processes[lot_no]',
                    'label' => 'Lot No',
                    'rules' =>  array('trim', 'required')),
                  );
    return $rules;
  }

  public function save($after_save = true) {
    if($this->router->method=='store') {
      foreach ($this->formdata['wax_tree_processes'] as $index => $value) {
        if(!empty($value['wax_id'])){
          $wax_tree_process=$this->wax_tree_process_model->find('',array('id'=>$value['wax_id']));
          $process_obj=new wax_tree_process_model($wax_tree_process);
          $process_obj->attributes['lot_no']=$this->attributes['lot_no'];
          $process_obj->attributes['status']=$this->attributes['status'];
          $process_obj->save();
        }
      }
    } else
      parent::save($after_save);
  }
}