<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_query_related_recutting extends CI_Model {

  public function up()
  {
    $this->db->query("update processes set department_name='CNC Department' where product_name='KA Chain' and process_name='CNC Recutting Process' and department_name='CNC Recutting'");
    $this->db->query("update processes set department_name='DC Department' where product_name='KA Chain' and process_name='DC Recutting Process' and department_name='DC Recutting'");
    $this->db->query("update processes set department_name='Round and Ball Chain' where product_name='KA Chain' and process_name='Round and Ball Chain Recutting Process' and department_name='Round and Ball Chain Recutting'");
    $this->db->query("update processes set department_name='Round and Ball Chain' where product_name='Ball Chain' and process_name='Copper Cutting Two Tone Process' and department_name='Round and Ball Chain Cutting'");
    $this->db->query("update processes set department_name='Round and Ball Chain' where product_name='Ball Chain' and process_name='Plain Cutting Process' and department_name='Round and Ball Chain Cutting'");





  }


}

?>