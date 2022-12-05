<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('m_admin');
        $this->load->model('m_setting');
        $this->load->model('m_pesanan_masuk');
    }

    public function index()
    {
        $data = [
            'title'             => 'Dashboard',
            'total_barang'      => $this->m_admin->total_barang(),
            'total_kategori'    => $this->m_admin->total_kategori(),
            'isi'               => 'v_admin'
        ];

        $this->load->view('layout/v_wrapper_backend', $data, false);
    }

    public function Setting()
    {
        $this->form_validation->set_rules('nama_toko', 'Nama Toko', 'required|trim', ['required' => 'Nama Toko Harus Diisi.!']);
        $this->form_validation->set_rules('kota', 'Kota', 'required|trim', ['required' => 'Kota Harus Diisi.!']);
        $this->form_validation->set_rules('no_tlp', 'No. Telepon', 'required|trim', ['required' => 'No. Telepon Harus Diisi.!']);
        $this->form_validation->set_rules('alamat_toko', 'Alamat Toko', 'required|trim', ['required' => 'Alamat Toko Harus Diisi.!']);

        if ($this->form_validation->run() == false) {

            $data = [
                'title'     => 'Setting Lokasi',
                'setting'   => $this->m_setting->data_setting(),
                'isi'       => 'v_setting'
            ];

            $this->load->view('layout/v_wrapper_backend', $data, false);
        } else {

            // ambil data dari input post.

            $data = [
                'id'            => 1,
                'nama_toko'     => $this->input->post('nama_toko'),
                'lokasi'        => $this->input->post('kota'),
                'alamat_toko'   => $this->input->post('alamat_toko'),
                'no_telepon'    => $this->input->post('no_tlp')
            ];

            // panggil model edit yg mengirimkan data.
            $this->m_setting->edit($data);

            $this->session->set_flashdata('pesan', 'Seting Lokasi berhasil diedit');
            redirect('admin/setting');
        }
    }

    public function pesanan_masuk()
    {
        $data = [
            'title'             => 'Pesanan Masuk',
            'pesanan'           => $this->m_pesanan_masuk->pesanan(),
            'pesanan_diproses'  => $this->m_pesanan_masuk->pesanan_diproses(),
            'pesanan_dikirim'  => $this->m_pesanan_masuk->pesanan_dikirim(),
            'pesanan_selesai'  => $this->m_pesanan_masuk->pesanan_selesai(),
            'isi'               => 'v_pesanan_masuk'
        ];

        $this->load->view('layout/v_wrapper_backend', $data, false);
    }

    public function proses($id_transaksi)
    {
        //  status order dibuat 1 karna akan di arahkan ke menu dikemas.
        $data = [
            'id_transaksi' => $id_transaksi,
            'status_order' => '1'
        ];

        $this->m_pesanan_masuk->update_pesanan($data);
        $this->session->set_flashdata('pesan', 'Pesanan Berhasil Diproses!!');
        redirect('admin/pesanan_masuk');
    }

    public function kirim_resi($id_transaksi)
    {
        //  status order dibuat 2 karna akan di arahkan ke menu Dikirim.
        $data = [
            'id_transaksi' => $id_transaksi,
            'no_resi'      => $this->input->post('no_resi'),
            'status_order' => '2'
        ];

        $this->m_pesanan_masuk->update_pesanan($data);
        $this->session->set_flashdata('pesan', 'Pesanan Berhasil Dikirim!!');
        redirect('admin/pesanan_masuk');
    }
}
