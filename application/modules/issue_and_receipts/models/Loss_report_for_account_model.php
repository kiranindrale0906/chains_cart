<?php 
class Loss_report_for_account_model extends BaseModel{
  protected $table_name= 'processes';
  
  public function __construct($data = array()){
    parent::__construct($data);
    $this->load->model(array('settings/loss_category_model','processes/process_out_wastage_detail_model','issue_departments/issue_department_model','issue_departments/issue_department_detail_model'));
  }

  public function get_ghiss_melting_out_weight($issue_department_id) {  
      $process_details=$this->issue_department_detail_model->get('process_id',array('issue_department_id'=>$issue_department_id));
      $process_ids=array_column('process_id', $process_details);
      $data=0;
      if(!empty($process_ids)){
        $data=$this->process_model->find('sum(out_weight) as out_weight',array('where_in'=>array('id'=>$process_ids)))['out_weight'];
      }
      return !empty($data)?$data:0;
   }

  public function get_loss_out_detail_records($record) {  
    if(!empty($record['quator'])){
      $record['quator']=$record['quator'];
    }else{
      $record['quator']=NULL;
    }

    $loss_details=$this->process_model->get('in_weight, (in_purity / 100 * in_lot_purity) as in_lot_purity,created_at,parent_id,description,product_name as receipt_type,id',
          array('product_name'=>'Loss Out',
                'description'=>$record['department_name'],
                'quator'=>$record['quator'],
                'department_name'=>'Loss Transfer',
                'date(completed_at)>='=>$record['completed_at']));
    $data['loss_detail']=array();
    foreach ($loss_details as $index => $loss_detail) {
      if($loss_detail['parent_id']!=0){
        $data['loss_detail'][$index]=$loss_detail;
      $process_wastage_details=$this->process_out_wastage_detail_model->get('process_id',array('parent_id'=>$loss_detail['parent_id'])); 
      $process_id=array_column($process_wastage_details,'process_id');
      $where = array('where_in' => array('id'=>$process_id)) ;
      $data['loss_detail'][$index]['first_date']='';
      $data['loss_detail'][$index]['last_date']='';
      $data['loss_detail'][$index]['out_weight']=0;
        if(!empty($process_id)){
        $processes=$this->process_model->find('max(distinct(date(completed_at))) as last_date,min(distinct(date(completed_at))) as first_date',$where);
        $data['loss_detail'][$index]['first_date']=date('d-m-Y',strtotime($processes['first_date']));
        $data['loss_detail'][$index]['last_date']=date('d-m-Y',strtotime($processes['last_date']));
        $where =array();
        $department_names =array();
        $loss_categories= $this->loss_category_model->get('department_name',array('name' => $record['department_name']));
        $department_names=array_column($loss_categories,'department_name');
        if(!empty($department_names)){
          $where = array('where_in' => array('department_name'=>'"'.implode('", "', $department_names).'"')) ;
        }
        $where['date(completed_at)>=']=date('Y-m-d',strtotime($processes['first_date']));
        $where['date(completed_at)<=']=date('Y-m-d',strtotime($processes['last_date']));
        
        $data['loss_detail'][$index]['out_weight']=$data['loss_detail'][$index]['out_weight']=$this->process_model->find('sum(out_weight) as out_weight',$where)['out_weight'];

        }
      }
    }
    return $data;
  }

  public function get_loss_out_records($record) {  
    if(!empty($record['quator'])){
      $record['quator']=$record['quator'];
    }else{
      $record['quator']=NULL;
    }
    $loss_details=$this->process_model->get('in_weight, (in_purity / 100 * in_lot_purity) as in_lot_purity,created_at,parent_id,description,product_name as receipt_type',array('product_name'=>'Loss Out','quator'=>$record['quator'],'description in ('.'"'.implode('", "', $record['department_names']).'"'.') '=>NULL ,'department_name'=>'Loss Transfer','date(completed_at)>='=>$record['completed_at']));

    $data['loss_detail']=array();
    foreach ($loss_details as $index => $loss_detail) {
      //if($loss_detail['parent_id']!=0){
        $data['loss_detail'][$index]=$loss_detail;
      $process_wastage_details=$this->process_out_wastage_detail_model->get('process_id',array('parent_id'=>$loss_detail['parent_id'])); 
      $process_id=array_column($process_wastage_details,'process_id');
      $where = array('where_in' => array('id'=>$process_id)) ;
      $data['loss_detail'][$index]['out_weight']=0;
        if(!empty($process_id)){
        $processes=$this->process_model->find('max(distinct(date(completed_at))) as last_date,min(distinct(date(completed_at))) as first_date',$where);
        $data['loss_detail'][$index]['first_date']=date('d-m-Y',strtotime($processes['first_date']));
        $data['loss_detail'][$index]['last_date']=date('d-m-Y',strtotime($processes['last_date']));
        $where =array();
        $department_names =array();
        $loss_categories= $this->loss_category_model->get('department_name',array('name' => $loss_detail['description']));
        $department_names=array_column($loss_categories,'department_name');
        if(!empty($department_names)){
          $where = array('where_in' => array('department_name'=>'"'.implode('", "', $department_names).'"')) ;
        }
        $where['date(completed_at)>=']=date('Y-m-d',strtotime($processes['first_date']));
        $where['date(completed_at)<=']=date('Y-m-d',strtotime($processes['last_date']));
        
        $data['loss_detail'][$index]['out_weight']=$this->process_model->find('sum(out_weight) as out_weight',$where)['out_weight'];
        $data['loss_detail'][$index]['loss_fine']=($loss_detail['in_weight']*$loss_detail['in_lot_purity']/100);
      }
    }
    
    return $data;
  }

}