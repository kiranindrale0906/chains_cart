<tbody>
	<?php 
	$diffrence = array();
			foreach($db as $key =>$values){ 
					foreach($db2 as $index => $value_db2){
						if($value_db2['id'] == $values['id']){
							$differ = array_diff_assoc($values,$value_db2);
							if(!empty($differ))
								$diffrence[] = $values;
						}
				}
			}

				$i = 0;
				foreach($diffrence as $values){
					if(!empty($values)){ ?>
				
						<tr>
							<?php 
							foreach($values as $value){
									echo "<td>".$value."</td>";
							}?>
					</tr>			
<?php 		$i++;}
				}
			if($i == 0){?>
				
				<td >No Diffrence Found.</td>
		
<?php }
if($i >0 && !empty($columns)){?>
	Note : Diffrence found because we found new column in current database table. if you want to update this database in backup database to view data diffrence click on link. <a href="<?php echo base_url().'sys/db_compares/update/'.$table.'?columns='.$columns?>">Update</a>
<?php }

?>
</tbody>