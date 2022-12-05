<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_auth extends CI_Model
{
    public function login_user($username, $password)
    {
        return $this->db->get_where('tb_user', ['username' => $username, 'password' => $password])->row();
    }

    public function login_pelanggan($email, $password)
    {
        return $this->db->get_where('tb_pelanggan', ['email' => $email, 'password' => $password])->row();
    }
}
