<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_issue_purity_model extends BaseModel {
  protected $table_name = 'process_issue_purities';
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules() {
    $rules = array(
              array('field' => 'process_issue_purities[process_id]', 'label' => 'Process',
                    'rules' => array('trim', 'required', 'numeric', 'greater_than[0]')),
              array('field' => 'process_issue_purities[wastage]', 'label' => 'Wastage',
                    'rules' => array('trim', 'required', 'numeric','less_than_equal_to[8]')),
            );
    return $rules;
  }
}

