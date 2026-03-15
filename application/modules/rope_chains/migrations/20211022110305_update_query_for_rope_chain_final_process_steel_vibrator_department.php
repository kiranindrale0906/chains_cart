<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_query_for_rope_chain_final_process_steel_vibrator_department extends CI_Model {

  public function up()
  {
    $this->db->query("update processes set department_name='Cleaning' where product_name='Rope Chain' and process_name='Final Process' and department_name='Steel Vibrator'");
     
  }


}

?>