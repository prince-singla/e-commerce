class Auth extends API_Controller {

public function __construct()
{
parent::__construct();
$this->load->model('User_model');
}

public function login()
{
$email = $this->input->post('email');
$password = $this->input->post('password');

$user = $this->User_model->get_by_email($email);

if(!$user || !password_verify($password, $user['password'])){
return $this->error('Invalid credentials');
}

$this->session->set_userdata([
'user_id' => $user['id'],
'role' => $user['role']
]);

return $this->response($user);
}
}