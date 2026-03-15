<div class="row">
<div class="col-sm-12">
<h6 class='blue text-uppercase bold mb-3'>Alloy Element Detail Report</h6>
<div class="table-responsive m-t-10">
  <form class="fields-group-sm">
    <div class="row">
      <?php load_field('dropdown',array('field' => 'company_name', 'col'=>'col-sm-3','option' => $company_name));?>
      <?php load_field('dropdown',array('field' => 'alloy_name', 'col'=>'col-sm-3','option' => $alloy_name));?>
      
    </div>
  </form>
  <table class="table table-sm fixedthead table-default">
	  <thead>
	  <tr>
	    <th>Company Name</th>
      <th>Alloy Name</th>
      <th>AG</th>
      <th>CU</th>
      <th>ZN</th>
      <th>IN</th>
      <th>IR</th>
      <th>CO</th>
      <th>RU</th>
      <th>NI</th>
      <th>XI </th>
      <th>GA </th>
      <th>TA </th>
      <th>GE </th>
	    <th>Extra</th>
	  </tr>
	</thead>
	<tbody>
    <?php
      if(!empty($record['alloy_element_details'])){
        foreach ($record['alloy_element_details'] as $index => $record) {
          ?>
          <tr>
            <td><?= !empty($record['company_name'])?$record['company_name']:'-' ?></td>
            <td><?= !empty($record['alloy_name'])?$record['alloy_name']:'-' ?></td>
            <td><?= !empty($record['ag'])?$record['ag']:'-' ?></td>
            <td><?= !empty($record['cu'])?$record['cu']:'-' ?></td>
            <td><?= !empty($record['zn'])?$record['zn']:'-' ?></td>
            <td><?= !empty($record['i_n'])?$record['i_n']:'-' ?></td>
            <td><?= !empty($record['ir'])?$record['ir']:'-' ?></td>
            <td><?= !empty($record['co'])?$record['co']:'-' ?></td>
            <td><?= !empty($record['ru'])?$record['ru']:'-' ?></td>
            <td><?= !empty($record['ni'])?$record['ni']:'-' ?></td>
            <td><?= !empty($record['xi'])?$record['xi']:'-' ?></td>
            <td><?= !empty($record['ga'])?$record['ga']:'-' ?></td>
            <td><?= !empty($record['ta'])?$record['ta']:'-' ?></td>
            <td><?= !empty($record['ge'])?$record['ge']:'-' ?></td>
            <td><?= !empty($record['extra'])?$record['extra']:'-' ?></td>
          </tr>
        <?php }?>
     <?php }else{ ?>
        <tr>
          <td>No Record Found.</td>
        </tr>
      <?php }
    ?>
  </tbody>
	</table>
</div>
</div>
</div>