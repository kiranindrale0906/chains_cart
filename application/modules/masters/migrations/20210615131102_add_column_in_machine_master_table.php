<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_in_machine_master_table extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER table machine_masters add COLUMN machine_count int(11) NULL, 
				    					 add COLUMN oprational_time int(11) NULL,
								    	 add COLUMN out_capacity int(11) NULL, 
								    	 add COLUMN in_capacity int(11) NULL, 
								    	 add COLUMN time_from_melting_lot int(11) NULL,
								    	 add COLUMN maintenance int(11) NULL");
  }


} ?>