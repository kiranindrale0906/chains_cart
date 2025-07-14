<?php
class Parent_lot_loss_model extends BaseModel{
	protected $table_name = 'processes';
	protected $id = 'id';
    public  $data = array();

  public function __construct($data=array()) {
		parent::__construct($data);
      }
  
  public function validation_rules($klass='') {
    return $rules=array();
  }
  
  public function get_parent_lot_loss($product_name,$type,$with_detail){
    $this->data['product_name'] = $product_name;
    $this->data['type'] = $type;
    $this->data['with_detail'] = $with_detail;
    $where=array();
    $where_in=array();
    $where_condition=array();
    if (!empty($this->data['product_name'])){
      if ($this->data['product_name']=='Office Outside Hollow Pipe') $this->data['product_name'] = 'Office Outside';
        if(!empty($this->data['type'])) {
          $where = array('product_name' => $this->data['product_name'], 
                     'parent_lot_name' =>$this->data['type'],
                     'parent_lot_id in (select id from parent_lots)' => NULL);
        } else {
          $where = array('product_name' => $this->data['product_name'], 
                     'parent_lot_name!=' =>'',
                     'parent_lot_id in (select id from parent_lots)' => NULL);
        }
    }
    $parent_lots = $this->process_model->get('parent_lot_id, parent_lot_name', $where, array(), array('group_by' => 'parent_lot_id, parent_lot_name'));
    $parent_lot_ids = array_column($parent_lots, 'parent_lot_id');
    $this->get_records_by_parent_lot_id($parent_lots, 'parent_lots');
      
    //(A) IN WEIGHT FROM AU+FE DEPARTMENT
    $in_weight_processes = $this->process_model->get('sum(out_weight * in_lot_purity) / sum(out_weight) as in_lot_purity,
                                                      sum(in_weight) as weight, parent_lot_id', 
                                                     array_merge($where, array('department_name' => 'Tube Forming')), array(), 
                                                     array('group_by' => 'parent_lot_id'));
    $this->get_records_by_parent_lot_id($in_weight_processes, 'in_weight');

    //(B) HOOK IN - HOOK OUT between AU+FE and HCL
    $hook_processes = $this->process_model->get('sum(hook_in-hook_out) as weight, parent_lot_id',
                                                 array_merge($where, array('out_purity !='=>100)), 
                                                 array(), array('group_by' => 'parent_lot_id'));
    $this->get_records_by_parent_lot_id($hook_processes, 'hook');
   
    //(C = A+B)

    //(D) OUT WEIGHT FROM HCL DEPARTMENT 
    //(N1 and N2) HCL DEPARTMENT HCL LOSS GROSS AND FINE
    //(HCLLOSSBAL1)
    $select = 'sum(out_weight + daily_drawer_in_weight) as out_weight, 
               sum((out_weight + daily_drawer_in_weight) * hook_kdm_purity/100) as out_weight_fine, 
               sum((out_weight + daily_drawer_in_weight) * in_lot_purity) / sum(out_weight + daily_drawer_in_weight) as out_lot_purity,
               sum(hcl_loss) as hcl_loss_gross,
               sum(hcl_loss * in_lot_purity / 100) as hcl_loss_fine,
               sum(balance_hcl_loss) as balance_hcl_loss,
               parent_lot_id';
    $out_weight_processes = $this->process_model->get($select, 
                                                     array_merge($where, array('department_name' => 'HCL')), array(), 
                                                     array('group_by' => 'parent_lot_id'));
    $this->get_records_by_parent_lot_id($out_weight_processes, 'out_weight');

    //(E) HCL MELTING OUT WEIGHT
    if (!empty($parent_lot_ids)) {
      $where_condition['where_in'] = array('parent_lot_id' =>$parent_lot_ids);
      $where_condition['where'] = array('product_name' => 'HCL',
                                        'process_name' => 'HCL Melting Process',
                                        'department_name' => 'Melting');
    }
    $hcl_melting_out_weight_processes = $this->process_model->get('sum(in_weight) as weight, 
                                                                   sum(in_weight * tounch_purity) / sum(in_weight) as tounch_purity,parent_lot_id', 
                                                     array_merge($where_condition), array(), 
                                                     array('group_by' => 'parent_lot_id'));
    $this->get_records_by_parent_lot_id($hcl_melting_out_weight_processes, 'hcl_melting_out_weight');

    //(F) AU+FE IN MELTING WASTAGE
    $au_fe_melting_wastage = $this->process_model->get('sum(melting_wastage) as melting_wastage,parent_lot_id', 
                                                     array_merge($where, array('department_name' => 'Tube Forming')), array(), 
                                                     array('group_by' => 'parent_lot_id'));
    $this->get_records_by_parent_lot_id($au_fe_melting_wastage, 'au_fe_melting_wastage');

    //(G) BULL BLOCK IN MELTING WASTAGE
    $bullblock_processes = $this->process_model->get('sum(in_melting_wastage) as weight, parent_lot_id', 
                                                     array_merge($where, array('department_name' => 'Bull Block')), array(), 
                                                     array('group_by' => 'parent_lot_id'));
    $this->get_records_by_parent_lot_id($bullblock_processes, 'bull_block_wastage');

    //(H = E+F+G)

    //(I1) LOSS between AU+FE and HCL
    $loss_weight_processes = $this->process_model->get('sum(loss * wastage_purity / 100) as weight, parent_lot_id', 
                                                       array_merge($where, array('out_purity <'=>100)), 
                                                       array(), array('group_by' => 'parent_lot_id'));
    $this->get_records_by_parent_lot_id($loss_weight_processes, 'loss_weight');
   
    //(I2) and (Q) LOSS of Tounch Department and Castic Process
    // (LOSSBAL)
    $loss_weight_processes = $this->process_model->get('sum(loss * out_purity / 100) as weight, 
                                                        sum(loss * out_purity / 100 * out_lot_purity / 100) as weight_fine, parent_lot_id,
                                                        sum(balance_loss) as balance_loss', 
                                                        array_merge($where, array('department_name' => array('Tounch Department', 'Castic Process', 'ReHCL', 'Castic'))), 
                                                        array(), array('group_by' => 'parent_lot_id'));
    $this->get_records_by_parent_lot_id($loss_weight_processes, 'castic_loss_weight');
    
    //(J) HCL GHISS
    if (   $this->data['product_name']=='Indo tally Chain'
        || $this->data['product_name']=='Imp Italy Chain'
        || $this->data['product_name']=='Hollow Choco Chain'
        || $this->data['product_name']=='Lotus Chain'
        || $this->data['product_name']=='Roco Choco Chain'
        || $this->data['product_name']=='Office Outside') {
      //$where_condition['where_in'] = array('parent_lot_id' =>$parent_lot_ids);
      $where_condition['where'] = array('product_name' => 'HCL Ghiss Out',
                                        'department_name' => 'HCL Process');
      $hcl_ghiss_processes = $this->process_model->get('sum(out_weight) as weight, parent_lot_id', 
                                                        $where_condition, array(), array('group_by' => 'parent_lot_id'));
    } else
      $hcl_ghiss_processes = $this->process_model->get('sum(hcl_ghiss * out_purity / 100) as weight, parent_lot_id', 
                                                        $where, array(), array('group_by' => 'parent_lot_id'));
   $this->get_records_by_parent_lot_id($hcl_ghiss_processes, 'hcl_ghiss');

    //(K = I1 + I2 + J)
    //(L = C - D- H - K)

    //(M1) CHAIN BALANCE
    $chain_balance = $this->process_model->get('sum(balance_gross) as weight, parent_lot_id', 
                                                array_merge($where), array(), 
                                                array('group_by' => 'parent_lot_id'));
    $this->get_records_by_parent_lot_id($chain_balance, 'chain_balance');

    //(M2) CHAIN AG BALANCE
    // if (!empty($this->data['type']))
    //   $where_rope_chain_ag_balance = array('product_name' => 'Rope Chain', 
    //                                       'department_name' => 'AG Melting',
    //                                       'parent_lot_name' => $this->data['type'],
    //                                       'where_not_in' => array('id' => "(select process_id from process_groups)"));
    // else
    //   $where_rope_chain_ag_balance = array('product_name' => 'Rope Chain', 
    //                                       'department_name' => 'AG Melting',
    //                                       'where_not_in' => array('id' => "(select process_id from process_groups)"));
    
    // if ($this->data['product_name'] == 'Rope Chain') 
    //   $rope_chain_ag_balance = $this->process_model->get('sum(out_weight) as weight, parent_lot_id', 
    //                                                       $where_rope_chain_ag_balance, array(), 
    //                                                       array('group_by' => 'parent_lot_id'));
    // else
      $rope_chain_ag_balance = array();
    $this->get_records_by_parent_lot_id($rope_chain_ag_balance, 'rope_chain_ag_balance');

    //(M) = (M1 + M2)

    //(N1 and N2) computed in (D)

    //(O1 and O2) HCL WASTAGE MELTING HCL LOSS GROSS AND FINE
    //(HCLLOSSBAL2)
    $where_condition=array();
    if (!empty($parent_lot_ids)){
      $where_condition['parent_lot_id'] = $parent_lot_ids;
    }
    $where_condition['product_name'] = array('HCL');
    $select = 'sum(hcl_loss) as hcl_loss_gross,
               sum(hcl_loss * in_lot_purity / 100) as hcl_loss_fine,
               sum(balance_hcl_loss) as balance_hcl_loss,
               parent_lot_id';
    $hcl_processes = $this->process_model->get($select, $where_condition, array(), array('group_by' => 'parent_lot_id'));
    $this->get_records_by_parent_lot_id($hcl_processes, 'hcl_process');
   
    //(P1 and P2) HCL GHISS MELTING HCL LOSS GROSS AND FINE
    //(HCLLOSSBAL3)
    $where_condition=array();
    if (!empty($parent_lot_ids)){
      $where_condition['parent_lot_id'] = $parent_lot_ids;
    }
    $where_condition['product_name'] = array('HCL Ghiss Out');
    $select = 'sum(hcl_loss) as hcl_loss_gross,
               sum(hcl_loss * in_lot_purity / 100) as hcl_loss_fine,
               sum(balance_hcl_loss) as balance_hcl_loss,
               parent_lot_id';
    $hcl_ghiss_processes = $this->process_model->get($select, $where_condition, array(), array('group_by' => 'parent_lot_id'));
    $this->get_records_by_parent_lot_id($hcl_ghiss_processes, 'hcl_ghiss_process');
   
    //(Q1 = N1 + O1 + P1)
    //(Q2 = N2 + O2 + P2)

    //(R) computed with I2
    
    //(S) TOUNCH DEPARTMENT TOUNCH FINE LOSS
    //(TLFBAL1)
    $tounch_department_processes = $this->process_model->get('sum(tounch_loss_fine) as weight, parent_lot_id, sum(balance_tounch_loss_fine) as balance_tounch_loss_fine', 
                                                       array_merge($where, array('department_name' => array('Tounch Department', 'Castic Process'))), 
                                                       array(), array('group_by' => 'parent_lot_id'));
    $this->get_records_by_parent_lot_id($tounch_department_processes, 'tounch_fine_loss');

    //(T) HCL MELTING TOUNCH FINE LOSS
    //(TFLBAL2)
    if (!empty($parent_lot_ids)){
      $where_condition=array();
      $where_condition['where_in'] = array('parent_lot_id' => $parent_lot_ids);
      $where_condition['where'] = array('tounch_purity >'=> 0,
                                        //'melting_wastage >'=> 0
                                        );
    }
    if (   $this->data['product_name']=='Indo tally Chain'
        || $this->data['product_name']=='Office Outside'
        || $this->data['product_name']=='Lotus Chain'
        || $this->data['product_name']=='Roco Choco Chain') 
      $where_condition['product_name'] = array('HCL', 'HCL Ghiss Out');
    else
      $where_condition['product_name'] = 'HCL';
      $hcl_melting_processes = $this->process_model->get('sum(tounch_loss_fine) as weight, parent_lot_id, sum(balance_tounch_loss_fine) as balance_tounch_loss_fine', 
                                                       $where_condition, array(), 
                                                       array('group_by' => 'parent_lot_id'));
    $this->get_records_by_parent_lot_id($hcl_melting_processes, 'hcl_melting_tounch_fine_loss');

    //(U) = (Q2) + (R) + (S) + (T)

    // (FE1) FE In from AU + FE
    $fe_in_au_fe_department = $this->process_model->get('sum(fe_in) as weight,parent_lot_id', 
                                                     array_merge($where, array('department_name' => 'AU+FE')), array(), 
                                                     array('group_by' => 'parent_lot_id'));
    $this->get_records_by_parent_lot_id($fe_in_au_fe_department, 'fe_in_au_fe_department');

    // (FE2a) FE Out from (Bull Block ,HCL),(HCL Melting),(Rope Ghiss Melting)

    $fe_out_department = $this->process_model->get('sum(fe_out) as weight,parent_lot_id', 
                                                     array_merge(array('where'=>$where),
                                                     array('where_in'=>array('department_name' => array('"Bull Block"','"HCL"')))), array(), 
                                                     array('group_by' => 'parent_lot_id'));
    $this->get_records_by_parent_lot_id($fe_out_department, 'fe_out_department');

    // (FE2b) FE Out from (HCL >> HCL Melting Process)
    if (!empty($parent_lot_ids)){
      $where_condition=array();
      $where_condition['where'] = array_merge($where,array('product_name' => 'HCL'),
                                                     array('process_name' => 'HCL Melting Process'));
      $where_condition['where_in'] = array('parent_lot_id' =>$parent_lot_ids);
    }

    $fe_out_hcl_melting_department = $this->process_model->get('sum(fe_out) as weight,parent_lot_id',$where_condition, array(),array('group_by' => 'parent_lot_id'));
    $this->get_records_by_parent_lot_id($fe_out_hcl_melting_department, 'fe_out_hcl_melting_department');

    // (FE2c) FE Out from HCL Ghiss Out >> Melting
    if (!empty($parent_lot_ids)){
      $where_fe_condition=array();
      $where_fe_condition['where'] = array_merge($where,array('product_name' => 'HCL Ghiss Out'),
                                                     array('process_name' => 'Melting'));
      $where_fe_condition['where_in'] = array('parent_lot_id' =>$parent_lot_ids);
    }
    $fe_out_rope_ghiss_melting_department = $this->process_model->get('sum(fe_out) as weight,parent_lot_id',
                                                                      $where_fe_condition, array(), array('group_by' => 'parent_lot_id'));

    // (FE2d) FE Out from AU+FE
    $fe_out_au_fe_department = $this->process_model->get('sum(wastage_fe) as weight,parent_lot_id', 
                                                     array_merge($where, array('department_name' => 'AU+FE')), array(), 
                                                     array('group_by' => 'parent_lot_id'));
    $this->get_records_by_parent_lot_id($fe_out_au_fe_department, 'fe_out_au_fe_department');

    $this->get_records_by_parent_lot_id($fe_out_rope_ghiss_melting_department, 'fe_out_rope_ghiss_melting_department');
    
    // (HCLW1) HCL Wastage Balance 
    $hcl_wastage_balance= $this->process_model->get('sum(balance_hcl_wastage) as weight, parent_lot_id',$where, array(),array('group_by' => 'parent_lot_id'));
    $this->get_records_by_parent_lot_id($hcl_wastage_balance, 'hcl_wastage_balance');


    // (HCLW2) HCL Melting Process >> HCL Process department Balance 
    $hcl_wastage_melting_process_balance= $this->process_model->get('sum(balance) as weight, parent_lot_id', 
                                                                    array('department_name' => 'HCL Process',
                                                                          'process_name' => 'HCL Melting Process',
                                                                          'parent_lot_id' => $parent_lot_ids), array(),array('group_by' => 'parent_lot_id'));
    $this->get_records_by_parent_lot_id($hcl_wastage_melting_process_balance, 'hcl_wastage_melting_process_balance');
    
    // (HCLW3) Rope Ghiss Balance 
    $rope_ghiss_balance= $this->process_model->get('sum(balance_hcl_ghiss) as weight,parent_lot_id',$where, array(),array('group_by' => 'parent_lot_id'));
    $this->get_records_by_parent_lot_id($rope_ghiss_balance, 'rope_ghiss_balance');

    // (HCLW4) Rope Ghiss Melting Process Balance
    $rope_ghiss_melting_process_balance= $this->process_model->get('sum(balance) as weight,parent_lot_id', 
                                                                    array('product_name' => 'HCL Ghiss Out',
                                                                          'process_name' => 'Melting',
                                                                          'department_name' => 'HCL Process',
                                                                          'parent_lot_id' => $parent_lot_ids), array(), array('group_by' => 'parent_lot_id'));
    $this->get_records_by_parent_lot_id($rope_ghiss_melting_process_balance, 'rope_ghiss_melting_process_balance');
    return $this->data['lot_loss_records'];
  }
  
  private function get_records_by_parent_lot_id($records, $record_type) {
    if(!empty($records)){
      foreach ($records as $index => $record){
        if (!isset($this->data['lot_loss_records'][$record['parent_lot_id']]))
          $this->data['lot_loss_records'][$record['parent_lot_id']] = array();
        $this->data['lot_loss_records'][$record['parent_lot_id']][$record_type] = $record;
      }      
    }
  }
}