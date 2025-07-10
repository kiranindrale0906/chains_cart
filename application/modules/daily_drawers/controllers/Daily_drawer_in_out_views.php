<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daily_drawer_in_out_views extends BaseController {	
	
  public function __construct(){
	 parent::__construct();
	 $this->load->model(array('processes/process_model', 'processes/process_field_model','daily_drawers/view_daily_drawer_summary_model',
                              'daily_drawers/daily_drawer_receipt_model','issue_departments/issue_department_model'));
  } 

  public function index() {
    $where = array();
    $this->data['column'] = (isset($_GET['column']) ? $_GET['column'] : '');

    $type = str_replace('_', ' ', $_GET['type']);
    $where = array('hook_kdm_purity' => $_GET['purity']);
    // if (HOST != 'ARF')

    if ($type == 'Hook')
      $where['daily_drawer_type'] = array('Hook', 'Solid Wire', 'Hard Wire');
    else
      $where['daily_drawer_type'] = $type;


//    if(isset($_GET['karigar'])){
      //if(isset($_GET['karigar']) && $_GET['karigar']==''){
      //  $where['karigar']='';
      //}else{
  //      $karigar = str_replace('_', ' ', $_GET['karigar']);
    //    $where['karigar']=$karigar;
      //}
    //}

    if(isset($_GET['column'])&&$_GET['column']=='in_weight')             $where['in_weight !=']= 0;
    if(isset($_GET['column'])&&$_GET['column']=='out_weight')            $where['out_weight !=']= 0;
    if(!empty($_GET['chain_name']))                                      $where['chain_name']=str_replace('_',' ',$_GET['chain_name']);
    
    if(!empty($_GET['type']) && $_GET['type']=='GPC_Powder' && isset($_GET['column'])&&$_GET['column']=='out_weight' ){
      $this->data['daily_drawers'] = $this->issue_department_model->get('"" as lot_no,(in_weight) as in_weight,(in_weight) as out_weight,
                                                              FORMAT(in_purity,4) as hook_kdm_purity,
                                                              "Factory" as karigar,product_name as
                                                              product_name,account_id as
                                                              daily_drawer_type,"" as department_name,created_at,id as process_id',
                                                              array('in_weight >' => 0,
                                                                    'product_name'=>'GPC Powder '));
        
    }elseif($_GET['karigar']=='Sisma_Accessory'){
      $this->data['daily_drawers']=$this->process_field_model->get('*', $where,array(),array('order_by'=>'created_at desc'));
//pd($this->data['daily_drawers']);//      lq();
    } else
      $this->data['daily_drawers']=$this->view_daily_drawer_summary_model->get('*', $where,array(),array('order_by'=>'created_at desc'));
    
    $this->load->render('daily_drawers/daily_drawer_in_out_views/index', $this->data);
  }
}

 
  
