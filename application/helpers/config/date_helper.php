<?php

  function getDatesFromRange($start, $end, $format = 'Y-m-d') { 
    $dates = array(); 
    $interval = new DateInterval('P1D'); 
  
    $realEnd = new DateTime($end); 
    $realEnd->add($interval); 
  
    $period = new DatePeriod(new DateTime($start), $interval, $realEnd); 
  
    foreach($period as $date)             
      $dates[] = $date->format($format);  
    
    return $dates; 
  } 
  

?>