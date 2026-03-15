<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Choco_chain_order_report_model extends BaseModel {
  protected $table_name = "choco_chain_orders";
  protected $id = 'id';

  function __construct($data = array()) {
    parent::__construct($data);
    $this->load->model(array('choco_chains/choco_chain_order_model', 'choco_chains/choco_chain_bom_setting_model', 'melting_lots/melting_lot_model', 'processes/process_model', 'processes/process_field_model'));
  }

  public function get_order_details($order_id = null, $melting_lot_id = null) {
    $where = array();
    if($order_id) {
      $where['id'] = $order_id;
    }
    $orders = $this->get('', $where);

    $qty_array = [8, 16, 18, 20, 22, 24, 26, 'custom_1', 'custom_2'];

    foreach ($orders as $i => $order) {

      $order['total_inches']    = $this->choco_chain_order_model->calculate_total_inches($order);
      $order['total_order_qty'] = $this->choco_chain_order_model->calculate_total_chains($order);

      /* define and initialize values */
      $order['total_production_qty']    = 0;
      $order['total_ready_qty']         = 0;
      $order['total_balance_qty']       = 0;
      $order['total_production_lenght'] = 0;

      foreach ($qty_array as $qty) {
        $order[$qty.'_production_qty'] = 0;
        $order[$qty.'_ready_qty']      = 0;
        $order[$qty.'_balance_qty']    = 0;
      }

      $settings = $this->choco_chain_bom_setting_model->find('', array('id' => $order['choco_chain_bom_setting_id']));

      $order['settings'] = $settings;

      $order['type']    = $settings['type'];
      $order['chain']   = $settings['chain'];
      $order['melting'] = $settings['melting'];

      $order['die_1']['pcs']             = round($settings['die_1_pcs_per_18_inch'] / 18 * $order['total_inches']);
      $order['strip_1_required']['wt']   = round($order['die_1']['pcs'] * $settings['die_1_strip_per_pc_wt']);
      $order['langari_1_required']['wt'] = round($order['strip_1_required']['wt'] / $settings['die_1_strip_to_langari_percentage']);

      $order['die_2']['pcs']             = round($settings['die_2_pcs_per_18_inch'] / 18 * $order['total_inches']);
      $order['langari_2_required']['wt'] = round($order['die_2']['pcs'] * $settings['die_2_langari_per_pc_wt']);

      $langari_required_wt = $order['langari_1_required']['wt'] + $order['langari_2_required']['wt'];

      if(empty($melting_lot_id)) {
        $melting_lots = $this->melting_lot_model->get('id', array('process_name' => 'Choco Chain', 'order_id' => $order['id']));
      } else {
        $melting_lots[] = array('id' => $melting_lot_id);
      }
      $melting_lot_ids = array_column($melting_lots, 'id');

      $total_gross_weight = 0;
      if(!empty($melting_lot_ids)) {
        $total_gross_weight = $this->melting_lot_model->find('SUM(gross_weight) as total_gross_weight', array('where' => array('process_name' => 'Choco Chain'), 'where_in' => array('id' => $melting_lot_ids)))['total_gross_weight'];
      }
      $prod_qty_proprtion = ($total_gross_weight/ $langari_required_wt) * $order['total_order_qty'];

      foreach ($qty_array as $qty) {
        $order[$qty.'_production_qty'] += floor($prod_qty_proprtion * $order[$qty.'_proportion']);
      }
      foreach ($melting_lots as $melting_lot) {
        $ready_qties = $this->process_field_model->get('length, quantity', array('melting_lot_id' => $melting_lot['id']));
        foreach ($ready_qties as $qty_data) {
          $length = str_replace(' inch','',$qty_data['length']);
          if(!empty($length))
            $order[$length.'_ready_qty'] += $qty_data['quantity'];
        }
      }

      foreach ($qty_array as $qty) {
        /* calculate balance */
        $order[$qty.'_balance_qty'] = $order[$qty.'_order_qty'] - $order[$qty.'_ready_qty'];
    
        /* calculate total */
        $order['total_production_qty'] += $order[$qty.'_production_qty'];
        $order['total_ready_qty']      += $order[$qty.'_ready_qty'];
        $order['total_balance_qty']    += $order[$qty.'_balance_qty'];

        $order['total_production_lenght'] += $qty * $order[$qty.'_production_qty'];
      }

      if(!empty($melting_lot_id)) {

        $order['melting_lot_id'] = $melting_lot_id;

        $order['production_chain_wt'] = $settings['wt_per_inch'] * $order['total_production_lenght'];

        $order['die_1']['code'] = $settings['die_1_code'];
        $order['die_1']['pcs']  = round($settings['die_1_pcs_per_18_inch'] / 18 * $order['total_production_lenght']);
        $order['die_1']['wt']   = round($order['die_1']['pcs'] * $settings['die_1_wt_per_pcs']);
        
        $order['die_2']['code'] = $settings['die_2_code'];
        $order['die_2']['pcs']  = round($settings['die_2_pcs_per_18_inch'] / 18 * $order['total_production_lenght']);
        $order['die_2']['wt']   = round($order['die_2']['pcs'] * $settings['die_2_wt_per_pcs']);

        $order = $this->choco_chain_order_model->calculate_strip_langari_data($order, $settings);

        $order['hook_required']['size']  = $settings['hook_per_chain_size'];
        $order['hook_required']['qty']   = $order['total_production_qty'] * $settings['hook_per_chain_qty'];
        $order['hook_required']['wt']    = $order['total_production_qty'] * $settings['hook_per_chain_wt'];

        $order['lock_required']['size'] = $settings['lock_per_chain_size'];
        $order['lock_required']['qty']  = $order['total_production_qty'] * $settings['lock_per_chain_qty'];
        $order['lock_required']['wt']   = $order['total_production_qty'] * $settings['lock_per_chain_wt'];

        $order['kdm_per_inch'] = round($order['total_production_lenght'] * $settings['kdm_per_inch'], 2);

        $order['pipe_required']['type_size'] = $settings['pipe_type_size'];
        $order['pipe_required']['pcs']       = round($order['total_production_lenght'] * $settings['pipe_pcs'] / 18);
        $order['pipe_required']['wt_per_pc'] = round($settings['pipe_wt_per_pc'], 2);
        $order['pipe_required']['total_wt']  = round($order['pipe_required']['pcs'] * $order['pipe_required']['wt_per_pc'], 2);
      }
      $orders[$i] = $order;
    }
    
    return $orders;
  }
}