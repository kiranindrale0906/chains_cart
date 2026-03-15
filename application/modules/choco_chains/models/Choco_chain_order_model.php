<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Choco_chain_order_model extends BaseModel {
  protected $table_name = "choco_chain_orders";
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
  }

  public function before_validate() {
    $this->load->model('choco_chain_bom_setting_model');
    if(isset($this->formdata['submittype']) && $this->formdata['submittype'] == 'json') {
      $this->formdata['choco_chain_bom_settings'] = $this->choco_chain_bom_setting_model->find('type, chain, id as melting', array('id' => $this->formdata['choco_chain_orders']['choco_chain_bom_setting_id']));
    }
  }

  public function validation_rules($klass='') {
    $rules = array(
              array('field' => 'choco_chain_bom_settings[type]', 'label' => 'type',
                    'rules' => array('trim', 'required')),
              array('field' => 'choco_chain_bom_settings[chain]', 'label' => 'chain',
                    'rules' => array('trim', 'required')),
              array('field' => 'choco_chain_bom_settings[melting]', 'label' => 'melting',
                    'rules' => array('trim', 'required')),
              array('field' => 'choco_chain_orders[8_order_qty]', 'label' => '8" quantity',
                    'rules' => array('trim', 'integer')),
              array('field' => 'choco_chain_orders[16_order_qty]', 'label' => '16" quantity',
                    'rules' => array('trim', 'integer')),
              array('field' => 'choco_chain_orders[18_order_qty]', 'label' => '18" quantity',
                    'rules' => array('trim', 'integer')),
              array('field' => 'choco_chain_orders[20_order_qty]', 'label' => '20" quantity',
                    'rules' => array('trim', 'integer')),
              array('field' => 'choco_chain_orders[22_order_qty]', 'label' => '22" quantity',
                    'rules' => array('trim', 'integer')),
              array('field' => 'choco_chain_orders[24_order_qty]', 'label' => '24" quantity',
                    'rules' => array('trim', 'integer')),
              array('field' => 'choco_chain_orders[26_order_qty]', 'label' => '26" quantity',
                    'rules' => array('trim', 'integer')),
              array('field' => 'choco_chain_orders[custom_1_length]', 'label' => 'custom length 1',
                    'rules' => array('trim', 'integer')),
              array('field' => 'choco_chain_orders[custom_1_order_qty]', 'label' => 'custom quantity 1',
                    'rules' => array('trim', 'integer')),
              array('field' => 'choco_chain_orders[custom_2_length]', 'label' => 'custom length 2',
                    'rules' => array('trim', 'integer')),
              array('field' => 'choco_chain_orders[custom_2_order_qty]', 'label' => 'custom quantity 2',
                    'rules' => array('trim', 'integer')),
              array('field' => 'choco_chain_orders[tone]', 'label' => 'tone',
                    'rules' => array('trim', 'required')),
            );
    return $rules;
  }

  public function get_orders_dropdown() {
    $this->load->model(array('choco_chain_bom_setting_model', 'melting_lots/melting_lot_model'));
    $orders = $this->choco_chain_order_model->get('', array('status' => 'OPEN'));
    $order_ids = array();
    foreach ($orders as $order) {
      $total_gross_weight = $this->melting_lot_model->find('SUM(gross_weight) as total_gross_weight', array('order_id' => $order['id'], 'process_name' => 'Choco Chain'))['total_gross_weight'];
      $settings = $this->choco_chain_bom_setting_model->find('', array('id' => $order['choco_chain_bom_setting_id']));
    
      $order['total_inches'] = $this->calculate_total_inches($order);
      
      $order['die_1']['pcs']             = round($settings['die_1_pcs_per_18_inch'] / 18 * $order['total_inches']);
      $order['strip_1_required']['wt']   = round($order['die_1']['pcs'] * $settings['die_1_strip_per_pc_wt']);
      if($settings['die_1_strip_to_langari_percentage'] != 0) {
        $order['langari_1_required']['wt'] = round($order['strip_1_required']['wt'] / $settings['die_1_strip_to_langari_percentage'], 2);
      }

      $order['die_2']['pcs']             = round($settings['die_2_pcs_per_18_inch'] / 18 * $order['total_inches']);
      $order['langari_2_required']['wt'] = round($order['die_2']['pcs'] * $settings['die_2_langari_per_pc_wt']);

      $langari_required_wt = $order['langari_1_required']['wt'] + $order['langari_2_required']['wt'];
      $gross_wt_1 = 0;
      $gross_wt_2 = 0;

      if($langari_required_wt != 0) {
        $gross_wt_1 = ($order['langari_1_required']['wt'] / $langari_required_wt) * $total_gross_weight;
        $gross_wt_2 = ($order['langari_2_required']['wt'] / $langari_required_wt) * $total_gross_weight;
      }
      
      $order_langari_1_required_wt = round($order['langari_1_required']['wt'] - $gross_wt_1);
      $order_langari_2_required_wt = round($order['langari_2_required']['wt'] - $gross_wt_2);

      if($order_langari_1_required_wt > 0 || $order_langari_2_required_wt > 0) {
        if ($order_langari_1_required_wt > 0) {
          $order_data = 'Order ID: '.$order['id'].' ('.$settings['chain'].', Melting '.$settings['melting'].', '.$settings['die_1_langari_name'].' - '.$order_langari_1_required_wt.'gms, '.$order['tone'].')';
          $order_ids[] = array('id'   => $order['id'],
                               'name' => $order_data);
        }
        if ($order_langari_2_required_wt > 0) {
          $order_data = 'Order ID: '.$order['id'].' ('.$settings['chain'].', Melting '.$settings['melting'].', '.$settings['die_2_langari_name'].' - '.$order_langari_2_required_wt.'gms, '.$order['tone'].')';
          $order_ids[] = array('id'   => $order['id'],
                               'name' => $order_data);
        }
      }
    }
    return $order_ids;
  }

  public function get_choco_bom_orders_dropdown() {
    $choco_bom_db = $this->get_chocobom_db();
      $order_id=$this->melting_lot_model->get('order_id',array('process_name'=>"Choco Chain"));
      if(!empty($order_id)){
        $order_ids=array_column($order_id,'order_id');
        $order_ids=implode(',',$order_ids);
      }else{
        $order_ids=0;
      }
      // $query =$this->db->query("select Distinct(".BOM_DB_NAME.".sisma_melting_lot_orders.id) as id ,".BOM_DB_NAME.".sisma_melting_lot_orders.order_no as name from  ".BOM_DB_NAME.".sisma_melting_lot_orders");
      $query =$this->db->query("select Distinct(".BOM_DB_NAME.".orders.id) as id ,".BOM_DB_NAME.".orders.name as name from  ".BOM_DB_NAME.".orders  where id not in (".$order_ids.") and bom='Choco Bom' and status= 'Accepted'");
      $order_ids = $query->result_array();
      return $order_ids;
    }

    public function get_choco_bom_orders_designs_dropdown($id = ''){
      $choco_bom_db = $this->get_chocobom_db();
      $query =$this->db->query('select Distinct('.BOM_DB_NAME.'.designs.design_name) as id ,'.BOM_DB_NAME.'.designs.design_name as name from '.BOM_DB_NAME.'.designs as designs INNER JOIN '.BOM_DB_NAME.'.order_details as order_details ON designs.id = order_details.design_code INNER JOIN '.BOM_DB_NAME.'.orders as orders ON order_details.order_id = orders.id and orders.id ='.$id. ' and orders.bom = "Choco Bom"');
      $design_codes = $query->result_array();
      return $design_codes;
    }
    
  public function get_choco_bom_details($choco_order_details){
    $choco_bom_db = BOM_DB_NAME;
    $query =$this->db->query("SELECT orders.order_date, orders.customer_name, orders.description, designs.design_name, GROUP_CONCAT(ROUND(order_details.length)) AS size,GROUP_CONCAT(ROUND(order_details.quantity)) AS qty
                              FROM $choco_bom_db.orders
                              LEFT JOIN $choco_bom_db.order_details ON order_details.order_id = orders.id
                              LEFT JOIN $choco_bom_db.designs ON designs.id = order_details.design_code
                              WHERE orders.id=".$choco_order_details['order_id']." AND designs.design_name='".$choco_order_details['digital_catalog_design_code']."'
                              GROUP BY design_code");
      $design_codes = $query->row_array();
      return $design_codes;
  }

  public function get_chocobom_db(){
//    return "chocobom_feb2023_production";
    return "argold_chocobom_staging";
    // return "choco_bom";
  }

  public function get_view_data($order) {
    $settings = $this->choco_chain_bom_setting_model->find('', array('id' => $order['choco_chain_bom_setting_id']));

    $order['total_inches'] = $this->calculate_total_inches($order);
    $order['total_chains'] = $this->calculate_total_chains($order);

    $order['total_chain_wt'] = $settings['wt_per_inch'] * $order['total_inches'];
    
    $order['die_1']['code'] = $settings['die_1_code'];
    $order['die_1']['pcs']  = round($settings['die_1_pcs_per_18_inch'] / 18 * $order['total_inches']);
    $order['die_1']['wt']   = round($order['die_1']['pcs'] * $settings['die_1_wt_per_pcs']);
    
    $order['die_2']['code'] = $settings['die_2_code'];
    $order['die_2']['pcs']  = round($settings['die_2_pcs_per_18_inch'] / 18 * $order['total_inches']);
    $order['die_2']['wt']   = round($order['die_2']['pcs'] * $settings['die_2_wt_per_pcs']);

    $order = $this->calculate_strip_langari_data($order, $settings);

    $order['hook_required']['size'] = $settings['hook_per_chain_size'];
    $order['hook_required']['qty']  = $order['total_chains'] * $settings['hook_per_chain_qty'];
    $order['hook_required']['wt']   = round($order['total_chains'] * $settings['hook_per_chain_wt']);

    $order['lock_required']['size'] = $settings['lock_per_chain_size'];
    $order['lock_required']['qty']  = $order['total_chains'] * $settings['lock_per_chain_qty'];
    $order['lock_required']['wt']   = round($order['total_chains'] * $settings['lock_per_chain_wt']);

    $order['kdm_per_inch'] = round($order['total_inches'] * $settings['kdm_per_inch'], 2);

    $order['pipe_required']['type_size'] = $settings['pipe_type_size'];
    $order['pipe_required']['pcs']       = round($order['total_inches'] * $settings['pipe_pcs'] / 18);
    $order['pipe_required']['wt_per_pc'] = round($settings['pipe_wt_per_pc'], 2);
    $order['pipe_required']['total_wt']  = round($order['pipe_required']['pcs'] * $order['pipe_required']['wt_per_pc'], 2);

    $order['settings'] = $settings;

    $order['melting_lots'] = $this->melting_lot_model->get('id, lot_no, lot_purity, gross_weight, created_at', array('process_name' => 'Choco Chain', 'order_id' => $order['id']));

    return $order;
  }

  public function calculate_total_chains($order) {
    return $order['8_order_qty']
         + $order['16_order_qty']
         + $order['18_order_qty']
         + $order['20_order_qty']
         + $order['22_order_qty']
         + $order['24_order_qty']
         + $order['26_order_qty']
         + $order['custom_1_order_qty']
         + $order['custom_2_order_qty'];
  }

  public function calculate_total_inches($order) {
    return 8 * $order['8_order_qty']
         + 16 * $order['16_order_qty']
         + 18 * $order['18_order_qty']
         + 20 * $order['20_order_qty']
         + 22 * $order['22_order_qty']
         + 24 * $order['24_order_qty']
         + 26 * $order['26_order_qty']
         + $order['custom_1_length'] * $order['custom_1_order_qty']
         + $order['custom_2_length'] * $order['custom_2_order_qty'];

  }

  public function calculate_strip_langari_data($order, $settings) {
    $order['strip_1_required']['width']     = round($settings['die_1_strip_per_pc_width']);
    $order['strip_1_required']['thickness'] = round($settings['die_1_strip_per_pc_thickness'], 2);
    $order['strip_1_required']['wt']        = round($order['die_1']['pcs'] * $settings['die_1_strip_per_pc_wt']);

    $order['strip_2_required']['width']     = round($settings['die_2_strip_per_pc_width']);
    $order['strip_2_required']['thickness'] = round($settings['die_2_strip_per_pc_thickness'], 2);
    $order['strip_2_required']['wt']        = round($order['die_2']['pcs'] * $settings['die_2_strip_per_pc_wt']);
    
    $order['langari_1_required']['size'] = $settings['die_1_langari_name'];
    $order['langari_1_required']['wt']   = round($order['strip_1_required']['wt'] / $settings['die_1_strip_to_langari_percentage']);
    
    $order['langari_2_required']['size'] = $settings['die_2_langari_name'];
    $order['langari_2_required']['wt']   = round($order['die_2']['pcs'] * $settings['die_2_langari_per_pc_wt']);
    return $order;
  }
}
