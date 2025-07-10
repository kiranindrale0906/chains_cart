<?php 

class Bom_report_model extends BaseModel{

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
      $headers = array('', 'order_id', 'lot_no', 'melting_date', 'melting', 'varient', 'langari', 'strip', 'chain_wt', 'gpc_out', 'gpc_out_qty', 'throughput');

      foreach ($orders as $i => $order) {
        $select = array_merge(['melting'], $chain_data['bom_fields']);
        $bom_data = $this->$bom_model->find($select, array('id' => $order[$controller.'_bom_setting_id']));
        if ($_GET['melting'] == 'All' || $bom_data['melting'] == $_GET['melting']) {
          $melting_lots = $this->melting_lot_model->get('lot_no, created_at, gross_weight, id', array('process_name' => $_GET['process'], 'order_id' => $order['id']));

          foreach ($melting_lots as $melting_lot) {
            $order_report = $this->$order_report_model->get_order_details($order['id'], $melting_lot['id'])[0];
            /* BOM data calculation */
            if($_GET['process'] == 'Choco Chain') {
              $bom_strip_wt = $order_report['strip_1_required']['wt'] + $order_report['strip_2_required']['wt'];
            } else {
              $bom_strip_wt = $order_report['strip_required']['wt'];
            }

            $hook_term = $_GET['process'] == 'Rope Chain' ? 'cap_required' : 'hook_required';
            $kdm = 0;
            if($_GET['process'] == 'Machine Chain') {
              $kdm = $order_report['kdm_2_per_inch'];
            } elseif ($_GET['process'] == 'Choco Chain') {
              $kdm = $order_report['kdm_per_inch'];          
            }

            $bom_gpc_out   = $order_report['production_chain_wt'] + $order_report[$hook_term]['wt'] + $order_report['lock_required']['wt'] + $kdm;
            $bom_throghput =  $bom_strip_wt == 0 ? 0 : round($bom_gpc_out / $bom_strip_wt * 100);

            $as_per_bom_data = array(
              'strip'        => $bom_strip_wt,
              'chain_wt'     => $order_report['production_chain_wt'],
              'gpc_out'      => $bom_gpc_out,
              'gpc_out_qty'  => $order_report['total_production_qty'],
              'throughput'   => $bom_throghput
            );

            /* actual data calculation */
            $actual_strip_wt    = $this->process_model->find('out_weight', array('melting_lot_id' => $melting_lot['id'], 'department_name' => 'Flatting'))['out_weight'];
            $actual_chain_wt    = $this->process_model->find('SUM(out_weight) as wt', array('melting_lot_id' => $melting_lot['id'], 'department_name' => $chain_data['dept_for_actual_ch_wt']))['wt'];
            $actual_gpc_out     = $this->process_model->find('SUM(gpc_out) as gpc_out', array('melting_lot_id' => $melting_lot['id'], 'department_name' => 'GPC'))['gpc_out'];
            $actual_gpc_out_qty = $this->process_model->find('SUM(quantity) as quantity', array('melting_lot_id' => $melting_lot['id'], 'department_name' => 'GPC'))['quantity'];
            $actual_throghput   = $actual_strip_wt == 0 ? 0 : round($actual_gpc_out / $actual_strip_wt * 100);

            $actual_data = array(
              'strip'        => !empty($actual_strip_wt) ? $actual_strip_wt : 0,
              'chain_wt'     => !empty($actual_chain_wt) ? $actual_chain_wt : 0,
              'gpc_out'      => !empty($actual_gpc_out) ? $actual_gpc_out : 0,
              'gpc_out_qty'  => !empty($actual_gpc_out_qty) ? round($actual_gpc_out_qty) : 0,
              'throughput'   => $actual_throghput
            );

            $report_data[] = array('order_data'      => $order,
                                   'bom_data'        => $bom_data,
                                   'melting_lot'     => $melting_lot,
                                   'as_per_bom_data' => $as_per_bom_data,
                                   'actual_data'     => $actual_data,
                                  );
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