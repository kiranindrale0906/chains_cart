<?php
class Bar_codes extends BaseController {

  public function __construct() {
    parent::__construct();
    $this->load->helper('config/product_process_department_helper');
    $this->load->model(array('melting_lots/melting_lot_model','processes/process_model','settings/same_karigar_model'));
  
  }

  public function index(){

    $data['lot_no'] = $_GET['lot_no'];
    $data['process_name'] = $_GET['process_name'];
    $data['product_name'] = $_GET['product_name'];
    $data['design_code']  = $_GET['design_code'];
    $data['bottom_text']  = 'ARG0000'.$_GET['barcode_code'];
    $data['bar_code_data'] = array($_GET['barcode_code']);
    $data['layout'] = 'application';
    echo json_encode(array('js_function'=>'genrate_bar_code('.json_encode($this->load->view('bar_codes/bar_codes/view',$data,true)).')')); exit;
  }

  public function view($id){
    if(isset($_POST['barcode_value'])){
      $barcode_data = $_POST['barcode_value'];
      $this->verify_request_scanner($barcode_data);
    }elseif(isset($_GET['barcode_value'])){
      $barcode_data = $_GET['barcode_value'];
      $this->verify_request_scanner($barcode_data);
    }
    if(isset($_GET['type']) && $_GET['type'] == 2){
        $get_data_array =  $this->process_model->find_process_data($id);
  
      if(empty($get_data_array['row_id'])){
        $get_data = $this->process_model->find('product_name,process_name,row_id',array('id'=>$id));
        $get_data_array['row_id'] = $get_data['row_id'];
      }
      $get_parent_id = $this->process_model->find('id',
                                                 array('parent_id'=>$id))['id'];
      if(isset($get_data_array['department_name']))
        $department_name = $get_data_array['department_name'];
      else $department_name = '';
      echo json_encode(array('status'=>'success',
                          'js_function'=>'set_cursor_on_input("'.$get_parent_id.'",'
                          .json_encode($department_name).','
                          .json_encode($get_data_array['row_id']).')'));exit;
    }
    if(!isset($_GET['process'])){
      $code_value = $barcode_data;
      redirect($host_name.'bar_codes/bar_codes/view/1?process=1'.'&code='.$code_value);
    }else{
      $this->redirect_on_chain();
    }
  }

  private function redirect_on_chain(){
    if(BARCODE_REDIRECT_ON == 'list')$action = 'index';
    else $action = 'edit';
    $process = $_GET['process'];
    $get_data_array =  $this->process_model->find_process_data($_GET['code']);
    
    if(isset($get_data_array['process_name'])){
      $check_is_new_process = get_new_product_name_with_diffrent_controllers($get_data_array['product_name']);
      if(!empty($check_is_new_process))
         $controller = $check_is_new_process[$get_data_array['process_name']]; 
      else
        $controller = strtolower(str_replace(" ",'_',$get_data_array['process_name']));
      if($controller != 'refresh')
        $make_controller_name = plural($controller).'/'.$action.'/'.$_GET['code'].'?barcode=1';

      else $make_controller_name = $controller.'/'.$action.'/'.$_GET['code'].'?barcode=1'; 


    }else{
      redirect(base_url());     
    }

    $get_product_name = get_product_name($get_data_array['product_name']);
    //pr($get_product_name);
    $host_name = base_url();
    redirect($host_name.$get_product_name.'/'.$make_controller_name);
  }

  private function verify_request_scanner($post_data){
    $explode = explode('-',$post_data);

    if(isset($explode[0]) && in_array($explode[0],get_dailydrawer_summary_sort_code())){
      redirect(base_url().'bar_codes/'.'bar_code_dd_summary/view/'.$post_data);
    }

    $uppercase = strtoupper($post_data);
    $explode = explode('T',$uppercase);
    if(isset($explode[1])){
      redirect(base_url().'tounch_reports/tounch_reports/edit/'.$explode[1]);
    }

    return true;
  }

}