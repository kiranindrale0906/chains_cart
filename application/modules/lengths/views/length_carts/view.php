<div class="boxrow mb-2">
  <div class="float-left">
    <h6 class="heading blue bold text-uppercase mb-0">Length Cart Details</h6>
  </div>
</div>
<div class="table-responsive tablefixedheader">
  <table class="table table-sm fixedthead table-default">
    <thead>
      <tr>
        <th>Design Code</th>
        <th>Range</th>
        <th class="text-right">Weight</th>
        <th class="text-right">Length</th>
        <th class="text-right">Selected Value</th>
        <th class="text-right">Quantity </th>
      </tr>
    </thead>
    <tbody>
      <?php if(!empty($record['length_cart_details'])) { 
        foreach ($record['length_cart_details'] as $length_cart_detail) {
      ?>
      <tr>
        <td><?= $length_cart_detail['design_code']?></td>
        <td><?= $length_cart_detail['range']?></td>
        <td class="text-right"><?= $length_cart_detail['weight']?></td>
        <td class="text-right"><?= $length_cart_detail['length']?></td>
        <td class="text-right"><?= $length_cart_detail['selected_value']?></td>
        <td class="text-right"><?= $length_cart_detail['quantity']?></td>
      </tr>
      <?php } } else {?>
        <tr>
          <td colspan="4">No data found.</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>