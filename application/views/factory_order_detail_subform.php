<tr class="table_ka_chain_factory_order_<?= $index ?>">
    <td>
    <input type="hidden" class="form-control" name="factory_order_details[<?=$index?>][ka_chain_factory_order_id]" value="<?=@$factory_order_detail['ka_chain_factory_order_id']?>" >
    <input type="text" class="form-control" name="factory_order_details[<?=$index?>][market_design_name]" value="<?=@$factory_order_detail['market_design_name']?>"onkeyup="on_change_market_design_name(<?=$index?>)" >
     <?php  
            // pd($index);
     if(form_error('factory_order_details[<?= $index ?>][market_design_name]'))
        { 
          echo "<span style='color:red'>".form_error('factory_order_details[<?= $index ?>][market_design_name]')."</span>";
        } 
    ?>
    </td> 
    <td>
    <input type="text" class="form-control" name="factory_order_details[<?=$index?>][14_inch_qty]" value="<?=@$factory_order_detail['14_inch_qty']?>" >
    </td>
    <td>
    <input type="text" class="form-control" name="factory_order_details[<?=$index?>][15_inch_qty]" value="<?=@$factory_order_detail['15_inch_qty']?>" >
    </td>
    <td>
    <input type="text" class="form-control" name="factory_order_details[<?=$index?>][16_inch_qty]" value="<?=@$factory_order_detail['16_inch_qty']?>" >
    </td>
    <td>
    <input type="text" class="form-control" name="factory_order_details[<?=$index?>][17_inch_qty]" value="<?=@$factory_order_detail['17_inch_qty']?>" >
    </td>
    <td>
    <input type="text" class="form-control" name="factory_order_details[<?=$index?>][18_inch_qty]" value="<?=@$factory_order_detail['18_inch_qty']?>" >
    </td>
    <td>
    <input type="text" class="form-control" name="factory_order_details[<?=$index?>][19_inch_qty]" value="<?=@$factory_order_detail['19_inch_qty']?>" >
    </td>
    <td>
    <input type="text" class="form-control" name="factory_order_details[<?=$index?>][20_inch_qty]" value="<?=@$factory_order_detail['20_inch_qty']?>">
    </td>
    <td>
    <input type="text" class="form-control" name="factory_order_details[<?=$index?>][21_inch_qty]" value="<?=@$factory_order_detail['21_inch_qty']?>" >
    </td>
    <td>
    <input type="text" class="form-control" name="factory_order_details[<?=$index?>][22_inch_qty]" value="<?=@$factory_order_detail['22_inch_qty']?>">
    </td>
    <td>
    <input type="text" class="form-control" name="factory_order_details[<?=$index?>][23_inch_qty]" value="<?=@$factory_order_detail['23_inch_qty']?>" >
    </td>
    <td>
    <input type="text" class="form-control" name="factory_order_details[<?=$index?>][24_inch_qty]" value="<?=@$factory_order_detail['24_inch_qty']?>">
    </td>
    <td>
    <input type="text" class="form-control" name="factory_order_details[<?=$index?>][25_inch_qty]" value="<?=@$factory_order_detail['25_inch_qty']?>" >
    </td>
    <td>
    <input type="text" class="form-control" name="factory_order_details[<?=$index?>][26_inch_qty]" value="<?=@$factory_order_detail['26_inch_qty']?>">
    </td>
    <td>
    <input type="text" class="form-control" name="factory_order_details[<?=$index?>][27_inch_qty]" value="<?=@$factory_order_detail['27_inch_qty']?>" >
    </td>
    <td>
    <input type="text" class="form-control" name="factory_order_details[<?=$index?>][28_inch_qty]"  value="<?=@$factory_order_detail['28_inch_qty']?>">
    </td>
    <td>
    <input type="text" class="form-control" name="factory_order_details[<?=$index?>][29_inch_qty]" value="<?=@$factory_order_detail['29_inch_qty']?>" >
    </td>
    <td>
    <input type="text" class="form-control" name="factory_order_details[<?=$index?>][30_inch_qty]" value="<?=@$factory_order_detail['30_inch_qty']?>">

    </td>
    <td>
    <input type="text" class="form-control" name="factory_order_details[<?=$index?>][31_inch_qty]" value="<?=@$factory_order_detail['31_inch_qty']?>" >
    </td>
    <td>
    <input type="text" class="form-control" name="factory_order_details[<?=$index?>][32_inch_qty]" value="<?=@$factory_order_detail['32_inch_qty']?>">

    </td>
    <td>
    <input type="text" class="form-control" name="factory_order_details[<?=$index?>][33_inch_qty]" value="<?=@$factory_order_detail['33_inch_qty']?>" >
    </td>
    <td>
    <input type="text" class="form-control" name="factory_order_details[<?=$index?>][34_inch_qty]" value="<?=@$factory_order_detail['34_inch_qty']?>">

    </td>
    <td>
    <input type="text" class="form-control" name="factory_order_details[<?=$index?>][35_inch_qty]" value="<?=@$factory_order_detail['35_inch_qty']?>" >
    </td>
    <td>
    <input type="text" class="form-control" name="factory_order_details[<?=$index?>][36_inch_qty]" value="<?=@$factory_order_detail['36_inch_qty']?>">

    </td>
    
<td>
<a class='btn btn-danger' onclick="delete_ka_chain_factory_order(<?=$index?>)">Delete</a>
</td>

</tr>


<!-- Script -->
