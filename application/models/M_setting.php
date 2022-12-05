<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_setting extends CI_Model
{
    public function data_setting()
    {
        return $this->db->get_where('tb_toko', ['id' => 1])->row_array();
    }

    public function edit($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tb_toko', $data);
    }
}
