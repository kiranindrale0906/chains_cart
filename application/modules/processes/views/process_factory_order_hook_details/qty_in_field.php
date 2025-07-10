<style>
.width{
  width: 60px;
}
</style>
<td class="text-right">
  <?php 
    if ($field_value > 0)
      load_field('plain/text', array('field' => $field_name,
                                     'value' => $field_value,
                                     'index' => $index,
                                     'class' => width,
                                     'horizontal' => true,
                                     'controller' => 'process_factory_order_details')); 
    else
      echo '-';
  ?>
</td>