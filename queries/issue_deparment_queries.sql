
DELETE from  `issue_departments` where product_name='Melting Wastage';
DELETE from  `issue_department_details` where field_name='Melting Wastage';
update processes set balance_melting_wastage=balance_melting_wastage+issue_melting_wastage;
update processes set issue_melting_wastage=0;

DELETE from  `issue_departments` where product_name='Daily Drawer Wastage';
DELETE from  `issue_department_details` where field_name='Daily Drawer Wastage';
update processes set balance_daily_drawer_wastage=balance_daily_drawer_wastage+issue_daily_drawer_wastage;
update processes set issue_daily_drawer_wastage=0;

DELETE from  `issue_departments` where product_name='GPC Out';
DELETE from  `issue_department_details` where field_name='GPC Out';
update processes set balance_gpc_out=balance_gpc_out+issue_gpc_out;
update processes set issue_gpc_out=0;

DELETE from  `issue_departments` where product_name='Repair Out';
DELETE from  `issue_department_details` where field_name='Repair Out';
update processes set balance_repair_out=balance_repair_out+issue_repair_out;
update processes set issue_repair_out=0;

DELETE from  `issue_departments` where product_name='HCL Loss';
DELETE from  `issue_department_details` where field_name='HCL Loss';
update processes set balance_hcl_loss=balance_hcl_loss+issue_hcl_loss;
update processes set issue_hcl_loss=0;

DELETE from  `issue_departments` where product_name='Tounch Loss Fine';
DELETE from  `issue_department_details` where field_name='Tounch Loss Fine';
update processes set balance_tounch_loss_fine=balance_tounch_loss_fine+issue_tounch_loss_fine;
update processes set issue_tounch_loss_fine=0;

DELETE from  `issue_departments` where product_name='Cutting Ghiss';
DELETE from  `issue_department_details` where field_name='Cutting Ghiss';
update processes set balance_ghiss=balance_ghiss+issue_ghiss;
update processes set issue_ghiss=0;








