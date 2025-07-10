<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_inch_qty_in_process_factory_order_details extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `process_factory_order_details` 
    	ADD `14_inch_qty` INT(4) NULL DEFAULT NULL , 
    	ADD `16_inch_qty` INT(4) NULL DEFAULT NULL , 
    	ADD `18_inch_qty` INT(4) NULL DEFAULT NULL , 
    	ADD `20_inch_qty` INT(4) NULL DEFAULT NULL , 
    	ADD `22_inch_qty` INT(4) NULL DEFAULT NULL , 
    	ADD `24_inch_qty` INT(4) NULL DEFAULT NULL , 
    	ADD `26_inch_qty` INT(4) NULL DEFAULT NULL , 
    	ADD `28_inch_qty` INT(4) NULL DEFAULT NULL, 
    	ADD `30_inch_qty` INT(4) NULL DEFAULT NULL ;");
  }


}

?>