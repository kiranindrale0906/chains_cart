<h5 class="heading"><?php echo 'ISSUE DETAILS'; ?></h5>
<div class="row">
  <?php if(!empty($issue_detail_names)) { 
    foreach ($issue_detail_names as $key => $issue_detail_name) {
      $total_out = 0;
  ?>
    <div class="col-md-6">
      <div class="col-md-6">
        <label class="medium mr-4"><?= $issue_detail_name['issue_department_names'];?>: </label>
      </div>
      <div class="col-md-12">
        <table class="table table-sm">
          <thead class="bg_gray">
            <tr>
              <th class="text-right">Out</th>
              <th class="text-right">Created At</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($issue_details as $key => $value) { ?>
              <tr>
                <?php if($issue_detail_name['issue_department_names'] == $value['field_name']) { 
                  $total_out += $value['out_weight'];
                ?>
                  <td class="text-right"><?= $value['out_weight']?></td>
                  <td class="text-right"><?= date("d-m-Y H:i:s",strtotime($value['created_at']))?></td>
                  <td class="text-right"><?= '<a href="'.base_url().'issue_departments/issue_departments/view/'.$value['issue_department_id'].'">VIEW</a>'?></td>
                <?php } ?>
              </tr>
            <?php } ?>
          </tbody>
          <tfoot class="bg_light_gray bold">
            <tr>
              <td class="text-right"><?= four_decimal($total_out)?></td>
              <td colspan="2"></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  <?php } } else { ?>
    <div class="col-md-12">
      No Records
    </div>
  <?php } ?>
</div>
<hr class="mt0">
