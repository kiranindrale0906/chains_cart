<?php 
class Alloy_gpc_vodator_ledger_model extends BaseModel{
  protected $table_name= 'processes';
  
  public function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules($klass='', $index=0){
    $validation_rules='';
    return $validation_rules; 
  }

  public function get_alloy_vodator_ledger($group=false) {                  
    $alloy_vodator_fields = 'sum(alloy_vodatar) as weight, sum(alloy_vodatar * lot_purity) / sum(alloy_vodatar) as purity, 
                             sum(alloy_vodatar * lot_purity / 100) as fine, 
                             date(created_at) as created_date';
    
    $group_by = ($group==true) ? 'group by date(created_at)' : '';
    $query = $this->db->query("select ".$alloy_vodator_fields." 
                                from melting_lots 
                                where alloy_vodatar != 0 
                                      and created_at > '2022-04-01' ".$group_by."  order by date(created_at) desc");
    $receipts= $query->result_array();
    return $receipts;
  }
  public function get_alloy_issue_ledger($group=false) {                  
   $alloy_issue_fields = 'sum(in_weight) as weight, 
                           sum(in_weight * in_lot_purity) / sum(in_weight) as purity, 
                           sum(in_weight * in_lot_purity / 100) as fine, 
                           date(created_at) as created_date, date(created_at) as created_at'; 

    $group_by = ($group==true) ? 'group by date(created_at)' : '';
    $query = $this->db->query("select ".$alloy_issue_fields." 
                              from processes 
                              where in_weight != 0  and product_name='Alloy Issue'
                                    and created_at > '2022-04-01' ".$group_by." order by date(created_at) desc");
    $receipts = $query->result_array();
    return $receipts;
  }

  public function get_gpc_vodator_ledger($group=false) {                  
    $gpc_vodator_fields = 'sum(micro_coating) as weight, 
                           sum(micro_coating * in_lot_purity) / sum(micro_coating) as purity, 
                           sum(micro_coating * in_lot_purity / 100) as fine, 
                           date(created_at) as created_date, date(created_at) as created_at'; 

    $group_by = ($group==true) ? 'group by date(created_at)' : '';
    $query = $this->db->query("select ".$gpc_vodator_fields." 
                              from processes 
                              where micro_coating != 0  
                                    and created_at > '2022-04-01' ".$group_by." order by date(created_at) desc");
    $receipts = $query->result_array();
    return $receipts;
  }

  public function get_stone_vatav_ledger($group=false) {                  
    $stone_vatav_fields = 'sum(stone_vatav - out_stone_vatav) as weight, 
                           sum((stone_vatav - out_stone_vatav) * in_lot_purity) / sum(stone_vatav - out_stone_vatav) as purity, 
                           sum((stone_vatav - out_stone_vatav) * in_lot_purity / 100) as fine, 
                           date(created_at) as created_date, date(created_at) as created_at';

    $group_by = ($group==true) ? 'group by date(created_at)' : '';
    $query = $this->db->query("select ".$stone_vatav_fields." 
                                from processes 
                                where (stone_vatav - out_stone_vatav) != 0
                                      and (process_name) != 'Meena Process'
                                      and created_at > '2022-04-01' ".$group_by." order by date(created_at) desc");
    $receipts = $query->result_array();
    return $receipts;
  }

  public function get_meena_vatav_ledger($group=false) {                  
    $stone_vatav_fields = 'sum(stone_vatav - out_stone_vatav) as weight, 
                           sum((stone_vatav - out_stone_vatav) * in_lot_purity) / sum(stone_vatav - out_stone_vatav) as purity, 
                           sum((stone_vatav - out_stone_vatav) * in_lot_purity / 100) as fine, 
                           date(created_at) as created_date, date(created_at) as created_at';

    $group_by = ($group==true) ? 'group by date(created_at)' : '';
    $query = $this->db->query("select ".$stone_vatav_fields." 
                                from processes 
                                where (stone_vatav - out_stone_vatav) != 0
                                      and (process_name) = 'Meena Process'
                                      and created_at > '2022-04-01' ".$group_by." order by date(created_at) desc");
    $receipts = $query->result_array();
    return $receipts;
  }

  public function get_copper_vatav_ledger($group=false) {                  
    $stone_vatav_fields = 'sum(copper_in - copper_out) as weight, 
                           sum((copper_in - copper_out) * in_lot_purity) / sum(copper_in - copper_out) as purity, 
                           sum((copper_in - copper_out) * in_lot_purity / 100) as fine, 
                           date(created_at) as created_date, date(created_at) as created_at';

    $group_by = ($group==true) ? 'group by date(created_at)' : '';
    $query = $this->db->query("select ".$stone_vatav_fields." 
                                from processes 
                                where (copper_in - copper_out) != 0
                                      and created_at > '2022-04-01' ".$group_by." order by date(created_at) desc");
    $receipts = $query->result_array();
    return $receipts;
  }

  public function get_rhodium_vatav_ledger($group=false) {                  
    $stone_vatav_fields = 'sum(rhodium_in) as weight, 
                           sum((rhodium_in) * in_lot_purity) / sum(rhodium_in) as purity, 
                           sum((rhodium_in) * in_lot_purity / 100) as fine, 
                           date(created_at) as created_date, date(created_at) as created_at';

    $group_by = ($group==true) ? 'group by date(created_at)' : '';
    $query = $this->db->query("select ".$stone_vatav_fields." 
                                from processes 
                                where (rhodium_in != 0)
                                      and created_at > '2022-04-01' ".$group_by." order by date(created_at) desc");
    $receipts = $query->result_array();
    return $receipts;
  }

  public function get_tounch_loss_fine_ledger($group=false) {                  
    $tounch_loss_fine_fields = '-1 * sum(tounch_loss_fine) as weight, 
                                100 as purity, 
                                -1 * sum(tounch_loss_fine) as fine, 
                                date(created_at) as created_date, date(created_at) as created_at';

    $group_by = ($group==true) ? 'group by date(created_at)' : '';
    $query = $this->db->query("select ".$tounch_loss_fine_fields." 
                                from processes 
                                where (tounch_loss_fine != 0) 
                                       and parent_lot_id = 0
                                       and product_name != 'Melting Wastage Refine Out'
                                       and created_at > '2022-04-01' ".$group_by." order by date(created_at) desc");
    $receipts = $query->result_array();
    return $receipts;
  }
  public function get_spring_vatav_ledger($group=false) {
    $spring_vatav_fields = 'sum(spring_vatav) as weight,
                           sum(spring_vatav * in_lot_purity) / sum(spring_vatav) as purity,
                           sum(spring_vatav * in_lot_purity / 100) as fine,
                           date(created_at) as created_date, date(created_at) as created_at';

    $group_by = ($group==true) ? 'group by date(created_at)' : '';
    $query = $this->db->query("select ".$spring_vatav_fields."
                              from processes
                              where spring_vatav != 0
                                    and created_at > '2022-04-01' ".$group_by." order by date(created_at) desc");
    $receipts = $query->result_array();
    return $receipts;
  }

}
