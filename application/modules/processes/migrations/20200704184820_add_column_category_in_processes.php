<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_category_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `melting_lot_category_one` VARCHAR(255) NULL DEFAULT NULL,
					    ADD `melting_lot_category_two` VARCHAR(255) NULL DEFAULT NULL,
					    ADD `melting_lot_category_three` VARCHAR(255) NULL DEFAULT NULL,
					    ADD `melting_lot_category_four` VARCHAR(255) NULL DEFAULT NULL,
					    ADD `melting_lot_chain_name` VARCHAR(255) NULL DEFAULT NULL;
");
  }


}

?>