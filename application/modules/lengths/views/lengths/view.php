<!--<div id="div1"> 
</div>-->
<div class="">
  <form action="<?= ADMIN_PATH?>lengths/length_carts/store" method="POST">
  <table class="table table-sm fixedthead table-default">
    <thead>
      <tr>
        <th>Design Code</th>
        <th>Range</th>
        <th>Weight</th>
<!--        <th>Length</th>-->
        <th>Selected Value</th>
        <th>Quantity</th>
      </tr>
    </thead>
    <input type="hidden" name="length_carts[id]" value="" />
      <tbody class="set_json_data">
        
      </tbody>
      
    
  </table>
    <button name="Save" type="submit" class="btn btn-sm btn_blue">Save</button>
  </form>
</div>