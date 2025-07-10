<thead class="thead-light" id="myHeader">
  <tr>
    <th>Parent Lot</th>
    <th>Melting Lot</th>
    <th>Purity</th>
    <th>Category</th>
    <!-- <th>Laser Powder</th> -->
    <th>Machine Size</th>
    <th>Design Code</th>

    <?php 
      foreach ($process_departments as $process => $departments) {
        foreach ($departments as $department) {
          foreach ($fields[$department] as $field) { ?>
            <th><?= ucwords(str_replace('_', ' ', $field)); ?></th>
          <?php } 
        }
      } 
    ?>
  </tr>
</thead>