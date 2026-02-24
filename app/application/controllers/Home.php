<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
    }

    public function index()
    {
        $data['title'] = "Home - Cart-Mart";

        $data['hero_products'] = $this->Product_model->get_latest_products(5);
        $data['featured_products'] = $this->Product_model->get_featured(12);
        $data['recent_products'] = $this->Product_model->get_recent(12);
        $data['bestseller_products'] = $this->Product_model->get_bestseller(12);

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/navbar');
        $this->load->view('home', $data);
        $this->load->view('layouts/footer');
    }
}
