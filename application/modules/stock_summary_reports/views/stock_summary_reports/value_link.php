<?php 
  $chain_column_name=(isset($column_type))?$column_type:'';
  $query = (isset($query)&&!empty($query)) ? $query : '';
  $product_name = (isset($product_name)&&!empty($product_name)) ? $product_name : '';
  $process_name = (isset($process_name)&&!empty($process_name)) ? $process_name : '';
  $section_name = (isset($section_name) && !empty($section_name)) ? $section_name : '';
  $href = ADMIN_PATH.'stock_summary_reports/stock_summary_list?row='.$row_name.'&product='.$product_name.'&process='.$process_name.'&section_name='.$section_name.'&type_of='.$column.'&is_highlight='.$chain_column_name;
//  $href = ADMIN_PATH.'settings/run_sql_query/index?query='.$query;

?>

<?php if ($type!='total') { ?>
  <a href='<?= $href?>' target="_blank">
<?php }
    
$row = $$row_name; 
$quantity = (!empty($row['quantity'])&&($row['quantity'] != 0)) ? two_decimal($row['quantity']) : '0';
$balance_gross_percantage = ($row['balance'] != 0) ? two_decimal($row['balance_gross'] / $row['balance']*100) : '0';
$balance_fine_percantage = ($row['balance_gross'] != 0) ? two_decimal($row['balance_fine'] / $row['balance_gross']*100) : '0';
if($column == 'balance_gross'){
  echo (isset($row[$column]) && $row[$column] != 0) ? four_decimal($row[$column]).' - ('.$balance_gross_percantage.'%)' : '-';
}
elseif($column == 'balance_fine'){
  echo (isset($row[$column]) && $row[$column] != 0) ? four_decimal($row[$column]).' - ('.$balance_fine_percantage.'%)' : '-';
}
else{
  if(HOST=="Hallmark"){
    if((isset($row[$column]) && $row[$column] != 0 && $quantity!=0)){
      echo  four_decimal($row[$column]).' - ('.$quantity.')' ;
    }elseif((isset($row[$column]) && $row[$column] != 0 && $quantity==0)){
      echo  four_decimal($row[$column]);
    }else{
      echo '-';
    }

  }else{
      echo (isset($row[$column]) && $row[$column] != 0) ? four_decimal($row[$column]): '-';
  }
  
}
if ($type!='total') { ?>
  </a>
<?php } ?>