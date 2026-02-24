<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

    public function get_all()
    {
        return $this->db->order_by('name', 'ASC')->get('categories')->result_array();
    }

    public function get_by_slug($slug)
    {
        return $this->db->get_where('categories', ['slug' => $slug])->row_array();
    }
}
