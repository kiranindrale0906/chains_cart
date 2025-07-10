<?php
class Melting_lot_report_model extends BaseModel{
  protected $table_name = 'melting_lots';
  protected $id = 'id';

  public function __construct($data=array()) {
    parent::__construct($data);
  }
  
}