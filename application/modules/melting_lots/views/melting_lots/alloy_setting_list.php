<div class="row">
  <div class="col-sm-12">
  <h6 class='blue text-uppercase bold mb-3'>Alloy Settings</h6>
    <div class="table-responsive m-t-10">
      <table class="table table-sm fixedthead table-default">
        <thead>
        <tr>
          <th>Product Name</th>
          <th>Weight</th>
          <th>Tone</th>
          <th>Chain</th>
          <th>Category One</th>
          <th>Purity</th>
        </tr>
        </thead>
        <tbody>
          <?php foreach($alloy_settings as $alloy_data){?>
           <tr> 
            <td><?= isset($alloy_data['product_name'])?$alloy_data['product_name']:'-';?></td>
            <td><?= isset($alloy_data['weight'])?$alloy_data['weight']:'-';?></td>
            <td><?= isset($alloy_data['tone'])?$alloy_data['tone']:'-';?></td>
            <td><?= isset($alloy_data['chain'])?$alloy_data['chain']:'-';?></td>
            <td><?= isset($alloy_data['category_one'])?$alloy_data['category_one']:'-';?></td>
            <td><?= isset($alloy_data['alloy_purity'])?$alloy_data['alloy_purity']:'-';?></td>
          <?php }?>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
