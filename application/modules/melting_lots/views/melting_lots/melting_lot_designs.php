<?php
  $process=$melting_lots[0]['process'];
  $design_code_cols=get_design_code_cols($process);
  $is_add_more=get_add_more_flag($melting_lots[0]['process']);
?>
<div class="col-lg-12">
  <div class="card">
    <div class="card-body">
      <?php if($is_add_more){ ?>
        <a href="<?=ADMIN_PATH.'Admin/design_code/create/'.y_encrypt($wastage_group['id'])?>" class="btn btn-sm btn-success pull-right m-b-10">Add More Design</a>
      <?php } ?>
      <span class="card-title custom_heading">Design Codes</span>
      <div class="table-responsive">
        <table class="table color-table info-table table-bordered">
          <thead>
            <tr>
              <?php
                if(sizeof($design_code_cols)>0){
                  foreach($design_code_cols as $col => $col_label) {
              ?>
              <th><?=@$col_label?></th>
              <?php } } ?>
            </tr>
          </thead>
          <tbody>
            <?php
            if(isset($process_records)){
             foreach ($process_records as $index => $process_record) { ?>
              <tr>
                <?php 
                  foreach($design_code_cols as $col => $col_label) {
                ?>
                  <td><?=$process_record[$col]?></td>
                <?php } ?>
              </tr>
            <?php }} ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
