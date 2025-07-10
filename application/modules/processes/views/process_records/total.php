 <div class="col-sm-6">
    <div class="table-responsive m-t-10">
    <table class="table table-sm fixedthead">
  	  <thead>
  	  <tr>

        <th>Balance</th>
        <th>Balance Gross</th>
        <th>Balance Fine</th>
  	  </tr>
  	</thead>
  	<tbody>
      <?php

        if(!empty($data)){?>
           <tr class="">
              <td class=" bold"><?= !empty($data['balance'])? four_decimal($data['balance']) :'-' ?></td>

              <td class=" bold"><?= !empty($data['balance_gross'])? four_decimal($data['balance_gross']) :'-' ?></td>

              <td class=" bold"><?= !empty($data['balance_fine'])? four_decimal($data['balance_fine']) :'-' ?></td>
            </tr>
       <?php } ?>
    </tbody>
  	</table>
  </div>
  </div>