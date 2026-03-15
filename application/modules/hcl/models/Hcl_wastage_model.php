<?php
class Hcl_wastage_model extends BaseModel{
	protected $table_name = 'processes';
	protected $id = 'id';

  public function __construct($data=array()) {
		parent::__construct($data);
	}
  
  public function get($select = '*', $conditions = array(), $joins = array(), $operations=array()) {
    $conditions['hcl_wastage >'] = 0;
    return parent::get($select, $conditions, $joins, $operations);
  }
}