<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Process_report_list_model extends BaseModel {
  protected $table_name = "processes";
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
    $this->load->model(array('melting_lots/melting_lot_model'));
  }

  public function get_logical_field_data($method_name){
  	return $this->$method_name();
  }

  private function daily_drawer_wastage(){
  	$data =  $this->process_model->get("
																out_lot_purity,
																sum(balance_daily_drawer_wastage) as balance_gross,
																sum(balance_daily_drawer_wastage * out_purity / 100 * out_lot_purity / 100) as balance_fine",array('balance_daily_drawer_wastage != '=>0),array(),
																array(
																	'order_by'=>'out_lot_purity',
																	'group_by'=>'out_lot_purity'
																));
 
  	return $data;
  }
  private function choco_chain_dye_process(){
  	$data =  $this->process_model->get("product_name,department_name,out_lot_purity,sum(balance_gross) as balance_gross,
																sum(balance_fine) as balance_fine",array('balance != '=>0,'process_name'=>'Choco Chain Dye Process'),array(),
																array(
																	'order_by'=>'out_lot_purity',
																	'group_by'=>'out_lot_purity,product_name,department_name'
																));
 
  	return $data;
  }
   private function hollow_choco_dye_process(){
  	$data =  $this->process_model->get("product_name,department_name,out_lot_purity,sum(balance_gross) as balance_gross,
																sum(balance_fine) as balance_fine",array('balance != '=>0,'process_name'=>'Hollow Choco Dye Process'),array(),
																array(
																	'order_by'=>'out_lot_purity',
																	'group_by'=>'out_lot_purity,product_name,department_name'
																));
 
  	return $data;
  }
  private function imp_dye_process(){
  	$data =  $this->process_model->get("product_name,department_name,out_lot_purity,sum(balance_gross) as balance_gross,
																sum(balance_fine) as balance_fine",array('balance != '=>0,'process_name'=>'Imp Italy Dye Process'),array(),
																array(
																	'order_by'=>'out_lot_purity',
																	'group_by'=>'out_lot_purity,product_name,department_name'
																));
 
  	return $data;
  }

  private function balance_ghiss(){
  	$data =  $this->process_model->get("department_name,
																sum(balance_ghiss * out_purity /100) as balance_gross,
																sum(balance_ghiss * out_purity /100 * out_lot_purity / 100) as balance_fine",
																array('(balance_ghiss * out_purity /100) != '=>0),array(),
																array(
																	'order_by'=>'department_name',
																	'group_by'=>'department_name'
																));
  	return $data;
  }

  private function rope_ghiss(){
  	$data =  $this->process_model->get("product_name,IF(parent_lot_name IS NULL OR 
  															parent_lot_name = '',lot_no,parent_lot_name) as process_name,
																sum(balance_hcl_ghiss * out_purity /100) as balance_gross,
																sum(balance_hcl_ghiss * out_purity /100 * out_lot_purity /100) as
																balance_fine",array('balance_hcl_ghiss != '=>0),array(),
																array(
																	'order_by'=>'product_name',
																	'group_by'=>'product_name,IF(parent_lot_name IS NULL OR parent_lot_name = "",lot_no,parent_lot_name)'
																));
  	return $data;
  }

  private function balance_loss(){

  	$data =  $this->process_model->get("
																department_name,
																sum(balance_loss * out_purity /100) as balance_gross,
																sum(balance_loss * out_purity /100 * out_lot_purity /100) as balance_fine",array('where'=>array('loss != '=>0,'process_name !='=>'hcl'),
																			'where_not_in'=>
																			array('department_name'=>array('"GPC"','"Stripping"'))),array(),
																array(
																	'order_by'=>'department_name',
																	'group_by'=>'department_name'
																));
  	return $data;
  }


  private function melting_wastage(){

  	$data =  $this->process_model->get("product_name,process_name,
																out_lot_purity,karigar,
																department_name,
																sum(balance_melting_wastage) as balance_gross,
																sum(balance_melting_wastage * out_lot_purity /100) as balance_fine",array('where_not_in' => array('product_name' => array("'Receipt'")),'where'=>array('balance_melting_wastage!='=>0)),array(),
																array(
																	'order_by'=>'product_name,process_name,out_lot_purity,karigar,department_name',
																	'group_by'=>'product_name,process_name,karigar,department_name,out_lot_purity,balance_fine'
																));
  	
 		//pr($data);
  	return $data;
  }

  private function metal(){

  	$data =  $this->process_model->get("product_name,process_name,
																out_lot_purity,karigar,
																department_name,
																sum(balance_melting_wastage) as balance_gross,
																sum(balance_melting_wastage * out_lot_purity /100) as balance_fine",array('balance_melting_wastage != '=>0,'product_name'=>'Receipt'),array(),
																array(
																	'order_by'=>'product_name,process_name,out_lot_purity,karigar,department_name',
																	'group_by'=>'product_name,process_name,karigar,department_name,out_lot_purity,balance_fine'
																));
  	
 		//pr($data);
  	return $data;
  }

  // private function refine_loss(){

  // 	$data =  $this->process_model->get("product_name,process_name,
		// 														out_lot_purity,karigar,
		// 														department_name,
		// 														sum(refine_loss) as balance_gross,
		// 														sum(refine_loss * in_lot_purity / 100) as balance_fine",array('refine_loss != '=>0),array(),
		// 														array(
		// 															'order_by'=>'product_name,process_name,out_lot_purity,karigar,department_name',
		// 															'group_by'=>'product_name,process_name,karigar,department_name,out_lot_purity,balance_fine'
		// 														));
  	
 	// 	//pr($data);
  // 	return $data;
  // }

  private function hcl_wastage(){

  	$data =  $this->process_model->get("product_name,IF(parent_lot_name IS NULL OR parent_lot_name = '',lot_no,parent_lot_name) as process_name,
																sum(balance_hcl_wastage * out_purity /100) as balance_gross,
																sum(balance_hcl_wastage * out_purity / 100 * out_lot_purity / 100) as balance_fine",array('balance_hcl_wastage != '=>0),array(),
																array(
																	'order_by'=>'product_name',
																	'group_by'=>'product_name,IF(parent_lot_name IS NULL OR parent_lot_name = "",lot_no,parent_lot_name)'
																));
  	
 		//pr($data);
  	return $data;
  }

  private function tounch(){

  	$data =  $this->process_model->get("product_name,process_name,
																out_lot_purity,karigar,
																department_name,
																sum(tounch_in - tounch_ghiss - tounch_out) as balance_gross,
																sum((tounch_in - tounch_ghiss - tounch_out) * out_lot_purity / 100) as balance_fine",array('tounch_in > '=>0,'(tounch_in - tounch_ghiss - tounch_out) !='=>0),array(),
																array(
																	'order_by'=>'product_name,process_name,out_lot_purity,karigar,department_name',
																	'group_by'=>'product_name,process_name,karigar,department_name,out_lot_purity,balance_fine'
																));
  	
 		//pr($data);
  	return $data;
  }

  private function alloy(){
  	$data = $this->db->query("
  			(select product_name,'-' as process_name,'-' as department_name,'-' as out_weight,'-' as karigar, sum(alloy_weight - out_alloy_weight) as balance_gross, sum(balance_fine) as balance_fine from processes where alloy_weight != 0 group by product_name) 
  			UNION 
  			(select 'Melting Lot' as product_name, '-' as process_name, '-' as department_name, '-' as karigar,'-' as out_weight, -1*sum(alloy_weight) as balance_gross, 0 as balance_fine from melting_lots where alloy_weight != 0 group by product_name)");
  	$result = $data->result_array();

  	return $result;
  }

  private function daily_drawer_balance(){

  	$data =  $this->process_model->get("
																hook_kdm_purity as out_lot_purity,karigar,
																sum(daily_drawer_in_weight - hook_in + hook_out - daily_drawer_out_weight) as balance_gross ,
																sum((daily_drawer_in_weight - hook_in + hook_out - daily_drawer_out_weight) * hook_kdm_purity / 100) as balance_fine",
																array('(daily_drawer_in_weight - hook_in + hook_out - daily_drawer_out_weight) !=  '=>0),array(),
																array(
																	'order_by'=>'karigar,hook_kdm_purity',
																	'group_by'=>'karigar,hook_kdm_purity'
																));
  	//lq();
 		//pr($data);
  	return $data;
  }

  private function rnd(){
  	$query = $this->db->query('(SELECT `product_name`, `process_name`, `out_lot_purity`, `karigar`, `department_name`, sum(in_weight) as balance_gross, sum(in_weight* in_purity / 100  * in_lot_purity / 100) as balance_fine FROM `processes` WHERE ((in_weight) - (select sum(in_weight) from processes where process_name = "RND Issue")) != 0 AND `process_name` = "RND Receipt" AND `processes`.`is_delete` != 1 GROUP BY `product_name`, `process_name`, `karigar`, `department_name`, `out_lot_purity`, `balance_fine` ORDER BY `product_name`, `process_name`, `out_lot_purity`, `karigar`, `department_name`) 

  		UNION 

  		(select `product_name`, `process_name`, `out_lot_purity`, `karigar`, `department_name`,-1*sum(in_weight) as balance_gross, -1*sum(in_weight* in_purity / 100  * in_lot_purity / 100) as balance_fine from processes where process_name = "RND Issue" GROUP BY `product_name`, `process_name`, `karigar`, `department_name`, `out_lot_purity`, `balance_fine` ORDER BY `product_name`, `process_name`, `out_lot_purity`, `karigar`, `department_name`)');
  	$data = $query->result_array();
  	return $data;
  }


  private function gpc_out(){

  	$data =  $this->process_model->get("product_name,process_name,
																out_lot_purity,karigar,
																department_name,sum(balance_gpc_out) as balance_gross ,
																sum((balance_gpc_out) * in_purity / 100  * in_lot_purity / 100) as balance_fine",array('balance_gpc_out !=  '=>0),array(),
																array(
																	'order_by'=>'product_name,process_name,out_lot_purity,karigar,department_name',
																	'group_by'=>'product_name,process_name,karigar,department_name,out_lot_purity,balance_fine'
																));
  	
 		//pr($data);
  	return $data;
  } 

  private function hcl_loss(){

  	$data =  $this->process_model->get("product_name,process_name,
																out_lot_purity,karigar,
																department_name,sum(balance_hcl_loss) as balance_gross ,
																sum(balance_hcl_loss * in_lot_purity / 100) as balance_fine",array('balance_hcl_loss !=  '=>0),array(),
																array(
																	'order_by'=>'product_name,process_name,out_lot_purity,karigar,department_name',
																	'group_by'=>'product_name,process_name,karigar,department_name,out_lot_purity,balance_fine'
																));
  	
 		//pr($data);
  	return $data;
  }
  private function refine_loss(){

  	$data =  $this->process_model->get("product_name,process_name,
																out_lot_purity,karigar,
																department_name,sum(balance_refine_loss) as balance_gross ,
																sum(balance_refine_loss * in_lot_purity / 100) as balance_fine",array('balance_refine_loss !=  '=>0),array(),
																array(
																	'order_by'=>'product_name,process_name,out_lot_purity,karigar,department_name',
																	'group_by'=>'product_name,process_name,karigar,department_name,out_lot_purity,balance_fine'
																));
  	
 		//pr($data);
  	return $data;
  }

  private function daily_drawer_tounch_out(){

  	$data =  $this->process_model->get("product_name,process_name,
																out_lot_purity,karigar,
																department_name,sum(balance_tounch_out) as balance_gross ,
																sum(balance_tounch_out * tounch_purity / 100) as balance_fine",array('balance_tounch_out !=  '=>0),array(),
																array(
																	'order_by'=>'product_name,process_name,out_lot_purity,karigar,department_name',
																	'group_by'=>'product_name,process_name,karigar,department_name,out_lot_purity,balance_fine'
																));
  	
 		//pr($data);
  	return $data;
  }

  private function tounch_ghiss(){

  	$data =  $this->process_model->get("
																out_lot_purity,sum(balance_tounch_ghiss) as balance_gross ,
																sum(balance_tounch_ghiss * tounch_purity / 100) as balance_fine",array('balance_tounch_ghiss !=  '=>0),array(),
																array(
																	'order_by'=>'out_lot_purity',
																	'group_by'=>'out_lot_purity'
																));
  	
 		//pr($data);
  	return $data;
  }

  private function pending_ghiss(){
  	$query = $this->db->query("(select product_name,process_name,
																out_lot_purity,karigar,
																department_name,
  		               sum(pending_ghiss * out_purity / 100) as balance_gross, 
  		               sum(pending_ghiss * out_purity / 100 * out_lot_purity / 100) as balance_fine from processes where pending_ghiss!= 0 group by product_name,process_name,karigar,department_name,out_lot_purity,balance_fine)
  		               UNION 
  		               (select product_name,process_name,
																out_lot_purity,karigar,
																department_name,
  		               -sum(ghiss) as balance_gross, 
  		               -sum(ghiss) as balance_fine from processes where product_name = 'Pending Ghiss Out' AND process_name = 'Pending Ghiss Out' group by product_name,process_name,karigar,department_name,out_lot_purity,balance_fine) ");
  	$data = $query->result_array();

  	
 		//pr($data);
  	return $data;
  }

  private function copper(){

  	$data =  $this->process_model->get("product_name,-1 * sum(copper_in-copper_out) as balance_gross ,
																'0.0000' as balance_fine",array('(copper_in-copper_out) !=  '=>0),array(),
																array(
																	'order_by'=>'product_name',
																	'group_by'=>'product_name'
																));
  	
 		//pr($data);
  	return $data;
  }

  private function alloy_vodatar(){

  	$data =  $this->melting_lot_model->get("'Alloy Vodatar' product_name,
																lot_purity,'0.0000' as balance_gross ,
																0-sum(alloy_vodatar*lot_purity/100) as balance_fine",array('alloy_vodatar !='=>0),array(),
																array(
																	'order_by'=>'product_name',
																	'group_by'=>'product_name,lot_purity'
																));
  	
 		//pr($data);
  	return $data;
  }

  private function tounch_department_loss(){

  	$data =  $this->process_model->get("product_name,process_name,
																out_lot_purity,karigar,
																department_name,'0.0000' as balance_gross ,
																sum(balance_tounch_loss_fine) as balance_fine",array('balance_tounch_loss_fine !='=>0),array(),
																array(
																	'order_by'=>'product_name,process_name,out_lot_purity,karigar,department_name',
																	'group_by'=>'product_name,process_name,karigar,department_name,out_lot_purity,balance_fine'
																));
  	
 		//pr($data);
  	return $data;
  }

  private function choco_chain_machine_out(){

  	$data =  $this->process_model->get("product_name,process_name,
																out_lot_purity,karigar,
																department_name,sum(out_weight * out_purity / 100) as balance_gross ,
																sum(out_weight * out_purity / 100 * out_lot_purity / 100) as balance_fine",array('where_not_in' => 
																							array('id'=>'select parent_id from processes 
																										where product_name = "Choco Chain" and process_name 
																										IN ("Final Process","Imp Final Process","Casting Final Process") 
																										and parent_id IS NOT NULL 
																										and department_name = "Start"'),
																				'where'=>array('product_name'=>'Choco Chain','department_name'=>'Chain Making',
																					'process_name'=>'Machine Process',

																				'(out_weight * out_purity / 100) !=' =>0)),array(),
																array(
																	'order_by'=>'product_name,process_name,out_lot_purity,karigar,department_name',
																	'group_by'=>'product_name,process_name,karigar,department_name,out_lot_purity,balance_fine'
																));
  	//lq();
  	
 		//pr($data);
  	return $data;
  }
}