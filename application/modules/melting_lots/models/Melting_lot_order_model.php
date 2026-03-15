<?php
class Melting_lot_order_model extends BaseModel{
  protected $table_name = 'melting_lot_orders';
  protected $id = 'id';

  public function __construct($data=array()) {
    parent::__construct($data);
  }
}