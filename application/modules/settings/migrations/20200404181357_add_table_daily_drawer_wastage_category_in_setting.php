<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_daily_drawer_wastage_category_in_setting extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `daily_drawer_wastage_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(225) DEFAULT NULL,
  `product_name` varchar(225) DEFAULT NULL,
  `process_name` varchar(225) DEFAULT NULL,
  `department_name` varchar(225) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(225) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(225) DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
  
  $this->db->query("INSERT INTO `daily_drawer_wastage_categories` (`id`, `name`, `product_name`, `process_name`, `department_name`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_delete`) VALUES
(1, 'Rope Chain Wastage', 'Rope Chain', 'AG', 'AG Melting', '2020-04-04 12:57:09', '7', '2020-04-04 12:57:33', '7', 0),
(2, 'Rope Chain Wastage', 'Rope Chain', 'AG Flatting', 'Melting', '2020-04-04 12:58:41', '7', '2020-04-04 12:58:41', NULL, 0),
(3, 'Machine Chain Wastage', 'Machine Chain', 'AG', 'Melting', '2020-04-04 13:00:30', '7', '2020-04-04 13:00:30', NULL, 0),
(4, 'Choco Chain Wastage', 'Choco Chain', 'AG', 'Melting', '2020-04-04 13:01:04', '7', '2020-04-04 13:01:04', NULL, 0),
(5, 'Round Box Chain Wastage', 'Round Box Chain', 'AG', 'Melting', '2020-04-04 16:39:59', '7', '2020-04-04 16:39:59', NULL, 0),
(6, 'Sisma Chain Wastage', 'Sisma Chain', 'AG', 'Melting', '2020-04-04 16:40:47', '7', '2020-04-04 16:40:47', NULL, 0),
(7, 'Indo Tally Chain Wastage', 'Indo tally Chain', 'AG', 'AG Melting', '2020-04-04 16:45:09', '7', '2020-04-04 16:45:09', NULL, 0),
(8, 'Indo Tally Chain Wastage', 'Indo tally Chain', 'AG Flatting', 'Melting', '2020-04-04 16:45:48', '7', '2020-04-04 16:45:48', NULL, 0),
(9, 'Indo Tally Chain Wastage', 'Indo tally Chain', 'PL', 'PL Melting', '2020-04-04 16:46:22', '7', '2020-04-04 16:46:22', NULL, 0),
(10, 'Indo Tally Chain Wastage', 'Indo tally Chain', 'PL Flatting', 'Melting', '2020-04-04 16:46:51', '7', '2020-04-04 16:46:51', NULL, 0),
(11, 'Hollow Choco Chain Wastage', 'Hollow Choco Chain', 'PL', 'PL Melting', '2020-04-04 16:47:39', '7', '2020-04-04 16:47:39', NULL, 0),
(12, 'Hollow Choco Chain Wastage', 'Hollow Choco Chain', 'PL Flatting', 'Melting', '2020-04-04 16:48:06', '7', '2020-04-04 16:48:06', NULL, 0),
(13, 'ARC Wastage', 'ARC', 'ARC', 'Melting', '2020-04-04 17:08:10', '7', '2020-04-04 17:08:10', NULL, 0),
(14, 'HCL Wastage', 'HCL', 'HCL Melting Process', 'Melting', '2020-04-04 17:08:35', '7', '2020-04-04 17:08:35', NULL, 0),
(15, 'Office Outside Wastage', 'Office Outside', 'KDM', 'Melting', '2020-04-04 17:09:48', '7', '2020-04-04 17:09:48', NULL, 0),
(16, 'Office Outside Wastage', 'Office Outside', 'Hook', 'Melting', '2020-04-04 17:10:14', '7', '2020-04-04 17:10:14', NULL, 0),
(17, 'Office Outside Wastage', 'Office Outside', 'Ball', 'Melting', '2020-04-04 17:11:02', '7', '2020-04-04 17:11:02', NULL, 0),
(18, 'Office Outside Wastage', 'Office Outside', 'Cutting Wire', 'Melting', '2020-04-04 17:11:26', '7', '2020-04-04 17:11:26', NULL, 0),
(19, 'Office Outside Wastage', 'Office Outside', 'Cutting Pipe', 'Melting', '2020-04-04 17:11:50', '7', '2020-04-04 17:11:50', NULL, 0),
(20, 'Office Outside Wastage', 'Office Outside', 'Solid Pipe', 'Melting', '2020-04-04 17:12:24', '7', '2020-04-04 17:12:24', NULL, 0),
(21, 'Office Outside Wastage', 'Office Outside', 'Hollow Pipe', 'Melting', '2020-04-04 17:12:58', '7', '2020-04-04 17:12:58', NULL, 0),
(22, 'Office Outside Wastage', 'Office Outside', 'Solid Wire', 'Melting', '2020-04-04 17:13:21', '7', '2020-04-04 17:13:21', NULL, 0),
(23, 'Office Outside Wastage', 'Office Outside', 'Hard Wire', 'Melting', '2020-04-04 17:14:55', '7', '2020-04-04 17:14:55', NULL, 0),
(24, 'Daily Drawer Wastage', 'Daily Drawer', 'Melting', 'Melting', '2020-04-04 17:15:23', '7', '2020-04-04 17:15:23', NULL, 0),
(25, 'Tounch Out Wastage', 'Tounch Out', 'Melting', 'Melting', '2020-04-04 17:15:43', '7', '2020-04-04 17:15:43', NULL, 0),
(26, 'Ghiss Out Wastage', 'Ghiss Out', 'Melting', 'Melting', '2020-04-04 17:16:09', '7', '2020-04-04 17:16:09', NULL, 0),
(27, 'Loss Out Wastage', 'Loss Out', 'Melting', 'Melting', '2020-04-04 17:16:44', '7', '2020-04-04 17:16:44', NULL, 0),
(28, 'Rope Ghiss Out Wastage', 'HCL Ghiss Out', 'Melting', 'Melting', '2020-04-04 17:18:54', '7', '2020-04-04 17:18:54', NULL, 0);
");
  }


}

?>