<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class API_Controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        header('Content-Type: application/json');
    }

    protected function response($data, $status = true, $code = 200)
    {
        http_response_code($code);
        echo json_encode([
            'status' => $status,
            'data' => $data
        ]);
        exit;
    }

    protected function error($message, $code = 400)
    {
        http_response_code($code);
        echo json_encode([
            'status' => false,
            'message' => $message
        ]);
        exit;
    }
}