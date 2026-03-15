<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_parent_id_and_department_in_process_factory_order extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `process_factory_order_details` ADD `parent_id` INT(11) NULL DEFAULT NULL,ADD `department_name` varchar(225) NULL DEFAULT NULL;");
  }


}

?>