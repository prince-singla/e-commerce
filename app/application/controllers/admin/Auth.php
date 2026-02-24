<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
    }

    public function login()
    {
        // If already logged in as admin, go dashboard
        if($this->session->userdata('role') == 2){
            redirect('admin/dashboard');
        }

        $data['title'] = "Admin Login - Cart-Mart";
        $data['error'] = "";


        // On form submit
        if($this->input->server('REQUEST_METHOD') === 'POST'){


            $email = trim($this->input->post('email'));
            $password = $this->input->post('password');

            // basic validation
            if(empty($email) || empty($password)){
                $data['error'] = "Please enter email and password.";
            } else {

                $user = $this->User_model->get_by_email($email);

                if(!$user){
                    $data['error'] = "Invalid email or password.";
                }
                else if(!password_verify($password, $user['password'])){
                    $data['error'] = "Invalid email or password.";
                }
                else if($user['role'] != 2){
                    $data['error'] = "You are not allowed to access admin panel.";
                }
                else {

                    // success login
                    $this->session->set_userdata([
                        'user_id' => $user['id'],
                        'name'    => $user['name'],
                        'role'    => $user['role']
                    ]);

                    redirect('admin/dashboard');
                }
            }
        }

        $this->load->view('layouts/header', $data);
        $this->load->view('admin/login', $data);
        $this->load->view('layouts/footer');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('admin/login');
    }
}
