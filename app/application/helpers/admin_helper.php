<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function admin_check()
{
    $ci =& get_instance();
    $ci->load->library('session');

    if($ci->session->userdata('role') != 2){
        redirect('admin/login');
    }
}
