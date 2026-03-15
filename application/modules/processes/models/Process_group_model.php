<?php 
class Process_group_model extends BaseModel{
  protected $table_name= 'process_groups';
  
  public function __construct($data = array()){
    parent::__construct($data);
    $this->load->model(array('melting_lots/melting_lot_model'));  
  }
  
  public function validation_rules($klass='') {
    $rules=array(
      array('field' => 'process_groups[process_ids]', 'label' => 'Lots',
            'rules' => array('trim', array('check_unique_parent_lot_id', array($this,'check_unique_parent_lot_id'))), 
            'errors'=>array('required'=>'Please Select Lots',
                            'check_unique_parent_lot_id'=>'select unique purity lots')),
    );
    return $rules;
  }

  public function check_unique_parent_lot_id() {
    $processes = $this->process_model->get('melting_lot_id', 
                           array('where_in' => array('id' => $this->formdata['process_groups']['process_ids'])));
    $melting_lot_ids = array_column($processes, 'melting_lot_id');
    $melting_lots = $this->melting_lot_model->get('parent_lot_id',
                                                    array('where_in' => array('id' => $melting_lot_ids)));
    $parent_lot_ids = array_column($melting_lots, 'parent_lot_id');
    return (count(array_unique($parent_lot_ids)) == 1);
  }

  public function save($after_save=TRUE) {
    $flatting_process = $this->create_flatting_process();
    $where = $this->query_for_processes_entries_to_be_combined()['where'];
    pd($where);
    $processes = $this->process_model->get('id, melting_lot_id', $where); 

    
    foreach($processes as $process) {
      $process_group = array('parent_id' => $flatting_process['id'],
                             'process_id' => $process['id']);

      
      $process_group_obj = new Process_group_model($process_group);
      $process_group_obj->store();
    }
  }
  
  private function create_flatting_process() {
    $query = $this->query_for_processes_entries_to_be_combined();
    $process = $this->process_model->find('sum(out_weight) as in_weight,
                                           (sum(out_weight*out_purity) / sum(out_weight)) as in_purity,
                                           (sum(out_weight*out_lot_purity) / sum(out_weight)) as in_lot_purity,
                                           group_concat(lot_no) as lot_nos,
                                           max(parent_lot_name) as parent_lot_name,
                                           max(melting_lot_id) as melting_lot_id, 
                                           max(parent_lot_id) as parent_lot_id, 
                                           max(hook_kdm_purity) as hook_kdm_purity, max(tone) as tone,max(input_type) as input_type,max(design_code) as design_code, max(machine_size) as machine_size,max(karigar) as karigar, max(melting_lot_category_one) as melting_lot_category_one',
                                           $query['where'],
                                           array());
  
    $flatting_process = array(
                              'parent_lot_id' => $process['parent_lot_id'],
                              'parent_lot_name' => $process['parent_lot_name'], 

                              'melting_lot_id' => $process['melting_lot_id'],
                              'lot_no' => $process['lot_nos'], 
                              'row_id' => $process['melting_lot_id'],

                              'melting_lot_category_one' => $process['melting_lot_category_one'],
                              'design_code' => $process['design_code'],
                              'machine_size' => $process['machine_size'],
                              'karigar' => $process['karigar'],
                              
                              'in_weight' => $process['in_weight'],
                              'in_purity' => $process['in_purity'],
                              'in_lot_purity' => $process['in_lot_purity'],
                              'hook_kdm_purity' => $process['hook_kdm_purity'],
                              'tone' => $process['tone'],
                              'input_type' => @$process['input_type'],
                              'status' => 'Pending',
                              'out_weight' => 0);

    if ($this->attributes['product_name'] == 'Casting Process') {
      $this->load->model('casting_processes/casting_process_melting_model');
      $flatting_process['department_name']='Melting';
      $flatting_process_obj = new casting_process_melting_model($flatting_process);
    }
    $flatting_process_obj->before_validate();
    $flatting_process_obj->store();
    return $flatting_process_obj->attributes;
  }

  private function query_for_processes_entries_to_be_combined() {
    $query = array();
    if($this->attributes['product_name']=='Sisma Chain')
    {
      $query['where'] = array('where_in' => array('id' =>  $this->attributes['process_ids'],
                                                  'process_name' => array("'RND In Process'"),
                                                  'department_name' => array("'Start'")),
                              'where' => array('product_name' => $this->attributes['product_name'],
                                               'out_purity >' => 0));
    }elseif($this->attributes['product_name']=='Casting Process')
    {
      $query['where'] = array('where_in' => array('id' =>  $this->attributes['process_ids'],
                                                  'process_name' => array("'Melting Process'"),
                                                  'department_name' => array("'Melting'")),
                              'where' => array('product_name' => $this->attributes['product_name'],
                                               'out_purity >' => 0));
    }else if($this->attributes['product_name']=='Indo tally Chain' && ($this->attributes['process_name']=='AG Flatting' || $this->attributes['process_name']=='PL Flatting')){
      $query['where'] = array('where_in' => array('id' =>  $this->attributes['process_ids'],
                                                  'process_name' => array("'AG Flatting'","'PL Flatting'"),
                                                  'department_name' => array("'Wire Drawing'")),
                              'where' => array('product_name' => $this->attributes['product_name'],
                                               'out_purity >' => 0));
    
    }else if($this->attributes['product_name']=='Lopster Making Chain' && ($this->attributes['process_name']=='Soldering Process')){
      $query['where'] = array('where_in' => array('id' =>  $this->attributes['process_ids'],
                                                  'process_name' => array("'Soldering Process'"),
                                                  'department_name' => array("'Soldering'")),
                              'where' => array('product_name' => $this->attributes['product_name'],'out_purity >' => 0));
    
    }else{
      $query['where'] = array('where_in' => array('id' =>  $this->attributes['process_ids'],
                                                  'process_name' => array("'AG'","'PL'"),
                                                  'department_name' => array("'Melting'")),
                              'where' => array('product_name' => $this->attributes['product_name'],
                                               'out_purity >' => 0));
    }
  
    // $query['group_by'] = array('parent_lot_id', 'parent_lot_name', 'design_code','machine_size', 'karigar');
    return $query;
  }
}