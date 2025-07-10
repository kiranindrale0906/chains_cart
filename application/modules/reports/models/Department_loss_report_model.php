<?php 
class Department_loss_report_model extends BaseModel{
  protected $table_name= 'processes';
  
  public function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules($klass='', $index=0){
    $validation_rules='';
    return $validation_rules; 
  }
  
  public function get_daily_department_loss_details($date,$department_names) {
    $loss_records=array();
    if(!empty($date)){
      foreach ($department_names as $index => $category) {
        $department_name=explode(',', $category['department_name']);
        $loss_records[$category['name']]['loss'] =$this->process_model->find('sum((loss+karigar_loss) * wastage_purity / 100) as gross',
                                                                             array('where'=>array('(loss != 0 or karigar_loss !=0) 
                                                                                                  and wastage_purity > 0
                                                                                                  and wastage_lot_purity > 0 and product_name!= "Ghiss Out"'=>NULL,
                                                                                                 'date(created_at)='=>date('Y-m-d',strtotime($date))),
                                                                                    'where_in'=>array('department_name'=>$department_name)))['gross'];

        $loss_records[$category['name']]['loss_out']=$this->process_model->find('sum(process_out_wastage_details.out_weight * processes.wastage_purity / 100) as gross',
                                                                                array('where' => array('process_out_wastage_details.field_name '=>'Loss Out',
                                                                                'process_out_wastage_details.out_weight != '=>0,
                                                                                'date(process_out_wastage_details.created_at)='=>date('Y-m-d',strtotime($date))),
                                                                                'where_in'=>array('processes.department_name'=>$department_name)),
                                                                                array(array('process_out_wastage_details','process_out_wastage_details.process_id=processes.id')))['gross'];
        $loss_details[$category['name']]['loss']=$loss_records[$category['name']]['loss']-$loss_records[$category['name']]['loss_out'];
         
      }
    }
    return $loss_details;
  }
}