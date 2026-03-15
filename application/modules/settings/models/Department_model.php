<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Department_model extends BaseModel {
  protected $table_name = 'departments';
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
  }
  
  public function before_validate() {
    if(isset($this->formdata['department_workers'])) {
      foreach ($this->formdata['department_workers'] as $index => $department_worker) {
        if(isset($department_worker['delete']) && $department_worker['delete'] == 1 && empty($department_worker['id'])) {
          unset($this->formdata['department_workers'][$index]);
        }
      }
    }
  }


  public function validation_rules($klass='') {
    $rules = array(
                array(
                  'field' => 'departments[name]',
                  'label' => 'Name',
                  'rules' => array('trim', 'required',
                                  array('unique_department',array($this,'check_department_unique'))),
                  'errors' => array('unique_department' => 'The entered department name already exists!!')
                ),
                array(
                  'field' => 'departments[department_process_value]',
                  'label' => 'Process',
                  'rules' => array('trim','required')
                )
              );
    $rules = $this->association_validation_rules($rules,'department_workers','department_worker_model');
    
    return $rules;
  }
  
  protected function association_validation_rules($rules,$association_router_class,$association_model) {
    if(isset($this->formdata[$association_router_class])){
      foreach($this->formdata[$association_router_class] as $index => $association_record) {
        if(empty($association_record['delete'])){
          $association_rules = $this->$association_model->validation_rules('', $index);
          $rules = array_merge($rules, $association_rules);
        } 
        
      }
    }
    return $rules;
  }
  
  public function check_department_unique() {
    return parent::check_unique(array('name','karigar_name'));
  }
  
  public function before_save($action) {
    $this->attributes['other_departments'] = implode(preg_split('/\s*,\s*/', trim($this->attributes['other_departments'])),',');    //pd($this->attributes);
  }
          
  function after_save($action) {
    if (isset($this->formdata['department_workers'])) {
      foreach ($this->formdata['department_workers'] as $index => $department_worker) {
        if(isset($department_worker['delete']) && $department_worker['delete']==1 && !empty($department_worker['id'])){
          $this->department_worker_model->delete($department_worker['id']);
        }
        else{
          unset($department_worker['delete']);
          if(!empty($department_worker['worker_count'])){
            $date=date('Y-m-d',strtotime($department_worker['date']));
            $karigar_rate_detail_obj = new department_worker_model($department_worker);
            $karigar_rate_detail_obj->attributes['department_id'] = $this->attributes['id'];
            $karigar_rate_detail_obj->attributes['date'] = $date;
            $karigar_rate_detail_obj->save();
          }
        }
      }
    }
  }
}