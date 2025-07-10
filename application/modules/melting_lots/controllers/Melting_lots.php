<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Melting_lots extends BaseController {

  public function __construct() {
    parent::__construct();
    $this->load->model(array('melting_lots/melting_lot_detail_model',
                             'melting_lots/melting_lot_alloy_detail_model',
                             'processes/process_model',
                             'melting_lots/parent_lot_model',
                             'settings/same_karigar_model',
                             'settings/category_four_model',
                             'settings/rod_model',
                             'settings/category_model','settings/alloy_detail_model',
                             'settings/chain_purity_model','masters/chain_model'
                            ));
    $this->redirect_after_save = 'view';
  }

  public function index(){
   if (!empty($_GET['category_one']) && $_GET['process_name']=='KA Chain') {
      if (!empty($_GET['category_one']) && empty($_GET['category_two'])) {
      $category_two = $this->category_model->get('DISTINCT(category_two) as id, category_two as name',array('product_name'=>$_GET['process_name'],
                    'category_one'=>$_GET['category_one']),
              array(),array('order_by'=>'category_two asc'));
      $category_two=array_merge(array(array('id '=>'','name'=>'Select')),$category_two);
      echo json_encode(array('category_two' => $category_two,
                             'status'      => 'success',
                             'open_modal'  => FALSE,
                             'js_function' => 'set_category_two_for_category_options(response.category_two)'));die;
      }
      if (!empty($_GET['category_two'])&&!empty($_GET['category_one'])&&empty($_GET['category_three'])) {
        $category_three = $this->category_model->get('DISTINCT(category_three) as id, category_three as name',array('product_name'=>$_GET['process_name'],
                                        'category_one'=>$_GET['category_one'],
                                        'category_two'=>$_GET['category_two']),
                  array(),array('order_by'=>'category_three asc'));
        $category_three=array_merge(array(array('id '=>'','name'=>'Select')),$category_three);
        echo json_encode(array('category_three' => $category_three,
                               'status'      => 'success',
                               'open_modal'  => FALSE,
                               'js_function' => 'set_category_three_for_category_options(response.category_three)'));die;
      }
    }else
    parent::index();
  }

  public function create() {
    $this->data['record']['process_name'] =  isset($_GET['process_name']) ? $_GET['process_name'] : '';
    $this->data['record']['parent_lot_id'] =  isset($_GET['parent_lot_id']) ? $_GET['parent_lot_id'] : '';
    $this->data['record']['order_id'] =  isset($_GET['order_id']) ? $_GET['order_id'] : '';
    $this->data['record']['chain_order_id'] =  isset($_GET['chain_order_id']) ? $_GET['chain_order_id'] : '';
    if($this->data['record']['process_name'] == "Indo tally Chain" || $this->data['record']['process_name']== "Hollow Choco Chain"){
      $parent_lot=$this->parent_lot_model->find('input_type',array('id'=>$this->data['record']['parent_lot_id']));
      $this->data['record']['input_type'] =  isset($parent_lot['input_type']) ? $parent_lot['input_type'] : '';
    }

    parent::create();
  }

  public function update($id){
    if(isset($_GET['from']) && $_GET['from']=='alloy_ details') {
      $this->melting_lot_model->compute_alloy_data($id);
      redirect(base_url().'melting_lots/melting_lots/view/'.$id);
    } else {
      parent::update($id);
    }
  }

  public function delete($id) {
    $data=$this->melting_lot_model->check_melting_lot_before_delete($id);
    if($data){
    $melting_lot_details=$this->melting_lot_detail_model->get('process_id,id',array('melting_lot_id'=>$id));
    foreach ($melting_lot_details as $index => $melting_lot_detail) {
      $this->melting_lot_detail_model->delete($melting_lot_detail['id']);
      $process_data = $this->process_model->find('', array('id' => $melting_lot_detail['process_id']));
      $process_obj = $this->process_model->get_model_object($process_data);
      $process_obj->before_validate();
      $process_obj->update(false);
    }
      parent::delete($id);
    } else{
      redirect();
    }
    
  }

  private function set_order_fields(){
    $order = $this->order_model->find('*', array('id' => $this->data['record']['chain_order_id']));
    $this->data['chain'] = $this->chain_model->find('*', array('name' => $this->data['record']['process_name']));
    
    if(!empty($order)){
      $this->data['record']['category_one'] = $order['category_1_label'];
      $this->data['record']['category_two'] = $order['category_2_label'];
      $this->data['record']['category_three'] = $order['category_3_label'];
      $this->data['record']['category_four'] = $order['category_4_label'];
      $this->data['record']['category_five'] = $order['category_5_label'];
      $this->data['record']['lot_purity'] = $order['lot_purity'];
    }
  }

  public function _get_form_data() {
    $this->data['process']=get_process();
    $this->data['sub_process']=array(
            array('name'=>'Choco Chain','id' =>'Choco Chain'),
            array('name'=>'Hollow Choco Chain','id' =>'Hollow Choco Chain'), 
            array('name'=>'Lotus Chain','id' =>'Lotus Chain'),
            array('name'=>'Lopster Making Chain','id' =>'Lopster Making Chain'),
            array('name'=>'Hollow Bangle Chain','id' =>'Hollow Bangle Chain'),
            array('name'=>'Roco Choco Chain','id' =>'Roco Choco Chain'),
            array('name'=>'Nawabi Chain','id' =>'Nawabi Chain'),
            array('name'=> 'Hand Made Chain', 'id' => 'Hand Made Chain'),
            array('name'=>'Imp Italy Chain','id' =>'Imp Italy Chain'), 
            array('name'=>'Indo tally Chain','id' =>'Indo tally Chain'), 
            array('name'=>'Machine Chain','id' =>'Machine Chain'),
            array('name'=>'Hollow Machine Chain','id' =>'Hollow Machine Chain'),
            array('name'=>'Solid Machine Chain','id' =>'Solid Machine Chain'),
            array('name'=>'Rope Chain','id' =>'Rope Chain'),
            array('name'=>'Solid Rope Chain','id' =>'Solid Rope Chain'),
            array('name'=>'Round Box Chain','id' =>'Round Box Chain'),
            array('name'=>'Sisma Chain','id' =>'Sisma Chain'),
    );
    $this->data['alloy_details']=array();
    $this->data['final_process']=get_final_process();
    $this->data['melting_type']=get_melting_type();
    $this->data['choco_chain_options']= get_choco_chain_options();
     if ($this->data['record']['process_name'] == 'KA Chain') {
      $ka_chain_order = $this->ka_chain_order_model->find('hook_kdm_purity, lot_purity, total_weight', array('id' => $this->data['record']['order_id']));
      $this->data['record']['hook_kdm_purity'] = $ka_chain_order['hook_kdm_purity'];
      $this->data['record']['lot_purity'] = $ka_chain_order['lot_purity'];
      $this->data['order_total_weight'] = $ka_chain_order['total_weight'];
    }if ($this->data['record']['process_name'] == 'Ball Chain') {
      $ball_chain_order = $this->ball_chain_order_model->find('hook_kdm_purity, lot_purity, total_weight', array('id' => $this->data['record']['order_id']));
      $this->data['record']['hook_kdm_purity'] = $ball_chain_order['hook_kdm_purity'];
      $this->data['record']['lot_purity'] = $ball_chain_order['lot_purity'];
      $this->data['order_total_weight'] = $ball_chain_order['total_weight'];
    } elseif ($this->data['record']['process_name'] == 'Verona Collection') {
      $verona_collection_order = $this->verona_collection_order_model->find('hook_kdm_purity, lot_purity, total_weight', array('id' => $this->data['record']['order_id']));
      $this->data['record']['hook_kdm_purity'] = $verona_collection_order['hook_kdm_purity'];
      $this->data['record']['lot_purity'] = $verona_collection_order['lot_purity'];
      $this->data['order_total_weight'] = $verona_collection_order['total_weight'];
    } else {
      $this->data['hook_kdm_purity']= $this->chain_purity_model->get('lot_purity as name,lot_purity as id',
                                                                      array(),
                                                                      array(),
                                                                      array('group_by'=>'lot_purity'));
    }

      $this->data['melting_lots_lot_purity']= $this->chain_purity_model->get('lot_purity id,lot_purity name',array(),array(),array('group_by'=>'lot_purity'));
    
    if($this->data['record']['process_name']=='ARC' || HOST=='ARC'){
      $this->data['tone']= array(array('id'=>'yellow','name'=>'Yellow'),array('id'=>'pink','name'=>'Pink'),array('id'=>'White','name'=>'White'),array('id'=>'Green','name'=>'Green'));
    }else{
      $this->data['tone']= array(array('id'=>'yellow','name'=>'Yellow'),array('id'=>'pink','name'=>'Pink'));
    }
    $this->data['machine_chain_options']= get_machine_chain_options();

    $this->data['process_name'] =  isset($_GET['process_name']) ? $_GET['process_name'] : $this->data['record']['process_name'];
    $this->data['parent_lots']=$this->parent_lot_model->get('id, name', array('status' => 0));
    if(HOST=="AR Gold Internal"){
      if($this->data['process_name']=="Indo tally Pasta Chain Internal"){
        $this->data['process_name']="Indo tally Chain Internal";
      }if($this->data['process_name']=="Machine Pasta Chain Internal"){
        $this->data['process_name']="Machine Chain Internal";
      }if($this->data['process_name']=="Choco Pasta Chain Internal"){
        $this->data['process_name']="Choco Chain Internal";
      }
      $process_name=explode(' ',$this->data['process_name']);
      if (($key = array_search('Internal', $process_name)) !== false) {
          unset($process_name[$key]);
      }
      $process_name=implode(' ',$process_name);
    $this->data['karigars']=process_wise_karigar_name($process_name);
    }else{
    $this->data['karigars']=process_wise_karigar_name($this->data['process_name']);
    }

    if($this->data['process_name']=='KA Chain'){
      $this->data['category_one'] = $this->category_model->get('category_one as name ,category_one as id',array('product_name'=>'KA Chain'),array(),array('group_by'=>'category_one','order_by'=>'category_one'));
    }
    if($this->data['process_name']=='Lopster'){
      $this->data['category_ones'] = array(array('id'=>"Lopster-92",'name'=>"Lopster-92"),
                                          array('id'=>"Lopster-75",'name'=>"Lopster-75"),
                                          array('id'=>"Lopster-83",'name'=>"Lopster-83.50"),
                                          array('id'=>"Lopster-87",'name'=>"Lopster-87.65"),
                                          array('id'=>"Lopster-58",'name'=>"Lopster-58.50"),
                                          array('id'=>"Lopster-41",'name'=>"Lopster-41.70"),
                                          array('id'=>"Lopster-37",'name'=>"Lopster-37.50"));
    }
    $this->data['rods'] = $this->rod_model->get('name,id');
    $this->data['processes_with_multi_orders']           = array();
    $this->data['processes_with_parent_order_selection'] = array('Indo tally Chain');
    $select = 'id as process_id, product_name,process_name, department_name, parent_lot_name as parent_lot_name,lot_no as lot_no, balance_melting_wastage as in_weight, wastage_lot_purity as in_purity,tounch_purity,description,tone, melting_lot_category_two';

    if (isset($this->data['record']['process_name'])
        && $this->data['record']['process_name'] == 'Fancy Chain') {
      $where = array('round(balance_melting_wastage, 4) >' => 0,
                     'wastage_purity >' => 0,
                     'product_name not in ("Rhodium Receipt","Hallmark Receipt")' => NULL,
                     'wastage_lot_purity >' => 0);
    } else {
      $where = array('round(balance_melting_wastage,4) >' => 0,
                     'wastage_purity >' => 0,
                     'wastage_lot_purity >' => 0,
                     'product_name not in ("Hallmark Receipt","Chain Receipt","Rhodium Receipt")' => NULL,
                     'department_name !=' => 'Fancy Out');
    }
    
    $where_condition=array('where_in'=>array('product_name'=>array("'HCL'","'Daily Drawer'","'Ghiss Out'","'HCL Ghiss Out'"),'process_name'=>array("'HCL Melting Process'","'Melting'","'Final Process'")));
    $where_condition['where']=$where;
    $where_condition['where']['tounch_purity']=0;
    $this->data['melting_lot_details_without_tounch_purities'] =$this->process_model->get($select,$where_condition);
    $exclude_process_ids = array_column($this->data['melting_lot_details_without_tounch_purities'], 'process_id');
    if (!empty($exclude_process_ids))
      @$where['id not in ('.implode($exclude_process_ids,',').')'] = NULL;

    $this->data['melting_lot_details'] =$this->process_model->get($select, $where, array(), array('order_by' => 'wastage_lot_purity desc'));
    $this->data['category_two'] = array();
  }

  public function view($id) {
    if(isset($_GET['type'])&&$_GET['type']==1){
      $res=$this->parent_lot_model->get('id,name, lot_purity',array('process_name'=>$_GET['process_name']));
      echo json_encode(array('result'=>$res));
    }elseif(isset($_GET['type'])&&$_GET['type']==2){
      $this->data['process_name']=isset($_GET['process_name']) ? $_GET['process_name'] : '';
      $this->data['lot_purity']=isset($_GET['lot_purity']) ? $_GET['lot_purity'] : '';
      $this->data['alloy_weight']=isset($_GET['alloy_weight']) ? $_GET['alloy_weight'] : '';
      $this->data['category_one']=isset($_GET['category_one']) ? $_GET['category_one'] : '';
      $this->data['tone']=isset($_GET['tone']) ? $_GET['tone'] : '';
      $where=array();
      if(!empty($this->data['lot_purity'])){
        $where= array('product_name'=>$this->data['process_name']);
        $where_in = array('alloy_purity'=>array($this->data['lot_purity'],'0.0000'));

        if(!empty($this->data['category_one']) || ($this->data['category_one']==0)){

          $where['category_one']=$this->data['category_one'];
        }

        if(!empty($this->data['tone'])){
          $where['tone']=$this->data['tone'];
        }else{
          $where['tone']='yellow';
        }
        $alloy_details=$this->alloy_detail_model->get('"'.$this->data['alloy_weight'].'" as alloy_weight, alloy_types.alloy_name as alloy_name,weight as percentage',array('where' => $where,'where_in' =>$where_in),array(array('alloy_types',  'alloy_settings.alloy_id=alloy_types.id')));
        echo json_encode(array('result'=>$alloy_details));
      }
    }else{
      $this->data['process_data'] = $this->process_model->find('MIN(id) as id,product_name,process_name,lot_no,design_code,in_lot_purity',array('melting_lot_id'=>$id),'',array('group_by'=>'id'));

      $this->data['melting_lot_details'] = $this->melting_lot_detail_model->get('melting_lot_details.*,processes.lot_no,processes.description as description,processes.design_code as design_code', array('melting_lot_details.melting_lot_id' => $id),array(array('processes',  'melting_lot_details.process_id=processes.id','right')));
      $this->data['alloy_details'] = $this->melting_lot_alloy_detail_model->get('', array('melting_lot_id' => $id));

      /* Order details */
      $process_with_orders = ['Rope Chain','Solid Rope Chain', 'Round Box Chain', 'Machine Chain', 'Choco Chain', 'Imp Italy Chain', 'Indo tally Chain'];

      $processes_with_multi_orders = ['Imp Italy Chain', 'Indo tally Chain'];
      if(!empty($this->data['process_data']['product_name'])&&in_array($this->data['process_data']['product_name'], $process_with_orders)) {
        if($this->data['process_data']['product_name'] == 'Rope Chain') {
          $order_report_model      = 'rope_chain_order_report_model';
          $order_report_print_view = 'rope_chain_order_print_view';
          $report_mini_view        = 'rope_chains/rope_chain_order_reports/report';
        }
      }
      $this->load->model('settings/alloy_detail_model');
      $this->data['alloy_settings'] =array();
      if(!empty($this->data['process_data']['product_name'])){
      $this->data['alloy_settings'] = $this->alloy_detail_model->get('*',array('product_name'=>$this->data['process_data']['product_name']));
      }

      parent::view($id);
    }
  }

}
