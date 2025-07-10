<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Loss_report_for_accounts extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('issue_and_receipts/loss_report_for_account_model','issue_departments/issue_department_detail_model','processes/process_model'));
  }

  public function index(){
   ini_set('max_input_vars', '3000');
    ini_set('max_execution_time',0);
    $data=$data['loss_details']['loss_details']=$data['ghiss_melting_out_weights']=array();
    if(!empty($_POST['department_names']) && !empty($_POST['type']))
      $data['loss_details'] = $this->loss_report_for_account_model->get_loss_out_records($_POST);
    else
      $data['loss_details'] = $this->loss_report_for_account_model->get_loss_out_detail_records($_POST);
    
    if (!empty($_POST['issue_department_id'])){
      if(!empty($_POST['quator']))
        $record['quator']=$_POST['quator'];
      else
        $record['quator']=NULL;
      
      $process_details = $this->issue_department_detail_model->get('process_id',
                                          array('issue_department_id'=>$_POST['issue_department_id'],
                                                'quator'=>$record['quator']));
/*      $process_ids = array_column($process_details,'process_id');
      $data['ghiss_melting_out_weights'] = array();
      if (!empty($process_ids)) {
        $data['ghiss_melting_out_weights']=$this->process_model->find('sum(in_weight) as out_weight',
                                                        array('where_in'=> array('id'=>$process_ids),
                                                              'process_name' => 'Melting',
                                                              'department_name' => 'Ghiss Melting'))['out_weight'];
      }
    }*/
   $process_id_as_issue_department=array();
      foreach ($process_details as $process_detail_index => $process_detail_value) {
        $process_id_as_issue_department[$process_detail_value['issue_department_id']][]=$process_detail_value['process_id'];
      }
      $data['ghiss_melting_out_weights'] = array();
      foreach ($process_id_as_issue_department as $issue_department_id => $process_ids) {
        if (!empty($process_ids)) {
          $data['ghiss_melting_out_weights'][$issue_department_id]=$this->process_model->find('sum(in_weight) as out_weight',
                                                          array('where_in'=> array('id'=>$process_ids),
                                                                'process_name' => 'Melting',
                                                                'department_name' => 'Ghiss Melting'))['out_weight'];
        }
      }
    $data['fire_tounch_out_weights'] = array();
    foreach ($process_id_as_issue_department as $issue_department_id => $process_ids) {
      if (!empty($process_ids)) {
        $data['fire_tounch_out_weights'][$issue_department_id]=$this->process_model->find('sum(refine_loss) as out_weight',
                                                        array('where_in'=> array('id'=>$process_ids),
                                                              'process_name' => 'Fire Tounch Daily Drawer Wastage',
                                                              'department_name' => 'Fire Tounch Daily Drawer Wastage'))['out_weight'];
        }
      }
    }
    echo json_encode(array('data'    => $data,
                           'status'      => 'success',
                           'open_modal'  => FALSE));die;
  }
}
