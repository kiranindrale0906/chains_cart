<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_of_category_in_issue_purity extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `issue_purities` CHANGE `category` `category_one` VARCHAR(225) CHARACTER 					SET latin1 COLLATE latin1_swedish_ci NOT NULL;");
	$this->db->query("ALTER TABLE `issue_purities` ADD `category_two` VARCHAR(225) NOT NULL");
	$this->db->query("ALTER TABLE `issue_purities`  ADD `category_three` VARCHAR(225) NOT NULL");
	$this->db->query("ALTER TABLE `issue_purities` ADD `category_four` VARCHAR(225) NOT NULL;
						");
  }


}

?>