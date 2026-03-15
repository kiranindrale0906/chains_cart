<?php
class Melting_processes extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('colour_abbreviation_model','settings/chain_purity_model'));
  }
  public function _get_form_data(){
    $this->data['colours'] = $this->colour_abbreviation_model->get('distinct(colour_name) as name, colour_name as id', array(), array());
    $this->data['purities'] = $this->chain_purity_model->get('distinct(lot_purity) as name, lot_purity as id', array(), array());
  }
}