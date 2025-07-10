<tbody>
	<?php foreach($db as $key =>$values){ ?>
				  <tr>
						<?php foreach($values as $index =>$value){?>
				    <td>
				    	<?php echo $value;?>
				    </td>
					<?php }?>
				  </tr>
 <?php }?>
</tbody>