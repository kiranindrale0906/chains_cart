<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Karigar_rate_model extends BaseModel {
  protected $table_name = 'karigar_rates';
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules() {

    $product_name=!empty($this->formdata['karigar_rates']['product_name'])?$this->formdata['karigar_rates']['product_name']:'';
    $process_name=!empty($this->formdata['karigar_rates']['process_name'])?$this->formdata['karigar_rates']['process_name']:'';
    $department_name=!empty($this->formdata['karigar_rates']['department_name'])?$this->formdata['karigar_rates']['department_name']:'';
    $karigar_name=!empty($this->formdata['karigar_rates']['karigar_name'])?$this->formdata['karigar_rates']['karigar_name']:'';

    $append_message="";
    $rules[] = array('field' => 'karigar_rates[product_name]', 'label' => 'product name',
                    'rules' => array('trim', 'required'));
    $rules[] = array('field' => 'karigar_rates[process_name]', 'label' => 'process name',
                    'rules' => array('trim', 'required'));

    $rules[] = array('field' => 'karigar_rates[department_name]', 'label' => 'department name',
                    'rules' => array('trim', 'required'));

    if(!empty($product_name) && $product_name=="Choco Chain" && strtolower($department_name)=="chain making" && ($karigar_name=="Prashanto" || $karigar_name=="Suman")) {
      $rules[] = array('field' => 'karigar_rates[design_code]', 'label' => 'Design code',
                      'rules' => array('trim', 'required'));
      $rules[] = array('field' => 'karigar_rates[purity]', 'label' => 'Purity',
                      'rules' => array('trim', 'required'));
      $append_message = "design code/concept, purity, ";
    }

    // if(!empty($product_name) && ($product_name=="Round Box Chain")) {
    //   $rules[] = array('field' => 'karigar_rates[design_code]', 'label' => 'Design code',
    //                   'rules' => array('trim', 'required'));
    //   $append_message = "design code/concept,";
    // }

    if($product_name=="Imp Italy Chain" && $process_name=="Chain Making Process" && $karigar_name=="Hollow Bappy") {
      $rules[] = array('field' => 'karigar_rates[design_code]', 'label' => 'Design code',
                      'rules' => array('trim', 'required'));
      $append_message = "design code/concept,";
    }

    if($product_name=="Machine Chain" && $department_name=="Joining Department"  && $karigar_name=="Ashish")
    {
      $rules[] = array('field' => 'karigar_rates[design_code]', 'label' => 'Design code',
                      'rules' => array('trim', 'required'));
      $rules[] = array('field' => 'karigar_rates[category]', 'label' => 'Cateogry',
                      'rules' => array('trim', 'required'));
      $rules[] = array('field' => 'karigar_rates[wire_size]', 'label' => 'Wire Size',
                      'rules' => array('trim', 'required'));
      $append_message = "design code/concept,category,wire size,";
    }

    if($product_name=="Rope Chain" && $department_name=="Hook"  && $karigar_name=="Ashish")
    {
      $rules[] = array('field' => 'karigar_rates[code]', 'label' => 'Code',
                      'rules' => array('trim', 'required'));
      $append_message = "code,";
    }

    // if($product_name=="Sisma Chain" && ($department_name=="Chain Making")) {
    //   $rules[] = array('field' => 'karigar_rates[design_code]', 'label' => 'Design code',
    //                   'rules' => array('trim', 'required'));
    //   $append_message = "design code/concept,";
    // }
    
    $rules[] = array('field' => 'karigar_rates[karigar_name]', 'label' => 'karigar name',
                  'rules' => array('trim', 'required', 
                                    array('unique_karigar',
                                          array($this, 'check_karigar_unique'))),
                  'errors'=> array('unique_karigar' => "The selected combination of product name, process name,".$append_message." department name and karigar name already exist."));  
    
    $rules[] = array('field' => 'karigar_rates[rate]', 'label' => 'rate',
                     'rules' => array('trim', 'required', 'numeric', 'greater_than[0]'));
    // $rules[] = array('field' => 'karigar_rates[no_of_workers]', 'label' => 'No of Workers',
    //                  'rules' => array('trim', 'numeric'));
    return $rules;
  }

  public function check_karigar_unique() {
    $product_name=!empty($this->formdata['karigar_rates']['product_name'])?$this->formdata['karigar_rates']['product_name']:'';
    $karigar_name=!empty($this->formdata['karigar_rates']['karigar_name'])?$this->formdata['karigar_rates']['karigar_name']:'';
    $department_name=!empty($this->formdata['karigar_rates']['department_name'])?$this->formdata['karigar_rates']['department_name']:'';
    if(!empty($product_name) && $product_name=="Round Box Chain")
      $fields = array('product_name', 'process_name', 'department_name','design_code','karigar_name');
    else if(!empty($product_name) && ($product_name=="Imp Italy Chain")) {
      if($this->attributes['process_name']=='Chain Making Process') {
        $fields = array('product_name', 'process_name', 'department_name','design_code','karigar_name');
      }  
      else {
        $fields = array('product_name', 'process_name', 'department_name','karigar_name');
      }
    }
    else if(!empty($product_name) && ($product_name=="Sisma Chain")) {
      // if($this->attributes['department_name']=='Chain Making'){
      //   $fields = array('product_name', 'process_name', 'department_name','design_code','karigar_name');
      // }  
      // else {
        $fields = array('product_name', 'process_name', 'department_name','karigar_name');
      //}
    }
    else if(!empty($product_name) && $product_name=="Choco Chain" && ($karigar_name=="Suman" || $karigar_name=="Prashanto")) {
      $fields = array('product_name', 'process_name', 'department_name','design_code','karigar_name',
                      'purity');
    }
    else if($product_name=="Imp Italy Chain" && $karigar_name=="Hollow Bappy") {
      $fields = array('product_name', 'process_name', 'department_name','design_code','karigar_name'); 
    }
    else if($product_name=="Machine Chain") {
      if($department_name=="Joining Department" && $karigar_name=="Ashish") {
        $fields = array('product_name', 'process_name', 'department_name','design_code','karigar_name','category','wire_size'); 
      }
      else {
        $fields = array('product_name', 'process_name', 'department_name','karigar_name');
      }
    }
    else if($product_name=="Rope Chain"){
      if($department_name=="Hook" && $karigar_name=="Ashish") {
        $fields = array('product_name', 'process_name', 'department_name','code','karigar_name'); 
      }
      else{
        $fields = array('product_name', 'process_name', 'department_name','karigar_name');
      }
    }
    else
      $fields = array('product_name', 'process_name', 'department_name','karigar_name');
    
    return parent::check_unique($fields);
  }
   function after_save($action) {
    if (isset($this->formdata['karigar_rate_worker_details'])) {
      foreach ($this->formdata['karigar_rate_worker_details'] as $index => $karigar_rate_detail) {
        if(isset($karigar_rate_detail['delete']) AND $karigar_rate_detail['delete']==1 && !empty($karigar_rate_detail['id'])){
          $this->karigar_rate_worker_detail_model->delete($karigar_rate_detail['id']);
        }
        else{
          unset($karigar_rate_detail['delete']);
          if(!empty($karigar_rate_detail['no_of_workers'])){
            $date=date('Y-m-d',strtotime($karigar_rate_detail['date']));
            $karigar_rate_detail_obj = new karigar_rate_worker_detail_model($karigar_rate_detail);
            $karigar_rate_detail_obj->attributes['karigar_rate_id'] = $this->attributes['id'];
            $karigar_rate_detail_obj->attributes['karigar'] = $this->attributes['karigar_name'];
            $karigar_rate_detail_obj->attributes['date'] = $date;
            $karigar_rate_detail_obj->save();
          }
        }
      }
    }
  }
}