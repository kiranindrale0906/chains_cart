Loss Out  
select sum(in_weight) from processes where product_name='Loss Out' and department_name='Start';
select sum(out_weight) from process_out_wastage_details where field_name='Loss Out';
select sum(loss),sum(balance_loss),sum(out_loss) from processes;

DELETE from  `process_out_wastage_details` where field_name='Loss Out';
update processes set balance_loss=balance_loss+out_loss;
update processes set out_loss=0;

Ghiss Out 
select sum(in_weight) from processes where product_name='Ghiss Out' and department_name='Start';
select sum(out_weight) from process_out_wastage_details where field_name='Ghiss Out';
select sum(ghiss),sum(balance_ghiss),sum(out_ghiss) from processes;

DELETE from  `process_out_wastage_details` where field_name='Ghiss Out';
DELETE from  `processes` where product_name='Ghiss Out';
update processes set balance_ghiss=balance_ghiss+out_ghiss;
update processes set out_ghiss=0;

Daily Drawer Wastage
select sum(in_weight) from processes where product_name='Daily Drawer' and department_name='Start';
select sum(out_weight) from process_out_wastage_details where field_name='Daily Drawer Wastage';
select sum(daily_drawer_wastage),sum(balance_daily_drawer_wastage),sum(out_daily_drawer_wastage) from processes;


DELETE from  `process_out_wastage_details` where field_name='Daily Drawer Wastage';
DELETE from  `processes` where product_name='Daily Drawer';

update processes set balance_daily_drawer_wastage=balance_daily_drawer_wastage+out_daily_drawer_wastage;
update processes set out_daily_drawer_wastage=0;

Tounch Ghiss Out  

select sum(in_weight) from processes where product_name='Tounch Ghiss Out' and department_name='Start';
select sum(out_weight) from process_out_wastage_details where field_name='Tounch Ghiss Out';
select sum(tounch_ghiss),sum(balance_tounch_ghiss),sum(out_tounch_ghiss) from processes;


DELETE from  `process_out_wastage_details` where field_name='Tounch Ghiss Out';
DELETE from  `processes` where product_name='Tounch Ghiss Out';

update processes set balance_tounch_ghiss=balance_tounch_ghiss+out_tounch_ghiss;
update processes set out_tounch_ghiss=0;

Tounch Out
select sum(in_weight) from processes where product_name='Tounch Out' and department_name='Start';
select sum(out_weight) from process_out_wastage_details where field_name='Tounch Out';
select sum(tounch_out),sum(balance_tounch_out),sum(out_tounch_out) from processes;

DELETE from  `process_out_wastage_details` where field_name='Tounch Out';
DELETE from  `processes` where product_name='Tounch Out';

update processes set balance_tounch_out=balance_tounch_out+out_tounch_out;
update processes set out_tounch_out=0;

Hcl Ghiss Out
select sum(in_weight) from processes where product_name='Hcl Ghiss Out' and department_name='Start';
select sum(out_weight) from process_out_wastage_details where field_name='Hcl Ghiss Out';
select sum(hcl_ghiss),sum(balance_hcl_ghiss),sum(out_hcl_ghiss) from processes;


DELETE from  `process_out_wastage_details` where field_name='Hcl Ghiss Out';
DELETE from  `processes` where product_name='Hcl Ghiss Out';

update processes set balance_hcl_ghiss=balance_hcl_ghiss+out_hcl_ghiss;
update processes set out_hcl_ghiss=0;

HCL Wastage

select sum(in_weight) from processes where product_name='HCL' and department_name='Start';
select sum(out_weight) from process_out_wastage_details where field_name='HCL Wastage';
select sum(hcl_wastage),sum(balance_hcl_wastage),sum(out_hcl_wastage) from processes;


DELETE from  `process_out_wastage_details` where field_name='HCL Wastage';
DELETE from  `processes` where product_name='HCL';

update processes set balance_hcl_wastage=balance_hcl_wastage+out_hcl_wastage;
update processes set out_hcl_wastage=0;
