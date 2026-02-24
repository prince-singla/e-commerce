<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->library('session');
    }

    public function index()
    {
        $data['title'] = "Cart - Cart-Mart";

        $cart = $this->session->userdata('cart');
        if(!$cart){
            $cart = [];
        }

        $items = [];
        $grand_total = 0;

        foreach($cart as $product_id => $qty){

            $product = $this->Product_model->get_by_id($product_id);

            if($product){

                $price = ($product['offer_price'] > 0 && $product['offer_price'] < $product['original_price'])
                    ? $product['offer_price']
                    : $product['original_price'];

                $subtotal = $price * $qty;
                $grand_total += $subtotal;

                $items[] = [
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'image' => $product['image'],
                    'price' => $price,
                    'qty' => $qty,
                    'subtotal' => $subtotal,
                    'stock' => $product['stock']
                ];
            }
        }

        $data['items'] = $items;
        $data['grand_total'] = $grand_total;

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/navbar');
        $this->load->view('cart/index', $data);
        $this->load->view('layouts/footer');
    }

    public function add($id)
    {
        $product = $this->Product_model->get_by_id($id);

        if(!$product){
            show_404();
        }

        if($product['stock'] <= 0){
            redirect('products/view/'.$id);
        }

        $cart = $this->session->userdata('cart');
        if(!$cart){
            $cart = [];
        }

        if(isset($cart[$id])){
            $cart[$id] += 1;
        } else {
            $cart[$id] = 1;
        }

        // Stock limit
        if($cart[$id] > $product['stock']){
            $cart[$id] = $product['stock'];
        }

        $this->session->set_userdata('cart', $cart);

        redirect('cart');
    }

    public function update()
    {
        if($this->input->server('REQUEST_METHOD') !== 'POST'){
            redirect('cart');
        }

        $qtys = $this->input->post('qty');
        $cart = $this->session->userdata('cart');

        if(!$cart){
            $cart = [];
        }

        if(is_array($qtys)){
            foreach($qtys as $product_id => $qty){

                $qty = (int)$qty;

                if($qty <= 0){
                    unset($cart[$product_id]);
                } else {

                    $product = $this->Product_model->get_by_id($product_id);
                    if($product){
                        if($qty > $product['stock']){
                            $qty = $product['stock'];
                        }
                    }

                    $cart[$product_id] = $qty;
                }
            }
        }

        $this->session->set_userdata('cart', $cart);
        redirect('cart');
    }

    public function remove($id)
    {
        $cart = $this->session->userdata('cart');
        if(!$cart){
            $cart = [];
        }

        if(isset($cart[$id])){
            unset($cart[$id]);
        }

        $this->session->set_userdata('cart', $cart);
        redirect('cart');
    }

    public function clear()
    {
        $this->session->unset_userdata('cart');
        redirect('cart');
    }
    public function ajax_add()
    {
        if($this->input->server('REQUEST_METHOD') !== 'POST'){
            echo json_encode(['status' => false, 'message' => 'Invalid request']);
            return;
        }

        $id = (int)$this->input->post('product_id');

        $product = $this->Product_model->get_by_id($id);

        if(!$product){
            echo json_encode(['status' => false, 'message' => 'Product not found']);
            return;
        }

        if($product['stock'] <= 0){
            echo json_encode(['status' => false, 'message' => 'Out of stock']);
            return;
        }

        $cart = $this->session->userdata('cart');
        if(!$cart){
            $cart = [];
        }

        if(isset($cart[$id])){
            $cart[$id] += 1;
        } else {
            $cart[$id] = 1;
        }

        // Stock limit
        if($cart[$id] > $product['stock']){
            $cart[$id] = $product['stock'];
        }

        $this->session->set_userdata('cart', $cart);

        // cart count
        $cart_count = 0;
        foreach($cart as $qty){
            $cart_count += (int)$qty;
        }

        echo json_encode([
            'status' => true,
            'message' => 'Added to cart',
            'cart_count' => $cart_count
        ]);
    }
}


