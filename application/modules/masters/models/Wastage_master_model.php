<?php
class Wastage_master_model extends BaseModel{
  protected $table_name = 'wastage_masters';

  public function __construct($data=array()) {
    parent::__construct($data);
  }
  
  public function validation_rules($klass='') {
    $rules[] = array('field' => 'wastage_masters[product_name]',
                     'label' => 'Product name',
                     'rules' => array('trim','required'),
                    );
    $rules[] = array('field' => 'wastage_masters[category_one]',
                     'label' => 'Category one',
                     'rules' => array('trim','required'));
    $rules[] = array('field' => 'wastage_masters[priority]',
                     'label' => 'Priority',
                     'rules' => array('trim','required'));
    // $rules[] = array('field' => 'wastage_masters[machine_size]',
    //                  'label' => 'Machine Size',
    //                  'rules' => array('trim','required'));
    // $rules[] = array('field' => 'wastage_masters[tone]',
    //                  'label' => 'Tone',
    //                  'rules' => array('trim','required'));
    // $rules[] = array('field' => 'wastage_masters[out_lot_purity]',
    //                  'label' => 'Purity',
    //                  'rules' => array('trim','required'));
    // $rules[] = array('field' => 'wastage_masters[wastage]',
    //                  'label' => 'Wastage',
    //                  'rules' => array('trim','required'));
    // $rules[] = array('field' => 'wastage_masters[design_name]',
    //                  'label' => 'Design Code',
    //                  'rules' => array('trim','required'));

    return $rules;
  }

  public function category_unique($name) {
    return parent::check_unique('category_name');
  }

  public function set_wastage_in_process($process) {
    $wastage = $this->get('', array('product_name' => $process['product_name']));
    foreach ($wastages as $key => $wastage) {
      if ($wastage['tone'] != '' && $wastage['tone'] != $process['tone']) continue;
      if ($wastage['category_one'] != '' && $wastage['category_one'] != $process['melting_lot_category_one']) continue;
      if ($wastage['machine_size'] != '' && $wastage['machine_size'] != $process['machine_size']) continue;
      if ($wastage['design_name'] != '' && $wastage['design_name'] != $process['design_code']) continue;
      if ($wastage['out_lot_purity'] != '' && $wastage['out_lot_purity'] != $process['out_lot_purity']) continue;
      return $wastage['wastage'];
    }
    return 0;
  }
}