<?php
class System_check_model extends BaseModel{
	protected $table_name = 'processes';
	protected $id = 'id';
	

  public function __construct($data=array()) {
		parent::__construct($data);
		$this->load->model('processes/process_details_model');
		
	}
  
  public function validation_rules($klass='') {
    return $rules=array();
  }

  public function execute_query($data_without_where ){
  	return $this->calculate_according_to_value($data_without_where );
  }

  public function check_data_base($data){
  	$this->attributes = $data['system_checks'];
  	parent::save();
  }

  private function calculate_according_to_value($data_without_where){
	
			$set_array =$data_without_where;

			$set_data = array();
			$balance = $this->process_model->find(
																		'sum(balance) as balance',
																			array('department_name'=>'Start','balance >' => 0))
																									['balance'];

			$set_data['Start Department Balance != 0'] = 
												$this->set_value_in_array(1,$balance,0,0);

			$melting_wastage = $this->process_model->find("sum(melting_wastage) as melting_wastage_out_purity",
																							array('out_purity !=' => 100,
																										'department_name !=' => 'AU+FE'))['melting_wastage_out_purity'];	

			$set_data['Melting Wastage: Out Purity != 100'] = 
										$this->set_value_in_array(2,$melting_wastage,0,0);

			$get_out_weight = $this->issue_department_detail_model->find('sum(out_weight) as out_weight',array('field_name'=>'Melting Wastage'))['out_weight'];	

			$set_data['Out Melting Wastage = Melting lot details required weight'] = 
										$this->set_value_in_array(3,$set_array['out_melting_wastage'],
																								$set_array['required_weight'],
																								0);						

			$set_data['Issue Melting Wastage = Issue Department Out Weight'] = 
										$this->set_value_in_array('3b',$set_array['issue_melting_wastage'],
																								$get_out_weight,
																								0);

			$get_grether_then_melting_wastage = 
												$this->process_model->find(
														' sum(melting_wastage + in_melting_wastage) - sum(out_melting_wastage + issue_melting_wastage + balance_melting_wastage)  as sum_melting_and_issue',

														array('where'=>array('(out_melting_wastage + issue_melting_wastage + balance_melting_wastage) - (melting_wastage + in_melting_wastage) > ' => 0)),'',array('protected_identifier'=>false))['sum_melting_and_issue'];
		
									
			$set_data['Out Melting Wastage + Issue Melting Wastage > In Melting Wastage'] = 
										$this->set_value_in_array(4,$get_grether_then_melting_wastage,0,0);
			
			$get_sum_melting_wast = $this->process_model->find('sum(melting_wastage + in_melting_wastage)  as melting')['melting'];	
			$sum_out_melting_westage = $this->process_model->find('sum(out_melting_wastage + issue_melting_wastage) as sum_out_issue_wastage')['sum_out_issue_wastage']	;							
			$set_data['Balance Melting Wastage: In = Out + Issue + Balance'] = 
												$this->set_value_in_array(5,$get_sum_melting_wast,
																										 $sum_out_melting_westage,
																										 $set_array['balance_melting_wastage']);

			$set_data['Melting Lot Detail Required Weight = Melting Lot Wastage Weight'] = 
												$this->set_value_in_array(6,$set_array['required_weight'],
																										$set_array['wastage_weight'],0);
																

			$set_data['Melting Lot Gross Weight: Match with Melting Lot Details'] = 
															$this->set_value_in_array(7,$set_array['required_weight_alloy_weight'],
																													$set_array['gross_weight_alloy_vodator'],0); 
			

			$get_sum_required = $this->melting_lot_detail_model->find('
									sum(required_weight * (melting_lot_details.in_purity - processes.out_lot_purity) / 100) 
									as sum_required_weight',
															array('melting_lot_details.in_purity != processes.out_lot_purity'=> 
                                                       null),
																														array(
                                                  							array('processes',
							                                                  '`melting_lot_details`.`process_id` = `processes`.`id`',
							                                                  'INNER JOIN'
							                                                  )
                                                						))['sum_required_weight'];


			$set_data['Melting Lot Detail: Process Out Lot Purity should match'] = 
																											$this->set_value_in_array(8,$get_sum_required,0,0); 
																
			$sum_melting_lots_required_weight_not_process_id = 
										$this->melting_lot_detail_model->find(
																	'sum(required_weight) 
                                          as sum_melting_lots_required_weight_not_process_id',
																		array('process_id NOT IN'=> '(select id from processes)'),'',
																		array('is_string'=>false))
																								['sum_melting_lots_required_weight_not_process_id'];
																											
			$set_data['Melting Lot Detail: Missing Processes'] = 
															$this->set_value_in_array(9,
																			$sum_melting_lots_required_weight_not_process_id,0,0); 
															
			$get_daily_drawer_wastage = $this->process_model->find('sum(daily_drawer_wastage) as daily_drawer_wastage',array('out_purity !='=>100))['daily_drawer_wastage'];													

			$set_data['Daily Drawer Wastage: Out Purity != 100'] = $this->set_value_in_array(10,
																																		$get_daily_drawer_wastage,0,0); 


			$drawer_wastage_equal_melting = 
				$this->process_model->find('sum(in_weight) as weight_purity',array('product_name'=>'Daily Drawer',
																									'process_name'=>'Melting',
																									'department_name'=>'Start'))['weight_purity']; 
			$issue_department = $this->issue_department_detail_model->find('sum(out_weight) as issue_weight',
																			array('field_name'=>'Daily Drawer Wastage'))['issue_weight'];																				
			$set_data['Out Daily Drawer Wastage = Daily Drawer Melting Process Start In Weight'] = 			
																	$this->set_value_in_array(11,
																								$set_array['sum_out_daily_drawer_wastage'],
																								$drawer_wastage_equal_melting,
																								0); 
			$process_out_wastage = $this->process_out_wastage_detail_model->find('sum(out_weight) as issue_weight',
																			array('field_name'=>'Daily Drawer Wastage'))['issue_weight'];	
												
			$set_data['Process Out Wastage Out Weight = Daily Drawer Melting Process Start In Weight'] = 			
																	$this->set_value_in_array('11B',
																								$process_out_wastage,
																								$drawer_wastage_equal_melting,
																								0); 
			$sum_out_wastage_issue_department = 
					$this->issue_department_detail_model->find('sum(out_weight) as sum_out_weight',
																			array('field_name'=>'Daily Drawer Wastage'))['sum_out_weight'];				

			$set_data['Issue Daily Drawer Wastage = Issue Department Details out Weight'] = 			
																	$this->set_value_in_array('11C',
																								$set_array['issue_daily_drawer_wastage'],
																								$sum_out_wastage_issue_department,
																								0); 
																
			$daily_out_drawer_wastage = $this->process_model->find(
														'sum(daily_drawer_wastage - out_daily_drawer_wastage - issue_daily_drawer_wastage - balance_daily_drawer_wastage) 
															as daily_drawer_wastage',
															array('where'=>array('daily_drawer_wastage != ( out_daily_drawer_wastage + issue_daily_drawer_wastage + balance_daily_drawer_wastage)'=>null)),'',array('protected_identifier'=>false))['daily_drawer_wastage'];

			
			$set_data['Out Daily Drawer Wastage + Issue Daily Drawer Wastage > In Daily Drawer Wastage'] = 
														$this->set_value_in_array(12,$daily_out_drawer_wastage,0,0); 

			$sum_out_wastage_daily_drawer = $this->process_model->find('sum(out_daily_drawer_wastage + issue_daily_drawer_wastage) as sum_daily_drawer_out')['sum_daily_drawer_out'];																											
			$set_data['Balance Daily Drawer Wastage: In = Out + Issue + Balance'] = 
												$this->set_value_in_array(13,
																$set_array['sum_daily_drawer_wastage'],
																$sum_out_wastage_daily_drawer,
																$set_array['sum_balance_daily_drawer_wastage']); 


			$sum_daily_drawer_wastage_out_lot_purity = $this->process_model->find(
														'sum(daily_drawer_wastage * out_lot_purity / 100) 
                                            as sum_daily_drawer_wastage_out_lot_purity',
														array('id IN'=> 
															'(select process_id from process_out_wastage_details 
                              where field_name ="Daily Drawer Wastage")'),'',
														array('is_string'=>false))['sum_daily_drawer_wastage_out_lot_purity'];

			$daily_drawer_weight = $this->common_query_return('sum(in_weight * in_lot_purity / 100) as weight_purity','Daily Drawer');

			$set_data['Daily Drawer Melting Process Purity: Match with Process Groups'] = 
													$this->set_value_in_array(14,
																$sum_daily_drawer_wastage_out_lot_purity,
																$daily_drawer_weight,0); 

			$ghiss_sum = $this->common_query_return('sum(in_weight) as weight_purity','Ghiss Out');
			$set_data['Ghiss - Out Purity must be 100'] = 
											$this->set_value_in_array(15,$set_array['sum_ghiss'],0,0); 
															
			$ghiss_greater_then = $this->process_model->find('sum(ghiss) as sum_ghiss',
																												array('(issue_ghiss + out_ghiss) > ghiss'=>null))['sum_ghiss'];													
			$set_data['Issue Ghiss + Out Ghiss > In Ghiss'] = 
											$this->set_value_in_array(16,$ghiss_greater_then,0,0); 

			$out_ghiss_issue_ghiss = $this->process_model->find('sum(out_ghiss + issue_ghiss) 
																													 as sum_ghiss')['sum_ghiss'];														
			$set_data['Balance Ghiss: In = Out + Balance'] = 
								$this->set_value_in_array(17,$set_array['sum_ghiss'],
																			$out_ghiss_issue_ghiss,
																			$set_array['sum_blance_ghiss']); 

			$sum_out_weight_check = $this->process_out_wastage_detail_model->find('sum(out_weight) out_weight',
                                                                            array('where' => array('field_name'=>'Ghiss Out'),
                                                                                  'or_where' => array('field_name' => 'Tounch Ghiss Out')))['out_weight'];	
				
			$set_data['Out Ghiss Equals Process Out Wastage Out Weight'] = 
								$this->set_value_in_array('17B',$set_array['sum_out_ghiss'],
																			$sum_out_weight_check,0); 

			$sum_for_process_out_ghiss = $this->process_model->find('sum(in_weight) 
																													     as in_weight',
                                                               array('product_name'=>'Ghiss Out',
                                                                     'department_name'=>'Start'))['in_weight'];								
			$set_data['Process Out Wastage Ghiss Out Equals Ghiss Melting Process In Weight'] = 
								$this->set_value_in_array('17C',$sum_out_weight_check,
																			$sum_for_process_out_ghiss,0); 

			$sum_in_weight_where_ghiss_out = $this->process_model->find('
																sum(in_weight) as in_weight',array(
																		'product_name'=>'Ghiss Out','department_name'=>'Melting'))['in_weight'];	
		

			$set_data['Ghiss Melting Process Start In Weight Equals Ghiss Melting Process Melting In Weight'] = 
								$this->set_value_in_array('17D',$sum_for_process_out_ghiss,
																			$sum_in_weight_where_ghiss_out,0); 

			$sum_in_weight_where_cutting = $this->issue_department_model->find('
																sum(in_weight) as in_weight',array(
																		'product_name'=>'Cutting Ghiss'))['in_weight'];						
			
			$set_data['Process Issue Ghiss Equal Issue Department Ghiss Out'] = 
								$this->set_value_in_array('17E',$set_array['issue_ghiss'],
																			$sum_in_weight_where_cutting,0); 

			$sum_ghiss_out_lot = $this->process_model->find(
																		'sum(ghiss * out_lot_purity / 100) as sum_ghiss_out_lot',
																	array('id IN'=> 
																		'(select process_id from process_out_wastage_details 
		                                where field_name ="Ghiss Out")'),'',
																	array('is_string'=>false))['sum_ghiss_out_lot'];

			$weight_purity_ghiss_out = $this->common_query_return(
																		'sum(in_weight * in_lot_purity / 100) 
                                    as weight_purity','Ghiss Out');


			$set_data['Ghiss Melting Process Purity: Match with Process Groups'] = 
								$this->set_value_in_array(18,$sum_ghiss_out_lot,$weight_purity_ghiss_out,0); 

			$hcl_wastage_sum = $this->common_query_return('sum(in_weight) as weight_purity','HCL');
			$set_data['Out HCL Wastage: Equal HCL Melting In Weight'] = 
													$this->set_value_in_array(19,$set_array['sum_out_hcl_wastage'],
																											$hcl_wastage_sum,0);


			$sum_process_out_wastage_details = $this->process_out_wastage_detail_model->find('
																sum(out_weight) as out_weight',array(
																		'field_name'=>'HCL Wastage'))['out_weight'];												
			$set_data['Out HCL Wastage: Equal to Process Out Wastage Details Out Weight'] = 
													$this->set_value_in_array('19B',$set_array['sum_out_hcl_wastage'],
																											$sum_process_out_wastage_details,0);

			
			$sum_in_weight_hcl_process = $this->process_model->find('
																sum(in_weight) as in_weight',array(
																		'product_name'=>'HCL','department_name'=>'HCL Process'))['in_weight'];											
			$set_data['HCL Melting Process Start In Equals HCL Melting Process HCL Process In Weight'] = 
													$this->set_value_in_array('19C',$hcl_wastage_sum,
																											$sum_in_weight_hcl_process,0);											

			$hcl_greater_then = $this->process_model->find('sum(hcl_wastage) as hcl_wastage',
																												array('out_hcl_wastage > hcl_wastage'=>null))['hcl_wastage'];	



			$set_data['Out HCL Wastage > In HCL Wastage'] = 
										$this->set_value_in_array(20,$hcl_greater_then,0,0);
																
			$set_data['Balance HCL Wastage: In = Out + Balance'] = 
										$this->set_value_in_array(21,$set_array['sum_hcl_wastage'],
																								$set_array['sum_out_hcl_wastage'],
																								$set_array['sum_balance_hcl_wastage']);
			
			$sum_hcl_wastage_out_purity_out_lot_purity = $this->process_model->find(
																		' sum(hcl_wastage * out_purity / 100 * out_lot_purity / 100) 
                                    	as sum_hcl_wastage_out_purity_out_lot_purity',
																	array('id IN'=> 
																		'(select process_id from process_out_wastage_details 
		                                where field_name ="HCL Wastage")'),'',
																	array('is_string'=>false))['sum_hcl_wastage_out_purity_out_lot_purity'];								
			$sum_hcl_in_weight_in_purity_in_lot_purity = $this->common_query_return(
													'sum(in_weight * in_purity / 100 * in_lot_purity / 100) 
                                    as weight_purity','HCL');
			$set_data['HCL Melting Process Lot Purity: Match with Process Groups'] = 
										$this->set_value_in_array(22,$sum_hcl_wastage_out_purity_out_lot_purity,
																								$sum_hcl_in_weight_in_purity_in_lot_purity,0);

			$sum_in_weight_in_purity_hcl = $this->common_query_return(
													'sum(in_weight * in_purity / 100) as weight_purity','HCL');

			$sum_hcl_wastage_out_purity = $this->process_model->find(
																		'sum(hcl_wastage * out_purity / 100) as sum_hcl_wastage_out_purity',
																							array('id IN'=> 
																								'(select process_id from process_out_wastage_details 
		                                            where field_name ="HCL Wastage")'),'',
																							array('is_string'=>false))['sum_hcl_wastage_out_purity'];	

			$set_data['HCL Melting Process Purity: Match with Process Groups'] = 
													$this->set_value_in_array(23,$sum_hcl_wastage_out_purity,
																											$sum_in_weight_in_purity_hcl,0);

			$tounch_greater_then = $this->process_model->find(' sum(tounch_in) as tounch_in',
																												array('tounch_out >'=>0))['tounch_in'];	
			$set_data['Tounch Report: Tounch In = Tounch Out + Tounch Ghiss'] = 
														$this->set_value_in_array(24,$tounch_greater_then,
																											$set_array['sum_tounch_out'],$set_array['sum_tounch_ghiss']);

			$tounch_fine_greater_then = $this->process_model->find(
				'sum(in_weight * (in_lot_purity - tounch_purity) / 100) as tounch_fine',
						array('tounch_out >'=>0,'tounch_purity = out_lot_purity'=>null))['tounch_fine'];
																																
			$set_data['Tounch Report: Tounch Fine'] = 
													$this->set_value_in_array(25,$set_array['sum_tounch_fine_in'],
																											$tounch_fine_greater_then,0);

			$tounch_out_weight = $this->common_query_return('sum(in_weight) as weight_purity','Tounch Out');
			$set_data['Tounch Out: Equals Melting Process In Weight'] = 
												$this->set_value_in_array(27,$set_array['sum_out_tounch_out'],
																											$tounch_out_weight,0);

			$out_tounch_greater = $this->process_model->find(
																		'sum(out_tounch_out) as out_touch_out',
																				array('out_tounch_out > tounch_out'=> null))['out_touch_out'];															
			$set_data['Out Tounch Out > In Tounch Out'] = 
												$this->set_value_in_array(28,$out_tounch_greater,0,0);
															
			$set_data['Balance Tounch Out: In = Out + Balance'] = 
												$this->set_value_in_array(29,$set_array['sum_tounch_out'],
																										$set_array['sum_out_tounch_out'],
																										$set_array['sum_balance_tounch_out']);
																


			$sum_in_wieght_in_lot_purity = $this->common_query_return("sum(in_weight * in_lot_purity / 100) 
																												as weight_purity",'Tounch Out');



			$tounch_out_out_lot_purity = $this->process_model->find(
																		'sum(tounch_out * tounch_purity / 100)  as tounch_out_out_lot_purity',
																							array('id IN'=> 
																								'(select process_id from process_out_wastage_details 
		                                            where field_name ="Tounch Out")'),'',
																							array('is_string'=>false))['tounch_out_out_lot_purity'];	


			$set_data['Tounch Out Process Purity: Match with Process Groups'] = 
												$this->set_value_in_array(30,$tounch_out_out_lot_purity,
																										$sum_in_wieght_in_lot_purity,0);


			$out_loss_weight = $this->common_query_return('sum(in_weight) as weight_purity','Loss Out');													
			$set_data['Out Loss Out: Equal Loss Out Melting In Weight'] = 
												$this->set_value_in_array(31,$set_array['sum_out_loss'],$out_loss_weight,0);
											
			$out_loss_greater = $this->process_model->find(
																		'sum(out_loss) as out_loss',
																				array('out_loss > loss'=> null))['out_loss'];													
			$set_data['Out Loss Out > In Loss Out'] = $this->set_value_in_array(32,$out_loss_greater,0,0);			

			$set_data['Balance Loss Out: In = Out + Balance'] = 
															$this->set_value_in_array(33,$set_array['sum_loss'] ,
																$set_array['sum_out_loss'],$set_array['sum_balance_loss']);
																							
		
			$get_loss_out = $this->process_model->find('sum(out_loss * out_purity / 100) as loss_out_in',
														array('id IN ' => '(select process_id from process_out_wastage_details 
		                                            where field_name ="Loss Out")'),'',
														array('is_string'=>false))['loss_out_in'];

			$get_loss_out_sum = $this->common_query_return('sum(in_weight * in_purity / 100) as weight_purity','Loss Out');
																											
			$set_data['Loss Out Process Purity: Match with Process Groups'] = 
																	$this->set_value_in_array(34,$get_loss_out ,$get_loss_out_sum,0);

		 	$get_loss_out = $this->process_model->find(
		 																			'sum(out_loss * out_purity * out_lot_purity / 100) 
		 																				as loss_out_in',
																						array('id IN ' => 
																									'(select process_id from process_out_wastage_details 
										                                            where field_name ="Loss Out")'),'',
																						array('is_string'=>false))['loss_out_in'];

			$get_loss_out_sum = $this->common_query_return('sum(in_weight * in_purity * in_lot_purity / 100) 
																											as weight_purity','Loss Out');

			$set_data['Loss Out Process Lot Purity: Match with Process Groups'] = 
								$this->set_value_in_array(35,$get_loss_out ,$get_loss_out_sum,0);

			$get_issue_department_data = $this->issue_department_detail_model->find(
																							'sum(out_weight) as out_weight',
																							array(
																								'where_not_in'=>array('field_name'=>
																								array('Melting Wastage', 'Daily Drawer Wastage', 'Repair Out', 'HCL Loss', 'Tounch Loss Fine', 'Cutting Ghiss'))),
																							'',
																							array('is_string'=>true))['out_weight'];	
																							
																																					
			$set_data['GPC Issue: Issue Out = Issue Department Out Weight'] = 
									$this->set_value_in_array(36,$set_array['issue_gpc_out'] ,$get_issue_department_data,0);

			$issue_out = $this->process_model->find(
																							'sum(issue_gpc_out) as issue_out',
																							array('issue_gpc_out > gpc_out' => null,
																									'where_in'=>array('department_name'=>array('GPC', 'GPC or Rodium'))),
																							'',
																							array('is_string'=>true))['issue_out'];	
																																				
			$set_data['Issue GPC Out > GPC out weight'] = $this->set_value_in_array(37,$issue_out,0,0);

			$ghiss = $this->process_model->find('sum(ghiss) as ghiss',array('out_purity !='=>100))['ghiss'];
			$set_data['Ghiss: Out Purity != 100'] = $this->set_value_in_array(38,$ghiss ,0,0);

			
			$get_expected_sum = $this->process_model->find('sum(expected_out_weight) as expected_out',
																								array('where_in'=>
																									array('department_name'=>
																										array('HCL','HCL Process')
																									)
																								)
																,'',array('is_string'=>true))['expected_out'];
			
			$get_expected_calculated_sum = $this->process_model->find('sum(in_weight * in_purity / 100) as expected_out',
																								array('where_in'=>
																									array('department_name'=>
																										array('HCL','HCL Process')
																									)
																								)
																,'',array('is_string'=>true))['expected_out'];
			

			$set_data['Expected Out Calculation in HCL and HCL Process'] = 
																	$this->set_value_in_array(39,$get_expected_sum ,$get_expected_calculated_sum,0);

			$hcl_loss = $this->process_model->find('sum(hcl_loss) as hcl_loss', 
																							array('strip_cutting_process_id' => 0,
																										'where_in'=> array('department_name'=> array("'HCL'","'HCL Process'"))))['hcl_loss'];

			$expected_out_weight = $this->process_model->find(
																	' sum(expected_out_weight - out_weight - daily_drawer_in_weight) as expected_out_weight',
																	array(
																		'strip_cutting_process_id' => 0,
																		'(out_weight > 0 OR daily_drawer_in_weight > 0)'=>null,
																		'where_in'=> array('department_name'=> 
																		array("'HCL'","'HCL Process'"))))['expected_out_weight'];
			
			

			$set_data['HCL Loss Calculation in HCL and HCL Process'] = $this->set_value_in_array(40, $hcl_loss, $expected_out_weight, 0);

			$hook_in = $this->process_field_model->find('sum(hook_in) as hook_in', array('hook_in >' => 0,
																																						 'daily_drawer_type' => ''))['hook_in'];		
			$hook_out = $this->process_field_model->find('sum(hook_in) as hook_out', array('hook_out >' => 0,
																																						 'daily_drawer_type' => ''))['hook_out'];		

			$set_data['Process Details with hook_in > 0 or hook_out > 0 and empty DD type'] = 
																	$this->set_value_in_array(41,$hook_in + $hook_out ,0,0);

			$hook_in_hook_out_kdm = $this->process_model->find('sum(hook_in - hook_out) as hook_in_hook_out',
																								array('where'=>array('(hook_in > 0 or hook_out > 0)'=>null,'hook_kdm_purity'=>0),
																								))['hook_in_hook_out'];																
			
			$set_data['Process details with hook_in > 0 or hook_out > 0 and empty 
																															hook_kdm_purity'] = 
																$this->set_value_in_array(42,$hook_in_hook_out_kdm ,0,0);

			$hook_in_hook_out_ddt = $this->process_field_model->find('sum(hook_in - hook_out) as hook_in_hook_out',
																								array('where'=>array('(hook_in > 0 or hook_out > 0)'=>null,'daily_drawer_type'=>''),
																								))['hook_in_hook_out'];															
																
			$set_data['Processes with hook_in > 0 or hook_out > 0 and empty hook_kdm_purity'] = 
																$this->set_value_in_array(43,$hook_in_hook_out_ddt ,0,0);

			$get_sisma_chain_machine_out_in_balance = $this->process_model->find('sum(out_weight) as out_weight',
																																array('product_name'=>'Sisma Chain',
																																			'process_name'=>'Sisma Machine Process',
				
																																			'department_name'=>'Sisma Machine'))['out_weight'];

			$get_sisma_chain_machine_out_out_balance = $this->process_model->find('sum(out_weight) as out_weight',
																																array('product_name'=>'Sisma Chain',
																																			'process_name'=>'Karigar Process',
																																			'department_name'=>'Start'))['out_weight'];
			
			$get_sisma_chain_machine_out_balance = $this->process_model->find('sum(out_weight) as out_weight',
																																array('product_name'=>'Sisma Chain',
																																			'process_name'=>'Rnd Process',
																																			'department_name'=>'Start'))['out_weight'];
			
			$set_data['System Check: SISMA Machine out = Sisma Karigar in + RND in + Issue Process IN'] = 
																$this->set_value_in_array(44,$get_sisma_chain_machine_out_in_balance ,$get_sisma_chain_machine_out_out_balance,$get_sisma_chain_machine_out_balance);

			$get_in_balance_daily_drawer_SSR = $this->process_model->find('sum((daily_drawer_in_weight - hook_in + hook_out - daily_drawer_out_weight) * hook_kdm_purity / 100) as sum_dd_ssr')['sum_dd_ssr'];
			$out_balance_dd_ssr = $this->process_model->find(' sum(daily_drawer_in_weight * hook_kdm_purity / 100) as out_sum_dd_ssr')['out_sum_dd_ssr'];

			$balance_dd_ssr = $this->process_details_model->find('  sum((hook_in-hook_out+daily_drawer_out_weight) * hook_kdm_purity / 100) as balance_dd_ssr')['balance_dd_ssr'];


			$set_data['SSR DD Balance Fine = DDS OO Balance Fine'] =  array(
																		'serial_no'=>45,
																		'in_balance'=>$get_in_balance_daily_drawer_SSR,
																		'out_balance'=>$out_balance_dd_ssr,
																		'diff'=>round($get_in_balance_daily_drawer_SSR,4) - round($out_balance_dd_ssr,4) + round($balance_dd_ssr,4),
																		'balance'=>$balance_dd_ssr);


			$daily_drawer_weight_in = $this->process_model->find('sum(daily_drawer_in_weight) as daily_drawer_weight',array('out_purity !='=>100,'daily_drawer_in_weight >'=>0))['daily_drawer_weight'];			

			$set_data['Daily Drawer Receipt in_purity and out_purity must be 100'] = $this->set_value_in_array(46,$daily_drawer_weight_in ,0,0);

			$count = $this->process_details_model->find('count(*) as count',array('process_id NOT IN (select id from processes)'=>NULL))['count'];
							
			$set_data['Show count of process_details records that do not have process records'] = $this->set_value_in_array(47,$count ,0,0);

			$query = $this->db->query("select count(melting_lot_details.id) as c from melting_lots inner join melting_lot_details on melting_lot_details.melting_lot_id = melting_lots.id group by melting_lots.id having c = 0;");
			$melting_lot_entry = $query->row_array()['count'];

			$set_data['Melting lots should have atleast 1 melting_lot_detail entry'] = $this->set_value_in_array(48,$melting_lot_entry ,0,0);

			$para_49_1 = $this->process_model->find('sum(in_weight)  as in_weight',array('product_name'=>'Indo tally Chain','process_name'=>'Spring Process','department_name'=>'Spring'))['in_weight'];

			$para_49_2 = $this->process_model->find('sum(out_weight)  as out_weight',array('product_name'=>'Indo tally Chain','process_name'=>'AG Flatting','department_name'=>'Wire Drawing'))['out_weight'];

			$para_49_3 = $this->process_model->find('sum(out_weight)  as out_weight',array('product_name'=>'Indo tally Chain','process_name'=>'PL Flatting','department_name'=>'Wire Drawing'))['out_weight'];

			$set_data['Indo Tally Spring In Weight Equals Wire Drawing Out Weight'] = $this->set_value_in_array(49,$para_49_1 ,$para_49_2,$para_49_3);

			
			$set_data['Pending Ghiss'] = $this->set_value_in_array(50,$set_array['pending_ghiss'] ,$set_array['out_pending_ghiss'],$set_array['balance_pending_ghiss']);

			$para_50B_2 = $this->process_model->find('sum(in_weight)  as in_weight',array('product_name'=>'Pending Ghiss Out'))['in_weight'];

			$set_data['Out Pending Ghiss Equals Pending Ghiss Out In Weight'] = $this->set_value_in_array("50B",$set_array['out_pending_ghiss'] ,$para_50B_2,0);

			$para_50C_2 = $this->process_model->find('sum(ghiss)  as ghiss',array('product_name'=>'Pending Ghiss Out'))['ghiss'];

			$set_data['Out Pending Ghiss Equals Ghiss In'] = $this->set_value_in_array("50C",$para_50B_2 ,$para_50C_2,0);

			$para_50D_1 = $this->process_model->find('sum(pending_ghiss)  as pending_ghiss',array('wastage_purity !='=>100))['pending_ghiss'];

			$set_data['Pending Ghiss: Wastage Purity must be 100'] = $this->set_value_in_array("50D",$para_50D_1 ,0,0);
			

		return $set_data;
  }

  function common_query_return($select,$where_value){
  	return $this->process_model->find($select,
												array('product_name' => $where_value,'department_name'=>'Start'))['weight_purity'];
  }

  function set_value_in_array($serial_no,$in,$out,$bal){
  	$set_array_data = array(
																	'serial_no'=>$serial_no,
																	'in_balance'=>$in,
																	'out_balance'=>$out,
																	'diff'=>round($in,4) - round($out,4) - round($bal,4),
																	'balance'=>$bal);
  	return $set_array_data;
  }

  /*$set_data['balance'] = $record_value['balance'];
			if($record_value['wastage_weight'] == $record_value['required_weight'])
				$set_data['Melting Lot Wastage Weight'] = 0;
			else $set_data['Melting Lot Wastage Weight'] = $record_value['wastage_weight'];*/
}