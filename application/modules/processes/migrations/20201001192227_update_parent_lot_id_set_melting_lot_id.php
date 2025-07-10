<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_parent_lot_id_set_melting_lot_id extends CI_Model {

  public function up()
  {
    $this->db->query("update processes set parent_lot_id=melting_lot_id where product_name='Imp Italy Chain'");
    $this->db->query("update processes set parent_lot_name=lot_no where product_name='Imp Italy Chain'");
    $this->db->query("update processes set parent_lot_id=melting_lot_id where product_name='Office Outside' and process_name='Hollow Pipe'");
    $this->db->query("update processes set parent_lot_name=lot_no where product_name='Office Outside' and process_name='Hollow Pipe'");
  }


}

?>