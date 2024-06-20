<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccessControl
{
    private $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    private function checkLogin()
    {
        if (!$this->CI->session->userdata('email')) {
            redirect('auth');
        }
    }

    public function isAdmin()
    {
        $this->checkLogin();
        $user = $this->CI->db->get_where('user', ['email' => $this->CI->session->userdata('email')])->row_array();
        if ($user['role_id'] != 1) {
            redirect('auth/blocked');
        }
    }

    public function isUser()
    {
        $this->checkLogin();
        $user = $this->CI->db->get_where('user', ['email' => $this->CI->session->userdata('email')])->row_array();
        if ($user['role_id'] != 2) {
            redirect('auth/blocked');
        }
    }
}
