<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    public function get_by_category($category_id)
    {
        return $this->db
            ->where('category_id', $category_id)
            ->order_by('created_at', 'DESC')
            ->get('products')
            ->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('products', ['id' => $id])->row_array();
    }

    public function get_featured($limit = 12)
    {
        return $this->db
            ->where('product_role', 'featured')
            ->order_by('created_at', 'DESC')
            ->limit($limit)
            ->get('products')
            ->result_array();
    }

    public function get_recent($limit = 12)
    {
        return $this->db
            ->order_by('created_at', 'DESC')
            ->limit($limit)
            ->get('products')
            ->result_array();
    }

    public function get_bestseller($limit = 12)
    {
        return $this->db
            ->where('product_role', 'bestseller')
            ->order_by('created_at', 'DESC')
            ->limit($limit)
            ->get('products')
            ->result_array();
    }
    public function get_latest_products($limit = 5)
    {
        return $this->db
            ->order_by('id', 'DESC')
            ->limit($limit)
            ->get('products')
            ->result_array();
    }
    public function get_by_role_limit($role, $limit = 10)
    {
        return $this->db
            ->where('product_role', $role)
            ->order_by('id', 'DESC')
            ->limit($limit)
            ->get('products')
            ->result_array();
    }

}
