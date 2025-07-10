<?php
class Melting_lot_detail_model extends BaseModel{
	protected $table_name = 'melting_lot_details';
  protected $id = 'id';

  public function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules($klass='') {
    // pd($this->formdata);
    // $rules= array(array('field' => 'melting_lot_id', 'label' => 'melting_lot_id',
    //                     'rules' => 'trim|required',
    //                     'errors'=>array('required'=>'Melting Lot id is required')));
    foreach($this->formdata['melting_lot_details'] as $index => $melting_lot_detail) {

     $rules= array(array('field' => 'melting_lot_details['.$index.'][required_weight]', 'label' => 'weight','rules' => array('trim', 'required','greater_than_equal_to['.$melting_lot_detail['in_weight'].']','less_than_equal_to['.$melting_lot_detail['in_weight'].']' 
                   ),
        'errors'=>array(
          'greater_than_equal_to'=>'Required weight should be same as in weight',
          'less_than_equal_to'=>'Required weight should be same as in weight')));
    
    }
    return $rules;
  }

  public function save($after_save=true) { 
    if (isset($this->formdata['add_to_existing_melting_lot']) && $this->formdata['add_to_existing_melting_lot']==TRUE) {
      foreach($this->formdata['melting_lot_details'] as $index => $melting_lot_detail) {
        if (empty($melting_lot_detail['required_weight'])) continue;
        $melting_lot_detail_obj = new Melting_lot_detail_model($melting_lot_detail);
        $melting_lot_detail_obj->store();
      }
      $this->update_wastage_weight_and_gross_weight_in_melting_lot($this->formdata['melting_lot_id']);
      $melting_detail=$this->melting_lot_model->find('',array('id'=>$this->formdata['melting_lot_id']));
      if($melting_detail['process_name']=='Fancy 75 Chain'){
        $this->update_fancy_seventy_chain_fancy_hold_process($this->formdata['melting_lot_id'],$this->formdata['karigar']);
      }else{
        $this->update_fancy_chain_fancy_hold_process($this->formdata['melting_lot_id'],$this->formdata['karigar']);
      }

    } else
       parent::save($after_save);
  }

  public function after_save($action){
    $this->update_balance_wastage_in_process();    
  }

  private function update_balance_wastage_in_process() {
    $out_melting_wastage = $this->find('sum(required_weight) as required_weight', 
                                       array('process_id' => $this->attributes['process_id'],
                                             'melting_lot_id' => $this->attributes['melting_lot_id']));
    $process_data = $this->process_model->find('', array('id' => $this->attributes['process_id']));
    $process_data['out_melting_wastage'] = $process_data['out_melting_wastage'] + $out_melting_wastage['required_weight'];
    $model_name = get_model_name($process_data['product_name'], $process_data['process_name']);
    $this->load->model($model_name['module_name'].'/'.$model_name['model_name']);
    $process_obj = new $model_name['model_name']($process_data);

    $process_obj->before_validate();
    $process_obj->save(false);
  }

  private function update_wastage_weight_and_gross_weight_in_melting_lot($melting_lot_id) {
    $melting_lot = $this->melting_lot_model->find('', array('id' => $melting_lot_id));
    $melting_lot_details = $this->find('sum(required_weight) as wastage_weight', array('melting_lot_id' => $melting_lot_id));
    $melting_lot_obj = new melting_lot_model($melting_lot);
    $melting_lot_obj->attributes['wastage_weight'] = $melting_lot_details['wastage_weight'];
    $melting_lot_obj->attributes['gross_weight'] = $melting_lot_obj->attributes['wastage_weight']
                                                   + $melting_lot_obj->attributes['alloy_weight']
                                                   + $melting_lot_obj->attributes['alloy_vodatar'];
    $melting_lot_obj->update(false);
  }
   public function update_fancy_chain_fancy_hold_process($melting_lot_id,$karigar='') {
      $this->load->model('fancy_chains/fancy_chain_fancy_hold_process_model');
    $melting_lot = $this->melting_lot_model->find('', array('id' => $melting_lot_id));

    $inital_melting_lot_gross_weight = $this->fancy_chain_fancy_hold_process_model->find('in_weight', array('melting_lot_id' => $melting_lot_id,'status' => 'Complete',                                      'department_name' => 'Fancy Hold'));
    $inital_melting_lot_gross_weight = $inital_melting_lot_gross_weight['in_weight'];

    $total_chain_making_in_weight_factory_out = $this->fancy_chain_fancy_hold_process_model->find('sum(in_weight) as in_weight, sum(factory_out) as factory_out', array('melting_lot_id' => $melting_lot_id,'status' => 'Complete','department_name' => 'Fancy Hold'));
    $total_chain_making_in_weight = $total_chain_making_in_weight_factory_out['in_weight'];
    $total_chain_making_factory_out = $total_chain_making_in_weight_factory_out['factory_out'];

    $last_factory_out_weight = $this->fancy_chain_fancy_hold_process_model->find('factory_out', 
                                                                                    array('melting_lot_id' => $melting_lot_id, 
                                                                                          'status' => 'Complete',
                                                                                          'department_name' => 'Fancy Hold'), array(), array('order_by' => 'id desc'));
    $last_factory_out_weight = $last_factory_out_weight['factory_out'];
    $used_melting_lot_wastage_weight = $total_chain_making_in_weight - $inital_melting_lot_gross_weight + $last_factory_out_weight - $total_chain_making_factory_out;
    $additional_melting_lot_wastage_weight  =  $melting_lot['gross_weight'] - $inital_melting_lot_gross_weight - $used_melting_lot_wastage_weight;
    
    // $completed_chain_making_department = $this->fancy_chain_fancy_hold_process_model->find('id, in_weight, factory_out', 
    //                                                                                           array('id' => $fancy_chain_start_department['parent_id']));
    $gross_weight = $last_factory_out_weight + $additional_melting_lot_wastage_weight;   
    // if (!empty($completed_chain_making_department))
    //   $gross_weight = $completed_chain_making_department['factory_out'] + ($gross_weight - $completed_chain_making_department['in_weight']);
    $pending_chain_making_department   = $this->fancy_chain_fancy_hold_process_model->find('', array('melting_lot_id' => $melting_lot_id, 
                                                                                                       'status' => 'Pending',
                                                                                                       'department_name' => 'Fancy Hold'));
    $fancy_chain_obj = new fancy_chain_fancy_hold_process_model($pending_chain_making_department);

    $fancy_chain_obj->attributes['in_weight'] = $gross_weight;
    $fancy_chain_obj->before_validate();
    $fancy_chain_obj->update(false);    

    $fancy_chain_start_department      = $this->fancy_chain_fancy_hold_process_model->find('', array('id' => $pending_chain_making_department['parent_id']));
    $fancy_chain_obj = new fancy_chain_fancy_hold_process_model($fancy_chain_start_department);
    $fancy_chain_obj->attributes['in_weight'] = $gross_weight;
    $fancy_chain_obj->attributes['out_weight'] = $gross_weight;
    $fancy_chain_obj->update(false);
    
  }

  public function update_fancy_seventy_chain_fancy_hold_process($melting_lot_id,$karigar='') {
    $this->load->model('fancy_seventy_chains/fancy_seventy_chain_fancy_hold_process_model');
    $melting_lot = $this->melting_lot_model->find('', array('id' => $melting_lot_id));

    $inital_melting_lot_gross_weight = $this->fancy_seventy_chain_fancy_hold_process_model->find('in_weight', array('melting_lot_id' => $melting_lot_id,'status' => 'Complete',                                      'department_name' => 'Fancy Hold'));
    $inital_melting_lot_gross_weight = $inital_melting_lot_gross_weight['in_weight'];

    $total_chain_making_in_weight_factory_out = $this->fancy_seventy_chain_fancy_hold_process_model->find('sum(in_weight) as in_weight, sum(factory_out) as factory_out', array('melting_lot_id' => $melting_lot_id,'status' => 'Complete','department_name' => 'Fancy Hold'));
    $total_chain_making_in_weight = $total_chain_making_in_weight_factory_out['in_weight'];
    $total_chain_making_factory_out = $total_chain_making_in_weight_factory_out['factory_out'];

    $last_factory_out_weight = $this->fancy_seventy_chain_fancy_hold_process_model->find('factory_out', 
                                                                                    array('melting_lot_id' => $melting_lot_id, 
                                                                                          'status' => 'Complete',
                                                                                          'department_name' => 'Fancy Hold'), array(), array('order_by' => 'id desc'));
    $last_factory_out_weight = $last_factory_out_weight['factory_out'];
    $used_melting_lot_wastage_weight = $total_chain_making_in_weight - $inital_melting_lot_gross_weight + $last_factory_out_weight - $total_chain_making_factory_out;
    $additional_melting_lot_wastage_weight  =  $melting_lot['gross_weight'] - $inital_melting_lot_gross_weight - $used_melting_lot_wastage_weight;
    
    // $completed_chain_making_department = $this->fancy_seventy_chain_fancy_hold_process_model->find('id, in_weight, factory_out', 
    //                                                                                           array('id' => $fancy_chain_start_department['parent_id']));
    $gross_weight = $last_factory_out_weight + $additional_melting_lot_wastage_weight;   
    // if (!empty($completed_chain_making_department))
    //   $gross_weight = $completed_chain_making_department['factory_out'] + ($gross_weight - $completed_chain_making_department['in_weight']);
    $pending_chain_making_department   = $this->fancy_seventy_chain_fancy_hold_process_model->find('', array('melting_lot_id' => $melting_lot_id, 
                                                                                                       'status' => 'Pending',
                                                                                                       'department_name' => 'Fancy Hold'));
    $fancy_chain_obj = new fancy_seventy_chain_fancy_hold_process_model($pending_chain_making_department);

    $fancy_chain_obj->attributes['in_weight'] = $gross_weight;
    $fancy_chain_obj->before_validate();
    $fancy_chain_obj->update(false);    

    $fancy_chain_start_department      = $this->fancy_seventy_chain_fancy_hold_process_model->find('', array('id' => $pending_chain_making_department['parent_id']));
    $fancy_chain_obj = new fancy_seventy_chain_fancy_hold_process_model($fancy_chain_start_department);
    $fancy_chain_obj->attributes['in_weight'] = $gross_weight;
    $fancy_chain_obj->attributes['out_weight'] = $gross_weight;
    $fancy_chain_obj->update(false);
    
  }
}
