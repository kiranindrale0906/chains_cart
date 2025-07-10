<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_seed_table_karigars_for_chain_purities extends CI_Model {

  public function up()
  {
    $products = array('Office Outside Hook', 'Office Outside KDM', 'Office Outside Lobster', 'Office Outside Ball', 'Office Outside Cutting Wire', 'Office Outside Solid Pipe', 'Office Outside Solid Wire', 'Office Outside Hard Wire', 'Office Outside Hollow Pipe', 'Office Outside Cutting Pipe', 'Office Outside Shook', 'Office Outside ARF KDM', 'Office Outside Cap');

    $this->load->model(array('settings/same_karigar_model'));
    foreach ($products as $product_name) {
      $data = array('product_name'    => $product_name,
                    'process_name'    => $product_name,
                    'department_name' => 'start',
                    'karigar_name'    => '-');
      $karigar = new same_karigar_model($data);
      $karigar->save();
    }
  }
}
