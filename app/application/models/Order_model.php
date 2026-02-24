<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

    public function create_order($user_id, $total)
    {
        $this->db->insert('orders', [
            'user_id' => $user_id,
            'total_amount' => $total,
            'status' => 'pending'
        ]);

        return $this->db->insert_id();
    }

    public function add_item($order_id, $item)
    {
        return $this->db->insert('order_items', [
            'order_id' => $order_id,
            'product_id' => $item['product_id'],
            'price' => $item['price'],
            'qty' => $item['qty'],
            'subtotal' => $item['subtotal']
        ]);
    }

    public function get_orders_by_user($user_id)
    {
        return $this->db
            ->order_by('id', 'DESC')
            ->get_where('orders', ['user_id' => $user_id])
            ->result_array();
    }

    public function get_order_items($order_id)
    {
        return $this->db
            ->select('order_items.*, products.name, products.image')
            ->from('order_items')
            ->join('products', 'products.id = order_items.product_id')
            ->where('order_items.order_id', $order_id)
            ->get()
            ->result_array();
    }

    public function get_order_by_id($id)
    {
        return $this->db->get_where('orders', ['id' => $id])->row_array();
    }
    public function get_all_orders_admin()
    {
        return $this->db
            ->select('orders.*, users.name as user_name, users.email as user_email')
            ->from('orders')
            ->join('users', 'users.id = orders.user_id')
            ->order_by('orders.id', 'DESC')
            ->get()
            ->result_array();
    }

    public function get_order_admin($id)
    {
        return $this->db
            ->select('orders.*, users.name as user_name, users.email as user_email, users.phone as user_phone')
            ->from('orders')
            ->join('users', 'users.id = orders.user_id')
            ->where('orders.id', $id)
            ->get()
            ->row_array();
    }


    public function update_status($id, $status)
    {
        return $this->db->where('id', $id)->update('orders', [
            'status' => $status
        ]);
    }

}
