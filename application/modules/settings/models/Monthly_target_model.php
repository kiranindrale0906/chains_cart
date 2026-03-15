<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Monthly_target_model extends BaseModel {
  protected $table_name = 'monthly_targets';
  protected $id = 'id';
  public $router_class = 'monthly_targets';

  function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules($klass=''){
  	$rules = array(array(
                      'field' => 'monthly_targets[month]',
                      'label' => 'Month',
                      'rules' => 'trim|required'),
                    array(
                      'field' => 'monthly_targets[year]',
                      'label' => 'Year',
                      'rules' => 'trim|required'),
                    array(
                      'field' => 'monthly_targets[product_name]',
                      'label' => 'Product Name',
                      'rules' => 'trim|required'),
                    array(
                      'field' => 'monthly_targets[target_production]',
                      'label' => 'Target Production',
                      'rules' => 'trim|required'),
                    array(
                      'field' => 'monthly_targets[target_rolling]',
                      'label' => 'Target Rolling',
                      'rules' => 'trim|required'),
                    array(
                      'field' => 'monthly_targets[target_gross_stock]',
                      'label' => 'Target Gross Stock',
                      'rules' => 'trim|required'),
                    array(
                      'field' => 'monthly_targets[daily_production]',
                      'label' => 'Daily Production',
                      'rules' => 'trim|required')
                  );
    return $rules;
  }
}