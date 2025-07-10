<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_report_lists extends BaseController {
	protected $load_helper = false;
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('processes/process_model'));
  }

  public function index(){
	if(!in_array($_POST['product_name'],$this->logical_product_array()))
	$data['process_data'] = $this->process_model->get('product_name,							department_name,karigar,sum(balance_gross) as balance_gross,					sum(balance_fine) as balance_fine',array('balance !='=>0,									'product_name'=>$_POST['product_name']										),array(),array('group_by'=>'department_name,karigar',						'order_by'=>'department_name,karigar'));
	else 
	$data['process_data'] = $this->logical_field_product_data($_POST['product_name']);
	$data['icon_hide'] = 0;
  	$class = str_replace(" ", "_", strtolower($_POST['product_name'])).'_list';
  	$data['class'] = $class;
  	$data['process'] = str_replace(" ", "_", strtolower($_POST['product_name']));
  	$html = $this->load->view('process_report_lists/view',$data,true);
  	echo json_encode(array('js_function'=>'render_show_more('.json_encode($html).',"'.$class.'")','status'=>'success'));
  
  }

  private function logical_product_array(){
		return array(	'Daily drawer wastage',
						'Balance ghiss',
						'Choco Chain Dye Process',
						'Hollow Choco Dye Process',
						'Imp Dye Process',
						'Rope Ghiss',
						'Balance Loss',
						'Melting Wastage',
						'Metal',
						'Refine Loss',
						'HCL wastage',
						'Tounch',
						'Alloy',
						'Daily Drawer Balance',
						'RND',
						'GPC Out',
						'HCL loss',
						'Choco Chain Machine Out',
						'Daily Drawer Tounch Out',
						'Pending Ghiss',
						'Alloy Vodatar',
						'Tounch Department Loss',
						'Copper',
						'Tounch Ghiss');  	
  }

  private function logical_field_product_data($product_name){
  	$product_name_method = str_replace(" ",'_', strtolower($product_name));
  	$data =  $this->process_report_list_model->get_logical_field_data($product_name_method);
  	return $data;
  							
  }

  public function view($id){
	  $data = json_decode($_POST['data'],true);

  	if(!in_array($data['master_process'],$this->master_process_class())){
	  	$where['product_name'] 		= !empty($data['product_name'])?$data['product_name']:"''";

	  	if(isset($data['department_name']) || empty($data['department_name']))	{
	  		$where['department_name'] 			= !empty($data['department_name'])?$data['department_name']:"";
	  	}

	  	if(isset($data['karigar'])  || empty($data['department_name']))	
	  		$where['karigar'] 			= !empty($data['karigar'])?$data['karigar']:"";

	  		$where['balance != '] = 0;
	  		$data['process_data'] = $this->process_model->get('id,product_name,process_name,parent_lot_name,lot_no,design_code,department_name,karigar,											balance_gross as balance_gross,												balance_fine as balance_fine',$where										);
	  	}else {
	  		$this->load->model('process_report_sub_list_model');
	  		$method = $data['master_process'];
	  		if(isset($data['out_lot_purity']) && !empty($data['out_lot_purity']))
	  			$where['out_lot_purity'] = $data['out_lot_purity'];
	  		if(isset($data['karigar']) && !empty($data['karigar']))
	  			$where['karigar'] = $data['karigar'];
	  		if(isset($data['product_name']) && !empty($data['product_name']))
	  			$where['product_name'] = $data['product_name'];

	  		if(isset($data['process_name']) && !empty($data['process_name']))
	  			$where['process_name'] = $data['process_name'];

	  		if(isset($data['department_name']) && !empty($data['department_name']))
	  			$where['department_name'] = $data['department_name'];

	  		if($method == 'rope_ghiss_list'){
	  			$where = 'balance_hcl_ghiss != 0 AND (parent_lot_name = "'.$data["process_name"].'" OR lot_no = "'.$data['process_name'].'" )';
	  	
	  		}
	  		if($method == 'hcl_wastage_list'){
	  			$where = 'balance_hcl_wastage != 0 AND (parent_lot_name = "'.$data["process_name"].'" OR lot_no = "'.$data['process_name'].'" )';
	  		}

	  		if($method == 'daily_drawer_balance_list'){
	  			$where = array('hook_kdm_purity'=>$data['out_lot_purity'],'karigar'=>$data['karigar'],
	  										'(daily_drawer_in_weight - hook_in + hook_out - daily_drawer_out_weight) !='=>0);
	  		}

	  
	  		$data['process_data'] = $this->process_report_sub_list_model->get_logical_field_data($method,$where);
	  	}
	  		$class = $_POST['class'];
		  	$data['class'] = str_replace(" ","_",strtolower($_POST['class']));
		  	$data['hide_class'] = $_POST['hide-class'];
		  	$data['icon_hide'] = 1;
		  	$data['process'] = $_POST['process'];
		  	$html = $this->load->view('process_report_lists/view',$data,true);
	  		echo json_encode(array('js_function'=>'render_show_more('.json_encode($html).',"'.$class.'","1")','status'=>'success'));
  }

  private function master_process_class(){
		return array(	'daily_drawer_wastage_list',
									'balance_ghiss_list',
									'rope_ghiss_list',
									'balance_loss_list',
									'melting_wastage_list',
									'metal_list',
									'refine_loss_list',
									'hcl_wastage_list',
									'tounch_list',
									'alloy_list',
									'daily_drawer_balance_list',
									'rnd_list',
									'gpc_out_list',
									'hcl_loss_list',
									'choco_chain_machine_out_list',
									'daily_drawer_tounch_out_list',
									'pending_ghiss_list',
									'alloy_vodatar_list',
									'tounch_department_loss_list',
									'copper_list',
									'tounch_ghiss_list');  	
  }
}