<?php

function hcl_wastages_checks() {
  $count = array('srno'=>'HCL1','title'=>'A3','A'=>'select count(*) as weight from processes','C'=>'select count(*) as weight from processes');
  $max = array('srno'=>'HCL2','title'=>'A4','A'=>'select count(*)+1 as weight from processes','C'=>'select count(*) as weight from processes');
  return array($count,$max);
}