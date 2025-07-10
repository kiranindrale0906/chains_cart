<?php
class Rod_loss_report_model extends BaseModel{
	protected $table_name = 'processes';
	protected $id = 'id';

  public function __construct($data=array()) {
		parent::__construct($data);
	}
  
  public function validation_rules($klass='') {
    return $rules=array();
  }
}