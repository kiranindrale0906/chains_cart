<tbody>
  <?php 
    $this->load->view('reports/gpc_out_reports/balance', array('label' => 'Opening',
                                                                             'created_date' => $previous_date,
                                                                             'type' => $type));

    foreach ($created_date_records as $index => $record) 
      $this->load->view('reports/gpc_out_reports/tr', array('record' => $record));
  
    $this->load->view('reports/gpc_out_reports/total', array('label' => 'Total',
                                                                           'weight' => $total[$created_date][$type]['weight'], 
                                                                           'gpc_powder' => $total[$created_date][$type]['gpc_powder'], 
                                                                           'kcn' => $total[$created_date][$type]['kcn'], 
                                                                           'fine' => $total[$created_date][$type]['fine']));
    $this->load->view('reports/gpc_out_reports/balance', array('label' => 'Balance',
                                                                             'created_date' => $created_date,
                                                                             'type' => $type));


  ?>
</tbody>