<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('memory_limit', '-1');

class Lot_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('melting_lots/melting_lot_model', 'processes/process_model',
                             'rope_chains/rope_chain_final_process_model'));
  }

  public function index() { 
    $this->data['type'] = empty($_GET['type']) ? '' : $_GET['type'];
    $this->data['group_by_department'] = 1; //!empty($_GET['group_by_department']);
    
    $product_name_records = $this->process_model->get('distinct(product_name) as product_name');
    $this->data['lot_records'] = array();
    foreach ($product_name_records as $index => $product_name_record) 
      $this->get_lot_reports($product_name_record['product_name']);
    $this->load->render('reports/lot_reports/index', $this->data);    

  }

  private function get_lot_reports($product_name){
    $where=array();
    $where['product_name'] = $product_name;

    if ($this->data['group_by_department']) {
      $common_select_fields = ' , processes.id as row_id, concat(processes.process_name, processes.department_name, processes.row_id) as melting_lot_id, 
                                  concat(processes.process_name, " ", processes.department_name, " ", min(processes.lot_no)) as lot_no';
       $group_by = 'processes.process_name, processes.id, processes.department_name';
    } else {
      $common_select_fields = ', processes.melting_lot_id as melting_lot_id, 
                                 min(processes.lot_no) as lot_no';
      $group_by = 'processes.melting_lot_id';
    }

    $where_condition=array();
    if (!$this->data['group_by_department']) 
      $where_condition['department_name'] = array('Start', 'Daily Drawer Wastage');
    $ins = $this->process_model->get('sum(in_weight) as weight,
                                      sum(in_weight * in_purity / 100) as weight_gross,
                                      sum(in_weight * in_purity / 100 * in_lot_purity / 100) as weight_fine'.$common_select_fields, 
                                      array_merge($where, $where_condition), array(), 
                                      array('group_by' => $group_by));
    $this->get_records_by_melting_lot_id($ins, 'in');

    $where_condition = array();
    $out_id_records = $this->process_model->get('max(id) as max_id'.$common_select_fields, 
                                       array_merge($where, $where_condition), array(), 
                                       array('group_by' => $group_by));
    $out_ids = array_column($out_id_records, 'max_id');
    
    $where_condition = array();
    $where_condition['id'] = $out_ids;
    //$where_condition['balance'] = 0;
    $outs = $this->process_model->get('sum(out_weight) as weight,
                                       sum(out_weight * out_purity / 100) as weight_gross,
                                       sum(out_weight * out_purity / 100 * out_lot_purity / 100) as weight_fine'.$common_select_fields, 
                                       array_merge($where, $where_condition), array(), 
                                       array('group_by' => $group_by));
    $this->get_records_by_melting_lot_id($outs, 'out');

    $indo_tally_strip_cutting_hcl_losses = $this->process_model->get('0 as weight,
                                       sum(hcl_process.expected_out_weight - hcl_process.out_weight) as weight_gross,
                                       sum((hcl_process.expected_out_weight - hcl_process.out_weight) * hcl_process.out_lot_purity / 100) as weight_fine'.$common_select_fields,
                                       array('hcl_process.product_name' =>  'HCL',
                                             'hcl_process.department_name' => 'HCL Process',
                                             'hcl_process.strip_cutting_process_id > 0' => NULL,
                                             'processes.product_name' => $product_name),
                                       array(array('processes hcl_process', 'hcl_process.strip_cutting_process_id = processes.id')),
                                       array('group_by' => $group_by));
    $this->get_records_by_melting_lot_id($indo_tally_strip_cutting_hcl_losses, 'indo_tally_strip_cutting_hcl_loss');

    $hcl_melting_strip_cutting_hcl_losses = $this->process_model->get('0 as weight,
                                       sum(processes.expected_out_weight - processes.out_weight) as weight_gross,
                                       sum((processes.expected_out_weight - processes.out_weight) * processes.out_lot_purity / 100) as weight_fine'.$common_select_fields, 
                                       array('processes.product_name' =>  'HCL',
                                             'processes.department_name' => 'HCL Process',
                                             'processes.strip_cutting_process_id > 0' => NULL,
                                             'indo_tally_process.product_name' => $product_name),
                                       array(array('processes indo_tally_process', 'processes.strip_cutting_process_id = indo_tally_process.id')),
                                       array('group_by' => $group_by));
    $this->get_records_by_melting_lot_id($hcl_melting_strip_cutting_hcl_losses, 'hcl_melting_strip_cutting_hcl_loss');

    $melting_wastages = $this->process_model->get('
                                                   sum(balance) as balance_weight,
                                                   sum(balance_gross) as balance_weight_gross,
                                                   sum(balance_fine) as balance_weight_fine,

                                                   sum(fe_in - fe_out - wastage_fe) as fe_weight,
                                                   0 as fe_weight_gross,
                                                   0 as fe_weight_fine,

                                                   sum(hook_in - hook_out + sisma_in - sisma_out) as hook_weight,
                                                   sum(hook_in - hook_out + sisma_in - sisma_out) as hook_weight_gross,
                                                   sum((hook_in - hook_out + sisma_in - sisma_out) * hook_kdm_purity / 100) as hook_weight_fine,

                                                   sum(solder_in) as solder_in_weight,
                                                   sum(solder_in) as solder_in_weight_gross,
                                                   0 as solder_in_weight_fine,

                                                   sum(alloy_weight + copper_in + stone_vatav + stone_in) as alloy_weight_weight,
                                                   sum(alloy_weight + copper_in + stone_vatav + stone_in) as alloy_weight_weight_gross,
                                                   sum((copper_in  + stone_vatav + stone_in) * in_lot_purity / 100) as alloy_weight_weight_fine,

                                                   sum(solder_wastage) as solder_wastage_weight,
                                                   sum(solder_wastage) as solder_wastage_weight_gross,
                                                   sum(solder_wastage * wastage_lot_purity) / 100 as solder_wastage_weight_fine,

                                                   sum(copper_out + out_stone_vatav + stone_out) as copper_out_weight,
                                                   sum(copper_out + out_stone_vatav + stone_out) as copper_out_weight_gross,
                                                   sum((copper_out + out_stone_vatav + stone_out) * in_lot_purity / 100) as copper_out_weight_fine,

                                                   sum(melting_wastage) as melting_wastage_weight,
                                                   sum(melting_wastage) as melting_wastage_weight_gross,
                                                   sum(melting_wastage * wastage_lot_purity / 100 ) as melting_wastage_weight_fine,

                                                   sum(repair_out) as ka_hook_out_weight,
                                                   sum(repair_out) as ka_hook_out_weight_gross,
                                                   sum(repair_out * in_lot_purity / 100 ) as ka_hook_out_weight_fine,

                                                   sum(next_department_wastage) as next_department_wastage_weight,
                                                   sum(next_department_wastage) as next_department_wastage_weight_gross,
                                                   sum(next_department_wastage * wastage_lot_purity / 100 ) as next_department_wastage_weight_fine,

                                                   sum(in_melting_wastage) as in_melting_wastage_weight,
                                                   sum(in_melting_wastage) as in_melting_wastage_weight_gross,
                                                   sum(in_melting_wastage * in_lot_purity / 100) as in_melting_wastage_weight_fine,

                                                   sum(daily_drawer_wastage) as daily_drawer_wastage_weight,
                                                   sum(daily_drawer_wastage) as daily_drawer_wastage_weight_gross,
                                                   sum(daily_drawer_wastage * wastage_lot_purity / 100) as daily_drawer_wastage_weight_fine,

                                                   sum(daily_drawer_in_weight) as daily_drawer_in_weight,
                                                   sum(daily_drawer_in_weight) as daily_drawer_in_weight_gross,
                                                   sum(daily_drawer_in_weight * out_lot_purity / 100) as daily_drawer_in_weight_fine,

                                                   sum(daily_drawer_out_weight) as daily_drawer_out_weight,
                                                   sum(daily_drawer_out_weight) as daily_drawer_out_weight_gross,
                                                   sum(daily_drawer_out_weight * out_lot_purity / 100) as daily_drawer_out_weight_fine,

                                                   sum(ghiss + pending_ghiss) as ghiss_weight,
                                                   sum(ghiss + pending_ghiss) as ghiss_weight_gross,
                                                   sum((ghiss + pending_ghiss) * wastage_lot_purity / 100) as ghiss_weight_fine,

                                                   sum(tounch_in + fire_tounch_in) as tounch_in_weight,
                                                   sum(tounch_in + fire_tounch_in) as tounch_in_weight_gross,
                                                   sum((tounch_in + fire_tounch_in) * wastage_lot_purity / 100) as tounch_in_weight_fine,

                                                   sum(hcl_wastage) as hcl_wastage_weight,
                                                   sum(hcl_wastage * wastage_purity / 100) as hcl_wastage_weight_gross,
                                                   sum(hcl_wastage * wastage_purity / 100 * wastage_lot_purity / 100) as hcl_wastage_weight_fine,

                                                   sum(hcl_ghiss) as hcl_ghiss_weight,
                                                   sum(hcl_ghiss * wastage_purity / 100) as hcl_ghiss_weight_gross,
                                                   sum(hcl_ghiss * wastage_purity / 100 * wastage_lot_purity / 100) as hcl_ghiss_weight_fine,

                                                   sum(loss + karigar_loss + pending_loss) as loss_weight,
                                                   sum((loss + karigar_loss + pending_loss) * wastage_purity / 100) as loss_weight_gross,
                                                   sum((loss + karigar_loss + pending_loss) * wastage_purity / 100 * wastage_lot_purity / 100) as loss_weight_fine,

                                                   sum(refine_loss) as refine_loss_weight,
                                                   sum(refine_loss * wastage_purity / 100) as refine_loss_weight_gross,
                                                   sum(refine_loss * wastage_purity / 100 * wastage_lot_purity / 100) as refine_loss_weight_fine,

                                                   0 as tounch_loss_fine_weight,
                                                   0 as tounch_loss_fine_weight_gross,
                                                   sum(tounch_loss_fine) as tounch_loss_fine_weight_fine,

                                                   0 as hcl_loss_weight,
                                                   sum(hcl_loss * wastage_purity / 100) as hcl_loss_weight_gross,
                                                   sum(hcl_loss * wastage_purity / 100 * wastage_lot_purity / 100) as hcl_loss_weight_fine,

                                                   sum(gpc_out + customer_out + recutting_out + factory_out + bounch_out + hallmark_out - hallmark_in) as gpc_out_weight,
                                                   sum(gpc_out + customer_out + recutting_out + factory_out + bounch_out + hallmark_out - hallmark_in) as gpc_out_weight_gross,
                                                   sum((gpc_out + customer_out + recutting_out + factory_out + bounch_out + hallmark_out - hallmark_in) * out_lot_purity / 100) as gpc_out_weight_fine,

                                                   sum(micro_coating) as micro_coating_weight,
                                                   sum(micro_coating) as micro_coating_weight_gross,
                                                   sum(micro_coating * wastage_lot_purity / 100) as micro_coating_weight_fine,

                                                   '.$common_select_fields, 
                                                   array_merge($where), array(), 
                                                   array('group_by' => $group_by));
    $this->get_records_by_melting_lot_id($melting_wastages, 'chain');

   //  //HOOK IN - HOOK OUT between AU+FE and HCL
   //  $hook_processes = $this->process_model->get('sum(hook_in-hook_out) as weight, melting_lot_id',
   //                                               array_merge($where, array('out_purity <'=>100)), 
   //                                               array(), array('group_by' => 'melting_lot_id'));
   //  $this->get_records_by_melting_lot_id($hook_processes, 'hook');
   
   //  $hcl_wastage_processes = $this->process_model->get('sum(hcl_wastage * out_purity / 100) as weight, melting_lot_id',
   //                                                      $where, array(), array('group_by' => 'melting_lot_id'));
   //  $this->get_records_by_melting_lot_id($hcl_wastage_processes, 'hcl_wastage');
   
   //  //LOSS between AU+FE and HCL
   //  $loss_weight_processes = $this->process_model->get('sum(loss * out_purity / 100) as weight, melting_lot_id', 
   //                                                     array_merge($where, array('out_purity <'=>100)), 
   //                                                     array(), array('group_by' => 'melting_lot_id'));
   //  $this->get_records_by_melting_lot_id($loss_weight_processes, 'loss_weight');
   
   //  //TOUNCH IN between AU+FE and HCL
   //  $tounch_processes = $this->process_model->get('sum(tounch_in) as weight, melting_lot_id', 
   //                                                     array_merge($where, array('out_purity <'=>100)), 
   //                                                     array(), array('group_by' => 'melting_lot_id'));
   //  $this->get_records_by_melting_lot_id($tounch_processes, 'tounch_weight');
   
   //  $hcl_ghiss_processes = $this->process_model->get('sum(hcl_ghiss * out_purity / 100) as weight, melting_lot_id', 
   //                                                    $where, array(), array('group_by' => 'melting_lot_id'));
   //  $this->get_records_by_melting_lot_id($hcl_ghiss_processes, 'hcl_ghiss');

   //  $select = 'sum(out_weight) as out_weight, 
   //             sum(out_weight * in_lot_purity) / sum(out_weight) as out_lot_purity,
   //             sum(hcl_loss) as hcl_loss_gross,
   //             sum(hcl_loss * in_lot_purity / 100) as hcl_loss_fine,
   //             melting_lot_id';
   //  $out_weight_processes = $this->process_model->get($select, 
   //                                                   array_merge($where, array('department_name' => 'HCL')), array(), 
   //                                                   array('group_by' => 'melting_lot_id'));

   //  $this->get_records_by_melting_lot_id($out_weight_processes, 'out_weight');


   //  //TOUNCH DEPARTMENT TOUNCH FINE LOSS
 
   //  $tounch_department_processes = $this->process_model->get('sum(tounch_loss_fine) as weight, melting_lot_id', 
   //                                                     array_merge($where, array('tounch_purity >'=> 0, 'out_weight >'=> 0)), 
   //                                                     array(), array('group_by' => 'melting_lot_id'));
   //  $this->get_records_by_melting_lot_id($tounch_department_processes, 'tounch_fine_loss');

   //    //Tounch and castic department  LOSS
   //  if (!empty($_GET['product_name']))
   //    $where_in['where_in'] = array('department_name' =>array("'Tounch Department'","'Castic Process'"));
    
   //  $tounch_castic_department_processes = $this->process_model->get('sum(loss * out_purity / 100) as weight, melting_lot_id', 
   //                                                     array_merge($where,$where_in, array('out_weight <'=> 100)), 
   //                                                     array(), array('group_by' => 'melting_lot_id'));
   //  $this->get_records_by_melting_lot_id($tounch_castic_department_processes, 'tounch_castic_department_loss');
    
   //  if (!empty($melting_lot_ids)){
   //    $where_condition['where_in'] = array('melting_lot_id' =>$melting_lot_ids);
   //    $where_condition['where'] = array('product_name' => 'HCL');
   //  }
   
   //  //HCL LOSS FROM HCL PROCESS
   //  $select = 'sum(hcl_loss) as hcl_loss_gross,
   //             sum(hcl_loss * in_lot_purity / 100) as hcl_loss_fine,
   //             melting_lot_id';
   //  $hcl_processes = $this->process_model->get($select,$where_condition, 
   //                                             array(), array('group_by' => 'melting_lot_id'));
   //  //echo "<pre>";print_r($hcl_processes);die;
  
   //  $this->get_records_by_melting_lot_id($hcl_processes, 'hcl_process');

   //  //HCL MELTING TOUNCH FINE LOSS
   //  if (!empty($melting_lot_ids)){
   //  $where_condition['where_in'] = array('melting_lot_id' =>$melting_lot_ids);
   //  $where_condition['where'] = array('product_name' => 'HCL',
   //                                    'tounch_purity >'=> 0,
   //                                    'melting_wastage >'=> 0,);
   // }
   //  $hcl_melting_processes = $this->process_model->get('sum(tounch_loss_fine) as weight, melting_lot_id', $where_condition, array(), array('group_by' => 'melting_lot_id'));
   //  $this->get_records_by_melting_lot_id($hcl_melting_processes, 'hcl_melting_tounch_fine_loss');
    
  }
  private function get_records_by_melting_lot_id($records, $record_type) {
    if(!empty($records)){
      foreach ($records as $index => $record){
        if (!isset($this->data['lot_reports'][$record['melting_lot_id']]))
          $this->data['lot_reports'][$record['melting_lot_id']] = array();
        $this->data['lot_reports'][$record['melting_lot_id']][$record_type] = $record;
      }      
    }
  } 
}
