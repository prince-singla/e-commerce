<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // Admin protection
        if(!$this->session->userdata('user_id') || $this->session->userdata('role') != 2){
            redirect('admin/login');
            exit;
        }

        $this->load->model('User_model');
    }

    public function index()
    {
        $data['title'] = "Users - Admin";
        $data['users'] = $this->User_model->get_all_users();

        $this->load->view('layouts/header', $data);
        $this->load->view('admin/users/index', $data);
        $this->load->view('layouts/footer');
    }

    public function edit($id)
    {
        $data['title'] = "Edit User - Admin";
        $data['user'] = $this->User_model->get_by_id($id);
        $data['error'] = "";

        if(!$data['user']){
            show_404();
        }

        // Prevent admin from editing himself (optional safety)
        if($id == $this->session->userdata('user_id')){
            $data['error'] = "You cannot edit your own account from here.";
        }

        if($this->input->server('REQUEST_METHOD') === 'POST' && empty($data['error'])){

            $update = [
                'name' => trim($this->input->post('name')),
                'email' => trim($this->input->post('email')),
                'phone' => trim($this->input->post('phone')),
                'role' => (int)$this->input->post('role')
            ];

            // basic validation
            if(empty($update['name']) || empty($update['email'])){
                $data['error'] = "Name and Email are required.";
            } else {
                $this->User_model->update_user($id, $update);
                $this->session->set_flashdata('success', 'User updated successfully.');
                redirect('admin/users');
                exit;
            }
        }

        $this->load->view('layouts/header', $data);
        $this->load->view('admin/users/edit', $data);
        $this->load->view('layouts/footer');
    }

    public function delete($id)
    {
        // Prevent admin from deleting himself
        if($id == $this->session->userdata('user_id')){
            $this->session->set_flashdata('error', "You cannot delete your own account.");
            redirect('admin/users');
            exit;
        }

        $this->User_model->delete_user($id);
        $this->session->set_flashdata('success', 'User deleted successfully.');
        redirect('admin/users');
        exit;
    }
}
