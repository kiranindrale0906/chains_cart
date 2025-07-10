Drop VIEW view_daily_drawer_summary;
CREATE VIEW view_daily_drawer_summary AS
SELECT processes.id AS process_id,
        lot_no AS lot_no,
        product_name AS product_name,
        department_name AS department_name,
        processes.daily_drawer_in_weight AS in_weight,
        0 AS out_weight,
        processes.issue_daily_drawer_wastage AS issue_daily_drawer_wastage,
        hook_kdm_purity AS hook_kdm_purity,
        processes.process_name AS daily_drawer_type,
        processes.karigar AS karigar,
        processes.chain_name AS chain_name,
        processes.created_at AS created_at,
        processes.is_delete AS is_delete
        FROM processes
        UNION
SELECT process_details.process_id as process_id,
       lot_no AS lot_no,
       '' AS product_name,
       '' AS department_name,
       0 AS in_weight,
       process_details.hook_in-process_details.hook_out+process_details.daily_drawer_out_weight as out_weight,
       0 as issue_daily_drawer_wastage,
       process_details.hook_kdm_purity AS hook_kdm_purity,
       process_details.daily_drawer_type AS daily_drawer_type,
       process_details.karigar AS karigar,
       process_details.chain_name AS chain_name,
       process_details.created_at AS created_at,
       process_details.is_delete AS is_delete
       FROM process_details