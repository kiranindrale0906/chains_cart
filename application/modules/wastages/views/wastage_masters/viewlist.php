<div>
<?php //pd(validation_errors(),0); ?>
  <h6 class="bold float-left mb-0">Wastage Details</h6>
</div>
<div class="table-responsive">
  <table class="table table-sm">
    <thead class="bg_gray">
      <tr>
      <th>Chain </th> 
      <th>Category</th>
      <th>Tone</th>
      <th>Purity</th>
      <th>Machine Size</th>
      <th>Design</th>
      <th>Wastage</th>
      <th>Factory Purity</th>
      <th>Sequence</th>
                                   
      </tr>
    </thead>
    <tbody id="table_wastage">
      <?php
      if(!empty($wastage_master_details)){
        foreach($wastage_master_details as $index => $value) { ?>
          <tbody class="">
            <tr>
            <td><?=$value['chain']?></td> 
            <td><?=$value['category_name']?></td>
            <td><?=$value['tone']?></td>
            <td><?=$value['purity']?></td>
            <td><?=$value['machine_size']?></td>
            <td><?=$value['design']?></td>
            <td><?=$value['wastage']?></td>
            <td><?=$value['factory_purity']?></td>
            <td><?=$value['sequance']?></td>
                                         
            </tr>
          </tbody>
      <?php }
      }?>
    </tbody>
  </table>
</div> 
<hr/>
