<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_purity extends CI_Model {

  public function up()
  {
  	$sql = "alter table karigar_rates add purity float(10,2)";
    $this->db->query($sql);
  }


}

?>