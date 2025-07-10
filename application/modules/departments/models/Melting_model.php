<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Melting_model extends BaseModel {
  protected $table_name = "processes";
  public $router_class = "melting";
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
    $this->load->model(array('melting_lots/melting_lot_model',
                             'melting_lots/parent_lot_model', 'settings/same_karigar_model',
                             'settings/loss_percentage_model', 'wastages/wastage_model',
                             'settings/rod_model','masters/process_detail_field_model'));
  }
  public function save($after_save = false){
    $process=$this->attributes;
    $model_name = get_model_name($process['product_name'], $process['process_name']);
          $this->load->model($model_name['module_name'].'/'.$model_name['model_name']);
          $process_obj = new $model_name['model_name']($process);
          $process_obj->before_validate();
          $process_obj->save(true);
  }
  public function validation_rules($klass='') {
    $rules = array(array('field' => 'melting[id]', 'label' => 'id',
                         'rules' => 'required'));
    return $rules;
  }
}