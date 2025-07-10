<?php

function tounch_loss_fine_checks() {
  return array(tlf1(), tlf2(), tlf3(), tlf4(), tlf5());
}

function tlf1() {
  /* select id, product_name, process_name, department_name, tounch_loss_fine, issue_tounch_loss_fine, balance_tounch_loss_fine 
            from processes 
            where tounch_loss_fine !=  issue_tounch_loss_fine + balance_tounch_loss_fine;  */
  return array( 'srno'  => 'TLF1',
                'title' => 'Tounch Loss Fine: In = Issue + Balance',
                'A'     => 'select sum(tounch_loss_fine) from processes',
                'C'     => 'select sum(issue_tounch_loss_fine) from processes',
                'D'     => 'select sum(balance_tounch_loss_fine) from processes');
}

function tlf2() {
  /* select id, gross_weight from melting_lots where id not in (select melting_lot_id from melting_lot_details); */
  return array( 'srno'  => 'TLF2',
                'title' => 'Tounch Loss Fine: Issue department gross must be zero',
                'A'     => 'select sum(in_weight) from issue_departments where product_name = "Tounch Loss Fine"');
}

function tlf3() {
  /* select p.id, sum(idd.out_weight) as idd_out, p.issue_tounch_loss_fine as p_out 
            from issue_department_details idd 
            inner join processes p on idd.process_id = p.id 
            inner join issue_departments isd on isd.id = idd.issue_department_id 
            where isd.product_name in ('Tounch Loss Fine') 
            group by p.id having idd_out != p_out; */
  return array( 'srno'  => 'TLF3',
                'title' => 'Tounch Loss Fine: Processes issue must be equal to issue department (positve entry)',
                'A'     => 'select sum(in_weight) from issue_departments where product_name = "Tounch Loss Fine" and in_purity = 100',
                'C'     => 'select sum(issue_tounch_loss_fine) from processes');
}

function tlf4() {
  /* same as tlf3 */
  return array( 'srno'  => 'TLF4',
                'title' => 'Tounch Loss Fine: Processes issue must be equal to issue department (negative entry)',
                'A'     => 'select sum(in_weight) from issue_departments where product_name = "Tounch Loss Fine" and in_purity = 0',
                'C'     => 'select sum(issue_tounch_loss_fine) from processes');
}

function tlf5() {
  return array( 'srno'  => 'TLF5',
                'title' => 'Tounch Loss Fine: Processes issue must be equal to issue department details',
                'A'     => 'select sum(out_weight) from issue_department_details where product_name = "Tounch Loss Fine"',
                'C'     => 'select sum(issue_tounch_loss_fine) from processes');
}