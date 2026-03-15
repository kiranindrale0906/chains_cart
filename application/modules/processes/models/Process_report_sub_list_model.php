<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Process_report_sub_list_model extends BaseModel {
  protected $table_name = "processes";
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
    $this->load->model(array('melting_lots/melting_lot_model'));
  }

  public function get_logical_field_data($method_name,$where){
  	return $this->$method_name($where);
  }

  private function daily_drawer_wastage_list($where){
  	$where['balance_daily_drawer_wastage !='] = 0;
  	$data =  $this->process_model->get("id,
																out_lot_purity,product_name,lot_no,parent_lot_name,melting_lot_category_four as design_code,process_name,karigar,department_name,
																sum(balance_daily_drawer_wastage) as balance_gross,
																sum(balance_daily_drawer_wastage * out_purity / 100 * out_lot_purity / 100) as balance_fine",$where,array(),
																array(
																	'order_by'=>'out_lot_purity,product_name,product_name,lot_no,parent_lot_name,melting_lot_category_four,
																								process_name,karigar,department_name',
																	'group_by'=>'out_lot_purity,product_name,product_name,lot_no,parent_lot_name,melting_lot_category_four,
																							process_name,karigar,id,
																							department_name'
																));
 
  	return $data;
  }

  private function balance_ghiss_list($where){
  	$where['(balance_ghiss * out_purity /100) != '] = 0;
  	
  	$data =  $this->process_model->get("id,product_name,
																department_name,process_name,karigar,out_lot_purity,
																sum(balance_ghiss * out_purity /100) as balance_gross,
																sum(balance_ghiss * out_purity /100 * out_lot_purity / 100) as balance_fine",
																$where,array(),
																array(
																	'order_by'=>'product_name,department_name,process_name,karigar,out_lot_purity',
																	'group_by'=>'product_name,department_name,process_name,karigar,out_lot_purity,id'
																));
  
  	return $data;
  }

  private function rope_ghiss_list($where){
  	
  	$data =  $this->process_model->get("id,product_name,product_name,lot_no,parent_lot_name,melting_lot_category_four as design_code,IF(parent_lot_name IS NULL OR 
  															parent_lot_name = '',lot_no,parent_lot_name) as process_name,karigar,department_name,
																(balance_hcl_ghiss * out_purity /100) as balance_gross,
																(balance_hcl_ghiss * out_purity /100 * out_lot_purity /100) as
																balance_fine",array('where'=>$where),array(),
																array(
																	'order_by'=>'product_name,karigar,department_name',
																	'group_by'=>''
																));
  	
  	
 		//pr($data);
  	return $data;
  }

  private function balance_loss_list($where){
  	$where['loss !='] =0; 
  	$where['process_name !='] ='hcl' ;
  	$data =  $this->process_model->get("id,
																department_name,karigar,product_name,lot_no,parent_lot_name,melting_lot_category_four as design_code,process_name,
																sum(balance_loss * out_purity /100) as balance_gross,
																sum(balance_loss * out_purity /100 * out_lot_purity /100) as balance_fine",array('where'=>$where),array(),
																array(
																	'order_by'=>'department_name,karigar,product_name,lot_no,parent_lot_name,melting_lot_category_four,process_name',
																	'group_by'=>'department_name,karigar,product_name,lot_no,parent_lot_name,melting_lot_category_four,id,process_name'
																));
  	
 		//pr($data);
  	return $data;
  }


  private function melting_wastage_list($where){
  	$where['balance_melting_wastage!='] = 0;

  	$data =  $this->process_model->get("id,product_name,lot_no,parent_lot_name,melting_lot_category_four as design_code,process_name,
																out_lot_purity,karigar,
																department_name,
																sum(balance_melting_wastage) as balance_gross,
																sum(balance_melting_wastage * out_lot_purity /100) as balance_fine",$where,array(),
																array(
																	'order_by'=>'product_name,process_name,lot_no,parent_lot_name,melting_lot_category_four ,out_lot_purity,karigar,department_name',
																	'group_by'=>'product_name,process_name,karigar,lot_no,parent_lot_name,melting_lot_category_four,department_name,out_lot_purity,id,balance_fine'
																));
  	
 		//pr($data);
  	return $data;
  }

  private function metal_list($where){
  	$where['balance_melting_wastage !='] = 0;
  	$data =  $this->process_model->get("id,product_name,lot_no,parent_lot_name,melting_lot_category_four as design_code,process_name,lot_no,parent_lot_name,melting_lot_category_four as design_code,
																out_lot_purity,karigar,
																department_name,
																balance_melting_wastage as balance_gross,
																(balance_melting_wastage * out_lot_purity /100) as balance_fine",$where,array(),
																array(
																	'order_by'=>'product_name,process_name,out_lot_purity,karigar,department_name',
																	'group_by'=>''
																));
  	
 		//pr($data);
  	return $data;
  }

  // private function refine_loss_list($where){
  // 	$where['refine_loss !=']= 0;
  // 	$data =  $this->process_model->get("id,product_name,lot_no,parent_lot_name,melting_lot_category_four as design_code,process_name,
		// 														out_lot_purity,karigar,
		// 														department_name,
		// 														refine_loss as balance_gross,
		// 														(refine_loss * in_lot_purity / 100) as balance_fine",$where,array(),
		// 														array(
		// 															'order_by'=>'product_name,process_name,out_lot_purity,karigar,department_name',
		// 															'group_by'=>''
		// 														));
  	
 	// 	//pr($data);
  // 	return $data;
  // }

  private function hcl_wastage_list($where){

  	$data =  $this->process_model->get("id,product_name,lot_no,parent_lot_name,melting_lot_category_four as design_code,IF(parent_lot_name IS NULL OR parent_lot_name = '',lot_no,parent_lot_name) as process_name,
																(balance_hcl_wastage * out_purity /100) as balance_gross,
																(balance_hcl_wastage * out_purity / 100 * out_lot_purity / 100) as balance_fine",array('where'=>$where),array(),
																array(
																	'order_by'=>'product_name',
																	'group_by'=>''
																));
  	
 		//pr($data);
  	return $data;
  }

  private function tounch_list($where){
  	$where['tounch_in >'] = 0;
  	if(!isset($where['karigar'])){
  		$where['karigar'] = '';
  	}
  	$data =  $this->process_model->get("id,product_name,lot_no,parent_lot_name,melting_lot_category_four as design_code,process_name,
																out_lot_purity,karigar,
																department_name,
																(tounch_in - tounch_ghiss - tounch_out) as balance_gross,
																((tounch_in - tounch_ghiss - tounch_out) * out_lot_purity / 100) as balance_fine",$where,array(),
																array(
																	'order_by'=>'product_name,process_name,out_lot_purity,karigar,department_name',
																	'group_by'=>''
																));
  	
 		//pr($data);
  	return $data;
  }

  private function alloy_list($where){
  	return array();
  }

  private function daily_drawer_balance_list($where){
  	$data =  $this->process_model->get("id,lot_no,parent_lot_name,melting_lot_category_four as design_code,
																hook_kdm_purity as out_lot_purity,karigar,
																(daily_drawer_in_weight - hook_in + hook_out - daily_drawer_out_weight) as balance_gross ,
																((daily_drawer_in_weight - hook_in + hook_out - daily_drawer_out_weight) * hook_kdm_purity / 100) as balance_fine",
																$where,array(),
																array(
																	'order_by'=>'karigar,hook_kdm_purity'
																));
  	//lq();
 		//pr($data);
  	return $data;
  }

  private function rnd_list($where){
  	return array();
  }


  private function gpc_out_list($where){
  	$where['balance_gpc_out !='] = 0; 
  	$data =  $this->process_model->get("id,product_name,lot_no,parent_lot_name,melting_lot_category_four as design_code,process_name,
																out_lot_purity,karigar,
																department_name,(balance_gpc_out) as balance_gross ,
																((balance_gpc_out) * in_purity / 100  * in_lot_purity / 100) as balance_fine",$where,array(),
																array(
																	'order_by'=>'product_name,process_name,out_lot_purity,karigar,department_name'
																	
																));
  	
 		//pr($data);
  	return $data;
  } 

  private function hcl_loss_list($where){
  	$where['balance_hcl_loss !='] =0; 
  	$data =  $this->process_model->get("id,product_name,lot_no,parent_lot_name,melting_lot_category_four as design_code,process_name,
																out_lot_purity,karigar,
																department_name,(balance_hcl_loss) as balance_gross ,
																(balance_hcl_loss * in_lot_purity / 100) as balance_fine",$where,array(),
																array(
																	'order_by'=>'product_name,process_name,out_lot_purity,karigar,department_name'
																
																));
  	
 		//pr($data);
  	return $data;
  }
  private function refine_loss_list($where){
  	$where['balance_refine_loss !='] =0; 
  	$data =  $this->process_model->get("id,product_name,lot_no,parent_lot_name,melting_lot_category_four as design_code,process_name,
																out_lot_purity,karigar,
																department_name,(balance_refine_loss) as balance_gross ,
																(balance_refine_loss * in_lot_purity / 100) as balance_fine",$where,array(),
																array(
																	'order_by'=>'product_name,process_name,out_lot_purity,karigar,department_name'
																
																));
  	
 		//pr($data);
  	return $data;
  }

  private function daily_drawer_tounch_out_list($where){
  	$where['balance_tounch_out !='] =0; 
  	$data =  $this->process_model->get("id,product_name,lot_no,parent_lot_name,melting_lot_category_four as design_code,process_name,
																out_lot_purity,karigar,
																department_name,(balance_tounch_out) as balance_gross ,
																(balance_tounch_out * tounch_purity / 100) as balance_fine",$where,array(),
																array(
																	'order_by'=>'product_name,process_name,out_lot_purity,karigar,department_name',
																	'group_by'=>'product_name,process_name,karigar,id,department_name,out_lot_purity,balance_fine'
																));
  	
 		//pr($data);
  	return $data;
  }

  private function tounch_ghiss_list($where){
  	$where['balance_tounch_ghiss !='] =0; 
  	$data =  $this->process_model->get("id,
																out_lot_purity,sum(balance_tounch_ghiss) as balance_gross ,
																(balance_tounch_ghiss * tounch_purity / 100) as balance_fine",$where,array(),
																array(
																	'order_by'=>'out_lot_purity',
																	'group_by'=>'id',
																
																));
  	
 		//pr($data);
  	return $data;
  }

  private function pending_ghiss_list($where){
  	return array();
 	}

  private function copper_list($where){
  	return array();
 
  }

  private function alloy_vodatar_list($where){
  	$where_condition['alloy_vodatar !='] = 0;
  	$where_condition['process_name'] = $where['product_name'];
  	$data =  $this->melting_lot_model->get("'Alloy Vodatar' product_name,
																lot_purity,'0.0000' as balance_gross ,
																0-(alloy_vodatar*lot_purity/100) as balance_fine",$where_condition,array(),
																array(
																	'order_by'=>'product_name'
													
																));
  	
 		//pr($data);
  	return $data;
  }

  private function tounch_department_loss_list($where){
  	$where['balance_tounch_loss_fine !='] = 0;
  	$data =  $this->process_model->get("id,product_name,lot_no,parent_lot_name,melting_lot_category_four as design_code,process_name,
																out_lot_purity,karigar,
																department_name,'0.0000' as balance_gross ,
																(balance_tounch_loss_fine) as balance_fine",$where,array(),
																array(
																	'order_by'=>'product_name,process_name,out_lot_purity,karigar,department_name'
										
																));
  	
 		//pr($data);
  	return $data;
  }

  private function choco_chain_machine_out_list($where){
  	$where['(out_weight * out_purity / 100) !='] = 0;
  	$data =  $this->process_model->get("id,product_name,lot_no,parent_lot_name,melting_lot_category_four as design_code,process_name,
																out_lot_purity,karigar,
																department_name,(out_weight * out_purity / 100) as balance_gross ,
																(out_weight * out_purity / 100 * out_lot_purity / 100) as balance_fine",array('where_not_in' => 
																							array('id'=>'select parent_id from processes 
																										where product_name = "Choco Chain" and process_name 
																										IN ("Final Process","Imp Final Process") 
																										and parent_id IS NOT NULL 
																										and department_name = "Start"'),
																				'where'=>$where),array(),
																array(
																	'order_by'=>'product_name,process_name,out_lot_purity,karigar,department_name',
																	
																));
  	//lq();
  	
 		//pr($data);
  	return $data;
  }
}