<?php 
class Process_field_model extends BaseModel{
  protected $table_name= 'process_details';
  public $router_class = 'process_fields';
  
  public function __construct($data = array()){
    parent::__construct($data);
    if (!$this->load->is_model_loaded('Process_model'))
      $this->load->model(array('processes/Process_model'));
    if (!isset($this->attributes['hook_in']) || empty($this->attributes['hook_in'])) $this->attributes['hook_in'] = 0;
    if (!isset($this->attributes['hook_out']) || empty($this->attributes['hook_out'])) $this->attributes['hook_out'] = 0;
    if (!isset($this->attributes['daily_drawer_in_weight']) || empty($this->attributes['daily_drawer_in_weight'])) $this->attributes['daily_drawer_in_weight'] = 0;
    $this->load->model(array( 'melting_lots/melting_lot_model'));

  }

  public function before_validate() {
    if(!empty($this->attributes['factory_order_weight'])){
      unset($this->attributes['factory_order_weight']);
    }
   
    $process = $this->Process_model->find('', array('id' => $this->attributes['process_id']));


    if($process['product_name'] == 'Office Outside'){
      $this->attributes['daily_drawer_type']=$process['process_name'];
    }if($process['product_name'] == 'Sisma Accessories Making Chain'){
      $this->attributes['daily_drawer_type']=$process['process_name'];
    }
    if ($process['product_name'] == 'Sisma Chain' && $process['process_name'] == 'RND Process'  && (   $process['department_name'] == 'Hand Cutting' || $process['department_name'] == 'Hand Dull' || $process['department_name'] == 'Buffing' || $process['department_name'] == 'Filing')) {
      $parent_process = $this->Process_model->find('', array('id' => $process['parent_id']));
      $this->attributes[$this->formdata['field_name']] = $this->check_previous_process_balance($parent_process);
    }

   

    if ($process['product_name']=='KA Chain' && $process['department_name']=='Factory Hold'  && $this->attributes['out_weight'] > 0) {
      if (isset($this->attributes['order_detail_id'])) {
        $ka_chain_order_detail = $this->ka_chain_order_detail_model->find('chain_name, tarpatta_order_detail_id', array('id' => $this->attributes['order_detail_id']));
        if (!empty($ka_chain_order_detail)) {
          $this->attributes['next_department_name'] = $ka_chain_order_detail['chain_name'];
        }
      }
    }

    if ($process['product_name']=='Ball Chain'  && (   $process['department_name'] == 'Factory Hold I'
                                                    || $process['department_name'] == 'Factory Hold Plain')  && $this->attributes['out_weight'] > 0) {
      $ball_chain_order_detail = $this->ball_chain_order_detail_model->find('cutting_process, category_four', array('id' => $this->attributes['order_detail_id']));
      if (!empty($ball_chain_order_detail)) {
        $this->attributes['next_department_name'] = $ball_chain_order_detail['cutting_process']; 
        $this->attributes['design_code'] = $ball_chain_order_detail['category_four'];
      }
    }
  }

  public function before_save($action) {
    if (isset($this->attributes['process_id'])) {
      $process = $this->Process_model->find('', array('id' => $this->attributes['process_id']));
      if (!empty($process)) {
        $this->attributes['melting_lot_id'] = $process['melting_lot_id'];
        $this->attributes['lot_no'] = $process['lot_no'];
        $this->attributes['parent_lot_id'] = $process['parent_lot_id'];
        $this->attributes['parent_lot_name'] = $process['parent_lot_name'];
        $this->attributes['chain_name'] = $process['chain_name'];
      }
    } else 
      parent::before_save($action);
  }

  public function save($after_save=true) {
    if (@$this->formdata['field_name'] == 'tounch_in') {
      $process_field = $this->find('', array('process_id' => $this->attributes['process_id']));
      if (empty($process_field)) {
        $this->store($after_save);
      } else {
        $this->attributes['id'] = $process_field['id'];
        $this->update($after_save);
      }
    } else {
      parent::save($after_save);
    }
  }

  public function check_previous_process_balance($parent_process) {
    if ($parent_process['balance'] < $this->attributes[$this->formdata['field_name']])
      return $this->attributes[$this->formdata['field_name']] = 0; 
    else 
      return $this->attributes[$this->formdata['field_name']];
  }

  public function after_save($action) {
    
    
    $process = $this->Process_model->find('', array('id' => $this->attributes['process_id']));
    $melting_lot_detail=$this->melting_lot_model->find('',array('id'=>$process['melting_lot_id']));
    // pd($melting_lot_detail);
      if($process['product_name']=="Sisma Chain" && $process['process_name']=="Final Process"&& $process['department_name']=="GPC" && $this->attributes['gpc_out']){
        $send_data['melting_lot_orders'] = array(
                'id' => $melting_lot_detail['order_id'],
                'melting_lot_id' => $melting_lot_detail['id'],
                'status' => "Confirmed",);
        $send_data['api']=1;
        $send_data['design_name']=$process['design_code'];
        $api_url=API_BOM_PATH."/api/api_orders/update_melting_lot_order_status/".$melting_lot_detail['order_id'];
        $result=curl_post_request($api_url, $send_data);
      }

      if($process['product_name']=="Choco Chain" && $process['process_name']=="Final Process"&& $process['department_name']=="GPC Or Rodium" && $this->attributes['gpc_out']){
        $send_data['orders'] = array(
          'id' => $melting_lot_detail['order_id'],
          // 'melting_lot_id' => $this->attributes['id'],
          'design_name' => $melting_lot_detail['digital_catalog_design_code'],
          'status' => "Confirmed"
        );
        $send_data['api']=1;
        $api_url=API_BOM_PATH."/api/api_orders/update_order_status_design/".$melting_lot_detail['order_id'];
        $result=curl_post_request($api_url, $send_data);
      }

      if($process['product_name']=="Indo tally Chain" && $process['process_name']=="Final Process"&& $process['department_name']=="GPC" && $this->attributes['gpc_out']){
        $send_data['orders'] = array(
          'id' => $melting_lot_detail['order_id'],
          'melting_lot_id' => $melting_lot_detail['id'],
          // 'design_name' => $this->attributes['digital_catalog_design_code'],
          'status' => "Confirmed"
        );
        $send_data['api'] = 1;
        $api_url=API_BOM_PATH."/api/api_orders/update_order_status/".$melting_lot_detail['order_id'];
        $result=curl_post_request($api_url, $send_data);
      }

      if($process['product_name']=="Imp Italy Chain" && $process['process_name']=="Final Process"&& $process['department_name']=="GPC Or Rodium" && $this->attributes['gpc_out']){
        $send_data['orders'] = array(
          'id' => $melting_lot_detail['order_id'],
          'melting_lot_id' => $melting_lot_detail['id'],
          // 'design_name' => $this->attributes['digital_catalog_design_code'],
          'status' => "Confirmed"
        );
        $send_data['api'] = 1;
        $api_url=API_BOM_PATH."/api/api_orders/update_order_status/".$melting_lot_detail['order_id'];
        $result=curl_post_request($api_url, $send_data);
      }

      if($process['product_name']=="Hollow Choco Chain" && $process['process_name']=="Final Process"&& $process['department_name']=="GPC Or Rodium" && $this->attributes['gpc_out']){
        $send_data['orders'] = array(
          'id' => $melting_lot_detail['order_id'],
          'melting_lot_id' => $melting_lot_detail['id'],
          // 'design_name' => $this->attributes['digital_catalog_design_code'],
          'status' => "Confirmed"
        );
        $send_data['api'] = 1;
        $api_url=API_BOM_PATH."/api/api_orders/update_order_status/".$melting_lot_detail['order_id'];
        $result=curl_post_request($api_url, $send_data);
      }

      if($process['product_name']=="Lotus Chain" && $process['process_name']=="Final Process"&& $process['department_name']=="GPC Or Rodium" && $this->attributes['gpc_out']){
        $design_details = explode("-",$process['design_code']);
        $send_data['orders'] = array(
                'id' => $melting_lot_detail['order_id'],
                'melting_lot_id' => $melting_lot_detail['id'],
                'status' => "Confirmed");
        $send_data['orders']['design_code'] = $design_details[0] ?? '';
        $send_data['orders']['design_name'] = $design_details[1] ?? '';
        $send_data['api']=1;
        $api_url=API_BOM_PATH."/api/api_orders/update_order_status_design_details/".$melting_lot_detail['order_id'];
        $result=curl_post_request($api_url, $send_data);
      }
      
      if($process['product_name']=="Rope Chain" && $process['process_name']=="Final GPC Process" && $process['department_name']=="GPC" && $this->attributes['gpc_out']){
        $this->load->model(array("rope_chains/market_order_model","rope_chains/market_order_design_detail_model","rope_chains/market_order_detail_model"));
        $market_order_details = $this->market_order_detail_model->get('market_orders.order_no,market_order_details.id,market_order_details.item_code',array("market_order_id" => $melting_lot_detail['order_id']),array(array("market_orders","market_orders.id = market_order_details.market_order_id")));

        foreach ($market_order_details as $index => $order_detail) {
          $market_order_detail_obj = new market_order_detail_model(['id' => $order_detail['id']]);
          $market_order_detail_obj->attributes['status'] = "Confirmed";
          $market_order_detail_obj->update(false);

          $send_data = array(
            'order_id' => $order_detail['order_no'],
            'item_code' => $order_detail['item_code'],
            'status' => "Confirmed"
          );
          $api_url = "https://arc-catalog.frappe.cloud/api/method/digitalcatalog_api_erpnext.api.order.update_order_status";
          $result=curl_post_request($api_url, $send_data);
        }
      }

      if($process['product_name']=="Round Box Chain" && $process['process_name']=="Final GPC Process" && $process['department_name']=="GPC" && $this->attributes['gpc_out']){
        $this->load->model(array("round_box_chains/market_order_model","round_box_chains/market_order_design_detail_model","round_box_chains/market_order_detail_model"));
        $market_order_details = $this->market_order_detail_model->get('market_orders.order_no,market_order_details.id,market_order_details.item_code',array("market_order_id" => $melting_lot_detail['order_id']),array(array("market_orders","market_orders.id = market_order_details.market_order_id")));

        foreach ($market_order_details as $index => $order_detail) {
          $market_order_detail_obj = new market_order_detail_model(['id' => $order_detail['id']]);
          $market_order_detail_obj->attributes['status'] = "Confirmed";
          $market_order_detail_obj->update(false);

          $send_data = array(
            'order_id' => $order_detail['order_no'],
            'item_code' => $order_detail['item_code'],
            'status' => "Confirmed"
          );
          $api_url = "https://arc-catalog.frappe.cloud/api/method/digitalcatalog_api_erpnext.api.order.update_order_status";
          $result=curl_post_request($api_url, $send_data);
        }
      }

      if($process['product_name']=="Machine Chain" && $process['process_name']=="Final GPC Process" && $process['department_name']=="GPC" && $this->attributes['gpc_out']){
        $this->load->model(array("machine_chains/market_order_model","machine_chains/market_order_design_detail_model","machine_chains/market_order_detail_model"));
        $market_order_details = $this->market_order_detail_model->get('market_orders.order_no,market_order_details.id,market_order_details.item_code',array("market_order_id" => $melting_lot_detail['order_id']),array(array("market_orders","market_orders.id = market_order_details.market_order_id")));

        foreach ($market_order_details as $index => $order_detail) {
          $market_order_detail_obj = new market_order_detail_model(['id' => $order_detail['id']]);
          $market_order_detail_obj->attributes['status'] = "Confirmed";
          $market_order_detail_obj->update(false);

          $send_data = array(
            'order_id' => $order_detail['order_no'],
            'item_code' => $order_detail['item_code'],
            'status' => "Confirmed"
          );
          $api_url = "https://arc-catalog.frappe.cloud/api/method/digitalcatalog_api_erpnext.api.order.update_order_status";
          $result=curl_post_request($api_url, $send_data);
        }
      }
      

      if(!empty($this->formdata['factory_order_details'])){
      foreach ($this->formdata['factory_order_details'] as $index => $value) {
        $order_detail=array();
        $order_ids=explode(',', $value['order_ids']);
        foreach ($order_ids as $order_index => $order_id) {
          $market_order_detail['id']=$order_id;
          $market_order_detail['status']="Ready";
          $market_order_detail['process_id']=$this->attributes['process_id'];
          $market_order_obj = new market_order_detail_model($market_order_detail);
          $market_order_obj->update(true);
        }
      }
    }
    if(!empty($this->formdata['bunch_order_details'])){
      foreach ($this->formdata['bunch_order_details'] as $index => $value) {
        $bunch_order_detail=array();
        $order_id=$value['order_ids'];
          $bunch_detail['id']=$order_id;
          $bunch_detail['status']="Ready";
          $bunch_detail['process_id']=$this->attributes['process_id'];
          $bunch_obj = new ka_chain_bunch_order_detail_model($bunch_detail);
          $bunch_obj->update(false);
      }
    }
    
    $this->attributes['processes']['previous_process_update'] = false;
    $this->attributes['processes']['previous_process_id'] = $process['parent_id'];
    if ($process['product_name'] == 'Fancy Chain' && ($process['process_name'] == 'Chain Making Process' )  && $process['department_name'] == 'Chain Making'  && (isset($this->attributes['out_weight'])                                                                            && $this->attributes['out_weight'] > 0)) {
      $this->load->model('fancy_chains/fancy_chain_chain_making_process_model');
      $this->fancy_chain_chain_making_process_model->create_final_department_record($process, $this->attributes);
    }
    if ($process['product_name'] == 'Hallmark'   && $process['process_name'] == 'Fire Assay Process' && $process['department_name'] == 'Fire Assay' &&(!empty($this->attributes['gpc_out'])) && ($this->attributes['gpc_out'] != 0)) {
      $this->load->model('hallmarking/fire_assay_process_model');
      $this->fire_assay_process_model->create_fire_assay_out_record($process, $this->attributes);
    }
    if ($process['product_name'] == 'Hallmark'   && $process['process_name'] == 'HUID Process' &&(!empty($this->attributes['factory_out'])) && ($this->attributes['factory_out'] != 0)) {
      $this->load->model('hallmarking/huid_process_model');
      $this->huid_process_model->create_factory_out_record($process, $this->attributes);
    }
    if ($process['product_name'] == 'Fancy 75 Chain'               && ($process['process_name'] == 'Chain Making Process' )  && $process['department_name'] == 'Chain Making'  && (isset($this->attributes['out_weight'])                                                                            && $this->attributes['out_weight'] > 0)) {
      $this->load->model('fancy_seventy_chains/fancy_seventy_chain_chain_making_process_model');
      $this->fancy_seventy_chain_chain_making_process_model->create_final_department_record($process, $this->attributes);
    }
    if ($process['product_name'] == 'Fancy 75 RND'               && ($process['process_name'] == 'Chain Making Process' )  && $process['department_name'] == 'Chain Making'  && (isset($this->attributes['out_weight'])                                                                            && $this->attributes['out_weight'] > 0)) {
        $this->load->model('fancy_seventy_five_rnd_chains/fancy_seventy_five_rnd_chain_chain_making_process_model');
        $this->fancy_seventy_five_rnd_chain_chain_making_process_model->create_final_department_record($process, $this->attributes);
      }
    if ($process['product_name'] == 'Fancy Chain' && $process['process_name'] == 'Chain Making Process'   && $process['department_name'] == 'Chain Making'  && (!empty($this->attributes['customer_out'])&&$this->attributes['customer_out']!=0)){
      
      $this->load->model('fancy_chains/fancy_chain_chain_making_process_model');
      $this->fancy_chain_chain_making_process_model->create_customer_order_process_record($process, $this->attributes);
    }elseif ($process['product_name'] == 'Refresh' && $process['process_name'] == 'Hook Refresh Process'   && $process['department_name'] == 'Hook'  && (!empty($this->attributes['customer_out'])&&$this->attributes['customer_out']!=0)){
      
      $this->load->model('refresh/Refresh_hook_refresh_process_model');
      $this->Refresh_hook_refresh_process_model->create_customer_order_process_record($process, $this->attributes);
    }elseif ($process['product_name'] == 'Fancy Chain' && $process['process_name'] == 'Chain Making Process'   && $process['department_name'] == 'Chain Making'  && isset($this->attributes['bounch_out'])){
      
      $this->load->model('fancy_chains/fancy_chain_chain_making_process_model');
      $this->fancy_chain_chain_making_process_model->create_chain_making_process_record($process, $this->attributes);
    }elseif ($process['product_name'] == 'Ball Chain' && $process['process_name'] == 'Factory Hold II Process'   && $process['department_name'] == 'Factory Hold II'  && isset($this->attributes['out_weight'])){
      $this->load->model('ball_chains/ball_chain_factory_hold_ii_process_model');
      $this->ball_chain_factory_hold_ii_process_model->create_next_hook_process_record($process, $this->attributes);
    }elseif ($process['product_name'] == 'Fancy 75 Chain' && $process['process_name'] == 'Chain Making Process'   && $process['department_name'] == 'Chain Making'  && isset($this->attributes['bounch_out'])){
      
      $this->load->model('fancy_seventy_chains/fancy_seventy_chain_chain_making_process_model');
      $this->fancy_seventy_chain_chain_making_process_model->create_chain_making_process_record($process, $this->attributes);
    }elseif ($process['product_name'] == 'Fancy 75 RND' && $process['process_name'] == 'Chain Making Process'   && $process['department_name'] == 'Chain Making'  && isset($this->attributes['bounch_out'])){
      
        $this->load->model('fancy_seventy_five_rnd_chains/fancy_seventy_five_rnd_chain_chain_making_process_model');
        $this->fancy_seventy_five_rnd_chain_chain_making_process_model->create_chain_making_process_record($process, $this->attributes);
      }elseif ($process['product_name'] == 'KA Chain' && $process['process_name'] == 'Hook Process'   && $process['department_name'] == 'Hook'  && isset($this->attributes['bounch_out'])){
      
      $this->load->model('ka_chains/ka_chain_hook_process_model');
      $this->ka_chain_hook_process_model->create_customer_bunch_order_process_record($process, $this->attributes);
    }elseif ($process['product_name'] == 'Ball Chain' && $process['process_name'] == 'Factory Hold II Process'   && $process['department_name'] == 'Factory Hold II'  && isset($this->attributes['out_weight'])){
      $this->load->model('ball_chains/ball_chain_factory_hold_ii_process_model');
      $this->ball_chain_factory_hold_ii_process_model->create_next_hook_process_record($process, $this->attributes);
    }/*elseif ($process['product_name'] == 'KA Chain' && $process['process_name'] == 'Hook Process'   && $process['department_name'] == 'Buffing'  && isset($this->attributes['factory_out'])){
      $this->load->model('ka_chains/ka_chain_hook_process_model');
      $this->ka_chain_hook_process_model->create_hallmarking_process_record($process, $this->attributes);
    }elseif ($process['product_name'] == 'KA Chain' && $process['process_name'] == 'Customer Order Process'   && $process['department_name'] == 'Buffing'  && isset($this->attributes['factory_out'])){
      $this->load->model('ka_chains/ka_chain_customer_order_process_model');
      $this->ka_chain_customer_order_process_model->create_hallmarking_process_record($process, $this->attributes);
    }elseif ($process['product_name'] == 'Ball Chain' && $process['process_name'] == 'Hook Plain Process'   && $process['department_name'] == 'Buffing'  && isset($this->attributes['factory_out'])){
      $this->load->model('ball_chains/ball_chain_hook_plain_process_model');
      $this->ball_chain_hook_plain_process_model->create_hallmarking_process_record($process, $this->attributes);
    }elseif ($process['product_name'] == 'Fancy Chain' && $process['process_name'] == 'Buffing Process'   && $process['department_name'] == 'Buffing'  && isset($this->attributes['factory_out'])){
      $this->load->model('fancy_chains/fancy_chain_buffing_process_model');
      $this->fancy_chain_buffing_process_model->create_hallmarking_process_record($process, $this->attributes);
    }elseif ($process['product_name'] == 'Fancy Chain' && $process['process_name'] == 'Final Process'   && $process['department_name'] == 'Buffing I'  && isset($this->attributes['factory_out'])){
      $this->load->model('fancy_chains/fancy_chain_final_process_model');
      $this->fancy_chain_final_process_model->create_hallmarking_process_record($process, $this->attributes);
    }elseif ($process['product_name'] == 'Fancy 75 Chain' && $process['process_name'] == 'Buffing Process'   && $process['department_name'] == 'Buffing'  && isset($this->attributes['factory_out'])){
      $this->load->model('fancy_seventy_chains/fancy_seventy_chain_buffing_process_model');
      $this->fancy_seventy_chain_buffing_process_model->create_hallmarking_process_record($process, $this->attributes);
    }elseif ($process['product_name'] == 'Fancy 75 Chain' && $process['process_name'] == 'Final Process'   && $process['department_name'] == 'Buffing I'  && isset($this->attributes['factory_out'])){
      $this->load->model('fancy_seventy_chains/fancy_seventy_chain_final_process_model');
      $this->fancy_seventy_chain_final_process_model->create_hallmarking_process_record($process, $this->attributes);
    }*/elseif ($process['product_name'] == 'KA Chain' && ($process['process_name'] == 'Hook Process'|| $process['process_name'] == 'Hook 75 Process' )  && ($process['department_name'] == 'Hook' || $process['department_name'] == 'Lobster' )  && isset($this->attributes['customer_out'])){
      
      $this->load->model('ka_chains/ka_chain_hook_process_model');
      $this->ka_chain_hook_process_model->create_customer_order_process_record($process, $this->attributes);

    }elseif ($process['product_name'] == 'Ball Chain' && ($process['process_name'] == 'Hook Plain Process' || $process['process_name'] == 'Hook 92 Plain Process' ) && ($process['department_name'] == 'Lobster' || $process['department_name']=="Hook")  && isset($this->attributes['customer_out'])){
      $this->load->model('ball_chains/Ball_chain_hook_plain_process_model');
      $this->Ball_chain_hook_plain_process_model->create_customer_order_process_record($process, $this->attributes);
    }elseif ($process['product_name'] == 'Ball Chain' && $process['process_name'] == 'Factory Hold II Process'   && $process['department_name'] == 'Factory Hold II'  && isset($this->attributes['recutting_out'])){
      $this->load->model('ball_chains/Ball_chain_factory_hold_ii_process_model');
      $this->Ball_chain_factory_hold_ii_process_model->create_fancy_out_record($process, $this->attributes);
    }elseif ($process['product_name'] == 'Fancy Chain' && $process['process_name'] == 'Fancy Hold Process'   && $process['department_name'] == 'Fancy Hold'  && !empty($this->attributes['out_weight'])){
      
      $this->load->model('fancy_chains/fancy_chain_fancy_hold_process_model');
      $this->fancy_chain_fancy_hold_process_model->create_chain_making_process_record($process, $this->attributes);
    }elseif ($process['product_name'] == 'Verona Collection' && $process['process_name'] == 'Round and Ball Chain Process'   && $process['department_name'] == 'Round and Ball Chain'  && !empty($this->attributes['out_weight'])){
      
      $this->load->model('verona_collections/round_and_ball_chain_process_model');
      $this->round_and_ball_chain_process_model->create_karigar_laser_process_record($process, $this->attributes);
    }elseif ($process['product_name'] == 'Fancy 75 Chain' && $process['process_name'] == 'Fancy Hold Process'   && $process['department_name'] == 'Fancy Hold'  && !empty($this->attributes['out_weight'])){
      
      $this->load->model('fancy_seventy_chains/fancy_seventy_chain_fancy_hold_process_model');
      $this->fancy_seventy_chain_fancy_hold_process_model->create_chain_making_process_record($process, $this->attributes);
    }elseif ($process['product_name'] == 'Fancy 75 RND' && $process['process_name'] == 'Fancy Hold Process'   && $process['department_name'] == 'Fancy Hold'  && !empty($this->attributes['out_weight'])){
      
        $this->load->model('fancy_seventy_five_rnd_chains/fancy_seventy_five_rnd_chain_fancy_hold_process_model');
        $this->fancy_seventy_five_rnd_chain_fancy_hold_process_model->create_chain_making_process_record($process, $this->attributes);
      }elseif ($process['product_name'] == 'Choco Chain' && ($process['process_name'] == 'Final Process')   && ($process['department_name'] == 'Buffing')  && (isset($this->attributes['recutting_out']) && ($this->attributes['recutting_out'] > 0))){
      
      $this->load->model('choco_chains/choco_chain_quality_process_model');
      $this->choco_chain_quality_process_model->create_quality_process_record($process, $this->attributes);
    }elseif ($process['product_name'] == 'Choco Chain' && ($process['process_name'] == 'Imp Final Process')   && ($process['department_name'] == 'Buffing II')  && (isset($this->attributes['recutting_out']) && ($this->attributes['recutting_out'] > 0))){
      $this->load->model('choco_chains/choco_chain_quality_process_model');
      $this->choco_chain_quality_process_model->create_quality_process_record($process, $this->attributes);

    }elseif ($process['product_name'] == 'Fancy Chain' && $process['process_name'] == 'Fancy Hold Process'   && $process['department_name'] == 'Fancy Hold'  && !empty($this->attributes['bounch_out'])){
      
      $this->load->model('fancy_chains/fancy_chain_fancy_hold_process_model');
      $this->fancy_chain_fancy_hold_process_model->create_refresh_process_record($process, $this->attributes);
    }elseif ($process['product_name'] == 'Fancy 75 Chain' && $process['process_name'] == 'Fancy Hold Process'   && $process['department_name'] == 'Fancy Hold'  && !empty($this->attributes['bounch_out'])){
      
      $this->load->model('fancy_seventy_chains/fancy_seventy_chain_fancy_hold_process_model');
      $this->fancy_seventy_chain_fancy_hold_process_model->create_refresh_process_record($process, $this->attributes);
    }elseif ($process['product_name'] == 'Fancy 75 RND' && $process['process_name'] == 'Fancy Hold Process'   && $process['department_name'] == 'Fancy Hold'  && !empty($this->attributes['bounch_out'])){
      
        $this->load->model('fancy_seventy_five_rnd_chains/fancy_seventy_five_rnd_chain_fancy_hold_process_model');
        $this->fancy_seventy_five_rnd_chain_fancy_hold_process_model->create_refresh_process_record($process, $this->attributes);
      } elseif ($process['product_name'] == 'Fancy Chain' && ($process['department_name'] == 'Fancy Hold'|| $process['department_name'] == 'Chain Making') && isset($this->attributes['recutting_out'])){
      
      $this->load->model('fancy_chains/fancy_chain_chain_making_process_model');
      $this->fancy_chain_chain_making_process_model->create_next_process_department_record($process, $this->attributes);
    }
    elseif ($process['product_name'] == 'Verona Collection' && ($process['department_name'] == 'Karigar Laser') && isset($this->attributes['recutting_out'])){
      
      $this->load->model('verona_collections/karigar_laser_process_model');
      $this->karigar_laser_process_model->create_next_process_department_record($process, $this->attributes);
    }elseif ($process['product_name'] == 'Fancy 75 Chain' && ($process['department_name'] == 'Fancy Hold'|| $process['department_name'] == 'Chain Making') && isset($this->attributes['recutting_out'])){
      
      $this->load->model('fancy_seventy_chains/fancy_seventy_chain_chain_making_process_model');
      $this->fancy_seventy_chain_chain_making_process_model->create_next_process_department_record($process, $this->attributes);
    }elseif ($process['product_name'] == 'Fancy 75 RND' && ($process['department_name'] == 'Fancy Hold'|| $process['department_name'] == 'Chain Making') && isset($this->attributes['recutting_out'])){
      
        $this->load->model('fancy_seventy_five_rnd_chains/fancy_seventy_five_rnd_chain_chain_making_process_model');
        $this->fancy_seventy_five_rnd_chain_chain_making_process_model->create_next_process_department_record($process, $this->attributes);
      }elseif ($process['product_name'] == 'Refresh' && $process['process_name'] == 'Refresh'   && $process['department_name'] == 'Refresh-Repairing'  && isset($this->attributes['recutting_out'])){
      
      $this->load->model('refresh/refresh_model');
      $this->refresh_model->create_next_process_department_record($process, $this->attributes);

    } else if ($process['product_name'] == 'Hollow Choco Chain' && $process['process_name'] == 'Spring Process'         && $process['department_name'] == 'Spring'        && (isset($this->attributes['out_weight'])                                                                          && $this->attributes['out_weight'] > 0)) {
      $this->load->model('hollow_choco_chains/hollow_choco_spring_process_model');
      $this->hollow_choco_spring_process_model->create_chain_making_department_record($process, $this->attributes);
    } else if ($process['product_name'] == 'Lotus Chain' && $process['process_name'] == 'Spring Process'         && $process['department_name'] == 'Spring'        && (isset($this->attributes['out_weight'])                                                                          && $this->attributes['out_weight'] > 0)) {
      $this->load->model('lotus_chains/lotus_spring_process_model');
      $this->lotus_spring_process_model->create_chain_making_department_record($process, $this->attributes);
    }else if ($process['product_name'] == 'Roco Choco Chain' && $process['process_name'] == 'Spring Process'         && $process['department_name'] == 'Spring'        && (isset($this->attributes['out_weight'])                                                                          && $this->attributes['out_weight'] > 0)) {
      $this->load->model('roco_choco_chains/roco_choco_spring_process_model');
      $this->roco_choco_spring_process_model->create_chain_making_department_record($process, $this->attributes);
    } else if ($process['product_name'] == 'Nawabi Chain' && $process['process_name'] == 'Spring Process'         && $process['department_name'] == 'Spring'        && (isset($this->attributes['out_weight'])                                                                          && $this->attributes['out_weight'] > 0)) {
      $this->load->model('nawabi_chains/nawabi_spring_process_model');
      $this->nawabi_spring_process_model->create_chain_making_department_record($process, $this->attributes);
    }else if ($process['product_name'] == 'Indo tally Chain'   && $process['process_name'] == 'Spring Process'         && $process['department_name'] == 'Spring'        && (isset($this->attributes['out_weight'])                                                                   && $this->attributes['out_weight'] > 0)) {
      $this->load->model('indo_tally_chains/indo_tally_spring_process_model');
      $this->indo_tally_spring_process_model->create_chain_making_department_record($process, $this->attributes);
    
    }else if ($process['product_name'] == 'KA Chain'   && $process['process_name'] == 'Hammering II Process'         && $process['department_name'] == 'Copper'&& (isset($this->attributes['out_weight']) && $this->attributes['out_weight'] > 0)) {
      $this->load->model('ka_chains/ka_chain_hammering_ii_process_model');
      $this->ka_chain_hammering_ii_process_model->create_next_process_department_record($process, $this->attributes);
    
    }else if ($process['product_name'] == 'KA Chain'            && $process['process_name'] == 'Start Process'        && $process['department_name'] == 'Tarpatta'       && (isset($this->attributes['out_weight'])                                                                              && $this->attributes['out_weight'] > 0)) {
      $this->load->model('ka_chains/ka_chain_start_process_model');
      $this->ka_chain_start_process_model->create_tarpatta_department_record($process, $this->attributes);
    }/*else if ($process['product_name'] == 'KA Chain'            && $process['process_name'] == 'Dhoom Process'        && $process['department_name'] == 'Chain Making'   && (isset($this->attributes['out_weight'])                                                                               && $this->attributes['out_weight'] > 0)) {
      $this->load->model('ka_chains/ka_chain_start_process_model');
      $this->ka_chain_start_process_model->create_tarpatta_department_record($process, $this->attributes);
    }*/else if ($process['product_name'] == 'KA Chain'            && $process['process_name'] == 'Factory Process'        && $process['department_name'] == 'Factory'       && (isset($this->attributes['out_weight'])                                                                          && $this->attributes['out_weight'] > 0)) {
      $this->load->model('ka_chains/ka_chain_factory_process_model');
      $this->ka_chain_factory_process_model->create_hook_department_record($process, $this->attributes);

    }else if ($process['product_name'] == 'KA Chain'            && $process['process_name'] == 'Factory Process'        && $process['department_name'] == 'Factory'       && (isset($this->attributes['recutting_out']) && $this->attributes['recutting_out'] > 0)) {

      $this->load->model('ka_chains/ka_chain_factory_process_model');
      $this->attributes['out_weight'] = $this->attributes['recutting_out'];
      $this->attributes['row_id'] = $process['row_id'].'-'. ((empty($this->attributes['id'])) ? rand() : $this->attributes['id']);
      $this->attributes['lot_row_id'] = $process['melting_lot_id'].'-'.$this->attributes['id'];
      $this->ka_chain_factory_process_model->create_ball_chain_hook_plain_process_record($process, $this->attributes);  
    }else if ($process['product_name'] == 'KA Chain'            && $process['process_name'] == 'Factory Process'        && $process['department_name'] == 'Factory'       && (isset($this->attributes['factory_out']) && $this->attributes['factory_out'] > 0)) {
      $this->load->model('ka_chains/ka_chain_factory_process_model');
      $this->ka_chain_factory_process_model->create_fancy_out_process_record($process, $this->attributes);  
    }else if ($process['product_name'] == 'KA Chain'            && $process['process_name'] == 'Customer Bunch Order Process'        && $process['department_name'] == 'Bunch GPC'       && (isset($this->attributes['factory_out']) && $this->attributes['factory_out'] > 0)) {
      $this->load->model('ka_chains/ka_chain_factory_process_model');
      $this->ka_chain_factory_process_model->create_fancy_out_process_record($process, $this->attributes);  
    }else if ($process['product_name'] == 'Fancy Chain'            && $process['process_name'] == 'Fancy Hold Process'        && $process['department_name'] == 'Fancy Hold' && (isset($this->attributes['tanishq_out']) && $this->attributes['tanishq_out'] > 0)) {
      $this->load->model('fancy_chains/fancy_chain_fancy_hold_process_model');
      $this->fancy_chain_fancy_hold_process_model->create_tanishq_process_record($process, $this->attributes);  
    }else if ($process['product_name'] == 'KA Chain'            && $process['process_name'] == 'Hook Process'        && $process['department_name'] == 'Hook'       && (isset($this->attributes['factory_out']) && $this->attributes['factory_out'] > 0)) {
      $this->load->model('ka_chains/ka_chain_hook_process_model');
      $this->ka_chain_hook_process_model->create_factory_process_record($process, $this->attributes);  
    } elseif ($process['product_name'] == 'KA Chain'            && $process['process_name'] == 'Factory Hold Process'   && $process['department_name'] == 'Factory Hold'  && (isset($this->attributes['out_weight']) && $this->attributes['out_weight'] > 0)) {
      $this->load->model(array('ka_chains/ka_chain_factory_hold_process_model'));
      $this->ka_chain_factory_hold_process_model->create_next_process_department_record($process, $this->attributes);
    
    } else if ($process['product_name'] == 'Sisma Chain'        && $process['process_name'] == 'Sisma Machine Process'  && $process['department_name'] == 'Sisma Machine' && (isset($this->attributes['out_weight'])                                                                           && $this->attributes['out_weight'] > 0)) {
      $this->load->model('sisma_chains/sisma_chain_sisma_machine_process_model');
      $this->sisma_chain_sisma_machine_process_model->create_final_department_record($process, $this->attributes);
    
    }else if ($process['product_name'] == 'KA Chain'        && ($process['process_name'] == 'CNC Process'||$process['process_name'] == 'DC Process'||$process['process_name'] == 'Round and Ball Chain Process')  && $process['department_name'] == 'Stripping' && (isset($this->attributes['out_weight'])                                                                           && $this->attributes['out_weight'] > 0)) {
      $this->load->model('ka_chains/ka_chain_cnc_process_model');
      $this->ka_chain_cnc_process_model->create_next_department_record($process, $this->attributes);
    
    } elseif ($process['product_name'] == 'Sisma Chain'         && $process['process_name'] == 'RND Process'            && $process['department_name'] == 'Chain Making'  && ($this->formdata['field_name'] == 'ghiss'                                                                             || $this->formdata['field_name'] == 'loss')) {
      $this->load->model(array('sisma_chains/sisma_chain_rnd_process_model'));
      $sisma_chains_obj = new sisma_chain_rnd_process_model();
      $sisma_chains_obj->create_next_department_record($this->attributes['process_id']);
    } elseif ($process['product_name'] == 'Sisma Chain'         && $process['process_name'] == 'RND Process'            && ($process['department_name'] == 'Hand Cutting' || $process['department_name'] == 'Hand Dull'   || $process['department_name'] == 'Buffing'                                              || $process['department_name'] == 'Filing')) {
      $this->update_current_process_in_weight($process);
      $this->update_previous_process_next_department_wastage($process);
      $this->attributes['processes']['previous_process_update'] = true;
    
    }elseif ($process['product_name'] == 'Hallmark') {
      $this->update_current_process_out_quantity($process);
      $this->update_current_process_rejected_qty($process);
      $this->update_current_process_no_hu_id_qty($process);
      $this->update_current_process_cutting_pc_qty($process);
      $this->update_current_process_fir_assay_qty($process);
      
    }
    //  elseif ($process['product_name'] == 'Refresh' && $process['process_name'] == 'Refresh Hold'   && $process['department_name'] == 'Refresh Hold'  && (isset($this->attributes['out_weight']) && $this->attributes['out_weight'] > 0)) {
    //   $this->load->model(array('refresh/refresh_hold_model'));
    //   $this->refresh_hold_model->create_next_process_department_record($process, $this->attributes);
    // }
     elseif ($process['product_name'] == 'Office Outside'      && $process['process_name'] == 'Pipe and Para Process'  && $process['department_name'] == 'Para and Pipe Making'  && isset($this->attributes['out_weight'])                                                                          && $this->attributes['out_weight'] > 0)  {
      $this->load->model(array('pipe_and_para_processes/pipe_and_para_start_process_model'));
      $this->pipe_and_para_start_process_model->create_pipe_and_para_next_department_record($process, $this->attributes);
    } elseif (($process['product_name'] == 'Stone Ring 92' 
               ||$process['product_name'] == 'Stone Ring 75' 
               || $process['product_name'] == 'Plain Ring')      && $process['process_name'] == 'Final Process'         && $process['department_name'] == 'Magnet Loss') {
      $this->update_current_process_in_weight($process);
      $this->update_previous_process_next_department_wastage($process);
      $this->attributes['processes']['previous_process_update'] = true;
    } else if (   $process['product_name'] == 'Ball Chain'       && $process['process_name'] == 'Factory Hold I Process'  && $process['department_name'] == 'Factory Hold I'         
               && (isset($this->attributes['out_weight']) && $this->attributes['out_weight'] > 0)) {
      $this->load->model('ball_chains/ball_chain_factory_hold_i_process_model');
      $this->ball_chain_factory_hold_i_process_model->create_cutting_department_record($process, $this->attributes);  
    } else if (   $process['product_name'] == 'Ball Chain'       && $process['process_name'] == 'Factory Hold Plain Process'    && $process['department_name'] == 'Factory Hold Plain'
               && (isset($this->attributes['out_weight']) && $this->attributes['out_weight'] > 0)) {
      $this->load->model('ball_chains/ball_chain_factory_hold_plain_process_model');
      $this->ball_chain_factory_hold_plain_process_model->create_hook_plain_or_laser_plain_record($process, $this->attributes);  
    } else if (   $process['product_name'] == 'Ball Chain'   && $process['process_name'] == 'Factory Hold Two Tone Process'  && $process['department_name'] == 'Factory Hold Two Tone'
               && (isset($this->attributes['out_weight']) && $this->attributes['out_weight'] > 0)) {
      $this->load->model('ball_chains/ball_chain_factory_hold_two_tone_process_model');
      $this->ball_chain_factory_hold_two_tone_process_model->create_hook_plain_or_laser_plain_record($process, $this->attributes);  
    } elseif ($process['product_name'] == 'Imp Italy Chain' && $process['process_name'] == 'Final Process'   && $process['department_name'] == 'GPC Or Rodium'  && isset($this->attributes['factory_out'])){
      
      $this->load->model('imp_italy_chains/Imp_italy_final_process_model');
      $this->Imp_italy_final_process_model->create_engraving_out_process_record($process, $this->attributes);
    }elseif ($process['product_name'] == 'Imp Italy Chain' && $process['process_name'] == 'Final Process'   && $process['department_name'] == 'Buffing'  && isset($this->attributes['factory_out'])){
      
      $this->load->model('imp_italy_chains/Imp_italy_final_process_model');
      $this->Imp_italy_final_process_model->create_engraving_out_process_record($process, $this->attributes);
    }elseif ($process['product_name'] == 'Fancy Chain' && ($process['process_name'] == 'Chain Making Process' || $process['process_name'] == 'Chain Making 75 Process')  && $process['department_name'] == 'Chain Making'  && isset($this->attributes['hook_out'])){
      $this->load->model('fancy_chains/fancy_chain_fancy_hold_process_model');
      $this->fancy_chain_fancy_hold_process_model->update_factory_hold_process_hook_in_from_chain_making($process, $this->attributes);
    }elseif ($process['product_name'] == 'Fancy 75 Chain' && ($process['process_name'] == 'Chain Making Process')  && $process['department_name'] == 'Chain Making'  && isset($this->attributes['hook_out'])){
      $this->load->model('fancy_seventy_chains/fancy_seventy_chain_fancy_hold_process_model');
      $this->fancy_seventy_chain_fancy_hold_process_model->update_factory_hold_process_hook_in_from_chain_making($process, $this->attributes);
    }elseif ($process['product_name'] == 'Fancy 75 RND' && ($process['process_name'] == 'Chain Making Process')  && $process['department_name'] == 'Chain Making'  && isset($this->attributes['hook_out'])){
        $this->load->model('fancy_seventy_five_rnd_chains/fancy_seventy_five_rnd_chain_fancy_hold_process_model');
        $this->fancy_seventy_five_rnd_chain_fancy_hold_process_model->update_factory_hold_process_hook_in_from_chain_making($process, $this->attributes);
      }elseif ($process['product_name'] == 'Office Outside' && $process['process_name'] == 'Pipe and Para Final Process'   && $process['department_name'] == 'Pipe and Para Final'  && isset($this->attributes['daily_drawer_in_weight'])){
      $this->load->model('fancy_chains/fancy_chain_fancy_hold_process_model');
      $this->fancy_chain_fancy_hold_process_model->update_factory_hold_process_hook_in_from_pipe_and_para($process, $this->attributes);
    }

    $process = $this->update_process($this->attributes['process_id'], $this->formdata['field_name'], 'false', '');

    if (@$this->attributes['daily_drawer_in_weight'] > 0 || $this->attributes['hook_in'] > 0 || $this->attributes['hook_out'] > 0) 
      $this->update_hook_kdm_purity($process, $this->attributes['id']);

    if ($process['product_name'] == 'Indo tally Chain'   && $process['process_name'] == 'Spring Process'         && $process['department_name'] == 'Spring'        && (   isset($this->attributes['hook_in'])                                                                      || isset($this->attributes['hook_out']))) {
      $this->load->model('indo_tally_chains/indo_tally_spring_process_model');
      $this->indo_tally_spring_process_model->set_purity_in_chain_making_and_final_processes($process['parent_lot_id']);
    }

    if ($process['product_name'] == 'Hollow Choco Chain'   && $process['process_name'] == 'Spring Process'         && $process['department_name'] == 'Spring'        && (   isset($this->attributes['hook_in'])                                                                          || isset($this->attributes['hook_out']))) {
      $this->load->model('hollow_choco_chains/hollow_choco_spring_process_model');
      $this->hollow_choco_spring_process_model->set_purity_in_chain_making_and_final_processes($process['parent_lot_id']);
    }
    if ($process['product_name'] == 'Lotus Chain'   && $process['process_name'] == 'Spring Process'         && $process['department_name'] == 'Spring'        && (   isset($this->attributes['hook_in'])                                                                          || isset($this->attributes['hook_out']))) {
      $this->load->model('lotus_chains/lotus_spring_process_model');
      $this->lotus_spring_process_model->set_purity_in_chain_making_and_final_processes($process['parent_lot_id']);
    }if ($process['product_name'] == 'Roco Choco Chain'   && $process['process_name'] == 'Spring Process'         && $process['department_name'] == 'Spring'        && (   isset($this->attributes['hook_in'])                                                                          || isset($this->attributes['hook_out']))) {
      $this->load->model('roco_choco_chains/roco_choco_spring_process_model');
      $this->roco_choco_spring_process_model->set_purity_in_chain_making_and_final_processes($process['parent_lot_id']);
    }

    if ($process['product_name'] == 'Nawabi Chain'   && $process['process_name'] == 'Spring Process'         && $process['department_name'] == 'Spring'        && (   isset($this->attributes['hook_in'])                                                                          || isset($this->attributes['hook_out']))) {
      $this->load->model('nawabi_chains/nawabi_spring_process_model');
      $this->nawabi_spring_process_model->set_purity_in_chain_making_and_final_processes($process['parent_lot_id']);
    }

    if ($process['product_name'] == 'Imp Italy Chain'   && $process['process_name'] == 'Spring Process'         && $process['department_name'] == 'Spring'        && (    isset($this->attributes['hook_in']) || isset($this->attributes['hook_out']))) {
      //$process_obj = $this->process_model->get_model_object($process);
      $this->load->model('imp_italy_chains/Imp_italy_spring_process_model');
      $this->Imp_italy_spring_process_model->set_purity_in_chain_making_and_final_processes($process['parent_lot_id']);
    }
    if (!empty($this->attributes['job_card_no'])) $process_fields['job_card_no'] = $this->attributes['job_card_no'];
    if (!empty($this->attributes['lopster_no'])) $process_fields['lopster_no'] = $this->attributes['lopster_no'];

   


    if (   isset($this->attributes['out_weight']) && $this->attributes['out_weight'] > 0 
        && $process['split_out_weight'] == 1 ) {

      $process_obj = $this->Process_model->get_model_object($process);
      $process_fields = array('out_weight' => $this->attributes['out_weight'],
                              'parent_process_detail_id' => $this->attributes['id'],
                              'order_detail_id' => !empty($this->attributes['order_detail_id'])? $this->attributes['order_detail_id']:0,
                              'row_id' => $process['row_id'].'-'.$this->attributes['id']);
      if (isset($this->attributes['melting_lot_category_one'])) $process_fields['melting_lot_category_one'] = $this->attributes['melting_lot_category_one'];
      if (isset($this->attributes['melting_lot_category_two'])) $process_fields['melting_lot_category_two'] = $this->attributes['melting_lot_category_two'];
      if (isset($this->attributes['melting_lot_category_three'])) $process_fields['melting_lot_category_three'] = $this->attributes['melting_lot_category_three'];
      if (!empty($this->attributes['quantity'])) $process_fields['quantity'] = $this->attributes['quantity'];
      if (!empty($this->attributes['lopster_no'])) $process_fields['lopster_no'] = $this->attributes['lopster_no'];
      if (!empty($this->attributes['next_department_name'])) $process_fields['next_department_name'] = $this->attributes['next_department_name'];
      if (!empty($this->attributes['machine_size'])) $process_fields['machine_size'] = $this->attributes['machine_size'];
      if (!empty($this->attributes['tone'])) $process_fields['tone'] = $this->attributes['tone'];
      if (!empty($this->attributes['product_name'])) $process_fields['product_name'] = $this->attributes['product_name'];

      if (!empty($this->attributes['karigar'])) $process_fields['karigar'] = $this->attributes['karigar'];
      if (!empty($this->attributes['worker'])) $process_fields['worker'] = $this->attributes['worker'];
      if (!empty($this->attributes['out_quantity'])) $process_fields['out_quantity'] = $this->attributes['out_quantity'];

      if (!empty($this->attributes['design_code'])) $process_fields['design_code'] = 
       isset($this->attributes['design_code_type'])?$this->attributes['design_code_type'].'-'.$this->attributes['design_code']:$this->attributes['design_code'];
       if(!empty($process['product_name'])&&$process['product_name']=='Office Outside'){
        $process_fields['type'] = $process['process_name'];
        if (!empty($this->attributes['next_department_karigar'])) $process_fields['karigar'] = $this->attributes['next_department_karigar'];
       }
       if(!empty($process['product_name'])&&$process['product_name']=='Sisma Accessories Making Chain'){
        $process_fields['type'] = $process['process_name'];
        if (!empty($this->attributes['next_department_karigar'])) $process_fields['karigar'] = $this->attributes['next_department_karigar'];
       }
      if(!empty($process['product_name'])&&$process['process_name']=='Refresh Hold'){
      //  $process_fields['type'] = $process['process_name'];
        if (!empty($this->attributes['next_department_karigar'])) $process_fields['karigar'] = $this->attributes['next_department_karigar'];
       }
       if ($process['product_name'] == 'Machine Chain' and $process['process_name'] == 'AG') {
          $category_abbr = $this->get_category_abbr();
          $srno = $this->process_model->find('max(srno) + 1 as srno', array('product_name' => $process['product_name'],'process_name' => $process['process_name'],
                                                           'melting_lot_category_one' => $this->attributes['melting_lot_category_one'],
                                                           'melting_lot_category_two' => $this->attributes['melting_lot_category_two'],
                                                           'melting_lot_category_three' => $this->attributes['melting_lot_category_three']))['srno'];
          $srno = (!empty($srno) ? $srno : 1);
          if ($this->attributes['melting_lot_category_one'] == 'Spyke') {
            $process_fields['lot_no'] = strtoupper($category_abbr['one'].$category_abbr['three'].'-'.sprintf("%02d", $srno));
          } else {
            $process_fields['lot_no'] = strtoupper($category_abbr['one'].$category_abbr['two'].$category_abbr['three'].'-'.sprintf("%02d", $srno));
          }
        }if ($process['product_name'] == 'Rope Chain' and $process['process_name'] == 'AU FE Process') {
          $category_abbr = $this->get_category_abbr();
          $srno = $this->process_model->find('max(srno) + 1 as srno', array('product_name' => $process['product_name'],'process_name' => $process['process_name'],
                                                           'melting_lot_category_one' => $this->attributes['melting_lot_category_one'],
                                                           'melting_lot_category_two' => $this->attributes['melting_lot_category_two'],
                                                           'melting_lot_category_three' => $this->attributes['melting_lot_category_three']))['srno'];
          $srno = (!empty($srno) ? $srno : 1);
            $process_fields['lot_no'] = strtoupper($category_abbr['one'].'RC'.$category_abbr['three'].'-'.sprintf("%02d", $srno));
        }
        if ($process['product_name'] == 'Rope Chain' and $process['process_name'] == 'AU FE Process') {
          $category_abbr = $this->get_category_abbr();
          $srno = $this->process_model->find('max(srno) + 1 as srno', array('product_name' => $process['product_name'],'process_name' => $process['process_name'],
                                                           'melting_lot_category_one' => $this->attributes['melting_lot_category_one'],
                                                           'melting_lot_category_two' => $this->attributes['melting_lot_category_two'],
                                            
                                                           'melting_lot_category_three' => $this->attributes['melting_lot_category_three']))['srno'];
          $srno = (!empty($srno) ? $srno : 1);
            $process_fields['lot_no'] = strtoupper($category_abbr['one'].'RC'.$category_abbr['three'].'-'.sprintf("%02d", $srno));

        }
      $process_obj->create_next_process_record('', $process_fields, true);
    }
    $process = $this->Process_model->find('', array('id' => $this->attributes['process_id']));
    $process_obj = $this->process_model->get_model_object($process);    
    $process_obj->set_current_process_status_completed();
    $process_obj->set_process_field_attributes();
    
    if ($this->attributes['hook_in'] > 0 || $this->attributes['hook_out'] > 0) 
      $this->Process_model->set_purity_from_previous_department($this->attributes['process_id'], $process_obj->attributes['in_purity'], $process_obj->attributes['in_lot_purity']);
    if ($this->attributes['hook_in'] > 0 || $this->attributes['hook_out'] > 0){
      $this->update_quantity_after_hook_in_update($this->attributes);
    }
    if (!empty($this->attributes['pending_ghiss']) && $this->attributes['pending_ghiss'] > 0 && $process['department_name']=="Hand Cutting"){
      $this->update_karigar_after_pending_ghiss_update($this->attributes);
    }
    if ($this->attributes['out_weight'] > 0 && $process['department_name']=="Factory Hold" && $process['product_name']=="Refresh"){
      $this->update_melting_lot_category_one_after_pending_ghiss_update($this->attributes);
    }
    if ($this->attributes['gpc_out'] > 0 && $process['department_name']=="GPC" && $process['product_name']=="KA Chain Refresh"){
      $this->update_melting_lot_category_one_after_pending_ghiss_update($this->attributes);
    } 

  }
  public function update_quantity_after_hook_in_update($current_process){
    $process_details=$this->process_model->get('',array('parent_id'=>$current_process['process_id']));
    foreach ($process_details as $index => $value) {
    $model_name = get_model_name($value['product_name'], $value['process_name']);
    $this->load->model($model_name['module_name'].'/'.$model_name['model_name']);  
    $quantity_details=$this->process_field_model->find('quantity',array('id'=>$value['parent_process_detail_id']));
    $current_process_obj = new $model_name['model_name'](array('id' => $value['id']));
    $current_process_obj->attributes['quantity'] = !empty($quantity_details)?$quantity_details['quantity']:0;
    $current_process_obj->update(false);
    }
  }
  public function update_karigar_after_pending_ghiss_update($current_process){
    $process_detail=$this->process_model->find('',array('id'=>$current_process['process_id']));
    $model_name = get_model_name($process_detail['product_name'], $process_detail['process_name']);
    $this->load->model($model_name['module_name'].'/'.$model_name['model_name']);  
    $current_process_obj = new $model_name['model_name'](array('id' => $process_detail['id']));
    $current_process_obj->attributes['karigar'] = !empty($current_process['next_department_karigar'])?$current_process['next_department_karigar']:"";
    $current_process_obj->update(false);
  }public function update_melting_lot_category_one_after_pending_ghiss_update($current_process){
    $process_detail=$this->process_model->find('',array('id'=>$current_process['process_id']));
    $model_name = get_model_name($process_detail['product_name'], $process_detail['process_name']);
    $this->load->model($model_name['module_name'].'/'.$model_name['model_name']);  
    $current_process_obj = new $model_name['model_name'](array('id' => $process_detail['id']));
    $current_process_obj->attributes['melting_lot_category_one'] = !empty($current_process['melting_lot_category_one'])?$current_process['melting_lot_category_one']:"";
    $current_process_obj->update(false);
  } 

  // private function set_attributes_from_processes() {
  //   $process = $this->process_model->find('karigar, hook_kdm_purity', array('id' => $this->attributes['process_id']));
  //   $process_fields = $this->process_field_model->find('', array('process_id' => $this->attributes['process_id']));
  //   foreach($process_fields as $process_field) {
  //     $process_field_obj = new process_field_model($process_field);
  //     $process_field_obj->attributes['karigar'] = $process['karigar'];
  //     $process_field_obj->attributes['hook_kdm_purity'] = $process['hook_kdm_purity'];
  //     $process_field_obj->update(false);
  //   }
  // }

  public function update_current_process_in_weight($process) {
    $process_obj = new Process_model($process);
    $process_obj->attributes['in_weight'] = $process['in_weight'] + $this->attributes[$this->formdata['field_name']];
    $process_obj->calculate_balance_wastage();
    $process_obj->calculate_balance();
    $process_obj->save(false);
  }
  public function update_current_process_out_quantity($process) {
    // fprocess);
    if(!empty($this->attributes['out_quantity'])){
      $process_obj = new Process_model($process);
      $process_obj->attributes['out_quantity'] = $process['out_quantity'] + $this->attributes['out_quantity'];
      $process_obj->attributes['balance_quantity'] = $process['balance_quantity'] - $this->attributes['out_quantity'];
      $process_obj->save(false);
    }
  }public function update_current_process_rejected_qty($process) {
    // pd($process);
    if(!empty($this->attributes['rejected_qty'])){
      $process_obj = new Process_model($process);
      $process_obj->attributes['rejected_qty'] = $process['rejected_qty'] + $this->attributes['rejected_qty'];
      $process_obj->attributes['balance_quantity'] = $process['balance_quantity'] - $this->attributes['rejected_qty'];
      
      // $process_obj->calculate_balance_quantity();
      $process_obj->save(false);
    }
  }public function update_current_process_no_hu_id_qty($process) {
    // pd($process);
    if(!empty($this->attributes['no_hu_id_qty'])){
      $process_obj = new Process_model($process);
      $process_obj->attributes['no_hu_id_qty'] = $process['no_hu_id_qty'] + $this->attributes['no_hu_id_qty'];
      $process_obj->attributes['balance_quantity'] = $process['balance_quantity'] - $this->attributes['no_hu_id_qty'];
      
      // $process_obj->calculate_balance_quantity();
      $process_obj->save(false);
    }
  }public function update_current_process_cutting_pc_qty($process) {
    // pd($process);
    if(!empty($this->attributes['cutting_pc_qty'])){
      $process_obj = new Process_model($process);
      $process_obj->attributes['cutting_pc_qty'] = $process['cutting_pc_qty'] + $this->attributes['cutting_pc_qty'];
      $process_obj->attributes['balance_quantity'] = $process['balance_quantity'] - $this->attributes['cutting_pc_qty'];  
      
      // $process_obj->calculate_balance_quantity();
      $process_obj->save(false);
    }
  }public function update_current_process_fir_assay_qty($process) {
    // pd($process);
    if(!empty($this->attributes['gpc_out_qty'])){
      $process_obj = new Process_model($process);
      $process_obj->attributes['gpc_out_qty'] = $process['gpc_out_qty'] + $this->attributes['gpc_out_qty'];
      $process_obj->attributes['balance_quantity'] = $process['balance_quantity'] - $this->attributes['gpc_out_qty'];
      
      // $process_obj->calculate_balance_quantity();
      $process_obj->save(false);
    }
  }

  public function update_previous_process_next_department_wastage($process) {
    $parent_process = $this->Process_model->find('', array('id' => $process['parent_id']));
    $process_obj = new Process_model($parent_process);
    $process_obj->attributes['next_department_wastage'] = $parent_process['next_department_wastage'] + $this->attributes[$this->formdata['field_name']];
    $process_obj->calculate_balance_wastage();
    $process_obj->calculate_balance();
    $process_obj->save(false);
  }

  public function before_delete($id) {
    if (isset($_GET['field_name'])) {
      $field_name = $_GET['field_name'];
      $process_field = $this->find('', array('id' => $id));   
      $this->update_process($process_field['process_id'], $field_name, 'true', $id);

      $process = $this->Process_model->find('', array('id' => $process_field['process_id']));
      if ($process['product_name'] == 'Indo tally Chain'   && $process['process_name'] == 'Spring Process'         && $process['department_name'] == 'Spring') {
        $this->load->model('indo_tally_chains/indo_tally_spring_process_model');
        $this->indo_tally_spring_process_model->set_purity_in_chain_making_and_final_processes($process['parent_lot_id']);
      }
      if ($process['product_name'] == 'Cartier'   && $process['process_name'] == 'Chain Making Process'         && $process['department_name'] == 'Chain Making') {
        $this->load->model('cartier_process/cartier_chain_making_process_model');
        $this->cartier_chain_making_process_model->set_purity_in_chain_making_and_final_processes($process['parent_lot_id']);
      }

      if ($process['product_name'] == 'Hollow Choco Chain'   && $process['process_name'] == 'Spring Process'         && $process['department_name'] == 'Spring') {
        $this->load->model('hollow_choco_chains/hollow_choco_spring_process_model');
        $this->hollow_choco_spring_process_model->set_purity_in_chain_making_and_final_processes($process['parent_lot_id']);
      }
      if ($process['product_name'] == 'Lotus Chain'   && $process['process_name'] == 'Spring Process'         && $process['department_name'] == 'Spring') {
        $this->load->model('lotus_chains/lotus_spring_process_model');
        $this->lotus_spring_process_model->set_purity_in_chain_making_and_final_processes($process['parent_lot_id']);
      }
      if ($process['product_name'] == 'Roco Choco Chain'   && $process['process_name'] == 'Spring Process'         && $process['department_name'] == 'Spring') {
              $this->load->model('roco_choco_chains/roco_choco_spring_process_model');
              $this->roco_choco_spring_process_model->set_purity_in_chain_making_and_final_processes($process['parent_lot_id']);
            }

      if ($process['product_name'] == 'Nawabi Chain'   && $process['process_name'] == 'Spring Process'         && $process['department_name'] == 'Spring') {
        $this->load->model('nawabi_chains/nawabi_spring_process_model');
        $this->nawabi_spring_process_model->set_purity_in_chain_making_and_final_processes($process['parent_lot_id']);
      }

      if ($process['product_name'] == 'Casting Chain'   && $process['process_name'] == 'Spring Process'         && $process['department_name'] == 'Spring') {
        $this->load->model('casting_chains/casting_spring_process_model');
        $this->casting_spring_process_model->set_purity_in_chain_making_and_final_processes($process['parent_lot_id']);
      }

      if ($process['product_name'] == 'Imp Italy Chain'   && $process['process_name'] == 'Spring Process'         && $process['department_name'] == 'Spring') {
        $this->load->model('imp_italy_chains/imp_italy_spring_process_model');
        $this->imp_italy_spring_process_model->set_purity_in_chain_making_and_final_processes($process['parent_lot_id']);
      }
    } else 
      parent::before_delete($id);
  }

  public function update_hook_kdm_purity($process, $process_field_id){
    $process_field = array('id' => $process_field_id,
                           'hook_kdm_purity' => $process['hook_kdm_purity']);
    if (@$this->attributes['daily_drawer_in_weight'] > 0) {
      $process_field['daily_drawer_type'] = $process['process_name'];
      $process_field['karigar'] = isset($process['karigar']) ? $process['karigar'] : $this->attributes['karigar'];
    } else
      $process_field['karigar'] = $process['karigar'];
    $process_field_obj = new Process_field_model($process_field);
    $process_field_obj->save(false);
  }


  public function update_process($process_id, $field_name, $after_delete, $process_field_id) {
    $where_conditions = array('process_id' => $process_id);
    if ($after_delete == 'true') 
      $where_conditions = array_merge($where_conditions, array('id!=' => $process_field_id));
    if ($field_name == 'karigar') {
      $field_value = $this->formdata['process_fields']['karigar'];
    } else {
      $field_value = $this->find('SUM('.$field_name.') as weight', $where_conditions)['weight'];
    }
    $this->attributes['processes']['field_name'] = $field_name;
    
    $process = $this->Process_model->find('', array('id' => $process_id));
    $model_name = get_model_name($process['product_name'], $process['process_name']);
    $this->load->model($model_name['module_name'].'/'.$model_name['model_name']);
    $process_obj = new $model_name['model_name']($process);
    $process_obj->attributes[$field_name] = $field_value;
    $process_obj->attributes['status'] ='Pending';
    $process_obj->before_validate();
    $process_obj->save(false);
    return $process_obj->attributes;
  }

  public function validation_rules($klass=''){
    $process = $this->Process_model->find('', array('id' => $this->attributes['process_id']));
    //if(empty($this->attributes['process_id'])){
      $rules = array(array('field' => 'process_fields[process_id]', 'label' => 'Process',
                         'rules' => 'trim|required')); 
    //}

    if ($this->attributes['hook_in'] > 0 || $this->attributes['hook_out'] > 0) {
      $hook_in_out_rules = array(array('field' => 'process_fields[daily_drawer_type]', 
                                       'label' => 'Daily Drawer Type',
                                       'rules' => 'trim|required'));
      $rules = array_merge($rules, $hook_in_out_rules);
    }
    if ($process['product_name']=='Fancy Chain'    && $process['department_name']=='Fancy Hold' && empty($this->attributes['out_weight']) && !empty($this->attributes['hook_out'])) {
      return false;
    }
    if ($process['product_name']=='Fancy 75 Chain'    && $process['department_name']=='Fancy Hold' && empty($this->attributes['out_weight']) && !empty($this->attributes['hook_out'])) {
      return false;
    }
    if ($process['product_name']=='Fancy 75 RND'    && $process['department_name']=='Fancy Hold' && empty($this->attributes['out_weight']) && !empty($this->attributes['hook_out'])) {
        return false;
      }
    if (   HOST == 'ARF' 
        && ($process['product_name']=='Fancy Chain'  || $process['product_name']=='Fancy 75 Chain' || $process['product_name']=='Fancy 75 RND')
        && $this->attributes['hook_in'] > 0 ) {
      $hook_in_validation = array(array('field' => 'process_field[hook_in]',
                                        'label' => 'Hook In',
                                        'rules' => array('greater_than[0]',
                                                         array('less_than_equal_to', array($this,'check_total_hook_in')))));
      $rules = array_merge($rules, $hook_in_validation);
    }
    /*if ($this->attributes['hook_in'] > 0) {
      $hook_in_validation = array(array('field' => 'process_field[hook_in]',
                                        'label' => 'Hook In',
                                        'rules' => array('greater_than[0]',
                                                         array('less_than_equal_to', array($this,'check_total_hook_in')))));
      $rules = array_merge($rules, $hook_in_validation);
    }*/

    if (($process['product_name']=='Indo tally Chain' || $process['product_name']=='Hollow Choco Chain') 
        && !empty($this->attributes['design_code'])
        && $this->attributes['design_code'] != 'Order') {
      $design_code_rules = array(array('field' => 'process_fields[design_code]', 
                                       'label' => 'Design Code',
                                       'rules' => array('trim','required',
                                                         array('check_design_code_msg', array($this,'check_design_code'))),
                                       'errors'=>array('check_design_code_msg' => "Add valid design code")));
      $rules = array_merge($rules, $design_code_rules);
    }

    if (   ($process['product_name']=='KA Chain'    && (   $process['department_name'] == 'Tarpatta'     
                                                        || $process['department_name'] == 'Factory Hold'
                                                        || $process['department_name'] == 'Laser'
                                                        || $process['department_name'] == 'Ashish'
                                                        || $process['department_name'] == 'Hammering I'
                                                        || $process['department_name'] == 'Vishnu'
                                                        || $process['department_name'] == 'Clipping'
                                                        || $process['department_name'] == 'Stripping')   && $this->attributes['out_weight'] > 0)
        || ($process['product_name']=='Ball Chain'  && (   $process['department_name'] == 'Factory Hold I'
                                                        || $process['department_name'] == 'Factory Hold Plain'
                                                        || $process['department_name'] == 'Factory Hold Two Tone')  && $this->attributes['out_weight'] > 0)) {
      $melting_lot_id = $this->process_model->find('melting_lot_id', array('id' => $this->attributes['process_id']))['melting_lot_id'];
      $order_id = $this->melting_lot_model->find('order_id', array('id' => $melting_lot_id,'category_one!='=>"Dhoom"))['order_id'];
      if (!empty($order_id) && $process['department_name']!='Stripping') {
        if($process['process_name']!="Customer Order Process"){
          $rules[] = array('field' => 'process_fields[order_detail_id]', 'label' => 'Order Detail',
                         'rules' => 'trim|required');
        }
      }
    }

    if ($process['product_name']=='KA Chain' && ($process['melting_lot_category_two']!='Dhoom') && ($process['process_name']!='Customer Order Process') && $process['department_name']=='Factory Hold'   && $this->attributes['out_weight'] > 0) {
        $rules[] = array('field' => 'process_fields[next_department_name]', 'label' => 'Next Dept',
                         'rules' => 'trim|required');
    }
    if (HOST=="AR Gold" && $process['department_name']=='Hand Cutting'   && $this->attributes['pending_ghiss'] > 0) {
        $rules[] = array('field' => 'process_fields[next_department_karigar]', 'label' => 'karigar',
                         'rules' => array('trim','required',array('check_karigar_msg', array($this,'check_karigar'))),
                         'errors'=>array('check_karigar_msg' => "please select karigar before you selected"));
      
    }

    // if ($process['product_name']=='Ball Chain'      && $process['department_name']=='Factory Hold I' && $this->attributes['out_weight'] > 0) {
    //     $rules[] = array('field' => 'process_fields[next_department_name]', 'label' => 'Cutting Process',
    //                      'rules' => 'trim|required');
    // }

    if ($process['product_name']=='Ball Chain'      && $process['department_name']=='Factory Hold Plain' && $this->attributes['out_weight'] > 0) {
        $rules[] = array('field' => 'process_fields[design_code]', 'label' => 'Item Name',
                         'rules' => 'trim|required');
    }

    if ($process['product_name']=='KA Chain'      && $process['department_name']=='Hook'      && $process['process_name']=='Hook Process' && (!empty($this->attributes['customer_out']) && $this->attributes['customer_out'] > 0)) {
        $rules[] = array('field' => 'process_fields[quantity]', 'label' => 'Quantity',
                         'rules' => 'trim|required');
    }
    


    if ($process['product_name']=='KA Chain'    &&  (   $process['department_name'] == 'Tarpatta'
                                                     || ($process['department_name'] == 'Factory Hold' && $process['order_detail_id'] > 0 )
                                                     || ($process['department_name'] == 'Laser' && $process['order_detail_id'] > 0 )
                                                     || ($process['department_name'] == 'Ashish' && $process['order_detail_id'] > 0 )
                                                     || ($process['department_name'] == 'Hammering I' && $process['order_detail_id'] > 0 )
                                                     || ($process['department_name'] == 'Vishnu' && $process['order_detail_id'] > 0 )
                                                     //|| ($process['department_name'] == 'Clipping' && $process['order_detail_id'] > 0 )

                                                     )     && $this->attributes['out_weight'] > 0
                                                           && isset($this->attributes['order_detail_id'])) {
      $ka_chain_order_detail = $this->ka_chain_order_detail_model->find('weight, tarpatta_out_weight, chain_name, tarpatta_order_detail_id', array('id' => $this->attributes['order_detail_id']));
      if (!empty($this->attributes['order_detail_id'])) {
        // if ($process['department_name'] == 'Tarpatta')
        //   $weight = (!empty($ka_chain_order_detail)) ? $ka_chain_order_detail['tarpatta_out_weight'] : 0;
        // elseif ($process['department_name'] == 'Factory Hold') {
        //   $weight = $this->ka_chain_order_detail_model->find('sum(weight) as weight', array('tarpatta_order_detail_id' => $ka_chain_order_detail['tarpatta_order_detail_id'],
        //                                                                                     'chain_name' => $ka_chain_order_detail['chain_name']))['weight'];
        // }
        // else
        $weight = (!empty($ka_chain_order_detail)) ? $ka_chain_order_detail['weight'] : 0;
        $min_allowed_weight = $weight * 0;
        $max_allowed_weight = $weight * 2;
        $rules[] = array('field' => 'process_fields[out_weight]', 'label' => 'Out Weight',
                         'rules' => array('trim', 'numeric','required', 
                                          'less_than_equal_to['.$process['balance'].']',
                                          'less_than_equal_to['.$max_allowed_weight.']',
                                          'greater_than_equal_to['.$min_allowed_weight.']'));
      }

    } else {
      if(   $process['process_name'] != 'Machine Process' 
         && $process['department_name'] != 'Chain Making'
         && $process['department_name'] != 'Copper'
         && $process['department_name'] != 'Rhodium'
         && (HOST=='ARC' && $process['department_name'] != 'GPC'
         && $process['department_name'] != 'Meena')
         && $process['department_name'] != 'Hook'){
      $rules[] = array('field' => 'process_fields[out_weight]', 'label' => 'Out Weight',
                       'rules' => array('trim', 'numeric', 'less_than_equal_to['.$process['balance'].']'));
      }
      if((HOST=='ARC' && $process['department_name'] != 'GPC'
         && $process['department_name'] != 'Meena')){
      $rules[] = array('field' => 'process_fields[out_weight]', 'label' => 'Out Weight',
                       'rules' => array('trim', 'numeric', 'less_than_equal_to['.$process['balance'].']'));
      }
      if($process['product_name'] == 'Sisma Chain' 
         && $process['department_name'] == 'Sisma Machine'){
      $rules[] = array('field' => 'process_fields[melting_wastage]', 'label' => 'Wastage',
                       'rules' => array('trim', 'numeric', 'less_than_equal_to['.$process['balance'].']'));
      $rules[] = array('field' => 'process_fields[pending_ghiss]', 'label' => 'Wastage',
                       'rules' => array('trim', 'numeric', 'less_than_equal_to['.$process['balance'].']'));
      }
     
      // if(   $process['product_name'] == 'KA Chain' 
      //    &&  $process['process_name'] == 'Customer Order Process' && $process['department_name'] == 'GPC'){
      // $rules[] = array('field' => 'process_fields[gpc_out]', 'label' => 'GPC OUT',
      //                  'rules' => array('trim', 'numeric','required', 'less_than_equal_to['.$process['balance'].']'));
      // }
      if(   $process['product_name'] == 'KA Chain' 
         &&  $process['process_name'] == 'Factory Process' && $process['department_name'] == 'Factory'){
      $rules[] = array('field' => 'process_fields[out_weight]', 'label' => 'Out Weight',
                       'rules' => array('trim', 'numeric', 'less_than_equal_to['.$process['balance'].']'));
      }
      // if(   $process['product_name'] == 'KA Chain' 
      //    &&  $process['process_name'] == 'Hook Process' && $process['department_name'] == 'Hook'&& $process['customer_out']==0){
      // $rules[] = array('field' => 'process_fields[customer_out]', 'label' => 'Customer Out',
      //                  'rules' => array('trim', 'numeric','required','less_than_equal_to['.$process['balance'].']'));
      // }
      if(   $process['process_name'] == 'Sisma Machine Process' 
         && $process['department_name'] == 'Sisma Machine'){
        if($process['balance']>0){
            $rules[] = array('field' => 'process_fields[out_weight]', 'label' => 'Out Weight',
                       'rules' => array('trim', 'numeric', 'less_than_equal_to['.$process['balance'].']'));
        }else{
            $rules[] = array('field' => 'process_fields[out_weight]', 'label' => 'Out Weight',
                       'rules' => array('trim', 'numeric', 'greater_than_equal_to['.$process['balance'].']'));
        }
      }
    }
    
    // if ($process['product_name']=='KA Chain'    && $process['department_name']=='Tarpatta'      && $this->attributes['out_weight'] > 0) {
    //   $rules[] = array('field' => 'process_fields[machine_size]', 'label' => 'Machine Size',
    //                    'rules' => 'trim|required');
    // }

    if ($process['product_name']=='KA Chain'    && $process['department_name']=='Factory'       && isset($this->attributes['factory_out']) && $this->attributes['factory_out'] > 0) {
      $rules[] = array('field' => 'process_fields[factory_out]', 'label' => 'Fancy Out',
                       'rules' => array('trim', 'numeric', 'less_than_equal_to['.$process['balance'].']'));
    }

    // if ($process['product_name']=='KA Chain'    && $process['department_name']=='GPC' && $process['department_name']=='GPC'       && isset($this->attributes['gpc_out']) && $this->attributes['gpc_out'] > 0) {
    //   $rules[] = array('field' => 'process_fields[gpc_out]', 'label' => 'GPC Out',
    //                    'rules' => array('trim', 'numeric', 'less_than_equal_to['.$process['balance'].']'));
    // }
    // if($process['product_name'] == 'Sisma Chain'        && $process['process_name'] == 'Sisma Machine Process'  && $process['department_name'] == 'Sisma Machine' && $process['balance']<0) {
    //   $rules[] = array('field' => 'process_fields[out_weight]', 'label' => 'Out Weight',
    //                    'rules' => array('trim', 'numeric', 'greater_than['.$process['balance'].']'));
    // }


    // if ($process['product_name']=='KA Chain' && $process['department_name']=='Factory'     && isset($this->attributes['out_weight'])    && $this->attributes['out_weight'] > 0) {
    //   $rules[] = array('field' => 'process_fields[karigar]', 'label' => 'Karigar',
    //                    'rules' => 'trim|required');
    // }

    
    // if (!empty($this->attributes['customer_out']) && $this->attributes['customer_out'] > 0) {
    //   $rules[] = array('field' => 'process_fields[customer_name]', 'label' => 'Customer name',
    //                    'rules' => array('trim', 'required', array('check_custome_name_error_msg', array($this,'check_customer_name_exist'))),
    //                    'errors'=> array('check_custome_name_error_msg' => "check same customer_name as selected"));
    // }

    if (($process['product_name']=='Fancy Chain' || $process['product_name']=='Fancy 75 Chain') && ($process['department_name']=='Fancy Hold' ) && isset($this->attributes['out_weight'])    && $this->attributes['out_weight'] > 0) {
      $rules[] = array('field' => 'process_fields[next_department_karigar]', 'label' => 'Karigar',
                       'rules' => 'trim|required');
    }
    if (($process['product_name']=='Fancy Chain' || $process['product_name']=='Fancy 75 RND') && ($process['department_name']=='Fancy Hold' ) && isset($this->attributes['out_weight'])    && $this->attributes['out_weight'] > 0) {
        $rules[] = array('field' => 'process_fields[next_department_karigar]', 'label' => 'Karigar',
                         'rules' => 'trim|required');
      }
    if ($process['tone'] == '2 Tone' && isset($this->attributes['pending_ghiss']) && $this->attributes['pending_ghiss'] != 0) {
      $rules[] = array('field' => 'process_fields[pending_ghiss]', 'label' => 'Pending Ghiss',
                       'rules' => 'trim|required|greater_than_equal_to[0]|less_than_equal_to[0]');
    }

    if (   (($process['process_name'] == 'Pipe and Para Start Process'                 && $process['department_name'] == 'Para and Pipe Making')
         || ($process['process_name'] == 'Pipe and Para Hold Process'                  && $process['department_name'] == 'Hold')       
         || ($process['process_name'] == 'Final Process'                  && $process['department_name'] == 'Buffing')       
         || ($process['process_name'] == 'Pipe and Para Dull Process'                  && $process['department_name'] == 'Dull')       
         || ($process['process_name'] == 'Pipe and Para Lasiya Cutting Process'                  && $process['department_name'] == 'Lasiya Cutting')       
         || ($process['process_name'] == 'Pipe and Para Copper Dull Process'           && $process['department_name'] == 'Stripping')
         || ($process['process_name'] == 'Pipe and Para Round and Ball Chain Process'  && $process['department_name'] == 'Round and Ball Chain')       
         || ($process['process_name'] == 'Pipe and Para Round and Ball Chain Process'  && $process['department_name'] == 'Stripping')       
         || ($process['process_name'] == 'Pipe and Para Hand Cutting Process'          && $process['department_name'] == 'Hand Cutting')       
         || ($process['process_name'] == 'Pipe and Para Hand Cutting III Process'          && $process['department_name'] == 'Hand Cutting III')       
         || ($process['process_name'] == 'Pipe and Para Hand Cutting Process'          && $process['department_name'] == 'Stripping')
         || ($process['process_name'] == 'Pipe and Para Rhodium Process'               && $process['department_name'] == 'Rhodium'))
      && isset($this->attributes['out_weight']) && $this->attributes['out_weight'] > 0) {
       $rules[] = array('field' => 'process_fields[next_department_name]', 'label' => 'Next Process',
                       'rules' => 'trim|required');
    }

    if (isset($this->attributes['out_weight']) && $this->attributes['out_weight'] > 0 
        && $process['split_out_weight'] == 1) {
      if (isset($this->attributes['melting_lot_category_one'])) 
        $rules[] = array('field' => 'process_fields[melting_lot_category_one]', 'label' => 'Category One',
                         'rules' => 'trim|required');
      if (isset($this->attributes['next_department_name'])) 
        $rules[] = array('field' => 'process_fields[next_department_name]', 'label' => 'Next Process / Department',
                         'rules' => 'trim|required');

      if($process['product_name']=='Office Outside' && (!in_array($process['process_name'], array('Pipe and Para 3.25 MM Dot Process','Pipe and Para 3.25 MM Slash Process','Pipe and Para 2 MM Slash Process','Pipe and Para Start Process','Imp Italy Dye Process','Pipe and Para Round and Ball Chain Process','Pipe and Para Dull Process','Pipe and Para Sand Dull Process','Pipe and Para Lasiya Cutting Process','Pipe and Para Stripping Process','Pipe and Para Copper Process','Pipe and Para Copper Dull Process','Pipe and Para CNC Process','Pipe and Para Hand Cutting Process','Pipe and Para Hand Cutting II Process','Pipe and Para Hold Process','Pipe and Para Rhodium Process','Pipe and Para Hand Cutting III Process')))){
        if (empty($this->attributes['next_department_karigar'])) 
          $rules[] = array('field' => 'process_fields[next_department_karigar]', 'label' => 'Karigar','rules' => 'trim|required');
      }else{
        if (isset($this->attributes['karigar'])) 
          $rules[] = array('field' => 'process_fields[karigar]', 'label' => 'Karigar',
                           'rules' => 'trim|required');
      }
    }

    if (isset($this->attributes['karigar']) && $this->attributes['karigar']=='Clipping') {
      $rules[] = array('field' => 'process_fields[concept]', 'label' => 'Clipping Design',
                       'rules' => 'trim|required');
    }

    if($process['product_name']=="Indo tally Chain" && $process['process_name']=="Final Process" && $process['department_name'] == "GPC" && !empty($this->attributes['out_weight'])
      ){
        $tounch_purities=$this->process_model->find('',array('row_id'=>$process['row_id'],'melting_lot_id'=>$process['melting_lot_id'],'product_name'=>'Indo tally Chain','process_name'=>'Final Process','department_name'=>'Castic Process'))['tounch_purity'];
        //pd($this->attributes);
      if($tounch_purities<91.65){
          $rules[] = array('field' => 'out_weight', 'label' => 'Tounch','rules' => array('trim','greater_than_equal_to[91.65]'));
        }
      }
    // if( (HOST=='ARC') && ($process['product_name'] == 'Arc 92 Chain' || $process['product_name'] == 'Arc 75 Chain' || $process['product_name'] == 'Arc Chain'|| $process['product_name'] == 'Casting RND' || $process['product_name'] == 'Lock Process')){
    //   $rules[] = array('field' => 'process_fields[melting_wastage]', 'label' => 'Melting Wastage',
    //                    'rules' => array('trim', 'numeric', 'less_than_equal_to['.$process['balance'].']'));
    // }

    return $rules;    
  }

  public function check_total_hook_in() {
    $process = $this->Process_model->find('',array('id' => $this->attributes['process_id']));
    $processes_weight = $this->Process_model->find('sum(daily_drawer_in_weight) as weight',
                                                   array(
                                                         //'process_name' => $this->attributes['daily_drawer_type'],
                                                         'hook_kdm_purity > ' => $process['hook_kdm_purity'] - 2,
                                                         'hook_kdm_purity < ' => $process['hook_kdm_purity'] + 2,
                                                         'karigar' => $process['karigar'],
                                                         'daily_drawer_in_weight > ' => 0));

    $process_details_weight = $this->process_field_model->find('sum(hook_in-hook_out+daily_drawer_out_weight) as weight,sum(daily_drawer_in_weight) as daily_drawer_in_weight', 
                                                    array(
                                                          //'daily_drawer_type' => $this->attributes['daily_drawer_type'],
                                                          'hook_kdm_purity > ' => $process['hook_kdm_purity'] - 2,
                                                          'hook_kdm_purity < ' => $process['hook_kdm_purity'] + 2,
                                                          'karigar' => $process['karigar']));
    $total = $processes_weight['weight'] - $process_details_weight['weight'] - $this->attributes['hook_in'];
    if ($total >= 0)
      return true;
    else
      return false;
  }
  public function check_design_code() {
    if(($this->attributes['design_code']>0 && $this->attributes['design_code']<5001)||(in_array($this->attributes['design_code'], array("Lotus 10 Gm","Lotus 12 Gm","Lotus 16 Gm","Lotus 20 Gm","Lotus 24 Gm")))){
      return true;
    }else{
      return false;
    }
  }

  public function check_karigar() {
    $process_pending_ghiss=$this->process_field_model->find('pending_ghiss,next_department_karigar',array('next_department_karigar!='=>"",'process_id'=>$this->attributes['process_id']));
    if(!empty($process_pending_ghiss)){
      if($process_pending_ghiss['next_department_karigar']==$this->attributes['next_department_karigar']){
        return true;
      }else{
        return false;
      }
    }else{
      return true;
    }
    
  }
  private function get_category_abbr() {
    foreach (['one', 'two', 'three', 'four'] as $index) {
      if (!isset($this->attributes['melting_lot_category_'.$index])
          || empty($this->attributes['melting_lot_category_'.$index]))
        $this->attributes['melting_lot_category_'.$index] = '';
        $abbr[$index] = substr($this->attributes['melting_lot_category_'.$index], 0, 2);
    }
    return $abbr;
  }

  public function check_customer_name_exist() {
    if(!empty($this->formdata['factory_order_details'])){
      $check_customer=0;
      $is_not_equal=0;
      foreach ($this->formdata['factory_order_details'] as $index => $value) {
        $order_detail=array();
        if(!empty($value['order_ids'])){
        $order_ids=explode(',', $value['order_ids']);
        foreach ($order_ids as $order_index => $order_id) {
         $process_market_order_details=$this->market_order_detail_model->find('market_orders.customer_name',array('market_order_details.id'=>$order_id),array(array('market_orders','market_orders.id=market_order_details.market_order_id')));
         if($process_market_order_details['customer_name']==$this->attributes['customer_name']){
            $check_customer=0;
          }else{
            $check_customer++;
            $is_not_equal++;
          }
        }}
      }
      if ($is_not_equal > 0)
        return false;
      else
        return true;
    }
  }

 
}
