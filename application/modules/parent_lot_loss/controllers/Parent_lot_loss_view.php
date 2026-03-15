<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parent_lot_loss_view extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('melting_lots/melting_lot_model', 'processes/process_model',
                             'rope_chains/rope_chain_final_process_model'));
  }
   public function index() { 
    $this->data['lot_loss_records'] = array();
    $this->data['process_name']=get_melting_lot_process();
    $this->data['column_name']=!empty($_GET['column_name'])?$_GET['column_name']:'';
    if (!empty($_GET['product_name']))
    $this->get_lot_loss();
    $this->load->render('parent_lot_loss/parent_lot_loss_view/index', $this->data);    
  }

  private function get_lot_loss(){
    $this->data['column_name'] = @$_GET['column_name'];
    $this->data['type'] = @$_GET['type'];
    $where=array();
    $where_in=array();
    $where_condition=array();
    if (!empty($_GET['product_name'])){
      $where = array('product_name' => str_replace('_',' ',$_GET['product_name']),
                     'parent_lot_id'=>$_GET['lot_id']);
    }

    // $melting_lots = $this->process_model->get('melting_lot_id, lot_no', $where, 
    //                                          array(), array('group_by' => 'melting_lot_id, lot_no'));
    // $melting_lot_ids = array_column($melting_lots, 'melting_lot_id');
    // $this->get_records_melting_lots($melting_lots, 'melting_lots');
      
    //IN WEIGHT = OUT WEIGHT + LOSS FROM AU+FE
    if($_GET['column_name']=='in_weight'){
      $in_weight_processes = $this->process_model->get('(out_weight * in_lot_purity / out_weight) as in_lot_purity, 
                                                        (in_weight) as weight,
                                                        parent_lot_id, lot_no, parent_lot_name, process_name, department_name', 
                                                     array_merge($where, array('department_name' => 'AU+FE')));
      $this->get_records_melting_lots($in_weight_processes, 'in_weight');
    }
    
    //HOOK IN - HOOK OUT between AU+FE and HCL
    if($_GET['column_name']=='hook'){
      $hook_processes = $this->process_model->get('(hook_in-hook_out) as weight, parent_lot_id,lot_no,parent_lot_name,process_name,department_name',
                                                   array_merge($where, array('out_purity !='=>100,
                                                    '(hook_in-hook_out)!='=>0)));
      $this->get_records_melting_lots($hook_processes, 'hook');
    }

    if($_GET['column_name']=='hcl_wastage'){
      $hcl_wastage_processes = $this->process_model->get('(hcl_wastage * out_purity / 100) as weight, 
                                                          parent_lot_id,lot_no,parent_lot_name,process_name,department_name',   
                                                          array_merge($where, array('(hcl_wastage * out_purity / 100)>'=>0)));
      $this->get_records_melting_lots($hcl_wastage_processes, 'hcl_wastage');
    }
   
    //(I1) LOSS between AU+FE and HCL
    if($_GET['column_name']=='loss_weight'){
      $loss_weight_processes = $this->process_model->get('(loss * wastage_purity / 100) as weight, 
                                                          parent_lot_id,lot_no,parent_lot_name,process_name,department_name', 
                                                          array_merge($where, array('out_purity <'=>100,'(loss * out_purity / 100)!='=>0)));
      $this->get_records_melting_lots($loss_weight_processes, 'loss_weight');
    }
   
    //(I2) LOSS in Tounch Department and Castic Process
    if($_GET['column_name']=='castic_loss_weight'){
      $loss_weight_processes = $this->process_model->get('(loss * out_purity / 100) as weight, 
                                                          parent_lot_id,lot_no,parent_lot_name,process_name,department_name', 
                                                      array_merge($where, array('department_name' => array('Tounch Department', 'Castic Process', 'Castic'),
                                                                                    '(loss * out_purity / 100)!='=>0)));
      $this->get_records_melting_lots($loss_weight_processes, 'castic_loss_weight');
    }


    //Bull Block Au out
    if($_GET['column_name']=='bull_block_wastage'){
      $bull_block_processes = $this->process_model->get('(in_melting_wastage) as  weight, 
                                                         parent_lot_id, parent_lot_id, lot_no, parent_lot_name, process_name, department_name', 
                                                     array_merge($where, array('department_name' => 'Bull Block','in_melting_wastage!='=>0)), array());
      $this->get_records_melting_lots($bull_block_processes, 'bull_block_wastage');
    }

    if($_GET['column_name']=='hcl_melting_out_weight') {    
    //hcl melting process
      $hcl_melting_out_weight_processes = $this->process_model->get('(in_weight) as weight,(tounch_purity) as tounch_purity,
                                                                     parent_lot_id,parent_lot_id,lot_no,parent_lot_name,process_name,department_name', 
                                                     array('product_name' => 'HCL',
                                                           'process_name' => 'HCL Melting Process',
                                                           'department_name' => 'Melting',
                                                           'parent_lot_id' =>$_GET['lot_id']), array());
      $this->get_records_melting_lots($hcl_melting_out_weight_processes, 'hcl_melting_out_weight');
    }

    //Au FE Melting wastage
    if($_GET['column_name']=='au_fe_melting_wastage'){
      $au_fe_melting_wastage = $this->process_model->get('(in_melting_wastage) as weight,
                                                          parent_lot_id,lot_no,parent_lot_name,process_name,department_name',
                                                     array_merge($where, array('department_name' => 'AU+FE', 'in_melting_wastage!='=>0)), array());
      $this->get_records_melting_lots($au_fe_melting_wastage, 'au_fe_melting_wastage');
    }
    
    if($_GET['column_name']=='balance_gross'){
      $in_weight_processes = $this->process_model->get('(out_weight * in_lot_purity / out_weight) as in_lot_purity, 
                                                        (balance_gross) as weight,
                                                        parent_lot_id, lot_no, parent_lot_name, process_name, department_name', 
                                                     array_merge($where, array('balance_gross !=' => 0)));
      $this->get_records_melting_lots($in_weight_processes, 'balance_gross');
    }
    
    if($_GET['column_name']=='ag_balance_gross'){
      $in_weight_processes = $this->process_model->get('(out_weight * in_lot_purity / out_weight) as in_lot_purity, 
                                                        (out_weight) as weight,
                                                        parent_lot_id, lot_no, parent_lot_name, process_name, department_name', 
                                                     array_merge($where, array('product_name' => 'Rope Chain',
                                                                               'department_name' => 'AG Melting',
                                                                'where_not_in' => array('id' => "(select process_id from process_groups)"))));
      $this->get_records_melting_lots($in_weight_processes, 'ag_balance_gross');
    }

    //TOUNCH IN between AU+FE and HCL
    if($_GET['column_name']=='tounch_weight'){
      $tounch_processes = $this->process_model->get('(tounch_in) as weight, parent_lot_id,lot_no,parent_lot_name,process_name,department_name', 
                                                       array_merge($where, array('out_purity <'=>100,'tounch_in !='=>0)));
      $this->get_records_melting_lots($tounch_processes, 'tounch_weight');
    }

    //(J) HCL GHISS
    if($_GET['column_name']=='hcl_ghiss'){
      if (   $_GET['product_name']=='Indo_tally_Chain'
          || $_GET['product_name']=='Office_Outside' ) {

        //$where_condition['where_in'] = array('parent_lot_id' =>$parent_lot_ids);
        $where_condition['where'] = array('product_name' => 'HCL Ghiss Out',
                                          'department_name' => 'HCL Process',
                                          'parent_lot_id' => $_GET['lot_id']);
        $hcl_ghiss_processes = $this->process_model->get('out_weight as weight, parent_lot_id, lot_no, parent_lot_name, process_name, department_name',  
                                                          $where_condition);
      } else
        $hcl_ghiss_processes = $this->process_model->get('(hcl_ghiss * out_purity / 100) as weight, 
                                                          parent_lot_id,lot_no,parent_lot_name,process_name,department_name', 
                                                          array_merge($where,array('(hcl_ghiss * out_purity / 100)!='=>0)));
      $this->get_records_melting_lots($hcl_ghiss_processes, 'hcl_ghiss');
    }

    if($_GET['column_name']=='out_weight' || $_GET['column_name']=='chain_hcl_loss_gross'|| $_GET['column_name']=='chain_hcl_loss_fine'){
      $select = 'parent_lot_id,lot_no,parent_lot_name,process_name,department_name,';
      if($_GET['type']=='hcl_loss_gross'){
        $select .= '(hcl_loss) as weight, out_weight, expected_out_weight';
        $where['hcl_loss!=']=0;
      }
    
      if($_GET['type']=='hcl_loss_fine'){
        $select .= ' (hcl_loss * in_lot_purity / 100) as weight, (out_weight * in_lot_purity / 100) as out_weight, (expected_out_weight * in_lot_purity / 100) as expected_out_weight';
        $where['(hcl_loss * in_lot_purity / 100)!=']=0;
      }

      if($_GET['type']=='out_weight'){
        $select .= '(out_weight) as weight';
        $where['out_weight!=']=0;
      }
    
      $out_weight_processes = $this->process_model->get($select, array_merge($where, array('department_name' => 'HCL')));
      $this->get_records_melting_lots($out_weight_processes, 'out_weight');
    }

    //TOUNCH DEPARTMENT TOUNCH FINE LOSS
    if($_GET['column_name']=='tounch_fine_loss'){
      $tounch_department_processes = $this->process_model->get('(tounch_loss_fine) as weight, 
                                                                parent_lot_id,lot_no,parent_lot_name,process_name,department_name', 
                                                                array_merge($where, array('tounch_loss_fine!='=>0, 
                                                                                          'department_name' => array('Tounch Department', 'Castic Process'))));
      $this->get_records_melting_lots($tounch_department_processes, 'tounch_fine_loss');
    }
    
    //Tounch and castic department  LOSS
    if($_GET['column_name']=='tounch_castic_department_loss'){
      if (!empty($_GET['product_name'])){
        $where_in['where_in'] = array('department_name' =>array("'Tounch Department'","'Castic Process'"));
      }
      $tounch_castic_department_processes = $this->process_model->get('(loss * out_purity / 100) as weight, 
                                                                      parent_lot_id,lot_no,parent_lot_name,process_name,department_name',
                                                                      array_merge($where,$where_in, array('out_weight >'=> 0,
                                                                                                          '(loss * out_purity / 100)!='=>0)));
      $this->get_records_melting_lots($tounch_castic_department_processes, 'tounch_castic_department_loss');
    }

    //HCL LOSS FROM HCL PROCESS
    if($_GET['column_name']=='hcl_process' ){
      $select='parent_lot_id,lot_no,parent_lot_name,process_name,department_name,';
      if($_GET['type']=='hcl_loss_gross')
        $select .= '(hcl_loss) as weight, out_weight, expected_out_weight';
      
      if($_GET['type']=='hcl_loss_fine')
        $select .= ' (hcl_loss * in_lot_purity / 100) as weight, (out_weight * in_lot_purity / 100) as out_weight, (expected_out_weight * in_lot_purity / 100) as expected_out_weight';

      $hcl_processes = $this->process_model->get($select, array('product_name' => 'HCL',
                                                                'parent_lot_id' =>$_GET['lot_id'],
                                                                'hcl_loss != ' => 0));
      $this->get_records_melting_lots($hcl_processes, 'hcl_process');
    }

    //HCL LOSS FROM HCL GHISS OUT
    if($_GET['column_name']=='hcl_ghiss_process' ){
      $select='parent_lot_id,lot_no,parent_lot_name,process_name,department_name,';
      if($_GET['type']=='hcl_loss_gross')
        $select .= '(hcl_loss) as weight, out_weight, expected_out_weight';
      
      if($_GET['type']=='hcl_loss_fine')
        $select .= ' (hcl_loss * in_lot_purity / 100) as weight, (out_weight * in_lot_purity / 100) as out_weight, (expected_out_weight * in_lot_purity / 100) as expected_out_weight';

      $hcl_ghiss_processes = $this->process_model->get($select, array('product_name' => 'HCL Ghiss Out',
                                                                      'parent_lot_id' =>$_GET['lot_id'],
                                                                      'hcl_loss != ' => 0));
      $this->get_records_melting_lots($hcl_ghiss_processes, 'hcl_ghiss_process');
    }
    
    //HCL MELTING TOUNCH FINE LOSS
    if($_GET['column_name']=='hcl_melting_tounch_fine_loss'){
      if (   $_GET['product_name']=='Indo_tally_Chain'
          || $_GET['product_name']=='Office_Outside') 
        $product_name = array('HCL', 'HCL Ghiss Out');
      else
        $product_name = 'HCL';
      
      $hcl_melting_processes = $this->process_model->get('(tounch_loss_fine) as weight, 
                                                          parent_lot_id,lot_no,parent_lot_name,process_name,department_name', 
                                                          array('product_name' => $product_name,
                                                                'tounch_purity >'=> 0, 
                                                                //'melting_wastage >'=> 0,
                                                                'parent_lot_id' =>$_GET['lot_id']));
      $this->get_records_melting_lots($hcl_melting_processes, 'hcl_melting_tounch_fine_loss');
    }

    //(Q) LOSS FINE in Tounch Department and Castic Process
    if($_GET['column_name']=='castic_loss_fine'){
      $loss_weight_processes = $this->process_model->get('(loss * out_purity / 100 * out_lot_purity / 100) as weight, 
                                                          parent_lot_id,lot_no,parent_lot_name,process_name,department_name', 
                                                          array_merge($where, array('department_name' => array('Tounch Department', 'Castic Process', 'ReHCL'),
                                                                                    '(loss * out_purity / 100)!='=>0)));
      $this->get_records_melting_lots($loss_weight_processes, 'castic_loss_fine');
    }
   
  }

  private function get_records_melting_lots($records, $record_type,$melting_lot_id='') {
    if(!empty($records)){
      $this->data['lot_loss_records'] = array();
      $this->data['lot_loss_records'][$record_type] = $records;
    }        
  }
  
}


