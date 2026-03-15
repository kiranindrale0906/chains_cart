<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Choco_chain_bom_settings extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->data['validation_klass'] = 'record';
  }

  public function index(){
    if (!empty($_GET['type']) && !empty($_GET['chain'])) {
      $meltings = $this->choco_chain_bom_setting_model->get('id, melting as name', array('type'=>$_GET['type'], 'chain'=>$_GET['chain']));
      echo json_encode(array('meltings'    => $meltings,
                             'status'      => 'success',
                             'open_modal'  => FALSE,
                             'js_function' => 'choco_bom_set_meltings_options(response.meltings)'));die;
    } else if (!empty($_GET['type'])) {
      $chains = $this->choco_chain_bom_setting_model->get('DISTINCT(chain) as id, chain as name', array('type'=>$_GET['type']));
      echo json_encode(array('chains'      => $chains,
                             'status'      => 'success',
                             'open_modal'  => FALSE,
                             'js_function' => 'choco_bom_set_chains_options(response.chains)'));die;
    } else if(!empty($_GET['bom_smaple_export']) && $_GET['bom_smaple_export'] == 1) {
      array_to_csv_download(import_headers(), 'Choco_Chain_BOM_Settings.csv');
    } else
      parent::index();
  }

  public function store() {
    if(!empty($_POST['import']))
      $this->data['validation_klass'] = 'import_file';
    parent::store();
  }
}