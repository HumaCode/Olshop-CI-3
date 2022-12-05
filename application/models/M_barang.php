<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_barang extends CI_Model
{
    public function get_all_barang()
    {

        // query join.
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori', 'left');

        $this->db->order_by('id_barang', 'DESC');
        return  $this->db->get()->result_array();
    }

    public function get_barang_by_id($id_barang)
    {
        return $this->db->get_where('tb_barang', ['id_barang' => $id_barang])->row_array();
    }

    public function add($data)
    {
        $this->db->insert('tb_barang', $data);
    }

    public function edit($data)
    {
        $this->db->where('id_barang', $data['id_barang']);
        $this->db->update('tb_barang', $data);
    }

    public function delete($data)
    {
        $this->db->where('id_barang', $data['id_barang']);
        $this->db->delete('tb_barang', $data);
    }
}
