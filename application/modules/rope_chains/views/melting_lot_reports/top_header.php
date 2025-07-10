<thead class="thead-light">
  <tr>
    <th></th>
    <th></th>
    <th></th> 
    <th></th>
    <th></th>
    <th></th>

    <?php foreach ($process_departments as $process => $departments) { ?>  
      <?php foreach ($departments as $department) { ?>   
        <th colspan = <?= sizeof($fields[$department]) ?>><?= $process.' >> '.$department ?></th>
      <?php } ?>
    <?php } ?>
  </tr>
</thead>