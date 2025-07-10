 <div class="col-sm-6">
    <div class="table-responsive m-t-10">
    <table class="table table-sm fixedthead table-red" border="1">
  	<tbody>
      <?php
       
          if(!empty($data)){
            foreach($data as $data_key => $data_value){
              if(in_array($data_key,out_columns()) && $data_value != '0.0000'){
              ?>
              <tr class="bg_pink">
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