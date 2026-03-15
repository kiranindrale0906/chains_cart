<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_choco_chain_bom_settings_add_new_columns extends CI_Model {

  public function up()
  {
    $sql = "ALTER TABLE `choco_chain_bom_settings`
            CHANGE `strip_to_langari_percentage` `die_1_strip_to_langari_percentage` DECIMAL(10,4) NOT NULL,
            ADD `die_2_strip_to_langari_percentage` DECIMAL(10,4) NOT NULL,
            ADD `pipe_finish` VARCHAR(255) NOT NULL;";
    $this->db->query($sql);
  }
}