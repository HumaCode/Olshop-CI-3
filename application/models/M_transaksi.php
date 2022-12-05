<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_transaksi extends CI_Model
{
    public function simpan_transaksi($data)
    {
        $this->db->insert('tb_transaksi', $data);
    }

    public function simpan_rincian_transaksi($data_rincian)
    {
        $this->db->insert('tb_rincian', $data_rincian);
    }

    public function belum_bayar()
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));

        // tambahkan filter status order = 0, 
        $this->db->where('status_order=0');

        $this->db->order_by('id_transaksi', 'desc');

        return $this->db->get()->result_array();
    }

    public function dikemas()
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));

        // tambahkan filter status order = 1, karena akan di tampilkan di baris dikemas 
        $this->db->where('status_order=1');

        $this->db->order_by('id_transaksi', 'desc');

        return $this->db->get()->result_array();
    }

    public function dikirim()
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));

        // tambahkan filter status order = 2, karena akan di tampilkan di baris dikirim 
        $this->db->where('status_order=2');

        $this->db->order_by('id_transaksi', 'desc');

        return $this->db->get()->result_array();
    }

    public function selesai()
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));

        // tambahkan filter status order = 3, karena akan di tampilkan di baris selesai 
        $this->db->where('status_order=3');

        $this->db->order_by('id_transaksi', 'desc');

        return $this->db->get()->result_array();
    }

    public function detail_pesanan($id_transaksi)
    {
        return $this->db->get_where('tb_transaksi', ['id_transaksi' => $id_transaksi])->row_array();
    }

    public function rekening()
    {
        return $this->db->get('tb_rekening')->result_array();
    }

    public function upload_bukti_bayar($data)
    {
        $this->db->where('id_transaksi', $data['id_transaksi']);
        $this->db->update('tb_transaksi', $data);
    }
}
