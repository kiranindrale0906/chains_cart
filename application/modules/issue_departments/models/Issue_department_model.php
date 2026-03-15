<?php 
class Issue_department_model extends BaseModel{
	protected $table_name= 'issue_departments';
	public function __construct($data = array()){
		parent::__construct($data);
    $this->load->model(array('processes/Process_model','api/Receipt_not_sent_argold_account_model',
    												 /*'chitties/chitti_detail_model','chitties/chitty_model'*/));
	}

	public function before_validate() {
		if ($this->formdata['field_name'] == 'Tounch Loss Fine')
			$this->formdata['issue_department_details'] = $this->process_model->get('id as process_id, balance_tounch_loss_fine as out_weight',array('balance_tounch_loss_fine != 0' => NULL));
	
		if ((!isset($this->formdata['issue_department_details'])  || empty($this->formdata['issue_department_details'])) && (empty($this->formdata['issue_department_chitti_details'])))  return;

		$in_weight = 0;
		$in_fine = 0;
		$this->formdata['issue_departments']['in_fine']   = 0;
		$this->formdata['issue_departments']['out_fine']  = 0;
		$this->formdata['issue_departments']['packet_no'] = $this->issue_department_model->find('max(packet_no) as packet_no')['packet_no']+1;

        if (!empty($this->attributes['status'])&&$this->attributes['status'] == 0) {
          $this->attributes['status'] = 1;
        }

		/*if(!empty($this->formdata['issue_department_chitti_details'])){
			$chitti_ids=array_column($this->formdata['issue_department_chitti_details'], 'chitti_id');
			$chitti_details=$this->chitti_detail_model->get('',array('where_in'=>array('chitti_id'=>$chitti_ids)));
			$chittis=$this->chitty_model->find('sum(out_purity * in_weight) / sum(in_weight) as out_purity,sum(wastage_fine) as out_fine',array('where_in'=>array('id'=>$chitti_ids)));
			foreach ($chitti_details as $index => $chitti_detail) {
				$this->formdata['issue_department_details'][$index]['out_weight']=$chitti_detail['in_weight'];
				$this->formdata['issue_department_details'][$index]['chitti_id']=$chitti_detail['chitti_id'];
				$this->formdata['issue_department_details'][$index]['process_id']=$chitti_detail['process_id'];
			}
			 $this->formdata['issue_departments']['out_purity'] = $chittis['out_purity'];
			 $this->formdata['issue_departments']['out_fine'] = $chittis['out_fine'];
		}*/

		foreach ($this->formdata['issue_department_details'] as $index => $issue_department_detail) {

			if (!isset($issue_department_detail['process_id'])) continue;
			if ($this->formdata['field_name'] == 'Tounch Loss Fine') continue;

			if (!isset($issue_department_detail['out_weight']) || empty($issue_department_detail['out_weight'])) {
				if ($this->formdata['field_name'] == 'Melting Wastage'||
				    $this->formdata['field_name'] == 'Daily Drawer Wastage' ||
				    $this->formdata['field_name'] == 'GPC Out'|| 
				    $this->formdata['field_name'] == 'Finish Good' || 
				    $this->formdata['field_name'] == 'GPC Repair Out' ||
				    // $this->formdata['field_name'] == 'Huid' ||
				    $this->formdata['field_name'] == 'GPC Loss Out' || 
				    $this->formdata['field_name'] == 'Finished Goods Receipt')
				continue;
			}
			$process = $this->Process_model->find('', array('id' => $issue_department_detail['process_id']));
			if ($this->formdata['field_name'] == 'Melting Wastage') {
				if ($issue_department_detail['out_weight'] > $process['balance_melting_wastage']) 
					$issue_department_detail['out_weight'] = $process['balance_melting_wastage'];	
			} elseif ($this->formdata['field_name'] == 'Daily Drawer Wastage'){
				if ($issue_department_detail['out_weight'] > $process['balance_daily_drawer_wastage']) 
					$issue_department_detail['out_weight'] = $process['balance_daily_drawer_wastage'];	
			} elseif ($this->formdata['field_name'] == 'HCL Loss'){
				$issue_department_detail['out_weight'] = $process['balance_hcl_loss'];	
			}elseif ($this->formdata['field_name'] == 'Refine Loss'){
				$issue_department_detail['out_weight'] = $process['balance_refine_loss'];	
			} elseif ($this->formdata['field_name'] == 'Tounch Loss Fine'){
				$issue_department_detail['out_weight'] = $process['balance_tounch_loss_fine'];	
			}elseif ($this->formdata['field_name'] == 'Tounch Loss Fine'){
				$issue_department_detail['out_weight'] = $process['balance_tounch_loss_fine'];	
			} elseif ($this->formdata['field_name'] == 'Export Internal'){
				$issue_department_detail['out_weight'] = $process['balance_rejected'];	
			} elseif ($this->formdata['field_name'] == 'Domestic Internal'){
				$issue_department_detail['out_weight'] = $process['balance_rejected'];
			}elseif ($this->formdata['field_name'] == 'Fire Tounch Loss'){
				$issue_department_detail['out_weight'] = $process['balance_refine_loss'];	
			}elseif ($this->formdata['field_name'] == 'Packing Slip'){
				$process = $this->packing_slip_detail_model->find('sum(gross_weight) as gross_weight,sum(pure) as pure', array('packing_slip_id' => $issue_department_detail['process_id']));
				$issue_department_detail['out_weight'] = $process['gross_weight'];	
			} elseif ($this->formdata['field_name'] == 'Cutting Ghiss' || $this->formdata['field_name'] == 'Ice Cutting Ghiss'|| $this->formdata['field_name'] == 'Hand Cutting Ghiss'|| $this->formdata['field_name'] == 'Hand Dull Ghiss'|| $this->formdata['field_name'] == 'Sand Dull Ghiss'){
				$issue_department_detail['out_weight'] = $process['balance_ghiss'];	
			} elseif ($this->formdata['field_name'] == 'Ghiss Melting Loss'|| $this->formdata['field_name'] == 'Castic Loss'){
				$issue_department_detail['out_weight'] = $process['loss'];	
			}elseif ($this->formdata['field_name'] == 'Hallmark Out'){
				$issue_department_detail['out_weight'] = $process['hallmark_out'];	
			} elseif ($this->formdata['field_name'] == 'GPC Out' ||
							  // $this->formdata['field_name'] == 'QC Out' ||
							  $this->formdata['field_name'] == 'Finish Good' || 
							  // $this->formdata['field_name'] == 'Hallmark Receipt' || 
							  $this->formdata['field_name'] == 'GPC Repair Out' || 
							  $this->formdata['field_name'] == 'GPC Loss Out'){
				if ($issue_department_detail['out_weight'] > $process['balance_gpc_out']) 
					$issue_department_detail['out_weight'] = $process['balance_gpc_out'];	
			} elseif ($this->formdata['field_name'] == 'Finished Goods Receipt'){
				if ($issue_department_detail['out_weight'] > $process['balance_gpc_out']) 
					$issue_department_detail['out_weight'] = $process['balance_gpc_out'];	
			} else 
				$issue_department_detail['out_weight'] = $process['balance_gpc_out'];
//pd($issue_department_detail);

			$this->formdata['issue_department_details'][$index]['out_weight'] = $issue_department_detail['out_weight']; 	
			// $this->formdata['issue_department_details'][$index]['quantity'] = $issue_department_detail['quantity']; 	

			$in_weight = $in_weight + $issue_department_detail['out_weight'];
			if ($this->formdata['field_name'] == 'Melting Wastage') {
				$in_fine = $in_fine + (($issue_department_detail['out_weight']*$process['wastage_lot_purity'])/100); 
			}
			elseif($this->formdata['field_name'] == 'Packing Slip'){
				$in_fine = $in_fine + (($issue_department_detail['out_weight']*(($process['pure']/$process['gross_weight'])*100))/100); 

			}else{

				$in_fine = $in_fine + (($issue_department_detail['out_weight']*$process['out_lot_purity'])/100); 
			}
		}
		if ($this->formdata['field_name'] == 'Tounch Loss Fine') {
      $in_fine = $in_weight;
		}

		if($this->formdata['field_name'] == 'Fire Tounch Loss'){
				$this->formdata['issue_departments']['in_fine'] = (($this->attributes['in_weight']*$this->attributes['in_purity'])/100); 
				$this->formdata['issue_departments']['out_fine'] = (($this->attributes['in_weight']*$this->attributes['out_purity'])/100);
				$this->formdata['issue_departments']['in_purity'] = ($this->attributes['in_purity']);
				$this->formdata['issue_departments']['out_purity'] = ($this->attributes['out_purity']);

			}
    $this->formdata['issue_departments']['in_weight'] = ($this->formdata['field_name'] == 'Tounch Loss Fine') ? 0 : $in_weight; 
		if($this->formdata['field_name'] != 'Fire Tounch Loss'){
    if(!empty($in_weight)) $this->formdata['issue_departments']['in_purity'] = (($in_fine / $in_weight) * 100);
	  }	
	if ($this->formdata['field_name'] == 'Tounch Loss Fine') $this->formdata['issue_departments']['in_purity'] = 100; 
		$this->formdata['issue_departments']['in_fine'] = $in_fine ;

		
		$domestic_account_names=$this->get_account_names_from_accounts("Domestic");
		if (   !isset($this->formdata['issue_departments']['out_purity']) 
        || empty($this->formdata['issue_departments']['out_purity'])
        || (!in_array($this->attributes['account_id'], $domestic_account_names ) ))
	 	  $this->formdata['issue_departments']['out_purity'] = $this->formdata['issue_departments']['in_purity'];

		if(!empty($this->formdata['issue_departments']['out_purity'])) {
			$this->formdata['issue_departments']['out_fine'] = (($in_weight * $this->formdata['issue_departments']['out_purity'])  / 100);
			$this->formdata['issue_departments']['wastage_percentage'] =!empty(($this->formdata['issue_departments']['out_fine']- $this->formdata['issue_departments']['in_fine']))? ($this->formdata['issue_departments']['out_fine']- $this->formdata['issue_departments']['in_fine']):0;
		}
    
		$chain_margin=0;
		if($this->attributes['product_name']=='Ghiss Melting Loss')
	  	$this->formdata['department_name']=$this->formdata['issue_departments']['department_name'];
	  	unset($this->formdata['issue_departments']['chain_purity']);
		unset($this->formdata['issue_departments']['department_name']);
		unset($this->formdata['issue_departments']['parent_lot_name']);
//pd($this->attributes);
	}

	public function save($after_save=false) {
    $issue_departments_master_array = $this->get_issue_departments_master_array();
    if(!isset($_GET['from']) && $_GET['from']!='view') {
        foreach ($issue_departments_master_array as $index => $issue_department) {
          $issue_department_details = $issue_department['issue_department_details'];
          unset($issue_department['issue_department_details']);

          if (empty($issue_department['description'])) $issue_department['description'] = $this->attributes['description'];
		// pd($issue_department);
          $issue_department_obj = new Issue_department_model($issue_department);
          $issue_department_obj->store(false);

          foreach ($issue_department_details as $issue_department_detail) {
              $issue_department_detail_obj = new Issue_department_detail_model($issue_department_detail);
              $issue_department_detail_obj->attributes['issue_department_id'] = $issue_department_obj->attributes['id'];
              $issue_department_detail_obj->store();
              if ($this->formdata['field_name'] == 'Tounch Loss Fine') pd(1);
          }

          if ($this->attributes['product_name'] == 'GPC Repair Out') {
              $process = array('repair_out' => $issue_department['in_weight'], 
                                         'in_lot_purity' => $issue_department['in_purity'],
                                           'quantity' => 1,
                                           'description' => $issue_department['description'],
                                           'hook_kdm_purity' => $issue_department['hook_kdm_purity'],
                                           'account' => '',
                                           'process_name' => 'Refresh Hold',
                                           'product_name' => $this->attributes['product_name'],
                                           'id' => '');	
              $this->load->model('refresh/refresh_hold_model');
        $attributes = $this->refresh_hold_model->create_refresh_records($process, 'No');
        foreach ($issue_department_details as $issue_department_detail) {
          $this->save_refresh_details($attributes, $issue_department_detail);
        }
          }

          if ($this->attributes['product_name'] != 'GPC Repair Out' && 
                  $this->attributes['product_name'] != 'GPC Loss Out') {
          	if($this->attributes['product_name']=='Ghiss Melting Loss'){
          	$issue_department_obj->attributes['department_name']=$this->attributes['product_name'].'-'.$this->formdata['department_name'];
          	}
              $this->send_request_to_argold_accounts($issue_department_obj->attributes);  
          }

		}
      } else {
        if($this->attributes['status']==0) {
          $this->attributes['status']=1;
        }
        parent::save($after_save);
      }
		
	}

	private function save_refresh_details($attributes,$process) {
    $repair_out_details=array(
      'process_id'=>$process['process_id']
    );
    $repair_out_detail_obj = new process_out_wastage_detail_model($repair_out_details);
    $repair_out_detail_obj->attributes['parent_id'] = $attributes['id'];
    $repair_out_detail_obj->attributes['out_weight'] = $process['out_weight'];
    $repair_out_detail_obj->attributes['field_name'] = 'Repair Out';
    $repair_out_detail_obj->save();
  }

	private function get_issue_departments_master_array() {
		foreach ($this->formdata['issue_department_details'] as $index => $issue_department_detail) { 
	  	if ($issue_department_detail['out_weight'] == 0 ) continue;

	  	$process= $this->Process_model->find('id, product_name,design_code,customer_name,machine_size,melting_lot_category_one,melting_lot_category_four,out_lot_purity,sum(quantity) as quantity,tone', array('id' => $issue_department_detail['process_id']));
    	$chain_margin       = $this->issue_purity_model->get_issue_wastage($issue_department_detail['process_id'], @$this->attributes['account_id']);

    	$export_account_names=$this->get_account_names_from_accounts("Export");
		$usd_margin=0;$inr_margin=0;
		if(!empty($this->attributes['account_id'])){
    	if (in_array($this->attributes['account_id'],$export_account_names)) {
    		$usd_margin = $this->issue_purity_model->get_usd_wastage($issue_department_detail['process_id'], $this->attributes['account_id']);
        }
        $domestic_labour_account_names=$this->get_account_names_from_accounts("Domestic Labour Account");

        if (in_array($this->attributes['account_id'], $domestic_labour_account_names)) {
			$inr_margin       = $this->issue_purity_model->get_inr_wastage($issue_department_detail['process_id'], $this->attributes['account_id']);
	    }

    	$chitti_purity      = $this->issue_purity_model->get_issue_chitti_purity($issue_department_detail['process_id'], $this->attributes['account_id']);
	if($this->attributes['product_name']!="Packing Slip"){

	$design_chitti_name = $this->category_four_model->get_chitti_design_name($process['id']);
	}
        $domestic_account_names=$this->get_account_names_from_accounts("Domestic");
        $domestic_labour_account_names=$this->get_account_names_from_accounts("Domestic Labour Account");
      	if ( (!in_array($this->attributes['account_id'],$domestic_account_names)   
          && !in_array($this->attributes['account_id'],$domestic_labour_account_names) )  
				|| (!in_array($this->attributes['product_name'], array('GPC Out', 'GPC Repair Out', 'Repair Out', 'Chitti Out', 'Finish Good', 'Huid', 'Hallmark Receipt', 'Hallmark Out','Export Internal', 'Packing Slip','Domestic Internal')))) {
				$chain_margin = 0;
        $chitti_purity = $this->attributes['in_purity'];
        $this->attributes['packet_no'] = 0;
      }}
      if($process['product_name']=="KA Chain" || $process['product_name']=="Ball Chain"){
      $item_code_detail=$this->item_code_master_model->find('item_code',array('product_name'=>$process['product_name'],'melting_lot_category_one'=>$process['melting_lot_category_one'],'machine_size'=>$process['machine_size'],'melting'=>$process['out_lot_purity']));
      }else{
      $item_code_detail=$this->item_code_master_model->find('item_code',array('product_name'=>$process['product_name'],'design_name'=>$process['melting_lot_category_one'],'melting'=>$process['out_lot_purity'],'tone'=>$process['tone']));
    }
      $item_code="";
      if(!empty($item_code_detail)){
      	$item_code=$item_code_detail['item_code'];
      }
      if (in_array($this->attributes['product_name'], array('GPC Out','QC Out', 'Finish Good', 'Finished Goods Receipt', 'Chitti Out', 'Repair Out'))) {
        if ($process['product_name'] == 'KA Chain' || $process['product_name'] == 'Ball Chain')
      		if ($process['customer_name'] == '')
      			$master_array_key = $index;
      		else
      			$master_array_key = $process['product_name'].' '.$process['customer_name'].' '.$chain_margin.' '.$usd_margin.' '.$inr_margin.''.$item_code;
        //  elseif ($process['product_name'] == 'Machine Chain' && $process['melting_lot_category_one'] == 'Spyke')
        //    $master_array_key = $process['product_name'].' '.$process['melting_lot_category_one'];  
      	//  elseif ($process['product_name'] == 'Sisma Chain')
      	// 	  $master_array_key = $process['product_name'].' '.$process['melting_lot_category_one'];
        elseif (!empty($process['melting_lot_category_one'])){
          $master_array_key = $process['product_name'].' '.$process['melting_lot_category_one'].' '.$chain_margin.' '.$usd_margin.' '.$inr_margin.''.$item_code;
      	}else
    	  $master_array_key = $process['product_name'].' '.$chain_margin.' '.$usd_margin.' '.$inr_margin.''.$item_code;

      } else
        $master_array_key = $this->attributes['product_name'];
      
      if($this->attributes['account_id']=="MALABAR GOLD" || $this->attributes['account_id']=="P.N.GADGIL AND SONS LTD"){
      	$this->attributes['in_purity']=91.80;
      }

    	if (!isset($issue_departments_master_array[$master_array_key])) {
    		$issue_departments_master_array[$master_array_key] = array(
	    		'product_name'       => $this->attributes['product_name'],
	    		'internal_wastage'       => !empty($this->attributes['internal_wastage'])?$this->attributes['internal_wastage']:0,
	    		'account_id'         => @$this->attributes['account_id'],
	    		'quantity'         => @$this->attributes['quantity'],
	    		'chain_name'         =>!empty($process['product_name'])?$process['product_name']:$this->attributes['product_name'],
	    		'in_purity'          => $this->attributes['in_purity'],
	    		'out_purity'         => $this->attributes['in_purity'] + $chain_margin,
	    		'wastage_percentage' =>!empty($chain_margin)? $chain_margin:0,
	    		'usd_wastage_percentage' => $usd_margin,
	    		'inr_wastage_percentage' => $inr_margin,
	    		'item_code' => $item_code,
	    		'chitti_purity'      => @$chitti_purity,
	    		'packet_no'          => $this->attributes['packet_no'],
	    		'customer_name'          =>!empty($process['customer_name'])?$process['customer_name']:@$this->attributes['customer_name'],
	    		'hook_kdm_purity'    => (isset($this->attributes['hook_kdm_purity'])) ? $this->attributes['hook_kdm_purity'] : 0.0000,
	    		'issue_department_details' => array()
	  		);
	  	}
  		
		if (!isset($issue_departments_master_array[$master_array_key]['in_weight'])) {
			$issue_departments_master_array[$master_array_key]['in_weight']   = 0;
			$issue_departments_master_array[$master_array_key]['in_fine']     = 0;
			$issue_departments_master_array[$master_array_key]['out_fine']    = 0;
        if (in_array($this->attributes['product_name'], array('GPC Out', 'Repair Out', 'Chitti Out')))
          $issue_departments_master_array[$master_array_key]['description'] = '';
        elseif ($this->attributes['product_name']=="QC Out")
          $issue_departments_master_array[$master_array_key]['description'] = $process['melting_lot_category_one'];
        else
    		  $issue_departments_master_array[$master_array_key]['description'] = empty($process['customer_name']) ? $this->attributes['description'] : $process['customer_name'].' '.$this->attributes['description'];
			} 
			   	
			$issue_departments_master_array[$master_array_key]['in_weight']   += $issue_department_detail['out_weight'];
    	$issue_departments_master_array[$master_array_key]['quantity']   += $issue_department_detail['quantity'];
    	$issue_departments_master_array[$master_array_key]['in_fine']     += $issue_department_detail['out_weight'] * $this->attributes['in_purity'] / 100;
    	$issue_departments_master_array[$master_array_key]['out_fine']    += $issue_department_detail['out_weight'] * $this->attributes['out_purity'] / 100;

      if (in_array($this->attributes['product_name'], array('GPC Out','Finish Good', 'Repair Out', 'Chitti Out'))) {
      	if (!empty($issue_departments_master_array[$master_array_key]['description']))
      		$issue_departments_master_array[$master_array_key]['description'] .= ', ';
      	$issue_departments_master_array[$master_array_key]['description'] .= $design_chitti_name;
      }
      
 			$issue_department_detail['field_name']          = $this->attributes['product_name'];
    	$issue_department_detail['design_chitti_name']  = @$design_chitti_name;    
    	$issue_department_detail['wastage']             = @$chain_margin;    
			$issue_department_detail['usd_wastage']         = @$usd_margin;    
			$issue_department_detail['inr_wastage']         = @$inr_margin;    
    	$issue_department_detail['chitti_purity']       = @$chitti_purity;    
			$issue_departments_master_array[$master_array_key]['issue_department_details'][] = $issue_department_detail;
    }
    return $issue_departments_master_array;
	}
	
	public function validation_rules($klass='') {
    $rules= array(array('field' => 'issue_departments[product_name]', 'label' => 'Product Name',
									      'rules' => 'trim|required',
									      'errors'=>array('required'=>'Please Select Product Name')),
  								//array('field' => 'issue_departments[account_id]', 'label' => 'Account Name',
									//      'rules' => 'trim|required',
									//      'errors'=>array('required'=>'Please Select Account Name')),
  							  // array('field' => 'issue_departments[issue_type]', 'label' => 'Issue Type',
									  //     'rules' => 'trim|required',
									  //     'errors'=>array('required'=>'Please Enter Issue Type')),
  								array('field' => 'issue_departments[description]', 'label' => 'Description',
									      'rules' => 'trim|required',
									      'errors'=>array('required'=>'Please Enter Description')),
  								array('field' => 'issue_departments[in_weight]', 'label' => 'Total Weight',
									      'rules' => 'trim|required',
									      'errors'=>array('required'=>'Total Weight is required')),
  								array('field' => 'issue_departments[in_purity]', 'label' => 'Purity',
									      'rules' => 'trim|required',
									      'errors'=>array('required'=>'Total Purity is required')),
  								array('field' => 'issue_departments[in_fine]', 'label' => 'Fine',
									      'rules' => 'trim|required',
									      'errors'=>array('required'=>'Fine is required')),
  								array('field' => 'issue_departments[out_purity]', 'label' => 'Issue Melting',
									      'rules' => 'trim|required',
									      'errors'=>array('required'=>'Please Enter Issue Melting')),
  								//array('field' => 'issue_departments[wastage_percentage]', 'label' => 'Wastage Percentage',
								//	      'rules' => 'trim|required',
								//	      'errors'=>array('required'=>'Please Enter Wastage Percentage')),
  								array('field' => 'issue_departments[out_fine]', 'label' => 'Issue Fine',
									      'rules' =>array('trim','required'),
                       					  'errors' => array('required'=>'Issue Fine is required')),
                  				);

    if ($this->attributes['product_name']=='GPC Out') {
	    $rules[]=array('field' => 'issue_departments[in_purity]', 'label' => 'Purity',
										 'rules' => array('trim','required',
										                  array('design_chitti_name_error_msg', array($this,'check_design_chitti_name_exist')),
                                      array('chain_margin_error_msg', array($this,'check_chain_margin_exist')),array('chitti_purity_error_msg', array($this,'check_chitti_purity_exist'))),
                     'errors' => array('design_chitti_name_error_msg' => 'Design Chitti Names not exist against selected lots in Design Name master.',
                                       'chain_margin_error_msg' => 'Wastage cannot be 0',
                                       'chitti_purity_error_msg' => 'Chitti Purity cannot be 0',
                                       'required'=>'Issue Fine is required'));
    }
    if ($this->attributes['product_name']=='GPC Repair Out') {
	    $rules[]=array('field' => 'issue_departments[hook_kdm_purity]', 'label' => 'Hook KDM Purity',
										 'rules' => array('trim','required'));
    }
    if(HOST!="Hallmark"&&!empty($this->attributes['account_id'])&& (in_array($this->attributes['account_id'],array("ARF Software","ARC Software","AR Gold Software"))) && HOST!="Export"&& HOST!="Domestic"){
	    $rules[]=array('field' => 'issue_departments[internal_wastage]', 'label' => 'Internal Wastage','rules' => array('trim','required'));
    }
    if(!empty($this->attributes['account_id']) && HOST=="Hallmark"){
	    $rules[]=array('field' => 'issue_departments[account_id]', 'label' => 'Account Name','rules' => array('trim','required'),
                    				  'errors' => array(
                                       'required' => 'Account Name is required'));
    }else{
    	if ($this->attributes['product_name']!='Hallmark Out') {
    	$rules[]=array('field' => 'issue_departments[account_id]', 'label' => 'Account Name','rules' => array('trim','required'),
                    				  'errors' => array('required' => 'Account Name is required'));
    	}
    
    }

	  return $rules;
  }


  public function check_design_chitti_name_exist($name) {
  	if (   $this->attributes['account_id'] != 'OUTSIDE PARTY'
        || $this->attributes['account_id'] != 'IMPORTED GOODS'
        || $this->attributes['account_id'] != 'AQUA GOLD'
        || $this->attributes['account_id'] != 'CHAIN AND JWELLERY'
        || $this->attributes['account_id'] != 'Bhandari Jewellers Pvt.Ltd.') return true;

    $process_ids = array_column($this->formdata['issue_department_details'], 'process_id');
    $processes = $this->process_model->get('', array('id' => $process_ids));  
    if (empty($processes)) return false;  
    
    foreach ($processes as $index => $process) {
      $design_chitti_name = $this->category_four_model->get_chitti_design_name($process['id']);
      if(empty($design_chitti_name))
        return false;
    }
    return true;
  }

  public function check_chain_margin_exist($name) {
    if (   $this->attributes['account_id'] != 'OUTSIDE PARTY'
        || $this->attributes['account_id'] != 'IMPORTED GOODS'
        || $this->attributes['account_id'] != 'AQUA GOLD'
        || $this->attributes['account_id'] != 'CHAIN AND JWELLERY'
        || $this->attributes['account_id'] != 'Bhandari Jewellers Pvt.Ltd.') return true;
  
    $process_ids = array_column($this->formdata['issue_department_details'], 'process_id');
    $processes = $this->process_model->get('', array('id' => $process_ids));  
    if (empty($processes)) return false;

    foreach ($processes as $index => $process) {
      $chain_margin = $this->issue_purity_model->get_issue_wastage($process['id'], ''); 
      if (empty($chain_margin))
        return false;
    } 
    return true;
  }

  public function check_chitti_purity_exist($name) {
    if (   $this->attributes['account_id'] != 'OUTSIDE PARTY'
        || $this->attributes['account_id'] != 'IMPORTED GOODS'
        || $this->attributes['account_id'] != 'CHAIN AND JWELLERY'
        || $this->attributes['account_id'] != 'AQUA GOLD'
        || $this->attributes['account_id'] != 'Bhandari Jewellers Pvt.Ltd.') return true;
  
    $process_ids = array_column($this->formdata['issue_department_details'], 'process_id');
    $processes = $this->process_model->get('', array('id' => $process_ids));  
    if (empty($processes)) return false;
    
    foreach ($processes as $index => $process) {
      $chitti_purity = $this->issue_purity_model->get_issue_chitti_purity($process['id'], ''); 
      if (empty($chitti_purity) || $chitti_purity==0)
        return false;
    } 
    return true;
  }
  public function check_account_name_exist($name) {
  	$data['account_name']=$this->attributes['account_id'];
    $url=API_BASE_PATH."masters/accounts/index";
    //$url="https://staging-argold-accounts.ascratech.com/masters/accounts/index";
    $records=json_decode(curl_post_request($url,$data)); 
    if(empty($records->data) && ($this->attributes['product_name']!='GPC Repair Out'&&$this->attributes['product_name']!='Huid'&&$this->attributes['product_name']!='Export Internal'&&$this->attributes['product_name']!='Packing Slip'&&$this->attributes['product_name']!='Domestic Internal'&&$this->attributes['product_name']!='QC Out')){
    	return false;
    }else{
    	return true;
    }
    
  }

	//$this->load->model('issue_departments/issue_department_model');
  //$this->issue_department_model->update_all_issue_department_records();
	public function update_all_issue_department_records() {
		$this->load->model(array('issue_departments/issue_department_detail_model', 'processes/process_model'));
	  $issue_departments = $this->issue_department_model->get('id');
	  foreach ($issue_departments as $issue_department) {
	    $in_weight = 0;
	    $in_fine = 0;
	    $issue_department_details = $this->issue_department_detail_model->get('process_id, out_weight', 
	                                                                          array('issue_department_id' => $issue_department['id']));
	    foreach ($issue_department_details as $issue_department_detail) {
	      $process = $this->process_model->find('out_lot_purity', array('id' => $issue_department_detail['process_id']));
	      if (!empty($process)) {
		      $in_fine += ($issue_department_detail['out_weight'] * $process['out_lot_purity'] / 100);
		      $in_weight += $issue_department_detail['out_weight'];
		    }
	    }

	    $issue_department['in_weight'] = $in_weight;
	    $issue_department['in_purity'] = ($in_weight==0) ? 0 : $in_fine / $in_weight * 100;
	    $issue_department['in_fine'] = $in_fine;
	    $issue_department['out_purity'] = $issue_department['in_purity'];
	    $issue_department['wastage_percentage'] = 0;
	    $issue_department['out_fine'] = $in_fine;

	    $issue_department_obj = new issue_department_model($issue_department);
	    $issue_department_obj->update(false); 
	  }
	}

	public function send_request_to_argold_accounts($data, $issue_voucher = true, $receipt_voucher = true) {
		$send_data=array();
    	$api_url="";
    if($data['product_name']=="Hallmark Out"){
    	$send_data['hallmark_receipt_processes'] = array(
    				  'account'=> HOST.HOSTVERSION,
                      'in_weight' => $data['in_weight'],
                      'quantity' => $data['quantity'],
                      'in_lot_purity' => $data['in_purity'],
                      'description' => $data['description'],
                      'factory_issue_department_id' => $data['id']);
	    //$api_url="https://staging-hallmarking.ascratech.com/api/api_hallmark_receipt_processes/store";   
	    $api_url=API_HALLMARK_PATH."api/api_hallmark_receipt_processes/store";
	    $result=curl_post_request($api_url, $send_data);
//		print_r($api_url);pd($result);
    }elseif($data['product_name']=="Hallmark Receipt"){
    	$process_id=array_column($this->formdata['issue_department_details'],'process_id');
    	$process_id=implode(',',$process_id);
    	$process_detail=$this->process_model->get('factory_issue_department_id',array('id in ('.$process_id.')'=>NULL));
    	$factory_issue_department_ids=array_column($process_detail,'factory_issue_department_id');
    	$factory_issue_department_ids=implode(',',$factory_issue_department_ids);
    	$send_data['hallmark_receipts'] = array(
    				  'account'=> $data['account_id'],
                      'in_weight' => $data['in_weight'],
                      'in_lot_purity' => $data['in_purity'],
                      'description' => $data['description'],
                      'factory_issue_department_id' => $factory_issue_department_ids);
	    if($data['account_id']=="ARF Software"){
	    	$url=ARF_AUG2022_URL;
	    }elseif($data['account_id']=="ARC Software"){
	    	$url=ARC_AUG2022_URL;
	    }else{
	    	$url=ARGOLD_AUG2022_URL;
	    }
	    $api_url=$url."api/api_hallmark_receipts/store";   
	    $result=curl_post_request($api_url, $send_data);
    }else{
	    if ($data['product_name']=='Tounch Loss Fine') {
	      $data['in_weight'] = $data['in_fine'];
	      $data['in_purity'] = 100;
	      $data['out_purity'] = 100;
	  }

	       if($data['account_id']=="Domestic Internal ERP Software"){
                $data['customer_name']=HOST.' Software'.HOSTVERSION;
                $data['department_name']=$data['description'];
            }
           if ($data['product_name']=='Fire Tounch Loss') {
                        $data['department_name']=$data['product_name'];
            }
	    $send_data['metal_issue_vouchers']=array('company_id' => 1,
												 'voucher_date' => date('Y-m-d'),
												 'receipt_type' => $data['product_name'],
	                                             'account_name'=> $data['account_id'],
	                                             'credit_weight' => $data['in_weight'],
	                                             'quantity' => $data['quantity'],
	                                             'purity' => $data['in_purity'],
	                                             'factory_purity' => $data['out_purity'],
	                                             'fine' => $data['in_weight'] * $data['in_purity']/100,
	                                             'factory_fine' => $data['in_weight']*$data['out_purity']/100,
	                                             'narration' => $data['description'],
	                                             'description' =>!empty($data['department_name'])?$data['department_name']:'',
	                                             'packet_no' => !empty($data['packet_no'])?$data['packet_no']:'',
	                                             'usd_wastage_percentage' => !empty($data['usd_wastage_percentage'])?$data['usd_wastage_percentage']:'',
	                                             'inr_wastage_percentage' => !empty($data['inr_wastage_percentage'])?$data['inr_wastage_percentage']:'',
	                                             'customer_name' => !empty($data['customer_name'])?$data['customer_name']:'',
	                                             'chitti_purity' => !empty($data['chitti_purity'])?$data['chitti_purity']:0,
	                                          	 'item_code' => !empty($data['item_code'])?$data['item_code']:"",
	                                          	 'argold_id' => $data['id'],
	                                          	 
	                                             'site_name' => HOST.''.HOSTVERSION);
	    if($this->attributes['product_name']=="QC Out"){
	    	$domestic_category=$this->domestic_category_master_model->find('rate_per_gram',array('design_code'=>$data['description']));
	        $send_data['metal_issue_vouchers']['rate']=!empty($domestic_category['rate_per_gram'])?$domestic_category['rate_per_gram']:0;
	  	}
	    $api_url=API_BASE_PATH."api/api_metal_issue_vouchers/store"; 
	   // echo"<pre>";print_r($api_url);
	   	if ($issue_voucher)
	    	$result=curl_post_request($api_url, $send_data);
	    //pd($result);
	    
	    unset($send_data['metal_issue_vouchers']);
	    $account_name = HOST.' Software'.HOSTVERSION;
	    if($data['product_name']=="Export Internal" || $data['product_name']=="Domestic Internal"){
	    	$data['description']=$data['account_id'];
	    }
	    if ($data['product_name']=='Fire Tounch Loss') {
		  	$data['department_name']=$data['product_name'];
	    }
	    if($data['account_id']=="Domestic Internal ERP Software"){
                $data['customer_name']="Domestic Internal ERP Software"; //HOST.' Software'.HOSTVERSION;
                $data['department_name']=$data['description'];
            }

	    $send_data['metal_receipt_vouchers']=array('company_id' => 1,
	                                               'account_name' => $account_name,
	                                               'voucher_date' => date('Y-m-d'),
	                                               'receipt_type' => $data['product_name'],
	                                               'quantity' => $data['quantity'],
	                                               'debit_weight' => $data['in_weight'],
	                                               'purity' => $data['in_purity'],
	                                               'fine' => $data['in_weight'] * $data['in_purity']/100,
	                                               'factory_purity' => $data['in_purity'],
	                                               'factory_fine' => $data['in_weight'] * $data['in_purity']/100,
	                                               'usd_wastage_percentage' => !empty($data['usd_wastage_percentage'])?$data['usd_wastage_percentage']:'',
	                                           	 'inr_wastage_percentage' => !empty($data['inr_wastage_percentage'])?$data['inr_wastage_percentage']:'',
	                                           
	                                               'narration' => $data['description'],
	                                               'description' =>!empty($data['department_name'])?$data['department_name']:'',
	                                             'packet_no' => !empty($data['packet_no'])?$data['packet_no']:'',
	                                             'customer_name' => !empty($data['customer_name'])?$data['customer_name']:'',
	                                               'chitti_purity' => !empty($data['chitti_purity'])?$data['chitti_purity']:0,
	                                               'item_code' => !empty($data['item_code'])?$data['item_code']:"",
	                                               'argold_id' => $data['id'],
	                                               'site_name' => HOST.''.HOSTVERSION);
	   
	    $api_url=API_BASE_PATH."api/api_metal_receipt_vouchers/store";   
	    if ($receipt_voucher)
	    	$result=curl_post_request($api_url, $send_data);
	}
  }

 public function get_customer_name_from_digital_catalogs($url) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: token bdd3672db03b87c:be2b5c680ee4410'
      )
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    return json_decode($response);
  }
  public function create_castic_loss_record($parent_lot_id, $chain_name) {
    $this->load->model('melting_lots/parent_lot_model');
    if ($chain_name != 'Imp Italy Chain') {
      $parent_lot = $this->parent_lot_model->find('name', array('id' => $parent_lot_id));
      if (empty($parent_lot)) return;
    }
    
    $where = array('parent_lot_id' => $parent_lot_id);
    $where['balance_loss != '] = 0;
    $where['department_name'] = array('Tounch Department', 'Castic Process', 'ReHCL', 'Castic');

    $select = 'sum(balance_loss) as in_weight,
               sum(balance_loss * wastage_lot_purity) / sum(balance_loss) as in_purity';
    $castic_loss_summary = $this->process_model->find($select, $where);
    
    if(empty($castic_loss_summary) || $castic_loss_summary['in_weight'] == 0) return;

    $issue_department = array('company_name' => 1,
                              'product_name' => 'Castic Loss',
                              'account_id' => 'HCL LOSS', //'Tounch & Castic Dep.Loss',
                              'in_weight' => $castic_loss_summary['in_weight'],
                              'in_purity' => $castic_loss_summary['in_purity'],
                              'in_fine' => $castic_loss_summary['in_weight'] * $castic_loss_summary['in_purity'] / 100,
                              'out_purity' => $castic_loss_summary['in_purity'],
                              'out_fine' => $castic_loss_summary['in_weight'] * $castic_loss_summary['in_purity'] / 100,
                              'description' =>'Castic Loss '.$chain_name.' '.$parent_lot['name']);
    $issue_department_obj = new Issue_department_model($issue_department);
    $issue_department_obj->store();

    $castic_loss_records = $this->process_model->get('id, balance_loss', $where);
    foreach ($castic_loss_records as $castic_loss_record) {
      $issue_department_detail = array('issue_department_id' => $issue_department_obj->attributes['id'],
                                       'process_id' => $castic_loss_record['id'],
                                       'out_weight' => $castic_loss_record['balance_loss'],
                                       'field_name' => "Castic Loss");
      $issue_department_detail_obj = new Issue_department_detail_model($issue_department_detail);
      $issue_department_detail_obj->store();

      //$hcl_loss_record['issue_hcl_loss'] = $hcl_loss_record['hcl_loss'];
      //$hcl_loss_record['balance_hcl_loss'] = 0;
      //$process_obj = new Process_model($hcl_loss_record);
      //$process_obj->update(false);
    }
    
    $this->send_request_to_argold_accounts($issue_department_obj->attributes);
  }

  public function create_hcl_loss_record($parent_lot_id, $chain_name) {
    $this->load->model('melting_lots/parent_lot_model');
    if ($chain_name != 'Imp Italy Chain') {
      $parent_lot = $this->parent_lot_model->find('name', array('id' => $parent_lot_id));
      if (empty($parent_lot)) return;
    }

    $where = array('parent_lot_id' => $parent_lot_id);
    $where['balance_hcl_loss != '] = 0;

    $select = 'sum(balance_hcl_loss) as in_weight,
               sum(balance_hcl_loss * in_lot_purity) / sum(balance_hcl_loss) as in_purity';
    $hcl_loss_summary = $this->process_model->find($select, $where);
    
    if(empty($hcl_loss_summary) || $hcl_loss_summary['in_weight'] == 0) return;

    $issue_department = array('company_name' => 1,
                              'product_name' => 'HCL Loss',
                              'account_id' => 'HCL LOSS',
                              'in_weight' => $hcl_loss_summary['in_weight'],
                              'in_purity' => $hcl_loss_summary['in_purity'],
                              'in_fine' => $hcl_loss_summary['in_weight'] * $hcl_loss_summary['in_purity'] / 100,
                              'out_purity' => $hcl_loss_summary['in_purity'],
                              'out_fine' => $hcl_loss_summary['in_weight'] * $hcl_loss_summary['in_purity'] / 100,
                              'description' =>'HCL Loss '.$chain_name.' '.$parent_lot['name']);
    $issue_department_obj = new Issue_department_model($issue_department);
    $issue_department_obj->store();

    $hcl_loss_records = $this->process_model->get('id, balance_hcl_loss', $where);
    foreach ($hcl_loss_records as $hcl_loss_record) {
      $issue_department_detail = array('issue_department_id' => $issue_department_obj->attributes['id'],
                                       'process_id' => $hcl_loss_record['id'],
                                       'out_weight' => $hcl_loss_record['balance_hcl_loss'],
                                       'field_name' => "HCL Loss");
      $issue_department_detail_obj = new Issue_department_detail_model($issue_department_detail);
      $issue_department_detail_obj->store();
    }
    
    $this->send_request_to_argold_accounts($issue_department_obj->attributes);
  }

  public function create_tounch_loss_fine_record($parent_lot_id, $chain_name) {
    $this->load->model('melting_lots/parent_lot_model');
    
    $parent_lot = $this->parent_lot_model->find('name', array('id' => $parent_lot_id));
    if (empty($parent_lot)) return;
    
    $where = array('parent_lot_id' => $parent_lot_id);
    $where["(department_name in ('Tounch Department', 'Castic Process') or product_name in ('HCL', 'HCL Ghiss Out'))"] = NULL;   
	  $where['balance_tounch_loss_fine != '] = 0;

    $select = 'sum(balance_tounch_loss_fine) as fine_weight';
    $tounch_loss_fine_summary = $this->process_model->find($select, $where);
    
    if(empty($tounch_loss_fine_summary) || $tounch_loss_fine_summary['fine_weight'] == 0) return;

    // if (HOST=='ARF')
    //   $account_id = 'TOUNCH LOSS FINE ARF';
    // else
    //   $account_id = 'Tounch Loss Fine';
    $account_id = 'HCL LOSS';

    $issue_department = array('company_name' => 1,
                              'product_name' => 'Tounch Loss Fine',
                              'account_id' => $account_id,
                              'in_weight' => $tounch_loss_fine_summary['fine_weight'],
                              'in_purity' => 100,
                              'in_fine' => $tounch_loss_fine_summary['fine_weight'],
                              'out_purity' => 100,
                              'out_fine' => $tounch_loss_fine_summary['fine_weight'],
                              'description' =>'Tounch Loss Fine '.$chain_name.' '.$parent_lot['name']);
    $issue_department_obj = new Issue_department_model($issue_department);
    $issue_department_obj->store();

    $tounch_loss_fine_records = $this->process_model->get('id, balance_tounch_loss_fine', $where);
    foreach ($tounch_loss_fine_records as $tounch_loss_fine_record) {
      $issue_department_detail = array('issue_department_id' => $issue_department_obj->attributes['id'],
                                       'process_id' => $tounch_loss_fine_record['id'],
                                       'out_weight' => $tounch_loss_fine_record['balance_tounch_loss_fine'],
                                       'field_name' => "Tounch Loss Fine");
      $issue_department_detail_obj = new Issue_department_detail_model($issue_department_detail);
      $issue_department_detail_obj->store();

      //$tounch_loss_fine_record['issue_tounch_loss_fine'] = $tounch_loss_fine_record['balance_tounch_loss_fine'];
      //$tounch_loss_fine_record['balance_tounch_loss_fine'] = 0;
      //$process_obj = new Process_model($tounch_loss_fine_record);
      //$process_obj->update(false);
    }
    $this->send_request_to_argold_accounts($issue_department_obj->attributes);

    $issue_department = array('company_name' => 1,
                              'product_name' => 'Tounch Loss Fine',
                              'account_id' => $account_id,
                              'in_weight' => -1 * $tounch_loss_fine_summary['fine_weight'],
                              'in_purity' => 0,
                              'in_fine' => 0,
                              'out_purity' => 0,
                              'out_fine' => 0,
                              'description' =>'Tounch Loss Fine '.$chain_name.' '.$parent_lot['name']);
    $issue_department_obj = new Issue_department_model($issue_department);
    $issue_department_obj->store();

    // $this->send_request_to_argold_accounts($issue_department_obj->attributes);
  }

  public function archive_records($parent_lot_id) {
    $this->load->model('melting_lots/parent_lot_model');
    $parent_lot = $this->parent_lot_model->find('name', array('id' => $parent_lot_id));
    if (empty($parent_lot)) return;

  	$processes = $this->process_model->get('id', array('parent_lot_id' => $parent_lot_id));
  	foreach ($processes as $index => $process) {
  		$process_obj = new process_model($process);
  		$process_obj->attributes['archive'] = 1;
  		$process_obj->update(false);
  	}
  }
  public function delete($id, $conditions = array(), $permanent_delete = true, $after_delete = true) {
    parent::delete($id, $conditions, $permanent_delete, $after_delete);
  }

  public function after_delete($id,$conditions){
  	$issue_department_details = $this->issue_department_detail_model->get('', array('issue_department_id' => $id));
    foreach ($issue_department_details as $index => $issue_department_detail) {
	    $processes = $this->process_model->find('', array('where'=>array('id'=>$issue_department_detail['process_id'])));
	      $this->issue_department_detail_model->delete($issue_department_detail['id']);
		  $model_name = get_model_name($processes['product_name'], $processes['process_name']);
		  $this->load->model($model_name['module_name'].'/'.$model_name['model_name']);
		  $process_object = new $model_name['model_name']($processes);
		   	if ($issue_department_detail['field_name'] == 'Melting Wastage') 
				$process_object->attributes['issue_melting_wastage'] = $issue_department_detail['out_weight'] - $processes['issue_melting_wastage'];
			elseif ($issue_department_detail['field_name'] == 'Daily Drawer Wastage') 
				$process_object->attributes['issue_daily_drawer_wastage'] = $issue_department_detail['out_weight'] - $processes['issue_daily_drawer_wastage'];
			elseif ($issue_department_detail['field_name'] == 'HCL Loss') 
				$process_object->attributes['issue_hcl_loss'] = $issue_department_detail['out_weight'] - $processes['issue_hcl_loss'];
			elseif ($issue_department_detail['field_name'] == 'Refine Loss') 
				$process_object->attributes['issue_refine_loss'] = $issue_department_detail['out_weight'] - $processes['issue_refine_loss'];
			elseif ($issue_department_detail['field_name'] == 'Tounch Loss Fine') 
				$process_object->attributes['issue_tounch_loss_fine'] = $issue_department_detail['out_weight'] - $processes['issue_tounch_loss_fine'];
			elseif ($issue_department_detail['field_name'] == 'Chitti Out') 
				$process_object->attributes['issue_chitti_out'] = $issue_department_detail['out_weight'] - $processes['issue_chitti_out'];
			elseif ($issue_department_detail['field_name'] == 'Cutting Ghiss' || $issue_department_detail['field_name'] == 'Ice Cutting Ghiss'|| $issue_department_detail['field_name'] == 'Hand Cutting Ghiss'|| $issue_department_detail['field_name'] == 'Hand Dull Ghiss'|| $issue_department_detail['field_name'] == 'Sand Dull Ghiss')
				$process_object->attributes['issue_ghiss'] = $issue_department_detail['out_weight'] - $processes['issue_ghiss'];
		    elseif ($issue_department_detail['field_name'] == 'Ghiss Melting Loss') 
		  		$process_object->attributes['issue_loss'] = $issue_department_detail['out_weight'] - $processes['issue_loss'];
		  elseif ($issue_department_detail['field_name'] == 'Fire Tounch Loss') 
				$process_object->attributes['issue_refine_loss'] = $issue_department_detail['out_weight'] - $processes['issue_refine_loss'];
			
			elseif ($issue_department_detail['field_name'] == 'Castic Loss') 
				$process_object->attributes['issue_loss'] = $issue_department_detail['out_weight'] - $processes['issue_loss'];
			elseif ($issue_department_detail['field_name'] == 'Hallmark Out') 
				$process_object->attributes['issue_hallmark_out'] = $issue_department_detail['out_weight'] - $processes['issue_hallmark_out'];
			elseif ($issue_department_detail['field_name'] == 'GPC Repair Out') {
				$process_object->attributes['issue_gpc_out'] = $issue_department_detail['out_weight'] - $processes['issue_gpc_out'];
			}elseif ($issue_department_detail['field_name'] == 'Huid') {
				$process_object->attributes['issue_gpc_out'] = $issue_department_detail['out_weight'] - $processes['issue_gpc_out'];
			}elseif ($issue_department_detail['field_name'] == 'QC Out') {
				$process_object->attributes['issue_gpc_out'] = $issue_department_detail['out_weight'] - $processes['issue_gpc_out'];
			}elseif ($issue_department_detail['field_name'] == 'Hallmark Receipt') {
				$process_object->attributes['issue_gpc_out'] = $issue_department_detail['out_weight'] - $processes['issue_gpc_out'];
			}elseif ($issue_department_detail['field_name'] == 'GPC Loss Out') {
				$process_object->attributes['gpc_out'] = $processes['gpc_out'] - $issue_department_detail['out_weight'];
				$process_object->attributes['loss'] = $issue_department_detail['out_weight'] - $processes['loss'];
			}else {
				$process_object->attributes['issue_gpc_out'] = $issue_department_detail['out_weight'] - $processes['issue_gpc_out'];
			}
	
      if($issue_department_detail['field_name'] == 'Ice Cutting Ghiss' ||
         $issue_department_detail['field_name'] == 'Hand Cutting Ghiss' || 
         $issue_department_detail['field_name'] == 'Hand Dull Ghiss' || 
         $issue_department_detail['field_name'] == 'Sand Dull Ghiss' || 
         $issue_department_detail['field_name'] == 'Ghiss Melting Loss' ||
         $issue_department_detail['field_name'] == 'Fire Tounch Loss' ||
         $issue_department_detail['field_name'] == 'Tounch Loss Fine') {
				$process_object->calculate_balance_wastage($issue_department_detail['field_name']);
			} else {
				$process_object->calculate_balance_wastage();
			}	
			$process_object->save(false);
  	}

  }
  public  function get_account_names_from_accounts($sub_group_name="") {
  	if(!empty($sub_group_name)){
	    $export_data['sub_group_name']=$sub_group_name;
		$url=API_BASE_PATH."masters/accounts/index";
		//$url="https://staging-argold-accounts.ascratech.com/masters/accounts/index";
    
    $export_records=@json_decode(curl_post_request($url,$export_data));
		if(!empty($export_records)){
		$export_data=(array)$export_records->data;
		}
		return array_column($export_data, 'name');
  	}
  }
}
