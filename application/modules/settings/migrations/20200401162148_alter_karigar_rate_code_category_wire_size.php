<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_karigar_rate_code_category_wire_size extends CI_Model {

  public function up()
  {
  	$sql = "alter table karigar_rates add code varchar(100), add wire_size varchar(100), add category varchar(100)";
    $this->db->query($sql);
  }


}

?>