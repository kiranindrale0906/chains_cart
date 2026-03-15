<?php
class Machine_master_model extends BaseModel{
  protected $table_name = 'machine_masters';

  public function __construct($data=array()) {
    parent::__construct($data);
  }
  
  public function validation_rules($klass='') {
    $rules[] = array('field' => 'machine_masters[product_name]',
                     'label' => 'Product name',
                     'rules' => array('trim','required'),
                    /* 'errors'=> array('required'=>'The Category Name field is required.',
                                      'unique_name' => "Category name must be unique.")*/);
    $rules[] = array('field' => 'machine_masters[process_name]',
                     'label' => 'Process name',
                     'rules' => array('trim','required'));
    $rules[] = array('field' => 'machine_masters[department_name]',
                     'label' => 'Department name',
                     'rules' => array('trim','required'));
    
    $rules[] = array('field' => 'machine_masters[category_one]',
                     'label' => 'Category one',
                     'rules' => array('trim','required'));
    $rules[] = array('field' => 'machine_masters[category_two]',
                     'label' => 'Category Two',
                     'rules' => array('trim','required'));
    $rules[] = array('field' => 'machine_masters[category_three]',
                     'label' => 'Category Three',
                     'rules' => array('trim','required'));
    $rules[] = array('field' => 'machine_masters[category_four]',
                     'label' => 'Category Four',
                     'rules' => array('trim','required'));
    
    $rules[] = array('field' => 'machine_masters[machine_size]',
                     'label' => 'Machine Size',
                     'rules' => array('trim','required'));
    $rules[] = array('field' => 'machine_masters[design_code]',
                     'label' => 'Design Code',
                     'rules' => array('trim','required'));

    $rules[] = array('field' => 'machine_masters[machine_name]',
                     'label' => 'Machine name',
                     'rules' => array('trim','required'));
    return $rules;
  }

  public function category_unique($name) {
    return parent::check_unique('category_name');
  }
}