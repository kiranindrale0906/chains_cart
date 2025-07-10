<thead class="nowrap">
    <tr>
      <?php foreach ($headings as $thkey => $thvalue) { ?>
          <th>
            <?php echo ucfirst(str_replace("_", " ", $thvalue)); ?>
          </th>
      <?php } ?>
    </tr>
</thead>