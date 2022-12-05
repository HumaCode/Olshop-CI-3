<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('m_home');
    }

    public function index()
    {
        $data = [
            'title'     => 'Home',
            'barang'    =>  $this->m_home->get_all_barang(),
            'isi'       => 'v_home'
        ];

        $this->load->view('layout/v_wrapper_frontend', $data, false);
    }

    public function kategori($id_kategori)
    {
        // buat variabel kategori agar nama kategori bisa di dambil untuk titile.
        $kategori = $this->m_home->kategori($id_kategori);

        $data = [
            'title'     => 'Kategori ' . $kategori['nama_kategori'],
            'barang'    =>  $this->m_home->get_all_barang_by_id($id_kategori),
            'kategori'  => $this->m_home->kategori($id_kategori),
            'isi'       => 'v_kategori_barang'
        ];

        $this->load->view('layout/v_wrapper_frontend', $data, false);
    }

    public function detail_barang($id_barang)
    {
        $data = [
            'title'     => 'Detail Barang',
            'gambar'    => $this->m_home->get_gambar_barang_by_id($id_barang),
            'barang'    =>  $this->m_home->detail_barang($id_barang),
            'isi'       => 'v_detail_barang'
        ];

        $this->load->view('layout/v_wrapper_frontend', $data, false);
    }

    public function error()
    {
        $data = [
            'title' => 'Error Page',
        ];

        $this->load->view('v_error', $data, false);
    }
}
