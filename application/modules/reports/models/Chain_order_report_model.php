<?php

class Chain_order_report_model extends BaseModel{

  public function __construct($data = array()){
    parent::__construct($data);
    $this->load->model(array('melting_lots/melting_lot_model', 'processes/process_model', 'processes/process_field_model'));
    $this->length_arr = [8, 16, 18, 20, 22, 24, 26, 'custom_1', 'custom_2'];
  }

  public function get_report_data($data) {
    if(isset($_GET['process']) && !in_array($_GET['process'], get_processes_with_orders())) {
      return false;
    }

    $controller  = url_title($_GET['process'], '_', true);
    $module_name = plural($controller);
    $order_model = $controller.'_order_model';
    $bom_model   = $controller.'_bom_setting_model';

    $this->load->model(array($module_name.'/'.$order_model, $module_name.'/'.$bom_model));

    $chain_data = get_chain_order_report_data()[$_GET['process']];

    $where = array();
    if(isset($data['from_date'])) {
      $where['created_at >='] = $data['from_date'];
    }

    if(isset($data['to_date'])) {
      $where['created_at <'] = date('Y-m-d',strtotime($data['to_date'] . ' + 1 days'));
    }

    $operations = array();
    if(isset($chain_data['order_by'])) {
      $operations['order_by'] = $chain_data['order_by'];
    }

    $select = array('id', $controller.'_bom_setting_id');

    if($_GET['process'] == 'Round Box Chain') {
      $select = array_merge($select, ['custom_1_order_length as custom_1_length', 'custom_2_order_length as custom_2_length']);
    } else {
      $select = array_merge($select, ['custom_1_length', 'custom_2_length']);
    }

    $orders = $this->$order_model->get($select, $where);

    $report_data = array();

    if (!empty($orders)) {
      $headers = array_merge(['sr_no'], $chain_data['bom_fields'], array('purity', 'melting_lot_no', 'melting_lot_date', 'melting_wt'), $chain_data['departments']);

      $department_cnt = 0;

      foreach ($chain_data['departments'] as $departments) {
        foreach ($departments as $department) {
          $department_cnt++;
        }
      }

      foreach ($orders as $i => $order) {
        $bom_data     = $this->$bom_model->find($chain_data['bom_fields'], array('id' => $order[$controller.'_bom_setting_id']));
        $melting_lots = $this->melting_lot_model->get('id, lot_purity, lot_no, created_at, gross_weight', array('process_name' => $_GET['process'], 'order_id' => $order['id']));

        foreach ($melting_lots as $melting_lot) {
          $total_ready_qty = 0;
          foreach ($this->length_arr as $length) {
            $quantities[$length.'_ready_qty'] = 0;
          }

          $processes = $this->process_model->get('process_name, department_name, out_weight', array('melting_lot_id' => $melting_lot['id'], 'department_name !=' => 'Start'), array(), $operations);

          $process_data = array();
          foreach ($processes as $process) {
            $process_name    = $process['process_name'];
            $department_name = $process['department_name'];
            if (isset($process_data[$process_name][$department_name])) {
              $process_data[$process_name][$department_name] += $process['out_weight'];
            } else {
              $process_data[$process_name][$department_name] = $process['out_weight'];
            }
          }

          $ready_qties = $this->process_field_model->get('length, quantity', array('melting_lot_id' => $melting_lot['id']));

          foreach ($ready_qties as $qty_data) {
            $length = str_replace(' inch','',$qty_data['length']);
            if(!empty($length))
              $quantities[$length.'_ready_qty'] += $qty_data['quantity'];
          }

          $gpc_qty = $this->process_model->find('SUM(quantity) as quantity', array('melting_lot_id' => $melting_lot['id'], 'department_name' => 'GPC'))['quantity'];
          $gpc_qty = empty($gpc_qty) ? 0 : $gpc_qty;

          foreach ($this->length_arr as $length) {
            $total_ready_qty += $quantities[$length.'_ready_qty'];
          }
          $report_data[] = array('order_data'      => $order,
                                 'bom_data'        => $bom_data,
                                 'melting_lot'     => $melting_lot,
                                 'process'         => $process_data,
                                 'gpc_qty'         => $gpc_qty,
                                 'quantities'      => $quantities,
                                 'total_ready_qty' => $total_ready_qty);
        }
      }

      $report_data['_headers']        = $this->_get_final_headers($headers);
      $report_data['_department_cnt'] = $department_cnt;
    }
    return $report_data;
  }

  private function _get_final_headers($headers) {
    $final_headers['main'] = array();
    foreach ($headers as $index => $header) {
      if(is_string($header)) {
        $final_headers['main'][] = str_replace('_', ' ', ucfirst($header));
      } else if(is_array($header)) {
        $final_headers['departments'][$index] = $header;
      }
    }
    foreach ($this->length_arr as $length) {
      $final_headers['quantities'][] = str_replace('_', ' ', ucfirst($length));
    }
    return $final_headers;
  }
}