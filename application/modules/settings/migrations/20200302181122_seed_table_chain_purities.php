<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_seed_table_chain_purities extends CI_Model {

  public function up()
  {
    $purities = get_melting_lots_lot_purity();
    $processes = array_column(get_process(), 'id');
    $this->load->model(array('settings/chain_purity_model'));

    foreach ($processes as $process_name) {
      $product_name = $process_name;
      if(!in_array($process_name, ['Rope Chain', 'Machine Chain', 'ARC'])) {
        $process_name = 'Other Chain';
      }
      $chain_purities = array_column($purities[$process_name], 'id');
      foreach ($chain_purities as $chain_purity) {
        $data = array('product_name' => $product_name, 
                      'lot_purity' => $chain_purity);
        $purity = new chain_purity_model($data);
        $purity->save();
      }
    }
  }
}