<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_home extends CI_Model
{
    // mengambil semua barang dari tabel barang, yang berelasi(join) dengan tabel kategori.
    public function get_all_barang()
    {
        // query join.
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori', 'left');

        $this->db->order_by('id_barang', 'DESC');
        return  $this->db->get()->result_array();
    }

    // mengambil semua data kategori.
    public function get_all_Kategori()
    {
        $this->db->order_by('id_kategori', 'DESC');
        $query = $this->db->get('tb_kategori');
        return $query->result_array();
    }

    // mengambil data kategori sesuai dengan id.
    public function kategori($id_kategori)
    {
        return $this->db->get_where('tb_kategori', ['id_kategori' => $id_kategori])->row_array();
    }

    // mengambil data barang didalam tabel barang yg berelasikan(join) dengan tabel kategori berdasarkan id kategori.
    public function get_all_barang_by_id($id_kategori)
    {
        // query join.
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori', 'left');

        $this->db->where('tb_barang.id_kategori', $id_kategori);
        return  $this->db->get()->result_array();
    }

    // mengambil data barang sesuai dengan id.
    public function detail_barang($id_barang)
    {
        // query join.
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori', 'left');

        $this->db->where('id_barang', $id_barang);
        return  $this->db->get()->row_array();
    }

    // mengambil data barang berdasarkan id.
    public function get_gambar_barang_by_id($id_barang)
    {
        return $this->db->get_where('tb_gambar', ['id_barang' => $id_barang])->result_array();
    }
}
