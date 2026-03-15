<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rolling_reports extends BaseController {
  public function __construct(){
    $this->_model = 'rolling_report_model';
    parent::__construct();
    $this->load->model(array('processes/process_model', 'processes/process_detail_model', 'settings/karigar_model', 'processes/process_out_wastage_detail_model'));
  }

  public function index(){
    $this->data['show_detail_breakup'] = isset($_GET['detail']) ? 'yes' : 'no';

    $this->data['processes'] = get_process();
    $this->data['record']['product_name'] = !empty($_GET['product_name']) ? $_GET['product_name'] : '';

    if (!empty($this->data['record']['product_name'])) {
      $this->data['record']['lot_no'] = !empty($_GET['lot_no']) ? $_GET['lot_no'] : '';

      $where_created   = array();
      $where_completed = array('gpc_out > ' => 0, 
                               'process_name not in ("Refresh Final Process", "Hook Refresh Process")'  => NULL,
                               'lot_no not like "%RF%"' => NULL);
      $where_updated   = array('process_name not in ("Refresh Final Process", "Hook Refresh Process")' => NULL);

      $where_created['process_name']   = $this->data['record']['product_name'];
      $where_completed['product_name'] = $this->data['record']['product_name'];
      $where_updated['product_name']   = $this->data['record']['product_name'];

      if(!empty($this->data['record']['lot_no'])){
        $where_created['lot_no']   = $this->data['record']['lot_no'];
        $where_completed['lot_no'] = $this->data['record']['lot_no'];
        $where_updated['lot_no']   = $this->data['record']['lot_no'];
      }

      $created_ats         = $this->melting_lot_model->get('distinct(date(created_at)) as created_at');
      $process_created_ats = $this->process_model->get('distinct(date(created_at)) as created_at');
      $completed_at        = $this->process_model->get('distinct(date(completed_at)) as completed_at');
      $updated_at          = $this->process_model->get('distinct(date(updated_at)) as updated_at');
      
      $date_melting_records         = array_column($created_ats,'created_at');
      $date_process_in_records      = array_column($process_created_ats,'created_at');
      $date_process_records         = array_column($completed_at,'completed_at');
      $date_wastage_process_records = array_column($updated_at,'updated_at');

      $date_records = array_unique(array_merge($date_melting_records,$date_process_in_records,$date_process_records,$date_wastage_process_records));
      asort($date_records);

      $this->get_process_wise_records($date_records,$this->data['record']);
    }

    $this->load->render('reports/rolling_reports/index',$this->data);  
  }

  private function get_process_wise_records($date_records){
    $strip_cutting_ids = $this->process_model->get('id', array('department_name' => 'Strip Cutting',
                                                                'product_name' => $this->data['record']['product_name']));
    $strip_cutting_ids = array_column($strip_cutting_ids, 'id');
    

    foreach ($date_records as $index => $date_report) {
      
      $year=date("Y-m",strtotime($date_report));
      $where_melting_weight_created = array('date(created_at)'=>$date_report);
      $where_created                = array('date(completed_at)'=>$date_report);
      $where_completed              = array('(`gpc_out` != 0 or repair_out != 0 )'=>null,
                                            'process_name not in ("Refresh Final Process", "Hook Refresh Process")' => NULL,
                                            'lot_no not like "%RF%"' => NULL,
                                            'date(completed_at)'=>$date_report);
      $where_updated = array('date(completed_at)'=>$date_report,
                             'process_name not in ("Refresh Final Process", "Hook Refresh Process")' => NULL,);
      
      if ($this->data['record']['product_name'] == 'Hollow Choco Chain') {
        $melting_lot_where = array('(process_name = "Hollow Choco Chain" or process_name = "Office Outside Hollow Choco Dye Process")' => NULL);
        $process_where = array('(processes.product_name = "Hollow Choco Chain" or processes.process_name = "Hollow Choco Dye Process")' => NULL);
      } elseif ($this->data['record']['product_name'] == 'Imp Italy Chain') {
        $melting_lot_where = array('(process_name = "Imp Italy Chain" or process_name = "Office Outside Imp Italy Dye Process")' => NULL);
        $process_where = array('(processes.product_name = "Imp Italy Chain" or processes.process_name = "Imp Italy Dye Process")' => NULL);
      } elseif ($this->data['record']['product_name'] == 'Choco Chain') {
        $melting_lot_where = array('(process_name = "Choco Chain" or process_name = "Office Outside Choco Dye Process")' => NULL);
        $process_where = array('(processes.product_name = "Choco Chain" or processes.process_name = "Choco Chain Dye Process")' => NULL);
      } else {
        $melting_lot_where = array('process_name' => $this->data['record']['product_name']);
        $process_where = array('processes.product_name' => $this->data['record']['product_name']);
      }

      $where_melting_weight_created = array_merge($where_melting_weight_created, $melting_lot_where);
      $where_created                = array_merge($where_created, $process_where);
      $where_completed              = array_merge($where_completed, $process_where);
      $where_updated                = array_merge($where_updated, $process_where);
    
      if(!empty($this->data['record']['lot_no'])){
        $where_melting_weight_created['lot_no'] = $this->data['record']['lot_no'];
        $where_created['lot_no']                = $this->data['record']['lot_no'];
        $where_completed['lot_no']              = $this->data['record']['lot_no'];
        $where_updated['lot_no']                = $this->data['record']['lot_no'];
      }

      $where_created['processes.product_name !=']   = 'Refresh';
      $where_completed['product_name !='] = 'Refresh';
      $where_updated['product_name !=']   = 'Refresh';

      if ($this->data['record']['product_name']=='Fancy Chain')
        $in_melting_weight = $this->melting_lot_model->find('sum(melting_lot_details.required_weight) as in_weight', 
                                                array('date(melting_lot_details.created_at)'=>$date_report, 
                                                      'melting_lots.process_name' => 'Fancy Chain'),
                                                array(array('melting_lot_details', 'melting_lots.id = melting_lot_details.melting_lot_id')))['in_weight'];
      else
        $in_melting_weight = $this->melting_lot_model->find('sum(gross_weight) as in_weight',$where_melting_weight_created)['in_weight'];

      $in_opening_weight = $this->process_model->find('sum(in_weight) as in_weight', array_merge($where_created, array('parent_id > id' => NULL)));

      if (   $this->data['record']['product_name']=='KA Chain'
          || $this->data['record']['product_name']=='Ball Chain')
        $ka_chain_to_ball_chain = $this->process_detail_model->find('sum(process_details.recutting_out) as in_weight', 
                                                                      array('processes.product_name' => 'KA Chain',
                                                                            'processes.process_name' => 'Factory Process',
                                                                            'processes.department_name' => 'Factory',
                                                                            'date(process_details.created_at)' => $date_report), 
                                                                      array(array('processes', 'processes.id = process_details.process_id')));


      if ($this->data['record']['product_name']=='KA Chain')
        $refresh_to_ka_chain_fancy = $this->process_model->find('sum(in_weight) as in_weight', 
                                                                  array('product_name' => 'KA Chain',
                                                                        'process_name' => 'Fancy Out Process',
                                                                        'department_name' => 'Fancy Out',
                                                                        'date(completed_at)' => $date_report,
                                                                        'parent_id in (select id from processes where product_name = "Refresh")' => NULL));

      $in_weight  = $this->process_model->find('sum((micro_coating + copper_in + solder_in + alloy_weight + stone_vatav)) as in_weight', $where_created)['in_weight'];
      $out_weight = $this->process_model->find('sum(gpc_out) as gpc_out, sum(repair_out) as repair_out',$where_completed);
      $wastage    = $this->process_model->find('sum(daily_drawer_in_weight) as daily_drawer_in_weight,sum(melting_wastage) as melting_wastage,sum(in_melting_wastage) as in_melting_wastage,
                                                sum(daily_drawer_wastage) as daily_drawer_wastage,sum(ghiss) as ghiss,sum(tounch_in) as tounch_in,sum(fire_tounch_in) as fire_tounch_in,
                                                sum(solder_wastage) as solder_wastage,sum(pending_ghiss) as pending_ghiss,sum(hcl_loss) as hcl_loss,sum(out_stone_vatav) as out_stone_vatav,
                                                sum(karigar_loss) as karigar_loss,sum(pending_loss) as pending_loss,sum(copper_out) as copper_out,
                                                sum(loss*wastage_purity/100) as loss,sum(out_hcl_ghiss*wastage_purity/100) as out_hcl_ghiss',
                                                $where_updated);

      $out_hcl_wastage  = $this->process_out_wastage_detail_model->find('sum(process_out_wastage_details.out_weight * processes.wastage_purity / 100) as process_out_wastage_details', 
                                array_merge($process_where, array('date(process_out_wastage_details.created_at)' => $date_report,
                                                                  'process_out_wastage_details.field_name' => 'HCL Wastage',
                                                                  'processes.product_name !=' => 'Refresh')), 
                                array(array('processes', 'processes.id=process_out_wastage_details.process_id')));

      $hook_weight  = $this->process_detail_model->find('sum((process_details.hook_in - process_details.hook_out)) as in_weight', 
                                array_merge($process_where, array('date(process_details.created_at)' => $date_report,
                                                                  'processes.product_name !=' => 'Refresh',
                                                                  'processes.process_name !=' => 'Hook Refresh Process')), array(array('processes', 'processes.id=process_details.process_id')))['in_weight'];

      if (!empty($strip_cutting_ids))
        $stripping_weight = $this->process_model->find('sum(expected_out_weight - out_weight) as weight', 
                                                       array('product_name' => 'HCL',
                                                             'out_weight > ' => 0,
                                                             'strip_cutting_process_id' => $strip_cutting_ids,
                                                             'date(completed_at)' => $date_report));

      $karigars = $this->karigar_model->get('karigar_name, hook_kdm_purity', array('chain_name' => $this->data['record']['product_name']));
      $daily_drawer_in_weight = 0;
      if (!empty($karigars)) {
        //$karigars = array_column($karigars, 'karigar_name');
        foreach ($karigars as $karigar) {
          $daily_drawer = $this->process_detail_model->find('sum(daily_drawer_in_weight - (hook_in - hook_out + daily_drawer_out_weight)) as in_weight',
                                                             array('karigar' => $karigar['karigar_name'],
                                                                   'hook_kdm_purity' => $karigar['hook_kdm_purity'],
                                                                   'date(created_at)' => $date_report));
          $daily_drawer_in_weight += @$daily_drawer['in_weight'];
        }
      }

      $this->data['rolling_records'][$year][$index]['date']=$date_report;
      $this->data['rolling_records'][$year][$index]['in_weight'] = $in_melting_weight + $in_weight + @$hook_weight + @$in_opening_weight['in_weight'] + @$stripping_weight['weight'] + @$daily_drawer_in_weight;
      $this->data['rolling_records'][$year][$index]['in_weight_details'] = array('in_melting_weight'=>$in_melting_weight,
                                                                                  'in_weight'=>$in_weight,
                                                                                  'hook_weight'=>@$hook_weight,
                                                                                  'in_opening_weight'=>@$in_opening_weight['in_weight'],
                                                                                  'stripping_weight'=>@$stripping_weight['weight'],
                                                                                  'daily_drawer'=>@$daily_drawer_in_weight);
      
      if ($this->data['record']['product_name']=='Ball Chain') $this->data['rolling_records'][$year][$index]['in_weight'] += @$ka_chain_to_ball_chain['in_weight'];

      $this->data['rolling_records'][$year][$index]['out_weight'] = $out_weight['gpc_out']+$out_weight['repair_out'];
      $this->data['rolling_records'][$year][$index]['out_weight_details'] = array('gpc_out'=>$out_weight['gpc_out'],
                                                                                  'repair_out'=>$out_weight['repair_out']);
      if ($this->data['record']['product_name']=='KA Chain') {
        $this->data['rolling_records'][$year][$index]['out_weight'] += @$ka_chain_to_ball_chain['in_weight'];
        $this->data['rolling_records'][$year][$index]['out_weight_details']['in_weight'] = @$ka_chain_to_ball_chain['in_weight'];
      }

      $this->data['rolling_records'][$year][$index]['wastage']=$wastage['daily_drawer_in_weight'] 
                                                                + $wastage['melting_wastage'] + $wastage['in_melting_wastage'] - @$refresh_to_ka_chain_fancy['in_weight']
                                                                + $wastage['daily_drawer_wastage'] + $wastage['ghiss'] + $wastage['tounch_in'] + $wastage['fire_tounch_in'] 
                                                                + $wastage['solder_wastage'] + $wastage['pending_ghiss'] + $wastage['hcl_loss'] + $wastage['out_stone_vatav'] 
                                                                + $wastage['karigar_loss'] + $wastage['pending_loss'] + $wastage['copper_out'] + $wastage['loss'] 
                                                                + $wastage['out_hcl_ghiss'] + @$out_hcl_wastage['process_out_wastage_details']; // + @$out_hcl_wastage_other_than_spring;
      $this->data['rolling_records'][$year][$index]['wastage_details'] = array('daily_drawer_in_weight'=>$wastage['daily_drawer_in_weight'],
                                                                                'melting_wastage'=>$wastage['melting_wastage'] - @$refresh_to_ka_chain_fancy['in_weight'],
                                                                                'in_melting_wastage'=>$wastage['in_melting_wastage'],
                                                                                'daily_drawer_wastage'=>$wastage['daily_drawer_wastage'],
                                                                                'ghiss'=>$wastage['ghiss'],
                                                                                'tounch_in'=>$wastage['tounch_in'],
                                                                                'fire_tounch_in'=>$wastage['fire_tounch_in'],
                                                                                'solder_wastage'=>$wastage['solder_wastage'],
                                                                                'pending_ghiss'=>$wastage['pending_ghiss'],
                                                                                'hcl_loss'=>$wastage['hcl_loss'],
                                                                                'out_stone_vatav'=>$wastage['out_stone_vatav'],
                                                                                'karigar_loss'=>$wastage['karigar_loss'],
                                                                                'pending_loss'=>$wastage['pending_loss'],
                                                                                'copper_out'=>$wastage['copper_out'],
                                                                                'loss'=>$wastage['loss'],
                                                                                'out_hcl_ghiss'=>$wastage['out_hcl_ghiss'],
                                                                                'out_hcl_wastage'=>@$out_hcl_wastage['process_out_wastage_details']);
      $this->data['rolling_records'][$year][$index]['rolling']=($in_weight!=0)?$this->data['rolling_records'][$year][$index]['out_weight']/$in_weight:$this->data['rolling_records'][$year][$index]['out_weight'];
    }
  } 
}
