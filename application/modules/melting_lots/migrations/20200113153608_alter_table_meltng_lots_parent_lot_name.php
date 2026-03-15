<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_meltng_lots_parent_lot_name extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `melting_lots` CHANGE  `parent_lot_name`  `parent_lot_name` VARCHAR( 255 ) NULL DEFAULT NULL ;
");
  }


}

?>