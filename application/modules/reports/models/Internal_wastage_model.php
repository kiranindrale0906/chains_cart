<?php 
class Internal_wastage_model extends BaseModel{
      protected $table_name = 'internal_wastages';
	  public $router_class = 'internal_wastages';
	  protected $id = 'id';
  public function __construct($data = array()){
    parent::__construct($data);
  }
}