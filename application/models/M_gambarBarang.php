<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_gambarBarang extends CI_Model
{
    public function get_all_gambar_barang()
    {

        // query join.
        $this->db->select('tb_barang.*,COUNT(tb_gambar.id_barang) as total_gambar');
        $this->db->from('tb_barang');
        $this->db->join('tb_gambar', 'tb_gambar.id_barang = tb_barang.id_barang', 'left');
        $this->db->group_by('tb_barang.id_barang');
        $this->db->order_by('id_barang', 'DESC');
        return  $this->db->get()->result_array();
    }

    public function get_gambar_barang($id_gambar)
    {
        return $this->db->get_where('tb_gambar', ['id_gambar' => $id_gambar])->row_array();
    }

    public function get_gambar_barang_by_id($id_barang)
    {
        return $this->db->get_where('tb_gambar', ['id_barang' => $id_barang])->result_array();
    }

    public function tambah($data)
    {
        $this->db->insert('tb_gambar', $data);
    }

    public function delete($data)
    {
        $this->db->where('id_gambar', $data['id_gambar']);
        $this->db->delete('tb_gambar', $data);
    }
}
