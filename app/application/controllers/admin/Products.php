<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        admin_check();
        $this->load->model('Product_admin_model');
        $this->load->model('Category_model');
    }

    public function index()
    {
        $data['title'] = "Manage Products - Cart-Mart";
        $data['products'] = $this->Product_admin_model->get_all();

        $this->load->view('layouts/header', $data);
        $this->load->view('admin/products/index', $data);
        $this->load->view('layouts/footer');
    }

    public function create()
    {
        $data['title'] = "Add Product - Cart-Mart";
        $data['categories'] = $this->Category_model->get_all();
        $data['error'] = "";

        if($this->input->server('REQUEST_METHOD') === 'POST'){

            $upload_name = "";

            // IMAGE UPLOAD
            if(!empty($_FILES['image']['name'])){

                if(!is_dir(FCPATH.'uploads/products')){
                    mkdir(FCPATH.'uploads/products', 0777, true);
                }

                $config['upload_path'] = FCPATH.'uploads/products/';
                $config['allowed_types'] = 'jpg|jpeg|png|webp';
                $config['max_size'] = 20480;
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);

                if(!$this->upload->do_upload('image')){
                    $data['error'] = strip_tags($this->upload->display_errors());
                } else {
                    $upload_name = $this->upload->data('file_name');
                }
            }

            // If no upload error then insert
            if(empty($data['error'])){

                $insert = [
                    'name' => trim($this->input->post('name')),
                    'description' => trim($this->input->post('description')),
                    'original_price' => $this->input->post('original_price'),
                    'offer_price' => $this->input->post('offer_price'),
                    'stock' => $this->input->post('stock'),
                    'category_id' => $this->input->post('category_id'),
                    'product_role' => $this->input->post('product_role'),
                    'image' => $upload_name
                ];

                $this->Product_admin_model->insert($insert);

                redirect('admin/products');
                exit;
            }
        }

        $this->load->view('layouts/header', $data);
        $this->load->view('admin/products/create', $data);
        $this->load->view('layouts/footer');
    }


    public function edit($id)
    {
        $data['title'] = "Edit Product - Cart-Mart";
        $data['categories'] = $this->Category_model->get_all();
        $data['product'] = $this->Product_admin_model->get_by_id($id);
        $data['error'] = "";

        if(!$data['product']){
            show_404();
        }

        if($this->input->post('update')){

            $upload_name = $data['product']['image'];

            if(!empty($_FILES['image']['name'])){

                if(!is_dir(FCPATH.'uploads/products')){
                    mkdir(FCPATH.'uploads/products', 0777, true);
                }

                $config['upload_path'] = FCPATH.'uploads/products/';
                $config['allowed_types'] = 'jpg|jpeg|png|webp';
                $config['max_size'] = 20480;
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);

                if(!$this->upload->do_upload('image')){
                    $data['error'] = $this->upload->display_errors();
                } else {

                    // delete old image
                    if(!empty($data['product']['image']) && file_exists(FCPATH.'uploads/products/'.$data['product']['image'])){
                        unlink(FCPATH.'uploads/products/'.$data['product']['image']);
                    }

                    $upload_name = $this->upload->data('file_name');
                }
            }

            if(empty($data['error'])){

                $update = [
                    'name' => trim($this->input->post('name')),
                    'description' => trim($this->input->post('description')),
                    'original_price' => $this->input->post('original_price'),
                    'offer_price' => $this->input->post('offer_price'),
                    'stock' => $this->input->post('stock'),
                    'category_id' => $this->input->post('category_id'),
                    'product_role' => $this->input->post('product_role'),
                    'image' => $upload_name
                ];

                $this->Product_admin_model->update($id, $update);
                redirect('admin/products');
            }
        }

        $this->load->view('layouts/header', $data);
        $this->load->view('admin/products/edit', $data);
        $this->load->view('layouts/footer');
    }

    public function delete($id)
    {
        $product = $this->Product_admin_model->get_by_id($id);

        if($product){

            if(!empty($product['image']) && file_exists(FCPATH.'uploads/products/'.$product['image'])){
                unlink(FCPATH.'uploads/products/'.$product['image']);
            }

            $this->Product_admin_model->delete($id);
        }

        // Stay on same page
        redirect('admin/products');
    }
}
