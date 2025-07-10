<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends BaseModel {
  protected $table_name = 'categories';
  public $router_class = 'categories';
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules() {
    if($this->attributes['product_name']=='Sisma Chain'){

    $rules = array(
              array('field' => 'categories[product_name]', 'label' => 'product name',
                    'rules' => array('trim', 'required')),
              array('field' => 'categories[category_one]', 'label' => 'Category One',
                    'rules' => array('trim', 'required',array('unique_product_category',
                                            array($this, 'check_unique_product_category'))),
                    'errors'=> array('unique_product_category' => "The combination of product and category one already exist.")),
            );
    }else{
      
    $rules = array(
              array('field' => 'categories[product_name]', 'label' => 'product name',
                    'rules' => array('trim', 'required')),
              array('field' => 'categories[category_one]', 'label' => 'Category One',
                    'rules' => array('trim', 'required',array('unique_category',
                                            array($this, 'check_unique_category')),
                    array('category_special_charactor',array($this, 'check_special_charactor'))),
                    'errors'=> array('category_special_charactor' => "Remove special charactor from category.",
                      'unique_category'=>'Combination of product name and categories already exist.')),
              array('field' => 'categories[category_two]', 'label' => 'Category Two',
                    'rules' => array('trim',array('category_special_charactor',
                                            array($this, 'check_special_charactor'))),
                    'errors'=> array('category_special_charactor' => "Remove special charactor from category.")),
              array('field' => 'categories[category_three]', 'label' => 'Category Three',
                    'rules' => array('trim',array('category_special_charactor',
                                            array($this, 'check_special_charactor'))),
                    'errors'=> array('category_special_charactor' => "Remove special charactor from category.")),
            );
    }


    return $rules;
  }

  public function check_unique_category(){
    $fields = array('product_name','category_one', 'category_two', 'category_three', 'category_four');
    return parent::check_unique($fields);
  }
   public function check_unique_product_category(){
    $fields = array('product_name', 'category_one');
    return parent::check_unique($fields);
  }
  public function check_special_charactor($fields){
     $charactors = preg_match('/[^a-zA-Z0-9._\d] /', $fields);
     
     if($charactors!=0){
     return false;
     }else{
      return true;
     }
   } 
}

