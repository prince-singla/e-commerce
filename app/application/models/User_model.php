<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function get_by_email($email)
    {
        return $this->db->get_where('users', ['email' => $email])->row_array();
    }

    public function insert_user($data)
    {
        return $this->db->insert('users', $data);
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('users', ['id' => $id])->row_array();
    }
    public function get_all_users()
    {
        return $this->db
            ->order_by('id', 'DESC')
            ->get('users')
            ->result_array();
    }


    public function update_user($id, $data)
    {
        return $this->db->where('id', $id)->update('users', $data);
    }

    public function delete_user($id)
    {
        return $this->db->where('id', $id)->delete('users');
    }

}
