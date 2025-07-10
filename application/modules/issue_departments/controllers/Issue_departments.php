<?php
class Issue_departments extends BaseController {
  public function __construct() {
  parent::__construct();
  $this->redirect_after_save = 'view';
  $this->load->model(array('users/account_model',
               'processes/process_model',
               'masters/domestic_category_master_model',
               'processes/process_detail_model',
               //'chitties/chitty_model',
               'export_internals/packing_slip_detail_model',
               'users/account_model',
               'processes/process_out_wastage_detail_model',
               'settings/issue_purity_model',
               'settings/chain_purity_model',
               'settings/category_four_model',
               'settings/category_model',
               'melting_lots/parent_lot_model',
               'settings/internal_wastage_model',
               'masters/item_code_master_model',
               //'refresh/refresh_model',
               'issue_department_detail_model'));
  }

  /*private function get_account_names_from_accounts() {
    $data['account_name']=$_GET['query'];
    $url=API_BASE_PATH."masters/accounts/index";
    $records=json_decode(curl_post_request($url,$data));
    $autocomplete_result=array();
    if(!empty($records->data)){
      foreach ($records->data as $index => $record) {
        $autocomplete_result[]=$record->name;
      }
    }
    echo json_encode($autocomplete_result);
    die;
  }*/

  private function get_customer_name_digital_catalogs()
    {
        $url = "https://argold-catalog.8848digital.com/api/method/digitalcatalog_api_erpnext.api.sales_order.get_unique_customer_names";
        $records = $this->issue_department_model->get_customer_name_from_digital_catalogs($url);
        $autocomplete_result = array();
        if (!empty($records->message)) {
            foreach ($records->message as $index => $record) {
      if($record!=""){
                $autocomplete_result[$index]['id'] = $record;
                $autocomplete_result[$index]['name'] = $record;
            }}
        }
//        pd($autocomplete_result);
        return $autocomplete_result;
    }

  public function index() {
    
    if (isset($_GET['acid'])) {
      $issue_department = $this->model->find('', array('id' => $_GET['acid']));
      $this->model->send_request_to_argold_accounts($issue_department, true, true);
    }

    if (isset($_GET['pid'])) {
      $process = $this->process_model->find('', array('id' => $_GET['pid']));
      $process_obj = $this->process_model->get_model_object($process);
      $process_obj->create_next_process_record('', array(), TRUE);
      //$this->load->model('melting_lots/melting_lot_model');
      //$melting_lot_obj = new melting_lot_model(array('id' => 523)); //$process['melting_lot_id']));
      //$melting_lot_obj->create_start_department_record();
    }

    if(!empty($_GET['query'])) $this->get_account_names_from_accounts();

    if(!empty($_GET["pdf"])){
      $this->data['record'] = $this->issue_department_model->find('*',array('id'=>@$_GET["id"]));
      $this->_get_view_data();
      $this->data['pdf_html'] =  $this->load->view('issue_departments/issue_departments/view',$this->data,true);
    }

    $redirect = 0;
    if(isset($_GET["issue_hcl_loss"]) && $_GET['issue_hcl_loss']==1) {
      $this->issue_department_model->create_hcl_loss_record($_GET["parent_lot_id"], $_GET['product_name']);
      $redirect = 1;
    }

    if(isset($_GET["issue_tounch_fine_loss"]) && $_GET['issue_tounch_fine_loss']==1) {
      $this->issue_department_model->create_tounch_loss_fine_record($_GET["parent_lot_id"], $_GET['product_name']);
      $redirect = 1;
    }

    if(isset($_GET["issue_castic_loss"]) && $_GET['issue_castic_loss']==1) {
      $this->issue_department_model->create_castic_loss_record($_GET["parent_lot_id"], $_GET['product_name']);
      $redirect = 1;
    }

    if(isset($_GET["archive_records"]) && $_GET['archive_records']==1) {
      $this->issue_department_model->archive_records($_GET["parent_lot_id"]);
      $redirect = 1; 
    }

    if ($redirect == 1) redirect(base_url('issue_departments'));
    parent::index();
  }

  public function create() {
    if(!empty($_GET['chain_name']))
      $chain_name = (strpos($_GET['chain_name'],'%')) ? urlencode($_GET['chain_name']) : urldecode($_GET['chain_name']);
    
    if(!empty($_GET['category_one']))
      $category_one = (strpos($_GET['category_one'],'%')) ? urlencode($_GET['category_one']) : urldecode($_GET['category_one']);
    
    if(!empty($_GET['parent_lot_name']))
      $parent_lot_name = (strpos($_GET['parent_lot_name'],'%')) ? urlencode($_GET['parent_lot_name']) : urldecode($_GET['parent_lot_name']);
    
    if(!empty($_GET['department_name']))
      $department_name = (strpos($_GET['department_name'],'%')) ? urlencode($_GET['department_name']) : urldecode($_GET['department_name']);
    if(!empty($_GET['customer_name']))
      $customer_name = (strpos($_GET['customer_name'],'%')) ? urlencode($_GET['customer_name']) : urldecode($_GET['customer_name']);
    
    $this->data['record']['product_name']    = isset($_GET['product_name']) ? $_GET['product_name'] : '';
    $this->data['record']['chain_name']      = (isset($_GET['chain_name']) && !empty($_GET['chain_name'])) ? str_replace('^^','+', $chain_name): '';
    $this->data['chain_name']                = isset($_GET['chain_name']) ?$_GET['chain_name']: '';

    $this->data['record']['chain_purity']    = isset($_GET['chain_purity']) ? $_GET['chain_purity'] : '';
    $this->data['record']['account_id']    = isset($_GET['account_name']) ? $_GET['account_name'] : '';
    $this->data['record']['category_one']    = isset($_GET['category_one']) ?str_replace('^^','+', $category_one): '';
    $this->data['record']['department_name'] = isset($_GET['department_name']) ? str_replace('^^','+',$department_name): '';
    $this->data['record']['customer_name'] = isset($_GET['customer_name']) ? str_replace('^^','+',@$customer_name): '';
    $this->data['record']['parent_lot_name'] = isset($_GET['parent_lot_name']) ? str_replace('^^','+',$parent_lot_name): '';
    parent::create();
  }

  public function _get_form_data() {
    $this->data['chain_names'] = array();
    $this->data['record']['chain_purity'] =  !empty($_GET['chain_purity']) ? $_GET['chain_purity'] : @$this->data['record']['chain_purity'];
    $this->data['record']['account_id'] =  !empty($_GET['account_name']) ? $_GET['account_name'] : @$this->data['record']['account_id'];

    $processes=array();
    if (!empty($this->data['record']['product_name'])) {
      if ($this->data['record']['product_name']=='GPC Out' || 
          $this->data['record']['product_name']=='Finish Good' || 
          $this->data['record']['product_name']=='GPC Repair Out' || 
          $this->data['record']['product_name']=='GPC Loss Out'){ 
          if(HOST=='ARF' && $this->data['record']['product_name']=='GPC Out'){
            if (!empty($this->data['record']['chain_purity'])&&!empty($this->data['record']['customer_name'])) 
            $processes = $this->get_issue_department_details(); 
            else
              $processes = array();
          }else{
             if (!empty($this->data['record']['chain_purity'])) 
              $processes = $this->get_issue_department_details(); 
            else
              $processes = array();
          }
        
       } 
      /*elseif ($this->data['record']['product_name']=='Chitti Out') {
        $this->data['processes'] = $this->get_chitti_issue_department_details(); 
      }*/
      elseif ($this->data['record']['product_name']=='Ghiss Melting Loss') {
        $processes = $this->get_ghiss_melting_loss_issue_department_details(); 
      }
      else{
        $processes = $this->get_issue_department_details(); 
      }

      if($this->data['record']['product_name']=='GPC Out' || 
         $this->data['record']['product_name']=='Finish Good' || 
         $this->data['record']['product_name']=='GPC Repair Out' || 
         $this->data['record']['product_name']=='GPC Loss Out') 
        $this->data['chain_names'] = $this->get_chain_names();

      if ($this->data['record']['product_name'] != 'Chitti Out' &&  !empty($processes)) {
        foreach ($processes as $process_index => $process_value) {
          if($this->data['record']['product_name'] != 'Packing Slip'){
            $tounch_purity = $this->process_model->find('tounch_purity',  array('tounch_purity != ' => 0,
                                                                                'melting_lot_id'    => $process_value['melting_lot_id'],
                                                                                'product_name'      => $process_value['product_name']),
                                                               array(), array('order_by'=>'created_at desc'));
          }
          $tounch_purity = empty($tounch_purity) ? 0 : $tounch_purity['tounch_purity'];
          $this->data['processes'][$process_index] = $process_value;
          $this->data['processes'][$process_index]['tounch_purity'] = $tounch_purity;

          if($this->data['record']['product_name'] == 'GPC Out' || 
             $this->data['record']['product_name'] == 'QC Out' || 
             $this->data['record']['product_name'] == 'GPC Out' || 
             $this->data['record']['product_name'] == 'Finish Good' || 
             $this->data['record']['product_name'] == 'GPC Repair Out' || 
             $this->data['record']['product_name'] == 'GPC Loss Out') {
            $default_chain_margin       = $this->category_model->find('wastage',array('category_one'=>$process_value['melting_lot_category_one'],'category_two'=>$process_value['melting_lot_category_two'])); 
          if($process_value['product_name']=="KA Chain" || $process_value['product_name']=="Ball Chain"){
            $item_code_detail       = $this->item_code_master_model->find('item_code',array('product_name'=>$process_value['product_name'],'melting_lot_category_one'=>$process_value['melting_lot_category_one'],'machine_size'=>$process_value['machine_size'])); 
          }else{
            $item_code_detail       = $this->item_code_master_model->find('item_code',array('product_name'=>$process_value['product_name'],'design_name'=>$process_value['melting_lot_category_one'],'tone'=>$process_value['tone'])); 
          }
          $domestic_category_detail       = $this->domestic_category_master_model->find('rate_per_gram,design_code',array('design_code'=>$process_value['melting_lot_category_one']));
            $default_chain_margin=!empty($default_chain_margin)?$default_chain_margin['wastage']:0;
             $chain_margin       = $this->issue_purity_model->get_issue_wastage($process_value['id'], ''); 
             $chitti_purity       = $this->issue_purity_model->get_issue_chitti_purity($process_value['id'], ''); 
            //$chain_margin       = $this->issue_purity_model->get_dynamic_issue_wastage_and_chitti_purity($process_value['id'],$this->data['record']['account_id']); 
            //$chitti_purity       = $this->issue_purity_model->get_dynamic_issue_wastage_and_chitti_purity($process_value['id'],$this->data['record']['account_id'],false);
            $this->data['processes'][$process_index]['chain_margin'] = (!empty($chain_margin) && $chain_margin!=0 )? $chain_margin : $default_chain_margin;
            $this->data['processes'][$process_index]['item_code'] = (!empty($item_code_detail['item_code']))? $item_code_detail['item_code'] : "";
           $this->data['processes'][$process_index]['rate_per_gram'] = (!empty($domestic_category_detail['rate_per_gram']))? $domestic_category_detail['rate_per_gram'] : "";
           $this->data['processes'][$process_index]['chitti_purity'] = !empty($chitti_purity) ? $chitti_purity : '';

            $this->data['processes'][$process_index]['design_chitti_name'] = $this->category_four_model->get_chitti_design_name($process_value['id']);
            //$this->data['processes'][$process_index]['design_machine_size'] = !empty($design_chitti_name) ? $design_chitti_name['machine_size'] : '';
          
          }
        }
      }
    }

    $this->data['accounts'] = $this->account_model->get('', array());
    $this->data['issue_purity'] = 0;
    $this->data['department_name'] = get_ghiss_issue_department();
    // $this->data['chain_purity'] = array(array('name' => '92.00', 'id' => '92.00'),
    //                                       array('name' => '83.50', 'id' => '83.50'),
    //                                       array('name' => '75.00', 'id' => '75.00'),
    //                                       array('name' => '58.50', 'id' => '58.50'),
    //                                       array('name' => '37.50', 'id' => '37.50'));
    
    if($this->data['record']['product_name']=="Hallmark Out"){
      $this->data['chain_purity'] = $this->process_model->get('distinct(out_lot_purity) as name ,out_lot_purity as id' ,array('hallmark_out>'=>0));
    }else{
      $this->data['chain_purity'] = $this->process_model->get('distinct(out_lot_purity) as name ,out_lot_purity as id' ,array('balance_gpc_out>'=>0));
    }
  $this->data['internal_wastages'] = $this->internal_wastage_model->get('distinct(name) as name ,name as id');
  $where_customer_name=array('balance_gpc_out>'=>0,'customer_name!='=>'');
  if(!empty($this->data['record']['chain_purity'])){
    $where_customer_name['out_lot_purity']=$this->data['record']['chain_purity'];
  }
  $this->data['customer_name'] = $this->process_model->get('distinct(customer_name) as name ,trim(customer_name) as id' ,$where_customer_name);
  //$this->data['customer_name'] = $this->get_customer_name_digital_catalogs();
  $this->data['customer_name'] = array_merge(array(array('name' => 'Market Issue', 'id' => 'Market Issue')),$this->data['customer_name']);


    $this->data['hook_kdm_purity']= 
      $this->chain_purity_model->get('lot_purity as name,lot_purity as id',
                                     array('where_in' => array('product_name'=>get_office_ouside_product_name())),
                                     array(),
                                     array('group_by'=>'lot_purity'));

    if (HOST=='ARC')
      $this->data['chain_purity'] = array_merge($this->data['chain_purity'], 
                                                array(array('name' => '58.50000000', 'id' => '58.50000000')));

    // elseif (HOST=='ARC')
     
    $where['category_one!=']='';

    $this->data['category_one'] = $this->issue_purity_model->get('distinct(category_one) as id, category_one as name');

    if (!empty($this->data['record']['chain_purity'])) {
      if($this->data['record']['chain_name']=='Sisma Chain') 
        $where=array('chain_purity' => $this->data['record']['chain_purity'],
                     'chain_name' => $this->data['record']['chain_name']);
      else
        $where=array('chain_purity' => $this->data['record']['chain_purity'],
                     'issue_chain_name' => $this->data['record']['chain_name']);
        
      if(!empty($this->data['record']['category_one']))  $where['category_one'] = $this->data['record']['category_one'];
        $chain_margin = $this->issue_purity_model->find('chain_margin', $where);

      if (!empty($chain_margin))
        $this->data['record']['out_purity'] = four_decimal($this->data['record']['chain_purity'] + $chain_margin['chain_margin']);
    }  

    if($this->data['record']['product_name']=='QC Out'){
      $this->data['domestic_categories']=$this->domestic_category_master_model->get('design_code as name,design_code as id');
    }
    if($this->data['record']['product_name']=='Castic Loss'){
      $this->data['castic_loss_categories']=get_parent_lot_process();
      if(!empty($this->data['record']['category_one']))
        $this->data['parent_lot_name']=$this->parent_lot_model->get('name as id,name as name',array('process_name'=>$this->data['record']['category_one']),array());
    }

    if ($this->router->method == 'store' || $this->router->method == 'update') {
      $this->data['record']['issue_departments'] = $_POST['issue_departments'];
      $this->data['issue_department_details']    = @$_POST['issue_department_details'];
    }

    
      $this->data['account_names']=$this->account_model->get('distinct(name) as name,name as id',array('name'!=""));
    
  }
  
  public function update($id) {
    if(isset($_GET['from']) && $_GET['from']=='view') {
      $issue_department = $this->model->find('id', array('id' => $id));
      $issue_department_obj = new $this->model($issue_department);
      $issue_department_obj->before_validate();
      $issue_department_obj->save(FALSE);
      redirect($_SERVER['HTTP_REFERER']);
    } else {
      parent::update($id);
    }
  }

  /*private function get_chitti_issue_department_details(){
     $where = array('in_weight > 0' => NULL,
                    'id not in (select chitti_id from issue_department_details)' => NULL);
      
     return $this->chitty_model->get('',$where);
  }*/
  public function _after_save($formdata, $action){
    $this->data['redirect_url']= ADMIN_PATH.'issue_departments/issue_departments';
    return $formdata;
  } 

  private function get_ghiss_melting_loss_issue_department_details(){
    if(!empty($_GET['department_name'])){
      $department_name=explode(',',$_GET['department_name']);
      $where['where'] = array('out_ghiss>'=>0,
                    'wastage_purity >' => 0,
                    'wastage_lot_purity >' => 0);
      $where['where_in'] =array('department_name'=>'"'.implode('", "', $department_name).'"') ;
      $processes= $this->process_model->get('id,department_name', $where);
      $process_id=array_column($processes,'id');
      
      $tounch_where['where'] = array('out_tounch_ghiss>'=>0,
                    'wastage_purity >' => 0,
                    'wastage_lot_purity >' => 0);
      $tounch_where['where_in'] =array('department_name'=>'"'.implode('", "', $department_name).'"') ;
      $tounch_processes= $this->process_model->get('id,department_name,out_tounch_ghiss', $tounch_where);

      $tounch_process_id=array_column($tounch_processes,'id');

      $process_id=array_merge($tounch_process_id,$process_id);

      $department_wise_process_id=array();
      if(HOST!='ARC'){
        $department_wise_where['where'] = array('balance_loss!='=>0,
                      'product_name'=>'Ghiss Out',
                      'next_department_name'=>$_GET['department_name']);
        $department_wise_processes= $this->process_model->get('id,department_name', $department_wise_where);
        $department_wise_process_id=array_column($department_wise_processes,'id');
      }


      if(!empty($process_id)){
        $process_out_wastage_details= $this->process_out_wastage_detail_model->get('distinct(parent_id) as parent_id',array('where'=>array('field_name'=>'Ghiss Out'),
                  'where_in'=>array('process_id'=>$process_id)));

       

        $parent_id=array_column($process_out_wastage_details,'parent_id');

        $tounch_process_out_wastage_details= $this->process_out_wastage_detail_model->get('distinct(parent_id) as parent_id',array('where'=>array('field_name'=>'Tounch Ghiss Out'),
                  'where_in'=>array('process_id'=>$process_id)));

       

        $tounch_parent_id=array_column($tounch_process_out_wastage_details,'parent_id');
        $parent_id=array_merge($tounch_parent_id,$parent_id);
        
        $processes= $this->process_model->get('id', array('where_in'=>array('parent_id'=>$parent_id),'where'=>array('balance_loss!='=>0)));
        $processes_id=array_column($processes,'id');

        $ghiss_final_details= $this->process_model->get('parent_id', array('product_name'=>'Ghiss Out','process_name'=>'Final Process','department_name'=>'Melting','balance_loss!='=>0,'id not in (select process_id from process_out_wastage_details)' => NULL));
        $ghiss_final_process_id=array_column($ghiss_final_details,'parent_id');

        $parent_processes= $this->process_model->get('id department_name', array('where_in'=>array('id'=>$parent_id),'where'=>array('balance_loss!='=>0)));
        $parent_processes_id=array_column($parent_processes,'id');

        $parent_id=array_merge($parent_id,$processes_id,$ghiss_final_process_id,$parent_processes_id,$department_wise_process_id);
      }
      if(!empty($parent_id)){
        return $this->process_model->get('', array('where_in'=>array('id'=>$parent_id),
        'where'=>array('balance_loss!='=>0,'wastage_purity >' => 0,'wastage_lot_purity >' => 0)));
      }
    }
  }

  public function _get_view_data() {
    $this->data['processes'] =array();
    $this->data['account'] = $this->account_model->find('', array('id' => $this->data['record']['id']));
    $this->data['issue_department_details'] = $this->issue_department_detail_model->get('',
                                    array('issue_department_id' => $this->data['record']['id']));

    $process_ids = array_column($this->data['issue_department_details'], 'process_id');
    $where=array();
    if(!empty($process_ids)){
      $where=array('where_in' => array('id' => $process_ids));
    }
    $this->data['processes'] = $this->process_model->get('',$where);

    foreach($this->data['processes'] as $processe){
      $parent_ids = array();
      $this->data['wastages'] =array();
      if($processe['product_name'] == 'Daily Drawer' && $processe['process_name'] == 'Melting'){
        $parent_ids[] = $processe['parent_id'];
        if(!empty($process_ids)){
          $where=array('where_in' => array('parent_id' => $parent_ids));
        }
          $process_out_wastage_details = $this->process_out_wastage_detail_model->get('id, process_id',$where);
          $process_ids = array_column($process_out_wastage_details, 'process_id');
        if(!empty($process_ids)){
          $where=array('where_in' => array('parent_id' => $parent_ids));
          $this->data['wastages'] = $this->process_model->get('',array('where_in' => array('id' => $process_ids)));
        }
      }
    }
  }

  private function get_issue_department_details() {
    $where = array();
    $group_by = array();
    $select = 'tone,parent_id,id, product_name,description, lot_no, melting_lot_category_one, melting_lot_category_two, melting_lot_id, design_code, melting_lot_chain_name, customer_name, gpc_out, balance_gpc_out, out_lot_purity, machine_size,loss,parent_lot_name,rejected,balance_rejected,
      department_name, process_name, quantity, balance_quantity, out_quantity, cz_wastage,balance_cz_wastage, daily_drawer_wastage, balance_daily_drawer_wastage,
      in_lot_purity, melting_wastage, balance_melting_wastage, tounch_loss_fine, balance_tounch_loss_fine,job_card_no,hallmark_out,balance_hallmark_out ,
      ghiss, balance_ghiss,balance_hcl_loss,balance_refine_loss, wastage_lot_purity,factory_issue_department_id,hallmark_quantity';
    
    if ($this->data['record']['product_name']     == 'Melting Wastage')         
      $where['balance_melting_wastage != 0 and product_name!="Rhodium Receipt" and product_name!="Hallmark Receipt" '] = NULL;  

    elseif ($this->data['record']['product_name'] == 'Daily Drawer Wastage')    
      $where['balance_daily_drawer_wastage >'] = 0;
    elseif ($this->data['record']['product_name'] == 'CZ Wastage')
      $where['balance_cz_wastage >'] = 0;


    elseif ($this->data['record']['product_name'] == 'HCL Loss')                
      $where['balance_hcl_loss !='] = 0;

    elseif ($this->data['record']['product_name'] == 'Tounch Loss Fine') {
      $select = 'sum(balance_tounch_loss_fine) as balance_tounch_loss_fine';
      $where['balance_tounch_loss_fine !='] = 0;
      $where['parent_lot_id'] = 0;
      $this->data['record']['in_weight'] = @$this->process_model->find($select, $where)['balance_tounch_loss_fine'];
      $this->data['record']['in_fine'] = $this->data['record']['in_weight'];
      $this->data['record']['in_purity'] = 100;
      if (HOST=='ARF')
        $this->data['record']['account_id'] = 'TOUNCH LOSS FINE ARF';
      else
        $this->data['record']['account_id'] = 'Tounch Loss Fine';
      //$this->data['record']]['description'] = 'Tounch loss fine issue until '.date('d-m-Y H:i:s');
      return array();
    //   $where['balance_tounch_loss_fine !='] = 0;
    //   $where['parent_lot_id'] = 0;
    //   // $where["product_name not in ('Indo tally Chain', 'Rope Chain', 'Machine Chain', 
    //   //                              'Hollow Choco Chain', 'Imp Italy Chain', 'Office Outside', 
    //   //                              'HCL', 'HCL Ghiss Out')"] = NULL;  
    //   $select = 'id, product_name, lot_no, melting_lot_id,department_name, process_name, balance_tounch_loss_fine';
    }        

    elseif ($this->data['record']['product_name'] == 'Cutting Ghiss'){          
      $where = array('balance_ghiss !=' => 0);
      $where["department_name in ('Cutting','Recutting')"] = NULL;

    }elseif ($this->data['record']['product_name'] == 'Ice Cutting Ghiss')       
      $where = array('balance_ghiss !=' => 0, 'department_name' => 'Ice Cutting');

    elseif ($this->data['record']['product_name'] == 'Hand Cutting Ghiss')       
      $where = array('balance_ghiss !=' => 0, 'department_name' => 'Hand Cutting');

    elseif ($this->data['record']['product_name'] == 'Hand Dull Ghiss')       
      $where = array('balance_ghiss !=' => 0, 'department_name' => 'Hand Dull');

    elseif ($this->data['record']['product_name'] == 'Sand Dull Ghiss')       
      $where = array('balance_ghiss !=' => 0, 'department_name' => 'Sand Dull');

    elseif ($this->data['record']['product_name'] == 'Ghiss Melting Loss')      
      $where = array('where' => array('product_name' => 'Ghiss Out', 
                                      'balance_loss != ' => 0),
                    'or_where' => array('tounch_loss_fine != '=> 0));

    elseif ($this->data['record']['product_name'] == 'Export Internal') {
      $internal=array('product_name' => 'Internal', 'balance_rejected != ' => 0);
      $where = array('where' =>$internal);
    }elseif ($this->data['record']['product_name'] == 'Domestic Internal') {
      $internal=array('product_name' => 'Domestic Internal', 'balance_rejected != ' => 0);
      $where = array('where' =>$internal);
    }
    elseif ($this->data['record']['product_name'] == 'Fire Tounch Loss') {
            $where = array('where' => array('product_name!=' => 'Melting Wastage Refine Out',
                'balance_refine_loss != ' => 0));
        }     

    elseif ($this->data['record']['product_name'] == 'GPC Out')                 
      $where = array('out_purity >' => 0, 
                     'out_lot_purity >' => 0,
                     'balance_gpc_out !=' => 0,
                    // 'gpc_out_required_status =' => 1,
                     'finish_good' => 0);

    elseif ($this->data['record']['product_name'] == 'Hallmark Out')                 
      $where = array('out_purity >' => 0, 
                     'out_lot_purity >' => 0,
                     'balance_hallmark_out !=' => 0);

    elseif ($this->data['record']['product_name'] == 'Huid')                 
      $where = array('out_purity >' => 0, 
                     'out_lot_purity >' => 0,
                     'process_name' =>"HUID Process",
                     'balance_gpc_out !=' => 0,
                     'finish_good' => 0);

    elseif ($this->data['record']['product_name'] == 'GPC Repair Out')          
      $where = array('out_purity >' => 0, 
                     'out_lot_purity >' => 0,
                     'balance_gpc_out !=' => 0,
                     'finish_good' => 0);

    elseif ($this->data['record']['product_name'] == 'GPC Loss Out')          
      $where = array('out_purity >' => 0, 
                     'out_lot_purity >' => 0,
                     'balance_gpc_out !=' => 0,
                     'finish_good' => 0);

    elseif ($this->data['record']['product_name'] == 'Refine Loss')          
      $where['balance_refine_loss != '] = 0;

    elseif ($this->data['record']['product_name'] == 'Finish Good')             
      $where = array('out_purity >' => 0,
                     'out_lot_purity >' => 0,
                     'balance_gpc_out !=' => 0,
                     'finish_good' => 1);     
    elseif ($this->data['record']['product_name'] == 'Hallmark Receipt'){
      $where = array('out_purity >' => 0, 
                     'out_lot_purity >' => 0,
                     'process_name' =>"Factory Out Process",
                     'balance_gpc_out !=' => 0);
      if(!empty($this->data['record']['account_id']) && $this->data['record']['account_id']=="AR Gold Software"){
        $where['where']['account']="AR Gold";
      }elseif(!empty($this->data['record']['account_id']) && $this->data['record']['account_id']=="ARC Software"){
        $where['where']['account']="ARC";
      }elseif(!empty($this->data['record']['account_id']) && $this->data['record']['account_id']=="ARF Software"){
        $where['where']['account']="ARF";
      }  
     

     } elseif ($this->data['record']['product_name'] == 'QC Out') {                
      $where = array('out_purity >' => 0, 
                     'out_lot_purity >' => 0,
                     'process_name' =>"GPC Process",
                     'balance_gpc_out !=' => 0,
                     'finish_good' => 0);
      if(!empty($this->data['record']['category_one']))       
        $where['where']['melting_lot_category_one']=$this->data['record']['category_one'];
      
  }elseif ($this->data['record']['product_name'] == 'Castic Loss') {           
      $where = array('balance_loss != ' => 0, 
                     'where_in' => array('department_name' => array('"Tounch Department"', 
                                                                    '"Castic Process"', 
                                                                    '"ReHCL"'))); 
      if(!empty($this->data['record']['category_one']))       
        $where['where']['product_name']=$this->data['record']['category_one'];
      if(!empty($this->data['record']['parent_lot_name']))    
        $where['where']['parent_lot_name']=$this->data['record']['parent_lot_name'];

    } elseif ($this->data['record']['product_name']=='Finished Goods Receipt')  
      $where = array('out_purity >' => 0, 
                     'out_lot_purity >' => 0,
                     'balance_gpc_out !=' => 0,
                     'product_name' => 'Finished Goods Receipt');
    else 
      $where['balance_gpc_out > '] = 0;

    if (!in_array($this->data['record']['product_name'], array('GPC Out', 'Finish Good', 'GPC Repair Out', 'GPC Loss Out'))) {
      $where['wastage_purity >']     = 0;
      $where['wastage_lot_purity >'] = 0;
    }

    if ($this->data['record']['product_name']=='GPC Out' || 
        $this->data['record']['product_name']=='Finish Good' || 
        $this->data['record']['product_name']=='GPC Repair Out' ||
        $this->data['record']['product_name']=='GPC Loss Out')  {
      // $chain_name_where=array();
      // if($this->data['record']['chain_name']=='KA Chain' || $this->data['record']['chain_name']=='Ball Chain' )
      //   $chain_name_where['chain_name']=$this->data['record']['chain_name'];
      // else 
      //   $chain_name_where['issue_chain_name']=$this->data['record']['chain_name'];
      
      // $issue_purity = $this->issue_purity_model->find('chain_name,
      //                                                  category_one,
      //                                                  category_three,
      //                                                  category_four', $chain_name_where);
      // $where['product_name'] = $issue_purity['chain_name'];
      
      if (   HOST == 'ARF' 
          && $this->data['record']['chain_name'] != 'Fancy Chain' 
          && $this->data['record']['chain_name'] != 'KA Chain' 
          && $this->data['record']['chain_name'] != 'Ball Chain' 
          && $this->data['record']['chain_name'] != 'KA Chain Refresh' 
          && $this->data['record']['chain_name'] != 'Refresh') {
        // $where['melting_lot_category_one'] = $issue_purity['category_one'];
        if ($this->data['record']['product_name'] != 'Finish Good') {
          // $where['machine_size'] = $issue_purity['category_three'];
          // $where['design_code']  = $issue_purity['category_four'];
        }
      }
    }
    if ($this->data['record']['chain_purity'] == '92.00') {
      $where['round(out_lot_purity,3)>'] = 90;
      $where['round(out_lot_purity,3)<'] = 93;
    }elseif ($this->data['record']['chain_purity'] == '75.00') {
      $where['round(out_lot_purity,3)>'] = 70;
      $where['round(out_lot_purity,3)<'] = 80;
    }elseif ($this->data['record']['chain_purity'] == '83.50') {
      $where['round(out_lot_purity,3)>'] = 81;
      $where['round(out_lot_purity,3)<'] = 89;
    }elseif ($this->data['record']['chain_purity'] == '58.50') {
      $where['round(out_lot_purity,3)>'] = 50;
      $where['round(out_lot_purity,3)<'] = 69;
    }elseif ($this->data['record']['chain_purity'] == '37.50') {
      $where['round(out_lot_purity,3)>'] = 30;
      $where['round(out_lot_purity,3)<'] = 40;
    }
     if(!empty($this->data['record']['customer_name'])){
      if($this->data['record']['customer_name']=='Market Issue'){
        $where['customer_name'] = '';
      }else{
        $where['customer_name'] = $this->data['record']['customer_name'];
      }
    } 
    $processes=$this->process_model->get($select, $where, array(), $group_by);
    foreach ($processes as $process_index => $process_value){
        $fire_tounch_loss_fine=$this->process_model->find('(((fire_tounch_in*out_lot_purity)/100)-((fire_tounch_out*fire_tounch_purity)/100)-((fire_tounch_fine*100)/100)) as balance_fine',array('id'=>$process_value['parent_id']));
        $processes[$process_index]['balance_refine_loss_fine']=$fire_tounch_loss_fine['balance_fine'];
    }
    


    if ($this->data['record']['product_name'] == 'Packing Slip') {
      $where=array();
      $issue_department_details=$this->issue_department_detail_model->get('process_id',array('field_name'=>"Packing Slip"));
      if(!empty($issue_department_details)){
        $process_ids=array_column($issue_department_details,'process_id');
        $where['packing_slip_id not in ('.implode(',',$process_ids).')']=NULL;
      }
      $processes=$this->packing_slip_detail_model->get("packing_slip_id,sum(gross_weight) as gross_weight ,sum(net_weight) as net_weight,sum(pure) as fine,sum((net_weight/pure)*100) as purity", $where,array(),array('group_by'=>'packing_slip_id'));
    //pd($processes);    
    }
    // lq();
    // if ($this->data['record']['product_name']=='GPC Out' && HOST=='ARF'){
    //   $where = array('out_purity >' => 0, 
    //                  'out_lot_purity >' => 0,
    //                  'balance_gpc_out !=' => 0,
    //                  'product_name' =>"KA Chain",
    //                  'finish_good' => 0);
    //   if (!empty($this->data['record']['chain_purity'])) $where['round(out_lot_purity,3)'] = $this->data['record']['chain_purity'];
    //     if (!empty($this->data['record']['customer_name'])){
    //       if($this->data['record']['customer_name']=='Market Issue'){
    //         $where['customer_name'] = '';
    //       }else{
    //         $where['customer_name'] = $this->data['record']['customer_name'];
    //       }
    //     } 
    //   $ka_chain_processes=$this->process_model->get($select,$where, array(), $group_by);
    //   $processes=array_merge($processes,$ka_chain_processes);
    // }
    return $processes;
  }

  private function get_chain_names() {
    $chain_name_dropdown = array();
    if ($this->data['record']['product_name']=='GPC Out' || 
        $this->data['record']['product_name']=='Finish Good' || 
        $this->data['record']['product_name']=='GPC Repair Out' || 
        $this->data['record']['product_name']=='GPC Loss Out') {
      $chain_names = array();
      if ($this->data['record']['product_name']=='GPC Out' || 
          $this->data['record']['product_name']=='GPC Repair Out' || 
          $this->data['record']['product_name']=='GPC Loss Out')
        $processes = $this->process_model->get('product_name, melting_lot_category_one, machine_size, 
                                                design_code, description', 
                                                array('balance_gpc_out >' => 0, 'finish_good' => 0),
                                                array(), array('order_by' => 'melting_lot_category_one, machine_size, design_code'));
      elseif ($this->data['record']['product_name']=='Finish Good')
        $processes = $this->process_model->get('product_name, melting_lot_category_one, machine_size, 
                                                design_code, description', 
                                               array('balance_gpc_out >' => 0, 'finish_good' => 1),
                                               array(), array('order_by' => 'melting_lot_category_one, machine_size, design_code'));
      foreach ($processes as $process) {
        if (HOST == 'ARF')
          if ($process['product_name'] == 'Fancy Chain')                $chain_name = 'Fancy Chain'; 
          elseif ($process['product_name'] == 'Refresh')                $chain_name = 'Refresh';
          elseif ($process['product_name'] == 'KA Chain Refresh')       $chain_name = 'KA Chain Refresh';
          elseif ($process['product_name'] == 'Finished Goods Receipt') $chain_name = $process['description'];
          elseif ($process['product_name'] == 'KA Chain')               $chain_name = $process['product_name'];
          elseif ($process['product_name'] == 'Ball Chain')             $chain_name = $process['product_name'];
          else   
            $chain_name = $process['melting_lot_category_one'].' '.$process['machine_size'].' '.$process['design_code'];
        else
          $chain_name = $process['product_name'];

        if (!in_array($chain_name, $chain_names))
        $chain_names[] = $chain_name;
      }

      foreach($chain_names as $chain_name)
        $chain_name_dropdown[] = array('id' => trim($chain_name), 'name' => trim($chain_name));
    }
    return $chain_name_dropdown;
  }
  // public function delete($id) {
    
  //     $issue_department_details=$this->issue_department_detail_model->get('',array('issue_department_id'=>$id));
  //     if(!empty($issue_department_details)){
  //       foreach ($variable as $key => $value) {
  //         $this->issue_department_detail_model->delete();
  //       }
  //     }
  //     parent::delete($id);
  //   }
  // }
  public function _after_delete($id){
    redirect(ADMIN_PATH.'issue_departments/issue_departments');
  }
  
}
