<?php
include_once APPPATH . "modules/issue_and_receipts/controllers/Ledgers.php";
class Department_wise_ghiss_ledgers extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('processes/process_out_wastage_detail_model'));
  }

  public function index() {
    redirect(base_url().'issue_and_receipts/department_wise_ghiss_ledgers/create');
  }

  public function _get_form_data() {
    $this->data['record']['department_name']=!empty($_GET['department_name'])?$_GET['department_name']:"";
    $this->data['start_date']  = (!empty($_GET['start_date'])) ? date('Y-m-d',strtotime($_GET['start_date'])) : '';
    $this->data['end_date'] = (!empty($_GET['end_date'])) ? date('Y-m-d',strtotime($_GET['end_date'])) :'';
    $this->data['department_names'] = get_ghiss_department();
    if(!empty($_GET['department_name'])){
      $department_name=explode(',',$_GET['department_name']);
      $where['where'] = array('out_ghiss>'=>0,
                              'wastage_purity >' => 0,
                              'wastage_lot_purity >' => 0);

      $where['where_in'] =array('department_name'=>'"'.implode('", "', $department_name).'"') ;
      $processes= $this->process_model->get('id,department_name', $where);
      $process_id=array_column($processes,'id');
      if(!empty($process_id)){
      $process_out_wastage_details= $this->process_out_wastage_detail_model->get('distinct(parent_id) as parent_id',array('where'=>array('field_name'=>'Ghiss Out'),
                          'where_in'=>array('process_id'=>$process_id)));

      $parent_id=array_column($process_out_wastage_details,'parent_id');
      $processes= $this->process_model->get('id', array('where_in'=>array('parent_id'=>$parent_id)));
      $parent_processes= $this->process_model->get('id', array('where_in'=>array('id'=>$parent_id)));
      $processes_id=array_column($processes,'id');
      $parent_processes_id=array_column($parent_processes,'id');
      $parent_id=array_merge($parent_id,$processes_id,$parent_processes_id);
      }

      if(!empty($parent_id)){
       $where=array('where_in'=>array('id'=>$parent_id));
       if (!empty($this->data['start_date'])) {
        $where['where']=array('date(completed_at) >='=>$this->data['start_date'],'date(completed_at) <='=>$this->data['end_date']);
      } 
      $this->data['processes'] = $this->process_model->get('', $where);
      }
        
    }

   // $this->data['department_names'] = get_ghiss_department();
   //  if (!empty($this->data['record']['department_name'])) {
   //    $department_name=explode(',', $this->data['record']['department_name']);
   //    $where['where'] = array('product_name'=>'Ghiss Out',
   //                            'department_name'=>'Melting',
   //                            'wastage_purity >' => 0,
   //                            'wastage_lot_purity >' => 0);
   //    $where['where_in'] =array('department_name'=>'"'.implode('", "', $department_name).'"') ;
   //    $this->data['processes'] = $this->process_model->get('', $where);
    
  }
}
   //  $process_fields = 'lot_no as lot_no,
   //                     product_name as product_name, 
   //                     department_name as issue_type,
   //                     in_weight as weight, 
   //                     in_lot_purity as purity, 
   //                     (in_weight * in_lot_purity) / 100 as fine, 
   //                     date(created_at) as created_date, created_at';

   //  $process_out_wastage_detail_fields = 'lot_no as lot_no,
   //                     product_name as product_name, 
   //                     department_name as issue_type,
   //                     melting_wastage as weight, 
   //                     out_lot_purity as purity, 
   //                     (melting_wastage * out_lot_purity )/ 100 as fine, 
   //                     date(created_at) as created_date, created_at';


   // $issue_where="where processes.product_name='Ghiss Out' and processes.process_name='Melting' and melting_wastage>0 ";
   
   //  $query = $this->db->query("select ".$process_out_wastage_detail_fields." from processes 
   //                             ".$issue_where."
   //                             order by created_at asc;");

   //  $issues = $query->result_array();

   //  $receipts_where="where processes.product_name='Ghiss Out' and processes.process_name='Melting' and in_weight>0 ";
     
   //  $query = $this->db->query("select ".$process_fields." from processes 
   //                             ".$receipts_where."
   //                             order by created_at asc;");
   //  $receipts = $query->result_array();

   //  $issue_created_dates = array_column($issues, 'created_date');
   //  $receipt_created_dates = array_column($receipts, 'created_date');
   //  $this->data['created_dates'] = array_values(array_unique(array_merge($issue_created_dates, $receipt_created_dates)));
   //  asort($this->data['created_dates']);
    
   //  $this->data['receipts'] = parent::get_records_by_created_date($receipts);
   //  $this->data['issues'] = parent::get_records_by_created_date($issues);


   //  if (!isset($_GET['do_no_remove_duplicate']))
   //    parent::remove_receipt_issue_matching_records();

   //  $this->data['total'] = array();

   //  parent::get_total_by_created_date($this->data['issues'], 'issue');

   //  parent::get_total_by_created_date($this->data['receipts'], 'receipt');

   //  parent::set_index_for_dates();

   //  parent::get_balance_by_created_date();
  // }
// }