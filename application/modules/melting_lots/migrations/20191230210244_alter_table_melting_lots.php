<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_melting_lots extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `melting_lots` ADD `category_one` VARCHAR(255) NULL, 
    									ADD `category_two` VARCHAR(255) NULL, 
    									ADD `category_three` VARCHAR(255) NULL, 
    									ADD `category_four` VARCHAR(255) NULL, 
    									ADD `karigar` VARCHAR(255) NULL, 
    									ADD `srno` INT(11) NOT NULL DEFAULT '0'; ");
  }


}

?>