<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Process_master_model extends BaseModel {
  protected $table_name = "processes";
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
  }
}

?>