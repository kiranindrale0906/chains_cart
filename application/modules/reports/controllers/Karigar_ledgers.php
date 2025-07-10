<?php

defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . "modules/issue_and_receipts/controllers/Ledgers.php";

class Karigar_ledgers  extends Ledgers {
  public function __construct(){
     $this->load->model(array('processes/process_model','processes/process_field_model',
                              'daily_drawers/box_weight_model','issue_departments/issue_department_model',
                              'settings/chain_purity_model', 'settings/karigar_model'));
    parent::__construct();
  }  
  public function index() {
    // pd($this->data);
    if(empty($_GET)){
    redirect(base_url().'reports/karigar_ledgers/create'); 
    }else{
      $this->load->render('reports/karigar_ledgers/create?');    
    }
  }
  public function create() {
    $this->data['karigar'] = (isset($_GET['karigar']) ? $_GET['karigar'] : '');
    $this->data['purity'] = (isset($_GET['purity']) ? $_GET['purity'] : '');
    // $this->data['type'] = (isset($_GET['type']) ? $_GET['type'] : '');
    parent::create();
  }

  public function _get_form_data() {
    //$this->data['karigars']=get_karigars();
    $this->data['karigars'] = $this->karigar_model->get('karigar_name as name, karigar_name as id', array(), array(), array('group_by' => 'karigar_name'));
    $this->data['purity'] = $this->chain_purity_model->get('DISTINCT(lot_purity) as id,lot_purity as name',array('lot_purity >'=>0),array(),array('order_by'=>'lot_purity asc'));
    $this->data['karigar']=!empty($_GET['karigar'])?$_GET['karigar']:'';
    $this->data['hook_kdm_purity']=!empty($_GET['purity'])?$_GET['purity']:'';
    $this->data['record']['karigar']=!empty($_GET['karigar'])?$_GET['karigar']:'';
    $this->data['record']['purity']=!empty($_GET['purity'])?$_GET['purity']:'';
    
    if (!empty($this->data['karigar'])) {
      $where_for_processes = "karigar = '".$this->data['karigar']."'";
      if(!empty($this->data['hook_kdm_purity'])){
        $where_for_processes .=" AND hook_kdm_purity = ".$this->data['hook_kdm_purity']."";
      }

      $where_for_process_details = "process_details.karigar = '".$this->data['karigar']."'";
      if(!empty($this->data['hook_kdm_purity'])){
        $where_for_process_details .=" AND process_details.hook_kdm_purity = ".$this->data['hook_kdm_purity']."";
      }
    $process_detail_fields = 'processes.lot_no as lot_no,
                              daily_drawer_type as product_name, 
                              processes.department_name as issue_type, 
                              processes.out_weight as out_weight,
                              processes.daily_drawer_wastage daily_drawer_wastage,
                              processes.melting_wastage as melting_wastage,
                              processes.loss as loss,
                              process_details.hook_in - process_details.hook_out + process_details.daily_drawer_out_weight as weight, 
                              process_details.hook_kdm_purity as purity, 
                              (process_details.hook_in - process_details.hook_out + process_details.daily_drawer_out_weight) * process_details.hook_kdm_purity / 100 as fine, 
                              date(process_details.created_at) as created_date, process_details.created_at';

    $process_fields = 'lot_no as lot_no,
                       product_name as product_name, 
                       process_name as issue_type,
                       daily_drawer_in_weight as weight, 
                       in_weight,
                       hook_kdm_purity as purity, 
                       daily_drawer_in_weight * hook_kdm_purity / 100 as fine, 
                       date(created_at) as created_date, created_at';

    $query = $this->db->query("select ".$process_fields." from processes 
                               where daily_drawer_in_weight > 0 AND
                                     ".$where_for_processes."
                               order by created_at asc;");
    $receipts = $query->result_array();

   
      $query = $this->db->query("select ".$process_detail_fields." from process_details 
                               inner join processes on process_details.process_id = processes.id
                               where ".$where_for_process_details."
                                     AND (process_details.hook_in > 0 
                                          OR process_details.hook_out > 0 
                                          OR process_details.daily_drawer_out_weight > 0)
                               order by created_at asc;");


    

    $issues = $query->result_array();

    $issue_created_dates = array_column($issues, 'created_date');
    $receipt_created_dates = array_column($receipts, 'created_date');
    $this->data['created_dates'] = array_values(array_unique(array_merge($issue_created_dates, $receipt_created_dates)));
    asort($this->data['created_dates']);
    
    $this->data['receipts'] = parent::get_records_by_created_date($receipts);
    $this->data['issues'] = parent::get_records_by_created_date($issues);

    $this->data['total'] = array();

    parent::get_total_by_created_date($this->data['issues'], 'issue');


    parent::get_total_by_created_date($this->data['receipts'], 'receipt');

    parent::set_index_for_dates();

    parent::get_balance_by_created_date();
    // pd($this->data);

  }
  }
}

//   private function wastage_records(){

//     if(!empty($_GET['karigar'])){
//       $in_where['daily_drawer_in_weight>']=0;
//       $in_where['karigar']=$_GET['karigar'];
//       if(!empty($_GET['purity'])){
//         $in_where['hook_kdm_purity']=$_GET['purity'];
//       }
//     $karigar_ledger_ins = $this->process_model->get('sum(daily_drawer_in_weight) as weight, 
//                                                    FORMAT(hook_kdm_purity,4) as hook_kdm_purity, 
//                                                    karigar, 
//                                                    process_name as daily_drawer_type',
                                                   
//                                                    $in_where, array(),
//                                                    array('group_by'=>'hook_kdm_purity, karigar, process_name'));
//     $this->set_daily_drawer_array('in', $karigar_ledger_ins);

//       $out_where['where']['hook_in>']=0;
//       $out_where['where']['karigar']=$_GET['karigar'];
//       $out_where['or_where']['hook_out>']=0;
//       $out_where['or_where']['daily_drawer_out_weight>']=0;
//       if(!empty($_GET['purity'])){
//         $out_where['hook_kdm_purity']=$_GET['purity'];
//       }
//     $karigar_ledger_outs = $this->process_field_model->get('sum(hook_in-hook_out+daily_drawer_out_weight) as weight,
//                                                           FORMAT(hook_kdm_purity,4) as hook_kdm_purity,
//                                                           karigar,
//                                                           daily_drawer_type',
//                                                           $out_where,
//                                                           array(),
//                                                           array('group_by'=>'hook_kdm_purity,karigar,daily_drawer_type'));

//     $this->set_daily_drawer_array('out', $karigar_ledger_outs);

    
//     $box_weight_where['where']['weight>']=0;
//     $box_weight_where['where']['karigar']=$_GET['karigar'];
//      if(!empty($_GET['purity'])){
//         $box_weight_where['purity']=$_GET['purity'];
//       }
//     $karigar_ledger_box_weights = $this->box_weight_model->get('sum(weight) as weight,
//                                                           FORMAT(purity,4) as hook_kdm_purity,
//                                                           karigar,
//                                                           daily_drawer_type',
//                                                           $box_weight_where,
//                                                           array(),
//                                                           array('group_by'=>'purity,karigar,daily_drawer_type'));
//     $this->set_daily_drawer_array('box_weight', $karigar_ledger_box_weights);
//     $process_in_where['where']['in_weight>']=0;
//     $process_in_where['where']['karigar']=$_GET['karigar'];
//     if(!empty($_GET['purity'])){
//         $process_in_where['hook_kdm_purity']=$_GET['purity'];
//       }
//     $process_in_weights = $this->process_model->get('sum(in_weight) as weight, 
//                                                    FORMAT(hook_kdm_purity,4) as hook_kdm_purity, 
//                                                    karigar, 
//                                                    process_name as daily_drawer_type',
//                                                    $process_in_where, array(),
//                                                    array('group_by'=>'hook_kdm_purity, karigar, process_name'));
//     $this->set_daily_drawer_array('in_weight', $process_in_weights);
//     $process_out_where['where']['out_weight>']=0;
//     $process_out_where['where']['karigar']=$_GET['karigar'];
//      if(!empty($_GET['purity'])){
//         $process_out_where['hook_kdm_purity']=$_GET['purity'];
//       }
//     $process_out_weights = $this->process_model->get('sum(out_weight) as weight, 
//                                                    FORMAT(hook_kdm_purity,4) as hook_kdm_purity, 
//                                                    karigar, 
//                                                    process_name as daily_drawer_type',
//                                                    $process_out_where, array(),
//                                                    array('group_by'=>'hook_kdm_purity, karigar, process_name'));
//     $this->set_daily_drawer_array('out_weight', $process_out_weights);

//     $process_melting_wastage_where['where']['melting_wastage>']=0;
//     $process_melting_wastage_where['where']['karigar']=$_GET['karigar'];
//     if(!empty($_GET['purity'])){
//         $process_melting_wastage_where['hook_kdm_purity']=$_GET['purity'];
//       }
//     $process_melting_wastage = $this->process_model->get('sum(melting_wastage) as weight, 
//                                                    FORMAT(hook_kdm_purity,4) as hook_kdm_purity, 
//                                                    karigar, 
//                                                    process_name as daily_drawer_type',
//                                                    $process_melting_wastage_where, array(),
//                                                    array('group_by'=>'hook_kdm_purity, karigar, process_name'));
//     $this->set_daily_drawer_array('melting_wastage', $process_melting_wastage);

//     $process_daily_drawer_where['where']['daily_drawer_wastage>']=0;
//     $process_daily_drawer_where['where']['karigar']=$_GET['karigar'];
//     if(!empty($_GET['purity'])){
//         $process_daily_drawer_where['hook_kdm_purity']=$_GET['purity'];
//       }
//     $process_daily_drawer_wastage = $this->process_model->get('sum(daily_drawer_wastage) as weight, 
//                                                    FORMAT(hook_kdm_purity,4) as hook_kdm_purity, 
//                                                    karigar, 
//                                                    process_name as daily_drawer_type',
//                                                    $process_daily_drawer_where, array(),
//                                                    array('group_by'=>'hook_kdm_purity, karigar, process_name'));
//     $this->set_daily_drawer_array('daily_drawer_wastage', $process_daily_drawer_wastage);
//     $process_loss_where['where']['loss>']=0;
//     $process_loss_where['where']['karigar']=$_GET['karigar'];
//     if(!empty($_GET['purity'])){
//         $process_loss_where['hook_kdm_purity']=$_GET['purity'];
//       }
    
//     $process_loss = $this->process_model->get('sum(loss) as weight, 
//                                                    FORMAT(hook_kdm_purity,4) as hook_kdm_purity, 
//                                                    karigar, 
//                                                    process_name as daily_drawer_type',
//                                                    $process_loss_where, array(),
//                                                    array('group_by'=>'hook_kdm_purity, karigar, process_name'));
//     $this->set_daily_drawer_array('loss', $process_loss);
//    }
//   } 

//   private function set_daily_drawer_array($in_out, $karigar_ledgers) {
//     if(!empty($karigar_ledgers)){
//       foreach ($karigar_ledgers as $index => $karigar_ledger) {
        
//         $karigar_name = $karigar_ledger['karigar'];
//         $purity = $karigar_ledger['hook_kdm_purity'];      
//         $karigar_ledger_type = $karigar_ledger['daily_drawer_type'];

//         if (HOST == 'ARF') {
//           $karigar_ledger_type = 'ARF Accessories';
//         } else {
//           if ($karigar_ledger_type == 'Ball') $karigar_ledger_type = 'Hook';
//         }
//         if (!isset($this->data['karigar_daily_drawers'][$karigar_name])) 
//           $this->data['karigar_daily_drawers'][$karigar_name] = array(); 
             
//         if(!empty($_GET['purity'])){
//           if($_GET['purity']==$purity){
//             if (!isset($this->data['karigar_daily_drawers'][$karigar_name][$purity]))
//           $this->data['karigar_daily_drawers'][$karigar_name][$purity] = array();  

//         if (!isset($this->data['karigar_daily_drawers'][$karigar_name][$purity][$karigar_ledger_type])) 
//           $this->data['karigar_daily_drawers'][$karigar_name][$purity][$karigar_ledger_type] = array('in' => 0, 'out' => 0,'box_weight'=>0,'gpc_powder_out'=>0,'in_weight'=>0,'out_weight'=>0,'melting_wastage'=>0,'daily_drawer_wastage'=>0,'loss'=>0);
//           $this->data['karigar_daily_drawers'][$karigar_name][$purity][$karigar_ledger_type][$in_out] += $karigar_ledger['weight'];
//           }
//         }else{
//           if (!isset($this->data['karigar_daily_drawers'][$karigar_name][$purity]))
//           $this->data['karigar_daily_drawers'][$karigar_name][$purity] = array();  

//         if (!isset($this->data['karigar_daily_drawers'][$karigar_name][$purity][$karigar_ledger_type])) 
//           $this->data['karigar_daily_drawers'][$karigar_name][$purity][$karigar_ledger_type] = array('in' => 0, 'out' => 0,'box_weight'=>0,'gpc_powder_out'=>0,'in_weight'=>0,'out_weight'=>0,'melting_wastage'=>0,'daily_drawer_wastage'=>0,'loss'=>0);
//         $this->data['karigar_daily_drawers'][$karigar_name][$purity][$karigar_ledger_type][$in_out] += $karigar_ledger['weight'];
          
//         }
        

//       }
//     }
//   }
// }
