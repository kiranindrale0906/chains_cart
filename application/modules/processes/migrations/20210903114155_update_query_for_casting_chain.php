<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_query_for_casting_chain extends CI_Model {

  public function up()
  {
    $this->db->query("update processes set product_name='Casting Chain' where product_name='Choco Chain' and process_name='Casting 75 Final Process'");
	$this->db->query("update processes set process_name='Casting 75 Process' where product_name='Casting Chain' and process_name='Casting 75 Final Process'");
	$this->db->query("update processes set product_name='Casting Chain' where product_name='Choco Chain' and process_name='Casting 92 Final Process'");
	$this->db->query("update processes set process_name='Casting 92 Process' where product_name='Casting Chain' and process_name='Casting 92 Final Process'");
  }


}

?>