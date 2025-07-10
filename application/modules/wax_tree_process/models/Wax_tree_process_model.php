<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Wax_tree_process_model extends BaseModel {
  protected $table_name = 'wax_tree_process';
  protected $id = 'id';
  public $router_class  = 'wax_tree_processes';

  function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules($klass=''){
  	$rules = array(array(
                    'field' => 'wax_tree_processes[item_name]',
                    'label' => 'Item Name',
                    'rules' =>  array('trim', 'required')),
                  array( 
                    'field' =>  'wax_tree_processes[type]',
                    'label' =>  'Type',
                    'rules' =>  array('trim','required')),
                  array( 
                    'field' =>  'wax_tree_processes[tone]',
                    'label' =>  'Tone',
                    'rules' =>  array('trim','required')),
                  array( 
                    'field' =>  'wax_tree_processes[melting]',
                    'label' =>  'Melting',
                    'rules' =>  array('trim','required','numeric')),
                  array( 
                    'field' =>  'wax_tree_processes[tree_gross_wt]',
                    'label' =>  'Tree Gross Wt',
                    'rules' =>  array('trim','required','numeric')),
                  array( 
                    'field' =>  'wax_tree_processes[tree_base_wt]',
                    'label' =>  'Tree base Wt',
                    'rules' =>  array('trim','required','numeric')),
                  array( 
                    'field' =>  'wax_tree_processes[stone_wt]',
                    'label' =>  'Stone Wt',
                    'rules' =>  array('trim','required','numeric')),

                  );
    return $rules;
  }

  // public function is_name_unique() {
  //   $where_conditions = array('item_name' => $this->attributes['name']);
  //   if(isset($this->attributes['id']))
  //     $where_conditions['id!='] = $this->attributes['id'];

  //   $result = $this->get('id', $where_conditions);
  //   return (empty($result)) ? true : false;
  // }

  public function before_save($action) {
    if($this->attributes['tone']=='Yellow' && $this->attributes['melting']==92){
      $this->attributes['gold_ratio']=18;
    }elseif ($this->attributes['tone']=='Pink' && $this->attributes['melting']==92) {
      $this->attributes['gold_ratio']=17;
    }elseif ($this->attributes['tone']=='Yellow' && $this->attributes['melting']==75) {
      $this->attributes['gold_ratio']=16;
    }elseif ($this->attributes['tone']=='Pink' && $this->attributes['melting']==75) {
      $this->attributes['gold_ratio']=15;
    }
    $this->attributes['tree_net_wt'] = $this->attributes['tree_gross_wt']-$this->attributes['tree_base_wt']-$this->attributes['stone_wt'];

    $this->attributes['total_required_gold'] = $this->attributes['tree_net_wt']*$this->attributes['gold_ratio'];
    $this->attributes['status'] = 'Pending';

  }
  public function update_lot_nos($wax_tree_details) {
    if(!empty($wax_tree_details)){
      foreach ($wax_tree_details as $index => $wax_tree_detail) {
        if (isset($wax_tree_detail['lot_no'])) {
        $voucher_obj = new wax_tree_lot_no_process_model($wax_tree_detail);
        $voucher_obj->attributes['status'] = 'Pending';
        $voucher_obj->attributes['lot_no'] = '';
        $voucher_obj->update(false);
        }
      }
    }
  }
}