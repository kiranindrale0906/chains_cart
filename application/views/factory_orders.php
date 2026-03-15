<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
}
</style>

<div id="container" class="container" >
    <h3>Factory Orders</h3>
        <?php if($this->session->flashdata('message')){?>
        <div class="alert alert-success">      
            <?php echo $this->session->flashdata('message')?>
        </div>
        <?php } ?>

        <br>
        <div align="right"> 
          <a href="<?php echo site_url('Factory_orders/add_data'); ?>">Add Factory Orders</a>
        </div>
    <br>

    <table class="" style="width:100%" >
        <thead>
        <tr>
            <th >Order No.</th>
            <th>Customer Name</th>
            <th class='text-right'>Melting</th>
            <th>Date</th>
            <th>Due Date</th>
            <th>View</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>

        <tbody>
          <?php
            if(isset($factory_orders) && is_array($factory_orders) && count($factory_orders)): 
            $i=1;
            foreach ($factory_orders as $index => $factory_order) { 
            ?>
            <tr <?php if($i%2==0){echo 'class="even"';}else{echo'class="odd"';}?>>
                <td ><?php echo $factory_order['id']; ?></td>            
                <td><?php echo $factory_order['customer_name']; ?></td>
                <td class='text-right'><?php echo four_decimal($factory_order['melting']); ?></td>
                <td><?php echo !empty($factory_order['date'])?date('d-m-Y',strtotime($factory_order['date'])):'-'; ?></td>
                <td><?php echo !empty($factory_order['due_date'])?date('d-m-Y',strtotime($factory_order['due_date'])):'-'; ?></td>
                <td><a href="<?php echo site_url('Factory_orders/view_data/'. $factory_order['id'].''); ?>">View</a></td>
               <td><a href="<?php echo site_url('Factory_orders/edit_data/'. $factory_order['id'].''); ?>">Edit</a></td>            
                <td><a href="<?php echo site_url('Factory_orders/delete_data/'. $factory_order['id'].''); ?>">Delete</a></td> 
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