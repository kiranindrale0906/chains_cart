<?php
include_once(APPPATH . "modules/weight_checks/helpers/melting_lots_helper.php");
include_once(APPPATH . "modules/weight_checks/helpers/melting_wastages_helper.php");
include_once(APPPATH . "modules/weight_checks/helpers/daily_drawer_wastages_helper.php");
include_once(APPPATH . "modules/weight_checks/helpers/ghiss_helper.php");
include_once(APPPATH . "modules/weight_checks/helpers/tounch_ghiss_helper.php");
include_once(APPPATH . "modules/weight_checks/helpers/tounch_out_helper.php");
include_once(APPPATH . "modules/weight_checks/helpers/tounch_in_helper.php");
include_once(APPPATH . "modules/weight_checks/helpers/office_outside_helper.php");
include_once(APPPATH . "modules/weight_checks/helpers/hcl_wastages_helper.php");
include_once(APPPATH . "modules/weight_checks/helpers/negative_checks_helper.php");
//include_once(APPPATH . "modules/weight_checks/helpers/tounch_loss_fine_helper.php");

class Weight_checks extends BaseController {
  public function __construct(){
    parent::__construct();
  }
  
  public function index() {
    $hcl_wastage_checks = hcl_wastages_checks();
    $wastage_checks = array_merge(negative_checks(),
                                  melting_lots_checks(), melting_wastages_checks(),
                                  daily_drawer_wastages_checks(),
                                  ghiss_checks(), tounch_ghiss_checks(), tounch_out_checks(), tounch_in_checks(),
                                  office_outside_checks()
                                  //tounch_loss_fine_checks()
                      );
    
    $this->data['records'] = array();
    foreach ($wastage_checks as $wastage_check) {
      $record = array();
      $record['title'] = $wastage_check['title'];
      $record['A'] = isset($wastage_check['A']) ? $this->db->query($wastage_check['A'])->result_array()[0]['weight'] : 0;
      $record['B'] = isset($wastage_check['B']) ? $this->db->query($wastage_check['B'])->result_array()[0]['weight'] : 0;
      $record['C'] = isset($wastage_check['C']) ? $this->db->query($wastage_check['C'])->result_array()[0]['weight'] : 0;
      $record['D'] = isset($wastage_check['D']) ? $this->db->query($wastage_check['D'])->result_array()[0]['weight'] : 0;
      $record['E'] = isset($wastage_check['E']) ? $this->db->query($wastage_check['E'])->result_array()[0]['weight'] : 0;
      $record['query'] = isset($wastage_check['query']) ? $wastage_check['query'] : '';
      $this->data['records'][$wastage_check['srno']] = $record;
    }
    $this->load->render('weight_checks/weight_checks/index', $this->data);
  }
}