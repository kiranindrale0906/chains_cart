<?php
class Hcl_lot_wise_report_model extends BaseModel{
	public $router_class = 'hcl_lot_wise_reports';
  public function __construct($data=array()) {
		parent::__construct($data);
		$this->table_name = 'process_out_wastage_details';
	}
}