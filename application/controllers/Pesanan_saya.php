<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan_saya extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('m_transaksi');
        $this->load->model('m_pesanan_masuk');
    }


    public function index()
    {
        $data = [
            'title'         => 'Pesanan Saya',
            'belum_bayar'   => $this->m_transaksi->belum_bayar(),
            'dikemas'      => $this->m_transaksi->dikemas(),
            'dikirim'      => $this->m_transaksi->dikirim(),
            'selesai'      => $this->m_transaksi->selesai(),
            'isi'           => 'v_pesanan_saya'
        ];

        $this->load->view('layout/v_wrapper_frontend', $data, false);
    }

    public function bayar($id_transaksi)
    {
        $this->form_validation->set_rules('atas_nama', 'Atas Nama', 'required|trim', ['required' => '%s Harus Diisi.!!']);

        if ($this->form_validation->run() == true) {

            // upload gambar.
            $config['upload_path']      = './assets/img/bukti_bayar/';
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['max_size']         = '2000';

            $this->upload->initialize($config);

            $field_name = 'bukti_bayar';
            // jika tidak melakukan upload, maka tmpilkan halaman tambah.
            if (!$this->upload->do_upload($field_name)) {
                $data = [
                    'title'         => 'Pembayaran',
                    'pesanan'       => $this->m_transaksi->detail_pesanan($id_transaksi),
                    'rekening'      => $this->m_transaksi->rekening(),
                    'error_upload'  => $this->upload->display_errors(),
                    'isi'           => 'v_bayar'
                ];

                $this->load->view('layout/v_wrapper_frontend', $data, false);
            } else {

                // melakukan upload.
                $upload_data    = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/img/bukti_bayar/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);



                $data = [
                    'id_transaksi'  => $id_transaksi,
                    'atas_nama'     => $this->input->post('atas_nama'),
                    'nama_bank'     => $this->input->post('nama_bank'),
                    'no_rek'        => $this->input->post('no_rek'),
                    'status_bayar'  => '1',
                    'bukti_bayar'   => $upload_data['uploads']['file_name'],
                ];


                $this->m_transaksi->upload_bukti_bayar($data);
                $this->session->set_flashdata('pesan', 'Bukti pembayaran berhasil dikirim..!!');
                redirect('pesanan_saya');
            }
        }


        $data = [
            'title'         => 'Pembayaran',
            'pesanan'       => $this->m_transaksi->detail_pesanan($id_transaksi),
            'rekening'      => $this->m_transaksi->rekening(),
            'isi'           => 'v_bayar'
        ];

        $this->load->view('layout/v_wrapper_frontend', $data, false);
    }

    public function diterima($id_transaksi)
    {
        $data = [
            'id_transaksi' => $id_transaksi,
            'status_order' => '3'
        ];

        $this->m_pesanan_masuk->update_pesanan($data);
        $this->session->set_flashdata('pesan', 'Pesanan Selesai dan Sudah diterima');
        redirect('pesanan_saya');
    }
}
