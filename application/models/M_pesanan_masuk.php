<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_pesanan_masuk extends CI_Model
{
    public function pesanan()
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');

        // filter berdasarkan status order yaitu 0 => Pesanan Masuk
        $this->db->where('status_order=0');
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get()->result_array();
    }

    public function pesanan_diproses()
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');

        // filter berdasarkan status order yaitu 1 => Pesanan Dikemas
        $this->db->where('status_order=1');
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get()->result_array();
    }

    public function pesanan_dikirim()
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');

        // filter berdasarkan status order yaitu 2 => Pesanan Dikirim
        $this->db->where('status_order=2');
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get()->result_array();
    }

    public function pesanan_selesai()
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');

        // filter berdasarkan status order yaitu 3 => Pesanan Selesai
        $this->db->where('status_order=3');
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get()->result_array();
    }

    public function update_pesanan($data)
    {
        $this->db->where('id_transaksi', $data['id_transaksi']);
        $this->db->update('tb_transaksi', $data);
    }
}

// catatan status order.
// status order = 0 => Pesanan Masuk,
// status order = 1 => Dikemas,
// status order = 2 => Dikirim, 
// status order = 3 => Selesai.
