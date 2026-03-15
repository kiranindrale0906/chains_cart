<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
}
</style>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script>

function on_click_function() {
    market_design_name=$("#market_design_name").val();
    category_name=$("#category_name").val();
    design_name=$("#design_name").val();
    gauge=$("#gauge").val();
    line=$("#line").val();
    if(market_design_name!=''){
        market_design_name='&market_design_name='+market_design_name;
    }
    if(category_name!=''){
        category_name='&category_name='+category_name;
    }
    if(design_name!=''){
        design_name='&design_name='+design_name;
    }
    if(gauge!=''){
        gauge='&gauge='+gauge;
    }
     if(line!=''){
        line='&line='+line;
    }
    var url = window.location.href;
    var new_url = url.split('?')[0];
    window.location.href=new_url+'?'+market_design_name+category_name+design_name+gauge+line;
}
    function on_click_clear(){
      var url = window.location.href;
      var new_url = url.split('?')[0];
      window.location.href=new_url;
    }
</script>

<div id="container" class="container" >
    <h3>Factory Order Masters</h3>
    <div class="row">
    Filter By:<br>
        Market Design Name:  <input type="text" id="market_design_name" class="market_design_name" value="<?=!empty($_GET['market_design_name'])?$_GET['market_design_name']:''?>" ><br>
        Factory Design Name:  <input type="text" id="design_name" class="design_name" value="<?=!empty($_GET['design_name'])?$_GET['design_name']:''?>" ><br>
        Category Name:                                <input type="text" id="category_name" class="category_name" value="<?=!empty($_GET['category_name'])?$_GET['category_name']:''?>" ><br>
        Gauge:  <input type="text" id="gauge" class="gauge" value="<?=!empty($_GET['gauge'])?$_GET['gauge']:''?>" ><br>
        Line:  <input type="text" id="line" class="line" value="<?=!empty($_GET['line'])?$_GET['line']:''?>" ><br><br>
        <button onclick="on_click_function()">Submit</button>
        <button onclick="on_click_clear()">Clear</button>
    </div> 
    <br>
        <table class="" style="width:100%" >
            <thead>
            <tr>
                <th>Market Design Name </th>
                <th>Factory Design Name</th>
                <th>Category Name</th>
                <th class='text-right'>Line</th>
                <th class='text-right'>Gauge</th>
                <th class='text-right'>Wt In 18 Inch</th>
                <th class='text-right'>Wt In 24 Inch</th>
            </tr>
            </thead>

            <tbody>
              <?php
                if(isset($factory_order_masters) && is_array($factory_order_masters) && count($factory_order_masters)): 
                $i=1;
                foreach ($factory_order_masters as $index => $factory_order) { 
                ?>
                <tr <?php if($i%2==0){echo 'class="even"';}else{echo'class="odd"';}?>>
                    <td><?php echo $factory_order['market_design_name']; ?></td>
                    <td><?php echo $factory_order['design_name']; ?></td>
                    <td><?php echo $factory_order['category_name']; ?></td>            
                    <td class='text-right'><?php echo $factory_order['line']; ?></td>
                    <td class='text-right'><?php echo $factory_order['gauge']; ?></td>
                    <td class='text-right'><?php echo $factory_order['wt_in_18_inch']; ?></td>
                    <td class='text-right'><?php echo $factory_order['wt_in_24_inch']; ?></td>
                    
                </tr>
                <?php
                    $i++;
                      }
                    else:
                ?>
                <tr>
                    <td colspan="7" align="center" >No Records Found..</td>
                </tr>
                <?php
                    endif;
                ?>

            </tbody>                                
        </table>
</div>