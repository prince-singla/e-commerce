<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // Admin protection
        if(!$this->session->userdata('user_id') || $this->session->userdata('role') != 2){
            redirect('admin/login');
            exit;
        }

        $this->load->model('Order_model');
        $this->load->model('User_model');
    }

    public function index()
    {
        $data['title'] = "Orders - Admin";
        $data['orders'] = $this->Order_model->get_all_orders_admin();

        $this->load->view('layouts/header', $data);
        $this->load->view('admin/orders/index', $data);
        $this->load->view('layouts/footer');
    }

    public function view($id)
    {
        $data['title'] = "Order Details - Admin";

        $data['order'] = $this->Order_model->get_order_admin($id);
        $data['items'] = $this->Order_model->get_order_items($id);

        if(!$data['order']){
            show_404();
        }

        $this->load->view('layouts/header', $data);
        $this->load->view('admin/orders/view', $data);
        $this->load->view('layouts/footer');
    }

    public function update_status($id)
    {
        if($this->input->server('REQUEST_METHOD') !== 'POST'){
            redirect('admin/orders/view/'.$id);
            exit;
        }

        $status = $this->input->post('status');

        $allowed = ['pending','shipped','delivered','cancelled'];

        if(!in_array($status, $allowed)){
            $this->session->set_flashdata('error', 'Invalid status');
            redirect('admin/orders/view/'.$id);
            exit;
        }

        $this->Order_model->update_status($id, $status);

        $this->session->set_flashdata('success', 'Order status updated');
        redirect('admin/orders/view/'.$id);
        exit;
    }
}
