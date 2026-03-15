<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Chain_purity_model extends BaseModel {
  protected $table_name = 'chain_purities';
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules() {
    $rules = array(
              array('field' => 'chain_purities[product_name]', 'label' => 'product name',
                    'rules' => array('trim', 'required')),
              array('field' => 'chain_purities[lot_purity]', 'label' => 'lot purity',
                    'rules' => array('trim', 'required', 'numeric', 'greater_than[0]', 'less_than[100]',
                                      array('unique_purity',
                                            array($this, 'check_unique_purity'))),
                    'errors'=> array('unique_purity' => "The combination of product name and lot purity already exist.")),
            );
    return $rules;
  }

  public function check_unique_purity(){
    $fields = array('product_name', 'lot_purity');
    return parent::check_unique($fields);
  }

  public function get_dropdown_data($where=array()) {
    $rows     = $this->get('product_name, lot_purity',$where);
    
    $dropdown = array();
    foreach ($rows as $row) {
      $dropdown[$row['product_name']][] = array(
        'id'   => $row['lot_purity'],
        'name' => $row['lot_purity']
      );
    }
    return $dropdown;
  }
 
}

