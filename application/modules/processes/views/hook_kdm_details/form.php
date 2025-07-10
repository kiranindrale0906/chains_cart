<?php if(isset($hook_in_details)){?>
  <div class="table-responsive">
  <h6>Daily Drawer In</h6>
    <table class="table table-sm table_blue" id="">
      <thead>
        <tr>
          <th>Type</th>
          <th>In</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          if(!empty($hook_in_details)){
            foreach ($hook_in_details as $index => $hook_in_detail) {
              if($hook_in_detail['hook_in']!=0) { ?>
                <tr>
                  <td><?=$hook_in_detail['daily_drawer_type'] ?></td>
                  <td><?=$hook_in_detail['hook_in'] ?></td>
                  <td><?=$hook_in_detail['created_at'] ?></td>
                </tr>
                <?php 
              } 
            }
          } else { ?>
            <tr>
              <td>No record found</td>
            </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php }
  if(isset($hook_out_details)){
  ?>
  <h6>Daily Drawer Out</h6>
    <table class="table table-sm table_blue" id="">
      <thead>
        <tr>
         <th>Type</th>
          <th>Out</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
      <?php 
        if(!empty($hook_out_details)){
          foreach ($hook_out_details as $index => $hook_out_detail) {
            if($hook_out_detail['hook_out']!=0){
      ?>
      <tr>
        <td><?=$hook_out_detail['daily_drawer_type'] ?></td>
        <td><?=$hook_out_detail['hook_out'] ?></td>
        <td><?=$hook_out_detail['created_at'] ?></td>
      </tr>
      <?php } 
          }
        }else{
      ?>
        <tr>
          <td>No record found</td>
        </tr>
      <?php } ?>
      </tbody>
    </table>
  </div>
<?php }?>


