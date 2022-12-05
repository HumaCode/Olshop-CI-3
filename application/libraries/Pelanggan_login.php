<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan_login
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model('m_auth');
        $this->ci->load->model('m_pelanggan');
    }

    public function login($email, $password)
    {
        $cek = $this->ci->m_auth->login_pelanggan($email, $password);

        if ($cek) {
            $id_pelanggan       = $cek->id_pelanggan;
            $nama_pelanggan     = $cek->nama_pelanggan;
            $email              = $cek->email;
            $gambar             = $cek->gambar;

            // buat session
            $this->ci->session->set_userdata('id_pelanggan', $id_pelanggan);
            $this->ci->session->set_userdata('nama_pelanggan', $nama_pelanggan);
            $this->ci->session->set_userdata('email', $email);
            $this->ci->session->set_userdata('gambar', $gambar);

            // jika benar, akan di redirek ke halaman admin/user(sesuai dengan levelnya)
            redirect('home');
        }
        // jika salah/tidak cocok.
        $this->ci->session->set_flashdata('error', 'email atau password salah');
        redirect('pelanggan/login');
    }

    // memproteksi halaman, harus login terlebih dahulu sebelum mengakses suatu halaman.
    public function proteksi_halaman()
    {
        if ($this->ci->session->userdata('email') == '') {
            $this->ci->session->set_flashdata('error', 'Anda belum login.!');
            redirect('pelanggan/login');
        } elseif (!$this->ci->session->userdata('email')) {
            redirect('home/error');
        }
    }

    public function logout()
    {
        $this->ci->session->unset_userdata('id_pelanggan');
        $this->ci->session->unset_userdata('nama_pelanggan');
        $this->ci->session->unset_userdata('email');
        $this->ci->session->unset_userdata('gambar');

        // pesan flash.
        $this->ci->session->set_flashdata('pesan', 'Anda berhasil logout.!');
        redirect('pelanggan/login');
    }
}
