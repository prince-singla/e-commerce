<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('Order_model');
        $this->load->library('session');
    }

    public function index()
    {
        // Must login
        if(!$this->session->userdata('user_id')){
            redirect('auth/login');
        }

        $cart = $this->session->userdata('cart');
        if(!$cart || empty($cart)){
            redirect('cart');
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
                    'price' => $price,
                    'qty' => $qty,
                    'subtotal' => $subtotal,
                    'stock' => $product['stock']
                ];
            }
        }

        $data['title'] = "Checkout - Cart-Mart";
        $data['items'] = $items;
        $data['grand_total'] = $grand_total;

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/navbar');
        $this->load->view('checkout/index', $data);
        $this->load->view('layouts/footer');
    }

    public function place_order()
    {
        if(!$this->session->userdata('user_id')){
            redirect('auth/login');
        }

        $cart = $this->session->userdata('cart');
        if(!$cart || empty($cart)){
            redirect('cart');
        }

        $user_id = $this->session->userdata('user_id');

        $items = [];
        $grand_total = 0;

        // Validate stock + prepare items
        foreach($cart as $product_id => $qty){

            $product = $this->Product_model->get_by_id($product_id);

            if(!$product){
                redirect('cart');
            }

            if($product['stock'] < $qty){
                redirect('cart');
            }

            $price = ($product['offer_price'] > 0 && $product['offer_price'] < $product['original_price'])
                ? $product['offer_price']
                : $product['original_price'];

            $subtotal = $price * $qty;
            $grand_total += $subtotal;

            $items[] = [
                'product_id' => $product['id'],
                'price' => $price,
                'qty' => $qty,
                'subtotal' => $subtotal
            ];
        }

        // DB transaction
        $this->db->trans_start();

        $order_id = $this->Order_model->create_order($user_id, $grand_total);

        foreach($items as $item){
            $this->Order_model->add_item($order_id, $item);

            // Deduct stock
            $this->db->set('stock', 'stock-'.$item['qty'], FALSE)
                ->where('id', $item['product_id'])
                ->update('products');
        }

        $this->db->trans_complete();

        // Clear cart
        $this->session->unset_userdata('cart');

        redirect('orders/success/'.$order_id);
    }
}
