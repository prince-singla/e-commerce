<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends API_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
    }

    public function index()
    {
        $data = [
            'hero' => $this->Product_model->get_latest_products(5),
            'featured' => $this->Product_model->get_by_role_limit('featured', 10),
            'recent' => $this->Product_model->get_latest_products(8),
            'bestseller' => $this->Product_model->get_by_role_limit('bestseller', 10)
        ];

        return $this->response($data);
    }
}