<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Belanja extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('m_transaksi');
    }

    public function index()
    {
        $data = [
            'title'     => 'Keranjang Belanja',
            'isi'       => 'v_belanja'
        ];

        $this->load->view('layout/v_wrapper_frontend', $data, false);
    }

    public function add($id_barang)
    {
        $barang = $this->m_home->detail_barang($id_barang);

        if ($this->input->post('qty')) {
            $qty = $this->input->post('qty');
        } else {
            $qty = 1;
        }

        $data = [
            'id'    => $barang['id_barang'],
            'qty'   => $qty,
            'price' => $barang['harga'],
            'name'  => $barang['nama_barang']
        ];

        $this->cart->insert($data);
        redirect('home');
    }

    public function delete($rowid)
    {
        $this->cart->remove($rowid);

        $this->session->set_flashdata('pesan', 'Data Keranjang berhasil hapus');
        redirect('belanja');
    }

    public function update()
    {

        // lakukan perulangan.
        $i =   1;
        foreach ($this->cart->contents() as $items) {
            $data = [
                'rowid' => $items['rowid'],
                'qty'   => $this->input->post($i . '[qty]')
            ];

            $this->cart->update($data);
            $i++;
        }

        $this->session->set_flashdata('pesan', 'Data Keranjang berhasil Diupdate');
        redirect('belanja');
    }

    public function clear()
    {
        $this->cart->destroy();

        $this->session->set_flashdata('pesan', 'Semua Data Keranjang berhasil hapus');
        redirect('belanja');
    }

    public function checkout()
    {
        // memproteksi halman
        $this->pelanggan_login->proteksi_halaman();


        // set rules
        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required|trim', ['required' => '%s Harus Diisi.!']);
        $this->form_validation->set_rules('kota', 'Kota', 'required|trim', ['required' => '%s Harus Diisi.!']);
        $this->form_validation->set_rules('expedisi', 'Expedisi', 'required|trim', ['required' => '%s Harus Diisi.!']);
        $this->form_validation->set_rules('paket', 'Paket', 'required|trim', ['required' => '%s Harus Diisi.!']);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => '%s Harus Diisi.!']);
        $this->form_validation->set_rules('kode_pos', 'Kode Pos', 'required|trim', ['required' => '%s Harus Diisi.!']);
        $this->form_validation->set_rules('nama_penerima', 'Nama Penerima', 'required|trim', ['required' => '%s Harus Diisi.!']);
        $this->form_validation->set_rules('tlp_penerima', 'Telepon Penerima', 'required|trim', ['required' => '%s Harus Diisi.!']);

        if ($this->form_validation->run() == false) {

            $data = [
                'title'     => 'Checkout Belanja',
                'isi'       => 'v_checkout'
            ];

            $this->load->view('layout/v_wrapper_frontend', $data, false);
        } else {

            // simpan di dalam tabel transaksi.
            $data = [
                'id_pelanggan' => $this->session->userdata('id_pelanggan'),
                'no_order' => $this->input->post('no_order'),
                'tgl_order' => date('Y-m-d'),
                'nama_penerima' => $this->input->post('nama_penerima'),
                'tlp_penerima' => $this->input->post('tlp_penerima'),
                'provinsi' => $this->input->post('provinsi'),
                'kota' => $this->input->post('kota'),
                'alamat' => $this->input->post('alamat'),
                'kode_pos' => $this->input->post('kode_pos'),
                'expedisi' => $this->input->post('expedisi'),
                'paket' => $this->input->post('paket'),
                'estimasi' => $this->input->post('estimasi'),
                'ongkir' => $this->input->post('ongkir'),
                'berat' => $this->input->post('berat'),
                'grand_total' => $this->input->post('grand_total'),
                'total_bayar' => $this->input->post('total_bayar'),
                'status_bayar' => '0',
                'status_order' => '0',
            ];

            // simpan di dalam tabel transaksi.
            $this->m_transaksi->simpan_transaksi($data);

            // simpan di dalam tabel rincian belanja.
            $i = 1;
            foreach ($this->cart->contents() as $items) {
                $data_rincian = [
                    'no_order' => $this->input->post('no_order'),
                    'id_barang' => $items['id'],
                    'qty' => $this->input->post('qty' . $i++)
                ];

                // simpan di dalam tabel rincian belanja.
                // didalam perulangan foreach, agar mengulang sebanyak produk yg di dalam keranjang.
                $this->m_transaksi->simpan_rincian_transaksi($data_rincian);
            }

            $this->session->set_flashdata('pesan', 'Pesanan berhasil diproses');

            // setelah berhasil memasukan data kedalam tabel transaksi dan tabel rincian, maka hapus data keranjang belanja.
            $this->cart->destroy();
            redirect('pesanan_saya');
        }
    }
}
