<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_four_model extends BaseModel {
  protected $table_name = 'category_four';
  public $router_class = 'category_fours';
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
    $this->load->model(array('settings/process_issue_purity_model'));
  }

  public function validation_rules() {
    $rules = array(
              array('field' => 'category_fours[product_name]', 'label' => 'product name',
                    'rules' => array('trim', 'required')),
               array('field' => 'category_fours[design_chitti_name]', 'label' => 'design chitti name',
                    'rules' => array('trim', 'required')),
              array('field' => 'category_fours[category]', 'label' => 'Category',
                    'rules' => array('trim', 'required',array('unique_category',
                                            array($this, 'check_unique_category')),array('unique_special_charactor',
                                            array($this, 'check_special_charactor'))),
                    'errors'=> array('unique_special_charactor' => "The combination of product name and category already exist.",
                      'unique_special_charactor' => "Remove special charactor from category.")),
            );
    if($this->attributes['product_name']=='KA Chain' && $this->attributes['category_one'] != 'Dhoom Chain'){
      $rules[]=array('field' => 'category_fours[machine_size]', 'label' => 'Machine Size',
                    'rules' => array('trim', 'required'));
    }

    return $rules;
  }

  public function check_unique_category(){
    return true;
    $fields = array('product_name', 'category_one', 'category');
    return parent::check_unique($fields);
  }
  
  public function check_special_charactor($fields){
    $charactors = preg_match('/[^a-zA-Z0-9. \d]/', $fields);
   
    if ($charactors!=0) {
      return false;
    } else {
      return true;
    }
  } 

  public function get_category_four_dropdown_data() {
    $rows     = $this->get('product_name,category_one,category');

    $dropdown = array();
    foreach ($rows as $row) {
      $dropdown[$row['product_name']][$row['category_one']][] = array(
        'id'   => $row['category'],
        'name' => $row['category']
      );
    }
    return $dropdown;
  }

  public function get_chitti_design_name($process_id) {
    $process_issue_purity = $this->process_issue_purity_model->find('design_chitti_name', array('process_id' => $process_id));
    if (!empty($process_issue_purity) && $process_issue_purity['design_chitti_name'] != '') return $process_issue_purity['design_chitti_name'];

    $process = $this->Process_model->find('product_name, melting_lot_category_one, out_lot_purity,
       melting_lot_category_four, machine_size, design_code, melting_lot_category_three, melting_lot_category_two, tone', 
                                          array('id' => $process_id));
    if ($process['product_name']=='IMP Premium Chain' && $process['design_code']=='RTN')
      return 'IMP Premium RTN';
    elseif ($process['product_name']=='Stone Chain' && $process['design_code']=='RTN')
      return 'Stone Chain RTN';
    elseif ($process['product_name']=='Omega Chain' && $process['design_code']=='RTN')
      return 'Omega RTN';
    elseif ($process['product_name']=='Morocco Collection' && $process['design_code']=='RTN')
      return 'Morocco Collection RTN';
    elseif ($process['product_name'] == 'KA Chain' && $process['design_code']=='RTN')
      $design_chitti_name = 'RTN';
    elseif ($process['melting_lot_category_one']=='Others')
      $design_chitti_name = 'RTN';
    elseif ($process['product_name'] == 'KA Chain' && $process['melting_lot_category_one']=='Dhoom Chain') 
      $design_chitti_name = $process['design_code'];
    elseif ($process['product_name'] == 'KA Chain') {
      $design_chitti_name = $this->category_four_model->find('', array('category' => $process['design_code'],
                                                                       'machine_size' => $process['machine_size']));
      $design_chitti_name = !empty($design_chitti_name['design_chitti_name']) ? $design_chitti_name['design_chitti_name'] : '';
      if (strpos($process['melting_lot_category_one'], 'IMP') !== false) $design_chitti_name .= ' IMP';
    } elseif ($process['product_name'] == 'Ball Chain') {
      return $process['melting_lot_category_three'].'mm '.$process['melting_lot_category_one'].' '.$process['melting_lot_category_two'].' '.$process['design_code'].' '.$process['tone'];
    } elseif ($process['product_name'] == 'Machine Chain' && $process['melting_lot_category_one'] == 'Spyke') {
      $design_chitti_name = 'Machine Chain Sypke';
    }
    elseif ($process['product_name'] == 'Fancy Chain')
      $design_chitti_name = $process['product_name'].' '.$process['melting_lot_category_one'];
    elseif (!empty($process['melting_lot_category_one']))
      $design_chitti_name = $process['product_name'].' '.$process['melting_lot_category_one'];
    else
      $design_chitti_name = $process['product_name'];

    return $design_chitti_name;
  }
}

