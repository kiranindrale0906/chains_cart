<?php
class Api_issue_departments extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('processes/process_model',
                             'issue_departments/issue_department_model',
                             'issue_departments/issue_department_detail_model'));
  }

  public function index() {
    ini_set('max_input_vars', '3000');
    ini_set('max_execution_time',0);
    $select = 'date(issue_departments.created_at) as created_at, 
               processes.product_name,
               processes.melting_lot_category_one as category_one, 
               issue_departments.account_id as account_name,
               sum(issue_department_details.out_weight) as issue_gpc_out';
    $where = array('date(issue_departments.created_at) > ' => '2020-11-14');


    $group_by = 'processes.product_name, processes.melting_lot_category_one, issue_departments.account_id'; 

    if (isset($_POST['product_name']) && !empty($_POST['product_name'])) $where['processes.product_name']             = $_POST['product_name'];
    if (isset($_POST['in_purity'])    && !empty($_POST['in_purity']))    $where['issue_departments.in_purity']        = $_POST['in_purity'];
    if (isset($_POST['account_name']) && !empty($_POST['account_name'])) $where['issue_departments.account_id']       = $_POST['account_name'];
    if (isset($_POST['category_one']) && !empty($_POST['category_one'])) $where['processes.melting_lot_category_one'] = $_POST['category_one'];
    if (   HOST == 'ARF'
        || (isset($_POST['machine_size']) && !empty($_POST['machine_size']))) {
      $select .= ' , processes.machine_size as machine_size ';
      $group_by .= ' , processes.machine_size'; 
    }

    if (isset($_POST['machine_size']) && !empty($_POST['machine_size']))
      $where['processes.machine_size'] = $_POST['machine_size'];

    if (   HOST == 'ARF'
        || (isset($_POST['design_code'])  && !empty($_POST['design_code']))) {
      $select .= ' , processes.design_code as design_code  ';
      $group_by .= ' , processes.design_code'; 
    }

    if (isset($_POST['design_code'])  && !empty($_POST['design_code'])) 
      if (   isset($_POST['product_name']) && !empty($_POST['product_name'])
        && $_POST['product_name']=='Indo tally Chain')
        $where['processes.design_code_type'] = $_POST['design_code_type'];
      else
        $where['processes.design_code'] = $_POST['design_code'];
    
    if(!empty($_POST['group_by'])&&$_POST['group_by']=='Week') {

      $period_from_date = 'DATE_SUB(
                                DATE_ADD(MAKEDATE(date_format(issue_departments.created_at,"%Y"), 1), INTERVAL week(issue_departments.created_at) WEEK),
                                INTERVAL WEEKDAY(
                                   DATE_ADD(MAKEDATE(date_format(issue_departments.created_at,"%Y"), 1), INTERVAL week(issue_departments.created_at) WEEK)
                                ) -1 DAY)';
      $period_to_date = 'DATE_SUB(
                                DATE_ADD(MAKEDATE(date_format(issue_departments.created_at,"%Y"), 1), INTERVAL week(issue_departments.created_at) WEEK),
                                INTERVAL WEEKDAY(
                                   DATE_ADD(MAKEDATE(date_format(issue_departments.created_at,"%Y"), 1), INTERVAL week(issue_departments.created_at) WEEK)
                                ) -7 DAY)';
      $period_select = 'CONCAT('.$period_from_date.' , " - ", '.$period_to_date.')';
      $select .= ' , '.$period_select.' as str_created_date';
   
    }else{
      $select .= ' , issue_departments.created_at as str_created_date';
    }
    
    if (isset($_POST['start_date']))
      $where['issue_departments.created_at > '] = $_POST['start_date']; 
    
    if (isset($_POST['filter_month']))
      $where['MONTH(issue_departments.created_at)'] = $_POST['filter_month']; 
    
    if (isset($_POST['filter_year']))
      $where['YEAR(issue_departments.created_at)'] = $_POST['filter_year']; 
    
    $select .= ' , issue_departments.in_purity as in_purity, 
                   issue_departments.out_purity as out_purity';
    $group_by .= ' , date(issue_departments.created_at), issue_departments.in_purity, issue_departments.out_purity';
    
    if (isset($_GET['issue_at']) && !empty($_GET['issue_at'])) {
      $where['date(issue_departments.created_at)']         = $_GET['issue_at'];
      $group_by = 'product_name';
    }
               
    $records = $this->issue_department_model->get($select, 
                                  array_merge($where, array('issue_departments.product_name' => array('GPC Out', 'Repair Out', 'Finish Good'))),
                                  array(array('issue_department_details', 'issue_department_details.issue_department_id = issue_departments.id'),
                                        array('processes', 'issue_department_details.process_id = processes.id')),
                                  array('group_by' => $group_by,
                                        'order_by' => 'date(issue_departments.created_at), processes.product_name'));
    echo(json_encode(array('data' => $records)));
    die();
  }

  public function create() {
    if (   isset($_POST['product_name']) && !empty($_POST['product_name'])
        && $_POST['product_name']=='Indo tally Chain')
      $data = array('product_names' => $this->get_distinct_values('processes.product_name'),
                    'category_ones' => $this->get_distinct_values('processes.melting_lot_category_one'),
                    'machine_sizes' => $this->get_distinct_values('processes.machine_size'),
                    'design_codes'  => $this->get_distinct_values('processes.design_code_type'),
                    'in_purities'   => $this->get_distinct_values('issue_departments.in_purity'),
                    'account_names' => $this->get_distinct_values('issue_departments.account_id'));
    else
      $data = array('product_names' => $this->get_distinct_values('processes.product_name'),
                    'category_ones' => $this->get_distinct_values('processes.melting_lot_category_one'),
                    'machine_sizes' => $this->get_distinct_values('processes.machine_size'),
                    'design_codes'  => $this->get_distinct_values('processes.design_code'),
                    'in_purities'   => $this->get_distinct_values('issue_departments.in_purity'),
                    'account_names' => $this->get_distinct_values('issue_departments.account_id'));
    echo json_encode($data);
    die();
  }  

  private function get_distinct_values($column) {
    $where = array('issue_departments.product_name' => array('GPC Out'));
    if ($column != 'processes.product_name') {
      if (isset($_POST['product_name']) && !empty($_POST['product_name'])) $where['processes.product_name']             = $_POST['product_name'];
      if (isset($_POST['in_purity'])    && !empty($_POST['in_purity']))    $where['issue_departments.in_purity']        = $_POST['in_purity'];
      //if (isset($_POST['account_name']) && !empty($_POST['account_name'])) $where['issue_departments.account_id']       = $_POST['account_name'];
      if (isset($_POST['category_one']) && !empty($_POST['category_one'])) $where['processes.melting_lot_category_one'] = $_POST['category_one'];
      if (isset($_POST['machine_size']) && !empty($_POST['machine_size'])) $where['processes.machine_size']             = $_POST['machine_size'];

      if (isset($_POST['start_date'])) $where['issue_departments.created_at > '] = $_POST['start_date'];
    }

    $records = $this->issue_department_model->get('distinct('.$column.') as names', $where,
                                                  array(array('issue_department_details', 'issue_department_details.issue_department_id = issue_departments.id'),
                                                        array('processes', 'issue_department_details.process_id = processes.id')),
                                                  array('order_by' => $column));
    return !empty($records) ? array_column($records, 'names') : array();
  }
}
