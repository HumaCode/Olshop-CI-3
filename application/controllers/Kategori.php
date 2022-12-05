<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('m_kategori');
    }


    public function index()
    {
        $data = [
            'title'     => 'Kategori',
            'kategori'  => $this->m_kategori->get_all_kategori(),
            'isi'       => 'v_kategori'
        ];

        $this->load->view('layout/v_wrapper_backend', $data, false);
    }

    public function add()
    {
        $data = [
            'nama_kategori'     => $this->input->post('nama_kategori')
        ];

        $this->m_kategori->add($data);
        $this->session->set_flashdata('pesan', 'Data kategori berhasil ditambahkan');
        redirect('kategori');
    }

    public function edit($id_kategori)
    {
        $data = [
            'id_kategori'       => $id_kategori,
            'nama_kategori'     => $this->input->post('nama_kategori')
        ];

        $this->m_kategori->edit($data);
        $this->session->set_flashdata('pesan', 'Data kategori berhasil diedit');
        redirect('kategori');
    }

    public function delete($id_kategori)
    {
        $data = [
            'id_kategori' => $id_kategori
        ];

        $this->m_kategori->delete($data);
        $this->session->set_flashdata('pesan', 'Data kategori berhasil hapus');
        redirect('kategori');
    }
}
