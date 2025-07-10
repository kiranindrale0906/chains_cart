<?php
class Finish_goods extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('users/account_model',
                             'processes/process_model',));
  }

  public function index() {
    if(!empty($_GET['query'])) {
      $data['account_name']=$_GET['query'];
      $url=API_BASE_PATH."masters/accounts/index";
      $records=json_decode(curl_post_request($url,$data));
      $autocomplete_result=array();
      if(!empty($records->data)){
        foreach ($records->data as $index => $record) {
          $autocomplete_result[]=$record->name;
        }
      }
      echo json_encode($autocomplete_result);die;
    }  

    parent::index();
  }
  public function create() {
    $this->data['record']['out_lot_purity'] =  isset($_GET['purity']) ? $_GET['purity'] : '';
    parent::create();
  }

  public function _after_save($formdata,$action){
    redirect(base_url().'issue_departments/finish_goods');
  }


  public function _get_form_data() {
    $where = array('balance_gpc_out > ' => 0,
                   'wastage_purity >' => 0,
                   'wastage_lot_purity >' => 0,
                   'finish_good'=>0);
    $where_purity=$where;
    if(!empty($this->data['record']['out_lot_purity'])){
      $where['out_lot_purity']=$this->data['record']['out_lot_purity'];
    }

    $this->data['processes'] = $this->process_model->get('', $where);

    $this->data['out_lot_purities'] = $this->process_model->get('out_lot_purity as id,out_lot_purity as name', $where_purity,array(),array('group_by'=>'out_lot_purity'));

    $this->data['accounts'] = $this->account_model->get('',array());
    if ($this->router->method == 'store' || $this->router->method == 'update') {
      $this->data['record']['finish_goods'] = $_POST['finish_goods'];
      $this->data['finish_good_details'] = @$_POST['finish_good_details'];
    }
  }
  public function _get_view_data() {
    $this->data['record']['out_lot_purity'] =  isset($_GET['purity']) ? $_GET['purity'] : '';
    $where = array('balance_gpc_out > ' => 0,
                       'wastage_purity >' => 0,
                       'wastage_lot_purity >' => 0,
                       'finish_good'=>1);
    if(!empty($this->data['record']['out_lot_purity'])){
          $where['out_lot_purity']=$this->data['record']['out_lot_purity'];
        }
    $this->data['processes'] = $this->process_model->get('',$where);
  }
}