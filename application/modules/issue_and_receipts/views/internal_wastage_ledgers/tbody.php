<tbody>
  <?php 
    $issue_fine=$issue_melting=0;
    $this->load->view('issue_and_receipts/internal_wastage_ledgers/balance', array('label' => 'Opening',
                                                                             'created_date' => $previous_date,
                                                                             'type' => $type));
    foreach ($created_date_records as $index => $record){
      $issue_melting=four_decimal($record['melting']+$record['internal_wastage']);
      $issue_fine+=$record['weight']*$issue_melting/100;
      $this->load->view('issue_and_receipts/internal_wastage_ledgers/tr', array('record' => $record));
      }
  
    $this->load->view('issue_and_receipts/internal_wastage_ledgers/total', array('label' => 'Total',
                                                                           'weight' => $total[$created_date][$type]['weight'], 
                                                                           'fine' => $total[$created_date][$type]['fine'], 
                                                                           'issue_fine' => $total[$created_date][$type]['issue_fine'], 
                                                                           'vodator' => $total[$created_date][$type]['vodator']));
    $this->load->view('issue_and_receipts/internal_wastage_ledgers/balance', array('label' => 'Balance',
                                                                             'created_date' => $created_date,
                                                                             'type' => $type));


  ?>
</tbody>