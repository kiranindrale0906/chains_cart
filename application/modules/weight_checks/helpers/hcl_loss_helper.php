<?php

function hcl_loss_checks() {
  return array(hl1(), hl2(), hl3());
}

function hl1() {
  /* select id, product_name, process_name, department_name, hcl_loss, issue_hcl_loss, balance_hcl_loss 
            from processes 
            where hcl_loss !=  issue_hcl_loss + balance_hcl_loss;  */
  return array( 'srno'  => 'HL1',
                'title' => 'HCL Loss: In = Issue + Balance',
                'A'     => 'select sum(hcl_loss) from processes',
                'C'     => 'select sum(issue_hcl_loss) from processes'
                'D'     => 'select sum(balance_hcl_loss) from processes');
}

function hl2() {
  /* select p.id, sum(idd.out_weight) as idd_out, p.issue_hcl_loss as p_out 
            from issue_department_details idd 
            inner join processes p on idd.process_id = p.id 
            inner join issue_departments isd on isd.id = idd.issue_department_id 
            where isd.product_name in ('HCL Loss') 
            group by p.id having idd_out != p_out; */
  return array( 'srno'  => 'HL3',
                'title' => 'HCL Loss: Processes issue must be equal to issue department (positve entry)',
                'A'     => 'select sum(in_weight) from issue_departments where product_name = "HCL Loss"',
                'C'     => 'select sum(issue_hcl_loss) from processes');
}

function hl3() {
  /* select p.id, sum(idd.out_weight) as idd_out, p.issue_hcl_loss as p_out 
            from issue_department_details idd 
            inner join processes p on idd.process_id = p.id 
            inner join issue_departments isd on isd.id = idd.issue_department_id 
            where isd.product_name in ('HCL Loss') 
            group by p.id having idd_out != p_out; */
  return array( 'srno'  => 'HL3',
                'title' => 'HCL Loss: Processes issue must be equal to issue department (positve entry)',
                'A'     => 'select sum(in_weight) from issue_departments where product_name = "HCL Loss"',
                'C'     => 'select sum(issue_hcl_loss) from processes');
}