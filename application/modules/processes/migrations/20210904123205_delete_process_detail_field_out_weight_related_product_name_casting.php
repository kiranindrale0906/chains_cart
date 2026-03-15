<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_delete_process_detail_field_out_weight_related_product_name_casting extends CI_Model {

  public function up()
  {
    $this->db->query("delete from  process_detail_fields where product_name ='Arc 92 Chain' and process_name='AG 92' and department_name='Melting' and field_name='out_weight';");
    
    $this->db->query("delete from  process_detail_fields where product_name ='Arc 75 Chain' and process_name='AG 75' and department_name='Melting' and field_name='out_weight';");
  }


}

?>