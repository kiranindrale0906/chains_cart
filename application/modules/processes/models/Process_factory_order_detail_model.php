<?php 
class Process_factory_order_detail_model extends BaseModel{
  public $router_class = 'process_factory_order_details';
  protected $table_name= 'process_factory_order_details';
  public function __construct($data = array()){
    parent::__construct($data);
  }

  public function before_validate() {
  	if(!empty($this->attributes['bunch_order_detail_id'])){
     //set pending qty in bunch order detail record for data correction in case of deleted records
  	 if ($this->attributes['department_name'] == 'Hook') {
      //if factory_qty_status is not empty would mean that record is being updated. There should be no calculations done in case of record updation
  	 $this->recalculate_pending_qty_in_bunch_order_details('in_process_active');
      if (empty($this->attributes['factory_qty_status'])) {
        //set status for new record. This will be used in calculation to increase ready process qty and reduce pending qty
        $this->attributes['factory_qty_status'] = 'in_process_active';

        //set process_bunch_order_detail record with qty same as pending qty of Bunch order detail
        $this->set_qty_from_bunch_order_detail_pending_qty();
      }

    }elseif ($this->attributes['department_name'] == 'Bunch GPC') {
          //factory_qty_status for GPC department process factory order detail records will always be ready.
          $this->recalculate_pending_qty_in_bunch_order_details('ready');
          $this->attributes['factory_qty_status'] = 'ready';

          //set hook process >> process factory order detail records with status as in_process_inactive. 
          //factory process  >> process factory order detail records are NOT used for computation of pending qty
          //hook process     >> process factory order detail records are NOT used for computation of pending qty
          $gpc_process     = $this->process_model->find('parent_id', array('id' => $this->attributes['process_id']));
          $buffing_process = $this->process_model->find('parent_id, parent_process_detail_id', array('id' => $gpc_process['parent_id']));

          //hook department >> process factory order details are fetched using parent_id and parent_process_detail_id of buffing department
          $this->set_bunch_status_of_previous_department_as_in_process_inactive($buffing_process['parent_id'], $buffing_process['parent_process_detail_id']);
        }

  	}else{
  		//set pending qty in factory order detail record for data correction in case of deleted records
     $this->recalculate_pending_qty_in_factory_order_details();

    //department (Factory, Hook, GPC) wise logic implementation
    if ($this->attributes['department_name'] == 'Factory') {
      //if factory_qty_status is not empty would mean that record is being updated. There should be no calculations done in case of record updation
      if (empty($this->attributes['factory_qty_status'])) {
        //set status for new record. This will be used in calculation to increase in process qty and reduce pending qty
        $this->attributes['factory_qty_status'] = 'in_process_active';

        //set process_factory_order_detail record with qty same as pending qty of factory order detail
        $this->set_qty_from_factory_order_detail_pending_qty();
      }

    } elseif ($this->attributes['department_name'] == 'Hook') {
      //if factory_qty_status is not empty would mean that record is being updated. factory_qty_status should be set only when record is created
       $this->attributes['factory_qty_status'] = 'ready';
        
      //set factory process >> process factory order detail records with status as in_process_inactive. 
      //factory process >> process factory order detail records are NOT used for computation of pending qty
      //hook process >> process factory order detail records are used for computation of pending qty
      $hook_process = $this->process_model->find('parent_id, parent_process_detail_id', array('id' => $this->attributes['process_id']));

      //factory department >> process factory order details are fetched using parent_id and parent_process_detail_id of hook department
      $this->set_factory_qty_status_of_previous_department_as_in_process_inactive($hook_process['parent_id'], $hook_process['parent_process_detail_id']);

    } elseif ($this->attributes['department_name'] == 'GPC') {
      //factory_qty_status for GPC department process factory order detail records will always be ready.
      $this->attributes['factory_qty_status'] = 'ready';

      //set hook process >> process factory order detail records with status as in_process_inactive. 
      //factory process  >> process factory order detail records are NOT used for computation of pending qty
      //hook process     >> process factory order detail records are NOT used for computation of pending qty
      $gpc_process     = $this->process_model->find('parent_id', array('id' => $this->attributes['process_id']));
      $buffing_process = $this->process_model->find('parent_id, parent_process_detail_id', array('id' => $gpc_process['parent_id']));

      //hook department >> process factory order details are fetched using parent_id and parent_process_detail_id of buffing department
      $this->set_factory_qty_status_of_previous_department_as_in_process_inactive($buffing_process['parent_id'], $buffing_process['parent_process_detail_id']);
    }
  	}
    
  }

  public function after_save($action) {
  	if(!empty($this->attributes['bunch_order_detail_id'])){
     $this->recalculate_pending_qty_in_bunch_order_details();
  	}else{
     $this->recalculate_pending_qty_in_factory_order_details();
  	}
  }

  public function get_factory_process_factory_order_details($factory_process_id) {
    //get category 1 to 4 from factory process record
    $factory_process = $this->process_model->find('melting_lot_category_one, melting_lot_category_three, design_code, line',
                                                  array('id' => $factory_process_id));

    $where = array('ka_chain_factory_order_masters.category_name' => $factory_process['melting_lot_category_one'],
                   'ka_chain_factory_order_masters.gauge'         => $factory_process['melting_lot_category_three'],
                   'ka_chain_factory_order_masters.design_name'   => $factory_process['design_code']/*,
                   'ka_chain_factory_order_masters.line'          => $factory_process['line']*/);

    //for factory department return pending factory order detail records that match category 1 to 4 of the process
    $datils=$this->get_process_factory_order_details($where, 'pending');
    return $datils;
  }
  public function get_hook_process_bunch_order_details($hook_process_id) {
    //get category 1 to 4 from factory process record
    $factory_process = $this->process_model->find('melting_lot_category_one, melting_lot_category_three, design_code, line',array('id' => $hook_process_id));

    $where = array('category_name' => $factory_process['melting_lot_category_one'],
                   'gauge'         => $factory_process['melting_lot_category_three'],
                   'design_name'   =>$factory_process['design_code'],
                   'status not in ("ready","in_process_active")'=>NULL);
    $datils=$this->get_process_bunch_order_details($where, 'pending');
    return $datils;
  }

  public function get_hook_process_factory_order_details($hook_process_id) {
    $where = array();
    
    //in hook department select only those factory order details that were selected in factory process
    $factory_process = $this->process_model->find('parent_id, parent_process_detail_id', array('id' => $hook_process_id));
    $previous_process_factory_order_detail_where = array('process_id=' => $factory_process['parent_id'],
                                                         'process_detail_id' => $factory_process['parent_process_detail_id']);
 
    //exclude all factory order details that have been selected for customer order within the same process id
    $exclude_factory_order_detail_ids = $this->process_factory_order_detail_model->get('factory_order_detail_id', 
                                                                                        array('process_id=' => $hook_process_id, 'department_name' => 'Hook'));
    $exclude_factory_order_detail_ids = array_column($exclude_factory_order_detail_ids , 'factory_order_detail_id');
    if (!empty($exclude_factory_order_detail_ids)){
      $previous_process_factory_order_detail_where['factory_order_detail_id not in  ('.implode(", ", $exclude_factory_order_detail_ids).')']=NULL;
    }

    return $this->get_process_factory_order_details($where, 'in', $previous_process_factory_order_detail_where);
  }

  public function get_gpc_process_factory_order_details($gpc_process_id) {
    $where = array();
    
    //in hook department select only those factory order details that were selected in factory process
    $gpc_process = $this->process_model->find('parent_id', array('id' => $gpc_process_id));
    $buffing_process = $this->process_model->find('parent_id, parent_process_detail_id', array('id' => $gpc_process['parent_id']));
    $previous_process_factory_order_detail_where = array('process_id=' => $buffing_process['parent_id'],
                                                'process_detail_id' => $buffing_process['parent_process_detail_id']);
 
    //excluse all factory order details that have been selected for customer order within the same process id
    $exclude_factory_order_detail_ids = $this->process_factory_order_detail_model->get('factory_order_detail_id', 
                                                                                        array('process_id=' => $gpc_process_id, 'department_name' => 'GPC'));
    $exclude_factory_order_detail_ids = array_column($exclude_factory_order_detail_ids , 'factory_order_detail_id');
    if (!empty($exclude_factory_order_detail_ids)){
      $previous_process_factory_order_detail_where['factory_order_detail_id not in  ('.implode(", ", $exclude_factory_order_detail_ids).')']=NULL;
    }
    
    return $this->get_process_factory_order_details($where, 'in', $previous_process_factory_order_detail_where);
  }

  public function get_bunch_gpc_process_factory_order_details($gpc_process_id) {
    $where = array();
    //in hook department select only those factory order details that were selected in factory process
    $buffing_process = $this->process_model->find('parent_id, parent_process_detail_id', array('id' => $gpc_process_id));
    $previous_process_bunch_order_detail_where = array('process_id=' => $buffing_process['parent_id'],
                                                'process_detail_id' => $buffing_process['parent_process_detail_id']);

 
    //excluse all factory order details that have been selected for customer order within the same process id
    $exclude_factory_order_detail_ids = $this->process_factory_order_detail_model->get('bunch_order_detail_id', 
                                                                                        array('process_id=' => $gpc_process_id, 'department_name' => 'Bunch GPC'));
    $exclude_factory_order_detail_ids = array_column($exclude_factory_order_detail_ids , 'bunch_order_detail_id');
    if (!empty($exclude_factory_order_detail_ids)){
      $previous_process_bunch_order_detail_where['bunch_order_detail_id not in  ('.implode(", ", $exclude_factory_order_detail_ids).')']=NULL;
    }
    $where['status']='in_process_active';
    
    return $this->get_process_bunch_order_details($where, 'in', $previous_process_bunch_order_detail_where);
  }

  private function get_process_factory_order_details($where, $pending_or_in, $previous_process_factory_order_detail_where = array()) {
    if ($pending_or_in == 'in') {   //only for Hook and GPC department
      //for hook department >> only include factory order detail ids that have been selected in factory process and not selected in hook process
      //only include factory order detail ids that have been selected in hook process and not selected in gpc process
      $include_factory_order_detail_ids = $this->process_factory_order_detail_model->get('factory_order_detail_id', $previous_process_factory_order_detail_where);
      $include_factory_order_detail_ids = array_column($include_factory_order_detail_ids , 'factory_order_detail_id');
      if (!empty($include_factory_order_detail_ids))
        $where['ka_chain_factory_order_details.id in  ('.implode(", ", $include_factory_order_detail_ids).')']=NULL;
      else
        $where['ka_chain_factory_order_details.id'] = 0;    //do not show any record if all factory order details have been selected in the hook process id
    }

    //for factory department check pending qty != 0
    //for hook and gpc department check in_qty != 0
    $where['(   14_inch_qty_'.$pending_or_in.'!= 0
             or 15_inch_qty_'.$pending_or_in.'!= 0
             or 16_inch_qty_'.$pending_or_in.'!= 0
             or 17_inch_qty_'.$pending_or_in.'!= 0
             or 18_inch_qty_'.$pending_or_in.'!= 0
             or 19_inch_qty_'.$pending_or_in.'!= 0
             or 20_inch_qty_'.$pending_or_in.'!= 0
             or 21_inch_qty_'.$pending_or_in.'!= 0
             or 22_inch_qty_'.$pending_or_in.'!= 0
             or 23_inch_qty_'.$pending_or_in.'!= 0
             or 24_inch_qty_'.$pending_or_in.'!= 0
             or 25_inch_qty_'.$pending_or_in.'!= 0
             or 26_inch_qty_'.$pending_or_in.'!= 0
             or 27_inch_qty_'.$pending_or_in.'!= 0
             or 28_inch_qty_'.$pending_or_in.'!= 0
             or 29_inch_qty_'.$pending_or_in.'!= 0
             or 30_inch_qty_'.$pending_or_in.'!= 0
             or 31_inch_qty_'.$pending_or_in.'!= 0
             or 32_inch_qty_'.$pending_or_in.'!= 0
             or 33_inch_qty_'.$pending_or_in.'!= 0
             or 34_inch_qty_'.$pending_or_in.'!= 0
             or 35_inch_qty_'.$pending_or_in.'!= 0
             or 36_inch_qty_'.$pending_or_in.'!= 0)'] = NULL;  

    $ka_chain_factory_details = $this->ka_chain_factory_order_detail_model->get(
                                                   'ka_chain_factory_order_masters.category_name as category_name,
                                                    ka_chain_factory_order_masters.design_name as design_name,
                                                    ka_chain_factory_order_masters.gauge as gauge,
                                                    ka_chain_factory_order_masters.wt_in_18_inch as wt_in_18_inch,
                                                    ka_chain_factory_order_masters.wt_in_24_inch as wt_in_24_inch ,
                                                    ka_chain_factory_order_masters.line as line,
                                                    ka_chain_factory_order_details.14_inch_qty_'.$pending_or_in.' as 14_inch_qty,
                                                     ka_chain_factory_order_details.15_inch_qty_'.$pending_or_in.' as 15_inch_qty,
                                                    ka_chain_factory_order_details.16_inch_qty_'.$pending_or_in.' as 16_inch_qty,
                                                    ka_chain_factory_order_details.17_inch_qty_'.$pending_or_in.' as 17_inch_qty,
                                                    ka_chain_factory_order_details.18_inch_qty_'.$pending_or_in.' as 18_inch_qty,
                                                    ka_chain_factory_order_details.19_inch_qty_'.$pending_or_in.' as 19_inch_qty,
                                                    ka_chain_factory_order_details.20_inch_qty_'.$pending_or_in.' as 20_inch_qty,
                                                    ka_chain_factory_order_details.21_inch_qty_'.$pending_or_in.' as 21_inch_qty,
                                                    ka_chain_factory_order_details.22_inch_qty_'.$pending_or_in.' as 22_inch_qty,
                                                    ka_chain_factory_order_details.23_inch_qty_'.$pending_or_in.' as 23_inch_qty,
                                                    ka_chain_factory_order_details.24_inch_qty_'.$pending_or_in.' as 24_inch_qty,
                                                    ka_chain_factory_order_details.25_inch_qty_'.$pending_or_in.' as 25_inch_qty,
                                                    ka_chain_factory_order_details.26_inch_qty_'.$pending_or_in.' as 26_inch_qty,
                                                    ka_chain_factory_order_details.27_inch_qty_'.$pending_or_in.' as 27_inch_qty,
                                                    ka_chain_factory_order_details.28_inch_qty_'.$pending_or_in.' as 28_inch_qty,
                                                    ka_chain_factory_order_details.29_inch_qty_'.$pending_or_in.' as 29_inch_qty,
                                                    ka_chain_factory_order_details.30_inch_qty_'.$pending_or_in.' as 30_inch_qty,
                                                    ka_chain_factory_order_details.31_inch_qty_'.$pending_or_in.' as 31_inch_qty,
                                                    ka_chain_factory_order_details.32_inch_qty_'.$pending_or_in.' as 32_inch_qty,
                                                    ka_chain_factory_order_details.33_inch_qty_'.$pending_or_in.' as 33_inch_qty,
                                                    ka_chain_factory_order_details.34_inch_qty_'.$pending_or_in.' as 34_inch_qty,
                                                    ka_chain_factory_order_details.35_inch_qty_'.$pending_or_in.' as 35_inch_qty,
                                                    ka_chain_factory_order_details.36_inch_qty_'.$pending_or_in.' as 36_inch_qty,
                                                    ka_chain_factory_order_details.id as factory_order_detail_id,
                                                    ka_chain_factory_order_id',
                                                    $where,
                                                    array(array('ka_chain_factory_order_masters',
                                                                'ka_chain_factory_order_details.market_design_name=ka_chain_factory_order_masters.market_design_name')));
    
    // append customer name, due date in process factory order details record
    $process_factory_order_details = array();
    foreach ($ka_chain_factory_details as $index => $ka_chain_factory_detail) {
      $factory_order = $this->ka_chain_factory_order_model->find('customer_name, due_date,melting', array('id' => $ka_chain_factory_detail['ka_chain_factory_order_id']));
      $process_factory_order_details[$index] = $ka_chain_factory_detail;
      $process_factory_order_details[$index]['due_date'] = date('d-m-y',strtotime($factory_order['due_date']));
      $process_factory_order_details[$index]['customer_name'] = $factory_order['customer_name'];
      $process_factory_order_details[$index]['melting'] = $factory_order['melting'];
    }
    return $process_factory_order_details;
  }
  private function get_process_bunch_order_details($where, $pending_or_in, $previous_process_factory_order_detail_where = array()) {
    if ($pending_or_in == 'in') {   //only for Hook and GPC department
      //for hook department >> only include factory order detail ids that have been selected in factory process and not selected in hook process
      //only include factory order detail ids that have been selected in hook process and not selected in gpc process
      $include_bunch_order_detail_ids = $this->process_factory_order_detail_model->get('bunch_order_detail_id', $previous_process_factory_order_detail_where);
      $include_bunch_order_detail_ids = array_column($include_bunch_order_detail_ids , 'bunch_order_detail_id');
      if (!empty($include_bunch_order_detail_ids))
        $where['ka_chain_bunch_order_details.id in  ('.implode(", ", $include_bunch_order_detail_ids).')']=NULL;
      else
        $where['ka_chain_bunch_order_details.id'] = 0;    //do not show any record if all factory order details have been selected in the hook process id
    }
    $where['(bunch_weight!= 0
             or bunch_length!= 0)'] = NULL; 

    $ka_chain_bunch_details = $this->ka_chain_bunch_order_detail_model->get(
                                                   'category_name as category_name,
                                                    design_name as design_name,
                                                    gauge as gauge,
                                                    wt_in_18_inch as wt_in_18_inch,
                                                    wt_in_24_inch as wt_in_24_inch ,
                                                    line as line,
                                                    ka_chain_bunch_order_details.bunch_weight as bunch_weight,
                                                    ka_chain_bunch_order_details.bunch_length as bunch_length,
                                                    ka_chain_bunch_order_details.estimate_bunch_weight as estimate_bunch_weight,
                                                    ka_chain_bunch_order_details.id as bunch_order_detail_id,
                                                    ka_chain_factory_order_id,
                                                    status',
                                                    $where,
                                                    array());
    // append customer name, due date in process factory order details record
    $process_bunch_order_details = array();
    foreach ($ka_chain_bunch_details as $index => $ka_chain_bunch_detail) {
      $bunch_order = $this->ka_chain_factory_order_model->find('customer_name, due_date,melting', array('id' => $ka_chain_bunch_detail['ka_chain_factory_order_id']));
      $process_bunch_order_details[$index] = $ka_chain_bunch_detail;
      $process_bunch_order_details[$index]['due_date'] = date('d-m-y',strtotime($bunch_order['due_date']));
      $process_bunch_order_details[$index]['customer_name'] = $bunch_order['customer_name'];
      $process_bunch_order_details[$index]['melting'] = $bunch_order['melting'];
    }
    return $process_bunch_order_details;
  }

  private function set_factory_qty_status_of_previous_department_as_in_process_inactive($factory_or_hook_process_id, $factory_or_hook_process_detail_id) {
    $process_factory_order_details = $this->get('', array('process_id' => $factory_or_hook_process_id,
                                                          'process_detail_id' => $factory_or_hook_process_detail_id));
    foreach ($process_factory_order_details as $process_factory_order_detail) {
      $process_factory_order_detail_obj = new Process_factory_order_detail_model($process_factory_order_detail);
      $process_factory_order_detail_obj->attributes['factory_qty_status'] = 'in_process_inactive';
      $process_factory_order_detail_obj->update(false);
    }
  }
  private function set_bunch_status_of_previous_department_as_in_process_inactive($factory_or_hook_process_id, $factory_or_hook_process_detail_id) {
    $process_factory_order_details = $this->get('', array('process_id' => $factory_or_hook_process_id,
                                                          'process_detail_id' => $factory_or_hook_process_detail_id));
    foreach ($process_factory_order_details as $process_factory_order_detail) {
      $process_factory_order_detail_obj = new Process_factory_order_detail_model($process_factory_order_detail);
      $process_factory_order_detail_obj->attributes['factory_qty_status'] = 'in_process_inactive';
      $process_factory_order_detail_obj->update(false);
    }
  }

  private function set_qty_from_factory_order_detail_pending_qty() {
    $ka_chain_factory_order_detail = $this->ka_chain_factory_order_detail_model->find('14_inch_qty_pending,15_inch_qty_pending, 16_inch_qty_pending, 17_inch_qty_pending, 18_inch_qty_pending, 19_inch_qty_pending, 
                                                                                       20_inch_qty_pending,
                                                                                       21_inch_qty_pending,
                                                                                       22_inch_qty_pending,
                                                                                       23_inch_qty_pending,
                                                                                       24_inch_qty_pending, 
                                                                                       25_inch_qty_pending, 
                                                                                       26_inch_qty_pending,
                                                                                       27_inch_qty_pending,
                                                                                       28_inch_qty_pending, 
                                                                                       29_inch_qty_pending, 
                                                                                       30_inch_qty_pending, 
                                                                                       31_inch_qty_pending, 
                                                                                       32_inch_qty_pending, 
                                                                                       33_inch_qty_pending, 
                                                                                       34_inch_qty_pending, 
                                                                                       35_inch_qty_pending, 
                                                                                       36_inch_qty_pending', 
                                                                                       array('id' => $this->attributes['factory_order_detail_id']));
    $this->attributes['14_inch_qty'] = $ka_chain_factory_order_detail['14_inch_qty_pending'];
    $this->attributes['15_inch_qty'] = $ka_chain_factory_order_detail['15_inch_qty_pending'];
    $this->attributes['16_inch_qty'] = $ka_chain_factory_order_detail['16_inch_qty_pending'];
    $this->attributes['17_inch_qty'] = $ka_chain_factory_order_detail['17_inch_qty_pending'];
    $this->attributes['18_inch_qty'] = $ka_chain_factory_order_detail['18_inch_qty_pending'];
    $this->attributes['19_inch_qty'] = $ka_chain_factory_order_detail['19_inch_qty_pending'];
    $this->attributes['20_inch_qty'] = $ka_chain_factory_order_detail['20_inch_qty_pending'];
    $this->attributes['21_inch_qty'] = $ka_chain_factory_order_detail['21_inch_qty_pending'];
    $this->attributes['22_inch_qty'] = $ka_chain_factory_order_detail['22_inch_qty_pending'];
    $this->attributes['23_inch_qty'] = $ka_chain_factory_order_detail['23_inch_qty_pending'];
    $this->attributes['24_inch_qty'] = $ka_chain_factory_order_detail['24_inch_qty_pending'];
    $this->attributes['25_inch_qty'] = $ka_chain_factory_order_detail['25_inch_qty_pending'];
    $this->attributes['26_inch_qty'] = $ka_chain_factory_order_detail['26_inch_qty_pending'];
    $this->attributes['27_inch_qty'] = $ka_chain_factory_order_detail['27_inch_qty_pending'];
    $this->attributes['28_inch_qty'] = $ka_chain_factory_order_detail['28_inch_qty_pending'];
    $this->attributes['29_inch_qty'] = $ka_chain_factory_order_detail['29_inch_qty_pending'];
    $this->attributes['30_inch_qty'] = $ka_chain_factory_order_detail['30_inch_qty_pending'];
    $this->attributes['31_inch_qty'] = $ka_chain_factory_order_detail['31_inch_qty_pending'];
    $this->attributes['32_inch_qty'] = $ka_chain_factory_order_detail['32_inch_qty_pending'];
    $this->attributes['33_inch_qty'] = $ka_chain_factory_order_detail['33_inch_qty_pending'];
    $this->attributes['34_inch_qty'] = $ka_chain_factory_order_detail['34_inch_qty_pending'];
    $this->attributes['35_inch_qty'] = $ka_chain_factory_order_detail['35_inch_qty_pending'];
    $this->attributes['36_inch_qty'] = $ka_chain_factory_order_detail['36_inch_qty_pending'];
  }
  private function set_qty_from_bunch_order_detail_pending_qty() {
    $ka_chain_bunch_order_detail = $this->ka_chain_bunch_order_detail_model->find('bunch_weight,bunch_length', 
                                                                                 array('id' => $this->attributes['bunch_order_detail_id']));
    $this->attributes['bunch_length'] = $ka_chain_bunch_order_detail['bunch_length'];
    $this->attributes['bunch_weight'] = $ka_chain_bunch_order_detail['bunch_weight'];
  }

  private function recalculate_pending_qty_in_factory_order_details() {
    $ka_chain_factory_order_detail_obj = new ka_chain_factory_order_detail_model(array('id' => $this->attributes['factory_order_detail_id']));
    $ka_chain_factory_order_detail_obj->before_validate();
    $ka_chain_factory_order_detail_obj->update();
  }
  private function recalculate_pending_qty_in_bunch_order_details($status='') {
    $ka_chain_bunch_order_detail_obj = new ka_chain_bunch_order_detail_model(array('id' => $this->attributes['bunch_order_detail_id']));
    $ka_chain_bunch_order_detail_obj->before_validate();
    if(!empty($status)){
      $ka_chain_bunch_order_detail_obj->attributes['status']=$status;
    }
    $ka_chain_bunch_order_detail_obj->update();
  }
}