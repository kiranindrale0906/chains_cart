<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Karigar_out_dashboards extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('processes/process_model'));
 		
  }

  public function index() {
    $query_string = $_SERVER['QUERY_STRING'];
    parse_str($query_string,$_GET);
   
    $completed_at['completed_at >='] = !empty($_GET['date']['completed_at'])?date("Y-m-d H:m:i",strtotime($_GET['date']['completed_at']." 00:00:01")):''; 

    $completed_at['completed_at <='] = !empty($_GET['date']['completed_at'])?date("Y-m-d H:m:i",strtotime($_GET['date']['completed_at']." 23:59:59")):'';
  
    if(empty($completed_at['completed_at >='])){
      unset($completed_at['completed_at >=']);
      unset($completed_at['completed_at <=']);
    }
  
    
   //pr($completed_at);
  	$users = $this->user_model->get('*');
    $this->data['rope_chain__final_process_hook_department'] = $this->karigar_out_dashboard_model->get('karigar,sum(out_weight) as balance',
                            array('product_name'=>'Rope Chain',
                                  'process_name'=>'Final Process',
                                  'department_name'=>'Hook','(out_weight != 0 OR out_weight != "")'=>null,
                                  'where'=>$completed_at),
                            array(),
                            array('group_by'=>'karigar'));
    
    $this->data['machine_chain_final_process_joining_department'] = $this->karigar_out_dashboard_model->get('                       karigar,sum(out_weight) as balance',
                      array('product_name'=>'Machine Chain',
                            'process_name'=>'Final Process',
                            'department_name'=>'Joining Department','(out_weight != 0 OR out_weight != "")'=>null,'where'=>$completed_at),
                      array(),
                      array('group_by'=>'karigar'));
  
    $this->data['choco_chain_machine_process_chain_making_department'] = $this->karigar_out_dashboard_model->get('karigar,sum(out_weight) as balance',
                                array('product_name'=>'Choco Chain',
                                    'process_name'=>'Machine Process','department_name'=>'Chain Making',
                                    '(out_weight != 0 OR out_weight != "")'=>null,'where'=>$completed_at),
                                array(),
                                array('group_by'=>'karigar'));

    $this->data['round_box_chain_final_process_hook_department'] = $this->karigar_out_dashboard_model->get('karigar,sum(out_weight) as balance',
                                array('product_name'=>'Round Box Chain',
                                    'process_name'=>'Final Process','department_name'=>'Hook',
                                    '(out_weight != 0 OR out_weight != "")'=>null,'where'=>$completed_at),
                                array(),
                                array('group_by'=>'karigar'));

    $this->data['sisma_chain_karigar_process_chain_making'] = $this->karigar_out_dashboard_model->get('karigar,sum(out_weight) as balance',
                                array('product_name'=>'Sisma Chain',
                                    'process_name'=>'Karigar Process','department_name'=>'Chain making',
                                    '(out_weight != 0 OR out_weight != "")'=>null,'where'=>$completed_at),
                                array(),
                                array('group_by'=>'karigar')); 

    $this->data['sisma_chain_RND_process_chain_making_department'] = $this->karigar_out_dashboard_model->get('karigar,sum(out_weight) as balance',
                                array('product_name'=>'Sisma Chain',
                                    'process_name'=>'RND Process','department_name'=>'Chain making',
                                    '(out_weight != 0 OR out_weight != "")'=>null,'where'=>$completed_at),
                                array(),
                                array('group_by'=>'karigar'));

    $this->data['imp_chain_spring_process_spring_department'] = $this->karigar_out_dashboard_model->get('karigar,sum(out_weight) as balance',
                                array('product_name'=>'Imp Italy Chain',
                                    'process_name'=>'Spring Process','department_name'=>'Spring',
                                    '(out_weight != 0 OR out_weight != "")'=>null,'where'=>$completed_at),
                                array(),
                                array('group_by'=>'karigar'));

    $this->data['imp_chain_chain_making_process_chain_making_department'] = $this->karigar_out_dashboard_model->get('karigar,sum(out_weight) as balance',
                                array('product_name'=>'Imp Italy Chain',
                                    'process_name'=>'Chain Making Process','department_name'=>'Chain Making',
                                    '(out_weight != 0 OR out_weight != "")'=>null,'where'=>$completed_at),
                                array(),
                                array('group_by'=>'karigar'));


    $this->data['hollow_choco_chain_spring_process_spring_department'] = $this->karigar_out_dashboard_model->get('karigar,sum(out_weight) as balance',
                                array('product_name'=>'Hollow Choco Chain',
                                    'process_name'=>'Spring Process','department_name'=>'Spring',
                                    '(out_weight != 0 OR out_weight != "")'=>null,'where'=>$completed_at),
                                array(),
                                array('group_by'=>'karigar'));

    $this->data['hollow_choco_chain_chain_making_process_chain_making_department'] = $this->karigar_out_dashboard_model->get('karigar,sum(out_weight) as balance',
                                array('product_name'=>'Hollow Choco Chain',
                                    'process_name'=>'Chain Making Process','department_name'=>'Chain Making',
                                    '(out_weight != 0 OR out_weight != "")'=>null,'where'=>$completed_at),
                                array(),
                                array('group_by'=>'karigar'));

    $this->data['indo_tally_chain_spring_process_spring_department'] = $this->karigar_out_dashboard_model->get('karigar,sum(out_weight) as balance',
                                array('product_name'=>'Indo tally Chain',
                                    'process_name'=>'Spring Process','department_name'=>'Spring',
                                    '(out_weight != 0 OR out_weight != "")'=>null,'where'=>$completed_at),
                                array(),
                                array('group_by'=>'karigar'));

    $this->data['indo_tally_chain_chain_making_process_chain_making_department'] = $this->karigar_out_dashboard_model->get('karigar,sum(out_weight) as balance',
                                array('product_name'=>'Indo tally Chain',
                                    'process_name'=>'Chain Making Process','department_name'=>'Chain Making',
                                    '(out_weight != 0 OR out_weight != "")'=>null,'where'=>$completed_at),
                                array(),
                                array('group_by'=>'karigar'));

    $this->data['ka_chain_hook_process_hook_department'] = $this->karigar_out_dashboard_model->get('karigar, sum(out_weight) as balance',
                                array('product_name'=>'KA Chain',
                                      'department_name'=>'Hook',
                                      '(out_weight != 0 OR out_weight != "")'=>null,'where'=>$completed_at),
                                array(),
                                array('group_by'=>'karigar'));


    parent::view($users[0]['id']);
  }
}