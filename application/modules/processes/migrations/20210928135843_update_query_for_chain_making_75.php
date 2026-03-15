<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_query_for_chain_making_75 extends CI_Model {

  public function up()
  {
    $this->db->query("update processes set product_name='Fancy 75 Chain' where product_name='Fancy Chain' and process_name='Chain Making 75 Process' and department_name='Chain Making'");

    $this->db->query("update processes set process_name='Chain Making Process' where product_name='Fancy 75 Chain' and process_name='Chain Making 75 Process' and department_name='Chain Making'");
    
  }


}

?>