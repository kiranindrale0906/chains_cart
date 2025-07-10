<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Department_loss_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->bot = new \TelegramBot\Api\BotApi('1387671982:AAGd_ke_dJoiZ_tkThtUlCrPUBTo2oNfjdc');
    $this->load->model(array('settings/loss_category_model','reports/department_loss_report_model'));
  }

  public function index(){
    $department_names=array();
    $department_names=$this->loss_category_model->get('group_concat(quote(department_name)) as department_name,name',array(),array(),array('group_by'=>'name'));
    $this->data['date']=!empty($_GET['date'])?$_GET['date']:date('Y-m-d');
    $this->data['loss_details'] = $this->model->get_daily_department_loss_details($this->data['date'],$department_names);
    $this->load->render('reports/department_loss_reports/index', $this->data);          
  }
  
  public function view($id) {
    if(!empty($_GET['access_token']) && $_GET['access_token']==API_ACCESS_TOKEN){
      $department_names=array();
      $department_names=$this->loss_category_model->get('group_concat(quote(department_name)) as department_name,name',array(),array(),array('group_by'=>'name'));

      $this->data['date']=!empty($_GET['date'])?$_GET['date']:date('Y-m-d');
      $this->data['loss_details'] = $this->model->get_daily_department_loss_details($this->data['date'],$department_names);
      $this->bot->sendMessage('620761862', date('d-m-Y',strtotime($this->data['date']))." - ".HOST." - LOSS");
      $this->bot->sendMessage('1699299372', date('d-m-Y',strtotime($this->data['date']))." ".HOST." - LOSS");
      $this->bot->sendMessage('712491427', date('d-m-Y',strtotime($this->data['date']))." ".HOST." - LOSS");
      foreach ($this->data['loss_details'] as $department_name => $department_loss) {
        if($department_loss['loss']!=0) {
            $this->bot->sendMessage('620761862', str_replace(" Loss", "", $department_name).' : '.four_decimal($department_loss['loss']));
            $this->bot->sendMessage('1699299372', str_replace(" Loss", "", $department_name).' : '.four_decimal($department_loss['loss']));
            $this->bot->sendMessage('712491427', str_replace(" Loss", "", $department_name).' : '.four_decimal($department_loss['loss']));
        }
      }
       // echo json_encode(array('data'    =>$qr_code_details,
       //                     'status'      => 'success',
       //                     'open_modal'  => FALSE));die;
    }else{
      echo json_encode(array('status'      => 'error',
                           'open_modal'  => FALSE));die;
    }
  }
}
