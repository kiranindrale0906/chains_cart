<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_drop_field_from_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` DROP `accept_packing_list`;");
    $this->db->query("ALTER TABLE `processes` DROP `rejected`;");
    $this->db->query("ALTER TABLE `processes` DROP `packing_slip_balance`;");
    $this->db->query("ALTER TABLE `processes` ADD `accept_packing_list` DECIMAL(16,4)  DEFAULT '0';");
    $this->db->query("ALTER TABLE `processes` ADD `rejected` DECIMAL(16,4)  DEFAULT '0';");
    $this->db->query("ALTER TABLE `processes` ADD `packing_slip_balance` DECIMAL(16,4)  DEFAULT '0';");
  }


}

?>