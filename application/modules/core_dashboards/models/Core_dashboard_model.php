<?php 
class Core_dashboard_model extends BaseModel{
	protected $table_name= 'users';
	public function __construct($data = array()){
		parent::__construct($data);
    $this->load->model(array('processes/process_model','settings/same_karigar_model','melting_lots/melting_lot_model'));
    $this->include_cards = array('metal_balance','gpc_out','melting_wastage_balance',
                            'daily_drawer_wastage','hcl_wastage_balance',
                            'hcl_process_balance','tounch','tounch_process',
                            'alloy_balance','office_outside','daily_drawer_balance',
                            'daily_drawer_process','pending_ghiss_balance',
                            'ghiss_process_balance','ghiss_balance',
                            'tounch_out_ghiss','rope_ghiss_process',
                            'loss_process_balance','loss_balance',
                            'refine_loss','tounch_fine_loss','hcl_loss','rope_ghiss_balance');
	}

  public function get_process_names(){
    $processes = $this->same_karigar_model->get('DISTINCT(process_name)',
                                                        array('product_name'=>$this->product_name));
    
    return array_column($processes,'process_name');
  }

  private function set_value_zero($value){
    if(empty($value))return "0.0000";
    else return $value;
  }

	public function dashboard_common_data($product_name="",$chain_name=""){

    $data = array();
    if(in_array('metal_balance',$this->include_cards))
      $data['metal_balance'] = $this->metal_balance();
    if(in_array('gpc_out',$this->include_cards))
  	 $data['gpc_out'] = $this->gpc_out($product_name,$chain_name);
    if(in_array('melting_wastage_balance',$this->include_cards))
     $data['melting_wastage_balance'] = $this->metal_wastage_balance($product_name,$chain_name);
    if(in_array('daily_drawer_wastage',$this->include_cards))
      $data['daily_drawer_wastage'] = $this->daily_drawer_wastage($product_name,$chain_name);
    if(in_array('hcl_wastage_balance',$this->include_cards))
      $data['hcl_wastage_balance'] = $this->hcl_wastage_balance($product_name,$chain_name);
    if(in_array('hcl_process_balance',$this->include_cards))
      $data['hcl_process_balance'] = $this->hcl_process_balance($product_name,$chain_name);
    if(in_array('tounch',$this->include_cards))
      $data['tounch'] = $this->tounch_balance($product_name,$chain_name);
    if(in_array('tounch_process',$this->include_cards))
      $data['tounch_process'] = $this->tounch_process_balance($product_name,$chain_name); 

    if(in_array('alloy_balance',$this->include_cards))
      $data['alloy_balance'] = $this->alloy_balance($product_name,$chain_name);

    if(in_array('office_outside',$this->include_cards))
      $data['office_outside'] = $this->office_outside($product_name,$chain_name);

    if(in_array('daily_drawer_balance',$this->include_cards))
      $data['daily_drawer_balance'] = $this->daily_drawer_balance($product_name,$chain_name);


    if(in_array('daily_drawer_process',$this->include_cards))
      $data['daily_drawer_process'] = $this->daily_drawer_process($product_name,$chain_name);

    if(in_array('pending_ghiss_balance',$this->include_cards))
      $data['pending_ghiss_balance'] = $this->pending_ghiss_balance($product_name,$chain_name);

    if(in_array('ghiss_process_balance',$this->include_cards))
      $data['ghiss_process_balance'] = $this->ghiss_process_balance($product_name,$chain_name);

    if(in_array('ghiss_balance',$this->include_cards))
      $data['ghiss_balance'] = $this->ghiss_balance($product_name,$chain_name);

    if(in_array('tounch_out_ghiss',$this->include_cards))
      $data['tounch_out_ghiss'] = $this->tounch_out_ghiss($product_name,$chain_name);

    if(in_array('rope_ghiss_process',$this->include_cards))
      $data['rope_ghiss_process'] = $this->rope_ghiss_process($product_name,$chain_name);

    if(in_array('loss_process_balance',$this->include_cards))
      $data['loss_process_balance'] = $this->loss_process_balance($product_name,$chain_name);

    if(in_array('loss_balance',$this->include_cards))
      $data['loss_balance'] = $this->loss_balance($product_name,$chain_name);

    if(in_array('refine_loss',$this->include_cards))
      $data['refine_loss'] = $this->refine_loss($product_name,$chain_name);

    if(in_array('tounch_fine_loss',$this->include_cards))
      $data['tounch_fine_loss'] = $this->tounch_fine_loss($product_name,$chain_name);

    if(in_array('hcl_loss',$this->include_cards))
      $data['hcl_loss'] = $this->hcl_loss($product_name,$chain_name);

    if(in_array('rope_ghiss_balance',$this->include_cards))
      $data['rope_ghiss_balance'] = $this->rope_ghiss_balance($product_name,$chain_name);

    return $data;
	}

  private function metal_balance(){
    $balance =  $this->process_model->find('sum(balance_melting_wastage) as balance',array('product_name'=>'Receipt'))['balance'];
    return $this->set_value_zero($balance);
  }

  private function gpc_out($product_name="",$chain_name=""){
    $data['where'] = $this->product_chain_name_where($product_name,$chain_name);
    $balance =  $this->process_model->find('sum(balance_gpc_out) as balance', $data['where'])['balance'];
    return $this->set_value_zero($balance);
  }

  private function metal_wastage_balance($product_name='',$chain_name=""){
    if(!empty($chain_name))
      $data['where'] = array('chain_name'=>$chain_name,'product_name !='=>'Receipt');
    elseif(!empty($product_name))
       $data['where'] = array('chain_name'=>$product_name,'product_name !='=>'Receipt');
    else
      $data['where'] =  array('product_name !='=>'Receipt');
    $balance = $this->process_model->find('sum(balance_melting_wastage) as balance',$data['where'])['balance'];
    return $this->set_value_zero($balance);
     
  }

  private function daily_drawer_wastage($product_name='',$chain_name=""){
    $data['where'] = $this->product_chain_name_where($product_name,$chain_name);
  
    $balance = $this->process_model->find('sum(balance_daily_drawer_wastage) as balance',$data['where'])['balance'];
    return $this->set_value_zero($balance);
  }

  private function daily_drawer_process($product_name='',$chain_name=""){
    if(!empty($chain_name))$data['where'] = array('chain_name'=>$chain_name,'product_name'=>'Daily Drawer');
    if(!empty($product_name))$data['where'] = array('chain_name'=>$product_name,'product_name'=>'Daily Drawer');
    else $data['where'] = array('product_name'=>'Daily Drawer');
    $balance = $this->process_model->find('sum(balance) as balance',$data['where'])['balance'];
    return $this->set_value_zero($balance);
  } 

  private function loss_process_balance($product_name='',$chain_name=""){
    if(!empty($chain_name)) $data['where'] = array('chain_name'=>$chain_name,'product_name'=>'Loss Out');
    elseif(!empty($product_name)) $data['where'] = array('chain_name'=>$product_name,'product_name'=>'Loss Out');
    else $data['where'] = array('product_name'=>'Loss Out');
    $balance = $this->process_model->find('sum(balance) as balance',$data['where'])['balance'];
    return $this->set_value_zero($balance);
  }  

  private function refine_loss($product_name='',$chain_name=""){
    $data['where'] = $this->product_chain_name_where($product_name,$chain_name);
    $balance = $this->process_model->find('sum(refine_loss) as balance',$data['where'])['balance'];
    return $this->set_value_zero($balance);
  }  

  private function rope_ghiss_balance($product_name='',$chain_name=""){
    $data['where'] = $this->product_chain_name_where($product_name,$chain_name);
    $balance = $this->process_model->find('sum(balance_hcl_ghiss) as balance',$data['where'])['balance'];
    return $this->set_value_zero($balance);
  } 

  private function loss_balance($product_name='',$chain_name=""){
    $data['where'] = $this->product_chain_name_where($product_name,$chain_name);
    $balance = $this->process_model->find('sum(balance_loss) as balance',$data['where'])['balance'];
    return $this->set_value_zero($balance);
  }

  private function tounch_fine_loss($product_name='',$chain_name=""){
    if(!empty($product_name) && !empty($chain_name)) $data['where'] = array('chain_name'=>$product_name,'tounch_purity !='=>'in_lot_purity','out_weight >' =>0,'chain_name'=>$chain_name);

    elseif(empty($product_name) && !empty($chain_name)) $data['where'] = array('tounch_purity !='=>'in_lot_purity','out_weight >' =>0,'chain_name'=>$chain_name);

    elseif(!empty($product_name) && empty($chain_name)) $data['where'] = array('chain_name'=>$product_name,'tounch_purity !='=>'in_lot_purity','out_weight >' =>0);

    else $data['where'] = array('tounch_purity !='=>'in_lot_purity','out_weight >' =>0);

     $balance = $this->process_model->find('sum(balance_fine) as balance',$data['where'])['balance'];
    return $this->set_value_zero($balance);
  }

  private function pending_ghiss_balance($product_name='',$chain_name=""){
    if(!empty($chain_name))
      $data['where'] = array('chain_name'=>$chain_name,'product_name'=>'Pending Ghiss Out');
    elseif(!empty($product_name))
      $data['where'] = array('chain_name'=>$product_name,'product_name'=>'Pending Ghiss Out');
    else
      $data['where'] = array('product_name'=>'Pending Ghiss Out');
    $balance =  $this->process_model->find('sum(pending_ghiss) - sum(in_weight) as balance',$data['where'])['balance'];
    return $this->set_value_zero($balance); 
  }

  private function ghiss_process_balance($product_name='',$chain_name=""){

    if(!empty($chain_name))
      $data['where'] = array('chain_name'=>$chain_name,'product_name'=>'Ghiss Out');
    elseif(!empty($product_name))
      $data['where'] = array('chain_name'=>$product_name,'product_name'=>'Ghiss Out');
    else
      $data['where'] = array('product_name'=>'Ghiss Out');
    
    $balance = $this->process_model->find('sum(balance) as balance',$data['where'])['balance'];

    return $this->set_value_zero($balance); 
     
  }

  private function product_chain_name_where($product_name="",$chain_name=""){
    if(!empty($product_name)) $data['where'] = array('chain_name'=>$product_name);
    elseif(!empty($chain_name)) $data['where'] = array('chain_name'=>$chain_name);
    else $data['where'] = array();
    return $data['where'];
  }

  private function ghiss_balance($product_name='',$chain_name=""){

    $data['where'] = $this->product_chain_name_where($product_name,$chain_name);
    $balance = $this->process_model->find('sum(balance_ghiss) as balance',$data['where'])['balance'];
    return $this->set_value_zero($balance);  
  }

  private function hcl_loss($product_name='',$chain_name=""){
    $data['where'] = $this->product_chain_name_where($product_name,$chain_name);
    $balance = $this->process_model->find('sum(hcl_loss) as balance',$data['where'])['balance'];
    return $this->set_value_zero($balance);
  }

  private function tounch_out_ghiss($product_name='',$chain_name=""){
    $data['where'] = $this->product_chain_name_where($product_name,$chain_name);
    $balance = $this->process_model->find('sum(balance_tounch_out) as balance',$data['where'])['balance'];
    return $this->set_value_zero($balance);
     
  }

  private function rope_ghiss_process($product_name='',$chain_name=""){
    if(!empty($chain_name)) $data['where'] = array('chain_name'=>$chain_name,'product_name'=>'HCL Ghiss Out');
    elseif(!empty($product_name)) $data['where'] = array('chain_name'=>$product_name,'product_name'=>'HCL Ghiss Out');
    else $data['where'] = array('product_name'=>'HCL Ghiss Out');
    $balance = $this->process_model->find('sum(balance_tounch_out) as balance',$data['where'])['balance'];
    return $this->set_value_zero($balance);
  }

  private function hcl_wastage_balance($product_name='',$chain_name){
    $data['where'] = $this->product_chain_name_where($product_name,$chain_name);
    $balance = $this->process_model->find('sum(balance_hcl_wastage) as balance',$data['where'])['balance'];
    return $this->set_value_zero($balance);
  }

  private function hcl_process_balance($product_name='',$chain_name){
    if(!empty($chain_name)) $data['where'] = array('product_name'=>'HCL','chain_name'=>$chain_name);
    elseif(!empty($product_name)) $data['where'] = array('product_name'=>'HCL','chain_name'=>$product_name);
    else $data['where'] = array('product_name'=>'HCL');
    $balance = $this->process_model->find('sum(balance) as balance', $data['where'])['balance'];
    return $this->set_value_zero($balance);
  }

  private function tounch_balance($product_name='',$chain_name=""){
    $data['where'] = $this->product_chain_name_where($product_name,$chain_name);
    $balance = $this->process_model->find('sum(tounch_in- tounch_ghiss-tounch_out) as balance',$data['where'])['balance'];
    return $this->set_value_zero($balance);
  }

  private function tounch_process_balance($product_name='',$chain_name=""){
    if(!empty($chain_name)) $data['where'] = array('chain_name'=>$chain_name,'product_name'=>'Tounch Out');
    else if(!empty($product_name)) $data['where'] = array('chain_name'=>$product_name,'product_name'=>'Tounch Out');
    else $data['where'] = array('product_name'=>'Tounch Out');

    $balance = $this->process_model->find('sum(balance) as balance',$data['where'])['balance'];
    return $this->set_value_zero($balance);
  } 

  private function office_outside($product_name='',$chain_name=""){
    /*if(!empty($chain_name)) $data['where'] = array('product_name'=>'Office Outside','chain_name'=>$chain_name);
    elseif(!empty($product_name)) $data['where'] = array('product_name'=>'Office Outside','chain_name'=>$product_name);
    else */
    $data['where'] = array('product_name'=>'Office Outside');

    $balance = $this->process_model->find('sum(balance) as balance',$data['where'])['balance'];
    return $this->set_value_zero($balance);
    
  }

  private function daily_drawer_balance($product_name='',$chain_name=""){
    //$data['where'] = $this->product_chain_name_where($product_name,$chain_name);
    //if(!empty($chain_name)) $data['where'] = array('chain_name'=>$chain_name);
    //else $data['where'] = array('product_name'=>'Office Outside');

    $balance = $this->process_model->find('sum(daily_drawer_in_weight - hook_in + hook_out - daily_drawer_out_weight) as balance')['balance'];
    //lq();
    return $this->set_value_zero($balance);
    
  } 

  public function process_balance(){
    $data = array();
    $process_array = $this->get_process_list();
    foreach($process_array as $process_key => $process_value){
      $query = $this->process_model->find('sum(balance) as balance',$process_value['where'])['balance'];
      
      $data[$process_key] = array('data'=>$query,'title'=>$process_value['title']);
    }
    return $data;
  }

  private function alloy_balance($product_name='',$chain_name=""){
    if(!empty($chain_name)) $data['where'] = array('product_name'=>'Tounch Out','chain_name'=>$chain_name);
    if(!empty($product_name)) $data['where'] = array('product_name'=>'Tounch Out','chain_name'=>$product_name);
    else $data['where'] = array('product_name'=>'Tounch Out');

    $alloy_balance =  $this->process_model->find(' sum(alloy_weight - out_alloy_weight) as balance')['balance']; 
    
    $alloy_weight =  $this->melting_lot_model->find(' sum(alloy_weight) as balance')['balance'];
    $balance  =  $alloy_balance - $alloy_weight;
    return $this->set_value_zero($balance);
  }

  public function department_wise_process_balance($module_name=''){
    $data = array();
    $process_array = $this->get_process_list();
    foreach($process_array as $process_key => $process_value){
      $modal_array = $this->get_model_array_key_wise($module_name)[$process_key];
     
      $query_data = $this->$modal_array->get('sum(balance) as balance,department_name',array('balance >'=>0,'product_name'=>$process_value['where']['product_name']),'',array('group_by'=>'department_name'));
  
      $data[$process_key] = array('data'=>$query_data,'title'=>$process_value['title']);
    }
  
    return $data;
  }

  public function get_process_list(){
    $data = array();
    foreach($this->process_names as $process_name)
      $data[$process_name] = array('where'=>array('process_name' => $process_name,
                                                'product_name'=>$this->product_name), 
                                'title'=> $process_name.' Balance');

    return $data;
  }

  public function get_model_array_key_wise($module_name=''){
    foreach ($this->process_names  as $process_name) {
      $model_name = str_replace(' ','_',strtolower($this->product_name)).'_'.str_replace(' ','_',strtolower($process_name)).'_model';
      if(!empty($module_name)){
        $only_model  =$model_name;
        $model_name = $module_name.'/'.$model_name;
      }
      
      $this->load->model($model_name);

      if(!empty($module_name))
        $model_name = $only_model;
      $modal_names[$process_name] =  $model_name;
    }
    return $modal_names;      
  }
}