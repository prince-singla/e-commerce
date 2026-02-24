class Products extends API_Controller {

public function __construct()
{
parent::__construct();
$this->load->model('Product_model');
}

public function index()
{
$products = $this->Product_model->get_latest_products(10);
return $this->response($products);
}

public function view($id)
{
$product = $this->Product_model->get_by_id($id);

if(!$product){
return $this->error('Product not found');
}

return $this->response($product);
}
}