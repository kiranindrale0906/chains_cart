<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_query_for_fancy_chain_final_prcesses extends CI_Model {

  public function up()
  {
    $this->db->query("update processes set department_name='Buffing I' where product_name='Fancy Chain' and process_name='Final Process' and department_name='Polish'");
  }


}

?>