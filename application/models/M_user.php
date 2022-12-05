<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{
    public function get_all_data()
    {
        $this->db->order_by('id_user', 'DESC');
        $query = $this->db->get('tb_user');
        return $query->result_array();
    }

    public function add($data)
    {
        $this->db->insert('tb_user', $data);
    }

    public function edit($data)
    {
        $this->db->where('id_user', $data['id_user']);
        $this->db->update('tb_user', $data);
    }

    public function delete($data)
    {
        $this->db->where('id_user', $data['id_user']);
        $this->db->delete('tb_user', $data);
    }
}
