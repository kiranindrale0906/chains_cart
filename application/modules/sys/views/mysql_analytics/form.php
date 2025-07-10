 <div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <div class="table-responsive m-t-20">
        <table id="example" class="table table-sm fixedthead table-default">
          <thead>
            <tr>
              <th>Date</th>
              <th>Query Time</th>
              <th>Lock Time</th>
              <th>Row Sent</th>
              <th>Row Examined</th>
              <th>DB Name</th>
              <th>Query</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($logs as $index => $log) { ?>
                <tr>
                  <td><?= $log['date'] ?></td>
                  <td><?= $log['query_time'] ?></td>
                  <td><?= $log['lock_time'] ?></td>
                  <td><?= $log['rows_sent'] ?></td>
                  <td><?= $log['rows_examined'] ?></td>
                  <td><?= $log['db_name'] ?></td>
                  <td class="abc">
                    <span>
                      <div class="content hideContent" show="50" toggle-type="link" status="false">
                        <div class="truncate-text" style="display: block;">
                          <?= substr($log['query_string'], 0, 50)  ?>
                          <span class="moreellipses">...&nbsp;&nbsp;<a href="javascript:void(0)" class="moreless more">More</a></span>
                        </div>
                        <div class="truncate-text" style="display: none;">
                          <?= $log['query_string'] ?>
                          <a href="" class="moreless Less">Less</a></div>
                      </div>
                    </span>
                  </td>
                </tr>
              <?php  
              }
            ?>
          </tbody>  
        </table>
      </div> 
    </div>
  </div>       
</div>