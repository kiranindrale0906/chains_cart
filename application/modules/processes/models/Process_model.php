<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_model extends BaseModel {
  protected $table_name = "processes";
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
    $this->load->model(array('masters/machine_master_model',
                             'melting_lots/melting_lot_model',
                             'melting_lots/parent_lot_model', 'settings/same_karigar_model',
                             'settings/loss_percentage_model', 'wastages/wastage_model','processes/process_group_model',
                             'settings/rod_model','masters/process_detail_field_model','processes/process_archive_model'));
    $this->department_not_deleted = array();
    $this->compute_tounch_loss_fine_departments = array();
    $this->compute_tounch_loss_fine_from_out_weight_departments = array();
    $this->compute_tounch_loss_fine_for_refine_loss = array();
    $this->split_out_weight_departments = array();
    
    $this->set_wastage_purity_equal_to_in_purity = array();
    $this->set_wastage_purity_from_strip_cutting = '';
    $this->set_wastage_purity_to_100 = array();

    $this->set_out_purity_to_100 = array();
    $this->gpc_out_purity_departments = array();
    $this->set_out_lot_purity_from_tounch_purity = array();
    $this->set_wastage_lot_purity_from_tounch_purity = array();

    $this->initialize_attributes_with_default_values();
  }

  function before_validate() {
  $this->save_machine_no();
    $this->attributes['process_sequence'] = $this->get_process_sequence();
    $this->attributes['packing_slip_balance'] =$this->attributes['accept_packing_list'];
    $this->set_in_rod_fields();
    $this->set_split_out_weight();
    $this->set_tounch_no();
    $this->set_fire_tounch_no();
    $this->set_quantity_from_repair_out_quantity();
    
    $this->set_process_fields();
    $this->calculate_field_from_process_details();
    $this->calculate_loss();
    $this->calculate_loss_hcl_loss_tounch_loss_fine();
    $this->calculate_balance();
    $this->calculate_decimal_loss();
    $this->calculate_balance_wastage();
    $this->calculate_hook_kdm_purity();
    $this->calculate_in_purity();
    $this->calculate_out_purity();
    $this->set_wastage_purities();
    $this->calcuate_balance_gross_and_fine();
    // $this->calculate_balance_quantity();
    $this->calculate_tounch_loss_fine();
    $this->set_karigar_name();
    $this->set_completed_at_field();
    //$this->calculate_stone_vatav();

  }	

  public function save_machine_no() {
    $machines = $this->machine_master_model->get('machine_name', 
                      array('product_name' => $this->attributes['product_name'],
                            'process_name' => $this->attributes['process_name'],
                            'department_name' => $this->attributes['department_name'],
                            'category_one' => array('All', $this->attributes['melting_lot_category_one']),
                            'category_two' => array('All', $this->attributes['melting_lot_category_two']),
                            'category_three' => array('All', $this->attributes['melting_lot_category_three']),
                            'category_four' => array('All', $this->attributes['melting_lot_category_four']),
                            'machine_size' => array('All', $this->attributes['machine_size']),
                            'design_code' => array('All', $this->attributes['design_code'])));
    if (count($machines)==1)
      $this->attributes['machine_no'] = $machines[0]['machine_name'];

    if (empty($this->attributes['machine_no'])) return;
    if (isset($this->attributes['id'])
        && isset($this->attributes['machine_no'])
        && !empty($this->attributes['machine_no'])) {
      $process_obj = new Process_model(array('id' => $this->attributes['id']));
      if (empty($process_obj->attributes['machine_no'])) {
        $process_obj->attributes['machine_no'] = @$this->attributes['machine_no'];
        $process_obj->update(false, array(), 'update', false);
      }
    }
  }

  private function set_in_rod_fields() {
    if ($this->attributes['department_name'] == 'Melting') {
      // $in_plain_rod = 0;
      // $in_rod = 0;

      if (!empty($this->attributes['rod_id'])) {
        $rod = $this->rod_model->find('weight', array('id' => $this->attributes['rod_id']));
        $this->attributes['in_plain_rod'] = $rod['weight']; 

        //$last_rod_process = $this->process_model->find('out_rod', array('rod_id' => $this->attributes['rod_id'],
        //                                                                'out_rod > ' => 0), array(), array('id desc'));
        //$in_rod = (!empty($last_rod_process)) ? $last_rod_process['out_rod'] : $in_plain_rod;
      }
    }
  }

  private function set_split_out_weight() {
    if (in_array($this->attributes['department_name'], $this->split_out_weight_departments)) 
      $this->attributes['split_out_weight'] = 1;
  }

  private function get_expected_at($today_working_hour){
    $this->load->model('settings/same_karigar_model');
    $get_due_duration = $this->same_karigar_model->find('due_duration',
                                                         array('department_name'=>$this->attributes['department_name'],
                                                               'product_name'=>$this->attributes['product_name'],
                                                               'process_name'=>$this->attributes['process_name']));

    if(empty($get_due_duration['due_duration']) || $get_due_duration['due_duration'] == '0')
      $get_due_duration['due_duration'] = '21600';

    $get_due_hours = gmdate("H:i:s", $get_due_duration['due_duration']);
    $current_time = date("H:i:s ");
    list ($hr, $min, $sec) = explode(':',$get_due_hours);
  
    $expected_time = date('H:i:s A',strtotime('+'.$hr.' hour +'.$min.' minutes +'.$sec.' seconds',strtotime($current_time)));
    $expected_time_without_am_pm =date('H:i:s',strtotime('+'.$hr.' hour +'.$min.' minutes +'.$sec.' seconds',strtotime($current_time)));
   
    $today_timing = date('H:i:s A',strtotime(($today_working_hour['close_time'])));
    $today_timing_without_am_pm  = date('H:i:s',strtotime(($today_working_hour['close_time'])));

   
    $today_time_set = strtotime(date('H:i:s',strtotime(($today_working_hour['close_time']))));
   
    $time1 = strtotime($current_time);

    $time2 = $today_time_set;


    $difference = abs($time2 - $time1);

    $today_remain_time = gmdate("H:i:s", $difference);
    $diff = abs(strtotime($get_due_hours) - strtotime($today_remain_time));

    //$difference1 = abs(strtotime($diff) - $today_time_set);
    if($today_remain_time >= $get_due_hours){
      return date('Y-m-d').' '.$expected_time;
    }

    $next_day_extended = gmdate("H:i:s", $diff);
   

    $get_next_day = $this->office_day_model->find('selected_date,open_time',array('selected_date >'=>date('Y-m-d'),'is_closed !='=>1));

    list ($hr, $min, $sec) = explode(':',$next_day_extended);

    $expected_time = date('H:i:s A',strtotime('+'.$hr.' hour +'.$min.' minutes +'.$sec.' seconds',
                                                                                        strtotime($get_next_day['open_time']))); 

    if(strtotime(date("H:i:s")) > strtotime($today_timing_without_am_pm)){
      $timremain = gmdate("H:i:s", $get_due_duration['due_duration']);
      list ($hr, $min, $sec) = explode(':',$timremain);
      $expected_time = date('H:i:s A',strtotime('+'.$hr.' hour +'.$min.' minutes +'.$sec.' seconds',
                                                                                        strtotime($get_next_day['open_time'])));

  
                                                                           
      return $get_next_day['selected_date'].' '.$expected_time;
    }

    return $get_next_day['selected_date'].' '.$expected_time;
    
    
    $str_to_time_today_close_time = strtotime($today_timing);

    $str_to_time_current = strtotime($current_time);
  }

  private function get_today_working_hours(){
    $this->load->model('reports/office_day_model');
    return $this->office_day_model->find('open_time,close_time',array('selected_date'=>date('Y-m-d')));
  }

  public function validation_rules($klass=''){
    if (empty($klass)) $klass='update';
    $rules = array();	
     $this->attributes['hallmark_out']=(float)$this->attributes['hallmark_out'];//pd($this->attributes);
     $this->attributes['balance_hallmark_out']=four_decimal($this->attributes['balance_hallmark_out']);//pd($this->attributes);
//pd($this->attributes);
    $rules['store'] = array(
      array('field' => 'lot_no', 'label' => 'Lot No',
            'rules' => array('trim')),

            greater_than_equal_to_0_validation('fe_in'),
            //greater_than_equal_to_0_validation('fe_out'),
            greater_than_equal_to_0_validation('wastage_fe'),
      
            greater_than_equal_to_0_validation('solder_in', 'Solder Powder'),

            greater_than_equal_to_0_validation('melting_wastage'),
            greater_than_equal_to_0_validation('in_melting_wastage'),
            greater_than_equal_to_0_validation('out_melting_wastage'),
            greater_than_equal_to_0_validation('out_opening_melting_wastage'),
            greater_than_equal_to_0_validation('issue_melting_wastage'),
            greater_than_equal_to_0_validation('issue_rejected'),
            //greater_than_equal_to_0_validation('balance_melting_wastage'),

            greater_than_equal_to_0_validation('hcl_wastage'),
            greater_than_equal_to_0_validation('out_hcl_wastage'),
            greater_than_equal_to_0_validation('balance_hcl_wastage'),
            

            greater_than_equal_to_0_validation('ghiss'),
            greater_than_equal_to_0_validation('out_ghiss'),
            greater_than_equal_to_0_validation('issue_ghiss'),
            greater_than_equal_to_0_validation('balance_ghiss'),

            greater_than_equal_to_0_validation('pending_ghiss'),
            greater_than_equal_to_0_validation('out_pending_ghiss'),
            greater_than_equal_to_0_validation('balance_pending_ghiss'),

            greater_than_equal_to_0_validation('hcl_ghiss'),
            greater_than_equal_to_0_validation('out_hcl_ghiss'),
            greater_than_equal_to_0_validation('balance_hcl_ghiss'),

            numeric_validation('loss'),
            
            greater_than_equal_to_0_validation('hook_in'),
            greater_than_equal_to_0_validation('sisma_in'),
            
            numeric_validation('hook_out'),
            numeric_validation('sisma_out'),
            numeric_validation('spring_in'),
            
            numeric_validation('spring_out'),
            numeric_validation('stone_in'),
            numeric_validation('stone_out'),
            numeric_validation('out_stone_vatav'),

            greater_than_equal_to_0_validation('micro_coating'),
      
            // numeric_validation('balance'),
            // numeric_validation('balance_gross'),
            // numeric_validation('balance_fine'),
            
            greater_than_equal_to_0_validation('solder_wastage'),
            greater_than_equal_to_0_validation('out_solder_wastage'),
            greater_than_equal_to_0_validation('balance_solder_wastage'),

            greater_than_equal_to_0_validation('tounch_in'),

            greater_than_equal_to_0_validation('tounch_ghiss'),
            greater_than_equal_to_0_validation('out_tounch_ghiss'),
            greater_than_equal_to_0_validation('balance_tounch_ghiss'),
            
            greater_than_equal_to_0_validation('tounch_out'),
            greater_than_equal_to_0_validation('out_tounch_out'),
            greater_than_equal_to_0_validation('balance_tounch_out'),
            
            greater_than_equal_to_0_validation('fire_tounch_in'),
      
            greater_than_equal_to_0_validation('fire_tounch_out'),
            greater_than_equal_to_0_validation('out_fire_tounch_out'),
            greater_than_equal_to_0_validation('balance_fire_tounch_out'),
            
            greater_than_equal_to_0_validation('expected_out_weight'),
            greater_than_equal_to_0_validation('bounch_out'),
            greater_than_equal_to_0_validation('factory_out'),
            greater_than_equal_to_0_validation('tanishq_out'),
            greater_than_equal_to_0_validation('closing_out'),
            greater_than_equal_to_0_validation('customer_out'),
            greater_than_equal_to_0_validation('recutting_out'),
            greater_than_equal_to_0_validation('repair_out'),

            greater_than_equal_to_0_validation('alloy_weight'),
            greater_than_equal_to_0_validation('out_alloy_weight'),

            greater_than_equal_to_0_validation('in_plain_rod'),
            greater_than_equal_to_0_validation('in_rod'),

            greater_than_equal_to_0_validation('copper_in'),
            greater_than_equal_to_0_validation('copper_out'),

            greater_than_equal_to_0_validation('stone_vatav'),
            // greater_than_equal_to_0_validation('out_stone_vatav'),

            //greater_than_equal_to_0_validation('refine_loss'),

            greater_than_equal_to_0_validation('daily_drawer_in_weight'),
            greater_than_equal_to_0_validation('daily_drawer_out_weight'),

            greater_than_equal_to_0_validation('chitti_out'),

            greater_than_equal_to_0_validation('liquor_in'),
            greater_than_equal_to_0_validation('liquor_out'),

            greater_than_equal_to_0_validation('out_rod'),
            greater_than_equal_to_0_validation('out_machine_gold'),
            
            greater_than_equal_to_0_validation('gemstone_in'),
            greater_than_equal_to_0_validation('gemstone_out'),
            
            array('field' => 'loss', 'label' => 'Loss',
            'rules' => array('trim', 'numeric',
                             array('loss_percentage', array($this,'check_loss_percentage'))),
            'errors' => array('loss_percentage' => 'Loss must be less than loss percentage')),
      
            greater_than_equal_to_0_validation('gpc_out'),
            greater_than_equal_to_0_validation('issue_gpc_out'),
            //greater_than_equal_to_0_validation('balance_gpc_out'),
            greater_than_equal_to_0_validation('hallmark_out'),
            greater_than_equal_to_0_validation('issue_hallmark_out'),
            greater_than_equal_to_0_validation('balance_hallmark_out'),
      
    );
      $rules['store'][] =  numeric_validation('balance');
      $rules['store'][] =  numeric_validation('balance_gross');
      $rules['store'][] =  numeric_validation('balance_fine');
    
    if ($this->attributes['product_name'] == 'Daily Drawer Receipt')
      $rules['store'][] = required_validation('type', 'Daily Drawer Type');
    
    if ($this->attributes['process_name'] == 'Daily Drawer Issue' && $this->attributes['product_name'] == 'Issue')
      $rules['store'][] = required_validation('type', 'Daily Drawer Type');
    // if ($this->attributes['product_name'] == 'KA Chain'
    //     && $this->attributes['department_name'] == 'Box Tar Chain'){
    //   $rules['store'][] =  required_validation('machine_no', 'Machine No');
    
    // } 
    
     

    if (   $this->attributes['product_name'] != 'Receipt' 
        && $this->attributes['product_name'] != 'Hallmark' 
        && $this->attributes['product_name'] != 'Daily Drawer Receipt' 
        && $this->attributes['product_name'] != 'Internal Receipt' 
        && $this->attributes['product_name'] != 'Domestic Internal' 
        && $this->attributes['product_name'] != 'Chain Receipt' 
        && $this->attributes['product_name'] != 'Stone Receipt' 
        && $this->attributes['product_name'] != 'Loss Receipt' 
        && $this->attributes['product_name'] != 'Pending Ghiss Receipt' 
        && $this->attributes['product_name'] != 'Finished Goods Receipt' 
        && $this->attributes['product_name'] != 'Alloy Receipt' 
        && $this->attributes['product_name'] != 'Alloy Issue' 
        && $this->attributes['product_name'] != 'Refresh'
        && $this->attributes['product_name'] != 'Daily Drawer'
        && $this->attributes['process_name'] != 'Ring Chain'
        && $this->attributes['product_name'] != 'Tounch Out'
        && $this->attributes['product_name'] != 'Stone Vatav'
        && $this->attributes['product_name'] != 'Fire Tounch Out'
        && $this->attributes['product_name'] != 'Ghiss Out'
        && $this->attributes['product_name'] != 'Melting Wastage Refine Out'
        && $this->attributes['product_name'] != 'Pending Ghiss Out'
        && $this->attributes['product_name'] != 'Pending Ghiss Issue'
        && $this->attributes['product_name'] != 'HCL Ghiss Out'
        && $this->attributes['product_name'] != 'Loss Out'
        && $this->attributes['product_name'] != 'Melting Loss Out'
        && $this->attributes['product_name'] != 'HCL'
        && $this->attributes['product_name'] != 'Solder Wastage'
        && $this->attributes['product_name'] != 'HCL Ghiss'
        && $this->attributes['product_name'] != 'Daily Drawer Wastage'
        && $this->attributes['product_name'] != 'Pending Loss from Hook'
        && $this->attributes['product_name'] != 'Pending Loss Out'
        && $this->attributes['product_name'] != 'KA Chain'
        && $this->attributes['product_name'] != 'Ball Chain'
        && $this->attributes['product_name'] != 'KA Chain Refresh'
        && $this->attributes['product_name'] != 'Stone'
        && $this->attributes['product_name'] != 'Rhodium Receipt'
        && $this->attributes['product_name'] != 'Hallmark Receipt'
        && $this->attributes['process_name'] != 'Refresh Final Process' 
        && $this->attributes['process_name'] != 'Internal Final Process') 
      $rules['store'][] = array(
            'field' => 'melting_lot_id', 'label' => 'Melting Lot',
            'rules' => array('trim', 'numeric', 'greater_than[0]'));
    
    if ($this->attributes['product_name'] == 'Pending Loss Out') 
      $rules['store'][] = array(
            'field' => 'factory_out', 'label' => 'Additional Wastage',
            'rules' => array('trim', 'numeric', 'greater_than[0]'));
    
    
    if (($this->attributes['next_department_name'] != '' && $this->attributes['product_name'] == 'Sisma Chain') || $this->attributes['product_name'] == 'RND'|| $this->attributes['product_name'] == 'Loss Out'|| $this->attributes['product_name'] == 'Melting Loss Out') {
      $rules['update'] = $rules['store'];
    }elseif (($this->attributes['next_department_name'] != '' && ($this->attributes['product_name'] == 'Fancy Chain' || $this->attributes['product_name']=='Fancy 75 Chain')) && $this->attributes['process_name'] == 'Chain Making ARG Process') {
      $rules['update'] = $rules['store'];
    } elseif (($this->attributes['next_department_name'] != '' && $this->attributes['product_name'] == 'Office Outside') || $this->attributes['product_name'] == 'Para') {
      $rules['update'] = $rules['store'];
    } else { 
      $rules['update'] = array_merge($rules['store'], array(
          array('field' => 'balance', 'label' => 'Balance',
                'rules' => array(array('equal_to_zero', array($this, 'equal_to_zero'))),
                'errors' => array('equal_to_zero' => 'Balance must be equal to zero'))));
    }
    if ($this->attributes['product_name'] != 'Alloy Receipt' && $this->attributes['product_name'] != 'Stone Receipt'&& $this->attributes['product_name'] != 'Loss Receipt'&& $this->attributes['product_name'] != 'Pending Ghiss Receipt' && $this->attributes['product_name'] != 'Alloy Issue') {
      $rules['store'][] = greater_than_equal_to_0_validation('in_lot_purity');
      $rules['store'][] = greater_than_equal_to_0_validation('out_lot_purity');
    }

    $machines = $this->machine_master_model->get('machine_name', 
                      array('product_name' => $this->attributes['product_name'],
                            'process_name' => $this->attributes['process_name'],
                            'department_name' => $this->attributes['department_name'],
                            'category_one' => array('All', $this->attributes['melting_lot_category_one']),
                            'category_two' => array('All', $this->attributes['melting_lot_category_two']),
                            'category_three' => array('All', $this->attributes['melting_lot_category_three']),
                            'category_four' => array('All', $this->attributes['melting_lot_category_four']),
                            'machine_size' => array('All', $this->attributes['machine_size']),
                            'design_code' => array('All', $this->attributes['design_code'])));
    if (!empty($machines)) {
      $rules['update'][] = array('field' => 'machine_no', 'label' => 'Machine No',
                                 'rules' => array('trim','required'));
    }

    if(empty($_POST['is_outside'])){
        if ($this->attributes['product_name'] != 'Sisma Chain' && ($this->attributes['product_name'] != 'Fancy Chain' && $this->attributes['product_name']!='Fancy 75 Chain') && $this->attributes['product_name'] != 'Daily Drawer' &&  $this->attributes['process_name'] != 'RND In Process'
            && $this->attributes['product_name'] != 'Alloy Receipt'
            && $this->attributes['product_name'] != 'Hallmark'
            && $this->attributes['product_name'] != 'Loss Out') {
          $rules['store'][] =  array('field' => 'in_weight', 'label' => 'In Weight',
                                     'rules' => array('trim', 'numeric', 'greater_than[0]',
                                                array('unique_row_id', array($this,'is_row_id_unique'))),
                                     'errors' => array('unique_row_id' => 'Row id must be unique'));
        }
    }

    if ($this->attributes['process_name'] == 'Melting Loss Out') {
      $rules['store'][] = array('field' => 'pending_loss_outs[loss]', 'label' => 'total loss',
                                'rules' => 'trim|required|numeric');
    }
    if (in_array($this->attributes['department_name'], array('GPC','GPC Rhodium', 'GPC Or Rodium', 'Bunch GPC'))) {
      $rules['update'][] = greater_than_equal_to_0_validation('loss');
      $rules['update'][] = greater_than_equal_to_0_validation('micro_coating');
    }

    if ($this->attributes['product_name'] == 'RND' &&  ($this->attributes['process_name'] == 'RND Karigar Receipt' || $this->attributes['process_name'] == 'RND Karigar Issue')) {
      $rules['update'][]=  array('field' => 'out_weight', 'label' => 'Out Weight',
                                'rules' => array('trim', 'numeric', 'greater_than[0]'));
    }

    if ($this->attributes['product_name'] == 'KA Chain' &&  ($this->attributes['process_name'] == 'Vishnu Process' &&  $this->attributes['department_name'] =='Vishnu')) {
      $rules['update'][]=  required_validation('tounch_in');
    }

    if ($this->attributes['product_name'] == 'KA Chain' 
        && $this->attributes['process_name']=='Box Chain Process' 
        && $this->attributes['department_name']=='Solder'
        && $this->attributes['out_weight'] > 0) { 
        $melting_lot = $this->melting_lot_model->find('chain',array('id' => $this->attributes['melting_lot_id']));
      if($melting_lot['chain']=='Vishnu'){
          $rules['store'][] = greater_than_equal_to_0_validation('out_lot_purity', 'Out Lot Purity', 92.2);
      }
    }
    // if ($this->attributes['product_name'] == 'Machine Chain' 
    //     && $this->attributes['process_name']=='Final Process' 
    //     && $this->attributes['department_name']=='Solder') { 
    //       $rules['update'][]=array('field' => 'next_department_karigar', 'label' => 'Next department karigar','rules' => array('trim','required'));
    // }

    if ($this->attributes['product_name'] == 'KA Chain') { 
      if($this->attributes['process_name']=='Box Chain Process' || $this->attributes['process_name']=='Anchor Process'|| $this->attributes['process_name']=='Laser Process'){
        $solder_in=0.01*$this->attributes['in_weight'];
      $rules['update'][]=array('field' => 'solder_in', 'label' => 'Solder In',
                               'rules' => array('trim', 'numeric', 'less_than_equal_to['.$solder_in.']'));
      }else{
      $rules['update'][] = greater_than_equal_to_0_validation('solder_in');
      }

      if($this->attributes['process_name']=='Vishnu Process'){
        $solder_in=0.01*$this->attributes['in_weight'];
      $rules['update'][]=array('field' => 'alloy_weight', 'label' => 'Solder In',
                               'rules' => array('trim', 'numeric', 'less_than_equal_to['.$solder_in.']'));
      }else{
      $rules['update'][] = greater_than_equal_to_0_validation('alloy_weight', 'Solder In');
      }
      
      if($this->attributes['process_name']=='Hammering II Process' && $this->attributes['department_name']=='Hammering II'){
        $rules['update'][]= required_validation('next_department_name');
      }
    }

    if (($this->attributes['product_name'] == 'Hollow Choco Chain' && $this->attributes['process_name'] == 'PL Flatting Process' 
            && $this->attributes['department_name'] == 'Final') ||
        ($this->attributes['product_name'] == 'Indo tally Chain' && $this->attributes['process_name'] == 'PL Flatting' 
            && $this->attributes['department_name'] == 'Wire Drawing')) {
      $rules['update'][] = array('field' => 'wastage_purity', 'label' => 'Wastage Purity',
                                 'rules' => array('trim', array('check_wastage_purity', array($this,'is_wastage_purity_set'))),
                                 'errors' => array('check_wastage_purity' => 'HCL Melting Process is not done'));
    }
    
    if ($this->attributes['product_name'] == 'KA Chain' 
        && $this->attributes['order_detail_id'] == 0    && (   $this->attributes['department_name'] == 'Ashish'
                                                            || $this->attributes['department_name'] == 'Laser'
                                                            || $this->attributes['department_name'] == 'Hammering I'
                                                            || $this->attributes['department_name'] == 'Vishnu'
                                                            || $this->attributes['department_name'] == 'Clipping')) {
      $rules['update'][] = required_validation('design_code');
    }

    if ($this->attributes['out_rod'] > 0)
      $rules['update'][] = greater_than_equal_to_0_validation('out_rod', 'Out Rod', $this->attributes['in_plain_rod']);
    if (HOST=="AR Gold" && in_array($this->attributes['department_name'],array("Tounch Department"))) {
        $melting_department_detail=$this->process_model->find('in_lot_purity',array('melting_lot_id'=>$this->attributes['melting_lot_id'],'department_name'=>"Tounch Hold Department"));
       if(!empty($melting_department_detail)){
        $greater_than=$melting_department_detail['in_lot_purity']-0.20;
        $less_than=$melting_department_detail['in_lot_purity']+0.20;
        $rules['update'][] = array('field' => 'tounch_purity', 'label' => 'tounch_purity',
                                  'rules' => array('trim', 'numeric','required', 'greater_than_equal_to['.$greater_than.']','less_than_equal_to['.$less_than.']'));
        }
      }
    $process_rules = $this->add_controller_to_validation_rules($this->router_class, $klass, $rules[$klass]);

		return $process_rules;	
	}

  public function is_row_id_unique(){ 
    $where_conditions = array('product_name' => $this->attributes['product_name'],
                              'department_name' => $this->attributes['department_name'],
                              'process_name' => $this->attributes['process_name'],
                              'row_id' => $this->attributes['row_id']);

    if (isset($this->attributes['id'])) 
      $where_conditions['id !='] = $this->attributes['id'];

    $result = $this->find('id', $where_conditions);
    //lq();
    return (empty($result) ? true : false);
  }

  public function is_wastage_purity_set(){ 
    if ($this->attributes['balance'] == 0) {
      if ($this->attributes['wastage_purity'] > 0 || $this->attributes['wastage_lot_purity'] > 0) {
        return true;
      } else{
        return false;
      }
    } else {
      return true;
    }
  }

  public function check_loss_percentage(){
    $max_loss_percentage = $this->loss_percentage_model->find('max_loss_percentage', 
                                                          array('product_name' => $this->attributes['product_name'],
                                                                'department_name' => $this->attributes['department_name'],
                                                                'process_name' => $this->attributes['process_name']));
    //if (isset($this->attributes['id']) && $this->attributes['id']==53139) return true;
    if (empty($max_loss_percentage) || ($max_loss_percentage['max_loss_percentage']==0)) return true;
    $max_loss = $max_loss_percentage['max_loss_percentage'] / 100 * $this->attributes['out_weight'];
    return ($max_loss >= $this->attributes['loss']);
  }

	public function after_save($action) {
    $departments = $this->get_departments();
    $this->set_process_field_attributes();
    
    if ($this->attributes['product_name'] == 'Pending Ghiss Receipt') return;

    if(    (   $this->attributes['gemstone_in'] > 0 || $this->attributes['gemstone_out'] > 0)
        && (   $this->attributes['department_name'] == 'Polish' 
            || $this->attributes['department_name'] == 'Chain Making' 
            || $this->attributes['department_name'] == 'Buffing I') ){
      $this->attributes['gemstone_in']= $this->attributes['gemstone_in']-$this->attributes['gemstone_out'];  
    }
    
    $force_create = isset($this->formdata['force_create']) ? $this->formdata['force_create'] : FALSE;
    
    //if($this->attributes['product_name'] != 'Receipt' && $this->attributes['product_name'] != 'Pending Loss Out')
    $this->set_purity_from_previous_department($this->attributes['id'], $this->attributes['in_purity'], $this->attributes['in_lot_purity'], FALSE);
    
    $this->create_next_process_record('', array(), $force_create);
    
    if($this->attributes['repair_out'] > 0){ 
      $this->load->model('refresh/refresh_hold_model');
      $this->refresh_hold_model->create_refresh_records($this->attributes); 
    }

    $this->create_melting_wastage_record_from_in_melting_wastage();

    //  if($this->attributes['closing_out'] > 0){ 
    //       $process=array(
    //         'department_name' => $this->attributes['department_name'],
    //         'process_name' => $this->attributes['process_name'],
    //         'product_name' => $this->attributes['product_name'],
    //         'lot_no' => $this->attributes['lot_no'],
    //         'parent_id' => $this->attributes['id'],
    //         'melting_lot_id' => $this->attributes['melting_lot_id'],
    //         'row_id' => rand(),
    //         'in_lot_purity' => $this->attributes['in_lot_purity'],
    //         'out_lot_purity' => $this->attributes['out_lot_purity'],
    //         'in_weight' => $this->attributes['closing_out'],
    //         'in_purity' => $this->attributes['out_purity'],
    //         'out_weight' =>$this->attributes['closing_out'],
    //         'karigar' => $this->attributes['karigar'],
    //         'quantity' => $this->attributes['quantity'],
    //         'no_of_bunch' => $this->attributes['no_of_bunch'],
    //         'tone' => $this->attributes['tone'],
    //         'design_code' => $this->attributes['design_code']
    //       ); 
    //       $model_name = get_model_name($process['product_name'], $process['process_name']);
    //       $this->load->model($model_name['module_name'].'/'.$model_name['model_name']);
          
    //       $process_obj = new $model_name['model_name']($process);
    //       $process_obj->before_validate();
    //       $process_obj->save(true);
    // }

    //$this->set_current_process_status_completed();
    $this->set_lot_process_hide();
    $this->set_lot_row_id($this->attributes['id']);
  }

  public function set_lot_process_hide(){
    $departments = $this->get_departments();
    if ($this->attributes['process_name']!="Hallmark Receipt"&&$this->attributes['department_name'] == end($departments) && $this->attributes['balance']==0){
      $process_archive_obj = new process_archive_model($this->attributes);
      $process_archive_obj->attributes['archive'] = 1;
      $process_archive_obj->update();
    }
  }
  public function create_melting_wastage_record_from_in_melting_wastage() {
    if ($this->attributes['in_melting_wastage'] == 0) return; 
    
    if (   $this->attributes['product_name'] == 'Internal' 
        && $this->attributes['department_name'] == 'Final' ) {
      $this->load->model('receipt_departments/chain_receipt_model');
      $this->chain_receipt_model->create_in_melting_wastage_record($this->attributes); 
    } else {
      $this->load->model('receipt_departments/receipt_department_model');
      $this->receipt_department_model->create_in_melting_wastage_record($this->attributes); 
    }
  }

  public function before_save($action){
    if($action == 'store'){
      $today_working_hour = $this->get_today_working_hours();
      //$this->attributes['expected_at']   = $this->get_expected_at($today_working_hour);
      if($this->attributes['department_name']!="Hallmark Out Hold"){
      $this->attributes['hallmark_quantity']=$this->attributes['quantity'];
      }
    }
    $this->attributes['loss_percentage']   = $this->get_loss_percent();
  }

  private function get_loss_percent(){
    if ($this->attributes['loss_percentage'] != 0) return $this->attributes['loss_percentage'];

    if (!empty($this->attributes['product_name']))
      $loss_percentage = @$this->loss_percentage_model->find('loss_percentage', array('product_name' => $this->attributes['product_name'], 
                                                                                      'process_name' => $this->attributes['process_name'],
                                                                                      'department_name' => $this->attributes['department_name'],
                                                                                      'karigar_name' => $this->attributes['karigar']))['loss_percentage'];
    $loss_percentage = (!empty($loss_percentage)) ? $loss_percentage : 0;
    return $loss_percentage;
  }

  public function get($select = '*', $conditions = array(), $joins = array(), $operations=array()) {
    if (!empty($this->attributes['product_name'])) $conditions['product_name'] = $this->attributes['product_name'];
    if (!empty($this->attributes['process_name'])) $conditions['process_name'] = $this->attributes['process_name'];
    return parent::get($select, $conditions, $joins, $operations);
  }

  public function get_model_object($process) {
    $module_name_model_name = get_model_name($process['product_name'], $process['process_name']);
    $module_name = $module_name_model_name['module_name'];
    $model_name = $module_name_model_name['model_name'];
    $this->load->model($module_name.'/'.$model_name);
    $process_obj = new $model_name($process);
    return $process_obj;
  }

  public function delete($id, $conditions=array(), $permanent_delete=TRUE, $after_delete=TRUE){
    ini_set('max_execution_time', '0');
    $data = $this->check_fields_before_delete($id);
    if ($data)
      return parent::delete($id, $conditions, $permanent_delete, $after_delete); 
  }

  public function check_fields_before_delete($id) {
    //$department_name=$this->find('department_name', array('id' => $id))['department_name'];
    $process = $this->find('*', array('id' => $id));
    //$parent_process = $this->find('*', array('id' => $process['parent_id']));
    //if(!empty($this->department_not_deleted) && in_array($department_name, $this->department_not_deleted))
    //  return false;

    $next_process = $this->process_model->find('id', array('parent_id' => $process['id']));
    if (!empty($next_process)) {
      return false;
    }
    
    if (   $process['out_melting_wastage'] > 0      || $process['out_rejected'] > 0      || $process['issue_melting_wastage'] > 0 || $process['issue_rejected'] > 0      || $process['out_opening_melting_wastage'] > 0
        || $process['out_daily_drawer_wastage'] > 0 || $process['issue_daily_drawer_wastage'] > 0
        || $process['out_cz_wastage'] > 0 || $process['issue_cz_wastage'] > 0
        || $process['out_hcl_wastage'] > 0          
        || $process['out_tounch_out'] > 0           || $process['out_fire_tounch_out'] > 0
        || $process['out_ghiss'] > 0                || $process['issue_ghiss'] > 0
        || $process['out_loss'] > 0                 || $process['issue_loss'] > 0 
        || $process['out_pending_ghiss'] > 0
        || $process['out_solder_wastage'] > 0 
        || $process['out_hcl_ghiss'] > 0            || $process['out_loss'] > 0 
        || $process['out_tounch_ghiss'] > 0
        || $process['issue_hcl_loss'] > 0
        || $process['issue_tounch_loss_fine'] > 0 
        || $process['issue_gpc_out'] > 0) {
      return false;
    } 

//    if (!empty($parent_process)) {
//      if (   $parent_process['out_melting_wastage'] > 0      || $parent_process['issue_melting_wastage'] > 0       || $parent_process['out_opening_melting_wastage'] > 0
//          || $parent_process['out_daily_drawer_wastage'] > 0 || $parent_process['issue_daily_drawer_wastage'] > 0  || $parent_process['out_opening_daily_drawer_wastage'] > 0 
//          || $parent_process['out_hcl_wastage'] > 0          || $parent_process['out_tounch_out'] > 0              || $parent_process['out_fire_tounch_out'] > 0
//          || $parent_process['out_ghiss'] > 0                || $parent_process['issue_ghiss'] > 0                 || $parent_process['out_opening_ghiss'] > 0 
//          || $parent_process['out_loss'] > 0                 || $parent_process['issue_loss'] > 0 
//          || $parent_process['out_pending_ghiss'] > 0        || $parent_process['out_copper_ghiss'] > 0            || $parent_process['out_opening_pending_ghiss'] > 0
//          || $parent_process['out_solder_wastage'] > 0 
//          || $parent_process['out_hcl_ghiss'] > 0 
//          || $parent_process['issue_out'] > 0                || $parent_process['out_tounch_ghiss'] > 0
//          || $parent_process['issue_repair_out'] > 0         || $parent_process['issue_hcl_loss'] > 0
//          || $parent_process['issue_tounch_loss_fine'] > 0
//          || $parent_process['issue_gpc_out'] > 0|| $parent_process['gemstone_out'] > 0) {
//          //|| $parent_process['department_name'] == 'Start') {
//        return false;
//      }
//    }
    return true; 
  }
  
  private function calculate_field_from_process_details() {
    $results = $this->process_detail_field_model->get('field_name', array('product_name'=>$this->attributes['product_name'],
                                                                          'process_name'=>$this->attributes['process_name'],
                                                                          'department_name'=>$this->attributes['department_name']));
    if (!$this->load->is_model_loaded('process_field_model'))
      $this->load->model('processes/process_field_model');
    foreach ($results as $key => $field_name) {
      if (  !empty($this->attributes['id'])
          && $field_name['field_name'] != 'karigar') {
        $processes_field = $this->process_field_model->find('sum('.$field_name["field_name"].') as total_weight',array('process_id'=>$this->attributes['id']));
        $this->attributes[$field_name["field_name"]] = round($processes_field['total_weight'],8);
      }
    }
  }

  public function calculate_balance() {	
    $this->attributes['balance'] = round($this->attributes['in_weight'] 

                                        + $this->attributes['fe_in']
                                        + $this->attributes['copper_in']
                                        + $this->attributes['stone_in']
                                        + $this->attributes['solder_in']
                                        + $this->attributes['alloy_weight']
                                        + $this->attributes['in_rod']
                                        + $this->attributes['in_machine_gold']

                                        + $this->attributes['hook_in']
                                        + $this->attributes['sisma_in']
                                        - $this->attributes['hook_out']
                                        - $this->attributes['sisma_out']
                                        - $this->attributes['accept_packing_list']
                                        - $this->attributes['rejected']
                                        + $this->attributes['spring_in']
                                        - $this->attributes['spring_out']

                                        + $this->attributes['rhodium_in']
                                        + $this->attributes['micro_coating']
                                        + @$this->attributes['stone_vatav']
                                        - @$this->attributes['out_stone_vatav']
                                        - @$this->attributes['stone_out']
                                        + @$this->attributes['liquor_in']
                                        - @$this->attributes['liquor_out']
                                        - $this->attributes['out_rod']
                                        - $this->attributes['out_machine_gold']
                                        
                                        - $this->attributes['fe_out']
                                        - $this->attributes['bounch_out']
                                        - $this->attributes['factory_out']
                                        - $this->attributes['tanishq_out']
                                        - $this->attributes['customer_out']
                                        - $this->attributes['recutting_out']
                                        // - $this->attributes['rejected']
                                        - $this->attributes['closing_out']
                                        - $this->attributes['copper_out']
                                        - $this->attributes['out_weight'] 
                                        + $this->attributes['flash_wire'] 

                                        - $this->attributes['daily_drawer_in_weight']
                                        - $this->attributes['daily_drawer_out_weight']

                                        - $this->attributes['refine_loss']
                                        - $this->attributes['out_alloy_weight']

                                        - $this->attributes['melting_wastage'] 
                                        - $this->attributes['in_melting_wastage'] 
                                        - $this->attributes['solder_wastage'] 
                                        - $this->attributes['hcl_wastage']  
                                        - $this->attributes['daily_drawer_wastage'] 
                                        - $this->attributes['cz_wastage'] 
                                        - $this->attributes['wastage_fe'] 

                                        - $this->attributes['tounch_in'] 
                                        - $this->attributes['fire_tounch_in'] 
                                        - $this->attributes['ghiss']
                                        - $this->attributes['hcl_ghiss'] 
                                        - $this->attributes['pending_ghiss'] 
                                        - $this->attributes['loss']
                                        - $this->attributes['karigar_loss']
                                        - $this->attributes['pending_loss']
                                        - $this->attributes['enamel_loss']

                                        - $this->attributes['next_department_wastage']

                                        - $this->attributes['gpc_out']
                                        - $this->attributes['hallmark_out']
                                        - $this->attributes['rejected_out']
                                        - $this->attributes['repair_out'],9);
    // if ($this->attributes['gross_loss'] > 0){
    //     // $this->attributes['fe_out'] = round($this->attributes['balance'] + $this->attributes['loss'] - $this->attributes['gross_loss'],8);
    //     // $this->attributes['balance'] = $this->attributes['balance'] + $this->attributes['loss'] - $this->attributes['gross_loss'] - $this->attributes['fe_out'];
    //     $this->attributes['balance'] = $this->attributes['balance'] + $this->attributes['loss'] - $this->attributes['gross_loss'];
    // }
    if ($this->attributes['hallmark_in'] > 0){
        $this->attributes['balance'] = $this->attributes['balance'] +  $this->attributes['issue_hallmark_out'];
    }
	    // pd($this->attributes);

  }

  public function calculate_decimal_loss() {
    if (   $this->attributes['balance'] != 0 
        && $this->attributes['balance'] < 0.0001 
        && $this->attributes['balance'] > -0.0001) {
      $this->attributes['refine_loss'] = round(($this->attributes['refine_loss'] + $this->attributes['balance']), 9);
      $this->attributes['balance'] = 0;
    }
  }
  // public function calculate_balance_quantity() {
  //     $this->attributes['balance_quantity'] = $this->attributes['balance_quantity']-$this->attributes['out_quantity']-$this->attributes['rejected_qty'];
  // }

  public function set_quantity_from_repair_out_quantity() {
    if ($this->attributes['repair_out_quantity'] > 0) {
      $process = $this->process_model->find('quantity,hallmark_quantity', array('id' => $this->attributes['parent_id']));
      if (!empty($process)) 
        $this->attributes['quantity'] = $process['quantity'] - $this->attributes['repair_out_quantity'];
    }
    if ($this->attributes['meena_quantity'] > 0) {
      $process = $this->process_model->find('quantity,hallmark_quantity', array('id' => $this->attributes['parent_id']));
      if (!empty($process))
        $this->attributes['quantity'] = $process['quantity'] - $this->attributes['repair_out_quantity'] - $this->attributes['meena_quantity'];
    }
    // if ($this->attributes['hallmark_quantity'] > 0) {
    //   $process = $this->process_model->find('quantity,hallmark_quantity', array('id' => $this->attributes['parent_id']));
    //   if (!empty($process)) 
    //     $this->attributes['quantity'] = $process['hallmark_quantity'];
    // }
  }

  public function set_copper_out_in_cutting_department() {
    if($this->attributes['department_name'] == 'Stripping') {
      $cutting_process = $this->find('id, parent_id, in_weight, out_weight, daily_drawer_wastage, cz_wastage, in_purity, in_lot_purity,
                                      out_purity, ghiss', array('id' => $this->attributes['parent_id']));
      $total_copper_out = 0;
      if (   $this->attributes['product_name'] == 'KA Chain'
          || $this->attributes['process_name'] == 'Yellow And White Gold Cutting Process'
          || $this->attributes['process_name'] == 'Pipe and Para Hand Cutting Process'
          || $this->attributes['process_name'] == 'Pipe and Para Round and Ball Chain Process'
          || $this->attributes['process_name'] == 'Pipe and Para CNC Process') {
        $start_process = $this->find('id, parent_id', array('id' => $cutting_process['parent_id']));
        $copper_process = $this->process_model->find('id, copper_in, in_lot_purity', array('id' => $start_process['parent_id']));
      } elseif ($this->attributes['process_name'] == 'Pipe and Para Copper Dull Process') {
        $dull_process   = $this->find('id, parent_id', array('id' => $cutting_process['parent_id']));
        $start_process  = $this->find('id, parent_id', array('id' => $dull_process['parent_id']));
        $copper_process = $this->process_model->find('id, copper_in, in_lot_purity', array('id' => $start_process['parent_id']));
      } elseif ($this->attributes['product_name'] == 'Ball Chain') {
        $this->load->model('ball_chains/Ball_chain_copper_cutting_two_tone_process_model');
        $copper_process = $this->process_model->find('id, copper_in, in_lot_purity, out_lot_purity', array('id' => $this->attributes['copper_process_id']));
        $where = array('copper_process_id' => $this->attributes['copper_process_id']);
        if (!empty($this->attributes['id'])) $where['id != '] = $this->attributes['id'];
        $other_stripping_processes = $this->process_model->find('sum(copper_out) as copper_out, sum(in_weight) as in_weight', $where);
        if (!empty($other_stripping_processes)) 
          $total_copper_out = $other_stripping_processes['copper_out'];
        $cutting_process = $this->Ball_chain_copper_cutting_two_tone_process_model->find('id, parent_id, in_weight, out_weight, daily_drawer_wastage, in_purity, in_lot_purity, out_purity, ghiss', 
                                                            array('copper_process_id' => $this->attributes['copper_process_id'],
                                                                  'department_name' => 'Round and Ball Chain Cutting'));
      } else 
        $copper_process = $this->find('id, copper_in, in_lot_purity', array('id' => $cutting_process['parent_id']));

      $this->attributes['expected_out_weight'] = $this->attributes['in_weight'] - $copper_process['copper_in'] + $total_copper_out;
    }
  }

  protected function set_process_fields() {
    if($this->attributes['department_name']=='Stripping') {
      $this->set_copper_out_in_cutting_department();
    }

    if (   $this->attributes['department_name']=='HCL'
        || $this->attributes['department_name']=='HCL Process') {
      $this->attributes['expected_out_weight'] = $this->attributes['balance_gross'] * $this->attributes['in_purity'] / 100;
      if (   $this->attributes['product_name'] == 'Machine Chain' 
          && $this->attributes['process_name'] == 'Final Process'
          && $this->attributes['department_name'] == 'HCL') {
        $this->attributes['min_hcl_loss'] =  $this->attributes['expected_out_weight'] - 2;
        $this->attributes['max_hcl_loss'] =  $this->attributes['expected_out_weight'] + 2;
      }
      if (   $this->attributes['out_weight'] > 0
          || $this->attributes['daily_drawer_in_weight'] > 0) {
        $this->attributes['fe_out'] = $this->attributes['in_weight'] - $this->attributes['out_weight'] - $this->attributes['daily_drawer_in_weight'] - $this->attributes['tounch_in'];
        $next_department_process = $this->process_model->find('id', array('parent_id' => $this->attributes['strip_cutting_process_id']));
        if ($this->attributes['strip_cutting_process_id'] == 0
            || empty($next_department_process))
          $this->attributes['hcl_loss'] = $this->attributes['expected_out_weight'] - ($this->attributes['out_weight'] + $this->attributes['daily_drawer_in_weight'] + $this->attributes['tounch_in']);
        else
          $this->attributes['hcl_loss'] = 0;
      }
    }

    // if ($this->attributes['product_name']=='Loss Out' && $this->attributes['process_name']=='Melting' && $this->attributes['department_name']=='Melting') {
    //   $this->attributes['expected_out_weight'] = $this->attributes['in_weight'] * $this->attributes['in_purity'] / 100;
    //   $this->attributes['wastage_fe'] = round($this->attributes['in_weight'] - $this->attributes['expected_out_weight'], 10);
    //   if ($this->attributes['melting_wastage'] > 0 && $this->attributes['out_lot_purity'] > 0) {
    //     $this->attributes['refine_loss'] = $this->attributes['expected_out_weight'] - $this->attributes['melting_wastage'];
    //   }
    // }  

    // if($this->attributes['department_name']=='Strip HCL') {
    //   $this->attributes['expected_out_weight'] = $this->attributes['in_weight'] * $this->attributes['in_purity'] / 100;
    //   if ($this->attributes['tounch_in'] > 0) {
    //     $this->attributes['fe_out'] = $this->attributes['in_weight'] - $this->attributes['tounch_in'];
    //     $this->attributes['hcl_loss'] = $this->attributes['expected_out_weight'] - $this->attributes['tounch_in'];
    //   }
    // }
  }

  // protected function calculate_stone_vatav() {
  //   if (HOST=='ARC') {
  //     $this->attributes['stone_vatav']=$this->attributes['stone_in']-$this->attributes['stone_out'];
  //   }
  // }

  protected function calculate_loss() {
    if ($this->attributes['out_weight'] > 0) {
      if(isset($this->auto_compute_loss_departments) && !empty($this->auto_compute_loss_departments)) {
        if (in_array($this->attributes['department_name'], $this->auto_compute_loss_departments)) {
          $this->calculate_balance();
          if($this->attributes['product_name']=='Indo tally Chain' 
             || $this->attributes['product_name']=='Imp Italy Chain'
             || $this->attributes['product_name']=='Hollow Choco Chain' 
             || $this->attributes['product_name']=='Sisma Chain' 
             || $this->attributes['product_name']=='Fancy Chain' 
             || $this->attributes['product_name']=='Lotus Chain' 
             || $this->attributes['product_name']=='Roco Choco Chain' 
             || $this->attributes['product_name']=='Fancy 75 Chain' 
             || $this->attributes['product_name']=='Choco Chain'
             || $this->attributes['product_name']=='Rope Chain'
             || $this->attributes['product_name']=='Solid Rope Chain'
             || $this->attributes['product_name']=='Machine Chain'
             || $this->attributes['product_name']=='Rolex Chain'
             || $this->attributes['product_name']=='Round Box Chain'/*
             || $this->attributes['product_name']=='KA Chain'*/) {
            if($this->attributes['process_name']=="Karigar Bom Process"){
//pd($this->attributes);
             if($this->attributes['next_department_name']==""){
              $this->attributes['loss'] = two_decimal($this->attributes['loss_percentage'] / 100 * $this->attributes['out_weight']);
             }
            }else{
            $this->attributes['loss'] = two_decimal($this->attributes['loss_percentage'] / 100 * $this->attributes['out_weight']);
            }
          } else {
            $this->attributes['loss'] = $this->attributes['balance'];
          }
        }
      }
    }
$this->attributes['loss'] = four_decimal($this->attributes['loss']);
//pd($this->attributes['loss']);
    // if (HOST=='AR Gold' && $this->attributes['id'] == 1919) $this->attributes['loss'] = 0;
    //  if (HOST=='AR Gold' && $this->attributes['id'] == 11243) $this->attributes['loss'] = 200.44;
  }
  public function calculate_loss_hcl_loss_tounch_loss_fine() {
    if(   $this->attributes['out_weight'] != 0
       && $this->attributes['process_name']=="Final Process" 
       && $this->attributes['department_name']=="Walnut" 
       && (   $this->attributes['product_name']=="Indo tally Chain" 
           || $this->attributes['product_name']=="Hollow Choco Chain")) {
      $this->attributes['gross_loss'] = $this->attributes['in_weight'] - $this->attributes['out_weight']; 
      $this->attributes['loss'] = $this->attributes['gross_loss'];
      $this->attributes['hcl_loss'] = 0; //($this->attributes['gross_loss'] - $this->attributes['loss']);
      $this->attributes['fe_out'] = 0;
      //$this->attributes['tounch_loss_fine']=($this->attributes['gross_loss']*(($this->attributes['in_purity']-100)/100)*($this->attributes['in_lot_purity']/100));

    }
  }

  // protected function calculate_micro_coating() {
  //   if (HOST=='ARF') return;
  //   if (HOST=='ARC') return;
  //   if (HOST=='AR Gold' || HOST=='ARG') return;

  //   if ($this->attributes['department_name'] == 'GPC' 
  //       || $this->attributes['department_name'] == 'GPC Or Rodium'
  //       || $this->attributes['department_name'] == 'Bunch GPC' ) {
  //     if ($this->attributes['gpc_out'] > 0 || $this->attributes['repair_out'] > 0) {
  //       $this->attributes['micro_coating'] = 0;
  //       $this->attributes['loss'] = 0;
  //       $this->calculate_balance();  
  //       $this->attributes['micro_coating'] = -1 * $this->attributes['balance'];
  //       if ($this->attributes['micro_coating'] < 0) {
  //         $this->attributes['loss'] = -1 * $this->attributes['micro_coating']; 
  //         $this->attributes['micro_coating'] = 0;
  //       }
  //     }
  //   }
  // }

  public function get_out_weight($model_name, $field_name) {
    // pd($field_name);
  $this->load->model(array('export_internals/packing_slip_detail_model'));
   $out_weight = 0;$out_record =array();
    if($model_name=="packing_slip_detail_model" && $field_name=="Packing Slip"){
	if(!empty($this->attributes['id'])){
	       $out_record = $this->$model_name->find('sum(gross_weight) as out_weight', array('process_id' => $this->attributes['id']));
	
	}
        if (!empty($out_record)) $out_weight = $out_record['out_weight'];
    }elseif($model_name!="packing_slip_detail_model"){
      if (isset($this->attributes['id'])) {
        $this->load->model(array('processes/process_out_wastage_detail_model',
                                 'issue_departments/issue_department_detail_model'));
        $out_record = $this->$model_name->find('sum(out_weight) as out_weight', array('process_id' => $this->attributes['id'],
                                                                                      'field_name' => $field_name));
        if (!empty($out_record)) $out_weight = $out_record['out_weight'];
      }
    }
    return $out_weight;
  }

  public function get_out_weight_from_melting_lot_detail() {
    $this->load->model(array('melting_lots/melting_lot_detail_model'));
    if (isset($this->attributes['id'])) {
      $out_weight = $this->melting_lot_detail_model->get('sum(required_weight) as out_weight',
                                                         array('process_id' => $this->attributes['id']));

      if (!empty($out_weight) && $out_weight[0]['out_weight'] > 0)
        return $out_weight[0]['out_weight'];
      else
        return 0;
    }
    return 0;
  }

  public function calculate_balance_wastage($field_name='') {
    if ($field_name == 'Tounch Loss Fine') {
      $this->attributes['issue_tounch_loss_fine'] = $this->get_out_weight('issue_department_detail_model', 'Tounch Loss Fine');
      $this->attributes['balance_tounch_loss_fine'] = $this->attributes['tounch_loss_fine'] - $this->attributes['issue_tounch_loss_fine'];
    // } elseif ($field_name == 'Melting Wastage Refine Out') {
    //   $this->attributes['balance_melting_wastage'] = $this->attributes['balance_melting_wastage'] - $this->attributes['out_melting_wastage'];
    } else {
      $this->attributes['issue_tounch_loss_fine'] = $this->get_out_weight('issue_department_detail_model', 'Tounch Loss Fine');
      $this->attributes['balance_tounch_loss_fine'] = $this->attributes['tounch_loss_fine'] - $this->attributes['issue_tounch_loss_fine'];

      $this->attributes['out_melting_wastage'] = $this->get_out_weight_from_melting_lot_detail();
      $this->attributes['out_melting_wastage'] += $this->get_out_weight('process_out_wastage_detail_model', 'Melting Wastage Refine Out');
      $this->attributes['issue_melting_wastage'] = $this->get_out_weight('issue_department_detail_model', 'Melting Wastage');
      $this->attributes['issue_rejected'] = $this->get_out_weight('issue_department_detail_model', 'Export Internal');
      $this->attributes['balance_melting_wastage'] = round(($this->attributes['melting_wastage'] 
                                                     - $this->attributes['out_melting_wastage'] - $this->attributes['issue_melting_wastage']
                                                     - $this->attributes['out_opening_melting_wastage']), 9);  //+ $this->attributes['in_melting_wastage'] 

      $this->attributes['balance_rejected'] = round(($this->attributes['rejected'] - $this->attributes['issue_rejected']), 9);

      $this->attributes['out_daily_drawer_wastage'] = $this->get_out_weight('process_out_wastage_detail_model', 
                                                                            'Daily Drawer Wastage');
      $this->attributes['issue_daily_drawer_wastage'] = $this->get_out_weight('issue_department_detail_model', 
                                                                              'Daily Drawer Wastage');
      $this->attributes['balance_daily_drawer_wastage'] = round(($this->attributes['daily_drawer_wastage'] 
                                                          - $this->attributes['out_daily_drawer_wastage'] - $this->attributes['issue_daily_drawer_wastage']), 9);
      $this->attributes['out_cz_wastage'] = $this->get_out_weight('process_out_wastage_detail_model', 
                                                                            'CZ Wastage');
      $this->attributes['issue_cz_wastage'] = $this->get_out_weight('issue_department_detail_model', 
                                                                              'CZ Wastage');
      $this->attributes['balance_cz_wastage'] = round(($this->attributes['cz_wastage'] 
                                                          - $this->attributes['out_cz_wastage'] - $this->attributes['issue_cz_wastage']), 9);
      //if (isset($this->attributes['id']) && $this->attributes['id']==53139) $this->attributes['balance_daily_drawer_wastage']=0;
      
      $this->attributes['out_hcl_wastage'] = $this->get_out_weight('process_out_wastage_detail_model', 'HCL Wastage');
      $this->attributes['balance_hcl_wastage'] = $this->attributes['hcl_wastage'] - $this->attributes['out_hcl_wastage'];
      
      $this->attributes['out_solder_wastage'] = $this->get_out_weight('process_out_wastage_detail_model', 'Solder Wastage');  
      $this->attributes['balance_solder_wastage'] = $this->attributes['solder_wastage'] - $this->attributes['out_solder_wastage'];

      $this->attributes['out_tounch_out'] = $this->get_out_weight('process_out_wastage_detail_model', 'Tounch Out');
      $this->attributes['balance_tounch_out'] = $this->attributes['tounch_out'] - $this->attributes['out_tounch_out'];
      
      $this->attributes['out_fire_tounch_out'] = $this->get_out_weight('process_out_wastage_detail_model', 'Fire Tounch Out');
      $this->attributes['balance_fire_tounch_out'] = $this->attributes['fire_tounch_out'] - $this->attributes['out_fire_tounch_out'];

      $this->attributes['out_ghiss'] = $this->get_out_weight('process_out_wastage_detail_model', 'Ghiss Out');
      if(!empty($field_name) && $field_name=='Ice Cutting Ghiss')
        $this->attributes['issue_ghiss'] = $this->get_out_weight('issue_department_detail_model', 'Ice Cutting Ghiss');
      elseif(!empty($field_name) && $field_name=='Hand Cutting Ghiss')
        $this->attributes['issue_ghiss'] = $this->get_out_weight('issue_department_detail_model', 'Hand Cutting Ghiss');
      elseif(!empty($field_name) && $field_name=='Hand Dull Ghiss')
        $this->attributes['issue_ghiss'] = $this->get_out_weight('issue_department_detail_model', 'Hand Dull Ghiss');
      elseif(!empty($field_name) && $field_name=='Sand Dull Ghiss')
        $this->attributes['issue_ghiss'] = $this->get_out_weight('issue_department_detail_model', 'Sand Dull Ghiss');
      elseif(!empty($field_name) && $field_name=='Ghiss Melting Loss')

        $this->attributes['issue_loss'] = $this->get_out_weight('issue_department_detail_model', 'Ghiss Melting Loss');
      elseif(!empty($field_name) && $field_name=='Castic Loss')
        $this->attributes['issue_loss'] = $this->get_out_weight('issue_department_detail_model', 'Castic Loss');
      elseif(!empty($field_name) && $field_name=='Chitti Out')

        $this->attributes['issue_chitti_out'] = $this->get_out_weight('issue_department_detail_model', 'Chitti Out');
      elseif(!empty($field_name) && $field_name=='Cutting Ghiss')
        $this->attributes['issue_ghiss'] = $this->get_out_weight('issue_department_detail_model', 'Cutting Ghiss');
      elseif(!empty($field_name) && $field_name=='Fire Tounch Loss')

        $this->attributes['issue_refine_loss'] = $this->get_out_weight('issue_department_detail_model', 'Fire Tounch Loss');
      elseif(!empty($field_name) && $field_name=='Refine Loss')

        $this->attributes['issue_refine_loss'] = $this->get_out_weight('issue_department_detail_model', 'Refine Loss');
      
      $this->attributes['balance_ghiss'] = $this->attributes['ghiss'] 
                                           - $this->attributes['out_ghiss'] - $this->attributes['issue_ghiss'];
      $this->attributes['balance_chitti_out'] = $this->attributes['chitti_out']- $this->attributes['issue_chitti_out'];

      $this->attributes['out_hcl_ghiss'] = $this->get_out_weight('process_out_wastage_detail_model', 'HCL Ghiss Out');
      $this->attributes['balance_hcl_ghiss'] = $this->attributes['hcl_ghiss'] - $this->attributes['out_hcl_ghiss'];

      $this->attributes['out_loss'] = $this->get_out_weight('process_out_wastage_detail_model', array('Loss Out', 'Melting Loss Out'));
      $this->attributes['balance_loss'] = $this->attributes['loss'] + $this->attributes['karigar_loss'] + $this->attributes['pending_loss']
                                        + $this->attributes['enamel_loss']
                                          - $this->attributes['out_loss'] - $this->attributes['issue_loss'];
                                          // print_r($this->attributes['loss']);
                                          // print_r($this->attributes['karigar_loss']);
                                          // print_r($this->attributes['pending_loss']);
                                          // print_r($this->attributes['out_loss']);
                                          // pd($this->attributes['issue_loss']);

      $this->attributes['out_tounch_ghiss'] = $this->get_out_weight('process_out_wastage_detail_model', 'Tounch Ghiss Out');
      $this->attributes['balance_tounch_ghiss'] = $this->attributes['tounch_ghiss'] - $this->attributes['out_tounch_ghiss'];

      $this->attributes['issue_hcl_loss'] = $this->get_out_weight('issue_department_detail_model', 'HCL Loss');
      $this->attributes['balance_hcl_loss'] = $this->attributes['hcl_loss'] - $this->attributes['issue_hcl_loss'];

      //$this->attributes['issue_refine_loss'] = $this->get_out_weight('issue_department_detail_model', 'Refine Loss');
      $this->attributes['balance_refine_loss'] = $this->attributes['refine_loss'] - $this->attributes['issue_refine_loss'];

      $this->attributes['out_pending_ghiss'] = $this->get_out_weight('process_out_wastage_detail_model', 'Pending Ghiss Out');
      $this->attributes['balance_pending_ghiss'] = $this->attributes['pending_ghiss'] - $this->attributes['out_pending_ghiss'];

      $this->attributes['issue_gpc_out'] = $this->get_out_weight('issue_department_detail_model', array('GPC Out', 'GPC Repair Out', 'Finish Good', 'Huid', 'QC Out'));

      $this->attributes['balance_gpc_out'] = $this->attributes['gpc_out'] - $this->attributes['issue_gpc_out'] - $this->attributes['out_gpc_out'];
      $this->attributes['issue_hallmark_out'] = $this->get_out_weight('issue_department_detail_model', array('Hallmark Out'));
       $this->attributes['balance_hallmark_out'] = $this->attributes['hallmark_out'] - $this->attributes['issue_hallmark_out'];
      $this->attributes['issue_rejected'] = $this->get_out_weight('issue_department_detail_model',array('Export Internal','Domestic Internal'));
      $this->attributes['balance_rejected'] = round(($this->attributes['rejected'] - $this->attributes['issue_rejected']), 9);
       $this->attributes['out_packing_slip'] = $this->get_out_weight('packing_slip_detail_model',"Packing Slip");
      //pd($this->attributes['out_packing_slip']);
      $this->attributes['packing_slip_balance'] = $this->attributes['accept_packing_list']-$this->attributes['out_packing_slip'];
    }
  }

  protected function calculate_in_purity() {
    if ($this->attributes['department_name'] == $this->set_wastage_purity_from_strip_cutting) {
      $this->load->model('hcl/hcl_melting_process_model');
      $hcl_process_record = $this->hcl_melting_process_model->find('expected_out_weight, out_weight, in_purity', 
                                                              array('strip_cutting_process_id' => $this->attributes['parent_id'],
                                                                    'out_weight > ' => 0));
      if (!empty($hcl_process_record)) {
        $additional_gold = $hcl_process_record['expected_out_weight'] - $hcl_process_record['out_weight'];
        $gross_weight  = $additional_gold + ($this->attributes['in_weight'] * $hcl_process_record['in_purity']/100);
        $this->attributes['in_purity'] = $gross_weight * 100 / $this->attributes['in_weight'];
      } 
    }
  }

  public function set_wastage_purities() {
    $this->set_wastage_purity_equal_to_in_purity[] = 'GPC';
    $this->set_wastage_purity_equal_to_in_purity[] = 'GPC Rhodium';
    $this->set_wastage_purity_equal_to_in_purity[] = 'GPC Or Rodium';
    $this->set_wastage_purity_equal_to_in_purity[] = 'Bunch GPC';
    if (  (   in_array($this->attributes['department_name'], $this->set_wastage_purity_equal_to_in_purity)
           || $this->attributes['hook_in']  != 0   
           || $this->attributes['hook_out'] != 0
           || $this->attributes['sisma_in']  != 0   
           || $this->attributes['sisma_out'] != 0)
       && (   $this->attributes['out_weight'] > 0 
           || $this->attributes['gpc_out'] > 0 
           || $this->attributes['balance'] != 0)
       && $this->attributes['fe_in'] == 0
       && $this->attributes['fe_out'] == 0
       && $this->attributes['wastage_fe'] == 0) {  
      $this->attributes['wastage_purity']     = $this->attributes['in_purity'];
      $this->attributes['wastage_lot_purity'] = $this->attributes['in_lot_purity'];
    } elseif (in_array($this->attributes['department_name'], $this->set_wastage_purity_to_100)) {
      $this->attributes['wastage_purity']     = 100;
      $this->attributes['wastage_lot_purity'] = $this->attributes['in_lot_purity'];
    } elseif (in_array($this->attributes['department_name'], $this->set_wastage_lot_purity_from_tounch_purity)) {
      $this->attributes['wastage_purity'] = 100;
      $this->attributes['wastage_lot_purity'] = ($this->attributes['tounch_purity'] > 0) ? $this->attributes['tounch_purity'] : $this->attributes['in_lot_purity'];
    // } elseif(   $this->attributes['out_weight'] != 0
    //    && $this->attributes['process_name']=="Final Process" 
    //    && $this->attributes['department_name']=="Walnut" 
    //    && (   $this->attributes['product_name']=="Indo tally Chain" 
    //        || $this->attributes['product_name']=="Hollow Choco Chain")) {
    //   $this->attributes['wastage_purity']     = 100;
    //   $this->attributes['wastage_lot_purity'] = $this->attributes['out_lot_purity'];
    } elseif ($this->attributes['process_name'] == 'Fire Tounch Daily Drawer Wastage') {
      $this->attributes['wastage_purity'] = 100;
      $this->attributes['wastage_lot_purity'] = 100;  
    } else {
      $this->attributes['wastage_purity']     = $this->attributes['out_purity'];
      $this->attributes['wastage_lot_purity'] = $this->attributes['out_lot_purity'];
    }
  } 

  protected function calculate_out_purity() {
    if (in_array($this->attributes['department_name'], $this->set_out_lot_purity_from_tounch_purity)) {
      $this->attributes['out_purity'] = 100;
      $this->attributes['out_lot_purity'] = ($this->attributes['tounch_purity'] > 0) ? $this->attributes['tounch_purity'] : $this->attributes['in_lot_purity'];
      return ;
    }

    if ($this->attributes['department_name']=='Refine Melting'){
      $this->attributes['out_purity'] = $this->attributes['out_purity'];
      $this->attributes['out_lot_purity'] = $this->attributes['out_lot_purity'];
      return ;
    }

    $this->gpc_out_purity_departments[] = 'Fancy Out';
    $this->gpc_out_purity_departments[] = 'GPC';
    //$this->gpc_out_purity_departments[] = 'GPC Rhodium';
    $this->gpc_out_purity_departments[] = 'Packing';
    $this->gpc_out_purity_departments[] = 'GPC Or Rodium';
    $this->gpc_out_purity_departments[] = 'GPC Or R/D';
    $this->gpc_out_purity_departments[] = 'Bunch GPC';
    // $this->gpc_out_purity_departments[] = 'Start';
    $this->gpc_out_purity_departments[] = 'Final';
    $this->gpc_out_purity_departments[] = 'Start';
    $this->gpc_out_purity_departments[] = 'Bunch GPC Final';
    $this->gpc_out_purity_departments[] = 'Finish Good';
    if (in_array($this->attributes['department_name'], $this->gpc_out_purity_departments)) {
      $melting_lot = $this->melting_lot_model->find('lot_purity',array('id' => $this->attributes['melting_lot_id']));
      $melting_lot_purity = (empty($melting_lot)) ? $this->attributes['in_lot_purity'] : $melting_lot['lot_purity'];
      $this->attributes['out_purity'] =$this->attributes['in_purity'] ;
      if ($melting_lot_purity >= 89) {
        //if ($this->attributes['department_name'] == 'Lock Filing')          $this->attributes['out_lot_purity'] = 91.80;
        if ($this->attributes['department_name'] == 'Fancy Out')            $this->attributes['out_lot_purity'] = 91.80; //$melting_lot_purity;
        elseif ($this->attributes['department_name'] == 'Start') $this->attributes['out_lot_purity'] =$melting_lot_purity;
        else                                                                $this->attributes['out_lot_purity'] = 92.00;
      
      }elseif ($this->attributes['department_name'] == 'Start') $this->attributes['out_lot_purity'] =$melting_lot_purity;
      elseif ($melting_lot_purity >= 80 && $melting_lot_purity < 86)      $this->attributes['out_lot_purity'] = 83.75;
      elseif ($melting_lot_purity >= 86 && $melting_lot_purity < 89)        $this->attributes['out_lot_purity'] = 88;
      
      elseif ($melting_lot_purity >= 65 && $melting_lot_purity < 80) {
        //if ($this->attributes['department_name'] == 'Lock Filing')          $this->attributes['out_lot_purity'] = 75.15;
        if ($this->attributes['department_name'] == 'Fancy Out')        $this->attributes['out_lot_purity'] = 75.25;

        elseif ($this->attributes['department_name'] == 'Start') $this->attributes['out_lot_purity'] =$melting_lot_purity;
        
        else                                                            $this->attributes['out_lot_purity'] = 75.00;
      
      } elseif ($melting_lot_purity >= 50 && $melting_lot_purity < 60) {
        $this->attributes['out_lot_purity'] = 58.50;
      }elseif ($melting_lot_purity >= 37 && $melting_lot_purity < 40) {
        $this->attributes['out_lot_purity'] = 37.50;
      } else {
        $this->attributes['out_lot_purity'] = 41.7;
      }
      if($this->attributes['product_name']=="Domestic Internal"){
        $this->attributes['out_lot_purity']=$this->attributes['in_lot_purity'];
      }                                                               
      return ;
    }

    $this->set_out_purity_to_100[] = 'Stripping';
    $this->set_out_purity_to_100[] = 'HCL';
    $this->set_out_purity_to_100[] = 'HCL Process';
    if (in_array($this->attributes['department_name'], $this->set_out_purity_to_100)) {
      $this->attributes['out_purity'] = 100;
      $this->attributes['out_lot_purity'] = $this->attributes['in_lot_purity'];
      return;
    }

    if (   $this->attributes['hook_in'] != 0   || $this->attributes['hook_out'] != 0 ||
        $this->attributes['sisma_in'] != 0   || $this->attributes['sisma_out'] != 0 
        || $this->attributes['solder_in'] != 0 || $this->attributes['alloy_weight'] != 0 
        || $this->attributes['fe_in'] != 0     || $this->attributes['wastage_fe'] != 0    || $this->attributes['fe_out'] != 0
        || $this->attributes['in_melting_wastage'] != 0
        || in_array($this->attributes['department_name'], $this->set_wastage_purity_equal_to_in_purity)
        || in_array($this->attributes['department_name'], $this->set_wastage_purity_to_100)) {
      $in_weight       = $this->attributes['in_weight'];
      $in_weight_gross = $in_weight * $this->attributes['in_purity'] / 100;
      $in_weight_fine  = $in_weight_gross * $this->attributes['in_lot_purity'] / 100;

      $fe_weight             = $this->attributes['fe_in'] - $this->attributes['wastage_fe'] - $this->attributes['fe_out'];
      $hook_and_alloy_weight =   $this->attributes['hook_in'] - $this->attributes['hook_out'] 
                               + $this->attributes['solder_in'] + $this->attributes['alloy_weight']
                               - $this->attributes['in_melting_wastage'];
      $hook_fine             =   (($this->attributes['hook_in'] - $this->attributes['hook_out']) * $this->attributes['hook_kdm_purity'] / 100)
                               - ($this->attributes['in_melting_wastage'] * $this->attributes['in_lot_purity'] / 100);                           

      $wastage_weight = $wastage_weight_gross = $wastage_weight_fine = 0;
      if (  (    $this->attributes['hook_in'] != 0 
              || $this->attributes['hook_out'] != 0 
              || in_array($this->attributes['department_name'], $this->set_wastage_purity_equal_to_in_purity))
          && (  $this->attributes['out_weight'] > 0 
              //|| $this->attributes['balance'] != 0
              )) {
        $wastage_weight       =   $this->attributes['hcl_wastage'] + $this->attributes['hcl_ghiss'] + $this->attributes['loss'] 
                                + $this->attributes['melting_wastage'] + $this->attributes['daily_drawer_wastage']+ $this->attributes['cz_wastage'] + $this->attributes['ghiss'] + $this->attributes['pending_ghiss'] 
                                + $this->attributes['tounch_in'] + $this->attributes['fire_tounch_in'] + $this->attributes['solder_wastage'];

        $wastage_weight_gross = $wastage_weight * $this->attributes['in_purity'] / 100;
        $wastage_weight_fine  = $wastage_weight_gross * $this->attributes['in_lot_purity'] / 100;
      } elseif (in_array($this->attributes['department_name'], $this->set_wastage_purity_to_100)) {
        $wastage_weight       = $this->attributes['in_weight'] - $this->attributes['out_weight'];
        $wastage_weight_gross = $wastage_weight; 
        $wastage_weight_fine  = $wastage_weight_gross * $this->attributes['in_lot_purity'] / 100;
      }

      if (  (    $this->attributes['hook_in'] != 0 
              || $this->attributes['hook_out'] != 0)
          && (   $this->attributes['fe_in'] != 0     
              || $this->attributes['wastage_fe'] != 0    
              || $this->attributes['fe_out'] != 0)) {

        //in case of addition of fe_in where hook is also added.... wastage_purity will be same as out_purity
        //do not reduce wastage_weight from in_weight in calculation
        $total_in_weight       = $in_weight + $fe_weight + $hook_and_alloy_weight;
        $total_in_weight_gross = $in_weight_gross + $hook_and_alloy_weight;
        $total_in_weight_fine  = $in_weight_fine + $hook_fine;
        echo 1;
      } else {

        //in case of addition of fe_in where hook is also added.... wastage_purity will be same as in_purity
        //reduce wastage_weight from in_weight in calculation
        $total_in_weight       = $in_weight + $fe_weight + $hook_and_alloy_weight - $wastage_weight-$this->attributes['melting_wastage'];
        $total_in_weight_gross = $in_weight_gross + $hook_and_alloy_weight - $wastage_weight_gross-$this->attributes['melting_wastage'];
        $total_in_weight_fine  = $in_weight_fine + $hook_fine - $wastage_weight_fine-$this->attributes['melting_wastage'];
        echo 0;
      }
      

      if ($total_in_weight != 0 && $total_in_weight_gross != 0) {
        $this->attributes['out_purity']     = $total_in_weight_gross / $total_in_weight * 100;
        $this->attributes['out_lot_purity'] = $total_in_weight_fine / $total_in_weight_gross * 100;

        echo $total_in_weight;echo "kk";echo $total_in_weight_fine;echo "kk";echo $this->attributes['out_lot_purity'];echo "kk"; pd($total_in_weight_gross);
        return;
      }
    }

    if ($this->attributes['process_name'] == 'Fire Tounch Daily Drawer Wastage') {
      $this->attributes['out_purity'] = 100;
      $this->attributes['out_lot_purity'] = 100;  
      return; 
    } 
    $this->attributes['out_purity'] = $this->attributes['in_purity'];
    $this->attributes['out_lot_purity'] = $this->attributes['in_lot_purity'];
  }

  protected function calculate_hook_kdm_purity() {
    if ($this->attributes['product_name']=='Internal' && $this->attributes['department_name']=='Final'){
      if ($this->attributes['tounch_purity'] !=0) {
        $this->attributes['hook_kdm_purity'] = $this->attributes['tounch_purity'];
        return true;
      } 
    }

    if ($this->attributes['process_name'] == 'Fire Tounch Daily Drawer Wastage') {
      $this->attributes['hook_kdm_purity'] = 100;
      return; 
    } 

    if (HOST=='ARF') {
      if ($this->attributes['in_lot_purity'] >= 40 && $this->attributes['in_lot_purity'] < 45)
        $this->attributes['hook_kdm_purity'] = 41.70;
      elseif ($this->attributes['in_lot_purity'] >= 37 && $this->attributes['in_lot_purity'] <= 38)
        $this->attributes['hook_kdm_purity'] = 37.50;
      elseif ($this->attributes['in_lot_purity'] >= 57 && $this->attributes['in_lot_purity'] < 60)
        $this->attributes['hook_kdm_purity'] = 58.50;
      elseif ($this->attributes['product_name'] =="Daily Drawer Receipt" && $this->attributes['process_name'] =="GPC Powder")
        $this->attributes['hook_kdm_purity'] = $this->attributes['in_lot_purity'];
      elseif ($this->attributes['in_lot_purity'] >= 60 && $this->attributes['in_lot_purity'] < 80)
        $this->attributes['hook_kdm_purity'] = 75.25;
      elseif ($this->attributes['in_lot_purity'] >= 80 && $this->attributes['in_lot_purity'] < 86)
        $this->attributes['hook_kdm_purity'] = 83.35;
      elseif ($this->attributes['in_lot_purity'] >= 86 && $this->attributes['in_lot_purity'] <= 88.99)
        $this->attributes['hook_kdm_purity'] = 87.65;
      elseif ($this->attributes['in_lot_purity'] == 100)
        $this->attributes['hook_kdm_purity'] = 100.00;
      else 
        $this->attributes['hook_kdm_purity'] = 91.80;
      return true;
    }

    if (HOST=='ARG' || HOST=='AR Gold') {
      if ($this->attributes['type'] == 'GPC Powder') 
        $this->attributes['hook_kdm_purity'] = 70;
      elseif ($this->attributes['in_lot_purity'] >= 41 && $this->attributes['in_lot_purity'] < 42)
        $this->attributes['hook_kdm_purity'] = 41.70;
      elseif ($this->attributes['in_lot_purity'] >= 37 && $this->attributes['in_lot_purity'] <= 38)
        $this->attributes['hook_kdm_purity'] = 37.50;
      
      elseif ($this->attributes['in_lot_purity'] >= 56 && $this->attributes['in_lot_purity'] < 60)
        $this->attributes['hook_kdm_purity'] = 58.50;
      elseif ($this->attributes['in_lot_purity'] >= 60 && $this->attributes['in_lot_purity'] < 80)
        $this->attributes['hook_kdm_purity'] = 75.15;
      elseif ($this->attributes['in_lot_purity'] >= 80 && $this->attributes['in_lot_purity'] < 86)
        $this->attributes['hook_kdm_purity'] = 83.50;
      elseif ($this->attributes['in_lot_purity'] >= 86 && $this->attributes['in_lot_purity'] <= 88)
        $this->attributes['hook_kdm_purity'] = 87.65;
      elseif ($this->attributes['in_lot_purity'] == 100)
        $this->attributes['hook_kdm_purity'] = 100.00;
      else 
        $this->attributes['hook_kdm_purity'] = 91.85;
      return true;
    }

    if (HOST =='ARC') {
      if ($this->attributes['type'] == 'GPC Powder') 
        $this->attributes['hook_kdm_purity'] = 70;
      elseif ($this->attributes['in_lot_purity'] >= 41 && $this->attributes['in_lot_purity'] < 42)
        $this->attributes['hook_kdm_purity'] = 41.70;
      elseif ($this->attributes['in_lot_purity'] >= 37 && $this->attributes['in_lot_purity'] < 38)
        $this->attributes['hook_kdm_purity'] = 37.50;
      elseif ($this->attributes['in_lot_purity'] >= 58 && $this->attributes['in_lot_purity'] < 59)
        $this->attributes['hook_kdm_purity'] = 58.50;
      elseif ($this->attributes['in_lot_purity'] >= 70 && $this->attributes['in_lot_purity'] <= 79.99)
        $this->attributes['hook_kdm_purity'] = 75.05;
       elseif ($this->attributes['in_lot_purity'] >= 88.51 && $this->attributes['in_lot_purity'] <= 93)
        $this->attributes['hook_kdm_purity'] = 91.75;
      elseif ($this->attributes['in_lot_purity'] >= 86 && $this->attributes['in_lot_purity'] <= 88)
        $this->attributes['hook_kdm_purity'] = 87.65;
      elseif ($this->attributes['in_lot_purity'] >= 82 && $this->attributes['in_lot_purity'] <= 85)
        $this->attributes['hook_kdm_purity'] = 83.50;
      else 
        $this->attributes['hook_kdm_purity'] = 0;
      return true;
    }

    // if ($this->attributes['hook_kdm_purity']==0) {
    //   if (   $this->attributes['product_name'] == 'Daily Drawer Wastage'
    //       || $this->attributes['product_name'] == 'Office Outside') {
    //     $this->attributes['hook_kdm_purity']=$this->attributes['in_lot_purity'];
    //   } elseif ($this->attributes['melting_lot_id'] != 0) {
    //     $melting_lot = $this->melting_lot_model->find('hook_kdm_purity', 
    //                                                   array('id' => $this->attributes['melting_lot_id']));
    //     if (empty($melting_lot)) {
    //       $previous_process_hook_kdm_purity = $this->process_model->find('hook_kdm_purity', array('id' => $this->attributes['parent_id']));
    //       $this->attributes['hook_kdm_purity'] = $previous_process_hook_kdm_purity['hook_kdm_purity'];
    //     } else
    //       $this->attributes['hook_kdm_purity'] = $melting_lot['hook_kdm_purity'];
    //   } else {
    //     if($this->attributes['in_lot_purity'] < 80)
    //       $this->attributes['hook_kdm_purity'] = 75.15;
    //     elseif($this->attributes['in_lot_purity'] >= 80 && $this->attributes['in_lot_purity'] < 88)
    //       $this->attributes['hook_kdm_purity'] = 83.65;
    //     else 
    //       $this->attributes['hook_kdm_purity'] = 92.00;
    //   }
    // }
  }

  public function calcuate_balance_gross_and_fine() {
    if ($this->attributes['balance'] == 0) {
      $this->attributes['balance_gross'] = 0;
      $this->attributes['balance_fine'] = 0;        
    } elseif ($this->attributes['out_rod'] == 0 && $this->attributes['in_rod'] > 0) {
      $this->attributes['balance_gross'] = ($this->attributes['balance'] * $this->attributes['in_purity'] / 100) - $this->attributes['in_plain_rod'];
      $this->attributes['balance_fine']  = $this->attributes['balance_gross'] * $this->attributes['in_lot_purity'] / 100;
    } elseif ($this->attributes['hook_in'] != 0 || $this->attributes['hook_out'] != 0) {
      $this->attributes['balance_gross'] = ($this->attributes['balance'] * $this->attributes['out_purity'] / 100);
      $this->attributes['balance_fine']  = $this->attributes['balance_gross'] * $this->attributes['out_lot_purity'] / 100;
    }elseif ($this->attributes['sisma_in'] != 0 || $this->attributes['sisma_out'] != 0) {
      $this->attributes['balance_gross'] = ($this->attributes['balance'] * $this->attributes['out_purity'] / 100);
      $this->attributes['balance_fine']  = $this->attributes['balance_gross'] * $this->attributes['out_lot_purity'] / 100;
    } else {
      $this->attributes['balance_gross'] = ($this->attributes['balance'] * $this->attributes['in_purity'] / 100);
      $this->attributes['balance_fine']  = $this->attributes['balance_gross'] * $this->attributes['in_lot_purity'] / 100;
    }

    $this->attributes['balance_gross'] = round($this->attributes['balance_gross'], 7);
    $this->attributes['balance_fine']  = round($this->attributes['balance_fine'], 7);
  }

  protected function set_karigar_name() {
    if ($this->attributes['product_name'] == 'Daily Drawer Receipt') return;
    if ($this->attributes['product_name'] == 'Daily Drawer Wastage') return;
    if ($this->attributes['product_name'] == 'Stone Issue') return;
    if ($this->attributes['product_name'] == 'Issue') return;
    if ($this->attributes['product_name'] == 'Pending Loss from Hook') return;
    if ($this->attributes['product_name'] == 'RND') return;
    if ($this->attributes['product_name'] == 'Sisma Accessories Making Chain' && $this->attributes['department_name']!="Final") return;

    $karigars = $this->same_karigar_model->get('karigar_name', array('product_name' => $this->attributes['product_name'],
                                                                     'process_name' => $this->attributes['process_name'],
                                                                     'department_name' => $this->attributes['department_name']));
    $karigar_names = array_column($karigars, 'karigar_name');
    
    $parent_process =$this->process_model->find('next_department_karigar', array('id' => $this->attributes['parent_id']));
    if (!empty($parent_process) && !empty($parent_process['next_department_karigar'])){
      $this->attributes['karigar'] = $parent_process['next_department_karigar'];
    }elseif($this->attributes['process_name'] != 'Pipe and Para Final Process') {
      if((in_array($this->attributes['department_name'], array('Polish','Stone Setting','Filing','Final')))) {
        // karigar is set manually by user
      } else {
       if (count($karigars) == 1){
        $this->attributes['karigar'] = $karigars[0]['karigar_name'];
        }elseif (count($karigars) == 0 || (!in_array($this->attributes['karigar'], $karigar_names))) {
          $this->attributes['karigar'] = '';
        }
      }
      if(HOST=="AR Gold" ||  HOST=="ARG"){
        if($this->attributes['product_name']=='Refresh'){
          $this->attributes['karigar'] ="Refresh";
        }
        if($this->attributes['product_name']=='Lopster Making Chain' && $this->attributes['process_name']=='Buffing Process' ){
          $this->attributes['karigar'] ="Factory";
        }
      }
    }
  }

  protected function get_process_sequence() {
    return array_search($this->attributes['department_name'], $this->get_departments());
  }

  protected function set_tounch_no() {
    $this->attributes['tounch_no'] = ($this->attributes['tounch_in'] > 0 && isset($this->attributes['id'])) ? $this->attributes['id'] : 0;
  }  

  protected function set_fire_tounch_no() {
  	if ($this->attributes['fire_tounch_in'] > 0
        && $this->attributes['fire_tounch_no'] == 0)
      $this->attributes['fire_tounch_no'] = isset($this->attributes['id']) ? $this->attributes['id'] : 0;
  }

  protected function get_next_process_model($process_field_attributes = array()) {
    return $this->next_process_model;
  }
  
  public function create_next_process_record($model_name='', $process_field_attributes = array(), $force_create = false, $set_parent_id = false) {
    $departments = $this->get_departments();

    if ($this->attributes['department_name'] == end($departments) && empty($this->get_next_process_model($process_field_attributes))) return;
    if (   (empty($this->attributes['out_weight']) || $this->attributes['out_weight'] ==0) 
        && empty($process_field_attributes['out_weight'])) return;

    if (!empty($model_name))
      $class_name = $model_name;
    elseif ($this->attributes['department_name'] != end($departments))
      $class_name = get_class($this);
    elseif (!empty($this->get_next_process_model($process_field_attributes))) {
      $next_process_model = $this->get_next_process_model($process_field_attributes); 
      $this->load->model($next_process_model);
      $class_name = explode('/', $next_process_model)[1];
    }

    $current_process = $this->attributes;
    $next_process = new $class_name(array('parent_id' => $current_process['id']));
    $process_where['where']=array('parent_id' => $this->attributes['id']);
    $process_where['where_in']=array('product_name NOT' => array('"Fire Tounch Out"', '"Receipt"'),
                                     'process_name NOT' => array('"Karigar Process"','"Karigar Bom Process"','"Mangalsutra Process"','"Mangalsutra Process"','"Para"','"Chain Making ARG Process"'));

    if (!$force_create) {
      $processes=$this->process_model->find('id', $process_where);
      if(!empty($processes)) return;
    }
    //$class_name = (empty($model_name)) ? get_class($this) : $model_name;

    foreach($process_field_attributes as $process_field_name => $process_field_value) 
      $current_process[$process_field_name] = $process_field_value;
    //if(empty($this->attributes['out_weight'])) return;
    //if (empty($model_name)) {
    // pd($current_process);
    if ($class_name == get_class($this)) {
      $next_process->attributes['process_sequence'] = $current_process['process_sequence'] + 1;
      $next_process->attributes['out_weight'] = 0; 
    } else {
      $next_process->attributes['process_sequence'] = 0;
      $next_process->attributes['out_weight'] = 0;
    }   

    if (isset($process_field_attributes['product_name'])) $next_process->attributes['product_name'] = $current_process['product_name'];

    $next_process->attributes['parent_id'] = ($set_parent_id==true)?$current_process['parent_id']:$current_process['id'];
    $next_process->attributes['parent_process_detail_id'] = (isset($process_field_attributes['parent_process_detail_id'])) ? $process_field_attributes['parent_process_detail_id'] : 0;
    $next_process->attributes['parent_lot_id'] = $current_process['parent_lot_id'];
    $next_process->attributes['parent_lot_name'] = $current_process['parent_lot_name'];
    
    $next_process->attributes['status'] = 'Pending';
    $next_process->attributes['type'] = $current_process['type'];
    $next_process->attributes['copper_process_id'] = $current_process['copper_process_id'];
    $next_process->attributes['melting_lot_id'] = $current_process['melting_lot_id'];
    $next_process->attributes['row_id'] = (isset($current_process['row_id'])) ? $current_process['row_id'] : $current_process['melting_lot_id'];
    $next_process->attributes['lot_row_id'] = $current_process['melting_lot_id']."-".$current_process['id'];
    $next_process->attributes['lot_no'] = $current_process['lot_no']; 
    $next_process->attributes['account'] = $current_process['account']; 
    $next_process->attributes['factory_issue_department_id'] = $current_process['factory_issue_department_id']; 
    $next_process->attributes['in_lot_purity'] = $current_process['out_lot_purity']; 
    $next_process->attributes['out_lot_purity'] = $current_process['out_lot_purity']; 
    $next_process->attributes['hook_kdm_purity'] = $current_process['hook_kdm_purity']; 
    $next_process->attributes['karigar'] = $current_process['karigar'];
    $next_process->attributes['worker'] = $current_process['worker'];
    $next_process->attributes['input_type'] = $current_process['input_type'];
    $next_process->attributes['next_department_karigar'] = $current_process['next_department_karigar'];
    $next_process->attributes['department_name'] =$next_process->get_departments()[$next_process->attributes['process_sequence']];

    $next_process->attributes['in_weight'] = $current_process['out_weight']; 
    $next_process->attributes['in_purity'] = $current_process['out_purity'];  
  	$next_process->attributes['design_code'] = $current_process['design_code'];
    //$next_process->attributes['design_code_type'] = $current_process['design_code_type'];
 	  $next_process->attributes['machine_size'] = $current_process['machine_size'];
    $next_process->attributes['line'] = $current_process['line'];
  	$next_process->attributes['length'] = $current_process['length'];
  	$next_process->attributes['remark'] = $current_process['remark'];
    $next_process->attributes['no_of_bunch'] = $current_process['no_of_bunch'];
    $next_process->attributes['tounch_no'] = $current_process['tounch_no'];
    $next_process->attributes['tounch_purity'] = $current_process['tounch_purity'];
    $next_process->attributes['quantity'] = $current_process['quantity'];
    // $next_process->attributes['out_quantity'] = $current_process['out_quantity'];
    $next_process->attributes['balance_quantity'] = $current_process['out_quantity'];
    $next_process->attributes['meena_quantity'] = $current_process['meena_quantity'];
    $next_process->attributes['job_card_no'] = $current_process['job_card_no'];
    $next_process->attributes['lopster_no'] = $current_process['lopster_no'];
    $next_process->attributes['gpc_out_qty'] = $current_process['gpc_out_qty'];
    $next_process->attributes['rejected_out'] = $current_process['rejected_out'];
    $next_process->attributes['rejected_qty'] = $current_process['rejected_qty'];
    $next_process->attributes['chain_name'] = $current_process['chain_name'];    
    $next_process->attributes['customer_out_required_status'] = $current_process['customer_out_required_status'];    
    $next_process->attributes['description'] = $current_process['description'];    
    $next_process->attributes['melting_lot_category_one'] = $current_process['melting_lot_category_one'];    
    $next_process->attributes['melting_lot_category_two'] = $current_process['melting_lot_category_two'];    
    $next_process->attributes['melting_lot_category_three'] = $current_process['melting_lot_category_three'];    
    $next_process->attributes['melting_lot_category_four'] = $current_process['melting_lot_category_four'];    
    $next_process->attributes['melting_lot_chain_name'] = $current_process['melting_lot_chain_name']; 
    $next_process->attributes['customer_name'] = $current_process['customer_name']; 
    $next_process->attributes['order_detail_id'] = $current_process['order_detail_id']; 
    $next_process->attributes['srno'] = $current_process['srno']; 

    $next_process->attributes['tone'] = $current_process['tone']; 
    $next_process->attributes['rod_id'] = $current_process['rod_id']; 
    $next_process->attributes['gemstone_in'] = $current_process['gemstone_in']; 
    if ($current_process['product_name'] == 'KA Chain'  && $current_process['process_name'] == 'Hammering II Process'  && $current_process['department_name'] == 'Hammering II') {
      $next_process->attributes['next_department_name'] = $current_process['next_department_name']; 
    }
    if ($current_process['product_name'] == 'KA Chain'  && $current_process['process_name'] == 'Customer Order Process') {
      $next_process->attributes['parent_process_detail_id'] = $current_process['parent_process_detail_id']; 
    }
    if ($current_process['product_name'] == 'KA Chain'  && $current_process['process_name'] == 'Hammering II Process'  && $current_process['department_name'] == 'Hammering II') {
      $next_process->attributes['next_department_name'] = $current_process['next_department_name']; 
    }
    // pd($next_process->attributes);
    if ($next_process->attributes['department_name'] == 'QC Department' && $next_process->attributes['in_weight']==0) return;
    if (   $next_process->validate('store') 
        || $current_process['department_name'] == 'Melting Start'
        || ($current_process['process_name'] == 'Internal Final Process' && $current_process['department_name'] == 'Start')
        || ($current_process['department_name'] == 'Loss Melting' && $current_process['out_weight'] == 0.001)
       )
      $next_process->store(); 
    else
      pd(validation_errors());
    $this->set_current_process_status_completed();
  }

  public function set_current_process_status_completed() {
    // if (number_format($this->attributes['balance'],4) != 0) return;

    // $this->attributes['status'] = 'Complete';
    // $this->set_completed_at_field();
    // $this->update(false);
  }

  public function calculate_tounch_loss_fine() {
    if (($this->attributes['product_name']=="Indo tally Chain" || $this->attributes['product_name']=="Hollow Choco Chain") && $this->attributes['process_name']=="Final Process" && $this->attributes['department_name']=="Walnut") return;
    if (     in_array($this->attributes['department_name'], $this->compute_tounch_loss_fine_departments)
          || in_array($this->attributes['department_name'], $this->set_out_lot_purity_from_tounch_purity))
      if ($this->attributes['in_weight'] != (  $this->attributes['repair_out'] 
                                              + $this->attributes['loss'])) 
        $this->attributes['tounch_loss_fine'] =   ((    $this->attributes['in_weight'] 
                                                      - $this->attributes['in_melting_wastage'] 
                                                      - $this->attributes['balance'] 
                                                      - $this->attributes['hook_in'] 
                                                      + $this->attributes['hook_out'] 
                                                      - $this->attributes['sisma_in'] 
                                                      + $this->attributes['sisma_out']) 
                                                    * (  $this->attributes['in_lot_purity'] 
                                                       - $this->attributes['out_lot_purity']) / 100)
                                                  + (  ($this->attributes['hook_in'] - $this->attributes['hook_out']) 
                                                     * ($this->attributes['hook_kdm_purity'] - $this->attributes['out_lot_purity']) / 100)+ (  ($this->attributes['hook_in'] - $this->attributes['hook_out']) 
                                                     * ($this->attributes['hook_kdm_purity'] - $this->attributes['out_lot_purity']) / 100);
      else
        $this->attributes['tounch_loss_fine'] = 0;
    elseif (in_array($this->attributes['department_name'], $this->set_wastage_lot_purity_from_tounch_purity))
      $this->attributes['tounch_loss_fine'] =  ($this->attributes['in_weight'] - $this->attributes['out_weight']) * ($this->attributes['in_lot_purity'] - $this->attributes['wastage_lot_purity']) / 100;
    elseif ($this->attributes['gpc_out'] > 0)
      $this->attributes['tounch_loss_fine'] =  ($this->attributes['gpc_out'] + $this->attributes['out_weight'])
                                               * ($this->attributes['in_lot_purity'] - $this->attributes['out_lot_purity']) / 100;
    elseif (   in_array($this->attributes['department_name'], $this->compute_tounch_loss_fine_from_out_weight_departments)
            &&  $this->attributes['out_weight'] > 0)
      $this->attributes['tounch_loss_fine'] =  ($this->attributes['out_weight']) 
                                                * ($this->attributes['in_lot_purity'] - $this->attributes['out_lot_purity']) / 100;
    // elseif ($this->attributes['repair_out'] > 0)
    //   $this->attributes['tounch_loss_fine'] =  $this->attributes['repair_out'] * ($this->attributes['in_lot_purity'] - $this->attributes['out_lot_purity']) / 100;
    elseif (   $this->attributes['hook_out'] > 0 
            && $this->attributes['out_purity'] == 100)
      $this->attributes['tounch_loss_fine'] =  $this->attributes['hook_out'] * ($this->attributes['in_lot_purity'] - $this->attributes['hook_kdm_purity']) / 100;
    elseif (  in_array($this->attributes['department_name'], $this->compute_tounch_loss_fine_for_refine_loss)
            && $this->attributes['balance'] == 0)
      $this->attributes['tounch_loss_fine'] =  $this->attributes['in_weight'] * ($this->attributes['in_lot_purity'] - $this->attributes['wastage_lot_purity']) / 100;
    else
      $this->attributes['tounch_loss_fine'] = 0;

    $this->attributes['issue_tounch_loss_fine'] = $this->get_out_weight('issue_department_detail_model', 'Tounch Loss Fine');
    if (   $this->attributes['parent_lot_id'] == 0
        && $this->attributes['product_name'] != 'Melting Wastage Refine Out')
        //&& (!isset($this->attributes['created_at']) || $this->attributes['created_at'] > '2022-02-01'))
      $this->attributes['issue_tounch_loss_fine'] = $this->attributes['tounch_loss_fine'];
    $this->attributes['balance_tounch_loss_fine'] = $this->attributes['tounch_loss_fine'] - $this->attributes['issue_tounch_loss_fine'];

  }

  public function set_completed_at_field() {
    if (number_format($this->attributes['balance'], 4) != 0) return;

    $this->attributes['status'] = 'Complete';
    if (empty($this->attributes['completed_at']))
      $this->attributes['completed_at'] = date('Y-m-d H:i:s');
  }

  public function after_delete($id, $conditions){
    $this->process_field_model->delete('', array('process_id' => $id), true);
  } 

  protected function unset_excluded_departments() {
    $melting_lot = $this->melting_lot_model->find('exclude_departments', 
                                                  array('id' => $this->attributes['melting_lot_id']));
    if (isset($melting_lot['exclude_departments']) && !empty($melting_lot['exclude_departments'])) {
      $exclude_deparments = explode(',', $melting_lot['exclude_departments']);
      $unordered_departments = array_diff($this->departments, $exclude_deparments);
      $this->departments = array_values($unordered_departments);
    }
    return array_values($this->departments);
  }

  protected function change_department_sequence() {
    $melting_lot = $this->melting_lot_model->find('department_sequence', 
                                                  array('id' => $this->attributes['melting_lot_id']));
    if (isset($melting_lot['department_sequence']) && !empty($melting_lot['department_sequence'])) {
      $this->departments = explode(',', $melting_lot['department_sequence']);
    }
    return $this->departments;
  }

  protected function get_departments() {  
    return $this->departments;
  }


  public function set_purity_from_previous_department($id, $in_purity=0, $in_lot_purity=0, $update_current_process = true) {
    if (@$process_object->attributes['product_name'] == 'Receipt') return;
    if (@$process_object->attributes['product_name'] == 'Pending Loss Out') return;

    $this->db->reset_query();
    $current_process = $this->process_model->find('id, product_name, process_name', array('id' => $id));
    if (empty($current_process)) return; 
    
    $model_name = get_model_name($current_process['product_name'], $current_process['process_name']);
    $this->load->model($model_name['module_name'].'/'.$model_name['model_name']);  
    
    $current_process_obj = new $model_name['model_name'](array('id' => $current_process['id']));
    if ($update_current_process) {
      $current_process_obj->attributes['in_purity'] = $in_purity;
      $current_process_obj->attributes['in_lot_purity'] = $in_lot_purity;
      $current_process_obj->before_validate();
      $current_process_obj->update(false);
    }

    $this->db->reset_query();
    $next_processes = $this->process_model->get('id', array('parent_id' => $current_process['id'],
                                                            'product_name' => $current_process['product_name']));
    foreach ($next_processes as $next_process) {
      $this->set_purity_from_previous_department($next_process['id'], $current_process_obj->attributes['out_purity'], $current_process_obj->attributes['out_lot_purity']);
    }
  }

  public function set_purity_for_department_processes($product_name, $process_name, $department_name) {
    ini_set('max_execution_time', 3000);
    $processes = $this->process_model->get('id, in_purity, in_lot_purity, department_name, process_name, wastage_purity, wastage_lot_purity', 
                                                                           array('product_name' => $product_name, 
                                                                                 'process_name' => $process_name, 
                                                                                 'department_name' => $department_name));
    $i = 0;
    foreach ($processes as $process) {
      $i += 1;
      $this->set_purity_from_previous_department($process['id'], $process['in_purity'], $process['in_lot_purity']);
    }
  }

  public function find_process_data($id,$chain_name=""){
    if(!empty($chain_name)){
      $chain_where= array('id'=>$id,'product_name'=>$chain_name);
    }else{
      $chain_where = array('id'=>$id);
    }

    $processone_row_data = $this->process_model->find('product_name,process_name,
                                                      row_id,department_name,parent_id,id',$chain_where);
    if(empty($processone_row_data))return ;

    $processone_department_data = $this->process_model->find('department_name',
                              array('row_id'=>$processone_row_data['row_id'],
                                    'process_name'=>$processone_row_data['process_name'],
                                    'product_name'=>$processone_row_data['product_name'],
                                    'balance > '=>0));

    if(empty($processone_department_data['department_name'])){
      $processone_last_data= $this->process_model->find('max(id) as id',
                                    array('row_id'=>$processone_row_data['row_id']));

    }
    else { 
      return array('department_name'=>$processone_department_data['department_name'],
                  'process_name'=>$processone_row_data['process_name'],
                  'product_name'=>$processone_row_data['product_name'],
                  'id'=>$processone_row_data['id'],
                  'parent_id'=>$processone_row_data['parent_id'],
                  'row_id'=>$processone_row_data['row_id']);
    }
    $return =  $this->second_process($processone_last_data,$processone_department_data,$chain_name);
    return $return;
  }

  private function second_process($processone_last_data,$processone_department_data,$chain_name){
    $processtwo_row_data = $this->process_model->find('product_name,process_name,row_id,parent_id,id',
                                                      array('parent_id'=>$processone_last_data['id']));
     if(empty($processtwo_row_data)){
      $last_process_data = $this->process_model->find('department_name,process_name,
                                                        product_name,row_id,parent_id,id',
                                                    array('id'=>$processone_last_data['id']));
        return array('department_name'=>$last_process_data['department_name'],
                  'process_name'=>$last_process_data['process_name'],
                  'product_name'=>$last_process_data['product_name'],
                  'parent_id'=>$last_process_data['parent_id'],
                  'id'=>$last_process_data['id'],
                  'row_id'=>$last_process_data['row_id']);
    }
  
    $processtwo_department_data = 
      $this->process_model->find('department_name',
                              array('row_id'=>$processtwo_row_data['row_id'],
                                    'process_name'=>$processtwo_row_data['process_name'],
                                    'product_name'=>$processtwo_row_data['product_name'],
                                    'balance > '=>0));

    if(empty($processtwo_department_data['department_name'])){
      $processtwo_last_data= $this->process_model->find('max(id) as id',
                                    array('row_id'=>$processtwo_row_data['row_id']));

    }else {
      return array('department_name'=>$processtwo_department_data['department_name'],
                        'process_name'=>$processtwo_row_data['process_name'],
                        'product_name'=>$processtwo_row_data['product_name'],
                        'parent_id'=>$processtwo_row_data['parent_id'],
                        'id'=>$processtwo_row_data['id'],
                        'row_id'=>$processtwo_row_data['row_id']);
    }

    return $this->second_process($processtwo_last_data,$processtwo_department_data,$chain_name);  
  }

  public function set_process_field_attributes(){
    if (!isset($this->attributes['id'])) return true; 
    if (!$this->load->is_model_loaded('process_field_model')) 
      $this->load->model('processes/process_field_model');
    $process_fields = $this->process_field_model->get('id', array('process_id' => $this->attributes['id']));
    if(!empty($process_fields)){
      foreach($process_fields as $process_field) {
        $process_field_obj = new process_field_model($process_field);
        $process_field_obj->attributes['karigar'] = $this->attributes['karigar'];
        $process_field_obj->attributes['hook_kdm_purity'] = $this->attributes['hook_kdm_purity'];
        $process_field_obj->update(false);
      }
    }
  }
    
  public function set_is_outside($record){
    if(!empty($record['id'])){
      $current_process_obj = new process_model(array('id' =>$record['id']));
      $current_process_obj->attributes['is_outside'] = $record['is_outside'];
      $current_process_obj->update(false);
    }
  }
  private function initialize_fields($fields, $default_value) {
    foreach ($fields as $field) {
      if (empty($this->attributes[$field])) $this->attributes[$field] = $default_value;
    }
  }

  public function initialize_attributes_with_default_values() {
    $str_fields = array('department_name', 'lot_no', 'type', 'machine_size', 'length','line', 'remark','machine_no','customer_out_required_status','factory_issue_department_id','account',
                        'melting_lot_category_one', 'melting_lot_category_two', 'melting_lot_category_three', 'melting_lot_category_four',
                        'melting_lot_chain_name', 'description', 'tone',
                        'parent_lot_name', 'customer_name',
                        'chain_name', 'design_code', 'karigar','worker','job_card_no','lopster_no', 'next_department_name','next_department_karigar', 'srno');
    $this->initialize_fields($str_fields, '');

    $number_fields = array('parent_id', 'process_sequence',
                          'copper_process_id', 'melting_lot_id', 'order_detail_id', 'parent_lot_id',
                          'in_plain_rod', 'in_rod', 'out_rod', 'in_machine_gold', 'out_machine_gold', 'rod_id','rhodium_in',
                          'in_lot_purity', 'in_weight',
                          'fe_in', 'fe_out', 'wastage_fe',
                          'solder_in', 'solder_wastage', 'out_solder_wastage',
                          'copper_in', 'copper_out',
                          'stone_vatav', 'out_stone_vatav', 'micro_coating',
                          'gemstone_in', 'gemstone_out', 'flash_wire',
                          'hook_in', 'hook_out','sisma_in', 'sisma_out','spring_in', 'spring_out','stone_in', 'stone_out', 'daily_drawer_in_weight', 'daily_drawer_out_weight', 'hook_kdm_purity',
                          'alloy_weight', 'out_alloy_weight', 'liquor_in', 'liquor_out',
                          'tounch_in', 'tounch_no', 'tounch_purity', 'fire_tounch_purity',
                          'tounch_out', 'out_tounch_out',
                          'fire_tounch_in', 'fire_tounch_no', 'fire_tounch_out', 'out_fire_tounch_out',
                          'melting_wastage', 'in_melting_wastage', 'out_melting_wastage', 'issue_melting_wastage', 'out_opening_melting_wastage', 'balance_melting_wastage','balance_rejected','issue_rejected',
                          'hcl_wastage', 'out_hcl_wastage',
                          'daily_drawer_wastage', 'out_daily_drawer_wastage', 'issue_daily_drawer_wastage', 'balance_daily_drawer_wastage',
                          'cz_wastage', 'out_cz_wastage', 'issue_cz_wastage', 'balance_cz_wastage','cz_wastage', 'out_cz_wastage', 'issue_cz_wastage', 'balance_cz_wastage',
                          'tounch_loss_fine', 'issue_tounch_loss_fine', 'balance_tounch_loss_fine',
                          'ghiss', 'out_ghiss', 'issue_ghiss', 'balance_ghiss','issue_refine_loss',
                          'tounch_ghiss', 'out_tounch_ghiss', 'balance_tounch_ghiss',
                          'pending_ghiss', 'out_pending_ghiss', 'balance_pending_ghiss',
                          'hcl_ghiss', 'out_hcl_ghiss', 'balance_hcl_ghiss',
                          'loss', 'pending_loss', 'enamel_loss', 'karigar_loss', 'out_loss', 'issue_loss', 'loss_percentage', 'balance_loss',
                          'hcl_loss', 'issue_hcl_loss', 'refine_loss','refine_loss','balance_refine_loss', 'balance_hcl_loss', 'expected_out_weight',
                          'wastage_purity', 'wastage_lot_purity', 'next_department_wastage', 
                          'out_weight', 'bounch_out', 'factory_out','tanishq_out', 'customer_out', 'recutting_out', 'split_out_weight',
                          'repair_out','closing_out', 'repair_out_quantity',
                          'no_of_bunch', 'quantity','out_quantity','balance_quantity', 'meena_quantity','gpc_out_qty','rejected_qty','rejected_out',
                          'gpc_out', 'out_gpc_out', 'issue_gpc_out', 'balance_gpc_out',
                          'hallmark_out',  'issue_hallmark_out', 'balance_hallmark_out',
                          'chitti_out', 'issue_chitti_out', 'balance_chitti_out',
                          'balance', 'balance_gross', 'balance_fine','gross_loss','hallmark_in','accept_packing_list','rejected','packing_slip_balance','balance_rejected','issue_rejected');

    $this->initialize_fields($number_fields, 0);

    if (empty($this->attributes['out_lot_purity'])) $this->attributes['out_lot_purity']=$this->attributes['in_lot_purity'];
    if (empty($this->attributes['in_purity'])) $this->attributes['in_purity']=100;
    if (empty($this->attributes['out_purity'])) $this->attributes['out_purity']=$this->attributes['in_purity'];
  }
  
  public function set_lot_row_id($id) {
    $process        = $this->process_model->find('id, product_name, process_name', array('id'=>$id));
    $process_object = $this->process_model->get_model_object($process);
    $process_object->attributes['lot_row_id']=$this->attributes['melting_lot_id'].'-'.$this->attributes['id'];
    $process_object->update(false);
  }

  public function compute_process($id) {
    $process        = $this->process_model->find('id, product_name, process_name', array('id'=>$id));
    $process_object = $this->process_model->get_model_object($process);
    $process_object->before_validate();
    $process_object->update(false);
    $process_object->set_process_field_attributes();
    $process_object->create_melting_wastage_record_from_in_melting_wastage();
    //if($process_object->attributes['product_name'] != 'Receipt' && $process_object->attributes['product_name'] != 'Pending Loss Out')
    $process_object->set_purity_from_previous_department($process_object->attributes['id'], $process_object->attributes['in_purity'], $process_object->attributes['in_lot_purity'], FALSE);
    return TRUE;
  }
  public function delete_record_from_process_out_wastage_details($id){
    $process_out_wastage_details=$this->process_out_wastage_detail_model->get('process_id,id',array('parent_id'=>$id));
    if(!empty($process_out_wastage_details)){
      foreach ($process_out_wastage_details as $index => $value) {
        $this->process_out_wastage_detail_model->delete($value['id']);
        $this->compute_process($value['process_id']);
      }
    }
  }
  public function update_combine_room_process($process_details) {
      $model_name = get_model_name($process_details['product_name'], $process_details['process_name']);
      $this->load->model($model_name['module_name'].'/'.$model_name['model_name']);
      $process_obj = new $model_name['model_name']($process_details);
      $process_obj->before_validate();
      $process_obj->update(true);
      return $process_obj;
  }
  public function create_records_in_process_groups($parent_process_id, $process_ids){
    $process_group_details=$this->process_group_model->get('process_id',array('parent_id'=>$parent_process_id));
    $process_group_process_ids=array_column($process_group_details, 'process_id');
    foreach ($process_ids as $index => $process_id) {
      if(!in_array($process_id,$process_group_process_ids)){
      $record = array('process_id' => $process_id,
                      'parent_id' => $parent_process_id);
      $process_group_obj = new Process_group_model($record);
      $process_group_obj->store(false);
      }
    }

  }
}
