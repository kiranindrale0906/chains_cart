<?php 

class Karigar_list_model extends BaseModel{
	protected $table_name = "processes";

	public function __construct($data = array()){
		parent::__construct($data);
	}

	public function get_daily_drawer_balance(){
		$query = $this->db->query('SELECT sum(daily_drawer_in_weight - hook_in + hook_out - daily_drawer_out_weight) as balance, `karigar`, `in_purity` FROM `processes` WHERE `karigar` = "Hollow Bappy"  AND `processes`.`is_delete` != 1 GROUP BY `in_purity`, `karigar`');
		return $query->result_array();
	}
}