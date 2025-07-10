<h6 class="heading blue bold text-uppercase mb-0">Wax Tree Details</h6>
<div class="table-responsive">
  <table class="table table-sm table-default">
    <thead>
      <tr>
        <th>Tree No</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    <?php 
     foreach ($wax_tree_details as $index => $wax_tree_detail) { ?>
      <tr>
        <td><?=$wax_tree_detail['id']?></td> 
        <td class="bold"><a class='red' href="<?=base_url().'wax_tree_process/wax_tree_lot_no_processes/delete/'.$wax_tree_detail['id'].'?lot_no='.$wax_tree_detail['lot_no']?>">remove</a></td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>

