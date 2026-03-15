<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Category_fours extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('settings/same_karigar_model','settings/category_model'));
  }

  public function create(){
    $this->data['record']['product_name']=!empty($_GET['product_name'])?$_GET['product_name']:'';
    parent::create();
  }

  public function edit($id) {
    if (isset($_GET['product_name']) && isset($_GET['category'])) {
      $category_four = $this->model->find('id', array('product_name' => $_GET['product_name'],
                                                      'category'     => $_GET['category'],
                                                      'machine_size' => $_GET['machine_size']));
      if (!empty($category_four))
        $id = $category_four['id'];
      else
       redirect(base_url()."settings/category_fours/create");
    }
    parent::edit($id);
  }
  
  public function _get_form_data(){
    $this->data['products']     = get_product_dropdown();
    $this->data['category_one'] = array();
    if($this->router->method == 'edit')
      $this->data['record']['product_name'] = !empty($_GET['product_name']) ? $_GET['product_name'] : $this->data['record']['product_name'];
    
    if(!empty($this->data['record']['product_name']))
      $this->data['category_one'] = $this->category_model->get('category_one as name ,category_one as id',
                                                                array('product_name' => $this->data['record']['product_name']),
                                                                array(), array('group_by' => 'category_one', 'order_by' => 'category_one'));
    $this->data['category_three'] = $this->category_model->get('category_three as name ,category_three as id',
                                                                array('product_name' => $this->data['record']['product_name']),
                                                                array(), array('group_by' => 'category_three', 'order_by' => 'category_three'));

	}
}
