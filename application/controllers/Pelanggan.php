<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('m_pelanggan');
    }


    public function register()
    {
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Lengkap', 'required|trim', ['required' => '%s Harus Diisi.!']);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_pelanggan.email]', ['required' => '%s Harus Diisi.!', 'valid_email' => '%s Tidak Valid.!', 'is_unique' => '%s Sudah Terdatar.!']);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|matches[password2]', ['required' => '%s Harus Diisi.!', 'matches' => '%s Tidak Sama.!']);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', ['required' => '%s Harus Diisi.!', 'matches' => '%s Tidak Sama.!']);

        if ($this->form_validation->run() == false) {

            $data = [
                'title' => 'Register Pelanggan',
                'isi'   => 'v_register'
            ];

            $this->load->view('layout/v_wrapper_frontend', $data, false);
        } else {
            // ambil datanya.
            $data = [
                'nama_pelanggan'    => $this->input->post('nama_pelanggan'),
                'email'             => $this->input->post('email'),
                'password'          => $this->input->post('password1')
            ];

            $this->m_pelanggan->register($data);

            $this->session->set_flashdata('pesan', 'Berhasil mendaftar, Silahkan Login.!');
            redirect('pelanggan/register');
        }
    }

    public function login()
    {
        // set rules
        $this->form_validation->set_rules('email', 'Email', 'required', ['required' => '%s Harus Diisi.!!']);
        $this->form_validation->set_rules('password', 'Password', 'required', ['required' => '%s Harus Diisi.!!']);

        if ($this->form_validation->run() == true) {

            $email = $this->input->post('email');
            $password = $this->input->post('password');

            // ambil function login dari library.
            $this->pelanggan_login->login($email, $password);
        }
        $data = [
            'title' => 'Login Pelanggan',
            'isi'   => 'v_login_pelanggan'
        ]; 

        $this->load->view('layout/v_wrapper_frontend', $data, false);
    }

    public function logout()
    {
        $this->pelanggan_login->logout();
    }

    public function akun()
    {
        // memproteksi halman
        $this->pelanggan_login->proteksi_halaman();

        $data = [
            'title' => 'Akun Saya',
            'isi'   => 'v_akun_saya'
        ];

        $this->load->view('layout/v_wrapper_frontend', $data, false);
    }
}
