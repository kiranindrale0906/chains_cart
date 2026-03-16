<?php
class Melting_lot_model extends BaseModel{
  protected $table_name = 'melting_lots';
  protected $id = 'id';

  public function __construct($data=array()) {
    parent::__construct($data);
    $this->load->model(array('orders/order_model'));
  }

  public function before_validate() {
    if(HOST=="AR Gold Internal"){

    }else{
    if (!isset($this->formdata['melting_lot_details'])) return;
    $lot_purity = isset($this->formdata['melting_lots']['lot_purity'])?$this->formdata['melting_lots']['lot_purity']:'';
    $this->formdata['melting_lots']['alloy_weight'] = 0;
    $this->formdata['melting_lots']['wastage_weight'] = 0;

    foreach ($this->formdata['melting_lot_details'] as $index => $melting_lot_detail_data) {
      if($melting_lot_detail_data['required_weight'] != ''
         && $melting_lot_detail_data['required_weight'] > 0) {
        $process = $this->process_model->find('process_name, department_name,
                                               balance_melting_wastage as in_weight, wastage_lot_purity as out_lot_purity',
                                              array('id' => $melting_lot_detail_data['process_id']));

        $melting_lot_detail_data['in_weight'] = $process['in_weight'];
        $melting_lot_detail_data['in_purity'] = $process['out_lot_purity'];

        if ($melting_lot_detail_data['required_weight'] > $melting_lot_detail_data['in_weight']) {
          $melting_lot_detail_data['required_weight'] = $melting_lot_detail_data['in_weight'];
          $this->formdata['melting_lot_details'][$index]['required_weight'] = $melting_lot_detail_data['in_weight'];
        }

        $pure_gold_weight = $process['in_weight'] * $melting_lot_detail_data['in_purity'] / 100;
        $total_weight = $pure_gold_weight / $lot_purity * 100;
        $melting_lot_detail_data['max_alloy_weight'] = $total_weight - $pure_gold_weight;

        $pure_gold_required_weight = $melting_lot_detail_data['required_weight'] * $melting_lot_detail_data['in_purity'] / 100;
        $melting_lot_detail_data['required_alloy_weight'] = ($pure_gold_required_weight / $lot_purity * 100) - $melting_lot_detail_data['required_weight'];

        $this->formdata['melting_lot_details'][$index]['in_weight'] = $melting_lot_detail_data['in_weight'];
        $this->formdata['melting_lot_details'][$index]['in_purity'] = $melting_lot_detail_data['in_purity'];

        $this->formdata['melting_lot_details'][$index]['max_alloy_weight'] = $melting_lot_detail_data['max_alloy_weight'];
        $this->formdata['melting_lot_details'][$index]['required_alloy_weight'] = $melting_lot_detail_data['required_alloy_weight'];

        $this->formdata['melting_lot_details'][$index]['process_name'] = $process['process_name'];
        $this->formdata['melting_lot_details'][$index]['department_name'] = $process['department_name'];

        $this->formdata['melting_lots']['wastage_weight'] += $melting_lot_detail_data['required_weight'];
        $this->formdata['melting_lots']['alloy_weight'] += four_decimal($melting_lot_detail_data['required_alloy_weight']);
      }
    }
    if ($this->formdata['melting_lots']['process_name'] =='KA Chain' && !empty($this->formdata['melting_lots']['order_id'])) {
      $this->load->model(array('ka_chains/ka_chain_order_detail_model'));
      $order_data = $this->ka_chain_order_model->find('hook_kdm_purity,lot_purity',array('id' => $this->attributes['order_id']));
      $order_detail_data = $this->ka_chain_order_detail_model->find('description,category_one,category_two,category_three,line',array('order_id' => $this->attributes['order_id']));
      $this->formdata['melting_lots']['lot_purity']=$order_data['lot_purity'];
      $this->formdata['melting_lots']['hook_kdm_purity']=$order_data['hook_kdm_purity'];
      $this->formdata['melting_lots']['description']=$order_detail_data['description'];
      $this->formdata['melting_lots']['staff_name']=$order_detail_data['description'];
      $this->formdata['melting_lots']['category_one']=$order_detail_data['category_one'];
      $this->formdata['melting_lots']['category_two']=$order_detail_data['category_two'];
      $this->formdata['melting_lots']['category_three']=$order_detail_data['category_three'];
      $this->formdata['melting_lots']['line']=$order_detail_data['line'];

    }
    $this->formdata['melting_lots']['pure_gold_weight']=0;
    if ($this->formdata['melting_lots']['alloy_weight'] < 0) {
      $this->formdata['melting_lots']['pure_gold_weight'] = ($this->attributes['lot_purity'] * ($this->formdata['melting_lots']['alloy_weight'] * -1)) / (100 - $this->attributes['lot_purity']);
    }
    $this->formdata['melting_lots']['additional_alloy_weight'] = 0;
    if ($this->formdata['melting_lots']['alloy_weight'] < 0
        || @$this->formdata['melting_lots']['pure_gold_weight'] > 0) {
      $additional_alloy_weight = (@$this->formdata['melting_lots']['pure_gold_weight'] / $lot_purity * 100)
                                - @$this->formdata['melting_lots']['pure_gold_weight'];
      $this->formdata['melting_lots']['additional_alloy_weight'] = $additional_alloy_weight;
    }
    $this->formdata['melting_lots']['alloy_vodatar']=!empty($this->formdata['melting_lots']['alloy_vodatar'])?$this->formdata['melting_lots']['alloy_vodatar']:0;
    $this->formdata['melting_lots']['gross_weight'] = $this->formdata['melting_lots']['wastage_weight']
                                                      + $this->formdata['melting_lots']['alloy_weight']
                                                      + $this->formdata['melting_lots']['additional_alloy_weight']
                                                      + @$this->formdata['melting_lots']['alloy_vodatar']
                                                      + @$this->formdata['melting_lots']['pure_gold_weight'];

    
    $this->set_parent_lot_name();
    $this->set_lot_no();
   }
   if (isset($this->formdata['karigar_text']) && !empty($this->formdata['karigar_text'])) {
      $this->formdata['melting_lots']['karigar'] = $this->formdata['karigar_text'];
    } elseif (isset($this->formdata['karigar_dropdown']) && !empty($this->formdata['karigar_dropdown'])) {
      $this->formdata['melting_lots']['karigar'] = $this->formdata['karigar_dropdown'];
    } else {
      $this->formdata['melting_lots']['karigar'] = '';
    }

    //$this->set_department_sequence();
  }

  public function validation_rules($klass='record') {

    $rules = array(
              array('field' => 'melting_lots[process_name]', 'label' => 'Process',
                    'rules' => 'trim|required|max_length[64]',
                    'errors'=>array('required'=>'Process is required')),
              array('field' => 'melting_lots[gross_weight]', 'label' => 'Gross Weight',
                      'rules' => 'trim|required|greater_than[0]',
                      'errors'=>array('greater_than' => 'Gross weight cannot be 0'))
    );


    if (($this->attributes['process_name'] == 'Rope Chain'|| $this->attributes['process_name'] == ' Choco Chain')
        && $this->attributes['lot_purity'] > 0){
        
        $rules[] =array('field' => 'melting_lots[lot_purity]', 'label' => 'Lot Purity',
                       'rules' => array('trim','required',array('purity_same_as_parent_lot_purity_error', array($this, 'purity_same_as_parent_lot_purity'))),
                     'errors'=> array('required'=>'The Lot Purity field is required.','purity_same_as_parent_lot_purity_error' => "Select Purity as per Parent Lot Purity"));
      }else{

        $rules[] =array('field' => 'melting_lots[lot_purity]', 'label' => 'Purity',
                    'rules' => 'trim|required|numeric|greater_than_equal_to[0.01]|less_than_equal_to[99.99]',
                    'errors'=>array('required'=>'Purity is required',
                                    'greater_than_equal_to'=>"Please enter purity greater than 0.01",
                                    'less_than_equal_to'=>"Please enter purity less than 99.99"));
      }
    
    if (in_array($this->attributes['process_name'],array('Rope Chain','Choco Chain'))) 
      $rules[]=array('field' => 'melting_lots[parent_lot_id]', 'label' => 'Parent Lot',
                     'rules' => 'trim|required|max_length[64]',
                     'errors'=>array('required'=>'Parent Lot is required'));

    if (in_array($this->attributes['process_name'], array('KA Chain','Ball Chain')))
      if ($this->attributes['order_id'] == 0) {
        $rules[]=array('field' => 'melting_lots[category_one]', 'label' => 'Category One',
                      'rules' => 'trim|required',
                      'errors'=>array('required'=>'Category One is required'));
        $rules[]=array('field' => 'melting_lots[category_two]', 'label' => 'Category Two',
                       'rules' => 'trim|required',
                       'errors'=>array('required'=>'Category Two is required'));
        $rules[]=array('field' => 'melting_lots[category_three]', 'label' => 'Size',
                       'rules' => 'trim|required',
                       'errors'=>array('required'=>'Size is required'));
      } else {
        $rules[]=array('field' => 'melting_lots[order_id]', 'label' => 'Order',
                      'rules' => 'trim|required',
                      'errors'=>array('required'=>'Order is required'));
      }

    return $rules;
  }
  public function purity_same_as_parent_lot_purity($name) {
     $total =0;
    $lot_purity = $this->parent_lot_model->find('lot_purity', array('id' => $this->attributes['parent_lot_id']));
      $purity=$lot_purity['lot_purity'];
    if($purity==$this->attributes['lot_purity']){
      return true;
    }else{
      return false;
    }
  }

  public function after_save($action) {
    if(HOST=="AR Gold Internal"){
      $this->create_start_department_record();
    }else{
      if (!isset($this->formdata['melting_lot_details'])) return;
      if ($this->attributes['gross_weight'] > 0){
        $added_process_details=$this->create_start_department_record();
      }
      if(!empty($added_process_details)){
        $data['id']=$this->attributes['id'];
        $data['lot_no']=$this->attributes['lot_no'];
        $data['after_melting_process_id']=$added_process_details['id'];
        $this->update_lot_no($data);
       }

    foreach ($this->formdata['melting_lot_details'] as $index => $melting_lot_detail_data) {
      if($melting_lot_detail_data['required_weight'] != ''
         && $melting_lot_detail_data['required_weight'] > 0) {
        $melting_lot_detail = new Melting_lot_detail_model($melting_lot_detail_data);
        $melting_lot_detail->attributes['melting_lot_id'] = $this->attributes['id'];
        $melting_lot_detail->attributes['after_melting_process_id'] = $added_process_details['id'];
        $melting_lot_detail->attributes['parent_lot_id'] = $added_process_details['parent_lot_id'];
        $melting_lot_detail->save();
      }
    }

    $this->_add_melting_lot_alloy_details();
   }
}


  public function after_delete($id,$condition) {
   if(!empty($id)) {
      $this->delete_dependent_records($id,'melting_lot_detail_model'); //id ,model name  
      if(!empty($_GET)){
        $melting_lot_detail['id']=$_GET['process_id'];
      $this->update_in_weight_in_casting_melting($melting_lot_detail,1); 
      }
    }
  }


  public function create_start_department_record() {
    $start_process=array(
      'department_name' => 'Melting Start',
      'lot_no' => $this->attributes['lot_no'],
      'lopster_no' => @$this->attributes['lopster_no'],
      'melting_lot_id' => $this->attributes['id'],
      'parent_lot_id' => @$this->attributes['parent_lot_id'],
      'parent_lot_name' => @$this->attributes['parent_lot_name'],
      'row_id' => $this->attributes['id'],
      'in_lot_purity' => $this->attributes['lot_purity'],
      'out_lot_purity' => $this->attributes['lot_purity'],
      'hook_kdm_purity' => @$this->attributes['hook_kdm_purity'],
      'in_weight' => $this->attributes['gross_weight'],
      'out_weight' => $this->attributes['gross_weight'],
      'design_code' => '',
      'machine_size' => '',
      'line' => @$this->attributes['line'],
      'quantity' => @$this->attributes['quantity'],
      'input_type' => @$this->attributes['input_type'],
      'description' => @$this->attributes['description'],
      'tone' => isset($this->attributes['tone']) ? $this->attributes['tone'] : '',
      'melting_lot_start_process' => 1,
      'rod_id' => @$this->attributes['rod_id'],
      'karigar' =>@$this->attributes['karigar']);
    if($this->attributes['process_name']=='Rope Chain'){
      $this->load->model('rope_chains/rope_chain_melting_process_model');
      $process_obj=new rope_chain_melting_process_model($start_process);
    }elseif($this->attributes['process_name']=='Choco Chain'){
      $this->load->model('choco_chains/choco_chain_ag_model');
      $process_obj=new choco_chain_ag_model($start_process);
    }elseif($this->attributes['process_name']=='Office Outside Hook'){
      $this->load->model('office_outside/hook_model');
      $process_obj=new hook_model($start_process);
    }elseif($this->attributes['process_name']=='Office Outside Lotus Dye Process'){
      $this->load->model('lotus_chains/lotus_dye_process_model');
      $process_obj=new lotus_dye_process_model($start_process);
    }elseif($this->attributes['process_name']=='Office Outside KDM'){
      $this->load->model('office_outside/kdm_model');
      $process_obj=new kdm_model($start_process);
    }elseif($this->attributes['process_name']=='Refresh'){
      $this->load->model('refresh/refresh_model');
      $process_obj=new refresh_model($start_process);
    }
    $process_obj->attributes['lot_row_id'] = $this->attributes['id'];
    $process_obj->before_validate();
    $process_obj->store();
    return $process_obj->attributes;
  }

  private function delete_dependent_records($id,$model_name) {
    $get_delete_record_ids=$this->$model_name->get('id',array('melting_lot_id'=>$id));
    if(!empty($get_delete_record_ids)){
      foreach ($get_delete_record_ids as $index => $get_delete_record_id) {
        if(!empty($get_delete_record_id['id']))
        $this->melting_lot_detail_model->delete($get_delete_record_id['id']);
      }
    }
  }

  private function set_parent_lot_name() {
    if(isset($this->formdata['melting_lots']['parent_lot_id'])){
     $parent_lot_name = $this->parent_lot_model->find('name',array('id' => $this->formdata['melting_lots']['parent_lot_id']))['name'];
     $this->attributes['parent_lot_name']=$parent_lot_name;
    }
  }
  public function set_lot_no() {
    $srno = $this->find('max(srno) + 1 as srno', array('process_name' => $this->attributes['process_name']))['srno'];
    $srno = (!empty($srno) ? $srno : 1);
    $this->attributes['srno'] = $srno;
   if ($this->attributes['process_name'] == 'Rope Chain') {
      $this->attributes['lot_no'] = strtoupper('RP-'.sprintf("%02d", $this->attributes['lot_purity']).'-'.sprintf("%02d", $srno));
    } elseif ($this->attributes['process_name'] == 'Choco Chain') {
      $this->attributes['lot_no'] = strtoupper('CC-'.sprintf("%02d", $this->attributes['lot_purity']).'-'.sprintf("%02d", $srno));
    } elseif ($this->attributes['process_name'] == 'Office Outside KDM') {
      $this->attributes['lot_no'] = strtoupper('KDM-'.sprintf("%02d", $srno));
    } elseif ($this->attributes['process_name'] == 'Office Outside Lobster') {
      $this->attributes['lot_no'] = strtoupper('LOB-'.sprintf("%02d", $srno));
    } else{
       $this->attributes['lot_no'] ='';
    }
  }

public function compute_alloy_data($id){
  $get_melting_lot_data = $this->find('',array('id'=>$id));
  $this->attributes = $get_melting_lot_data;
  $melting_lot_alloy_details = new Melting_lot_alloy_detail_model();
  $melting_lot_alloy_details->delete('',array('melting_lot_id'=>$id));
  $this->_add_melting_lot_alloy_details();
}

public function compute_alloy_details_for_all_melting_lots(){
  $melting_lot_ids = $this->get('id');
  foreach($melting_lot_ids as $id){
    $this->compute_alloy_data($id['id']);
  }
}

private function _add_melting_lot_alloy_details(){
  $this->load->model('settings/alloy_detail_model');
  $where = array('product_name'=>$this->attributes['process_name']);
  if(!empty($this->attributes['category_one']))
    $where['category_one'] = $this->attributes['category_one'];

  if(!empty($this->attributes['tone']))
    $where['tone'] = $this->attributes['tone'];
  else
    $where['tone'] = 'yellow';

    $where_in = array('alloy_purity'=>array($this->attributes['lot_purity'],'0.0000'));
    $get_alloy_detail_data = $this->alloy_detail_model->get(
          'alloy_name,weight as weight_pecentage',
          array('where' => $where,
                'where_in' =>$where_in),array(array('alloy_types','alloy_types.id = alloy_settings.alloy_id')));
    foreach($get_alloy_detail_data as $allow_detail_key => $alloy_detail){
      $alloy_details[]=array(
        'melting_lot_id' => $this->attributes['id'],
        'alloy_name' => $alloy_detail['alloy_name'],
        'out_weight' => (($this->attributes['alloy_weight']*$alloy_detail['weight_pecentage'])/100),
      );
    }
    if(!empty($alloy_details)){
      foreach ($alloy_details as $index => $alloy_detail){
        $melting_lot_alloy_details = new Melting_lot_alloy_detail_model($alloy_detail);
        $melting_lot_alloy_details->save();
      }
    }

  }

  public function update_lot_no($data){
      $this->attributes['lot_no'] = $data['lot_no'];
      $this->attributes['id'] = $data['id'];
      $this->attributes['after_melting_process_id'] = $data['after_melting_process_id'];
      $this->update(FALSE);
  }
/*  public function update_in_weight_in_casting_melting($data,$type){
    $this->load->model('casting_processes/casting_process_melting_model');
     
    $melting_lot_data=$this->melting_lot_model->find('sum(gross_weight) gross_weight,count(id) count_of_process',array('after_melting_process_id'=>$data['id']));
    if($melting_lot_data['count_of_process']>1){
    $process_casting=$this->process_model->find('',array('id'=>$data['id']));
    $process_obj = new casting_process_melting_model($process_casting);
    $process_obj->attributes['in_weight'] = $melting_lot_data['gross_weight'];
    $process_obj->before_validate();
    $process_obj->update(false);
      if($type==1){
        redirect(base_url().'processes/processes/view/'.$data['id']);
      }
    }else{
      echo "cannot delete record";
    }
  }*/
  public function check_melting_lot_before_delete($id) {
    $process = $this->process_model->find('*', array('melting_lot_id' => $id));
    if (!empty($process['melting_lot_id'])) {
      return false;
    }else{
      return true; 
    } 
  }
}
