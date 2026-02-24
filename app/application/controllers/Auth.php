<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->config->load('custom');
    }

    public function register()
    {
        $data['title'] = "Register";
        $data['error'] = "";

        if($this->input->server('REQUEST_METHOD') === 'POST'){

            // 🔹 Get form data
            $name = trim($this->input->post('name'));
            $email = trim($this->input->post('email'));
            $phone = trim($this->input->post('phone'));
            $gender = $this->input->post('gender');
            $hobbies = $this->input->post('hobbies');
            $password = $this->input->post('password');

            // 🔹 Basic validation
            if(empty($name) || empty($email) || empty($password) || empty($gender)){
                $data['error'] = "All required fields must be filled.";
            } else {

                // 🔹 Check duplicate email
                $exists = $this->db->where('email', $email)->get('users')->row();

                if($exists){
                    $data['error'] = "Email already registered.";
                } else {

                    // 🔥 IMAGE UPLOAD START
                    $imageName = '';

                    if(!empty($_FILES['image']['name'])){

                        $config['upload_path'] = './uploads/users/';
                        $config['allowed_types'] = 'jpg|jpeg|png';
                        $config['file_name'] = time();

                        $this->load->library('upload', $config);

                        if($this->upload->do_upload('image')){
                            $uploadData = $this->upload->data();
                            $imageName = $uploadData['file_name'];
                        } else {
                            $data['error'] = $this->upload->display_errors();
                        }
                    }
                    // 🔥 IMAGE UPLOAD END


                    // 🔹 Prepare data for insert
                    $insert = [
                        'name' => $name,
                        'email' => $email,
                        'phone' => $phone,
                        'gender' => $gender,
                        'hobbies' => !empty($hobbies) ? implode(',', $hobbies) : '',
                        'password' => password_hash($password, PASSWORD_DEFAULT),
                        'role' => 1,
                        'image' => $imageName
                    ];

                    // 🔹 Insert into DB
                    $this->db->insert('users', $insert);

                    // 🔹 Flash message
                    $this->session->set_flashdata('success', 'Account created successfully! Please login.');

                    // 🔹 Redirect
                    redirect('auth/login');
                    exit;
                }
            }
        }

        // 🔹 Load views
        $this->load->view('layouts/header', $data);
        $this->load->view('auth/register', $data);
        $this->load->view('layouts/footer');

    }

    public function login()
    {
        if($this->session->userdata('user_id')){
            redirect('/');
        }

        $data['title'] = "Login - Cart-Mart";
        $data['error'] = "";


        if($this->input->server('REQUEST_METHOD') === 'POST'){
            // 🔥 STEP 3: CAPTCHA VALIDATION START
            $token = $this->input->post('recaptcha_token');

            if(empty($token)){
                $this->session->set_flashdata('error', 'Captcha verification failed');
                redirect('auth/login');
            }

            $secret = '6Lf_CnYsAAAAAEWHIrzno61fZrp8RgPUVEpZB0Ny';

            $response = file_get_contents(
                "https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$token}"
            );

            $result = json_decode($response, true);
            $result = json_decode($response, true);


// 🔥 IMPORTANT: CHECK SCORE
            if(!$result['success'] || $result['score'] < 0.5){
                $this->session->set_flashdata('error', 'Suspicious activity detected');
                redirect('auth/login');
            }
            // 🔥 CAPTCHA VALIDATION END

            $email = trim($this->input->post('email'));
            $password = $this->input->post('password');

            $user = $this->User_model->get_by_email($email);

            if(!$user || !password_verify($password, $user['password'])){
                $data['error'] = "Invalid email or password.";
            } else {

                $this->session->set_userdata([
                    'user_id' => $user['id'],
                    'name' => $user['name'],
                    'role' => $user['role'],
                    'image' => $user['image']
                ]);



                redirect('/');
            }
        }

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/navbar');
        $this->load->view('auth/login', $data);
        $this->load->view('layouts/footer');

    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }
    public function googleLogin()
    {
        require_once FCPATH.'vendor/autoload.php';

        $client = new Google_Client();
        $client->setClientId($this->config->item('google_client_id'));
        $client->setClientSecret($this->config->item('google_client_secret'));
        $client->setRedirectUri($this->config->item('google_redirect_uri'));

        $client->addScope("email");
        $client->addScope("profile");


        redirect($client->createAuthUrl());
    }
    public function googleCallback()
    {
        require_once FCPATH.'vendor/autoload.php';

        $client = new Google_Client();
        $client->setClientId($this->config->item('google_client_id'));
        $client->setClientSecret($this->config->item('google_client_secret'));
        $client->setRedirectUri($this->config->item('google_redirect_uri'));

        $code = $this->input->get('code');

        if(!$code){
            echo "No code received from Google";
            exit;
        }

        $token = $client->fetchAccessTokenWithAuthCode($code);

        if(isset($token['error'])){
            echo "Token Error:";
            print_r($token);
            exit;
        }

        $client->setAccessToken($token);

        $google_service = new Google_Service_Oauth2($client);
        $data = $google_service->userinfo->get();

        $email = $data->email;
        $name = $data->name;
        $image = $data->picture;

        // 🔥 CHECK USER
        $user = $this->db->where('email', $email)->get('users')->row_array();

        if(!$user){
            $this->db->insert('users', [
                'name' => $name,
                'email' => $email,
                'password' => '',
                'image' => $image,
                'role' => 1
            ]);

            $user_id = $this->db->insert_id();
        } else {
            $user_id = $user['id'];
        }

        // 🔥 SESSION
        $this->session->set_userdata([
            'user_id' => $user_id,
            'name' => $name,
            'image' => $image
        ]);

        redirect('/');
     }


}
