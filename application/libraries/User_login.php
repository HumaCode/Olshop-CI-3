<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_login
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model('m_auth');
    }

    public function login($username, $password)
    {
        $cek = $this->ci->m_auth->login_user($username, $password);

        if ($cek) {
            $nama_user  = $cek->nama_user;
            $username   = $cek->username;
            $level_user = $cek->level_user;

            // buat session
            $this->ci->session->set_userdata('username', $username);
            $this->ci->session->set_userdata('nama_user', $nama_user);
            $this->ci->session->set_userdata('level_user', $level_user);

            // jika benar, akan di redirek ke halaman admin/user(sesuai dengan levelnya)
            redirect('admin');
        }
        // jika salah/tidak cocok.
        $this->ci->session->set_flashdata('error', 'Username atau password salah');
        redirect('auth/login_user');
    }

    // memproteksi halaman, harus login terlebih dahulu sebelum mengakses suatu halaman.
    public function proteksi_halaman()
    {
        if ($this->ci->session->userdata('username') == '') {
            $this->ci->session->set_flashdata('error', 'Anda belum login.!');
            redirect('auth/login_user');
        } elseif (!$this->ci->session->userdata('username')) {
            redirect('home/error');
        }
    }

    public function logout()
    {
        $this->ci->session->unset_userdata('username');
        $this->ci->session->unset_userdata('nama_user');
        $this->ci->session->unset_userdata('level_user');

        // pesan flash.
        $this->ci->session->set_flashdata('pesan', 'Anda berhasil logout.!');
        redirect('auth/login_user');
    }
}
