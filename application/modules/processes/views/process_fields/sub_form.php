<?php echo form_open(base_url().'processes/process_fields/store?type=1&product_name='.$record['product_name'].'&id='.$record['process_id'].'&process_name='.$record['process_name']);?>
  <div row>
    <div class="table-responsive">
      <table class="table table-sm table_blue" id="tblAddRow">
        <tbody>
          <tr>
            <td width="10%">
              <?= date('d-m-Y');?>
              <?php load_field('hidden',array('field' => 'process_id')); ?>
              <?php load_field('hidden',array('field' =>'field_name',
                                              'name' => 'field_name')); ?>
              <?php load_field('hidden',array('field' =>'product_name',
                                              'name' => 'product_name')); ?>
              <?php load_field('hidden',array('field' =>'process_name',
                                              'name' => 'process_name')); ?>
            </td>
            <?php
            if(isset($process_fields_form_fields)){
              foreach ($process_fields_form_fields as $index => $process_fields_form_field) { ?>
                <td  width="12%">
                  <?php load_field('plain/'.$process_fields_form_field['field_type'],
                                   array('field' => $process_fields_form_field['database_column'],
                                         'option' => @$process_fields_form_field['options'],
                                         'class' => 'set_cursor_'.$process_fields_form_field['database_column'],
                                         'layout' => 'application')); ?>
                                                        
                </td>
                
              <?php  
              } }
            ?>
          </tr>
        </tbody>
      </table>
      <button type="submit" class="btn bth-sm btn_blue ajax_post">SUBMIT</button>
    </div>
  
</form>
<?php 
  if (isset($process_fields) && !empty($process_fields)) { 
    $this->load->view('process_fields/view');
  }
?>