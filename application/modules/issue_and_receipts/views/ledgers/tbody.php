<tbody>
  <?php 
  if(!empty($_GET['period'])&&$_GET['period']!=='week' && $_GET['period']!=='month' && $_GET['period']!=='year'){
    $this->load->view('issue_and_receipts/ledgers/balance', array('label' => 'Opening',
                                                                             'created_date' => $previous_date,
                                                                             'type' => $type));
  }
    foreach ($created_date_records as $index => $record) 
      $this->load->view('issue_and_receipts/ledgers/tr', array('record' => $record));
  
    $this->load->view('issue_and_receipts/ledgers/total', array('label' => 'Total',
                                                                           'weight' => $total[$created_date][$type]['weight'],
                                                                            'gross' => $total[$created_date][$type]['gross'],
                                                                           'in_weight' => isset($total[$created_date][$type]['in_weight'])?$total[$created_date][$type]['in_weight']:'',
                                                                            'out_weight' => isset($total[$created_date][$type]['out_weight'])?$total[$created_date][$type]['out_weight']:'',
                                                                            'melting_wastage' => isset($total[$created_date][$type]['melting_wastage'])?$total[$created_date][$type]['melting_wastage']:'','daily_drawer_wastage' => isset($total[$created_date][$type]['daily_drawer_wastage'])?$total[$created_date][$type]['daily_drawer_wastage']:'', 'loss' => isset($total[$created_date][$type]['loss'])?$total[$created_date][$type]['loss']:'', 
                                                                           'fine' => @$total[$created_date][$type]['fine'], 
                                                                           'wastage_fine' => @$total[$created_date][$type]['wastge_fine'], 
                                                                           'wastage_diff' => $total[$created_date][$type]['wastage_diff']));
    $this->load->view('issue_and_receipts/ledgers/balance', array('label' => 'Balance',
                                                                             'created_date' => $created_date,
                                                                             'type' => $type));


  ?>
</tbody>