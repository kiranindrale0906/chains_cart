<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_record_of_fancy_chain_92_in_daimond_cutting extends CI_Model {

  public function up()
  {
     $this->db->query("update processes set department_name='DC Department' where product_name='Fancy Chain' and process_name='Diamond Cutting Process' and department_name='Diamond Cutting'");
     $this->db->query("update processes set department_name='CNC Department' where product_name='Fancy Chain' and process_name='CNC Process' and department_name='CNC'");
    
    
  }


}

?>