<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_alter_table_process_groups_add_parent_id extends CI_Model {

  public function up() {
    $this->db->query("alter table process_groups add parent_id int(11) unsigned NOT NULL DEFAULT 0");
  }
}

?>