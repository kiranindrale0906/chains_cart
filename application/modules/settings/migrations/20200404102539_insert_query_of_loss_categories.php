<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_insert_query_of_loss_categories extends CI_Model {

  public function up()
  {
    $this->db->query("INSERT INTO `loss_categories` (`id`, `department_name`, `name`, `created_at`, `updated_at`, `created_by`, `updated_by`, `is_delete`) VALUES
(1, 'Melting', 'Melting Loss', '2020-04-03 19:58:40', '2020-04-03 19:58:40', 7, 0, 0),
(2, 'AG Melting', 'Melting Loss', '2020-04-03 19:58:59', '2020-04-03 19:58:59', 7, 0, 0),
(3, 'PL Melting', 'Melting Loss', '2020-04-03 19:59:17', '2020-04-03 19:59:17', 7, 0, 0),
(4, 'Flatting', 'Tarpatta And Flatting Loss', '2020-04-03 20:00:55', '2020-04-03 20:00:55', 7, 0, 0),
(5, 'AU+FE', 'Tarpatta And Flatting Loss', '2020-04-03 20:01:16', '2020-04-03 20:01:16', 7, 0, 0),
(6, 'Strip Cutting', 'Tarpatta And Flatting Loss', '2020-04-03 20:01:28', '2020-04-03 20:01:28', 7, 0, 0),
(7, 'Bull Block', 'Tarpatta And Flatting Loss', '2020-04-03 20:01:49', '2020-04-03 20:01:49', 7, 0, 0),
(8, 'Tarpatta', 'Tarpatta And Flatting Loss', '2020-04-03 20:02:05', '2020-04-03 20:02:05', 7, 0, 0),
(9, 'Stamping', 'Tarpatta And Flatting Loss', '2020-04-03 20:02:33', '2020-04-03 20:02:33', 7, 0, 0),
(10, 'Dye', 'Tarpatta And Flatting Loss', '2020-04-03 20:02:44', '2020-04-03 20:02:44', 7, 0, 0),
(11, 'Wire Drawing', 'Tarpatta And Flatting Loss', '2020-04-03 20:02:56', '2020-04-03 20:02:56', 7, 0, 0),
(12, 'Pipe Making', 'Tarpatta And Flatting Loss', '2020-04-03 20:03:12', '2020-04-03 20:03:12', 7, 0, 0),
(13, 'Annealing II', 'Tarpatta And Flatting Loss', '2020-04-03 20:03:24', '2020-04-03 20:03:24', 7, 0, 0),
(14, '14 by 14', 'Tarpatta And Flatting Loss', '2020-04-03 20:03:42', '2020-04-03 20:03:42', 7, 0, 0),
(17, 'Shampoo And Steel', 'Shampoo And Steel Loss', '2020-04-03 20:06:33', '2020-04-04 00:32:17', 7, 7, 0),
(18, 'Polish', 'Shampoo And Steel Loss', '2020-04-03 20:06:48', '2020-04-04 00:32:39', 7, 7, 0),
(19, 'Refresh-Repairing', 'Shampoo And Steel Loss', '2020-04-03 20:07:01', '2020-04-04 00:32:49', 7, 7, 0),
(20, 'Shampoo and Steel II', 'Shampoo And Steel Loss', '2020-04-03 20:07:28', '2020-04-04 00:32:58', 7, 7, 0),
(21, 'Shampoo', 'Shampoo And Steel Loss', '2020-04-03 20:08:00', '2020-04-04 00:33:06', 7, 7, 0),
(22, 'Pasta', 'Pasta Loss', '2020-04-03 20:08:40', '2020-04-03 20:08:40', 7, 0, 0),
(23, 'Pasta Shampoo', 'Pasta Loss', '2020-04-03 20:10:53', '2020-04-03 20:10:53', 7, 0, 0),
(24, 'Buffing', 'Buffing Loss', '2020-04-03 20:12:23', '2020-04-03 20:12:23', 7, 0, 0),
(25, 'Buffing II', 'Buffing Loss', '2020-04-03 20:12:40', '2020-04-03 20:12:40', 7, 0, 0),
(26, 'Walnut', 'Walnut Loss', '2020-04-04 00:29:24', '2020-04-04 00:29:24', 7, 0, 0),
(27, 'Walnut Shampoo', 'Walnut Loss', '2020-04-04 00:29:35', '2020-04-04 00:29:35', 7, 0, 0),
(28, 'Spring', 'Bengali Loss', '2020-04-04 00:29:35', '2020-04-04 00:29:35', 7, 0, 0),
(29, 'Chain Making', 'Bengali Loss', '2020-04-04 00:29:35', '2020-04-04 00:29:35', 7, 0, 0),
(30, 'Joinning Department', 'Bengali Loss', '2020-04-04 00:29:35', '2020-04-04 00:29:35', 7, 0, 0),
(31, 'Hook', 'Bengali Loss', '2020-04-04 00:29:35', '2020-04-04 00:29:35', 7, 0, 0),
(32, 'PL Buffing', 'PL Buffing', '2020-04-04 00:29:35', '2020-04-04 00:29:35', 7, 0, 0);
");
  }


}

?>