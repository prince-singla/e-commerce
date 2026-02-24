<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

    public function add()
    {
        $id = $this->input->post('product_id');

        if(!$id){
            echo json_encode(['status'=>false, 'msg'=>'No product id']);
            return;
        }

        $cart = $this->session->userdata('cart');

        if(!$cart){
            $cart = [];
        }

        if(isset($cart[$id])){
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        $this->session->set_userdata('cart', $cart);

        echo json_encode([
            'status' => true,
            'msg' => 'Added to cart',
            'cart' => $cart
        ]);
    }


    public function count()
    {
        $cart = $this->session->userdata('cart');
        $count = 0;

        if($cart && is_array($cart)){
            foreach($cart as $qty){
                $count += $qty;
            }
        }

        echo json_encode(['count'=>$count]);
    }
}