<?php
class Alloy_element_detail_model extends BaseModel{
  protected $table_name = 'alloy_element_details';

  public function __construct($data=array()) {
    parent::__construct($data);
  }
  public function before_validate() {
    $this->attributes['ag']=!empty($this->attributes['ag'])?$this->attributes['ag']:0;
    $this->attributes['cu']=!empty($this->attributes['cu'])?$this->attributes['cu']:0;
    $this->attributes['zn']=!empty($this->attributes['zn'])?$this->attributes['zn']:0;
    $this->attributes['i_n']=!empty($this->attributes['i_n'])?$this->attributes['i_n']:0;
    $this->attributes['ir']=!empty($this->attributes['ir'])?$this->attributes['ir']:0;
    $this->attributes['co']=!empty($this->attributes['co'])?$this->attributes['co']:0;
    $this->attributes['ru']=!empty($this->attributes['ru'])?$this->attributes['ru']:0;
    $this->attributes['ni']=!empty($this->attributes['ni'])?$this->attributes['ni']:0;
    $this->attributes['xi']=!empty($this->attributes['xi'])?$this->attributes['xi']:0;
    $this->attributes['ga']=!empty($this->attributes['ga'])?$this->attributes['ga']:0;
    $this->attributes['ta']=!empty($this->attributes['ta'])?$this->attributes['ta']:0;
    $this->attributes['ge']=!empty($this->attributes['ge'])?$this->attributes['ge']:0;
    $this->attributes['extra']=!empty($this->attributes['extra'])?$this->attributes['extra']:0;
  }
  public function validation_rules($klass='') {
    $rules[] = array('field' => 'alloy_element_details[company_name]',
                     'label' => 'name',
                     'rules' => array('trim','required',array('total_of_element_error', 
                                      array($this, 'total_of_element'))),
                     'errors'=> array('required'=>'The Company Name field is required.','total_of_element_error' => "Sum of element is not 100"));
    // $rules[]=array('field' => 'alloy_element_details[ag]',
    //                  'label' => 'ag',
    //                  'rules' => array('trim','numaric'),
    //                  'errors'=> array('numaric'=>'ag should be numaric'));
    // $rules[]=array('field' => 'alloy_element_details[cu]',
    //                  'label' => 'cu',
    //                  'rules' => array('trim','numaric'),
    //                  'errors'=> array('numaric'=>'cu should be numaric'));
    // $rules[]=array('field' => 'alloy_element_details[zn]',
    //                  'label' => 'zn',
    //                  'rules' => array('trim','numaric'),
    //                  'errors'=> array('numaric'=>'zn should be numaric'));
    // $rules[]=array('field' => 'alloy_element_details[i_n]',
    //                  'label' => 'in',
    //                  'rules' => array('trim','numaric'),
    //                  'errors'=> array('numaric'=>'in should be numaric'));
    // $rules[]=array('field' => 'alloy_element_details[jr]',
    //                  'label' => 'ir',
    //                  'rules' => array('trim','numaric'),
    //                  'errors'=> array('numaric'=>'ir should be numaric'));
    // $rules[]=array('field' => 'alloy_element_details[co]',
    //                  'label' => 'co',
    //                  'rules' => array('trim','numaric'),
    //                  'errors'=> array('numaric'=>'co should be numaric'));
    // $rules[]=array('field' => 'alloy_element_details[ru]',
    //                  'label' => 'ru',
    //                  'rules' => array('trim','numaric'),
    //                  'errors'=> array('numaric'=>'ru should be numaric'));
    // $rules[]=array('field' => 'alloy_element_details[ni]',
    //                  'label' => 'ni',
    //                  'rules' => array('trim','numaric'),
    //                  'errors'=> array('numaric'=>'ni should be numaric'));
    // $rules[]=array('field' => 'alloy_element_details[xi]',
    //                  'label' => 'xi',
    //                  'rules' => array('trim','numaric'),
    //                  'errors'=> array('numaric'=>'xi should be numaric'));
    // $rules[]=array('field' => 'alloy_element_details[extra]',
    //                  'label' => 'extra',
    //                  'rules' => array('trim','numaric'),
    //                  'errors'=> array('numaric'=>'extra should be numaric'));
    return $rules;
  }
  public function total_of_element($name) {
     $total =0;
    $total = four_decimal(($this->attributes['ag'])+($this->attributes['cu'])+($this->attributes['zn'])+($this->attributes['i_n'])+($this->attributes['ir'])+($this->attributes['co'])+($this->attributes['ru'])+($this->attributes['ni'])+($this->attributes['xi'])+($this->attributes['extra'])+($this->attributes['ga'])+($this->attributes['ta'])+($this->attributes['ge']));
    
    if($total==100){
      return true;
    }else{
      return false;
    }
  }
}