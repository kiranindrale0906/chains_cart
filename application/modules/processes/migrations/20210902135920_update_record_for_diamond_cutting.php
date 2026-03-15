<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_record_for_diamond_cutting extends CI_Model {

  public function up()
  {
    $this->db->query("update processes set department_name='DC Department' where product_name='Fancy Chain' and process_name='Diamond Cutting Process' and department_name='Diamond Cutting'");
    
  }


}

?>