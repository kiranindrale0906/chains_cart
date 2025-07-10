<div class="table-responsive">
  <table class="table table-bordered table-sm mb-0">
    <thead>
      <tr>
        <?php
          if(!empty($data['header'])){
            foreach ($data['header'] as $header_value) {
              ?>
                 <th><?=$header_value?></th> 
              <?php
            }
          }
        ?>
        <!-- <th>Name</th>
        <th class="text-right">Views</th> -->
      </tr>
    </thead>
    <tbody>
      <?php
        if(!empty($data['table_data'])){
          foreach ($data['table_data'] as $rows) { ?>
            <tr>
              <?php
                foreach ($rows as $key=>$td_value) {
                  if(@$data['url_argument']!=$key) { ?>
                    <td>
                      <a href="<?=@$data['href'].@$rows[$data['url_argument']]?>" class="black">
                        <?=$td_value?>
                      </a>
                    </td>                  
                <?php
                  }
                }
              ?>
            </tr>  
            <?php
          }
        }
        else { 
          $colspan=count($data['header']); ?>
          <tr colspan="<?=$colspan?>">
            <td>No Records Found</td>
          </tr>
        <?php  
        } ?>
          
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php load_buttons('button', 
                       array('name'=>'View All',
                             'type'=>'button',
                             'class'=>'btn btn-sm btn_blue float-right',
                             'onclick'=>''));?>
        </td>
      </tr>
    </tfoot>
  </table>
</div>
