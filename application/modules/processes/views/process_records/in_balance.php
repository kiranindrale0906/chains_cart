  <div class="col-sm-12">
    <h6 class='blue text-uppercase bold mb-2'><?=$title;?></h6>
    <a class="pull-right" target="_blank" href="<?php echo base_url().'processes/processes/view/'.$data['id']?>">View</a>
    <div class="table-responsive m-t-10">
    <table class="table table-sm fixedthead red table-gray">
      <thead>
      <tr>
        <th>Product Name</th>
        <th>Process Name</th>
        <th>Department Name</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if(!empty($data)){?>
           <tr>
              <td><?= !empty($data['product_name'])?$data['product_name']:'-' ?></td>

              <td><?= !empty($data['process_name'])?$data['process_name']:'-' ?></td>

              <td><?= !empty($data['department_name'])?$data['department_name']:'-' ?></td>

            </tr>

     <?php }?>
    </tbody>
    </table>
  </div>
  </div>

  <div class="col-sm-6">
      <div class="table-responsive m-t-10">
      <table class="table table-sm fixedthead table-green" border="1">
    	<tbody>
        <?php
       
          if(!empty($data)){
            //pr($data);
            foreach($data as $data_key => $data_value){
              if(in_array($data_key,in_columns()) && $data_value != '0.0000'){
              ?>
              <tr class="bg_green">
                <td class=" bold"><?php echo strtoupper(str_replace("_"," ",$data_key));?></td><td class=" bold"><?= $data_value; ?></td>
              </tr>
            <?php } } }else{ ?>
            <tr>
              <td>No Record Found.</td>
            </tr>
          <?php }
        ?>
      </tbody>
    	</table>
    </div>
  </div>