<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_query_of__casting_rnd extends CI_Model {

  public function up()
  {
    $this->db->query("update processes set department_name='Filing RND' where product_name='Casting RND' and process_name='Filing Process' and department_name='Filing'");
	$this->db->query("update processes set department_name='Grinding RND' where product_name='Casting RND' and process_name='Filing Process' and department_name='Grinding'");


  }


}

?>