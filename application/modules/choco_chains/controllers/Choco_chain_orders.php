<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Choco_chain_orders extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('choco_chains/choco_chain_bom_setting_model', 'melting_lots/melting_lot_model'));
  }

  public function _before_save($formdata, $action){
    $formdata['choco_chain_orders']['choco_chain_bom_setting_id'] = $formdata['choco_chain_bom_settings']['melting'];
    if(empty($formdata['choco_chain_orders']['status']))
      $formdata['choco_chain_orders']['status'] = 'OPEN';

    $total_chain_qty = $this->model->calculate_total_chains($formdata['choco_chain_orders']);

    $qty_array = [8, 16, 18, 20, 22, 24, 26, 'custom_1', 'custom_2'];

    foreach ($qty_array as $qty) {
      if($total_chain_qty == 0) {
        $formdata['choco_chain_orders'][$qty.'_proportion'] = 0;
      } else {
        $formdata['choco_chain_orders'][$qty.'_proportion'] = $formdata['choco_chain_orders'][$qty.'_order_qty'] / $total_chain_qty;
      }
    }
  }

  public function _get_form_data() {
    $this->data['types']     = $this->choco_chain_bom_setting_model->get('DISTINCT(type) as id, type as name');
    $this->data['chains']    = array();
    $this->data['meltings']  = array();

    $record =& $this->data['record'];
    $settings = array();
    if (!empty($record['choco_chain_bom_setting_id'])) {
      $settings = $this->choco_chain_bom_setting_model->find('type, chain, melting', array('id' => $record['choco_chain_bom_setting_id']));
      $settings['melting'] = $record['choco_chain_bom_setting_id'];
    }
    
    if(!empty($_POST['choco_chain_bom_settings'])) {
      $settings['type']    = $_POST['choco_chain_bom_settings']['type'];
      $settings['chain']   = $_POST['choco_chain_bom_settings']['chain'];
      $settings['melting'] = $_POST['choco_chain_bom_settings']['melting'];
    }

    if (!empty($settings['type'])) {
      foreach($this->data['types'] as $i => $type){
        if($type['id'] == $settings['type'])
          $this->data['types'][$i]['selected'] = true;
      }
      $this->data['chains'] = $this->choco_chain_bom_setting_model->get('DISTINCT(chain) as id, chain as name', 
                                                                            array('type' => $settings['type']));
      foreach($this->data['chains'] as $i => $chain){
        if($chain['id'] == $settings['chain'])
          $this->data['chains'][$i]['selected'] = true;
      }
    }

    if (!empty($settings['type']) && !empty($settings['chain'])) {
      $this->data['meltings'] = $this->choco_chain_bom_setting_model->get('id, melting as name',
                                                                         array('type'  => $settings['type'],
                                                                               'chain' => $settings['chain']));
      foreach($this->data['meltings'] as $i => $melting){
        if($melting['id'] == $settings['melting'])
          $this->data['meltings'][$i]['selected'] = true;
      }
    }
  }

  public function _get_view_data() {
    $this->data['record'] = $this->model->get_view_data($this->data['record']);
  }
}