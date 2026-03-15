<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_fields extends BaseController {
  
  public function __construct(){
    parent::__construct();
    $this->load->model(array('processes/Process_model','settings/category_model','masters/process_detail_field_model','processes/process_factory_order_detail_model'));   //'fancy_chains/fancy_chain_chain_making_process_model'
  }

  public function create($id=''){

    $this->data['record']['process_factory_order_detail'] = isset($_GET['process_factory_order_detail']) ? $_GET['process_factory_order_detail'] : '';
    $this->data['record']['field_name'] = @$_GET['field_name'];

    $this->data['record']['process_id'] = $id;
    $process = $this->Process_model->find('product_name, process_name, department_name, tone, 
                                           melting_lot_category_one, melting_lot_category_two, melting_lot_category_three, 
                                           split_out_weight, balance, order_detail_id,in_lot_purity,melting_lot_id', array('id' => $this->data['record']['process_id']));
    $this->data['record']['product_name'] = $process['product_name'];
    $this->data['record']['process_name'] = $process['process_name'];
    $this->data['record']['department_name'] = $process['department_name'];
    $this->data['balance']=$process['balance'];

    if (!empty($this->data['record']['process_factory_order_detail'])) {
      $this->data['record']['in_lot_purity'] = $process['in_lot_purity'];
    }
    if (HOST=="ARC" && $this->data['record']['product_name'] == 'Arc Casting Process' && (   $this->data['record']['department_name'] == 'Casting')) {
      $this->load->model(array('arc_orders/generate_lot_model', 'arc_orders/generate_lot_detail_model', 'arc_orders/order_melting_lot_detail_model'));
      // $melting_lot_id = $this->Process_model->find('melting_lot_id', array('id' => $id,'product_name'=>'Arc Casting Process'))['melting_lot_id'];
      // $order_id = $this->melting_lot_model->find('order_id', array('id' => $melting_lot_id,'process_name'=>'Arc Casting'));
      // $melting_lot_id = $this->Process_model->find('melting_lot_id, in_lot_purity, tone', array('id' => $id,'product_name'=>'Arc Casting Process'));
      // $order_id = $this->melting_lot_model->find('order_id', array('id' => $melting_lot_id['melting_lot_id'], 'lot_purity' => $melting_lot_id['in_lot_purity'], 'tone' => $melting_lot_id['tone'], 'process_name'=>'Arc Casting'));

      // $order_id = (empty($order_id)) ? 0 : $order_id['order_id'];
      // $order_melting_lot_details=$this->order_melting_lot_detail_model->get('genarate_lot_id',array('order_melting_lot_id' => $order_id));
      // $genarate_lot_ids=array_column($order_melting_lot_details,'genarate_lot_id');
      // if(!empty($genarate_lot_ids)){
      // // $where_order_details=array('id in ('.implode(',', $genarate_lot_ids).')' =>NULL,'id not in (select order_detail_id from process_details  where process_id='.$id.')' => NULL);
      // $where_order_details=array('id in ('.implode(',', $genarate_lot_ids).')' =>NULL,'id not in (select order_detail_id from process_details  where process_id='.$id.')' => NULL, 'purity' => $melting_lot_id['in_lot_purity'], 'colour' => $melting_lot_id['tone']);
      // $this->data['order_details'] = $this->generate_lot_model->get('id, lot_no as name',
      //                                                                        $where_order_details);
      // }else{
      //   $this->data['order_details'] =array();
      // }
      
      $melting_lot_id = $this->Process_model->find('melting_lot_id, in_lot_purity, tone', array('id' => $id,'product_name'=>'Arc Casting Process'));
      $process_field_ids = $this->process_field_model->get('order_detail_id');
      //$order_melting_lot_details = $this->order_melting_lot_detail_model->get('genarate_lot_id');
      $generate_lot_ids = array_column($process_field_ids,'order_detail_id');

      if($melting_lot_id['in_lot_purity'] == "37.5000"){

        $where['where']['purity'] = $melting_lot_id['in_lot_purity'];
      }
      else {
        $where['where']['purity'] = number_format(round($melting_lot_id['in_lot_purity']), 4);
      }
      $where['where']['colour'] = $melting_lot_id['tone'];
      $where['where']['status'] = "In Investment";
      $where['where']['investment_date  > '] ="2023-05-15";


       if(!empty($generate_lot_ids))
         $where['where']['id not in ('.implode(',',$generate_lot_ids).')']=NULL;
      $this->data['order_details'] = $this->generate_lot_model->get('id, lot_no as name', $where);
      $this->data['all_order_details'] = $this->generate_lot_model->get('id, lot_no as name,category_one,next_process');
    // lq();
    }
    if (!empty($this->data['record']['process_factory_order_detail'])) {
      $ka_chain_order_detail = $this->ka_chain_order_detail_model->find('category_one, category_three, category_four, line',array('id' => $process['order_detail_id']));
      $ka_chain_factory_order_master = $this->ka_chain_factory_order_master_model->find('category_name, market_design_name,design_name,gauge,line',array('category_name'=> $ka_chain_order_detail['category_one'],
                                                         'gauge' => $ka_chain_order_detail['category_three'],
                                                         'design_name'  => $ka_chain_order_detail['category_four']));
      $this->data['ka_chain_factory_order_master'] =!empty($ka_chain_factory_order_master)?$ka_chain_factory_order_master:array();
    }
    
    if (!empty($this->data['record']['process_factory_order_detail']) && ($process['department_name'] == 'Hook'|| $process['department_name'] == 'Factory')) {
      if(($this->data['record']['field_name']=='customer_out')){
        $processes = $this->Process_model->find('melting_lot_id,order_detail_id', array('id' => $id,'product_name'=>'KA Chain'));
        $orders = $this->ka_chain_order_detail_model->find('', array('id' => $processes['order_detail_id']));
        $order_id = (empty($orders)) ? 0 : $orders['order_id'];
         // pd($order_id);
        $factory_order_details=$this->factory_order_detail_model->get('market_order_detail_id',array('order_id'=>$order_id));
        $market_order_detail_ids=array_column($factory_order_details,'market_order_detail_id');
        $factory_where['where']['market_order_details.status']="In Process";

        $ka_chain_order_detail = $this->ka_chain_order_detail_model->find('category_one, category_three, category_four, line',array('id' => $processes['order_detail_id']));
        if(!empty($market_order_detail_ids)){
          $factory_where['where']['market_order_details.id in ('.implode(',', $market_order_detail_ids).')']=NULL;
          $factory_where['where']['trim(market_order_details.category_name)']=trim($ka_chain_order_detail['category_one']);
          $factory_where['where']['trim(market_order_details.machine_size)']=trim($ka_chain_order_detail['category_three']);
          $factory_where['where']['trim(market_order_details.design_name)']=trim($ka_chain_order_detail['category_four']);
          $factory_where['where']['market_orders.market_order_status']="accepted";
        
        $this->data['factory_order_details']=$this->market_order_detail_model->get("market_order_details.*,market_orders.date as date,GROUP_CONCAT(DISTINCT(market_orders.customer_name)) as customer_name,market_orders.due_date as due_date,sum(total_weight) as total_weight,GROUP_CONCAT(round(inch_size)) as size,GROUP_CONCAT(round(inch_qty)) as qty,GROUP_CONCAT(market_order_details.id) as ids,market_orders.single_order as single_order",$factory_where,array(array('market_orders',  'market_orders.id=market_order_details.market_order_id')),array('group_by'=>"market_order_details.market_design_name,market_orders.customer_name"));
        }

        $this->data['customer_names']=array();
        if(!empty($this->data['factory_order_details'])){
          $customer_names = array_unique(array_column($this->data['factory_order_details'], 'customer_name'));
          foreach ($customer_names as $index => $customer_name) {
            $this->data['customer_names'][$index]['name'] = $customer_name;
            $this->data['customer_names'][$index]['id'] = $customer_name;
          }
        }
      
      }elseif($this->data['record']['field_name']=='bounch_out'){
        $this->data['bunch_order_details'] =array();
        $processes = $this->Process_model->find('melting_lot_id,order_detail_id', array('id' => $id,'product_name'=>'KA Chain'));
        $orders = $this->ka_chain_order_detail_model->find('', array('id' => $processes['order_detail_id']));
        //	pd($orders);
        $order_id = (empty($orders)) ? 0 : $orders['order_id'];
        $bunch_where['ka_chain_bunch_order_details.status']="In Process";
        $bunch_order_details=$this->bunch_order_detail_model->get('bunch_order_detail_id,order_id',array('order_id'=>$order_id));
        $bunch_order_detail_ids=array_column($bunch_order_details,'bunch_order_detail_id');
        if(!empty($bunch_order_detail_ids)){
          $bunch_where['ka_chain_bunch_order_details.id in ('.implode(',', $bunch_order_detail_ids).')']=NULL;
          $bunch_where['where']['trim(ka_chain_bunch_order_details.category_name)']=trim($orders['category_one']);
          $bunch_where['where']['trim(ka_chain_bunch_order_details.gauge)']=trim($orders['category_three']);
          $bunch_where['where']['trim(ka_chain_bunch_order_details.design_name)']=trim($orders['category_four']);
          $bunch_where['where']['market_orders.market_order_status']="accepted";
        
        $this->data['bunch_order_details'] = $this->ka_chain_bunch_order_detail_model->get('ka_chain_bunch_order_details.*,market_orders.date as date,market_orders.customer_name as customer_name,market_orders.due_date as due_date,market_orders.single_order as single_order',$bunch_where,array(array('market_orders',  'market_orders.id=ka_chain_bunch_order_details.ka_chain_factory_order_id')));
          foreach ($this->data['bunch_order_details'] as $bunch_order_index => $bunch_order_value) {
            $factory_order_master=$this->ka_chain_factory_order_master_model->find('',array('market_design_name'=>$bunch_order_value['market_design_name']));
            if(!empty($factory_order_master)){
              $this->data['bunch_order_details'][$bunch_order_index][]=$factory_order_master;
            }
          }
        }
        $this->data['customer_names']=array();
        $customer_names = array_unique(array_column($this->data['bunch_order_details'], 'customer_name'));
        foreach ($customer_names as $index => $customer_name) {
          $this->data['customer_names'][$index]['name'] = $customer_name;
          $this->data['customer_names'][$index]['id'] = $customer_name;
        }
      
      }elseif(($this->data['record']['field_name']=='out_weight' && $process['process_name'] == 'Factory Process' && $process['department_name'] == 'Factory')){
        $this->data['bunch_order_details'] =array();
        $processes = $this->Process_model->find('melting_lot_id,order_detail_id', array('id' => $id,'product_name'=>'KA Chain'));
        $orders = $this->ka_chain_order_detail_model->find('', array('id' => $processes['order_detail_id']));
        $order_id = (empty($orders)) ? 0 : $orders['order_id'];
        $bunch_where['ka_chain_bunch_order_details.status']="In Process";
        $bunch_order_details=$this->bunch_order_detail_model->get('bunch_order_detail_id,order_id',array('order_id'=>$order_id));
        $bunch_order_detail_ids=array_column($bunch_order_details,'bunch_order_detail_id');
        if(!empty($bunch_order_detail_ids)){
          $bunch_where['ka_chain_bunch_order_details.id in ('.implode(',', $bunch_order_detail_ids).')']=NULL;
       	 $bunch_where['where']['trim(ka_chain_bunch_order_details.category_name)']=trim($orders['category_one']);
          $bunch_where['where']['trim(ka_chain_bunch_order_details.gauge)']=trim($orders['category_three']);
          $bunch_where['where']['trim(ka_chain_bunch_order_details.design_name)']=trim($orders['category_four']);
          $bunch_where['where']['market_orders.market_order_status']="accepted";
        
  
      $this->data['bunch_order_details'] = $this->ka_chain_bunch_order_detail_model->get('ka_chain_bunch_order_details.*,market_orders.date as date,market_orders.customer_name as customer_name,market_orders.due_date as due_date,market_orders.single_order as single_order',$bunch_where,array(array('market_orders',  'market_orders.id=ka_chain_bunch_order_details.ka_chain_factory_order_id')));
          foreach ($this->data['bunch_order_details'] as $bunch_order_index => $bunch_order_value) {
            $factory_order_master=$this->ka_chain_factory_order_master_model->find('',array('market_design_name'=>$bunch_order_value['market_design_name']));
            if(!empty($factory_order_master)){
              $this->data['bunch_order_details'][$bunch_order_index][]=$factory_order_master;
            }
          }
        }
        $this->data['customer_names']=array();
        $customer_names = array_unique(array_column($this->data['bunch_order_details'], 'customer_name'));
        foreach ($customer_names as $index => $customer_name) {
          $this->data['customer_names'][$index]['name'] = $customer_name;
          $this->data['customer_names'][$index]['id'] = $customer_name;
        }

        $processes = $this->Process_model->find('melting_lot_id,order_detail_id', array('id' => $id,'product_name'=>'KA Chain'));
        $orders = $this->ka_chain_order_detail_model->find('', array('id' => $processes['order_detail_id']));
        $order_id = (empty($orders)) ? 0 : $orders['order_id'];
         // pd($order_id);
        $factory_order_details=$this->factory_order_detail_model->get('market_order_detail_id',array('order_id'=>$order_id));
        $market_order_detail_ids=array_column($factory_order_details,'market_order_detail_id');
        $factory_where['where']['market_order_details.status']="In Process";
        if(!empty($market_order_detail_ids)){
          $ka_chain_order_detail = $this->ka_chain_order_detail_model->find('category_one, category_three, category_four, line',array('id' => $processes['order_detail_id']));
         $factory_where['where']['market_order_details.id in ('.implode(',', $market_order_detail_ids).')']=NULL;
          $factory_where['where']['trim(market_order_details.category_name)']=trim($ka_chain_order_detail['category_one']);
          $factory_where['where']['trim(market_order_details.machine_size)']=trim($ka_chain_order_detail['category_three']);
          $factory_where['where']['trim(market_order_details.design_name)']=trim($ka_chain_order_detail['category_four']);
          $factory_where['where']['market_orders.market_order_status']="accepted";
        
        $this->data['factory_order_details']=$this->market_order_detail_model->get("market_order_details.*,market_orders.date as date,GROUP_CONCAT(DISTINCT(market_orders.customer_name)) as customer_name,market_orders.due_date as due_date,sum(total_weight) as total_weight,GROUP_CONCAT(round(inch_size)) as size,GROUP_CONCAT(round(inch_qty)) as qty,GROUP_CONCAT(market_order_details.id) as ids,market_orders.single_order as single_order",$factory_where,array(array('market_orders',  'market_orders.id=market_order_details.market_order_id')),array('group_by'=>"market_order_details.market_design_name,market_orders.customer_name"));
        }

        $this->data['customer_names']=array();
        if(!empty($this->data['factory_order_details'])){
          $customer_names = array_unique(array_column($this->data['factory_order_details'], 'customer_name'));
          foreach ($customer_names as $index => $customer_name) {
            $this->data['customer_names'][$index]['name'] = $customer_name;
            $this->data['customer_names'][$index]['id'] = $customer_name;
          }
        }
      
      }
     //  if($this->data['record']['field_name']=='customer_out'){
     //    $this->data['customer_names']=array();
     //    $customer_names = array_unique(array_column($this->data['factory_order_details'], 'customer_name'));
     //    foreach ($customer_names as $index => $customer_name) {
     //      $this->data['customer_names'][$index]['name'] = $customer_name;
     //      $this->data['customer_names'][$index]['id'] = $customer_name;
      
     //  }}else{
     //    $this->data['customer_names']=array();
     //    $customer_names = array_unique(array_column($this->data['bunch_order_details'], 'customer_name'));
     //    foreach ($customer_names as $index => $customer_name) {
     //      $this->data['customer_names'][$index]['name'] = $customer_name;
     //      $this->data['customer_names'][$index]['id'] = $customer_name;
      

     //  }
     // }
    }

    if (!empty($this->data['record']['process_factory_order_detail']) && $process['department_name'] == 'GPC') {
      $this->data['process_factory_order_details']=$this->process_factory_order_detail_model->get_gpc_process_factory_order_details($this->data['record']['process_id']);
    }

    if (!empty($this->data['record']['process_factory_order_detail']) && $process['department_name'] == 'Bunch GPC') {
      $this->data['process_bunch_order_details']=$this->process_factory_order_detail_model->get_bunch_gpc_process_factory_order_details($this->data['record']['process_id']);
    }
    
    $result = $this->process_detail_field_model->find('id',array('product_name'=>$this->data['record']['product_name'],'process_name'=>$this->data['record']['process_name'],
                                                      'department_name'=>$this->data['record']['department_name'],'field_name'=>$this->data['record']['field_name']));
    if(empty($result)) {
      $process_detail_field_obj = new Process_detail_field_model($this->data['record']);
      unset($process_detail_field_obj->attributes['process_id']);
      unset($process_detail_field_obj->attributes['process_factory_order_detail']);
      $process_detail_field_obj->save(false);
    }

    if (($this->data['record']['department_name'] == 'Spring' || strtolower($this->data['record']['department_name']) == 'casting')
        && $this->data['record']['field_name']      == 'out_weight')
      $this->data['record']['request_uri'] = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
    
    $this->data['record']['split_out_weight'] = $process['split_out_weight'];
    $this->data['process_fields_form_fields'] = json_decode(@$_GET['process_details_fields'], true);
   /* if(isset($_GET['type']) && $_GET['type'] == 1){
      $html = $this->load->view($this->router->module.'/'.$this->router->class.'/sub_form', $this->data, TRUE);
      echo json_encode(array('status' => 'success',
                        'open_modal'=> 0,
                        'js_function' => "append_add_more_html(".json_encode($html).",'".$_GET['field_name']."','".$_GET['field_class']."')")
                      );exit;
    }else{*/
    if ($this->data['record']['product_name'] == 'KA Chain' && (   $this->data['record']['department_name'] == 'Tarpatta'
                                                                || $this->data['record']['department_name'] == 'Chain Making')) {
      $this->load->model(array('ka_chains/ka_chain_order_detail_model', 'melting_lots/melting_lot_model'));
      $melting_lot_id = $this->Process_model->find('melting_lot_id', array('id' => $id,'product_name'=>'KA Chain'))['melting_lot_id'];
      $order_id = $this->melting_lot_model->find('order_id', array('id' => $melting_lot_id,'process_name'=>'KA Chain'));
      $order_id = (empty($order_id)) ? 0 : $order_id['order_id'];
      $this->data['order_details'] = $this->ka_chain_order_detail_model->get('id, concat(category_one, " ", category_two, "  (", category_three, ")  ", category_four, " - ", tarpatta_out_weight) as name',
                                                                             array('order_id' => $order_id,
                                                                                   'id not in (select order_detail_id from processes  where product_name="KA Chain")' => NULL,
                                                                                   'split_level' => 0));
      $this->data['all_order_details'] = $this->ka_chain_order_detail_model->get('id, concat(category_one, " ", category_two , "  (", category_three, ")  ", category_four, " - ", tarpatta_out_weight) as name',
                                                                             array('order_id' => $order_id));
    } elseif ($this->data['record']['product_name'] == 'Ball Chain' && $this->data['record']['department_name'] == 'Factory Hold I') {
      $this->load->model(array('ball_chains/ball_chain_order_detail_model', 'melting_lots/melting_lot_model'));
      $melting_lot_id = $this->Process_model->find('melting_lot_id', array('id' => $id,'product_name'=>'Ball Chain'))['melting_lot_id'];
      $order_id = $this->melting_lot_model->find('order_id', array('id' => $melting_lot_id,'process_name'=>'Ball Chain'));
      $order_id = (empty($order_id)) ? 0 : $order_id['order_id'];
      $this->data['order_details'] = $this->ball_chain_order_detail_model->get('id, concat(category_one, "  (", category_three, ")  ", category_four, "  (", tone, ") - ", cutting_process, " - ", level1_out_weight) as name',                                   array('order_id' => $order_id,'id not in (select order_detail_id from processes where product_name="Ball Chain")' => NULL,             'split_level' => 0));
      $this->data['all_order_details'] = $this->ball_chain_order_detail_model->get('id, concat(category_one, "  (", category_three, ")  ", category_four, "  (", tone, ") - ", cutting_process, " - ", level1_out_weight) as name',           array('order_id' => $order_id));
    } elseif ($this->data['record']['product_name'] == 'Ball Chain' && ($this->data['record']['department_name'] == 'Factory Hold Plain' || $this->data['record']['department_name'] == 'Factory Hold Two Tone')) {
      $this->load->model(array('ball_chains/ball_chain_order_detail_model', 'melting_lots/melting_lot_model'));
      $melting_lot_id = $this->Process_model->find('melting_lot_id', array('id' => $id,'product_name'=>'Ball Chain'))['melting_lot_id'];
      $order_id = $this->melting_lot_model->find('order_id', array('id' => $melting_lot_id,'process_name'=>'Ball Chain'));
      $order_id = (empty($order_id)) ? 0 : $order_id['order_id'];
      $order_detail_id = $this->Process_model->find('order_detail_id', array('id' => $this->data['record']['process_id']))['order_detail_id'];
      $this->data['order_details'] = $this->ball_chain_order_detail_model->get('id, concat(category_one, "  (", category_three, ")  ", category_four, " - ", weight) as name',
                                                                             array('order_id' => $order_id,
                                                                                   'parent_id' => $order_detail_id,
                                                                                   'id not in (select order_detail_id from processes where product_name="Ball Chain")' => NULL,
                                                                                   'split_level' => 1));
      $this->data['all_order_details'] = $this->ball_chain_order_detail_model->get('id, concat(category_one, "  (", category_three, ")  ", category_four, " - ", weight) as name',
                                                                             array('order_id' => $order_id));
    }
    if ($this->data['record']['product_name'] == 'Sisma Chain' && $this->data['record']['department_name'] == 'Sisma Machine') {
      $process = $this->process_model->find('melting_lot_id', array('id' => $this->data['record']['process_id']));
      $orders = $this->melting_lot_model->find('order_id', array('id' => $process['melting_lot_id']));
      $order_id = (empty($orders)) ? 0 : $orders['order_id'];
      $this->data['all_design_code_types'] = $this->sisma_chain_order_model->get_orders_description($order_id,1,$process['melting_lot_id']);

    }
    if ($this->data['record']['product_name'] == 'KA Chain' && $this->data['record']['department_name'] == 'Factory Hold') {
      $this->load->model(array('ka_chains/ka_chain_order_detail_model','ka_chains/ka_chain_order_model'));

      $order_detail_id = $this->Process_model->find('order_detail_id', array('id' => $this->data['record']['process_id'],'product_name'=>'KA Chain'))['order_detail_id'];

      if($process['melting_lot_category_one']=="Dhoom Chain"){
        $order_id =$this->ka_chain_order_model->find('id', array('melting_lot_id' => $process['melting_lot_id']))['id'];
        $this->data['order_details'] = $this->ka_chain_order_detail_model->get('id, concat(chain_name, " - ", weight) as name', 
                                                                                array('split_level' => 1,
                                                                                      'order_id'=>$order_id,
                                                                                      'id not in (select order_detail_id from processes where product_name = "KA Chain" and process_name not in ("Factory Hold Process", 
                                                                                        "Anchor Process","Box Chain Process"))' => NULL));
        // pd($this->data['order_details']);
        $this->data['all_order_details'] = $this->ka_chain_order_detail_model->get('id, concat(category_one, "  (", category_three, ")  ",chain_name, " - ", weight) as name', array('order_id' => $order_id));
       
    }


      
      if (!empty($order_detail_id) && $process['melting_lot_category_one']!="Dhoom Chain") {
        $order_id = $this->ka_chain_order_detail_model->find('order_id', array('id' => $order_detail_id));
        $this->data['order_details'] = $this->ka_chain_order_detail_model->get('id, concat(chain_name, " - ", weight) as name', 
                                                                                array('split_level' => 1,
                                                                                      'parent_id' => $order_detail_id,
                                                                                      'id not in (select order_detail_id from processes where product_name = "KA Chain" and process_name not in ("Factory Hold Process", 
                                                                                        "Anchor Process","Box Chain Process"))' => NULL));
        $this->data['all_order_details'] = $this->ka_chain_order_detail_model->get('id, concat(category_one, "  (", category_three, ")  ",chain_name, " - ", weight) as name', 
                                                                                   array('order_id' => $order_id));
        $this->data['next_department_names'] = array(array('id' => '', 'name' => ''));
      }
    }

    if ($this->data['record']['product_name'] == 'KA Chain' && (   $this->data['record']['department_name'] == 'Laser'
                                                                || $this->data['record']['department_name'] == 'Ashish'
                                                                || $this->data['record']['department_name'] == 'Vishnu'
                                                                || $this->data['record']['department_name'] == 'Hammering I'
                                                                || $this->data['record']['department_name'] == 'Clipping')) {
      $this->load->model(array('ka_chains/ka_chain_order_detail_model'));
      $order_detail_id = $this->Process_model->find('order_detail_id', array('id' => $this->data['record']['process_id'],'product_name'=>'KA Chain'))['order_detail_id'];
      if (!empty($order_detail_id)) {
        $ka_chain_order_detail = $this->ka_chain_order_detail_model->find('order_id, chain_name', array('id' => $order_detail_id));
        $this->data['order_details'] = $this->ka_chain_order_detail_model->get('id, concat(category_four, " - ", weight) as name', array('parent_id'       => $order_detail_id,                                                                                 'id not in (select process_details.order_detail_id from process_details 
                                                                                                        inner join processes on processes.id = process_details.process_id 
                                                                                                        where processes.product_name = "KA CHain")' => NULL,
                                                                                            'split_level'    => 2));
        $this->data['all_order_details'] = $this->ka_chain_order_detail_model->get('id, concat(category_four, " - ", weight) as name', array('order_id' => $ka_chain_order_detail['order_id']));
      }
    }

    if ($this->data['record']['product_name'] == 'KA Chain' && $this->data['record']['department_name'] == 'Stripping') {
      $this->load->model(array('ka_chains/ka_chain_order_detail_model'));
      $order_detail_id = $this->Process_model->find('order_detail_id', array('id' => $this->data['record']['process_id'],'product_name'=>'KA Chain'))['order_detail_id'];
      if (!empty($order_detail_id)) {
        $ka_chain_order_detail = $this->ka_chain_order_detail_model->find('order_id, chain_name', array('id' => $order_detail_id));
        $this->data['order_details'] = $this->ka_chain_order_detail_model->get('id, concat(category_four, " - " , tone, " - ", weight) as name', array('parent_id'       => $order_detail_id,                                                                                 'id not in (select order_detail_id from process_details)' => NULL,'split_level'    => 3));
        $this->data['all_order_details'] = $this->ka_chain_order_detail_model->get('id, concat(category_four, " - " , tone, " - ", weight) as name', array('order_id' => $ka_chain_order_detail['order_id']));
      }
    }

    // if ($this->data['record']['product_name'] == 'Ball Chain' && $this->data['record']['department_name'] == 'Factory Hold I') {
    //   $this->load->model(array('ball_chains/ball_chain_order_detail_model', 'melting_lots/melting_lot_model'));
    //   $melting_lot_id = $this->Process_model->find('melting_lot_id', array('id' => $id))['melting_lot_id'];
    //   $order_id = $this->melting_lot_model->find('order_id', array('id' => $melting_lot_id));
    //   $order_id = (empty($order_id)) ? 0 : $order_id['order_id'];
    //   $this->data['order_details'] = $this->ball_chain_order_detail_model->get('id, concat("ORD-", id) as name',
    //                                                                          array('order_id' => $order_id,
    //                                                                                'id not in (select order_detail_id from processes where product_name="Ball Chain")' => NULL));

    //   $this->data['all_order_details'] = $this->ball_chain_order_detail_model->get('id, concat("ORD-", id) as name',
    //                                                                          array('order_id' => $order_id));
    // } 

    if (   $this->data['record']['product_name'] == 'Office Outside' 
        && (   ($this->data['record']['process_name'] == 'Pipe and Para Hand Cutting Process'         && $this->data['record']['department_name'] == 'Hand Cutting')
            || ($this->data['record']['process_name'] == 'Pipe and Para Round and Ball Chain Process' && $this->data['record']['department_name'] == 'Round and Ball Chain'))){
      $process_tone = $process['tone'];
      if ($process_tone == '2 Tone')
        $this->data['next_department_names'] = array(array('id'   => 'Stripping', 'name' => 'Stripping')); 
    }
    $this->data['category_ones'] = $this->category_model->get('distinct(category_one) as name,(category_one) as id'); 
    $this->data['category_twos'] = $this->category_model->get('distinct(category_two) as name,(category_two) as id'); 
    parent::create();
    //}
  }

  public function _get_form_data() {
    if (!empty(validation_errors())) {
      $this->data['open_modal'] = false;
      $this->data['ajax_failure_function'] = "toastr_errors(response)";
    }

    if ($this->router->method == 'store' || $this->router->method == 'update') {
      $this->data['record']['process_id'] = @$_POST['process_fields']['process_id'];
      $this->data['record']['field_name'] = @$_POST['field_name'];
      $this->data['record']['product_name'] = @$_POST['product_name'];
      $this->data['record']['process_name'] = @$_POST['process_name'];
    }
    $this->data['process_fields'] = $this->process_field_model->get('',
                                      array('process_id' => $this->data['record']['process_id'],
                                            ''.$this->data['record']['field_name'].'!=' => NULL,
                                            ''.$this->data['record']['field_name'].'!=' => 0,));
  }

  public function _get_view_data() {
    $this->data['process_field'] = $this->process_field_model->get('',
                                      array('process_id' => $this->data['record']['process_id'],
                                            ''.$this->data['record']['field_name'].'!=' => NULL,
                                            ''.$this->data['record']['field_name'].'>' => 0));
  }

  public function get_ajax_success_data($model_obj, $action) {
    $data['current_process'] = $this->Process_model->find('', array('id' => $model_obj->attributes['process_id']));
    $data['previous_process'] = $this->Process_model->find('', array('id' => $model_obj->attributes['processes']['previous_process_id']));
    $data['current_process'] = $this->Process_model->find('', array('id' => $model_obj->attributes['process_id']));
    $data['previous_process'] = $this->Process_model->find('', array('id' => $model_obj->attributes['processes']['previous_process_id']));
    $data['current_process']['previous_process_update'] = $model_obj->attributes['processes']['previous_process_update'];
    $data['current_process']['parent_id'] = $model_obj->attributes['processes']['previous_process_id'];
    $data['current_process']['field_name'] = $model_obj->attributes['processes']['field_name'];
    $data['current_process']['weight'] = @$data['current_process'][$model_obj->attributes['processes']['field_name']];
    $data['current_process']['process_field_id'] = $model_obj->attributes['id'];  
    return $data; 
  }

  public function _after_save($formdata, $action) {
    $this->data['ajax_success_function'] = "set_process_field_value(response)";
    return $formdata;
  }

  public function get_ajax_delete_data($record) {
    $data['current_process'] = $this->Process_model->find('', array('id' => $record['process_id']));
    $data['current_process']['field_name'] = $_GET['field_name'];
    $data['current_process']['weight'] = $data['current_process'][$_GET['field_name']];
    $data['current_process']['process_field_id'] = $record['id'];  
    return $data; 
  }

  public function _after_delete($id) {
    $this->data['ajax_delete_success_function'] = 'set_process_field_value_after_delete(response)';
  }

  private function is_ajax_request() {
    $is_ajax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    return $is_ajax;
  }

}
