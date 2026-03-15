<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_view_daily_drawer extends CI_Model {

  public function up()
  {/*
    $this->db->query("ALTER VIEW `view_daily_drawer_summary`  AS SELECT `processes`.`id` AS `process_id`, `processes`.`lot_no` AS `lot_no`, `processes`.`product_name` AS `product_name`, `processes`.`department_name` AS `department_name`, `processes`.`daily_drawer_in_weight` AS `in_weight`, 0 AS `out_weight`, `processes`.`issue_daily_drawer_wastage` AS `issue_daily_drawer_wastage`, `processes`.`hook_kdm_purity` AS `hook_kdm_purity`, `processes`.`process_name` AS `daily_drawer_type`, `processes`.`type` AS `type`, `processes`.`karigar` AS `karigar`, `processes`.`chain_name` AS `chain_name`, `processes`.`created_at` AS `created_at`, `processes`.`is_delete` AS `is_delete` FROM `processes` ;
");*/
  }


}

?>