<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_new_column_in_issue_purity_and_design_name extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `category_four` ADD `design_chitti_name` VARCHAR(225) NOT NULL");
	$this->db->query("ALTER TABLE `issue_purities` ADD `chitti_purity` DECIMAL(16,8) NOT NULL");
  }


}

?>