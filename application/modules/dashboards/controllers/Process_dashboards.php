<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Process_dashboards extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('users/user_model','processes/process_model','processes/process_field_model'));
  }

  public function index() {
   $users = $this->user_model->get('*');
   $this->data['arc_chain_casting'] = $this->process_model->find('sum(balance) balance,sum(balance_gross)balance_gross ,sum(balance_fine) balance_fine',array('product_name in ("Casting Process") and (department_name in ("Melting Start", "Melting","Casting"))'=>NULL));

   $arc_chain_casting_balance=$this->data['arc_chain_casting']['balance'];
   $arc_chain_casting_balance_gross=$this->data['arc_chain_casting']['balance_gross'];
   $arc_chain_casting_balance_fine=$this->data['arc_chain_casting']['balance_fine'];

    $this->data['pure_metal'] = $this->process_model->find('sum(balance_melting_wastage) balance,sum(balance_melting_wastage)balance_gross ,sum(balance_melting_wastage * out_lot_purity / 100) balance_fine',array('product_name in ("Receipt") and (process_name in ("Receipt"))'=>NULL));

   $pure_metal_balance=$this->data['pure_metal']['balance'];
   $pure_metal_balance_gross=$this->data['pure_metal']['balance_gross'];
   $pure_metal_balance_fine=$this->data['pure_metal']['balance_fine'];

   $this->data['other'] = $this->process_model->find('sum(balance) balance,sum(balance_gross)balance_gross ,sum(balance_fine) balance_fine',array('product_name not in ("Chain 92","Chain 75","Ring","Pendant","Ring 75","Pendant 75","Casting RND","Lock Process","Kuwaitis","Stone Transfer","Arc Chain","Arc 75 Chain","Arc 92 Chain","Arc Ornament","Arc 92 Ornament","Arc 75 Ornament","Arc Kuwaiti","Arc 92 Kuwaiti","Arc 75 Kuwaiti")'=>NULL));

   $other_balance=$this->data['other']['balance'];
   $other_balance_gross=$this->data['other']['balance_gross'];
   $other_balance_fine=$this->data['other']['balance_fine'];

   
   $this->data['daily_drawer_92_in'] = $this->process_model->find('sum(daily_drawer_in_weight) as balance,sum(daily_drawer_in_weight) as balance_gross,
                                                                sum(daily_drawer_in_weight*hook_kdm_purity/100) as balance_fine' ,
                                                array('where'=>array('daily_drawer_in_weight != '=>0,
                                                                     'product_name != '=>'Fancy Chain',
                                                                     '(hook_kdm_purity>90 and hook_kdm_purity<93)'=>NULL,
                                                                     'type != ' => 'GPC Powder',
                                                                     'karigar'=>"Factory")));
   
   $daily_drawer_92_in_balance=$this->data['daily_drawer_92_in']['balance'];
   $daily_drawer_92_in_balance_gross=$this->data['daily_drawer_92_in']['balance_gross'];
   $daily_drawer_92_in_balance_fine=$this->data['daily_drawer_92_in']['balance_fine'];

   $this->data['daily_drawer_92_out']=$this->process_field_model->find('sum(hook_in-hook_out+daily_drawer_out_weight) as balance,sum(hook_in-hook_out+daily_drawer_out_weight) as balance_gross,sum((hook_in-hook_out+daily_drawer_out_weight)*hook_kdm_purity/100) as balance_fine',
                                                       array('where'=>array('(hook_kdm_purity>90 
                                                                             and hook_kdm_purity<93)'=>NULL,
                                                                             'chain_name != '=>'Fancy Chain',
                                                                            'karigar'=>"Factory")));

   $daily_drawer_92_out_balance=$this->data['daily_drawer_92_out']['balance'];
   $daily_drawer_92_out_balance_gross=$this->data['daily_drawer_92_out']['balance_gross'];
   $daily_drawer_92_out_balance_fine=$this->data['daily_drawer_92_out']['balance_fine'];

   $this->data['daily_drawer_75_in'] = $this->process_model->find('sum(daily_drawer_in_weight) as balance,sum(daily_drawer_in_weight) as balance_gross,sum(daily_drawer_in_weight*hook_kdm_purity/100) as balance_fine' ,
                                                array('where'=>array('daily_drawer_in_weight != '=>0,
                                                                     'product_name != '=>'Fancy Chain',
                                                                     '(hook_kdm_purity>70 and hook_kdm_purity<76)'=>NULL,
                                                                     'type != ' => 'GPC Powder',
                                                                     'karigar'=>"Factory")));

   $daily_drawer_75_in_balance=$this->data['daily_drawer_75_in']['balance'];
   $daily_drawer_75_in_balance_gross=$this->data['daily_drawer_75_in']['balance_gross'];
   $daily_drawer_75_in_balance_fine=$this->data['daily_drawer_75_in']['balance_fine'];
 
   $this->data['daily_drawer_75_out']=$this->process_field_model->find('sum(hook_in-hook_out+daily_drawer_out_weight) as balance,sum(hook_in-hook_out+daily_drawer_out_weight) as balance_gross,sum((hook_in-hook_out+daily_drawer_out_weight)*hook_kdm_purity/100) as balance_fine',
                                                       array('where'=>array('(hook_kdm_purity>70 
                                                                             and hook_kdm_purity<76)'=>NULL,
                                                                             'chain_name != '=>'Fancy Chain',
                                                                            'karigar'=>"Factory")));

   $daily_drawer_75_out_balance=$this->data['daily_drawer_75_out']['balance'];
   $daily_drawer_75_out_balance_gross=$this->data['daily_drawer_75_out']['balance_gross'];
   $daily_drawer_75_out_balance_fine=$this->data['daily_drawer_75_out']['balance_fine'];

   $total_balance=$total_balance_gross=$total_balance_fine=0;
   $daily_drawer_92_balance=$daily_drawer_92_in_balance-$daily_drawer_92_out_balance;
   $daily_drawer_75_balance=$daily_drawer_75_in_balance-$daily_drawer_75_out_balance;

   $daily_drawer_92_balance_gross=$daily_drawer_92_in_balance_gross-$daily_drawer_92_out_balance_gross;
   $daily_drawer_75_balance_gross=$daily_drawer_75_in_balance_gross-$daily_drawer_75_out_balance_gross;

   $daily_drawer_92_balance_fine=$daily_drawer_92_in_balance_fine-$daily_drawer_92_out_balance_fine;
   $daily_drawer_75_balance_fine=$daily_drawer_75_in_balance_fine-$daily_drawer_75_out_balance_fine;

   $total_balance=$arc_chain_casting_balance+$arc_chains_balance+$arc_ornament_casting_balance+$arc_ornament_balance+$arc_kuwaitis_balance+$arc_balance_melting_wastage_balance+$pure_metal_balance+$other_balance+$total_rnd_balance+$casting_rnd_balance+$lock_process_balance+$daily_drawer_92_balance+$daily_drawer_75_balance;
   $total_balance_gross=$arc_chain_casting_balance_gross+$arc_chains_balance_gross+$arc_ornament_casting_balance_gross+$arc_ornament_balance_gross+$arc_kuwaitis_balance_gross+$arc_balance_melting_wastage_balance_gross+$pure_metal_balance_gross+$other_balance_gross+$total_rnd_balance_gross+$casting_rnd_balance_gross+$lock_process_balance_gross+$daily_drawer_92_balance_gross+$daily_drawer_75_balance_gross;

   $total_balance_fine=$arc_chain_casting_balance_fine+$arc_chains_balance_fine+$arc_ornament_casting_balance_fine+$arc_ornament_balance_fine+$arc_kuwaitis_balance_fine+$arc_balance_melting_wastage_balance_fine+$pure_metal_balance_fine+$other_balance_fine+$total_rnd_balance_fine+$casting_rnd_balance_fine+$lock_process_balance_fine+$daily_drawer_92_balance_fine+$daily_drawer_75_balance_fine;

   $this->data['total_of_balance']['balance']=$total_balance;
   $this->data['total_of_balance']['balance_gross']=$total_balance_gross;
   $this->data['total_of_balance']['balance_fine']=$total_balance_fine;

   parent::view($users[0]['id']);
  }
}