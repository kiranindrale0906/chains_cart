<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Issue_purity_model extends BaseModel {
  protected $table_name = 'issue_purities';
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
    $this->load->model(array('settings/process_issue_purity_model'));
  }

  public function validation_rules() {
    $rules = array(
                  array('field' => 'issue_purities[chain_name]', 'label' => 'chain name',
                          'rules' => array('trim', 'required')),
                  array('field' => 'issue_purities[chain_margin]', 'label' => 'chain margin',
                          'rules' => array('trim', 'required','numeric')),
                  array('field' => 'issue_purities[chain_purity]', 'label' => 'chain Purity',
                          'rules' => array('trim', 'required','numeric')),
                );
    return $rules;
  }

  // public function save($after_save=TRUE) {
  //   if ($this->attributes['chain_name']=='KA Chain' && $this->attributes['category_four']=='All') {
  //     $design_name_records=$this->category_four_model->get();
  //     foreach ($design_name_records as $index => $design_name_record) {
  //       $attributes=$this->attributes;
  //       $attributes['category_four']=$design_name_record['category'];
  //       $issue_purity_obj = new issue_purity_model($attributes);
  //       $issue_purity_obj->before_validate();
  //       if($issue_purity_obj->validate()){
  //         $issue_purity_obj->save(false);
  //       }
  //     }
  //   }
  //   else
  //     parent::store($after_save);
  // } 
  public function get_dynamic_issue_wastage_and_chitti_purity($process_id, $customer_name, $issue_wastage = true) {
    $this->load->model(array('wastages/wastage_master_model','wastages/wastage_master_detail_model'));
    
    $process_detail_select_fields = 'product_name,melting_lot_category_one,tone,machine_size,design_code,out_lot_purity,customer_name';
    $process_detail = $this->process_model->find($process_detail_select_fields, array('id' => $process_id));

    $wastage_details=$this->wastage_master_model->find('id',  array('customer_name'=>$customer_name));

    $wastage_master_details=$this->wastage_master_detail_model->get('', array('wastage_master_id'=>$wastage_details['id'],
                                                                             'chain' => $process_detail['product_name']),
                                                                        array(), array('order_by' => 'sequance'));
//lq();
    foreach($wastage_master_details as $wastage_master_detail_index => $wastage_master_detail) {
      if (    $wastage_master_detail['category_name'] != '' 
          &&  $wastage_master_detail['category_name'] != $process_detail['melting_lot_category_one'])
        continue;

      if (    $wastage_master_detail['tone'] != '' 
          &&  $wastage_master_detail['tone'] != $process_detail['tone'])
        continue;

      if (    $wastage_master_detail['purity'] != '' 
          &&  $wastage_master_detail['purity'] != $process_detail['out_lot_purity'])
        continue;

      if (    $wastage_master_detail['machine_size'] != '' 
          &&  $wastage_master_detail['machine_size'] != $process_detail['machine_size'])
        continue;

      if (    $wastage_master_detail['design'] != '' 
          &&  $wastage_master_detail['design'] != $process_detail['design_code'])
        continue;

      if ($issue_wastage)
        return $wastage_master_detail['wastage'];
      else
        return $wastage_master_detail['factory_purity'];
    }
  }

  public function get_issue_wastage($process_id, $account_name) {
    if($account_name == "MALABAR GOLD")
      return $this->get_malabar_gold_issue_wastage($process_id, $account_name);
    
    $domestic_account_names=$this->issue_department_model->get_account_names_from_accounts("Domestic");
    // if ($account_name != '' && (!in_array($account_name, array('OUTSIDE PARTY','IMPORTED GOODS', 'AQUA GOLD', 'Bhandari Jewellers Pvt.Ltd.', 'CHAIN AND JWELLERY')))) return 0;

    if ($account_name != '' && (!in_array($account_name, $domestic_account_names))) return 0;
    
    $process = $this->Process_model->find('',array('id' => $process_id));
    $process_issue_purity = $this->process_issue_purity_model->find('wastage', array('process_id' => $process_id));
    if (!empty($process_issue_purity)) return $process_issue_purity['wastage']; //&& $process_issue_purity['wastage'] != 0

    if ($process['product_name']=='IMP Premium Chain')
      return 4.00;
    elseif (   $process['product_name']=='Stone Chain'
            || $process['product_name']=='Omega Chain'
            || $process['product_name']=='Morocco Collection') 
      return 5.00;
    
    elseif ($process['product_name']=='KA Chain') {
      if (strpos($process['melting_lot_category_one'], 'IMP') !== false)
        return ($process['out_lot_purity'] == 75.00) ? 2.50 : 2.00; 
      elseif ($process['melting_lot_category_one'] == 'Dhoom Chain')
        return ($process['out_lot_purity'] == 75.00) ? 0.00 : 2.00; 
      elseif ($process['tone'] == '2 Tone')
        return ($process['out_lot_purity'] == 75.00) ? 2.50 : 2.00; 
      elseif (   (strpos($process['design_code'], 'Ball and Capsule Clipping') !== false) 
              || (strpos($process['design_code'], 'Pipe Clipping') !== false))
        return ($process['out_lot_purity'] == 75.00) ? 2.50 : 2.00; 
      elseif ($process['machine_size'] == '0.21')
        return ($process['out_lot_purity'] == 75.00) ? 1.50 : 1.25;
      elseif ($process['machine_size'] == '0.20')
        return ($process['out_lot_purity'] == 75.00) ? 2.50 : 1.50;
      elseif (   $process['machine_size'] == '0.25' 
              && $process['melting_lot_category_one'] == 'LEFT RIGHT')
        return ($process['out_lot_purity'] == 75.00) ? 1.50 : 2.50; 
      elseif (   $process['machine_size'] == '0.25')
        return ($process['out_lot_purity'] == 75.00) ? 1.50 : 1.25; 
      else 
        return ($process['out_lot_purity'] == 75.00) ? 1.25 : 0.80;

    } elseif ($process['product_name']=='Ball Chain')
      return ($process['out_lot_purity'] == 75.00) ? 2.50 : 2.00;
    
    elseif ($process['product_name']=='Fancy Chain') {
      if ($process['out_lot_purity'] == 92.00) {
        if (strtolower($process['melting_lot_category_one']) == strtolower('MOP')) return 1.25;
        else return 1.80;
      } else return 0;

    } elseif ($process['product_name']=='Fancy 75 Chain') {
      if ($process['out_lot_purity'] == 75.00) {
        if     (strtolower($process['melting_lot_category_one']) == strtolower('IMP PREMIUM')) return 4.00;
        elseif (strtolower($process['melting_lot_category_one']) == strtolower('IND PREMIUM')) return 2.50;
        elseif (strtolower($process['melting_lot_category_one']) == strtolower('OMEGA')) return 5.00;
        elseif (strtolower($process['melting_lot_category_one']) == strtolower('STONE CHAIN')) return 5.00;
        elseif (strtolower($process['melting_lot_category_one']) == strtolower('RAINBOW COLLECTION')) return 5.00;
        elseif (strtolower($process['melting_lot_category_one']) == strtolower('CORAL COLLECTION')) return 5.00;
        elseif (strtolower($process['melting_lot_category_one']) == strtolower('DHAGA COLLECTION')) return 5.00;
        elseif (strtolower($process['melting_lot_category_one']) == strtolower('IMP')) return 2.50;
        elseif (strtolower($process['melting_lot_category_one']) == strtolower('SING 75 (YELLOW)')) return 2.25;
        else return 0;
      } else return 0;
      
    } elseif ($process['product_name']=='Indo tally Chain')
      return ($process['out_lot_purity'] == 75.00) ? 2.25 : 1.80;
    
    elseif ($process['product_name']=='Choco Chain') {
      if (in_array($process['melting_lot_category_one'], array('CHOCO', 'MAX CHAIN')))
        return ($process['out_lot_purity'] == 75.00) ? 4.00 : 2.50;
      elseif ($process['melting_lot_category_one']=='MILANO')
        return ($process['out_lot_purity'] == 75.00) ? 6.00 : 2.50;
      elseif (in_array($process['melting_lot_category_one'], array('STAMPOO', 'CASTING CHAIN')))
        return ($process['out_lot_purity'] == 75.00) ? 6.00 : 3.00;
      elseif ($process['melting_lot_category_one']=='CHOCO ROLEX')
        return ($process['out_lot_purity'] == 75.00) ? 4.00 : 3.00;
      elseif ($process['melting_lot_category_one'] == 'CHOCO DHL')
        return ($process['out_lot_purity'] == 75.00) ? 2.50 : 0.00;
      else 
        return 0.00;

    } elseif ($process['product_name']=='Rope Chain') {
      if (strtoupper($process['melting_lot_category_one']) == 'REGULAR') 
        return ($process['out_lot_purity'] == 75.00) ? 1.75 : 1.50;
      elseif (strtoupper($process['melting_lot_category_one']) == 'IMP ROPE')
        return ($process['out_lot_purity'] == 75.00) ? 3.00 : 0.00;
      elseif (strtoupper($process['melting_lot_category_one']) == 'ROPE FANCY')
        return ($process['out_lot_purity'] == 75.00) ? 3.00 : 0.00;
      elseif (strtoupper($process['melting_lot_category_one']) == 'ROPE PRO')
        return ($process['out_lot_purity'] == 75.00) ? 2.25 : 2.00;
      else 
        return 0;

    } elseif ($process['product_name']=='Machine Chain')
      return ($process['out_lot_purity'] == 75.00) ? 2.25 : 1.80;
    
    elseif ($process['product_name']=='Sisma Chain') {
      if (in_array($process['melting_lot_category_one'], array('Lexus Bangle', 'Lexus Necklace')))
        return 5.00;
      elseif (in_array($process['melting_lot_category_one'], array('CHARMS BRC')))
        return ($process['out_lot_purity'] == 75.00) ? 4.50 : 2.50;
      elseif (in_array($process['melting_lot_category_one'], array('Lexus Chain')))
        return ($process['out_lot_purity'] == 75.00) ? 7.00 : 0.00;
      elseif (in_array($process['melting_lot_category_one'], array('Lexus Shanghai')))
        return ($process['out_lot_purity'] == 75.00) ? 4.00 : 0.00;
      elseif (in_array($process['melting_lot_category_one'], array('Lexus Butterfly', 'Lexus Delica')))
        return ($process['out_lot_purity'] == 75.00) ? 5.00 : 0.00;
      else
        return 0.00;
    }
    
    elseif ($process['product_name']=='Imp Italy Chain')
      return 4.00;

    elseif ($process['product_name']=='Hollow Choco Chain')
      return 2.50;

    elseif ($process['product_name']=='Round Box Chain') {
      if ($process['out_lot_purity'] == 75.00)
        return ($process['tone'] == '2 Tone' || $process['melting_lot_category_one'] == '2 Tone') ? 2.50 : 1.25;
      else
        return ($process['tone'] == '2 Tone' || $process['melting_lot_category_one'] == '2 Tone') ? 2.50 : 0.80; 
    } 

    elseif ($process['product_name']=='Refresh')
      return ($process['out_lot_purity'] == 75.00) ? 3.00 : 2.00;
    
    elseif ($process['product_name']=='KA Chain Refresh')  
      return ($process['out_lot_purity'] == 75.00) ? 3.00 : 2.00;

    elseif ($process['product_name']=='Roco Choco Chain')  
      return 2.50;

    elseif ($process['product_name']=='Lotus Chain')  
      return ($process['out_lot_purity'] == 75.00) ? 2.25 : 1.80;

    elseif ($process['product_name']=='Dus Collection')  
      return ($process['out_lot_purity'] == 75.00) ? 3.50 : 1.50;

    elseif ($process['product_name']=='Handmade')  
      return 2.00;

    elseif ($process['product_name']=='Nawabi Chain')  
      return 2.00;

    elseif ($process['product_name']=='ARG Fancy 92')  
      return 1.80;

    elseif ($process['product_name']=='Casting Chain 75')  
      return 5.00;

    else
      $issue_chain_name = $process['product_name'];
    
    $wastage = $this->find('max(chain_margin) as chain_margin', array('chain_name'       => $process['product_name'],
                                                                      'chain_purity'     => $process['in_lot_purity'],
                                                                      'issue_chain_name' => $issue_chain_name));

    return !empty($wastage) ? $wastage['chain_margin'] : 0;
  }

  public function get_malabar_gold_issue_wastage($process_id, $account_name) {
    $domestic_account_names=$this->issue_department_model->get_account_names_from_accounts("Domestic");
    // if ($account_name != '' && (!in_array($account_name, array('OUTSIDE PARTY','IMPORTED GOODS', 'AQUA GOLD', 'Bhandari Jewellers Pvt.Ltd.', 'CHAIN AND JWELLERY')))) return 0;

    if ($account_name != '' && (!in_array($account_name, $domestic_account_names))) return 0;
    
    $process = $this->Process_model->find('',array('id' => $process_id));
    $process_issue_purity = $this->process_issue_purity_model->find('wastage', array('process_id' => $process_id));
    if (!empty($process_issue_purity)) return $process_issue_purity['wastage']; //&& $process_issue_purity['wastage'] != 0

    if ($process['product_name']=='IMP Premium Chain')
      return 4.00;
    elseif (   $process['product_name']=='Stone Chain'
            || $process['product_name']=='Omega Chain'
            || $process['product_name']=='Morocco Collection') 
      return 5.00;
    
    elseif ($process['product_name']=='KA Chain') {
      if (strpos($process['melting_lot_category_one'], 'IMP') !== false)
        return ($process['out_lot_purity'] == 75.00) ? 2.50 : 2.00; 
      elseif ($process['melting_lot_category_one'] == 'Dhoom Chain')
        return ($process['out_lot_purity'] == 75.00) ? 0.00 : 2.00; 
      elseif ($process['tone'] == '2 Tone')
        return ($process['out_lot_purity'] == 75.00) ? 2.50 : 2.2; 
      elseif (   (strpos($process['design_code'], 'Ball and Capsule Clipping') !== false) 
              || (strpos($process['design_code'], 'Pipe Clipping') !== false))
        return ($process['out_lot_purity'] == 75.00) ? 2.50 : 2.00; 
      elseif ($process['machine_size'] == '0.21')
        return ($process['out_lot_purity'] == 75.00) ? 1.50 : 2.2;
      elseif ($process['machine_size'] == '0.20')
        return ($process['out_lot_purity'] == 75.00) ? 2.50 : 3.2;
      elseif (   $process['machine_size'] == '0.25' 
              && $process['melting_lot_category_one'] == 'LEFT RIGHT')
        return ($process['out_lot_purity'] == 75.00) ? 1.50 : 3.2; 
      elseif (   $process['machine_size'] == '0.25')
        return ($process['out_lot_purity'] == 75.00) ? 1.50 : 1.95; 
      else 
        return ($process['out_lot_purity'] == 75.00) ? 1.25 : 1.70;

    } elseif ($process['product_name']=='Ball Chain')
      return ($process['out_lot_purity'] == 75.00) ? 2.50 : 2.00;
    
    elseif ($process['product_name']=='Fancy Chain') {
      if ($process['out_lot_purity'] == 92.00) {
        if (strtolower($process['melting_lot_category_one']) == strtolower('MOP')) return 1.25;
        else return 1.80;
      } else return 0;

    } elseif ($process['product_name']=='Fancy 75 Chain') {
      if ($process['out_lot_purity'] == 75.00) {
        if     (strtolower($process['melting_lot_category_one']) == strtolower('IMP PREMIUM')) return 4.00;
        elseif (strtolower($process['melting_lot_category_one']) == strtolower('IND PREMIUM')) return 2.50;
        elseif (strtolower($process['melting_lot_category_one']) == strtolower('OMEGA')) return 5.00;
        elseif (strtolower($process['melting_lot_category_one']) == strtolower('STONE CHAIN')) return 5.00;
        elseif (strtolower($process['melting_lot_category_one']) == strtolower('RAINBOW COLLECTION')) return 5.00;
        elseif (strtolower($process['melting_lot_category_one']) == strtolower('CORAL COLLECTION')) return 5.00;
        elseif (strtolower($process['melting_lot_category_one']) == strtolower('DHAGA COLLECTION')) return 5.00;
        elseif (strtolower($process['melting_lot_category_one']) == strtolower('IMP')) return 2.50;
        elseif (strtolower($process['melting_lot_category_one']) == strtolower('SING 75 (YELLOW)')) return 2.25;
        else return 0;
      } else return 0;
      
    } elseif ($process['product_name']=='Indo tally Chain')
      return ($process['out_lot_purity'] == 75.00) ? 2.25 : 1.80;
    
    elseif ($process['product_name']=='Choco Chain') {
      if (in_array($process['melting_lot_category_one'], array('CHOCO', 'MAX CHAIN')))
        return ($process['out_lot_purity'] == 75.00) ? 4.00 : 2.50;
      elseif ($process['melting_lot_category_one']=='MILANO')
        return ($process['out_lot_purity'] == 75.00) ? 6.00 : 2.50;
      elseif (in_array($process['melting_lot_category_one'], array('STAMPOO', 'CASTING CHAIN')))
        return ($process['out_lot_purity'] == 75.00) ? 6.00 : 3.00;
      elseif ($process['melting_lot_category_one']=='CHOCO ROLEX')
        return ($process['out_lot_purity'] == 75.00) ? 4.00 : 3.00;
      elseif ($process['melting_lot_category_one'] == 'CHOCO DHL')
        return ($process['out_lot_purity'] == 75.00) ? 2.50 : 0.00;
      else 
        return 0.00;

    } elseif ($process['product_name']=='Rope Chain') {
      if (strtoupper($process['melting_lot_category_one']) == 'REGULAR') 
        return ($process['out_lot_purity'] == 75.00) ? 1.75 : 1.50;
      elseif (strtoupper($process['melting_lot_category_one']) == 'IMP ROPE')
        return ($process['out_lot_purity'] == 75.00) ? 3.00 : 0.00;
      elseif (strtoupper($process['melting_lot_category_one']) == 'ROPE FANCY')
        return ($process['out_lot_purity'] == 75.00) ? 3.00 : 0.00;
      elseif (strtoupper($process['melting_lot_category_one']) == 'ROPE PRO')
        return ($process['out_lot_purity'] == 75.00) ? 2.25 : 2.00;
      else 
        return 0;

    } elseif ($process['product_name']=='Machine Chain')
      return ($process['out_lot_purity'] == 75.00) ? 2.25 : 1.80;
    
    elseif ($process['product_name']=='Sisma Chain') {
      if (in_array($process['melting_lot_category_one'], array('Lexus Bangle', 'Lexus Necklace')))
        return 5.00;
      elseif (in_array($process['melting_lot_category_one'], array('CHARMS BRC')))
        return ($process['out_lot_purity'] == 75.00) ? 4.50 : 2.50;
      elseif (in_array($process['melting_lot_category_one'], array('Lexus Chain')))
        return ($process['out_lot_purity'] == 75.00) ? 7.00 : 0.00;
      elseif (in_array($process['melting_lot_category_one'], array('Lexus Shanghai')))
        return ($process['out_lot_purity'] == 75.00) ? 4.00 : 0.00;
      elseif (in_array($process['melting_lot_category_one'], array('Lexus Butterfly', 'Lexus Delica')))
        return ($process['out_lot_purity'] == 75.00) ? 5.00 : 0.00;
      else
        return 0.00;
    }
    
    elseif ($process['product_name']=='Imp Italy Chain')
      return 4.00;

    elseif ($process['product_name']=='Hollow Choco Chain')
      return 2.50;

    elseif ($process['product_name']=='Round Box Chain') {
      if ($process['out_lot_purity'] == 75.00)
        return ($process['tone'] == '2 Tone' || $process['melting_lot_category_one'] == '2 Tone') ? 2.50 : 1.25;
      else
        return ($process['tone'] == '2 Tone' || $process['melting_lot_category_one'] == '2 Tone') ? 2.50 : 0.80; 
    } 

    elseif ($process['product_name']=='Refresh')
      return ($process['out_lot_purity'] == 75.00) ? 3.00 : 2.00;
    
    elseif ($process['product_name']=='KA Chain Refresh')  
      return ($process['out_lot_purity'] == 75.00) ? 3.00 : 2.00;

    elseif ($process['product_name']=='Roco Choco Chain')  
      return 2.50;

    elseif ($process['product_name']=='Lotus Chain')  
      return ($process['out_lot_purity'] == 75.00) ? 2.25 : 1.80;

    elseif ($process['product_name']=='Dus Collection')  
      return ($process['out_lot_purity'] == 75.00) ? 3.50 : 1.50;

    elseif ($process['product_name']=='Handmade')  
      return 2.00;

    elseif ($process['product_name']=='Nawabi Chain')  
      return 2.00;

    elseif ($process['product_name']=='ARG Fancy 92')  
      return 1.80;

    elseif ($process['product_name']=='Casting Chain 75')  
      return 5.00;

    else
      $issue_chain_name = $process['product_name'];
    
    $wastage = $this->find('max(chain_margin) as chain_margin', array('chain_name'       => $process['product_name'],
                                                                      'chain_purity'     => $process['in_lot_purity'],
                                                                      'issue_chain_name' => $issue_chain_name));

    return !empty($wastage) ? $wastage['chain_margin'] : 0;
  }

  public function get_issue_chitti_purity($process_id, $account_name) {
    $process = $this->Process_model->find('',array('id' => $process_id));
    if ($account_name != '' && (!in_array($account_name, array('OUTSIDE PARTY','IMPORTED GOODS', 'AQUA GOLD', 'Bhandari Jewellers Pvt.Ltd.', 'CHAIN AND JWELLERY')))) return $process['out_lot_purity'];

    $process_issue_purity = $this->process_issue_purity_model->find('chitti_purity', array('process_id' => $process_id));
    if (!empty($process_issue_purity) && $process_issue_purity['chitti_purity'] != 0) return $process_issue_purity['chitti_purity'];

    if (HOST=='ARC') {
      if ($process['out_lot_purity'] > 88)     return 92.00;
      elseif ($process['out_lot_purity'] < 80) return 75.00;
    } 

    if (  $process['product_name']=='IMP Premium Chain'
       || $process['product_name']=='Stone Chain'
       || $process['product_name']=='Omega Chain'
       || $process['product_name']=='Morocco Collection') 
      return 75.00;
    elseif ($process['product_name']=='KA Chain') { 
      if (   $process['out_lot_purity'] == 75.00 
          && (   (strpos($process['design_code'], 'Ball and Capsule Clipping') !== false) 
              || (strpos($process['design_code'], 'Pipe Clipping') !== false))
              || (strpos($process['melting_lot_category_one'], 'IMP') !== false)) 
        return 75.00;
      else
        return $process['out_lot_purity'];

    } elseif ($process['product_name']=='KA Chain Refresh')
      return ($process['out_lot_purity'] == 75.00) ? 75.00 : $process['out_lot_purity'];
    
    elseif ($process['product_name']=='Ball Chain') 
      return ($process['out_lot_purity'] == 75.00) ? 75.00 : $process['out_lot_purity'];
    
    elseif ($process['product_name']=='Finished Goods Receipt')
      $issue_chain_name = $process['melting_lot_category_one'];
    
    elseif (in_array($process['product_name'], array('Choco Chain', 
                                                     'Machine Chain', 
                                                     'Imp Italy Chain', 
                                                     'Sisma Chain', 
                                                     'Round Box Chain', 
                                                     'Indo tally Chain', 
                                                     'Hollow Choco Chain', 
                                                     'Rope Chain',
                                                     'Fancy Chain',
                                                     'Fancy 75 Chain',
                                                     'Refresh'))) 
      return $process['out_lot_purity'];
    else 
      $issue_chain_name = $process['product_name'];
    
    
    $chitti_purity = $this->find('chitti_purity as chitti_purity', array('chain_name'       => $process['product_name'],
                                                                      'chain_purity'     => $process['in_lot_purity'],
                                                                      'issue_chain_name' => $issue_chain_name));
    return !empty($chitti_purity) ? $chitti_purity['chitti_purity'] : 0;
  }

  public function get_usd_wastage($process_id, $account_name) {
    return 1.4;
  }

  public function get_inr_wastage($process_id, $account_name) {
    return 1.2;
  }
}
