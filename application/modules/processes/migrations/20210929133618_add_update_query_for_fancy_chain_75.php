<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_update_query_for_fancy_chain_75 extends CI_Model {

  public function up()
  {
    $this->db->query("update processes set department_name='DC Department' where product_name='Fancy 75 Chain' and process_name='Diamond Cutting Process' and department_name='Diamond Cutting'");
    $this->db->query("update processes set department_name='CNC Department' where product_name='Fancy 75 Chain' and process_name='CNC Process' and department_name='CNC'");
  }


}

?>