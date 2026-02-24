<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_model');
        $this->load->library('session');
    }

    public function index()
    {
        if(!$this->session->userdata('user_id')){
            redirect('auth/login');
        }

        $data['title'] = "My Orders - Cart-Mart";
        $data['orders'] = $this->Order_model->get_orders_by_user($this->session->userdata('user_id'));

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/navbar');
        $this->load->view('orders/index', $data);
        $this->load->view('layouts/footer');
    }

    public function success($id)
    {
        if(!$this->session->userdata('user_id')){
            redirect('auth/login');
        }

        $order = $this->Order_model->get_order_by_id($id);

        if(!$order || $order['user_id'] != $this->session->userdata('user_id')){
            show_404();
        }

        $data['title'] = "Order Success - Cart-Mart";
        $data['order'] = $order;
        $data['items'] = $this->Order_model->get_order_items($id);

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/navbar');
        $this->load->view('orders/success', $data);
        $this->load->view('layouts/footer');
    }
}
