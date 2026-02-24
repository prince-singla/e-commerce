<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Category_model');
        $this->load->model('Product_model');
    }

    public function category($slug)
    {
        $category = $this->Category_model->get_by_slug($slug);

        if(!$category){
            show_404();
        }

        $data['title'] = $category['name']." - Cart-Mart";
        $data['category'] = $category;
        $data['products'] = $this->Product_model->get_by_category($category['id']);

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/navbar');
        $this->load->view('products/category', $data);
        $this->load->view('layouts/footer');
    }

    public function view($id)
    {
        $product = $this->Product_model->get_by_id($id);

        if(!$product){
            show_404();
        }

        $data['title'] = $product['name']." - Cart-Mart";
        $data['product'] = $product;

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/navbar');
        $this->load->view('products/view', $data);
        $this->load->view('layouts/footer');
    }
}
