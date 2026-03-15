<?php
class Orders extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('order_detail_model','settings/chain_purity_model'));
    $this->redirect_after_save ='view';
  }

  public function _get_form_data(){
  	if (isset($_GET['chain_name'])) $this->data['record']['chain_name'] = $_GET['chain_name'];
  	$this->data['chains'] = $this->model->find('*, name as name, name as id', 
  																					array('name' => $this->data['record']['chain_name']), array(), array('table' => 'chains'));
  	$this->data['selected_labels'] = array_slice($this->data['chains'],8);

  	$this->data['category_1'] = $this->model->get('category_name as id,category_name as name', 
  																					array('chain_name' => $this->data['record']['chain_name']), array(), array('table' => 'category_1'));
  	$this->data['category_2'] = $this->model->get('category_name as id,category_name as name', 
  																					array('chain_name' => $this->data['record']['chain_name']), array(), array('table' => 'category_2'));
  	$this->data['category_3'] = $this->model->get('category_name as id,category_name as name', 
  																					array('chain_name' => $this->data['record']['chain_name']), array(), array('table' => 'category_3'));
  	$this->data['category_4'] = $this->model->get('category_name as id,category_name as name', 
  																					array('chain_name' => $this->data['record']['chain_name']), array(), array('table' => 'category_4'));
  	$this->data['category_5'] = $this->model->get('category_name as id,category_name as name', 
  																					array('chain_name' => $this->data['record']['chain_name']), array(), array('table' => 'category_5'));
  	$this->data['category_6'] = $this->model->get('category_name as id,category_name as name', 
  																					array('chain_name' => $this->data['record']['chain_name']), array(), array('table' => 'category_6'));
    $this->data['melting_lots_lot_purity']= $this->chain_purity_model->get('lot_purity as id, lot_purity as name, product_name',
                                                                        array('product_name' => $this->data['record']['chain_name']));
  	if ($this->router->method=='create')
      $this->data['order_details'] = array();
    elseif ($this->router->method=='edit')
  		$this->data['order_details'] = $this->order_detail_model->get('',
                                             array('order_id' =>$this->data['record']['id']));
  	else
      @$this->data['order_details'] = @$_POST['order_details'];
  }

  public function _get_view_data(){ 
    $this->data['chains'] = $this->model->find('*, name as name, name as id', 
                                            array('name' => $this->data['record']['chain_name']), array(), 
                                            array('table' => 'chains'));
    $this->data['selected_labels'] = array_slice($this->data['chains'],8);
    $this->data['orders'] = $this->model->find('*',
                                            array('id' => $this->data['record']['id']), array(), array('table' => 'orders'));
    $this->data['order_details'] = $this->order_detail_model->get('',
                                             array('order_id' =>$this->data['record']['id']));
    $this->data['melting_lots_lot_purity']= $this->chain_purity_model->get('lot_purity as id, lot_purity as name, product_name',
                                                                        array('product_name' => $this->data['record']['chain_name']));
  }

  public function update($id) {
    if(isset($_GET['from']) && $_GET['from']=='view') {
      $order_model = $this->model->find('id', array('id' => $id));
      $order_model_obj = new $this->model($order_model);
      $order_model_obj->before_validate();
      $order_model_obj->save(FALSE);
      redirect($_SERVER['HTTP_REFERER']);
    } else {
      parent::update($id);
    }
  }
}