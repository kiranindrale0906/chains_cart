<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Karigar_calculation_model extends BaseModel {
  protected $table_name = "karigar_rates";
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
  }
}