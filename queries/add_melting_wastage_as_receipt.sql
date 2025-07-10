select out_weight,in_weight,melting_wastage,product_name,process_name,department_name from processes where product_name='Loss Out' and melting_wastage>0;
update processes set product_name='Receipt',process_name='Receipt',department_name='Start' where product_name='Loss Out' and melting_wastage>0;


select out_weight,in_weight,melting_wastage,product_name,process_name,department_name from processes where product_name='Ghiss Out' and melting_wastage>0;
update processes set product_name='Receipt',process_name='Receipt',department_name='Start' where product_name='Ghiss Out' and melting_wastage>0;


select out_weight,in_weight,melting_wastage,product_name,process_name,department_name from processes where product_name='Daily Drawer Wastage' and melting_wastage>0;
update processes set product_name='Receipt',process_name='Receipt',department_name='Start' where product_name='Daily Drawer Wastage' and melting_wastage>0;


select out_weight,in_weight,melting_wastage,product_name,process_name,department_name from processes where product_name='Tounch Ghiss Out' and melting_wastage>0;
update processes set product_name='Receipt',process_name='Receipt',department_name='Start' where product_name='Tounch Ghiss Out' and melting_wastage>0;


select out_weight,in_weight,melting_wastage,product_name,process_name,department_name from processes where product_name='Tounch Out' and melting_wastage>0;
update processes set product_name='Receipt',process_name='Receipt',department_name='Start' where product_name='Tounch Out' and melting_wastage>0;


select out_weight,in_weight,melting_wastage,product_name,process_name,department_name from processes where product_name='Hcl Ghiss Out' and melting_wastage>0;
update processes set product_name='Receipt',process_name='Receipt',department_name='Start' where product_name='Hcl Ghiss Out' and melting_wastage>0;


select out_weight,in_weight,melting_wastage,product_name,process_name,department_name from processes where product_name='HCL' and melting_wastage>0;
update processes set product_name='Receipt',process_name='Receipt',department_name='Start' where product_name='HCL' and melting_wastage>0;





