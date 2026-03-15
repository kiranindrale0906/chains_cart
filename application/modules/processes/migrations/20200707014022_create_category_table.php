<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_category_table extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `product_name` varchar(225) NOT NULL,
  `category_one` varchar(225) NOT NULL,
  `category_two` varchar(225) NOT NULL,
  `category_three` varchar(225) NOT NULL,
  `category_four` varchar(225) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(225) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(225) NOT NULL,
  `is_delete` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

$this->db->query("ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);
");
$this->db->query("ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
");
  }


}

?>