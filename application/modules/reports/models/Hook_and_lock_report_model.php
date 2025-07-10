<?php 

class Hook_and_lock_report_model extends BaseModel{

  public function __construct($data = array()){
    parent::__construct($data);
    $this->load->model(array('melting_lots/melting_lot_model', 'processes/process_model', 'processes/process_field_model'));
  }

  public function get_report_data($data) {
    if(isset($_GET['process']) && !in_array($_GET['process'], get_processes_with_orders()) 
    && isset($_GET['melting']) && !in_array($_GET['melting'], get_meltings())) {
      return false;
    }

    $controller         = url_title($_GET['process'], '_', true);
    $module_name        = plural($controller);
    $order_model        = $controller.'_order_model';
    $bom_model          = $controller.'_bom_setting_model';
    $order_report_model = $controller.'_order_report_model';

    $this->load->model(array($module_name.'/'.$order_model, $module_name.'/'.$bom_model, $module_name.'/'.$order_report_model));

    $where = array();
    if(isset($data['from_date'])) {
      $where['created_at >='] = $data['from_date'];
    }

    if(isset($data['to_date'])) {
      $where['created_at <'] = date('Y-m-d',strtotime($data['to_date'] . ' + 1 days'));
    }

    $orders = $this->$order_model->get('id,'.$controller.'_bom_setting_id', $where);

    $chain_data = get_chain_order_report_data()[$_GET['process']];
    
    $report_data = array();
    if (!empty($orders)) {
      $headers = array('date', 'parent_lot', 'melting_lot', 'purity', 'varient', 'hook', 'qty', 'wt', 'lock', 'qty', 'wt', 'kdm');

      if ($_GET['process'] == 'Choco Chain') {
        $headers = array_merge($headers, ['pipe', 'qty', 'wt']);
      }

      foreach ($orders as $i => $order) {
        $select = array_merge(['melting'], $chain_data['bom_fields']);
        $bom_data = $this->$bom_model->find($select, array('id' => $order[$controller.'_bom_setting_id']));
        if ($_GET['melting'] == 'All' || $bom_data['melting'] == $_GET['melting']) {
          $melting_lots = $this->melting_lot_model->get('created_at, IFNULL(parent_lot_name, "--"), lot_no, lot_purity, id', array('process_name' => $_GET['process'], 'order_id' => $order['id']));

          foreach ($melting_lots as $melting_lot) {
            $order_report = $this->$order_report_model->get_order_details($order['id'], $melting_lot['id'])[0];

            $hook_term = $_GET['process'] == 'Rope Chain' ? 'cap_required' : 'hook_required';
            $hook_data = $order_report[$hook_term];
            $lock_data = $order_report['lock_required'];
            $pipe_data = null;
            $kdm = 0;
            if($_GET['process'] == 'Machine Chain') {
              $kdm = $order_report['kdm_2_per_inch'];
            } elseif ($_GET['process'] == 'Choco Chain') {
              $kdm       = $order_report['kdm_per_inch'];
              $pipe_data = array('size' => 'NA', 'qty' => 0, 'wt' => 0);
              if($order_report['pipe_required']['total_wt'] > 0) {
                $pipe_data = array(
                  'size' => $order_report['pipe_required']['type_size'],
                  'qty'  => $order_report['pipe_required']['pcs'],
                  'wt'   => $order_report['pipe_required']['total_wt'],
                );
              }
            }

            $report_data[] = array('order_data'  => $order,
                                   'bom_data'    => $bom_data,
                                   'melting_lot' => $melting_lot,
                                   'hook_data'   => $hook_data,
                                   'lock_data'   => $lock_data,
                                   'kdm'         => $kdm,
                                   'pipe_data'   => $pipe_data);
          }
        }
      }

      foreach ($headers as $header) {
        $report_data['_headers'][] = str_replace('_', ' ', strtoupper($header));
      }
    }
    return $report_data;
  }
}