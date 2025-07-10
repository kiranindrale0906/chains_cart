<?php
class Process_compute_model extends BaseModel{
  protected $table_name= 'processes';
  //public $router_class= 'process_compute';
  public function __construct($data = array()){
      parent::__construct($data);
  }
}