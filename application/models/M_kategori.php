<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_kategori extends CI_Model
{
    public function get_all_Kategori()
    {
        $this->db->order_by('id_kategori', 'DESC');
        $query = $this->db->get('tb_kategori');
        return $query->result_array();
    }

    public function add($data)
    {
        $this->db->insert('tb_kategori', $data);
    }

    public function edit($data)
    {
        $this->db->where('id_kategori', $data['id_kategori']);
        $this->db->update('tb_kategori', $data);
    }

    public function delete($data)
    {
        $this->db->where('id_kategori', $data['id_kategori']);
        $this->db->delete('tb_kategori', $data);
    }
}
