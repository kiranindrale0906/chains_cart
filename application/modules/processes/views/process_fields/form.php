<form method="post" class="form-horizontal fields-group-sm mb-0 client_form" 
      enctype="multipart/form-data" action="<?= get_form_action("processes/process_fields", 'store', @$record) ?>">
  <?php 
    load_field('hidden',array('field' =>'request_uri', 'name' => 'request_uri'));
    load_field('hidden',array('field' => 'process_id')); 
    load_field('hidden',array('field' =>'field_name', 'name' => 'field_name')); 
    load_field('hidden',array('field' =>'product_name', 'name' => 'product_name')); 
    load_field('hidden',array('field' =>'process_name', 'name' => 'process_name'));
    load_field('hidden',array('field' =>'department_name', 'name' => 'department_name')); 
    load_field('hidden',array('field' =>'process_factory_order_detail', 'name' => 'process_factory_order_detail')); 

    if (!empty($record['process_factory_order_detail'])) {
      if ($record['department_name'] == 'Factory')
        $this->load->view('process_factory_order_details/form');
      elseif ($record['department_name'] == 'Hook' && $record['field_name'] == 'bounch_out')
        $this->load->view('process_bunch_order_hook_details/form');
      elseif ($record['department_name'] == 'Hook' && $record['field_name'] == 'customer_out')
        $this->load->view('process_factory_order_hook_details/form');
      // elseif ($record['department_name'] == 'GPC')
      //   $this->load->view('process_factory_order_gpc_details/form');
      elseif ($record['department_name'] == 'Bunch GPC')
        $this->load->view('process_bunch_order_gpc_details/form');

    } else { 
  ?>
  <div class="table-responsive">
    <table class="table table-sm table_blue" id="tblAddRow">
      <thead>
        <tr>
          <th>Date</th>
          <?php
            if(isset($process_fields_form_fields)){
              foreach ($process_fields_form_fields as $index => $process_fields_form_field) { ?>
                <th><?= $process_fields_form_field['label'] ?></th>
              <?php  
              }
            }
          ?>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td width="10%">
            <?= date('d-m-Y');?>
          </td>
          <?php
            if(isset($process_fields_form_fields)){
              foreach ($process_fields_form_fields as $index => $process_fields_form_field) { ?>
                <td  width="25%">
                  <?php 
                    if ($process_fields_form_field['database_column'] == 'order_detail_id') { 
                      $process_fields_form_field['options'] = @$order_details;
                    } elseif ($process_fields_form_field['database_column'] == 'design_code_type' && $record['product_name']=="Sisma Chain") { 
                      $process_fields_form_field['options'] = @$all_design_code_types;
                    } elseif ($process_fields_form_field['database_column'] == 'next_department_name' && (!empty($next_department_names))) {
                      if (!(empty($order_details)))
                        $process_fields_form_field['options'] = array();
                      else
                        $process_fields_form_field['options'] = $next_department_names;
                    } 


                  ?>
                  <?php load_field('plain/'.$process_fields_form_field['field_type'],
                                   array('field' => $process_fields_form_field['database_column'],
                                         'option' => @$process_fields_form_field['options'],
                                         'layout' => 'application')); ?>
                </td>
              <?php  
              } 
            }
          ?>
        </tr>
      </tbody>
    </table>
  </div>
  <?php  }?>
    <button type="submit"  class="btn btn-ms btn_blue ajax_post">SUBMIT</button>
</form>
<?php 
  if (empty($record['process_factory_order_detail'])) {
    if (isset($process_fields) && !empty($process_fields)) { 
      $this->load->view('process_fields/view');
    }
  }
?>
