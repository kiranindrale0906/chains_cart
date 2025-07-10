<?php
class Hallmark_receipts extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('users/account_model','processes/process_archive_model','processes/process_model','issue_departments/issue_department_detail_model','processes/process_out_wastage_detail_model'));
  }
  public function store() {
    $this->data['validation_klass'] = 'store';
    parent::store();
  }

  public function _after_save($formdata, $action){
    $this->data['redirect_url']= ADMIN_PATH.'receipt_departments/hallmark_receipts';
    return $formdata;
  }
  public function _get_view_data() {
    $this->data['processes'] =array();
    $this->data['account'] = $this->account_model->find('', array('id' => $this->data['record']['id']));
//pd($this->data['record']);  
  $this->data['issue_department_details'] = $this->issue_department_detail_model->get('',
                                    array('issue_department_id in ('.$this->data['record']['factory_issue_department_id'].')' => NULL));
//    pd($this->data['issue_department_details']);
    if(!empty($this->data['issue_department_details'])){
    $process_ids = array_column($this->data['issue_department_details'], 'process_id');
    }else{$this->data['issue_department_details']=array();}
 
    $where=array();
    if(!empty($process_ids)){
      $where=array('where_in' => array('id' => $process_ids));
    }
    $this->data['processes'] = $this->process_model->get('',$where);
//    pd($this->data['processes']);

    foreach($this->data['processes'] as $processe){
      $parent_ids = array();
      $this->data['wastages'] =array();
      if($processe['product_name'] == 'Daily Drawer' && $processe['process_name'] == 'Melting'){
        $parent_ids[] = $processe['parent_id'];
        if(!empty($process_ids)){
          $where=array('where_in' => array('parent_id' => $parent_ids));
        }
          $process_out_wastage_details = $this->process_out_wastage_detail_model->get('id, process_id',$where);
          $process_ids = array_column($process_out_wastage_details, 'process_id');
        if(!empty($process_ids)){
          $where=array('where_in' => array('parent_id' => $parent_ids));
          $this->data['wastages'] = $this->process_model->get('',array('where_in' => array('id' => $process_ids)));
        }
      }
    }
  }
}
