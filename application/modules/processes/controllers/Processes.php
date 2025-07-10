<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Processes extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->data['layout'] = 'table';
    $this->load->helper(array('processes/processes'));
    $this->load->model(array('processes/process_model','processes/process_field_model', 'processes/process_information_model', 
                             'processes/process_out_wastage_detail_model', 'processes/process_group_model',
                             'melting_lots/melting_lot_detail_model', 'issue_departments/issue_department_detail_model',
                             'users/user_model', 'settings/room_model'));
    $this->data['open_modal'] = false;
    $this->data['ajax_success_function'] = "set_process_rows(response)";
    $this->data['ajax_failure_function'] = "set_process_rows(response)";
    $this->data['ajax_delete_success_function'] = "set_process_rows(response)";
    $this->redirect_after_save = 'view';
  }

  public function index() { 
    
    $where['where']=array();

    if (   !isset($_GET['archive'])
  && empty($_GET['from_date']) 
        && empty($_GET['parent_lot_no'])
        && empty($_GET['lot_no'])) {
      $where['where'] = array_merge($where['where'], array('(archive = 0 or balance != 0)' => NULL));
    }

    if (!empty($_GET['customer_name'])) {
      $where['customer_name'] = $_GET['customer_name'];
    }
    if (!empty($_GET['parent_lot_no'])) {
      $where['parent_lot_name like'] = '%'.$_GET['parent_lot_no'].'%';
    }
    if (!empty($_GET['in_lot_purity'])) {
      $where['in_lot_purity'] =$_GET['in_lot_purity'];
    }
    if (!empty($_GET['lot_no'])) {
      $where['lot_no like'] = '%'.$_GET['lot_no'].'%';
    }if (!empty($_GET['karigar'])) {
      $where['karigar like'] = '%'.$_GET['karigar'].'%';
    }if (!empty($_GET['worker'])) {
      $where['worker like'] = '%'.$_GET['worker'].'%';
    }
    if (!empty($_GET['from_date'])) {
        $where['where']['date(created_at) >=']=$_GET['from_date'];
        $where['where']['date(created_at) <=']=$_GET['to_date'];
//        $where['where']['archive = 1']=NULL;
    }
//pd($where);
      
    // if (!empty($_GET['created_at'])) {
    //   $where['created_at like'] = '%'.$_GET['created_at'].'%';
    // }
    if (!empty($_GET['department_name'])) {
      $where['department_name'] = $_GET['department_name'];
      $where['balance !='] = 0;
    }

    $this->data['room']                 = empty($_GET['room']) ? '' : $_GET['room'];
    $this->data['room_name']            = empty($_GET['room_name']) ? '' : $_GET['room_name'];
    $this->data['room_product_name']    = empty($_GET['room_product_name']) ? '' : $_GET['room_product_name'];
    $this->data['room_process_name']    = empty($_GET['room_process_name']) ? '' : $_GET['room_process_name'];
    $this->data['room_department_name'] = empty($_GET['room_department_name']) ? '' : $_GET['room_department_name'];
    $this->data['department_name']      = empty($_GET['department_name']) ? '' : $_GET['department_name'];
    
    if ($this->router->class == 'processes' && empty($this->data['room']))
      redirect(base_url().'processes/processes?room=1');
    if ($this->router->class == 'melting' && empty($this->data['room']))
      redirect(base_url().'processes/processes?room=1&room_name=Melting Room');

    if (!empty($this->data['room_name'])) {
      $rooms = $this->room_model->get('department_name', array('name' => $this->data['room_name']));
      $room_department_names = array_column($rooms, 'department_name');
      
      $this->data['room_department_names'] = $this->process_model->get("product_name, process_name, department_name, ROUND(sum(balance),2) as balance",
                                                  array('department_name' => $room_department_names,
                                                        'balance != ' => 0), array(),
                                                  array('order_by' => 'product_name, process_name, department_name',
                                                        'group_by' => 'product_name, process_name, department_name'));

      if (sizeof($this->data['room_department_names']) == 1) {



$this->data['room_product_name']     = $this->data['room_department_names'][0]['product_name'];

        $this->data['room_process_name']     = $this->data['room_department_names'][0]['process_name'];
        $this->data['room_department_name']  = $this->data['room_department_names'][0]['department_name'];
      }
    }

    if (!empty($this->data['room_department_name']) && $this->router->class == 'processes') {
      $model_name = get_model_name($this->data['room_product_name'], $this->data['room_process_name']);
      $module_name = $model_name['module_name'];
      $model_name = $model_name['model_name'];
      $this->load->model($module_name.'/'.$model_name);
      $controller_name = $this->$model_name->router_class;
      redirect(base_url().$module_name.'/'.$controller_name.'/index?room=1&room_name='.$this->data['room_name'].'&department_name='.$this->data['room_department_name']);
    }
    $select='account,input_type,hallmark_in,hallmark_quantity,hallmark_out,worker,
      id,parent_id,row_id,lot_row_id,account,karigar,machine_size,length,line,remark,loss_remark,no_of_bunch,type,product_name,process_name,department_name,description ,process_sequence,design_code,lot_no,melting_lot_id,in_weight,out_weight,fe_in,fe_out,wastage_fe,melting_wastage,hcl_wastage,daily_drawer_wastage,in_purity,out_lot_purity,out_purity,in_lot_purity,tounch_purity,hook_kdm_purity,tounch_no,tounch_in,tounch_out ,tounch_ghiss,hook_in,hook_out,sisma_in,sisma_out,ghiss,loss,hcl_loss,tounch_loss_fine,micro_coating,expected_out_weight,status,gemstone_in,gemstone_out,stone_in,stone_out,copper_in,copper_out,solder_in,hcl_ghiss,Round(quantity,0) as quantity,refine_loss,parent_lot_id,parent_lot_name,daily_drawer_in_weight,alloy_weight,out_tounch_ghiss,balance_tounch_ghiss,repair_out, Round(repair_out_quantity,0) as repair_out_quantity ,pending_ghiss,solder_wastage,flash_wire,gpc_out,issue_melting_wastage,concept,liquor_in ,chain_name,issue_tounch_loss_fine,balance_tounch_loss_fine,issue_hcl_loss,balance_hcl_loss,issue_ghiss,spring_vatav,stone_vatav,meena_quantity,Round(out_quantity,0) out_quantity,Round(balance_quantity,0) as balance_quantity,argold_account_id,in_rod,out_rod,in_machine_gold,out_machine_gold,in_plain_rod,bounch_out,factory_out,fire_tounch_in,fire_tounch_purity,fire_tounch_out,fire_tounch_ghiss,fire_tounch_fine,fire_tounch_no,fire_tounch_gross,in_melting_wastage,wastage_purity,wastage_lot_purity,parent_process_detail_id ,melting_lot_start_process,finish_good,is_outside,melting_lot_category_one,melting_lot_category_two,melting_lot_category_three,melting_lot_category_four,melting_lot_chain_name,karigar_loss,customer_out,customer_name,recutting_out,srno,pending_loss,order_detail_id,rhodium_in,rod_id,issue_chain_name,copper_process_id,min_hcl_loss,max_hcl_loss,split_out_weight,machine_no,updated_at,created_at,updated_by,created_by,archive,balance,balance_gross,balance_fine,completed_at,strip_cutting_process_id,out_stone_vatav,stone_count,city,job_card_no,gpc_out_qty,tone,spring_in,spring_out,lopster_no, (fire_tounch_out+fire_tounch_gross) as total_fire_tounch_out, (fire_tounch_in-fire_tounch_out-fire_tounch_gross) as balance_fire_tounch_out,gross_loss,tanishq_out,worker';
     
    if ($this->router->class != 'processes' && ($this->router->class != 'melting' && $this->router->module != 'departments')) {
      if ($this->router->class == 'refresh_final_processes'){
        $where['process_name'] = $this->model->attributes['process_name'];    
      }elseif ($this->router->class == 'final_processes' && $this->router->module == 'office_outside'){
        $where['product_name'] = $this->model->attributes['product_name'];
      }elseif ($this->router->class == 'sisma_accessories_making_final_processes' && $this->router->module == 'sisma_accessories_making_chains'){
        $where['product_name'] = $this->model->attributes['product_name'];
      }else{
        $where['product_name'] = $this->model->attributes['product_name'];
        $where['process_name'] = $this->model->attributes['process_name'];
      }

      if ($this->router->class == 'loss_out_melting_processes')
        $where['in_weight !='] = 0.001;

      //$where['department_name !='] = 'QC Department';
      if (($this->router->class == 'final_processes' && $this->router->module == 'office_outside')
        ||($this->router->class == 'imp_italy_dye_final_processes' && $this->router->module == 'imp_italy_chains')
        ||($this->router->class == 'indo_tally_dye_final_processes' && $this->router->module == 'indo_tally_chains')
        ||($this->router->class == 'choco_chain_dye_final_processes' && $this->router->module == 'choco_chains')
        ||($this->router->class == 'hollow_choco_dye_final_processes' && $this->router->module == 'hollow_choco_chains')
        ||($this->router->class == 'lotus_dye_final_processes' && $this->router->module == 'lotus_chains')
        ||($this->router->class == 'nawabi_dye_final_processes' && $this->router->module == 'nawabi_chains')
        ||($this->router->class == 'roco_choco_dye_final_processes' && $this->router->module == 'roco_choco_chains')
      ){
        $where['department_name'] = 'Office Outside Final';
      }elseif($this->router->class == 'sisma_accessories_making_final_processes' && $this->router->module == 'sisma_accessories_making_chains'){
        $where['department_name'] = 'Final';
      }else{$where['department_name !='] = 'Office Outside Final';}
      if($this->router->class=='customer_order_processes' && $this->router->module == 'ka_chains'){
        $where['customer_out_required_status'] = 1;
      }
      if($this->router->class=='hold_processes' && $this->router->module == 'domestic_internals'){
        $where['domestic_internal_required_status'] = 1;
      }
      $processes=$this->process_model->get($select, $where);
//lq();//
//pd($processes); 
      $this->data['page_title']=get_product_value($this->router->module).' - '.get_process_value($this->router->class);
      foreach ($processes as $process) {
        if (!isset($this->data['records'][$process['row_id']]))
        $this->data['records'][$process['row_id']] = array();
        $this->data['records'][$process['row_id']][$process['department_name']] = $process;   
      }

      if ($this->router->class == 'refresh_final_processes')
        $this->data['product_name'] = '';
      else 
        $this->data['product_name'] = $this->model->attributes['product_name'];
      if (($this->router->class == 'final_processes' && $this->router->module == 'office_outside' ) || ($this->router->class == 'sisma_accessories_making_final_processes' && $this->router->module == 'sisma_accessories_making_chains'))
        $this->data['process_name'] = '';
      else 
        $this->data['process_name'] = $this->model->attributes['process_name'];
      $this->data['last_department_name'] = end($this->model->departments);
      $this->data['users'] = get_records_by_id($this->user_model->get('id, name'));
    }else{
      if($this->router->class == 'processes' && !empty($room_department_names)
        || $this->router->class == 'melting' && $this->router->module == 'departments' && !empty($room_department_names)){
        $where['where'] =array('balance >'=>0) ;
        $where['where_in'] =array('department_name'=>'"'.implode('", "', $room_department_names).'"') ;
        $processes=$this->process_model->get($select, $where);
        foreach ($processes as $process) {
          if (!isset($this->data['records'][$process['row_id']]))
          $this->data['records'][$process['row_id']] = array();
          $this->data['records'][$process['row_id']][$process['department_name']] = $process;   
        }
        $this->data['users'] = get_records_by_id($this->user_model->get('id, name'));
      }

    }
    $this->data['room_names'] = $this->process_model->get('rooms.name as name, ROUND(sum(processes.balance),2) as balance',
                                                                array('processes.department_name != ' => 'Start',
                                                                      'balance != ' => 0), array(array('rooms', 'rooms.department_name = processes.department_name')),
                                                                array('group_by' => 'rooms.name', 'order_by' => 'rooms.name'));
    $this->load->view('layouts/table/index.php', $this->data);    
  }

  public function edit($id){
    $this->form_path = 'processes/process_details';
    if(empty($id))redirect(base_url().$this->router->module.'/'.$this->router->class.'/index');
    $this->data['layout'] = 'application';
    $this->data['record']['id'] = $id;
    parent::edit($id);
  }

  public function update($id){
    $this->form_path = 'processes/process_details';
    if(isset($_GET['type']) && $_GET['type'] == 2){
      $this->data['layout'] = 'application';
      $_POST['row_id'] = $_POST[$this->router->class]['row_id'];
    }

    if(!empty($_POST['is_outside'])){
      $this->data['layout'] = 'application';
      $_POST['id'] = $id;
    }
    if(!empty($_GET['room'])){
      $controller_names=array_keys($_POST);
      if($controller_names[1]=='melting'){
        $_POST[$this->router->class]=$_POST['melting']; 
        unset($_POST['melting']);
      }else{
        $_POST[$this->router->class]=$_POST['processes'];
        unset($_POST['processes']);
      }
    }
    parent::update($id);
  
  }
  

  public function _after_save($formdata, $action) {
    if(isset($_GET['type']) && $_GET['type'] == 2){
      redirect(base_url().'processes/'.'process_records/view/'.$formdata[$this->router->class]['id']);
    }
    
    $this->data['ajax_success_function'] = "set_process_rows(response)";
    return $formdata;
  }

  public function get_ajax_success_data($model_obj, $action) {
    $previous_process = $this->model->find('', array('id' => $model_obj->attributes['parent_id']));
    if(!empty($previous_process)){
    $previous_process_department_columns = @get_process_structures()[$previous_process['department_name']];
    }

    $current_process_department_columns = get_process_structures()[$model_obj->attributes['department_name']];

    $last_department_name = end($model_obj->departments);

    $next_process = $this->model->find('', array('parent_id' => $model_obj->attributes['id']), '', 
                                              array('order_by' => 'id desc'));
    if (!empty($next_process))
      $next_process_department_columns = @get_process_structures()[$next_process['department_name']];
    
    $data = array('current_process' => 
                  array('view_html' => $this->load->view('processes/processes/form', 
                                                         array('process' => $model_obj->attributes,
                                                               'department_columns' => $current_process_department_columns,
                                                               'last_department_name' => $last_department_name), TRUE),
                        'row_id' => get_row_id($model_obj->attributes['row_id'], $model_obj->attributes['department_name'])),
                  'previous_process' => 
                    array('view_html' => $this->load->view('processes/processes/form', 
                                                           array('process' => $previous_process,
                                                                 'department_columns' => @$previous_process_department_columns,
                                                                 'last_department_name' => $last_department_name), TRUE),
                          'row_id' => get_row_id($previous_process['row_id'], $previous_process['department_name'])),
                  'next_process' => (empty($next_process)) ? array() :
                    array('view_html' => $this->load->view('processes/processes/form', 
                                                           array('process' => $next_process,
                                                                 'department_columns' => $next_process_department_columns,
                                                                 'last_department_name' => $last_department_name), TRUE),
                          'row_id' => get_row_id($next_process['row_id'], $next_process['department_name'])));
    return $data;
  }

  public function get_ajax_failure_data($model_obj, $action) {
    $current_process_department_columns = get_process_structures()[$model_obj->attributes['department_name']];
    $last_department_name = end($model_obj->departments);
    $data = array('current_process' => 
                  array('view_html' => $this->load->view('processes/processes/form', 
                                                         array('process' => $model_obj->attributes,
                                                               'department_columns' => $current_process_department_columns,
                                                               'last_department_name' => $last_department_name), TRUE),
                        'row_id' => get_row_id($model_obj->attributes['row_id'], $model_obj->attributes['department_name'])),

                  );
    return $data;     
  }

  public function get_ajax_delete_data($record) {
    $previous_process = $this->model->find('', array('id' => $record['parent_id']));
     if(!empty($previous_process)){
      $previous_process_department_columns = get_process_structures()[$previous_process['department_name']];
     }
    $current_process_department_columns = get_process_structures()[$record['department_name']];
    $last_department_name = end($this->model->departments);
    $data = array('current_process' => 
                    array('view_html' => $this->load->view('processes/processes/form', 
                                             array('process' => @$process,
                                                   'department_columns' => $current_process_department_columns,
                                                   'last_department_name' => $last_department_name), TRUE),
                          'row_id' => get_row_id($record['row_id'], $record['department_name'])),

                  'previous_process' => 
                    array('view_html' => $this->load->view('processes/processes/form', 
                                             array('process' => $previous_process,
                                                   'department_columns' => @$previous_process_department_columns,
                                                   'last_department_name' => $last_department_name), TRUE),
                          'row_id' => get_row_id($previous_process['row_id'], $previous_process['department_name'])),
                  );
    return $data;     
  }

  public function delete($id) {
    $data = $this->process_model->check_fields_before_delete($id);
    if ($data) {
      $next_process = $this->model->find('', array('parent_id' => $id));
      if (empty($next_process)) {
        $current_process = new $this->model(array('id' => $id)); 
        
        if ($current_process->attributes['department_name']=='Stripping')
          $current_process->set_copper_out_in_cutting_department();
          
        $previous_process = new $this->model(array('id' => $current_process->attributes['parent_id']));
        $previous_process->attributes['out_weight'] = 0;
        if (isset($previous_process->attributes['department_name']) &&  $previous_process->attributes['department_name'] == 'HCL') {
          $previous_process->attributes['fe_out'] = 0;
          $previous_process->attributes['hcl_loss'] = 0;
        } elseif (isset($previous_process->attributes['department_name']) && $previous_process->attributes['department_name'] == 'Solder') {
          $previous_process->attributes['solder_in'] = 0;
        } elseif (isset($previous_process->attributes['product_name']) && $previous_process->attributes['product_name'] == 'KA Chain'
                  && $previous_process->attributes['department_name'] == 'Hook') {
          $previous_process->attributes['hook_in'] = 0;
          $process_field = $this->process_field_model->find('', array('process_id' => $previous_process->attributes['id'],
                                                                      'hook_in > 0' => null));
          $this->process_field_model->delete($process_field['id']);
        }

        $previous_process->calculate_balance(); 
        $previous_process->calcuate_balance_gross_and_fine();
        $previous_process->attributes['status'] = 'Pending';
        $previous_process->update(FALSE);
      }
      $this->process_model->delete_record_from_process_out_wastage_details($id);
      $processes = $this->model->find('', array('id' => $id));
  
      if($current_process->attributes['parent_id']!=0){
      $this->data['redirect_url'] = base_url().'processes/processes/view/'.$current_process->attributes['parent_id']; 
      }else{
        $this->data['redirect_url'] = $_SERVER['HTTP_REFERER'];
      }
    } else
      $this->data['redirect_url'] = $_SERVER['HTTP_REFERER'];
    parent::delete($id);
  }

  public function _get_form_data(){
  
    $process_data = $this->process_model->find('process_name,product_name,department_name,row_id',
                                                                array('id'=>$this->data['record']['id']));

    if($this->router->method == 'edit'){
      $where_balance = array();
      if(isset($_GET['barcode']) && $_GET['barcode'] == 1){
        $process_id = $this->data['record']['id'];
        $process_data = $this->process_model->find_process_data($process_id);
        $where_balance = array('balance > '=>0);
      }

      if(empty($process_data))
          redirect(base_url().$this->router->module.'/'.$this->router->class.'/index');

      $where   = array('product_name' =>  $process_data['product_name'],
                                  'process_name' => $process_data['process_name'],
                                  'row_id'=> $process_data['row_id']);

      $where_condition = array_merge($where,$where_balance);
      
      $processes = $this->process_model->find('*',$where_condition);
      
      $department_name = $process_data['department_name'];

      $this->data['record'] = $processes;

      $process_name = str_replace(" ","_",strtolower($process_data['product_name'].'_'.$process_data['process_name']));
      if(empty($processes)){
        $replace_charc = strtolower(str_replace(" ","_",$process_data['product_name']));
        if($replace_charc === 'office_outside' || $replace_charc === 'refresh')
          $module = $replace_charc;
        else $module = plural($replace_charc);
      
        $controller = strtolower(plural(str_replace(" ","_",$process_data['process_name'])));
        redirect(base_url().$module.'/'.$controller.'/index/'.$process_id);
      }


    }else{
      $processes = $this->process_model->find('*',array('id'=>$this->data['record']['id']));
      $this->data['record'] = @$_POST[$this->router->class];
      $this->data['record']['status'] = $processes['status'];
      $model_obj = new $this->model($_POST);
      $model_obj->calculate_balance();
      $model_obj->calcuate_balance_gross_and_fine();
      $this->data['record']['balance'] = $model_obj->attributes['balance'];
      $process_name = str_replace(" ","_",strtolower($process_data['product_name'].'_'.$process_data['process_name']));                                               
    }
    $this->data['record']['process_name'] = $process_data['process_name'];
    $this->data['record']['product_name'] = $process_data['product_name'];
    $this->data['record']['department_name'] = $process_data['department_name'];
    if(isset(get_process_structures()[$process_data['department_name']])){
      $this->data['process_array'] = get_process_structures()[$process_data['department_name']];
    }
    else redirect();
    //pr('s');
                                                  
  }
  
  public function _get_view_data() {
    // $this->db->query("UPDATE `process_details` SET `next_department_karigar` = 'Prasanjit-Fancy' WHERE `process_details`.`next_department_karigar` ='Prasanjit' and chain_name='Fancy Chain';");
    // $details=$this->process_field_model->get('',array('bounch_out!=0'=>NULL,'date(created_at)<'=>'2021-05-14'));
    // pd($details);
    
    
    // $this->db->query("UPDATE `process_details` SET `next_department_karigar` = 'Prasanjit-Fancy' WHERE `process_details`.`id` = 43471;");
    // $this->db->query("UPDATE `process_details` SET `next_department_karigar` = 'Prasanjit-Fancy' WHERE `process_details`.`id` = 43813;");
    if(isset($_GET['old']) && !empty($_GET['old'])) 
      $this->_get_view_data_old();
    else 
      $this->_get_view_data_new();
  }


  public function _get_view_data_new() {
    $id = $this->data['record']['id'];
    $this->data['record']=$this->process_model->find('processes.*,user1.name as created_user,user2.name as updated_user,',array('processes.id'=>$id),
                                                      array(array('users as user1','user1.id = processes.created_by','left'),
                                                            array('users as user2','user2.id = processes.updated_by','left')));
    /* links */
    $this->data['next_process_details']=$this->process_model->get('',array('parent_id'=>$this->data['record']['id']));
    $this->data['process_detail_id'] = $this->process_model->find('parent_process_detail_id',array('id'=>$id));//pd($this->data['process_detail_id']);
    if($this->data['process_detail_id']['parent_process_detail_id']!=0) {
      $this->data['prev_process_out_weight_details']=$this->process_field_model->find('(out_weight+customer_out+factory_out+recutting_out+gpc_out+tanishq_out) as out_weight',
                                                                      array('id'=>$this->data['record']['parent_process_detail_id']));
    }
    $this->data['next_process_parent_ids']=array_column($this->data['next_process_details'], 'parent_id');
    $this->data['prev_process_details']=$this->process_model->find('',array('id'=>$this->data['record']['parent_id']));
    /* in_out_weights */
    $this->data['in_fields'] = array('in_weight','fe_in','tounch_in','hook_in','sisma_in','gemstone_in','copper_in','stone_vatav','alloy_weight');
    $this->data['out_fields'] = array('out_weight','fe_out','tounch_out','hook_out','sisma_out','gemstone_out','copper_out','out_stone_vatav','out_alloy_weight',
                                      'factory_out','customer_out','bounch_out','tanishq_out','recutting_out');
    /* in_weight_details */
    if($this->data['record']['product_name']=='Indo tally Chain' && $this->data['record']['department_name']=='Spring') {
      $this->data['indo_in_weights'] = $this->process_model->get('',array('parent_lot_id'=>$this->data['record']['parent_lot_id'], 'department_name'=>'Wire Drawing','status'=>'Complete'));
    }
    /* in-weights from process groups */
    if($this->data['record']['product_name']=='Rope Chain' ||$this->data['record']['product_name']=='Lopster Making Chain' || $this->data['record']['product_name']=='Indo tally Chain' || $this->data['record']['product_name']=='Hollow Choco Chain' || $this->data['record']['product_name']=='Hand Made Chain') {
      $this->data['process_group_in_weights'] = $this->process_group_model->get('process_groups.process_id,processes.out_weight,processes.out_purity,
                                                                                processes.out_lot_purity,processes.created_at as process_created,processes.lot_no',
                                                                                array('process_groups.parent_id'=>$this->data['record']['id']),
                                                                                array(array('processes','processes.id=process_groups.process_id')));
      if(!empty($this->data['process_group_in_weights'])) $this->data['prev_process_details']='';
    }
    /* in-weights from process out wastage details */
    $this->data['process_out_wastage_in_weights'] = $this->process_out_wastage_detail_model->get('process_out_wastage_details.*,processes.wastage_purity,
                                                                                                  processes.wastage_lot_purity,processes.lot_no',
                                                                                                  array('process_out_wastage_details.parent_id'=>$this->data['record']['id']),
                                                                                                  array(array('processes','processes.id=process_out_wastage_details.process_id')));
    //array_push($this->data['in_weight_details'],$indo_in_weight_details);pd($this->data['in_weight_details']);
    /* wastages */
    $this->data['wastages'] = array(
                                'Melting Wastage'=>array('melting_wastage','in_melting_wastage','out_melting_wastage','out_opening_melting_wastage','issue_melting_wastage', 'balance_melting_wastage'),
                                'Daily Drawer Wastage'=>array('daily_drawer_wastage','out_daily_drawer_wastage','issue_daily_drawer_wastage','balance_daily_drawer_wastage'),
                                'HCL Wastage'=>array('hcl_wastage','out_hcl_wastage','balance_hcl_wastage'),
                                'Loss'=>array('loss','refine_loss','out_loss','issue_loss','balance_loss'),
                                'Ghiss'=>array('ghiss','out_ghiss','issue_ghiss','balance_ghiss'),
                                'Pending Ghiss'=>array('pending_ghiss','out_pending_ghiss','balance_pending_ghiss'),
                                'HCL Ghiss'=>array('hcl_ghiss','out_hcl_ghiss','balance_hcl_ghiss'),
                                'HCL Loss'=>array('hcl_loss','issue_hcl_loss','balance_hcl_loss'),
                                'Tounch Loss Fine'=>array('tounch_loss_fine','issue_tounch_loss_fine','balance_tounch_loss_fine'),
                                'GPC'=>array('gpc_out','issue_gpc_out','balance_gpc_out'),
                                'Tounch Out'=> array('tounch_out','out_tounch_out','balance_tounch_out'),
                                'Tounch Ghiss'=> array('tounch_ghiss','out_tounch_ghiss','balance_tounch_ghiss'),
                                'Fire Tounch In'=> array('fire_tounch_in', 'total_fire_tounch_out', 'balance_fire_tounch_out'),
                                'Solder Wastage'=> array('solder_wastage', 'out_solder_wastage', 'balance_solder_wastage'),
                              );
    /* process_details */
    /*$this->data['process_details']=$this->process_field_model->get('id,design_code,machine_size,length,karigar,no_of_bunch,out_weight,daily_drawer_wastage,
                                                                  melting_wastage,hcl_wastage,ghiss,wastage_au_fe,hook_in,hook_out,tounch_in,
                                                                  gemstone_in,gemstone_out,fe_in,hcl_ghiss,daily_drawer_type,rnd_process,hook_kdm_purity,
                                                                  daily_drawer_out_weight,daily_drawer_in_weight,pending_ghiss,loss,design_code_type,
                                                                  in_melting_wastage,customer_out,customer_name,next_department_name,fire_tounch_in,factory_out,
                                                                  order_detail_id,design_code_category,melting_lot_category_one,recutting_out,
                                                                  product_name,tone,karigar_loss,gpc_out,description,next_department_karigar,',
                                                                  array('process_id'=>$id));*/
    $or_where_out_details = '(out_weight!=0 or customer_out!=0 or factory_out!=0 or tanishq_out!=0 or recutting_out!=0 or gpc_out!=0)';
    $this->data['out_process_details'] = $this->process_field_model->get('id,product_name,design_code,machine_size,length,no_of_bunch,
                                                                          out_weight,design_code_type,customer_out,bounch_out,customer_name,next_department_name,
                                                                          factory_out,tanishq_out,order_detail_id,design_code_category,melting_lot_category_one,
                                                                          recutting_out,tone,description,rnd_process,next_department_karigar,
                                                                          gpc_out,created_at',array('process_id'=>$id,$or_where_out_details=>NULL));
    foreach($this->data['out_process_details'] as $key => $process_detail_value) {
      foreach ($this->data['next_process_details'] as $k => $next_process_detail) {
        if($next_process_detail['parent_process_detail_id']==$process_detail_value['id']) {
          $this->data['out_process_details'][$key]['process_id'] = $next_process_detail['id'];
        }
      }
    }
    $or_where_hook_details = '(hook_in!=0 or hook_out!=0 or sisma_in!=0 or sisma_out!=0 or daily_drawer_in_weight!=0 or daily_drawer_out_weight!=0)';
    $this->data['hook_process_details'] = $this->process_field_model->get('id,hook_in,hook_out,sisma_in,sisma_out,hook_kdm_purity,daily_drawer_type,daily_drawer_in_weight,
                                                                          daily_drawer_out_weight,karigar,created_at',
                                                                          array('process_id'=>$id,$or_where_hook_details=>NULL));
    $or_where_wastage_details = '(melting_wastage!=0 or in_melting_wastage!=0 or hcl_wastage!=0 or ghiss!=0 or hcl_ghiss!=0 or pending_ghiss!=0 or wastage_au_fe!=0
                                 or fe_in!=0 or tounch_in!=0 or gemstone_in!=0 or gemstone_out!=0 or daily_drawer_wastage!=0 or fire_tounch_in!=0 
                                 or loss!=0 or karigar_loss!=0)';
    $this->data['wastage_process_details'] = $this->process_field_model->get('id,melting_wastage,in_melting_wastage,hcl_wastage,ghiss,hcl_ghiss,pending_ghiss,
                                                                          wastage_au_fe,fe_in,tounch_in,gemstone_in,gemstone_out,daily_drawer_wastage,
                                                                          fire_tounch_in,loss,karigar_loss,created_at',
                                                                          array('process_id'=>$id,$or_where_wastage_details=>NULL));
    /* wastage_details */
    $this->data['wastage_detail_names']=$this->process_out_wastage_detail_model->get('DISTINCT(field_name) as wastage_name',array('process_id'=>$id));
    $this->data['wastage_details']=$this->process_out_wastage_detail_model->get('process_out_wastage_details.*,processes.lot_no,processes.parent_lot_name',
                                                                                array('process_id'=>$id),
                                                                                array(array('processes','processes.id = process_out_wastage_details.parent_id')));
    /* issue-details */
    $this->data['issue_detail_names']= $this->issue_department_detail_model->get('DISTINCT(issue_department_details.field_name) as issue_department_names',array('issue_department_details.process_id'=>$id));
    $this->data['issue_details']=$this->issue_department_detail_model->get('',array('issue_department_details.process_id'=>$id));
    //pd($this->data['process_details']);
    $this->data['layout']        = 'application';
    
//    $record_groups = get_record_groups($this->data['record']['product_name']);pd($record_groups);
//    $this->data['process_details']=$this->process_model->find('',array('parent_id'=>$this->data['record']['id']));
//    $this->data['layout']        = 'application';
  }

  function _get_view_data_old(){

    $record_groups = get_record_groups($this->data['record']['product_name']);
    $this->data['process_details']=$this->process_model->find('',array('parent_id'=>$this->data['record']['id']));

    foreach (get_columns_per_model() as $model_name => $columns) {
      $common_columns            = isset($columns['_common_data']['columns']) ? $columns['_common_data']['columns'] : array();
      $common_select_columns     = isset($columns['_common_data']['select_columns']) ? $columns['_common_data']['select_columns'] : array();
      $common_columns_with_total = isset($columns['_common_data']['columns_with_total']) ? $columns['_common_data']['columns_with_total'] : array();
      $custom_headers            = isset($columns['_common_data']['custom_headers']) ? $columns['_common_data']['custom_headers'] : array();
      $is_same_model             = isset($columns['_common_data']['same_model']) ? $columns['_common_data']['same_model'] : false;
      $common_joins              = isset($columns['_common_data']['joins']) ? $columns['_common_data']['joins'] : array();
      $common_only_for           = isset($columns['_common_data']['only_for']) ? $columns['_common_data']['only_for'] : array();

      unset($columns['_common_data']);
      foreach ($columns as $column_name => $column_data) {

        /* columns */
        if(!isset($column_data['columns'])) {
          $column_data['columns'] = $common_columns;
        } else {
          $column_data['columns'] = array_merge($column_data['columns'] , $common_columns);
        }
        /* columns at end */
        if(isset($column_data['columns_at_end'])) {
         $column_data['columns'] = array_merge($column_data['columns'] , $column_data['columns_at_end']); 
        }
        /* columns to remove */
        if(isset($column_data['columns_to_remove'])) {
          $column_data['columns'] = array_diff($column_data['columns'], $column_data['columns_to_remove']);
        }
        /* override columns */
        if(isset($column_data['columns_override'])) {
          $column_data['columns'] = $column_data['columns_override'];
        }
        /* select_columns */
        if (!isset($column_data['select_columns'])) {
          $select_columns = $common_select_columns;
        } else {
          $select_columns = $column_data['select_columns'];
        }
        if(empty($select_columns)) {
          $select_columns = $column_data['columns'];
        }

        /* conditions */
        if(!isset($column_data['conditions'])) {
          $column_data['conditions'] = array();
        }
        /* join conditions */
        if(!isset($column_data['joins'])) {
          $column_data['joins'] = $common_joins;
        } else {
          if(isset($column_data['override_default_condition']) && $column_data['override_default_condition'] == true) {
            $column_data['joins'] = $column_data['joins'];
          } else {
            $column_data['joins'] = array_merge($column_data['joins'] ,$common_joins);
          }
        }
        /* only for chain */
        if (!isset($column_data['only_for'])) {
          $column_data['only_for'] = $common_only_for;
        } else {
          $column_data['only_for'] = array_merge($column_data['only_for'] , $common_only_for);
        }

        $data_flag = false;
        if(empty($column_data['only_for'])) {
          $data_flag = true;
        }
        else if(in_array($this->data['record']['product_name'], $column_data['only_for']['products'])) {
          $data_flag = true;
          if(!empty($column_data['only_for']['departments']) && ! in_array($this->data['record']['department_name'], $column_data['only_for']['departments'])) {
            $data_flag = false;
          }
        }

        /* set data */
        if ($data_flag) {
          $this->data[$column_name.'_data'] = array();

          if ($is_same_model) {
            if(isset($column_data['dynamic_condition']) && $column_data['dynamic_condition'] == true) {
              $column_data['conditions'][$column_data['field']] = $this->data['record'][$column_data['dynamic_value']];
            }
            if(isset($column_data['override_default_condition']) && $column_data['override_default_condition'] == true) {
              $where = $column_data['conditions'];
            } else {
              $where = array_merge(array('process_id' => $this->data['record']['id']), $column_data['conditions']);
            }
            $this->data[$column_name.'_data'] = $this->$model_name->get($select_columns, $where, $column_data['joins']);
          } else {
            $result = false;
            if(!empty($column_data['conditions'])) {
              foreach ($column_data['conditions'] as $condition) {
                if($condition == 'greater_than_zero') {
                  $result = $this->data['record'][$column_name] > 0;
                }
              }
            }
            if($result) {
              $this->data[$column_name.'_data'] = $this->$model_name->get($select_columns, array('process_id' => $this->data['record']['id']), $column_data['joins']);
            }
          }

          /* set columns */
          $this->data[$column_name.'_columns'] = $column_data['columns'];
          /* update custome headers */
          if(isset($column_data['custom_headers'])) {
            $custom_headers = array_merge($column_data['custom_headers'], $custom_headers);
          }
          $table_headers = $column_data['columns'];
          
          foreach ($custom_headers as $old_header => $new_header) {
            $index = array_search($old_header, $table_headers);
            if($index) {
              $table_headers[$index] = $new_header;
            }
          }

          $this->data[$column_name.'_headers'] = $table_headers;

          /* columns with totals */
          $columns_with_total = $common_columns_with_total;
          if(isset($column_data['columns_with_total'])) {
            $columns_with_total = array_merge($column_data['columns_with_total'], $common_columns_with_total);
          }
          foreach($columns_with_total as $column_with_total) {
            if(count($this->data[$column_name.'_data']) > 1) {
              $this->data[$column_name.'_totals'][$column_with_total] = array_sum(array_column($this->data[$column_name.'_data'], $column_with_total));
            }
          }
          /* columns with weighted average */
          if(isset($column_data['columns_with_wt_avg'])) {
            foreach ($column_data['columns_with_wt_avg'] as $weighted_avg_column => $weighting_factor_column) {
              if(!empty($this->data[$column_name.'_data']) && count($this->data[$column_name.'_data']) > 1) {
                $total = 0;
                $weighting_factors_sum = array_sum(array_column($this->data[$column_name.'_data'], 'out_weight'));
                foreach ($this->data[$column_name.'_data'] as $row) {
                  $total += $row[$weighting_factor_column] * $row[$weighted_avg_column];
                }
                $wt_avg = $total / $weighting_factors_sum;
                $this->data[$column_name.'_totals'][$weighted_avg_column] = $wt_avg;
              }
            }
          }
        }
      }
    }
    
    foreach ($record_groups as $group => $columns) {
      if(in_array($group, get_groups_to_hide_if_zero())) {
        $hide_group = TRUE;
        foreach ($columns as $column) {
          if($this->data['record'][$column] != 0 || !empty($this->data[$column.'_data'])) {
            $hide_group = FALSE;
          }
        }
        if($hide_group) unset($record_groups[$group]);
      }
    }

    $link_table_columns = array('process_name', 'department_name', 'id','parent_id');
    $link_table_headers = array('process_name', 'department_name', 'action');

    $this->data['previous_process_data']    = $this->model->get($link_table_columns, array('id' => $this->data['record']['parent_id']));

    $this->data['previous_process_columns'] = $link_table_columns;
    $this->data['previous_process_headers'] = $link_table_headers;
    
    $this->data['next_processes_data']    = $this->model->get($link_table_columns, array('parent_id' => $this->data['record']['id']));
    $this->data['next_process_parent_ids']=array_column($this->data['next_processes_data'], 'parent_id');
    $this->data['next_processes_columns'] = $link_table_columns;
    $this->data['next_processes_headers'] = $link_table_headers;

    $process_information_table_columns = array('in_weight', 'out_weight', 'wastage','loss','stone_vatav','balance','id');
    $process_information_table_headers = array('in_weight', 'out_weight', 'wastage','loss','stone_vatav','balance','action');

    $this->data['process_information_data']    = $this->process_information_model->get($process_information_table_columns, array('process_id' => $this->data['record']['id']));
    $this->data['process_information_columns'] = $process_information_table_columns;
    $this->data['process_information_headers'] = $process_information_table_headers;

    $this->data['layout']        = 'application';
    $this->data['record_groups'] = $record_groups;
  }
}
