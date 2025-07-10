<form method="post" class="form-horizontal fields-group-sm form_radius_none" enctype="multipart/form-data"
      action="<?= get_form_action($controller, $action, $record) ?>">
  <div class="row">
    <?php if ($action == 'edit' || $action == 'update'): ?>
      <?php load_field('hidden', array('field' => 'id')) ?>
    <?php endif; ?>
    <?php load_field('dropdown', array('field' => 'name','option'=> (!empty($departments) ? $departments : ''))) ?>
    <?php load_field('text', array('field' => 'other_departments')) ?>
    <?php load_field('dropdown', array('field' => 'karigar_name','option'=> (!empty($karigars) ? $karigars : ''))) ?>
    <?php load_field('dropdown', array('field' => 'check_field','option'=> (!empty($types) ? $types : ''))) ?>
    <?php load_field('dropdown', array('field' => 'department_process_value','option'=> (!empty($process) ? $process : ''))) ?>
  </div>
  <hr>
  <h6 class="bold">No Of Workers Details</h6>
  <div class="col-md-12">
    <div class="float-right">
        <?= getJsButton('Add More', 'javascript:void(0)', 'btn-sm underline text-blue float-right bold mb-1', '', 'add_department_workers()'); ?>
    </div>
    <div class="table-responsive">
      <table border="0" class="table table-sm table-default">
        <th>Department Date</th>
        <th>No Of Workers</th>
        <tbody id="department_worker">
        <?php 
        foreach ($department_workers as $index => $department_worker) {
          $this->load->view('departments/subform', array('index' =>$index)); 
        }?>
        </tbody>
      </table>
    </div>
  </div>
  <?php load_buttons('submit',array('name' => 'Save',
                                    'class' => 'btn-sm btn_blue')) ?>
</form>

<script>
  <?php 
  $department_worker_form_html = $this->load->view('../departments/subform',
                                                array('index' => 'index_count'),TRUE);?>
   var department_worker_form_html = <?= json_encode(array('html' => $department_worker_form_html)); ?>;
   var fields_index_img = <?= time() ?>;
  function add_department_workers() {
    
      var html_str = department_worker_form_html.html.replace(/\index_count/g, fields_index_img);
      fields_index_img += 1;
      $('#department_worker').append(html_str);
    return false;
  }
  function delete_departments(index) {
    $("input[name*='department_workers["+index+"][delete]']").val(1);
    $(".department_workers_"+index).hide();
  }
</script>