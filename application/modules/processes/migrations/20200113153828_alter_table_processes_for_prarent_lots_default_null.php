<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_processes_for_prarent_lots_default_null extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `processes` CHANGE  `parent_lot_name`  `parent_lot_name` VARCHAR( 255 ) NULL DEFAULT NULL");
  }


}

?>