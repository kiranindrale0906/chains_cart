<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add__column_order_id_in_processes extends CI_Model {

  public function up()
  {
  	if(HOST == "ARC"){
	    // $this->db->query("ALTER TABLE `processes` ADD `order_id` INT(11) NOT NULL");
	    // $this->db->query("ALTER TABLE `processes` ADD `order_detail_id` INT(11) NOT NULL");
  	}else{
  		//$this->db->query();
  	}
  }


}

?>