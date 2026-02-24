class Orders extends API_Controller {

public function __construct()
{
parent::__construct();
$this->load->model('Order_model');
$this->load->model('Product_model');
}

public function place()
{
$user_id = $this->session->userdata('user_id');

if(!$user_id){
return $this->error('Login required');
}

$cart = $this->session->userdata('cart');

if(empty($cart)){
return $this->error('Cart is empty');
}

$this->db->trans_begin();

$total = 0;

foreach($cart as $pid => $qty){
$product = $this->Product_model->get_by_id($pid);
$price = ($product['offer_price'] > 0) ? $product['offer_price'] : $product['original_price'];
$total += $price * $qty;
}

$this->db->insert('orders', [
'user_id' => $user_id,
'total_amount' => $total,
'status' => 'pending'
]);

$order_id = $this->db->insert_id();

foreach($cart as $pid => $qty){
$product = $this->Product_model->get_by_id($pid);
$price = ($product['offer_price'] > 0) ? $product['offer_price'] : $product['original_price'];

$this->db->insert('order_items', [
'order_id' => $order_id,
'product_id' => $pid,
'price' => $price,
'qty' => $qty,
'subtotal' => $price * $qty
]);
}

$this->db->trans_commit();

$this->session->unset_userdata('cart');

return $this->response([
'message' => 'Order placed successfully',
'order_id' => $order_id
]);
}
}